<?
include ("header.php");
include ("../calendar/cal.php");
?>
<script src="../javascripts/cBoxes.js"></script>


<script>
document.title= '<? echo $company_name . " ERP - Umrah New Bookings"; ?>';
</script>


	<?






 if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
 $s_pnr = $_SESSION["spnr"];
 $g_extraid = $_SESSION["extraid"];


?>



<html>
<link rel="stylesheet" type="text/css" href="../calendar/css.css" />
<body leftmargin="0" topmargin="0" rightmargin="0">
<table width="100%" border="0" cellpadding="0" cellspacing="0" style="border-bottom: 1px solid #999999 ;border-left: 3px solid #006600;border-right: 3px solid #006600"><tr>
    <td bgcolor="#CCCCCC"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">&nbsp;You
      are here: <a href="uhome.php">Home</a> &raquo; <a href="bookings.php">Bookings</a>  &raquo; Amend Extra/Other Booking</a></font></td>
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
                      <td bgcolor="#CCCCCC"><strong>Amend Other/Extra Booking </strong></td>
                    </tr></table>
<table width="100%" cellpadding="1" cellspacing="0"><tr>
                      <td  style="border-bottom: 1px solid #999999"><div align="left"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">



					  </font></div></td>
                    </tr></table>

<?

$q_extra_sel ="select sales_extra_sno,req_date_time,paticulars,net_rate,sell_rate,booking_status from sales_extra where ocode='$s_pnr' and sales_extra_sno=$g_extraid";

$res_extra_sel = pg_query($conn, $q_extra_sel);

$rows_extra = pg_num_rows($res_extra_sel);

if (!$res_extra_sel) {
echo "An error occured.\n";
exit;
		}

if($rows_extra>0){
echo "<br><table width=\"100%\" border=\"1\" cellpadding=\"1\" cellspacing=\"0\"><tr bgcolor=\"#CCCCCC\"><td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><b>Others / Extras</b></font></div></td></tr><tr bgcolor=\"#CCCCCC\"><td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><b>Request Date</b></font></div></td><td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><b>Paticulars</b></font></div></td><td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><b>Price</b></font></div></td><td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><b>Status</b></font></div></td></tr>";
}
while ($rows_extra_sel = pg_fetch_array($res_extra_sel)){

$s_sales_extra_sno = $rows_extra_sel["sales_extra_sno"];

$s_req_date_time = $rows_extra_sel["req_date_time"];

$s_paticulars = $rows_extra_sel["paticulars"];
$s_net_rate = $rows_extra_sel["net_rate"];
$s_sell_rate = $rows_extra_sel["sell_rate"];
$s_booking_status = $rows_extra_sel["booking_status"];




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


$_SESSION['d11Day']   = $_POST['d1Day'];
$_SESSION['d11Month'] = $_POST['d1Month'];
$_SESSION['d11Year']  = $_POST['d1Year'];


$_SESSION['other2noofa']=$_POST['other2noofa'];
$_SESSION['other2nrate']=$_POST['other2nrate'];
$_SESSION['other2srate']=$_POST['other2srate'];

$other2noofa=$_POST['other2noofa'];
$other2nrate=$_POST['other2nrate'];
$other2srate=$_POST['other2srate'];


$others2d = $_POST['d1Day'];
$others2m = $_POST['d1Month'];
$others2y = $_POST['d1Year'];

$others2rd = $others2y ."-". $others2m ."-". $others2d ;

?>


<form name="roomselput" action="resextraamenda.php"  method="post">

<table width="100%" cellpadding="1" cellspacing="0">
                                   <tr bgcolor="#FFFFFF">
                            <td colspan="8">&nbsp;</td>
                          </tr>

								   <tr bgcolor="#CCCCCC">
                            <td colspan="8"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Other Request Sno : 2</font></td>
                          </tr>

                                   <tr>
                                     <td colspan="1" align="center" bgcolor="#EFEFEF" style="border-right: 1px solid #999999; border-top: 1px solid #999999"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Request Date </b></font></td>
                                     <td colspan="1" align="center" bgcolor="#EFEFEF" style="border-right: 1px solid #999999; border-top: 1px solid #999999"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b> Paticulars</b></font></td>
                                     <td colspan="1" align="center" bgcolor="#EFEFEF" style="border-right: 1px solid #999999; border-top: 1px solid #999999"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Net Rate</b></font></td>
                                     <td colspan="1" align="center" bgcolor="#EFEFEF" style="border-top: 1px solid #999999"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Sell Rate</b></font></td>
                                   </tr>
                                  <tr>
  <td colspan="1" align="center" bgcolor="#EFEFEF" style="border-right: 1px solid #999999; border-top: 1px solid #999999"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><? echo date('d-M-Y', strtotime($others2rd))  ?> </font></td>

  <td colspan="1" align="center" bgcolor="#EFEFEF" style="border-right: 1px solid #999999; border-top: 1px solid #999999"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"> <? echo $other2noofa  ?></font></td>

    <script>
function other2nt(){
grand_net(grand_gnt);
}
function other2t(){
grand_sell(grand_gt);
}
</script>
  <td colspan="1" align="center" bgcolor="#EFEFEF" style="border-right: 1px solid #999999; border-top: 1px solid #999999"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><input type="text" name="other2net" id="other2net" value='<? echo $other2nrate ?>' size="2" onKeyUp="other2nt()"  onFocus="other2nt()" onBlur="other2nt()"></font></td>
  <td colspan="1" align="center" bgcolor="#EFEFEF" style="border-top: 1px solid #999999"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><input type="text" name="other2sell" id="other2sell" value='<? echo $other2srate ?>' size="2" onKeyUp="other2t()"  onFocus="other2t()" onBlur="other2t()"></font></td>
</tr>
</table>

<tr><td>&nbsp;</td></tr>

                                   <tr bgcolor="#CCCCCC">
                            <td colspan="2"><b>Grand Totals</b></td>
                          </tr>

<script>

function grand_net(val){
var g_net=0 ;


g_net = parseFloat(g_net) + parseFloat(document.getElementById("other2net").value);


val.innerHTML = g_net;
}


function grand_sell(val){
var g_sell=0 ;


g_sell = parseFloat(g_sell) + parseFloat(document.getElementById("other2sell").value);


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
                            <td colspan="2">&nbsp;</td>
                          </tr>

<tr><td colspan="2" align="center"><input type="submit" value="Amend Others/Extra"></td></tr>


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





</body>
</html>
