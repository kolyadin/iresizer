<?php

require_once (LIB_DIR . 'vpa_tpl_plugins.php');

/**
 * ���������� ������������ ������ � ���� ��������� �������
 * ���� �� ������ ����� ���� - � ���� ������������ :(
 */

class VPA_template {
	public $domain;
	public $path;
	public $template;
	public $result;
	public $page;
	public $lifetime = 0;
	public $data;
	public $log;
	public $plugins; // �������
	public $mod_dir = TPL_MODULES;
	/**
	 * Hosts with static
	 */
    static $staticHosts = array(
        0 => 'http://v1.popcorn-news.ru',
    );
	/**
	 * Int key from array self::$staticHosts
	 *
	 * @var int
	 */
	public $preferStaticHost = null;

	/**
	 * No init param for informer
	 *
	 * @staticvar VPA_template $instance
	 * @param type $noInit
	 * @return VPA_template
	 */
	static public function getInstance($noInit = false) {
		static $instance;
		if (!$instance) {
			$instance = new VPA_template;
			if (!$noInit) $instance->_init();
		}
		return $instance;
	}

	public function _init() {
		global $modersEmails, $whoCanAnwser, $communityModersEmails, $YSmoderEmails;

		$this->log = VPA_logger::getInstance();
		$this->data['modersEmails'] = $modersEmails; // ��������� email'� �������
		$this->data['communityModersEmails'] = $communityModersEmails; // ��������� email'� ������� ���������
		$this->data['whoCanAnwser'] = $whoCanAnwser; // ��� ��� ����� �������� �� ������� ����������� �������������
		$this->data['YSmoderEmails'] = $YSmoderEmails;
		$this->plugins = VPA_tpl_plugins::getInstance($this->mod_dir);
	}

	/**
	 * ������������� �������
	 * string $domain - ����� ������, � ������� ����� ������� ��� ����� ������ (�� ���� - ������ ����� ����, ������� ��� ��������� ������������ �������������� ������)
	 * string $path - ���� ��� ����� ������ �� �������
	 * string $page - ��� ����� ������ ����� �������� ������ �������� save
	 * string $template - �������� ��� �������, �� ���� �������� ����� �������� ��������
	 * integer $lifetime - ����� ����� �������, � ������� �������� ��������������� �������� ����� ������� �� ����
	 */
	public function init($domain, $path, $page, $template, $lifetime = 1) {
		$this->domain = $domain;
		$this->path = $path;
		$this->page = $page;
		$this->template = $template;
		$this->lifetime = $lifetime;
	}

	/**
	 * ����������� ������ ������� init, ������������ � ��� ������, ���� �� �� ��������� ������������ ������������ ��� ��������� �������, � ������ ������ ��� ������������
	 */
	public function tpl($domain, $path, $template) {
		$this->domain = $domain;
		$this->path = $path;
		$this->template = $template;
		$this->lifetime = 0;
	}

	/* get tpl */
	public function get_tpl() {
		return array('domain' => $this->domain, 'path' => $this->path, 'template' => $this->template);
	}

	/**
	 * ����� ��� ��������� ������ ��� �������
	 * ������ ������ assign �� ������������� Smarty
	 */
	public function assign() {
		$arg_list = func_get_args();
		if (count($arg_list) > 0) {
			if (is_array($arg_list[0])) {
				foreach ($arg_list[0] as $name => $value) {
					$this->data[$name] = $value;
				}
			} elseif (count($arg_list) >= 2) {
				$this->data[$arg_list[0]] = $arg_list[1];
			}
		}
	}

	public function get_data($name) {
		return (isset($this->data[$name]) ? $this->data[$name] : null);
	}

	public function set_data($name, $value) {
		$this->data[$name] = $value;
	}

	public function reset_data() {
		unset($this->data);
	}

