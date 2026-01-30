<?
include ("header.php");
include ("../calendar/cal.php");

?>


<script type="text/javascript">
      function OpenWindow(){

		var rr = "hotelsearch.php?hn="+document.selhotel.hotelname.value;

        var winPop = window.open(rr,"winPop",'scrollbars=yes,toolbar=no,resizable=yes,width=550,height=300' ).focus();
      }
    </script>

<script>
document.title= '<? echo $company_name . " ERP - Umrah Home"; ?>';
</script>

<html>
<link rel="stylesheet" type="text/css" href="../calendar/css.css" />
<body leftmargin="0" topmargin="0" rightmargin="0">
<table width="100%" border="0" cellpadding="0" cellspacing="0" style="border-bottom: 1px solid #999999 ;border-left: 3px solid #006600;border-right: 3px solid #006600"><tr>
    <td bgcolor="#CCCCCC"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">&nbsp;You
      are here: <a href="uhome.php">Home</a> &raquo; <a href="bookings.php">Bookings</a> &raquo; <a href="newbookings.php">New Bookings</a> &raquo; New Hotel Booking</a></font></td>
  </tr></table>

<table width="100%" border="0" cellpadding="0" cellspacing="0" style="border-bottom: 3px solid #006600; border-right: 3px solid #006600;border-left: 3px solid #006600 ">
  <tr>
    <td width="20%" style="border-right: 1px solid #999999"  valign="top"> <table width="100%" border="0" cellpadding="0" cellspacing="0">
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
                      <td bgcolor="#CCCCCC"><strong>New Hotel Booking</strong></td>
                    </tr></table>
<table width="100%" cellpadding="1" cellspacing="0"><tr>
                      <td style="border-bottom: 1px solid #999999"><div align="left"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">
                          <table width="100%" border="0" cellspacing="0">
							 <tr><td colspan="4"><?

  $cind = $_POST['dDay'];
  $cinm = $_POST['dMonth'];
  $ciny = $_POST['dYear'];

 $cin = $ciny."-".$cinm."-".$cind;
 $cindis = $cind." - ".$cinm." - ".$ciny;

 $coutd = $_POST['d1Day'];
 $coutm = $_POST['d1Month'];
 $couty = $_POST['d1Year'];
//echo "<br>";
 $cout = $couty."-".$coutm."-".$coutd;
 $coutdis = $coutd." - ".$coutm." - ".$couty;
//echo "<br>";
 $hotel_id = $_POST['hotelv'];
?>
						  <table width="100%" cellpadding="1" cellspacing="0">
                                  <tr>
                                    <td width="17%" style="border-right: 1px solid #999999"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Check
                                      In</font></td>
                                    <td ><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><? echo $cindis ?></font></td>
                                  </tr>
                                  <tr>
                                    <td style="border-right: 1px solid #999999"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Check
                                      Out</font></td><td><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><? echo $coutdis ?></font></td>
                                  </tr>
                                  <tr>
                                    <td style="border-right: 1px solid #999999"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Hotel
                                      Name</font></td><td><font size="2" face="Verdana, Arial, Helvetica, sans-serif">
									  <?
									  $query_hotel ="select hotel_id, hotel_name, city from hotels where hotel_id='$hotel_id'";

$result_hotel = pg_query($query_hotel);

if (!$result_hotel) {
echo "An error occured.\n";
exit;
		}
while ($rows_hotel = pg_fetch_array($result_hotel)){
$hotel_name_dis = $rows_hotel["hotel_name"];
$hotel_city = $rows_hotel["city"];
}
pg_free_result($result_hotel);

echo $hotel_name_dis;
echo " - " ;
echo $hotel_city;
echo "&nbsp;&nbsp;&nbsp;";
echo "<a href=\"#\">more about hotel...</a>";


									  ?>

									  </font></td>
                                  </tr>

                                </table></td></tr>
                            <tr bgcolor="#EFEFEF">
                              <td colspan="4">
							  <?
$array_room_id = array();
$array_room_type = array();
$array_no_of_paxs = array();
$array_room_description = array();
$query_room ="select room_id, room_type, no_of_paxs,room_description from rooms where room_id like '$hotel_id%'";

$result_room = pg_query($query_room);

if (!$result_room) {
	echo "An error occured.\n";
	exit;
	}
while ($rows_room = pg_fetch_array($result_room)){

$array_room_id[] = $rows_room["room_id"];
$array_room_type[] = $rows_room["room_type"];
$array_no_of_paxs[] = $rows_room["no_of_paxs"];
$array_room_description[] = $rows_room["room_description"];
}
pg_free_result($result_room);


$array_rates_room_id = array();
$array_rate_date = array();
$array_sell_rate = array();
$array_avialibility = array();
$array_avial_bool = array();

$query_rates ="select room_id, rate_date, sell_rate,avialibility,avial_bool, date '$cout'-'$cin' as nts from rates where rate_date between '$cin' and date '$cout' - integer '1' and room_id like '$hotel_id%' order by rate_date";

$result_rates = pg_query($query_rates);

if (!$result_rates) {
	echo "An error occured.\n";
	exit;
	}
