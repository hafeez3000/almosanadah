<? 
include("../db/db.php");  ?>
<html>
<head><title>DORS - Hotel Reservation Request</title>
<meta http-equiv="Content-Type" content="text/html; charset=charset=utf-8">
</head>
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<center>


<?
$s_pnr = $_GET['spnr'];
$a_hotel_id = array();
$s_hotel_name = array();
$s_city = array();
$s_fax = array();

$a_supp_id = array();
$supp_name_t = array();
$supp_city = array();
$supp_fax = array();
$supp_email = array();


$supp_empty="";

$q_supp_chk ="select supp_id from sales_hotels where ocode='$s_pnr' and supp_id!='$supp_empty' group by supp_id";
$hot_supp_chk = pg_query($q_supp_chk);
$supp_chk_rows = pg_num_rows($hot_supp_chk);



if($supp_chk_rows==0){ 

$q_hotel_id ="select hotel_id from sales_hotels where ocode='$s_pnr' group by hotel_id";

$res_hotel_id = pg_query($q_hotel_id);

if (!$res_hotel_id) {
echo "An error occured.\n";
exit;
		}

while ($rows_hotel_id = pg_fetch_array($res_hotel_id)){
$a_hotel_id[] = $rows_hotel_id["hotel_id"];
$int_hot_id =  $rows_hotel_id["hotel_id"];

$q_hotel_subsel = "select hotel_name,reception_fax, city from hotels where hotel_id='$int_hot_id'";

$res_hotel_subsel = pg_query($q_hotel_subsel);

if (!$res_hotel_subsel) {
echo "An error occured.\n";
exit;
		}
while ($rows_hotel_subsel = pg_fetch_array($res_hotel_subsel)){

$s_hotel_name[] = $rows_hotel_subsel["hotel_name"];
$s_city[] = $rows_hotel_subsel["city"];
$s_fax[] =  $rows_hotel_subsel["reception_fax"];

}




} //end of hotel id while





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

}



?>



<?

