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
$a_trans_id = array();
$s_trans_c_name = array();
$s_city = array();
$a_trans_id_s = array();
$s_res_fax = array();
$a_supp_account_code = array();


$q_hotel_id ="select trans_id_s from sales_trans where ocode='$s_pnr' group by trans_id_s";

$res_hotel_id = pg_query($conn, $q_hotel_id);

if (!$res_hotel_id) {
echo "An error occured.\n";
exit;
		}

while ($rows_hotel_id = pg_fetch_array($res_hotel_id)){

$a_trans_id_s[] = $rows_hotel_id["trans_id_s"];

$s_trans_supp_id = $rows_hotel_id["trans_id_s"];

$q_hotel_subsel = "select trans_c_name, city,reservation_fax from s_trans where trans_id='$s_trans_supp_id'";

$res_hotel_subsel = pg_query($conn, $q_hotel_subsel);

if (!$res_hotel_subsel) {
echo "An error occured.\n";
exit;
		}
while ($rows_hotel_subsel = pg_fetch_array($res_hotel_subsel)){

$s_trans_c_name[] = $rows_hotel_subsel["trans_c_name"];
$s_city[] = $rows_hotel_subsel["city"];
$s_res_fax[] = $rows_hotel_subsel["reservation_fax"];

}



} //end of hotel id while


//print_r($a_supp_account_code);


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

}



?>



<?

