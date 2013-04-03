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
   
   $bPhylisDialoguePassed = FALSE;
   
   //Settings for this particular script
   $aSettings = array("cycle_speed 1", "sp_walls_length 1", "walls_length 1", "cycle_walls_length 1", "cycle_brake_deplete 0", "cycle_speed_decay_above 10", "cycle_delay 0.1", "cycle_rubber 1000");
   //We're using zones as NPC's here. Start from type unless they need names. (Ex. n Phylis death 10 0 etc)
   //Some may have paths to help make it more realistic
   $aNpcSpawns = array("n Phylis rubber 310 400 15 0 0 0 0 true 1 0 0 15", "n Sarah rubber 150 300 15 0 0 0 0 true 1 0 1 15", "n Vain rubber 300 200 15 0 0 0 0 true 1 0.3 0", "n Jack 327 100 7 0 0 0 0 true 0 1 0 7", "n Rolan rubber 200 100 15 0 0 0 0 true 0.4 0 1 15", "n Moofie 250 450 10 0 0 0 0 true 0.4 0.9 0.4 15");
   //Dialogue for the NPC's after the initial chat with phylis is cleared
   //A set for each so it doesn't seem half assed
   //Sarah
   $aSarahDialouge = array("DeathZone has gone too far with this", "I cant beleive this is happening", "He even took some of our members with him.", "Vain is taking this rather harshly. They were close. You should talk to him");
   //Vain
   $aVainDialouge = array("...", "Death....why?", "To think something like this..in our clan.", "You should go i'm not much for talking right now");
   //Jack
   $aJackDialouge = array("Look are some things you should know about Vain. He took several of our members and is skilled with death magic. One hit of of it will desroy you, watch yourself.", "Here I thought he was the mysterious type. Who would of that Mr. Secretive would do something like this. We don't even know his full name", "As his former clan members we are responsible for this");
   //Rolan
   $aRolanDialouge = array("Fuckin Death needs to get his shit together", "Who the fuck does he think he is", "Get him back man. Fuckin last thing we need is this on our rep", "Bullshit Death....bullshit");
   //The moofie dialouge
   $aMoofieDialouge = "Oh...ill just....sorry...bye..";
   
   
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
              foreach($aNpcSpawn as $value)
                {
                    echo "spawn_zone {$value}\n";
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
   
   
