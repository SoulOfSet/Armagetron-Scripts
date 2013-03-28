#!/usr/bin/php
<?php

// Options
$username = "0xff0000Bounty";
$points = rand(1, 5);

// Ignore These
$bounty  = "";
$players = array();

while (!feof(STDIN))
{
    $input = rtrim(fgets(STDIN));
	$param = explode(" ", $input);
	
	if ($param[0] == "CYCLE_CREATED")
	{
		array_push($players, $param[1]);
	}
	elseif ($param[0] == "NEW_ROUND")
	{
		$players = array();
	}
	elseif ($param[0] == "GAME_TIME" && $param[1] == "0")
	{
		shuffle($players);
		$bounty  = array_shift($players);
		
		print("console_message {$username}0xffff7f: There's a bounty on {$bounty}'s head for {$points} points!  Get him!" . "\n");
	}
	elseif ($param[0] == "DEATH_FRAG" && $param[1] == $bounty)
	{
		print("add_score_player {$param[2]} {$points}" . "\n");
		print("console_message {$username}0xffff7f: {$param[2]} killed {$bounty} for {$points} points!" . "\n");
	}
}

?>
