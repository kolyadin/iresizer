<?
$this->_render('inc_header', array('title'=>$d['cuser']['nick'], 'header'=>'������ ���������', 'top_code'=>'<img src="' . $this->getStaticPath($this->getUserAvatar($d['cuser']['avatara'], true)) . '" alt="' . htmlspecialchars($d['cuser']['nick']) . '" class="avaProfile">', 'header_small'=>'��� ���� �������� ������ ���������'));
$new_msgs = $p['query']->get_num('user_msgs', array('uid' => $d['cuser']['id'], 'readed'=>0, 'private' => 1, 'del_uid' => 0));
$new_friends = $p['query']->get_num('user_friends_optimized', array('uid'=>$d['cuser']['id'], 'confirmed'=>0));
$blackList = BlackListFactory::getBlackListForUser($d['user']['id']);
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
			<li><a rel="nofollow" href="/profile/<?=$d['cuser']['id']?>/messages/sent">������������</a></li>
			<li><a rel="nofollow" href="/profile/<?=$d['cuser']['id']?>/messages/new">�������� �����</a></li>
		</ul>
		<div class="trackContainer mailTrack">
			<div class="trackItem answering">
				<div class="entry">
					<p><?=nl2br($this->preg_repl($p['smiles']->parse($d['message']['content'])))?></p>
				</div>
				
				<a rel="nofollow" href="/profile/<?=$d['message']['aid']?>" class="ava"><img alt="" src="<?=$this->getStaticPath($this->getUserAvatar($d['user']['avatara']))?>" /></a>
				<div class="details">
					<a class="pc-user" rel="nofollow" href="/profile/<?=$d['message']['aid']?>"><?=htmlspecialchars($d['user']['nick'], ENT_IGNORE, 'cp1251', false);?></a>
					<span class="date"><?=$p['date']->unixtime($d['message']['cdate'], '%d %F %Y, %H:%i')?></span>
					<div class="rating"></div>
				</div>
                <?php if(!$blackList->isUserExists($d['cuser']['id'])) { ?>
				<form class="answer newMessage" action="/" method="POST">
					<input type="hidden" name="type" value="private_msg">
					<input type="hidden" name="action" value="answer">
					<input type="hidden" name="pid" value="<?=$d['message']['id']?>">
					<input type="hidden" name="uid" value="<?=$d['user']['id']?>">
					<?$this->_render('inc_smiles');?>
					<textarea name="content"></textarea>
					<div class="meta">
						<div class="aboutMe">
							<a rel="nofollow" href="/profile/<?=$d['cuser']['id']?>" class="ava"><img src="<?=$this->getStaticPath($this->getUserAvatar($d['cuser']['avatara']))?>" /></a>
							<span>�� ������ ���</span><br />
							<a rel="nofollow" href="/profile/<?=$d['cuser']['id']?>"><?=htmlspecialchars($d['cuser']['nick'], ENT_IGNORE, 'cp1251', false);?></a>
						</div>
						<input type="submit" value="���������" onclick="this.enabled = false;" />
					</div>
				</form>
                <?php } else { ?>
                    <h4 style="clear:both;padding-top: 10px;">��������� ����������� �� ��������� ��� �������� �� ��� ���������</h4>
                <?php } ?>
			</div>
		</div>
		
		<?if (!isset($d['history'])) {?>
		<h4><a href="/profile/<?=$d['cuser']['id']?>/messages/read/<?=$d['message']['id']?>/history">�������� ������� ��������� � <?=htmlspecialchars($d['user']['nick'], ENT_IGNORE, 'cp1251', false);?></a></h4>
		<?} elseif (empty($d['history'])) {?>
		<h4>� ��� ��� ��������� � <?=htmlspecialchars($d['user']['nick'], ENT_IGNORE, 'cp1251', false);?></h4>
		<?} else {?>
		<div class="trackContainer commentsTrack">
			<?foreach ($d['history'] as $i => $msg) {?>
			<div class="trackItem <?=($msg['readed'] == 0 ? ' notReaded' : null)?>" id="<?=$msg['id'];?>">
				<div class="post">
					<div class="entry">
						<p><?=nl2br($this->preg_repl($p['smiles']->parse($msg['content'])))?></p>
					</div>
					<a href="/profile/<?=$msg['user']['id']?>" class="ava"><img src="<?=$this->getStaticPath($this->getUserAvatar($msg['user']['avatara']))?>" /></a>
					<div class="details">
						<a class="pc-user" rel="nofollow" href="/profile/<?=$msg['user']['id']?>"><?=htmlspecialchars($msg['user']['nick'], ENT_IGNORE, 'cp1251', false);?></a>
						
						<span class="date"><?=$p['date']->unixtime($msg['cdate'], '%d %F %Y, %H:%i')?></span>
						
						<a href="#" onclick="delete_msg(<?=$msg['id'];?>, '<?=$msg['uid'] == $d['cuser']['id'] ? 'private' : 'private_send'?>'); return false;">�������</a>
						
						<?$rating = $p['rating']->_class($msg['user']['rating']);?>
						<div class="userRating <?=$rating['class']?>" title="<?=$msg['user']['rating']?>">
							<div class="rating <?=$rating['stars']?>"></div>
							<span><?=$msg['user']['rating']?></span>
						</div>
					</div>
				</div>
			</div>
			<?}?>
		</div>
		
		<div class="noUpperBorder paginator">
			<p class="pages">��������:</p>
			<ul>
				<?foreach ($p['pager']->make($d['page'], $d['pages'], 10) as $i => $pi) { ?>
				<li>
					<?if (!isset($pi['current'])) {?>
					<a rel="nofollow" href="/profile/<?=$d['cuser']['id']?>/messages/read/<?=$d['message']['id']?>/history/page/<?=$pi['link']?>"><?=$pi['text']?></a>
					<?} else {?>
					<?=$pi['text']?>
					<?}?>
				</li>
				<?}?>
			</ul>
		</div>
		<?}?>
	</div>

	<?$this->_render('inc_right_column');?>
</div>
<?$this->_render('inc_footer');?>
