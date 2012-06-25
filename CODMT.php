#!/usr/bin/php
 <?php
    //Script by SoulOfSet
	//BETA :D
	$int=10;
	$scoree="";
	$scoretype="";
	$scriptname="lives.php";
	$sentryactive=0;
	$timesentrydie=0;
	$sentryowner;
	$sentrytarget;
		while (1)
			{
				 $input = rtrim(fgets(STDIN, 1024));
				 $param = explode(" ", $input); 
				 $maxx=500; 
				 $maxy=500;
				 $minx=0;
				 $miny=0;   
				 $randint=rand(25, 30); 
				 $numplayers=0;
				 $randxcoord=rand($minx, $maxx);
				 $randycoord=rand($miny, $maxy);
				 $artillery="console_message Atrillery Strike Spawned! \n spawn_zone n artillery target {$randxcoord} {$randycoord} 10 0 0 0 true 15 15 15 \n";
				 $juggernaut="console_message Juggernaut Spawned! \n spawn_zone n jug target {$randxcoord} {$randycoord} 10 0 \n"; 
				 $nuke="console_message Nuke Spawned! \n spawn_zone n nuke target {$randxcoord} {$randycoord} 10 0 0 0 true 15 0 10 \n"; 
				 $dogs="console_message Dogs Spawned! \n spawn_zone n dogs target {$randxcoord} {$randycoord} 10 0 0 0 13 7 5 true\n";
				 $attheli="console_message Attack Heli Spawned! \n spawn_zone n attheli target {$randxcoord} {$randycoord} 10 0 0 0 true 0 0 0\n";
				 $sentry="console_message Sentry Gun Spawned! \n spawn_zone n sentry target {$randxcoord} {$randycoord} 10 0 0 0 true 0 10 15\n";
				 $rollingthun="console_message Rolling Thunder Spawned! \n spawn_zone n rollingthun target {$randxcoord} {$randycoord} 10 0 0 0 true 0 0 15\n";
				 $napalm="console_message Napalm Spawned! \n spawn_zone n napalm target {$randxcoord} {$randycoord} 10 0 0 0 true 15 0 0\n";
				 $placebo="FUCK \n"; //dunno
				 $killstreaks=array($juggernaut, $artillery, $dogs, $attheli, $sentry, $rollingthun, $nuke, $placebo); //the array containing perks/killstreaks w/e
				 $numbers=array(1, 2, 3, 4, 5, 6, 7, 8);
				 //CUSTOM COMMANDS
				if(preg_match("/^INVALID_COMMAND/", $input))
					{
						if($param[4] <= 1 && $param[1] == "/artillery")
						{
							print("{$artillery}");
						}
						elseif($param[4] <= 1 && $param[1] == "/juggernaut")
						{
							print("{$juggernaut}");
						}
						elseif($param[4] <= 1 && $param[1] == "/nuke")
						{
							print("{$nuke}");
						}
						elseif($param[4] <= 1 && $param[1] == "/dogs")
						{
							print("{$dogs}");
						}
						elseif($param[4] <= 1 && $param[1] == "/attheli")
						{
							print("{$attheli}");
						}
						elseif($param[4] <= 1 && $param[1] == "/sentry")
						{
							print("{$sentry}");
						}
						elseif($param[4] <= 1 && $param[1] == "/rollingthun")
						{
							print("{$rollingthun}");
						}
						elseif($param[4] <= 1 && $param[1] == "/napalm")
						{
							print("{$napalm}");
						}
						elseif($param[4] <= 1 && $param[1] == "/respawn")
						{
							print("respawn_player {$param[2]} 1 {$randxcoord} {$randycoord} 1 0 \n");
						}
						elseif($param[4] <= 1 && $param[1] == "/killscript")
						{
							print("kill_script {$scriptname}\n");
							print("player_message {$param[2]} \"Script Killed\" \n");
						}
						elseif($param[4] <= 1 && $param[1] == "/int")
						{
							print("console_message {$int}\n");
						}
						elseif($param[4] <= 1 && $param[1] == "/intadd")
						{
							$int = $int + $param[5];
						}
						elseif($param[4] <= 1 && $param[1] == "/res")
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
						elseif($param[4] <= 1 && $param[1] == "/debug")
						{
							print("cycle_speed 50\ncycle_rubber 10000\ncycle_walls_length 1\nwalls_length 1\n");
						}
						elseif($param[4] <= 1 && $param[1] == "/enddebug")
						{
							print("include settings_custom.cfg\n");
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
				//SCORING
				 if (preg_match("/^DEATH_DEATHZONE/", $input))
					{
						if ($scoree !== $param[1])
							{
								if ($scoretype == "nuke")
									{
										print("console_message {$scoree} Received 1 Point For Blasting {$param[1]} With A Nuke!\n");
										print("add_score_player {$scoree} 1 \n");
									}
								elseif ($scoretype == "artillery")
									{
										print("console_message {$scoree} Received 1 Point For Blasting {$param[1]} With An Artillery Shell!\n");
										print("add_score_player {$scoree} 1 \n");
									}
								elseif ($scoretype == "attheli")
									{
										print("console_message {$scoree} Received 1 Point For Shooting Down {$param[1]} With Their Attack Helicopter!\n");
										print("add_score_player {$scoree} 1 \n");
									}
								elseif ($scoretype == "rollingthun")
									{
										print("console_message {$scoree} Receive 1 Point For Blasting {$param[1]} With Their Rolling Thunder!\n");
										print("add_score_player {$scoree} 1 \n");
									}
							}
						elseif ($scoree == $param[1])
							{
								if ($scoretype == "nuke")
									{
										print("console_message {$scoree} Was Docked 1 Point Hitting Their Own Nuke!\n");
										print("add_score_player {$scoree} -1 \n");
									}
								elseif ($scoretype == "artillery")
									{
										print("console_message {$scoree} Was Docked 1 Point For Blasting Themself With An Artillery Shell!\n");
										print("add_score_player {$scoree} -1 \n");
									}
								elseif ($scoretype == "attheli")
									{
										print("console_message {$scoree} Was Docked 1 Point For Getting Shot By Their Own Attack Helicopter!\n");
										print("add_score_player {$scoree} -1 \n");
									}
								elseif ($scoretype == "rollingthunder")
									{
										print("console_message {$scoree} Was Docked 1 Point For Getting Blasted By Their Own Rolling Thunder!\n");
										print("add_score_player {$scoree} -1 \n");
									}	
							}
					}
				//PLAYER TRACKING
				 if(preg_match("/^PLAYER_ENTERED/", $input))
				 {
					$name = $param[1];
					$players[] = $name;
					$numplayers=$numplayers + 1;
				 }
				 if(preg_match("/^PLAYER_LEFT/", $input))
				 {
					$remove = array_search($param[1], $players);
					unset($players[$remove]);
					$numplayers=$numplayers - 1;
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
				 if (preg_match("/^DEATH_FRAG|DEATH_SUICIDE|PLAYER_KILLED|DEATH_SHOT_FRAG|DEATH_DEATHZONE|DEATH_SHOT_SUICIDE|DEATH_TEAMKILL|DEATH_SHOT_TEAMKILL|DEATH_ZOMBIEZONE|DEATH_DEATHSHOT|DEATH_SELF_DESTRUCT/", $input))
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
					$numplayers=$numplayers + 1;
				 }
				 if(preg_match("/^ROUND_COMMENCING/", $input))
				 {
					unset($playersalive);
					$sentryactive = 0;
				 }
				 //RANDOMLY SPAWNS THE KILLSTREAK PERK THINGS
				 if (preg_match("/^GAME_TIME/", $input))
				 {
					$gametime = $param[1];
					if ($param[1] == $int)
						{
						  $rand = array_rand($killstreaks, 2);
						  print($killstreaks[$rand[0]] . "\n");
						  shuffle($killstreaks);
						  $int = $int + $randint;
						}
				 }
				 //RESETS THE INT TIME
				 if (preg_match("/^NEW_ROUND/", $input))
				 {
				  $int = 10;
				 }
				//TRACKS PLAYERS ENTERING THE PERK ZONES AND DOES STOOF
				 if (preg_match("/^TARGETZONE_PLAYER_ENTER/", $input))
					{ 
					  if ($param[2] == "jug") //jug
					   {
						print("console_message {$param[5]} Got The Juggernaut!\n");
						print("set_zone_expansion jug -100\n");
						print("spawn_zone zombieOwner {$param[5]} {$param[5]} {$param[6]} {$param[7]} 10 0 0 0 false\n");
					   }
					  elseif ($param[2] == "nuke") //nuke
					   {
						print("console_message {$param[5]} Got The Nuke!\n");
						$randxcoordd=rand($minx, $maxx);
						$randycoordd=rand($miny, $maxy);
						print("set_zone_expansion nuke -100\n");
						print("spawn_zone n nukedeath death {$randxcoordd} {$randycoordd} 10 20 0 0 false 15 0 0 \n ");
						sleep(10);
						print("collapse_zone nukedeath\n");
						$scoree="{$param[5]}";
						$scoretype="nuke";
					   }
					  elseif ($param[2] == "artillery") //artillery
						{
							print("set_zone_expansion artillery -100\n");
							print("console_message {$param[5]} Got The Artillery Strike!\n");
							for ($i = 1; $i <= 40; $i++)
								{
									$randxcoorda=rand($minx, $maxx);
									$randycoorda=rand($miny, $maxy);
									print("spawn_zone n artdeath death {$randxcoorda} {$randycoorda} 10 -1 0 0 false 15 0 0\n");
								}
							$scoree="{$param[5]}";
							$scoretype="artillery";
						}
					  elseif ($param[2] == "dogs") //dogs
						{
						print("set_zone_expansion dogs -100\n");
						print("console_message {$param[5]} Got The Dogs! \n");
						$remove = array_search($param[5], $playersalive);
						unset($playersalive[$remove]);
						 foreach ($playersalive as $value)
						 {
						  print("spawn_zone zombieOwner {$value} {$param[5]} 250 250 6 -0.1 0 0 false 5 3 1\n");
						 }
						$playersalive[] = $param[5];
						}
						elseif ($param[2] == "attheli") //attack helicopter
						{
							print("set_zone_expansion attheli -100\n");
							print("console_message {$param[5]} Got The Attack Helicopter! \n");
								for ($f = 1; $f <= 10; $f++)
									{
										$randxcoordb=rand($minx, $maxx);
										$randycoordb=rand($miny, $maxy);
										sleep(1);
										for ($g = 1; $g <= 25; $g++)
											{
												print("spawn_zone n atthelideathx death {$randxcoordb} {$randycoordb} 5 -1 \n");
												$randxcoordb = $randxcoordb + 6;
												usleep(20000);
											}
										$randxcoordc=rand($minx, $maxx);
										$randycoordc=rand($miny, $maxy);
										for ($h = 1; $h <= 25; $h++)
											{
												print("spawn_zone n atthelideathy death {$randxcoordc} {$randycoordc} 5 -1 \n");
												$randycoordc = $randycoordc + 6;
												usleep(20000);
											}
											
									}
							$scoree="{$param[5]}";
							$scoretype="attheli";
						}
						elseif ($param[2] == "sentry") //sentry
						{
						print("console_message {$param[5]} Activated The Sentry!\n");
						print("set_zone_expansion sentry -100\n");
						print("spawn_zone n sentryzone rubber {$param[6]} {$param[7]} 10 0 0 0 0 false 0 10 15 \n ");
						$scoretype="sentry";
						$timesentrystart = $gametime;
						$timesentrydie = $gametime + 12;
						$centerxsentry = $param[6];
						$centerysentry = $param[7];
						$maxxsentry = $param[6] + 100;
						$minxsentry = $param[6] - 100;
						$maxysentry = $param[7] + 100;
						$minysentry = $param[7] - 100;
						$sentryactive = 1;
						$scoree = $param[5];
						$sentryowner = $param[5];
					   }
					   elseif ($param[2] == "sentryshot" && $sentryowner !== $param[5])  //sentry shots
					   {
						print("kill {$param[5]} sen {$sentryowner}\n");
						print("add_score_player {$sentryowner} -1 \n");
						print("console_message {$sentryowner} Received 1 Point For Blasting {$param[5]} With Their Sentry!\n");
						unset($sentrytarget);
					   }
					   elseif ($param[2] == "rollingthun")  //Rolling Thunder
					   {
							$scoretype="rollingthun";
							print("console_message {$param[5]} Activated Rolling Thunder!\n");
							print("set_zone_expansion rollingthun -100\n");
							$rollingthunderowner = $param[5];
							$scoree = $param[5];
							$randnumber = array_rand($numbers);
							if ($randnumber == 1)
								{
									$xroll = 1;
									$yroll = 10;
									for ($k = 1; $k <= 100; $k++)
										{
											$offset = rand(-10, 10);
											$randdeathsize = rand(5, 10);
											print("spawn_zone n rollingdeath death {$xroll} {$yroll} {$randdeathsize} -1 \n");
											$xroll = $xroll + 5;
											$yroll = $yroll + 5 + $offset;
											usleep(1000);
										}
								}
							elseif ($randnumber == 2)
								{
									$xroll = 250;
									$yroll = 10;
									for ($k = 1; $k <= 100; $k++)
										{
											$offset = rand(-10, 10);
											$randdeathsize = rand(5, 10);
											print("spawn_zone n rollingdeath death {$xroll} {$yroll} {$randdeathsize} -1 \n");
											$xroll = $xroll + $offset;
											$yroll = $yroll + 5;
											usleep(1000);
										}
								}
							elseif ($randnumber == 3)
								{
									$xroll = 500;
									$yroll = 10;
									for ($k = 1; $k <= 100; $k++)
										{
											$offset = rand(-10, 10);
											$randdeathsize = rand(5, 10);
											print("spawn_zone n rollingdeath death {$xroll} {$yroll} {$randdeathsize} -1 \n");
											$xroll = $xroll - 5;
											$yroll = $yroll + 5 + $offset;
											usleep(1000);
										}
								}
							elseif ($randnumber == 4)
								{
									$xroll = 500;
									$yroll = 250;
									for ($k = 1; $k <= 100; $k++)
										{
											$offset = rand(-10, 10);
											$randdeathsize = rand(5, 10);
											print("spawn_zone n rollingdeath death {$xroll} {$yroll} {$randdeathsize} -1 \n");
											$xroll = $xroll - 5;
											$yroll = $yroll + $offset;
											usleep(1000);
										}
								}
							elseif ($randnumber == 5)
								{
									$xroll = 500;
									$yroll = 500;
									for ($k = 1; $k <= 100; $k++)
										{
											$offset = rand(-10, 10);
											$randdeathsize = rand(5, 10);
											print("spawn_zone n rollingdeath death {$xroll} {$yroll} {$randdeathsize} -1 \n");
											$xroll = $xroll - 5;
											$yroll = $yroll - 5 - $offset;
											usleep(1000);
										}
								}
							elseif ($randnumber == 6)
								{
									$xroll = 250;
									$yroll = 500;
									for ($k = 1; $k <= 100; $k++)
										{
											$offset = rand(-10, 10);
											$randdeathsize = rand(5, 10);
											print("spawn_zone n rollingdeath death {$xroll} {$yroll} {$randdeathsize} -1 \n");
											$xroll = $xroll - $offset;
											$yroll = $yroll - 5;
											usleep(1000);
										}
								}
							elseif ($randnumber == 7)
								{
									$xroll = 0;
									$yroll = 500;
									for ($k = 1; $k <= 100; $k++)
										{
											$offset = rand(-10, 10);
											$randdeathsize = rand(5, 10);
											print("spawn_zone n rollingdeath death {$xroll} {$yroll} {$randdeathsize} -1 \n");
											$xroll = $xroll + 5;
											$yroll = $yroll - 5 - $offset;
											usleep(1000);
										}
								}
							elseif ($randnumber == 8)
								{
									$xroll = 0;
									$yroll = 250;
									for ($k = 1; $k <= 100; $k++)
										{
											$offset = rand(-10, 10);
											$randdeathsize = rand(5, 10);
											print("spawn_zone n rollingdeath death {$xroll} {$yroll} {$randdeathsize} -1 \n");
											$xroll = $xroll + 5;
											$yroll = $yroll - $offset;
											usleep(1000);
										}
								}
							}
							elseif ($param[2] == "napalm")  //NAPALM
								{
									$scoree = $param[5];
									$scoretype = "napalm";
									$napalmowner = $param[5];
									print("console_message {$param[5]} Got A Napalm Strike!\n");
									print("set_zone_expansion napalm -100\n");
									$napx = $randxcoord=rand($minx, $maxx);
									$napy = $randycoord=rand($miny, $maxy);
									$napyup1 = $napy + 15;
									$napydown1 = $napy - 15;
									$napxright1 = $napx + 15;
									$napxleft1 = $napx - 15;
									$napyup2 = $napy + 20;
									$napydown2 = $napy - 20;
									$napxright2 = $napx + 20;
									$napxleft2 = $napx - 20;
									$napyup3 = $napy + 30;
									$napydown3 = $napy - 30;
									$napxright3 = $napx + 30;
									$napxleft23 = $napx - 30;
										if ($napx == $param[6])
											{
												$napx = $napx + 15;
											}
										if ($napy == $param[7])
											{
												$napy = $napy + 15;
											}
									print("spawn_zone n napalmshot death {$napx} {$napy} 10 0\n");
									sleep(1);
									print("spawn_zone n napalmshot death {$napx} {$napyup1} 7 -0.5\n");
									print("spawn_zone n napalmshot death {$napx} {$napydown1} 7 -0.5\n");
									print("spawn_zone n napalmshot death {$napxright1} {$napy} 7 -0.5\n");
									print("spawn_zone n napalmshot death {$napxleft1} {$napy} 7 -0.5\n");
									sleep(1);
									print("spawn_zone n napalmshot death {$napxleft2} {$napyup2} 5 -0.5\n");
									print("spawn_zone n napalmshot death {$napxright2} {$napyup2} 5 -0.5\n");
									print("spawn_zone n napalmshot death {$napxright2} {$napydown2} 5 -0.5\n");
									print("spawn_zone n napalmshot death {$napxleft2} {$napydown2} 5 -0.5\n");
									sleep(1);
									print("spawn_zone n napalmshot death {$napx} {$napyup3} 3 -0.5\n");
									print("spawn_zone n napalmshot death {$napx} {$napydown3} 3 -0.5\n");
									print("spawn_zone n napalmshot death {$napxright3} {$napy} 3 -0.5\n");
									print("spawn_zone n napalmshot death {$napxleft3} {$napy} 3 -0.5\n");
									sleep(3);
									print("collapse_zone napalmshot\n");
								}
						}
				//SENTRY DEPENDS ON DIS SHIT >:C 
			if (preg_match("/^PLAYER_GRIDPOS/", $input) && $sentryactive == 1 && $sentryowner !== $param[1])
				{
					if ($param[2] > $minxsentry && $param[2] < $maxxsentry || $param[3] > $minysentry && $param[3] < $maxysentry)
						{
							if(empty($sentrytarget) && $param[1] !== $sentryowner)
								{
									$sentrytarget = $param[1];
								}
							if ($param[1] == $sentrytarget)
								{
									print("spawn_zone n sentryshot target L {$centerxsentry} {$centerysentry} {$param[2]} {$param[3]} {$param[2]} {$param[3]} Z 2.5 -1 -100 -100 true 0 10 15 \n");
								}
						}
					if ($param[2] < $minxsentry && $param[2] > $maxxsentry || $param[3] < $minysentry && $param[3] > $maxysentry)
						{
						 if ($param[1] == $sentrytarget)
							{
								unset($sentrytarget);
							}
						}
				}
					if (preg_match("/^GAME_TIME/", $input) && $param[1] == $timesentrydie)
					 {
					 print("set_zone_expansion sentryzone -100\n");
					 unset($sentrytarget);
					 $sentryactive = 0;
					 }
				//END SENTRY DEPENDENT SHIT
			}			
 ?>