<?$this->_render('inc_header', array('header' => '������ ������', 'top_code' => '*', 'title' => '������ ������'));?>
<?php 
$fromProfile = strpos($_SERVER['REQUEST_URI'], 'profile') !== false;
?>
<div id="contentWrapper" class="twoCols">
	<div id="content">
		<ul class="menu">
			<li><a href="/games/guess_star/instructions<?=($fromProfile ? '/user' : '');?>">����</a></li>
			<li class="active">������� ����������</li>
		</ul>
		<table class="quess_film_stat" cellpadding="4">
			<tr>
				<td rowspan="3"><h3>����<br />����������</h3></td>
				<td><h5>����� � ��������</h5></td>
				<td><h4>������ ����:</h4></td>
				<td>&nbsp;</td>
				<td><h4>�� ��� ����:</h4></td>
				<td>&nbsp;</td>
			</tr>
			<tr>
				<td><span class="place"><?=$d['place']?></span></td>
				<td>������� ������</td>
				<td><span><?=$d['currentUserBestGame']['answers_right']?></span></td>
				<td>������� ������</td>
				<td><span><?=$d['currentUserAllGames']['answers_right']?></span></td>
			</tr>
			<tr>
				<td><span>�� <span class="all_games"><?=$d['numberOfGames']?></span> <?=$p['declension']->get($d['numberOfGames'], '����', '����', '���')?></span></td>
				<td>����� ����</td>
				<td><span><?=$p['time']->writeTime($d['currentUserBestGame']['time'])?></span></td>
				<td>����� ����</td>
				<td><span><?=$p['time']->writeTime($d['currentUserAllGames']['time'])?></span></td>
			</tr>
		</table>
		<?php if(count($d['ratingData'])) { ?>
		<table class="rating_quess" cellpadding="0" cellspacing="0">
			<caption>������ ������</caption>
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
		<?if ($d['numPages'] > 1) {?>
		<div>
			<div class="paginator smaller">
				<p class="pages">��������:</p>
				<ul>
					<?foreach ($p['pager']->make($d['page'], $d['numPages'], 20) as $i => $pi) { ?>
					<li>
						<?if (!isset($pi['current'])) {?>
						<a href="/games/guess_star/rating/<?=$pi['link']?>"><?=$pi['text']?></a>
						<?} else {?>
						<?=$pi['text']?>
						<?}?>
					</li>
					<?}?>
				</ul>
			</div>
		</div>
		<?}}?>
	</div>
	<?$this->_render('inc_right_column');?>
</div>
<?$this->_render('inc_footer');?>