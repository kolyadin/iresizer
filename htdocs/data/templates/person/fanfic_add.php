<?
$this->_render('inc_header', array('title'=>'������ - �������� - ' . $d['person']['name'], 
		'header' => $d['person']['name'] . '<br /><span>'.$d['person']['eng_name'].'</span>',
		'top_code' => ($d['person']['main_photo'] ? '<img src="' . $this->getStaticPath('/upload/_100_100_80_' . $d['person']['main_photo']) . '" alt="' . $d['person']['name'] . '" class="avaProfile">' : null), 
		'header_small'=>'',
		'header_class' => 'topPersonHeader',
));
?>
<div id="contentWrapper" class="twoCols">
	<div id="content">
		<ul class="menu">
			<li><a href="/persons/<?=$handler->Name2URL($d['person']['eng_name']);?>">�������</a></li>
			<li><a href="/persons/<?=$handler->Name2URL($d['person']['eng_name']);?>/news">�������</a></li>
			<?if ($p['query']->get_num('kino_films', array('person'=>$d['person']['id'])) > 0) {?>
			<li><a href="/persons/<?=$handler->Name2URL($d['person']['eng_name']);?>/kino">������������</a></li>
			<?}?>
			<li><a href="/persons/<?=$handler->Name2URL($d['person']['eng_name']);?>/photo">����</a></li>
			<li><a href="/persons/<?=$handler->Name2URL($d['person']['eng_name']);?>/fans">����������</a></li>
			<?if ($p['query']->get_num('puzzles', array('person'=>$d['person']['id'])) > 0) {?>
			<li><a href="/persons/<?=$handler->Name2URL($d['person']['eng_name']);?>/puzli">�����</a></li>
			<?}?>
			<?if ($p['query']->get_num('person_wallpapers', array('id'=>$d['person']['id'], 'name'=>$d['person']['name'])) > 0) {?>
			<li><a href="/persons/<?=$handler->Name2URL($d['person']['eng_name']);?>/oboi">����</a></li>
			<?}?>
			<li class="active"><a href="/persons/<?=$handler->Name2URL($d['person']['eng_name']);?>/fanfics">�������</a></li>
			<li><a href="/persons/<?=$handler->Name2URL($d['person']['eng_name']);?>/facts">�����</a></li>
			<li><a href="/persons/<?=$handler->Name2URL($d['person']['eng_name']);?>/talks">����������</a></li>
			<?if ($p['query']->get_num('video', array('pole1'=>$d['person']['id'], 'pole11'=>'1')) > 0) {?>
			<li><a href="/persons/<?=$handler->Name2URL($d['person']['eng_name']);?>/video">�����</a></li>
			<?}?>
			<?if ($p['query']->get_num('yourstyle_sets_tags', array('tid'=>$d['person']['id'])) > 0) {?>
			<li><a href="/persons/<?=$handler->Name2URL($d['person']['eng_name']);?>/sets">����</a></li>
			<? } ?>			
		</ul>
		<ul class="menu bLevel">
		<?php if($d['fcount'] > 0) { ?>
			<li><a href="/persons/<?=$handler->Name2URL($d['person']['eng_name']);?>/fanfics/all">��� �������</a></li>
		<?php } ?>
			<li class="active"><a href="/persons/<?=$handler->Name2URL($d['person']['eng_name']);?>/fanfics/add">��������</a></li>
		</ul>
		<h2>�������� ������</h2>
		<div class="trackContainer fanficsTrack">
			<?if (!empty($d['cuser'])) {?>
			<div class="trackContainer mailTrack">
				<div class="trackItem answering">
					<script type="text/javascript">
						function check_fr(frm)
						{
							frm.button.disabled=true;
							str='';
							if (frm.name.value=='')
							{
								str='�� �� ������� ���� ��� �������!';
							}
							if (frm.content.value.length < 4000) {
								str = '� ����� ������ ����������� ���� ��������� �������, �� ����� 4000 ������';
							}
							if (str!='')
							{
								alert (str);
								frm.button.disabled=false;
								return false;
							}							
							return true;
						}
					</script>
					<p class="rules">
						������� ���������� �������:<br />
						1.������� �������� ������ ��������<br />
						2.� ����� ������ ������� ������ ��������� ����������� �� ����� �������.<br />
						3.� ����� ������ ����������� ���� ��������� �������, �� ����� 4000 ������.<br />
						4.����������� ����������� ������ ��������������� ���� ������ �������<br />
						5.������� �Enter� �������� ������ ������ ������ � ����� ������. �� ������ ����� ����� ��������� ��������.<br />
						6.�������� ����� ��� ����, ����� � ����� ������ �������� � ���� �����, �� ������� �� ������������.<br />
						7.��� ���������� ������ ����������, ���������� ��� ������ � ��������. �������� ��������� �����.<br />
						<br />
						������������� ����� �� ����� ��������������� �� ����������� �������������� ���������.<br />
					</p>
					<form name="fmr" method="POST" class="answer newMessage" onSubmit="return check_fr(this);" enctype="multipart/form-data">
						<input type="hidden" name="type" value="fanfic" />
						<input type="hidden" name="action" value="<?=($d['fanfics_data'] ? 'edit' : 'add')?>" />
						<input type="hidden" name="pid" value="<?=(!isset($_POST['pid']) ? $handler->getID() : $_POST['pid']);?>" />
						<?if ($d['fanfics_data']['id']) {?><input type="hidden" name="id" value="<?=$d['fanfics_data']['id'];?>"><?}?>
						<p>��������:</p><input type="text" name="name" value="<?=htmlspecialchars((isset($_POST['name']) ? $_POST['name'] : $d['fanfics_data']['name']));?>">
						<p>�����:</p><textarea class="announce" title="�������� 400 ��������" name="announce"><?=(isset($_POST['announce']) ? $_POST['announce'] : $d['fanfics_data']['announce']);?></textarea>
						<p>�����:</p>
							<?$this->_render('inc_bbcode');?>
						<textarea class="content" name="content"><?=(isset($_POST['content']) ? $_POST['content'] : $d['fanfics_data']['content']);?></textarea>
						<div class="aboutMe">
							<a rel="nofollow" href="/profile/<?=$d['cuser']['id']?>" class="ava"><img src="<?=$this->getStaticPath($this->getUserAvatar($d['cuser']['avatara']))?>" /></a>
							<span>�� ������ ���</span><br />
							<a rel="nofollow" href="/profile/<?=$d['cuser']['id']?>"><?=htmlspecialchars($d['cuser']['nick'], ENT_IGNORE, 'cp1251', false);?></a>
						</div>
						<label>�������� <input type="file" name="attachment" /></label>
						<input type="submit" name="button" value="���������" />
					</form>
				</div>
			</div>
			<?} else {?>
			<p>���� �� ������ �������� ������ - <a href="/register">�����������������</a>.</p>
			<?}?>
		</div>
	</div>
	<?$this->_render('inc_right_column');?>
</div>
<?$this->_render('inc_footer');?>