<?php
	App::uses('AppController', 'Controller');
	
	class ItemsController extends AppController {
		public $uses = array(
			'Item', 'Rarity', 'Category', 'Log', 'ItemStat', 'Preference'
		);
		
		public $components = array('Session');
	
		public function index() { 
			$user_id = $this->Auth->user('id');
		
			$auctions = array();
			
			/* Auction Houses */
			# Gold 			== 1
			# Gold Hardcore	== 2
			# RMAH 			== 3
			# RMAH Hardcore	== 4 
		
			$auctions['gold']['normal']['auctions'] = 	$this->Item->find('all', array('conditions' => array('user_id' => $user_id, 'status' => 1, 'auction_house' => 1), 'order' => 'Item.name'));
			$auctions['gold']['normal']['sales'] = 		$this->Item->find('all', array('conditions' => array('user_id' => $user_id, 'status' => 2, 'auction_house' => 1), 'order' => 'Item.name'));
			$auctions['gold']['hardcore']['auctions'] = $this->Item->find('all', array('conditions' => array('user_id' => $user_id, 'status' => 1, 'auction_house' => 3), 'order' => 'Item.name'));
			$auctions['gold']['hardcore']['sales'] = 	$this->Item->find('all', array('conditions' => array('user_id' => $user_id, 'status' => 2, 'auction_house' => 3), 'order' => 'Item.name'));
			
			$auctions['rmah']['normal']['auctions'] = 	$this->Item->find('all', array('conditions' => array('user_id' => $user_id, 'status' => 1, 'auction_house' => 2), 'order' => 'Item.name'));
			$auctions['rmah']['normal']['sales'] = 		$this->Item->find('all', array('conditions' => array('user_id' => $user_id, 'status' => 2, 'auction_house' => 2), 'order' => 'Item.name'));
			$auctions['rmah']['hardcore']['auctions'] = $this->Item->find('all', array('conditions' => array('user_id' => $user_id, 'status' => 1, 'auction_house' => 4), 'order' => 'Item.name'));			
			$auctions['rmah']['hardcore']['sales'] = 	$this->Item->find('all', array('conditions' => array('user_id' => $user_id, 'status' => 2, 'auction_house' => 4), 'order' => 'Item.name'));
						
			$auctions['gold']['normal']['profit'] = 	$this->find_profit($auctions['gold']['normal']['sales']);
			$auctions['gold']['hardcore']['profit'] = 	$this->find_profit($auctions['gold']['hardcore']['sales']);
			$auctions['rmah']['normal']['profit'] = 	$this->find_profit($auctions['rmah']['normal']['sales']);
			$auctions['rmah']['hardcore']['profit'] = 	$this->find_profit($auctions['rmah']['hardcore']['sales']);

			$logs = $this->Log->find('all', array('conditions' => array('Log.user_id' => $user_id), 'limit' => 20, 'order' => 'Log.created DESC'));
			
			$log_count = $this->Log->find('count', array('conditions' => array('Log.user_id' => $user_id)));
			
			$this->set('auctions', $auctions);
			$this->set('logs', $logs);
			$this->set('log_count', $log_count);
			
			$this->set('SHOW_HARDCORE', $this->Preference->getPref($user_id, 'SHOW_HARDCORE'));
			$this->set('SHOW_BOUGHT_FOR', $this->Preference->getPref($user_id, 'SHOW_BOUGHT_FOR'));
		}
		
			public function find_profit($items) {
				$profit = 0;
				foreach($items as $item) {
					$profit += $item['Item']['profit'];
				}				
				return $profit;
			}
		
		public function add() { 
			$user_id = $this->Auth->User('id');
		
			$auction_house = $this->params->query['ah'];
			
			switch($auction_house) {
				case 'gold_normal':
					$ah_id = 1;
				break;
				case 'gold_hardcore':
					$ah_id = 3;
				break;
				case 'rmah_normal':
					$ah_id = 2;
				break;
				case 'rmah_hardcore':
					$ah_id = 4;
				break;
				default: 
					$ah_id = 1;
				break;
			}
		
			$this->set('ah_id', $ah_id);
		
			$this->set('Rarities', $this->Rarity->find('list'));
			$this->set('Categories', $this->Category->find('list'));
			
			$this->set('COMPARE_HIGHER_LEVEL', $this->Preference->getPref($user_id, 'COMPARE_HIGHER_LEVEL'));
			$this->set('COMPARE_LOWER_LEVEL', $this->Preference->getPref($user_id, 'COMPARE_LOWER_LEVEL'));
			$this->set('COMPARE_STAT_RANGE', $this->Preference->getPref($user_id, 'COMPARE_STAT_RANGE'));
			$this->set('SHOW_BOUGHT_FOR', $this->Preference->getPref($user_id, 'SHOW_BOUGHT_FOR'));
		
			if ($this->request->is('post')) {
				if (!empty($this->request->data)) {
				
					$user_id = $this->Auth->user('id');
					
					foreach($this->request->data['ItemStat'] as $index => $item_stat) {
						if (empty($item_stat['stat_id']) || empty($item_stat['value'])) {
							unset($this->request->data['ItemStat'][$index]);
						}
					}
					
					$this->request->data['Item'] = array_merge($this->request->data['Item'], array('user_id' => $user_id));
					
					if($this->Item->saveAll($this->request->data)) {
						$log = array(
							'Log' => array(
								'item_id' => $this->Item->id,
								'user_id' => $user_id,
								'code' => 'add',
								'detail_1' => $this->request->data['Item']['buyout']
							)
						);
						
						$this->Log->save($log);
						$this->redirect('/items');
					}
					
				}
			}
		}
		
		public function view() {
			$user_id = $this->Auth->user('id');
		
			$id = $this->request->pass[0];
			$item = $this->Item->find('first', array('conditions' => array('Item.id' => $id), 'recursive' => 2));
			$this->set('item', $item);
			
			$logs = $this->Log->find('all', array('conditions' => array('Log.item_id' => $id), 'order' => 'Log.created'));
			$this->set('logs', $logs);
		
			$this->set('COMPARE_HIGHER_LEVEL', $this->Preference->getPref($user_id, 'COMPARE_HIGHER_LEVEL'));
			$this->set('COMPARE_LOWER_LEVEL', $this->Preference->getPref($user_id, 'COMPARE_LOWER_LEVEL'));
			$this->set('COMPARE_STAT_RANGE', $this->Preference->getPref($user_id, 'COMPARE_STAT_RANGE'));
			$this->set('SHOW_BOUGHT_FOR', $this->Preference->getPref($user_id, 'SHOW_BOUGHT_FOR'));
		
			if ($this->request->is('post')) {
				
				$log = array(
					'Log' => array(
						'user_id' => $user_id
					)
				);
							
				switch($this->request->data['Item']['status']) {
					case 1:
					default:
						$log['Log']['code'] = "update";
						$log['Log']['detail_1'] = $this->request->data['Item']['buyout'];
					break;
					case 2:
						$profit = 0;
						
						switch($this->request->data['Item']['auction_house']) {
							case 1:
							case 3:
								$profit = ceil($this->request->data['Item']['buyout'] - ($this->request->data['Item']['buyout'] * 0.15));
							break;
							case 2:
							case 4:
								$profit = $this->request->data['Item']['buyout'] - 1;
							break;
							default:
								$profit = 0;
							break;
						}
						
						$log['Log']['detail_1'] = $profit;
						
						$profit = $profit - $this->request->data['Item']['paid'];
						
						$log['Log']['detail_2'] = $profit;
						
						$this->request->data['Item'] = array_merge($this->request->data['Item'], array('profit' => $profit));
						
						$log['Log']['code'] = "sold";
					break;
					case 3:
						$log['Log']['code'] = "remove";
					break;
				}
				
				if ($this->Item->save($this->request->data)) {
				
					$log['Log']['item_id'] = $this->Item->id;
				
					$this->Log->save($log);
				
					$this->redirect('/items');	
				}		
			}
		}
	}
?>