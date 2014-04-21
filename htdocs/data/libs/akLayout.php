<?php

/**
 * @author Azat Khuzhin
 *
 * Layout transfer for search engine
 */

class akLayout {
	/**
	 * Layout
	 *
	 * @var array
	 */
	protected static $_layout = array(
		// lowercase
		'�' => 'q',
		'�' => 'w',
		'�' => 'e',
		'�' => 'r',
		'�' => 't',
		'�' => 'y',
		'�' => 'u',
		'�' => 'i',
		'�' => 'o',
		'�' => 'p',
		'�' => '[',
		'�' => ']',
		'�' => 'a',
		'�' => 's',
		'�' => 'd',
		'�' => 'f',
		'�' => 'g',
		'�' => 'h',
		'�' => 'j',
		'�' => 'k',
		'�' => 'l',
		'�' => ';',
		'�' => '\'',
		'�' => 'z',
		'�' => 'x',
		'�' => 'c',
		'�' => 'v',
		'�' => 'b',
		'�' => 'n',
		'�' => 'm',
		'�' => ',',
		'�' => '.',
		// uppercase
		'�' => 'Q',
		'�' => 'W',
		'�' => 'E',
		'�' => 'R',
		'�' => 'T',
		'�' => 'Y',
		'�' => 'U',
		'�' => 'I',
		'�' => 'O',
		'�' => 'P',
		'�' => '{',
		'�' => '}',
		'�' => 'A',
		'�' => 'S',
		'�' => 'D',
		'�' => 'F',
		'�' => 'G',
		'�' => 'H',
		'�' => 'J',
		'�' => 'K',
		'�' => 'L',
		'�' => ':',
		'�' => '"',
		'�' => 'Z',
		'�' => 'X',
		'�' => 'C',
		'�' => 'V',
		'�' => 'B',
		'�' => 'N',
		'�' => 'M',
		'�' => '<',
		'�' => '>',
	);


	/**
	 * Transfer
	 */
	public function transfer($text) {
		static $ru, $en, $forRuLayout, $forEnLayout;

		if (!$ru) {
			$ru = join('', array_keys(self::$_layout));
			$en = join('', array_values(self::$_layout));

			$forRuLayout = self::$_layout;
			$forEnLayout = array_flip(self::$_layout);
		}

		return (preg_match(sprintf('@[%s]@s', preg_quote($ru)), $text) ? strtr($text, $forRuLayout) : strtr($text, $forEnLayout));
	}
}
