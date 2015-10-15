<?php
	define("DX_ROOT_DIR", dirname(__FILE__) . "/");
	define("DX_ROOT_PATH", basename(dirname(__FILE__) . "/"));
	include_once "config/db.php";
	include_once "config/config.php";
	$request = $_SERVER['REQUEST_URI'];
	$request_home = "/".DX_ROOT_PATH;
	$controller = "master";
	$method = "index";
	$admin_routing = false;
	$param = array();

	foreach(glob("lib/*.php") as $file) {
		include_once $file;
	}
	include_once "controllers/master.php";
	include_once "models/master.php";
	if (! empty($request)) {
		if (0===strpos($request, $request_home)) {
			$request = substr($request, strlen($request_home));
			if (strpos($request, "admin")) {
				$admin_routing = true;
				include_once "controllers/admin/master.php";
				$request = substr($request, strlen("admin/"));
			}
			$components = explode("/", $request, 4);
			array_shift($components);
			
			if (count($components) > 1) {
				list($controller, $method) = $components;
				if(isset($components[2])) {
					$param = $components[2];
				}
				$admin_folder = $admin_routing ? "admin/" : "";
				include_once "controllers/".$admin_folder.$controller.".php";
				
			}	
		}
	}
	$admin_namespace = $admin_routing ? "\Admin" : "";
	$controller_class = $admin_namespace.'\Controllers\\' . ucfirst($controller) . '_Controller';
	$instance = new $controller_class();
	if (method_exists($instance, $method)) {
		call_user_func_array(array($instance, $method), array($param));
	}
	$dbobject = \Lib\Database::get_instance();
	$db_conn = $dbobject::get_db();

?>

