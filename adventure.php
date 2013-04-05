#!/usr/bin/php
    <?php
//Script by SoulOfSet and Moofie
//Incase you got your own Mr. Special
$sDefaultCFGCommand = "RINCLUDE default.cfg(http://shenanaboosh.me/armagetronad/default.cfg)";

//Adventure Class
class adventure
  {
    //This variable is usually just your Author title in the repo but can extend to 
    //type also if you use more than one. (Ex. SoulOfSet/hr/team/maphere.aamap.xml)
    const sMapCommandPrefix = "SoulOfSet";
    
    public $sAdventureTitle;
    public $sMapDir;
    public $sAdventurerGID;
    public $iAdventurerRoundCurr = 1;
    //Add the adventure names here
    public $aAvailableAdventures = array("roguedz");
    //
    public $bAdventureInProgress = FALSE;
    
    function __construct($sTitle, $sMapDir, $sGID, $iRoundCurr)
      {
        $this->sAdventureTitle      = $sTitle;
        $this->sMapDir              = $sMapDir;
        $this->sAdventurerGID       = $sGID;
        $this->iAdventurerRoundCurr = $iRoundCurr;
        
        if ($this->checkAvailable($this->sAdventureTitle))
          {
            $this->startAdventure();
          }
        else
          {
            echo "console_message That adventure is not available\n";
          }
      }
    
    function checkAvailable($sTitle)
      {
        if (!in_array($sTitle, $this->aAvailableAdventures))
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
        $this->bAdventureInProgress = TRUE;
        echo "center_message Hello $this->sAdventurerGID and welcome to $this->sAdventureTitle\n";
        usleep(300000);
        echo "delay_command 3 console_message You will start at level $this->iAdventurerRoundCurr\n";
        echo "delay_command 6 console_message Please note that this is still beta and requires much work. Please report any problems to SoulOfSet or Moofie\n";
        echo "delay_command 9 console_message Your adventure will begin shortly\n";
        echo "delay_command 11 map_file " . self::sMapCommandPrefix . "/{$this->sMapDir}/map{$this->iAdventurerRoundCurr}-1.aamap.xml\n";
        echo "delay_command 11 spawn_script {$this->sAdventureTitle}/script{$this->iAdventurerRoundCurr}.php\n";
        echo "delay_command 11 kill $this->sAdventurerGID\n";
      }
    
    function nextRound()
      {
        echo "kill_script {$this->sAdventureTitle}/script{$this->iAdventurerRoundCurr}.php\n";
        $this->iAdventurerRoundCurr = $this->iAdventurerRoundCurr + 1;
        if (!file_exists("{$this->sAdventureTitle}/script{$this->iAdventurerRoundCurr}.php"))
          {
            echo "console_message Congrats you have completed the adventure :D.\n";
            $this->bAdventureInProgress = FALSE;
          }
        else
          {
            echo "map_file " . self::sMapCommandPrefix . "/{$this->sMapDir}/map{$this->iAdventurerRoundCurr}-1.aamap.xml\n";
            echo "spawn_script {$this->sAdventureTitle}/script{$this->iAdventurerRoundCurr}.php\n";
          }
      }
    
  }

//Some variables
$cAdventure = NULL;

while (!feof(STDIN))
  {
    $input = rtrim(fgets(STDIN, 1024));
    $param = explode(" ", $input);
    
    if ($param[0] == "INVALID_COMMAND")
      {
        if (($param[1] == "/start") && !$cAdventure->bAdventureInProgress)
          {
            if (!$param[5])
              {
                echo "console_message Please specify an adventure to play\n";
              }
            else
              {
                $sPlayerName    = $param[2];
                $sAdventureName = $param[5];
                if ((intval($param[6])) && $param[4] <= 1)
                  {
                    $iRoundStart = $param[6];
                  }
                else
                  {
                    $iRoundStart = 1;
                  }
                if (($param[7]) && $param[4] <= 1)
                  {
                    $sMapDir = $param[7];
                  }
                else
                  {
                    $sMapDir = $sAdventureName;
                  }
                 $cAdventure = new adventure($sAdventureName, $sMapDir, $sPlayerName, $iRoundStart);
              }   
          }
        elseif (($param[1] == "/start") && $cAdventure->bAdventureInProgress)
          {
            echo "console_message An adventure is in progress. Type /end to stop it\n";
          }
        elseif (($param[1] == "/end") && $cAdventure->bAdventureInProgress == TRUE)
          {
            echo "kill_script {$cAdventure->sAdventureTitle}/script{$cAdventure->iAdventureRoundCurr}.php\n";
            $cAdventure = NULL;
            echo "$sDefaultCFGCommand\n";
          }
        elseif (($param[1] == "/end") && $cAdventure->bAdventureInProgress == FALSE)
          {
            echo "console_message There is no adventure to end! \n";
          }
      }
    elseif (($param[0] == "TARGETZONE_PLAYER_ENTER") && $param[2] == "next")
      {
        $cAdventure->nextround();
      }
  }

?>
