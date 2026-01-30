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



$s_text = $_POST['tdata'];
$s_text1 = $_POST['tdata'];
$s_text_type = $_POST['texttype'];


$q_text_type="";

if($s_text_type=="pnr"){
$d_tt = "PNR" ;
$q_text_type = $q_text_type ." UPPER(ocode) like ";
$s_text = "%" . strtoupper($s_text) . "%";
}
if($s_text_type=="gname"){
$d_tt = "Guest Name" ;
$q_text_type = $q_text_type ." LOWER(guest_name) like ";
$s_text = "%" . strtolower($s_text) ."%";
}
if($s_text_type=="userid"){
$d_tt = "User ID" ;
$q_text_type = $q_text_type ." LOWER(user_id) like " ;
$s_text = "%" . strtolower($s_text) ."%";
}




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
$q_main_sel ="select main_sno,	ocode,user_sno,user_id,guest_name,order_date,option_date,booking_status,cus_company_name,cus_country,sales_hotels,sales_trans,sales_visa,sales_others from sales_main where $q_text_type '$s_text' order by order_date, guest_name";

$res_main_sel = pg_query($conn, $q_main_sel);

$rows_main = pg_num_rows($res_main_sel);

if (!$res_main_sel) {
echo "An error occured.\n";
exit;
		}

if($rows_main>0){

echo "<table width=\"100%\" border=\"1\" cellpadding=\"1\" cellspacing=\"0\">";

echo "<tr><td colspan=\"8\"><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><b>";

echo "Search Results for <font color=\"#FF0000\">";
echo $d_tt . "</font> with <font color=\"#FF0000\">" . $s_text1 ;

echo "</font></b></font></div></td></td></tr>" ;

echo "<tr><td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><b>PNR</b></font></div></td><td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><b>Guest Name</b></font></div></td><td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><b>Order Date</b></font></div></td><td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><b>User Id</b></font></div></td><td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><b>Company</b></font></div></td><td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><b>Country</b></font></div></td><td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><b>Status</b></font></div></td><td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><b>Details</b></font></div></td></tr>";
}
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
