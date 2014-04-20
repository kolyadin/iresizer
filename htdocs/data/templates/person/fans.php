<?
$this->_render('inc_header', array('title'=>'���������� - ' . $d['person']['name'], 
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
			<li><a href="/persons/<?=$handler->Name2URL($d['person']['eng_name']);?>/photo">����</a></li>
			<li class="active"><a href="/persons/<?=$handler->Name2URL($d['person']['eng_name']);?>/fans">����������</a></li>
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
		<ul class="menu bLevel">
			<li class="active"><a href="/persons/<?=$handler->Name2URL($d['person']['eng_name']);?>/fans">��� ����������</a></li>
			<li><a href="/persons/<?=$handler->Name2URL($d['person']['eng_name']);?>/fans/new">�����</a></li>
			<?
			if (isset($d['cuser']) && !empty($d['cuser'])) {
				$is_fan = $p['query']->get('fans', array('gid'=>$d['person']['id'], 'uid'=>$d['cuser']['id']), null, 0, 1, null, true, true);
			?>
			<li><a href="/persons/<?=$handler->Name2URL($d['person']['eng_name']);?>/fans/local">� ����� ������</a></li>
			<?if (!$is_fan) {?>
			<li><a href="/persons/<?=$handler->Name2URL($d['person']['eng_name']);?>/fans/subscribe">����� �����������</a></li>
			<?} else {?>
			<li><a href="/persons/<?=$handler->Name2URL($d['person']['eng_name']);?>/fans/unsubscribe">�������� ������</a></li>
			<?}?>
			<?}?>
		</ul>
		<h2>���������� <?=$d['person']['genitive']?></h2>
		<table class="contentUsersTable">
			<tr>
				<th class="user"><a href="/persons/<?=$handler->Name2URL($d['person']['eng_name']);?>/fans/sort/nick<?=($d['sort'] == 'nick' ? '_desc' : '')?>" <?=($d['sort'] == 'nick' ? 'class="active"' : '')?>>������������</a></th>
				<th class="starRating">&nbsp;</th>
				<th class="city"><a href="/persons/<?=$handler->Name2URL($d['person']['eng_name']);?>/fans/sort/city<?=($d['sort'] == 'city' ? '_desc' : '')?>" <?=($d['sort'] == 'city' ? 'class="active"' : '')?>>�����</a></th>
				<th class="rating"><a href="/persons/<?=$handler->Name2URL($d['person']['eng_name']);?>/fans/sort/rating<?=($d['sort'] == 'rating' ? '_desc' : '')?>" <?=($d['sort'] == 'rating' ? 'class="active"' : '')?>>�������</a></th>
				<th class="actions">&nbsp;</th>
			</tr>
			<?
			$limit = 50;
			$offset = ($d['page'] - 1) * $limit;
			if ($offset < 0) $offset = 0;
			$num_users = $p['query']->get_num('person_fans', array('gid'=>$d['person']['id']));
			$pages = ceil($num_users / $limit);

			foreach ($p['query']->get('person_fans', array('gid'=>$d['person']['id']), array($d['sort']), $offset, $limit) as $i => $user) {
			?>
			<tr>
				<td class="user">
					<a rel="nofollow" href="/profile/<?=$user['id']?>">
						<img alt="" src="<?=$this->getStaticPath($this->getUserAvatar($user['avatara']))?>" />
						<span><?=htmlspecialchars($user['nick'], ENT_IGNORE, 'cp1251', false);?></span>
					</a>
				</td>
				<td class="starRating">
						<?$rating = $p['rating']->_class($user['rating']);?>
					<div class="userRating <?=$rating['class']?>" title="<?=$user['rating']?>">
						<div class="rating <?=$rating['stars']?>"></div>
						<span><?=$rating['name']?></span>
					</div>
				</td>
				<td class="city">
					<a href="/persons/<?=$handler->Name2URL($d['person']['eng_name']);?>/fans/city/<?=$user['city_id']?>"><?=($user['city_id'] > 0) ? $user['city'] : "������"?></a>
				</td>
				<td class="rating">
					<span><?=$user['rating']?></span>
				</td>
			</tr>
			<?}?>
		</table>
		<div class="paginator smaller">
			<p class="pages">��������:</p>
			<ul>
				<?foreach ($p['pager']->make($d['page'], $pages, 10) as $i => $pi) { ?>
				<li>
					<?if (!isset($pi['current'])) {?>
					<a href="/persons/<?=$handler->Name2URL($d['person']['eng_name']);?>/fans/sort/<?=$d['sort']?>/page/<?=$pi['link']?>"><?=$pi['text']?></a>
					<?} else {?>
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