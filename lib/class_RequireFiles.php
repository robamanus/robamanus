<?php
	class RequireFiles{
		
		private $allfiles = array(
			'RequireFiles',
			'Template',
			'URL',
			'Processor',
			'Settings',
		);
		private $filepath;
		private $req_file = array();
		
		private function BuildFilesTree(){
			$this->filepath = array();
			for ($x=0; $x<count($this->allfiles); $x++){
				$this->filepath[] = $_SERVER['DOCUMENT_ROOT']."/lib/class_".($this->allfiles[$x]).".php";
				$modx = $this->allfiles[$x];
				$modx .= "()";
				require_once $this->filepath[$x];
			}
		}
		
		public function TakeRequireFilesTree(){
			$this->BuildFilesTree();
		}
	}
?>