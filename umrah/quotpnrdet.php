<?

include ("header.php");
?>


<script>
document.title= '<? echo $company_name . " ERP - Quotation PNR Details"; ?>';
</script>

<html>
<link rel="stylesheet" type="text/css" href="../calendar/css.css" />
<head>
<script>
 var winl = (screen.width - 760) / 2; 
 var wint = (screen.height - 550) / 2;
</script>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<body leftmargin="0" topmargin="0" rightmargin="0">
<table width="100%" border="0" cellpadding="0" cellspacing="0" style="border-bottom: 1px solid #999999 ;border-left: 3px solid #006600;border-right: 3px solid #006600"><tr>
    <td bgcolor="#CCCCCC"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">&nbsp;You 
      are here: <a href="uhome.php">Home</a> &raquo; <a href="bookings.php">Booking Details</a> &raquo; Quotation PNR Details</font></td>
  </tr></table>
  
<table width="100%" border="0" cellpadding="0" cellspacing="0" style="border-bottom: 3px solid #006600; border-right: 3px solid #006600;border-left: 3px solid #006600 ">
  <tr>
    <td width="20%" style="border-right: 1px solid #999999"  valign="top"> <table width="100%" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td valign="top"><div align="left"> 
              <?php include  ("umenupreline.php"); ?>
            </div></td>
        </tr>
      </table></td>
    <td width="80%" valign="top"  > <table width="100%" border="0" cellpadding="0" cellspacing="1">
        <tr>
          <td valign="top"> 

			
            <table width="100%" cellpadding="0" cellspacing="0" ><tr><td width="85%" valign="top"> 
			<table cellpadding="0" cellspacing="0" width="100%" style="border-top: 1px solid #999999; border-bottom: 1px solid #999999"><tr>
                      <td bgcolor="#CCCCCC"><strong>Quotation PNR Details</strong></td>
					  <td bgcolor="#CCCCCC"><div align="right"><img src="../images/print_icon.gif" width="16" height="16"> 
                          <a href="bbyodactionpv.php">Printable View</a></div></td>
                    </tr></table>
<table width="100%" cellpadding="1" cellspacing="0"><tr>
                      <td> 
                          <table width="100%" border="0" cellspacing="0" style=" border-bottom: 1px solid #999999">
                         <tr><td>
						 
						  <table width="100%" border="0" cellspacing="0">
							 <tr><td>
<?
 session_start(); 

 $_SESSION['a_pnr'] = $_GET['spnr'];

 $s_pnr = $_GET['spnr'];

 $tot_amt = 0;



$q_main_sel ="select main_sno,ocode,user_sno,user_id,guest_name,cus_account_code,sel_rooms,order_date,option_date,sales_hotels,sales_trans,sales_visa,sales_others from quot_main where ocode='$s_pnr'";

$main_sel = pg_query($conn, $q_main_sel);

$rows_main = pg_num_rows($main_sel);

if (!$main_sel) {
echo "An error occured.\n";
exit;
		}

if($rows_main>0){

echo "<table width=\"100%\" border=\"1\" cellpadding=\"1\" cellspacing=\"0\">";

}

