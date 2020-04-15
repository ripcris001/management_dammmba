<?php
	$root = __DIR__;
	include('CONFIG/config.php');
	include('CONFIG/object.php');
	include('CLASSES/class.connection.php'); // connection
	include('CLASSES/class.core.php'); // core class
	include('CLASSES/class.requesthandler.php');
	include('CONFIG/class.php'); 
	include('CONFIG/routes.php'); 
	foreach($route->routeFile as $keys => $value){
		if($loader->checkFile("ROUTES/$value")){
			include("ROUTES/$value");
			$class = $value;
			$class = str_replace('.php', '', $class);
			$className = 'route_'.$class;
			$output->$className = new $class;
		}
	}
	$server->lock = 0;
	$server->maintenance = 0;
	$output->err404 = $loader->loadTemplate("/TEMPLATE/Error/404.html");
	$output->err403 = $loader->loadTemplate("/TEMPLATE/Error/403.html");
	$output->connection = $dbcon;
	$output->route = $route->list;
	$output->server = $server;
?>