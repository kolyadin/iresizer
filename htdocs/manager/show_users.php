<?

include "inc/connect.php";
//include "../func.php";
 

//$REQUEST=clean_request($_SERVER["REDIRECT_URL"]);
//$URL=explode("/",$REQUEST);
//$url=$URL;

// �����
$text=""; // ����� � � ������ �����
$maket="title.php"; // ����� �� ��������� 
$roothead=""; // ��������� ����
$title="�������news";
$clouds=""; // ������ ������
$clouds2="";
$right_arch=""; // ���� �� �������� �� ����� ��������


ob_start();
require_once('templates/show_users.php');
$text.=ob_get_clean ();
echo $text;
?>