for($i=0; $i<count($a_hotel_id); $i++){

include ("printheadrequest.php");
?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">


<table width="97%" border="0" cellspacing="0" cellpadding="0" >
<tr><td>

<table width="100%" border="0" cellspacing="0" cellpadding="0" >
<tr><td><img src="../images/space.jpg"></td></tr>
<tr>
      <td  align="center"><font face="Arial, Helvetica, sans-serif"><strong> HOTEL RESERVATION REQUEST </strong></font></td>
    </tr></table>

<?

echo "<table width=\"95%\" align=\"center\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" >";

echo "<tr><td align=\"left\" ><font size=\"4\" face=\"Verdana, Arial, Helvetica, sans-serif\">";

echo "PNR:  ";

echo  $s_pnr;

echo "</font></td>";




echo "<td align=\"right\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";

echo "To: " . $s_hotel_name[$i]   ;

echo "</font></td></tr>";


echo "<tr><td align=\"left\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";

echo "Request Date:  ";
echo date('jS M, Y', strtotime($s_order_date)) ;

echo "</font></td>";

echo "<td align=\"right\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";

echo "City: "  . $s_city[$i];

echo "</font></td></tr>";



echo "<tr><td align=\"left\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";

echo "Guest Name:  ";
echo  "<b>" .$s_guest_title .". " .strtoupper($s_guest_name) ."</b>";

echo "</font></td>";

echo "<td align=\"right\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";

if(trim($s_fax[$i])==""){echo " &nbsp; <br> &nbsp; ";}
else{
echo "Fax: "  . $s_fax[$i];
}


echo "</font></td></tr>";

echo "</table>";


echo "<table width=\"95%\" align=\"center\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" >";

echo "<tr><td align=\"left\" ><font size=\"4\" face=\"Verdana, Arial, Helvetica, sans-serif\">";

echo "<tr><td colspan=\"2\"><font size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\">Dear Sir, <br>We would like to request you Confirm our Hotel Reservation Request with referring to above mentioned PNR and Guest Name. <br>Further, send us all details of Confirmation Number, Prices with our Agent Commission  and other Terms and Conditions.<br><br></font></td></tr>"; 

echo "</table>";



$r_sno=1;
$q_hotel_sel ="select sales_hotels_sno,user_sno,hotel_id,room_id,cin,cout,no_rooms,no_nights,no_paxs,sell_rate,booking_status  from sales_hotels where hotel_id='$a_hotel_id[$i]' and ocode='$s_pnr' order by sales_hotels_sno";

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
$s_sell_rate = $rows_hotel_sel["sell_rate"];
$s_booking_status = $rows_hotel_sel["booking_status"];


$q_rooms_subsel ="select  room_type from rooms where room_id=$s_room_id";

$res_rooms_subsel = pg_query($q_rooms_subsel);

if (!$res_rooms_subsel) {
echo "An error occured.\n";
exit;
		}
while ($rows_rooms_subsel = pg_fetch_array($res_rooms_subsel)){

$s_room_type = $rows_rooms_subsel["room_type"];
}


$q_meals_sel ="select sales_meals_sno,sales_hotels_sno,sales_hot_meals_sno,user_sno,rate_date,room_id,breakfast,halfboard,fullboard,sahoor,iftar,room_net_rate,room_sell_rate,no_of_paxs,no_of_rooms,day_net_rate,day_sell_rate from sales_meals where sales_hotels_sno=$s_hotels_sno order by sales_meals_sno";

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


$p_meals="";


if($s_breakfast=="N/A" || $s_breakfast=="INC"){
}
else
{
$p_meals = $p_meals . "BreakFast," ;
}

if($s_halfboard=="N/A" || $s_halfboard=="INC") {
}
else
{
$p_meals = $p_meals . "HalfBoard," ;
}

if($s_fullboard=="N/A" || $s_fullboard=="INC") {
}
else
{
$p_meals = $p_meals . "FullBoard" ;
}

if($s_sahoor=="N/A" || $s_sahoor=="INC") {
}
else
{
$p_meals = $p_meals . "Sahoor" ;
}

if($s_iftar=="N/A" || $s_iftar=="INC") {
}
else
{
$p_meals = $p_meals . "Iftar" ;
}


}	



echo "<table width=\"90%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\" style=\"border-bottom: 1px solid #999999; border-top: 1px solid #999999;\">";


echo "<tr ><td style=\"border-bottom: 1px solid #999999;border-left: 1px solid #999999;border-right: 1px solid #999999 \" width=\"17%\"><div align=\"center\"><font size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\"><b>Request Sno: $r_sno</b></font></div></td><td colspan=\"2\">&nbsp;</td>";



echo "</tr>";


echo "<tr ><td >&nbsp;</td>";

echo "<td width=\"25%\"><div align=\"right\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">Check In:</font></div></td>";

echo "<td ><div align=\"left\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">&nbsp;" . date('D, jS M, Y', strtotime($s_cin)) ."</font></div></td>";

echo "</tr>";

echo "<tr ><td >&nbsp;</td>";

echo "<td ><div align=\"right\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">Check Out:</font></div></td>";

echo "<td ><div align=\"left\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">&nbsp;" . date('D, jS M, Y', strtotime($s_cout)) . " </font></div></td>";


echo "</tr>";


echo "<tr ><td >&nbsp;</td>";

echo "<td ><div align=\"right\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">No of Paxs:</font></div></td>";
echo "<td ><div align=\"left\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">&nbsp; " . $s_no_paxs . " Paxs </font></div></td>";


echo "</tr>";


echo "<tr ><td >&nbsp;</td>";


echo "<td><div align=\"right\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">No of Rooms (Type):</font></div></td>";

echo "<td ><div align=\"left\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">&nbsp;" . $s_no_rooms . " X " . $s_room_type . "</font></div></td>";

echo "</tr>";

