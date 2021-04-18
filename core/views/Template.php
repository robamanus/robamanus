<?php

	class Template{
		
		public $request;
		public $obtained_data;
		
		function Tpl($request, $obtained_data){
			$this->obtained_data = $obtained_data;
			$this->request = $request;
			require_once "tpl/".$this->request.".tpl";
		}
	}
?>