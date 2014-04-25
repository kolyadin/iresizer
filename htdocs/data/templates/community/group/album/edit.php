<?$this->_render('inc_header', array('title' => '����� ������', 'header' => '�������� ������', 'top_code' => 'C', 'header_small' => $d['album']['title']));?>
<div id="contentWrapper" class="twoCols">
	<div id="content">
		<ul class="menu">
			<li><a href="/community/group/<?=$d['group']['id']?>">������</a></li>
			<li><a href="/community/group/<?=$d['group']['id']?>/topics">����������</a></li>
			<li class="active"><a href="/community/group/<?=$d['group']['id']?>/albums">����</a></li>
			<li><a href="/community/group/<?=$d['group']['id']?>/members">���������</a></li>
			<li><a href="/community/group/<?=$d['group']['id']?>/newsfeed">����������</a></li>
		</ul>
		<?if (isset($d['error'])) {?><h4><?=$d['error']?></h4><?}?>
		
		<div class="communityEditAlbum">
			<form action="" method="POST" class="answer">
				<input type="hidden" name="type" value="community">
				<input type="text" name="title" value="<?=$d['album']['title']?>" />

				<input type="submit" value="���������" />
			</form>
		</div>
	</div>
	<?$this->_render('inc_right_column');?>
</div>
<?$this->_render('inc_footer');?>