if($p_meals=="" ) { }
else{
echo "<tr ><td >&nbsp;</td>";


echo "<td><div align=\"right\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">Meals:</font></div></td>";

echo "<td ><div align=\"left\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">&nbsp;" . $p_meals . "</font></div></td>";

echo "</tr>";
}


$r_sno++;
}

echo "</table>";

?>
<br>
<table width="95%" border="0" cellspacing="0" cellpadding="0" align="center">
<tr><td align="justify"><font size="1" face="Verdana, Arial, Helvetica, sans-serif"> OUR GUEST IS HOLDING THE VOUCHER FOR ABOVE REQUEST.
WE WILL COVER THE PAYMENT FOR THE SAME. SO KINDLY DEBIT OUR ACCOUNT. <font size="1">( Please do not hesitate to contact us for further information at our office,  timings  09:00 AM to 09:00 PM ) </font></font></td></tr>

<?

if($s_guest_notes==" "){}
else
{
echo "<tr><td><font size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\"> <br> Notes: $s_guest_notes </font></td></tr>";
}
?>


<tr><td align="justify"><font size="1" face="Verdana, Arial, Helvetica, sans-serif"><br>
*KINDLY SEND US CONFIRMATION LETTER AT THE EARLIEST POSSIBLE</font>
</td></tr> 
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

<?
if (count($a_hotel_id)- $i > 1){
echo "<p style=\"page-break-before: always\">";
}
?>

<?
}  //end of hotel id for loop




}   // end of if 1st supp_chk
else {

while ($rows_supp_chk = pg_fetch_array($hot_supp_chk)){
$a_supp_id[] = $rows_supp_chk["supp_id"];
$int_supp_id =  $rows_supp_chk["supp_id"];


$query_supp_t ="select supp_name,city,fax,email from suppliers where supp_id='$int_supp_id' ";

$result_supp_t = pg_query($query_supp_t);



if (!$result_supp_t) {
	echo "An error occured.\n";
	exit;
	}
while ($rows_supp_t = pg_fetch_array($result_supp_t)){

$supp_name_t[] = $rows_supp_t["supp_name"];
$supp_city[] = $rows_supp_t["city"];
$supp_fax[] = $rows_supp_t["fax"];
$supp_email[] = $rows_supp_t["email"];

}



} //end of supp id while




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

}




