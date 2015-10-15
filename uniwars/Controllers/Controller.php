<?php
	namespace uniwars\Controllers;
	class Controller {
		protected $view;
		protected $controllerName;
		protected $request;
		public function __construct(\uniwars\View $view, \uniwars\Request $request, $controllerName) {
			$this->view = $view;
			$this->controllerName = $controllerName;
			$this->request = $request;
			$this->onLoad();
		}
		protected function onLoad() {
			
		}
		public function redirect($controller = null, $action=null, $params = []) {
			$requestUri = explode("/", $_SERVER["REQUEST_URI"]);
			$url = "//".$_SERVER["HTTP_HOST"] . "/";
			foreach ($requestUri as $key => $uri) {
				if ($uri === $this->controllerName) {
					break;
				}
				$url .= "$uri";
			}
			if ($controller) {
				$url .= "/$controller";
			}
			if ($action) {
				$url .= "/$action";
			}
			foreach ($params as $key=>$param) {
				$url .= "/$key/$param";
			}
			header ("Location: " . $url);
			exit;
		}
	}
?>
