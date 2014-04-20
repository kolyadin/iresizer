<?

/*
 * This file is part of the akLib package.
 * (c) 2010 Azat Khuzhin <dohardgopro@gmail.com>
 *
 * For the full copyright and license information, please view http://www.gnu.org/licenses/gpl-2.0.html
 */

/**
 * akDispatcher - Path dispatcher system
 * 
 * @author Azat Khuzhin <dohardgopro@gmail.com>
 * @package akLib
 * @licence GPLv2
 * 
 * @link http://www.pcre.org/
 * @link http://php.net/pcre
 * 
 * @see akException
 */

require_once AKLIB_DIR.'/sys/akException.class.php';

class akDispatcher {
	/**
	 * Path delimiter
	 * It need only to quote them (to get write param)
	 * 
	 * @var char (string, wich length = 1)
	 */
	protected $delimiter = '/';
	/**
	 * Additional param delimiter
	 * It need only to quote them (to get write param)
	 * 
	 * @example /akDispatcher/test/:first_:second (if value of this propery is "_" than this will be work)
	 * @see /akDispatcher/example.php
	 * 
	 * @var char (string, wich length = 1)
	 */
	protected $additionalParamDelimiter = '_';
	/**
	 * List of events
	 * 
	 * @see this::add()
	 * @see this::pattern()
	 * @var array
	 */
	protected $events = array();
	/**
	 * Request HTTP method
	 * Lowercase
	 * 
	 * @var string
	 */
	protected $requestMethod;
	/**
	 * Request HTTP query
	 * 
	 * @var string
	 */
	protected $requestQuery;
	/**
	 * List of vars
	 * 
	 * @see this::setParam()
	 * @see this::getParam()
	 * @see this::deleteParam()
	 * @var array
	 */
	protected $vars = array();
	/**
	 * List of params
	 * 
	 * @see this::run()
	 * @var array
	 */
	protected $params = array();
	/**
	 * Calls before user defined funcOrContent
	 * 
	 * @var callback
	 */
	protected $beforeCallback;
	/**
	 * Calls after user defined funcOrContent
	 * IT NOT RUN ON DEFAULT CALLBACK
	 * 
	 * @var callback
	 */
	protected $afterCallback;
	/**
	 * Calls if not suitable events are founded
	 * IT NOT RUN ON DEFAULT CALLBACK
	 * 
	 * @var callback
	 */
	protected $defaultCallback;
	/**
	 * Calls on error
	 * 
	 * @var callback
	 */
	protected $errorCallback;
	/**
	 * Content charset
	 * To send right headers
	 * 
	 * @var string
	 */
	protected $charset = 'UTF-8';
	/**
	 * Type of content (only text type are avaliable)
	 * 
	 * @var string
	 */
	protected $type = 'html';
	/**
	 * Callbacks returns content not print by it selfs, otherwise callback print it by it self
	 * 
	 * @var bool
	 * @default true
	 */
	public $functionReturnsContent = true;
	/**
	 * Final route
	 * 
	 * Before this function print headers & execute beforeCallback, at the end of function execute: execute afterCallback & print result
	 */
	const FINAL_ROUTE = 1;
	/**
	 * Not final route
	 * Just execute a function
	 */
	const NOT_FINAL_ROUTE = 2;


	/**
	 * Constructor
	 * 
	 * @see class properties
	 * @return void
	 * 
	 * @throws akException
	 */
	public function __construct($delimiter = null, $requestQuery = null, $charset = null, $type = null, $additionalParamDelimiter = null) {
		// delimiter, only 1 first char
		if ($delimiter) $this->delimiter = (string)$delimiter[0];
		
		$this->requestMethod = (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] ? mb_strtolower($_SERVER['REQUEST_METHOD']) : 'get');
		$this->requestQuery = ($requestQuery ? $requestQuery : $_SERVER['REQUEST_URI']);
		if ($charset) $this->charset = $charset;
		if ($type) $this->type = $type;
		if ($additionalParamDelimiter) $this->additionalParamDelimiter = $additionalParamDelimiter;
		