for($i=0; $i<count($a_supp_id); $i++){


include ("printheadrequest.php");
?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">


<table width="97%" border="0" cellspacing="0" cellpadding="0" >
<tr><td>

<table width="100%" border="0" cellspacing="0" cellpadding="0" >
<tr><td><img src="../images/space.jpg"></td></tr>
<tr>
      <td  align="center"><font face="Arial, Helvetica, sans-serif"><strong> HOTEL RESERVATION REQUEST </FONT></strong></font></td>
    </tr></table>

<?

echo "<table width=\"95%\" align=\"center\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" >";

echo "<tr><td align=\"left\" ><font size=\"4\" face=\"Verdana, Arial, Helvetica, sans-serif\">";

echo "PNR:  ";

echo  $s_pnr;

echo "</font></td>";




echo "<td align=\"right\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";

echo "To: " . $supp_name_t[$i]   ;

echo "</font></td></tr>";


echo "<tr><td align=\"left\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";

echo "Request Date:  ";
echo date('jS M, Y', strtotime($s_order_date)) ;

echo "</font></td>";

echo "<td align=\"right\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";

echo "City: "  . $supp_city[$i];

echo "</font></td></tr>";



echo "<tr><td align=\"left\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";

echo "Guest Name:  ";
echo  "<b>" .$s_guest_title .". " .strtoupper($s_guest_name) ."</b>";

echo "</font></td>";

echo "<td align=\"right\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";

if(trim($supp_fax[$i])==""){echo " &nbsp; <br> &nbsp; ";}
else{
echo "Fax: "  . $supp_fax[$i];
}


echo "</font></td></tr>";

echo "<tr><td align=\"left\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";

echo "&nbsp;";

echo "</font></td>";

echo "<td align=\"right\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";

if(trim($supp_email[$i])==""){echo " &nbsp; <br> &nbsp; ";}
else{
echo "Email: "  . $supp_email[$i];
}


echo "</font></td></tr>";


echo "</table>";


echo "<table width=\"95%\" align=\"center\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" >";

echo "<tr><td align=\"left\" ><font size=\"4\" face=\"Verdana, Arial, Helvetica, sans-serif\">";

echo "<tr><td colspan=\"2\"><font size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\">Dear Sir, <br>We would like to request you Confirm our Hotel Reservation Request with referring to above mentioned PNR and Guest Name. <br>Further, send us all details of Confirmation Number, Prices with our Agent Commission  and other Terms and Conditions.<br><br></font></td></tr>"; 

echo "</table>";



$r_sno=1;
$q_hotel_sel ="select sales_hotels_sno,user_sno,hotel_id,room_id,cin,cout,no_rooms,no_nights,no_paxs,sell_rate,booking_status  from sales_hotels where supp_id='$a_supp_id[$i]' and ocode='$s_pnr' order by sales_hotels_sno";

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
$s_sell_rate = $rows_hotel_sel["sell_rate"];
$s_booking_status = $rows_hotel_sel["booking_status"];


$q_rooms_subsel ="select  room_type from rooms where room_id=$s_room_id";

$res_rooms_subsel = pg_query($q_rooms_subsel);

if (!$res_rooms_subsel) {
echo "An error occured.\n";
exit;
		}
while ($rows_rooms_subsel = pg_fetch_array($res_rooms_subsel)){

$s_room_type = $rows_rooms_subsel["room_type"];
}


$q_hotel_subsel = "select hotel_name,reception_fax, city from hotels where hotel_id='$s_hotel_id'";

$res_hotel_subsel = pg_query($q_hotel_subsel);

if (!$res_hotel_subsel) {
echo "An error occured.\n";
exit;
		}
while ($rows_hotel_subsel = pg_fetch_array($res_hotel_subsel)){

$s_hotel_namein = $rows_hotel_subsel["hotel_name"];
$s_cityin = $rows_hotel_subsel["city"];


}




$q_meals_sel ="select sales_meals_sno,sales_hotels_sno,sales_hot_meals_sno,user_sno,rate_date,room_id,breakfast,halfboard,fullboard,sahoor,iftar,room_net_rate,room_sell_rate,no_of_paxs,no_of_rooms,day_net_rate,day_sell_rate from sales_meals where sales_hotels_sno=$s_hotels_sno order by sales_meals_sno";

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


$p_meals="";


if($s_breakfast=="N/A" || $s_breakfast=="INC"){
}
else
{
$p_meals = $p_meals . "BreakFast," ;
}

if($s_halfboard=="N/A" || $s_halfboard=="INC") {
}
else
{
$p_meals = $p_meals . "HalfBoard," ;
}

if($s_fullboard=="N/A" || $s_fullboard=="INC") {
}
else
{
$p_meals = $p_meals . "FullBoard" ;
}

if($s_sahoor=="N/A" || $s_sahoor=="INC") {
}
else
{
$p_meals = $p_meals . "Sahoor" ;
}

if($s_iftar=="N/A" || $s_iftar=="INC") {
}
else
{
$p_meals = $p_meals . "Iftar" ;
}


}	



echo "<table width=\"90%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\" style=\"border-bottom: 1px solid #999999; border-top: 1px solid #999999;\">";


echo "<tr ><td bgcolor=\"#CCCCCC\" width=\"17%\"><div align=\"center\"><font size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\"><b>Request Sno: $r_sno</b></font></div></td><td colspan=\"2\">&nbsp;</td>";



echo "</tr>";



echo "<tr ><td >&nbsp;</td>";

echo "<td width=\"25%\"><div align=\"right\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">Hotel Name:</font></div></td>";

echo "<td ><div align=\"left\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">&nbsp;" . $s_hotel_namein ." (".$s_cityin.")</font></div></td>";

