<?$this->_render('inc_header', 
    array(
    	'title' => 'your.style', 
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
			<li><a href="/yourstyle/stars">������</a></li>
			<li class="active"><a href="/yourstyle/brands">������</a></li>
			<li><a href="/yourstyle/editor" target="_blank">�������</a></li>
			<li><a href="/yourstyle/rules">�������</a></li>
		</ul>
		<ul class="menu bLevel">
			<li><a href="/yourstyle/brands">��� ������</a></li>
			<li class="active"><a href="/yourstyle/brands/top">����������</a></li>
		</ul>
		<h2>���������� ������</h2>
		<div class="b-items-roll">
			<ul class="ys-canvas__stuff">
				<?foreach ($d['brands'] as $brand) {?>
				<li>
				    <a class="image" href="/yourstyle/brands/<?=$brand['id']?>">
				        <img src="<?=$brand['logo'];?>" />
				    </a>
				</li>
				<?}?>
			</ul>
		</div>
	</div>
	<?$this->_render('inc_right_column');?>
</div>
<?$this->_render('inc_footer');?>