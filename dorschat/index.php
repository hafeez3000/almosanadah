<?php

require_once dirname(__FILE__)."/src/phpfreechat.class.php";
$params = array();
$params["title"] = "Quick chat";
$params["nick"] = "guest".rand(1,10);  // setup the intitial nickname
$params["isadmin"] = true; // just for debug ;)
$params["serverid"] = md5(__FILE__); // calculate a unique id for this chat
$chat = new phpFreeChat( $params );

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html>
 <head>
  <meta http-equiv="content-type" content="text/html; charset=utf-8" />
  <title>phpFreeChat- Sources Index</title>
  <link rel="stylesheet" title="classic" type="text/css" href="style/generic.css" />
  <link rel="stylesheet" title="classic" type="text/css" href="style/header.css" />
  <link rel="stylesheet" title="classic" type="text/css" href="style/footer.css" />
  <link rel="stylesheet" title="classic" type="text/css" href="style/menu.css" />
  <link rel="stylesheet" title="classic" type="text/css" href="style/content.css" />  
  <?php $chat->printJavascript(); ?>
  <?php $chat->printStyle(); ?>  
 </head>
 <body>

<div class="header">
      <h1>DORS Chat</h1>
      <img alt="logo bulle" src="style/bulle.gif" class="logo2" />
</div>



<div class="content">
  <?php $chat->printChat(); ?>
</div>

</body></html>
