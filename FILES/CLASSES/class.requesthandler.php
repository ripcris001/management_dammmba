<?php
	class handler{		
		public function parseString($string){
			$object = array();
			$parseUrl = strstr($string, '?');
			$parseUrl = substr($parseUrl, 1);
			$output_string = str_replace('%20', ' ', $parseUrl);
			$output_string = str_replace('=', ':', $output_string);
			$output_string = str_replace('&', ',', $output_string);
			if(strlen($output_string)){
				$output_string = explode(",",$output_string);
				if(count($output_string) > 0){
					foreach ($output_string as $key => $value) {
						$loopdata = explode(":", $value);
						$loopIndex = $loopdata[0];
						$loopValue = $loopdata[1];
						$object[$loopIndex] = $loopValue;
					}
				}
			}
			return $object;
		}
		public function handleRequest($server, $post, $get, $value){
			$localClass = '';
			$localFunction = '';
			$localMaintenance = 0;
			$localRequireLogin = 0;
			$findCount = 0;
			$findHome = 0;
			$url = $server['REQUEST_URI'];
			$method = $server['REQUEST_METHOD'];
			$get = $this->parseString($url);

			foreach($value->route as $keys => $values){
				if(!isSet($server['REDIRECT_URL'])){
					$findHome++;
				}else if($server['REDIRECT_URL'] == $values->route){
					$localClass = 'route_'.$values->class;
					$localFunction = $values->function;
					$localMaintenance = $values->maintenance;
					$localRequireLogin = $values->require_login;
					$findCount++;
				}
			}
			$input = new stdClass();
			if($findHome || $findCount){
				if($value->server->maintenance){
					$input->body = $post;
					$input->params = $get; 
					$value->route_system_use->maintenance($input);
				}else if($value->server->lock){
					$input->body = $post;
					$input->params = $get; 
					$value->route_system_use->lock($input);
				}else{
					if($findHome){
						$input->body = $post;
						$input->params = $get; 
						$value->route_home->_init($input);
					}else if($findCount){
						if($localMaintenance > 0){
							$input->body = $post;
							$input->params = $get; 
							$value->route_system_use->maintenance($input);
						}else if($localRequireLogin > 0){
							$input->body = $post;
							$input->params = $get; 
							$value->route_login->_init($input);
						}else{
							$input->body = $post;
							$input->params = $get; 
							$value->$localClass->$localFunction($input);
						}
					}else{
						$input->body = $post;
						$input->params = $get; 
						$value->route_system_use->err404($input);
					}
				}
			}else{
				$input->body = $post;
				$input->params = $get; 
				$value->route_system_use->err404($input);
			}
		}
	}
?>