
BETA
PHP Formatter
HomeFeaturesContactAbout
	Bookmark and Share

			
Welcome to the new PHP Formatter BETA!
We've given PHP Formatter a new design as well as a new engine! The new engine features:

    Blazingly fast, on the fly formatting of all scripts!
    PHP 4 and PHP 5 support
    Handy syntax check function
    Ability to create your own coding styles, or to use builtin styles
    Proper handling of doc comments, and alternative control structures



			
InputStyleFormat
1
2
3
4
5
6
7
8
9
10
11
12
13
14
15
16
17
18
19
20
21
22
23
24
25
26
27
28
29
30
31
32
33
34
35
36
37
38
39
40
41
42
43
44
45
46
47
48
49
50
51
52
53
54
55
56
57
	#!/usr/bin/php
<?php
//Jumbo Sumobar script: by Moofie
$players    = array();
$numplayers = count($players);
$zonesizes  = array(
    30,
    45,
    60,
    75,
    90
);
while (!feof(STDIN))
  {
    $input = rtrim(fgets(STDIN));
    $param = explode(" ", $input);
    
    if ($param[0] == "PLAYER_ENTERED")
      {
        array_push($players, $param[3]);
      }
    if ($param[0] == "PLAYER_LEFT")
      {
        $remove = array_search($param[1], $players);
        unset($players[$remove]);
      }
    if ($param[0] == "PLAYER_RENAMED")
      {
        $oldname = array_search($param[1], $players);
        unset($players[$oldname]);
        array_push($players, $param[2]);
      }
    if ($param[0] == "GAME_TIME" && $param[1] == "0")
      {
        if ($numplayers <= 3)
          {
            print("SPAWN_ZONE sumo 150 150 {$zonesizes[1]} -.4 0 0\n");
          }
        elseif ($numplayers >= 4 && $numplayers <= 6)
          {
            print("SPAWN_ZONE sumo 150 150 {$zonesizes[2]} -.4 0 0\n");
          }
        elseif ($numplayers >= 7 && $numplayers <= 9)
          {
            print("SPAWN_ZONE sumo 150 150 {$zonesizes[3]} -.4 0 0\n");
          }
        elseif ($numplayers >= 10 && $numplayers <= 12)
          {
            print("SPAWN_ZONE sumo 150 150 {$zonesizes[4]} -.4 0 0\n");
          }
        elseif ($numplayers >= 13 && $numplayers <= 15)
          {
            print("SPAWN_ZONE sumo 150 150 {$zonesizes[5]} -.4 0 0\n");
          }
      }
  }
?>
Download Formatting took: 141 ms
PHP Formatter made by Spark Labs  
Copyright Gerben van Veenendaal  
