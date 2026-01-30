<?
session_cache_limiter('must-revalidate');
include ("header.php");
include ("../calendar/cal.php");

?>




<script>
document.title= '<? echo $company_name . " ERP - Umrah New Booking - Price Summary"; ?>';
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
              <?php include  ("umenupreline.php"); ?>
            </div></td>
        </tr>
      </table></td>
    <td width="80%" valign="top"  > <table width="100%" border="0" cellpadding="0" cellspacing="1">
        <tr>
          <td valign="top">


			



            <table width="100%" cellpadding="0" cellspacing="0" ><tr><td width="85%" valign="top">
			<table cellpadding="0" cellspacing="0" width="100%" style="border-top: 1px solid #999999; border-bottom: 1px solid #999999"><tr>
                      <td bgcolor="#CCCCCC"><strong>New Hotel Booking </strong>- Price Summary</td>
                    </tr></table>
<table width="100%" cellpadding="1" cellspacing="0"><tr>
                      <td><div align="left"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">
                          <table width="100%" border="0" cellspacing="0">
							 <tr><td>
  <?

 session_start();

  $cind = $_SESSION['cind'];
  $cinm = $_SESSION['cinm'];
  $ciny = $_SESSION['ciny'];

 $cin = $ciny."-".$cinm."-".$cind;
 $cindis = date('D, d-M-Y', strtotime($cin));

 $coutd = $_SESSION['coutd'];
 $coutm = $_SESSION['coutm'];
 $couty = $_SESSION['couty'];
//echo "<br>";
 $cout = $couty."-".$coutm."-".$coutd;
 $coutdis = date('D, d-M-Y', strtotime($cout));
//echo "<br>";
 $hotel_id = $_SESSION['hotel_id'];
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

$result_hotel = pg_query($conn, $query_hotel);

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
                            <tr>
                              <td bgcolor="#EFEFEF">


<?

$arr_room_id = $_POST["putselrcb"];


$array_room_id = array();
$array_sel_rooms = array();
$array_sel_meals = array();
$array_sel_paxs = array();
$array_p_n_rate = array();
$array_p_rate = array();



for($i=0; $i<count($arr_room_id); $i++){
$array_sel_rooms[] = $_POST["putrooms$arr_room_id[$i]"];
$array_sel_meals[] = $_POST["putmeals$arr_room_id[$i]"];
$array_sel_paxs[] = $_POST["putpaxs$arr_room_id[$i]"];
$array_p_n_rate[] = $_POST["putnrate$arr_room_id[$i]"];
$array_p_rate[] = $_POST["putrate$arr_room_id[$i]"];



$query_room ="select room_id, room_type, no_of_paxs,room_description from rooms where room_id ='$arr_room_id[$i]'";

$result_room = pg_query($conn, $query_room);

if (!$result_room) {
	echo "An error occured.\n";
	exit;
	}


while ($rows_room = pg_fetch_array($result_room)){
//echo $rows_room["room_id"];
$array_room_id[] = $rows_room["room_id"];
$array_room_type[] = $rows_room["room_type"];
}


}


$_SESSION['$array_room_id'] = $array_room_id;

$_SESSION['$array_sel_rooms'] = $array_sel_rooms;
$_SESSION['$array_sel_meals'] = $array_sel_meals;
$_SESSION['$array_sel_paxs'] = $array_sel_paxs;

//print_r($arr_room_id); echo "<br>";
//print_r($array_room_type); echo "<br>";
//print_r($array_p_n_rate); echo "<br>";
//print_r($array_p_rate); echo "<br>";
//print_r($array_sel_rooms); echo "<br>";
//print_r($array_sel_meals); echo "<br>";

//print_r($array_sel_paxs);

$days = (strtotime($cout) - strtotime($cin)) / (60 * 60 * 24);


$ts = strtotime($cin);

$cbd = getdate($ts);
$cbdd = $cbd[mday];
$cbdm =$cbd[mon];
$cbdy =$cbd[year];

