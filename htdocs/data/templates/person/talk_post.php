<?
$this->_render('inc_header', array('title'=>$d['person']['name'], 
		'header' => $d['person']['name'] . '<br /><span>'.$d['person']['eng_name'].'</span>',
		'top_code' => ($d['person']['main_photo'] ? '<img src="' . $this->getStaticPath('/upload/_100_100_80_' . $d['person']['main_photo']) . '" alt="' . $d['person']['name'] . '" class="avaProfile">' : null), 
		'header_small'=>'',
		'header_class' => 'topPersonHeader',
));
?>
<div id="contentWrapper" class="twoCols">
	<div id="content">
		<ul class="menu">
			<li><a href="<?=$handler->getBaseLink();?>">�������</a></li>
			<li><a href="<?=$handler->getBaseLink();?>/news">�������</a></li>
			<?if ($p['query']->get_num('kino_films', array('person'=>$d['person']['id'])) > 0) {?>
			<li><a href="<?=$handler->getBaseLink();?>/kino">������������</a></li>
			<?}?>
			<li><a href="<?=$handler->getBaseLink();?>/photo">����</a></li>
			<li><a href="<?=$handler->getBaseLink();?>/fans">����������</a></li>
			<?if ($p['query']->get_num('puzzles', array('person'=>$d['person']['id'])) > 0) {?>
			<li><a href="<?=$handler->getBaseLink();?>/puzli">�����</a></li>
			<?}?>
			<?if ($p['query']->get_num('person_wallpapers', array('id'=>$d['person']['id'], 'name'=>$d['person']['name'])) > 0) {?>
			<li><a href="<?=$handler->getBaseLink();?>/oboi">����</a></li>
			<?}?>
			<li><a href="<?=$handler->getBaseLink();?>/fanfics">�������</a></li>
			<li><a href="<?=$handler->getBaseLink();?>/facts">�����</a></li>
			<li class="active"><a href="<?=$handler->getBaseLink();?>/talks">����������</a></li>
			<?if ($p['query']->get_num('video', array('pole1'=>$d['person']['id'], 'pole11'=>'1')) > 0) {?>
			<li><a href="<?=$handler->getBaseLink();?>/video">�����</a></li>
			<?}?>
			<?if ($p['query']->get_num('yourstyle_sets_tags', array('tid'=>$d['person']['id'])) > 0) {?>
			<li><a href="/persons/<?=$handler->Name2URL($d['person']['eng_name']);?>/sets">����</a></li>
			<? } ?>
		</ul>
		<ul class="menu bLevel">
			<li><a href="<?=$handler->getBaseLink();?>/talks">��� ����</a></li>
			<li><a href="<?=$handler->getBaseLink();?>/talks/messages">��� �����������</a></li>
			<li class="active"><a href="<?=$handler->getBaseLink();?>/talks/post">������� ����</a></li>
		</ul>
		<h2><?=(!empty($d['edit_topic']) ? '�������������� ���������� ' : '���������� ') . $d['person']['genitive']?></h2>
		<?if ($d['cuser']['rating'] < 100) {?>
		<div class="systemMessage">
			<p>��� �������� ���������� ���������� ����� ������� ������ 100.</p>
		</div>
		<?} elseif($d['person']['id'] == 1) { ?>
		<p>
			��������, �������� ����� ���������� �������� �������������� ��-�� ��������� ������.
			<br><a href="javascript:window.history.back();">�����</a>
		</p>
		<?} elseif (!$d['is_fan']) { ?>
		<div class="systemMessage">
			<p>� ���������, �� �� ������ ��������� ����� ����, ��� ��� �� ��������� ����������� ������ ������.</p>
		</div>
		<?} else {?>
		<div class="trackContainer mailTrack">
			<div class="trackItem answering">
				<script type="text/javascript">
					function check_fr(frm)
					{
						frm.submit.disabled=true;
						str='';
						if (frm.name.value=='') {
							str='�� �� ������� ���� ��� ����������!';
						}
						if (str!='') {
							alert (str);
							frm.submit.disabled=false;
							return false;
						}
						return true;
					}
					function check_length(message){
						var maxLen = 500;
						if (message.value.length > maxLen){
							message.value = message.value.substring(0, maxLen);
						}
					}
				</script>

				<form action="/" name="frm" method="POST" class="answer newMessage" onSubmit="return check_fr(this);">
					<input type="hidden" name="type" value="topic">
					<?if (!empty($d['edit_topic'])) {?>
					<input type="hidden" name="action" value="edit">
					<input type="hidden" name="topic_id" value="<?=(!empty($d['topic_id']) ? $d['topic_id'] : null)?>">
					<?} else {?>
					<input type="hidden" name="action" value="post">
					<?}?>
					<input type="hidden" name="person" value="<?=(!empty($d['person']['id']) ? $d['person']['id'] : null)?>">
					<input type="text" name="name" value="<?=(!empty($d['edit_topic']['name']) ? $d['edit_topic']['name'] : null)?>">
					<textarea name="content" onkeyup="check_length(this);" title="�������� 500 ��������"><?=(!empty($d['edit_topic']['content']) ? $d['edit_topic']['content'] : null)?></textarea>
					��� �����:<textarea name="embed" style="height:40px"><?=(!empty($d['edit_topic']['embed']) ? $d['edit_topic']['embed'] : null)?></textarea>
					<div class="aboutMe">
						<a rel="nofollow" href="/profile/<?=$d['cuser']['id']?>" class="ava"><img alt="" src="<?=$this->getStaticPath($this->getUserAvatar($d['cuser']['avatara']))?>" /></a>
						<span>�� ������ ���</span><br />
						<a rel="nofollow" href="/profile/<?=$d['cuser']['id']?>"><?=htmlspecialchars($d['cuser']['nick'], ENT_IGNORE, 'cp1251', false);?></a>
					</div>
					<input type="submit" value="���������" />
				</form>
			</div>
		</div>
		<?}?>
	</div>
	<?$this->_render('inc_right_column');?>
</div>
<?$this->_render('inc_footer');?>
