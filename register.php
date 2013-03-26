#!/usr/bin/php
<?php
mysql_connect("localhost", "root", "******") or die(mysql_error());
mysql_select_db("auth") or die(mysql_error());
while(!feof(STDIN))
{
      $input = rtrim(fgets(STDIN, 1024));
		$param = explode(" ", $input); 
	
	if(preg_match("/^INVALID_COMMAND/", $input))
	{
		$param[5] = $username;
		$param[6] = $password;
		$password = md5($password);
		mysql_query("INSERT INTO admin(username, passcode) VALUES('$username', '$password');");
	}

}
?>