	/**
	 * ���������� ����������� �������� �� ������� �� ���� ���������� ����� set_data ������
	 */
	public function make($template = '') {	    
		$status = true;
		$start = $this->log->get_time();
		$p = &$this->plugins; // ����������� ������� � ������� � ���� �������� ���������� p
		$d = &$this->data; // ����������� ������ � ������� � ���� �������� ���������� d
		$handler = &$this->data['handler']; //new ����������
		$file = ($template == '' ? $this->template : $template);
		$pt = $fn = STATIC_TEMPLATES . $this->domain . $this->path;
		$fn = STATIC_TEMPLATES . $this->domain . $this->path . $file;

		$fs = STATIC_TEMPLATES . '/' . $file;
		$dir = $fn;
		$j = 0;
		$i = 0;
		do {
			if (file_exists($dir)) {
				ob_start();
				include ($dir);
				$this->result = ob_get_contents();
				ob_end_clean();
				$this->log->add_message(get_class($this), "������ �������� (" . $dir . ") ������ ������� (�������� ������: " . strlen($this->log->serialize($this->data)) . " ����)", $start, true);
				break;
			} else {
				$this->log->add_message(get_class($this), "������ �������� (" . $dir . ") �� ������ (���� �� ����������)", $start, false);
			}
			if ($i++ > 15) die('Runtime error #4!');
			$j++;
		} while (!file_exists($dir) && $dir != $fs && $j < 4 && ($dir = $this->_up_dir($dir, $file)));

		return $this->result;
	}

	/**
	 * ����� ��������� ������� ��� ������� �� ������� ���� �� �����������
	 */
	public function _up_dir($dir, $file) {
		$p1 = explode("/", $dir);
		unset($p1[count($p1)-1]);
		unset($p1[count($p1)-1]);
		return join($p1, '/') . '/' . $file;
	}

	/**
	 * ���� ����� ��� ������� ������ � ������ ��� ����
	 *
	 * @param string $file
	 * @param array $vars - ���������, ������� �� ����� �������� � ������
	 */
	public function _render($file, $vars = null) {
		$start = $this->log->get_time();
		$path = STATIC_TEMPLATES . $this->domain . $this->path;
		if (!empty($vars)) {
			$this->data = array_merge($this->data, $vars);
		}

		$this->make($file . '.php');
		echo $this->output();
		$this->log->add_message(get_class($this), 'Include (_render): ���� �� ����������', $start, true);
	}

	/**
	 * ���� ����� ��� ������� ������ � ������
	 *
	 * @string method - ��������� 2 ��������:
	 *    direct - ��������������� ���� ������������� � ������ ��������
	 *    ssi - ��������������� ���� ������������ ����� SSI
	 * @int lifetime - ����� ����� ������� � ��������
	 * @bool remake - ����� �� ���������������� ��� �� ������� (true - ���� �� ������� ��� ���, ������ ��� ��������� � ������� ����)
	 * @array vars - ���������, ������� �� ����� �������� � ������
	 * �������� ����� ����� � ���� ������� ���������� � ������������ �������� �� ����������� ����� (����� � ��� ����� !?!?!)
	 */
	public function _i ($file, $method, $lifetime = 0, $remake = false, $vars = null) {
		$status = true;
		$start = $this->log->get_time();
		$fn = WWW_DIR . $this->domain . $this->path . $file . '.shtml';
		$msg = '���� ���� �� ����';
		if (!empty($vars)) {
			$this->data = array_merge($this->data, $vars);
		}

		$fs = WWW_DIR . '/' . $file . '.shtml';
		$dir = $fn;
		$true_dir = '';
		$st = false;
		$i = 0;

		do {
			if (file_exists($dir)) {
				$st = true;
				$true_dir = $dir;
				break;
			}
			if ($i++ > 15) die('Runtime error #1!');
		} while (!$st && $dir != $fs && ($dir = $this->_up_dir($dir, $file . '.shtml')));
		if (!empty($true_dir)) $dir = $true_dir;
		// ��� �������� ����� �� ������� ������, ����� ������������� ��� ������ - ������� - ��� ����� �������� ��������� ���������, � ���������� ����� ����� ���� ��������.
		if ($remake) {
			if (!$st) {
				$this->make($file . '.php');
				if ($lifetime > 0) $this->save($file . '.shtml');
				$msg = '������ ����� ����';
			} else {
				clearstatcache();
				$time = filemtime($dir);
				if (time() > intval($time + $lifetime)) {
					$this->make($file . '.php');
					if ($lifetime > 0) $this->save($file . '.shtml');
					$msg = '���� �������� (��� �������: ' . $lifetime . ')';
				}
			}
		}

		if ($st || $remake) {
			// code 1: ��������� ��� ����������, ��� ����� ������������ ���� ���� - �� ���� ��� � ������� ���������� � ����
			$fs = WWW_DIR . '/' . $file . '.shtml';
			$dir = $fn;
			$true_dir = '';
			$st = false;
			$i = 0;
			do {
				if (file_exists($dir)) {
					$st = true;
					$true_dir = $dir;
					break;
				}
				if ($i++ > 15) die('Runtime error #2!');
			} while (!file_exists($dir) && $dir != $fs && ($dir = $this->_up_dir($dir, $file . '.shtml')));
			if (!empty($true_dir)) $dir = $true_dir;
			// code 1
			if ($method == 'direct' && $lifetime > 0) {
				echo file_get_contents($dir);
			} elseif ($method == 'direct' && $lifetime == 0) {
				echo $this->output();
			} else {
				$j = 0;
				$i = 0;
				$true_dir = false;
				$dir = $this->path . $file . '.shtml';
				do {
					if (file_exists(rtrim(WWW_DIR . $this->domain, "/") . $dir)) {
						$st = true;
						$true_dir = $dir;
						break;
					}
					if ($i++ > 15) die('Runtime error #3!');
					$j++;
				} while (!file_exists(rtrim(WWW_DIR . $this->domain, "/") . $dir) && $j < 3 && ($dir = $this->_up_dir($dir, $file . '.shtml')));
				if ($true_dir) {
					echo '<!--#include virtual="' . $true_dir . '" -->';
				} else {
					$this->log->add_message(get_class($this), "SSI include (" . rtrim(WWW_DIR . $this->domain, "/") . $dir . ") - ������, ����� �� �������!", $start, false);
				}
			}
			$this->log->add_message(get_class($this), "Include (" . $fn . "): " . $msg, $start, $status);
		} else {
			$this->log->add_message(get_class($this), "Include (" . $fn . "): ���� �� ����������, � ������������� ��� ���������", $start, false);
		}
	}

