<?
include ("header.php");
include ("../calendar/cal.php");
?>
<script src="../javascripts/cBoxes.js"></script>


<script>
document.title= '<? echo $company_name . " ERP - Umrah New Bookings"; ?>';
</script>

<?
 $s_pnr = $_GET["spnr"];
 $g_visaid = $_GET["visaid"];
$vy1=$vm1=$vd1=0;
$tot_amt = 0;

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$_SESSION["spnr"] = $s_pnr ;
$_SESSION["visaid"] =  $g_visaid;
?>
<html>
<link rel="stylesheet" type="text/css" href="../calendar/css.css" />
<body leftmargin="0" topmargin="0" rightmargin="0">
<table width="100%" border="0" cellpadding="0" cellspacing="0" style="border-bottom: 1px solid #999999 ;border-left: 3px solid #006600;border-right: 3px solid #006600"><tr>
    <td bgcolor="#CCCCCC"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">&nbsp;You
      are here: <a href="uhome.php">Home</a> &raquo; <a href="bookings.php">Bookings</a>
      &raquo; <a href="newbookings.php">New Bookings</a> &raquo; New Visa Booking</a></font></td>
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
                      <td bgcolor="#CCCCCC"><strong>New Visa Booking </strong>-
                        Enter paxs details for visa</td>
                    </tr></table>

<?
$q_visa_sel ="select sales_visa_sno,req_date_time,no_adults,no_child,no_infant,net_adults,net_child,net_infant,sell_adults,sell_child,sell_infant,tot_sell_adults,tot_sell_child,tot_sell_infant,booking_status from sales_visa where ocode='$s_pnr' and sales_visa_sno=$g_visaid";

$res_visa_sel = pg_query($conn, $q_visa_sel);

$rows_visa = pg_num_rows($res_visa_sel);

if (!$res_visa_sel) {
echo "An error occured.\n";
exit;
		}

