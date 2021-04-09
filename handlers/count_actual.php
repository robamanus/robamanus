<?php
	if(strpos($req_db,'.') != false) { $c = str_replace(".", ",", $c); }
	$p = $_POST['p'];
	$c = $_POST['c'];
	$b = $_POST['b'];
	$i = $s = 0;
	$min = $p/($c-1);
	//if($min<10) $min = 10;
	$n = ($p+$min)/($c*$min-$min);
	if($n<=1) return;
	echo "<table align='center' border='1'><tr><td class='chance_pg'>Попытка</td><td>Ставка</td><td>Рассход на попытку</td></tr>";
	while($s<$b){
		$tmp = $min*pow($n,$i);
		$tmp1 = ceil($min*pow($n,$i));
		$s += round($tmp,2);
		if($s<$b){
			echo "<tr><td><span style='text-align:center;font-weight:bold;'>".($i+1)."</span></td><td>".round($min*pow($n,$i),2)." руб.</td><td>".$s." руб.</td></tr>";
			$i++;
		}
	}
	echo "</table>";
/*kn(min)=profit+min+min(n);
kn(min)-min(n)=profit+min;
n(k*min)-min=profit+min;
n=profit+min/(k*min)-min;

20+10/3*10-10=1.5
20+10/5*10-10=1.5
x*3=200+x
*/
?>