<?

include ("header.php");
?>



<script>
document.title= '<? echo $company_name . " ERP - Bookings by Order Date"; ?>';
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
      are here: <a href="uhome.php">Home</a> &raquo; <a href="bookings.php">Booking Details</a> &raquo; Bookings by Order Date</font></td>
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
<?           
$reqd = $_POST['dDay'];
$reqm = $_POST['dMonth'];
$reqy = $_POST['dYear'];		

 $from_date = $reqy."-".$reqm."-".$reqd;

 $from_date_re = $reqd."-".$reqm."-".$reqy;


$reqd1 = $_POST['dDay1'];
$reqm1 = $_POST['dMonth1'];
$reqy1 = $_POST['dYear1'];						 

 $to_date = $reqy1."-".$reqm1."-".$reqd1;

 $to_date_re = $reqd1."-".$reqm1."-".$reqy1;


 $s_booking_status = $_POST['booking_status'];
 $s_type_booking = $_POST['type_booking'];
$s_agentname = $_POST['agentname'];


$q_agentname="";

if($s_agentname!="All"){
 $q_agentname=" and cus_account_code = " . $s_agentname ;
}


$q_type_booking="";
$s_tb="";

$sr_hotels_ocode = array();
$sr_trans_ocode = array();
$sr_visa_ocode = array();
$sr_extra_ocode = array();

$sr_ocode = array();

$sr_all = array();


if($s_type_booking=="hotels"){


$q_hotel_sel ="select ocode from sales_hotels where cin between '$from_date' and  '$to_date'  and booking_status like '$s_booking_status'   $q_agentname order by cin";

$res_hotel_sel = pg_query($conn, $q_hotel_sel);

if (!$res_hotel_sel) {
echo "An error occured.\n";
exit;
		}
while ($rows_hotel_sel = pg_fetch_array($res_hotel_sel)){
$sr_hotels_ocode[] = $rows_hotel_sel["ocode"];


}



}



if($s_type_booking=="trans"){

$q_trans_sel ="select ocode from sales_trans where req_date_time between '$from_date' and '$to_date' and booking_status like '$s_booking_status' $q_agentname order by req_date_time";

$res_trans_sel = pg_query($conn, $q_trans_sel);

if (!$res_trans_sel) {
echo "An error occured.\n";
exit;
		}
while ($rows_trans_sel = pg_fetch_array($res_trans_sel)){
$sr_trans_ocode[] = $rows_trans_sel["ocode"];

}
}

if($s_type_booking=="visa"){
$s_tb = "Visa";
$q_type_booking = $q_type_booking ." and sales_visa='true'"; 

$q_visa_sel ="select ocode from sales_visa where req_date_time between '$from_date' and date '$to_date' + integer '1' and booking_status like '$s_booking_status' $q_agentname order by req_date_time";

$res_visa_sel = pg_query($conn, $q_visa_sel);

if (!$res_visa_sel) {
echo "An error occured.\n";
exit;
		}
while ($rows_visa_sel = pg_fetch_array($res_visa_sel)){
$sr_visa_ocode[] = $rows_visa_sel["ocode"];

}



}

if($s_type_booking=="others"){

$q_extra_sel ="select ocode from sales_extra where req_date_time between '$from_date' and '$to_date' and booking_status like '$s_booking_status' $q_agentname order by req_date_time";

$res_extra_sel = pg_query($conn, $q_extra_sel);

if (!$res_extra_sel) {
echo "An error occured.\n";
exit;
		}
while ($rows_extra_sel = pg_fetch_array($res_extra_sel)){
$sr_extra_ocode[] = $rows_extra_sel["ocode"];

}

}


