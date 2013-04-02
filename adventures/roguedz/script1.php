#!/usr/bin/php
    <?php
   //Script by SoulOfSet
   //First script in the Rogue DZ Adventure. "The Incident At The Clan Meet"
   //The player is introduced to some clan mates who informs him one of the most powerful members
   //has gone rogue and you need to stop him. He was caught burning towns across the fields. 
   
   //Since scripts are called at the end of the previous rounds you need to make sure that the 
   //script isnt run until the round its needed for. :)
   $bScriptActive = FALSE;
   //Not the shorthand one but the full title. (Ex. The Prince To The Rescue instead of prince_rescue or w/e)
   $sAdventureTitle = "The Rogue DeathZone"
   
   $aConceredDialog = 
   
   //Settings for this particular script
   $aSettings = array("cycle_speed 1", "sp_walls_length 1", "walls_length 1", "cycle_walls_length 1", "cycle_brake_deplete 0", "cycle_speed_decay_above 10", "cycle_delay 0.1", "cycle_rubber 1000");
   //We're using zones as NPC's here. Start from type unless they need names. (Ex. n Phylis death 10 0 etc)
   $aNpcSpawns = array("n phylis ")
   
   while (!feof(STDIN))
    {
      $input = rtrim(fgets(STDIN, 1024));
      $param = explode(" ", $input);
      
      if ($param[0] == "GAME_TIME")
        {
            $sGameTime = "1";
            if($param[1] == "1")
            {
              $bScriptActive = TRUE;
              foreach($aSettings as $value)
                {
                  echo "$value\n";
                }
            }
        }
        
      if($bScriptActive)
        {
          //This script is just a chronological series of events so we can create and check variables along the way
          if($sGameTime == "2")
          {
            echo "fullscreen_message Hello tronner and welcome to $sAdventureTitle. This is your clan meeting quarters. On your way back from a quest you notice general unrest. You should go speak with clan master behind the bar, Phylis. He will fill you in on the details.\n";
          }
        }
   
   