$day_room_tot=0;
$day_room_ntot=0;
$hot_tot=0;
$hot_ntot=0;
for($ri=0; $ri<count($array_room_id); $ri++){

echo "<table width=\"100%\" border=\"1\" cellpadding=\"1\" cellspacing=\"0\"><form name=\"roomselput\" method=\"post\" action=\"hotelroomrateputa.php\"><tr><td colspan=\"8\"><div align=\"left\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><b>$array_room_type[$ri]</b></font></div></td></tr><tr><td ><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">Req. Night</font></div></td><td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">Net</font></div></td><td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">Sell</font></div></td><td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">Rooms</font></div></td><td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">Paxs</font></div></td><td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">Meals</font></div></td><td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">T.Net</font></div></td><td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">T.Sell</font></div></td></tr>";


for($d=0; $d<$days; $d++){


echo "<tr><td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">" . date('D, d-M', mktime(0,0,0,$cbdm,$cbdd+$d,$cbdy)) . "</font></div></td><td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><input type=\"text\" id=\"putnrate$ri$d\"  name=\"putnrate$ri$d\" size=\"3\" value='$array_p_n_rate[$ri]' onKeyUp=\"caldayntot$ri$d();ntothot$ri()\"  onFocus=\"caldayntot$ri$d();ntothot$ri()\" onBlur=\"caldayntot$ri$d();ntothot$ri()\"></font></div></td><td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><input type=\"text\" id=\"putrate$ri$d\" name=\"putrate$ri$d\" size=\"3\"  value='$array_p_rate[$ri]' onKeyUp=\"caldaytot$ri$d();tothot$ri()\" onFocus=\"caldaytot$ri$d();tothot$ri()\" onBlur=\"caldaytot$ri$d();tothot$ri()\"></font></div></td><td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">$array_sel_rooms[$ri]<input type=\"hidden\" id=\"noofrooms$ri$d\" name=\"noofrooms$ri$d\" value=\"$array_sel_rooms[$ri]\" ></font></div></td><td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">$array_sel_paxs[$ri]<input type=\"hidden\" id=\"noofpaxs$ri$d\" name=\"noofpaxs$ri$d\" value=\"$array_sel_paxs[$ri]\"></font></div></td><td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><table width=\"100%\" border=\"1\" cellpadding=\"1\" cellspacing=\"0\" align=\"center\"><tr>";

$day_room_tot = $array_p_rate[$ri] * $array_sel_rooms[$ri] ;
$day_room_ntot = $array_p_n_rate[$ri] * $array_sel_rooms[$ri] ;

for($me=0; $me<count($array_sel_meals[$ri]) ; $me++){
echo "<td align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";
echo $array_sel_meals[$ri][$me] ;
echo "<br>";
echo "<input type=\"text\" id=\"meals$ri$me$d\" name=\"meals$ri$me$d\" size=\"1\" value=\"0\" onKeyUp=\"calmealstot$ri$me$d();tothot$ri();calmealsntot$ri$me$d();ntothot$ri()\" onFocus=\"calmealstot$ri$me$d();tothot$ri();calmealsntot$ri$me$d();ntothot$ri()\" onBlur=\"calmealstot$ri$me$d();tothot$ri();calmealsntot$ri$me$d();ntothot$ri()\">";
echo "</font></td>";

?>
<script>

function calmealstot<? echo $ri.$me.$d; ?>(){

var roomt = document.getElementById ('putrate<? echo $ri.$d; ?>').value * document.getElementById ('noofrooms<? echo $ri.$d; ?>').value ;

var mealst = 0;

'<? for($m=0; $m<count($array_sel_meals[$ri]); $m++){?>'

mealst = parseFloat(mealst) + parseFloat(document.getElementById ('meals<? echo $ri.$m.$d; ?>').value);


'<?}?>'



var mealstt = parseFloat(mealst) * document.getElementById ('noofpaxs<? echo $ri.$d; ?>').value ;


document.getElementById ('daytot<? echo $ri.$d; ?>').value = parseFloat(roomt) + parseFloat(mealstt);



}


function calmealsntot<? echo $ri.$me.$d; ?>(){

var nroomt = document.getElementById ('putnrate<? echo $ri.$d; ?>').value * document.getElementById ('noofrooms<? echo $ri.$d; ?>').value ;

var nmealst = 0;

'<? for($m=0; $m<count($array_sel_meals[$ri]); $m++){?>'

nmealst = parseFloat(nmealst) + parseFloat(document.getElementById ('meals<? echo $ri.$m.$d; ?>').value);


'<?}?>'



var nmealstt = parseFloat(nmealst) * document.getElementById ('noofpaxs<? echo $ri.$d; ?>').value ;


document.getElementById ('dayntot<? echo $ri.$d; ?>').value = parseFloat(nroomt) + parseFloat(nmealstt);

}

</script>
<?

}
echo "</tr></table></font></div></td><td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><input type=\"text\" id=\"dayntot$ri$d\" name=\"dayntot$ri$d\" size=\"2\" value='$day_room_ntot' readonly></td><td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><input type=\"text\" id=\"daytot$ri$d\" name=\"daytot$ri$d\" size=\"2\" value='$day_room_tot' readonly></font></div></td></tr>";
$hot_tot = $hot_tot + $day_room_tot;
$hot_ntot = $hot_ntot + $day_room_ntot;
$day_room_tot=0;
$day_room_ntot=0;

?>
<script>
	function caldaytot<? echo $ri.$d; ?>(){
		document.getElementById ('daytot<? echo $ri.$d; ?>').value =  document.getElementById ('putrate<? echo $ri.$d; ?>').value * document.getElementById ('noofrooms<? echo $ri.$d; ?>').value;

}

	function caldayntot<? echo $ri.$d; ?>(){
		document.getElementById ('dayntot<? echo $ri.$d; ?>').value =  document.getElementById ('putnrate<? echo $ri.$d; ?>').value * document.getElementById ('noofrooms<? echo $ri.$d; ?>').value;

}

</script>
<?


}
echo "<tr><td colspan=\"7\"><div align=\"right\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">GT.Net:<br><input type=\"text\" id=\"hotntot$ri\" name=\"hotntot$ri\" size=\"2\" value='$hot_ntot' readonly></font></div></td><td colspan=\"7\"><div align=\"right\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">GT.Sell:<br><input type=\"text\" id=\"hottot$ri\" name=\"hottot$ri\" size=\"2\" value='$hot_tot' readonly></font></div></td></tr>";


?>
<script>
	function tothot<? echo $ri; ?>(){

var hotv=0 ;

'<? for($dd=0; $dd<$days; $dd++){?>'

 hotv = parseFloat(hotv) + parseFloat(document.getElementById ('daytot<? echo $ri.$dd  ; ?>').value);

'<?}?>'
 document.getElementById ('hottot<? echo $ri; ?>').value = hotv;

htotal(gt);
}

function ntothot<? echo $ri; ?>(){

var nhotv=0 ;

'<? for($dd=0; $dd<$days; $dd++){?>'

 nhotv = parseFloat(nhotv) + parseFloat(document.getElementById ('dayntot<? echo $ri.$dd  ; ?>').value);

'<?}?>'
 document.getElementById ('hotntot<? echo $ri; ?>').value = nhotv;
hntotal(gnt);
}


</script>

<script>

function htotal(val){
var gtotv=0 ;

'<? for($gtot=0; $gtot<count($array_room_id); $gtot++){?>'

gtotv = parseFloat(gtotv) + parseFloat(document.getElementById ('hottot<? echo $gtot  ; ?>').value);

'<?}?>'
val.innerHTML = gtotv;
}


function hntotal(val){
var gntotv=0 ;

'<? for($gntot=0; $gntot<count($array_room_id); $gntot++){?>'

gntotv = parseFloat(gntotv) + parseFloat(document.getElementById ('hotntot<? echo $gntot  ; ?>').value);

'<?}?>'
val.innerHTML = gntotv;
}

</script>

<?



echo "<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" ><tr><td bgcolor=\"#FFFFFF\">&nbsp;</td></tr></table>";
$hot_tot=0;
$hot_ntot=0;
}


echo "<tr><td><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">Grand Room(s) Total <FONT
style=\"BACKGROUND-COLOR: #DFDFDF\">NetRate:</FONT> SAR <span id=\"gnt\">0</span>/-</font></td></tr>";


echo "<tr><td align=\"right\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">Grand Room(s) Total <FONT
style=\"BACKGROUND-COLOR: #DFDFDF\">SellingRate:</FONT> SAR <span id=\"gt\">0</span>/-</font></td></tr>";


echo "<tr><td >&nbsp;</td></tr>";

echo "<tr><td align=\"right\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><input type=\"submit\" name=\"submit\" value=\"Book Room(s) >>\" ></font></td></tr>";



echo "</form></table>";
?>

<script>
htotal(gt);
hntotal(gnt);
</script>

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
