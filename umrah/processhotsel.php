<?
include ("header.php");
?>
<script src="../javascripts/cBoxes.js"></script>
<script>
 var winl = (screen.width - 760) / 2;
 var wint = (screen.height - 550) / 2;
</script>
<script>
document.title= '<? echo $company_name . " ERP - Amend Bookings"; ?>';
</script>
	<?
$vy=$vm=$vd=0;
 $s_pnr = $_GET["spnr"];
 $s_hot_id = $_GET["hotid"];
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
              <?php include  ("umenupreline.php"); ?>
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

$tot_amt = 0;


$q_hotel_sel ="select sales_hotels_sno,user_sno,hotel_id,room_id,cin,cout,no_rooms,no_nights,no_paxs,sell_rate,booking_status,option_date,hotel_confirmation_no,cus_voucher,cus_paid,guest_occ_status,room_inhouseno  from sales_hotels where ocode='$s_pnr' and sales_hotels_sno=$s_hot_id";

$res_hotel_sel = pg_query($conn, $q_hotel_sel);

$rows_hotels = pg_num_rows($res_hotel_sel);

if (!$res_hotel_sel) {
echo "An error occured.\n";
exit;
		}

if($rows_hotels>0){
echo "<table width=\"100%\" border=\"1\" cellpadding=\"1\" cellspacing=\"0\"><tr ><td bgcolor=\"#CCCCCC\"><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><b>Hotels</b></font></div></td><td colspan=\"9\"><div align=\"right\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";


echo "</font></div></td></tr><tr bgcolor=\"#CCCCCC\"><td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><b>Room Type</b></font></div></td><td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><b>Hotel (City)</b></font></div></td><td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><b>Check In</b></font></div></td><td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><b>Check Out</b></font></div></td><td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><b>Rooms</b></font></div></td><td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><b>Price</b></font></div></td><td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><b>Status</b></font></div></td></tr>";
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

$s_option_date	= $rows_hotel_sel["option_date"];
$s_hotel_confirmation_no = $rows_hotel_sel["hotel_confirmation_no"];
$s_cus_voucher = $rows_hotel_sel["cus_voucher"];
$s_cus_paid	= $rows_hotel_sel["cus_paid"];
$s_room_inhouseno = $rows_hotel_sel["room_inhouseno"];
$s_guest_occ_status = $rows_hotel_sel["guest_occ_status"];




$guest_status_cb = "unchecked";

if($s_guest_occ_status=="t"){
$guest_status_cb = "checked";
}



$tot_amt = $tot_amt + $s_sell_rate;

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





$vy=date('Y', strtotime($s_option_date));
$vm=date('m', strtotime($s_option_date));
$vd=date('d', strtotime($s_option_date));

$vhours=date('H', strtotime($s_option_date));
$vmin =date('i', strtotime($s_option_date));




echo "<tr><td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";

echo "<a href=\"roomdetails.php?hotid=$s_hotels_sno\" target=\"hotdetpop\" onClick=\"window.open('', 'hotdetpop','width=700,height=380,menubar=yes,scrollbars=yes, top='+wint+',left='+winl+' ').focus()\" >" . $s_room_type . "</a>";
echo "</font></div></td>";
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
echo $s_no_rooms;
echo "</font></div></td>";
echo "<td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";
echo $s_sell_rate;
echo "</font></div></td>";
echo "<td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";
echo $s_booking_status;
echo "</font></div></td>";


echo "</tr>";
}

echo " </table>";

?>
<!--------Display PNR history---------->
<?php
if(!empty($s_pnr)) {
$pnrquery ="SELECT p.*, u.user_first_name, u.user_last_name FROM pnrhistory p, users u WHERE p.ocode='$s_pnr' AND u.user_sno = p.user_sno ORDER BY created_at ASC";
$pgqpnr = pg_query($conn, $pnrquery);
$pgnrpnr = pg_num_rows($pgqpnr);

if (!$pgqpnr) {
	echo "An error occured.\n";
	exit;
}

if($pgnrpnr>0){
	echo "<br><table width=\"100%\" border=\"1\" cellpadding=\"1\" cellspacing=\"0\"><tr bgcolor=\"#CCCCCC\"><td colspan=5><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><b>PNR History</b></font></div></td></tr><tr bgcolor=\"#CCCCCC\"><td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><b>S.No</b></font></div></td><td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><b>User</b></font></div></td><td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><b>Date Created</b></font></div></td><td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><b>Description</b></font></div></td></tr>";
}
$pnrsno = 1;
while ($pgfapnr = pg_fetch_array($pgqpnr)){
//$pnrsno = $pgfapnr["sno"];
//$pnruserid = $pgfapnr["user_id"];
//$pnrocode = $pgfapnr["ocode"];
$pnrdescription = $pgfapnr["description"];
$pnrcreatedat = $pgfapnr["created_at"];
$pnrusername = $pgfapnr["user_first_name"]." ".$pgfapnr["user_last_name"];

echo "<tr><td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";
echo $pnrsno;
echo "</font></div></td>";
echo "<td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";
echo $pnrusername;
echo "</font></div></td>";
/*echo "<td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";
echo $pnrocode;
echo "</font></div></td>";*/
echo "<td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";
// $datetime = new DateTime("$pnrcreatedat");
echo date('d-M-Y H:i:s', strtotime($pnrcreatedat)) ;
// echo $datetime->format('d-M-Y H:i:s') . "\n";
echo "</font></div></td>";
echo "<td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";
echo $pnrdescription;
echo "</font></div></td></tr>";
$pnrsno ++;
}
echo "</table>";
}
?>

