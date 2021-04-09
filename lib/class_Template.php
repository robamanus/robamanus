<?php
require_once "lib/class_RequireFiles.php";

	class Template{
		
		private $url;
		private $db;
		private $settings;
		public $request;
		
		function __construct(){
			$this->url = new Url();
			$this->request = $this->url->Request();
			$this->settings = new Settings();
			//echo $this->request; exit;
			//echo $this->settings->GetPathCode($this->request); exit;
			switch($this->settings->GetPathCode($this->request)){
				case 0: $this->Dir($this->request); break;
				case 1: $this->Catalog(); break;
				case 2: $this->Prod(); break;
				case 3: $this->Info(); break;
				case 4: $this->Handlers($this->request); break;
			}
		}
		public function Dir($req){
			switch ($req){
				case "product": require_once "tpl/".$this->request.".tpl"; print_r($req); break;
				case 1: $this->Pre(); break;
				case 2: $this->Prod(); break;
				case 3: $this->Info(); break;
				case 4: $this->Catalog(); break;
				default: switch ($req[0]){
					case "products": require_once "tpl/".$req[0].".tpl"; break;
					default: /*print_r($req)*/; break;
				}; break;
			}
		}
		public function Prod(){
			echo "prod";
		}
		public function Info(){
			$cpu = new Processor();
			$cpu->CheckPrivate();
			if(is_array($this->request)!=false) { $this->request = implode("/",$this->request); }
			if($this->request == false) $this->request = "index";
			//echo "<h1>".$this->request."</h1>";
			require_once "tpl/".$this->request.".tpl";
		}
		public function Catalog(){
			$this->RequestSeparator($this->request);
		}
		public function Distributor(){
			require_once "tpl/distributor.tpl";
		}
		public function Handlers($request){
			$request = implode("/",$request);
			require_once $_SERVER['DOCUMENT_ROOT'] . "/" . $request . ".php";
		}
		
		public function RequestSeparator($req){
			require_once "tpl/distributor.tpl";
		}
	}
?>