for($i=0; $i<count($a_trans_id_s); $i++){

include ("printheadrequest.php");
?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">


<table width="97%" border="0" cellspacing="0" cellpadding="0" >
<tr><td>

<table width="100%" border="0" cellspacing="0" cellpadding="0" >
<tr><td><img src="../images/space.jpg"></td></tr>
<tr>
      <td  align="center"><font face="Arial, Helvetica, sans-serif"><strong> TRASPORTATION RESERVATION REQUEST </strong></font></td>
    </tr></table>

<?

echo "<table width=\"95%\" align=\"center\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" >";

echo "<tr><td align=\"left\" ><font size=\"4\" face=\"Verdana, Arial, Helvetica, sans-serif\">";

echo "PNR:  ";

echo  $s_pnr;

echo "</font></td>";

echo "<td align=\"right\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";

echo "To: " . $s_trans_c_name[$i]   ;

echo "</font></td></tr>";


echo "<tr><td align=\"left\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";

echo "Request Date:  ";
echo date('jS M, Y', strtotime($s_order_date)) ;

echo "</font></td>";

echo "<td align=\"right\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";

echo "City: "  . $s_city[$i];

echo "</font></td></tr>";


$a_s_req_date_time  = array();
$a_s_f2t            = array();
$a_s_type_of_trans  = array();
$a_s_no_of_units    = array();
$a_s_no_of_paxs     = array();
$a_s_flight_det     = array();
$a_s_kind_of_trans  = array();
$a_s_trans_model    = array();
$a_s_req_date_time_d = array();      




$r_sno=1;
$q_hotel_sel ="select sales_trans_sno,user_sno,trans_id,req_date_time,f2t,type_of_trans,no_of_units,no_of_paxs,flight_det,kind_of_trans,trans_model,supp_rep,booking_status  from sales_trans where trans_id_s='$a_trans_id_s[$i]' and ocode='$s_pnr' order by req_date_time";

$res_hotel_sel = pg_query($conn, $q_hotel_sel);

$rows_hotels = pg_num_rows($res_hotel_sel);

if (!$res_hotel_sel) {
echo "An error occured.\n";
exit;
		}

while ($rows_hotel_sel = pg_fetch_array($res_hotel_sel)){
$s_sales_trans_sno = $rows_hotel_sel["sales_trans_sno"];
$s_user_sno = $rows_hotel_sel["user_sno"];
$s_trans_id = $rows_hotel_sel["trans_id"];
$s_req_date_time = $rows_hotel_sel["req_date_time"];
$s_f2t = $rows_hotel_sel["f2t"];
$s_type_of_trans = $rows_hotel_sel["type_of_trans"];
$s_no_of_units = $rows_hotel_sel["no_of_units"];
$s_no_of_paxs = $rows_hotel_sel["no_of_paxs"];
$s_flight_det = $rows_hotel_sel["flight_det"];
$s_kind_of_trans = $rows_hotel_sel["kind_of_trans"];
$s_trans_model = $rows_hotel_sel["trans_model"];
$s_supp_rep = $rows_hotel_sel["supp_rep"];
$s_booking_status = $rows_hotel_sel["booking_status"];


$a_s_req_date_time[]=date('d-M-Y H:i A', strtotime($s_req_date_time));


$var = date('H' , strtotime($s_req_date_time));

if ($var <= 11) {
        $a_s_req_date_time_d[] = "Morning";

}
else {
        if ($var > 11 and $var < 18) {
                $a_s_req_date_time_d[] = "Afternoon";

        }
        else {
                $a_s_req_date_time_d[] = "Evening";

        }
}




$a_s_f2t[]          =$s_f2t          ;
$a_s_type_of_trans[]=$s_type_of_trans;
$a_s_no_of_units[]  =$s_no_of_units  ;
$a_s_no_of_paxs[]   =$s_no_of_paxs   ;
$a_s_flight_det[]   =$s_flight_det   ;
$a_s_kind_of_trans[]=$s_kind_of_trans;
$a_s_trans_model[]  =$s_trans_model  ;

}

echo "<tr><td align=\"left\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";

echo "Guest Name:  ";
echo  "<b>" .$s_guest_title .". " .strtoupper($s_guest_name) ."</b>";

echo "</font></td>";

echo "<td align=\"right\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";

echo "Kind Attn: Mr. " . $s_supp_rep;
//echo " &nbsp; <br> &nbsp; ";

echo "</font></td></tr>";

echo "<tr><td align=\"left\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";

echo "Company Name :  ";
echo  $s_cus_company_name .", " .strtoupper($s_cus_country);

echo "</font></td>";

echo "<td align=\"right\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";

echo "Fax No: " . $s_res_fax[$i];


echo "</font></td></tr>";
echo "</table>";

echo "<br>";


echo "<table width=\"95%\" align=\"center\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" >";

echo "<tr><td align=\"left\" ><font size=\"4\" face=\"Verdana, Arial, Helvetica, sans-serif\">";

echo "<tr><td colspan=\"2\"><font size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\">Dear Sir, <br>We would like to request you Confirm our Transfer Reservation Request with referring to above mentioned PNR and Guest Name. <br>Further, send us all details of Confirmation Number, Prices with Our Commission  and other Terms and Conditions.<br><br></font></td></tr>"; 



echo "</table>";

echo "<table width=\"95%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\" style=\" border-top: 1px solid #999999;\">";


echo "<tr><td align=\"center\" style=\"border-bottom: 1px solid #999999; border-right: 1px solid #999999;\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">Units</font></td><td align=\"center\" style=\"border-bottom: 1px solid #999999; border-right: 1px solid #999999;\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">Transfer Type</font></td><td align=\"center\" style=\"border-bottom: 1px solid #999999; border-right: 1px solid #999999;\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">Brand Name</font></td><td align=\"center\" style=\"border-bottom: 1px solid #999999; border-right: 1px solid #999999;\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">Model</font></td><td align=\"center\" style=\"border-bottom: 1px solid #999999; border-right: 1px solid #999999;\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">Transfer Route</font></td><td align=\"center\" style=\"border-bottom: 1px solid #999999; border-right: 1px solid #999999;\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">Time</font></td><td align=\"center\" style=\"border-bottom: 1px solid #999999; border-right: 1px solid #999999;\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">Flight</font></td><td align=\"center\" style=\"border-bottom: 1px solid #999999; \"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">No. Pax</font></td></tr>";

for($rd=0; $rd<count($a_s_type_of_trans); $rd++){

$s_t_kind = "";
$s_t_kind = $a_s_kind_of_trans[$rd];
if($s_t_kind==""){ $s_t_kind = "&nbsp;";} 


$s_t_model = "";
$s_t_model = $a_s_trans_model[$rd];
if($s_t_model==""){ $s_t_model = "&nbsp;";} 


$s_flight_det="";
$s_flight_det = $a_s_flight_det[$rd];
if($s_flight_det==""){ $s_flight_det = "&nbsp;";} 

$tot_pax=$a_s_no_of_units[$rd]*$a_s_no_of_paxs[$rd];

echo "<tr><td align=\"center\" style=\"border-bottom: 1px solid #999999; border-right: 1px solid #999999;\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">$a_s_no_of_units[$rd]</font></td><td align=\"center\" style=\"border-bottom: 1px solid #999999; border-right: 1px solid #999999;\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">$a_s_type_of_trans[$rd]</font></td><td align=\"center\" style=\"border-bottom: 1px solid #999999; border-right: 1px solid #999999;\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">$s_t_kind</font></td><td align=\"center\" style=\"border-bottom: 1px solid #999999; border-right: 1px solid #999999;\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">$s_t_model</font></td><td align=\"center\" style=\"border-bottom: 1px solid #999999; border-right: 1px solid #999999;\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">$a_s_f2t[$rd]</font></td><td align=\"center\" style=\"border-bottom: 1px solid #999999; border-right: 1px solid #999999;\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">$a_s_req_date_time[$rd] ($a_s_req_date_time_d[$rd])</font></td><td align=\"center\" style=\"border-bottom: 1px solid #999999; border-right: 1px solid #999999;\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">$s_flight_det</font></td><td align=\"center\" style=\"border-bottom: 1px solid #999999;\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">$tot_pax</font></td></tr>";

}


echo "</table>";




?>
<br>
<table width="95%" border="0" cellspacing="0" cellpadding="0" align="center">
<tr><td align="justify"><font size="1" face="Verdana, Arial, Helvetica, sans-serif"> Please provide us good conditioned vehicle and ensure that vehicle should be clean and neat.  A kind and pleasing driver with capability to display signboard of the Guest name during the time of arrival.<br><br>OUR GUEST IS HOLDING THE VOUCHER FOR ABOVE REQUEST.
WE WILL COVER THE PAYMENT FOR THE SAME. SO KINDLY DEBIT OUR ACOUNT. <font size="1">( Please do not hesitate to contact us for further information at our office,  timings  09:00 AM to 09:00 PM ).

</font></font></td></tr>

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

$u_sel = pg_query($conn, $q_u_det);

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
if (count($a_trans_id_s)- $i > 1){
echo "<p style=\"page-break-before: always\">";
}
?>

<?
}  //end of hotel id for loop
?>


</center>
</body>

</html>