<!--------END - Display PNR history---------->
<br>

<table style="border: 1px solid red" cellpadding="5" cellspacing="0" width="100%" height="100%">
                                <tr>

                                  <td bgcolor="#FFDFDF" colspan="2"><img src="../images/hotel_icon.gif" width="23" height="14">&nbsp;<strong>Hotel Room Type Processing...
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
         var hotno = "hotelconfno.php?"+'<? echo "spnr=".$s_pnr ?>'+
'<? echo "&hotid=".$s_hot_id ?>'+"&hot_rno="+document.getElementById ("ha_no").value;
		document.location.href=hotno ;

      }

}
    </script>

								<tr>
                                  <td style="border-bottom: 1px solid red" align="left">Enter Hotel Confirmation No / Allotment No                                  </td>
                                  <td style="border-bottom: 1px solid red" align="left"><div align="left">
                                    <input type="text" id="ha_no" name="ha_no" value='<? echo $s_hotel_confirmation_no ; ?>' size="10"><br>
                                    <input type="button" id="ha_nab" name="ha_nab" value="Hotel Confirmation" onClick="hotel_cfno()">
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
         var ag_vn = "agentvocno.php?"+'<? echo "spnr=".$s_pnr ?>'+
'<? echo "&hotid=".$s_hot_id ?>'+"&ag_vno="+document.getElementById ("ag_vno").value;
		document.location.href=ag_vn ;

      }

}
    </script>
                                <tr>
                                  <td style="border-bottom: 1px solid red" align="left">Agent Voucher Number / ReConfirmation No                                  </td>
                                  <td style="border-bottom: 1px solid red" align="left"><div align="left">
                                    <input type="text" id="ag_vno" name="ag_vno" value='<? echo $s_cus_voucher ; ?>' size="10">
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
         var pd_amtt = "agentbpaid.php?"+'<? echo "spnr=".$s_pnr ?>'+
'<? echo "&hotid=".$s_hot_id ?>'+"&pd_amt="+document.getElementById ("pd_amt").value+"&pd_details="+document.getElementById ("pd_details").value;
		document.location.href=pd_amtt ;

      }

}
    </script>
                                <tr>
                                  <td style="border-bottom: 1px solid red" align="left">Agent Paid Amount for this booking                                    </td>
                                  <td style="border-bottom: 1px solid red" align="left"><div align="left">
                                    Amount<input type="text" id="pd_amt" name="pd_amt" value='<? echo $s_cus_paid ; ?>' size="10">
                                    <br>Details <textarea id="pd_details" name="pd_details" rows="3" cols="20"></textarea>
                                    <input type="button" id="pd_amtb" name="pd_amtb" value="Paid" onClick="agent_paid()">
                                  </div></td>
                                </tr>
<script type="text/javascript">
      function guest_inh(){

	if (document.getElementById ("guest_scb").checked){

   if ((document.getElementById ("rm_no").value== null) || ((document.getElementById ("rm_no").value).length==0)  || (document.getElementById ("rm_no").value=="No Show") )
   {
      alert ("Sorry, But enter Guest Inhouse Room Number");
	  document.getElementById ("rm_no").focus();
   }
   else {
         var rm_not = "guestinhno.php?"+'<? echo "spnr=".$s_pnr ?>'+
'<? echo "&hotid=".$s_hot_id ?>'+"&rm_no="+document.getElementById ("rm_no").value+"&guest_scb="+document.getElementById ("guest_scb").checked;
		document.location.href=rm_not ;

      }

	}

	else {

		var ns = "No Show";
        var rnv = document.getElementById ("rm_no").value;
    if (rnv.toString() == ns.toString() )
   {

	           var rm_not = "guestinhno.php?"+'<? echo "spnr=".$s_pnr ?>'+
'<? echo "&hotid=".$s_hot_id ?>'+"&rm_no="+document.getElementById ("rm_no").value+"&guest_scb="+document.getElementById ("guest_scb").checked;
		document.location.href=rm_not ;

   }
   else {

			  alert ("Sorry, But enter \"No Show\" ");
	  document.getElementById ("rm_no").focus();


      }


    }








}
    </script>
                                <tr>
                                  <td style="border-bottom: 1px solid red" align="left">Guest Arrived? If yes ! Check the Box & Hotel Room Number                                  </td>
                                  <td style="border-bottom: 1px solid red" align="left"><div align="left">In House<input type="checkbox" id="guest_scb" name="guest_scb" <? echo $guest_status_cb ?> >
                                    <input type="text" id="rm_no" name="rm_no" value='<? echo $s_room_inhouseno ; ?>' size="6">
                                    <br><input type="button" id="rm_nob" name="rm_nob" value="Room Num / No Show" onClick="guest_inh()">
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
