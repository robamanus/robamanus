<?php
require_once "lib/class_RequireFiles.php";

	class Url{
		
		public $request;
		public $exrequest;
		public $separator = "/";
		
		function __construct(){
			$this->request = $_SERVER["REQUEST_URI"];
			$slashes = substr_count(($_SERVER["REQUEST_URI"]), "/");
			$this->request = $this->ProcessingRequest($this->request);
			if ($slashes > 1) {
				$this->exrequest = explode('/', $this->request);
			}
			else{
				$this->exrequest = $this->request;
			}
			return $this->exrequest;
		}
		public function Request(){
			return $this->exrequest;
		}
		public function ImpExpRequest($req){
			$req = $this->ProcessingRequest($req);
			switch (is_array($req)){
				case 0: $this->Dir($this->request); break;
				case 1: $this->Pre(); break;
			}
			return $this->exrequest;
		}
		public function ImplodedRequest(){
			return implode("/",$this->request);
		}
		public function ProcessingRequest($req){
			$req = substr_replace($req, "", 0, 1);
			return $req;
		}
		public function PrepareLink(){
			$this->request = substr_replace(($_SERVER["REQUEST_URI"]), "", 0, 1);
			return $this->request;
		}
		public function Path($req){
			$path = '';
			foreach($req as $value){
				$path .= $value.$this->separator;
			}
			return $path;
		}
	}
?>