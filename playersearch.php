#!/usr/bin/php
<?php
//script by moofie
$filename = "/home/mark/armagetronad/servers/moofie_demo/var/ladderlog.txt";
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
		if($param[0] == 'INVALID_COMMAND' && $param[1] == "/whois" && $param[4] <= 1)
		{
			$ip = filter_var($param[5], FILTER_VALIDATE_IP) ? true : false;
				{
					$user = preg_replace($regex['find'], $regex['replace'], $param[5]);
				}
		}		
		
}
?>
