<?php
	class system_use extends Core {
		public function _init($param){
			$this->__template->cContent = $this->loadTemplate("/TEMPLATE/Login/home.html");
			$this->__data->name = "hello";
			$this->__data->test = array("hello","world");
			$this->render();
		}
		public function lock($param){
			$this->__tConfig->template = "/TEMPLATE/Default/lock-no-login.html";
			$this->__data->name = 'Server is lock';
			$this->__data->img = 'images/biohazard--v1.png';
			$this->render();
		}
		public function maintenance($param){
			$this->__tConfig->template = "/TEMPLATE/Default/maintenance.html";
			$this->__data->name = "kim den";
			$this->__data->img = 'images/biohazard--v1.png';
			$this->render();
		}
		public function err404($param){
			$this->__tConfig->template = "/TEMPLATE/Error/404.html";
			$this->__data->img = 'images/biohazard--v1.png';
			$this->render();
		}
		public function not_login($param){
			$this->__tConfig->template = "/TEMPLATE/Error/404.html";
			$this->__data->img = 'images/biohazard--v1.png';
			$this->render();
		}
	}
?>