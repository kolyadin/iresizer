<?
$this->_render('inc_header', array('title'=>$d['cuser']['nick'], 'header'=>'�������� ������', 'top_code'=>'<img src="' . $this->getStaticPath($this->getUserAvatar($d['cuser']['avatara'], true)) . '" alt="' . htmlspecialchars($d['cuser']['nick']) . '" class="avaProfile">', 'header_small'=>'���� �������'));

$new_msgs = $p['query']->get_num('user_msgs', array('uid' => $d['cuser']['id'], 'readed'=>0, 'private' => 1, 'del_uid' => 0));
$new_friends = $p['query']->get_num('user_friends_optimized', array('uid'=>$d['cuser']['id'], 'confirmed'=>0));
?>
<div id="contentWrapper" class="twoCols">
	<div id="content">
		<ul class="menu">
			<li><a rel="nofollow" href="/profile/<?=$d['cuser']['id']?>">�������</a></li>
			<li><a rel="nofollow" href="/profile/<?=$d['cuser']['id']?>/friends">������</a><span class="marked"><?=$new_friends;?></span></li>
			<li><a rel="nofollow" href="/profile/<?=$d['cuser']['id']?>/persons/all">�������</a></li>
			<li><a rel="nofollow" href="/profile/<?=$d['cuser']['id']?>/guestbook">��������</a></li>
			<li><a rel="nofollow" href="/profile/<?=$d['cuser']['id']?>/messages">���������</a><span class="marked"><?=$new_msgs;?></span></li>
			<li><a rel="nofollow" href="/profile/<?=$d['cuser']['id']?>/wrote">� ����</a></li>
			<li class="active"><a rel="nofollow" href="/profile/<?=$d['cuser']['id']?>/fanfics">�������</a></li>
			<li><a rel="nofollow" href="/profile/<?=$d['cuser']['id']?>/gifts">�������</a></li>			
			<li><a rel="nofollow" href="/profile/<?=$d['cuser']['id']?>/community/groups">������</a></li>
			<li><a rel="nofollow" href="/profile/<?=$d['cuser']['id']?>/sets">your.style</a></li>
			<li><a rel="nofollow" href="/games/guess_star/instructions/profile">������ ������</a></li>			
		</ul>
		<ul class="menu bLevel">
			<li><a rel="nofollow" href="/profile/<?=$d['cuser']['id']?>/fanfics/all">��� �������</a></li>
			<li class="active"><a rel="nofollow" href="/profile/<?=$d['cuser']['id']?>/fanfics/add">��������</a></li>
		</ul>
		<div class="trackContainer fanficsTrack">
			<div class="trackContainer mailTrack">
				<div class="trackItem answering">
					<script type="text/javascript">
						function check_fr(frm)
						{
							frm.button.disabled = true;
							str = '';
							if (frm.name.value == '')
							{
								str='�� �� ������� ���� ��� �������!';
							}
							if (frm.content.length < 4000) {
								str = '� ����� ������ ����������� ���� ��������� �������, �� ����� 4000 ������';
							}
							if (str != '')
							{
								alert (str);
								frm.button.disabled = false;
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
					<form name="fmr" method="POST" class="answer addFanfic" onSubmit="return check_fr(this);" enctype="multipart/form-data">
						<input type="hidden" name="type" value="fanfic">
						<input type="hidden" name="action" value="add">
						<?/*<input type="hidden" name="pid" value="<?=$d['page_action'];?>">*/?>
						<input type="hidden" name="page" value="<?=(isset($d['page']) ? $d['page'] : null);?>">
						<p>� ���:</p>
						<select class="selectReciever" name="pid">
						</select>
						<p>��������:</p><input type="text" name="name" value="<?=(isset($_POST['name']) ? $_POST['name'] : null);?>">
						<p>�����:</p><textarea class="announce" title="�������� 400 ��������" name="announce"><?=(isset($_POST['announce']) ? $_POST['announce'] : null);?></textarea>
						<p>�����:</p>
						<?$this->_render('inc_bbcode');?>
						<textarea class="content" name="content"><?=(isset($_POST['content']) ? $_POST['content'] : null);?></textarea>
						<div class="aboutMe">
							<a rel="nofollow" href="/profile/<?=$d['cuser']['id']?>" class="ava"><img alt="" src="<?=$this->getStaticPath($this->getUserAvatar($d['cuser']['avatara']))?>" /></a>
							<span>�� ������ ���</span><br />
							<a rel="nofollow" href="/profile/<?=$d['cuser']['id']?>"><?=htmlspecialchars($d['cuser']['nick'], ENT_IGNORE, 'cp1251', false);?></a>
						</div>
						<label>�������� <input type="file" name="attachment" /></label>
						<input type="submit" name="button" class="submitFanfic" value="���������" />
					</form>
				</div>
			</div>
		</div>
	</div>
	<?$this->_render('inc_right_column');?>
</div>
<?$this->_render('inc_footer');?>