if($rows_visa>0){
echo "<br><table width=\"100%\" border=\"1\" cellpadding=\"1\" cellspacing=\"0\"><tr bgcolor=\"#CCCCCC\"><td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><b>Visa</b></font></div></td></tr><tr bgcolor=\"#CCCCCC\"><td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><b>Visa Request Date</b></font></div></td><td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><b>Total Paxs</b></font></div></td><td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><b>Adults</b></font></div></td><td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><b>Child</b></font></div></td><td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><b>Infant</b></font></div></td><td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><b>Total Amount</b></font></div></td><td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><b>Status</b></font></div></td></tr>";
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

$vy1=date('Y', strtotime($s_req_date_time));
$vm1=date('m', strtotime($s_req_date_time));
$vd1=date('d', strtotime($s_req_date_time));

?>

<table width="100%" cellpadding="1" cellspacing="0"><tr>
                      <td  style="border-bottom: 1px solid #999999"><div align="left"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">
					   <form name="gquot" method="post" action="amendvisasela.php" >

					        <table align="center">
                              <tr>
                                <td><div align="right"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Requesting
                                    visa Date</font></div></td>
                                <td><font size="2" face="Verdana, Arial, Helvetica, sans-serif">
                                  <select name="d1Day" class="selBox">
                                  </select>
                                  </font></td>
                                <td><font size="2" face="Verdana, Arial, Helvetica, sans-serif">
                                  <select name="d1Month" class="selBox">
                                  </select>
                                  </font></td>
                                <td><font size="2" face="Verdana, Arial, Helvetica, sans-serif">
                                  <select name="d1Year" class="selBox">
                                  </select>
                                  </font></td>
                              </tr>
<script>
function other2nt(){
grand_net(grand_gnt);
}
function other2t(){
grand_sell(grand_gt);
}

function ncc(){
grand_net(grand_gnt);
grand_sell(grand_gt);
}

</script>
							  <tr>
                                <td><div align="right"><font size="2" face="Arial, Helvetica, sans-serif">Enter
                                    No. Adults<br>
                                    ( Age Above 12)</font></div></td>
                                <td colspan="3"><font size="2" face="Arial, Helvetica, sans-serif"><strong>
                                  <input id="noofa" name="noofa" type="text" size="2" value=<? echo $s_no_adults ?> onKeyUp="ncc()"  onFocus="ncc()" onBlur="ncc()" >
                                  </strong></font></td>
                              </tr>
                              <tr>
                                <td><div align="right"><font size="2" face="Arial, Helvetica, sans-serif">Enter
                                    No. Children <br>
                                    (Age Between 2-12)</font></div></td>
                                <td colspan="3"><font size="2" face="Arial, Helvetica, sans-serif"><strong>
                                  <input id="noofc" name="noofc" type="text" size="2" value=<? echo $s_no_child; ?> onKeyUp="ncc()"  onFocus="ncc()" onBlur="ncc()"  >
                                  </strong></font></td>
                              </tr>
                              <tr>
                                <td><div align="right"><font size="2" face="Arial, Helvetica, sans-serif">Enter
                                    No. Infants <br>
                                    ( Age Below 2)</font></div></td>
                                <td colspan="3"><font size="2" face="Arial, Helvetica, sans-serif">
                                  <input id="noofi" name="noofi" type="text" size="2" value=<? echo $s_no_infant; ?> onKeyUp="ncc()"  onFocus="ncc()" onBlur="ncc()"  >
                                  </font></td>
                              </tr>
                              <tr>
                                <td><div align="right"><font size="2" face="Arial, Helvetica, sans-serif">Enter
                                    Adult Visa price in SAR</font></div></td>
                                <td colspan="2"><div align="center"><font size="2" face="Arial, Helvetica, sans-serif">
                                    <font size="2" face="Arial, Helvetica, sans-serif">Net
                                    Price</font><br>
                                    <input id="anetprice" name="anetprice" type="text" size="2" value='<? echo $s_net_adults ?>' onKeyUp="other2nt()"  onFocus="other2nt()" onBlur="other2nt()">
                                    </font></div></td>
                                <td colspan="1"><div align="center"><font size="2" face="Arial, Helvetica, sans-serif">
                                    <font size="2" face="Arial, Helvetica, sans-serif">Sell
                                    Price<br>
                                    </font>
                                    <input id="asellprice" name="asellprice" type="text" size="2" value='<? echo $s_sell_adults ?>' onKeyUp="other2t()"  onFocus="other2t()" onBlur="other2t()">
                                    </font></div></td>
                              </tr>
                              <tr>
                                <td><div align="right"><font size="2" face="Arial, Helvetica, sans-serif">Enter
                                    Child Visa price in SAR</font></div></td>
                                <td colspan="2"><div align="center"><font size="2" face="Arial, Helvetica, sans-serif">
                                    <font size="2" face="Arial, Helvetica, sans-serif">Net
                                    Price</font><br>
                                    <input id="cnetprice" name="cnetprice" type="text" size="2" value='<? echo $s_net_child ?>' onKeyUp="other2nt()"  onFocus="other2nt()" onBlur="other2nt()">
                                    </font></div></td>
                                <td colspan="1"><div align="center"><font size="2" face="Arial, Helvetica, sans-serif">
                                    <font size="2" face="Arial, Helvetica, sans-serif">Sell
                                    Price<br>
                                    </font>
                                    <input id="csellprice" name="csellprice" type="text" size="2" value='<? echo $s_sell_child ?>' onKeyUp="other2t()"  onFocus="other2t()" onBlur="other2t()">
                                    </font></div></td>
                              </tr>
                              <tr>
                                <td><div align="right"><font size="2" face="Arial, Helvetica, sans-serif">Enter
                                    Infant Visa price in SAR</font></div></td>


                                <td colspan="2"><div align="center"><font size="2" face="Arial, Helvetica, sans-serif">
                                    <font size="2" face="Arial, Helvetica, sans-serif">Net
                                    Price</font><br>
                                    <input id="inetprice" name="inetprice" type="text" size="2" value='<? echo $s_net_infant ?>' onKeyUp="other2nt()"  onFocus="other2nt()" onBlur="other2nt()">
                                    </font></div></td>
                                <td colspan="1"><div align="center"><font size="2" face="Arial, Helvetica, sans-serif">
                                    <font size="2" face="Arial, Helvetica, sans-serif">Sell
                                    Price<br>
                                    </font>
                                    <input id="isellprice" name="isellprice" type="text" size="2" value='<? echo $s_sell_infant ?>' onKeyUp="other2t()"  onFocus="other2t()" onBlur="other2t()">
                                    </font></div></td>
                              </tr>


<tr><td colspan="4">&nbsp;</td></tr>

                                   <tr bgcolor="#CCCCCC">
                            <td colspan="4"><b>Grand Totals</b></td>
                          </tr>




<script>

function grand_net(val){
var g_net=0 ;

g_net = parseFloat(g_net) + ( parseFloat(document.getElementById("anetprice").value) * parseFloat(document.getElementById("noofa").value) );
(g_net = parseFloat(g_net) + parseFloat(document.getElementById("cnetprice").value)* parseFloat(document.getElementById("noofc").value) );
(g_net = parseFloat(g_net) + parseFloat(document.getElementById("inetprice").value)* parseFloat(document.getElementById("noofi").value) );


val.innerHTML = g_net;
}


function grand_sell(val){
var g_sell=0 ;

g_sell = parseFloat(g_sell) + ( parseFloat(document.getElementById("asellprice").value) * parseFloat(document.getElementById("noofa").value) );
g_sell = parseFloat(g_sell) + (parseFloat(document.getElementById("csellprice").value)* parseFloat(document.getElementById("noofc").value) );
g_sell = parseFloat(g_sell) + (parseFloat(document.getElementById("isellprice").value)* parseFloat(document.getElementById("noofi").value) );


val.innerHTML = g_sell;
}

</script>

<tr><td><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><FONT
style="BACKGROUND-COLOR: #DFDFDF">Grand Net Total :</FONT> SAR <span id="grand_gnt">0</span>/-</font></td></tr>


<tr><td align="right"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><FONT
style="BACKGROUND-COLOR: #DFDFDF">Grand Selling Total:</FONT> SAR <span id="grand_gt">0</span>/-</font></td></tr>


<script>
grand_net(grand_gnt);
grand_sell(grand_gt);
</script>

                    <tr>
                                <td colspan="4"><div align="center">
                                    <input type="submit" name="Submit" value="Put Rate">
                                  </div></td>
                              </tr>
                            </table>
					   </form>


					  </font></div></td>
                    </tr></table>

			</td>
                <td width="15%" style="border-left: 1px solid #999999" valign="top"><table >
                    <tr>
                      <td style="border-bottom: 1px solid #999999" valign="top"><?php


$time = time();
$today = date('j',$time);
$days = array($today=>array(NULL,NULL,'<span style="color: red; font-weight: bold; font-size: larger; text-decoration: none;">'.$today.'</span>'));
echo generate_calendar(date('Y', $time), date('n', $time), $days, 2);
?>

                        </td>
                    </tr>
					      <tr>
                      <td style="border-bottom: 1px solid #999999"><?php
    $time = time();
    echo generate_calendar(date('Y', $time), date('n', $time)+1, NULL, 2);
?>

                        </td>
                    </tr>
					<tr>

                    </tr>
                  </table>
				</td>
              </tr></table> </td>
        </tr>
      </table></td></tr>


      </table>
</table>



	</tr></table>

<script>


	var dvy1 = <?php echo $vy1; ?>; if (dvy1==0) dvy1=tdddate.getYear()
	var dvm1 = <?php echo $vm1; ?>; if (dvm1==0) dvm1=tdddate.getMonth()
	var dnd1 = <?php echo $vd1; ?>; if (dnd1==0) dnd1=tdddate.getDate()

    if (dvy1 < 2000) dvy1 += 1900;


	var now_date1 = new Date(dvy1,dvm1-1,dnd1);
	now_date1.setDate(now_date1.getDate())

	var now_day1 = now_date1.getDate();
	var now_month1 = now_date1.getMonth();
	var now_year1 = now_date1.getYear();



   	var d2 = new dateObj(document.gquot.d1Day, document.gquot.d1Month, document.gquot.d1Year);
	initDates(dvy1-1, dvy1+1, dvy1, now_month1, now_day1, d2);

</script>

</body>
</html>
