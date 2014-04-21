<?$this->_render('inc_header', array('title' => '����� ������', 'header' => '����� ������', 'top_code' => 'C', 'header_small' => '����� ������'));?>
<div id="contentWrapper" class="twoCols">
	<div id="content">
		<ul class="menu">
			<li><a href="/community/group/<?=$d['group']['id']?>">������</a></li>
			<li><a href="/community/group/<?=$d['group']['id']?>/topics">����������</a></li>
			<li class="active"><a href="/community/group/<?=$d['group']['id']?>/albums">����</a></li>
			<li><a href="/community/group/<?=$d['group']['id']?>/members">���������</a></li>
			<li><a href="/community/group/<?=$d['group']['id']?>/newsfeed">����������</a></li>
		</ul>
		<ul class="menu bLevel">
			<li><a href="/community/group/<?=$d['group']['id']?>/album/<?=$d['album']['id']?>">��� ����</a></li>
			<?if ($d['isAMember']) {?><li class="active"><a href="/community/group/<?=$d['group']['id']?>/album/<?=$d['album']['id']?>/addPhotos">��������� ����</a></li><?}?>
			<?if ($d['canModifyGroup']) {?><li><a href="/community/group/<?=$d['group']['id']?>/album/<?=$d['album']['id']?>/deletePhotos">������� ����</a></li><?}?>
		</ul>
		
		<?if (isset($d['error'])) {?><h4><?=$d['error']?></h4><?}?>
		<div class="communityAddAlbumPhoto">
			<form action="" method="POST" enctype="multipart/form-data" class="answer">
				<input type="hidden" name="type" value="community">
				<div class="rules">
					<h3>������� ��� �������� ����������:</h3>
					<ol>
						<li>������ ���������� ������ ���� �� ����� 350*450 �����.</li>
						<li>������ ���������� � JPEG/JPG</li>
						<li>�� ���� �� ������ ���� ������� ������ �� �����, � ������� ��� ���� �������. ������������ ������� �� ������� ����� ���������� � ���������� � ���������</li>
						<li>������� �� ��������� ������������� ��������.</li>
					</ol>
				</div>
				<input type="file" name="photo[]" />
				<input type="file" name="photo[]" />
				<input type="file" name="photo[]" />
				
				<input type="submit" value="���������" />
			</form>
		</div>
	</div>
	<?$this->_render('inc_right_column');?>
</div>
<?$this->_render('inc_footer');?>