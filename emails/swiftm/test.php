<?php

require_once 'lib/swift_required.php';




//Create the Transport
$transport = Swift_SmtpTransport::newInstance()
  ->setHost('smtp.gmail.com')
  ->setPort(465)
  ->setEncryption('ssl')
//  ;

//$transport = Swift_SmtpTransport::newInstance('smtp.gmail.com',  587 )
  ->setUsername('xwc5230@daralmanasek.com')
  ->setPassword('xwc5230')
  ;

/*
You could alternatively use a different transport such as Sendmail or Mail:

//Sendmail
$transport = Swift_SendmailTransport::newInstance('/usr/sbin/sendmail -bs');

//Mail
$transport = Swift_MailTransport::newInstance();
*/

//Create the Mailer using your created Transport
$mailer = Swift_Mailer::newInstance($transport);

//Create a message
$message = Swift_Message::newInstance('Wonderful Subject')
  ->setFrom(array('john@doe.com' => 'John Doe'))
  ->setTo(array('cto@hotelsleaders.com'))
  ->setBody('Here is the message itself')
  ;
  
//Send the message
$result = $mailer->send($message);

/*
You can alternatively use batchSend() to send the message

$result = $mailer->batchSend($message);
*/

