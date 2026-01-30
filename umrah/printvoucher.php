<? 

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// is the one accessing this page logged in or not?
if (!isset($_SESSION['db_is_logged_in_umrah']) 
   || $_SESSION['db_is_logged_in_umrah'] !== true) {

   // not logged in, move to login page
   header('Location: login.php');
   exit;
}
$suserid = $_SESSION["userid"];


include("../db/db.php");

include("enc.php");
$passworda = 'dorserp password';

?>
<head><title>Sohulat Al Safar Umrah Services - Voucher</title>

 


<META HTTP-EQUIV="imagetoolbar" CONTENT="no">

<script language="javascript">
function noClick() {
if ((event.button==1)||(event.button==2)) {
alert('You cannot click on this page - neither mouse button will work.')
}
}
document.onmousedown=noClick
</script>
<SCRIPT>
<!--
javascript:window.history.forward(1);
//-->
</SCRIPT>

<SCRIPT>
document.onkeydown = function ()
{
if (122 == event.keyCode)
{
event.keyCode = 0;
return false;
}
}
</SCRIPT>


</head>
<center>
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" ondragstart="return false" onselectstart="return false">




<?

include("../db/db.php");


 $s_pnr = $_GET['spnr'];


 $q_main_sel ="select main_sno,ocode,user_sno,user_id,guest_title,guest_name,guest_notes,order_date,option_date,cus_account_code,cus_title,cus_name,cus_company_name,cus_country,cus_contact,cus_email,agent_notes,sales_hotels,sales_trans,sales_visa,sales_others from sales_main where ocode='$s_pnr'";

$main_sel = pg_query($conn, $q_main_sel);

$rows_main = pg_num_rows($main_sel);

if (!$main_sel) {
echo "An error occured.\n";
exit;
		}

while ($rows_main = pg_fetch_array($main_sel)){

$s_user_id = $rows_main["user_id"];
$s_guest_title = $rows_main["guest_title"];
$s_guest_name = $rows_main["guest_name"];
//$s_guest_telno = $rows_main["guest_telno"];
$s_guest_notes = $rows_main["guest_notes"];
$s_order_date = $rows_main["order_date"];
$s_option_date = $rows_main["option_date"];
$s_cus_account_code = $rows_main["cus_account_code"];
$s_cus_title = $rows_main["cus_title"];
$s_cus_name = $rows_main["cus_name"];
$s_cus_company_name = $rows_main["cus_company_name"];
$s_cus_country = $rows_main["cus_country"];
$s_cus_fax = $rows_main["cus_contact"];
$s_cus_email = $rows_main["cus_email"];
$s_agent_notes = $rows_main["agent_notes"];
$s_sales_hotels = $rows_main["sales_hotels"];
$s_sales_trans = $rows_main["sales_trans"];
$s_sales_visa = $rows_main["sales_visa"];
$s_sales_others = $rows_main["sales_others"];

$s_main_sno = $rows_main["main_sno"];
}

$gnamewt = $s_guest_title.". ".$s_guest_name;


$gnamewt1 = md5_encrypt($gnamewt, $passworda,16);
$gnamewt = urlencode($gnamewt1);




$q_u_det ="select user_first_name, user_last_name from users where user_id='$suserid'";

$u_sel = pg_query($conn, $q_u_det);

if (!$u_sel) {
echo "An error occured.\n";
exit;
		}

while ($rows_u_sel = pg_fetch_array($u_sel)){

 $s_user_first_name = $rows_u_sel["user_first_name"];

 $s_user_last_name = $rows_u_sel["user_last_name"];
}



