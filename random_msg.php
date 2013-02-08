#!/usr/bin/php
<?php
//script by moofie
$filename = "/home/mark/armagetronad/servers/test/var/messages.txt";
//place the messages you'd like displayed in there^
$file = fopen($filename, "r");
$fileLines = file($file);
while(1)
	{
		$line = rtrim(fgets(STDIN, 1024));
		if(preg_match( "/^ROUND_COMMENCING/", $line))
			{
			$message = array_rand($fileLines, 1);
			print("console_message $message \n");
			}
	}
?>
