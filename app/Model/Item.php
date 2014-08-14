<?php
	App::uses('AppModel', 'Model');

	class Item extends AppModel {
		public $name = "Item";

		public $hasMany = array(
			'ItemStat', 'Log'
		);
		
		public $belongsTo = array(
			'Category', 'Rarity', 'Type'
		);
		
		public $validate = array(
			'name' => array(
				'rule' => 'notEmpty',
				'message' => 'Please provide the Loot\'s Name.',
				'required' => true
			),
			'rarity_id' => array(
				'rule' => 'notEmpty',
				'message' => 'Please select the Loot\'s Rarity.',
				'required' => true
			),
			'category_id' => array(
				'rule' => 'notEmpty',
				'message' => 'Please select the Loot\'s Category.',
				'required' => true
			),
			'type_id' => array(
				'rule' => 'notEmpty',
				'message' => 'Please select the Loot\'s Type.',
				'required' => true
			),
			'required_level' => array(
				'isEmpty' => array(
					'rule' => 'notEmpty',
					'message' => 'Please provide the Loot\'s Required Level.',
					'required' => true
				),
				'isValid' => array(
					'rule' => array('range', 0, 61),
					'message' => 'Required Level is between 1 to 60.'
				),
			),
			'vendor_value' => array(
				'isEmpty' => array(
					'rule' => 'notEmpty',
					'message' => 'Please provide the Loot\'s Sell Value.',
					'required' => true
				),
				'isValid' => array(
					'rule' => array('comparison', '>', 0),
					'message' => 'Sell Value must be a number greater than 0.'
				)
			),
			'primary_stat' => array(
				'isValid' => array(
					'rule' => array('comparison', '>', 0),
					'message' => 'Primary Stat Value must be a number greater than 0.',
					'allowEmpty' => true
				)
			),
			'paid' => array(
				'isNumeric' => array(
					'rule' => array('numeric'),
					'message' => 'Bought For Value must be a number.',
					'allowEmpty' => true
				),
				'isValid' => array(
					'rule' => array('comparison', '>=', 0),
					'message' => 'Bought For Value must be greater than or equal to 0.',
				)
			),
			'bid' => array(
				'bidOrBuyout' => array(
					'rule' => 'bidBuyoutCheck',
					'message' => 'Please provide the Loot\'s Bid or Buyout Value.'
				),
				'isValid' => array(
					'rule' => array('comparison', '>', 0),
					'message' => 'Bid Value must be a number greater than 0.',
					'allowEmpty' => true
				)
			),
			'buyout' => array(
				'bidOrBuyout' => array(
					'rule' => 'bidBuyoutCheck',
					'message' => 'Please provide the Loot\'s Bid or Buyout Value.'
				),
				'isValid' => array(
					'rule' => array('comparison', '>', 0),
					'message' => 'Buyout Value must be a number greater than 0.',
					'allowEmpty' => true
				)
			)
		);
		
		public function bidBuyoutCheck() {
			if( (isset($this->data['Item']['bid']) && !empty($this->data['Item']['bid'])) || (isset($this->data['Item']['buyout']) && !empty($this->data['Item']['buyout'])) ) {
				return true;
			}
			return false;
		}
	}
?>