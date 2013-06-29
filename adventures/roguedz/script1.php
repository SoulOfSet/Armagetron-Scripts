#!/usr/bin/php
    <?php
//Script by SoulOfSet
//First script in the Rogue DZ Adventure. "The Incident At The Clan Meet"
//The player is introduced to some clan mates who informs him one of the most powerful members
//has gone rogue and you need to stop him. He was caught burning towns across the fields. 

//Since scripts are called at the end of the previous rounds you need to make sure that the 
//script isnt run until the round its needed for. :)
$bScriptActive   = FALSE;
//Not the shorthand one but the full title. (Ex. The Prince To The Rescue instead of prince_rescue or w/e)
$sAdventureTitle = "The Rogue DeathZone";

$bPhylisDialoguePassed = FALSE;

//Moofie Activated
$bMoofie = true;

//Settings for this particular script
$aSettings       = array(
    "cycle_speed 0",
    "sp_walls_length 1",
    "walls_length 1",
    "cycle_walls_length 1",
    "cycle_brake_deplete 0",
    "cycle_speed_decay_above 10",
    "cycle_delay 0.1",
    "cycle_rubber 1000",
    "cycle_brake -200",
    "sp_size_factor -3",
    "sp_num_ai 0"
    
);
//We're using zones as NPC's here. Start from type unless they need names. (Ex. n Phylis death 10 0 etc)
//Some may have paths to help make it more realistic
$aNpcSpawns      = array(
    "n Phylis target 310 400 15 0 0 0 true 1 0.5 0 15",
    "n Sarah target 150 300 15 0 0 0 true 1 0 1 15",
    "n Vain target 300 200 15 0 0 0 true 1 0.3 0",
    "n Jack target 327 100 7 0 0 0 true 0 1 0 7",
    "n Rolan target 200 100 15 0 0 0 true 0.4 0 1 15",
    "n Moofie target 250 450 10 0 0 0 true 0.4 0.9 0.4 15"
);
//Dialogue for the NPC's after the initial chat with phylis is cleared
//A set for each so it doesn't seem half assed
//Sarah
$aSarahDialouge  = array(
    "DeathZone has gone too far with this",
    "I cant beleive this is happening",
    "He even took some of our members with him.",
    "Vain is taking this rather harshly. They were close. You should talk to him"
);
//Vain
$aVainDialouge   = array(
    "...",
    "Death....why?",
    "To think something like this..in our clan.",
    "You should go i'm not much for talking right now"
);
//Jack
$aJackDialouge   = array(
    "Look are some things you should know about Vain. He took several of our members and is skilled with death magic. One hit of of it will desroy you, watch yourself.",
    "Here I thought he was the mysterious type. Who would of that Mr. Secretive would do something like this. We don't even know his full name",
    "As his former clan members we are responsible for this"
);
//Rolan
$aRolanDialouge  = array(
    "Fuckin Death needs to get his shit together",
    "Who the fuck does he think he is",
    "Get him back man. Fuckin last thing we need is this on our rep",
    "Bullshit Death....bullshit"
);
//The moofie dialouge
$aMoofieDialouge = "Oh...ill just....sorry...bye..";

//Some bools
$bPhylisActive = TRUE;


while (!feof(STDIN))
  {
    $input = rtrim(fgets(STDIN, 1024));
    $param = explode(" ", $input);
    
    if ($param[0] == "GAME_TIME")
      {
        $sGameTime = $param[1];
        if ($param[1] == "-2")
          {
            $bScriptActive = TRUE;
            foreach ($aSettings as $value)
              {
                echo "$value\n";
              }
            foreach ($aNpcSpawns as $value)
              {
                echo "spawn_zone {$value}\n";
              }
          }
      }
    
    if ($bScriptActive)
      {
        //This script is just a chronological series of events so we can create and check variables along the way
        if ($sGameTime == "-1")
          {
            echo "console_message 0 Hello tronner and welcome to $sAdventureTitle. This is your clan meeting quarters. On your way back from a quest you notice general unrest. You should go speak with clan master behind the bar, Phylis. He will fill you in on the details.\n";
            echo "console_message 0xff0005 Talk to Phylis at the bar. He'll tell you whats going on \n";
          }
        if (($param[0] == "PLAYER_GRIDPOS") && $bPhylisActive == TRUE)
          {
            if (($param[2] > 90) && $param[3] > 120 && $param[3] < 150 && $param[2] < 130)
              {
                $bPhylisActive = FALSE;
                echo "cycle_brake 0\n";
                echo "console_message 0xff0700Phylis: Oh thank god you are here. DeathZone has gone rampant. He left the guild a day ago and has since used his magic to cause hell around the surrounding towns.\n";
                sleep(4);
                echo "console_message 0xff0700Phylis: Listen I don't know whats gotten into Death but we're responsible for this. We have to stop him at all costs. Kill him if you must but try and recover him if possible.\n";
                sleep(4);
                echo "console_message 0xff0700Phylis: Talk to the other guild members, they'll provide some extra info. When you're ready to leave enter the portal behind the building. Good luck.\n";
                sleep(1);
                echo "cycle_brake -200\n";
                echo "spawn_zone n next target 450 100 5 0\n";
              }
          }
        elseif ($param[0] == "PLAYER_GRIDPOS")
          {
            if (($param[2] > 75) && $param[2] < 110 && $param[3] > 150 && $bMoofie)
            {
                echo "cycle_brake 0\n";
                echo "console_message Moofie: $aMoofieDialouge\n";
                $bMoofie = FALSE;
                sleep(3);
                echo "collapse_zone Moofie\n";
                echo "cycle_brake -200\n";  
            }   
                
          }
        
        elseif ($param[0] == "TARGETZONE_PLAYER_ENTER")
          {
            if ($bPhylisActive) //Naughty, go talk to Phylis first
              {
                echo "console_message $param[2]: Go see Phylis.\n";
              }
            else //Already talked to him
              {
                if ($param[2] == "Sarah")
                  {
                    if ($aSarahDialouge)
                      {
                        $iArrayValue = array_rand($aSarahDialouge, 1);
                        echo "console_message Sarah: $aSarahDialouge[$iArrayValue]\n";
                        unset($aSarahDialouge[$iArrayValue]);
                      }
                  }
                elseif ($param[2] == "Vain")
                  {
                    if ($aVainDialouge)
                      {
                        $iArrayValue = array_rand($aVainDialouge, 1);
                        echo "console_message Vain: $aVainDialouge[$iArrayValue]\n";
                        unset($aVainDialouge[$iArrayValue]);
                      }
                  }
                elseif ($param[2] == "Jack")
                  {
                    if ($aJackDialouge)
                      {
                        $iArrayValue = array_rand($aJackDialouge, 1);
                        echo "console_message Jack: $aSarahDialouge[$iArrayValue]\n";
                        unset($aJackDialouge[$iArrayValue]);
                      }
                  }
                elseif ($param[2] == "Rolan")
                  {
                    if ($aRolanDialouge)
                      {
                        $iArrayValue = array_rand($aRolanDialouge, 1);
                        echo "console_message Rolan: $aRolanDialouge[$iArrayValue]\n";
                        unset($aRolanDialouge[$iArrayValue]);
                      }
                  }
              }
          }
      }
  }
 ?>

