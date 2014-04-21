<?=$this->_render('inc_header');?>
<div>
	<div class="paginator smaller">
		<h4>��������:</h4>
		<ul>
			<?foreach ($p['pager']->make($d['page'], $d['pages'], 10) as $i => $pi) { ?>
			<li>
				<?if (!isset($pi['current'])) {?>
				<a href="?type=yourstyle&action=tilesBrands&page=<?=$pi['link']?>"><?=$pi['text']?></a>
				<?} else {?>
				<?=$pi['text']?>
				<?}?>
			</li>
			<?}?>
		</ul>
	</div>
</div>

<table cellspacing="1" class="TableFiles">
	<tr>
		<td class="TFHeader">�����</td>
		<td class="TFHeader">��������</td>
	</tr>
	<?foreach ($d['brands'] as $brand) {?>
	<tr>
		<td><a href="?type=yourstyle&action=brandTiles&bid=<?=$brand['id']?>"><?=$brand['title']?></a></td>
		<td>
			<a href="?type=yourstyle&action=editTileBrand&bid=<?=$brand['id']?>">�������������</a><br />
			<a onclick="return confirm('�� ������������� ������ ����������?');" href="?type=yourstyle&action=deleteTileBrand&bid=<?=$brand['id']?>">�������</a>
		</td>
	</tr>
	<?}?>
</table>
<?=$this->_render('inc_footer');?>