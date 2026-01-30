<?
include ("header.php");
?>

<script src="../javascripts/cBoxes.js"></script>
<? $vy=$vm=$vd=0; 
$vy1=$vm1=$vd1=0;
?>

<script>
document.title= '<? echo $company_name . " ERP - Cases"; ?>';
</script>


<html>
<link rel="stylesheet" type="text/css" href="../calendar/css.css" />
<head>
<script>
 var winl = (screen.width - 700) / 2; 
 var wint = (screen.height - 500) / 2;
</script>
</head>
<body leftmargin="0" topmargin="0" rightmargin="0">
<table width="100%" border="0" cellpadding="0" cellspacing="0" style="border-bottom: 1px solid #999999 ;border-left: 3px solid #006600;border-right: 3px solid #006600"><tr>
    <td bgcolor="#CCCCCC"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">&nbsp;You 
      are here: <a href="uhome.php">Home</a> &raquo; Cases  &raquo; Create Cases</font></td>
  </tr></table>
  
<table width="100%" border="0" cellpadding="0" cellspacing="0" style="border-bottom: 3px solid #006600; border-right: 3px solid #006600;border-left: 3px solid #006600 ">
  <tr>
    <td width="20%" style="border-right: 1px solid #999999"  valign="top"> <table width="100%" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td valign="top"><div align="left"> 
              <?include ("umenu.php"); ?>
            </div></td>
        </tr>
      </table></td>
    <td width="80%" valign="top"  > <table width="100%" border="0" cellpadding="0" cellspacing="1">
        <tr>
          <td valign="top"> 
           
			


			
            <table width="100%" cellpadding="0" cellspacing="0" ><tr><td width="85%" valign="top"> 
			<table cellpadding="0" cellspacing="0" width="100%" style="border-top: 1px solid #999999; border-bottom: 1px solid #999999"><tr>
                      <td bgcolor="#CCCCCC"><strong>Creating Case</strong></td>
                    </tr></table>
<table width="100%" cellpadding="1" cellspacing="0"><tr>
                      <td> <br><br><br>
                          <? 
include ("gprocessing.html"); 


$cases_priority =$_POST['cases_priority'];
$cases_status =$_POST['cases_status'];

$cases_subject =$_POST['cases_subject'];
$cases_desc =$_POST['cases_desc'];
//$cases_resol =$_POST['cases_resol'];



$sqlins_case = "insert into cases (subject,date_entered,created_by,description,status,priority,user_sno ) values ('$cases_subject', 'now' , $suser_sno, '$cases_desc', '$cases_status', '$cases_priority', $suser_sno) ";

pg_query($sqlins_case);



$ol_email = $_SESSION['ol_email'];

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

$subject_s = "DORS - Case Created : " . date("r")." (GMT)"; 
//Create a message

$e_body = <<<ENDH

<table  cellpadding="3" cellspacing="3" border="1" align="center">
	<tr >
		<td colspan="2" align="center"><img src="http://www.dheyafataj.com/dorsERP/dors/online/logo.jpg"></td>
	</tr>
	<tr >
		<td colspan="2" align="left"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Case Details</b></font></td>
	</tr>
	<tr> 
		<td width="17%" style="border-right: 1px solid #999999" ><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Subject </font></td>
		<td ><font size="2" face="Verdana, Arial, Helvetica, sans-serif"> $cases_subject </font></td>
	</tr>
	<tr> 
		<td width="17%" style="border-right: 1px solid #999999" ><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Description </font></td>
		<td ><font size="2" face="Verdana, Arial, Helvetica, sans-serif"> $cases_desc</font></td>
	</tr>
</table>

ENDH;



$message = Swift_Message::newInstance($subject_s)
  ->setFrom(array('deyafahsales@gmail.com' => 'DORS - Reservation'))
  ->setTo(array($ol_email))
  ->setBody($e_body, 'text/html')
  ;

$message1 = Swift_Message::newInstance($subject_s)
  ->setFrom(array('deyafahsales@gmail.com' => 'DORS - Reservation'))
  ->setTo('ceo@dheyafataj.com')
  ->setBody($e_body, 'text/html')
  ;  
//Send the message
$result = $mailer->send($message);


$mailer1->send($message1);


		
if (!$result) {
			print_r($mail->errors);
		} else {
//echo 'Successfully Mail sent to ==>' .	$ol_email . '<br>';

}

 echo "<script> document.location.href=\"listcases.php\" </script>" ;  
?>


		
							

					  </td>
                            </tr>
                          </table>
                         </td>
                    </tr></table>									
					
			</td> 
              </tr></table> </td>
        </tr>
      </table></td></tr>
	  
	  
      </table> 
</table>	
	
	

	</tr></table>



<script>
function fun2(theForm){




 if ((document.bbyod.cases_subject.value== null) ||   ((document.bbyod.cases_subject.value).length==0))
   {
      alert ("Sorry, But enter subject for Case/Bug");
	  document.bbyod.cases_subject.focus();
	  		return false;
   }

 if(document.bbyod.cases_desc.value=="")
   {
      alert ("Sorry, But enter Description for Case/Bug");
	  document.bbyod.cases_desc.focus();
	  		return false;
   }




}
</script>

</body>				
</html>
