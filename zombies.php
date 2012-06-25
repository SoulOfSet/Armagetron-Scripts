#!/usr/bin/php
<?php 
  $round = 1;
  $points = 0;
  $numzombies = 1;
  $handle = fopen("/home/mark/.armagetronad-styct-dedicated/servers/callofduty/var/scorelog.txt", "r");
      while(1)
		{
		  $input = rtrim(fgets(STDIN, 1024)); 
		  $line = rtrim(fgets($handle, 1024)); 
		  $param = explode(" ", $input);
		  $paramScoreLog = explode(" ", $line); 
		  $numplayersalive = count($players);
		  $numplayersalive2 = count($playersalive);
		  if ($numplayersalive == 0) {$numplayersalive = $numplayersalive + 1;}
			if(preg_match("/^INVALID_COMMAND/", $input))
					{
						if($param[4] <= 1 && $param[1] == "/res")
						{
							print("respawn_player {$param[5]} 1 {$randxcoord} {$randycoord} 1 0 \n");
						}
						elseif($param[4] <= 1 && $param[1] == "/slapall")
						{
							foreach ($players as $value)
								{
									print("slap {$value} {$param[5]}\n");
								}
						}
						elseif($param[4] <= 1 && $param[1] == "/killall")
						{
							foreach ($playersalive as $value)
								{
									print("kill {$value} \n");
								}
						}
						elseif($param[4] <= 1 && $param[1] == "/playerson")
						{
							foreach ($players as $value)
								{
									print("console_message {$value}\n");
								}
						}
						elseif($param[4] <= 1 && $param[1] == "/playersalive")
						{
							foreach ($playersalive as $value)
								{
									print("console_message {$value}\n");
								}
						}
						elseif($param[4] > 1)
						{
							print("player_message {$param[2]} \"You need to be admin to do custom commands\"\n");
						}
						else
						{
							print("player_message {$param[2]} \"That Command Does Not Exist\"\n");
						}
					}
			 if(preg_match("/^PLAYER_ENTERED/", $input))
			   {
				  $name = $param[1];
				  $players[] = $name; 
			   }
			 if(preg_match("/^PLAYER_LEFT/", $input))
			   {
				  $remove = array_search($param[1], $players); 
				  unset($players[$remove]); 
			   }
			 if(preg_match("/^CYCLE_CREATED/", $input)) 
			   {
				  $namealive = $param[1]; 
				  if (!in_array($param[1], $players)) 
					  {
						  $players[] = $namealive; 
					  }	
				  $playersalive[] = $namealive; 
			   }
			 if (preg_match("/^DEATH_FRAG|DEATH_SUICIDE|PLAYER_KILLED|DEATH_SHOT_FRAG|DEATH_DEATHZONE|DEATH_SHOT_SUICIDE|DEATH_TEAMKILL|DEATH_SHOT_TEAMKILL|DEATH_ZOMBIEZONE|DEATH_DEATHSHOT|DEATH_SELF_DESTRUCT/", $input)) //if he died.....
			   {
				  $remove = array_search($param[1], $playersalive);
				  unset($playersalive[$remove]);
			   }
			   if(preg_match("/^PLAYER_RENAMED/", $input))
			   {
				  $nameold = array_search($param[1], $players);
				  unset($players[$nameold]); 
				  $namenew = $param[2]; 
				  $players[] = $namenew; 
			   }
			   if(preg_match("/^ROUND_COMMENCING/", $input)) 
			   {
				  unset($playersalive); 
			   }
			 //Control 
			 if (preg_match("/^NEW_ROUND/", $input))
				{
					$time = 10;
					$round = $round + 1;
				}
			//Spawning Area
			if (preg_match("/^GAME_TIME/", $input) && $param[1] == "1")
				{
					$calczombies = $numplayersalive * $round * 4 / 2; 
					$divtheplayers = $calczombies / $numplayersalive; 
					$numzombies = round($divtheplayers);
					print("kill Lord \n");
				}
				elseif ($param[1] == "10")                          
				  {	
					  print("console_message {$numzombies} \n");
					  $istracking = true;
					  $numzombiestrack = $numzombies;
					  for ($i = 0; $i <= $numzombiestrack; $i++)
						{
							$time = 2;
							foreach($playersalive as $value)
							  {
								$randint2 = rand(1, 3); 
								$player = array_rand($playersalive);
								print("DELAY_COMMAND {$time} spawn_zone zombieOwner {$value} Lord 250 250 7 0 \n");
								$time = $time + $randint2;
								$numzombiestrack = $numzombiestrack - 1;
							  }
						 }
				  }
			if (strpos($line, "shenanaboosh'd Lord"))
				{
					$points = $points + 50;
					print("console_message hi \n console_message {$points} \n");
					$numzombies = $numzombies - 1;
					
				}	
			if ($numzombies == 0 && $numplayersalive > 0 && ($istracking))
				{
					print("center_message Well Done. You Have Cleared Round {$round} \n");
					sleep(2);
					foreach ($playersalive as $value)
								{
									print("kill {$value} \n");
								}
					$istracking = false;
				}
			if ($numplayersalive == 0 && $numzombies > 0)
				{
					print("center_message You have survived to round {$round} \n");
					sleep(2);
					foreach ($playersalive as $value)
								{
									print("kill {$value} \n");
								}
					$round = 0;
				}

					
		}
?>