<?php
require_once "lib/class_URL.php";

	class Template{
		
		public $url;
		public $request;
		
		function __construct(){
			$this->url = new Url();
			$this->request = $this->url->request;
			if($this->request == false) $this->request = "index";
			require_once "tpl/".$this->request.".tpl";
		}
	}
?>