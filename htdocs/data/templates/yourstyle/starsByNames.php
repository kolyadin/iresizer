<?$this->_render('inc_header', 
    array(
    	'title' => 'your.style - ���� �� ��������', 
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
			<li><a href="/yourstyle/stars">�����</a></li>
			<li class="active"><a href="/yourstyle/stars/byName">�� �����</a></li>
		</ul>
		<h2>���� �� ��������</h2>

		<div class="b-cols b-cols-3 b-ys-content">
			<?foreach ($d['starsByNames3Cols'] as $starsByNames) {?>
			<div class="b-cols__col">
				<?foreach ($starsByNames as $letter => $stars) {?>
				<dl class="b-alpha-list b-stars-list">
					<dt class="b-alpha-list__letter"><?=$letter?></dt>
					<?foreach ($stars as $star) {
					    $link = $star['eng_name'];
					    $link = str_replace('-', '_', $link);
					    $link = str_replace('&dash;', '_', $link);
					    $link = '/persons/'.str_replace(' ', '-', $link).'/sets';
					?>
					<dd><a href="<?=$link;?>"><?=$star['name']?></a></dd>
					<?}?>
				</dl>
				<?}?>
			</div>
			<?}?>
		</div>
	</div>
	<?$this->_render('inc_right_column');?>
</div>
<?$this->_render('inc_footer');?>