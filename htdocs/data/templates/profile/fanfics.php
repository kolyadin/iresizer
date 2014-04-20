<?
$this->_render('inc_header', array('title'=>$d['cuser']['nick'], 'header'=>'�������', 'top_code'=>'<img src="' . $this->getStaticPath($this->getUserAvatar($d['cuser']['avatara'], true)) . '" alt="' . htmlspecialchars($d['cuser']['nick']) . '" class="avaProfile">', 'header_small'=>'���� �������'));
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
			<li class="active"><a rel="nofollow" href="/profile/<?=$d['cuser']['id']?>/fanfics">�������</a></li>
			<li><a rel="nofollow" href="/profile/<?=$d['cuser']['id']?>/gifts">�������</a></li>
			<li><a rel="nofollow" href="/profile/<?=$d['cuser']['id']?>/community/groups">������</a></li>
			<li><a rel="nofollow" href="/profile/<?=$d['cuser']['id']?>/sets">your.style</a></li>
			<li><a rel="nofollow" href="/games/guess_star/instructions/profile">������ ������</a></li>			
		</ul>
		<ul class="menu bLevel">
			<li class="active"><a rel="nofollow" href="/profile/<?=$d['cuser']['id']?>/fanfics/all">��� �������</a></li>
			<li><a rel="nofollow" href="/profile/<?=$d['cuser']['id']?>/fanfics/add">��������</a></li>
		</ul>
		<h2>�������</h2>
		<div class="trackContainer fanficsTrack commentsTrack">
			<?foreach ($d['fanfics_data'] as $value) {?>
			<div class="trackItem">
				<h3><a href="/persons/<?=str_replace(' ', '-', $value['eng_name']);?>/fanfics/<?=$value['id'];?>"><?=$value['name'];?></a></h3>
				<?if ($value['attachment']) {?>
				<div class="picture"><img src="<?=$this->getStaticPath('/upload/'. $value['attachment']);?>" alt="" /></div>
				<?}?>
				<div class="entry">
					<p><?=$value['announce'];?></p>
				</div>
				<div class="newsMeta fanficMeta">
					<span class="comments"><a href="/persons/<?=str_replace(' ', '-', $value['eng_name']);?>/fanfics/<?=$value['id'];?>#comments">������������ <?=($value['num_comments'] ? $value['num_comments'] : 0);?></a></span>
					<span class="views">���������� <?=($value['num_views'] ? $value['num_views'] : 0);?></span><br />
					<span class="date"><?=$value['time_create'];?></span>
					<span class="user">
						<h5><a href="/persons/<?=str_replace(' ', '-', $value['eng_name']);?>"><?=$value['artist_name']?></a></h5>
					</span>
					<span class="rating">
						�����������?
						<span class="like">�� (<?=$value['num_like'];?>)</span>
						<span class="dislike">��� (<?=$value['num_dislike'];?>)</span>
					</span>
				</div>
			</div>
				<?}?>
		</div>
		<div class="paginator smaller">
			<p class="pages">��������:</p>
			<ul>
				<?foreach ($p['pager']->make($d['page'], $d['pages'], 10) as $i => $pi) { ?>
				<li>
					<?if (!isset($pi['current'])) {?>
					<a rel="nofollow" href="/profile/<?=$d['cuser']['id']?>/fanfics/page/<?=$pi['link']?>"><?=$pi['text']?></a>
					<?} else {?>
					<?=$pi['text']?>
					<?}?>
				</li>
				<?}?>
			</ul>
		</div>
	</div>
	<?$this->_render('inc_right_column');?>
</div>
<?$this->_render('inc_footer');?>