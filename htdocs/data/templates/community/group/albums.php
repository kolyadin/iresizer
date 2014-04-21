<?$this->_render('inc_header', array('title' => '������� ������ - ' . htmlspecialchars($d['group']['title']), 'header' => '������� ������', 'top_code' => 'C', 'header_small' => $d['group']['title']));?>
<div id="contentWrapper" class="twoCols">
	<div id="content">
		<ul class="menu">
			<li><a href="/community/group/<?=$d['group']['id']?>">������</a></li>
			<li><a href="/community/group/<?=$d['group']['id']?>/topics">����������</a></li>
			<li class="active"><a href="/community/group/<?=$d['group']['id']?>/albums">����</a></li>
			<li><a href="/community/group/<?=$d['group']['id']?>/members">���������</a></li>
			<li><a href="/community/group/<?=$d['group']['id']?>/newsfeed">����������</a></li>
		</ul>
		
		<?if ($d['albumsNum'] > 0) {?>
		<div class="group_photo">
			<ul>
				<?foreach ($d['albums'] as $album) {?>
					<li>
						<a href="/community/group/<?=$d['group']['id']?>/album/<?=$album['id']?>#img<?=$album['lastPhoto']['id']?>">
							<img alt="" src="<?=$this->getStaticPath(Community::getWWWAlbumPhotoPath($album['lastPhoto']['aid'], $album['lastPhoto']['image']))?>" />
							<?=$album['title']?>
							<?if ($d['canModifyGroup']) {?>
							<a href="/community/group/<?=$d['group']['id']?>/album/<?=$album['id']?>/delete" title="�������">�������</a>
							<a href="/community/group/<?=$d['group']['id']?>/album/<?=$album['id']?>/edit">��������</a>
							<?}?>
						</a>
						<?=$album['photos']?> ����
					</li>
				<?}?>
			</ul>
		</div>
		
		<div class="paginator smaller">
			<p class="pages">��������:</p>
			<ul>
				<?foreach ($p['pager']->make($d['page'], $d['pages']) as $i => $pi) { ?>
				<li>
					<?if (!isset($pi['current'])) {?>
					<a href="/community/group/<?=$d['group']['id']?>/albums/page/<?=$pi['link']?>"><?=$pi['text']?></a>
					<?} else {?>
					<?=$pi['text']?>
					<?}?>
				</li>
				<?}?>
			</ul>
		</div>
		<?} else {?>
		<h4>� ���� ������ ��� ��� �� ������ �������</h4>
		<?}?>
		
		<?if ($d['canModifyGroup']) {?>
		<h4><a href="/community/group/<?=$d['group']['id']?>/album/add">����� ������</a></h4>
		<?}?>
	</div>
	<?$this->_render('inc_right_column');?>
</div>
<?$this->_render('inc_footer');?>