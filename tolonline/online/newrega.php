<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
 "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<title>Create Your Profile</title>
	
	<meta name="robots" content="noindex, nofollow" />
	
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="Content-language" content="en" />
	
		<!-- start CSS -->
		<link rel="stylesheet" href="css/profil-registration-structure.css" type="text/css" media="all" />
		<link rel="stylesheet" href="css/profil-registration-couleur.css" type="text/css" media="all" />
    <link type="text/css" rel="stylesheet" media="screen" href="css/bandeau_cr.css" />
    <style type="text/css">
    #page #profil-overture{background: url(images/profil/img-registration_result.jpg) no-repeat;}
    </style>
  <!-- end CSS -->
	<script type="text/javascript" src="javascripts/prototype.js"></script>

  <script type="text/javascript" src="javascripts/tooltipAH.js"></script>
  <SCRIPT LANGUAGE="JavaScript1.1" SRC="../javascripts/FormChek.js"></SCRIPT>

	
<body id="profil-registration" onLoad="document.newUser1.user_civility.focus();">
	<div id="page" >
			<div id="profil-bandeau">
        <div id="bandeau_cr">
          <div id="header_cr">
            <a class="logo_cr" href="http://www.daralmanasek.com" target="_top"><img src="images/logo.png" alt="Dar Al Manasek" /></a>
              <p class="slogan_cr"><strong>DAR AL MANASEK <br>It's pleasure to serve you!</strong></p>					

                <ul id="languageSelection_cr">
                  <li><a href="#" lang="ar" ><img src="images/arabic.jpg" alt="Arabic" /></a></li> 
                </ul>	
      
                <!-- navigation -->
                <ul id="navigation_cr" class="items4 navigation">
                  <li><a href="http://www.daralmanasek.com/" target="_top"><span>Welcome</span></a></li>
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
    
    
    include("../db/db.php"); 
    $verify = md5(time());
    
    
    $query_hotel ="select users from seq";
    
    $result_hotel = pg_query($query_hotel);
    
    if (!$result_hotel) {
    echo "An error occured.\n";
    exit;
    }
    while ($rows_hotel = pg_fetch_array($result_hotel)){
    
    $u_sno = $rows_hotel["users"];
    
    }
    
    pg_free_result($result_hotel);
    
    
    $u_sno++;
    
    $user_id=$_POST['user_login'];
    
    $uid = strtolower($user_id);
    
    $user_password=$_POST['user_password'];
    $user_title=$_POST['user_civility'];
    $user_first_name=$_POST['user_firstName'];
    $user_last_name=$_POST['user_lastName'];
    
    $user_last_name =  addslashes($user_last_name);
    
    $designation=$_POST['user_designation'];
    $company_name=$_POST['user_companyName'];
    
     $company_name =  addslashes($company_name);
    
 //   $iata_number=$_POST['iata_number'];
    $addr1=$_POST['user_address1'];
    $addr1 =  addslashes($addr1);
    $addr2=$_POST['user_address2'];
    $addr2 =  addslashes($addr2);
 //   $po_box=$_POST['po_box'];
    $zip_code=$_POST['user_zipCode'];
    $city=$_POST['user_city'];
    $city =  addslashes($city);
    $country=$_POST['user_country'];
     $country =  addslashes($country);
    
    
    
    $tel1=$_POST['user_phonePrefix'] . $_POST['user_phoneNumber'];
 //   $tel2=$_POST['tel2'];
  
    
  $mobile=$_POST['user_mobilePrefix'] . $_POST['user_mobileNumber'];
    
    
    $fax= $_POST['user_faxPrefix'] . $_POST['user_faxNumber'];
    
   
    
    $email=$_POST['user_email'];
