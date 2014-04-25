<?
$this->_render('inc_header', array('title' => $d['user']['nick'], 'header' => htmlspecialchars($d['user']['nick']), 'top_code' => '<img src="' . $this->getStaticPath($this->getUserAvatar($d['user']['avatara'], true)) . '" alt="' . htmlspecialchars($d['user']['nick']) . '" class="avaProfile">', 'header_small' => '�������'));
?>
<div id="contentWrapper" class="twoCols">
	<div id="content">
		<ul class="menu">
			<?$rating = $p['rating']->_class($d['user']['rating']);?>
			<li class="rating">
				<div class="userRating <?=$rating['class']?>">
					<div class="rating <?=$rating['stars']?>"></div>
					<span><?=$d['user']['rating']?> <?=$rating['name']?> <?=$d['online'] ? '������' :''?></span>
				</div>
			</li>
			<li><a rel="nofollow" href="/profile/<?=$d['user']['id']?>">�������</a></li>
			<li><a href="/user/<?=$d['user']['id']?>/friends">������</a></li>
			<li class="active"><a href="/user/<?=$d['user']['id']?>/persons">�������</a></li>
			<?if ($p['query']->get_num('profile_pix', array('uid'=>$d['user']['id'])) > 0) {?>
			<li><a href="/user/<?=$d['user']['id']?>/photos">����������</a></li>
				<?}?>
			<li><a href="/user/<?=$d['user']['id']?>/guestbook">��������</a></li>
			<li><a href="/user/<?=$d['user']['id']?>/gifts">�������</a></li>
			<li><a href="/user/<?=$d['user']['id']?>/wrote">�����</a></li>
			<li><a href="/user/<?=$d['user']['id']?>/community/groups">������</a></li>
			<li><a href="/user/<?=$d['user']['id']?>/sets">your.style</a></li>
		</ul>
		<h2>������� <?=htmlspecialchars($d['user']['nick'], ENT_IGNORE, 'cp1251', false);?></h2>
		<div class="groupsContainer">
			<?foreach ($p['query']->get('persons', array('fan' => $d['user']['id']), null, null, null) as $i => $person) {
			    $link = $person['eng_name'];
			    $link = str_replace('-', '_', $link);
			    $link = str_replace('&dash;', '_', $link);
			    $link = '/persons/'.str_replace(' ', '-', $link);	
			?>
			<dl>
				<dt><a href="<?=$link;?>"><img alt="" src="<?=$this->getStaticPath('/upload/_84_120_70_' . $person['main_photo'])?>"  width="80" /></a></dt>
				<dd><a href="<?=$link;?>"><?=$person['name']?></a></dd>
			</dl>
			<?if (($i + 1) % 6 == 0) {?><div class="divider"></div><?}?>
			<?}?>
		</div>
	</div>
	<?$this->_render('inc_right_column');?>
</div>
<?$this->_render('inc_footer');?>
