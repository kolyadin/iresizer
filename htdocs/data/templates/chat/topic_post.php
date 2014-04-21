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
			<li><a href="/chat/theme/<?=$d['theme']['id']?>/">��� ����������</a></li>
			<li><a href="/chat/theme/<?=$d['theme']['id']?>/messages">��� �����������</a></li>
			<li class="active"><a href="/chat/theme/<?=$d['theme']['id']?>/post">������� ����</a></li>
		</ul>
		<h2><?=(isset($d['edit_topic'])?'�������������� ���������� ':'���������� ')?></h2>
		<div class="trackContainer mailTrack">
			<div class="trackItem answering">
				<script type="text/javascript">
					function check_fr(frm)
					{
						frm.submit.disabled=true;
						str='';
						if (frm.name.value=='') {
							str='�� �� ������� ���� ��� ����������!';
						} else if (frm.content.value=='') {
							str='�� �� ������� �������� ����������!';
						}
						if (str!='') {
							alert (str);
							frm.submit.disabled=false;
							return false;
						}
						return true;
					}
				</script>

				<form action="/" name="frm" method="POST" class="answer newMessage" onSubmit="return check_fr(this);">
					<input type="hidden" name="type" value="chat">
					<?if (isset($d['edit_topic'])) {?>
					<input type="hidden" name="action" value="edit">
					<input type="hidden" name="topic_id" value="<?=$d['edit_topic']['id']?>">
					<?} else {?>
					<input type="hidden" name="action" value="post">
					<?}?>
					<input type="hidden" name="theme" value="<?=$d['theme']['id']?>">
					<input type="text" name="name" value="<?=$d['edit_topic']['name']?>">
					<textarea name="content"><?=$d['edit_topic']['content']?></textarea>
					��� �����:<textarea name="embed" style="height:40px"><?=$d['edit_topic']['embed']?></textarea>
					<div class="aboutMe">
						<a rel="nofollow" href="/profile/<?=$d['cuser']['id']?>" class="ava"><img alt="" src="<?=$this->getStaticPath($this->getUserAvatar($d['cuser']['avatara']))?>" /></a>
						<span>�� ������ ���</span><br />
						<a rel="nofollow" href="/profile/<?=$d['cuser']['id']?>"><?=htmlspecialchars($d['cuser']['nick'], ENT_IGNORE, 'cp1251', false);?></a>
					</div>
					<input type="submit" value="���������" onclick="this.enabled = false;" />
				</form>
			</div>
		</div>
	</div>
	<?$this->_render('inc_right_column');?>
</div>
<?$this->_render('inc_footer');?>
