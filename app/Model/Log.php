<?php
	App::uses('AppModel', 'Model');

	class Log extends AppModel {
		public $name = "Log";
		
		public $belongsTo = array(
			'User', 'Item'
		);
	}
?>