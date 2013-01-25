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
 
 
 while (1)
  {
   $input = rtrim(fgets(STDIN, 1024));
   $param = explode(" ", $input); 
   //Random Generators
   $randX = rand(0, 500);
   $randY = rand(0, 500);
   $randXDir = rand(-5, 5);
   $randYDir = rand(-5, 5);
   
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
      //We also need to fix this up for the array teams. Damn renamers makin things complicated: TODO  
     }
    if(preg_match("/^ROUND_COMMENCING/", $input))
     {
      unset($playersAlive);
     }
    //END PLAYER TRACKING
    
    //Team Tracking TODO: Make dynamic
    if(preg_match("/^TEAM_PLAYER_ADDED/", $input))
     {
      $teamName = $param[1];
      $playerName = $param[2];
      //Depending on which team he's on add him to an array
      if($teamName == "Shenaners")
       {
        $playerName = $teamShenaners[];
       }
      elseif($teamName = "Booshers")
       {
        $playerName = $teamBooshers[];
       }
     }
    if(preg_match("/^TEAM_PLAYER_REMOVED/", $input))
     {
      $teamName = $param[1];
      $playerName = $param[2];
      //Depending on which team he's on add him to an array
      if($teamName == "Shenaners")
       {
        unset($teamShenaners[$playerName]);
       }
      elseif($teamName = "Booshers")
       {
        unset($teamBooshers[$playerName]);
       }
     }
     
     //Lets make sure that destroyed teams are always unset for precautions
     if(preg_match("/^TEAM_DESTROYED/", $input))
     {
       $teamName = $param[1];
       if($teamName == "Shenaners")
       {
        unset($teamShenaners);
       }
      elseif($teamName = "Booshers")
       {
        unset($teamBooshers);
       }
      }
      
     //Spawn Zone On Player Death
     if (preg_match("/^DEATH_FRAG|DEATH_SUICIDE|PLAYER_KILLED|DEATH_SHOT_FRAG|DEATH_DEATHZONE|DEATH_SHOT_SUICIDE|DEATH_TEAMKILL|DEATH_SHOT_TEAMKILL|DEATH_ZOMBIEZONE|DEATH_DEATHSHOT|DEATH_SELF_DESTRUCT/", $input))
     {
       $playerDied = $param[1];
       if(in_array($playerDied, $teamShenaners)
        {
         if (!$movingRespawnZones) { print("spawn_zone n $playerDied target $randX $randY 10 0 0 0 true 0 0 1"); }
         elseif ($movingRespawnZones) { print("spawn_zone n $playerDied target $randX $randY 10 0 $randXDir $randYDir true 0 0 1"); }
        }
       elseif(in_array($playerDied, $teamBooshers)
        {
         if (!$movingRespawnZones) { print("spawn_zone n $playerDied target $randX $randY 10 0 0 0 true 1 0 0"); }
         elseif ($movingRespawnZones) { print("spawn_zone n $playerDied target $randX $randY 10 0 $randXDir $randYDir true 1 0 0"); }
        }
      }
     
     //Check what player entered the zone. The variable AllowEnemnyRespawn governs whether an enemy can also rev a player.
     //With higher speeds on the Xdir and Ydir ou could even have somewhat of a dodging zone game for the other team members
     //as they try to elimate the other team they dont want to revive any.
     if (preg_match("/^TARGETZONE_PLAYER_ENTER/", $input))
      {
       
      }
    
    
