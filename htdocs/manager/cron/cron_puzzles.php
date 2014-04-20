<?php

/**
 * @author Azat Khuzhin
 *
 * ������ ����� � ��������� � ��������� �� � ����
 */

require_once dirname(__FILE__) . '/functions.php';
require_once dirname(__FILE__) . '/../inc/connect.php';
require_once dirname(__FILE__) . '/../../data/libs/config.lib.php';

// ����� ��� user.lib.php
$_SERVER['DOCUMENT_ROOT'] = WWW_DIR;
$_SERVER['REQUEST_URI'] = '/';
$_SERVER['HTTP_HOST'] = 'popcornnews.ru';

require_once UI_DIR  . 'user.lib.php';
require_once LIB_DIR . 'vpa_popcornnews.lib.php';
define('PATH_CACHE', '/var/www/sites/popcornnews.ru/htdocs/upload/');
define('KINO_PATH_CACHE', 'http://www.kinoafisha.msk.ru/upload/');
define('KINO_GOODS', 'kinoafisha_v2_goods_');

error_reporting(E_ALL);
ini_set('display_errors', 'On');

/**
 * @param string $src_name - ��� ����� ������� ���� �����������
 * @return mixed
 * string - ��� ������ �����, ���� ������,
 * ����� false
 */
function kino_copy($src_name) {
	// ���������, ���� ���� ����������, �� ������ ��������
	$dst_name = $src_name;
	// ����������
	$src_ext = preg_split('/\./Uis', $src_name);
	$src_ext = '.' . strtolower($src_ext[count($src_ext)-1]);
	
	if (file_exists(PATH_CACHE . $dst_name)) {
		while (file_exists(PATH_CACHE . $dst_name)) {
			$dst_name = rand_str() . $src_ext;
		}
	}
	// ��������
	if (copy(KINO_PATH_CACHE . $src_name, PATH_CACHE . $dst_name)) {
		return $dst_name;
	}

	return false;

}

/*
 * ����
 */
$main = new user_base_api();
/*
 * ��������� ����������
 */
$tpl = $main->tpl;
/**
 * ������� � ���������
 */
$link_kino = mysql_connect('217.112.36.238:3308', 'sky', 'uGrs7u8rN');
if (!$link_kino) {
	cat('Can`t connect to kinoafisha (' . mysql_error() . ')' . "\n");
	die;
}
mysql_query('use kinoafisha', $link_kino);

// ������� ������ �������
$persons = new VPA_table_persons_tiny_ajax;
$persons->get($persons_list, null, null, null);
$persons_list->get($persons_list);
foreach ($persons_list as $person) {
	$puzzles_kino = mysql_query('SELECT id, name, pole1 small, pole2 big FROM ' . KINO_GOODS . ' WHERE (goods_id = 122 AND page_id = 2 AND pole16 = "") AND pole15 LIKE "%' . $person['name'] . '%"', $link_kino);
	if (mysql_num_rows($puzzles_kino) > 0) {
		while ($puzzle = mysql_fetch_assoc($puzzles_kino)) {
			// �������� ������� ��������
			$big = kino_copy($puzzle['big']);
			// �������� ��������� ��������
			$small = ($puzzle['small'] ? kino_copy($puzzle['small']) : null);

			if ($big || $small) {
				// ������� � ���� ��������
				$query = sprintf(
					'INSERT INTO %s SET name = "%s", pole1 = "%s", pole2 = "%s", pole3 = "%s", page_id = 2, goods_id = 8',
					$tbl_goods_, $person['name'], $big, $small, $person['id']
				);
				// �������� ���� �� ��������� ��� ����� ���� ����
				$query_kino = sprintf('UPDATE %s SET pole16 = "Yes" WHERE id = %d', KINO_GOODS, $puzzle['id']);
				if (mysql_query($query, $link) && mysql_query($query_kino, $link_kino)) {
					cat(
						sprintf(
							'�������� ���� c id = %d, �������: %s',
							$puzzle['id'], $person['name']
						)
					);
					// ������
					continue;
				}
			}
			// ������
			cat(
				sprintf(
					'������ ��� ���������� ����� c id = %d, �������: %s (%s, %s)',
					$puzzle['id'], $person['name'], mysql_error($link), mysql_error($link_kino)
				)
			);
		}
	}
}
cat('�������� ������ ���������');
?>