//    $web=$_POST['web'];
//    $reg_date=$_POST['reg_date'];
    
    $query_gsno ="select user_id from users where LOWER(user_id)='$uid'";
    
    $result_gsno = pg_query($query_gsno);
    
    $hid_c = pg_num_rows($result_gsno);
    
    pg_free_result($result_gsno);
    
    
    if($hid_c>0){ 
      
     ?>
     
         <div   style="text-align:center; font-size:2em; color:Red;">
      The userid already taken
      
       <div class="submit-button-container"  >
    
					<span class="btn-submit top-right" id="submitForm">
						<a HREF="javascript:history.go(-1)"  >Retry again with another userid!</a>
						<span class="btn-submit-left"></span>

					</span>
				</div>
      
  </div>
  
  
  
   
   <?php   
      
      }
    else{
    
    $query_hotel ="insert into users(user_sno,user_id,user_password,user_title,user_first_name,user_last_name,designation,company_name,addr1,addr2,zip_code,city,country,tel1,mobile,fax,email,reg_date,email_active_c) values ($u_sno,'$user_id','$user_password','$user_title','$user_first_name','$user_last_name','$designation','$company_name','$addr1','$addr2','$zip_code','$city','$country','$tel1','$mobile','$fax','$email','now()','$verify')";
    $ins_q = pg_query($query_hotel);
    

  
    if($ins_q){
    
     $sequpdateg_rate_sno = "update seq set users=$u_sno";
    pg_query($sequpdateg_rate_sno);
   
    
    
    $e_body = <<<ENDH

<html>
<head>
<title>DAR AL MANASEK - Userid Activation Center</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<center>
<body>
<table width="100%" align="center" cellpadding="0" cellspacing="0" >
<tr>
      <td colspan="2" style="border-bottom: 1px solid #FF0000;"><a href="http://www.daralmanasek.com" ><img src="http://www.daralmanasek.com/dorsERP/images/logo.jpg" border="0"></a></td>
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
padding:2px;">Admin - Userid Activation Center</td>
          </tr>
          <tr> 
            <td><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Salamo 
              alaikum $user_first_name! <br><br>
              Thank you for registering at www.daralmanasek.com.<br>
              </font></td>
          </tr>
          <tr> 
            <td><font size="2" face="Verdana, Arial, Helvetica, sans-serif">We 
              have been received your registration with userid:: $uid, and inorder 
              to activate please click on the link <br><br>
              <a href="http://www.daralmanasek.com/dorsERP/dors/online/verify.php?uid=$uid&verify=$verify"> http://www.daralmanasek.com/dorsERP/dors/online/verify.php?uid=$uid&verify=$verify</a><br>
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
            <td align="right"><font size="1" face="Verdana, Arial, Helvetica, sans-serif">Keep doing online bookings in smart way to save time and money - Dar Al Manasek - Virtually go anyware in Kindom of Saudi Arabia -  <a href="mailto:res@daralmanasek.com">res@daralmanasek.com</a></font></td>
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
    
    $subject_s = "DORS - New User Registration at : " . date("r")." (GMT)"; 	
  
    //Create a message
    
    
    $message = Swift_Message::newInstance($subject_s)
    ->setFrom(array('res@daralmanasek.com' => 'DORS - Reservation'))
    ->setTo(array($email))
    ->setBody($e_body, 'text/html')
    ;
    
    $message1 = Swift_Message::newInstance($subject_s)
    ->setFrom(array('res@daralmanasek.com' => 'DORS - Reservation'))
    ->setTo('hafeez@daralmanasek.com')
    ->setBody($e_body, 'text/html')
    ;  
    //Send the message
    $result = $mailer->send($message);
    
    
    $mailer1->send($message1);
    
 
 ?>
 
 <div   style="text-align:center; font-size:3em">
 
 Congratulations!!!, <br> Your profile successfully registered. <br> In couple of moments you will receive profile activation email link. <br> For Further queries  <a href="contactus.php">contact us</a>
 
 
 </div>
 
 
 
 
 
 <?php  
     }
     
     else {
       ?>
       <div   style="text-align:center; font-size:3em; color:Red">
 
 Soory!!!, <br> Your profile  registeration failed. <br>   <a HREF="javascript:history.go(-1)">Try Again with correct data</a>
 
 
 </div>
   <?php    
     }
      
     } 
    
  }
  ?>
  
  
  	
              
      
			</div>
			<!-- @End Bloc Content -->
		
		</div>
		<!-- @End Bloc mainContainer -->
   
