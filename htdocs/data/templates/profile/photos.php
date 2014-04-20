<?
$this->_render('inc_header',
	array(
		'title' => $d['cuser']['nick'],
		'header' => '����������',
		'top_code' => '<img src="' . $this->getStaticPath($this->getUserAvatar($d['cuser']['avatara'], true)) . '" alt="' . htmlspecialchars($d['cuser']['nick']) . '" class="avaProfile">',
		'header_small' => '����������',
		'js' => 'Comments.js?d=13.05.11',
	)
);

$new_msgs = $p['query']->get_num('user_msgs', array('uid' => $d['cuser']['id'], 'readed'=>0, 'private' => 1, 'del_uid' => 0));
$new_friends = $p['query']->get_num('user_friends_optimized', array('uid'=>$d['cuser']['id'], 'confirmed'=>0));
$U_ = explode('/', $_SERVER['REQUEST_URI']);
?>
<div id="contentWrapper" class="twoCols">
	<div id="content">
		<ul class="menu">
			<li class="active"><a rel="nofollow" href="/profile/<?=$d['cuser']['id']?>">�������</a></li>
			<li><a rel="nofollow" href="/profile/<?=$d['cuser']['id']?>/friends">������</a><span class="marked"><?=$new_friends;?></span></li>
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
			<li><a rel="nofollow" href="/profile/<?=$d['cuser']['id']?>">�������</a></li>
			<li><a rel="nofollow" href="/profile/<?=$d['cuser']['id']?>/form">�������������</a></li>
			<li class="active"><a rel="nofollow" href="/profile/<?=$d['cuser']['id']?>/photos">����������</a></li>
			<li><a rel="nofollow" href="/profile/<?=$d['cuser']['id']?>/photos/del">�������� ����</a></li>
            <li><a rel="nofollow" href="/profile/<?=$d['cuser']['id']?>/blacklist">������ ������</a></li>
		</ul>
		<h2>���� ����</h2>
		<div class="gallery">
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
			<a rel="nofollow" href="/profile/<?=$d['cuser']['id']?>/photos/add">�������� ����</a>
			<strong>���� ��� ����������? ��������!</strong>
		</div>
		<?$comments = $p['query']->get('profile_pix_comments_vivod', array('gid'=>$d['cuser']['id']), array('id'), null, null);?>
		<br clear="both"><br>
		<div class="irh irhComments">
			<div class="irhContainer">
				<h3>�����������<span class="replacer"/></h3>
				<span class="counter"><?=count($comments)?></span>
			</div>
		</div>
		<div class="trackContainer commentsTrack">
		<?foreach ($comments as $i => $comment) {?>
			<div class="trackItem" id="<?=$comment['id'];?>">
				<div class="post">
					<div class="entry">
						<p><?=$this->preg_repl($p['nc']->get($comment['content']));?></p>
					</div>
					
					<a rel="nofollow" href="/profile/<?=$comment['uid']?>" class="ava"><img src="<?=$this->getStaticPath($this->getUserAvatar($comment['uavatara']))?>" /></a>
					<?if (!empty($d['cuser'])) {?>
					<div class="mark">
						<span class="up"><span><?=$comment['rating_up']?></span></span>
						<span class="down"><span>-<?=$comment['rating_down']?></span></span>
					</div>
					<?}?>
					<div class="details">
						<a class="pc-user" rel="nofollow" href="/profile/<?=$comment['uid']?>"><?=$comment['unick']?></a>
						<span class="date"><?=$p['date']->unixtime($comment['ctime'], '%d %F %Y, %H:%i')?></span>
						<?$rating = $p['rating']->_class($comment['urating']);?>
						<div class="userRating <?=$rating['class']?>">
							<div class="rating <?=$rating['stars']?>"></div>
							<span><?=$comment['urating']?></span>
						</div>
						<span class="reply" onkeydown="return '<?=$p['nc']->replyText($comment['content'])?>';">��������</span>
						<? if ($comment['gid'] == $d['cuser']['id'] || $d['cuser']['id'] == $comment['uid']) { ?>
						<span class="delete">�������</span>
						<?}?>
					</div>
				</div>
			</div>
		<?}?>
		</div>
		<div class="trackContainer commentsTrack">
			<form class="newComment checkCommentsForm" name="fmr" action="/" method="POST">
				<input type="hidden" name="type" value="photos_comment">
				<input type="hidden" name="action" value="add">
				<input type="hidden" name="re" value="">
				<input type="hidden" name="new_id" value="<?=$d['cuser']['id']?>">
				<a name="write"></a>
				<div class="trackItem">
					<div class="entry">
					    <?$this->_render('inc_bbcode');?>
						<?$this->_render('inc_smiles');?>
						<textarea name="content"></textarea>
					</div>
					<fieldset class="loggedOut twoCols">
						<div class="aboutMe">
							<a rel="nofollow" href="/profile/<?=$d['cuser']['id']?>" class="ava"><img src="<?=$this->getStaticPath($this->getUserAvatar($d['cuser']['avatara']))?>" /></a>
							<span>�� ������ ���</span><br />
							<a rel="nofollow" href="/profile/<?=$d['cuser']['id']?>"><?=htmlspecialchars($d['cuser']['nick'], ENT_IGNORE, 'cp1251', false);?></a>
						</div>
					</fieldset>
				</div>
				<div class="formActions">
					<input type="submit" name="submit" value="���������" onclick="this.enabled = false;" />
				</div>
			</form>
		</div>
	</div>
	<?$this->_render('inc_right_column');?>
</div>
<?$this->_render('inc_footer');?>