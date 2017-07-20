<?php
	class Bootstrap {
		private $_request;
		private $_action;
		private $_controller;

		public function __toString() {
			return	'request: ' . print_r($this->_request) . '<br/>' .
					'action: ' . $this->_action . '<br/>' .
					'controller: ' . $this->_controller . '<br/>';
		}

		public function __construct($request) {
			$this->_request = $request;
			if (!isset($this->_request['controller']) || $this->_request['controller'] == '') {
				$this->_controller = 'Home_controller';
			} else {
				$this->_controller = ucfirst($request['controller'] . '_controller');
			}
			if (!isset($this->_request['action']) || $this->_request['action'] == '') {
				$this->_action = 'index';
			} else {
				$this->_action = $request['action'];
			}
		}

		public function createController() {
			if (class_exists($this->_controller)) {
				$parents = class_parents($this->_controller);
				if (in_array("Controller", $parents)) {
						if (method_exists($this->_controller, $this->_action)) {
							return new $this->_controller($this->_action, $this->_request);
						} else {
							echo '<h1>Method does not exist<h1>';
							//echo 'controller: ' . $this->controller . ' action : ' . $this->action;
						}
					} else {
					echo '<h1>Base controller not found</h1>';
					return;
				}
			} else {
				echo '<h1>Controller does not exist</h1>';
				return;
			}
		}

	}
?>