echo "</tr>";


echo "<tr ><td >&nbsp;</td>";

echo "<td width=\"30%\"><div align=\"right\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">Check In:</font></div></td>";

echo "<td ><div align=\"left\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">&nbsp;" . date('D, jS M, Y', strtotime($s_cin)) ."</font></div></td>";

echo "</tr>";

echo "<tr ><td >&nbsp;</td>";

echo "<td ><div align=\"right\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">Check Out:</font></div></td>";

echo "<td ><div align=\"left\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">&nbsp;" . date('D, jS M, Y', strtotime($s_cout)) . " </font></div></td>";


echo "</tr>";


echo "<tr ><td >&nbsp;</td>";

echo "<td ><div align=\"right\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">No of Paxs:</font></div></td>";
echo "<td ><div align=\"left\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">&nbsp; " . $s_no_paxs . " Paxs </font></div></td>";


echo "</tr>";


echo "<tr ><td >&nbsp;</td>";


echo "<td><div align=\"right\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">No of Rooms (Room Type):</font></div></td>";

echo "<td ><div align=\"left\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">&nbsp;" . $s_no_rooms . " X " . $s_room_type . "</font></div></td>";

echo "</tr>";

if($p_meals=="" ) { }
else{
echo "<tr ><td >&nbsp;</td>";


echo "<td><div align=\"right\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">Meals:</font></div></td>";

echo "<td ><div align=\"left\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">&nbsp;" . $p_meals . "</font></div></td>";

echo "</tr>";
}


$r_sno++;
}

echo "</table>";

?>
<br>
<table width="95%" border="0" cellspacing="0" cellpadding="0" align="center">
<tr><td align="justify"><font size="1" face="Verdana, Arial, Helvetica, sans-serif"> OUR GUEST IS HOLDING THE VOUCHER FOR ABOVE REQUEST.
WE WILL COVER THE PAYMENT FOR THE SAME. SO KINDLY DEBIT OUR ACCOUNT. <font size="1">( Please do not hesitate to contact us for further information at our office,  timings  09:00 AM to 09:00 PM ) </font></font></td></tr>

<?

if($s_guest_notes==" "){}
else
{
echo "<tr><td><font size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\"> <br>Notes: $s_guest_notes </font></td></tr>";
}
?>


<tr><td align="justify"><font size="1" face="Verdana, Arial, Helvetica, sans-serif"><br>
*KINDLY SEND US CONFIRMATION LETTER AT THE EARLIEST POSSIBLE</font>
</td></tr> 
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

<?
if (count($a_hotel_id)- $i > 1){
echo "<p style=\"page-break-before: always\">";
}
?>

<?
}  //end of hotel id for loop





$q_supp_2chk ="select supp_id from sales_hotels where ocode='$s_pnr' and supp_id='$supp_empty' group by supp_id";
$hot_supp_2chk = pg_query($q_supp_2chk);
$supp_chk_2rows = pg_num_rows($hot_supp_2chk);

if($supp_chk_rows>0){  //start of 2nd supp_check

$a_hotel_id = array();
$s_hotel_name = array();
$s_city = array();
$s_fax = array();

$a_supp_id = array();
$supp_name_t = array();
$supp_city = array();
$supp_fax = array();
$supp_email = array();


$q_hotel_id ="select hotel_id from sales_hotels where ocode='$s_pnr' and supp_id='$supp_empty' group by hotel_id";

$res_hotel_id = pg_query($q_hotel_id);

if (!$res_hotel_id) {
echo "An error occured.\n";
exit;
		}

while ($rows_hotel_id = pg_fetch_array($res_hotel_id)){
$a_hotel_id[] = $rows_hotel_id["hotel_id"];
$int_hot_id =  $rows_hotel_id["hotel_id"];

$q_hotel_subsel = "select hotel_name,reception_fax, city from hotels where hotel_id='$int_hot_id'";

$res_hotel_subsel = pg_query($q_hotel_subsel);

if (!$res_hotel_subsel) {
echo "An error occured.\n";
exit;
		}
while ($rows_hotel_subsel = pg_fetch_array($res_hotel_subsel)){

$s_hotel_name[] = $rows_hotel_subsel["hotel_name"];
$s_city[] = $rows_hotel_subsel["city"];
$s_fax[] =  $rows_hotel_subsel["reception_fax"];

}




} //end of hotel id while





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

}



