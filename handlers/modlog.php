<?php
	switch($_POST['act']){
		case 'login':
			echo "<span id='modal_close'><img src='http://ck35313.tmweb.ru/img/x.png'></span><div id='modal_content'><input class='modal_inp' type='text' name='login' placeholder='Логин' value='' style="."'"."margin-top:42px;"."'".">
			<input class='modal_inp' type='password' name='password' placeholder='Пароль' value=''></div><button class='bigbut' go='login'>Войти</button>"; break;
		case 'signin':
			echo "<span id='modal_close'><img src='http://ck35313.tmweb.ru/img/x.png'></span><div id='modal_content'><input class='modal_inp' type='text' name='login' placeholder='Логин' value=''>
			<input class='modal_inp' type='text' name='email' placeholder='Почта' value=''>
			<input class='modal_inp' type='password' name='password' placeholder='Пароль' value=''>
			<input class='modal_inp' type='password' name='password' placeholder='Еще раз пароль' value=''></div><button class='bigbut' id='signup' go='signin'>Зарегаться!</button>";break;
		case 'logout':
			setcookie("login","",time()-31536000,'/');
			header("Refresh:0");
			echo "lo";
			break;
		default: return;
	}
	
?>