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
			$fp = fopen($file, 'r');
				while (!feof($fp))
				{
				$log = explode(" ", rtrim(fgets($fp)));
					if($log[0] == "PLAYER_ENTERED")
					{
						if($ip)
                            {
                            $info = array();
								if($log[2] == $param[5] && !in_array($log[3], $info))
								$info[] = $log[1];
                            }
                        else
							{
							
							}
							
					}
					elseif ($log[0] == "PLAYER_RENAMED")
					{
						if($ip)
                            {
                             if($log[3] == $param[5])
                                {
                                    if (!in_array($log[1], $info))
                                        $info[] = $log[1];
                                                       
                                    if (!in_array($log[2], $info))
                                        $info[] = $log[2];
                                }                  
                            }
                        else
							{
							
							}
					}
					
				}
			fclose($fp);
			print("PLAYER_MESSAGE {$param[2]} \"0x0000ccWhois0xffffff: " . implode('0x0000cc, 0xffffff', $info) . "\"\n");
		}		
}
?>
