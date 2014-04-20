<?
$img = (empty($d['cuser']['avatara']) ? '/img/no_photo.jpg' : '/avatars/' . $d['cuser']['avatara']);
$this->_render('inc_header', array(
	    'title'=>'���������� � '.$d['person']['name'],
		'meta' => array(
			'description' => sprintf('���������� %s - ���� �������� ���� � %s ���������� ��� ����������� ����� Popcornnews.ru', $d['person']['name'], $d['person']['eng_name']),
			'keywords' => sprintf('����������, ����, %s, %s', $d['person']['name'], $d['person']['eng_name']),
		),
		'header' => $d['person']['name'] . '<br /><span>'.$d['person']['eng_name'].'</span>',
		'top_code' => ($d['person']['main_photo'] ? '<img src="' . $this->getStaticPath('/upload/_100_100_80_' . $d['person']['main_photo']) . '" alt="' . $d['person']['name'] . '" class="avaProfile">' : null), 
		'header_small'=>'',
		'header_class' => 'topPersonHeader',
));
?>
<div id="contentWrapper" class="twoCols">
	<div id="content">
		<ul class="menu">
			<li><a href="/persons/<?=$handler->Name2URL($d['person']['eng_name']);?>">�������</a></li>
			<li><a href="/persons/<?=$handler->Name2URL($d['person']['eng_name']);?>/news">�������</a></li>
			<?if ($p['query']->get_num('kino_films', array('person'=>$d['person']['id'])) > 0) {?>
			<li><a href="/persons/<?=$handler->Name2URL($d['person']['eng_name']);?>/kino">������������</a></li>
			<?}?>
			<li class="active"><a href="/persons/<?=$handler->Name2URL($d['person']['eng_name']);?>/photo">����</a></li>
			<li><a href="/persons/<?=$handler->Name2URL($d['person']['eng_name']);?>/fans">����������</a></li>
			<?if ($p['query']->get_num('puzzles', array('person'=>$d['person']['id'])) > 0) {?>
			<li><a href="/persons/<?=$handler->Name2URL($d['person']['eng_name']);?>/puzli">�����</a></li>
			<?}?>
			<?if ($p['query']->get_num('person_wallpapers', array('id'=>$d['person']['id'], 'name'=>$d['person']['name'])) > 0) {?>
			<li><a href="/persons/<?=$handler->Name2URL($d['person']['eng_name']);?>/oboi">����</a></li>
			<?}?>
			<li><a href="/persons/<?=$handler->Name2URL($d['person']['eng_name']);?>/fanfics">�������</a></li>
			<li><a href="/persons/<?=$handler->Name2URL($d['person']['eng_name']);?>/facts">�����</a></li>
			<li><a href="/persons/<?=$handler->Name2URL($d['person']['eng_name']);?>/talks">����������</a></li>
			<?if ($p['query']->get_num('video', array('pole1'=>$d['person']['id'], 'pole11'=>'1')) > 0) {?>
			<li><a href="/persons/<?=$handler->Name2URL($d['person']['eng_name']);?>/video">�����</a></li>
			<?}?>
			<?if ($p['query']->get_num('yourstyle_sets_tags', array('tid'=>$d['person']['id'])) > 0) {?>
			<li><a href="/persons/<?=$handler->Name2URL($d['person']['eng_name']);?>/sets">����</a></li>
			<? } ?>
		</ul>
		<h2>���������� <?=$d['person']['genitive']?></h2>
		<div class="gallery undecorated">
			<div class="largeContainer">
				<div class="scrollLeft imageLeftScroller"></div>
				<div class="scrollRight imageRightScroller"></div>
				<div class="imgContainer"></div>
			</div>
			<div class="previewsWrapper">
				<div class="scrollLeft listLeftScroller"></div>
				<div class="previewsContainer">
					<ul></ul>
				</div>
				<div class="scrollRight listRightScroller"></div>
			</div>
		</div>

		<div class="sendPhoto">
			<a href="/persons/<?=$handler->Name2URL($d['person']['eng_name']);?>/photo/add">�������� ����</a>
			<strong>���� ��� ����������? ��������!</strong>
		</div>
	</div>
	<?$this->_render('inc_right_column');?>
</div>
<?$this->_render('inc_footer');?>
