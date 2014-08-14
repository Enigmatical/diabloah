<?php
	App::uses('AppController', 'Controller');
	
	class AjaxController extends AppController {
		public $uses = array(
			'Stat', 'Type', 'Item', 'ItemStat', 'Log', 'Preference'
		);
		
		public function get() {
			$this->layout = 'ajax';
			$this->autoRender = 'false';
			
			$model = $this->request->pass[0];
			$filter = $this->request->pass[1];
			$user_id = $this->request->pass[2];
			
			$COMPACT_MODE = $this->Preference->getPref($user_id, 'COMPACT_MODE');
			
			if ($model == 'Stat') {
				if ($COMPACT_MODE) {
					$results = $this->Stat->find('list', array('conditions' => array('category_id' => $filter, 'compact' => 1)));
				} else {
					$results = $this->Stat->find('list', array('conditions' => array('category_id' => $filter)));
				}
			}
			
			if ($model == 'Type') {
				$results = $this->Type->find('list', array('conditions' => array('category_id' => $filter)));
			}
			
			$this->set('results', $results);
			$this->render('/Ajax/json');
		}
		
		public function logs() {
			$this->layout = 'ajax';
			$this->autoRender = 'false';
			
			$offset = $this->request->pass[0];
			$user_id = $this->request->pass[1];
			
			$logs = $this->Log->find('all', array('conditions' => array('Log.user_id' => $user_id), 'offset' => $offset, 'limit' => 20, 'order' => 'Log.created DESC'));
			
			$this->set('SHOW_BOUGHT_FOR', $this->Preference->getPref($user_id, 'SHOW_BOUGHT_FOR'));
			$this->set('logs', $logs);
			$this->render('/Items/logs.page');
		}
		
		public function preference() {
			$this->layout = 'ajax';
			$this->autoRender = 'false';
		
			$user_id = $this->request->pass[0];
			$code = $this->request->pass[1];
			$value = $this->request->pass[2];
			
			$result = $this->Preference->setPref($user_id, $code, $value);
			
			$this->set('results', $result);
			$this->render('/Ajax/json');
		}
		
		public function suggestion() {
			$this->layout = 'ajax';
			$this->autoRender = 'false';
			
			$user_id = $this->request->data['user_id'];
			
			$suggestions = array();
			
			/* MARKET RESEARCH */
			
				/*
					Looks at successful auctions with the same Category ID and Type ID from the past 14 days with the same 
					Stat IDs and similar (within 15%) Stat Values and averages the Buyouts together.
				*/
				
				$MARKET_RANGE = $this->Preference->getPref($user_id, 'SUGGEST_MARKET_RANGE');
				$LEVEL_LO = $this->Preference->getPref($user_id, 'COMPARE_LOWER_LEVEL');
				$LEVEL_HI = $this->Preference->getPref($user_id, 'COMPARE_HIGHER_LEVEL');
				$MATCH_THRESHOLD = $this->Preference->getPref($user_id, 'SUGGEST_MATCH_THRESHOLD');
				$SIMILARS_REQUIRED = $this->Preference->getPref($user_id, 'SUGGEST_SIMILARS_REQUIRED');
				$STRICTER_FILTER = $this->Preference->getPref($user_id, 'SUGGEST_STRICTER_FILTER');
					
				$conditions = array();
				
				$conditions[] = array('Item.auction_house' => $this->request->data['ah_id']); //In The Same Auction House
				$conditions[] = array('Item.status' => 2); //Only Success Auctions
				$conditions[] = array("Item.modified >" => date('Y-m-d', strtotime("-2 weeks"))); //In the Past 2 Weeks
					
				$CategoryId = $this->request->data['cate_id'];
				$TypeId = $this->request->data['type_id'];
				
					if ($CategoryId == 1 || $CategoryId == 2) {
						$conditions[] = array('Item.category_id' => $CategoryId); //Search ALL Weapons in a Category
					} else {
						$conditions[] = array('Item.category_id' => $CategoryId); //Search Category
						$conditions[] = array('Item.type_id' => $TypeId); //Search Category Types
					}
					
				if (!empty($this->request->data['primary'])) {
					$Primary = $this->request->data['primary'];
					$LowPrime = $Primary - ($Primary * $MARKET_RANGE);
					$HighPrime = $Primary + ($Primary * $MARKET_RANGE);
					$conditions[] = array('Item.primary_stat BETWEEN ? AND ?' => array($LowPrime, $HighPrime));
				}
					
				$Level = $this->request->data['level'];
				$conditions[] = array('Item.required_level BETWEEN ? AND ?' => array($Level - $LEVEL_LO, $Level + $LEVEL_HI));
				
				$results = $this->Item->find('all', array('conditions' => $conditions));
				
				$potential_similars = array();
				
				if (!empty($this->request->data['stats'])) {
				
					$stat_count = count($this->request->data['stats']);
				
					foreach($results as $item) {
						
						$match = 0;
						
						foreach($this->request->data['stats'] as $stat) {
							
							$lowstat = $stat['value'] - ($stat['value'] * $MARKET_RANGE);
							$highstat = $stat['value'] + ($stat['value'] * $MARKET_RANGE);
						
							foreach($item['ItemStat'] as $ItemStat) {
								if ($ItemStat['stat_id'] == $stat['stat_id'] && $ItemStat['value'] >= $lowstat && $ItemStat['value'] <= $highstat) {
									$match++;
								}
							}
						}
						
						if ($match / $stat_count >= $MATCH_THRESHOLD) {
							$potential_similars[] = array('id' => $item['Item']['id'], 'value' => max($item['Item']['bid'], $item['Item']['buyout']));
						}
					}
				}
								
				if (count($potential_similars) > 0) {
				
					$values = array_merge($potential_similars, $potential_similars);
					usort($values, array("AjaxController", "market_research_sort"));
					
					$count = count($values);
					
					$Q1 = $values[round( .25 * ( $count + 1 ) ) - 1]['value'];
					$Q2 = ($count % 2 == 0) ? ($values[($count / 2) - 1]['value'] + $values[$count / 2]['value']) / 2 : $values[intval(($count + 1) / 2)]['value'];
					$Q3 = $values[round( .75 * ( $count + 1 ) ) - 1]['value'];
					
					$IQR = $Q3 - $Q1;
					
					$bogus_detect = $IQR * 3;
					$bogus_low = $Q1 - $bogus_detect;
					$bogus_high = $Q3 + $bogus_detect;
					
					foreach($potential_similars as $ind => $s) {
						if ($s['value'] < $bogus_low || $s['value'] > $bogus_high) {
							unset($potential_similars[$ind]);
						}
					}
					
					if ($STRICTER_FILTER) {
						$bogus_detect = $IQR * 1.5;
						$bogus_low = $Q1 - $bogus_detect;
						$bogus_high = $Q3 + $bogus_detect;
						
						foreach($potential_similars as $ind => $s) {
							if ($s['value'] < $bogus_low || $s['value'] > $bogus_high) {
								unset($potential_similars[$ind]);
							}
						}						
					}
					
					$market = 0;
					$count = count($potential_similars);
					foreach($potential_similars as $s) {
						$market += $s['value'];
					}
					
					if ($count >= $SIMILARS_REQUIRED) {
				
						$average = 0;
						switch($this->request->data['ah_id']) {
							case 1:
							case 3:
							default:
								$average = ceil($market / $count);
							break;
							case 2:
							case 4:
								$average = sprintf("%01.2f", ($market/$count));
							break;
						}
						
						$suggestions[] = array("label" => "Market Research ($similar Similar Items Found)", "value" => $average);
						
					} else {
						$suggestions[] = array("label" => "Market Research (Insufficient Items Found)", "value" => 0);
					}
					
				} else {
					$suggestions[] = array("label" => "Market Research (No Similar Items Found)", "value" => 0);
				}
				
				
			/* UNDERCUT LOWEST */
			
				/*
					Takes the Lowest Buyout provided and subtracts 15%.
				*/
				
				if (!empty($this->request->data['lowest'])) {
					$UNDERCUT = $this->Preference->getPref($user_id, 'SUGGEST_LOWEST_UNDERCUT');
					
					$lowest = $this->request->data['lowest'];
					$lowest = $lowest - ($lowest * $UNDERCUT);
					
					switch($this->request->data['ah_id']) {
						case 1:
						case 3:
						default:
							$lowest = ceil($lowest);
						break;
						case 2:
						case 4:
							$lowest = sprintf("%01.2f", $lowest);
						break;
					}
					
					$suggestions[] = array("label" => "Undercut Lowest (" . $UNDERCUT * 100 . "% Undercut)", "value" => $lowest);
				}
				
			/* GOLD AUCTION HOUSE ONLY */
				
			if ($this->request->data['ah_id'] == 1 || $this->request->data['ah_id'] == 3) {
				
				/* VENDOR MARKUP */
				
					/*
						Last Resort:  Multiplies the Vendor Value by 5.
					*/
					
					if (!empty($this->request->data['vendor']) && empty($this->request->data['lowest'])) {
						$MARKUP = $this->Preference->getPref($user_id, 'SUGGEST_VENDOR_MARKUP');
						
						$vendor = $this->request->data['vendor'];
						
						$suggestions[] = array("label" => "Vendor Markup (" . $MARKUP . "x Sale Value)", "value" => $vendor * $MARKUP);
					}
					
				/* VENDOR IT */
				
					if (!empty($this->request->data['vendor'])) {
						$vendor = $this->request->data['vendor'];
						
						$suggestions[] = array("label" => "Vendor Sale", "value" => $vendor);
					}
			
			}
				
			usort($suggestions, array("AjaxController","suggest_sort"));
			
			$this->set('results', $suggestions);
			$this->render('/Ajax/json');
		}
		
		function suggest_sort($b, $a) {
			return $a['value'] - $b['value'];
		}
		
		function market_research_sort($a, $b) {
			return $a['value'] - $b['value'];
		}
		
		function beforeFilter() {
			parent::beforeFilter();
			$this->Auth->allow('*');
		}
	}
?>

