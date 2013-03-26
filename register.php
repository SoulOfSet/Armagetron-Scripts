#!/usr/bin/php
<?php
mysql_connect("localhost", "root", "*****") or die(mysql_error());
mysql_select_db("auth") or die(mysql_error());
$registered = array();
while(!feof(STDIN))
{
    	$input = rtrim(fgets(STDIN, 1024));
		$param = explode(" ", $input); 
	
	if(preg_match("/^INVALID_COMMAND/", $input))
	{
		if($param[1] == "/register")
		{
			if(in_array($param[3], $registered))
			{
				print("console_message Sorry, you have already registered for a Shenanaboosh ID.\n");
			}
			else
			{
				$username = $param[5];
				$password = $param[6];
				$md5pw = md5($password);
				mysql_query("INSERT INTO admin(username, passcode) VALUES('$username', '$md5pw');");
				print("console_message Thanks for registering!  You can now login by typing '/login {$username}@shenanaboosh.me' with {$password} as your password.\n");
				$registered[] = $param[3];
			}
		}
		else
		{
		print("console_message That command does not exist.\n");
		}
	}

}
mysql_close();
?>

