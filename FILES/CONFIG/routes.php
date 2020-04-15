<?php
	
	function addRoute($routes, $class, $function, $maintenance = 0, $req_login = 0){
		$local = new stdClass();
		$local->route = $routes;
		$local->class = $class;
		$local->function = $function;
		$local->maintenance = $maintenance;
		$local->require_login = $req_login;
		return $local;
	}
	function setRoute($data){
		array_push($local_routes, $data);
		return true;
	};
	$route->routeFile = array("login.php","home.php","system_use.php","testdata.php", "client.php");
	$local_routes = array();
	array_push($local_routes, addRoute('/login', 'login', '_init',0 ,0));
	array_push($local_routes, addRoute('/client/login', 'testdata', '_init', 0, 0));
	array_push($local_routes, addRoute('/client/test_lock', 'testdata', 'lock', 0, 0));
	array_push($local_routes, addRoute('/client/test_unlock', 'testdata', 'unlock', 0, 0));
	array_push($local_routes, addRoute('/client/test_logout', 'testdata', 'logout', 0, 0));
	array_push($local_routes, addRoute('/client/test_login', 'testdata', 'login', 0, 0));
	array_push($local_routes, addRoute('/client/encrypt', 'testdata', 'encryption', 0, 0));
	array_push($local_routes, addRoute('/api/login', 'login', 'apiLogin', 0, 0));
	array_push($local_routes, addRoute('/api/logout', 'login', 'apiLogout', 0, 0));
	$route->list = $local_routes;
?>