#!/usr/bin/php
<?php
//Jumbo Sumobar script: by Moofie
$players = array();
$zonesizes = array(
    30,
    45,
    60,
    75,
    90
);
while (!feof(STDIN))
  {
$numplayers = count($players);
    $input = rtrim(fgets(STDIN));
    $param = explode(" ", $input);
    
    if ($param[0] == "CYCLE_CREATED")
      {
        array_push($players, $param[1]);
      }
	if ($param[0] == "NEW_ROUND")
	  {
		$players = array();
	  }
    if ($param[0] == "GAME_TIME" && $param[1] == "0")
      {
        if ($numplayers <= 3)
          {
            print("SPAWN_ZONE sumo 150 150 {$zonesizes[0]} -.4 0 0\n");
          }
        elseif ($numplayers >= 4 && $numplayers <= 6)
          {
            print("SPAWN_ZONE sumo 150 150 {$zonesizes[1]} -.4 0 0\n");
          }
        elseif ($numplayers >= 7 && $numplayers <= 9)
          {
            print("SPAWN_ZONE sumo 150 150 {$zonesizes[2]} -.4 0 0\n");
          }
        elseif ($numplayers >= 10 && $numplayers <= 12)
          {
            print("SPAWN_ZONE sumo 150 150 {$zonesizes[3]} -.4 0 0\n");
          }
        elseif ($numplayers >= 13 && $numplayers <= 15)
          {
            print("SPAWN_ZONE sumo 150 150 {$zonesizes[4]} -.4 0 0\n");
          }
      }
  }
?>
