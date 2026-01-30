<? include ("printhead.php");
include("../db/db.php");  ?>
<html>
<head><title>DORS - Confirmation</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>

<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<center>

<table width="97%" border="0" cellspacing="0" cellpadding="0" ><tr><td>

<table width="100%" border="0" cellspacing="0" cellpadding="0" >
<tr><td><img src="../images/space.jpg"></td></tr>
<tr>
      <td  align="center" ><font face="Arial, Helvetica, sans-serif"><strong>BOOKING CONFIRMATION - NET RATE</strong></font></td>
    </tr></table>

<?
$s_pnr = $_GET['spnr'];

$s_date = array();
$s_rate = array();
$s_rate_u = array();
$s_final = array();



$q_main_sel ="select main_sno,ocode,user_sno,user_id,guest_title,guest_name,guest_notes,order_date,option_date,cus_account_code,cus_title,cus_name,cus_company_name,cus_country,cus_contact,cus_email,agent_notes,sales_hotels,sales_trans,sales_visa,sales_others from sales_main where ocode='$s_pnr'";

$main_sel = pg_query($q_main_sel);

$rows_main = pg_num_rows($main_sel);

if (!$main_sel) {
echo "An error occured.\n";
exit;
		}

while ($rows_main = pg_fetch_array($main_sel)){

$s_user_id = $rows_main["user_id"];
$s_guest_title = $rows_main["guest_title"];
$s_guest_name = $rows_main["guest_name"];
$s_guest_telno = $rows_main["guest_telno"];
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

?>







<? 
echo "<table width=\"95%\" align=\"center\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" >";

echo "<tr><td align=\"left\" ><font size=\"4\" face=\"Verdana, Arial, Helvetica, sans-serif\">";

echo "PNR:  ";

echo  $s_pnr;

echo "</font></td>";

echo "<td align=\"right\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";

echo "To: " . $s_cus_company_name . ", " . $s_cus_country ;

echo "</font></td></tr>";


echo "<tr><td align=\"left\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";

echo "Order Date:  ";
echo date('jS M, Y', strtotime($s_order_date)) ;

echo "</font></td>";

echo "<td align=\"right\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";

echo "Attn: " . $s_cus_title . ". ". $s_cus_name;

echo "</font></td></tr>";



echo "<tr><td align=\"left\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";

echo "Guest Name:  ";
echo  "<b>" .$s_guest_title .". " .strtoupper($s_guest_name) ."</b>";

echo "</font></td>";

echo "<td align=\"right\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";

echo " Email: $s_cus_email <br>  Fax: $s_cus_fax";

echo "</font></td></tr>";

echo "<tr><td colspan=\"2\"><font size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\">Dear Sir, <br>Thank you for kind co-operation towards us and your request is treated as highly valuable. Further as per your reservation request(s), we confirm the same on definite circumstances with the following details.</font></td></tr>"; 

echo "</table>";

?>

<?

if($s_sales_hotels=="t") {  
?>
<br>
<table width="100%" border="0" cellspacing="0" cellpadding="0" style="border-top: 1px solid #999999;">
<tr><td  width="10%" align="center" style="border-bottom: 1px solid #999999;border-left: 1px solid #999999;border-right: 1px solid #999999 "><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Hotels</font></td><td >&nbsp;</td></tr>
<tr><td colspan="2">

<table width="95%" border="0" cellspacing="0" cellpadding="0" align="center">
<?
$s_sno=1;
$tot_hot=0;
$g_tot=0;



$q_hotel_sel ="select sales_hotels_sno,user_sno,hotel_id,room_id,cin,cout,no_rooms,no_nights,no_paxs,net_rate,booking_status  from sales_hotels where ocode='$s_pnr' order by sales_hotels_sno";

$res_hotel_sel = pg_query($q_hotel_sel);

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
$s_sell_rate = $rows_hotel_sel["net_rate"];
$s_room_sell_rate = $rows_meals_sel["room_net_rate"];
$s_booking_status = $rows_hotel_sel["booking_status"];

$q_hotel_subsel ="select hotel_name, city from hotels where hotel_id=$s_hotel_id";

$res_hotel_subsel = pg_query($q_hotel_subsel);

if (!$res_hotel_subsel) {
echo "An error occured.\n";
exit;
		}
while ($rows_hotel_subsel = pg_fetch_array($res_hotel_subsel)){

$s_hotel_name = $rows_hotel_subsel["hotel_name"];
$s_city = $rows_hotel_subsel["city"];
}

$q_rooms_subsel ="select  room_type from rooms where room_id=$s_room_id";

$res_rooms_subsel = pg_query($q_rooms_subsel);

if (!$res_rooms_subsel) {
echo "An error occured.\n";
exit;
		}
while ($rows_rooms_subsel = pg_fetch_array($res_rooms_subsel)){

$s_room_type = $rows_rooms_subsel["room_type"];
}

echo "<tr ><td ><div align=\"left\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><b>Sno: $s_sno</b></font></div></td>";

echo "<td ><div align=\"left\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">Check In:  ". date('D, jS M, Y', strtotime($s_cin))."</font></div></td>";

echo "<td ><div align=\"left\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">Hotel: $s_hotel_name </font></div></td>";

echo "<td ><div align=\"left\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">City:  $s_city</font></div></td>";

echo "</tr>";

echo "<tr ><td style=\"border-bottom: 1px dotted #999999;\"><div align=\"left\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">On</font></div></td>";

echo "<td ><div align=\"left\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">Check Out: " . date('D, jS M, Y', strtotime($s_cout)) . " </font></div></td>";

echo "<td><div align=\"left\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">Room Type: $s_room_type</font></div></td>";
echo "</tr>";


$st_rate="";

$q_meals_sel ="select sales_meals_sno,sales_hotels_sno,sales_hot_meals_sno,user_sno,rate_date,room_id,breakfast,halfboard,fullboard,sahoor,iftar,room_net_rate,room_net_rate,no_of_paxs,no_of_rooms,day_net_rate,day_net_rate from sales_meals where sales_hotels_sno=$s_hotels_sno order by sales_meals_sno";

$res_meals_sel = pg_query($q_meals_sel);

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
$s_rate[] = $rows_meals_sel["room_net_rate"];
$st_rate[] = $rows_meals_sel["day_net_rate"];

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
$p_meals = $p_meals . "   B/F: $s_breakfast" ;
}

if($s_halfboard=="N/A") {
}
else
{
//echo " X ";
//echo "H/B: $s_halfboard";
$p_meals = $p_meals . " +  H/B: $s_halfboard" ;
}

if($s_fullboard=="N/A") {
}
else
{
//echo " X ";
//echo "F/B: $s_fullboard";
$p_meals = $p_meals . " +  F/B: $s_fullboard" ;
}

if($s_sahoor=="N/A") {
}
else
{
//echo " X ";
//echo "SAH: $s_sahoor";
$p_meals = $p_meals . " +  SAH: $s_sahoor" ;
}

if($s_iftar=="N/A") {
}
else
{
//echo " X ";
//echo "IFT: $s_iftar";
$p_meals = $p_meals . " +  IFT: $s_iftar" ;
}


}	





