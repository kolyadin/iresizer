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
);
$filters = array();
?>
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
			<li><a href="/yourstyle/groups">��� ����</a></li>
			<li class="active"><a href="/yourstyle/tiles/top">����������</a></li>
		</ul>

		<div class="irh irhContainer irhPopularItems">
			<h3><a class="replacer" href="/yourstyle/tiles/top"></a>���������� ����</h3>
		</div>
		<?php 
		$this->_render('filterPanel', 
		    array(
		    	'rootGroups' => $d['rootGroups'], 
		    	'groups' => $d['groups'], 
		    	'brands' => $d['brands'], 
		    	'colors' => $d['colors'], 
		    	'filters' => $filters,
		        'action_path' => '/yourstyle/tiles/top/filtered/'
		    )
		); 
		
		if(count($d['topTiles']) > 0) {
		$i = 0;
	    ?>
        <table class="b-items-roll b-items-roll-category"><tbody>
        <?php foreach ($d['topTiles'] as $tile) { ?>
            <?php if(($i % 3) == 0) { ?>
            <tr>
            <?php } ?>
                <td style="width:33%;">
                    <a href="/yourstyle/tile/<?=$tile['id']?>" class="item-image"><img src="<?=$p['ys']::getWwwUploadTilesPath($tile['gid'], $tile['image'], '150x150')?>"></a>
                    <h3><a href="/yourstyle/tile/<?=$tile['id']?>"><?=ucfirst($tile['groupTitle']);?> - <?=$tile['brand']?></a></h3>
                    <div class="controls">
                        <span>��������:</span>
                        <a href="/yourstyle/editor/withTile/<?=$tile['id']?>">� ���</a>
                        <span class="border">|</span>
                        <a onclick="ys.tilesToFromMy(event);" href="/yourstyle/tile/<?=$tile['id']?>/toMy">� ��� ����</a>
                    </div>
                </td>
            <?php if(($i % 3) == 2) { ?>
            <tr>
            <?php } $i++; ?>
        <?php } ?>
        </tbody></table>	    
		<?php } else { ?>
		<h4>������ �� �������</h4>
		<?php } ?>
	</div>
	<?$this->_render('inc_right_column');?>
</div>
<?$this->_render('inc_footer');?>