while ($rows_main = pg_fetch_array($main_sel)){

$s_user_id = $rows_main["user_id"];

$s_guest_name = $rows_main["guest_name"];



$s_order_date = $rows_main["order_date"];
$s_option_date = $rows_main["option_date"];

$s_cus_account_code = $rows_main["cus_account_code"];

$s_sel_rooms = $rows_main["sel_rooms"];

$as_rse1 = explode(",", $s_sel_rooms);



$sqmain_n="";
$sqmain_s="";

for($st=0; $st<count($as_rse1); $st++){
$sqmain_s = $sqmain_s . "sell_rate_r".$as_rse1[$st].",";
}

$qscmain = $sqmain_s;




$s_sales_hotels = $rows_main["sales_hotels"];
$s_sales_trans = $rows_main["sales_trans"];
$s_sales_visa = $rows_main["sales_visa"];
$s_sales_others = $rows_main["sales_others"];


$q_main_cus ="select acccode, aname,title,cname,scountry,fax,email from agentsdet where acccode= $s_cus_account_code";

$main_cus = pg_query($conn, $q_main_cus);

$rows_agen = pg_num_rows($main_cus);

if (!$main_cus) {
echo "An error occured.\n";
exit;
		}

if($rows_agen>0){

while ($rows_agen = pg_fetch_array($main_cus)){

$s_cus_name    =     $rows_agen["aname"];
$s_cus_title	=		$rows_agen["title"];
$s_cus_company_name	=		$rows_agen["cname"];
$s_cus_country  =      $rows_agen["scountry"];
$s_cus_fax		=		$rows_agen["fax"];
$s_cus_email	=		$rows_agen["email"];
  

}

}

echo "<tr ><td bgcolor=\"#CCCCCC\"><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><b>PNR</b></font></div></td>";
echo "<td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";
echo $s_pnr;
echo "</font></div></td>";

echo "<td bgcolor=\"#CCCCCC\"><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><b>Guest Details </b></font></div></td>";

echo "<td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";

echo "<b>" .$s_guest_name ."</b>";



echo "</font></div></td></tr>";

echo "<tr ><td bgcolor=\"#CCCCCC\"><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><b>Order Date</b></font></div></td>";
echo "<td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";
echo date('d-M-Y', strtotime($s_order_date)) ;
echo "</font></div></td>";

echo "<td bgcolor=\"#CCCCCC\"><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><b>Option Date</b></font></div></td>";

echo "<td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";
echo date('d-M-Y', strtotime($s_option_date)) ;

echo "</font></div></td></tr>";


echo "<tr ><td bgcolor=\"#CCCCCC\"><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><b>User Id </b></font></div></td>";
echo "<td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";
echo $s_user_id;
echo "</font></div></td>";

echo "<td bgcolor=\"#CCCCCC\"><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><b>Booking Status</b></font></div></td>";

echo "<td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\" color=\"#FF0000\"><strong>";

echo $s_booking_status;
echo "</strong></font></div></td></tr>";


echo "<tr ><td bgcolor=\"#CCCCCC\"><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><b>Requested By </b></font></div></td>";
echo "<td  colspan=\"3\"><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";
echo $s_cus_title . ". " .$s_cus_name . ", For ";
echo $s_cus_company_name .", ";
echo $s_cus_country;
echo "</font></div></td></tr>";

echo "<tr ><td bgcolor=\"#CCCCCC\"><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><b>Notes </b></font></div></td>";
echo "<td  colspan=\"3\"><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";
echo $s_guest_notes;
echo "</font></div></td></tr>";


echo "<tr><td colspan=\"2\" align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><a href=\"amendguestdet.php?spnr=$s_pnr\"> Amend Agent/Guest Details</a></font></td><td colspan=\"2\" align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";

echo "<a href=\"printconfirmation.php?spnr=$s_pnr\" target=\"hotdetpop\" onClick=\"window.open('', 'hotdetpop','width=750,height=450,menubar=yes,scrollbars=yes, top='+wint+',left='+winl+' ').focus()\" >Print PNR Confirmation</a>";

echo "</font></td></tr>";

echo "<tr><td colspan=\"4\">&nbsp;</td></tr>";

echo "<tr><td colspan=\"1\" align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\" style=\"BACKGROUND-COLOR: #DFDFDF\"><a href=\"pnraddnewhot.php?spnr=$s_pnr\">Add New Hotel</a></font></td><td colspan=\"1\" align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\" style=\"BACKGROUND-COLOR: #DFDFDF\"><a href=\"pnraddnewtrans.php?spnr=$s_pnr\">Add New Trans</a>";
echo "</font></td><td colspan=\"1\" align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\" style=\"BACKGROUND-COLOR: #DFDFDF\"><a href=\"pnraddnewvisa.php?spnr=$s_pnr\">Add New Visa</a>";
echo "</font></td><td colspan=\"1\" align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\" style=\"BACKGROUND-COLOR: #DFDFDF\"><a href=\"pnraddnewextra.php?spnr=$s_pnr\">Add New Extras</a>";
echo "</font></td></tr>";



echo "</table>";
}




