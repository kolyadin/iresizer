<?
include "inc/connect.php";
include 'inc/functions.php';

// �����
$text=""; // ����� � � ������ �����
$maket="title.php"; // ����� �� ��������� 
$roothead=""; // ��������� ����
$title="�������news";
$clouds=""; // ������ ������
$clouds2="";
$right_arch=""; // ���� �� �������� �� ����� ��������

ob_start();
require_once('templates/already_moder_images.php');
$text.=ob_get_clean();
echo $text;
?>