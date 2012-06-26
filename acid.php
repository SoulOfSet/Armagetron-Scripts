#!/usr/bin/php
    <?php
        $zoneName = "ball"; //name used with spawn_zone n THISNAME
        //Need to get values that are floats
        function GetRandomValue($min, $max)
        {
            $range = $max-$min;
            $num = $min + $range * mt_rand(0, 32767)/32767;

            $num = round($num, 1);

            return ((float) $num);
        }
        while (1)
    		{
				 $input = rtrim(fgets(STDIN, 1024));
				 $param = explode(" ", $input); 
                 $colorRed = GetRandomValue(0, 1);
                 $colorGreen = GetRandomValue(0, 1);
                 $colorBlue = GetRandomValue(0, 1);
                 
                 if (preg_match("/^GAME_TIME/", $input))
				    {
                        print("SET_ZONE_COLOR {$zoneName} {$colorRed} {$colorGreen} {$colorBlue} \n");
				    }
    		}
    ?>