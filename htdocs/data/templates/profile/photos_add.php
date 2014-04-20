<?
$this->_render('inc_header', array('title'=>$d['cuser']['nick'], 'header'=>'������', 'top_code'=>'<img src="' . $this->getStaticPath($this->getUserAvatar($d['cuser']['avatara'], true)) . '" alt="' . htmlspecialchars($d['cuser']['nick']) . '" class="avaProfile">', 'header_small'=>'�������������� ����� ������'));
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
			<li><a rel="nofollow" href="/profile/<?=$d['cuser']['id']?>/wrote">� ����</a></li>
			<li><a rel="nofollow" href="/profile/<?=$d['cuser']['id']?>/fanfics">�������</a></li>
			<li><a rel="nofollow" href="/profile/<?=$d['cuser']['id']?>/gifts">�������</a></li>
			<li><a rel="nofollow" href="/profile/<?=$d['cuser']['id']?>/community/groups">������</a></li>
			<li><a rel="nofollow" href="/profile/<?=$d['cuser']['id']?>/sets">your.style</a></li>
			<li><a rel="nofollow" href="/games/guess_star/instructions/profile">������ ������</a></li>			
		</ul>
		<ul class="menu bLevel">
			<li><a rel="nofollow" href="/profile/<?=$d['cuser']['id']?>/form">������</a></li>
			<li><a rel="nofollow" href="/profile/<?=$d['cuser']['id']?>/form">�������������</a></li>
			<li class="active"><a rel="nofollow" href="/profile/<?=$d['cuser']['id']?>/photos">����������</a></li>
			<li><a rel="nofollow" href="/profile/<?=$d['cuser']['id']?>/photos/del">�������� ����</a></li>
		</ul>
		<h2>���������� ����������</h2>
		<form class="questionnaireForm newPhotos" method="POST" action="/index.php" enctype="multipart/form-data">
			<input type="hidden" name="type" value="profile">
			<input type="hidden" name="action" value="add_photo">
			<fieldset>
				<span>���� 1</span>
				<input type="file" name="photo[]" />
				<span class="desc">�������� ����������:</span>
				<input type="text" name="descr[]" maxlength="160" value="" />
			</fieldset>
			<fieldset>
				<span>���� 2</span>
				<input type="file" name="photo[]" />
				<span class="desc">�������� ����������:</span>
				<input type="text" name="descr[]" maxlength="160" value="" />
			</fieldset>
			<fieldset>
				<span>���� 3</span>
				<input type="file" name="photo[]" />
				<span class="desc">�������� ����������:</span>
				<input type="text" name="descr[]" maxlength="160" value="" />
			</fieldset>
			<input type="submit" value="���������" />
		</form>
	</div>
	<?$this->_render('inc_right_column');?>
</div>
<?$this->_render('inc_footer');?>