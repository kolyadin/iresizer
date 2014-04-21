<?$this->_render('inc_header', array('title' => '����� ����������', 'header' => '����� ����������', 'top_code' => 'C', 'header_small' => '����� ����������'));?>
<div id="contentWrapper" class="twoCols">
	<div id="content">
		<ul class="menu">
			<li><a href="/community/group/<?=$d['group']['id']?>">������</a></li>
			<li class="active"><a href="/community/group/<?=$d['group']['id']?>/topics">����������</a></li>
			<li><a href="/community/group/<?=$d['group']['id']?>/albums">����</a></li>
			<li><a href="/community/group/<?=$d['group']['id']?>/members">���������</a></li>
			<li><a href="/community/group/<?=$d['group']['id']?>/newsfeed">����������</a></li>
		</ul>
		<ul class="menu bLevel">
			<li><a href="/community/group/<?=$d['group']['id']?>/topics">��� ����</a></li>
			<?if ($d['isAMember']) {?>
			<li class="active"><a href="/community/group/<?=$d['group']['id']?>/topic/add">������� ����</a></li>
			<li><a href="/community/group/<?=$d['group']['id']?>/topic/addPoll">������� �����</a></li>
			<?}?>
		</ul>
		<?if (isset($d['error'])) {?><h4><?=$d['error']?></h4><?}?>
		
		<div class="communityAddTopic">
			<form action="" method="POST" class="answer">
				<input type="hidden" name="type" value="community" />
				<input type="text" name="title" maxlength="255" />
				<textarea name="description"></textarea>
				
				<input type="submit" value="���������" />
			</form>
		</div>
	</div>
	<?$this->_render('inc_right_column');?>
</div>
<?$this->_render('inc_footer');?>