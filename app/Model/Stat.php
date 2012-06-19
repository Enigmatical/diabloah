<?php
	App::uses('AppModel', 'Model');

	class Stat extends AppModel {
		public $name = "Stat";
		
		public $hasOne = array(
			'Category'
		);
		
		public $hasMany = array(
			'ItemStat'
		);
		
		public $belongsTo = array(
			'ItemStat'
		);
	}
?>