<?php
	App::uses('AppController', 'Controller');
	
	class UsersController extends AppController {
		public $uses = array(
			'User', 'Item', 'Preference'
		);
		
		public function beforeFilter() {
			parent::beforeFilter();
			$this->Auth->allow('signup', 'login', 'logout');
		}
		
		public function index() {
			$this->redirect('/');
		}
		
		public function login() {
			if ($this->request->is('post')) {
				if ($this->Auth->login()) {
					return $this->redirect($this->Auth->redirect());
				} else {
					$this->Session->setFlash('No user exists for that username and password combination.');
					$this->redirect('/');
				}
			}
		}
		
		public function logout() {
			$this->redirect($this->Auth->logout());
		}
		
		public function signup() {
			if ($this->request->is('post')) {
				if ($this->User->save($this->request->data)) {				
					$id = $this->User->id;
					$this->request->data['User'] = array_merge($this->request->data['User'], array('id' => $id));
					$this->Auth->login($this->request->data['User']);
					$this->redirect($this->Auth->redirect());
				}
			}
		}
		
		public function settings() {
			$user_id = $this->Auth->User('id');
		
			$preference_codes = array(
				'COMPACT_MODE', 
				'SHOW_HARDCORE', 
				'SHOW_BOUGHT_FOR', 
				'USE_MY_DATA',
				'COMPARE_HIGHER_LEVEL', 
				'COMPARE_LOWER_LEVEL',
				'COMPARE_STAT_RANGE',
				'SUGGEST_MARKET_RANGE',
				'SUGGEST_LOWEST_UNDERCUT',
				'SUGGEST_VENDOR_MARKUP'
			);
		
			$preferences = array();
			
			foreach($preference_codes as $code) {
				$preferences[$code] = $this->Preference->getPref($user_id, $code);
			}

			$this->set('preferences', $preferences);
		}
	}
?>