if($s_sales_hotels=="t") {  
?>





<?
$hrid=0;

$q_hotel_sel ="select sales_hotels_sno,user_sno,hotel_id,room_id,cin,cout,no_rooms,no_nights,no_paxs,sell_rate,booking_status,hotel_confirmation_no  from sales_hotels where ocode='$s_pnr' order by sales_hotels_sno";

$res_hotel_sel = pg_query($conn, $q_hotel_sel);

$rows_hotels = pg_num_rows($res_hotel_sel);

if (!$res_hotel_sel) {
echo "An error occured.\n";
exit;
		}

while ($rows_hotel_sel = pg_fetch_array($res_hotel_sel)){
$s_hotels_sno = $rows_hotel_sel["sales_hotels_sno"];
$s_user_sno = $rows_hotel_sel["user_sno"];
$s_hotel_id = $rows_hotel_sel["hotel_id"];
$s_room_id = $rows_hotel_sel["room_id"];
$s_cin = $rows_hotel_sel["cin"];
$s_cout = $rows_hotel_sel["cout"];
$s_no_rooms = $rows_hotel_sel["no_rooms"];
$s_no_nigths = $rows_hotel_sel["no_nights"];
$s_no_paxs = $rows_hotel_sel["no_paxs"];
$s_sell_rate = $rows_hotel_sel["sell_rate"];
//$s_room_sell_rate = $rows_meals_sel["room_sell_rate"];
$s_booking_status = $rows_hotel_sel["booking_status"];
$s_hotel_confirmation_no = $rows_hotel_sel["hotel_confirmation_no"];

$q_hotel_subsel ="select hotel_name, city from hotels where hotel_id='$s_hotel_id'";

$res_hotel_subsel = pg_query($conn, $q_hotel_subsel);

if (!$res_hotel_subsel) {
echo "An error occured.\n";
exit;
		}
while ($rows_hotel_subsel = pg_fetch_array($res_hotel_subsel)){

$s_hotel_name = $rows_hotel_subsel["hotel_name"];
$s_city = $rows_hotel_subsel["city"];
}

$q_rooms_subsel ="select  room_type from rooms where room_id='$s_room_id'";

$res_rooms_subsel = pg_query($conn, $q_rooms_subsel);

if (!$res_rooms_subsel) {
echo "An error occured.\n";
exit;
		}
while ($rows_rooms_subsel = pg_fetch_array($res_rooms_subsel)){

$s_room_type = $rows_rooms_subsel["room_type"];
}







$q_meals_sel ="select sales_meals_sno,sales_hotels_sno,sales_hot_meals_sno,user_sno,rate_date,room_id,breakfast,halfboard,fullboard,sahoor,iftar,room_net_rate,room_sell_rate,no_of_paxs,no_of_rooms,day_net_rate,day_sell_rate from sales_meals where sales_hotels_sno=$s_hotels_sno order by sales_meals_sno";

$res_meals_sel = pg_query($conn, $q_meals_sel);

if (!$res_meals_sel) {
echo "An error occured.\n";
exit;
		}

while ($rows_meals_sel = pg_fetch_array($res_meals_sel)){


$s_breakfast = $rows_meals_sel["breakfast"];
$s_halfboard = $rows_meals_sel["halfboard"];
$s_fullboard = $rows_meals_sel["fullboard"];
$s_sahoor = $rows_meals_sel["sahoor"];
$s_iftar = $rows_meals_sel["iftar"];

$s_date[] = $rows_meals_sel["rate_date"];
$s_rate[] = $rows_meals_sel["room_sell_rate"];
$st_rate[] = $rows_meals_sel["day_sell_rate"];

$s_rate_date = $rows_meals_sel["rate_date"];


$s_no_of_paxs = $rows_meals_sel["no_of_paxs"];
$s_no_of_rooms = $rows_meals_sel["no_of_rooms"];

$p_meals="";


if($s_breakfast=="N/A"){
}
else
{
//echo " X ";
//echo "B/F: $s_breakfast";
$p_meals = $p_meals . "   B/F: Yes" ;
}

if($s_halfboard=="N/A") {
}
else
{
//echo " X ";
//echo "H/B: $s_halfboard";
$p_meals = $p_meals . " +  H/B: Yes" ;
}

if($s_fullboard=="N/A") {
}
else
{
//echo " X ";
//echo "F/B: $s_fullboard";
$p_meals = $p_meals . " +  F/B: Yes" ;
}

if($s_sahoor=="N/A") {
}
else
{
//echo " X ";
//echo "SAH: $s_sahoor";
$p_meals = $p_meals . " +  SAH: Yes" ;
}

if($s_iftar=="N/A") {
}
else
{
//echo " X ";
//echo "IFT: $s_iftar";
$p_meals = $p_meals . " +  IFT: Yes" ;
}


}	

if($p_meals==""){
$p_meals = "Room Only";
}


?>
<br>
<table width="98%" border="0" cellspacing="0" cellpadding="2" style="border: 1px solid black;" >
<tr><td valign="top">
<?
include ("printheadvou.php");
?>
</td>
<td style="border-left: 1px solid #999999;">

<table width="100%" border="0" cellspacing="0" cellpadding="0"><tr>
<td align="right"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Voucher:</font></td><td><font size="2" face="Verdana, Arial, Helvetica, sans-serif"> <? echo $invn = $s_main_sno."-H-".$s_hotels_sno; ?></font>
</td></tr>



<tr>

<td align="right"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">PNR:</font></td><td><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><? echo $s_pnr; ?></font>
</td>
</tr>

<? if($s_hotel_confirmation_no==""){ } else { ?>

<tr>

<td align="right"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">HTL Conf:</font></td><td><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><? echo $s_hotel_confirmation_no; ?></font>
</td>
</tr>


<?}?>

</table>
</td>
</tr>


<?

echo "<tr><td colspan=\"2\" ><table border=\"0\" width=\"100%\" style=\"border-top: 1px solid #999999;border-bottom: 1px solid #999999;\">";

echo "<tr><td><div align=\"left\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">Check In:  ". date('D, jS M, Y', strtotime($s_cin))."</font></div></td>";

echo "<td ><div align=\"left\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">Hotel: $s_hotel_name </font></div></td>";

echo "<td ><div align=\"left\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">City:  $s_city</font></div></td>";

echo "</tr>";

echo "<tr >";

echo "<td ><div align=\"left\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">Check Out: " . date('D, jS M, Y', strtotime($s_cout)) . " </font></div></td>";

echo "<td><div align=\"left\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">Room Type:$s_no_of_rooms X $s_room_type</font></div></td>";

echo "<td><div align=\"left\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">Meals: $p_meals</font></div></td>";

echo "</tr>";

echo "</td></tr></table></td></tr>";


echo "<tr><td align=\"center\" colspan=\"2\"><table border=\"0\" width=\"100%\" style=\"border-bottom: 1px solid #999999;\" ><tr><td align=\"center\">";

 
 $enc_text = md5_encrypt($invn, $passworda,16);
 $enc_text = urlencode($enc_text);




echo "<img src=\"barcode.php?barcode=" . $enc_text ."&gname=" .$gnamewt."\">";



echo "</td>";

echo "<td align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">SEAL & SIGNATURE</font></td>"; 


echo "</tr></table></td></tr>";

?>

<tr>
<td colspan="2">

<table width="100%"><tr><td>
<font size="2" face="Verdana, Arial, Helvetica, sans-serif">Issued:<?echo  date("r")." (GMT)"; ?></font>
</td>
<td align="center"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><? echo $s_user_first_name ." " . $s_user_last_name ?><br>Prepared By</font>
</td></tr>
</table>

</td>
</tr>


</table>
<br>
<?







if ($rows_hotels - $hrid > 1){
echo "<p style=\"page-break-before: always\">";
}

$hrid++;


} //end of hotel while





}
?>





