<?php
require('FILES/compiler.php');
// $input = isset($_GET['Input']) ? $_GET['Input']: '';
// $input = urlChopping($input);
// $input = strTolower($input);
// #----- Structure With Error Trapping -----#
// function urlChopping($url){
// 	$parseString = array('SERVER','_','/');
// 	$parseFile = array('.php','.js','.','/');
// 	foreach($parseString as $x){
// 		$url = str_replace($x, '', $url);
// 	}
// 	foreach($parseFile as $y){
// 		$url = str_replace($y, '-', $url);
// 	}
// 	return $url;
// }
if($output->connection->status){
	$handler->handleRequest($_SERVER, $_POST, $_GET, $output);
}else{
	print_r("No Connection!");
}
?>