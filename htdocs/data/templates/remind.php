<?$this->_render('inc_header',array('title'=>'����������� ������','header'=>'����������� ������','top_code'=>'*','header_small'=>''));?>
<script type="text/javascript">
function test_reg(frm)
{
	str='';
	if (frm.email.value.indexOf('@')==-1)
	{
		str='�� �� ������� ��� E-mail ��� ��� ������ ����������� !';
	}
	
	if (str!='')
	{
		alert (str);
		return false;
	}
	return true;
}
</script>
<div id="contentWrapper" class="twoCols">
	<div id="content">
	<form class="questionnaireForm" action="/index.php" method="POST" enctype="multipart/form-data" name="fr" onsubmit="return test_reg(this);">
		<input type="hidden" name="type" value="remind">
		<label>
			<strong>E-mail <sup>*</sup></strong>
			<input type="text" name="email" value="">
		</label>
		<br><br>
		<input type="submit" value="������� ������" />
	</form>
	</div>
	<?$this->_render('inc_right_column');?>
</div>
<?$this->_render('inc_footer');?>
