<?php
	$cpu = new Processor();
	if($cpu->CheckPrivateXHR() == $cpu->stop) { echo $cpu->stop; return; }
	$x = $cpu->ReturnBet();
?>