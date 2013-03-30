#!/usr/bin/php
//Script by SoulOfSet and Moofie
    <?php
    
        
        //Adventure Class
        class adventure
        {
         public $sAdventureTitle;
         public $sMapDir;
         public $sAdventurerGID;
         public $iAdventurerRoundCurr;
         //Add the adventure names here
         public $aAvailableAdventures = array("hi");
         
         function __construct($sTitle, $sMapDir, $sGID, $iRoundCurr)
         {   
            $this->sAdventureTitle = $sTitle;
            $this->sMapDir = $sMapDir;
            $this->sAdventurerGID = $sGID;
            $this->iAdventurerRoundCurr = $iRoundCurr;
            
            if($this->checkAvailable())
                {
                    $this->startAdventure();
                }
            else
                {
                    echo "console_message That adventure is not available \n";
                }
         } 
         
         function checkAvailable($sTitle)
         {
             if(!in_array($sTitle, $this->aAvailableAdventures))
                {
                    return FALSE;
                }
             else
                {
                    return TRUE;
                }
         }
         
         function startAdventure()
         {
            echo "center_message Hello $this->sAdventurerGID and welcome to $this->sAdventureTitle \n";
            echo "delay_command 3 center_message You will start at level $this->iAdventurerRoundCurr \n";
            echo "delay_command 6 center_message Please note that this is still beta and requires much work. Please report any problems to SoulOfSet or Moofie \n";
            echo "delay_command 9 center_message Your adventure will begin shortly \n";
            echo "delay_command 11 map_file SoulOfSet/{$this->sMapDir}/map{$this->iAdventurerRoundCurr}-1.aamap.xml \n";
            echo "delay_command 11 spawn_script {$this->sAdventureTitle}/script{$this->iAdventurerRoundCurr}.php \n";
         }
         
        }
        while (!feof(STDIN))
        {
  			 $input = rtrim(fgets(STDIN, 1024));
				 $param = explode(" ", $input); 
                 
                 
                          
        } 
