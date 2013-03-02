#!/usr/bin/php
<?php
//script by moofie
$filename = "/home/mark/armagetronad/servers/moofie_demo/var/ladderlog.txt";
$handle = fopen($filename, "rb");
$contents = fread($handle, filesize($filename));
$records = explode(" ", $contents);
fclose($handle);
while(1)
  {
		$line = rtrim(fgets(STDIN, 1024));
		$param = explode(" ", $line);
			if(preg_match("PLAYER_ENTERED", $handle))
			{
				$records[2] = $playerip;
				$records[3] = $playername;
			}
			if(preg_match("/^INVALID_COMMAND/", $line))
			{
				if($param[1] == "/whois")
				{
					if($param[5] == $playername)
					{
						print("player_message {$param[2]} \"{$playername}'s IP is {$playerip}.  His other aliases are {$playername}.\"\n");
					}
					elseif($param[5] == $playerip)
						{
						print("player_message {$param[2]} \"That IP belongs to {$playername}\"\n");
						}
					else
						{
						print("player_message {$param[2]} \"That user is not in our records\"\n");
						}
				}
			}
	}
?>
