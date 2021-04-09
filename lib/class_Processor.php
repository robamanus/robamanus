<?php

	class Processor{
		
		public $result = false;
		public $stop = "st0p";
		
		// Делаем автоматом до действия
		public function CheckPrivateXHR(){
			$url = new URL();
			$request = $url->Request();
			$settings = new Settings();
			$is_private = $settings->PrivateLinks($request);
			if(!isset($_COOKIE[$is_private]) && ($is_private==true)) {
				return $this->stop;
			}
			return;
		}
		// Делаем автоматом до действия
		public function CheckPrivate(){
			$url = new URL();
			$request = $url->Request();
			$settings = new Settings();
			$is_private = $settings->PrivateLinks($request);
			if(!isset($_COOKIE[$is_private]) && ($is_private==true)) {
				header("Location:http://ck35313.tmweb.ru/"); return;
			}
			return $this->result;
		}
	}
?>