if($s_sales_hotels=="t") {

$q_hotel_sel ="select quot_hotels_sno,user_sno,hotel_id,cin,cout,no_nights," .$qscmain." no_paxs  from quot_hotels where ocode='$s_pnr' order by quot_hotels_sno";

$res_hotel_sel = pg_query($conn, $q_hotel_sel);

$rows_hotels = pg_num_rows($res_hotel_sel);

if (!$res_hotel_sel) {
echo "An error occured.\n";
exit;
		}

if($rows_hotels>0){
echo "<br><table width=\"100%\" border=\"1\" cellpadding=\"1\" cellspacing=\"0\"><tr ><td bgcolor=\"#CCCCCC\"><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><b>Hotels</b></font></div></td><td colspan=\"9\"><div align=\"right\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";

echo "<a href=\"printhotelreq.php?spnr=$s_pnr\" target=\"hotreqpop\" onClick=\"window.open('', 'hotreqpop','width=750,height=450,menubar=yes,scrollbars=yes, top='+wint+',left='+winl+' ').focus()\" >Print Request</a>";


echo "</font></div></td></tr><tr bgcolor=\"#CCCCCC\"><td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><b>Room Type</b></font></div></td><td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><b>Hotel (City)</b></font></div></td><td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><b>Check In</b></font></div></td><td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><b>Check Out</b></font></div></td><td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><b>Amend</b></font></div></td><td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><b>Process</b></font></div></td><td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><img src=\"../images/delete.gif\" alt=\"Delete\" ></font></div></td></tr>";
}
while ($rows_hotel_sel = pg_fetch_array($res_hotel_sel)){
$s_hotels_sno = $rows_hotel_sel["quot_hotels_sno"];
$s_user_sno = $rows_hotel_sel["user_sno"];
$s_hotel_id = $rows_hotel_sel["hotel_id"];
$s_room_id = $rows_hotel_sel["room_id"];
$s_cin = $rows_hotel_sel["cin"];
$s_cout = $rows_hotel_sel["cout"];
//$s_no_rooms = $rows_hotel_sel["no_rooms"];


$s_no_nigths = $rows_hotel_sel["no_nights"];
$s_no_paxs = $rows_hotel_sel["no_paxs"];
$s_sell_rate = $rows_hotel_sel["sell_rate"];
$s_booking_status = $rows_hotel_sel["booking_status"];


for($i=0; $i<count($as_rse1); $i++){
$roomn = $as_rse1[$i];
${sr.$roomn} = $rows_hotel_sel["sell_rate_r".$as_rse1[$i]];
}




$tot_amt = $tot_amt + $s_sell_rate;

$q_hotel_subsel ="select hotel_name, city from hotels where hotel_id=$s_hotel_id";

$res_hotel_subsel = pg_query($conn, $q_hotel_subsel);

if (!$res_hotel_subsel) {
echo "An error occured.\n";
exit;
		}
while ($rows_hotel_subsel = pg_fetch_array($res_hotel_subsel)){

$s_hotel_name = $rows_hotel_subsel["hotel_name"];
$s_city = $rows_hotel_subsel["city"];
}



echo "<tr><td><table border=\"1\"><tr>";


for($rn=0; $rn<count($as_rse1); $rn++){

$r_name="";

if($as_rse1[$rn]=="1"){
$r_name = "Single";
}
if($as_rse1[$rn]=="2"){
$r_name = "Double";
}
if($as_rse1[$rn]=="3"){
$r_name = "Triple";
}


echo "<td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";

echo "<a href=\"roomdetails.php?hotid=$s_hotels_sno\" target=\"hotdetpop\" onClick=\"window.open('', 'hotdetpop','width=700,height=380,menubar=yes,scrollbars=yes, top='+wint+',left='+winl+' ').focus()\" >" . $r_name . "</a>";
echo "</font></div></td>";

}

echo "</tr><tr>";


for($st=0; $st<count($as_rse1); $st++){


$sr="sr";
$roomn = $as_rse1[$st];



echo "<td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";

echo  ${$sr . $roomn} ;
echo "</font></div></td>";


}






echo"</tr></table></td>";
echo "<td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";
echo $s_hotel_name;
echo " (" . $s_city . ")";
echo "</font></div></td>";
echo "<td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";
echo date('d-M-Y', strtotime($s_cin));
echo "</font></div></td>";
echo "<td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";

echo date('d-M-Y', strtotime($s_cout));
echo "</font></div></td>";

echo "<td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";
echo "<a href=\"amendhotsel.php?hotid=$s_hotels_sno\">Amend</a>";
echo "</font></div></td>";
echo "<td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";
echo "<a href=\"processhotsel.php?hotid=$s_hotels_sno\">Process</a>";
echo "</font></div></td>";

echo "<td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";
echo "<a href=\"pnrhotdel.php?hotid=$s_hotels_sno\"><img src=\"../images/delete.gif\" alt=\"Click to Delete\"></a>";
echo "</font></div></td>";

echo "</tr>";
}

echo " </table>";


}  // end of if hotels

