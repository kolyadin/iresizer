<?
$this->_render('inc_header', array('title'=>$d['cuser']['nick'], 'header'=>'� ����', 'top_code'=>'<img src="' . $this->getStaticPath($this->getUserAvatar($d['cuser']['avatara'], true)) . '" alt="' . htmlspecialchars($d['cuser']['nick']) . '" class="avaProfile">', 'header_small'=>'�����������'));
$new_msgs = $p['query']->get_num('user_msgs', array('uid' => $d['cuser']['id'], 'readed'=>0, 'private' => 1, 'del_uid' => 0));
$new_friends = $p['query']->get_num('user_friends_optimized', array('uid'=>$d['cuser']['id'], 'confirmed'=>0));
?>
<div id="contentWrapper" class="twoCols">
	<div id="content">
		<ul class="menu">
			<li><a rel="nofollow" href="/profile/<?=$d['cuser']['id']?>">�������</a></li>
			<li><a rel="nofollow" href="/profile/<?=$d['cuser']['id']?>/friends">������</a><span class="marked"><?=$new_friends;?></span></li>
			<li><a rel="nofollow" href="/profile/<?=$d['cuser']['id']?>/persons/all">�������</a></li>
			<li><a rel="nofollow" href="/profile/<?=$d['cuser']['id']?>/guestbook">��������</a></li>
			<li><a rel="nofollow" href="/profile/<?=$d['cuser']['id']?>/messages">���������</a><span class="marked"><?=$new_msgs;?></span></li>
			<li class="active"><a rel="nofollow" href="/profile/<?=$d['cuser']['id']?>/wrote">� ����</a></li>
			<li><a rel="nofollow" href="/profile/<?=$d['cuser']['id']?>/fanfics">�������</a></li>
			<li><a rel="nofollow" href="/profile/<?=$d['cuser']['id']?>/gifts">�������</a></li>
			<li><a rel="nofollow" href="/profile/<?=$d['cuser']['id']?>/community/groups">������</a></li>
			<li><a rel="nofollow" href="/profile/<?=$d['cuser']['id']?>/sets">your.style</a></li>
			<li><a rel="nofollow" href="/games/guess_star/instructions/profile">������ ������</a></li>			
		</ul>
		<ul class="menu bLevel">
			<li><a rel="nofollow" href="/profile/<?=$d['cuser']['id']?>/wrote">����</a></li>
			<li class="active"><a rel="nofollow" href="/profile/<?=$d['cuser']['id']?>/wrote/notifications">�����������</a></li>
		</ul>
		<div class="trackContainer commentsTrack">
			<?
			foreach ($d['notifications'] as $i => $notify) {
				if ($notify['readed'] == 0) $p['query']->set('notifications', array('readed' => 1), $notify['id']);
			?>
			<div class="trackItem" id="<?=$notify['id'];?>"<?=($notify['readed'] == 0 ? ' style="background-color: #E5E5E5;"' : '')?>>
				<div class="post">
					<a rel="nofollow" href="/profile/<?=$d['cuser']['id']?>" class="ava"><img src="<?=$this->getStaticPath($this->getUserAvatar($d['cuser']['avatara'], true))?>" alt="" /></a>
					<div class="details">
						<span class="toTheme">������������ <?=$notify['anick']?> ������� �� ��� ����������� � ���� <a href="<?=$notify['title_link']?>">&laquo;<?=$notify['title']?>&raquo;</a></span>
						<span class="toTheme"><a href="<?=$notify['link']?>">������� � �����������</a></span>
						<span class="date"><?=$p['date']->unixtime(strtotime($notify['regtime']), "%d %F %Y, %H:%i")?></span>
						<a class="reply" href="#" onclick="delete_msg(<?=$notify['id']?>, 'notify'); return false;">�������</a>
					</div>
				</div>
			</div>
			<?}?>
		</div>
		<div class="noUpperBorder paginator smaller">
			<p class="pages">��������:</p>
			<ul>
				<?foreach ($p['pager']->make($d['page'], $d['pages'], 10) as $i => $pi) { ?>
				<li>
					<?if (!isset($pi['current'])) {?>
					<a rel="nofollow" href="/profile/<?=$d['cuser']['id']?>/wrote/notifications/<?=$pi['link']?>"><?=$pi['text']?></a>
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
