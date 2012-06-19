<?php
	App::uses('AppModel', 'Model');

	class ItemStat extends AppModel {
		public $name = "ItemStat";
		
		public $belongsTo = array(
			'Item', 'Stat'
		);
	}
?>