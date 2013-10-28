#!/usr/bin/php
<?php

/* Spawn zombies following every player at the start of each round.

These settings must be set for this to work:
ladderlog_write_game_time set to 1
ladderlog_write_online_player set to 1
ladderlog_game_time_interval set to 1

*/
$sentryactive  = 0;
$timesentrydie = 0;
$sentryowner;
$sentrytarget;
while (1) {
                $line = rtrim(fgets(STDIN, 1024));
                if (preg_match("/^GAME_TIME/", $line)) {
                                $array = preg_split("/ /", $line);
                                $time  = floor($array[1]);
                                if ($time == 9) {
                                                print($zombie);
                                                $zombie = "";
                                }
                }
                
                if (preg_match("/^ONLINE_PLAYER/", $line)) {
                                $array = preg_split("/ /", $line);
                                if (sizeof($array) == 7) {
                                                $zombie .= "SPAWN_ZONE zombie $array[1] 100 100 1 0 0 0 false .1 .2 .3 1\n";
                                }
                }
                if (preg_match("/^DEATH_ZOMBIEZONE/", $line)) {
                                $split = explode(" ", $line);
                                print("console_message $split[1] was killed by Boo! One of Bowzers minions!\n");
                                print("add_score_player $split[1] -1\n");
                }
                if (preg_match("/^INVALID_COMMAND/", $line)) {
                                $param = explode(" ", $line);
								if ($param[1] == "/sentry") //sentry
                                                {
                                                print("console_message {$param[5]} activated a 0x00ffffSentry!\n");
                                                print("set_zone_expansion sentry -100\n");
                                                print("spawn_zone n sentryzone rubber {$param[6]} {$param[7]} 10 0 0 0 0 false 0 10 15 \n ");
                                                $scoretype       = "sentry";
                                                $timesentrystart = $gametime;
                                                $timesentrydie   = $gametime + 12;
                                                $centerxsentry   = $param[6];
                                                $centerysentry   = $param[7];
                                                $maxxsentry      = $param[6] + 100;
                                                $minxsentry      = $param[6] - 100;
                                                $maxysentry      = $param[7] + 100;
                                                $minysentry      = $param[7] - 100;
                                                $sentryactive    = 1;
                                                $scoree          = $param[5];
                                                $sentryowner     = $param[5];
                                }
                }
                if (preg_match("/^PLAYER_GRIDPOS/", $input) && $sentryactive == 1 && $sentryowner !== $param[1]) {
                                if ($param[2] > $minxsentry && $param[2] < $maxxsentry || $param[3] > $minysentry && $param[3] < $maxysentry) {
                                                if (empty($sentrytarget) && $param[1] !== $sentryowner) {
                                                                $sentrytarget = $param[1];
                                                }
                                                if ($param[1] == $sentrytarget) {
                                                                print("spawn_zone n sentryshot target L {$centerxsentry} {$centerysentry} {$param[2]} {$param[3]} {$param[2]} {$param[3]} Z 2.5 -1 -100 -100 true 0 10 15 \n");
                                                }
                                }
                                if ($param[2] < $minxsentry && $param[2] > $maxxsentry || $param[3] < $minysentry && $param[3] > $maxysentry) {
                                                if ($param[1] == $sentrytarget) {
                                                                unset($sentrytarget);
                                                }
                                }
                }
                if (preg_match("/^GAME_TIME/", $line) && $param[1] == $timesentrydie) {
                                print("set_zone_expansion sentryzone -100\n");
                                unset($sentrytarget);
                                $sentryactive = 0;
                }
}
?>
