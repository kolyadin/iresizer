<?php
$allowImages = true;
if(isset($d['images'])) {
    $allowImages = $d['images'];
}
?>

<script type="text/javascript" src="/js/bbcode.js?d=13.05.11"></script>

<div class="bbCode hiddenbbCode hiddenBlock">
  <!-- <span class="header"></span> -->
    <div class="bbCodeContainer">
      <ul>
	<li><a href="javascript:{void(0);}" onclick="javascript:{addtg('[b]',get_sel(),'[/b]')}" onfocus="this.blur()"><img src="/i/bbcode/b.gif" title="[b]��������� ������[/b]" border="0"></a></li>
	<li><a href="javascript:{void(0);}" onclick="javascript:{addtg('[i]',get_sel(),'[/i]')}" onfocus="this.blur()"><img src="/i/bbcode/i.gif" title="[i]��������� �����[/i]" border="0" width="22" height="22"></a></li>
	<li><a href="javascript:{void(0);}" onclick="javascript:{addtg('[u]',get_sel(),'[/u]')}" onfocus="this.blur()"><img src="/i/bbcode/u.gif" title="[u]������������ �����[/u]" border="0" width="22" height="22"></a></li>
	<li><a href="javascript:{addtgs('[ulist]',get_sel(),'[/ulist]')}" onfocus="this.blur()"><img src="/i/bbcode/li.gif" title="
	    [ulist]
	    [*] - ������
	    [*] - ������
	    [*] - ������
	    [/ulist]
	    " border="0" width="22" height="22"></a></li>
	<li><a href="javascript:{void(0);}" onclick="javascript:{addtgs('[list]',get_sel(),'[/list]')}" onfocus="this.blur()"><img src="/i/bbcode/ol.gif" title="
	      [list]
	      [*] - ����������� ������
	      [*] - ����������� ������
	      [*] - ����������� ������
	      [/list]
	      " border="0" width="22" height="22"></a></li>
	<li><a href="javascript:{void(0);}" onclick="javascript:{addtg('[p]',get_sel(),'[/p]')}" onfocus="this.blur()"><img src="/i/bbcode/pre.gif" title="[p]�����[/p]" border="0" width="22" height="22"></a></li>
	<li><a href="javascript:{void(0);}" onclick="javascript:{addtg('[quote]',get_sel(),'[/quote]')}" onfocus="this.blur()"><img src="/i/bbcode/quote.gif" title="[quote]������[/quote]" border="0" width="22" height="22"></a></li>
	<li><a onmouseover="gs();" href="javascript:{void(0);}" onclick="javascript:{addtg_()}" onfocus="this.blur()"><img src="/i/bbcode/quote2.gif" title="[quote]������[/quote] ��������� ���������� ����� ������ � ����� ���� �����" border="0" width="22" height="22"></a></li>
	<li><a href="javascript:{void(0);}" onclick="javascript:{addtg('�','','')}" onfocus="this.blur()"><img src="/i/bbcode/cp.gif" title="[copy] - ������ ���������" border="0" width="22" height="22"></a></li>
	<!-- <li><a href="javascript:{void(0);}" onclick="javascript:{addtg('[ps]',window.prompt('������� �����:',''+get_sel()),'[/ps]')}" onfocus="this.blur()"><img src="/i/bbcode/ps.gif" alt="[ps]P.S. - �����������[/ps]" border="0" width="22" height="22"></a></li> -->
	<!-- <li><a href="javascript:{void(0);}" onclick="javascript:{addtg('[nb]',window.prompt('������� �����:',get_sel()),'[/nb]')}" onfocus="this.blur()"><img src="/i/bbcode/nb.gif" alt="[nb]NB[/b]" border="0" width="22" height="22"></a></li> -->
	<li><a href="javascript:{void(0);}" onclick="javascript:{addtg('[sub]',window.prompt('������� �����:',get_sel()),'[/sub]')}" onfocus="this.blur()"><img src="/i/bbcode/sb.gif" title="[sub]��������� ������ �����[/sub]" border="0" width="22" height="22"></a></li>
	<li><a href="javascript:{void(0);}" onclick="javascript:{addtg('[sup]',window.prompt('������� �����:',get_sel()),'[/sup]')}" onfocus="this.blur()"><img src="/i/bbcode/sp.gif" title="[sup]��������� ������� �����[/sup]" border="0" width="22" height="22"></a></li>
	<li><a href="javascript:{void(0);}" onclick="javascript:{addtg('[h]',window.prompt('������� ���������:',get_sel()),'[/h]')}" onfocus="this.blur()"><img src="/i/bbcode/h1.gif" title="[h]���������[/h]" border="0" width="22" height="22"></a></li>
	<li><a href="javascript:{void(0);}" onclick="javascript:{addtg('[small]',window.prompt('������� �����:',get_sel()),'[/small]')}" onfocus="this.blur()"><img src="/i/bbcode/sm.gif" title="[small]������ �����[/small]" border="0" width="22" height="22"></a></li>
	<li><a href="javascript:{void(0);}" onclick="javascript:{addsm_2(window.prompt('������� �����:',get_sel()),window.prompt('������� �����:','http://www.'),'url','=')}" onfocus="this.blur()"><img src="/i/bbcode/l.gif" title="[url=URL]������[/url] ���������� � www. ��� http://" border="0" width="22" height="22"></a></li>
	<li><a href="javascript:{void(0);}" onclick="javascript:{addsm_2(window.prompt('������� �����:',get_sel()),window.prompt('������� E-mail:',''),'email','=')}" onfocus="this.blur()"><img src="/i/bbcode/em.gif" title="[email=e-mail]���� ������[/color]" border="0" width="22" height="22"></a></li>

    <?php if($allowImages) { ?>
          <li><a href="javascript:{void(0);}" onclick="javascript:{addtg('[img]',window.prompt('������� ������:','http://www.'),'[/img]')}" onfocus="this.blur()"><img src="/i/bbcode/im.gif" title="[img]���� � ��������[/img]" border="0" width="22" height="22"></a></li>
    <?php } ?>
    <!-- <li><a href="javascript:{void(0);}" onclick="javascript:{addtg('[off]',window.prompt('������� �����:',get_sel()),'[/off]')}" onfocus="this.blur()"><img src="/i/bbcode/off.gif" alt="[off]��������[/off] ��������� ������ ������������ �������" border="0" width="22" height="22"></a></li> -->
	<li><a href="javascript:{void(0);}" onclick="javascript:{addsm_2(window.prompt('������� �����:',get_sel()),window.prompt('������� ��� ����� ��� ��������:',''),'color','=')}" onfocus="this.blur()"><img src="/i/bbcode/cl.gif" title="[color=color_name]������� �����[/color] �������� ����� ��� ��� � #" border="0" width="22" height="22"></a></li>
	<li><a href="javascript:{void(0);}" onclick="javascript:{addsm_2(window.prompt('������� �����:',get_sel()),3,'size','=')}" onfocus="this.blur()"><img src="/i/bbcode/sz.gif" title="[size=size]������� �����[/size] ����� �����" border="0" width="22" height="22"></a></li>
	<!-- <li><a href="javascript:{void(0);}" onclick="javascript:{addtg('[code]',get_sel(),'[/code]')}" onfocus="this.blur()"><img src="/i/bbcode/cd.gif" title="[code]����� �������������������� ������ ��������� �� ����� ������ � �.�.[/code]" border="0" width="22" height="22"></a></li> -->
      </ul>
    </div>
</div>
<!--






-->