<?$this->_render('inc_header', array('header' => '������ ������', 'top_code' => '*', 'title' => '������ ������'));?>
<?php
$fromProfile = strpos($_SERVER['REQUEST_URI'], 'user') !== false;
$firstTime = $fromProfile ? $d['firstTime'] : false;
?>
<style>
.quess_instructions dl dt {
	font-weight: bold;
}
</style>
<div id="contentWrapper" class="twoCols">
	<div id="content">
		<ul class="menu">
			<li class="active">����</li>
			<?php if(!$firstTime && count($d['ratingData']) > 0) { ?>
			<li><a href="/games/guess_star/rating<?=($fromProfile ? '/profile' : '');?>">������� ����������</a></li>
			<?php } ?>
		</ul>
		<div class="start_game">
			<img class="fon" src="/i/quess/start_game_f.jpg" alt="" />
			<p>���� ��� ��������� ������������, �� ������� �� �� �������� ��� ������ ������, ��, �������, ���� �� �� ������ � ����. �� ���������� ��� ��������� � ����, ������ ������� � ���� "������ ������".</p>
			<a href="/games/guess_star/start"></a>
		</div>
		<div class="quess_instructions">
			<img src="/i/quess/example.jpg" width="332" height="269" alt="��� ����" />
			<p>� ��� ���� 50 ������ ��� ����, ����� ������� ��� ����� ������ ��������� ���. � ������ ���������� ����������� 4 �������� ������. �� ������ ���������� ����� � ������ ������� ������������ 3 �������, � �� ������������ ��������� 10 ������. </p>
			<p>���� �������������, ��� ������ � ��� ������������� �����. � ���� ���� �� ������ ��������������� �����������:</p>
			<dl>
				<dt>50/50</dt><dd>� ������ ��� ������������ ������</dd>
				<dt>5 ������</dt><dd>� �������������� ���� ������</dd>
				<dt>����������</dt><dd>� ���������� ������</dd>
			</dl>
			<p>���� �� �� ����� ���� ������������ �������� ��� ���������� � ������ ���� � ���� ����� ��������� �����������.</p>
		</div>
		<?php if(count($d['ratingData']) > 0) {?>
		<table class="rating_quess" cellpadding="0" cellspacing="0">
			<caption>������� ����������</caption>
			<col />
			<thead>
				<tr>
					<td>&nbsp;</td>
					<td style="text-align:left;color:#000;">������������</td>
					<td class="quess">������� �����</td>
					<td class="time">����� ����</td>
					<td class="attempt">�������</td>
				</tr>
			</thead>
			<tbody>
				<?$kk=1;?>
				<?foreach ($d['ratingData'] as $row) {?>
				<tr>
					<td><?=$kk++;?></td>
					<td>
						<a rel="nofollow" href="/profile/<?=$row['uid']?>" class="ava">
							<img src="<?=$this->getStaticPath($this->getUserAvatar($row['avatara']))?>" alt="" />
							<?=htmlspecialchars($row['nick'], ENT_IGNORE, 'cp1251', false);?>
						</a>
					</td>
					<td class="quess"><?=$row['answers_right']?></td>
					<td class="time"><?=$p['time']->writeTime($row['time'])?></td>
					<td class="attempt"><?=$row['attempts']?></td>
				</tr>
				<?}?>
			</tbody>
		</table>
		<?php } ?>
	</div>
	<?$this->_render('inc_right_column');?>
</div>
<?$this->_render('inc_footer');?>