<?
$this->_render('inc_header', array('title' => $d['cuser']['nick'], 'header' => '������', 'top_code' => '<img src="' . $this->getStaticPath($this->getUserAvatar($d['cuser']['avatara'], true)) . '" alt="' . htmlspecialchars($d['cuser']['nick']) . '" class="avaProfile">', 'header_small' => '���� �������'));

$maintance = isset($d['maintace']) ? $d['maintance'] : false;

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
			<li><a rel="nofollow" href="/profile/<?=$d['cuser']['id']?>/gifts">�������</a></li>
			<li class="active"><a rel="nofollow" href="/profile/<?=$d['cuser']['id']?>/community/groups">������</a></li>
			<li><a rel="nofollow" href="/profile/<?=$d['cuser']['id']?>/sets">your.style</a></li>
			<li><a rel="nofollow" href="/games/guess_star/instructions/profile">������ ������</a></li>			
		</ul>
		<ul class="menu bLevel">
			<li><a rel="nofollow" href="/profile/<?=$d['cuser']['id']?>/community/groups">������</a></li>
			<li class="active"><a rel="nofollow" href="/profile/<?=$d['cuser']['id']?>/community/newsfeed">����������</a></li>
		</ul>
		<h2>����������</h2>

        <?php if($maintance) {

        } else {?>

		<?if ($d['num'] > 0) {?>
		<table class="group_update">
			<tbody>
			<?$i = 0; foreach ($d['items'] as &$item) { $i++ ?>
				<tr>
					<td class="first"><a name="feed_<?=$item['_id']?>" href="#feed_<?=$item['_id']?>"><?=$i?></a></td>
					<td>
					<?
					$this->assign('item', $item);
					switch ($item['_type']) {
						case 'messages':
							echo $this->make('../community/group/newsfeed/messages.php');
							break;
						case 'topics':
							echo $this->make('../community/group/newsfeed/topics.php');
							break;
						case 'albums':
							echo $this->make('../community/group/newsfeed/albums.php');
							break;
						case 'photos':
							echo $this->make('../community/group/newsfeed/photos.php');
							break;
						case 'albumsComments':
							echo $this->make('../community/group/newsfeed/albumsComments.php');
							break;
					}
					?>
					</td>
				</tr>
			<?}?>
			</tbody>
		</table>

		<div class="paginator smaller">
			<p class="pages">��������:</p>
			<ul>
			<?foreach ($p['pager']->make($d['page'], $d['pages']) as $i => $pi) { ?>
				<li>
				<?if (!isset($pi['current'])) {?>
				<a rel="nofollow" href="/profile/<?=$d['cuser']['id']?>/community/newsfeed/page/<?=$pi['link']?>"><?=$pi['text']?></a>
				<?} else {?>
				<?=$pi['text']?>
				<?}?>
				</li>
			<?}?>
			</ul>
		</div>
		<?} else {?>
		<h4>����� ����� ������������ ���������� � �������, � ������� �� ��������.</h4>
		<?}}?>
	</div>
	<?$this->_render('inc_right_column');?>
</div>
<?$this->_render('inc_footer');?>