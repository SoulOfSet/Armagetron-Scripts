#!/usr/bin/php
    <?php
		$ballInPlay = false;
		$nextBallSpawnTime = rand(10, 20);
		//Put Your Random Functions Here :D
		//*********************************************************
		
		//Spawns Lots O' Balls 
		function spawnBalls($playerName)
			{
				$numBallsLimited = rand(10, 20) //Increase the second number for the chance of spawning more!
				for($i = 0; $i < $numBallsLimited; $i++)
					{
						print("console_message $playerName spawned balls everywhere! \n");
						$xRandBall = rand(10, 490);
						$yRandBall = rand(10, 490);
						$randColorBallR = ;
						$randColorBallG = ;
						$randColorBallB = ;
						print("spawn_zone n randBallMulti ball $xRandball $yRandBall 10 0 $randColorBallR $randColorBallG $randColorBallB \n");
						$randEffectLength = rand(10, 20); //Min and max of how long it will last
						print("delay_command $randEffectLength collapse_zone randBallMulti \n");
					}
			}
			
		//END FUNCTIONS
		//**********************************************************
			while(1)
				{
					$input = rtrim(fgets(STDIN, 1024)); 
					$param = explode(" ", $input);
					//Random Target Coloring
					$randColorTargetR = ;//Dont
					$randColorTargetG = ;//touch
					$randColorTargetB = ;//these
					//Random Coordinate Control
					$xRandTarget = rand(10, 490); //According to the size of your grid you might want to 
					$yRandTarget = rand(10, 490);//edit these. It's assuming you're using size_factor 0
					$xDirRandTarget = rand(-20, 20); //Increase the range of numbers in the xDir and yDir
					$yDirRantTarget = rand(-20, 20);//to increase the speed of the random ball.
					//Random Size
					$randBallSize = rand(5, 10); //Min and max of ball size
					//Random Ball Of Fun Array Of Things To Do :D
					$randBallEffects = array("spawnBalls"); //This will be the middle-man linking the functions to the random output
															//I suggest strings added here are the same as the function names to avoid confusion
					//TODO Find out how to do that more efficiently :3 ^
					
					
					//Randomly generated integer. Can have multiple uses
					$randInt = rand(10, 30);
					
					//Track The Time
					if (preg_match("/^GAME_TIME/", $input)
					{
						$gameTimeCurr = $param[1];
						if ($ballInPlay == true)
						{
							print("set_zone_color randBall $randColorTargetR $randColorTargetG $randColorTargetB \n");
						}
						if (is_float($gameTimeCurr))
						{
							$gameTimeCurr = round($gameTimeCurr);
						}
					}
					//Do we spawn the ball yet?
					if ($gameTimeCurr == $nextBallSpawnTime)
					{
						if($ballInPlay == false)
						{
							print("spawn_zone n randBall target $xRandTarget $yRandTarget $randBallSize 0 \n");
							$ballInPlay = true;
						}
						else
						{
							$nextBallSpawnTime = $nextBallSpawnTime + $randInt;
						}
							
					}
					//If the player enters the ball....
					 if (preg_match("/^TARGETZONE_PLAYER_ENTER/", $input) && $param[2] == "randBall")
					 {
						//Set up the next ball
						$nextBallSpawnTime = $nextBallSpawnTime + $randInt;
						$ballInPlay = false;
						//Name params to avoid confusion
						$zoneName = $param[2];
						$playerName = $param[5];
						$targetXLocOnHit = $param[6];
						$targetYLocOnHit = $param[7];
						//More organized
						$gameTime = $gameTimeCurr;
						//Here we call on a random link from our array
						$randEffect = array_rand($randBallEffects, 1);
						//Ball needs to go away :3
						print("collapse_zone randBall \n");
						
						/*TODO: Get rid of this method and replace it with something more efficient
						Using this link method is somewhat ridiculous*/
						
						/*Now we use the called link from the array to decide what function or command to execute
						This should be easy if you named your functions the same as the link*/
						if ($randEffect == "spawnBalls") { spawnBalls($playerName); }
						
						
						
						
					}
				}
	?>
						
					 
					 
					 
					 
					 