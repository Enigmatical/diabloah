<?php
	App::uses('AppModel', 'Model');
	App::uses('AuthComponent', 'Controller/Component');

	class User extends AppModel {
		public $name = "User";

		public $hasMany = array(
			'Item', 'Preference', 'Log'
		);
		
		public $validate = array(
			'username' => array(
				'username-rule-1' => array(
					'rule' => 'email',
					'required' => true,
					'message' => 'Please provide a valid email address.'
				),
				'username-rule-2' => array(
					'rule' => 'isUnique',
					'message' => 'An account with this email already exists.'
				)
			),
			'password' => array(
				'password-rule-1' => array(
					'rule' => array('between', 3, 30),
					'required' => true,
					'message' => 'Passwords must be between 3 and 30 characters long.'
				)
			)
		);
		
		public function beforeSave() {
			if (isset($this->data[$this->alias]['password'])) {
				$this->data[$this->alias]['password'] = AuthComponent::password($this->data[$this->alias]['password']);
			}
			return true;
		}
	}
?>