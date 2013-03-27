#!/usr/bin/php
<?php
//script by moofie
//note: not currently working
$players = array();
while (!feof(STDIN))
{
    $input = rtrim(fgets(STDIN, 1024));
	$param = explode(" ", $input); 
		if(preg_match("/^PLAYER_ENTERED/", $input))
		{
			$name = $param[1];
			$players[] = $name;	
		}
		if(preg_match("/^NEW_ROUND/", $input))
		{
			$bounty = array_rand($players);
			print("console_message There has been a bounty placed on {$bounty}'s head for 2 points!");
			shuffle($players);
		}
		if(preg_match("/^PLAYER_LEFT/", $input))
		{
			$remove = array_search($param[1], $players);
			unset($players[$remove]);
		}
}
?>