?>



<?

for($i=0; $i<count($a_hotel_id); $i++){

include ("printheadrequest.php");
?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">


<table width="97%" border="0" cellspacing="0" cellpadding="0" >
<tr><td>

<table width="100%" border="0" cellspacing="0" cellpadding="0" >
<tr><td><img src="../images/space.jpg"></td></tr>
<tr>
      <td  align="center"><font face="Arial, Helvetica, sans-serif"><strong> HOTEL RESERVATION REQUEST </FONT></strong></font></td>
    </tr></table>

<?

echo "<table width=\"95%\" align=\"center\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" >";

echo "<tr><td align=\"left\" ><font size=\"4\" face=\"Verdana, Arial, Helvetica, sans-serif\">";

echo "PNR:  ";

echo  $s_pnr;

echo "</font></td>";




echo "<td align=\"right\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";

echo "To: " . $s_hotel_name[$i]   ;

echo "</font></td></tr>";


echo "<tr><td align=\"left\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";

echo "Request Date:  ";
echo date('jS M, Y', strtotime($s_order_date)) ;

echo "</font></td>";

echo "<td align=\"right\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";

echo "City: "  . $s_city[$i];

echo "</font></td></tr>";



echo "<tr><td align=\"left\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";

echo "Guest Name:  ";
echo  "<b>" .$s_guest_title .". " .strtoupper($s_guest_name) ."</b>";

echo "</font></td>";

echo "<td align=\"right\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";

if(trim($s_fax[$i])==""){echo " &nbsp; <br> &nbsp; ";}
else{
echo "Fax: "  . $s_fax[$i];
}


echo "</font></td></tr>";

echo "</table>";


echo "<table width=\"95%\" align=\"center\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" >";

echo "<tr><td align=\"left\" ><font size=\"4\" face=\"Verdana, Arial, Helvetica, sans-serif\">";

echo "<tr><td colspan=\"2\"><font size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\">Dear Sir, <br>We would like to request you Confirm our Hotel Reservation Request with referring to above mentioned PNR and Guest Name. <br>Further, send us all details of Confirmation Number, Prices with our Agent Commission  and other Terms and Conditions.<br><br></font></td></tr>"; 

echo "</table>";



$r_sno=1;
$q_hotel_sel ="select sales_hotels_sno,user_sno,hotel_id,room_id,cin,cout,no_rooms,no_nights,no_paxs,sell_rate,booking_status  from sales_hotels where hotel_id='$a_hotel_id[$i]' and ocode='$s_pnr' order by sales_hotels_sno";

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
$s_sell_rate = $rows_hotel_sel["sell_rate"];
$s_booking_status = $rows_hotel_sel["booking_status"];


$q_rooms_subsel ="select  room_type from rooms where room_id=$s_room_id";

$res_rooms_subsel = pg_query($q_rooms_subsel);

if (!$res_rooms_subsel) {
echo "An error occured.\n";
exit;
		}
while ($rows_rooms_subsel = pg_fetch_array($res_rooms_subsel)){

$s_room_type = $rows_rooms_subsel["room_type"];
}


$q_meals_sel ="select sales_meals_sno,sales_hotels_sno,sales_hot_meals_sno,user_sno,rate_date,room_id,breakfast,halfboard,fullboard,sahoor,iftar,room_net_rate,room_sell_rate,no_of_paxs,no_of_rooms,day_net_rate,day_sell_rate from sales_meals where sales_hotels_sno=$s_hotels_sno order by sales_meals_sno";

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


$p_meals="";


if($s_breakfast=="N/A" || $s_breakfast=="INC"){
}
else
{
$p_meals = $p_meals . "BreakFast," ;
}

if($s_halfboard=="N/A" || $s_halfboard=="INC") {
}
else
{
$p_meals = $p_meals . "HalfBoard," ;
}

if($s_fullboard=="N/A" || $s_fullboard=="INC") {
}
else
{
$p_meals = $p_meals . "FullBoard" ;
}

if($s_sahoor=="N/A" || $s_sahoor=="INC") {
}
else
{
$p_meals = $p_meals . "Sahoor" ;
}

if($s_iftar=="N/A" || $s_iftar=="INC") {
}
else
{
$p_meals = $p_meals . "Iftar" ;
}


}	



