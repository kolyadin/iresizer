<?$this->_render('inc_header', array('title' => '�����������', 'header' => '�����������', 'top_code' => 'C', 'header_small' => '�����������', 'js' => array('Community.js')));?>
<script type="text/javascript">
	var community = new Community();
</script>

<div id="contentWrapper" class="twoCols">
	<div id="content">
		<ul class="menu">
			<li class="active"><a href="/community/group/<?=$d['group']['id']?>">������</a></li>
			<li><a href="/community/group/<?=$d['group']['id']?>/topics">����������</a></li>
			<li><a href="/community/group/<?=$d['group']['id']?>/albums">����</a></li>
			<li><a href="/community/group/<?=$d['group']['id']?>/members">���������</a></li>
			<li><a href="/community/group/<?=$d['group']['id']?>/newsfeed">����������</a></li>
		</ul>
		<ul class="menu bLevel">
			<li><a href="/community/group/<?=$d['group']['id']?>">����������</a></li>
			<?if ($d['canModifyGroup'] || $this->isCommunityModer()) {?>
			<li><a href="/community/group/<?=$d['group']['id']?>/edit">�������������</a></li>
			<?}?>
			<?if ($d['canModifyGroup']) {?>
			<li class="active"><a href="/community/group/<?=$d['group']['id']?>/invites">����������</a></li>
			<li><a href="/community/group/<?=$d['group']['id']?>/editMembers">������������� ������</a><span class="marked"><?=$d['newMembersNum']?></a></li>
			<?}?>
		</ul>

		<?if ($d['friends']) {?>
		<table class="contentUsersTable membersUsersTable">
			<tr>
				<th class="user">������������</th>
				<th class="actions">&nbsp;</th>
			</tr>
			<?foreach ($d['friends'] as $i => $user) {?>
			<tr>
				<td class="user">
					<a rel="nofollow" href="/profile/<?=$user['id']?>" class="ava"><img alt="" src="<?=$this->getStaticPath($this->getUserAvatar($user['avatara']))?>" /></a>
					<a rel="nofollow" href="/profile/<?=$user['id']?>"><span><?=htmlspecialchars($user['nick'], ENT_IGNORE, 'cp1251', false);?></span></a>
				</td>
				<td class="actions">
					<a href="/community/group/<?=$d['group']['id']?>/member/add/<?=$user['id']?>" onclick="community.addInvite(event);">����������</a><br />
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
					<a href="/community/group/<?=$d['group']['id']?>/invites/page/<?=$pi['link']?>"><?=$pi['text']?></a>
					<?} else {?>
					<?=$pi['text']?>
					<?}?>
				</li>
				<?}?>
			</ul>
		</div>
		<?} else {?>
		<h4>
			����� ������������ ������, ������� ��� ��� � ���� ������, � ������� ��������� ���������� � ������
		</h4>
		<?}?>
	</div>

	<?$this->_render('inc_right_column');?>
</div>
<?$this->_render('inc_footer');?>