if($s_sales_trans=="t") {



$q_trans_sel ="select quot_trans_sno,req_date_time,f2t,type_of_trans,no_of_units,no_of_paxs,flight_det,sell_rate,tot_sell_rate,booking_status  from quot_trans where ocode='$s_pnr'  order by quot_trans_sno";

$res_trans_sel = pg_query($conn, $q_trans_sel);

 $rows_trans = pg_num_rows($res_trans_sel);

if (!$res_trans_sel) {
echo "An error occured.\n";
exit;
		}

if($rows_trans>0){
echo "<br><table width=\"100%\" border=\"1\" cellpadding=\"1\" cellspacing=\"0\"><tr ><td bgcolor=\"#CCCCCC\"><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><b>Transportation</b></font></div></td><td colspan=\"10\"><div align=\"right\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><a href=\"printtransreq.php?spnr=$s_pnr\">Print Request</a></font></div></td></tr><tr bgcolor=\"#CCCCCC\"><td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><b>From - To</b></font></div></td><td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><b>Units</b></font></div></td><td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><b>Type of Trans</b></font></div></td><td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><b>Date & Time</b></font></div></td><td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><b>Flight Details</b></font></div></td><td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><b>No of Paxs</b></font></div></td><td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><b>Price</b></font></div></td><td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><b>Amend</b></font></div></td><td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><b>Process</b></font></div></td><td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><img src=\"../images/delete.gif\" alt=\"Delete\" ></font></div></td></tr>";


}
while ($rows_trans_sel = pg_fetch_array($res_trans_sel)){

$s_sales_trans_sno = $rows_trans_sel["quot_trans_sno"];
	
$s_req_date_time = $rows_trans_sel["req_date_time"];
$s_f2t = $rows_trans_sel["f2t"];
$s_type_of_trans = $rows_trans_sel["type_of_trans"];
$s_no_of_units = $rows_trans_sel["no_of_units"];
$s_no_of_paxs = $rows_trans_sel["no_of_paxs"];
$s_flight_det = $rows_trans_sel["flight_det"];
$s_sell_rate = $rows_trans_sel["sell_rate"];
$s_tot_sell_rate = $rows_trans_sel["tot_sell_rate"];
$s_booking_status = $rows_trans_sel["booking_status"];

$tot_amt = $tot_amt + $s_tot_sell_rate;

echo "<tr><td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";

echo "$s_f2t";
echo "</font></div></td>";
echo "<td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";
echo $s_no_of_units;
echo "</font></div></td>";
echo "<td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";
echo $s_type_of_trans;
echo "</font></div></td>";
echo "<td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";
echo date('d-M-Y H:i A', strtotime($s_req_date_time));
echo "</font></div></td>";
echo "<td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";

echo $s_flight_det;
echo "</font></div></td>";
echo "<td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";
echo $s_no_of_paxs;
echo "</font></div></td>";
echo "<td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";
echo $s_tot_sell_rate;
echo "</font></div></td>";
echo "<td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";
echo "<a href=\"amendtranssel.php?transid=$s_sales_trans_sno\">Amend</a>";
echo "</font></div></td>";
echo "<td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";
echo "<a href=\"processtranssel.php?transid=$s_sales_trans_sno\">Process</a>";
echo "</font></div></td>";

echo "<td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";
echo "<a href=\"pnrtransdel.php?transid=$s_sales_trans_sno\"><img src=\"../images/delete.gif\" alt=\"Click to Delete\"></a>";
echo "</font></div></td>";

echo "</tr>";
}

echo "</table>";


} //end of if trans

