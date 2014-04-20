<?
$this->_render('inc_header', array('title' => $d['cuser']['nick'], 'header' => '�������', 'top_code' => '<img src="' . $this->getStaticPath($this->getUserAvatar($d['cuser']['avatara'], true)) . '" alt="' . htmlspecialchars($d['cuser']['nick']) . '" class="avaProfile">', 'header_small' => '���� �������'));

$new_msgs = $p['query']->get_num('user_msgs', array('uid' => $d['cuser']['id'], 'readed'=>0, 'private' => 1, 'del_uid' => 0));
$new_friends = $p['query']->get_num('user_friends_optimized', array('uid'=>$d['cuser']['id'], 'confirmed'=>0));
?>
<div id="contentWrapper" class="twoCols">
	<div id="content">
		<ul class="menu">
			<li><a rel="nofollow" href="/profile/<?=$d['cuser']['id']?>">�������</a></li>
			<li><a rel="nofollow" href="/profile/<?=$d['cuser']['id']?>/friends">������</a><span class="marked"><?=$new_friends;?></span></li>
			<li class="active"><a rel="nofollow" href="/profile/<?=$d['cuser']['id']?>/persons/all">�������</a></li>
			<li><a rel="nofollow" href="/profile/<?=$d['cuser']['id']?>/guestbook">��������</a></li>
			<li><a rel="nofollow" href="/profile/<?=$d['cuser']['id']?>/messages">���������</a><span class="marked"><?=$new_msgs;?></span></li>
			<li><a rel="nofollow" href="/profile/<?=$d['cuser']['id']?>/wrote">� ����</a></li>
			<li><a rel="nofollow" href="/profile/<?=$d['cuser']['id']?>/fanfics">�������</a></li>
			<li><a rel="nofollow" href="/profile/<?=$d['cuser']['id']?>/gifts">�������</a></li>
			<li><a rel="nofollow" href="/profile/<?=$d['cuser']['id']?>/community/groups">������</a></li>
			<li><a rel="nofollow" href="/profile/<?=$d['cuser']['id']?>/sets">your.style</a></li>
			<li><a rel="nofollow" href="/games/guess_star/instructions/profile">������ ������</a></li>			
		</ul>
		<ul class="menu bLevel">
			<li><a rel="nofollow" href="/profile/<?=$d['cuser']['id']?>/persons/all">�������</a></li>
			<li class="active"><a rel="nofollow" href="/profile/<?=$d['cuser']['id']?>/persons">�������</a></li>
			<li><a rel="nofollow" href="/profile/<?=$d['cuser']['id']?>/persons/add">��������</a></li>
			<li><a rel="nofollow" href="/profile/<?=$d['cuser']['id']?>/persons/del">�������</a></li>
		</ul>
		<h2>������� � �������, ������� ���� ��������</h2>
		<div class="newsTrack">
			<?foreach ($d['persons_news'] as $i => $new) {?>
			<div class="trackItem">
				<h3><a href="/news/<?=$new['new_id']?>"><?=$new['name']?></a></h3>
				<div class="imagesContainer">
					<a href="/news/<?=$new['new_id']?>"><img alt="" src="<?=$this->getStaticPath('/upload/_500_600_80_' . $new['main_photo'])?>" /></a>
				</div>
				<div class="entry">
						<?=$new['anounce']?>
					<a href="/news/<?=$new['new_id']?>" class="more_new">������ ������</a>
				</div>
				<div class="newsMeta">
					<span class="comments"><a href="/news/<?=$new['new_id']?>#comments">������������: <?=RoomFactory::load('news-'.$new['new_id'])->getCount();?></a></span>
					<span class="views">���������� <?=$new['views']?></span><br />
					<span class="tags">����:
						<?
						$persons = $p['query']->get('persons', array('ids' => $new['ids_persons']));
						$events = $p['query']->get('events', array('ids' => $new['ids_events']));
						foreach ($persons as $i => $person) {
						    $link = $person['eng_name'];
			                $link = str_replace('-', '_', $link);
			                $link = str_replace('&dash;', '_', $link);
			                $link = '/persons/'.str_replace(' ', '-', $link);
			            ?>
						<a href="<?=$link;?>"><?=$person['name']?></a><?if ($i < count($persons) - 1) {?>, <?}?>
						<?}?>
						<?if (!empty($persons) && !empty($events)) {?>,<?}?>
						<?foreach ($events as $i => $event) {?>
						<a href="/event/<?=$event['id']?>"><?=$event['name']?></a>
						<?if ($i < count($events) - 1) {?>,<?}?>
						<?}?>
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
					<?if (!isset($pi['current'])) {?>
					<a rel="nofollow" href="/profile/<?=$d['cuser']['id']?>/persons/page/<?=$pi['link']?>"><?=$pi['text']?></a>
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