$s_rate_u = $s_rate;
array_multisort($s_rate, $s_date);
$k=0;
for($i=0; $i<count($s_rate) ; $i++){
$s_final[current($s_rate)][$k] = $s_date[$i];
$k++;
if($s_rate[$i] != next($s_rate)){
$k=0;
}
}
$s_rate_u = array_unique($s_rate_u);
sort($s_rate_u);

for($i=0; $i<count($s_rate_u); $i++){
echo "<tr><td style=\"border-bottom: 1px dotted #999999;\"><div align=\"left\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";
$sv_final = $s_rate_u[$i];
$p=1;
for($j=0; $j<count($s_final[$sv_final]); $j++){

$a = $s_final[$sv_final][$j]; 
$b = $s_final[$sv_final][$j]; 
$c="";

if($p==1){
echo $c = date('j', strtotime($b)) ;
}

if( date('j', strtotime($a))+1 != date('j', strtotime(next($s_final[$sv_final]))) ){

if($c== date('j', strtotime($b)) ){

}
else{
echo "-";
echo date('j', strtotime($b)) ;
echo ",";
}
$p=1;

}
else{
$p=0;


}

}

if($p_meals==""){ $p_meals="Room Only" ;}

echo "</font></div></td><td ><div align=\"left\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">Rate/Night: ". $sv_final. "X Rooms:" . $s_no_of_rooms . "X Nights: $j"  ."</font></div></td>";
echo "<td colspan=\"2\"><div align=\"left\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">Paxs: " . $s_no_of_paxs . " X (" .$p_meals ." )";
echo "</td></tr>";

$tot_hot = array_sum($st_rate) + $tot_hot;
$st_rate = array();
}

