<form class="questionnaireForm newPhotos" method="POST" action="/index.php" enctype="multipart/form-data">
	<input type="hidden" name="type" value="persons">
	<input type="hidden" name="action" value="add_photo">
	<input type="hidden" name="pid" value="<?=$d['person']['id']?>">
	<div class="rules">
		<h3>������� ��� �������� ����������:</h3>
		<ol>
			<li>������ ���������� ������ ���� �� ����� 350*450 �����.</li>
			<li>������ ���������� � JPEG/JPG</li>
			<li>�� ���� �� ������ ���� ������� ������ �� �����, � ������� ��� ���� �������. ������������ ������� �� ������� ����� ���������� � ���������� � ���������</li>
			<li>���� ��������� ������ �������������.</li>
			<li>���� �� �� ������� ����� ���� � �������, �� ����� ������� �� �� ��������� ���. ���� ��� ��� �� ���� ������������, ���� �� ������� �� �������. �� ���������� ���������� ������� �� ����� ��� �� ��������.</li>
			<li>����� ���, ��� ������� ����������, ���������: �������� ������ ���� ��� ������������ � �������. </li>
			<li>������� �� ��������� ������������� ��������.</li>
		</ol>
	</div>
	<label>
		<input type="file" name="photo[]" />
		<span>���� 1</span>
	</label>
	<label>
		<input type="file" name="photo[]" />
		<span>���� 2</span>
	</label>
	<label>
		<input type="file" name="photo[]" />
		<span>���� 3</span>
	</label>
	<input type="submit" value="���������" />
</form>