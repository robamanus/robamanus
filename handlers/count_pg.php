<?php
	$cpu = new Processor();
	//echo "<pre>";
	if($cpu->CheckPrivateXHR() == $cpu->stop) { echo $cpu->stop; return; }
	$p = $_POST['p'];
	$c = $_POST['c'];
	//if($c<=1) { return; }
	if(strpos($c,',') != false) { $c = str_replace(",", ".", $c); }
	$b = $_POST['b'];
	$i = $s = $ii = 0;
	$min = $p/($c-1);
	$bonus = false;
	if($min<50) { $min = 50; }
	if($_COOKIE['login']=='a7cff078365c00ada677551638000c68') { $min=0.1; }
	$lastbets = array();
	//$n = ($p+$min)/($c*$min-$min);
	//if($n<=1) return;
	echo "<div id='result_table'><table style='margin-left:5px;text-align:center;' border='1'><tr class='chance_pg'><td>Попытка</td><td>Коэф.</td><td>Ставка</td><td>Рассход</td><td>Бонус</td><td>Статус</td></tr>";
	while($s<$b){
		if(($_COOKIE['login']=='a7cff078365c00ada677551638000c68')&&($i==0)&&($min==0.1)) {
			$bet = 0.1; $bonus = $c*$bet-$p-$s;
			if($bonus<0){ $bonus=false; }
			if($bonus!=false) {
				$bonus = "<span style='color:#49E834;'> + ".$bonus." </span>";
			}
			else{
				$bonus = false;
			}
		}
		if(($i==0)&&($min==50)) {
			$bet = 50; $bonus = $c*$bet-$p-$s;
			if($bonus!=false) {
				$bonus = "<span style='color:#49E834;'> + ".$bonus." </span>";
			}
			else{
				$bonus = false;
			}
		}
		else {
			$bet = ($p+array_sum($lastbets))/($c-1); $bet = ceil($bet);
			if($bet<$min) { $bet = $min; $bonus = $c*$bet-$p-$s; $bonus = "<span style='color:#49E834;'> + ".$bonus." </span>"; }
		}
		$lastbets[] = $bet;
		//echo "<pre>";
		//echo $bet;
		//print_r($lastbets);
		//$tmp1 = ceil($min*pow($n,$i)*100)/100;
		//$tmp1 = ceil($min*pow($n,$i)*100)/100;
		//if(($tmp1<$minbet)&&($i==0)){$corrector = $minbet-$tmp1;$tmp1=$tmp1+$corrector;}
		//echo "<h1>".$tmp1."</h1>";
		$s = array_sum($lastbets);
		//echo "<h1>summa = ".$s. "</h1>";
		if($s<$b){
			$ii++;
		}
		if(($s<$b) && ($i!=1)){
			if(is_string($bonus)==false){$bonus="0";}
			echo "<tr chance='1'><td class='chance_pg' chance='1'><span style='text-align:center;font-weight:bold;'>".($i+1)."</span></td><td class='coef_pg' chance='1'>".$c."</td><td class='bet_pg' chance='1'>".$bet."</td><td class='consumption_pg' chance='1'>".$s."</td><td class='bonus_pg' chance='1'>".$bonus."</span></td><td class='status_pg' chance='1'><button class='submit_pg_w' chance='1'>WON</button><button class='submit_pg_l' chance='1'>LOST</button></td></tr>";
			$bet_m = $bet;
			$s_m = $s;
			$i++;
		}
		$bonus = false;
	}
	echo "</table>";
	echo "Попыток: ".$ii."</div>";
	$b=$b-$bet_m;
	$code1 = time();
	$record_data = array($b,$bet_m,$s_m,$c,$code1,$p,$_COOKIE['login']);
	$record_cell = array("bank","bet","consumption","coef","code","profit","label");
	$db = new DB();
	$db->UpdateData("UPDATE `account_data` SET `current_bet`='".$code1."' WHERE `label`='".$_COOKIE['login']."'");
	$db->InsertData("probet_go",$record_data,$record_cell,"probet_go");
	//$id = $db->SelectByQueryString("SELECT LAST_INSERT_ID()");
	//print_r($id);
	//echo "<h1>". $id ."</h1>";
?>