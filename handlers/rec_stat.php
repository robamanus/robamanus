<?php
	$status = $_POST['st'];
	$cpu = new Processor();
	if($cpu->CheckPrivateXHR() == $cpu->stop) { echo $cpu->stop; return; }
	$db = new DB();
	if($status==0){
		$db->UpdateData("UPDATE probet_go AS pg INNER JOIN account_data AS acd ON acd.label='".$_COOKIE['login']."' AND acd.current_bet=pg.code SET pg.status='".$status."'");
	}
	if($status==1){
		$db->UpdateData("UPDATE probet_go AS pg INNER JOIN account_data AS acd ON acd.label='".$_COOKIE['login']."' AND acd.current_bet=pg.code SET pg.status='".$status."', acd.current_bet=null");
		echo "<span style='color:#3fda3f;'>WON</span>";
	}
?>