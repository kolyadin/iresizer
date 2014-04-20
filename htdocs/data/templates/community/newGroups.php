<?$this->_render('inc_header', array('title' => '������', 'header' => '������', 'top_code' => 'C', 'js' => 'Community.js'));?>
<div id="contentWrapper" class="twoCols">
	<div id="content">
		<ul class="menu">
			<li><a href="/community/groups">�������</a></li>
			<li><a href="/community/groups/top">����������</a></li>
			<li class="active"><a href="/community/groups/new">�����</a></li>
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
			<div class="h3"><img src="/img/c22.gif" alt="����� ������" /></div>
			<?foreach ($d['newGroups'] as &$group) {?>
			<dl class="group">
				<dt>
					<?if ($group['image']) {?>
					<a href="/community/group/<?=$group['id']?>"><img alt="" src="<?=$this->getStaticPath(Community::getWWWAvatarPath($group['image']))?>" /></a>
					<?} else {?>
					&nbsp;
					<?}?>
				</dt>
				<dd>
					<a class="h3" href="/community/group/<?=$group['id']?>"><?=$group['title']?></a>
					<p><?=$this->limit_text($group['description'], 600)?></p>
					<span class="date">������� <?=$p['date']->unixtime($group['createtime'], '%d %F %Y')?></span>
				</dd>
			</dl>
			<?}?>
		</div>
	</div>
	<?$this->_render('inc_right_column');?>
</div>
<?$this->_render('inc_footer');?>