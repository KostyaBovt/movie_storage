<?php
	class Controller {
		protected $_params;
		protected $_action;	
		
		public function __construct($action, $params) {
			$this->_action = $action;
			$this->_params = $params;
		}

		public function executeAction() {
			return $this->{$this->_action}();
		}

		public function displayView($user_view, $view_data, $view_file) {
			require_once 'views/main.php';
		}
	}
?>