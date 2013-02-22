#!/usr/bin/php
<?php
//script by moofie
while(true)
$players = array();
{
    $input = rtrim(fgets(STDIN, 1024));
  $param = explode(" ", $input); 
	if(preg_match("/^ONLINE_PLAYER/", $input))
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
}
?>
