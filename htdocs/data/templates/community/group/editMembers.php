<?$this->_render('inc_header', array('title' => '��������� ������ - ' . htmlspecialchars($d['group']['title']), 'header' => '��������� ������', 'top_code' => 'C', 'header_small' => $d['group']['title'], 'js' => array('Community.js')));?>
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
			<li><a href="/community/group/<?=$d['group']['id']?>/invites">����������</a></li>
			<li class="active"><a href="/community/group/<?=$d['group']['id']?>/editMembers">������������� ������</a><span class="marked"><?=$d['newMembersNum']?></a></li>
			<?}?>
		</ul>
		
		<?if ($d['members']) {?>
		<table class="contentUsersTable membersUsersTable">
			<tr>
				<th class="user">������������</th>
				<th class="actions">&nbsp;</th>
			</tr>
			<?foreach ($d['members'] as $i => $user) {?>
			<tr>
				<td class="user">
					<a rel="nofollow" href="/profile/<?=$user['id']?>" class="ava"><img alt="" src="<?=$this->getStaticPath($this->getUserAvatar($user['avatara']))?>" /></a>
					<a rel="nofollow" href="/profile/<?=$user['id']?>"><span><?=htmlspecialchars($user['nick'], ENT_IGNORE, 'cp1251', false);?></span></a>
					<?if ($user['confirm'] == 'n' && $user['request'] == 'y') {?><small>[���� �������������]</small><?}?>
					<?if ($user['confirm'] == 'n' && $user['request'] == 'n') {?><small>[�� ������������]</small><?}?>
				</td>
				<td class="actions">
					<?if ($user['request'] == 'n' && $user['confirm'] == 'n') {?>
					<a href="/community/group/<?=$d['group']['id']?>/member/delete/<?=$user['id']?>" onclick="community.deleteMember(event);">�������� �����������</a>
					<?}?>
					
					<?if ($user['request'] == 'y' && $user['confirm'] == 'n') {?>
					<a href="/community/group/<?=$d['group']['id']?>/member/add/<?=$user['id']?>" onclick="community.addMember(event);">����������</a><br />
					<a href="/community/group/<?=$d['group']['id']?>/member/delete/<?=$user['id']?>" onclick="community.deleteMember(event);">��������</a>
					<?}?>
					<?if ($user['confirm'] == 'y') {?>
					<a href="/community/group/<?=$d['group']['id']?>/member/delete/<?=$user['id']?>" onclick="community.deleteMember(event);">�������</a><br />
					<?}?>
					
					<?if ($user['id'] != $d['group']['uid']) {?>
					<?if ($user['confirm'] == 'y' && !$user['assistant']) {?>
					<a href="/community/group/<?=$d['group']['id']?>/assistant/add/<?=$user['id']?>" onclick="community.addAssistant(event);">��������� �����������</a>
					<?}?>
					<?if ($user['assistant']) {?>
					<a href="/community/group/<?=$d['group']['id']?>/assistant/delete/<?=$user['id']?>" onclick="community.deleteAssistant(event);">������ �� �����������</a>
					<?}?>
					<?}?>
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
					<a href="/community/group/<?=$d['group']['id']?>/editMembers/page/<?=$pi['link']?>"><?=$pi['text']?></a>
					<?} else {?>
					<?=$pi['text']?>
					<?}?>
				</li>
				<?}?>
			</ul>
		</div>
		<?} else {?>
		<h4>� ���� ������ ��� ��� �� ������ ���������</h4>
		<?}?>
	</div>
	<?$this->_render('inc_right_column');?>
</div>
<?$this->_render('inc_footer');?>