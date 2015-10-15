<?php
	session_start();
	spl_autoload_register(function($className) {
		$classPathSplitted = explode('\\', $className);
		$vendor = $classPathSplitted[0];
		$classPath = str_replace($vendor, "", $className);
		$classPath = str_replace("\\", "/", $classPath);

		require_once $classPath.".php";
	});
	
	ini_set("display_errors", 1);
	$dbConfigClass = '\\uniwars\\Configs\\DbConfig';
	\uniwars\Db::setInstance($dbConfigClass::USER, $dbConfigClass::PASS, $dbConfigClass::DBNAME, $dbConfigClass::HOST);
	
	$scriptName = explode("/", $_SERVER["SCRIPT_NAME"]);
	$requestUri = explode("/", $_SERVER["REQUEST_URI"]);
	$controllerIndex = 0;
	foreach ($scriptName as $key=>$value) {
		if($value === "index.php") {
			$controllerIndex = $key;
			break;
		}
	}
	$actionIndex = $controllerIndex + 1;
	$controllerName = $requestUri[$controllerIndex];
	$actionName = $requestUri[$actionIndex];
	
	$controllerClassName = "\\uniwars\\Controllers\\".ucfirst($controllerName)."Controller";
	$view = new \uniwars\View($controllerName, $actionName);
	
	$request = [];
	for ($key = $actionIndex + 1; $key < count($requestUri); $key+=2) {
		if ($key <= $actionIndex) {
			continue;
		}
		if (!isset($requestUri[$key+1])) {
			break;
		}
		$request[$requestUri[$key]] = $requestUri[$key+1];
		
	}
	$requestObject = new uniwars\Request($request);
	
	try {
		$controller = new $controllerClassName($view, $requestObject, $controllerName);
	}
	catch (\Exception $error) {
		echo "Invalid controller";
	}
	if (!$actionName) {
		$actionName = "index";
	}
	if (!method_exists($controller, $actionName)) {
		die("Invalid action");
	}
	
	$controller->$actionName();
	$view->render();
	
?>