<?php
	$cpu = new Processor();
	if($cpu->CheckPrivateXHR() == $cpu->stop) { echo $cpu->stop; return; }
	//echo "<pre>";
	//setcookie("current_bet_data","",time()-604800,'/');
	//$cha = $_POST['cha']; // попытка
	$coef = trim($_POST['coef']); // коэф
	if(($coef == 1)||($coef == 0)) { $array_result = array("-","-"); $array_result = json_encode($array_result); echo $array_result; }
	if(strpos($coef,',') != false) { $coef = str_replace(",", ".", $coef); }
	$i = $s = $ii = 0;
	//$min = $p/($coef-1);
	$bonus = false;
	
	$cpu->RecordProbetGo($coef);
	
	
?>