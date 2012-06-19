<?php
	App::uses('AppModel', 'Model');

	class Preference extends AppModel {	
		public $name = "Preference";
		
		public $belongsTo = array(
			'User'
		);
		
		public function getPref($user_id, $code) {
			$preference = $this->find('first', array('conditions' => array('user_id' => $user_id, 'code' => $code)));
			
			if (!empty($preference)) {
				return $preference['Preference']['value'];
			} else {
				return Configure::read('DiabloAH.' . $code);
			}
		}
		
		public function setPref($user_id, $code, $value) {
			$preference = $this->find('first', array('conditions' => array('Preference.user_id' => $user_id, 'code' => $code)));
			
			if (!empty($preference)) {
				$pref = array(
					'Preference' => array(
						'id' => $preference['Preference']['id'],
						'value' => $value
					)
				);
			} else {
				$pref = array(
					'Preference' => array(
						'user_id' => $user_id,
						'code' => $code,
						'value' => $value
					)
				);
			}
			
			if ($this->save($pref)) {
				return true;
			} else {
				return false;
			}
		}
	}
?>