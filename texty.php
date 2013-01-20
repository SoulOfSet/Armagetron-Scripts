#!/usr/bin/php
 <?php
 //Script by SoulOfSet
 
 function sendMessage($textMessage, $personalMessage, $sender)
  {
   $textAddress = "number@e-mailaddress.com"; //You could use an email or cell number here. Examples: http://www.emailtextmessages.com/
   $textSubject = "Armagetron Message";
   $textHeaders = 'From: root@myserver.com'."\r\n".
               'Reply-To: root@myserver.com'."\r\n" .
               'X-Mailer: PHP/' . phpversion();
   if($personalMessage) { $textSubject = "Arma PM: $sender"; }
   mail($textAddress, $textSubject, $textMessage, $textHeaders);
   $textSubject = "Armagetron Message"; //Please make sure this is the same as the original $textMessage near the top.
  }
  //
  //Events which you wish to receive a message
  $onChat = 0;
  $onKill = 0;
  $onAdminCommand = 0;
  $onPlayerBan = 0;
  $onPlayerKick = 0;
  $personalMessages = 0; //If you want players to be able to send you custom messages
     $personalMessageAccessLevel = 1; //Minimum level at which someone is allowed to send you a message. Default is admin (1)
     
     while(1)
      {
       $input = rtrim(fgets(STDIN, 1024)); 
     		$param = explode(" ", $input);
       $chatParam = explode(" ", $input, 3);
       
       $banLength = NULL;
       $banReason = NULL;
       
        //Trigger Detection
         if(preg_match("/^CHAT/", $input) && $onChat)
          {
           $chatParam = explode(" ", $input, 3);
           $chatContent = $chatParam[2];
           $Chatter = $param[1];
           $textMessage = "CHAT - $Chatter: $chatContent";
           sendMessage($textMessage, NULL, NULL );
          }
         if(preg_match("/^DEATH_FRAG/", $input) && $onKill)
          {
           $playerKilled = $param[1];
           $playerKiller = $param[2];
           $textMessage = "Kill - $playerKiller killed $playerKilled";
           sendMessage($textMessage, NULL, NULL );
          }
         if(preg_match("/^ADMIN_COMMAND/", $input) && $onAdminCommand)
          {
           $commandParam = explode(" ", $input, 6);
           $adminCommand = $param[4];
           $additionalCommandParams = $commandParam[5];
           $adminCommander = $param[1];
           $textMessage = "Admin Command by $adminCommander: $adminCommand $additionalCommandParams";
           sendMessage($textMessage, NULL, NULL );
          }
         if(preg_match("/^ADMIN_COMMAND/", $input) && $onPlayerBan && strtolower($param[4]) == "ban")
          {
           $banParam = explode(" ", $input, 8);
           $adminBanner = $param[1];
           $playerBanned = $param[5];
           $banLength = $param[6];
           $banReason = $banParam[7];
           if(empty($banLength)) { $banLength = "none given"; }
           if(empty($banReason)) { $banReason = "none given"; }
           $textMessage = "Ban: $adminBanner banned $playerBanned for $banLength because $banReason";
           sendMessage($textMessage, NULL, NULL );
          }
         if(preg_match("/^ADMIN_COMMAND/", $input) && $onPlayerKick && strtolower($param[4]) == "kick")
          {
           $kickParam = explode(" ", $input, 7);
           $adminKicker = $param[1];
           $playerKicked = $param[5];
           $kickReason = $kickParam[6];
           if(empty($kickReason)) { $kickReason = "none given"; }
           $textMessage = "Kick: $adminKicker kicked $playerKicked because $kickReason";
           sendMessage($textMessage, NULL, NULL );
          }
         if(preg_match("/^INVALID_COMMAND/", $input) && $param[4] <= $personalMessageAccessLevel)
          {
           if(($param[1] == "/textowner") && $personalMessages)
            {
             $pmParam = explode(" ", $input, 6);
             $messageSender = $param[2];
             $senderIP = $param[3];
             $pmMessageContent = $pmParam[5];
             $textMessage = "$messageSender ($senderIP): $pmMessageContent";
             sendMessage($textMessage, 1, 1);
            }
          }
      }
?>
   
