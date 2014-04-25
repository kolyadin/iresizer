<?$this->_render('inc_header', array('title' => '���������� ������ - ' . htmlspecialchars($d['group']['title']), 'header' => '���������� ������', 'top_code' => 'C', 'header_small' => $d['group']['title']));?>
<div id="contentWrapper" class="twoCols">
	<div id="content">
		<ul class="menu">
			<li><a href="/community/group/<?=$d['group']['id']?>">������</a></li>
			<li class="active"><a href="/community/group/<?=$d['group']['id']?>/topics">����������</a></li>
			<li><a href="/community/group/<?=$d['group']['id']?>/albums">����</a></li>
			<li><a href="/community/group/<?=$d['group']['id']?>/members">���������</a></li>
			<li><a href="/community/group/<?=$d['group']['id']?>/newsfeed">����������</a></li>
		</ul>
		<ul class="menu bLevel">
			<li class="active"><a href="/community/group/<?=$d['group']['id']?>/topics">��� ����</a></li>
			<?if ($d['isAMember']) {?>
			<li><a href="/community/group/<?=$d['group']['id']?>/topic/add">������� ����</a></li>
			<li><a href="/community/group/<?=$d['group']['id']?>/topic/addPoll">������� �����</a></li>
			<?}?>
		</ul>
		
		<?if ($d['topicsNum'] > 0) {?>
		<table class="personTalks">
			<tr>
				<th class="theme">����, ����� � <a href="/community/group/<?=$d['group']['id']?>/topics/page/<?=$d['page']?>/sort/cdate_<?=($d['sort'] == 'cdate_desc' ? 'asc' : 'desc')?>">���� ��������</a></th>
				<th class="rating"><a href="/community/group/<?=$d['group']['id']?>/topics/page/<?=$d['page']?>/sort/rating_<?=($d['sort'] == 'rating_desc' ? 'asc' : 'desc')?>">�������</a></th>
				<th class="comments"><a href="/community/group/<?=$d['group']['id']?>/topics/page/<?=$d['page']?>/sort/comment_<?=($d['sort'] == 'comment_desc' ? 'asc' : 'desc')?>">�����������</a></th>
				<th class="last"><a href="/community/group/<?=$d['group']['id']?>/topics/page/<?=$d['page']?>/sort/ldate_<?=($d['sort'] == 'ldate_desc' ? 'asc' : 'desc')?>">��������� ���������</a></th>
			</tr>
				<?foreach ($d['topics'] as $i => $topic) {?>
					<tr>
						<td class="theme">
							<a class="ava" href="/profile/<?=$topic['author_user_id']?>"><img src="<?=$this->getStaticPath($this->getUserAvatar($topic['author_user_avatara']));?>" alt="" /></a>
							<div class="details">
								<h3><a href="/community/group/<?=$d['group']['id']?>/topic/<?=$topic['id']?>"><?=(!empty($topic['title']) ?  $topic['title'] : (substr($topic['description'], 0, 200) . '...'))?></a></h3>
								�����: <a class="pc-user" rel="nofollow" href="/profile/<?=$topic['author_user_id']?>"><?=$topic['author_user_nick']?></a>, <span class="date"><?=$p['date']->unixtime($topic['createtime'], '%d %F %Y, %H:%i')?></span>
							</div>
						</td>
						<td class="rating"><span class="high"><?=$topic['rating']?></span></td>
						<td class="comments"><span class="new"><?=(int)$topic['comment']?></span></td>
						<td class="last">
						<?=($topic['last_message'] ? ('<span class="date">' . $p['date']->unixtime($topic['last_message_date'], '%d %F %Y, %H:%i') . '</span><a rel="nofollow" href="/profile/' . $topic['last_msg_user_id'] . '" class="pc-user">' . $topic['last_msg_user_nick'] . '</a></td>'):'&nbsp;')?>
						</td>
					</tr>
				<?}?>
		</table>
		
		<div class="paginator smaller">
			<p class="pages">��������:</p>
			<ul>
			<?foreach ($p['pager']->make($d['page'], $d['pages']) as $i => $pi) { ?>
				<li>
				<?if (!isset($pi['current'])) {?>
				<a href="/community/group/<?=$d['group']['id']?>/topics/page/<?=$pi['link']?>"><?=$pi['text']?></a>
				<?} else {?>
				<?=$pi['text']?>
				<?}?>
				</li>
			<?}?>
			</ul>
		</div>
		
		<?} else {?>
		<h4>� ���� ������ ��� ��� �� ������ ����������</h4>
		<?}?>
	</div>
	<?$this->_render('inc_right_column');?>
</div>
<?$this->_render('inc_footer');?>