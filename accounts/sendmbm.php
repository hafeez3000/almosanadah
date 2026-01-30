<?

include("../db/db.php"); 

$accn = $_GET['accn'];
$fd = $_GET['fd'];
$td = $_GET['td'];

require_once('../emails/htmlMimeMail5.php');
set_time_limit(9000);    
$mail = new htmlMimeMail5();
 
include ("../emails/esset.php");


$mail->setSMTPParams( $host, $port, $host, $auth, $user, $pass) ;

$mail->setFrom('DORS - Accounts <accounts@daralmanasek.com>');

$subject_s = "Request for Payment Dated: " . date("r")." (GMT)"; 	

$mail->setSubject($subject_s);
    
$mail->setHeader('X-Mailer', 'Dar Al Manasek Tourism & Umrah');

$mail->setRRT('receipts@daralmanasek.com');
$mail->setNRUDT('receipts@daralmanasek.com');

$mail->setPriority('high');

$mail->setText('Request for Payment');


$query_hotel ="select aname,country,email from agentsdet where acccode='$accn'";

$result_hotel = pg_query($conn, $query_hotel);

if (!$result_hotel) {
	echo "An error occured.\n";
	exit;
	}
while ($rows_hotel = pg_fetch_array($result_hotel)){

$agent_name = $rows_hotel["aname"];
$agent_country = $rows_hotel["country"];
$agent_email = $rows_hotel["email"];


}

pg_free_result($result_hotel);









$ch = curl_init(); 

curl_setopt($ch,CURLOPT_URL,"http://bo.daralmanasek.com/dorsERP/accounts/printledgeragents.php");
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch,CURLOPT_POSTFIELDS,"acc=$accn&fd=$fd&td=$td");
curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);

$htmls = "ehtml/".$accn."agentsledger.html";

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
//$agent_email="admin@daralmanasek.com";
$result =  $mail->send(array($agent_email), 'smtp');
}



if($result){
	echo "<center>Habibi!  Agent Ledger has been send successfull!</center>";
    unlink($htmls);
	echo "<script>setTimeout('self.close()',2000);</script>";
}
else{
unlink($htmls);
echo "<center>Habibi! Error !  Email Could not send</center>";
}

?>