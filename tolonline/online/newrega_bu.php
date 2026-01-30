<html>
<center>
<body>

<?php 

include("../db/db.php"); 
$verify = md5(time());
session_start();

   if( $_SESSION['security_code'] == $_POST['security_code'] && !empty($_SESSION['security_code'] ) ) {
		// Insert you code for processing the form here, e.g emailing the submission, entering it into a database. 
	
     include ("gprocessing.html");  	

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

$user_id=$_POST['user_id'];

 $uid = strtolower($user_id);

$user_password=$_POST['user_password'];
$user_title=$_POST['user_title'];
$user_first_name=$_POST['user_first_name'];
$user_last_name=$_POST['user_last_name'];
$designation=$_POST['designation'];
$company_name=$_POST['company_name'];
$iata_number=$_POST['iata_number'];
$addr1=$_POST['addr1'];
$addr2=$_POST['addr2'];
$po_box=$_POST['po_box'];
$zip_code=$_POST['zip_code'];
$city=$_POST['city'];
$country=$_POST['country'];
$tel1=$_POST['tel1'];
$tel2=$_POST['tel2'];
$mobile=$_POST['mobile'];
$fax=$_POST['fax'];
$email=$_POST['email'];
$web=$_POST['web'];
$reg_date=$_POST['reg_date'];

$query_gsno ="select user_id from users where LOWER(user_id)='$uid'";

$result_gsno = pg_query($query_gsno);

$hid_c = pg_num_rows($result_gsno);

pg_free_result($result_gsno);


if($hid_c>0){ echo "<script>document.location.href=\"newreg.php\"</script>"; }
else{

$query_hotel ="insert into users(user_sno,user_id,user_password,user_title,user_first_name,user_last_name,designation,company_name,iata_number,addr1,addr2,po_box,zip_code,city,country,tel1,tel2,mobile,fax,email,web,reg_date,email_active_c) values ($u_sno,'$user_id','$user_password','$user_title','$user_first_name','$user_last_name','$designation','$company_name','$iata_number','$addr1','$addr2','$po_box','$zip_code','$city','$country','$tel1','$tel2','$mobile','$fax','$email','$web','now()','$verify')";
pg_query($query_hotel);
						

									
$sequpdateg_rate_sno = "update seq set users=$u_sno";
pg_query($sequpdateg_rate_sno);





require_once('../../emails/htmlMimeMail5.php');
set_time_limit(900);    
$mail = new htmlMimeMail5();
 
include ("../../emails/esset.php");


$mail->setSMTPParams( $host, $port, $host, $auth, $user, $pass) ;

$mail->setFrom('DORS - Admin <admin@daralmanasek.com>');

$subject_s = "DORS - New User Registration at : " . date("r")." (GMT)"; 	

$mail->setSubject($subject_s);
    
$mail->setHeader('X-Mailer', 'Dar Al Manasek Tourism & Umrah Services Co Ltd');

$mail->setRRT('receipts@daralmanasek.com');
$mail->setNRUDT('receipts@daralmanasek.com');

$mail->setPriority('high');

$mail->setText($subject_s);

    
$stext='Salamo alaikum' . $user_first_name .'!Thank you for registering at daralmanasek.com. We have been received your registration with userid ::' . $uid . ', and inorder to activate userid please click on the link  http://www.daralmanasek.com/dorsERP/dors/online/verify.php?uid='.$uid.'&verify='.$verify.' Note: If you have problem in viewing this email,please ENCODE the character set to UNICODE ( UTF-8 ). Keep doing online bookings in smart way to save time and money - Dar Al Manasek - Virtually go anyware in Kindom of Saudi Arabia';


//$body = $mail->getFile('./email/support.html');
$body = <<<ENDH

<html>
<head>
<title>DAR AL MANASEK - Userid Activation Center</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<center>
<body>
<table width="100%" align="center" cellpadding="0" cellspacing="0" >
<tr>
      <td colspan="2" style="border-bottom: 1px solid #FF0000;"><a href="http://www.daralmanasek.com" ><img src="logo.jpg" border="0"></a></td>
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

	
	
//$mail->setHTML($body);
    
//$mail->addEmbeddedImage(new fileEmbeddedImage('logo20548.jpg'));

$mail->setHTML($body , $stext);
    
$mail->addEmbeddedImage(new fileEmbeddedImage('logo.jpg'));





$result =  $mail->send(array($email), 'smtp');
		
			
			if (!$result) {
			print_r($mail->errors);
		} else {
//			echo 'Successfully Mail sent to ==>' .	$atoadd[$i] . '<br>';
		}

sleep(5);
$mail->setFrom($user_first_name .'<'.$email.'>');
$result2 =  $mail->send(array("admin@daralmanasek.com"), 'smtp');








 echo "<script>document.location.href=\"newregas.php\"</script>";
}




		unset($_SESSION['security_code']);
   } else {
		// Insert your code for showing an error message here
		echo '<b>Sorry, you have provided an invalid security code</b><br><br>';
 
		echo '<a href="newreg.php"> Try Again with correct code </a>';
   }

?>


</body>
</center>
</html>