if($s_sales_visa=="t") {


$q_visa_sel ="select quot_visa_sno,req_date_time,no_adults,no_child,no_infant,sell_adults,tot_sell_adults,tot_sell_child,tot_sell_infant,booking_status from quot_visa where ocode='$s_pnr' order by quot_visa_sno";

$res_visa_sel = pg_query($conn, $q_visa_sel);

$rows_visa = pg_num_rows($res_visa_sel);

if (!$res_visa_sel) {
echo "An error occured.\n";
exit;
		}

if($rows_visa>0){
echo "<br><table width=\"100%\" border=\"1\" cellpadding=\"1\" cellspacing=\"0\"><tr bgcolor=\"#CCCCCC\"><td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><b>Visa</b></font></div></td></tr><tr bgcolor=\"#CCCCCC\"><td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><b>Visa Request Date</b></font></div></td><td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><b>Total Paxs</b></font></div></td><td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><b>Adults</b></font></div></td><td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><b>Child</b></font></div></td><td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><b>Infant</b></font></div></td><td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><b>Total Amount</b></font></div></td><td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><b>Amend</b></font></div></td><td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><b>Process</b></font></div></td><td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><img src=\"../images/delete.gif\" alt=\"Delete\" ></font></div></td></tr>";
}
while ($rows_visa_sel = pg_fetch_array($res_visa_sel)){

$s_sales_visa_sno = $rows_visa_sel["quot_visa_sno"];
$s_req_date_time = $rows_visa_sel["req_date_time"];
$s_no_adults = $rows_visa_sel["no_adults"];
$s_no_child = $rows_visa_sel["no_child"];
$s_no_infant = $rows_visa_sel["no_infant"];
$tot_no = $s_no_adults + $s_no_child + $s_no_infant;
$s_sell_adults = $rows_visa_sel["sell_adults"];
$s_tot_sell_adults = $rows_visa_sel["tot_sell_adults"];
$s_tot_sell_child = $rows_visa_sel["tot_sell_child"];
$s_tot_sell_infant = $rows_visa_sel["tot_sell_infant"];
$s_booking_status = $rows_visa_sel["booking_status"];

$s_tot_amount = $s_tot_sell_adults + $s_tot_sell_child + $s_tot_sell_infant;

$tot_amt = $tot_amt + $s_tot_amount;

echo "<tr><td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";

echo date('d-M-Y', strtotime($s_req_date_time));
echo "</font></div></td>";
echo "<td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";
echo $tot_no;
echo "</font></div></td>";
echo "<td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";
echo $s_no_adults;
echo "</font></div></td>";
echo "<td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";

echo $s_no_child;
echo "</font></div></td>";
echo "<td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";
echo $s_no_infant;
echo "</font></div></td>";
echo "<td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";
echo $s_tot_amount;
echo "</font></div></td>";

echo "<td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";
echo "<a href=\"amendvisasel.php?visaid=$s_sales_visa_sno\">Amend</a>";
echo "</font></div></td>";
echo "<td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";
echo "<a href=\"processvisasel.php?visaid=$s_sales_visa_sno\">Process</a>";
echo "</font></div></td>";

echo "<td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";
echo "<a href=\"pnrvisadel.php?visaid=$s_sales_visa_sno\"><img src=\"../images/delete.gif\" alt=\"Click to Delete\"></a>";
echo "</font></div></td>";

echo "</tr>";
}
echo "</table>";

} //end of if visa

