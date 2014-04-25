<?$this->_render('inc_header', 
    array(
    	'title' => 'your.style - ����', 
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
			<li class="active"><a href="/yourstyle/groups">����</a></li>
			<li><a href="/yourstyle/stars">������</a></li>
			<li><a href="/yourstyle/brands">������</a></li>
			<li><a href="/yourstyle/editor" target="_blank">�������</a></li>
			<li><a href="/yourstyle/rules">�������</a></li>
		</ul>
		<ul class="menu bLevel">
			<li class="active"><a href="/yourstyle/groups">��� ����</a></li>
			<li><a href="/yourstyle/tiles/top">����������</a></li>
		</ul>

		<h2>��� ����</h2>
		<?php $this->_render('filterPanel', array('rootGroups' => $d['rootGroups'], 'groups' => $d['groups'], 'brands' => $d['brands'], 'colors' => $d['colors'], 'filters' => $filters)); ?>
		<div class="b-items-roll">
			<ul class="ys-canvas__stuff">
				<?foreach ($d['rootGroups'] as $rootGroup) { if(count($rootGroup['groups']) > 0) { ?>
				<li>
					<a class="image" href="/yourstyle/rootGroup/<?=$rootGroup['id']?>"><img src="<?=$p['ys']::getWwwUploadTilesPath($rootGroup['tile']['gid'], $rootGroup['tile']['image'], '100x100')?>" /></a>
					<a href="/yourstyle/rootGroup/<?=$rootGroup['id']?>"><?=$rootGroup['title']?></a>
				</li>
				<?}}?>
			</ul>
		</div>
	</div>
	<?$this->_render('inc_right_column');?>
</div>
<?$this->_render('inc_footer');?>