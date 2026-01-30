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
 $g_extraid = $_GET["extraid"];

 $vy1=$vm1=$vd1=0;




if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$_SESSION["spnr"] = $s_pnr ;
$_SESSION["extraid"] = $g_extraid;


?>



<html>
<link rel="stylesheet" type="text/css" href="../calendar/css.css" />
<body leftmargin="0" topmargin="0" rightmargin="0">
<table width="100%" border="0" cellpadding="0" cellspacing="0" style="border-bottom: 1px solid #999999 ;border-left: 3px solid #006600;border-right: 3px solid #006600"><tr>
    <td bgcolor="#CCCCCC"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">&nbsp;You
      are here: <a href="uhome.php">Home</a> &raquo; <a href="bookings.php">Bookings</a>  &raquo; <a href="newbookings.php">New Bookings</a> &raquo; New Transportation Booking</a></font></td>
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


		

            <table width="100%" cellpadding="0" cellspacing="0" ><tr><td width="100%" valign="top">
			<table cellpadding="0" cellspacing="0" width="100%" style="border-top: 1px solid #999999; border-bottom: 1px solid #999999"><tr>
                      <td bgcolor="#CCCCCC"><strong>Amend Extra Booking </strong>- Select Others/Extra for Amendment</td>
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

$vy1=date('Y', strtotime($s_req_date_time));
$vm1=date('m', strtotime($s_req_date_time));
$vd1=date('d', strtotime($s_req_date_time));

?>



<form name="gquot" action="resextraamend.php"  method="post">

<table>

 <tr bgcolor="#E8D2D2">
                                  <td colspan="4" bgcolor="#B9F4AE"><div align="center">

                                  <strong>Other Request Amend</strong> </div></td>
                                </tr>

  <tr><td colspan="4">



					        <table align="center" width="100%">
                              <tr>
                                <td><div align="right"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Requesting
                                    Date</font></div></td>
                                <td colspan="2"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">
                                  <select name="d1Day" class="selBox">
                                  </select>
                                </font><font size="2" face="Verdana, Arial, Helvetica, sans-serif">
                                <select name="d1Month" class="selBox">
                                </select>
                                </font><font size="2" face="Verdana, Arial, Helvetica, sans-serif">
                                <select name="d1Year" class="selBox">
                                </select>
                                </font></td>
                              </tr>
                              <tr>
                                <td><div align="right"><font size="2" face="Arial, Helvetica, sans-serif">Enter
                                    Net Rate</font></div>                                  </td>
                                <td><input type="text" id="other2nrate" name="other2nrate" size="2" value="<? echo $s_net_rate; ?>"></td>
                                <td rowspan="2"><div align="center"><font size="2" face="Arial, Helvetica, sans-serif">Paticulars of the Request<strong>
                                  <textarea id="other2noofa" name="other2noofa" cols="25" rows="3" ><? echo $s_paticulars; ?></textarea>
                                </strong></font></div></td>
                              </tr>
							   <tr>
                                <td><div align="right"><font size="2" face="Arial, Helvetica, sans-serif">Enter
                                    Selling Rate</font></div></td>
                                <td><font size="2" face="Arial, Helvetica, sans-serif"><strong>
                                  <input type="text" id="other2srate" name="other2srate" size="2" value="<? echo $s_sell_rate; ?>">
                                </strong></font></td>
                                </tr>
                            </table>

  </td></tr>


  <tr>
						  <td  colspan="2" align="center"></td>
						  </tr>

 <tr>
                                  <td colspan="4" style="border-top: 1px solid #673636" align="right">


                                      <input type="submit" name="Submit" value="Get Rates >>">                                    </td>
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