echo "<tr><td colspan=\"2\" style=\"border-bottom: 1px dotted #999999;\"><div align=\"left\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">Invoice No:$s_main_sno-H-$s_hotels_sno</font></td><td colspan=\"2\" style=\"border-bottom: 1px dotted #999999;\"><div align=\"right\"><font size=\"3\" face=\"Verdana, Arial, Helvetica, sans-serif\">Net Rate: ". $tot_hot ."</font></div></td>";
echo "</tr>";




$s_sno++;

$s_date = array();
$s_rate = array();
$s_rate_u = array();
$s_final = array();

$g_tot = $g_tot + $tot_hot ;
$tot_hot=0;
} //end of hotel while




?>


</table>
</td></tr>
</table>

<?
}
?>


<?
if($s_sales_trans=="t") {  
?>

<br>
<table width="100%" border="0" cellspacing="0" cellpadding="0" style="border-top: 1px solid #999999;">
<tr><td  width="15%" align="center" style="border-bottom: 1px solid #999999;border-left: 1px solid #999999;border-right: 1px solid #999999 "><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Transportation</font></td><td >&nbsp;</td></tr>

<tr><td colspan="2">
<?

$q_trans_sel ="select sales_trans_sno,req_date_time,f2t,type_of_trans,no_of_units,no_of_paxs,flight_det,net_rate,tot_net_rate,booking_status  from sales_trans where ocode='$s_pnr'  order by sales_trans_sno";

$res_trans_sel = pg_query($q_trans_sel);

 $rows_trans = pg_num_rows($res_trans_sel);

if (!$res_trans_sel) {
echo "An error occured.\n";
exit;
		}

if($rows_trans>0){
echo "<table width=\"95%\" border=\"0\" cellpadding=\"2\" cellspacing=\"0\" align=\"center\"><tr><td style=\"border-top: 1px solid #999999;border-bottom: 1px solid #999999;border-left: 1px solid #999999;border-right: 1px solid #999999 \"><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">Invice No</font></div></td><td style=\"border-top: 1px solid #999999;border-right: 1px solid #999999;border-bottom: 1px solid #999999 \"><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">From - To</font></div></td><td style=\"border-top: 1px solid #999999;border-right: 1px solid #999999;border-bottom: 1px solid #999999 \"><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">Units</font></div></td><td style=\"border-top: 1px solid #999999;border-right: 1px solid #999999;border-bottom: 1px solid #999999 \"><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">Type of Trans</font></div></td><td style=\"border-top: 1px solid #999999;border-right: 1px solid #999999;border-bottom: 1px solid #999999 \"><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">Date & Time</font></div></td><td style=\"border-top: 1px solid #999999;border-right: 1px solid #999999;border-bottom: 1px solid #999999 \"><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">Flight Details</font></div></td><td style=\"border-top: 1px solid #999999;border-right: 1px solid #999999;border-bottom: 1px solid #999999 \"><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">Paxs</font></div></td><td style=\"border-top: 1px solid #999999;border-right: 1px solid #999999;border-bottom: 1px solid #999999 \"><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">Net Rate</font></div></td></tr>";


}
while ($rows_trans_sel = pg_fetch_array($res_trans_sel)){

$s_sales_trans_sno = $rows_trans_sel["sales_trans_sno"];
	
$s_req_date_time = $rows_trans_sel["req_date_time"];
$s_f2t = $rows_trans_sel["f2t"];
$s_type_of_trans = $rows_trans_sel["type_of_trans"];
$s_no_of_units = $rows_trans_sel["no_of_units"];
$s_no_of_paxs = $rows_trans_sel["no_of_paxs"];
$s_flight_det = $rows_trans_sel["flight_det"];
$s_sell_rate = $rows_trans_sel["net_rate"];
$s_tot_sell_rate = $rows_trans_sel["tot_net_rate"];
$s_booking_status = $rows_trans_sel["booking_status"];

$tot_amt = $tot_amt + $s_tot_sell_rate;

echo "<tr><td style=\"border-bottom: 1px solid #999999;border-left: 1px solid #999999;border-right: 1px solid #999999 \"><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";

echo $s_main_sno."-T-".$s_sales_trans_sno;
echo "</font></div></td>";

echo "<td style=\"border-bottom: 1px solid #999999;border-right: 1px solid #999999 \"><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";

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
echo "<td style=\"border-bottom: 1px solid #999999;border-right: 1px solid #999999 \"><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";
echo $s_no_of_units*$s_no_of_paxs;
echo "</font></div></td>";
echo "<td style=\"border-bottom: 1px solid #999999;border-right: 1px solid #999999 \"><div align=\"center\"><font size=\"3\" face=\"Verdana, Arial, Helvetica, sans-serif\">";
echo $s_tot_sell_rate;
echo "</font></div></td>";


echo "</tr>";
}
$g_tot = $g_tot + $tot_amt ;
$tot_amt=0;
echo "</table>";

?>

</td></tr>
</table>

<?
}
?>


