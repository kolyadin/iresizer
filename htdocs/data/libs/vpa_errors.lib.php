<?php

class vpa_errors {
	public $errors;

	public function vpa_errors() {
		$this->errors = array(
			'no_email' => array('title' => '������ E-mail', 'msg' => '�� �� ������� ���� e-mail', 'link' => '', 'header' => HTTP_STATUS_200),
			'empty_pass' => array('title' => '������ ������', 'msg' => '�� �� ������� ������', 'link' => '', 'header' => HTTP_STATUS_200),
			'no_login' => array('title' => '�� �� ����������������', 'msg' => '��� ������� � ������ ��������, �� ������ ���� ������������. ���� �� ��� �� ���������������� �� ����� �����, �� ������ ������� ��� ������� �� ������ "<a href="/register/">�����������</a>".', 'link' => '<a href="javascript:window.history.back();">�����</a>', 'header' => HTTP_STATUS_200),
			'auth_fail' => array('title' => '������ �����������', 'msg' => '������ �������, ��������� ��������� ���������� � �� ������ �� ������� Caps Lock', 'link' => '', 'header' => HTTP_STATUS_200),
			'404' => array('title' => '�������� �� �������', 'msg' => '�� ��������� ��������, ������� �� ����������. ��������� ��� �� ��������� ������� ����� ��������, ��� ���������� ����� ������ ��� �������� ����� � �������.', 'link' => '<a href="javascript:window.history.back();">�����</a>', 'header' => HTTP_STATUS_404),
			'401' => array('title' => '��������� �����������', 'msg' => '������ ��� ���������� ����� ��������', 'link' => '<a href="javascript:window.history.back();">�����</a>', 'header' => HTTP_STATUS_404),
			'small_rating' => array('title' => '��� ������� ������� ���', 'msg' => '��� ���������� ����� ��������� ��� ���������� ����� ������� �������. �� ������ ������� ������� � ������� ���������� ������������ � �������� ��� ��������� �� ���� ���������� ����� ������� ������� ��� ������.', 'link' => '', 'header' => HTTP_STATUS_403),
			'db_error' => array('title' => '������', 'msg' => '�� ����� ���������� �������� ��������� ������. ���������� ��������� �������� �������, � ���� ������ ����������� - ���������� � ��������������.', 'link' => '', 'header' => HTTP_STATUS_200),
			'short_query' => array('title' => '�������� ������', 'msg' => '�� ����� ������� �������� ������. ��� ����� �� ������ ���� ����� 3-� ��������.', 'link' => '', 'header' => HTTP_STATUS_200),
			'unsubscribe' => array('title' => '�� ������� ����������', 'msg' => '�� ���������� �� ��������� ����� � ��������� ����� ���������.', 'link' => '', 'header' => HTTP_STATUS_200),
			'user_register' => array('title' => '�� ������� ������������������.', 'msg' => '��� ��������� ����������� �� ������ ����������� ���� �������� ����, ������� �� ��������� ���� e-mail ���� ������� ������ � ����� �������������.', 'link' => '', 'header' => HTTP_STATUS_200),
			'user_commit' => array('title' => '�� ������� ������������������.', 'msg' => '�����������! ��� ������� �����������.', 'link' => '', 'header' => HTTP_STATUS_200),
			'user_reject' => array('title' => '��������� ���� ��� �������.', 'msg' => '��������� ���� ��� �������, ��������� ������������ ������������� ���� ������.', 'link' => '', 'header' => HTTP_STATUS_200),
			'limit_photos_exceed' => array('title' => '����� ������� ���������� ��������', 'msg' => '�� ��������� ����� ������� ���������� (6 ���������� � ����) �� �������.', 'link' => '', 'header' => HTTP_STATUS_200),
			'email_failed' => array('title' => 'Email �� ���������.', 'msg' => 'Email �� ����� ���� ������.', 'link' => '', 'header' => HTTP_STATUS_200),
			'pass_sended' => array('title' => '������ ������.', 'msg' => '��� ������ ��� ������ �� �����, ��������� ���� ��� �����������.', 'link' => '', 'header' => HTTP_STATUS_200),
			'user_not_found' => array('title' => '������������ �� ������', 'msg' => '������������������� ������������ � ����� e-mail-�� �� ����������.', 'link' => '', 'header' => HTTP_STATUS_200),
			'subscribe_successful' => array('title' => '�� ��� !', 'msg' => '����������� ��� ! �� �������� � ������.', 'link' => '', 'header' => HTTP_STATUS_200),
			'unsubscribe_successful' => array('title' => '�� �������� ������', 'msg' => '', 'link' => '', 'header' => HTTP_STATUS_200),
			'empty_msg' => array('title' => '������ ���������', 'msg' => '������ ��������� �� �����������.', 'link' => '', 'header' => HTTP_STATUS_200),
			'friend_sent' => array('title' => '�� ��� ��������� ��� � ������', 'msg' => '�� ��� ��������� ��� � ������, ������� ������ ��� ������ ��������� �� �����.', 'link' => '', 'header' => HTTP_STATUS_200),
			'not_confirmed' => array('title' => '�� �� � ������� � ������', 'msg' => '�� �� �������� � ������ � �� �������� �����.', 'link' => '', 'header' => HTTP_STATUS_200),
			'user_banned' => array('title' => '�� �� ������ ������ ���������', 'msg' => '�� ���� �������� � �� ������ ������ �� ������ ������ ���������.', 'link' => '', 'header' => HTTP_STATUS_200),
			'user_spamer' => array('title' => '�� �� ������ ������ ���� ���������', 'msg' => '�� �� ������ ������ ���������� ��������� � ����� ����, ��� ��������� ������.', 'link' => '', 'header' => HTTP_STATUS_200),
			'file_error' => array('title' => '���� ������ ���� ������������', 'msg' => '���� ������ ���� ������������', 'link' => '', 'header' => HTTP_STATUS_200),
			'too_many_files' => array('title' => '�������� ����� ������', 'msg' => '�������� ����� ������', 'link' => '', 'header' => HTTP_STATUS_200),

			'no_money' => array('title' => '���� ������� �������', 'msg' => '� ��� ������������ �������. ��������� ������', 'link' => '', 'header' => HTTP_STATUS_200),
			'free_gifts_limit' => array('title' => '����� ��������', 'msg' => '��������� ������������!<br />�� ������ ��������� 1 ���������� ������� � �����.<br />��� ����� �� ������� ��������.', 'link' => '<a href="javascript:window.history.back();">�����</a>', 'header' => HTTP_STATUS_200),

			'ask_already_exists' => array('title' => '����� ������ ��� ��������', 'msg' => '��������� ������������!<br />����� ������ ��� ��������, ���������� �������� ��� �� ������ ���������.', 'link' => '<a href="javascript:window.history.back();">�����</a>', 'header' => HTTP_STATUS_200),
			// community
			'community_delete_albums_have_photos' => array('title' => '� ����� ������� ��� ���� ����������', 'msg' => '� ����� ������� ��� ���� ����������.<br />������� ������� ��.', 'link' => '<a href="javascript:window.history.back();">�����</a>', 'header' => HTTP_STATUS_200),
			'community_user_is_not_a_member' => array('title' => '�� �� �������� � ��� ������', 'msg' => '�� �� �������� � ��� ������.<br />������� ����� ��������.', 'link' => '<a href="javascript:window.history.back();">�����</a>', 'header' => HTTP_STATUS_200),
			'community_no_access_to_album' => array('title' => '�� �� �������� � ��� ������', 'msg' => '�� �� ������ ������������� ������� �������� ������.<br />������� ����� ��������.', 'link' => '<a href="javascript:window.history.back();">�����</a>', 'header' => HTTP_STATUS_200),
			// yourstyle_image_tranform
			'yourstyle_image_tranform' => array('title' => '�� ������� ������������� �����������', 'msg' => '�� ������� ������������� �����������<br />���������� �������� ����������� �������� �������.', 'link' => '<a href="javascript:window.history.back();">�����</a>', 'header' => HTTP_STATUS_200),

		    // fanfics errors
		    'fanfic_content_4000' => array('title' => '������ �������', 'msg' => '����� ������ �� ����� ��������� ����� 4000 ������', 'link' => '<a href="javascript:window.history.back();">�����</a>', 'header' => HTTP_STATUS_200),
		    'fanfic_announce' => array('title' => '������ �������', 'msg' => '����� ������ �� ����� ���� ������', 'link' => '<a href="javascript:window.history.back();">�����</a>', 'header' => HTTP_STATUS_200),
		    'fanfic_name' => array('title' => '�� �� ������� ���� ��� �������', 'link' => '<a href="javascript:window.history.back();">�����</a>', 'header' => HTTP_STATUS_200),

            'private_settings' => array(
                'title' => '������ �����������',
                'msg' => '��������� ����������� �� ��������� ��� ������ ���������',
                'link' => '<a href="javascript:window.history.back();">�����</a>',
                'header' => HTTP_STATUS_200),
		);
	}

	public function get($error) {
		$data = $this->errors[$error];
		if (!empty($data)) {
			return $data;
		}
		return $this->errors['404'];
	}
}
