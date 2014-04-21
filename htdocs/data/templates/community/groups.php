<?$this->_render('inc_header', array('title' => '������', 'header' => '������', 'top_code' => 'C', 'js' => 'Community.js'));?>
<div id="contentWrapper" class="twoCols">
	<div id="content">
		<ul class="menu">
			<li class="active"><a href="/community/groups">�������</a></li>
			<li><a href="/community/groups/top">����������</a></li>
			<li><a href="/community/groups/new">�����</a></li>
			<li><a href="/community/groups/tags">����</a></li>
			<li><a href="/community/group/add">������� ������</a></li>
			<li><a href="/community/groups/rules">�������</a></li>
		</ul>
		<form name="groupsSearch" method="get" action="/community/groups/search/" class="searchbox">
			<fieldset>
				<label>
					����� ������
					<input type="text" name="q" />
				</label>
				<input type="submit" value="�����">
			</fieldset>
		</form>
		<script type="text/javascript">
			var c = new Community();
			c.searchInit();
		</script>
		
		<div class="groups">
			<div class="h3"><img src="/img/c21.gif" alt="���������� ������" /></div>
			<?foreach ($d['topGroups'] as &$group) {?>
			<dl class="group">
				<dt>
					<?if ($group['image']) {?>
					<a href="/community/group/<?=$group['id']?>" rel="nofollow"><img alt="" src="<?=$this->getStaticPath(Community::getWWWAvatarPath($group['image']))?>" /></a>
					<?} else {?>
					&nbsp;
					<?}?>
				</dt>
				<dd>
					<a class="h3" href="/community/group/<?=$group['id']?>" rel="nofollow"><?=$group['title']?></a>
					<p><?=$this->limit_text($group['description'], 600)?></p>
					<p class="tags"><noindex>
						<span>����:</span>
						<?$i = 0; foreach ($group['tags'] as &$tag) { $i++; ?>
						<a href="/<?=($tag['type'] == 'events' ? 'event' : 'tag')?>/<?=$tag['id']?>" rel="nofollow"><?=$tag['name']?></a><?=($i != count($group['tags']) ? ', ': null)?>
						<?}?>
						</noindex>
					</p>
					<noindex><span class="date">������� <?=$p['date']->unixtime($group['createtime'], '%d %F %Y')?></span></noindex>
					<span class="participant"><?=$group['members']?> <?=$p['declension']->get($group['members'], '��������', '���������', '����������')?></span>
				</dd>
			</dl>
			<?}?>
			<div class="new">
				<div class="h3"><img src="/img/c22.gif" alt="����� ������" /></div>
				<table>
					<tbody>
						<?foreach ($d['newGroups'] as $i => &$group) {?>
						<?if ($i % 2 == 0) {?><tr><?}?>
							<td><a href="/community/group/<?=$group['id']?>" rel="nofollow"><img src="<?=$this->getStaticPath(Community::getWWWAvatarPath($group['image']))?>" alt="" /><?=$group['title']?></a></td>
						<?if ($i % 2 == 1) {?></tr><?}?>
						<?}?>
					</tbody>
				</table>
			</div>
			<div class="tags"><noindex>
				<div class="h3"><img src="/img/c23.gif" alt="����" /></div>
				<ul class="tagCloud">
					<?foreach ($d['communityTags'] as $tag) {?>
					<li class="<?=$tag['class']?>"><a href="/community/groups/tag/<?=$tag['id']?>" rel="nofollow"><?=$tag['name']?></a></li>
					<?}?>
				</ul>
				</noindex>
			</div>
		</div>
	</div>
	<?$this->_render('inc_right_column');?>
</div>
<?$this->_render('inc_footer');?>