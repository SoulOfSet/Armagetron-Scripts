#!/usr/bin/php
 <?php
 //Script by Moofie
 //Some Functions
 function GetRandomFloat($min, $max)
        {
            $range = $max-$min;
            $num = $min + $range * mt_rand(0, 32767)/32767;

            $num = round($num, 1);

            return ((float) $num);
        }
 while(1)
 {
 
  $input = rtrim(fgets(STDIN, 1024));
	$param = explode(" ", $input); 
	$xmin = 0;
	$xmax = 500;
	$ymin = 0;
	$ymax = 500;
	$randxcoord = rand($xmin, $xmax);
	$randycoord = rand($ymin, $ymax);
	//For Rape
	$numRapeZones = 5;
	$rapeTime = 0;
	if(preg_match("/^INVALID_COMMAND/", $input))
	{
		if ($param[1] == "/telly")
		{
			if(empty($param[5]))
			{
			$param[5] = $randxcoord;
			}
			if(empty($param[6]))
			{
			$param[6] = $randycoord;
			}
		print("console_message {$param[2]} teleported!\n");
		print("teleport_player {$param[2]} {$param[5]} {$param[6]} 1 1\n");
		}
		elseif ($param[1] == "/respawn")
		{
			if(empty($param[5]))
			{	
			$param[5] = $randxcoord;
			}
			if(empty($param[6]))
			{
			$param[6] = $randycoord;
			}
		print("console_message {$param[2]} respawned!\n");
		print("respawn_player {$param[2]} 1 {$param[5]} {$param[6]} 1 0\n");
		}	
		elseif ($param[1] == "/fuckthesebitches")
		{
			print("center_message EVERYONE DIE!!!\n");
			print("spawn_zone death 250 250 1 150 0 0 true 15 15 3 1000\n");
		}
		elseif ($param[1] == "/rape")
		{
			print("center_message ITS RAPING TIME\n");
			$rapeTime = 1;
			for($i = 0; $i < $numRapeZones; $i++)
			{
				$randXDir = rand(-100, -50);
				$randYDir = rand(-100, 100);
				print("spawn_zone n rapeDeath death 250 250 10 0 $randXDir $randYDir 0 true 15 0 13 10\n");
			}
		}
		
 	}
 	if(preg_match("/^GAME_TIME/", $input) && $rapeTime == 1)
 	{
 		$zoneRed   = GetRandomFloat(0, 1);
 		$zoneGreen = GetRandomFloat(0, 1);
 		$zoneBlue  = GetRandomFloat(0, 1);
 		print("set_zone_color rapeDeath $colorRed $colorGreen $colorBlue\n");
 	}
 	if(preg_match("/^NEW_ROUND/", $input) && $rapeTime == 1)
 	{
 		$rapeTime = 0;
 	}
 }
 ?>
