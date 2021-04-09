<?php
if($_SERVER['REQUEST_METHOD'] == 'POST') {
	session_start();
	$psychic_1_digit = mt_rand(10,99);
	$psychic_2_digit = mt_rand(10,99);
	$psychic_3_digit = mt_rand(10,99);
	$psychic_4_digit = mt_rand(10,99);
	$psychic_5_digit = mt_rand(10,99);
	$psychic_digits = array($psychic_1_digit,$psychic_2_digit,$psychic_3_digit,$psychic_4_digit,$psychic_5_digit);
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
			$_SESSION[$k][] = array($psychic_digits[$c-1],0,$level,0);
			$c++;
		}
	}
	echo "<div style='font-family:Tahoma;font-size:50px;'>
			<div>Догадки экстрассенсов:</div>
			<div style='display:flex;justify-content:center;flex-wrap:wrap;width:1258px;'>
				<div style='margin:30px;'>
					<div>Экс-1</div>
					<div style='font-weight:bold;' id='p1'>".$psychic_1_digit."</div>
				</div>
				<div style='inline-block;margin:30px;'>
					<div>Экс-2</div>
					<div style='font-weight:bold;' id='p2'>".$psychic_2_digit."</div>
				</div>
				<div style='inline-block;margin:30px;'>
					<div>Экс-3</div>
					<div style='font-weight:bold;' id='p3'>".$psychic_3_digit."</div>
				</div>
				<div style='inline-block;margin:30px;'>
					<div>Экс-4</div>
					<div style='font-weight:bold;' id='p4'>".$psychic_4_digit."</div>
				</div>
				<div style='inline-block;margin:30px;'>
					<div>Экс-5</div>
					<div style='font-weight:bold;' id='p5'>".$psychic_5_digit."</div>
				</div>
			</div>
			<div>
				<input type='text' name='user_digit' placeholder='Ваше задуманное число' style='outline:none;width:500px;height:75px;border:1px solid #888;font-size:42px;text-align:center;'>
			</div>
			<div style='position:absolute;bottom:75px;left:42%;'>
				<button style='width:200px;height:50px;font-family:Tahoma;font-size:18px;' id='user_digit'>ОК</button>
			</div>
		</div>";
}
?>