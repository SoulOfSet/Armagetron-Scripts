#!/usr/bin/php
<?php
//script by moofie
$filename = "/home/mark/armagetronad/servers/test/var/messages.txt";
//place the messages you'd like displayed in there^
$handle = fopen($filename, "rb");
$contents = fread($handle, filesize($filename));
fclose($handle);
$line = $contents[rand(0, count($contents) - 1)];
while(1)
	{
		$line = rtrim(fgets(STDIN, 1024));
		if(preg_match( "/^ROUND_COMMENCING/", $line))
			{
			print("console_message [$line] \n");
			}
	}
?>
