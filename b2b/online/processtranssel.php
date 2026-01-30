<?
include ("header.php");

?>
<script src="../javascripts/cBoxes.js"></script>
<script>
 var winl = (screen.width - 760) / 2;
 var wint = (screen.height - 550) / 2;
</script>

<script>
document.title= '<? echo $company_name . " ERP - Transportation Processing..."; ?>';
</script>

	<?



 $s_pnr = $_GET["spnr"];
 $g_trans_sno = $_GET["transid"];






?>




<html>
<link rel="stylesheet" type="text/css" href="../calendar/css.css" />
<body leftmargin="0" topmargin="0" rightmargin="0">
<table width="100%" border="0" cellpadding="0" cellspacing="0" style="border-bottom: 1px solid #999999 ;border-left: 3px solid #006600;border-right: 3px solid #006600"><tr>
    <td bgcolor="#CCCCCC"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">&nbsp;You
      are here: <a href="uhome.php">Home</a> &raquo; <a href="bookings.php">Bookings</a> &raquo; Amend Hotel Booking</a></font></td>
  </tr></table>

<table width="100%" border="0" cellpadding="0" cellspacing="0" style="border-bottom: 3px solid #006600; border-right: 3px solid #006600;border-left: 3px solid #006600 ">
  <tr>
    <td width="20%" style="border-right: 1px solid #999999" valign="top"> <table width="100%" border="0" cellpadding="0" cellspacing="0">
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
                      <td bgcolor="#CCCCCC"><strong>Processing Booking </strong></td>
                    </tr></table>
<table width="100%" cellpadding="1" cellspacing="0"><tr>
                      <td  style="border-bottom: 1px solid #999999"><div align="right"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">

				<a href="pnrdet.php?spnr=<? echo $s_pnr ?>"><? echo $s_pnr ?></a>

					  </font></div></td>
                    </tr></table>

<?
$q_trans_sel ="select sales_trans_sno,req_date_time,f2t,type_of_trans,no_of_units,no_of_paxs,flight_det,sell_rate,tot_sell_rate,booking_status,trans_id_s,trans_supplier_confirmation,cus_voucher,cus_paid,occp_bull  from sales_trans where ocode='$s_pnr' and sales_trans_sno=$g_trans_sno";

$res_trans_sel = pg_query($q_trans_sel);

 $rows_trans = pg_num_rows($res_trans_sel);

if (!$res_trans_sel) {
echo "An error occured.\n";
exit;
		}

if($rows_trans>0){
echo "<table width=\"100%\" border=\"1\" cellpadding=\"1\" cellspacing=\"0\"><tr ><td bgcolor=\"#CCCCCC\"><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><b>Transportation</b></font></div></td><td colspan=\"10\"><div align=\"right\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"></font></div></td></tr><tr bgcolor=\"#CCCCCC\"><td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><b>From - To</b></font></div></td><td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><b>Units</b></font></div></td><td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><b>Type of Trans</b></font></div></td><td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><b>Date & Time</b></font></div></td><td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><b>Flight Details</b></font></div></td><td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><b>No of Paxs</b></font></div></td><td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><b>Price</b></font></div></td><td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><b>Staus</b></font></div></td></tr>";



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
$s_trans_id_s = $rows_trans_sel["trans_id_s"];

$trans_supplier_confirmation = $rows_trans_sel["trans_supplier_confirmation"];
$cus_voucher= $rows_trans_sel["cus_voucher"];
$cus_paid= $rows_trans_sel["cus_paid"];
$occp_bull= $rows_trans_sel["occp_bull"];

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
echo $s_booking_status;
echo "</font></div></td>";



echo "</tr>";
}

echo "</table>";


?>






<table style="border: 1px solid red" cellpadding="5" cellspacing="0" width="100%" height="100%">
                                <tr>

                                  <td bgcolor="#FFDFDF" colspan="2">&nbsp;<strong>Transportation Processing...
                                    </strong>                                 </td>
                                </tr>
