#!/usr/bin/php
 <?php
 //Script by SoulOfSet
 
 //Prequisites For The Mail Function
 $textAddress = "number@e-mailaddress.com"; //You could use an email or cell number here. Examples: http://www.emailtextmessages.com/
 $textSubject = "Armagetron Message";
 $textHeaders = 'From: root@myserver.com'."\r\n".
                'Reply-To: root@myserver.com'."\r\n";
 
 function sendMessage($textMessage, $type, $personalMessage, $sender)
  {
   if($personalMessage == 1) { $textSubject = "Personal Message"; }
   $mail = mail($textAddress, $textSubject, $textMessage, $headers);
   if(!mail)
    {
      echo "Something is broken with the mail function.\n";
    }
   elseif((mail) && $personalMessage == 1)
   {
     print("player_message $sender \"Message Sent!\"\n");
   }
   $textSubject = "Armagetron Message"; //Please make sure this is the same as the original $textMessage near the top.
  }
  //
  
  //Events which you wish to receive a message
  $onChat = 0;
  $onKill = 0;
  $onAdminCommand = 0;
  $onPlayerBan = 0;
  $onPlayerKick = 0;
  
   
   
   
   
     while(1)
      {
       $input = rtrim(fgets(STDIN, 1024)); 
     		$param = explode(" ", $input);
   
