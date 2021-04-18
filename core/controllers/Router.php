<?php
require_once "core/models/URL.php";
require_once "core/models/Message.php";
require_once "core/views/Template.php";

	class Router{
		
		private $url;
		private $path;
		private $processed_data = false;
		
		function __construct(){
			$this->url = new Url();
			switch($this->url->request){
				case false: $this->path = "index"; break;
				case 'controllers/Message':
					if($_SERVER['REQUEST_METHOD'] == 'POST') {
						$message = new \MDL\Message();
						$this->processed_data = $message->MessageHandler($_POST['step']);
						$this->path = "message-" . $_POST['step'];
						//echo $this->path;
					}
					break;
				default: $this->path = '404'; break;
			}
			$template = new Template();
			return $template->Tpl($this->path,$this->processed_data);
		}
	}
?>