<script type="text/javascript">
      function hotel_cfno(){

   if ((document.getElementById ("ha_no").value== null) || ((document.getElementById ("ha_no").value).length==0))
   {
      alert ("Sorry, But enter hotel confirmation number");
	  document.getElementById ("ha_no").focus();
   }
   else {
         var hotno = "transconfno.php?"+'<? echo "spnr=".$s_pnr ?>'+
'<? echo "&transid=".$g_trans_sno ?>'+"&hot_rno="+document.getElementById ("ha_no").value;
		document.location.href=hotno ;

      }

}
    </script>

								<tr>
                                  <td style="border-bottom: 1px solid red" align="left">Transportation Supplier Confirmation Number </td>
                                  <td style="border-bottom: 1px solid red" align="left"><div align="left">
                                    <input type="text" id="ha_no" name="ha_no"
									value='<? echo $trans_supplier_confirmation ; ?>' size="3"><br>
                                    <input type="button" id="ha_nab" name="ha_nab" value="Trans Confirmation" onClick="hotel_cfno()">
                                  </div></td>
                                </tr>
<script type="text/javascript">
      function agent_vno(){

   if ((document.getElementById ("ag_vno").value== null) || ((document.getElementById ("ag_vno").value).length==0))
   {
      alert ("Sorry, But enter Agent Voucher number");
	  document.getElementById ("ag_vno").focus();
   }
   else {
         var ag_vn = "agenttransvocno.php?"+'<? echo "spnr=".$s_pnr ?>'+
'<? echo "&transid=".$g_trans_sno ?>'+"&ag_vno="+document.getElementById ("ag_vno").value;
		document.location.href=ag_vn ;

      }

}
    </script>
                                <tr>
                                  <td style="border-bottom: 1px solid red" align="left">Agent Voucher Number / ReConfirmation No                                  </td>
                                  <td style="border-bottom: 1px solid red" align="left"><div align="left">
                                    <input type="text" id="ag_vno" name="ag_vno"
									value='<? echo $cus_voucher ; ?>' size="3">
                                    <br><input type="button" id="ag_vnob" name="ag_vnob" value="Agent Voucher" onClick="agent_vno()">
                                  </div></td>
                                </tr>
<script type="text/javascript">
      function agent_paid(){

   if ((document.getElementById ("pd_amt").value== null) || ((document.getElementById ("pd_amt").value).length==0))
   {
      alert ("Sorry, But enter Agent Paid Amount");
	  document.getElementById ("pd_amt").focus();
   }
   else {
         var pd_amtt = "agenttransbpaid.php?"+'<? echo "spnr=".$s_pnr ?>'+
'<? echo "&transid=".$g_trans_sno ?>'+"&pd_amt="+document.getElementById ("pd_amt").value;
		document.location.href=pd_amtt ;

      }

}
    </script>
                                <tr>
                                  <td style="border-bottom: 1px solid red" align="left">Agent Paid Amount for this booking                                    </td>
                                  <td style="border-bottom: 1px solid red" align="left"><div align="left">
                                    <input type="text" id="pd_amt" name="pd_amt" value='<? echo $cus_paid ; ?>' size="3">
                                    <br><input type="button" id="pd_amtb" name="pd_amtb" value="Paid" onClick="agent_paid()">
                                  </div></td>
                                </tr>
<script type="text/javascript">
      function guest_inh(){


         var rm_not = "guesttransenjoyed.php?"+'<? echo "spnr=".$s_pnr ?>'+
'<? echo "&transid=".$g_trans_sno ?>'+"&rm_no="+document.getElementById ("rm_no").checked;
		document.location.href=rm_not ;



}
    </script>
                                <tr>
                                  <td style="border-bottom: 1px solid red" align="left">Guest Arrived and Enjoyed Transfer!                                  </td>
                                  <td style="border-bottom: 1px solid red" align="left"><div align="left">
<? $check_stat="unchecked" ;
   if($occp_bull=="t"){ $check_stat="checked" ;}
?>
                       <input type="checkbox" id="rm_no" name="rm_no" <? echo $check_stat ; ?> >

                                    <br><input type="button" id="rm_nob" name="rm_nob" value="Enjoyed ?" onClick="guest_inh()">
                                  </div></td>
                                </tr>




                            </table>







			</td>

              </tr></table> </td>
        </tr>
      </table></td></tr>


      </table>
</table>



	</tr></table>





</body>
</html>
