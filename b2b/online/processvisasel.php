<?
include ("header.php");

?>
<script src="../javascripts/cBoxes.js"></script>
<script>
 var winl = (screen.width - 760) / 2;
 var wint = (screen.height - 550) / 2;
</script>

<script>
document.title= '<? echo $company_name . " ERP - Visa Processing..."; ?>';
</script>

	<?



 $s_pnr = $_GET["spnr"];
 $g_visaid = $_GET["visaid"];






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
$q_visa_sel ="select sales_visa_sno,req_date_time,no_adults,no_child,no_infant,net_adults,net_child,net_infant,sell_adults,sell_child,sell_infant,tot_sell_adults,tot_sell_child,tot_sell_infant,booking_status,mofa_bull,cus_voucher,cus_paid from sales_visa where ocode='$s_pnr' and sales_visa_sno=$g_visaid";

$res_visa_sel = pg_query($q_visa_sel);

$rows_visa = pg_num_rows($res_visa_sel);

if (!$res_visa_sel) {
echo "An error occured.\n";
exit;
		}

if($rows_visa>0){
echo "<table width=\"100%\" border=\"1\" cellpadding=\"1\" cellspacing=\"0\"><tr bgcolor=\"#CCCCCC\"><td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><b>Visa</b></font></div></td></tr><tr bgcolor=\"#CCCCCC\"><td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><b>Visa Request Date</b></font></div></td><td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><b>Total Paxs</b></font></div></td><td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><b>Adults</b></font></div></td><td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><b>Child</b></font></div></td><td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><b>Infant</b></font></div></td><td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><b>Total Amount</b></font></div></td><td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><b>Status</b></font></div></td></tr>";
}
while ($rows_visa_sel = pg_fetch_array($res_visa_sel)){

$s_sales_visa_sno = $rows_visa_sel["sales_visa_sno"];
$s_req_date_time = $rows_visa_sel["req_date_time"];
$s_no_adults = $rows_visa_sel["no_adults"];
$s_no_child = $rows_visa_sel["no_child"];
$s_no_infant = $rows_visa_sel["no_infant"];

$tot_no = $s_no_adults + $s_no_child + $s_no_infant;

$s_net_adults = $rows_visa_sel["net_adults"];
$s_net_child = $rows_visa_sel["net_child"];
$s_net_infant = $rows_visa_sel["net_infant"];

$s_sell_adults = $rows_visa_sel["sell_adults"];
$s_sell_child = $rows_visa_sel["sell_child"];
$s_sell_infant = $rows_visa_sel["sell_infant"];

$s_booking_status = $rows_visa_sel["booking_status"];

$mofa_bull= $rows_visa_sel["mofa_bull"];
$cus_voucher= $rows_visa_sel["cus_voucher"];
$cus_paid= $rows_visa_sel["cus_paid"];


$s_tot_sell_adults = $rows_visa_sel["tot_sell_adults"];
$s_tot_sell_child = $rows_visa_sel["tot_sell_child"];
$s_tot_sell_infant = $rows_visa_sel["tot_sell_infant"];


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
echo $s_booking_status;
echo "</font></div></td>";

echo "</tr>";
}
echo "</table>";


?>






<table style="border: 1px solid red" cellpadding="5" cellspacing="0" width="100%" height="100%">
                                <tr>

                                  <td bgcolor="#FFDFDF" colspan="2">&nbsp;<strong>Visa Processing...
                                    </strong>                                 </td>

						<script type="text/javascript">
      function guest_inh(){


         var rm_not = "mofagrant.php?"+'<? echo "spnr=".$s_pnr ?>'+
'<? echo "&visaid=".$g_visaid ?>'+"&rm_no="+document.getElementById ("rm_no").checked;
		document.location.href=rm_not ;



}
    </script>
                                <tr>
                                  <td style="border-bottom: 1px solid red" align="left">Visa Processing by the Ministry (MOFA) </td>
                                  <td style="border-bottom: 1px solid red" align="left"><div align="left">
<? $check_stat="unchecked" ;
   if($mofa_bull=="t"){ $check_stat="checked" ;}
?>
                       <input type="checkbox" id="rm_no" name="rm_no" <? echo $check_stat ; ?> >

                                    <br><input type="button" id="rm_nob" name="rm_nob" value="Granted ?" onClick="guest_inh()">
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
         var ag_vn = "agentvisavocno.php?"+'<? echo "spnr=".$s_pnr ?>'+
'<? echo "&visaid=".$g_visaid ?>'+"&ag_vno="+document.getElementById ("ag_vno").value;
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
         var pd_amtt = "agentvisabpaid.php?"+'<? echo "spnr=".$s_pnr ?>'+
'<? echo "&visaid=".$g_visaid ?>'+"&pd_amt="+document.getElementById ("pd_amt").value;
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
