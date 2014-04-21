<?=$this->_render('inc_header');?>
<div>
	<div class="paginator smaller">
		<h4>��������:</h4>
		<ul>
			<?foreach ($p['pager']->make($d['page'], $d['pages'], 10) as $i => $pi) { ?>
			<li>
				<?if (!isset($pi['current'])) {?>
				<a href="?type=yourstyle&action=groupsTiles&gid=<?=$d['gid']?>&page=<?=$pi['link']?>"><?=$pi['text']?></a>
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
		<td class="TFHeader">������</td>
		<td class="TFHeader">������������</td>
		<td class="TFHeader">��������</td>
	</tr>
	<?foreach ($d['tiles'] as $tile) {?>
	<tr>
		<td><a href="?type=yourstyle&action=brandTiles&bid=<?=$tile['bid']?>"><?=$tile['brand'] ?: '�� �����'?></a></td>
		<td><img src="<?=$p['ys']::getWwwUploadTilesPath($tile['gid'], $tile['image'], '100x100')?>" alt="" /></td>
		<td><a href="?type=yourstyle&action=groupsTilesByUser&uid=<?=$tile['uid']?>"><?=$tile['unick']?></a></td>
		
		<td>
			<a href="?type=yourstyle&action=editGroupsTile&tid=<?=$tile['id']?>">�������������</a><br />
			<a onclick="return confirm('�� ������������� ������ ����������?');" href="?type=yourstyle&action=deleteGroupsTile&tid=<?=$tile['id']?>">�������</a><br />
			<a href="?type=yourstyle&action=duplicateGroupsTile&tid=<?=$tile['id']?>">�����������</a><br /> ������������ �������� ���� ���
			<a href="?type=yourstyle&action=setDefaultGroupTile&tid=<?=$tile['id']?>&gid=<?=$tile['gid'];?>">���������</a> | 
			<a href="?type=yourstyle&action=setDefaultRootGroupTile&tid=<?=$tile['id']?>&gid=<?=$tile['gid'];?>">������</a>
		</td>
	</tr>
	<?}?>
</table>
<?=$this->_render('inc_footer');?>