<?php
	
	if($_SERVER['REQUEST_METHOD'] == 'POST') {
		function NumMatrix($chance_to_score){
			$y=0;
			$null = 0;
			$chance_to_score = round($chance_to_score*100); // 1.4038426579268 * 100 = 140
			for($x=0;$x<=10000;$x++){
				if($y<=$chance_to_score){
					$nummatrix[] = $y+1;
					if($x!=10000){$y++;}
				}
				else{
					$nummatrix[] = 0;
					$null++;
				}
			}
			//echo '$y = '.$y."<br>";
			//echo '$null = '.$null."<br>";
			shuffle($nummatrix);
			//print_r($nummatrix);
			return $nummatrix;
		}
		function MessagesGenerator($digit){
			switch($digit){
				case 0 : $result = " упускает шанс..."; break;
				case 1 : $result = " не реализовал момент..."; break;
				case 2 : $result = " бьёт мимо..."; break;
				case 3 : $result = " не забивает..."; break;
				case 4 : $result = " промахивается..."; break;
				case 5 : $result = " бьёт в штангу!"; break;
				case 6 : $result = " - хороший момент, но вратарь спасает!"; break;
			}
			return $result;
		}
		$cpu = new Processor();
		if($cpu->CheckPrivateXHR() == $cpu->stop) { echo $cpu->stop; return; }
		$k1 = $_POST['k1'];
		$kx = $_POST['kx'];
		$k2 = $_POST['k2'];
		$team1 = $_POST['t1'];
		$team2 = $_POST['t2'];
		if(strpos($k1,',') != false) { $k1 = str_replace(",", ".", $k1); }
		if(strpos($kx,',') != false) { $kx = str_replace(",", ".", $kx); }
		if(strpos($k2,',') != false) { $k2 = str_replace(",", ".", $k2); }
		$perc1 = 1/$k1*100;
		$percx = 1/$kx*100;
		$perc2 = 1/$k2*100;
		$marzha = ($perc1+$percx+$perc2) - 100;
		$perc1real = $perc1*100/($perc1+$percx+$perc2);
		$percxreal = $percx*100/($perc1+$percx+$perc2);
		$perc2real = $perc2*100/($perc1+$percx+$perc2);
		//echo "П1 - ".$perc1."\r\nX - ".$percx."\r\nП2 - ".$perc2."\r\n\r\nСумма = " . ($perc1+$percx+$perc2) . "\r\nРеал П1 - ".$perc1real."\r\nРеал X - ".$percxreal."\r\nРеал П2 - ".$perc2real."\r\n\r\nСумма = " . ($perc1real+$percxreal+$perc2real);
		echo "<div class='match'>";
		$team1_strengh = array('stamina' => 100,'attack' => $perc1real);
		$team2_strengh = array('stamina' => 100,'attack' => $perc2real);
		$points1 = $points2 = 0;
		$message=false;
		$misses1=$misses2=0;
		$gt = array();
		$additional_time = mt_rand(1,mt_rand(2,mt_rand(3,10)));
		$next_min_no_goal = -1;
		for($m=0;$m<=(90 + $additional_time);$m++){
			//$current_mood_team1 = (mt_rand(0,100)/100);
			//$current_mood_team2 = (mt_rand(0,100)/100);
			//$chance_to_score_team1 = ($current_mood_team1*((100/$k_1)-$misses1));
			$rnd_k = (mt_rand(100,105))/100;
			//echo '$rnd_k = '.$rnd_k.'<br>';
			switch(mt_rand(0,2)){
				case 0 :
					if($team1_strengh['attack']>$team2_strengh['attack']){
						$team2_strengh['attack'] = $team2_strengh['attack'] * $rnd_k * (1+(mt_rand(0,$m)/mt_rand(300,3000)));
						$team1_strengh['attack'] = $team1_strengh['attack'] / $rnd_k * (1+(mt_rand(0,$m)/mt_rand(300,3000)));
					}
					else{
						$team1_strengh['attack'] = $team1_strengh['attack'] * $rnd_k * (1+(mt_rand(0,$m)/mt_rand(300,3000)));
						$team2_strengh['attack'] = $team2_strengh['attack'] / $rnd_k * (1+(mt_rand(0,$m)/mt_rand(300,3000)));
					}
					break;
				case 1 :
					$team1_strengh['attack'] = $team1_strengh['attack'] * (1+(mt_rand(0,$m)/mt_rand(500,3000))); break;
				case 2 :	
					$team2_strengh['attack'] = $team2_strengh['attack'] * (1+(mt_rand(0,$m)/mt_rand(500,3000))); break;
			}
			$current_team1_attack = ($team1_strengh['stamina']/mt_rand(100,200)) * $team1_strengh['attack']*(mt_rand(75,100)/100); // *(1+(mt_rand(0,$m))/(mt_rand(75,100)))
			//echo '$current_team1_attack = '.$current_team1_attack."<br>";
			$current_team2_attack = ($team2_strengh['stamina']/mt_rand(100,200)) * $team2_strengh['attack']*(mt_rand(75,100)/100); // *(1+(mt_rand(0,$m))/(mt_rand(75,100)))
			//echo '$current_team2_attack = '.$current_team2_attack."<br>";
			switch(mt_rand(0,3)){
				case 0 : $stamina_minus1 = $current_team1_attack/mt_rand(7,33); $stamina_minus2 = $current_team2_attack/mt_rand(7,33); break;
				case 1 : $stamina_minus1 = $current_team2_attack/mt_rand(7,33); $stamina_minus2 = $current_team2_attack/mt_rand(7,33); break;
				case 2 : $stamina_minus1 = $current_team2_attack/mt_rand(7,33); $stamina_minus2 = $current_team1_attack/mt_rand(7,33); break;
				case 3 : $stamina_minus1 = $current_team1_attack/mt_rand(7,33); $stamina_minus2 = $current_team1_attack/mt_rand(7,33); break;
			}
			$att1_minus = (1-((mt_rand(0,(100-$m)))/(mt_rand(100,200))));
			//echo '$att1_minus = '.$att1_minus."<br>";
			$chance_to_score_team1 = $current_team1_attack*(($team1_strengh['stamina']+$team1_strengh['attack'])/mt_rand(100,200)) * $att1_minus;
			$team1_strengh['stamina'] = $team1_strengh['stamina'] - $stamina_minus1;
			$att2_minus = (1-((mt_rand(0,(100-$m)))/(mt_rand(100,200))));
			//echo '$att1_minus = '.$att2_minus."<br>";
			$chance_to_score_team2 = $current_team2_attack*(($team2_strengh['stamina']+$team2_strengh['attack'])/mt_rand(100,200)) * $att1_minus;
			$team2_strengh['stamina'] = $team2_strengh['stamina'] - $stamina_minus2;
			//$team1_strengh['attack'] = ($team1_strengh['attack']*$team1_strengh['stamina']/100)+mt_rand(0,10);
			//$team2_strengh['attack'] = ($team2_strengh['attack']*$team2_strengh['stamina']/100)+mt_rand(0,10);
			//echo '$stamina_minus1 = '.$stamina_minus1."<br>";
			//echo '$stamina_minus2 = '.$stamina_minus2."<br>";
			//$chance_to_score_team2 = ($current_mood_team2*((100/$k_2)-$misses2));
			$min = min($chance_to_score_team1,$chance_to_score_team2);
			//echo '$min = '.$min."<br>";
			$chance_to_score_team1 = $chance_to_score_team1-$min;
			//echo '$real_chance1 = '.$chance_to_score_team1."<br>";
			$chance_to_score_team2 = $chance_to_score_team2-$min;
			//echo '$real_chance2 = '.$chance_to_score_team2."<br><br>";
			if($chance_to_score_team1>100) { $chance_to_score_team1=100; }
			if($chance_to_score_team2>100) { $chance_to_score_team2=100; }
			if($chance_to_score_team1 != false) {
				//echo 'шанс ДО: '. $chance_to_score_team1 . '<br>';
				switch ($chance_to_score_team1){
					case ($chance_to_score_team1>=90) : $mt_r = mt_rand(0,50); $chance_to_score_team1 = $chance_to_score_team1 - mt_rand(0,$mt_r); break;
					case (90>$chance_to_score_team1 && $chance_to_score_team1>=80) : $mt_r = mt_rand(0,40); $chance_to_score_team1 = $chance_to_score_team1 - mt_rand(0,$mt_r); break;
					case (80>$chance_to_score_team1 && $chance_to_score_team1>=70) : $mt_r = mt_rand(0,30); $chance_to_score_team1 = $chance_to_score_team1 - mt_rand(0,$mt_r); break;
					case (70>$chance_to_score_team1 && $chance_to_score_team1>=60) : $mt_r = mt_rand(0,20); $chance_to_score_team1 = $chance_to_score_team1 - mt_rand(0,$mt_r); break;
					case (60>$chance_to_score_team1 && $chance_to_score_team1>=50) : $mt_r = mt_rand(0,15); $chance_to_score_team1 = $chance_to_score_team1 - mt_rand(0,$mt_r); break;
					case (50>$chance_to_score_team1 && $chance_to_score_team1>=40) : $mt_r = mt_rand(0,10); $chance_to_score_team1 = $chance_to_score_team1 - mt_rand(0,$mt_r); break;
					case (40>$chance_to_score_team1 && $chance_to_score_team1>=30) : $mt_r = mt_rand(0,5); $chance_to_score_team1 = $chance_to_score_team1 - mt_rand(0,$mt_r); break;
					case (30>$chance_to_score_team1 && $chance_to_score_team1>=20) : break;
					case (20>$chance_to_score_team1 && $chance_to_score_team1>=10) : $mt_r = mt_rand(0,5); $chance_to_score_team1 = $chance_to_score_team1 + mt_rand(0,$mt_r); break;
					case (10>$chance_to_score_team1 && $chance_to_score_team1>=0) : $mt_r = mt_rand(0,10); $chance_to_score_team1 = $chance_to_score_team1 + mt_rand(0,$mt_r); break;
				}
				//echo 'шанс ПОСЛЕ: '. $chance_to_score_team1 . '<br>';
				$matrix = NumMatrix($chance_to_score_team1);
				//print_r($matrix);
				$cell = mt_rand(0,10000);
				if($matrix[$cell] != false){
					$rr1 = 10-(round($chance_to_score_team1/10));
					switch ($rr1){
						case 10 : case 9 : case 8 : $rr1 = $rr1 - mt_rand(0,mt_rand(0,4)); break;
						case 7 : case 6 : case 5 : $rr1 = $rr1 - mt_rand(0,2); break;
						case 4 : case 3 : case 2 : $rr1 = $rr1 - mt_rand(0,1); break;
						case 1 : case 0 : break;
					}
					$r1 = mt_rand(0,$rr1);
					if(mt_rand(0,$r1) == mt_rand(0,$r1) && ($next_min_no_goal != $m)) {
						$points1++; $message="ГООООООЛ!";
						$team1_strengh["attack"] = $team1_strengh["attack"] * (mt_rand(75,125)/100);
						$gt[] = array($m,$points1,$points2,true);
						$next_min_no_goal = $m+1;
						//$team2_strengh['attack'] = $team2_strengh['attack']+mt_rand(0,mt_rand(0,round($team2_strengh['attack']/10)));
					}
					else{
						if($next_min_no_goal != $min){
							$message="УПС! ".$team1." УПУСКАЕТ ШАНС!";
							$generated_message = MessagesGenerator(mt_rand(0,6));
							$gt[] = array($m,$team1,$generated_message,false);
							$team1_strengh['attack'] = $team1_strengh['attack']-($team1_strengh['attack']/mt_rand(10,100));
						}
					}
				}
				else{
					$team1_strengh["attack"] = $team1_strengh["attack"] * (mt_rand(95,100)/100);
				}
			}
			else{
				//echo 'шанс ДО: '. $chance_to_score_team2 . '<br>';
				switch ($chance_to_score_team2){
					case ($chance_to_score_team2>=90) : $mt_r = mt_rand(0,50); $chance_to_score_team2 = $chance_to_score_team2 - mt_rand(0,$mt_r); break;
					case (90>$chance_to_score_team2 && $chance_to_score_team2>=80) : $mt_r = mt_rand(0,40); $chance_to_score_team2 = $chance_to_score_team2 - mt_rand(0,$mt_r); break;
					case (80>$chance_to_score_team2 && $chance_to_score_team2>=70) : $mt_r = mt_rand(0,30); $chance_to_score_team2 = $chance_to_score_team2 - mt_rand(0,$mt_r); break;
					case (70>$chance_to_score_team2 && $chance_to_score_team2>=60) : $mt_r = mt_rand(0,20); $chance_to_score_team2 = $chance_to_score_team2 - mt_rand(0,$mt_r); break;
					case (60>$chance_to_score_team2 && $chance_to_score_team2>=50) : $mt_r = mt_rand(0,15); $chance_to_score_team2 = $chance_to_score_team2 - mt_rand(0,$mt_r); break;
					case (50>$chance_to_score_team2 && $chance_to_score_team2>=40) : $mt_r = mt_rand(0,10); $chance_to_score_team2 = $chance_to_score_team2 - mt_rand(0,$mt_r); break;
					case (40>$chance_to_score_team2 && $chance_to_score_team2>=30) : $mt_r = mt_rand(0,5); $chance_to_score_team2 = $chance_to_score_team2 - mt_rand(0,$mt_r); break;
					case (30>$chance_to_score_team2 && $chance_to_score_team2>=20) : break;
					case (20>$chance_to_score_team2 && $chance_to_score_team2>=10) : $mt_r = mt_rand(0,5); $chance_to_score_team2 = $chance_to_score_team2 + mt_rand(0,$mt_r); break;
					case (10>$chance_to_score_team2 && $chance_to_score_team2>=0) : $mt_r = mt_rand(0,10); $chance_to_score_team2 = $chance_to_score_team2 + mt_rand(0,$mt_r); break;
				}
				//echo 'шанс ПОСЛЕ: '. $chance_to_score_team2 . '<br>';
				$matrix = NumMatrix($chance_to_score_team2);
				$cell = mt_rand(0,10000);
				if($matrix[$cell] != false){
					$rr1 = 10-(round($chance_to_score_team2/10));
					switch ($rr1){
						case 10 : case 9 : case 8 : $rr1 = $rr1 - mt_rand(0,mt_rand(0,4)); break;
						case 7 : case 6 : case 5 : $rr1 = $rr1 - mt_rand(0,2); break;
						case 4 : case 3 : case 2 : $rr1 = $rr1 - mt_rand(0,1); break;
						case 1 : case 0 : break;
					}
					//echo '$rr1: '. $rr1 . '<br>';
					$r1 = mt_rand(0,$rr1);
					if(mt_rand(0,$r1) == mt_rand(0,$r1) && ($next_min_no_goal != $m)) {
						$points2++; $message="ГООООООЛ!";
						$team2_strengh["attack"] = $team2_strengh["attack"] * (mt_rand(75,125)/100);
						$gt[] = array($m,$points1,$points2,true);
						$next_min_no_goal = $m+1;
					}
					else{
						if($next_min_no_goal != $min){
							$message="УПС! ".$team2." УПУСКАЕТ ШАНС!";
							$generated_message = MessagesGenerator(mt_rand(0,6));
							$gt[] = array($m,$team2,$generated_message,false);
							$team2_strengh['attack'] = $team2_strengh['attack']-($team2_strengh['attack']/mt_rand(10,100));
						}
					}
					if($misses2<0) { $misses2=0; }
				}
				else{
					$team2_strengh["attack"] = $team2_strengh["attack"] * (mt_rand(95,100)/100);
				}
			}
			
			//echo '[$cell] = '.$cell."<br>";
			//echo '$matrix[$cell] = '.$matrix[$cell]."<br>";
			//echo $m."' ".$team1." ".$points1.":".$points2." ".$team2."<br>";
			//echo $message . "<br>";
			$stamina_plus1 = ($team1_strengh['stamina']/mt_rand(100,1000))+($perc1real/mt_rand(100,1000));
			$stamina_plus2 = ($team2_strengh['stamina']/mt_rand(100,1000))+($perc2real/mt_rand(100,1000));
			$team1_strengh['stamina'] = $team1_strengh['stamina'] + $stamina_plus1;
			$team2_strengh['stamina'] = $team2_strengh['stamina'] + $stamina_plus2;
			//echo 'chance_to_score_team1 = '.$chance_to_score_team1."<br>";
			//echo 'chance_to_score_team2 = '.$chance_to_score_team2."<br><br>";
			//echo '$team1_strengh["stamina"] = '.$team1_strengh['stamina']."<br>";
			//echo '$team2_strengh["stamina"] = '.$team2_strengh['stamina']."<br>";
			//echo '$team1_strengh["attack"] = '.$team1_strengh['attack']."<br>";
			//echo '$team2_strengh["attack"] = '.$team2_strengh['attack']."<br><br>";
			//echo '$stamina_plus1 = '.$stamina_plus1."<br>";
			//echo '$stamina_plus2 = '.$stamina_plus2."<br><br>";
			$message=false;
		}
		echo "<h1>".$team1." <span style='color:blue;'>".$points1.":".$points2."</span> ".$team2."</h1><br>";
		for($t=0;$t<count($gt);$t++){
			switch($gt[$t][3]){
				case false : echo "<h4>".$gt[$t][0]."' ".$gt[$t][1]." ".$gt[$t][2]."</h4><br>"; break;
				case true  : echo "<h4>".$gt[$t][0]."' ".$team1." <span style='color:blue;'>".$gt[$t][1].":".$gt[$t][2]."</span> ".$team2."</h4><br>"; break;
			}
		}
		echo "</div>";
	}
?>