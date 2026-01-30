
<?

include("../db/db.php"); 

$accn = $_GET['pnr'];



require_once('../emails/htmlMimeMail5.php');
set_time_limit(900);    
$mail = new htmlMimeMail5();
 
include ("../emails/esset.php");


$mail->setSMTPParams( $host, $port, $host, $auth, $user, $pass) ;

$mail->setFrom('DORS - Reservation <res@daralmanasek.com>');

$subject_s = "PNR: ".$accn ." - Booking Confirmation - Dated: " . date("r")." (GMT)"; 	

$mail->setSubject($subject_s);
    
$mail->setHeader('X-Mailer', 'Dar Al Manasek Tourism & Umrah');

$mail->setRRT('receipts@daralmanasek.com');
$mail->setNRUDT('receipts@daralmanasek.com');

$mail->setPriority('high');

$mail->setText($subject_s);


$query_hotel ="select cus_company_name,cus_country,cus_email from sales_main where ocode='$accn'";

$result_hotel = pg_query($conn, $query_hotel);

if (!$result_hotel) {
	echo "An error occured.\n";
	exit;
	}
while ($rows_hotel = pg_fetch_array($result_hotel)){

$agent_name = $rows_hotel["cus_company_name"];
$agent_country = $rows_hotel["cus_country"];
$agent_email = $rows_hotel["cus_email"];


}

pg_free_result($result_hotel);









$ch = curl_init(); 

curl_setopt($ch,CURLOPT_URL,"http://bo.daralmanasek.com/dorsERP/umrah/printconffemail.php");
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch,CURLOPT_POSTFIELDS,"pnr=$accn");
curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);

$htmls = "ehtml/".$accn."emailconf.html";

$fp = fopen($htmls, "w");
curl_setopt($ch, CURLOPT_FILE, $fp);
curl_setopt($ch, CURLOPT_HEADER, 0);
$result = curl_exec($ch);
curl_close($ch);
fclose($fp);

$body = $mail->getFile($htmls);


$mail->setHTML($body);
    

$mail->addEmbeddedImage(new fileEmbeddedImage('logo.jpg'));
$mail->addEmbeddedImage(new fileEmbeddedImage('arname350.jpg'));


$result=0;

if($agent_email==""){
echo "<div><font  color=\"#FF0000\" size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";
echo $ii=$i+1 .') Unable to send mail to ==> ' .	$agent_email . ' (' . $agent_name . ",".$agent_country .')</font></div>';
$result=0;
}
else {
//echo $agent_email;
//$agent_email="admin@daralmanasek.com";
//$agent_email="hafeez3000@yahoo.com";

$result =  $mail->send(array($agent_email), 'smtp');
}



if($result){
	echo "<center>Habibi!  Email Confirmation has been send successfull!</center>";
    unlink($htmls);
	echo "<script>setTimeout('self.close()',2000);</script>";
}
else{
unlink($htmls);
echo "<center>Habibi! Error !  Email Could not send</center>";
}


?>