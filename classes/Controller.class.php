<?php
	class Controller {
		protected $_request;
		protected $_action;	
		
		public function __construct($action, $request) {
			$this->_action = $action;
			$this->_request = $request;
		}

		public function executeAction() {
			return $this->{$this->_action}();
		}

		public function displayView($user_view, $view_data, $view_file) {
			require_once 'views/main.php';
		}
	}
?>