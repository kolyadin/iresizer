<?

/**
 * ����� ��������
 */

/**
 * # RUS
 */

/**
 * @author runcore
 * @link http://habrahabr.ru/blogs/php/53210/
 */
function ru_num2str($inn) {
	if (!function_exists('morph')) {
		/**
		 * �������� ����������
		 */
		public function morph($n, $f1, $f2, $f5) {
			$n = abs($n) % 100;
			$n1 = $n % 10;
			if ($n > 10 && $n < 20)
				return $f5;
			if ($n1 > 1 && $n1 < 5)
				return $f2;
			if ($n1 == 1)
				return $f1;
			return $f5;
		}

	}

	$nol = '����';
	$str[100] = array('', '���', '������', '������', '���������', '�������', '��������', '�������', '���������', '���������');
	$str[11] = array('', '������', '�����������', '����������', '����������', '������������', '����������', '�����������', '����������', '������������', '������������', '��������');
	$str[10] = array('', '������', '��������', '��������', '�����', '���������', '����������', '���������', '�����������', '���������');
	$sex = array(
		array('', '����', '���', '���', '������', '����', '�����', '����', '������', '������'), // m
		array('', '����', '���', '���', '������', '����', '�����', '����', '������', '������') // f
	);
	$forms = array(
		array('', '', '', 1), // array('�������',  '�������',   '������',     1), // 10^-2
		array('', '', '', 0), // array('�����',    '�����',     '������',     0), // 10^ 0
		array('������', '������', '�����', 1), // 10^ 3
		array('�������', '��������', '���������', 0), // 10^ 6
		array('��������', '���������', '����������', 0), // 10^ 9
		array('��������', '���������', '����������', 0), // 10^12
	);
	$out = $tmp = array();
	// �������!
	$tmp = explode('.', str_replace(',', '.', $inn));
	$rub = number_format($tmp[0], 0, '', '-');
	if ($rub == 0)
		$out[] = $nol;
	// ������������ ������
	$kop = isset($tmp[1]) ? substr(str_pad($tmp[1], 2, '0', STR_PAD_RIGHT), 0, 2) : '00';
	$segments = explode('-', $rub);
	$offset = sizeof($segments);
	if ((int) $rub == 0) { // ���� 0 ������
		$o[] = $nol;
		$o[] = morph(0, $forms[1][0], $forms[1][1], $forms[1][2]);
	} else {
		foreach ($segments as $k => $lev) {
			$sexi = (int) $forms[$offset][3]; // ���������� ���
			$ri = (int) $lev; // ������� �������
			if ($ri == 0 && $offset > 1) {// ���� �������==0 & �� ��������� �������(��� Units)
				$offset--;
				continue;
			}
			// ������������
			$ri = str_pad($ri, 3, '0', STR_PAD_LEFT);
			// �������� ������� ��� �������
			$r1 = (int) substr($ri, 0, 1); //������ �����
			$r2 = (int) substr($ri, 1, 1); //������
			$r3 = (int) substr($ri, 2, 1); //������
			$r22 = (int) $r2 . $r3; //������ � ������
			// ���������� �������
			if ($ri > 99) $o[] = $str[100][$r1]; // �����
			if ($r22 > 20) {// >20
				$o[] = $str[10][$r2];
				$o[] = $sex[$sexi][$r3];
			} else { // <=20
				if ($r22 > 9) $o[] = $str[11][$r22 - 9]; // 10-20
				elseif ($r22 > 0) $o[] = $sex[$sexi][$r3]; // 1-9

			}
			// �����
			$o[] = morph($ri, $forms[$offset][0], $forms[$offset][1], $forms[$offset][2]);
			$offset--;
		}
	}
	return trim(preg_replace("/\s{2,}/", ' ', implode(' ', $o)));
}

/**
 * # ENG
 */


/**
 * @link http://www.phpro.org/examples/Convert-Numbers-to-Words.html
 */
function en_num2str($number) {
	if (($number < 0) || ($number > 999999999)) {
		return false;
	}

	$Gn = floor($number / 1000000);  /* Millions (giga) */
	$number -= $Gn * 1000000;
	$kn = floor($number / 1000);     /* Thousands (kilo) */
	$number -= $kn * 1000;
	$Hn = floor($number / 100);	/* Hundreds (hecto) */
	$number -= $Hn * 100;
	$Dn = floor($number / 10);	 /* Tens (deca) */
	$n = $number % 10;		   /* Ones */

	$res = "";

	if ($Gn) {
		$res .= en_num2str($Gn) . " million";
	}

	if ($kn) {
		$res .= ( empty($res) ? "" : " ") .
			en_num2str($kn) . " thousand";
	}

	if ($Hn) {
		$res .= ( empty($res) ? "" : " ") .
			en_num2str($Hn) . " hundred";
	}

	static $ones = array("", "one", "two", "three", "four", "five", "six",
		"seven", "eight", "nine", "Ten", "eleven", "twelve", "thirteen",
		"fourteen", "fifteen", "sixteen", "seventeen", "eightteen",
		"nineteen");
	static $tens = array("", "", "twenty", "thirty", "fourty", "fifty", "sixty",
		"seventy", "eigthy", "ninety");

	if ($Dn || $n) {
		if (!empty($res)) {
			$res .= " and ";
		}

		if ($Dn < 2) {
			$res .= $ones[$Dn * 10 + $n];
		} else {
			$res .= $tens[$Dn];

			if ($n) {
				$res .= "-" . $ones[$n];
			}
		}
	}

	if (empty($res)) {
		$res = "zero";
	}

	return $res;
}
