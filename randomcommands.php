#!/usr/bin/php
 <?php
 while(1)
 //Script by Moofie
 {
  $input = rtrim(fgets(STDIN, 1024));
	$param = explode(" ", $input); 
	$xmin = 0;
	$xmax = 500;
	$ymin = 0;
	$ymax = 500;
	$randxcoord = rand($xmin, $xmax);
	$randycoord = rand($ymin, $ymax);
	if(preg_match("/^INVALID_COMMAND/", $input))
	{
		if ($param[1] == "/telly")
		{
			if(empty($param[5]))
			{
			$param[5] = $randxcoord;
			}
			if(empty($param[6]))
			{
			$param[6] = $randycoord;
			}
		print("console_message {$param[2]} teleported!\n");
		print("teleport_player {$param[2]} {$param[5]} {$param[6]} 1 1\n");
		}
		elseif ($param[1] == "/respawn")
		{
			if(empty($param[5]))
			{	
			$param[5] = $randxcoord;
			}
			if(empty($param[6]))
			{
			$param[6] = $randycoord;
			}
		print("console_message {$param[2]} respawned!\n");
		print("respawn_player {$param[2]} 1 {$param[5]} {$param[6]} 1 0\n");
		}	
		elseif ($param[1] == "/fuckthesebitches")
		{
			print("center_message EVERYONE DIE!!!\n");
			print("spawn_zone death 250 250 1 150 0 0 true 15 15 3 1000\n");
		}
 }
 }
 ?>
