<?php
	$cpu = new Processor();
	//echo "<pre>";
	if($cpu->CheckPrivateXHR() == $cpu->stop) { echo $cpu->stop; return; }
	$p = $_POST['p'];
	$c = $_POST['c'];
	if(strpos($c,',') != false) { $c = str_replace(",", ".", $c); }
	if($c<=1) { return; }
	$b = $_POST['b'];
	$i = $s = 0;
	$min = $p/($c-1);
	$bonus = false;
	if($min<50) { $min = 50; }
	if($_COOKIE['login']=='a7cff078365c00ada677551638000c68') { $min=0.1; }
	$lastbets = array();
	//$n = ($p+$min)/($c*$min-$min);
	//if($n<=1) return;
	echo "<table id='result_table' style='margin-left:5px;text-align:center;' border='1'><tr><td class='chance_pg'>Попытка</td><td>Ставка (руб.)</td><td>Рассход на прибыль</td><td>Бонус</td></tr>";
	while($s<$b){
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
		if($s<=$b){
			if(is_string($bonus)==false){$bonus="0";}
			echo "<tr><td><span style='text-align:center;font-weight:bold;'>".($i+1)."</span></td><td>".$bet."</td><td>".$s."</td><td>".$bonus."</span></td></tr>";
			$i++;
		}
		$bonus = false;
	}
	echo "</table>";
/*kn(min)=profit+min+min(n);
kn(min)-min(n)=profit+min;
n(k*min)-min=profit+min;
n=profit+min/(k*min)-min;

kn(min)+bonus=profit+min+min(n);
kn(min)-min(n)=profit+min-bonus;
n(k*min)-min=profit+min-bonus;
n=profit+min-bonus/(k*min)-min;

10
20+10/3*10-10=1.5
20+10/5*10-10=1.5
x*3=200+x
*/
?>