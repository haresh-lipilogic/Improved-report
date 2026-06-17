<?php
//$con=mysql_connect("10.125.0.50","webserveruser","K&dN&r4a8N@du0") or die(mysql_error());//cluster1
//$con1=mysqli_connect("10.125.0.50","webserveruser","K&dN&r4a8N@du0") or die(mysqli_error());//cluster1
ini_set('max_execution_time', 100000000);

ini_set('mysql.connect_timeout', 100000000);
ini_set('default_socket_timeout', 100000000);
$con2=mysqli_connect('10.34.240.214','webserveruser','K&dN&r4a8N@du0') or die(mysql_error());//cluster 2

$con1=$con2;

date_default_timezone_set("Asia/Calcutta");
$date1=date('Y-m-d',strtotime("-1 days"));
$start_date=$date1.' 00:00:00';
$end_date=$date1.' 23:59:59';
$operator=['gamebardb_vodafone_qatar'];
$activation=0;


mysqli_query($con1,"DELETE FROM gamebardb_vodafone_qatar_report.`activation_report` WHERE `date`='".$date1."'");
for($i=1;$i<=24;$i++)
{
			$hvact=$oman=$malaysia=$saact=$sagact=$gindonesia=$ooredoo_qatar=$glambar_airtel=$gamebar_airtel=$gamebar_idea=$gamebar_voda=$glamour_idea=$glamour_voda=$gamerussia=$glamerussia=$gamebar_egypt=$gamebar_southafrica_intarget=$glambar_southafrica_intarget=$gamebar_italy=$dialog_srilanka=0;
			
			$gamebar_france=0;
		echo "==1==".date('Y-m-d H:i:s')."==<br>";	
		if($result1 = $con1->query("call fashionbardb_france.get_activation('".$start_date."',  '".$end_date."', ".$i.") "))
			{
				$activation++;
				
			$rows=mysqli_num_rows($result1);
			
			while($row1=mysqli_fetch_array($result1))
			{
				$gamebar_france=$row1['act'];
				$hvdate=$row1['dt'];
				
			}
			}
			$result1->close();
			$con1->next_result();
			
			
			echo "==2==".date('Y-m-d H:i:s')."==<br>";	
			
			$egmon1=0;
			if($result1 = $con1->query("call gamebar_egypt.getactivation('".$start_date."',  '".$end_date."', ".$i.") "))
			{
				$activation++;
			while($row1=mysqli_fetch_array($result1))
			{
				$egmon1=$row1['act'];
				$hvdate=$row1['dt'];
				
			}
			}
			$result1->close();
			$con1->next_result();
			
			
			
			echo "==3==".date('Y-m-d H:i:s')."==<br>";
			
			
			
			$egmon2=0;
			if($result1 = $con1->query("call gamebar_egypt_mondianew.getactivation('".$start_date."',  '".$end_date."', ".$i.") "))
			{
				$activation++;
			while($row1=mysqli_fetch_array($result1))
			{
				$egmon2=$row1['act'];
				$hvdate=$row1['dt'];
				
			}
			}
			$result1->close();
			$con1->next_result();
			
			$egmon=$egmon2+$egmon1;
			
		
			
		//	echo "<br>call fashionbardb_zaglam.activation_report('".$start_date."',  '".$end_date."', ".$i.")";
			echo "==4==".date('Y-m-d H:i:s')."==<br>";
			$glambarsouthafrica=$glambarsouthafrica1=0;
			if($result1 = $con1->query("call fashionbardb_zaglam.get_activation('".$start_date."',  '".$end_date."', ".$i.") "))
			{
				$activation++;
				
			$rows=mysqli_num_rows($result1);
			
			while($row1=mysqli_fetch_array($result1))
			{
				$glambarsouthafrica1=$row1['act'];
				$hvdate=$row1['dt'];
				
			}
			}
			$result1->close();
			$con1->next_result();
			
			
			
			echo "==5==".date('Y-m-d H:i:s')."==<br>";
			$glamzamobixone=0;
			if($result1 = $con1->query("call glambar_zamobixone.get_activation('".$start_date."',  '".$end_date."', ".$i.") "))
			{
				$activation++;
				
			$rows=mysqli_num_rows($result1);
			
			while($row1=mysqli_fetch_array($result1))
			{
				$glamzamobixone=$row1['act'];
				$hvdate=$row1['dt'];
				
			}
			}
			$result1->close();
			$con1->next_result();
			
			
			echo "==6==".date('Y-m-d H:i:s')."==<br>";
			$gamebar_turkey=0;
			if($result1 = $con1->query("call fashionbardb_paygurutr.get_activation('".$start_date."',  '".$end_date."', ".$i.") "))
			{
				$activation++;
				
			$rows=mysqli_num_rows($result1);
			
			while($row1=mysqli_fetch_array($result1))
			{
				$gamebar_turkey=$row1['act'];
				$hvdate=$row1['dt'];
				
			}
			}
			$result1->close();
			$con1->next_result();
			
			
			echo "==7==".date('Y-m-d H:i:s')."==<br>";
			$gamebar_ro=0;
			if($result1 = $con1->query("call gamebar_ro.get_activation('".$start_date."',  '".$end_date."', ".$i.") "))
			{
				$activation++;
				
			$rows=mysqli_num_rows($result1);
			
			while($row1=mysqli_fetch_array($result1))
			{
				$gamebar_ro=$row1['act'];
				$hvdate=$row1['dt'];
				
			}
			}
			$result1->close();
			$con1->next_result();
			
			echo "==8==".date('Y-m-d H:i:s')."==<br>";
			$gamebar_pl=0;
			if($result1 = $con1->query("call fashionbardb_polandgame.get_activation('".$start_date."',  '".$end_date."', ".$i.") "))
			{
				$activation++;
				
			$rows=mysqli_num_rows($result1);
			
			while($row1=mysqli_fetch_array($result1))
			{
				$gamebar_pl=$row1['act'];
				$hvdate=$row1['dt'];
				
			}
			}
			$result1->close();
			$con1->next_result();
			
			
			echo "==9==".date('Y-m-d H:i:s')."==<br>";
			$glambar_czech=0;
			if($result1 = $con1->query("call fashionbardb_czglam.get_activation('".$start_date."',  '".$end_date."', ".$i.") "))
			{
				$activation++;
				
			$rows=mysqli_num_rows($result1);
			
			while($row1=mysqli_fetch_array($result1))
			{
				$glambar_czech=$row1['act'];
				$hvdate=$row1['dt'];
				
			}
			}
			$result1->close();
			$con1->next_result();
			
			echo "==10==".date('Y-m-d H:i:s')."==<br>";
			$gamebar_slovenia=0;
			if($result1 = $con1->query("call gamebar_slovenia.get_activation('".$start_date."',  '".$end_date."', ".$i.") "))
			{
				$activation++;
				
			$rows=mysqli_num_rows($result1);
			
			while($row1=mysqli_fetch_array($result1))
			{
				$gamebar_slovenia=$row1['act'];
				$hvdate=$row1['dt'];
				
			}
			}
			$result1->close();
			$con1->next_result();
			
			
			
			echo "==11==".date('Y-m-d H:i:s')."==<br>";
			
			$glambar_slovenia=0;
			if($result1 = $con1->query("call glambar_slovenia.get_activation('".$start_date."',  '".$end_date."', ".$i.") "))
			{
				$activation++;
				
			$rows=mysqli_num_rows($result1);
			
			while($row1=mysqli_fetch_array($result1))
			{
				$glambar_slovenia=$row1['act'];
				$hvdate=$row1['dt'];
				
			}
			}
			$result1->close();
			$con1->next_result();
			
			
			$glambarsouthafrica=$glambarsouthafrica1+$glamzamobixone;
			
			
			
			
			echo "==12==".date('Y-m-d H:i:s')."==<br>";
			
			$sagact=$sagact1=0;
			if($result1 = $con1->query("call fashionbardb_za.get_activation('".$start_date."',  '".$end_date."', ".$i.") "))
			{
				$activation++;
				
			$rows=mysqli_num_rows($result1);
			
			while($row1=mysqli_fetch_array($result1))
			{
				$sagact1=$row1['act'];
				$gvedate=$row1['dt'];
				
			}
			}
			$result1->close();
			$con1->next_result();
			
			echo "==13==".date('Y-m-d H:i:s')."==<br>";
			$gamebarzamobixone=0;
			if($result1 = $con1->query("call gamebar_zamobixone.get_activation('".$start_date."',  '".$end_date."', ".$i.") "))
			{
				$activation++;
				
			$rows=mysqli_num_rows($result1);
			
			while($row1=mysqli_fetch_array($result1))
			{
				$gamebarzamobixone=$row1['act'];
				$gvedate=$row1['dt'];
				
			}
			}
			$result1->close();
			$con1->next_result();
			
			
			$sagact=$sagact1+$gamebarzamobixone;
			
			
			
			echo "==14==".date('Y-m-d H:i:s')."==<br>";
			
			$gamebar_myanmar=0;
			if($result1 = $con1->query("call fashionbardb_myanmartelenor.get_activation('".$start_date."','".$end_date."','".$i."') "))
			{
				$activation++;
			$rows11=0;	
			 $rows11=mysqli_num_rows($result1);
				if($rows11>0)
				{
					while($rows11=mysqli_fetch_array($result1))
					{
						$gamebar_myanmar=$rows11['act'];
						$gvedate=$row1['dt'];
						
					}
				}
			}
			//echo $gamebar_myanmar;exit;
			$result1->close();
			$con1->next_result();
			
			echo "==15==".date('Y-m-d H:i:s')."==<br>";
			$gamebar_qatar=$gamebar_qatar_ooredoo=0;
			if($result1 = $con1->query("call fashionbardb_qatarooredoo.get_activation('".$start_date."','".$end_date."','".$i."') "))
			{
				$activation++;
			$rows11=0;	
			 $rows11=mysqli_num_rows($result1);
				if($rows11>0)
				{
					while($rows11=mysqli_fetch_array($result1))
					{
						$gamebar_qatar_ooredoo=$rows11['act'];
						$gvedate=$row1['dt'];
						
					}
				}
			}
			//echo $gamebar_myanmar;exit;
			$result1->close();
			$con1->next_result();
			
			
			
			$gamebar_qatar_vodafone=0;
			
			echo "==16==".date('Y-m-d H:i:s')."==<br>";
			$gamebar_qatar=$gamebar_qatar_ooredoo+$gamebar_qatar_vodafone;
			
			
			
			$gamebar_paydashgr=0;
			if($result1 = $con1->query("call fashionbardb_greece.get_activation('".$start_date."','".$end_date."',".$i.") "))
			{
				$activation++;
				
			$rows=mysqli_num_rows($result1);
			
			while($row1=mysqli_fetch_array($result1))
			{
				$gamebar_paydashgr=$row1['act'];
				$gvedate=$row1['dt'];
				
			}
			}
			$result1->close();
			$con1->next_result();
		
			$glambar_thailand=0;
			echo "==17==".date('Y-m-d H:i:s')."==<br>";
			
			if($result1 = $con1->query("call fashionbardb_glam9005thailand.get_activation('".$start_date."','".$end_date."',".$i.") "))
			{
				$activation++;
				
			$rows=mysqli_num_rows($result1);
			
			while($row1=mysqli_fetch_array($result1))
			{
				$glambar_thailand=$row1['act'];
				$gvedate=$row1['dt'];
				
			}
			}
			$result1->close();
			$con1->next_result();
			
			
			
			echo "==18==".date('Y-m-d H:i:s')."==<br>";
			$gamebar_thailand=0;
			if($result1 = $con1->query("call fashionbardb_game9305thailand.get_activation('".$start_date."','".$end_date."',".$i.") "))
			{
				$activation++;
				
			$rows=mysqli_num_rows($result1);
			
			while($row1=mysqli_fetch_array($result1))
			{
				$gamebar_thailand=$row1['act'];
				$gvedate=$row1['dt'];
				
			}
			}
			$result1->close();
			$con1->next_result();
			
			
			
			echo "==19==".date('Y-m-d H:i:s')."==<br>";
			
			
		
			
			echo "==20==".date('Y-m-d H:i:s')."==<br>";
			
			$glambar_paydashgr=0;
			if($result1 = $con1->query("call fashionbardb_greeceglambar.get_activation('".$start_date."',  '".$end_date."', ".$i.") "))
			{
				$activation++;
				
			$rows=mysqli_num_rows($result1);
			
			while($row1=mysqli_fetch_array($result1))
			{
				$glambar_paydashgr=$row1['act'];
				$omandate=$row1['dt'];
				
			}
			}
			$result1->close();
			$con1->next_result();
			
			
			
			
			
			echo "==21==".date('Y-m-d H:i:s')."==<br>";
			$gamebar_kuwait=$kuwaitzain=$kuwaitstc=0;
						
						
						if($result1 = $con1->query("call fashionbardb_slakwzain.get_activation('".$start_date."',  '".$end_date."', '".$i."') "))
						{
							$activation++;
							
						$rows=mysqli_num_rows($result1);
						
						while($row1=mysqli_fetch_array($result1))
						{
							$kuwaitzain=$row1['act'];
							$omandate=$row1['dt'];
							
						}
						}
						$result1->close();
						$con1->next_result();
						
						
						echo "==22==".date('Y-m-d H:i:s')."==<br>";
						if($result1 = $con1->query("call fashionbardb_slakwstc.get_activation('".$start_date."',  '".$end_date."', '".$i."') "))
						{
							$activation++;
							
						$rows=mysqli_num_rows($result1);
						
						while($row1=mysqli_fetch_array($result1))
						{
							$kuwaitstc=$row1['act'];
							$omandate=$row1['dt'];
							
						}
						}
						$result1->close();
						$con1->next_result();
						
						
						
						
						
						
						
					echo "==23==".date('Y-m-d H:i:s')."==<br>";	
						$gamebar_kuwait=$kuwaitzain+$kuwaitstc;
			//echo "call fashionbardb_bh.get_activation('".$start_date."',  '".$end_date."', ".$i.") ";exit;
			
			
			$gamebar_bahrain=0;
						$result2 = $con1->query("call fashionbardb_bh.get_activation('".$start_date."',  '".$end_date."', ".$i.") ");
						$rows=mysqli_num_rows($result2);
						$saact=0;
						
						while($row1=mysqli_fetch_array($result2))
						{
							$gamebar_bahrain=$row1['act'];
							$sagdate=$row1['dt'];
							
						}
						
						$result2->close();
						$con1->next_result();
						
						
						echo "==24==".date('Y-m-d H:i:s')."==<br>";
						
					$gamebar_indonesia1=0;
					if($result1 = $con1->query("call gamebardb_indonesia.get_activation('".$start_date."',  '".$end_date."', ".$i.") "))
					{
						$activation++;
						
					$rows=mysqli_num_rows($result1);
					
					while($row1=mysqli_fetch_array($result1))
					{
						$gamebar_indonesia1=$row1['act'];
						$omandate=$row1['dt'];
						
					}
					}
					$result1->close();
					$con1->next_result();
					
					
					$gamebar_indonesia2=0;
					if($result1 = $con1->query("call fashionbardb_idtelkomsel.get_activation('".$start_date."',  '".$end_date."', ".$i.") "))
					{
						$activation++;
						
					$rows=mysqli_num_rows($result1);
					
					while($row1=mysqli_fetch_array($result1))
					{
						$gamebar_indonesia2=$row1['act'];
						$omandate=$row1['dt'];
						
					}
					}
					$result1->close();
					$con1->next_result();
					
					
					
					$gamebar_indonesia=$gamebar_indonesia2+$gamebar_indonesia1;
					
					
					
					
					
					echo "==25==".date('Y-m-d H:i:s')."==<br>";
					$gamebar_norway=0;
					if($result1 = $con1->query("call fashionbardb_norway.get_activation('".$start_date."',  '".$end_date."', ".$i.") "))
					{
						$activation++;
						
					$rows=mysqli_num_rows($result1);
					
					while($row1=mysqli_fetch_array($result1))
					{
						$gamebar_norway=$row1['act'];
						$omandate=$row1['dt'];
						
					}
					}
					//$result1->close();
					$con1->next_result();
					
					
					echo "==26==".date('Y-m-d H:i:s')."==<br>";
					
					$gamebar_pk=0;
					if($result1 = $con1->query("call fashionbardb_pkzong.get_activation('".$start_date."',  '".$end_date."', ".$i.") "))
					{
						$activation++;
						
					$rows=mysqli_num_rows($result1);
					
					while($row1=mysqli_fetch_array($result1))
					{
						$gamebar_pk=$row1['act'];
						$omandate=$row1['dt'];
						
					}
					}
					$result1->close();
					$con1->next_result();
					
					echo "==27==".date('Y-m-d H:i:s')."==<br>";
					
					
					
					echo "==28==".date('Y-m-d H:i:s')."==<br>";
					
					$gamebar_ksa=0;
					if($result1 = $con1->query("call fashionbardb_timwezain.get_activation('".$start_date."',  '".$end_date."', ".$i.") "))
					{
						$activation++;
						
					$rows=mysqli_num_rows($result1);
					
					while($row1=mysqli_fetch_array($result1))
					{
						$gamebar_ksa=$row1['act'];
						$omandate=$row1['dt'];
						
					}
					}
					$result1->close();
					$con1->next_result();
					
					
					
					
					echo "==31==".date('Y-m-d H:i:s')."==<br>";
					$gamebar_oman=0;
					if($result1 = $con1->query("call fashionbardb_omooredoo.get_activation('".$start_date."',  '".$end_date."', ".$i.") "))
					{
						$activation++;
						
					$rows=mysqli_num_rows($result1);
					
					while($row1=mysqli_fetch_array($result1))
					{
						$gamebar_oman=$row1['act'];
						$omandate=$row1['dt'];
						
					}
					}
					$result1->close();
					$con1->next_result();
			
					echo "==32==".date('Y-m-d H:i:s')."==<br>";
					$gamebar_uae=0;
					if($result1 = $con1->query("call fashionbardb_etisalat.get_activation('".$start_date."',  '".$end_date."', ".$i.") "))
					{
						$activation++;
						
					$rows=mysqli_num_rows($result1);
					
					while($row1=mysqli_fetch_array($result1))
					{
						$gamebar_uae=$row1['act'];
						$omandate=$row1['dt'];
						
					}
					}
					$result1->close();
					$con1->next_result();
					
					echo "==33==".date('Y-m-d H:i:s')."==<br>";
					$glambar_pl=0;
					if($result1 = $con1->query("call glambar_plteleaudio.getactivation('".$start_date."',  '".$end_date."', ".$i.") "))
					{
						$activation++;
						
					$rows=mysqli_num_rows($result1);
					
					while($row1=mysqli_fetch_array($result1))
					{
						$glambar_pl=$row1['act'];
						$omandate=$row1['dt'];
						
					}
					}
					$result1->close();
					$con1->next_result();
					
					//echo "call fashionbardb_cz.get_activation('".$start_date."',  '".$end_date."', ".$i.")";
					echo "==34==".date('Y-m-d H:i:s')."==<br>";
					$gamebar_cz=0;
					if($result1 = $con1->query("call fashionbardb_cz.get_activation('".$start_date."',  '".$end_date."', ".$i.") "))
					{
						$activation++;
						
					$rows=mysqli_num_rows($result1);
					
					while($row1=mysqli_fetch_array($result1))
					{
						$gamebar_cz=$row1['act'];
						$omandate=$row1['dt'];
						
					}
					}
					$result1->close();
					$con1->next_result();
					
					echo "==35==".date('Y-m-d H:i:s')."==<br>";
					$gamebar_sweden=0;
					if($result1 = $con1->query("call fashionbardb_sweden.get_activation('".$start_date."',  '".$end_date."', ".$i.") "))
					{
						$activation++;
						
					$rows=mysqli_num_rows($result1);
					
					while($row1=mysqli_fetch_array($result1))
					{
						$gamebar_sweden=$row1['act'];
						$omandate=$row1['dt'];
						
					}
					}
					$result1->close();
					$con1->next_result();
					
					
					echo "==36==".date('Y-m-d H:i:s')."==<br>";
						$gamebar_finland=0;
					if($result1 = $con1->query("call fashionbardb_finland.get_activation('".$start_date."',  '".$end_date."', ".$i.") "))
					{
						$activation++;
						
					$rows=mysqli_num_rows($result1);
					
					while($row1=mysqli_fetch_array($result1))
					{
						$gamebar_finland=$row1['act'];
						$omandate=$row1['dt'];
						
					}
					}
					$result1->close();
					$con1->next_result();
					
					echo "==37==".date('Y-m-d H:i:s')."==<br>";
					
					$glambar_pldmc=0;
					if($result1 = $con1->query("call fashionbardb_polandglam.get_activation('".$start_date."',  '".$end_date."', ".$i.") "))
					{
						$activation++;
						
					$rows=mysqli_num_rows($result1);
					
					while($row1=mysqli_fetch_array($result1))
					{
						$glambar_pldmc=$row1['act'];
						$omandate=$row1['dt'];
						
					}
					}
					$result1->close();
					$con1->next_result();
					echo "==38==".date('Y-m-d H:i:s')."==<br>";
			
					$gamebar_switzerland=0;
					if($result1 = $con1->query("call gamebar_ch_nth.get_activation('".$start_date."',  '".$end_date."', ".$i.") "))
					{
						$activation++;
						
					$rows=mysqli_num_rows($result1);
					
					while($row1=mysqli_fetch_array($result1))
					{
						$gamebar_switzerland=$row1['act'];
						$omandate=$row1['dt'];
						
					}
					}
					$result1->close();
					$con1->next_result();
					
					echo "==39==".date('Y-m-d H:i:s')."==<br>";
					$gamebar_Mozambique=0;
					if($result1 = $con1->query("call fashionbardb_mz.get_activation('".$start_date."',  '".$end_date."', ".$i.") "))
					{
						$activation++;
						
					$rows=mysqli_num_rows($result1);
					
					while($row1=mysqli_fetch_array($result1))
					{
						$gamebar_Mozambique=$row1['act'];
						$omandate=$row1['dt'];
						
					}
					}
					$result1->close();
					$con1->next_result();
					
					echo "==40==".date('Y-m-d H:i:s')."==<br>";
					
					
					
					$gamebar_iraq1=$gamebar_iraq=0;
					if($result1 = $con1->query("call gamebar_iqzain_qg.getactivation('".$start_date."',  '".$end_date."', ".$i.") "))
					{
						$activation++;
						
					$rows=mysqli_num_rows($result1);
					
					while($row1=mysqli_fetch_array($result1))
					{
						$gamebar_iraq1=$row1['act'];
						$omandate=$row1['dt'];
						
					}
					}
					$result1->close();
					$con1->next_result();
					
					
					
					$gamebar_iraqmwapi=0;
					if($result1 = $con1->query("call gamebar_iqmw_api.getactivation('".$start_date."',  '".$end_date."', ".$i.") "))
					{
						$activation++;
						
					$rows=mysqli_num_rows($result1);
					
					while($row1=mysqli_fetch_array($result1))
					{
						$gamebar_iraqmwapi=$row1['act'];
						$omandate=$row1['dt'];
						
					}
					
					}
					$result1->close();
					$con1->next_result();
					
					$gamebar_iraq=$gamebar_iraq1+$gamebar_iraqmwapi;
					
					
					
					
					$gamebar_kenya=0;
					if($result1 = $con1->query("call fashionbardb_safaricom.get_activation('".$start_date."',  '".$end_date."', ".$i.") "))
					{
						$activation++;
						
					$rows=mysqli_num_rows($result1);
					
					while($row1=mysqli_fetch_array($result1))
					{
						$gamebar_kenya=$row1['act'];
						$omandate=$row1['dt'];
						
					}
					}
					$result1->close();
					$con1->next_result();
					
					$gamebar_jordan1=0;
						
						$result2 = $con1->query("call fashionbardb_joorange.get_activation('".$start_date."',  '".$end_date."', ".$i.") ");
						$rows=mysqli_num_rows($result2);
						$saact=0;
						
						while($row1=mysqli_fetch_array($result2))
						{
							$gamebar_jordan1=$row1['act'];
							$sagdate=$row1['dt'];
							
						}
						
						$result2->close();
						$con1->next_result();
						
						$gamebar_jordanum=0;
						$result2 = $con1->query("call fashionbardb_joumniah.get_activation('".$start_date."',  '".$end_date."', ".$i.") ");
						$rows=mysqli_num_rows($result2);
						$saact=0;
						
						while($row1=mysqli_fetch_array($result2))
						{
							$gamebar_jordanum=$row1['act'];
							$sagdate=$row1['dt'];
							
						}
						
						$result2->close();
						$con1->next_result();
						
						
						$gamebar_zain=0;
						$result2 = $con1->query("call gamebar_jozain.getactivation('".$start_date."',  '".$end_date."', ".$i.") ");
						$rows=mysqli_num_rows($result2);
						$saact=0;
						
						while($row1=mysqli_fetch_array($result2))
						{
							$gamebar_zain=$row1['act'];
							$sagdate=$row1['dt'];
							
						}
						
						$result2->close();
						$con1->next_result();
						
						
						
						$gamebar_jordan=$gamebar_jordan1+$gamebar_jordanum+$gamebar_zain;
					
					
					
					
					$gamebar_bangladesh1=0;
					if($result1 = $con1->query("call gamebar_bdgrameen.getactivation('".$start_date."',  '".$end_date."', ".$i.") "))
					{
						$activation++;
						
					$rows=mysqli_num_rows($result1);
					
					while($row1=mysqli_fetch_array($result1))
					{
						$gamebar_bangladesh1=$row1['act'];
						$omandate=$row1['dt'];
						
					}
					}
					$result1->close();
					$con1->next_result();
					
					
					
					$gamebar_bangladesh2=0;
					if($result1 = $con1->query("call fashionbardb_bdgp.get_activation('".$start_date."',  '".$end_date."', ".$i.") "))
					{
						$activation++;
						
					$rows=mysqli_num_rows($result1);
					
					while($row1=mysqli_fetch_array($result1))
					{
						$gamebar_bangladesh2=$row1['act'];
						$omandate=$row1['dt'];
						
					}
					}
					$result1->close();
					$con1->next_result();
					
					
					
					
					$gamebar_bangladesh3=0;
					if($result1 = $con1->query("call gamebar_bdrobi.getactivation('".$start_date."',  '".$end_date."', ".$i.") "))
					{
						$activation++;
						
					$rows=mysqli_num_rows($result1);
					
					while($row1=mysqli_fetch_array($result1))
					{
						$gamebar_bangladesh3=$row1['act'];
						$omandate=$row1['dt'];
						
					}
					}
					$result1->close();
					$con1->next_result();
					
					
					
					
					
					
					
				$gamebar_bangladesh=$gamebar_bangladesh2+$gamebar_bangladesh1+$gamebar_bangladesh3;
				
					$gamebar_ghana=0;
					if($result1 = $con1->query("call gamebar_ghairtel_mtech.getactivation('".$start_date."',  '".$end_date."', ".$i.") "))
					{
						$activation++;
						
					$rows=mysqli_num_rows($result1);
					
					while($row1=mysqli_fetch_array($result1))
					{
						$gamebar_ghana=$row1['act'];
						$omandate=$row1['dt'];
						
					}
					}
					$result1->close();
					$con1->next_result();
				
				$gamebar_Nigeriammt=0;
					if($result1 = $con1->query("call gamebar_nigeria_MMT.getactivation('".$start_date."',  '".$end_date."', ".$i.") "))
					{
						$activation++;
						
					$rows=mysqli_num_rows($result1);
					
					while($row1=mysqli_fetch_array($result1))
					{
						$gamebar_Nigeriammt=$row1['act'];
						$omandate=$row1['dt'];
						
					}
					}
					$result1->close();
					$con1->next_result();
					
					$gamebar_Nigeria=$gamebar_Nigeriamtn=0;
					if($result1 = $con1->query("call fashionbardb_ngmtn.get_activation('".$start_date."',  '".$end_date."', ".$i.") "))
					{
						$activation++;
						
					$rows=mysqli_num_rows($result1);
					
					while($row1=mysqli_fetch_array($result1))
					{
						$gamebar_Nigeriamtn=$row1['act'];
						$omandate=$row1['dt'];
						
					}
					}
					$result1->close();
					$con1->next_result();
					$gamebar_Nigeria=$gamebar_Nigeriamtn+$gamebar_Nigeriammt;
					
					
					$gamebar_gabon=0;
					if($result1 = $con1->query("call fashionbardb_gabon.get_activation('".$start_date."',  '".$end_date."', ".$i.") "))
					{
						$activation++;
						
					$rows=mysqli_num_rows($result1);
					
					while($row1=mysqli_fetch_array($result1))
					{
						$gamebar_gabon=$row1['act'];
						$omandate=$row1['dt'];
						
					}
					}
					$result1->close();
					$con1->next_result();
				
				
				
					$Players_kenya=0;
					if($result1 = $con1->query("call fashionbardb_safaricompkm.get_activation('".$start_date."',  '".$end_date."', ".$i.") "))
					{
						$activation++;
						
					$rows=mysqli_num_rows($result1);
					
					while($row1=mysqli_fetch_array($result1))
					{
						$Players_kenya=$row1['act'];
						$omandate=$row1['dt'];
						
					}
					}
					$result1->close();
					$con1->next_result();
				
				
					$gamebar_Palestine=0;
					if($result1 = $con1->query("call fashionbardb_psjw.get_activation('".$start_date."',  '".$end_date."', ".$i.") "))
					{
						$activation++;
						
					$rows=mysqli_num_rows($result1);
					
					while($row1=mysqli_fetch_array($result1))
					{
						$gamebar_Palestine=$row1['act'];
						$omandate=$row1['dt'];
						
					}
					}
					$result1->close();
					$con1->next_result();
				
				
					$players_ng=0;
					if($result1 = $con1->query("call fashionbardb_ngmtn11.get_activation('".$start_date."',  '".$end_date."', ".$i.") "))
					{
						$activation++;
						
					$rows=mysqli_num_rows($result1);
					
					while($row1=mysqli_fetch_array($result1))
					{
						$players_ng=$row1['act'];
						$omandate=$row1['dt'];
						
					}
					}
					$result1->close();
					$con1->next_result();
					
					$contest_qatar=0;
					if($result1 = $con1->query("call contestdb_qaoo.get_activation('".$start_date."',  '".$end_date."', ".$i.") "))
					{
						$activation++;
						
					$rows=mysqli_num_rows($result1);
					
					while($row1=mysqli_fetch_array($result1))
					{
						$contest_qatar=$row1['act'];
						$omandate=$row1['dt'];
						
					}
					}
					$result1->close();
					$con1->next_result();
					
					
					
					$gamebar_et=0;
					if($result1 = $con1->query("call gamebar_ethopia.getactivation('".$start_date."',  '".$end_date."', ".$i.") "))
					{
						$activation++;
						
					$rows=mysqli_num_rows($result1);
					
					while($row1=mysqli_fetch_array($result1))
					{
						$gamebar_et=$row1['act'];
						$omandate=$row1['dt'];
						
					}
					}
					$result1->close();
					$con1->next_result();
					
					$players_et=0;
					if($result1 = $con1->query("call 11players_ethopia.getactivation('".$start_date."',  '".$end_date."', ".$i.") "))
					{
						$activation++;
						
					$rows=mysqli_num_rows($result1);
					
					while($row1=mysqli_fetch_array($result1))
					{
						$players_et=$row1['act'];
						$omandate=$row1['dt'];
						
					}
					}
					$result1->close();
					$con1->next_result();
					
					
					
					
					$players_bd=$players_bd_daily=$players_bd_weekly=$players_bd_monthly=0;
						$result2 = $con1->query("call 11players_bdrobi.getactivation('".$start_date."',  '".$end_date."', ".$i.") ");
						$rows=mysqli_num_rows($result2);
						$saact=0;
						
						while($row1=mysqli_fetch_array($result2))
						{
							$players_bd_daily=$row1['act'];
							$sagdate=$row1['dt'];
							
						}
						
						$result1->close();
						$con1->next_result();
						
						
						$result2 = $con1->query("call 11players_bdrobi_weekly.getactivation('".$start_date."',  '".$end_date."', ".$i.") ");
						$rows=mysqli_num_rows($result2);
						$saact=0;
						
						while($row1=mysqli_fetch_array($result2))
						{
							$players_bd_weekly=$row1['act'];
							$sagdate=$row1['dt'];
							
						}
						
						$result1->close();
						$con1->next_result();
						
						
						$result2 = $con1->query("call 11players_bdrobi_monthly.getactivation('".$start_date."',  '".$end_date."', ".$i.") ");
						$rows=mysqli_num_rows($result2);
						$saact=0;
						
						while($row1=mysqli_fetch_array($result2))
						{
							$players_bd_monthly=$row1['act'];
							$sagdate=$row1['dt'];
							
						}
						
						$result1->close();
						$con1->next_result();
						
						
						echo $players_bd=$players_bd_daily+$players_bd_weekly+$players_bd_monthly;
						
						$players_ghana=0;
						$result2 = $con1->query("call fashionbardb_ghmtn11.get_activation('".$start_date."',  '".$end_date."', ".$i.") ");
						$rows=mysqli_num_rows($result2);
						$saact=0;
						
						while($row1=mysqli_fetch_array($result2))
						{
							$players_ghana=$row1['act'];
							$sagdate=$row1['dt'];
							
						}
						
						$result1->close();
						$con1->next_result();
						
						
						
						$players_ksa=0;
						$result2 = $con1->query("call fashionbardb_sa11.get_activation('".$start_date."',  '".$end_date."', ".$i.") ");
						$rows=mysqli_num_rows($result2);
						$saact=0;
						
						while($row1=mysqli_fetch_array($result2))
						{
							$players_ksa=$row1['act'];
							$sagdate=$row1['dt'];
							
						}
						
						$result1->close();
						$con1->next_result();
						
						$gamebar_lk=0;
						$result2 = $con1->query("call gamebar_lk_dig.getactivation('".$start_date."',  '".$end_date."', ".$i.") ");
						$rows=mysqli_num_rows($result2);
						$saact=0;
						
						while($row1=mysqli_fetch_array($result2))
						{
							$gamebar_lk=$row1['act'];
							$sagdate=$row1['dt'];
							
						}
						
						$result1->close();
						$con1->next_result();
					
					
						$contest_bh=0;
						$result2 = $con1->query("call contestdb_bh.get_activation('".$start_date."',  '".$end_date."', ".$i.") ");
						$rows=mysqli_num_rows($result2);
						$saact=0;
						
						while($row1=mysqli_fetch_array($result2))
						{
							$contest_bh=$row1['act'];
							$sagdate=$row1['dt'];
							
						}
						
						$result1->close();
						$con1->next_result();
				
				
				
			echo "<br>".$i;
			
			echo $activation;
			if($activation>=139)
			{
				$activationcount=1;
				//$sql="update hotshotsnewdb_voda_0617.cron_report set cron_activation=".$activationcount." where date='".$date1."'";
				$cur_date=date('Y-m-d H-i:s');
				$sql="update gamebardb_vodafone_qatar_report.cron_report set ran=".$activationcount.", date='".$cur_date."' where cron_name='cron_activation'";
				$result = mysqli_query($con2,$sql) ;
			}
			
			
			 echo "<br><br>".   $sql55="INSERT INTO gamebardb_vodafone_qatar_report.activation_report
					(`date`, `hour`, `gamebar_france`,`gamebar_southafrica`,`gamebar_myanmar`,`gamebar_paydashgr`,`Glambar_southafrica`,`Glambar_paydashgr`,`gamebar_kuwait`,`gamebar_bahrain`,`gamebar_indoneisa`,`gamebar_oman`,`gamebar_pk`,`gamebar_qatar`,`gamebar_uae`,`glambar_pl`,`glambar_thailand`,`gamebar_thailand`,`gamebar_ksa`,`gamebar_norway`,`gamebar_czech`,`gamebar_egmon`,`glambar_czech`,`gamebar_slovenia`,`gamebar_ro`,`gamebar_finland`,`glambar_slovenia`,`gamebar_pl`,`glambar_pldmc`,`gamebar_turkey`,`gamebar_switzerland`,`gamebar_iraq`,`gamebar_Mozambique`,`gamebar_kenya`,`gamebar_jordan`,`gamebar_bangladesh`,`gamebar_ghana`,`gamebar_Nigeria`,`gamebar_gabon`,`gamebar_Palestine`,`11Players_nigeria`,`11Players_bd`,`11Players_kenya`,`contest_qatar`,`gamebar_ethiopia`,`11players_ethiopia`,`11players_ghana`,`11Players_KSA`,`contest_bh`,`gamebar_lk`) values('".$date1."','".$i."','".$gamebar_france."','".$sagact."','".$gamebar_myanmar."','".$gamebar_paydashgr."','".$glambarsouthafrica."','".$glambar_paydashgr."','".$gamebar_kuwait."','".$gamebar_bahrain."','".$gamebar_indonesia."','".$gamebar_oman."','".$gamebar_pk."','".$gamebar_qatar."','".$gamebar_uae."','".$glambar_pl."','".$glambar_thailand."','".$gamebar_thailand."','".$gamebar_ksa."','".$gamebar_norway."','".$gamebar_cz."','".$egmon."','".$glambar_czech."','".$gamebar_slovenia."','".$gamebar_ro."','".$gamebar_finland."','".$glambar_slovenia."','".$gamebar_pl."','".$glambar_pldmc."','".$gamebar_turkey."','".$gamebar_switzerland."','".$gamebar_iraq."','".$gamebar_Mozambique."','".$gamebar_kenya."','".$gamebar_jordan."','".$gamebar_bangladesh."','".$gamebar_ghana."','".$gamebar_Nigeria."','".$gamebar_gabon."','".$gamebar_Palestine."','".$players_ng."','".$players_bd."','".$Players_kenya."','".$contest_qatar."','".$gamebar_et."','".$players_et."','".$players_ghana."','".$players_ksa."','".$contest_bh."','".$gamebar_lk."')  ";
					
				
					 $result33=mysqli_query($con1,$sql55) or die($con1->error);
			
			
}																		

?>