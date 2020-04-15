<?php
	class client extends Core {
		public function _init($param){
			$checkSession = $this->checkSession();
			if(!$checkSession){
				$this->__template->cTitle = 'Login Page';
				$this->__tConfig->template = "/TEMPLATE/Default/blank.html";
				$this->__template->cContent = $this->loadTemplate("/TEMPLATE/Pages/about.html");
				$this->render();
			}else{
				$this->__template->cContent = $this->loadTemplate("/TEMPLATE/Login/home.html");
				$this->__data->name = "hello";
				$this->__data->test = array("hello","world");
				$this->render();
			}
		}
	}
?>