<?
require_once 'data/libs/ui/YourStyle/YourStyle_Factory.php';
$this->_render('inc_header', array('title' => $d['user']['nick'], 'header' => htmlspecialchars($d['user']['nick'], ENT_IGNORE, 'cp1251', false), 'top_code' => '<img src="' . $this->getStaticPath($this->getUserAvatar($d['user']['avatara'], true)) . '" alt="' . htmlspecialchars($d['user']['nick']) . '" class="avaProfile">', 'header_small' => '������� ������������'));
$online = new VPA_online($d['user']);
$online = $online->cache_get_online();
$blackLsit = BlackListFactory::getBlackListForUser($d['cuser']['id']);
?>
<div id="contentWrapper" class="twoCols">
	<div id="content">
		<ul class="menu">
			<?$rating = $p['rating']->_class($d['user']['rating']);?>
			<li class="rating">
				<div class="userRating <?=$rating['class']?>" title="<?=$d['user']['rating']?>">
					<div class="rating <?=$rating['stars']?>"></div>
					<span><?=$d['user']['rating']?> <?=$rating['name']?> <?=($online ? '������' : null)?></span>
				</div>
			</li>
			<li class="active"><a rel="nofollow" href="/profile/<?=$d['user']['id']?>">�������</a></li>
			<li><a href="/user/<?=$d['user']['id']?>/friends">������</a></li>
			<li><a href="/user/<?=$d['user']['id']?>/persons">�������</a></li>
			<?if ($p['query']->get_num('profile_pix', array('uid'=>$d['user']['id'])) > 0) {?>
			<li><a href="/user/<?=$d['user']['id']?>/photos">����������</a></li>
			<?}?>
			<li><a href="/user/<?=$d['user']['id']?>/guestbook">��������</a></li>
			<li><a href="/user/<?=$d['user']['id']?>/gifts">�������</a></li>
			<li><a href="/user/<?=$d['user']['id']?>/wrote">�����</a></li>
			<li><a href="/user/<?=$d['user']['id']?>/community/groups">������</a></li>
			<li><a href="/user/<?=$d['user']['id']?>/sets">your.style</a></li>
		</ul>
		<?if (!empty($d['user']['credo'])) {?>
		<h2><strong>�����: </strong><?=substr($d['user']['credo'], 0, 300)?></h2>
		<?}?>
		<div class="userDetails">
			<div class="questionnaire">
				<dl class="questionnaire">
					<dt>������</dt>
					<dd><?=$d['user']['country']?></dd>
				</dl>
				<dl class="questionnaire">
					<dt>�����</dt>
					<dd><?
						$ct = array_shift($p['query']->get('cities', array('name'=>$d['user']['city']), null, 0, 1));
						if (!empty($ct)) {
							echo $d['user']['city'];
						}
						?></dd>
				</dl>
				<dl class="questionnaire">
					<dt>���</dt>
					<dd><?=($d['user']['sex'] == 0 ? '�� ������' : ($d['user']['sex'] == 1 ? '�������' : '�������'))?></dd>
				</dl>
				<?if ($d['user']['show_bd'] == 1) {?>
				<dl class="questionnaire">
					<dt>���� ��������</dt>
					<dd><?=substr($d['user']['birthday'], 6, 2) . '.' . substr($d['user']['birthday'], 4, 2) . '.' . substr($d['user']['birthday'], 0, 4)?></dd>
				</dl>
				<?}?>
				<dl class="questionnaire">
					<dt>�����</dt>
					<dd><?=($d['user']['sex'] == 1 ? ($d['user']['family'] == 1 ? '�����' : '������') : ($d['user']['family'] == 1 ? '�������' : '�� �������'))?></dd>
				</dl>
				<dl class="questionnaire">
					<dt>� �����<?$d['user']['sex'] == 1 ? '' : 'a';?> �� ����������� �</dt>
					<dd>
						<? if (!empty($d['user']['meet_actor']) && ($star = array_shift($p['query']->get('persons', array('id'=>$d['user']['meet_actor']), null, 0, 1))) && !empty($star)) {?>
						<a href="/tag/<?=$star['id']?>"><?=$star['name']?></a>
						<?}?>
					</dd>
				</dl>
				<?if (!$online) {?>
				<dl class="questionnaire">
					<dt>��������� �����</dt>
					<dd><?=$p['date']->unixtime($d['user']['ldate'], "%d %F %Y, %H:%i")?></dd>
				</dl>
				<?}?>
			</div>
			<div class="actions">
				<?
				$n_f = $p['query']->get_num('user_friends_optimized', array('uid'=>$d['cuser']['id'], 'fid' => $d['user']['id']));
				if (!$n_f) {
				?>
				<a class="addToFriends" href="#" onclick="c_add_friend(<?=$d['user']['id']?>);">�������� � ������</a><br />
				<?}?>
				<a class="writeInGuestbook" href="/user/<?=$d['user']['id']?>/guestbook#form">�������� � ��������</a><br />
				<a class="pMessage" rel="nofollow" href="/profile/<?=$d['cuser']['id']?>/add_msg/<?=$d['user']['id']?>">������ ���������</a><br />
				<a class="sendGift" rel="nofollow" href="/profile/<?=$d['cuser']['id']?>/gifts/<?=$d['user']['id']?>">��������� �������</a><br />
                <?php if(!$this->checkModer($d['user']['email']) && $d['user']['id'] != 57) { ?>
                    <?php if($blackLsit->isUserExists($d['user']['id'])) { ?>
                    <a rel="nofollow" href="/profile/<?=$d['cuser']['id'];?>/unblock/<?=$d['user']['id'];?>">��������������</a><br />
                    <?php } else { ?>
                    <a rel="nofollow" href="/profile/<?=$d['cuser']['id'];?>/block/<?=$d['user']['id'];?>">�������������</a><br />
                    <?php } ?>
                <?php } ?>
				<?php if($this->isModer() && $d['user']['banned'] != 1) { ?>
				<a href="/ban_user/<?=$d['user']['id']?>">��������</a><br />
				<?php } ?>
			</div>
		</div>
		<div class="content">
			<div class="irh irhGB">
				<div class="irhContainer">
					<h3>��������<a href="/user/<?=$d['user']['id']?>/guestbook" class="replacer"></a></h3>
					<span class="counter"><a href="/user/<?=$d['user']['id']?>/guestbook"><?=$p['query']->get_num('user_msgs', array('private'=>0, 'uid'=>$d['user']['id']))?></a></span>
				</div>
				<div class="trackContainer pMessagesTrack">
					<?foreach ($p['query']->get('public_msgs', array('uid'=>$d['user']['id'], 'pid'=>0), array('cdate desc'), 0, 15) as $i => $msg) {?>
					<div class="trackItem">
                        <style>
                            div.entry img {max-width: 374px;}
                        </style>
						<div class="entry">
							<p><?=$this->preg_repl($p['nc']->get($msg['content']))?></p>
						</div>
						<a rel="nofollow" href="/profile/<?=$msg['aid'];?>" class="ava"><img alt="" src="<?=$this->getStaticPath($this->getUserAvatar($msg['avatara']))?>" /></a>
						<div class="details">
							<a class="pc-user" rel="nofollow" href="/profile/<?=$msg['aid']?>"><?=htmlspecialchars($msg['nick'], ENT_IGNORE, 'cp1251', false);?></a>
							<span class="date"><?=$p['date']->unixtime($msg['cdate'], "%d %F %Y, %H:%i")?></span>
							<?$rating = $p['rating']->_class($msg['user_rating']);?>
							<div class="userRating <?=$rating['class']?>" title="<?=$msg['user_rating']?>">
								<div class="rating <?=$rating['stars']?>"></div>
								<span><?=$msg['user_rating']?></span>
							</div>
						</div>
					</div>
					<?}?>
					<a href="/user/<?=$d['user']['id']?>/guestbook#form" class="new">�������� � ��������</a>
				</div>
			</div>
		</div>
		<div class="contentSidebar">
			<?
			$gift = $p['query']->get('user_gifts_send', array('uid' => $d['user']['id']), array('gifts.id DESC'), 0, 1);
			if (!empty($gift)) $gift = $gift[0];
			if (!empty($gift)) {
			?>
			<div class="irh irhGifts csbDiv">
				<div class="irhContainer">
					<h3>�������<a rel="nofollow" href="/profile/<?=$d['user']['id']?>/gifts" class="replacer"></a></h3>
					<span class="counter"><a rel="nofollow" href="/profile/<?=$d['user']['id']?>/gifts"><?=$p['query']->get_num('user_gifts_send', array('uid'=>$d['user']['id']))?></a></span>
				</div>
				<div id="gift">
					<?if ($gift['amount'] == 0) {?>
					<img src="/gifts/<?=$gift['small_pic']?>" alt="">
					<?} else {?>
					<script type="text/javascript" src="/js/swfobject.js"></script>
					<script type="text/javascript">
						var realEstate = new SWFObject('/gifts/<?=$gift['gift_pic']?>', "gift", "125", "125", "9.0.0");
						realEstate.addParam("wmode","transparent");
						realEstate.write("gift");
					</script>
					<?}?>
				</div>
			</div>
			<?
			}

			$num_friends = $p['query']->get_num('user_friends_optimized', array('uid'=>$d['user']['id'], 'confirmed'=>1));
			$num_facts = $p['query']->get_num('facts', array('uid'=>$d['user']['id']));
			$num_comments = $p['query']->get_num('comments', array('user_id'=>$d['user']['id']));
			$num_cups = $p['query']->get_num('winners', array('uid'=>$d['user']['id']));
			$num_photos = $p['query']->get_num('user_pix', array('uid'=>$d['user']['id'], 'moderated'=>1));

			$awards = '';require_once 'data/libs/ui/YourStyle/YourStyle_Factory.php';
			
			if ($d['user']['activist'] > 0) $awards .= '<li class="active"><strong>' . ($d['user']['activist'] > 1?'x ' . $d['user']['activist']:'&nbsp;') . '</strong><span>�������� ������</span></li>';
			if ($num_comments >= 1000) $awards .= '<li class="thousand"><strong>' . (floor($num_comments / 1000) > 1?'x ' . floor($num_comments / 1000):'&nbsp;') . '</strong><span>1000 ���������</span></li>';
			if ($num_photos >= 100) $awards .= '<li class="photo"><strong>' . (floor($num_photos / 100) > 1?'x ' . floor($num_photos / 100):'&nbsp;') . '</strong><span>������� 100 ����</span></li>';
			if ($num_cups >= 10) $awards .= '<li class="cup"><strong>' . (floor($num_cups / 10) > 1?'x ' . floor($num_cups / 10):'&nbsp;') . '</strong><span>10 ����� � ��������</span></li>';
			if ($num_facts >= 20) $awards .= '<li class="facts"><strong>' . (floor($num_facts / 20) > 1?'x ' . floor($num_facts / 20):'&nbsp;') . '</strong><span>������� 20 ������</span></li>';
			if ($num_friends >= 50) $awards .= '<li class="friends"><strong>' . (floor($num_friends / 50) > 1?'x ' . floor($num_friends / 50):'&nbsp;') . '</strong><span>����� 50 ������</span></li>';

			if ($awards != '') {?>
			<div class="irh irhAwards csbDiv">
				<div class="irhContainer">
					<h3>�������<span class="replacer"></span></h3>
				</div>
				<ul class="awards">
				<?=$awards?>
				</ul>
			</div>
			<?}?>
			
			<div class="irh irhGroups irhCustom csbDiv">
				<div class="irhContainer">
					<h3><a href="/user/<?=$d['user']['id']?>/community/groups" class="replacer"></a></h3>
					<span class="counter"><a href="/user/<?=$d['user']['id']?>/community/groups"><?=$p['query']->get_num('community_groups_members', array('muid' => $d['user']['id'], 'confirm' => 'y'))?></a></span>
				</div>
				<ul class="groups">
					<?foreach ($p['query']->get('community_users_groups', array('muid' => $d['user']['id']), array('b.createtime desc'), 0, 10, array('a.id')) as $i => $user_group) {?>
					<li>
						<div class="details">
							<a href="/community/group/<?=$user_group['id']?>"><?=$user_group['title']?></a>
							<span><?=$user_group['membersNum']?> <?=$p['declension']->get($user_group['membersNum'], '��������', '���������', '����������')?></span>
						</div>
					</li>
					<?}?>
				</ul>
			</div>
			
			<?
			$num_friends = $p['query']->get_num('user_friends_optimized', array('uid'=>$d['user']['id'], 'confirmed'=>1));
			if ($num_friends > 0) {
			?>
			<div class="irh irhUserFriends csbDiv">
				<div class="irhContainer">
					<h3>��� ������<a href="/user/<?=$d['user']['id']?>/friends" class="replacer"></a></h3>
					<span class="counter"><a href="/user/<?=$d['user']['id']?>/friends"><?=$num_friends?></a></span>
				</div>
				<ul class="friends equalsContainer">
					<?
					$friends = $p['query']->get('user_friends_optimized', array('uid'=>$d['user']['id'], 'confirmed'=>1), null, 0, 9);
					$cf = count($friends);
					if ($cf > 3 && $cf < 6) $friends = array_slice($friends, 0, 3);
					if ($cf > 6 && $cf < 9) $friends = array_slice($friends, 0, 6);
					foreach ($friends as $i => $person) {
					?>
					<li><a rel="nofollow" href="/profile/<?=$person['fid']?>"><img alt="" src="<?=$this->getStaticPath($this->getUserAvatar($person['avatara']))?>" /></a></li>
					<?}?>
				</ul>
			</div>
			<?}?>
			<?$photos = $p['query']->get_num('profile_pix', array('uid'=>$d['user']['id']));
			if ($photos > 0) {?>
			<div class="irh irhPhotos scbDiv">
				<div class="irhContainer">
					<?
					$imgi = array_shift($p['query']->get('profile_pix', array('uid'=>$d['user']['id']), array('cdate desc'), 0, 1));
					?>
					<h3>��� �����<a href="/user/<?=$d['user']['id']?>/photos" class="replacer"></a></h3>
					<span class="counter"><a href="/user/<?=$d['user']['id']?>/photos"><?=$photos?></a></span>
				</div>
				<a href="/user/<?=$d['user']['id']?>/photos" class="myPhoto"><img alt="" src="<?=$this->getStaticPath($this->getUserPhoto($imgi['filename']))?>" /></a>
			</div>
			<?}?>
			<?php 
			$sets_num = $p['query']->get_num('yourstyle_sets', array('uid' => $d['user']['id'], 'isDraft' => 'n'));
			if($sets_num > 0) {			
			 ?>
			<div class="irh irhStyles scbDiv">
				<div class="irhContainer">
				<?php
				    if($sets_num > 0) {
				        $set = $p['query']->get('yourstyle_sets', array('uid'=>$d['user']['id'], 'isDraft' => 'n'), array('createtime desc'), 0, 1);
				    } else {
				        $set['image'] = null;
				    }
				    $set = $set[0];
				?>
					<h3>����<a rel="nofollow" href="/user/<?=$d['user']['id']?>/sets" class="replacer"></a></h3>
					<span class="counter"><a rel="nofollow" href="/user/<?=$d['user']['id']?>/sets"><?=$sets_num?></a></span>
				</div>
				<a rel="nofollow" href="/yourstyle/set/<?=$set['id'];?>/" class="myPhoto"><img alt="" src="<?=$p['ys']::getWwwUploadSetPath($set['id'], $set['image'], '150x150')?>" /></a>				
			</div>
			<?php } ?>
		</div>
	</div>
	<?$this->_render('inc_right_column');?>
</div>
<?$this->_render('inc_footer');?>