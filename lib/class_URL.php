<?php

	class Url{
		
		public $request;
		public $exrequest;
		
		function __construct(){
			$this->request = $_SERVER["REQUEST_URI"];
			$slashes = substr_count(($_SERVER["REQUEST_URI"]), "/");
			$this->request = $this->ProcessingRequest($this->request);
			return $this->request;
		}
		public function ProcessingRequest($req){
			$req = substr_replace($req, "", 0, 1);
			return $req;
		}
	}
?>