<?php
	class testdata extends Core {
		public function _init($param){
			$_SESSION["open"] = 0;
			$_SESSION["lock"] = 1;
			$_SESSION["user_name"] = "Vladimir Bargayo";
		}
		public function lock($param){
			$input = $this->newClass();
			$input->lock = 1;
			$input->bebot = 1;
			$this->updateSession($input);
		}
		public function unlock($param){
			$input = $this->newClass();
			$input->lock = 0;
			$this->updateSession($input);
		}
		public function logout($param){
			print_r($this->setLogout());
		}
		public function login($param){
			print_r($this->setLogin());
		}
		public function encryption($param){
			$enct = $this->encrypt($param->params["encrypt"]);
			print_r("Encrypt: ".$enct." <br>");
			$dect = $this->decrypt($param->params["decrypt"]);
			print_r("Decrypt:". $dect);
		}
	}
?>