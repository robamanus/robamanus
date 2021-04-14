<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>Экстрасенсы</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="">
		<meta Name="keywords" Content="">
		<meta name="robots" content="noindex,nofollow"/>
		<link rel="stylesheet" type="text/css" href="css/style.css" />
		<script type="text/javascript" src="http://ck35313.tmweb.ru/js/jquery-2.1.4.min.js"></script>
		<script type="text/javascript" src="http://ck35313.tmweb.ru/js/jq.js"></script>
		<link rel="shortcut icon" href="img/favicon.ico">
	</head>
<body onload="Load()">
	<?php
		echo '<div>
				<h1>История:</h1>';
				echo '<table border="1" style="border-collapse:collapse;">
							<tr>
								<td></td>
								<td>Экс-1</td>
								<td>Экс-2</td>
								<td>Экс-3</td>
								<td>Экс-4</td>
								<td>Экс-5</td>
							</tr>';
		foreach($_SESSION as $k=>$v){
			$matches[$k] = $lvl[$k] = 0;
			$guesseddigits[$k] = array();
			for($m=0;$m<count($v);$m++){
				if($v[$m][1]==true) {
					$matches[$k]++;
					$guesseddigits[$k][] = $v[$m][3];
				}
				$lvl[$k] = $v[$m][2];
			}
		}
		if(!isset($_SESSION['psychic-1'])){
			echo '</table>';
		}
		else{
			for($m=0;$m<count($v);$m++){
				$user_digits[] = $v[$m][3];
			}
			echo '<tr>
					<td>Совпадений</td>';
			foreach($matches as $val){
				echo '<td>' . $val . '</td>';
			}
			echo '</tr><tr>
					<td>Угадал числа</td>';
			foreach($guesseddigits as $k){
				echo '<td>';
				$k = implode(', ',$k);
				echo $k;
				echo '</td>';
			}
			echo '</tr><tr>
					<td>Уровень достоверности</td>';
			foreach($lvl as $val){
				echo '<td>' . $val . '</td>';
			}
				echo '</tr></table><div>';
				$user_digits = implode(', ',$user_digits);
				echo '<div>';
				echo '<p>История загаданных чисел: <b>' . $user_digits . '</b></p>';
				echo '</div>';
		}	
	?>
	<div id="modal_form"></div>
	<div id="overlay"></div>
	<div id="overlay_noclose"></div>
</body>
</html>