while ($rows_rates = pg_fetch_array($result_rates)){

$nts = $rows_rates["nts"];
//$array_rates_room_id[] = $rows_rates["room_id"];
$rid = $rows_rates["room_id"];
$array_rate_date[$rid][] = $rows_rates["rate_date"];
$array_sell_rate[$rid][] = $rows_rates["sell_rate"];
$array_avialibility[$rid][] = $rows_rates["avialibility"];
$array_avial_bool[$rid][] = $rows_rates["avial_bool"];


}
pg_free_result($result_rates);

if(count($array_room_id)>0){
echo "<table width=\"100%\" cellpadding=\"1\" cellspacing=\"0\"><form name=\"roomsel\" method=\"post\" action=\"#\"><thead><tr><td style=\"border-right: 1px solid #999999; border-bottom: 1px solid #999999\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><strong>Room Type</strong></font></td><td align=\"center\" style=\"border-right: 1px solid #999999; border-bottom: 1px solid #999999\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><strong>Select</strong></font></td><td align=\"center\" style=\"border-right: 1px solid #999999; border-bottom: 1px solid #999999\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><strong>Rooms</strong></font></td><td align=\"center\" style=\"border-right: 1px solid #999999;  border-bottom: 1px solid #999999\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><strong>Meals</strong></font></td><td align=\"center\" style=\"border-right: 1px solid #999999;  border-bottom: 1px solid #999999\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><strong>Paxs</strong></font></td><td align=\"center\" style=\" border-bottom: 1px solid #999999\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><strong>Avail</strong></font></td></tr>";
}

for($i=0; $i<count($array_room_id); $i++){
$status=1;
$r_id = $array_room_id[$i];
$no_px = $array_no_of_paxs[$i];
echo "<tr>";
echo "<td  style=\"border-right: 1px solid #999999; border-bottom: 1px solid #999999\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><a href=\"#\">" . $array_room_type[$i] . "</a></font></td>";


for($j=0; $j<$nts; $j++){
//echo "<br>";
//echo $array_rate_date[$r_id][$j];
//echo "&nbsp;&nbsp;&nbsp;";
//echo $array_sell_rate[$r_id][$j];
//echo "&nbsp;&nbsp;&nbsp;";
//echo $array_avialibility[$r_id][$j];
//echo "&nbsp;&nbsp;&nbsp;";
//echo $array_avial_bool[$r_id][$j];

if($array_avialibility[$r_id][$j]==0){$status=0; break;}
elseif($array_avial_bool[$r_id][$j]=='f'){$status=0; break;}
elseif($array_sell_rate[$r_id][$j]==''){$status=0; break;}
elseif($array_sell_rate[$r_id][$j]==0){$status=0; break;}

}
if($status==1){

//echo "<td>A</td>";
echo "<td align=\"center\" style=\"border-right: 1px solid #999999; border-bottom: 1px solid #999999\"><input type=\"checkbox\" name=\"selrcb[]\" value=\"$r_id\"></td><td align=\"center\" style=\"border-right: 1px solid #999999; border-bottom: 1px solid #999999\"><select name=\"rooms\">";
for($rm=1;$rm<=$fix_no_rooms;$rm++){
echo "<option valued=\"$rm\">$rm</option>";
}
echo "</select></td><td align=\"center\" style=\"border-right: 1px solid #999999; border-bottom: 1px solid #999999\"><select name=\"meals\"><option value=\"meals\">Meals</option><option value=\"breakfast\">B/B</option><option value=\"halfboard\">H/B</option><option value=\"fullboard\">F/B</option><option value=\"sahoor\">Sahoor</option><option value=\"iftar\">Iftar</option></select></td>";

echo "<td align=\"center\" style=\"border-right: 1px solid #999999; border-bottom: 1px solid #999999\"><select name=\"meals\"><option value=\"$no_px\" selected>$no_px</option>";
for($px=1;$px<=$no_px*$fix_no_rooms;$px++){
echo "<option valued=\"$px\">$px</option>";
}
echo "</select></td>";
echo "<td align=\"center\" style=\"border-bottom: 1px solid #999999\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><a href=\"#\">Avail</a></font></td>";
}
else {

echo "<td align=\"center\" style=\"border-right: 1px solid #999999; border-bottom: 1px solid #999999\" colspan=\"4\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">Not Available </font></td><td align=\"center\" style=\"border-bottom: 1px solid #999999\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><a href=\"#\">Avail</a></font></td>";
}
echo "</tr>";
}

echo "<tr><td colspan=\"6\" align=\"center\"><input type=\"submit\" value=\"Get Selected Rooms Price\"></td></tr>";
if(count($array_room_id)>0){
echo "</form></table>";
}



?>





							  </td>
                            </tr>
                          </table>
                          </font></div></td>
                    </tr></table>

			</td>
                <td width="15%" style="border-left: 1px solid #999999" valign="top"><table >
                    <tr>
                      <td style="border-bottom: 1px solid #999999"><?php
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
                      <td><div align="center"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><a href="../calendar/index.php">DORS
                          ERP TODO</a></font></div></td>
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