<?
if($s_sales_visa=="t") {  
?>


<br>
<table width="100%" border="0" cellspacing="0" cellpadding="0" style="border-top: 1px solid #999999;">
<tr><td style="border-bottom: 1px solid #999999;border-left: 1px solid #999999;border-right: 1px solid #999999 " width="10%" align="center"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Visas</font></td><td >&nbsp;</td></tr>

<tr><td colspan="2">

<?
$q_visa_sel ="select sales_visa_sno,req_date_time,no_adults,no_child,no_infant,net_adults,tot_net_adults,tot_net_child,tot_net_infant,booking_status from sales_visa where ocode='$s_pnr' order by sales_visa_sno";

$res_visa_sel = pg_query($q_visa_sel);

$rows_visa = pg_num_rows($res_visa_sel);

if (!$res_visa_sel) {
echo "An error occured.\n";
exit;
		}

if($rows_visa>0){
echo "<table width=\"95%\" border=\"0\" cellpadding=\"2\" cellspacing=\"0\" align=\"center\"><tr><td style=\"border-bottom: 1px solid #999999;border-right: 1px solid #999999;border-left: 1px solid #999999;border-top: 1px solid #999999 \" ><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">Invice No</font></div></td><td style=\"border-bottom: 1px solid #999999;border-right: 1px solid #999999;border-top: 1px solid #999999 \"><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">Visa Request Date</font></div></td><td style=\"border-bottom: 1px solid #999999;border-right: 1px solid #999999;border-top: 1px solid #999999 \"><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">Total Paxs</font></div></td><td style=\"border-bottom: 1px solid #999999;border-right: 1px solid #999999;border-top: 1px solid #999999 \"><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">Adults</font></div></td><td style=\"border-bottom: 1px solid #999999;border-right: 1px solid #999999;border-top: 1px solid #999999 \"><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">Child</font></div></td><td style=\"border-bottom: 1px solid #999999;border-right: 1px solid #999999;border-top: 1px solid #999999 \"><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">Infant</font></div></td><td style=\"border-bottom: 1px solid #999999;border-right: 1px solid #999999;border-top: 1px solid #999999 \"><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">Net Rate</font></div></td></tr>";
}
while ($rows_visa_sel = pg_fetch_array($res_visa_sel)){

$s_sales_visa_sno = $rows_visa_sel["sales_visa_sno"];
$s_req_date_time = $rows_visa_sel["req_date_time"];
$s_no_adults = $rows_visa_sel["no_adults"];
$s_no_child = $rows_visa_sel["no_child"];
$s_no_infant = $rows_visa_sel["no_infant"];
$tot_no = $s_no_adults + $s_no_child + $s_no_infant;
$s_sell_adults = $rows_visa_sel["net_adults"];
$s_tot_sell_adults = $rows_visa_sel["tot_net_adults"];
$s_tot_sell_child = $rows_visa_sel["tot_net_child"];
$s_tot_sell_infant = $rows_visa_sel["tot_net_infant"];
$s_booking_status = $rows_visa_sel["booking_status"];

$s_tot_amount = $s_tot_sell_adults + $s_tot_sell_child + $s_tot_sell_infant;

$tot_amt = $tot_amt + $s_tot_amount;




echo "<tr><td style=\"border-bottom: 1px solid #999999;border-right: 1px solid #999999;border-left: 1px solid #999999 \"><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";

echo $s_main_sno."-V-".$s_sales_visa_sno;
echo "</font></div></td>";
echo "<td style=\"border-bottom: 1px solid #999999;border-right: 1px solid #999999 \"><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";

echo date('D, jS M, Y', strtotime($s_req_date_time));
echo "</font></div></td>";
echo "<td style=\"border-bottom: 1px solid #999999;border-right: 1px solid #999999 \"><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";
echo $tot_no;
echo "</font></div></td>";
echo "<td style=\"border-bottom: 1px solid #999999;border-right: 1px solid #999999 \"><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";
echo $s_no_adults;
echo "</font></div></td>";
echo "<td style=\"border-bottom: 1px solid #999999;border-right: 1px solid #999999 \"><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";

echo $s_no_child;
echo "</font></div></td>";
echo "<td style=\"border-bottom: 1px solid #999999;border-right: 1px solid #999999 \"><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";
echo $s_no_infant;
echo "</font></div></td>";
echo "<td style=\"border-bottom: 1px solid #999999;border-right: 1px solid #999999 \"><div align=\"center\"><font size=\"3\" face=\"Verdana, Arial, Helvetica, sans-serif\">";
echo $s_tot_amount;
echo "</font></div></td>";


echo "</tr>";
}
$g_tot = $g_tot + $tot_amt ;
$tot_amt=0;
echo "</table>";

?>

</td></tr>
</table>

<?
}
?>


