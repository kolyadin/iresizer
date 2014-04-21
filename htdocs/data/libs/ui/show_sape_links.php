<?php
/**
 * @author Azat Khuzhin
 *
 * ����� ��� ����������� ������ ��� ������� sape
 */

class show_sape_links {
	/*
	 * ������� �� ��������, �� ��� �������� ������
	 */
	public $table = 'sape_links';
	/*
	 * ������� ���������� ������ �� ������ ��������
	 */
	public $first_page_links = 500;
	/*
	 * ������� ���������� ������ �� ��������� ���������
	 */
	public $others_page_links = 150;
	/*
	 * �������� ������
	 */
	public $host = '';
	/*
	 * ��������� ���������
	 */
	public $last_result = array();
	/*
	 * ���-�� ������� � ������� � ��������
	 */
	public $num = 0;

	public function show_sape_links () {
		$this->host = $_SERVER['HTTP_HOST'];
	}

	public function show () {
		if (empty($this->last_result)) return false;

		$links = '';
		foreach ($this->last_result as $value)  {
			$links .= sprintf('<a href="http://%s/%s">.</a>', $this->host, $value);
		}
		return $links;
	}

	/**
	 * @global resource $link
	 * @param boolean $main - ������� �������� ��� ���, �� ��������� - �������
	 * @param int $first - � ������ id (���� �� ������� ��������)
	 * @param int $last - �� ����� id (���� �� ������� ��������)
	 * @return array
	 */
	public function get($main = true, $first = null, $last = null) {
		if (!$main && (is_null($first) || is_null($last))) return false;

		if ($main == true) {
			$query = sprintf('SELECT url FROM %s ORDER BY id ASC LIMIT 0, %d', $this->table, $this->first_page_links);
		} else {
			$query = sprintf('SELECT url FROM %s WHERE (id >= %d AND id < %d) AND (id >= %d) LIMIT 0, %d', $this->table, $first, $last, $this->first_page_links, $this->others_page_links);
		}
		$result = mysql_query($query);
		while ($data = mysql_fetch_assoc($result)) {
			$this->last_result[] = $data['url'];
		}

		return $this->last_result;
	}

	public function num() {
		$query = sprintf('SELECT COUNT(*) FROM %s', $this->table);
		$result = mysql_query($query);
		$this->num = mysql_fetch_row($result);
		$this->num = $this->num[0];
		return $this->num;
	}
}
?>