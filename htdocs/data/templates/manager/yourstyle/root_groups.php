<?=$this->_render('inc_header');?>
<table cellspacing="1" class="TableFiles">
	<tr>
		<td class="TFHeader">��������</td>
		<td class="TFHeader">��������</td>
	</tr>
	<?foreach ($d['rootGroups'] as $rootGroup) {?>
	<tr>
		<td><a href="?type=yourstyle&action=rootGroup&rgid=<?=$rootGroup['id']?>"><?=$rootGroup['title']?></a></td>
		<td>
			<a href="?type=yourstyle&action=editRootGroup&rgid=<?=$rootGroup['id']?>">�������������</a><br />
			<a onclick="return confirm('�� ������������� ������ ����������?');" href="?type=yourstyle&action=deleteRootGroup&rgid=<?=$rootGroup['id']?>">�������</a>
		</td>
	</tr>
	<?}?>
</table>
<?=$this->_render('inc_footer');?>