#!/usr/bin/php
<?php
//Script by SoulOfSet
/*Script which, on new player enter, will log IP with their name and record all future
names under that addy to the same ip.*/

 $sWhoisFile = "whois.txt"
 $aWhoisFile = fopen($sWhoIsFile, 'w+'); //Open for reading and writing, if it does not exist it will try and create it

 while (1)
  {
		 $input = rtrim(fgets(STDIN, 1024));
			$param = explode(" ", $input); 
   
   
   
   
   
   