<?
if($s_sales_others=="t") {  
?>


<br>
<table width="100%" border="0" cellspacing="0" cellpadding="0" style="border-top: 1px solid #999999;">
<tr><td  style="border-bottom: 1px solid #999999;border-left: 1px solid #999999;border-right: 1px solid #999999 " width="10%" align="center"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Others</font></td><td >&nbsp;</td></tr>

<tr><td colspan="2">

<?
$q_extra_sel ="select sales_extra_sno,req_date_time,paticulars,net_rate,booking_status from sales_extra where ocode='$s_pnr' order by sales_extra_sno";

$res_extra_sel = pg_query($q_extra_sel);

$rows_extra = pg_num_rows($res_extra_sel);

if (!$res_extra_sel) {
echo "An error occured.\n";
exit;
		}

if($rows_extra>0){
echo "<table width=\"95%\" border=\"0\" cellpadding=\"2\" cellspacing=\"0\" align=\"center\"><tr><td style=\"border-bottom: 1px solid #999999;border-right: 1px solid #999999;border-left: 1px solid #999999;border-top: 1px solid #999999 \"><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">Invice No</font></div></td><td style=\"border-bottom: 1px solid #999999;border-right: 1px solid #999999;border-top: 1px solid #999999 \"><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">Request Date</font></div></td><td style=\"border-bottom: 1px solid #999999;border-right: 1px solid #999999;border-top: 1px solid #999999 \"><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">Paticulars</font></div></td><td style=\"border-bottom: 1px solid #999999;border-right: 1px solid #999999;border-top: 1px solid #999999 \"><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">Net Rate</font></div></td></tr>";
}
while ($rows_extra_sel = pg_fetch_array($res_extra_sel)){

$s_sales_extra_sno = $rows_extra_sel["sales_extra_sno"];

$s_req_date_time = $rows_extra_sel["req_date_time"];

$s_paticulars = $rows_extra_sel["paticulars"];
$s_sell_rate = $rows_extra_sel["net_rate"];
$s_booking_status = $rows_extra_sel["booking_status"];

$tot_amt = $tot_amt + $s_sell_rate;

echo "<tr><td style=\"border-bottom: 1px solid #999999;border-right: 1px solid #999999;border-left: 1px solid #999999 \" \"><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";

echo $s_main_sno."-X-".$s_sales_extra_sno;
echo "</font></div></td>";

echo "<td style=\"border-bottom: 1px solid #999999;border-right: 1px solid #999999 \"><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";

echo date('D, jS M, Y', strtotime($s_req_date_time));
echo "</font></div></td>";
echo "<td style=\"border-bottom: 1px solid #999999;border-right: 1px solid #999999 \"><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";
echo $s_paticulars;
echo "</font></div></td>";
echo "<td style=\"border-bottom: 1px solid #999999;border-right: 1px solid #999999 \"><div align=\"center\"><font size=\"3\" face=\"Verdana, Arial, Helvetica, sans-serif\">";
echo $s_sell_rate;
echo "</font></div></td>";


echo "</tr>";
}
$g_tot = $g_tot + $tot_amt ;
$tot_amt=0;
echo "</table>";
?>

</td></tr>
</table>

<?
}
?>