<?
if($s_sales_trans=="t") {  

echo "<p style=\"page-break-before: always\">";

?>


<?
$traid=0;
$q_trans_sel ="select sales_trans_sno,req_date_time,f2t,type_of_trans,no_of_units,no_of_paxs,flight_det,sell_rate,tot_sell_rate,booking_status  from sales_trans where ocode='$s_pnr'  order by sales_trans_sno";

$res_trans_sel = pg_query($conn, $q_trans_sel);

 $rows_trans = pg_num_rows($res_trans_sel);

if (!$res_trans_sel) {
echo "An error occured.\n";
exit;
		}

if($rows_trans>0){


}
while ($rows_trans_sel = pg_fetch_array($res_trans_sel)){

$s_sales_trans_sno = $rows_trans_sel["sales_trans_sno"];
	
$s_req_date_time = $rows_trans_sel["req_date_time"];
$s_f2t = $rows_trans_sel["f2t"];
$s_type_of_trans = $rows_trans_sel["type_of_trans"];
$s_no_of_units = $rows_trans_sel["no_of_units"];
$s_no_of_paxs = $rows_trans_sel["no_of_paxs"];
$s_flight_det = $rows_trans_sel["flight_det"];
$s_sell_rate = $rows_trans_sel["sell_rate"];
$s_tot_sell_rate = $rows_trans_sel["tot_sell_rate"];
$s_booking_status = $rows_trans_sel["booking_status"];



?>


<br>
<table width="98%" border="0" cellspacing="0" cellpadding="2" style="border: 1px solid black;" background="../images/design.jpg">
<tr><td valign="top">
<?
include ("printheadvou.php");
?>
</td>
<td style="border-left: 1px solid #999999;">

<table width="100%" border="0" cellspacing="0" cellpadding="0"><tr>
<td align="right"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Voucher:</font></td><td><font size="2" face="Verdana, Arial, Helvetica, sans-serif"> <? echo $invn = $s_main_sno."-T-".$s_sales_trans_sno; ?></font>
</td></tr>

<tr>

<td align="right"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">PNR:</font></td><td><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><? echo $s_pnr; ?></font>
</td>
</tr>


</table>
</td>
</tr>


<?

echo "<tr><td colspan=\"2\"><table width=\"100%\" cellpadding=\"0\" cellspacing=\"0\">";

echo "<tr><td style=\"border-top: 1px solid #999999;border-right: 1px solid #999999;border-bottom: 1px solid #999999 \"><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">From - To</font></div></td><td style=\"border-top: 1px solid #999999;border-right: 1px solid #999999;border-bottom: 1px solid #999999 \"><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">Units</font></div></td><td style=\"border-top: 1px solid #999999;border-right: 1px solid #999999;border-bottom: 1px solid #999999 \"><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">Type of Trans</font></div></td><td style=\"border-top: 1px solid #999999;border-right: 1px solid #999999;border-bottom: 1px solid #999999 \"><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">Date & Time</font></div></td><td style=\"border-top: 1px solid #999999;border-right: 1px solid #999999;border-bottom: 1px solid #999999 \"><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">Flight Details</font></div></td><td style=\"border-top: 1px solid #999999;border-bottom: 1px solid #999999 \"><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">Paxs</font></div></td></tr>";

echo "<tr><td style=\"border-bottom: 1px solid #999999;border-right: 1px solid #999999 \"><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";

echo "$s_f2t";
echo "</font></div></td>";

echo "<td style=\"border-bottom: 1px solid #999999;border-right: 1px solid #999999 \"><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";
echo $s_no_of_units;
echo "</font></div></td>";
echo "<td style=\"border-bottom: 1px solid #999999;border-right: 1px solid #999999 \"><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";
echo $s_type_of_trans;
echo "</font></div></td>";
echo "<td style=\"border-bottom: 1px solid #999999;border-right: 1px solid #999999 \"><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";
echo date('D, jS M, Y H:i A', strtotime($s_req_date_time));
echo "</font></div></td>";
echo "<td style=\"border-bottom: 1px solid #999999;border-right: 1px solid #999999 \"><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";

if($s_flight_det==""){ echo "&nbsp;";} else {
echo $s_flight_det; }

echo "</font></div></td>";
echo "<td style=\"border-bottom: 1px solid #999999 \"><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";
echo $s_no_of_units*$s_no_of_paxs;
echo "</font></div></td></tr>";

echo "</td></tr></table>";

echo "<tr><td align=\"center\" colspan=\"2\"><table border=\"0\" width=\"100%\" style=\"border-bottom: 1px solid #999999;\" ><tr><td align=\"center\">";


 $enc_text = md5_encrypt($invn, $passworda,16);
 $enc_text = urlencode($enc_text);




echo "<IMG SRC=\"barcode.php?barcode=" . $enc_text ."&gname=" .$gnamewt."\">";



echo "</td>";

echo "<td align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">SEAL & SIGNATURE</font></td>"; 


echo "</tr></table></td></tr>";

?>

<tr>
<td colspan="2">

<table width="100%"><tr><td>
<font size="2" face="Verdana, Arial, Helvetica, sans-serif">Issued:<?echo  date("r")." (GMT)"; ?></font>
</td>
<td align="center"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><? echo $s_user_first_name ." " . $s_user_last_name ?><br>Prepared By</font>

</td></tr>
</table>

</td>
</tr>


</table>
<br>

<?

if ( $rows_trans - $traid > 1){
echo "<p style=\"page-break-before: always\">";
}


$traid++;

}


?>


<?
}
?>






</body>
</center>
</html>
