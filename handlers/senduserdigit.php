<?php
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
?>