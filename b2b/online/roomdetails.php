<?
session_start();

// is the one accessing this page logged in or not?
/*if (!isset($_SESSION['db_is_logged_in_umrah'])
   || $_SESSION['db_is_logged_in_umrah'] !== true) {

   // not logged in, move to login page
   header('Location: login.php');
   exit;
}*/
$suserid = $_SESSION["userid"];
$suser_sno = $_SESSION["user_sno"];
$dept = $_SESSION["deptumrah"];
?>
<?
include("../db/db.php");
?>
<center>
<body bgcolor="#00A800" leftmargin="10" topmargin="10" marginwidth="0" marginheight="0">
<table width="100%" height="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF">
  <tr>
    <td>

<table width="100%" height="6%" border="0" cellspacing="0" cellpadding="0" bgcolor="#CAFFCA">
  <tr>
            <td><font size="2" face="Arial, Helvetica, sans-serif"><strong>&nbsp;
              Booking Details </strong></font></td>
            <td valign="top"> <div align="right"><img src="../images/tr.jpg" width="9" height="10"></div></td>
  </tr>
</table>
<table width="100%" height="86%" border="0" cellspacing="0" cellpadding="1" bgcolor="#FFFFFF">
  <tr><td valign="top">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td>
<?$hotel_sel_sno = $_GET["hotid"]; ?>

<?
$g_hot_tot=0;

$q_hotel_sel ="select sales_hotels_sno,user_sno,hotel_id,room_id,cin,cout,no_rooms,no_nights,no_paxs,sell_rate  from sales_hotels where sales_hotels_sno=$hotel_sel_sno";

$res_hotel_sel = pg_query($q_hotel_sel);

if (!$res_hotel_sel) {
echo "An error occured.\n";
exit;
		}
echo "<table width=\"100%\" border=\"1\" cellpadding=\"1\" cellspacing=\"0\"><tr><td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><b>Room Type</b></font></div></td><td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><b>Hotel (City)</b></font></div></td><td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><b>Check In</b></font></div></td><td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><b>Check Out</b></font></div></td><td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><b>Nights</b></font></div></td></tr>";

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


$q_hotel_subsel ="select hotel_name, city from hotels where hotel_id='$s_hotel_id'";

$res_hotel_subsel = pg_query($q_hotel_subsel);

if (!$res_hotel_subsel) {
echo "An error occured.\n";
exit;
		}
while ($rows_hotel_subsel = pg_fetch_array($res_hotel_subsel)){

$s_hotel_name = $rows_hotel_subsel["hotel_name"];
$s_city = $rows_hotel_subsel["city"];
}

$q_rooms_subsel ="select  room_type from rooms where room_id='$s_room_id'";

$res_rooms_subsel = pg_query($q_rooms_subsel);

if (!$res_rooms_subsel) {
echo "An error occured.\n";
exit;
		}
while ($rows_rooms_subsel = pg_fetch_array($res_rooms_subsel)){

$s_room_type = $rows_rooms_subsel["room_type"];
}



//echo $s_hotels_sno;
//echo $s_user_sno;
//echo $s_hotel_id;
//echo $s_room_id;
echo "<tr><td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";

echo " $s_room_type";
echo "</font></div></td>";
echo "<td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";
echo $s_hotel_name;
echo " (" . $s_city . ")";
echo "</font></div></td>";
echo "<td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";
echo date('D, d-M-Y', strtotime($s_cin));
echo "</font></div></td>";
echo "<td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";

echo date('D, d-M-Y', strtotime($s_cout));
echo "</font></div></td>";
echo "<td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";
echo $s_no_nigths;
echo "</font></div></td>";
echo "</tr>";
}
echo "</table>";
?>

<?
$q_meals_sel ="select sales_meals_sno,sales_hotels_sno,sales_hot_meals_sno,user_sno,rate_date,room_id,breakfast,halfboard,fullboard,sahoor,iftar,room_net_rate,room_sell_rate,no_of_paxs,no_of_rooms,day_net_rate,day_sell_rate from sales_meals where sales_hotels_sno=$s_hotels_sno order by sales_meals_sno";

