#!/usr/bin/php
<?php
//script by moofie
$console_msgs = array(
"console_message Please play by loose dogfight rules.  That means no stabbing, backdooring, sealing, or touching the wall of any sort.",
"console_message Come join us at shenanaboosh.me!",
"console_message Shenanaboosh for life!",
"console_message Please don't chatkill other players, it's rude.",
"console_message We ask that you try to keep offensive language to a minimum.",
);
while(1)
	{
		$line = rtrim(fgets(STDIN, 1024));
			if(preg_match( "/^ROUND_STARTED/", $line))
			{
			$displayedmsg = array_rand($console_msgs, 1);
			print("$console_msgs[$displayedmsg] \n");
			shuffle($console_msgs);
			}
	}		
?>
