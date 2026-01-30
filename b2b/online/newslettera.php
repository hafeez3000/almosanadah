<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
 "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<title>Newsletter submit</title>
	
	<meta name="robots" content="noindex, nofollow" />
	
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="Content-language" content="en" />
	
		<!-- start CSS -->
		<link rel="stylesheet" href="css/profil-registration-structure.css" type="text/css" media="all" />
		<link rel="stylesheet" href="css/profil-registration-couleur.css" type="text/css" media="all" />
    <link type="text/css" rel="stylesheet" media="screen" href="css/bandeau_cr.css" />
    <style type="text/css">
    #page #profil-overture{background: url(images/profil/newsl_registration_result.jpg) no-repeat;}
    </style>
  <!-- end CSS -->

	
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
      
                <!-- navigation -->
                <ul id="navigation_cr" class="items4 navigation">
                  <li><a href="http://www.dheyafataj.com/" target="_top"><span>Welcome</span></a></li>
                  <li class="deuxLignes"><a href="" target="_top"><span>Search and book a hotel</span></a></li>
                  <li><a href="" target="_top"><span>Dar Al Manasek Hotel</span></a></li>
                  <li><a href="" target="_top"><span>Great ideas</span></a></li>
                </ul>
                <!-- / navigation -->          
          </div>
        </div>
      </div>

	
		
		<div id="profil-mainContainer">
			
			<div id="profil-overture">
		
			
					
				</div>
			</div>
			<!-- @End Bloc Overture -->
      
      
      <div id="profil-content">

    <?php 
    include("../db/db.php"); 
    $email=$_POST['email'];
    $email = strtolower($email);
    $query_gsno ="select semail from nlsubscribe where LOWER(semail)='$email'";
    $result_gsno = pg_query($query_gsno);
    $hid_c = pg_num_rows($result_gsno);
    pg_free_result($result_gsno);

      
    
    if($hid_c>0){   
    ?>  
      
      
      <div   style="text-align:center; font-size:2em; color:Red;">
      The email was already registered, Thank you
    </div>


<div class="submit-button-container"  >

			<span class="btn-submit top-right" id="submitForm">
				<a HREF="javascript:history.go(-1)"  >Go back to home page</a>
				<span class="btn-submit-left"></span>

			</span>
		</div>

   <?php
   
   
   }
    else{
      
    $hostname = $_SERVER['REMOTE_ADDR'];
    $verify = md5(time());
    $query_hotel ="insert into nlsubscribe(created_at, updated_at, semail,  hostip, verify) values ('now', 'now', '$email','$hostname', '$verify')";
    $ins_q = pg_query($query_hotel);
    
    if($ins_q){
    $e_body = <<<ENDH

<html>
<head>
<title>DAR AL MANASEK - Email Newsletter Activation Center</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<center>
<body>
<table width="100%" align="center" cellpadding="0" cellspacing="0" >
<tr>
      <td colspan="2" style="border-bottom: 1px solid #FF0000;"><a href="http://www.dheyafataj.com" ><img src="http://www.dheyafataj.com/dorsERP/images/logo.jpg" border="0"></a></td>
</tr>
<tr>
    <td style="border-right: 1px solid #FF0000;" width ="6%"  height="100%" valign="top">&nbsp;</td>
    <td> <br>
        <table width="95%" align="center">
          <tr> 
            <td style="border-top: 1px solid #FF0000;
background: #FFCCCC;
font:12px Ariel, sans-serif;
font:bold;
padding:2px;">Admin - Email Newsletter  Activation Center</td>
          </tr>
          <tr> 
            <td><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Salamo 
              alaikum $user_first_name! <br><br>
              Thank you for newsletter registering at www.dheyafataj.com.<br>
              </font></td>
          </tr>
          <tr> 
            <td><font size="2" face="Verdana, Arial, Helvetica, sans-serif">We 
              have been received your newletter registration with emailid:: $email, and inorder 
              to activate please click on the link <br><br>
              <a href="http://www.dheyafataj.com/dorsERP/dors/online/nlverify.php?email=$email&verify=$verify"> http://www.dheyafataj.com/dorsERP/dors/online/nlverify.php?semail=$email&verify=$verify</a><br>
              <br>
              </font></td>
          </tr>
          <tr>
            <td><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><br>Note: If you have problem in viewing this email, 
              <br>
              please ENCODE the character set to <font color="#FF0000">UNICODE 
              ( UTF-8 )</font></font></td>
          </tr>
          <tr> 
            <td style="border-bottom: 1px solid #FF0000;" align="right"><div align="left"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Adminstration Dept - WWW.DARALMANASEK.COM <br>
                <br></font></div></td>
          </tr>
          <tr>
            <td align="right"><font size="1" face="Verdana, Arial, Helvetica, sans-serif">Keep doing online bookings in smart way to save time and money - Dar Al Manasek - Virtually go anyware in Kindom of Saudi Arabia -  <a href="mailto:deyafahsales@gmail.com">deyafahsales@gmail.com</a></font></td>
          </tr>
        </table>
      </td>
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
    
    $subject_s = "DORS - New email Registration for newletters at : " . date("r")." (GMT)"; 	
  
    //Create a message
    
    
    $message = Swift_Message::newInstance($subject_s)
    ->setFrom(array('deyafahsales@gmail.com' => 'DORS - Reservation'))
    ->setTo(array($email))
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
 <div   style="text-align:center; font-size:3em">
 
 Congratulations!!!, <br> Your email successfully registered for newletters. <br> In couple of moments you will receive newletter activation email link. <br> For Further queries  <a href="contactus.php">contact us</a>
 
 
 </div>
 <?php

  }  

}

 ?>
 




 </div>
	
              
      
			</div>
			<!-- @End Bloc Content -->
		
		</div>
		<!-- @End Bloc mainContainer -->
   
