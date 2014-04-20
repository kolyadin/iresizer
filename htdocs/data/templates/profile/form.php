<?
$this->_render('inc_header', array('title' => $d['cuser']['nick'], 'header' => '������������� �������', 'top_code' => '<img src="' . $this->getStaticPath($this->getUserAvatar($d['cuser']['avatara'], true)) . '" alt="' . htmlspecialchars($d['cuser']['nick']) . '" class="avaProfile">', 'header_small' => '�������������� ����� ������'));
$new_msgs = $p['query']->get_num('user_msgs', array('uid' => $d['cuser']['id'], 'readed' => 0, 'private' => 1, 'del_uid' => 0));
$new_friends = $p['query']->get_num('user_friends_optimized', array('uid' => $d['cuser']['id'], 'confirmed' => 0));
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
			<li><a rel="nofollow" href="/profile/<?=$d['cuser']['id']?>/fanfics">�������</a></li>
			<li><a rel="nofollow" href="/profile/<?=$d['cuser']['id']?>/gifts">�������</a></li>
			<li><a rel="nofollow" href="/profile/<?=$d['cuser']['id']?>/community/groups">������</a></li>
			<li><a rel="nofollow" href="/profile/<?=$d['cuser']['id']?>/sets">your.style</a></li>
			<li><a rel="nofollow" href="/games/guess_star/instructions/profile">������ ������</a></li>			
		</ul>
		<ul class="menu bLevel">
			<li><a rel="nofollow" href="/profile/<?=$d['cuser']['id']?>">�������</a></li>
			<li class="active"><a rel="nofollow" href="/profile/<?=$d['cuser']['id']?>/form">�������������</a></li>
			<li><a rel="nofollow" href="/profile/<?=$d['cuser']['id']?>/photos">����������</a></li>
			<li><a rel="nofollow" href="/profile/<?=$d['cuser']['id']?>/photos/del">�������� ����</a></li>
            <li><a rel="nofollow" href="/profile/<?=$d['cuser']['id']?>/blacklist">������ ������</a></li>
		</ul>
		<h2>�������������� �������</h2>
		<?if (isset($d['rewrite'][3]) && $d['rewrite'][3] == 'err_fields') {?>
		<h4>�� �� ��������� ��� ������������ ����.</h4>
		<?}?>
		<form class="questionnaireForm" action="/" method="POST" enctype="multipart/form-data">
			<input type="hidden" name="type" value="profile">
			<input type="hidden" name="action" value="edit">
			<label>
				<strong>��� <sup>*</sup></strong>
				<input type="text" name="nick" value="<?=htmlspecialchars($d['user_data']['nick'], ENT_IGNORE, 'cp1251', false);?>" readonly="readonly">
			</label>
			<label>
				<strong>���</strong>
				<input type="text" name="uname" value="<?=$d['user_data']['name']?>">
			</label>
			<label>
				<strong>���� ����� <br>(�� ����� 250 ��������)</strong>
				<textarea name="credo"><?=$d['user_data']['credo']?></textarea>
			</label>
			<fieldset>
				<strong>�������<br />84x84 �����</strong>
				<span class="cont">
					<? if ($d['user_data']['avatara']) {?><img src="<?=$this->getStaticPath($this->getUserAvatar($d['user_data']['avatara']))?>"><?}?>
					<input type="file" name="avatara" value="">
				</span>
			</fieldset>
			<fieldset>
				<strong>���� �������� <sup>*</sup></strong>
				<span class="cont">
					<select name="day">
						<?for ($i = 1;$i <= 31;$i++) { ?>
                                    <option value="<?=$i?>" <?=$i == substr($d['user_data']['birthday'], 6, 2) ? 'selected' : ''?>><?=$i?></option>
							<?}?>
					</select>
					<select name="month">
						<option value="1" <?=(1 == substr($d['user_data']['birthday'], 4, 2)) ? 'selected="selected"' :''?>>������</option>
						<option value="2" <?=(2 == substr($d['user_data']['birthday'], 4, 2)) ? 'selected="selected"' :''?>>�������</option>
						<option value="3" <?=(3 == substr($d['user_data']['birthday'], 4, 2)) ? 'selected="selected"' :''?>>�����</option>
						<option value="4" <?=(4 == substr($d['user_data']['birthday'], 4, 2)) ? 'selected="selected"' :''?>>������</option>
						<option value="5" <?=(5 == substr($d['user_data']['birthday'], 4, 2)) ? 'selected="selected"' :''?>>���</option>
						<option value="6" <?=(6 == substr($d['user_data']['birthday'], 4, 2)) ? 'selected="selected"' :''?>>����</option>
						<option value="7" <?=(7 == substr($d['user_data']['birthday'], 4, 2)) ? 'selected="selected"' :''?>>����</option>
						<option value="8" <?=(8 == substr($d['user_data']['birthday'], 4, 2)) ? 'selected="selected"' :''?>>�������</option>
						<option value="9" <?=(9 == substr($d['user_data']['birthday'], 4, 2)) ? 'selected="selected"' :''?>>��������</option>
						<option value="10" <?=(10 == substr($d['user_data']['birthday'], 4, 2)) ? 'selected="selected"' :''?>>�������</option>
						<option value="11" <?=(11 == substr($d['user_data']['birthday'], 4, 2)) ? 'selected="selected"' :''?>>������</option>
						<option value="12" <?=(12 == substr($d['user_data']['birthday'], 4, 2)) ? 'selected="selected"' :''?>>�������</option>
					</select>
					<select name="year">
						<?for ($i = date('Y');$i >= 1900;$i--) { ?>
                                    <option value="<?=$i?>" <?=$i == substr($d['user_data']['birthday'], 0, 4) ? 'selected' : ''?>><?=$i?></option>
							<?}?>
					</select>
					<span>���������� � �������</span>
					<input type="checkbox" name="show_bd" value="1" <?=($d['user_data']['show_bd'] == 1) ? 'checked="checked"' : ''?> />
				</span>
			</fieldset>
			<label>
				<strong>����� ������</strong>
				<input type="password" name="pass1" value="">
			</label>
			<label>
				<strong>��������� ������</strong>
				<input type="password" name="pass2" value="">
			</label>
			<label><strong>������</strong>
				<select name="country">
					<?foreach ($p['query']->get('countries', null, array('rating'), 0, 500) as $i => $city) {?>
					<option value="<?=$city['id']?>" <?=$d['user_data']['country_id'] == $city['id'] ? 'selected="selected"' : ''?>><?=$city['name']?></option>
						<?}?>
					<option value="0" <?=$d['user_data']['city_id'] == '0' ? 'selected="selected"' : ''?>>������...</option>
				</select>
			</label>
			<label>
				<strong>����� <sup>*</sup></strong>
				<select name="city">
				</select>
			</label>
			<label>
				<strong>���</strong>
				<select name="sex">
					<option value="0">-</option>
					<option value="1" <?if ($d['user_data']['sex'] == 1) {?>selected="selected"<?}?>>�������</option>
					<option value="2" <?if ($d['user_data']['sex'] == 2) {?>selected="selected"<?}?>>�������</option>
				</select>
			</label>
			<label>
				<strong>�����</strong>
				<select name="family">
					<option value="0"<?=$d['user_data']['family'] == 0 ? 'selected="selected"' :''?>>-</option>
					<option value="1"<?=$d['user_data']['family'] == 1 ? 'selected="selected"' :''?>>�����/�������</option>
					<option value="2"<?=$d['user_data']['family'] == 2 ? 'selected="selected"' :''?>>������/�������</option>
				</select>
			</label>
			<label>
				<strong>� �����<?=$d['user_data']['sex'] == 1 ? '': '�';?> �� ����������� �</strong>
				<select name="meet_actor">
					<option value="0">�� � ���</option>
					<?foreach ($p['query']->get('persons', null, array('name'), null, null) as $i => $person) {?>
					<option value="<?=$person['id']?>"<?=$d['user_data']['meet_actor'] == $person['id'] ? 'selected="selected"' :''?>><?=$person['name']?></option>
						<?}?>
				</select>
			</label>
			
			<label class="long">
				<strong>� ���� �������� ���������� �������� �������� � �����</strong>
				<input type="checkbox" name="daily_sub" value="1" <?=($d['user_data']['daily_sub'] == 1) ? 'checked="checked"' : null?>>
			</label>
			<label class="long">
				<strong>� ���� �������� ����������� � ����� ���������</strong>
				<input type="checkbox" name="alert_on_new_mail" value="1" <?=($d['user_data']['alert_on_new_mail'] == 1) ? 'checked="checked"' : null?>>
			</label>
			<label class="long">
				<strong>� ���� �������� ����������� � ����� ������� � ��������</strong>
				<input type="checkbox" name="alert_on_new_guest_items" value="1" <?=($d['user_data']['alert_on_new_guest_items'] == 1) ? 'checked="checked"' : null?>>
			</label>
			<label class="long">
				<strong>��������� ����������� � ������</strong>
				<input type="checkbox" name="can_invite_to_community_groups" value="1" <?=($d['user_data']['can_invite_to_community_groups'] == 1) ? 'checked="checked"' : null?>>
			</label>

			<input type="submit" value="���������" /><label></label>

		</form>
	</div>
	<?$this->_render('inc_right_column');?>
</div>
<?$this->_render('inc_footer');?>