echo "<table width=\"90%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\" style=\"border-bottom: 1px solid #999999; border-top: 1px solid #999999;\">";


echo "<tr ><td bgcolor=\"#CCCCCC\" width=\"17%\"><div align=\"center\"><font size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\"><b>Request Sno: $r_sno</b></font></div></td><td colspan=\"2\">&nbsp;</td>";



echo "</tr>";


echo "<tr ><td >&nbsp;</td>";

echo "<td width=\"25%\"><div align=\"right\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">Check In:</font></div></td>";

echo "<td ><div align=\"left\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">&nbsp;" . date('D, jS M, Y', strtotime($s_cin)) ."</font></div></td>";

echo "</tr>";

echo "<tr ><td >&nbsp;</td>";

echo "<td ><div align=\"right\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">Check Out:</font></div></td>";

echo "<td ><div align=\"left\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">&nbsp;" . date('D, jS M, Y', strtotime($s_cout)) . " </font></div></td>";


echo "</tr>";


echo "<tr ><td >&nbsp;</td>";

echo "<td ><div align=\"right\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">No of Paxs:</font></div></td>";
echo "<td ><div align=\"left\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">&nbsp; " . $s_no_paxs . " Paxs </font></div></td>";


echo "</tr>";


echo "<tr ><td >&nbsp;</td>";


echo "<td><div align=\"right\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">No of Rooms (Type):</font></div></td>";

echo "<td ><div align=\"left\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">&nbsp;" . $s_no_rooms . " X " . $s_room_type . "</font></div></td>";

echo "</tr>";

if($p_meals=="" ) { }
else{
echo "<tr ><td >&nbsp;</td>";


echo "<td><div align=\"right\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">Meals:</font></div></td>";

echo "<td ><div align=\"left\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">&nbsp;" . $p_meals . "</font></div></td>";

echo "</tr>";
}


$r_sno++;
}

echo "</table>";

?>
<br>
<table width="95%" border="0" cellspacing="0" cellpadding="0" align="center">
<tr><td align="justify"><font size="1" face="Verdana, Arial, Helvetica, sans-serif"> OUR GUEST IS HOLDING THE VOUCHER FOR ABOVE REQUEST.
WE WILL COVER THE PAYMENT FOR THE SAME. SO KINDLY DEBIT OUR ACCOUNT. <font size="1">( Please do not hesitate to contact us for further information at our office,  timings  09:00 AM to 09:00 PM ) </font></font></td></tr>

<?

if($s_guest_notes==" "){}
else
{
echo "<tr><td><font size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\"> <br><FONT 
style=\"BACKGROUND-COLOR: #CCCCCC\">&nbsp Notes:&nbsp</FONT> $s_guest_notes </font></td></tr>";
}
?>


<tr><td align="justify"><font size="1" face="Verdana, Arial, Helvetica, sans-serif"><br>
*KINDLY SEND US CONFIRMATION LETTER AT THE EARLIEST POSSIBLE</font>
</td></tr> 
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

<?
if (count($a_hotel_id)- $i > 1){
echo "<p style=\"page-break-before: always\">";
}
?>

<?
}  //end of hotel id for loop



}  // end of 2nd supp_check




}  // end of else supp_check

?>
</center>
</body>

</html>
