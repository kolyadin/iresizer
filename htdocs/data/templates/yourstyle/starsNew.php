<?$this->_render('inc_header', 
    array(
    	'title' => 'your.style - ����� ���� �� ��������', 
    	'header' => 'your.style', 
    	'top_code' => '<img src="' . $this->getStaticPath($this->getUserAvatar($d['cuser']['avatara'], true)) . '" alt="' . $d['cuser']['nick'] . '" class="avaProfile">', 
    	'header_small' => '', 
    	'css' => 'ys.css?d=26.03.12', 
    	'js' => 'YourStyle.js?d=26.03.12',
        'yourstyleRating' => $d['yourStyleUserRating'],
    )
);?>
<div id="contentWrapper" class="twoCols">
	<div id="content">
		<ul class="menu">
			<li><a href="/yourstyle">your.style</a></li>
			<li><a href="/yourstyle/sets">����</a></li>
			<li><a href="/yourstyle/groups">����</a></li>
			<li class="active"><a href="/yourstyle/stars">������</a></li>
			<li><a href="/yourstyle/brands">������</a></li>
			<li><a href="/yourstyle/editor" target="_blank">�������</a></li>
			<li><a href="/yourstyle/rules">�������</a></li>
		</ul>
		<ul class="menu bLevel">
			<li class="active"><a href="/yourstyle/stars">�����</a></li>
			<li><a href="/yourstyle/stars/byName">�� �����</a></li>
		</ul>
		<h2>���� �� ��������</h2>
		
		<form action="/yourstyle/stars" method="post" class="searchbox">
			<input type="hidden" name="type" value="yourstyle">
			<input type="hidden" name="action" value="stars">
			<fieldset>
				<label>
					����� �� �����
				    <input type="text" name="search" value="<?=$d['search'];?>" class="suggest" onclick="return {url:'/yourstyle/stars_search/'}"/>
				</label>
			    <input type="submit" value="�����" />
		    </fieldset>
		</form>
				
		<?php
		if(count($d['stars']) > 0) {		    
		    foreach ($d['stars'] as $star) {
		?>
		
		<a href="/persons/<?=$star['link'];?>/sets" class="title1"><?=$star['name'];?></a><span class="counter ver2"><a href="/persons/<?=$star['link'];?>/sets"><?=$star['setsCount'];?></a></span>
        <div class="clear"></div>
		<ul class="b-sets-roll b-sets-roll_full">
		    <?php foreach ($star['sets'] as $set) { ?>
			<li class="b-sets-roll__set">
				<a class="set-image" href="/yourstyle/set/<?=$set['id'];?>"><img src="<?=$set['image'];?>" /></a>
				<h2><a href="/yourstyle/set/<?=$set['id'];?>"><?=$set['title'];?></a></h2>
				<div class="b-meta">
                    <span class="votes-count"><?=$set['votes'];?> <?=$p['declension']->get($set['votes'], '�����', '������', '�������');?></span>
                    <a class="comments-count" href="/yourstyle/set/<?=$set['id'];?>#comments"><?=$set['comments'];?> <?=$p['declension']->get($set['comments'], '�����������', '�����������', '������������');?></a>,
                    <a class="username" href="/profile/<?=$set['uid'];?>"><?=$set['unick'];?></a>
                    <span class="sub_rating"><?=$set['urating'];?></span>
				</div>
			</li>
			<?php } ?>
        </ul>
		
		<?php }
		} else { if(!is_null($d['search'])) { ?>
		<h4>������ �� �������</h4>
		<?php }} ?>
		
		<?php if($d['pages'] > 1) { ?>
		<div class="paginator smaller">
			<p class="pages">��������:</p>
			<ul>
			<?
			$searchLink = is_null($d['search']) ? "" : "?search={$d['search']}";
			foreach ($p['pager']->make($d['page'], $d['pages']) as $i => $pi) { ?>
				<li>
				<?if (!isset($pi['current'])) {?>
				<? if($pi['link'] == 1) { ?>
				<a href="/yourstyle/stars<?=$searchLink;?>"><?=$pi['text']?></a>
				<? } else {?>
				<a href="/yourstyle/stars/<?=$pi['link']?><?=$searchLink;?>"><?=$pi['text']?></a>				
				<?}} else {?>
				<?=$pi['text']?>
				<?}?>
				</li>
			<?}?>
			</ul>
		</div>
		<?php } ?>
		
	</div>
	<?$this->_render('inc_right_column');?>
</div>
<?$this->_render('inc_footer');?>