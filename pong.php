#!/usr/bin/php
<?php
    //Tron Pong
	while(1)
		{
			$line = rtrim(fgets(STDIN, 1024));
			$param = explode(" ", $input, 5);
				//PLAYER TRACKING
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
				 }
				 if(preg_match("/^ROUND_COMMENCING/", $input))
				 {
					unset($playersalive);
				 }
				 //End player tracking
				 
				 //Variable Control
					$countPlayers = count($players);
					if ($countPlayers <= 2) {$sizeFactor = -3; $ballsize = 3;}
					elseif ($countPlayers <= 4 ) {$sizeFactor = -2; $ballsize = 5;}
					elseif ($countPlayers <= 6 ) {$sizeFactor = -1; $ballsize = 6;}
					elseif ($countPlayers <= 8 ) {$sizeFactor = 0; $ballsize = 8;}
					elseif ($countPlayers <= 10 ) {$sizeFactor = 0; $ballsize = 10;}
				//End Variable Control
				
				//Size Control
				if(preg_match("/^ROUND_COMMENCING/", $input))
				 {
					print("SIZE_FACTOR {$sizefactor} \n");
					$staticSizeFactor = $sizefactor;
					$staticBallSize = $BallSize;
				 }
				//End Size Control
				
				//Ball Spawning Control
				if ($saticSizeFactor == -3) {print("SPAWN_ZONE ball x y {$staticBallSize} 0")};
				elseif ($saticSizeFactor == -2) {print("SPAWN_ZONE ball x y {$staticBallSize} 0");}
				elseif ($saticSizeFactor == -1) {print("SPAWN_ZONE ball x y {$staticBallSize} 0");}
				elseif ($saticSizeFactor == 0) {print("SPAWN_ZONE ball x y {$staticBallSize} 0");}
				//End Ball Spawning Control
				
		}
	?>
				
				
	  