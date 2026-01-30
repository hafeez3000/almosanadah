<?
session_start();

// is the one accessing this page logged in or not?
if (!isset($_SESSION['db_is_logged_in_online']) 
   || $_SESSION['db_is_logged_in_online'] !== true) {

   // not logged in, move to login page
   header('Location: login.php');
   exit;
}
$suserid = $_SESSION["userid"];
$suser_sno = $_SESSION["user_sno"];
$dept = $_SESSION["deptsr"];

include("../db/db.php"); 
include ("../conf/mainconf.php");
?>
<html>
<center>
<body leftmargin="0" topmargin="0" rightmargin="0">
<table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0" style="border-top: 5px solid #006600 ;border-bottom: 5px solid #006600 ;border-left: 5px solid #006600;border-right: 5px solid #006600"><tr><td valign="top">


<?


$body = $_POST["e_body"];




$gtitle = $_POST["gtitle"];
$guestname = $_POST["guestname"];
$ol_c_n = $_POST["ol_c_n"];
$ol_country = $_POST["ol_country"];
$ol_email = $_POST["ol_email"];
$cin = $_POST["cin"];
$cout = $_POST["cout"];
$hotel_name = $_POST["hotel_name"];
$city = $_POST["city"];
$room_type = $_POST["room_type"];
$no_of_rooms = $_POST["no_of_rooms"];
$no_of_paxs = $_POST["no_of_paxs"];
$meals = $_POST["meals"];


 $e_body1 = <<<ENDH

<table  cellpadding="3" cellspacing="3" border="1" align="center">
                                
								   
									<tr >
                            <td colspan="2" align="center"><img src="http://www.daralmanasek.com/dorsERP/dors/online/logo.jpg"></td>
                          </tr>

								   <tr >
                            <td colspan="2" align="left"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Guest Details</b></font></td>
                          </tr>
	
							 

								  <tr> 
                                    <td width="17%" style="border-right: 1px solid #999999" ><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Guest Name </font></td>
                                    <td ><font size="2" face="Verdana, Arial, Helvetica, sans-serif"> $gtitle .  $guestname </font></td>
                                  </tr>
								   <tr> 
                                    <td width="17%" style="border-right: 1px solid #999999" ><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Travel Agent </font></td>
                                    <td ><font size="2" face="Verdana, Arial, Helvetica, sans-serif"> $ol_c_n - $ol_country </font></td>
                                  </tr>
                  <tr> 
                    <td width="17%" style="border-right: 1px solid #999999" ><font size="2" face="Verdana, Arial, Helvetica, sans-serif">From email </font></td>
                    <td ><font size="2" face="Verdana, Arial, Helvetica, sans-serif"> $ol_email </font></td>
                  </tr>
								  <td colspan="2" align="center">&nbsp;</td>
                          </tr>




ENDH;


$e_body = $e_body1 . $body;

/*add a record to emailrequests table*/
$sendrreqa = "INSERT INTO emailrequests(user_sno, guest_title, guest_name, cin, cout, hotel_name, city, room_type, no_of_rooms, no_of_paxs, meals, created_at, status, email) VALUES ($suser_sno, '$gtitle', '$guestname', '$cin', '$cout', '$hotel_name', '$city', '$room_type', $no_of_rooms, $no_of_paxs, '$meals', 'now()', 'New', '$ol_email')";
pg_query($sendrreqa);
/*END - add a record to emailrequests table*/

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

$subject_s = "DORS - New Email Request : " . date("r")." (GMT)"; 
//Create a message


$message = Swift_Message::newInstance($subject_s)
  ->setFrom(array('res@daralmanasek.com' => 'DORS - Reservation'))
  ->setTo(array($ol_email))
  ->setBody($e_body, 'text/html')
  ;

$message1 = Swift_Message::newInstance($subject_s)
  ->setFrom(array('res@daralmanasek.com' => 'DORS - Reservation'))
  ->setTo('res@daralmanasek.com')
  ->setBody($e_body, 'text/html')
  ;  
//Send the message
$result = $mailer->send($message);


$mailer1->send($message1);


		
if (!$result) {
			print_r($mail->errors);
		} else {
echo 'Successfully Mail sent to ==>' .	$ol_email . '<br>';
echo "<script>document.location.href=\"sendrreqaf.php\"</script>";
		}		
		
?>





</td></tr></table>

</body>
</center>
</html>

