<?$this->_render('inc_header',array('title'=>'�����������','header'=>'�����������','top_code'=>'','header_small'=>''));?>
			<div id="contentWrapper" class="twoCols">
				<div id="content">
				<h2>�����������</h2>
					<form class="questionnaireForm authForm" method="post" action="index.php">
					<input type="hidden" value="login" name="type"/>
						<label>
					        <strong>E-mail</strong>
					        <input type="text" name="email" />
						</label>
						<label>
					        <strong>������</strong>
					        <input type="password" name="pass" />
						</label>
						<input type="submit" value="���������" />
					</form>
				</div>
				<?$this->_render('inc_right_column');?>
			</div>
<?$this->_render('inc_footer');?>
