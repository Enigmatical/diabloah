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
					'rule' => array('between', 5, 50),
					'message' => 'Please provide a username (between 5 and 50 characters long).',
					'allowEmpty' => false
				),
				'username-rule-2' => array(
					'rule' => 'isUnique',
					'message' => 'An account with this username already exists.'
				),
				'username-rule-3' => array(
					'rule' => 'notEmpty',
					'message' => 'Your username cannot be blank.'
				)
			),
			'password' => array(
				'password-rule-1' => array(
					'rule' => array('between', 3, 30),
					'message' => 'Passwords must be between 3 and 30 characters long.',
				),
				'password-rule-2' => array(
					'rule' => 'notEmpty',
					'message' => 'Your password cannot be blank.'
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
