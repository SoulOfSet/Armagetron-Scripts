#!/usr/bin/php
 <?php
 //Script by SoulOfSet
 
 //Basically a team based srcipt in which you strive to kill the other team completely.
 //When you die a zone spawns in which your teammates can revive you on touch.
 
 //As of now the script counts on the team names being Shenaners and Booshers. TODO: Make team tracking dynamic
 
 $teamShenaners = array();
 $teamBooshers  = array();
 //Do you want respawn zones to float around?
 $movingRespawnZones = 0;
 $allowEnemyRespawn = 0; //Whether or notthe enemy team is also allowed to respawn the player
 $zoneTimeOut = 0; //Whether the respawn zone should time out
  $zoneTimeOutLength = 0; //The time it takes for a respawn zone to time out. In seconds
 
 
 while (1)
  {
   $input = rtrim(fgets(STDIN, 1024));
   $param = explode(" ", $input); 
   //Random Generators
   $randX = rand(0, 500);
   $randY = rand(0, 500);
   $randXDir = rand(-5, 5);
   $randYDir = rand(-5, 5);
   
    if(preg_match("/^INVALID_COMMAND/", $input))
     {
      if($param[4] <= 1 && $param[1] == "/shenaners")
      {
       print("console_message" . var_dump($teamShenaners) ."\n");
      }
      elseif($param[4] <= 1 && $param[1] == "/booshers")
      {
       print("console_message" . var_dump($teamBooshers) ."\n");
      }
     }
   
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
      $remove = array_search($param[1], $playersAlive);
      unset($playersAlive[$remove]);
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
      unset($playersAlive);
      unset($teamShenaners);
      unset($teamBooshers);
     }
    //END PLAYER TRACKING
     
    if(preg_match("/^ONLINE_PLAYER/", $input))
     {
      $teamName = $param[6];
      $playerName = $param[1];
      //Depending on which team he's on add him to an array
      if($teamName == "shenaners")
       {
        $teamShenaners[] = $playerName;
       }
      elseif($teamName == "booshers")
       {
        $teamBooshers[] = $playerName;
       }
     }
     
     //Lets make sure that destroyed teams are always unset for precautions
     if(preg_match("/^TEAM_DESTROYED/", $input))
     {
       $teamName = $param[1];
       if($teamName == "shenaners")
       {
        unset($teamShenaners);
       }
      elseif($teamName == "booshers")
       {
        unset($teamBooshers);
       }
      }
      
     //Spawn Zone On Player Death
     if (preg_match("/^DEATH_FRAG|DEATH_SUICIDE|PLAYER_KILLED|DEATH_SHOT_FRAG|DEATH_DEATHZONE|DEATH_SHOT_SUICIDE|DEATH_TEAMKILL|DEATH_SHOT_TEAMKILL|DEATH_ZOMBIEZONE|DEATH_DEATHSHOT|DEATH_SELF_DESTRUCT/", $input))
     {
       $playerDied = $param[1];
       if(in_array($playerDied, $teamShenaners))
        {
         if (!$movingRespawnZones) { print("spawn_zone n $playerDied target $randX $randY 10 0 0 0 true 0 0 1\n"); }
         elseif ($movingRespawnZones) { print("spawn_zone n $playerDied target $randX $randY 10 0 $randXDir $randYDir true 0 0 1\n"); }
        }
       elseif(in_array($playerDied, $teamBooshers))
        {
         if (!$movingRespawnZones) { print("spawn_zone n $playerDied target $randX $randY 10 0 0 0 true 1 0 0\n"); }
         elseif ($movingRespawnZones) { print("spawn_zone n $playerDied target $randX $randY 10 0 $randXDir $randYDir true 1 0 0\n"); }
        }
       if($zoneTimeOut)
        {
         print("delay_command $zoneTimeOutLength collapse_zone $playerDied\n");
        }
      }
     
     //Check what player entered the zone.
     if (preg_match("/^TARGETZONE_PLAYER_ENTER/", $input))
     {
       print("collapse_zone $zoneName\n");
       $playerEntered = $param[5];
       $zoneName = $param[2];
       if($allowEnemyRespawn)
        {
         print("respawn_player $zoneName 0 0 $randX $randY\n");
        }
       elseif(!$allowEnemyRespawn)
        {
         if(in_array($playerEntered, $teamShenaners) && in_array($zoneName, $teamShenaners) || in_array($playerEntered, $teamBooshers) && in_array($zoneName, $teamBooshers))//They are on the same team
          {
           print("respawn_player $zoneName 0 0 $randX $randY\n");
          }
        }
       print("console_message $playerEntered respawned $zoneName!\n");
      }
  }
 ?>
    
    
