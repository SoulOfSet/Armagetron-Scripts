#!/usr/bin/php
<?php
//Jumbo Sumobar script: by Moofie
$players = array();
$numplayers = count($players);
$zonesizes = array(30, 45, 60, 75, 90);
while (!feof(STDIN))
{
	$input = rtrim(fgets(STDIN));
    $param = explode(" ", $input);

		if ($param[0] == "PLAYER_ENTERED")
		{
			array_push($players, $param[3]);
		}
		if ($param[0] == "PLAYER_LEFT")
		{
			$remove = array_search($param[1], $players);
			unset($players[$remove]);
		}
		if ($param[0] == "PLAYER_RENAMED")
		{
			$oldname = array_search($param[1], $players);
			unset($players[$oldname]);
			array_push($players, $param[2]);
		}
		if ($param[0] == "GAME_TIME" && $param[1] == "0")
		{
			if ($numplayers <= 3 && )
			{
			print("SPAWN_ZONE sumo 150 150 {$zonesizes[1]} -.4 0 0\n");
			}
			elseif ($numplayers >= 4 && $numplayers <= 6)
			{
			print("SPAWN_ZONE sumo 150 150 {$zonesizes[2]} -.4 0 0\n");
			}
			elseif ($numplayers >= 7 && $numplayers <= 9)
			{
			print("SPAWN_ZONE sumo 150 150 {$zonesizes[3]} -.4 0 0\n");
			}
			elseif ($numplayers >= 10 && $numplayers <= 12)
			{
			print("SPAWN_ZONE sumo 150 150 {$zonesizes[4]} -.4 0 0\n");
			}
			elseif ($numplayers >= 13 && $numplayers <= 15)
			{
			print("SPAWN_ZONE sumo 150 150 {$zonesizes[5]} -.4 0 0\n");
			}
		}
}
?>