if($s_type_booking=="all"){


$q_hotel_sel ="select ocode from sales_hotels where cin between '$from_date' and '$to_date' and booking_status like '$s_booking_status' $q_agentname order by cin";

$res_hotel_sel = pg_query($conn, $q_hotel_sel);

if (!$res_hotel_sel) {
echo "An error occured.\n";
exit;
		}
while ($rows_hotel_sel = pg_fetch_array($res_hotel_sel)){
$sr_hotels_ocode[] = $rows_hotel_sel["ocode"];
}



$q_trans_sel ="select ocode from sales_trans where req_date_time between '$from_date' and '$to_date' and booking_status like '$s_booking_status' $q_agentname order by req_date_time";

$res_trans_sel = pg_query($conn, $q_trans_sel);

if (!$res_trans_sel) {
echo "An error occured.\n";
exit;
		}
while ($rows_trans_sel = pg_fetch_array($res_trans_sel)){
$sr_trans_ocode[] = $rows_trans_sel["ocode"];

}



$q_visa_sel ="select ocode from sales_extra where req_date_time between '$from_date' and '$to_date' and booking_status like '$s_booking_status' $q_agentname order by req_date_time";

$res_visa_sel = pg_query($conn, $q_visa_sel);

if (!$res_visa_sel) {
echo "An error occured.\n";
exit;
		}
while ($rows_visa_sel = pg_fetch_array($res_visa_sel)){
$sr_visa_ocode[] = $rows_visa_sel["ocode"];

}


$q_extra_sel ="select ocode from sales_extra where req_date_time between '$from_date' and '$to_date' and booking_status like '$s_booking_status' $q_agentname order by req_date_time";

$res_extra_sel = pg_query($conn, $q_extra_sel);

if (!$res_extra_sel) {
echo "An error occured.\n";
exit;
		}
while ($rows_extra_sel = pg_fetch_array($res_extra_sel)){
$sr_extra_ocode[] = $rows_extra_sel["ocode"];

}

}

$sru_all = array_unique($sr_all);





$result = array_merge($sr_hotels_ocode, $sr_trans_ocode, $sr_visa_ocode, $sr_extra_ocode);
$result = array_unique($result);
sort($result);


?>			


			
            <table width="100%" cellpadding="0" cellspacing="0" ><tr><td width="85%" valign="top"> 
			<table cellpadding="0" cellspacing="0" width="100%" style="border-top: 1px solid #999999; border-bottom: 1px solid #999999"><tr>
                      <td bgcolor="#CCCCCC"><strong>Bookings by Order Date</strong></td>
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

if(count($result)>0){

echo "<table width=\"100%\" border=\"1\" cellpadding=\"1\" cellspacing=\"0\"><tr>";

echo "<td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><b>PNR</b></font></div></td><td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><b>Guest Name</b></font></div></td><td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><b>Order Date</b></font></div></td><td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><b>User Id</b></font></div></td><td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><b>Company</b></font></div></td><td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><b>Country</b></font></div></td><td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><b>Status</b></font></div></td><td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><b>Details</b></font></div></td></tr>";

for($i=0; $i<count($result); $i++) {

$sru_alli = $result[$i];


$q_main_sel ="select main_sno,	ocode,user_sno,user_id,guest_name,order_date,option_date,booking_status,cus_company_name,cus_country,sales_hotels,sales_trans,sales_visa,sales_others from sales_main where ocode='$result[$i]' ";



$res_main_sel = pg_query($conn, $q_main_sel);

$rows_main = pg_num_rows($res_main_sel);

if (!$res_main_sel) {
echo "An error occured.\n";
exit;
		}

if($rows_main>0){

while ($rows_main_sel = pg_fetch_array($res_main_sel)){

    
$s_main_sno = $rows_main_sel["main_sno"];

$s_ocode = $rows_main_sel["ocode"];
$s_user_sno = $rows_main_sel["user_sno"];
$s_user_id = $rows_main_sel["user_id"];
$s_guest_name = $rows_main_sel["guest_name"];
$s_order_date = $rows_main_sel["order_date"];
$s_booking_status = $rows_main_sel["booking_status"];
$s_option_date = $rows_main_sel["option_date"];
$s_cus_company_name = $rows_main_sel["cus_company_name"];
$s_cus_country = $rows_main_sel["cus_country"];
$s_sales_hotels = $rows_main_sel["sales_hotels"];
$s_sales_trans = $rows_main_sel["sales_trans"];
$s_sales_visa = $rows_main_sel["sales_visa"];
$s_sales_others = $rows_main_sel["sales_others"];





echo "<tr><td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";
echo $s_ocode;
echo "</font></div></td>";
echo "<td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";
echo $s_guest_name;
echo "</font></div></td>";
echo "<td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";
echo date('d-M', strtotime($s_order_date));
echo "</font></div></td>";
echo "<td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";

echo $s_user_id;
echo "</font></div></td>";
echo "<td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";
echo $s_cus_company_name;
echo "</font></div></td>";
echo "<td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";
echo $s_cus_country;
echo "</font></div></td>";
echo "<td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";
echo $s_booking_status;
echo "</font></div></td>";
echo "<td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";
echo "<a href=\"pnrdet.php?spnr=$s_ocode\" >Details</a>";
echo "</font></div></td>";

echo "</tr>";
}

}

} // end of for loop

}
?>
</td></tr></table> 
						 
						 
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
