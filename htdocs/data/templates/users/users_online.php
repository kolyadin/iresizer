<?
$this->_render('inc_header',array('title'=>'������������','header'=>'������������','top_code'=>'*','header_small'=>'������ �� �����'));?>
			<div id="contentWrapper" class="twoCols">
				<div id="content">
	            <ul class="menu">
	                <li><a href="/users/">������������</a></li>
	                <?/*<li><a href="/users_all/">���</a></li>*/?>
	                <li><a href="/users_top/">���</a></li>
	                <li class="active"><a href="/users_online/">on-line</a></li>
	                <?=$d['ucity_id']!=''&&$d['ucity']!=''?'<li><a href="/users_city/'.$d['ucity_id'].'">� ����� ������ <em>('.$d['ucity'].')</em></a></li>':''?>
	            </ul>
                    <?
					$u_online=new VPA_online();
                    $users_online=$u_online->get_online_users(array('nick'));
                    if(count($users_online)>1){?>
					<ul class="users users-online">
						<?$li = 0; foreach ($users_online as $i => $user) {?>
						<li>
							<a class="ava" rel="nofollow" href="/profile/<?=$user['id']?>">
								<img src="<?=$this->getStaticPath($this->getUserAvatar($user['avatara']))?>"/>
							</a>
							<a rel="nofollow" href="/profile/<?=$user['id']?>"><?=preg_replace(array("/</","/>/"),array("&lt;","&gt;"),$user['nick'])?></a>
						</li>
						<?
							$li++;
							echo ($li%4) == 0 ? '<li class="divider"></li>' : null;
						}
						?>

					</ul>
					<?}else{?>
					<h4>� ������ ������ on-line ��� �������������.</h4>
					<?}?>
				</div>
				<?$this->_render('inc_right_column');?>
			</div>
<?$this->_render('inc_footer');?>