if($s_sales_others=="t") {


$q_extra_sel ="select quot_extra_sno,req_date_time,paticulars,sell_rate,booking_status from quot_extra where ocode='$s_pnr' order by quot_extra_sno";

$res_extra_sel = pg_query($conn, $q_extra_sel);

$rows_extra = pg_num_rows($res_extra_sel);

if (!$res_extra_sel) {
echo "An error occured.\n";
exit;
		}

if($rows_extra>0){
echo "<br><table width=\"100%\" border=\"1\" cellpadding=\"1\" cellspacing=\"0\"><tr bgcolor=\"#CCCCCC\"><td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><b>Others / Extras</b></font></div></td></tr><tr bgcolor=\"#CCCCCC\"><td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><b>Request Date</b></font></div></td><td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><b>Paticulars</b></font></div></td><td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><b>Price</b></font></div></td><td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><b>Amend</b></font></div></td><td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><b>Process</b></font></div></td><td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><img src=\"../images/delete.gif\" alt=\"Delete\" ></font></div></td></tr>";
}
while ($rows_extra_sel = pg_fetch_array($res_extra_sel)){

$s_sales_extra_sno = $rows_extra_sel["quot_extra_sno"];

$s_req_date_time = $rows_extra_sel["req_date_time"];

$s_paticulars = $rows_extra_sel["paticulars"];
$s_sell_rate = $rows_extra_sel["sell_rate"];
$s_booking_status = $rows_extra_sel["booking_status"];

$tot_amt = $tot_amt + $s_sell_rate;


echo "<tr><td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";

echo date('d-M-Y', strtotime($s_req_date_time));
echo "</font></div></td>";
echo "<td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";
echo $s_paticulars;
echo "</font></div></td>";
echo "<td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";
echo $s_sell_rate;
echo "</font></div></td>";

echo "<td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";
echo "<a href=\"amendextrasel.php?extraid=$s_sales_extra_sno\">Amend</a>";
echo "</font></div></td>";
echo "<td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";
echo "<a href=\"processextrasel.php?extraid=$s_sales_extra_sno\">Process</a>";
echo "</font></div></td>";

echo "<td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";
echo "<a href=\"pnrextradel.php?extraid=$s_sales_extra_sno\"><img src=\"../images/delete.gif\" alt=\"Click to Delete\"></a>";
echo "</font></div></td>";

echo "</tr>";
}

echo "</table>";


}

echo "<br>";
echo "<font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\" style=\"BACKGROUND-COLOR: #DFDFDF\">Total Amount per pax in RoomType: <b></b></font> ";


$q_mainr ="select " .$qscmain." main_sno from quot_main where ocode='$s_pnr'";

$mainr = pg_query($conn, $q_mainr);

$rows_mainr = pg_num_rows($mainr);

if (!$mainr) {
echo "An error occured.\n";
exit;
		}

if($rows_mainr>0){

echo "<table width=\"100%\" border=\"1\" cellpadding=\"1\" cellspacing=\"0\"><tr>";

}

while ($rows_mainr = pg_fetch_array($mainr)){

for($i=0; $i<count($as_rse1); $i++){
$roomn = $as_rse1[$i];
${sr.$roomn} = $rows_mainr["sell_rate_r".$as_rse1[$i]];
}

for($rn=0; $rn<count($as_rse1); $rn++){

$r_name="";

if($as_rse1[$rn]=="1"){
$r_name = "Single";
}
if($as_rse1[$rn]=="2"){
$r_name = "Double";
}
if($as_rse1[$rn]=="3"){
$r_name = "Triple";
}


echo "<td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";

echo "Per Pax in " . $r_name;

echo "</font></div></td>";

}

echo "</tr><tr>";


for($st=0; $st<count($as_rse1); $st++){


$sr="sr";
$roomn = $as_rse1[$st];



echo "<td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><b>";

echo  ${$sr . $roomn} ;
echo "</b></font></div></td>";


}



}

echo "</tr></table>";

?>

							  </table></td></tr></table> 
						 
						 
                      </td>
                    </tr>
                        </table>




		
							

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


</body>				
</html>
