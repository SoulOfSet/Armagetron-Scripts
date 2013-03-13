#!/usr/bin/php
<?php
//script by Moofie with help from Light
//type /whois ingame along with an IP or name.  it will search $file for their other aliases, and list them.
$file = "/home/mark/armagetronad/servers/moofie_demo/var/ladderlog.txt";

$regex = array(
	'find' => array(
		'/\s+/',
		'/\:/',
	),
	'replace' => array(
		'_',
		'\:'
	)
);

while (!feof(STDIN))
{
	$param = explode(" ", rtrim(fgets(STDIN)));
	
	if($param[0] == 'INVALID_COMMAND')
	{
		if ($param[1] == "/whois" && $param[4] <= 1)
		{
			$info = array();
			$ip = filter_var($param[5], FILTER_VALIDATE_IP) ? true : false;
			
			if (!$ip)
				$param[5] = preg_replace($regex['find'], $regex['replace'], strtolower($param[5]));
			
			$fp = fopen($file, 'r');
			
			while (!feof($fp))
			{
				$log = explode(" ", rtrim(fgets($fp)));
				
				if ($log[0] == "PLAYER_ENTERED")
				{
					if ($ip)
					{
						if ($log[2] == $param[5] && !in_array($log[1], $info))
							$info[] = $log[1];
					}
					else
					{
						if ($log[1] == $param[5] && !in_array($log[2], $info))
							$info[] = $log[2];
					}
				}
				elseif ($log[0] == "PLAYER_RENAMED")
				{
					if ($ip)
					{
						if ($log[3] == $param[5])
						{
							if (!in_array($log[1], $info))
								$info[] = $log[1];
							
							if (!in_array($log[2], $info))
								$info[] = $log[2];
						}
					}
					else
					{
						if (($log[1] == $param[5] || $log[2] == $param[5]) && !in_array($log[3], $info))
							$info[] = $log[3];
					}
				}
			}
			
			fclose($fp);
			
			if (!empty($info))
				$message = str_replace('"', '\"', implode('0x0000cc, 0xffffff', $info));
			else
				$message = "Search returned nothing for '{$param[5]}'.";
			
			print("PLAYER_MESSAGE {$param[2]} \"0x0000ccWhois0xffffff: {$message}\"\n");
		}
	}
}

?>

