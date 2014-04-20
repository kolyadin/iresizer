<?
$this->_render('inc_header', array('title' => $d['cuser']['nick'], 'header' => '������', 'top_code' => '<img src="' . $this->getStaticPath($this->getUserAvatar($d['cuser']['avatara'], true)) . '" alt="' . htmlspecialchars($d['cuser']['nick']) . '" class="avaProfile">', 'header_small' => '���� �������', 'js' => 'Comments.js?d=13.05.11'));

$new_msgs = $p['query']->get_num('user_msgs', array('uid' => $d['cuser']['id'], 'readed'=>0, 'private' => 1, 'del_uid' => 0));
$new_friends = $p['query']->get_num('user_friends_optimized', array('uid' => $d['cuser']['id'], 'confirmed' => 0));
?>
<div id="contentWrapper" class="twoCols">
	<div id="content">
		<ul class="menu">
			<li><a rel="nofollow" href="/profile/<?=$d['cuser']['id']?>">�������</a></li>
			<li class="active"><a rel="nofollow" href="/profile/<?=$d['cuser']['id']?>/friends">������</a><span class="marked"><?=$new_friends;?></span></li>
			<li><a rel="nofollow" href="/profile/<?=$d['cuser']['id']?>/persons/all">�������</a></li>
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
			<li><a rel="nofollow" href="/profile/<?=$d['cuser']['id']?>/friends/">������ ������</a></li>
			<li class="active"><a rel="nofollow" href="/profile/<?=$d['cuser']['id']?>/friends/wrote">��� �����</a></li>
		</ul>
		<h2>��� ����� ���� ������</h2>
		<div class="trackContainer commentsTrack">
			<?
			$limit = 50;
			$offset = ($d['page'] - 1) * $limit;
			$num_friends = $p['query']->get_num('comments_friends', array('uid'=>$d['cuser']['id'], 'confirmed'=>1));
			$pages = ceil($num_friends / $limit);
			foreach ($p['query']->get('comments_friends', array('uid' => $d['cuser']['id']), null, $offset, $limit) as $i => $friend) {
				$last_comment = array_shift($p['query']->get('comments', array('user_id' => $friend['fid']), array('id desc'), 0, 1));
				if (empty($last_comment)) {
					continue;
				}
				$comment_new = array_shift($p['query']->get('news', array('id'=>$last_comment['new_id']), null, 0, 1));
			?>
			<div class="trackItem" id="<?=$last_comment['id']?>">
				<div class="post">
					<div class="entry">
						<p><?=$p['nc']->get($last_comment['content']);?></p>
					</div>
					<a rel="nofollow" href="/profile/<?=$friend['id']?>" class="ava"><img src="<?=$this->getStaticPath($this->getUserAvatar($friend['avatara']))?>" alt="" /></a>
					<?if (!empty($d['cuser']) && !$last_comment['del']) {?>
					<div class="mark">
						<span class="up"><span><?=$last_comment['rating_up']?></span></span>
						<span class="down"><span>-<?=$last_comment['rating_down']?></span></span>
					</div>
					<?}?>
					<div class="details">
						<span class="toTheme">� ���� <a href="/main_comments/find/<?=$last_comment['id']?>">&laquo;<?=$comment_new['name']?>&raquo;</a></span>
						<a class="pc-user" rel="nofollow" href="/profile/<?=$friend['id']?>"><?=htmlspecialchars($friend['nick'], ENT_IGNORE, 'cp1251', false);?></a>
						<span class="date"><?=$p['date']->dmyhi($last_comment['ctime'], '%d %F %Y, %H:%i')?></span>
						<?$rating=$p['rating']->_class($d['cuser']['rating']);?>
						<div class="userRating <?=$rating['class']?>" title="<?=$d['cuser']['rating']?>">
							<div class="rating <?=$rating['stars']?>"></div>
							<span><?=$d['cuser']['rating']?></span>
						</div>
					</div>
				</div>
			</div>
			<?}?>

			<div class="paginator noUpperBorder">
				<p class="pages">��������:</p>
				<ul>
					<?foreach ($p['pager']->make($d['page'], $pages, 10) as $i => $pi) { ?>
					<li>
						<?if (!isset($pi['current'])) {?>
						<a rel="nofollow" href="/profile/<?=$d['cuser']['id']?>/friends/wrote/page/<?=$pi['link']?>"><?=$pi['text']?></a>
						<?} else {?>
						<?=$pi['text']?>
						<?}?>
					</li>
					<?}?>
				</ul>
			</div>
		</div>
	</div>
	<?$this->_render('inc_right_column');?>
</div>
<?$this->_render('inc_footer');?>