		// errors
		if (!$this->delimiter) throw new akException('No path delimiter');
		if (!$this->requestQuery) throw new akException('No HTTP query');
		if (!$this->requestMethod) throw new akException('No HTTP method');
		if (!$this->charset) throw new akException('No content charset');
		if (!$this->type) throw new akException('No type or content are set');
	}

	/**
	 * Fast init
	 * 
	 * @see this::__construct()
	 * @return object of akDispatcher
	 */
	static function getInstance($delimiter = null, $requestQuery = null, $charset = null, $type = null, $additionalParamDelimiter = null) {
		static $object;
		if (!$object) $object = new akDispatcher($delimiter, $requestQuery, $charset, $type, $additionalParamDelimiter);
		
		return $object;
	}

	/**
	 * Add event
	 * 
	 * If param $funcOrContent is a function,
	 * than it must not to write some thing to STDOUT,
	 * it must return text that it want to write to STDOUT
	 * 
	 * @param mixed $path
	 * @param mixed $funcOrContent - function to run, or file to require, or formated string
	 * @param string $method - "get" or "post" or "both", both - for both methods
	 * @param int $type - type (@see this::NOT_FINAL_ROUTE, this::FINAL_ROUTE)
	 * @return void
	 * 
	 * @link http://php.net/callback
	 * 
	 * @throws akException
	 */
	public function add($path, $funcOrContent, $method = 'get', $type = self::FINAL_ROUTE) {
		$method = mb_strtolower($method);
		if (!in_array($method, array('get', 'post', 'both'))) throw new akException('Method must be "get" or "post" or "both"');
		if (!in_array($type, array(self::FINAL_ROUTE, self::NOT_FINAL_ROUTE))) throw new akException('Not supported type');
		
		if (is_scalar($path)) $path = array($path);
		foreach ($path as &$p) {
			$this->events[] = array(
				'path' => $p,
				'funcOrContent' => $funcOrContent,
				'method' => $method,
				'type' => (int)$type,
			);
		}
	}

	/**
	 * Run dispatcher
	 * And it send all params to function, or to formated string, but not to file (because it's of secure)
	 * 
	 * @see If no suitable events then throwing an exception
	 * @return bool (true on success)
	 * 
	 * @throws akException
	 */
	public function run() {
		if (count($this->events) <= 0) throw new akException('No events found');
		$this->sortEvents();
		
		// run by all events and detect needable
		foreach ($this->events as &$event) {
			// flush array
			$this->params = array();
			
			// founded
			if (preg_match($this->pattern($event['path']), $this->requestQuery, $matches) && ($event['method'] == $this->requestMethod || $event['method'] == 'both')) {
				// delete numeric params
				// first delete than add,
				// because we need to call user func with only string keys
				foreach ($matches as $key => &$value) {
					if (is_numeric($key)) unset($matches[$key]);
				}
				// add string params to param list
				foreach ($matches as $key => &$value) {
					$this->params[$key] = $value;
				}
				
				// not final route
				if ($event['type'] == self::NOT_FINAL_ROUTE) {
					$this->params ? call_user_func_array($event['funcOrContent'], $this->params) : call_user_func($event['funcOrContent']);
					continue;
				}
				
				$content = '';
				if ($this->beforeCallback) $content .= call_user_func($this->beforeCallback);
				// function or content
				if (is_callable($event['funcOrContent'])) {
					$this->headers();
					$content .= ($this->params ? call_user_func_array($event['funcOrContent'], $this->params) : call_user_func($event['funcOrContent']));
				} elseif (is_readable($event['funcOrContent'])) {
					$content .= $this->content($event['funcOrContent'], 'html');
				} else {
					$this->headers();
					$content .= vsprintf($event['funcOrContent'], $this->params);
				}
				if ($this->afterCallback) $content .= call_user_func($this->afterCallback);
				
				if ($content && $this->functionReturnsContent) echo $content;
				return true;
			}
		}
		
		if (!$this->defaultCallback) throw new akException('No suitable events');
		
		$this->headers();
		$content = call_user_func($this->defaultCallback);
		if ($this->functionReturnsContent) echo $content;
		return true;
	}

	/**
	 * Return content
	 * And it extract vars that set by this::set()
	 * 
	 * @param string $path - path to include
	 * @param string $type - type (only text types are avaliable)
	 * @return string
	 * 
	 * @throws akException if file not exists
	 */
	public function content($path) {
		if (!is_readable($path)) throw new akException(sprintf('File "%s" is not exists!', $path));
		
		$this->headers();
		extract($this->vars);
		
		ob_start();
		require $path;
		$content = ob_get_contents();
		ob_end_clean();
		
		return $content;
	}

	/**
	 * Return content
	 * 
	 * @param string $callback - function to call
	 * @param string $params - params to function
	 * @param string $type - type (only text types are avaliable)
	 * @return string
	 * 
	 * @throws akException if file not exists
	 */
	public function call($callback, $params = null) {
		if (!is_callable($callback)) throw new akException(sprintf('Function "%s" is not callable!', $callback));
		
		$this->headers();
		
		ob_start();
		if ($params) {
			call_user_func_array($callback, $params);
		} else {
			call_user_func($callback);
		}
		$content = ob_get_contents();
		ob_end_clean();
		
		return $content;
	}

	/**
	 * Set var
	 * 
	 * @param string $key - key
	 * @param string $value - value
	 * @return void
	 */
	public function set($key, $value) {
		$this->vars[$key] = $value;
	}

	/**
	 * Get var
	 * 
	 * @param string $key - key
	 * @return mixed (mixed - found, otherwise - false (i.e. if not found such var))
	 */
	public function get($key) {
		return (isset($this->vars[$key]) ? $this->vars[$key] : false);
	}

	/**
	 * Delete var
	 * 
	 * @param string $key - key
	 * @return bool (true - deleted, otherwise - false (i.e. if not found such var))
	 */
	public function delete($key) {
		$key = array_search($key, $this->vars);
		// founded
		if ($key !== false) {
			unset($this->vars[$key]);
			return true;
		}
		// not found
		return false;
	}

	/**
	 * Get param
	 * 
	 * @param string $key - key
	 * @return mixed (mixed - found, otherwise - false (i.e. if not found such var))
	 */
	public function getParam($key) {
		return (isset($this->params[$key]) ? $this->params[$key] : false);
	}

	/**
	 * Set callbacks
	 * 
	 * The callback functions must not to write some thing to STDOUT,
	 * it must return text that it want to write to STDOUT
	 * 
	 * @param callback $before - before callback
	 * @param callback $after - after callback
	 * @param callback $default - default callback
	 * @param callback $error - error callback
	 * @param bool $toAllErrors - bind call back to all errors (otherwise only to "E_ALL ^ E_NOTICE ^ E_WARNING")
	 * @return void
	 * 
	 * @throws akException if one of functions is not callable
	 */
	public function setCallbacks($before = null, $after = null, $default = null, $error = null, $toAllErrors = false) {
		if ($before) {
			if (!is_callable($before)) {
				throw new akException(sprintf('Can`t set after callback, because function "%s" is not callable', $before));
			}
			
			$this->beforeCallback = $before;
		}
		if ($after) {
			if (!is_callable($after)) {
				throw new akException(sprintf('Can`t set after callback, because function "%s" is not callable', $after));
			}
			
			$this->afterCallback = $after;
		}
		if ($default) {
			if (!is_callable($default)) {
				throw new akException(sprintf('Can`t set default callback, because function "%s" is not callable', $default));
			}
			
			$this->defaultCallback = $default;
		}
		if ($error) {
			if (!is_callable($error)) {
				throw new akException(sprintf('Can`t set error callback, because function "%s" is not callable', $error));
			}
			
			$this->errorCallback = $error;
			if ($toAllErrors) {
				set_error_handler($this->errorCallback);
			} else {
				set_error_handler($this->errorCallback, E_ALL ^ E_NOTICE ^ E_WARNING);
			}
			set_exception_handler($this->errorCallback);
		}
	}

	/**
	 * Set debug mode
	 * 
	 * @return void
	 */
	public function setDebug($debug = false) {
		if ($debug) {
			ini_set('display_errors', 1);
			error_reporting(E_ALL);
		} else {
			ini_set('display_errors', 0);
			error_reporting(E_ERROR | E_WARNING | E_PARSE);
		}
	}

	/**
	 * Redirect
	 * 
	 * @param string $url - url
	 * @param mixed $status - status
	 * @return void
	 */
	public function redirect($url = null, $status = 'HTTP/1.1 301 Moved Permanently') {
		if (!headers_sent() && $url) {
			if (is_string($status) && !empty($status)) {
				header($status);
				header('Location: ' . $url);
			} elseif (is_numeric($status) && $status > 0) {
				header('Location: ' . $url, $status);
			} else {
				header('Location: ' . $url);
			}
			die;
		}
	}

	/**
	 * Return request method
	 * 
	 * @return string // in lower case
	 */
	public function getRequestMethod() {
		return $this->requestMethod;
	}

	/**
	 * Is post
	 * 
	 * @return bool
	 */
	public function isPost() {
		return $this->requestMethod == 'post';
	}

	/**
	 * Compare for sortEvents [sort strings]
	 * 
	 * @param mixed $a
	 * @param mixed $b
	 * @return int
	 * 
	 * @protected
	 */
	protected function _compare(&$a, &$b) {
		// not final - up
		if ($a['type'] == self::NOT_FINAL_ROUTE) return -1;
		if ($b['type'] == self::NOT_FINAL_ROUTE) return 1;
		// if less characters of ":" - up
		$n1 = substr_count($a['path'], ':');
		$n2 = substr_count($b['path'], ':');
		if ($n1 === $n2) return 0;
		return ($n1 > $n2);
	}

	/**
	 * Trunsfer path to pattern
	 * 
	 * @param string $path - path
	 * @return string
	 * 
	 * @example "/main/:param" => /main/asd ("asd" will be remember) or /main/123 ("123" will be remember)
	 * @example "/main*"  - What your whant at the end - /main/asdasd or /main/as/asd or /main
	 * @example "/main/+"  - /main/asda or /main/asda1 but not /main/
	 * 
	 * @throws akException
	 */
	protected function pattern($path) {
		$path = $this->quote($path, array($this->delimiter, $this->additionalParamDelimiter, '/'));
		
		// delimiter
		static $quotedDelimiter;
		if (!$quotedDelimiter) {
			$quotedDelimiter = $this->quote($this->delimiter . $this->additionalParamDelimiter, array('/', $this->delimiter, $this->additionalParamDelimiter));
		}
		
		$path = preg_replace(
			sprintf('/\\\\\:([^\:%s\\\]+)/is', $quotedDelimiter),
			sprintf('(?P<\1>[^\:%s]+)', $quotedDelimiter),
			$path
		);
		// quantifiers [what your whant]
		$path = strtr($path, array('\*' => '.*', '\?' => '.', '\+' => '.+'));
		
		return sprintf('/^%s$/is', $path);
	}

	/**
	 * PCRE quote
	 * 
	 * @param string $unquotedString
	 * @param mixed $delimiters
	 * @return string
	 */
	protected function quote($unquotedString, $delimiters) {
		if (is_scalar($delimiters)) $delimiters = array($delimiters);
		elseif (is_array($delimiters)) $delimiters = array_unique($delimiters);
		
		$unquotedString = preg_quote($unquotedString);
		
		foreach ($delimiters as $delimiter) {
			// see if preg_quote is already quoted this symbol
			if (preg_quote($delimiter) == '\\' . $delimiter) continue;
			
			$unquotedString = str_replace($delimiter, '\\' . $delimiter, $unquotedString);
		}
		return $unquotedString;
	}

	/**
	 * Send headers if not send yet
	 * 
	 * @return void
	 */
	protected function headers() {
		if (!headers_sent() && $this->type) header(sprintf('Content-type: text/%s; charset=%s', $this->type, $this->charset));
	}

	/**
	 * Sort events
	 * This method is needable! (for right routes)
	 * 
	 * @return void
	 */
	protected function sortEvents() {
		usort($this->events, array(&$this, '_compare'));
	}
}
