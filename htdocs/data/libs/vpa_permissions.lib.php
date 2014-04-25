<?php

class vpa_permissions {

	public $client;
	public $agent;
	public $type;
	public $action;
	public $user_type;

	public function vpa_permissions($user, $type, $action, $rewrite) {
		$this->user = $user;
		$this->type = $type;
		$this->action = $action;

		if (empty($this->user)) {
			$this->user_type = 'anonym';
		} elseif (!empty($this->user)) {
			$this->user_type = 'user';
		}
	}

	public function test() {
		$types = array();
		// ����������� �������
		// �������� ��������������� ����� � ���������
		// ��� ������� �������� (��� * - ���� ��� ���� ��������) ��������� ����� pipe ���� user_type-��, ������� ������ � ���� ��������
		$types['*'] = array('*' => 'anonym');
		$types['profile'] = array('default' => 'user', '*' => 'user');
		$types['opinion'] = array('*' => 'user');
		$types['message'] = array('post' => 'user');
		$types['ajax'] = array(
			'*' => 'user',
			'users' => 'anonym|user',
			'cities' => 'anonym|user',
			'persons_list' => 'anonym|user',
			'gallery' => 'anonym|user',
			'person_search' => 'anonym|user',
			'meet_vote' => 'anonym|user',
			'kid_vote' => 'anonym|user',
			'new_vote' => 'anonym|user',
			'person_vote' => 'anonym|user',
			'fact_vote' => 'anonym|user'
		);
		$types['comment'] = array('add' => 'user', 'edit' => 'user');
		$types['message'] = array('post' => 'user', 'edit' => 'user');
		$types['chat_message'] = array('post' => 'user', 'edit' => 'user');
		$types['fanfic'] = array('comment_add' => 'user', 'comment_edit' => 'user', 'add' => 'user', 'edit' => 'user', '*' => 'anonym|user');
		$types['user'] = array('*' => 'user');
		$types['status'] = array('*' => 'user');
		$types['statuses'] = array('*' => 'user');
		$types['unsub'] = array('*' => 'user');

		// ���������, ������������ �� ���� �������� � ������, ��������� ����������
		// ���� ���, �� ����� ��� ��� ����� �����
		if (!isset($types[$this->type])) {
			return true;
		}
		$actions = $types[$this->type];

		foreach ($actions as $action => $perm) {
			$perms = explode("|", $perm);
			// ���� �� ������� ������������������ ������� �� ���� ��������� - �� ����� �������� ������ *
			// ���� �������� ��������, ������� ��������� �� ��������� �������
			if (($action == '*' || $action == $this->action) && in_array($this->user_type, $perms)) {
				return true;
			}
		}
		// ���� �� ����� ������� �� ���� ������� �� ��������� - ������ � ��� ������ "�� �������, ����� �������, � ����� ��������" (�) �����������
		return false;
	}

}

?>