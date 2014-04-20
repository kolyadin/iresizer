<?$this->_render('inc_header', array('title' => '������', 'header' => '������', 'top_code' => 'C', 'js' => 'Community.js'));?>
<div id="contentWrapper" class="twoCols">
	<div id="content">
		<ul class="menu">
			<li><a href="/community/groups">�������</a></li>
			<li><a href="/community/groups/top">����������</a></li>
			<li><a href="/community/groups/new">�����</a></li>
			<li class="active"><a href="/community/groups/tags">����</a></li>
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
		
		<div class="tags">
			<div class="h3"><img src="/img/c23.gif" alt="����" /></div>
			<ul class="tagCloud">
				<?foreach ($d['communityTags'] as $tag) {?>
				<li class="<?=$tag['class']?>"><a href="/community/groups/tag/<?=$tag['id']?>"><?=$tag['name']?></a></li>
				<?}?>
			</ul>
		</div>
	</div>
	<?$this->_render('inc_right_column');?>
</div>
<?$this->_render('inc_footer');?>