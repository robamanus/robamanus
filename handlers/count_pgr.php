<?php
	$cpu = new Processor();
	if($cpu->CheckPrivateXHR() == $cpu->stop) { echo $cpu->stop; return; }
	$coef = $_POST['coef']; // коэф
	if(($coef == 1)||($coef == 0)) { $array_result = array("-","-"); $array_result = json_encode($array_result); echo $array_result; }
	if(strpos($coef,',') != false) { $coef = str_replace(",", ".", $coef); }
	
	$x = $cpu->ProbetGoRec($coef);
	echo $x;
	
?>