#!/usr/bin/php
 <?php
 //Script by SoulOfSet
 
 //Basically a team based server in which you strive to kill the other team completely.
 //When you die a zone spawns in which your teammates can revive you on touch.
 
 while (1)
  {
   $input = rtrim(fgets(STDIN, 1024));
   $param = explode(" ", $input); 
   
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
      $playersAlive[] = $namealive;
     }
    if (preg_match("/^DEATH_FRAG|DEATH_SUICIDE|PLAYER_KILLED|DEATH_SHOT_FRAG|DEATH_DEATHZONE|DEATH_SHOT_SUICIDE|DEATH_TEAMKILL|DEATH_SHOT_TEAMKILL|DEATH_ZOMBIEZONE|DEATH_DEATHSHOT|DEATH_SELF_DESTRUCT/", $input))
     {
      $remove = array_search($param[1], $playersalive);
      unset($playersAlive[$remove]);
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
      unset($playersAlive);
      $sentryactive = 0;
     }
    //End Player Tracking
