<?=$this->_render('inc_header');?>
<table cellspacing="1" class="TableFiles">
	<tr>
		<td class="TFHeader">��������</td>
		<td class="TFHeader">������</td>
		<td class="TFHeader">��������</td>
	</tr>
	<?foreach ($d['sets'] as $set) {?>
	<tr>
		<td><?=$set['title']?></td>
		<td><img src="<?=$p['ys']::getWwwUploadSetPath($set['id'], $set['image'], '100x100')?>" alt="" /></td>
		<td>
			<a onclick="return confirm('�� ������������� ������ ����������?');" href="?type=yourstyle&action=deleteSet&sid=<?=$set['id']?>">�������</a>
		</td>
	</tr>
	<?}?>
</table>
<?=$this->_render('inc_footer');?>