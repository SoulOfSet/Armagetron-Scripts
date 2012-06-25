#!/usr/bin/php
	<?php
		//Vote Control
		$playersVotedYes = array();
		$playersVotedNo = array();
        $playersAlive = array();
		$numPlayersVoteYes;
		$numPlayersVoteNo;
		$voteInSession = false;
		$voteSessionTime = 20; //In Seconds
		$command;
        $currGameMode = "pandamonium"; //Put the default cfg here.
		//Time Tracker
		$gameTimeCurr = 0;
		$gameTimeVoteEnd = -1;
		//File Includes
		$teamsumo = "include teamsumo.cfg \n";
		$pandamonium = "include settings_custom.cfg \n"; //Default CFG
		$hr = "include hr.cfg \n";
		$df = "include df.cfg \n";
		//Files Array
		$filesToInclude = array($teamsumo, $pandamonium, $hr, $df);
		$filesToIncludeStrings = array("teamsumo", "pandamonium", "hr", "df");
		
		//Function To Start The Voting Session And Determines The Length Of The Session
			while(1)
				{
					$input = rtrim(fgets(STDIN, 1024)); 
					$param = explode(" ", $input);
					
					//Keep Track Of Time	
					if (preg_match("/^GAME_TIME/", $input))
						{
							$gameTimeCurr = $param[1];
						}
					//Track Players Alive
                    if(preg_match("/^CYCLE_CREATED/", $input))
                        {
                        	$name = $param[1];
                        	$playersAlive[] = $name;
                        }
					//Ends The Voting Sessions And Determines Outcome
					if ($gameTimeVoteEnd <= $gameTimeCurr && $voteInSession == true)
						{
							$voteInSession = false;
							$numPlayersVoteYes = count($playersVotedYes);
							$numPlayersVoteNo = count($playersVotedNo);
							//Do Or Not Do?
							if ($numPlayersVoteYes > $numPlayersVoteNo) //The Vote Has Been Accepted
								{
                                    $currGameMode = $voteType;
									print("console_message Vote Accepted! Config will be included shortly! \n");
                                    print("DELAY_COMMAND 5 {$command}\n");
                                    print("collapse_zone\n");
                                    print("START_NEW_MATCH");
                                    foreach($playersAlive as $value)
                                        {
                                                print("kill {$value}\n");
                                        }  
								}
							elseif ($numPlayersVoteYes == $numPlayersVoteNo) //The Vote Tied
								{
									print("console_message The vote has tied! No action will be taken.\n");
								}
							else //The Vote Was Denied
								{
									print("console_message The vote was denied! No action will be taken.\n");
								}
							$gameTimeVoteEnd = -1;
							unset($playersVotedYes);
							unset($playersVotedNo);
						}
						
					//Include It When The Round Ends
					if (preg_match("/^NEW_ROUND/", $input) && $voteInSession == true)
						{
                            
							$gameTimeVoteEnd = $gameTimeVoteEnd - $gameTimeCurr;
                            $gameTimeCurr = -2;
                            print("console_message A vote is still in session for {$voteType}. Please type /yes or /no to vote.\n");
						}
                    if (preg_match("/^NEW_ROUND/", $input) && $voteInSession == false)
						{
                            print("console_message The current game mode is {$currGameMode}. Type /chmode modehere to change that! Type /list for available modes.\n");
						}
					//Voting Control
					if (preg_match("/^INVALID_COMMAND/", $input))
						{
							if ($param[1] == "/chmode" && $voteInSession == false)
								{
									$voteOwner = $param[2];
									$voteType = $param[5];
									if (in_array($param[5], $filesToIncludeStrings))
										{
											$voteInSession = true;
											if ($voteType == "teamsumo") {$command = $teamsumo;}
											elseif ($voteType == "pandamonium") {$command = $pandamonium;}
											elseif ($voteType == "hr") {$command = $hr;}
											elseif ($voteType == "df") {$command = $df;}
                                            $playersVotedYes[] = $voteOwner; 
											$gameTimeVoteEnd = $gameTimeCurr + $voteSessionTime;
											print("console_message A vote has been cast for {$voteType}. Please vote /yes or /no in your chat! \n");
										}
									else
										{
											print("console_message Please enter a valid mode. Type /list for available modes! \n");
										}
								}
							elseif ($param[1] == "/chmode" && $voteInSession == true)
								{
									
									print("console_message A vote is already in session. Type /yes or /no to vote on it \n");
								}
							elseif ($param[1] == "/yes" && $voteInSession == true)
								{
									if (!in_array($param[2], $playersVotedYes) && 
										!in_array($param[2], $playersVotedNo))
											{
												$playersVotedYes[] = $param[2]; 
												print("player_message {$param[2]} \"Your vote has been casted!\"\n");
											}
									else
										{
											print("player_message {$param[2]} \"You've already cast your vote\"\n");
										}
								}
							elseif ($param[1] == "/no" && $voteInSession == true)
								{
									if (!in_array($param[2], $playersVotedYes) && 
										!in_array($param[2], $playersVotedNo))
											{
												$playersVotedNo[] = $param[2]; 
												print("player_message {$param[2]} \"Your vote has been casted!\"\n");
											}
									else
										{
											print("player_message {$param[2]} \"You've already voted!\"\n");
										}
								}
							//No Vote In Progress
							elseif ($param[1] == "/yes" && $voteInSession == false)
								{
									print("player_message {$param[2]} \"There is no vote in progress. Type /chmode modehere to start a vote. Type /list for available modes!\"\n");
								}
							elseif ($param[1] == "/no" && $voteInSession == false)
								{
									print("player_message {$param[2]} \"There is no vote in progress. Type /chmode modehere to start a vote. Type /list for available modes!\"\n");
								}
							//List The Modes
							elseif ($param[1] == "/list")
								{
									foreach ($filesToIncludeStrings as $value)
										{
											print("player_message {$param[2]} \"0xff0010{$value}\"\n");
										}
								}
                            //DEBUG
                            elseif($param[4] <= 1 && $param[1] == "/gtc")
    					        {
							        print("console_message {$gameTimeCurr}\n");
						        }
                            elseif($param[4] <= 1 && $param[1] == "/gtvt")
        				        {
							        print("console_message {$gameTimeVoteEnd}\n");
						        }
                            //END DEBUG
							else
								{
									print("player_message {$param[2]} \"Command does not exist!\"\n");
								}
						}

				}
	?>			