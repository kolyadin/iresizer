<a href="?section=main">�������� ���</a><br />
<a href="?section=twiligth">�������� ��� ��� ���� �������</a><br />
<a href="?section=potter">�������� ��� ��� ���� ���� ������</a><br />
<a href="?section=sex">�������� ��� ��� ���� ���� � �������</a><br />
<?
die('�� �����!');
if (isset($_GET['section'])){
   switch ($_GET['section']){
	 case 'main':
	   $status = unlink($_SERVER['DOCUMENT_ROOT'].'/data/var/gen/right.tmp');
	   break;
	 case 'twiligth';
	   $status = unlink($_SERVER['DOCUMENT_ROOT'].'/data/var/gen/right_twilight.tmp');
	   break;
	 case 'potter';
	   $status = unlink($_SERVER['DOCUMENT_ROOT'].'/data/var/gen/right_potter.tmp');
	   break;
	 case 'sex';
	   $status = unlink($_SERVER['DOCUMENT_ROOT'].'/data/var/gen/right_sex.tmp');
	   break;
   }

   if ($status) echo '��� ��� ���������� ������� ������!';
   else echo '������ ��� �������� ���� � ������ �������!';
}
/*
<form action="/" method="post" target="ifr">
<input type="hidden" name="reloadcache" value="1" />
<input type="submit" value="�������� ��� ��� �������" />
</form>
<script>
var ale=false;
</script>
<iframe id="irf" name="ifr" onload="ale=!ale;if(!ale)alert('��� ��� ������� �������');"></iframe>
*/
?>