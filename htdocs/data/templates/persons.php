<?
$this->_render('inc_header',array('title'=>'�������','header'=>'�������','top_code'=>'*','header_small'=>'����� �������������'));?>
			<div id="contentWrapper" class="twoCols">
				<div id="content">
					<ul class="menu">
						<li><a href="/persons">�������</a></li>
						<li><a href="/persons/all">���</a></li>
					</ul>
					<form action="/persons/search" method="post" class="searchbox">
					<input type="hidden" name="type" value="persons">
					<input type="hidden" name="action" value="search">
						<fieldset>
							<label>
								����� �� �����
								<input type="text" name="search" value="<?=htmlspecialchars($d['search'])?>"/>
							</label>
							<input type="submit" value="�����" />
						</fieldset>
					</form>
			  <?if(!empty($d['search'])&&strlen($d['search'])<3){?>
                    <div class="systemMessage"><h4>�� ����� ������� �������� ������.<br>��� ����� �� ������ ���� ����� 3-� ��������.</h4></div><br>
                    <?}else{
                    $search_url = (!empty($d['search']))?'/'.urlencode($d['search']):'';
                    $persons = $p['query']->get('persons_rating',array('search'=>mysql_real_escape_string($d['search'])),array($d['sort']),null,null);
                    if(count($persons)>0){
			  ?>
					<table class="personsRate">
						<tr>
							<th>&nbsp;</th>
							<th class="person">�������</th>
							<th><a href="/persons/search/sort/rating<?=($d['sort']!='rating desc' ? '_desc' : '').$search_url?>">������������</a></th>
							<th><a href="/persons/search/sort/talant<?=($d['sort']!='talant desc' ? '_desc' : '').$search_url?>">������</a></th>
							<th><a href="/persons/search/sort/style<?=($d['sort']!='style desc' ? '_desc' : '').$search_url?>">�����</a></th>
							<th><a href="/persons/search/sort/face<?=($d['sort']!='face desc' ? '_desc' : '').$search_url?>">���������</a></th>
							<th><a href="/persons/search/sort/fans<?=($d['sort']!='fans desc' ? '_desc' : '').$search_url?>">����������</a></th>
						</tr>
						<?foreach ($persons as $i => $person) {?>
						<tr>
							<td class="num"><?=$i+1?></td>
							<td class="person"><a href="/persons/<?=$handler->Name2URL($person['eng_name']);?>"><?=$person['name']?></a></td>
							<td><strong><?printf("%.1f",$person['rating']/10)?></strong></td>
							<td><?=ceil($person['talant'])/10==10 ? ceil($person['talant'])/10 : sprintf("%.1f",$person['talant']/10)?></td>
							<td><?=ceil($person['style'])/10==10? ceil($person['style'])/10 : sprintf("%.1f",$person['style']/10)?></td>
							<td><?=ceil($person['face'])/10==10 ? ceil($person['face'])/10 : sprintf("%.1f",$person['face']/10)?></td>
							<td><?printf("%d",$person['fans'])?></td>
						</tr>
						<?}?>
					</table>
			  <?}else{?>
                       <div class="systemMessage"><h4>�� ������ ������� ������ �� �������.</h4></div>
			<?}
			}?>
				</div>
				<?$this->_render('inc_right_column');?>
			</div>
<?$this->_render('inc_footer');?>
