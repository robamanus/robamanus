<?php
namespace MDL;

	class Message{
		
		private $obtained_data = false;
		public $ready_data;
		
		function MessageHandler($data){ // Получаем данные (step) и отправляем исполнителю
			$this->obtained_data = $data;
			switch($data){
				case 1: return; break;
				case 2: 
					if(!isset($_SESSION)) { session_start(); }
					$psychic_1_digit = mt_rand(10,99);
					$psychic_2_digit = mt_rand(10,99);
					$psychic_3_digit = mt_rand(10,99);
					$psychic_4_digit = mt_rand(10,99);
					$psychic_5_digit = mt_rand(10,99);
					$this->ready_data = array($psychic_1_digit,$psychic_2_digit,$psychic_3_digit,$psychic_4_digit,$psychic_5_digit);
					if(!isset($_SESSION['psychic-1'])) {
						$level = 100;
						$_SESSION['psychic-1'][] = array($psychic_1_digit,0,$level,0);
						$_SESSION['psychic-2'][] = array($psychic_2_digit,0,$level,0);
						$_SESSION['psychic-3'][] = array($psychic_3_digit,0,$level,0);
						$_SESSION['psychic-4'][] = array($psychic_4_digit,0,$level,0);
						$_SESSION['psychic-5'][] = array($psychic_5_digit,0,$level,0);
					}
					else{
						$c=1;
						foreach($_SESSION as $k=>$v){
							$p_name = 'psychic-' . $c;
							$keys = array_keys($_SESSION[$k]);
							$last_key = array_pop($keys);
							$level = $_SESSION[$k][$last_key][2];
							$_SESSION[$k][] = array($this->ready_data[$c-1],0,$level,0);
							$c++;
						}
					}
					break;
				case 3:
					if($_SERVER['REQUEST_METHOD'] == 'POST') {
						if (!isset($_SESSION)) { session_start(); }
						$_POST['user_digit'] = htmlspecialchars($_POST['user_digit']);
						if(!is_numeric($_POST['user_digit'])){
							echo "Вы ввели не число!";exit;
						}
						if(($_POST['user_digit'] < 10) or ($_POST['user_digit'] > 99)){
							echo "Вы ввели не двухзначное число!";exit;
						}
						foreach($_SESSION as $k=>$v){
							$keys = array_keys($_SESSION[$k]);
							$last_key = array_pop($keys);
							if($_SESSION[$k][$last_key][0] == $_POST['user_digit']) {
								$_SESSION[$k][$last_key][1] = true; // [1] - имеется ли совпадение совпадение...
								$_SESSION[$k][$last_key][2] = $_SESSION[$k][$last_key][2]+1; // [2] - уровень достоверности (по умолчанию - 100)
							}
							else{
								$_SESSION[$k][$last_key][1] = false; // [1] - имеется ли совпадение совпадение...
								$_SESSION[$k][$last_key][2] = $_SESSION[$k][$last_key][2]-1; // [2] - уровень достоверности (по умолчанию - 100)
							}
							$_SESSION[$k][$last_key][3] = $_POST['user_digit']; // [3] - число пользователя
						}
					}
					break;
				default: return;
			}
			return $this->ready_data;
		}
	}
?>