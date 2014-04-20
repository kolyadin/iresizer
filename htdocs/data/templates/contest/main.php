<?
$this->_render('inc_header_main',
	array('title'=>'������� ������� � ���������� �����')
);
?>
<div id="contentWrapper" class="twoCols">
	<div id="content" class="content-contest">
		<div class="contest-cols">
			<div class="left-col">
				<p>��������� ������������ �������news � ���������� ��������� �����! � ��� ���� ���������� ����������� ������� �� �������� ������ ����� � ������, ���� ������� ���� ���������. �� ��������� ���������� �������, �� ����������� �������� ����� ������� 20 �����������. ��� ������� ������ �� �������� � ���-����, ������� ����� ���������� ����������� ������ � �������, � ��� ����� ����� ����� �������� �, ���� �������, ������������������ � ���. ����� ������� ����������� ����� �������� ������� �� ��������� ���������. ��� ��������� �������, ������� ����� �� ������.</p>
			</div>
			<div class="right-col">
				<a class="preview" href="/contest/rules">������ �������</a>
	`			<a class="preview" href="/contest/works">�������� ������</a>
				<?/*<a class="takePart" href="/contest/take_part">������� �������</a>*/?>
			</div>
		</div>
		
		<?if ($d['works_only_photos']) {?>
		<div class="contest-list">
			<h2><img src="/i/contest/h2-new-photo.gif" alt="" /></h2>
			<ul>
				<?foreach ($d['works_only_photos'] as &$work) {?>
				<li>
					<div class="item">
						<a href="/contest/work/<?=$work['id']?>"><img src="<?=$this->getStaticPath('/upload/contest/' . $work['small_image'])?>" alt="" /></a>
					</div>
					<span><a rel="nofollow" href="/profile/<?=$work['uid']?>"><?=$work['unick']?></a></span>
					<a href="/contest/work/<?=$work['id']?>"><?=$work['rating'] . ' ' . $p['declension']->get($work['rating'], '�����', '������', '�������')?></a>
				</li>
				<?}?>
			</ul>
		</div>
		<?}?>

		<?if ($d['works_only_videos']) {?>
		<div class="contest-list">
			<h2><img src="/i/contest/h2-new-video.gif" alt="" /></h2>
			<ul>
				<?foreach ($d['works_only_videos'] as &$work) {?>
				<li>
					<div class="item">
						<a href="/contest/work/<?=$work['id']?>"><img src="<?=$this->getStaticPath('/upload/contest/' . $work['small_image'])?>" alt="" /></a>
					</div>
					<span><a rel="nofollow" href="/profile/<?=$work['uid']?>"><?=$work['unick']?></a></span>
					<a href="/contest/work/<?=$work['id']?>"><?=$work['rating'] . ' ' . $p['declension']->get($work['rating'], '�����', '������', '�������')?></a>
				</li>
				<?}?>
			</ul>
		</div>
		<?}?>

		<?if ($d['works_best']) {?>
		<div class="voted-liders">
			<h2><img src="/i/contest/h2-voted-liders.gif" alt="" /></h2>
			<table>
				<?$i = 0; foreach ($d['works_best'] as &$work) {?>
				<tr>
					<td class="number"><?=(++$i)?></td>
					<td class="ava"><img src="<?=$this->getStaticPath($this->getUserAvatar($work['uavatara']))?>" alt="" /></td>
					<td class="votes"><b><?=$work['rating']?></b> <?=$p['declension']->get($work['rating'], '�����', '������', '�������')?></td>
					<td class="nick"><a rel="nofollow" href="/profile/<?=$work['uid']?>"><?=$work['unick']?></a></td>
					<td class="city"><a href="/users_city/<?=$work['ucity_id']?>"><?=$work['ucity']?></a></td>
				</tr>
				<?}?>
			</table>
		</div>
		<?}?>

	</div> 
	<?$this->_render('inc_right_column');?>
</div>
<?$this->_render('inc_footer');?>