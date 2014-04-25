<?$this->_render('inc_header', array('title' => '������ ' . htmlspecialchars($d['album']['title']), 'header' => '������', 'top_code' => 'C', 'header_small' => $d['album']['title']));?>
<div id="contentWrapper" class="twoCols">
	<div id="content">
		<ul class="menu">
			<li><a href="/community/group/<?=$d['group']['id']?>">������</a></li>
			<li><a href="/community/group/<?=$d['group']['id']?>/topics">����������</a></li>
			<li class="active"><a href="/community/group/<?=$d['group']['id']?>/albums">����</a></li>
			<li><a href="/community/group/<?=$d['group']['id']?>/members">���������</a></li>
			<li><a href="/community/group/<?=$d['group']['id']?>/newsfeed">����������</a></li>
		</ul>
		<ul class="menu bLevel">
			<li><a href="/community/group/<?=$d['group']['id']?>/album/<?=$d['album']['id']?>">��� ����</a></li>
			<li><a href="/community/group/<?=$d['group']['id']?>/album/<?=$d['album']['id']?>/addPhotos">��������� ����</a></li>
			<li class="active"><a href="/community/group/<?=$d['group']['id']?>/album/<?=$d['album']['id']?>/deletePhotos">������� ����</a></li>
		</ul>
		
		<?if (isset($d['error'])) {?><h4><?=$d['error']?></h4><?}?>
		<div class="communityDeleteAlbumPhoto">
		<?if (count($d['photos']) > 0) {?>
		<form method="POST" action="">
			<input type="hidden" name="type" value="community">
			<div class="groupsContainer equalsContainer gonnaExit undecorated">
				<?foreach ($d['photos'] as $i => $photo) {?>
				<dl>
					<dt><input type="checkbox" name="p[<?=$photo['id']?>]"/><img alt="" src="<?=$this->getStaticPath(Community::getWWWAlbumPhotoPath($photo['aid'], $photo['image'], '80x100a'))?>" /></dt>
				</dl>
				<?if (($i + 1) % 6 == 0) {?><div class="divider"></div><?}?>
				<?}?>
			</div>
			<a href="#" onclick="as.parent(this, 'form').submit(); return false;" class="saveButton">���������</a>
		</form>
		<?}?>
		</div>
	</div>
	<?$this->_render('inc_right_column');?>
</div>
<?$this->_render('inc_footer');?>