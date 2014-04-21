<?php
/**
 * Date plugin
 */

class vpa_tpl_date {
	public $months;
	public $nominative;

	public function vpa_tpl_date() {
		$this->months = array(
			1 => '������',
			2 => '�������',
			3 => '�����',
			4 => '������',
			5 => '���',
			6 => '����',
			7 => '����',
			8 => '�������',
			9 => '��������',
			10 => '�������',
			11 => '������',
			12 => '�������',
		);

		$this->nominative = array(
			1 => '������',
			2 => '�������',
			3 => '����',
			4 => '������',
			5 => '���',
			6 => '����',
			7 => '����',
			8 => '������',
			9 => '��������',
			10 => '�������',
			11 => '������',
			12 => '�������',
		);
	}

	public function _parse($time, $format) {
		// ��� �� ��������� ����������� ������ �������������� ���, ��� � ���� �� ������� date
		// ����������� ������ �� ���, � ������ ��, ��� ����.
		// ������������ ������ ��������������, ����� ����� ���� ������� �������� ������ � ��� ������ � ������������� �� �������� ������ �� �������.
		// ����� ���������� ���� ������������, ������ ����� - �������������� ���� :)
		$date = $format;
		$date = str_replace("%Y", date('Y', $time), $date);
		$date = str_replace("%m", date('m', $time), $date);
		$date = str_replace("%F", $this->months[intval(date('m', $time))], $date);
		$date = str_replace("%N", $this->nominative[intval(date('m', $time))], $date);
		$date = str_replace("%d", date('d', $time), $date);
		$date = str_replace("%j", date('j', $time), $date);
		$date = str_replace("%H", date('H', $time), $date);
		$date = str_replace("%i", date('i', $time), $date);		
		return $date;
	}

	/**
	 * ������ ���� ��. � ���� �� PHP ��� ������� date
	 */
	public function parse($date, $format) {
		preg_match_all("|(\d{4})(\d{2})(\d{2})|is", $date, $out);
		$time = mktime(0, 0, 0, (isset($out[2][0]) ? $out[2][0] : null), (isset($out[3][0]) ? $out[3][0] : null), (isset($out[1][0]) ? $out[1][0] : null));
		return $this->_parse($time, $format);
	}

	public function dmyhi($date, $format) {
		preg_match_all("|(\d{2})-(\d{2})-(\d{4})\s+(\d{2}):(\d{2})|is", $date, $outs);
		$time = mktime($outs[4][0], $outs[5][0], 0, $outs[2][0], $outs[1][0], $outs[3][0]);
		return $this->_parse($time, $format);
	}

	public function unixtime($date, $format) {
		return $this->_parse($date, $format);
	}
}

?>