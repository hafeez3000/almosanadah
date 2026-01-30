<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<title>Dar Al Manansek - Contact us</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="Content-language" content="en" />

<!-- start CSS -->
<link rel="stylesheet" href="css/profil-registration-structure.css" type="text/css" media="all" />
<link rel="stylesheet" href="css/profil-registration-couleur.css" type="text/css" media="all" />
<link type="text/css" rel="stylesheet" media="screen" href="css/bandeau_cr.css" />
<!-- end CSS -->
<style type="text/css">

        #page #profil-overture{background: url(images/profil/img_contactus.jpg) no-repeat;}

            </style>

<!-- start javascript -->
<script type="text/javascript" src="javascripts/prototype.js"></script>
<script type="text/javascript" src="javascripts/tooltipAH.js"></script>
 <SCRIPT LANGUAGE="JavaScript1.1" SRC="../javascripts/FormChek.js"></SCRIPT>

	

<body id="profil-registration" >
	<div id="page" >
			<div id="profil-bandeau">
        <div id="bandeau_cr">
          <div id="header_cr">
            <a class="logo_cr" href="http://www.dheyafataj.com" target="_top"><img src="images/logo.png" alt="Dar Al Manasek" /></a>
              <p class="slogan_cr"><strong>DAR AL MANASEK <br>It's pleasure to serve you!</strong></p>					

                <ul id="languageSelection_cr">
                  <li><a href="#" lang="ar" ><img src="images/arabic.jpg" alt="Arabic" /></a></li> 
                </ul>	
      
                <!-- start navigation -->
                <ul id="navigation_cr" class="items4 navigation">
                  <li><a href="http://www.dheyafataj.com/" target="_top"><span>Welcome</span></a></li>
                  <li class="deuxLignes"><a href="" target="_top"><span>Search and book a hotel</span></a></li>
                  <li><a href="" target="_top"><span>Dar Al Manasek Hotel</span></a></li>
                  <li><a href="" target="_top"><span>Great ideas</span></a></li>
                </ul>
                <!-- end  navigation -->          
          </div>
        </div>
      </div>

	
		
<div id="profil-mainContainer">
  <div id="profil-overture">
	</div>
</div>


<?php


  require_once('recaptchalib.php');
  $privatekey = "6LfxVrwSAAAAACRxc56KN4ilbh9hOTHVseQrzdGk";
  $resp = recaptcha_check_answer ($privatekey,
                                $_SERVER["REMOTE_ADDR"],
                                $_POST["recaptcha_challenge_field"],
                                $_POST["recaptcha_response_field"]);

  if (!$resp->is_valid) {
    // What happens when the CAPTCHA was entered incorrectly
  

  ?>
      
      <div   style="text-align:center; font-size:2em; color:Red;">
      The reCAPTCHA wasn't entered correctly! <br> errors are:
   <?php  echo $resp->error ; ?>
  </div>
  
  
    <div class="submit-button-container"  >
    
					<span class="btn-submit top-right" id="submitForm">
						<a HREF="javascript:history.go(-1)"  >Retry again with correct CAPTCHA</a>
						<span class="btn-submit-left"></span>

					</span>
				</div>
  
  <?php 
  
  
    die ();
  } else {
  



 $user_name=$_POST['user_name'];
 $user_email=$_POST['user_email'];
 $user_subject=$_POST['user_subject'];
 $user_messagetext=$_POST['user_messagetext'];
 $hostname = $_SERVER['REMOTE_ADDR'];

include("../db/db.php"); 

 $conn;
   $query_hotel ="insert into contactus (cname, email, csubject, messagetext, hostip, created_at, updated_at) values ('$user_name','$user_email', '$user_subject', '$user_messagetext', '$hostname', 'now', 'now')";
  $ins_q = pg_query($query_hotel);
      
if($ins_q){
 
    $e_body = <<<ENDH

<html>
<head>
<title>DAR AL MANASEK - Contactus</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<center>
<body>
<table width="100%" align="center" cellpadding="0" cellspacing="0" >
<tr>
      <td >Name:</td><td> $user_name</td>
</tr>
<tr>
      <td >Email:</td><td> $user_email</td>
</tr>
<tr>
      <td >Subject:</td><td> $user_subject</td>
</tr>

<tr>
      <td >Message:</td><td> $user_messagetext</td>
</tr>

</table>
</body>
</center>
</html>




ENDH;
 
 require_once '../../emails/swiftm/lib/swift_required.php';
    
    require_once '../../emails/emailuser.php';
    
    //Create the Transport
    $transport = Swift_SmtpTransport::newInstance()
    ->setHost('smtp.gmail.com')
    ->setPort(465)
    ->setEncryption('ssl')
    //  ;
    
    //$transport = Swift_SmtpTransport::newInstance('smtp.gmail.com',  587 )
    ->setUsername($euser)
    ->setPassword($epass)
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
    
    $mailer1 = Swift_Mailer::newInstance($transport);
    
    $subject_s = "DORS - New Contact at : " . date("r")." (GMT)"; 	
  
    //Create a message
    
    
    $message = Swift_Message::newInstance($subject_s)
    ->setFrom(array('deyafahsales@gmail.com' => 'DORS - Reservation'))
    ->setTo(array($user_email))
    ->setBody($e_body, 'text/html')
    ;
    
    $message1 = Swift_Message::newInstance($subject_s)
    ->setFrom(array('deyafahsales@gmail.com' => 'DORS - Reservation'))
    ->setTo('hafeez@dheyafataj.com')
    ->setBody($e_body, 'text/html')
    ;  
    //Send the message
    $result = $mailer->send($message);
    
    
    $mailer1->send($message1);
    
 





 ?> 
<div   style="text-align:center; font-size:2em; color:Green;">
 Your contact message successfully submitted
</div>

<?
}

}

?>