	/**
	 * ���� ����� ��������� �������� � ��������� ������
	 */
	public function _i_dyn ($file, $var = '') {
		$var = $var == '' ? '' : '?' . $var;
		$start = $this->log->get_time();
		$dir = $file . '.php';
		if (!file_exists(rtrim(WWW_DIR . $this->domain, "/") . '/' . $dir)) {
			$this->log->add_message(get_class($this), "SSI include (" . rtrim(WWW_DIR . $this->domain, "/") . '/' . $dir . ") - ������, ����� �� �������!", $start, false);
			return '';
		}
		echo '<!--#include virtual="/' . $dir . $var . '" -->';
		$this->log->add_message(get_class($this), "Include (" . $dir . "): �������� ������ �������", $start, true);
	}

	public function save($file = '') {
		$start = $this->log->get_time();
		$fn = WWW_DIR . $this->domain;
		if (!is_dir($fn)) {
			mkdir($fn);
		}
		$fn .= $this->path;
		if (!is_dir($fn)) {
			mkdir($fn);
		}
		$fn .= $file == '' ? $this->page : $file;
		$fd = fopen($fn, 'w');
		$id = "";
		$result = $this->result;
		fwrite($fd, $result);
		$status = fclose($fd);
		$this->log->add_message(get_class($this), "���� ���� " . $fn . " ��������: ������:" . $status, $start, $status);
	}

	public function output() {
		$start = $this->log->get_time();
		echo $this->result;
		$this->log->add_message(get_class($this), "������ ������� �� �����", $start, true);
	}

	public function preg_repl($txt) {
		$what1 = array("/(?<=\s|^)((http:\/\/|)(www\.|)(popcornnews\.ru.*?))(\s|$|<)/i", "/(?<=\s|^)((http:\/\/|)(www\.|)((\w{2,5}\.|)kinoafisha\.(spb\.ru|msk\.ru|info).*?))(\s|$|<)/i");
		$what2 = array('<a href="http://www.$4">$1</a>$5', '<a href="http://www.$4">$1</a>$7');
		return preg_replace($what1, $what2, $txt);
	}

	public function limit_text($txt, $limit = 500) {
		$txt = trim($txt);
		if (strlen($txt) > $limit) $txt = substr($txt, 0, strrpos(substr($txt, 0, $limit), " ")) . ' ...';
		return $txt;
	}