<br>
<table width="100%" border="0" cellspacing="0" cellpadding="0" style="border-top: 1px solid #999999;">
<tr><td align="right"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"> Grand Total Net Rate:  </font></td><td width="17%" style="border-bottom:  double #999999;"><font size="3" face="Verdana, Arial, Helvetica, sans-serif"><b>SAR#<? echo number_format($g_tot, 2, "." , ",")?>/-</b></font></td></tr></table>

<br>
<table width="95%" border="0" cellspacing="0" cellpadding="0" align="center">
<tr><td align="justify"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">  <? echo date('D, jS M, Y H:i A', strtotime($s_option_date)); ?>  is option date for payment or for voucher, Kindly Transfer above Amount to A/C: Mr. JAMAL ABDULLAH MUKHTAR, 12022016000102, National Commercial Bank, Manara Branch, Jeddah, K.S.A </font></td></tr>



<tr><td align="justify"><font size="1" face="Verdana, Arial, Helvetica, sans-serif"><br> 
*In Case of Non-Payment of Above Amount before option date, Your Booking will be automatically cancelled. Thereafter Dheyafa Al Taj is not responsible in any circumstances. **This Booking is confirmed on NON-REFUNDABLE constraint.</font>
</td></tr> 
<?

if($s_agent_notes==""){}
else
{
echo "<tr><td><font size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\">Notes: $s_agent_notes </font></td></tr>";
}
?>
</table>

<br>

<?
$q_u_det ="select user_first_name, user_last_name from users where user_id='$s_user_id'";

$u_sel = pg_query($q_u_det);

if (!$u_sel) {
echo "An error occured.\n";
exit;
		}

while ($rows_u_sel = pg_fetch_array($u_sel)){

 $s_user_first_name = $rows_u_sel["user_first_name"];

 $s_user_last_name = $rows_u_sel["user_last_name"];
}
?>

<table width="95%" border="0" cellspacing="0" cellpadding="0" align="center">
<tr><td><td align="justify"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><i>
<? echo $s_user_first_name ." " . $s_user_last_name ?></i></font>
</td></tr>
<tr><td><td align="justify"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><br><br><i>
Reservation Dept</i></font>
</td></tr>
</table>

<tr><td></table>
</center>
</body>

</html>
