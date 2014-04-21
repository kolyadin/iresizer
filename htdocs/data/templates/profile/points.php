<?php
$this->_render('inc_header', array('title'=>$d['cuser']['nick'], 'header'=>'������', 'top_code'=>'<img src="' . $this->getStaticPath($this->getUserAvatar($d['cuser']['avatara'], true)) . '" alt="' . htmlspecialchars($d['cuser']['nick']) . '" class="avaProfile">', 'header_small'=>'���� �������'));

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
			<li class="active"><a rel="nofollow" href="/profile/<?=$d['cuser']['id']?>/messages">���������</a><span class="marked"><?=$new_msgs;?></span></li>
			<li><a rel="nofollow" href="/profile/<?=$d['cuser']['id']?>/wrote">� ����</a></li>
			<li><a rel="nofollow" href="/profile/<?=$d['cuser']['id']?>/fanfics">�������</a></li>
			<li class="active"><a rel="nofollow" href="/profile/<?=$d['cuser']['id']?>/gifts">�������</a></li>
			<li><a rel="nofollow" href="/profile/<?=$d['cuser']['id']?>/community/groups">������</a></li>
			<li><a rel="nofollow" href="/profile/<?=$d['cuser']['id']?>/sets">your.style</a></li>
			<li><a rel="nofollow" href="/games/guess_star/instructions/profile">������ ������</a></li>			
		</ul>
		<ul class="menu bLevel">
			<li><a rel="nofollow" href="/profile/<?=$d['cuser']['id']?>/gifts">��������� �������</a></li>
			<li><a rel="nofollow" href="/profile/<?=$d['cuser']['id']?>/gifts/send">������������ �������</a></li>
			<li><a rel="nofollow" href="/profile/<?=$d['cuser']['id']?>/gifts/recieved">�������� �������</a></li>
			<li class="active"><a rel="nofollow" href="/profile/<?=$d['cuser']['id']?>/gifts/points">������ ����</a><span id="money"><?=$d['cuser']['points']?></span></li>
		</ul>
		<div class="gift-list">
			<h4 class="error"><?=(isset($d['error']) ? $d['error'] : '')?></h4>
			<div class="h3">�� ����� ����� <?=$d['cuser']['points'] . ' ' . $p['declension']->get($d['cuser']['points'], '����', '�����', '������')?></div>
			<h3>��� ��������� ����</h3>
			<p>
							����� �������� ����� ��� �������� �������,
							��������� SMS � ������� <nobr><b>popcorn <?=$d['cuser']['id'];?></b></nobr> �� ������:
			</p>
			<ol>
				<li type="1">4445 - ��������� 20 ��� (2 �����)</li>
				<li type="1">4444 - ��������� 10 ��� (1 ����)</li>
			</ol>
			<p>(��������� ������� ��� ���)</p>
		</div>
	</div>
	<?$this->_render('inc_right_column');?>
</div>
<?$this->_render('inc_footer');?>