	public function for_us() {
		return self::isDeveloper();
	}

	/**
	 * Check is developer or not
	 *
	 * @staticvar array $developers
	 * @return bool
	 */
	static public function isDeveloper() {
		static $developers = array(
			'79.142.82.62',
			'93.185.185.49',
			'89.112.4.138',
			'77.88.4.182',
			'127.0.0.1',
			'77.88.3.127',
			'213.182.162.82',
		);
		// dev.popcornnews.ru || localhost
		if (DEVELOPMENT) return true;

		return in_array($_SERVER['REMOTE_ADDR'], $developers);
	}

	/**
	 * Is moder
	 *
	 * @return bool
	 */
	public function isModer() {
		if (!$this->data['cuser']['email'] || !$this->data['modersEmails']) return false;
		return in_array(strtolower($this->data['cuser']['email']), $this->data['modersEmails']);
	}

    public function checkModer($email) {
        if(!$this->data['modersEmails']) return true;
        return in_array(strtolower($email), $this->data['modersEmails']);
    }
	
	public function isModerYS() {
	    if (!$this->data['cuser']['email'] || !$this->data['YSmoderEmails']) return false;
	    return in_array(strtolower($this->data['cuser']['email']), $this->data['YSmoderEmails']) ? true : false;	     
	}

	/**
	 * Is community moder
	 *
	 * @return bool
	 */
	public function isCommunityModer() {
		if (!$this->data['cuser']['email'] || !$this->data['communityModersEmails']) return false;
		return in_array(strtolower($this->data['cuser']['email']), $this->data['communityModersEmails']) ? true : false;
	}

	/**
	 * Can anwser
	 *
	 * @return bool
	 */
	public function canAnwser() {
		if (!$this->data['cuser']['email'] || !$this->data['whoCanAnwser']) return false;
		return in_array(strtolower($this->data['cuser']['email']), $this->data['whoCanAnwser']) ? true : false;
	}

	/**
	 * Get WWW path to user avatar
	 *
	 * @param string $avatar
	 * @param bool $big
	 * @return string
	 */
	public function getUserAvatar($avatar, $big = false) {
		if ($big) {
			return empty($avatar) ? '/img/no_photo.jpg' : '/avatars/' . $avatar;
		} else {
			return empty($avatar) ? '/img/no_photo_small.jpg' : '/avatars_small/' . $avatar;
		}
	}

	/**
	 * Get WWW path to user photo
	 *
	 * @param string $photo
	 * @param bool $big
	 * @return string
	 */
	public function getUserPhoto($photo, $type = 'small') {
		if (!in_array($type, array('small', 'del', 'big', 'preview', 'small'))) {
			return false;
		}

		//$photo = str_replace('.', '_', $photo);

		switch ($type) {
			case 'del':		return empty($photo) ? '/img/no-photo-user.jpg' : '/user_photos/del/' . $photo;
			case 'big':		return empty($photo) ? '/img/no-photo-user.jpg' : '/user_photos/big/' . $photo;
			case 'preview':	return empty($photo) ? '/img/no-photo-user.jpg' : '/user_photos/preview/' . $photo;

			default:
			case 'small':	return empty($photo) ? '/img/no-photo-user.jpg' : '/user_photos/small/' . $photo;
		}
	}

	/**
	 * Get static path
	 *
	 * @param string $path
	 * @param bool $leadingSlash - add / at the begin of string, if string is not begins from /
	 * @return string
	 */
	public function getStaticPath($path = null, $leadingSlash = true) {
		$host = (!is_null($this->preferStaticHost) && isset(self::$staticHosts[$this->preferStaticHost]) ? self::$staticHosts[$this->preferStaticHost] : self::$staticHosts[0]);

		if (in_array(substr($path, 0, 26), self::$staticHosts)) return $path;
		if ($leadingSlash && ($path && $path[0] && $path[0] != '/')) $path = '/' . $path;

		if (DEVELOPMENT && (strpos($path, 'js/') || strpos($path, 'css/'))) {
			return $path;
		}
		if (getenv('IS_AZAT_SERVER') && strpos($path, 'yourstyle/')) {
			return $path;
		}

		return sprintf('%s%s', $host, $path);
	}
}
