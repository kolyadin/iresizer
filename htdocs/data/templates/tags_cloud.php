<? $this->_render('inc_header', array('title' => '�������', 'header' => '�������', 'top_code' => '*', 'header_small' => '��� ������')); ?>
			<div id="contentWrapper" class="twoCols">
				<div id="content">
					<ul class="menu">
						<li><a href="/persons">�������</a></li>
						<li class="active"><a href="/persons/all">���</a></li>
					</ul>
					<form action="/persons/search" method="post" class="searchbox">
					<input type="hidden" name="type" value="persons">
					<input type="hidden" name="action" value="search">
						<fieldset>
							<label>
								����� �� �����
								<input type="text" name="search" value="" class="suggest" onclick="return {url:'/ajax/person_search/'}" />
							</label>
							<input type="submit" value="�����" />
						</fieldset>
					</form>
					<ul class="tagCloud">
						<? foreach ($d['all_tags'] as $i => $tag) { ?>
							<li class="<?=$tag['class']?>"><a href="/persons/<?=$handler->Name2URL($tag['eng_name']);?>"><?=$tag['name']?></a></li>
						<?}?>
					</ul>
				</div>
				<? $this->_render('inc_right_column'); ?>
			</div>
<? $this->_render('inc_footer'); ?>