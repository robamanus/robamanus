<?php
	class Settings{
		
		private $path_codes =
			array(
				'' => 3,
				'user' => 3,
				'turms_and_conditions' => 3,
				'rezultat_poiska_vernyi' => 3,
				'rezultat_poiska_nevernyi' => 3,
				'stranica_tovara' => 3,
				'calc_stoleshnica' => 3,
				'calc_mebelnyi_schit' => 3,
				'calc_fasady' => 3,
				'empty_basket' => 3,
				'katalog' => 3,
				'404' => 3,
				'handlers' => 4
			);
		private $private_links =
			array(
				'user'=>array('require'=>'login'),
				'user/probet_go'=>array('require'=>'login'),
				'handlers/count'=>array('require'=>'login'),
				'handlers/count_pg'=>array('require'=>'login'),
				'handlers/count_pgb'=>array('require'=>'login')
			);
		
		
		public function GetPathCode($req){
			if(is_array($req) === false){
				return $this->path_codes[$req];
			}
			else{
				//print_r($this->path_codes[$req[0]]);
				return $this->path_codes[$req[0]];
			}
		}
		public function PrivateLinks($req){
			if(is_array($req)!=false) { $req = implode("/",$req); }
			foreach($this->private_links as $key=>$value){
				if($key == $req){
					return $value['require'];
				}
			}
			return;
		}
	}
?>