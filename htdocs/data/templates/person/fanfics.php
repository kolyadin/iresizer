<? 
if(count($d['fanfics_data']) == 0) {
    header('Location: /persons/'.$handler->Name2URL($d['person']['eng_name']).'/fanfics/add');
}

$additional = ($d['page'] > 1) ? " - ����������� (���.{$d['page']})" : '';

$this->_render('inc_header', array(
		'title'=>'������� - ' . $d['person']['name'].$additional, 
		'meta' => array(
			'description' => sprintf('������� (���������� �����������) %s - ������������ ������������ ����� %s, ���-��� �� ����� Popcornnews.ru'.$additional, $d['person']['name'], $d['person']['eng_name']),
			'keywords' => sprintf('�������, ���-���, ����������, %s, %s', $d['person']['name'], $d['person']['eng_name']),
		),
		'header' => $d['person']['name'] . '<br /><span>'.$d['person']['eng_name'].'</span>',
		'top_code' => ($d['person']['main_photo'] ? '<img src="' . $this->getStaticPath('/upload/_100_100_80_' . $d['person']['main_photo']) . '" alt="' . $d['person']['name'] . '" class="avaProfile">' : null), 
		'header_small'=>'',
		'header_class' => 'topPersonHeader'
));?>
<div id="contentWrapper" class="twoCols">
	<div id="content">
		<ul class="menu">
			<li><a href="/persons/<?=$handler->Name2URL($d['person']['eng_name']);?>">�������</a></li>
			<li><a href="/persons/<?=$handler->Name2URL($d['person']['eng_name']);?>/news">�������</a></li>
			<?if ($p['query']->get_num('kino_films', array('person'=>$d['person']['id'])) > 0) {?>
			<li><a href="/persons/<?=$handler->Name2URL($d['person']['eng_name']);?>/kino">������������</a></li>
			<?}?>
			<li><a href="/persons/<?=$handler->Name2URL($d['person']['eng_name']);?>/photo">����</a></li>
			<li><a href="/persons/<?=$handler->Name2URL($d['person']['eng_name']);?>/fans">����������</a></li>
			<?if ($p['query']->get_num('puzzles', array('person'=>$d['person']['id'])) > 0) {?>
			<li><a href="/persons/<?=$handler->Name2URL($d['person']['eng_name']);?>/puzli">�����</a></li>
			<?}?>
			<?if ($p['query']->get_num('person_wallpapers', array('id'=>$d['person']['id'], 'name'=>$d['person']['name'])) > 0) {?>
			<li><a href="/persons/<?=$handler->Name2URL($d['person']['eng_name']);?>/oboi">����</a></li>
			<?}?>
			<li class="active"><a href="/persons/<?=$handler->Name2URL($d['person']['eng_name']);?>/fanfics">�������</a></li>
			<li><a href="/persons/<?=$handler->Name2URL($d['person']['eng_name']);?>/facts">�����</a></li>
			<li><a href="/persons/<?=$handler->Name2URL($d['person']['eng_name']);?>/talks">����������</a></li>
			<?if ($p['query']->get_num('video', array('pole1'=>$d['person']['id'], 'pole11'=>'1')) > 0) {?>
			<li><a href="/persons/<?=$handler->Name2URL($d['person']['eng_name']);?>/video">�����</a></li>
			<?}?>
			<?if ($p['query']->get_num('yourstyle_sets_tags', array('tid'=>$d['person']['id'])) > 0) {?>
			<li><a href="/persons/<?=$handler->Name2URL($d['person']['eng_name']);?>/sets">����</a></li>
			<? } ?>
		</ul>
		<ul class="menu bLevel">
			<li class="active"><a href="/persons/<?=$handler->Name2URL($d['person']['eng_name']);?>/fanfics/all">��� �������</a></li>
			<li><a href="/persons/<?=$handler->Name2URL($d['person']['eng_name']);?>/fanfics/add">��������</a></li>
		</ul>
		<h2>�������</h2>
		<div class="trackContainer fanficsTrack commentsTrack">
			<?foreach ($d['fanfics_data'] as $value) {?>
			<div class="trackItem">
				<h3><a href="/persons/<?=$handler->Name2URL($d['person']['eng_name']);?>/fanfics/<?=$value['id'];?>"><?=$value['name'];?></a></h3>
				<?if ($value['attachment']) {?>
				<div class="picture"><img src="<?=$this->getStaticPath('/upload/'. $value['attachment']);?>" alt="" /></div>
				<?}?>
				<div class="entry">
					<p><?=$value['announce'];?></p>
					<a href="/persons/<?=$handler->Name2URL($d['person']['eng_name']);?>/fanfics/<?=$value['id'];?>" class="more_new">������ ������</a>
				</div>
				<div class="newsMeta fanficMeta">
					<span class="comments"><a href="/persons/<?=$handler->Name2URL($d['person']['eng_name']);?>/fanfics/<?=$value['id'];?>#comments">������������ <?=($value['num_comments'] ? $value['num_comments'] : 0);?></a></span>
					<span class="views">���������� <?=($value['num_views'] ? $value['num_views'] : 0);?></span><br />
					<span class="date"><?=$value['time_create'];?></span>
					<span class="user">
						<?$rating = $p['rating']->_class($value['user_rating']);?>
						<div class="userRating <?=$rating['class']?>">
							<div class="rating <?=$rating['stars']?>"></div>
							<span><?=$rating['name']?></span>
						</div>
						<h4><a rel="nofollow" href="/profile/<?=$value['user_id']?>"><?=htmlspecialchars($value['user_nick'], ENT_IGNORE, 'cp1251', false);?></a></h4>
					</span>
					<span class="rating">
							       �����������?
						<span class="like">�� (<?=$value['num_like'];?>)</span>
						<span class="dislike">��� (<?=$value['num_dislike'];?>)</span>
					</span>
				</div>
			</div>
			<?}?>
		</div>
		<div class="paginator">
			<p class="pages">��������:</p>
			<ul>
				<?foreach ($p['pager']->make($d['page'], $d['pages'], 10) as $i => $pi) { ?>
				<li>
					<?if (!isset($pi['current'])) {
					    if($pi['link'] == 1) { ?>
					    	<a href="/persons/<?=$handler->Name2URL($d['person']['eng_name']);?>/fanfics"><?=$pi['text']?></a>					    
					    <?php } else { ?>					
							<a href="/persons/<?=$handler->Name2URL($d['person']['eng_name']);?>/fanfics/page/<?=$pi['link']?>"><?=$pi['text']?></a>
					    <?}} else {?>
					<?=$pi['text']?>
					<?}?>
				</li>
				<?}?>
			</ul>
		</div>
	</div>
	<?$this->_render('inc_right_column');?>
</div>
<?$this->_render('inc_footer');?>