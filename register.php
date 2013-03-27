#!/usr/bin/php
<?php

define("HOSTNAME", "localhost");
define("USERNAME", "root");
define("PASSWORD", "*******");

define("ACCOUNT_LIMIT", 2);

while (!feof(STDIN))
{
    $input = rtrim(fgets(STDIN));
    $split = explode(" ", $input);
    
    if ($split[0] == "INVALID_COMMAND" && $split[1] == "/register")
    {
        $link = mysql_connect(HOSTNAME, USERNAME, PASSWORD);

        if ($link)
        {
            mysql_select_db("auth", $link);

            if (!empty($split[5]) && !empty($split[6]))
            {
                $ip = $split[3];
                $username = mysql_real_escape_string($split[5]);
                $password = $split[6];
                
                $sql = "SELECT COUNT(*) AS `count` FROM `admin` WHERE `username` = '{$username}' LIMIT 1;";
                $row = mysql_fetch_assoc( mysql_query($sql) );

                if ($row['count'] == 0)
                {
                    $sql = "SELECT COUNT(*) AS `count` FROM `admin` WHERE `ip` = '{$ip}';";
                    $row = mysql_fetch_assoc( mysql_query($sql) );

                    if ($row['count'] <= ACCOUNT_LIMIT)
                    {
                        $sql = "INSERT INTO `admin` (`ip`, `username`, `passcode`) VALUES ('{$ip}', '{$username}', '" . md5($password) . "');";
                        mysql_query($sql);
                        
                        // Registration successful.
                        print("player_message {$split[2]} \"Thank you for registering.  You may now login by typing '/login {$username}@shenanaboosh.me' using password '{$password}'!\"\n");
                    }
                    else
                    {
                        // You already have too many accounts.
						print("player_message {$split[2]} \"Sorry, you have reached the limit of 2 accounts.  Please contact Moofie if you would like them edited.\"\n");
                    }
                }
                else
                {
                    // Username is taken.
                }
            }
            else
            {
                // Username and/or password wasn't filled in.
				print("player_message {$split[2]} \"You have failed to fill in one of the username/password fields, please try again.\"\n");
            }

            mysql_close($link);
        }
        else
        {
            // Failed to connect to MySQL.
        }
    }
}

?>

