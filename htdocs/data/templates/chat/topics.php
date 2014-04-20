<?
$this->_render('inc_header',
	array(
	    'title'=>$d['theme']['name'],
	    'header'=>$d['theme']['name'],
	    'top_code'=>'<img src="/i/chat_ico.png">',
	    'header_small'=>'�������� �� ��������� ����'
	)
);
?>
<div id="contentWrapper" class="twoCols">
	<div id="content">
		<ul class="menu">
			<li class="active"><a href="/chat/theme/<?=$d['theme']['id']?>/">��� ����������</a></li>
			<li><a href="/chat/theme/<?=$d['theme']['id']?>/messages">��� �����������</a></li>
			<li><a href="/chat/theme/<?=$d['theme']['id']?>/post">������� ����</a></li>
		</ul>
		<?if ($d['num'] > 0) {?>
		<table class="personTalks">
			<tr>
				<th class="theme">����, ����� � <a href="/chat/theme/<?=$d['theme']['id']?>/page/<?=$d['page']?>/order/<?=($d['order'] != 'cdate_desc'?'cdate_desc':'cdate')?>">���� ��������</a></th>
				<th class="rating"><a href="/chat/theme/<?=$d['theme']['id']?>/page/<?=$d['page']?>/order/<?=($d['order'] != 'rating_desc'?'rating_desc':'rating')?>">�������</a></th>
				<th class="comments"><a href="/chat/theme/<?=$d['theme']['id']?>/page/<?=$d['page']?>/order/<?=($d['order'] != 'comment_desc'?'comment_desc':'comment')?>">�����������</a></th>
				<th class="last" style="text-align: left;"><a href="/chat/theme/<?=$d['theme']['id']?>/page/<?=$d['page']?>/order/<?=($d['order'] != 'ldate_desc'?'ldate_desc':'ldate')?>">��������� ���������</a></th>
			</tr>
			<?foreach ($d['topics'] as $topic) {?>
			<tr>
				<td class="theme">
					<a class="ava"><img src="<?=$this->getStaticPath($this->getUserAvatar($topic['author_user_avatara']))?>" /></a>
					<div class="details">
						<h3><a href="/chat/theme/<?=$d['theme']['id']?>/topic/<?=$topic['id']?>"><?=(!empty($topic['name']) ?  $topic['name'] : (substr($topic['content'], 0, 200) . '...'))?></a></h3>
						�����: <a class="pc-user" rel="nofollow" href="/profile/<?=$topic['author_user_id']?>"><?=$topic['author_user_nick']?></a>, <span class="date"><?=$p['date']->unixtime($topic['cdate'], '%d %F %Y, %H:%i')?></span>
					</div>
				</td>
				<td class="rating"><span class="high"><?=$topic['rating']?></span></td>
				<td class="comments"><span class="new"><?=intval($topic['comment'])?></span></td>
				<td class="last" style="white-space: normal;">
				<?=(intval($topic['last_comment']) > 0 ? ('<span class="date">' . $p['date']->unixtime($topic['ldate'], '%d %F %Y, %H:%i') . '</span><a rel="nofollow" href="/profile/' . $topic['last_msg_user_id'] . '" class="pc-user">' . $topic['last_msg_user_nick'] . '</a></td>'):'&nbsp;')?>
			</tr>
			<?}?>
		</table>
		<div class="paginator smaller">
			<p class="pages">��������:</p>
			<ul>
			<?foreach ($p['pager']->make($d['page'], $d['pages'], 10) as $i => $pi) { ?>
				<li>
				<?if (!isset($pi['current'])) {?>
				<a href="/chat/theme/<?=$d['theme']['id']?>/page/<?=$pi['link']?>/order/<?=str_replace(" ", "_", $d['order'])?>"><?=$pi['text']?></a>
				<?} else {?>
				<?=$pi['text']?>
				<?}?>
				</li>
			<?}?>
			</ul>
		</div>
		<?} else { ?>
		<strong class="no_info">���� ���������� ���. <a href="/chat/theme/<?=$d['theme']['id']?>/post">������ ���� !</a></strong>
	<?}?>
	</div>
	<?$this->_render('inc_right_column');?>
</div>
<?$this->_render('inc_footer');?>
