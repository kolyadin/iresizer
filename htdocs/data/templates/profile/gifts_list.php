<?php
$this->_render('inc_header',
               array(
                    'title'=>$d['cuser']['nick'],
                    'header'=>'������', 'top_code'=>'<img src="' . $this->getStaticPath($this->getUserAvatar($d['cuser']['avatara'], true)) . '" alt="' . htmlspecialchars($d['cuser']['nick']) . '" class="avaProfile">',
                    'header_small'=>'���� �������'));

$new_msgs = $p['query']->get_num('user_msgs', array('uid' => $d['cuser']['id'], 'readed'=>0, 'private' => 1, 'del_uid' => 0));
$new_friends = $p['query']->get_num('user_friends_optimized', array('uid'=>$d['cuser']['id'], 'confirmed'=>0));

$to = (isset($d['rewrite'][3]) ? (int)$d['rewrite'][3] : 0);
if ($to > 0) {
	$to = $p['query']->get('users', array('id' => $d['rewrite'][3]), null, 0, 1);
	$to = $to[0];
}
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
			<li class="active"><a rel="nofollow" href="/profile/<?=$d['cuser']['id']?>/gifts">��������� �������</a></li>
			<li><a rel="nofollow" href="/profile/<?=$d['cuser']['id']?>/gifts/send">������������ �������</a></li>
			<li><a rel="nofollow" href="/profile/<?=$d['cuser']['id']?>/gifts/recieved">�������� �������</a></li>
			<li><a rel="nofollow" href="/profile/<?=$d['cuser']['id']?>/gifts/points">������ ����</a><span id="money"><?=$d['cuser']['points']?></span></li>
		</ul>
		<div class="gift-list">
			<h4 class="error"><?=(isset($d['error']) ? $d['error'] : '')?></h4>
			<p class="choose">������ �������<?=($to ? ' ��� <b>' . htmlspecialchars($to['nick'], ENT_IGNORE, 'cp1251', false) . '</b>' : '')?>:</p>
			<ul class="gift-list">
				<?
				foreach ($d['gifts'] as $value) {
					if (substr($value['gift_pic'], - 3) == 'jpg') {
				?>
				<li>
					<a title="<?=$value['id']?>" class="paid" href="/gifts/<?=$value['gift_pic']?>">
						<img alt="<?=$value['amount']?>" title="<?=$value['title']?>" src="/gifts/<?=$value['small_pic']?>" />
					</a>
					<img alt="" class="paid" src="/i/paid-gift.jpg" />
				</li>
				<?} else {?>
				<li>
					<a title="<?=$value['id']?>" class="paid" href="/gifts/<?=$value['gift_pic']?>">
						<img alt="<?=$value['amount']?>" title="<?=$value['title']?>" src="/gifts/<?=$value['small_pic']?>" />
					</a>
					<img alt="" class="paid" src="/i/paid-gift.jpg" />
				</li>
				<?
					}
				}
				?>
			</ul>
			<div class="gift-container" id="gift-container">
				<div class="gift" id="gift"><img alt="" src="" id="picture" /></div>
				<div class="gift-info">
					<div class="send" id="send">
						<form method="POST" name="fmr" class="answer giftsForm">
							<input type="hidden" name="type" value="gift">
							<input type="hidden" name="action" value="add">
							<input type="hidden" name="id" id="gift_id">
							<input type="hidden" name="uid" id="uid" <?if (isset($d['rewrite'][3]) && is_numeric($d['rewrite'][3])) {?>value="<?=$d['rewrite'][3]?>"<?}?>>
							<?if (!$to) {?>
							<p>��������� �������:</p>
							<select class="selectReciever" name="uid"></select>
								<?}?>
							<p class="attention" id="attention">� ������� ����� ����� <span id="giftsPoint"></span></p>
							<input type="submit" value="" class="submitMessage" />
						</form>
					</div>
					<div class="noMoney" id="noMoney">
						<p class="bold">���� ������� �������.</p>
						<p>��� �� ��� ���������, ����������</p>
						<p class="bold"><a rel="nofollow" href="/profile/<?=$d['cuser']['id']?>/gifts/points">��������� ����.</a></p>
						<p id="notEnough"></p>
					</div>
				</div>
			</div>
		</div>
		<script type="text/javascript" src="<?=$this->getStaticPath('/js/gifts.js?02032010_3');?>"></script>
	</div>
	<?$this->_render('inc_right_column');?>
</div>
<?$this->_render('inc_footer');?>