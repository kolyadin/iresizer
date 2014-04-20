<?
$this->_render('inc_header', array('title' => $d['cuser']['nick'], 'header' => '������ ���������', 'top_code' => '<img src="' . $this->getStaticPath($this->getUserAvatar($d['cuser']['avatara'], true)) . '" alt="' . htmlspecialchars($d['cuser']['nick']) . '" class="avaProfile">', 'header_small' => '��� ���� ������������ ������ ���������'));
$new_msgs = $p['query']->get_num('user_msgs', array('uid' => $d['cuser']['id'], 'readed' => 0, 'private' => 1, 'del_uid' => 0));
$new_friends = $p['query']->get_num('user_friends_optimized', array('uid' => $d['cuser']['id'], 'confirmed' => 0));
?>
<div id="contentWrapper" class="twoCols">
	<div id="content">
		<ul class="menu">
			<li><a rel="nofollow" href="/profile/<?=$d['cuser']['id']?>">�������</a></li>
			<li><a rel="nofollow" href="/profile/<?=$d['cuser']['id']?>/friends">������</a><span class="marked"><?=$new_friends;?></span></li>
			<li><a rel="nofollow" href="/profile/<?=$d['cuser']['id']?>/persons/all">�������</a></li>
			<li><a rel="nofollow" href="/profile/<?=$d['cuser']['id']?>/guestbook">��������</a></li>
			<li class="active"><a rel="nofollow" href="/profile/<?=$d['cuser']['id']?>/messages">���������</a><span class="marked"><?=$new_msgs;?></span></li>
			<li><a rel="nofollow" href="/profile/<?=$d['cuser']['id']?>/wrote">� ����</a></li>
			<li><a rel="nofollow" href="/profile/<?=$d['cuser']['id']?>/fanfics">�������</a></li>
			<li><a rel="nofollow" href="/profile/<?=$d['cuser']['id']?>/gifts">�������</a></li>
			<li><a rel="nofollow" href="/profile/<?=$d['cuser']['id']?>/community/groups">������</a></li>
			<li><a rel="nofollow" href="/profile/<?=$d['cuser']['id']?>/sets">your.style</a></li>
			<li><a rel="nofollow" href="/games/guess_star/instructions/profile">������ ������</a></li>			
		</ul>
		<ul class="menu bLevel">
			<li><a rel="nofollow" href="/profile/<?=$d['cuser']['id']?>/messages">��������</a></li>
			<li class="active"><a rel="nofollow" href="/profile/<?=$d['cuser']['id']?>/messages/sent">������������</a></li>
			<li><a rel="nofollow" href="/profile/<?=$d['cuser']['id']?>/messages/new">�������� �����</a></li>
		</ul>
		<div class="trackContainer commentsTrack">
			<?
			$limit = 10;
			$offset = ($d['page'] - 1) * $limit;
			$num_records = $p['query']->get_num('user_msgs', array('aid' => $d['cuser']['id'], 'private' => 1, 'del_aid' => 0));

			$pages = ceil($num_records / $limit);
			foreach ($p['query']->get('user_msgs', array('aid' => $d['cuser']['id'], 'private' => 1, 'del_aid' => 0), array('id desc'), $offset, $limit) as $i => $msg) {
				$user = array_shift($p['query']->get('users', array('id' => $msg['uid']), null, 0, 1));
			?>
			<div class="trackItem<?=($msg['readed'] == 0 ? ' notReaded' : null)?>" id="<?=$msg['id'];?>">
				<div class="post">
					<div class="entry">
						<p><?=nl2br($this->preg_repl($p['nc']->get($msg['content'])))?></p>
					</div>
					<a href="/profile/<?=$user['id']?>" class="ava"><img src="<?=$this->getStaticPath($this->getUserAvatar($user['avatara']))?>" /></a>
					<div class="details">
						<a class="pc-user" rel="nofollow" href="/profile/<?=$user['id']?>"><?=htmlspecialchars($user['nick'], ENT_IGNORE, 'cp1251', false);?></a>
						<span class="date"><?=$p['date']->unixtime($msg['cdate'], '%d %F %Y, %H:%i')?></span>
						
						<a href="/profile/<?=$d['cuser']['id']?>/messages/read/<?=$msg['id']?>">�������</a>
						<a href="#" onclick="delete_msg(<?=$msg['id'];?>, 'private_send'); return false;">�������</a>
						
						<?$rating = $p['rating']->_class($user['rating']);?>
						<div class="userRating <?=$rating['class']?>" title="<?=$user['rating']?>">
							<div class="rating <?=$rating['stars']?>"></div>
							<span><?=$user['rating']?></span>
						</div>
					</div>
				</div>
			</div>
			<?}?>
		</div>
		<div class="noUpperBorder paginator smaller">
			<p class="pages">��������:</p>
			<ul>
				<?foreach ($p['pager']->make($d['page'], $pages, 10) as $i => $pi) { ?>
				<li>
						<?if (!isset($pi['current'])) {?>
					<a rel="nofollow" href="/profile/<?=$d['cuser']['id']?>/messages/sent/page/<?=$pi['link']?>"><?=$pi['text']?></a>
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
