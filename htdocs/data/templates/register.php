<?$this->_render('inc_header',array('title'=>'�����������','header'=>'�����������','top_code'=>'*','header_small'=>'����������� �� �����'));?>
<script type="text/javascript">
function test_reg(frm)
{
	str='';
	if (frm.nick.value=='')
	{
		str='�� �� ������� ���� ��� !';
	}
	else if (frm.email.value.indexOf('@')==-1)
	{
		str='�� �� ������� ��� E-mail ��� ��� ������ ����������� !';
	}
	else if (frm.pass1.value=='' || frm.pass2.value=='')
	{
		str='�� ������� ������ ������ !';
	}
	else if (frm.pass1.value!=frm.pass2.value)
	{
		str='������ �� ��������� !';
	}
	else if (frm.city.value=='')
	{
		str='�� �� ������� ���� ����� !';
	}
	if (str!='')
	{
		alert (str);
		return false;
	}

	/*if (!frm.rules.checked)
	{
		alert ("��� ���������� �����������, �� ������ ������� ������� !");
		return false;
	}*/
	return true;
}
</script>
<div id="contentWrapper" class="twoCols">
<div id="content">
							<?if (isset($d['rewrite'][1]) && $d['rewrite'][1]=='err_nick') {?>
							<h4>����� ��� ��� ��������������� � �������.</h4>
							<?}?>
							<?if (isset($d['rewrite'][1]) && $d['rewrite'][1]=='err_fields') {?>
							<h4>�� �� ��������� ��� ������������ ����.</h4>
							<?}?>
							<?if (isset($d['rewrite'][1]) && $d['rewrite'][1]=='dif_pass') {?>
							<h4>������ �� ���������.</h4>
							<?}?>
							<?if (isset($d['rewrite'][1]) && $d['rewrite'][1]=='err_email') {?>
							<h4>����� E-mail ��� ��������������� � �������.</h4>
							<?}?>
							<?if (isset($d['rewrite'][1]) && $d['rewrite'][1]=='rules') {?>
							<h4>��� ���������� ����������� �� ������ ������� �������.</h4>
							<?}?>
							<form class="questionnaireForm" action="/index.php" method="POST" enctype="multipart/form-data" name="fr" onsubmit="return test_reg(this);">
							<input type="hidden" name="type" value="register">
							<input type="hidden" name="action" value="add">
							<label>
							<strong>��� <sup>*</sup></strong>
							<input type="text" name="nick" value="<?=htmlspecialchars($d['user_data']['nick'], ENT_IGNORE, 'cp1251', false);?>">
							</label>
							<label>
							<strong>��� <sup></sup></strong>
							<input type="text" name="uname" value="<?=$d['user_data']['name']?>">
							</label>
							<label>
							<strong>���� �����</strong>
							<textarea name="credo"><?=$d['user_data']['credo']?></textarea>
							</label>
							<label>
							<strong>�������</strong>
							<input type="file" name="avatara" value="">
							</label>
							<label>
							<strong>E-mail <sup>*</sup></strong>
							<input type="text" name="email" value="<?=$d['user_data']['email']?>">
							</label>
							<label>
							<strong>������ <sup>*</sup></strong>
							<input type="password" name="pass1" value="">
							</label>
							<label>
							<strong>��������� ������ <sup>*</sup></strong>
							<input type="password" name="pass2" value="">
							</label>
							<fieldset>
							<strong>���� �������� <sup>*</sup></strong>
							<span class="cont">
								<select name="day">
									<option>1</option><option>2</option><option>3</option><option>4</option><option>5</option><option>6</option><option>7</option><option>8</option>
									<option>9</option><option>10</option><option>11</option><option>12</option><option>13</option><option>14</option><option>15</option><option>16</option>
									<option>17</option><option>18</option><option>19</option><option>20</option><option>21</option><option>22</option><option>23</option><option>24</option>
									<option>25</option><option>26</option><option>27</option><option>28</option><option>29</option><option>30</option><option>31</option>
								</select>
								<select name="month">
									<option value="1">������</option><option value="2">�������</option><option value="3">�����</option><option value="4">������</option><option value="5">���</option>
									<option value="6">����</option><option value="7">����</option><option value="8">�������</option><option value="9">��������</option>
									<option value="10">�������</option><option value="11">������</option><option value="12">�������</option>
								</select>
								<select name="year">
									<?for ($i=date('Y');$i>=1900;$i--) { ?>
                                    <option value="<?=$i?>"><?=$i?></option>
                                    <?}?>
								</select>
								<span>���������� � �������</span>
								<input type="checkbox" name="show_bd" value="1"/>
							</span>
						</fieldset>
                                                <label><strong>������</strong>
                                                <select name="country">
                                                        <?foreach ($p['query']->get('countries',null,array('rating'),0,500) as $i => $city) {?>
														<option value="<?=$city['id']?>" <?=$d['user_data']['country_id']==$city['id'] ? 'selected="selected"' : ''?>><?=$city['name']?></option>
														<?}?>
														<option value="0" <?=$d['user_data']['city_id']=='0' ? 'selected="selected"' : ''?>>������...</option>
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
                                                                <option value="1" <?if ($d['user_data']['sex']==1){?>selected="selected"<?}?>>�������</option>
                                                                <option value="2" <?if ($d['user_data']['sex']==2){?>selected="selected"<?}?>>�������</option>
                                                        </select>
                                                </label>
                                                <label>
                                                        <strong>�����</strong>
                                                        <select name="family">
                                                                <option value="0"-</option>
                                                                <option value="1"<?=$d['user_data']['family']==1 ? 'selected="selected"' :''?>>�����/�������</option>
                                                                <option value="2"<?=$d['user_data']['family']==2 ? 'selected="selected"' :''?>>������/�������</option>
                                                        </select>
                                                </label>
                                                <label>
                                                        <strong>� �����<?=$d['user_data']['sex']==1 ? '': '�';?> �� ����������� �</strong>
                                                        <select name="meet_actor">
                                                                <option value="0">�� � ���</option>
                                                                <?foreach ($p['query']->get('persons',null,array('name'),null,null) as $i => $person){?>
                                                                <option value="<?=$person['id']?>"<?=$d['user_data']['meet_actor']==$person['id'] ? 'selected="selected"' :''?>><?=$person['name']?></option>
                                                                <?}?>
                                                        </select>
                                                </label>
												<span><input type="checkbox" name="daily_sub" value="1" checked="checked">&nbsp;� ���� �������� ���������� �������� �������� � ����� </span><br><br>
												<span><input type="checkbox" name="rules" value="1">&nbsp;� �������� <a href="/rules" onclick="window.open('/rules','_blank','width=800, height=600, scrollbars=yes'); return false;">�������</a> � �������� ��</span>
												<br><br>
                                                <input type="submit" value="���������" />

                                        </form>
                                </div>

                        <?$this->_render('inc_right_column');?>
                        </div>
<?$this->_render('inc_footer');?>
