<?

//������� ��� �������� .. ����� � ���������� ;-)

$url=$HTTP_SERVER_VARS['QUERY_STRING'];

$url=str_replace("url=","",$url);

header("location: $url");
//print "=$url=";

//print $HTTP_SERVER_VARS['QUERY_STRING'];

exit(1);

?>