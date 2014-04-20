<?$this->_render('inc_header', 
    array(
    	'title' => 'your.style - �������', 
    	'header' => 'your.style', 
    	'top_code' => '<img src="' . $this->getStaticPath($this->getUserAvatar($d['cuser']['avatara'], true)) . '" alt="' . $d['cuser']['nick'] . '" class="avaProfile">', 
    	'header_small' => '', 
    	'css' => 'ys.css?d=26.03.12', 
    	'js' => 'YourStyle.js?d=26.03.12',
        'yourstyleRating' => $d['yourStyleUserRating'],
    ));    
?>
<div id="contentWrapper" class="twoCols">
	<div id="content">
		<ul class="menu">
			<li><a href="/yourstyle">your.style</a></li>
			<li><a href="/yourstyle/sets">����</a></li>
			<li><a href="/yourstyle/groups">����</a></li>
			<li><a href="/yourstyle/stars">������</a></li>
			<li><a href="/yourstyle/brands">������</a></li>
			<!--<li><a href="/yourstyle/editor" class="newWindow" target="_blank">�������</a></li>-->
			<li><a href="/yourstyle/editor" target="_blank">�������</a></li>
			<li class="active"><a href="/yourstyle/rules">�������</a></li>
		</ul>

		<div>
			<h2>�������</h2>
			<div class="simpleText rules">
			    <ul>
			        <li>� ������� � ������� ����� ��������� ������ ���������� ����� �� ����� ����. ��������� ���������� � ������������ �������������, ��������� � �. �. ���������.<br /><br /></li>
		    	    <li>����������� ��������� ����� ��� ����, ������� �� ������ ��������. ���� ��� ������ ��� � �������� ��� �����, ��� ������ �����, ���������� � �. �. ����� ���������.<br /><br /></li>
	    		    <li>������ ���� ������ ����������� � ��������������� ������: ������ � � �������, ����� � � ������, ����� � � ������ � �. �.<br /><br /></li>
    			    <li>���� �� ������ �������� � ���� ��� ��������, ������� �� ������������� ������������� ��������, ���������� ��������� ������� �������� ������ ��� ������������. ��� �������� ����� �������� ���, �� �� ������� � ����� ������ �����.</li>
			    </ul>
			</div>
		</div>
	</div>
	<?$this->_render('inc_right_column');?>
</div>
<?$this->_render('inc_footer');?>