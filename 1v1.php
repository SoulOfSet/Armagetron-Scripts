 <?php
        //Script by SoulOfSet.
        $inProgress = 0;
        
        //----------------------------------------------------------------
        //Available 1v1 Modes. These should correlate to accepted setting
        //standards. Ex: no "expiremental df". Anything like that would
        //obscure 1v1 validity.
        $df = "df.cfg";
        $hr = "hr.cfg";
        $sumo = "sumo.cfg";
        $fort = "fort.cfg";
        $hrs = "hrs.cfg";
        //----------------------------------------------------------------
        $sets = array("teams_max 2", "team_max_players 1", "limit_rounds 0", "limit_score 9999999");
                                
        $availableModes = array("df", "hr", "sumo", "fort", "hrs");
        
        while(1)
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
                            $playersalive[] = $namealive; 
                        }
                    if (preg_match("/^DEATH_FRAG|DEATH_SUICIDE|PLAYER_KILLED|DEATH_SHOT_FRAG|DEATH_DEATHZONE|DEATH_SHOT_SUICIDE|DEATH_TEAMKILL|DEATH_SHOT_TEAMKILL|DEATH_ZOMBIEZONE|DEATH_DEATHSHOT|DEATH_SELF_DESTRUCT/", $input)) //if he died.....
                        {
                            $remove = array_search($param[1], $playersalive);
                            unset($playersalive[$remove]);
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
                            unset($playersalive); 
                        }
                    //END PLAYER TRACKING
                    
                    if (preg_match("/^INVALID_COMMAND/", $input))
    					{
                            if($param[1] == "/1v1")
                                {
                                    if($inProgress == 1) //Already goin
                                        {
                                            print("console_message A 1v1 is already in progress please wait. \n");
                                        }
                                    else //Not going
                                        {
                                            if(empty($param[8]))
                                                {
                                                    print("console_message The required number of params has not
                                                                been met. Please type /help for more info. \n");
                                                }
                                            if(!in_array($param[5], $players) || !in_array($param[6], $players))
                                                {
                                                    print("console_message Either both people are missing
                                                                or one is not there. \n");
                                                }
                                            if(!in_array($param[7], $availableModes))
                                                {
                                                    print("console_message The mode you entered is invalid. Type
                                                                /modes for a list. \n");
                                                }
                                            if(!is_numeric($param[8]) || $param[8] > 10)
                                                {
                                                    print("console_message Either the number you entered is
                                                                not numeric or it exceeds the number 10. \n");
                                                }
                                            else //We can begin
                                                {
                                                    $contestantA = $param[5];
                                                    $contestantB = $param[6];
                                                    $scoreA = 0;
                                                    $scoreB = 0;
                                                    $mode = $param[7];
                                                    $scoreLimit = $param[8];
                                                    $currRound = 0;
                                                    $inProgress = 1;
                                                    
                                                    unset($players[$contestantA]);
                                                    unset($players[$contestantB]);
                                                    
                                                    foreach($players as $value)
                                                        {
                                                            print("suspend $value 20 \n");
                                                        }
                                                        
                                                    $players[] = $contestantA;
                                                    $players[] = $contestantA; 

                                                    foreach($sets as $value)
                                                        {
                                                            print("$value \n");
                                                        }
                                                    
                                                    if($mode == "df"){print("$df \n");}
                                                    if($mode == "hr"){print("$hr \n");}
                                                    if($mode == "sumo"){print("$sumo\n");}
                                                    if($mode == "fort"){print("$fort \n");}
                                                    if($mode == "hrs"){print("$hrs \n");}
                                                    
                                                    foreach($players as $value)
                                                        {
                                                            print("kill $value \n");
                                                        }
                                                        
                                                    print("delay_command 5 console_message A 1v1 has been 
                                                                called between $contestantA and $contestantB to $scoreLimit.
                                                                You may type /score at any time for the current score. \n");
                                                }
                                        }
                                }
                             if($param[1] == "/help")
                                {
                                    print("player_message $param[2] \"This is the 1v1 server. To initiate a 1v1 use syntax like this
                                                /1v1 player1 player2 mode maxscore\" \n");
                                }
                            if($param[1] == "/list")
                                {
                                    foreach($availableModes as $value)
                                        {
                                            print("player_message $param[2] \"$value\" \n");
                                        }
                                }
                            if($param[1] == "/score")
                                {
                                    print("player_message $param[2] \"$contestantA at $scoreA and $contestantB at $scoreB\" \n");
                                }
                                    
                            
                        }
                    
                    //New round calls.
                    if (preg_match("/^NEW_ROUND/", $input) && $inProgress == 1)
                        {
                            $currRound =+ 1;
                            print("Round $currRound. $constestantA at $scoreA and $contestantB at $scoreB \n");
                        }
                        
                    if (preg_match("/^NEW_ROUND/", $input) && $inProgress == 0)
                        {
                            print("console_message Welcome to the 1v1 server. Type /help for more info \n");
                            
                            if(!empty($prevWin))
                                {
                                    print("\n console_message The outcome of last match was $prevWin beating $prevLose \n");
                                }
                       }
                    //Score track
                    if (preg_match("/^ROUND_WINNER/", $input) && $inProgress == 1)
                        {
                            if($param[1] == $contestantA)
                                {
                                    $scoreA =+ 1;
                                }
                            if($param[1] == $contestantB)
                                {
                                    $scoreB =+ 1;
                                }
                        }
                    //If contestant A has won.
                    if(($scoreA == $scoreLimit) && $inProgress == 1)
                        {
                            print("center_message $contestantA has won! Congrats! \n");
                            $prevWin = $contestantA;
                            $prevLose = $contestantB;
                            
                            $scoreA = 0;
                            $scoreB = 0;
                            $inProgress = 0;
                            
                            print("include reset.cfg \n");
                        }
                    //If B wins
                    if(($scoreB == $scoreLimit) && $inProgress == 1)
                        {
                            print("center_message $contestantB has won! Congrats! \n");
                            $prevWin = $contestantB;
                            $prevLose = $contestantA;
                            
                            $scoreA = 0;
                            $scoreB = 0;
                            $inProgress = 0;
                            
                            print("include reset.cfg \n");
                        }
                }
?>
                        