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
			<li><a rel="nofollow" href="/profile/<?=$d['cuser']['id']?>/messages">���������</a><span class="marked"><?=$new_msgs;?></span></li>
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
			<li class="active"><a rel="nofollow" href="/profile/<?=$d['cuser']['id']?>/gifts/recieved">�������� �������</a></li>
			<li><a rel="nofollow" href="/profile/<?=$d['cuser']['id']?>/gifts/points">������ ����</a><span id="money"><?=$d['cuser']['points']?></span></li>
		</ul>
		<div class="gift-list">
			<h4 class="error"><?=(isset($d['error']) ? $d['error'] : '')?></h4>
			<script type="text/javascript" src="/js/swfobject.js"></script>
			<table class="send">
				<? foreach ($d['gifts'] as $gift) {?>
				<tr>
					<td class="gift" id="gift_<?=$gift['id']?>">
						<?if (substr($gift['gift_pic'], - 3) == 'jpg') {?>
						<img alt="" src="/gifts/<?=$gift['small_pic']?>" />
						<?} else {?>
						<script type="text/javascript">
							var realEstate = new SWFObject('/gifts/<?=$gift['gift_pic']?>', "gift_<?=$gift['id']?>", "125", "125", "9.0.0");
							realEstate.addParam("wmode","transparent");
							realEstate.write("gift_<?=$gift['id']?>");
						</script>
						<?}?>
					</td>
					<td><a rel="nofollow" href="/profile/<?=$gift['user_id']?>/"><?=htmlspecialchars($gift['nick'], ENT_IGNORE, 'cp1251', false);?></a></td>
					<td><?=$p['date']->unixtime($gift['send_date'], '%d %F %Y, %H:%i')?></td>
					<td><?=($gift['amount'] == 0 ? '���������' : $gift['amount'])?></td>
				</tr>
				<?}?>
			</table>
		</div>
	</div>
	<?$this->_render('inc_right_column');?>
</div>
<?$this->_render('inc_footer');?>