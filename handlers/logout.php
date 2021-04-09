<?php
	setcookie("login", '');
	$cpu = new Processor();
	$cpu->CheckPrivateXHR();
	unset($cpu);
?>