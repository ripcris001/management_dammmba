<?php
	class login extends Core{
		public function _init($param){
			$checkSession = $this->checkSession();
			if(!$checkSession){
				$this->__template->cTitle = 'Login Page';
				$this->__tConfig->template = "/TEMPLATE/Default/login.html";
				$this->__template->cContent = $this->loadTemplate("/TEMPLATE/Pages/login.html");
				$this->render();
			}else{
				$this->redirect("/");
			}
		}
		public function apiLogin($param){
			$response = $this->newClass(); // create object;
			$input = $this->newClass();
			$input->username = $param->body['username']; 
			$input->password = $this->encrypt($param->body['password']);
			$input->query = "SELECT * FROM user WHERE USER_USERNAME = '$input->username' AND USER_PASSWORD = '$input->password'";
			$query = $this->execQuery("fetch",$input->query);
			if($query->status){
				$response->message = "Success login!";
				$response->status = true;
				$this->setLogin($query->data);
			}else{
				$response->message = "User Doest exist!";
				$response->status = false;
			}
			$this->response($response);
		}
		public function apiLogout($param){
			$logout = $this->setLogout();
			$this->response($logout);
		}

	}
?>