$res_meals_sel = pg_query($q_meals_sel);

if (!$res_meals_sel) {
echo "An error occured.\n";
exit;
		}
echo "<table width=\"100%\" border=\"1\" cellpadding=\"1\" cellspacing=\"0\"><tr><td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><b>Rate Date</b></font></div></td><td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><b>Rate/Night</b></font></div></td><td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><b>No of Rooms</b></font></div></td><td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><b>No of Paxs</b></font></div></td><td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><b>Meals</b></font></div></td><td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><b>Day Total</b></font></div></td></tr>";

while ($rows_meals_sel = pg_fetch_array($res_meals_sel)){

$s_meals_sno = $rows_meals_sel["sales_meals_sno"];
$s_hotels_sno = $rows_meals_sel["sales_hotels_sno"];
$s_hot_meals_sno = $rows_meals_sel["sales_hot_meals_sno"];
$s_user_sno = $rows_meals_sel["user_sno"];
echo "<tr><td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";
 $s_rate_date = $rows_meals_sel["rate_date"];
echo date('D, d-M-Y', strtotime($s_rate_date));
echo "</font></div></td>";
echo "<td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";
echo $s_room_sell_rate = $rows_meals_sel["room_sell_rate"];
echo "</font></div></td>";
echo "<td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";
echo $s_no_of_rooms = $rows_meals_sel["no_of_rooms"];
echo "</font></div></td>";
echo "<td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";
echo $s_no_of_paxs = $rows_meals_sel["no_of_paxs"];
echo "</font></div></td>";

$s_room_id = $rows_meals_sel["room_id"];

echo "<td><table width=\"100%\" border=\"1\" cellpadding=\"1\" cellspacing=\"0\" ><tr>";

$s_breakfast = $rows_meals_sel["breakfast"];
$s_halfboard = $rows_meals_sel["halfboard"];
$s_fullboard = $rows_meals_sel["fullboard"];
$s_sahoor = $rows_meals_sel["sahoor"];
$s_iftar = $rows_meals_sel["iftar"];

if($s_breakfast!="N/A"){ echo "<td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">B/F:" .$s_breakfast . "</font></div></td>";}

if($s_halfboard!="N/A"){ echo "<td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">H/B:" .$s_halfboard . "</font></div></td>";}
if($s_fullboard!="N/A"){ echo "<td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">F/B:" .$s_fullboard . "</font></div></td>";}
if($s_sahoor!="N/A"){ echo "<td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">SAH:" .$s_sahoor . "</font></div></td>";}
if($s_iftar!="N/A"){ echo "<td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">IFT:" .$s_iftar . "</font></div></td>";}



echo "</tr></table></td>";

echo "<td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";
echo $s_day_sell_rate = $rows_meals_sel["day_sell_rate"];
echo "</font></div></td>";

$g_hot_tot = $g_hot_tot + $s_day_sell_rate ;

$s_room_net_rate = $rows_meals_sel["room_net_rate"];

$s_day_net_rate = $rows_meals_sel["day_net_rate"];

echo "</tr>";
}
echo "<tr><td colspan=\"5\" align=\"right\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><strong>Ceiled Total Amount of the Booking in SAUDI RIYALS </strong></font></td><td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";
echo ceil($g_hot_tot);
echo "</font></div></td></tr>";
echo "</table>";
?>

</td></tr>
</table>
</td></tr>
</table>
<table width="100%" height="8%" border="0" cellspacing="0" cellpadding="0" bgcolor="#CAFFCA">
  <tr>
            <td  valign="bottom"  > <img src="../images/bl.jpg" width="9" height="10"></td>
            <td valign="middle"><div align="right">
                <input name="close" type="button" value="  Close  "  onClick="window.close()">&nbsp;&nbsp;&nbsp;
              </div></td>
  </tr>
</table>


</td>
  </tr>
</table>


</body>
</center>
