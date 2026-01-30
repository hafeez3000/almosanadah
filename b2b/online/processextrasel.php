<?
include ("header.php");

?>
<script src="../javascripts/cBoxes.js"></script>
<script>
 var winl = (screen.width - 760) / 2;
 var wint = (screen.height - 550) / 2;
</script>

<script>
document.title= '<? echo $company_name . " ERP - Extras/Others Processing..."; ?>';
</script>

	<?



 $s_pnr = $_GET["spnr"];
 $g_extraid = $_GET["extraid"];






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
$q_extra_sel ="select sales_extra_sno,req_date_time,paticulars,net_rate,sell_rate,booking_status,made_bull,cus_voucher,cus_paid from sales_extra where ocode='$s_pnr' and sales_extra_sno=$g_extraid";

$res_extra_sel = pg_query($q_extra_sel);

$rows_extra = pg_num_rows($res_extra_sel);

if (!$res_extra_sel) {
echo "An error occured.\n";
exit;
		}

if($rows_extra>0){
echo "<table width=\"100%\" border=\"1\" cellpadding=\"1\" cellspacing=\"0\"><tr bgcolor=\"#CCCCCC\"><td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><b>Others / Extras</b></font></div></td></tr><tr bgcolor=\"#CCCCCC\"><td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><b>Request Date</b></font></div></td><td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><b>Paticulars</b></font></div></td><td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><b>Price</b></font></div></td><td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><b>Status</b></font></div></td></tr>";
}
while ($rows_extra_sel = pg_fetch_array($res_extra_sel)){

$s_sales_extra_sno = $rows_extra_sel["sales_extra_sno"];

$s_req_date_time = $rows_extra_sel["req_date_time"];

$s_paticulars = $rows_extra_sel["paticulars"];
$s_net_rate = $rows_extra_sel["net_rate"];
$s_sell_rate = $rows_extra_sel["sell_rate"];
$s_booking_status = $rows_extra_sel["booking_status"];

$made_bull = $rows_extra_sel["made_bull"];
$cus_voucher = $rows_extra_sel["cus_voucher"];
$cus_paid = $rows_extra_sel["cus_paid"];



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
echo $s_booking_status;
echo "</font></div></td>";


echo "</tr>";
}

echo "</table>";


?>






<table style="border: 1px solid red" cellpadding="5" cellspacing="0" width="100%" height="100%">
                                <tr>

                                  <td bgcolor="#FFDFDF" colspan="2">&nbsp;<strong>Extra / Others Processing...
                                    </strong>                                 </td>

						<script type="text/javascript">
      function guest_inh(){


         var rm_not = "extrasarranged.php?"+'<? echo "spnr=".$s_pnr ?>'+
'<? echo "&extraid=".$g_extraid ?>'+"&rm_no="+document.getElementById ("rm_no").checked;
		document.location.href=rm_not ;



}
    </script>
                                <tr>
                                  <td style="border-bottom: 1px solid red" align="left">Made Arragements with Supplier(s) </td>
                                  <td style="border-bottom: 1px solid red" align="left"><div align="left">
<? $check_stat="unchecked" ;
   if($made_bull=="t"){ $check_stat="checked" ;}
?>
                       <input type="checkbox" id="rm_no" name="rm_no" <? echo $check_stat ; ?> >

                                    <br><input type="button" id="rm_nob" name="rm_nob" value="Arranged ?" onClick="guest_inh()">
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
         var ag_vn = "agentextravocno.php?"+'<? echo "spnr=".$s_pnr ?>'+
'<? echo "&extraid=".$g_extraid ?>'+"&ag_vno="+document.getElementById ("ag_vno").value;
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
         var pd_amtt = "agentextrabpaid.php?"+'<? echo "spnr=".$s_pnr ?>'+
'<? echo "&extraid=".$g_extraid ?>'+"&pd_amt="+document.getElementById ("pd_amt").value;
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
