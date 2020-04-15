<?php
Class Core extends Connection implements settings {
	public $__template, $__tConfig, $__data, $__session;
	private $encryption_key = "VjWt#9<\=m<uyq6zC=%Yb.&DBe5q^+T]f8k";
	private $encryption_iv = "2zQfC2GEcQ*})gMg";
	private $encryption_cipher = "AES-256-CBC";
	public function __construct(){
		$this->__template = new stdClass();
		$this->__template->cTitle = settings::c_title;
		$this->__template->cDescription = settings::c_description;
		$this->__template->cFooter = $this->template(settings::d_path.settings::t_footer);
		$this->__template->cHeader = $this->template(settings::d_path.settings::t_header);
		$this->__template->cSidebar = $this->template(settings::d_path.settings::t_sidebar);
		$this->__template->cThemer = $this->template(settings::d_path.settings::t_themer);
		$this->__template->cSlideChat = $this->template(settings::d_path.settings::t_slidechat);
		$this->__template->cAssets = settings::d_url.settings::d_assets.settings::t_assets;
		$this->__template->cAssetsJS = $this->__template->cAssets.settings::t_js;
		$this->__template->cAssetsCSS = $this->__template->cAssets.settings::t_css;
		$this->__template->cAssetsCC = $this->__template->cAssets.settings::t_cc;
		$this->__template->cAssetsPLUGIN = $this->__template->cAssets.settings::t_plugin;
		$this->__template->cContent = "Default Content";
		$this->__template->cData = null;
		$this->__tConfig = new stdClass();
		$this->__tConfig->template = settings::t_main;
		$this->__data = new stdClass();
		$this->__session = new stdClass();
		$this->__session->noSessionMessage = "No Session";
	}
	public function template($data) {
		$template = $data;
        if (!file_exists($template))
        $this->SystemExit('Template not found: ' . $template, __LINE__, __FILE__);
        $__data[0][0] = fopen($template, "r");
        $__data[0][1] = fread($__data[0][0], filesize($template));
        fclose($__data[0][0]);
        return $__data[0][1];
    }
	public function buildComponent ($data){
		$output = $this->buildContent($this->template($data->file), $d_data);	
		return output;
	}
	public function buildTemplate($data, $def = true){
		$__object = new stdClass();
		$__object = $this->__template;
		$template = $this->__tConfig->template;
		foreach($data as $key => $value){
			if(!$def){
				$__object->$key = $value;
			}
		}
		foreach($this->__data as $key => $value){
			$checktype = gettype($value);
			$index = 'data_'.$key;
			if($checktype == 'array' || $checktype == 'object'){
				$__object->$index = json_encode($value);
			}else{
				$__object->$index = $value;
			}
		}
		if($def){
			$template = $this->__tConfig->template;
		}else{
			$template = $data->t_main;
		}
		$output = $this->buildContent($this->template(settings::d_path.$template), $__object);
		return $output;
	}
	public function loadTemplate($path, $def = false){
		$__object = new stdClass();
		$__object->t_main = $path;
		return $this->buildTemplate ($__object, $def);
	}
	
	public function render(){
		$local = new stdClass();
		print_r($this->buildTemplate($local, true));
	}
	
	public function buildContent($data, $variables) {  
		$__variable = array();
		foreach($variables as $key => $value){
			$__variable['{'.$key.'}'] = $value;
		}
        $output = empty($variables) ? $data : str_replace(array_keys($__variable), array_values($__variable), $data);
        return $output;
    }
	public function checkFile($path){
		$path = settings::d_path.'/'.$path;
		if (!file_exists($path)){
			return false;
		}else {
			return true;
		}
	}
	public function checkSession(){
		session_start();
		if(isset($_SESSION)){
			if(count($_SESSION)){
				$session = $_SESSION;
				if($session['lock']){
					
				}else{
					return true;
				}
			}else{
				return false;
			}
		}else{
			return false;
		}
	}
	public function setLogin($data){
		$response = new stdClass();
		$response->status = false;
		$response->message = "";
		$check = $this->checkSession();
		if($check){
			$response->status = false;
			$response->message = "Session Exist!";
			return $response;
		}else{
			$_SESSION["open"] = 0;
			$_SESSION["lock"] = 0;
			$_SESSION["hasLogin"] = 1;
			$_SESSION["user_name"] = $data->USER_USERNAME;
			$_SESSION["name"] = $data->USER_FIRSTNAME." ".$data->USER_LASTNAME;
			$response->status = true;
			$response->message = "Session set complete!";
			return $response;
		}
	}
	public function setLogout(){
		$response = new stdClass();
		$response->status = false;
		$response->message = "";
		$check = $this->checkSession();
		if($check){
			session_unset();
			session_destroy();
			$response->status = true;
			$response->message = "Session destroy!";
			return $response;
		}else{
			$response->status = false;
			$response->message = $this->__session->noSessionMessage;
			return $response;
		}
	}
	public function updateSession($param){
		if(gettype($param) == 'object'){
			$session = $this->checkSession();
			if($session){
				foreach($param as $key => $value){
					if(isset($_SESSION[$key])){
						$_SESSION[$key] = $value;
					}else{
						print_r("$key is not in session");
					}
				}
			}else{
				print_r($this->__session->noSessionMessage);
			}
		}
	}
	public function getSessionVar($param){
		if(isset($param)){
			$session = $this->checkSession();
			if($session){
				if(isset($_SESSION[$param])){
					return $_SESSION[$param];
				}else{
					return "";
				}
			}else{
				return $this->__session->noSessionMessage;
			}
		}
	}
	public function newClass(){
		$input = new stdClass();
		return $input;
	}
	public function redirect($param){
		header('Content-Type: text/plain');
        print ("Redirecting to $param");
        header("Location: $param");
        exit(1);
	}
	public function encrypt($data){
		//$iv_length = openssl_cipher_iv_length($this->encryption_cipher); 
		$encryption_iv = substr(hash('sha256', $this->encryption_iv), 0, 16); 
		$encryption_key = hash('sha256', $this->encryption_key); 
		$encryption = openssl_encrypt($data, $this->encryption_cipher, $encryption_key, 0, $encryption_iv); 
		return $encryption;
	}
	public function decrypt($data){
		//$iv_length = openssl_cipher_iv_length($this->encryption_cipher); 
		$decryption_iv = substr(hash('sha256', $this->encryption_iv), 0, 16);
		$decryption_key = hash('sha256', $this->encryption_key); 
		$decryption = openssl_decrypt ($data, $this->encryption_cipher, $decryption_key, 0, $decryption_iv);
		return $decryption;
	}
	public function response($data){
		print_r(json_encode($data));
		exit(1);
	}
	public function execQuery($type,$data, $all = false){
		$output = $this->newClass();
		$output->status = false;
		$type = strtolower($type);
		$result = "";
		$this->connectDB();
		if(isSet($data)){
			$query = $this->DBase('query', $data);
			if($type == 'fetch'){
				if($all){
					$output->data = $query->fetch_all(MYSQLI_ASSOC);
					$output->status = true;
				}else{
					$output->data = $query->fetch_object();
					if($output->data){
						$output->status = true;
					}
				}
			}else if($type == 'update'){

			}else if($type == 'insert'){
				
			}else if($type == 'delete'){
				
			}
			
			return $output;
		}
	}
	public function SystemExit($text, $line, $file = null) {
        if (ob_get_level()) ob_end_clean();
        header('Content-Type: text/plain');
        print ("$text - " . date("F j, Y, g:i a"));
        print ("\nLocation: $file ($line)");
        exit(1);
    }
}
?>