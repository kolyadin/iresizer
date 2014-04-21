<?$this->_render('inc_header', array('title' => '����� ������', 'header' => '����� ������', 'top_code' => 'C', 'header_small' => '����� ������'));?>
<div id="contentWrapper" class="twoCols">
	<div id="content">
		<ul class="menu">
			<li><a href="/community/groups">�������</a></li>
			<li><a href="/community/groups/top">����������</a></li>
			<li><a href="/community/groups/new">�����</a></li>
			<li><a href="/community/groups/tags">����</a></li>
			<li class="active"><a href="/community/group/add">������� ������</a></li>
			<li><a href="/community/groups/rules">�������</a></li>
		</ul>
		<?if (isset($d['error'])) {?><h4><?=$d['error']?></h4><?}?>
		<form id="group_new" class="group_new" method="post" enctype="multipart/form-data">
			<input type="hidden" name="type" value="community" />

			<h5>�������� ������</h5>
			<input name="title" type="text" />
			<h5>�������� ������</h5>
			<textarea name="description" onkeydown="checkTextArea(this, 600);" onchange="checkTextArea(this, 600);"></textarea>
			<h5>����</h5>
			<ul id="getTags_chosen" class="help_chosen">
				<?/*C��� ����������� ��������� ����*/?>
			</ul>
			<input id="getTags" type="text" autocomplete="off" />
			<div id="getTags_popup" class="popup help">
				<div class="fon"></div>
				<div class="cont">
					<ul id="getTags_help">
						<?/*C��� ����������� ������ � ����� �� �����*/?>
					</ul>
				</div>
			</div>
			<h5>������</h5>
			<input name="image" type="file" />
			<h5>��� ������</h5>
			<label><input type="radio" name="group" value="public" checked="checked" /><span>��������</span> (�������� � ������ ����� ����� ������������������ ������������)</label>
			<label><input type="radio" name="group" value="private" /><span>��������</span> (�������� � ������ ����� ������ ������������ ������������)</label>
			<input type="image" src="/i/create_gr_but.gif" />
		</form>
	</div>
	
	<script type="text/javascript" src="<?=$this->getStaticPath('/js/createGroup.js?d=09.02.11')?>"></script>
	<?$this->_render('inc_right_column');?>
</div>
<?$this->_render('inc_footer');?>