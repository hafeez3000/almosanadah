<?
include ("header.php");
include ("../calendar/cal.php");
?>
<script>
document.title= '<? echo $company_name . " ERP - Umrah New Booking - Price Summary"; ?>';
</script>
<script>
function trimString(str) {
  while (str.charAt(0) == ' ')
  str = str.substring(1);
  while (str.charAt(str.length - 1) == ' ')
  str = str.substring(0, str.length - 1);
  return str;
}
</script>
<?

$query_hotel ="select hotel_id, hotel_name, city from hotels order by hotel_name";

$result_hotel = pg_query($query_hotel);

if (!$result_hotel) {
	echo "An error occured.\n";
	exit;
	}
while ($rows_hotel = pg_fetch_array($result_hotel)){

$array_hotel[] = $rows_hotel["hotel_name"];
$array_hotel_id[] = $rows_hotel["hotel_id"];
$array_city[] = $rows_hotel["city"];
}

pg_free_result($result_hotel);


$ss_breakfast =  "breakfast";
$ss_halfboard =  "halfboard";
$ss_fullboard =  "fullboard";
$ss_sahoor =  "sahoor";
$ss_iftar =  "iftar";



session_start();

$_SESSION['a_hotel_name'] = $array_hotel;
$_SESSION['a_hotel_id'] = $array_hotel_id;
$_SESSION['city'] = $array_city;
?>
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
                      <td bgcolor="#CCCCCC"><strong>New Hotel Booking </strong>- Price Summary</td>
                    </tr></table>
<table width="100%" cellpadding="1" cellspacing="0"><tr>
                      <td><div align="left"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">
                          <table width="100%" border="0" cellspacing="0">
							 <tr><td>

<?

if($_SESSION['ch_wep_s']=="t"){

$s_ch_wep = "t";
}
else {
$s_ch_wep = "f";

	}


$s_hotelsmad = $_SESSION["hotelsmad"];

$madcind = $_SESSION['dDay'];
$madcinm = $_SESSION['dMonth'];
$madciny = $_SESSION['dYear'];

$madcin = $madciny ."-". $madcinm ."-". $madcind ;

$madcoutd = $_SESSION['d1Day'];
$madcoutm = $_SESSION['d1Month'];
$madcouty = $_SESSION['d1Year'];

$madcout = $madcouty ."-". $madcoutm ."-". $madcoutd ;

$madcins = date('D, d-M-Y', strtotime($madcin));
$madcouts = date('D, d-M-Y', strtotime($madcout));

$madco = mktime(0,0,0,$madcoutm,$madcoutd,$madcouty);
$madci = mktime(0,0,0,$madcinm,$madcind,$madciny);
$madnights = Round((($madco-$madci)/86400), 0) ;



$madcind1 = $madcind;
$madcinm1 = $madcinm;
$madciny1 = $madciny;

$madcin1 = $madciny1 ."-". $madcinm1 ."-". $madcind1 ;

$madcoutd1 = $madcoutd;
$madcoutm1 = $madcoutm;
$madcouty1 = $madcouty;


$madcout1 = $madcouty1 ."-". $madcoutm1 ."-". $madcoutd1 ;
$madnights1= $madnights;



?>
<br>

<form name="roomselput" action="hotelsel.php"  method="post" onSubmit="return fun2(this)">

 <table width="100%" cellpadding="1" cellspacing="0">
                                   <tr bgcolor="#CCCCCC">
                            <td colspan="2"><b>Selected Hotel<b></td>
                          </tr>
								  <tr>
                                    <td width="17%" style="border-right: 1px solid #999999"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Check
                                      In</font></td>
                                    <td ><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><? echo $madcins ?></font></td>
                                  </tr>
                                  <tr>
                                    <td style="border-right: 1px solid #999999"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Check
                                      Out</font></td><td><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><? echo $madcouts ?></font></td>
                                  </tr>
                                  <tr>
                                    <td style="border-right: 1px solid #999999"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Hotel
                                      Name</font></td><td><font size="2" face="Verdana, Arial, Helvetica, sans-serif">
									  <?
									  $query_hotel ="select hotel_id, hotel_name, city from hotels where hotel_id='$s_hotelsmad'";

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

								</table>
		<table width="100%">

 <tr><td bgcolor="#EFEFEF">

							  <?


$_SESSION["madselrcb"] = $_POST["madselrcb"];

$mad_arr_room_id = $_POST["madselrcb"];



//print_r($arr_room_id);

$mad_array_sel_rooms = array();
$mad_array_sel_meals = array();
$mad_array_sel_paxs = array();

$mad_array_room_id = array();
$mad_array_room_type = array();
$mad_array_no_of_paxs = array();
$mad_array_room_description = array();

for($i=0; $i<count($mad_arr_room_id); $i++){

$query_room ="select room_id, room_type, no_of_paxs from rooms where room_id ='$mad_arr_room_id[$i]'";

$result_room = pg_query($query_room);

if (!$result_room) {
	echo "An error occured.\n";
	exit;
	}
while ($rows_room = pg_fetch_array($result_room)){

$mad_array_room_id[] = $rows_room["room_id"];
$mad_array_room_type[] = $rows_room["room_type"];
$mad_array_no_of_paxs[] = $rows_room["no_of_paxs"];
}
pg_free_result($result_room);

$mad_array_sel_rooms[] = $_POST["madrooms$mad_arr_room_id[$i]"];
$mad_array_sel_meals[] = $_POST["madmeals$mad_arr_room_id[$i]"];
$mad_array_sel_paxs[] =  $_POST["madpaxs$mad_arr_room_id[$i]"];

$mad_array_p_n_rate[] = $_POST["madputnrate$mad_arr_room_id[$i]"];
$mad_array_p_rate[] = $_POST["madputrate$mad_arr_room_id[$i]"];

}


$_SESSION["mad_array_sel_rooms"]=$mad_array_sel_rooms;
$_SESSION["mad_array_sel_meals"]=$mad_array_sel_meals;
$_SESSION["mad_array_sel_paxs"]=$mad_array_sel_paxs;






$mad_day_room_tot=0;
$mad_day_room_ntot=0;
$mad_hot_tot=0;
$mad_hot_ntot=0;

for($ri=0; $ri<count($mad_array_room_id); $ri++){


$mad_rd1 = date('Y-m-d', mktime(0,0,0,$madcinm,$madcind,$madciny));

$query_g_rates ="select room_id,from_date,to_date, weekday_net,weekday_sell,weekend_net,weekend_sell,breakfast,halfboard,fullboard,sahoor,iftar,weekends,wpackage  from res_rates where '$mad_rd1' between from_date and to_date - interval '1 day' and room_id = '$mad_array_room_id[$ri]' ";


$result_rates = pg_query($query_g_rates);

if (!$result_rates) {
	echo "An error occured.\n";
	exit;
	}
while ($rows_rates = pg_fetch_array($result_rates)){
//echo " ";


$a_weekends = explode(",", $rows_rates["weekends"]);



$s_wep = $rows_rates["wpackage"];

}

if($s_ch_wep=="f"){
$s_wep="f";
}

if(trim($s_wep)=="t"){

echo "Weekend Package";




if(count($a_weekends)==2){     // two days weekend


$weekes =  $a_weekends[0];

$weekee =  $a_weekends[1];


if(date('D', strtotime($madcin1))== $weekee){

$madcin1 = date('Y-m-d', mktime(0,0,0,$madcinm1,$madcind1-1,$madciny1));

}




if(date('D', strtotime($madcout1))== $weekee){

$madcout1 = date('Y-m-d', mktime(0,0,0,$madcoutm1,$madcoutd1+1,$madcouty1));

}



}  // end of two days weekend


if(count($a_weekends)==3){     // three days weekend

$weeke0 =  $a_weekends[0];
$weeke1 =  $a_weekends[1];
$weeke2 =  $a_weekends[2];


if(date('D', strtotime($madcin1))== $weeke1){
$madcin1 = date('Y-m-d', mktime(0,0,0,$madcinm1,$madcind1-1,$madciny1));
}
if(date('D', strtotime($madcin1))== $weeke2){
$madcin1 = date('Y-m-d', mktime(0,0,0,$madcinm1,$madcind1-2,$madciny1));
}

if(date('D', strtotime($madcout1))== $weeke1){
$madcout1 = date('Y-m-d', mktime(0,0,0,$madcoutm1,$madcoutd1+2,$madcouty1));
}
if(date('D', strtotime($madcout1))== $weeke2){
$madcout1 = date('Y-m-d', mktime(0,0,0,$madcoutm1,$madcoutd1+1,$madcouty1));
}


}  // end of three days weekend



$madcin1 = date('Y-m-d', strtotime($madcin1));
$madcout1 = date('Y-m-d', strtotime($madcout1));

$madnights1 = Round(((strtotime($madcout1)-strtotime($madcin1))/86400), 0) ;




}







echo "<table width=\"100%\" border=\"1\" cellpadding=\"1\" cellspacing=\"0\"><tr><td colspan=\"8\"><div align=\"left\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><b>$mad_array_room_type[$ri]</b></font></div></td></tr><tr><td ><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">Req. Night</font></div></td><td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">Rate</font></div></td><td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">Rooms</font></div></td><td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">Paxs</font></div></td><td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">Meals</font></div></td><td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">T.Rate</font></div></td></tr>";

for($d=0; $d<$madnights1; $d++){

$mad_rd = date('Y-m-d', mktime(0,0,0,date('m', strtotime($madcin1)),date('d', strtotime($madcin1))+$d,date('Y', strtotime($madcin1)) ));

$query_g_rates ="select room_id,from_date,to_date, weekday_net,weekday_sell,weekend_net,weekend_sell,breakfast,halfboard,fullboard,sahoor,iftar,weekends,wpackage  from res_rates where '$mad_rd' between from_date and to_date - interval '1 day' and room_id = '$mad_array_room_id[$ri]' ";


$result_rates = pg_query($query_g_rates);

if (!$result_rates) {
	echo "An error occured.\n";
	exit;
	}
while ($rows_rates = pg_fetch_array($result_rates)){
//echo " ";


$a_weekends = explode(",", $rows_rates["weekends"]);

 $s_wep = $rows_rates["wpackage"];

for($we=0; $we<count($a_weekends); $we++){

if($a_weekends[$we]==date('D', strtotime($mad_rd))){
$we_bull=1;
break;
}
else{
 $we_bull=0;
}

}

if($we_bull){
 $ridn = $rows_rates["weekend_net"];
  $rids = $rows_rates["weekend_sell"];
}
else {
 $ridn = $rows_rates["weekday_net"];
  $rids = $rows_rates["weekday_sell"];
}

$status=1;
$s_breakfast =  $rows_rates["breakfast"];
$s_halfboard =  $rows_rates["halfboard"];
$s_fullboard =  $rows_rates["fullboard"];
$s_sahoor =  $rows_rates["sahoor"];
$s_iftar =  $rows_rates["iftar"];

}

if($mad_array_p_n_rate[$ri] || $mad_array_p_rate[$ri]){
$ridn = $mad_array_p_n_rate[$ri];
  $rids = $mad_array_p_rate[$ri];
}


echo "<tr><td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">" . date('D, d-M', mktime(0,0,0,date('m', strtotime($madcin1)),date('d', strtotime($madcin1))+$d,date('Y', strtotime($madcin1)))) . "</font></div></td>";

if($mad_array_p_n_rate[$ri] || $mad_array_p_rate[$ri]){
echo "<td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><input type=\"hidden\" id=\"mad_putnrate$ri$d\"  name=\"mad_putnrate$ri$d\" size=\"3\" value=\"$mad_array_p_n_rate[$ri]\" onKeyUp=\"mad_caldayntot$ri$d();mad_ntothot$ri()\"  onFocus=\"mad_caldayntot$ri$d();mad_ntothot$ri()\" onBlur=\"mad_caldayntot$ri$d();mad_ntothot$ri()\" readonly></font></div><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><input type=\"text\" id=\"mad_putrate$ri$d\" name=\"mad_putrate$ri$d\" size=\"3\"  value=\"$mad_array_p_rate[$ri]\" onKeyUp=\"mad_caldaytot$ri$d();mad_tothot$ri()\" onFocus=\"mad_caldaytot$ri$d();mad_tothot$ri()\" onBlur=\"mad_caldaytot$ri$d();mad_tothot$ri()\" readonly></font></div></td>";

}
else{
echo "<td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><input type=\"hidden\" id=\"mad_putnrate$ri$d\"  name=\"mad_putnrate$ri$d\" size=\"3\" value='$ridn' onKeyUp=\"mad_caldayntot$ri$d();mad_ntothot$ri()\"  onFocus=\"mad_caldayntot$ri$d();mad_ntothot$ri()\" onBlur=\"mad_caldayntot$ri$d();mad_ntothot$ri()\" readonly></font></div><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><input type=\"text\" id=\"mad_putrate$ri$d\" name=\"mad_putrate$ri$d\" size=\"3\"  value='$rids' onKeyUp=\"mad_caldaytot$ri$d();mad_tothot$ri()\" onFocus=\"mad_caldaytot$ri$d();mad_tothot$ri()\" onBlur=\"mad_caldaytot$ri$d();mad_tothot$ri()\" readonly></font></div></td>";
}



echo "<td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">$mad_array_sel_rooms[$ri]<input type=\"hidden\" id=\"mad_noofrooms$ri$d\" name=\"mad_noofrooms$ri$d\" value=\"$mad_array_sel_rooms[$ri]\" ></font></div></td><td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">$mad_array_sel_paxs[$ri]<input type=\"hidden\" id=\"mad_noofpaxs$ri$d\" name=\"mad_noofpaxs$ri$d\" value=\"$mad_array_sel_paxs[$ri]\"></font></div></td><td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><table width=\"100%\" border=\"1\" cellpadding=\"1\" cellspacing=\"0\" align=\"center\"><tr>";


$tot_meals = 0;

for($me=0; $me<count($mad_array_sel_meals[$ri]) ; $me++){
echo "<td align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";

echo ucfirst($mad_array_sel_meals[$ri][$me]) ;
$sr_meals="0";

if($ss_breakfast==$mad_array_sel_meals[$ri][$me]){
if(trim($s_breakfast)=="Included"){
$sr_meals="INC";
}
else if(trim($s_breakfast)=="Not Available"){
$sr_meals="NA";
}
else{
$sr_meals=$s_breakfast;
$tot_meals = $tot_meals+$s_breakfast;
}
}


if($ss_halfboard==$mad_array_sel_meals[$ri][$me]){
if(trim($s_halfboard)=="Included"){
$sr_meals="INC";
}
else if(trim($s_halfboard)=="Not Available"){
$sr_meals="NA";
}
else{
$sr_meals=$s_halfboard;
$tot_meals = $tot_meals+$s_halfboard;
}
}

if($ss_fullboard==$mad_array_sel_meals[$ri][$me]){
if(trim($s_fullboard)=="Included" ){
$sr_meals="INC";
}
else if(trim($s_fullboard)=="Not Available"){
$sr_meals="NA";
}
else{
//echo $s_fullboard;
$sr_meals=$s_fullboard;
$tot_meals = $tot_meals+$s_fullboard;
}
}

if($ss_sahoor==$mad_array_sel_meals[$ri][$me]){
if(trim($s_sahoor)=="Included" ){
$sr_meals="INC";
}
else if(trim($s_sahoor)=="Not Available"){
$sr_meals="NA";
}
else{

$sr_meals=$s_sahoor;
$tot_meals = $tot_meals+$s_sahoor;
}
}

if($ss_iftar==$mad_array_sel_meals[$ri][$me]){
if(trim($s_iftar)=="Included" ){
$sr_meals="INC";
}
else if (trim($s_iftar)=="Not Available"){
$sr_meals="NA";
}
else{
//echo $s_iftar;
$sr_meals=$s_iftar;
$tot_meals = $tot_meals+$s_iftar;
}
}




if($mad_array_p_n_rate[$ri] || $mad_array_p_rate[$ri]){

echo "<br>";
echo "<input type=\"text\" id=\"mad_meals$ri$me$d\" name=\"mad_meals$ri$me$d\" size=\"1\" value=\"NA\" onKeyUp=\"mad_calmealstot$ri$me$d();mad_tothot$ri();mad_calmealsntot$ri$me$d();mad_ntothot$ri();roomselput.mad_meals$ri$me$d.value=roomselput.mad_meals$ri$me$d.value.toUpperCase()\" onFocus=\"mad_calmealstot$ri$me$d();mad_tothot$ri();mad_calmealsntot$ri$me$d();mad_ntothot$ri();roomselput.mad_meals$ri$me$d.value=roomselput.mad_meals$ri$me$d.value.toUpperCase()\" onBlur=\"mad_calmealstot$ri$me$d();mad_tothot$ri();mad_calmealsntot$ri$me$d();mad_ntothot$ri();roomselput.mad_meals$ri$me$d.value=roomselput.mad_meals$ri$me$d.value.toUpperCase()\" readonly>";
echo "</font></td>";
$tot_meals=0;
}
else{

echo "<br>";
echo "<input type=\"text\" id=\"mad_meals$ri$me$d\" name=\"mad_meals$ri$me$d\" size=\"1\" value=\"$sr_meals\" onKeyUp=\"mad_calmealstot$ri$me$d();mad_tothot$ri();mad_calmealsntot$ri$me$d();mad_ntothot$ri();roomselput.mad_meals$ri$me$d.value=roomselput.mad_meals$ri$me$d.value.toUpperCase()\" onFocus=\"mad_calmealstot$ri$me$d();mad_tothot$ri();mad_calmealsntot$ri$me$d();mad_ntothot$ri();roomselput.mad_meals$ri$me$d.value=roomselput.mad_meals$ri$me$d.value.toUpperCase()\" onBlur=\"mad_calmealstot$ri$me$d();mad_tothot$ri();mad_calmealsntot$ri$me$d();mad_ntothot$ri();roomselput.mad_meals$ri$me$d.value=roomselput.mad_meals$ri$me$d.value.toUpperCase()\" readonly>";
echo "</font></td>";

}

?>
<script>

function mad_calmealstot<? echo $ri.$me.$d; ?>(){

var roomt = document.getElementById ('mad_putrate<? echo $ri.$d; ?>').value * document.getElementById ('mad_noofrooms<? echo $ri.$d; ?>').value ;

var mealst = 0;
var mea =0;

'<? for($m=0; $m<count($mad_array_sel_meals[$ri]); $m++){?>'

if(trimString(document.getElementById ('mad_meals<? echo $ri.$m.$d; ?>').value)=="INC" || trimString(document.getElementById ('mad_meals<? echo $ri.$m.$d; ?>').value)=="NA"){ mea = 0;}
else{
mea = parseFloat(document.getElementById ('mad_meals<? echo $ri.$m.$d; ?>').value);
}

mealst = mealst + mea;



'<?}?>'



var mealstt = parseFloat(mealst) * document.getElementById ('mad_noofpaxs<? echo $ri.$d; ?>').value ;


document.getElementById ('mad_daytot<? echo $ri.$d; ?>').value = parseFloat(roomt) + parseFloat(mealstt);



}


function mad_calmealsntot<? echo $ri.$me.$d; ?>(){

var nroomt = document.getElementById ('mad_putnrate<? echo $ri.$d; ?>').value * document.getElementById ('mad_noofrooms<? echo $ri.$d; ?>').value ;

var nmealst = 0;
var nmea =0;
'<? for($m=0; $m<count($mad_array_sel_meals[$ri]); $m++){?>'


if(trimString(document.getElementById ('mad_meals<? echo $ri.$m.$d; ?>').value)=="INC" || trimString(document.getElementById ('mad_meals<? echo $ri.$m.$d; ?>').value)=="NA"){ nmea = 0;}
else{
nmea = parseFloat(document.getElementById ('mad_meals<? echo $ri.$m.$d; ?>').value);
}

nmealst = nmealst + nmea;





'<?}?>'



var nmealstt = parseFloat(nmealst) * document.getElementById ('mad_noofpaxs<? echo $ri.$d; ?>').value ;


document.getElementById ('mad_dayntot<? echo $ri.$d; ?>').value = parseFloat(nroomt) + parseFloat(nmealstt);

}

</script>
<?




}


//echo $day_room_tot = $rids * $array_sel_rooms[$ri] ;
//echo $day_room_ntot = $ridn * $array_sel_rooms[$ri] ;

$mad_day_room_tot = $rids * $mad_array_sel_rooms[$ri]   + $mad_array_sel_paxs[$ri]*$tot_meals;
$mad_day_room_ntot = $ridn * $mad_array_sel_rooms[$ri]  + $mad_array_sel_paxs[$ri]*$tot_meals;


echo "</tr></table></font></div></td><td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><input type=\"hidden\" id=\"mad_dayntot$ri$d\" name=\"mad_dayntot$ri$d\" size=\"2\" value='$mad_day_room_ntot' readonly><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><input type=\"text\" id=\"mad_daytot$ri$d\" name=\"mad_daytot$ri$d\" size=\"2\" value='$mad_day_room_tot' readonly></font></div></td></tr>";



$mad_hot_tot = $mad_hot_tot + $mad_day_room_tot;
$mad_hot_ntot = $mad_hot_ntot + $mad_day_room_ntot;
$mad_day_room_tot=0;
$mad_day_room_ntot=0;

?>
<script>
	function mad_caldaytot<? echo $ri.$d; ?>(){
		document.getElementById ('mad_daytot<? echo $ri.$d; ?>').value =  document.getElementById ('mad_putrate<? echo $ri.$d; ?>').value * document.getElementById ('mad_noofrooms<? echo $ri.$d; ?>').value;

'<? for($mer=0; $mer<count($mad_array_sel_meals[$ri]) ; $mer++){ ?>'
 mad_calmealstot<? echo $ri.$mer.$d; ?>();
'<?}?>'

}

	function mad_caldayntot<? echo $ri.$d; ?>(){
		document.getElementById ('mad_dayntot<? echo $ri.$d; ?>').value =  document.getElementById ('mad_putnrate<? echo $ri.$d; ?>').value * document.getElementById ('mad_noofrooms<? echo $ri.$d; ?>').value;

'<? for($mern=0; $mern<count($mad_array_sel_meals[$ri]) ; $mern++){ ?>'
mad_calmealsntot<? echo $ri.$mern.$d; ?>();
'<?}?>'

}

</script>
<?


}
$mad_hot_ntot = ceil($mad_hot_ntot);
$mad_hot_tot = ceil($mad_hot_tot);
echo "<tr><td colspan=\"5\"><div align=\"right\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><br><input type=\"hidden\" id=\"mad_hotntot$ri\" name=\"mad_hotntot$ri\" size=\"2\" value=\"$mad_hot_ntot\" readonly></font></div></td><td colspan=\"5\"><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">GT.Sell:<br><input type=\"text\" id=\"mad_hottot$ri\" name=\"mad_hottot$ri\" size=\"2\" value=\"$mad_hot_tot\" readonly></font></div></td></tr>";



?>
<script>
	function mad_tothot<? echo $ri; ?>(){

var hotv=0 ;

'<? for($dd=0; $dd<$madnights1; $dd++){?>'

 hotv = parseFloat(hotv) + parseFloat(document.getElementById ('mad_daytot<? echo $ri.$dd  ; ?>').value);

'<?}?>'
 document.getElementById ('mad_hottot<? echo $ri; ?>').value = Math.round(hotv);

mad_htotal(mad_gt);
grand_sell(grand_gt);
}

function mad_ntothot<? echo $ri; ?>(){

var nhotv=0 ;

'<? for($dd=0; $dd<$madnights1; $dd++){?>'

 nhotv = parseFloat(nhotv) + parseFloat(document.getElementById ('mad_dayntot<? echo $ri.$dd  ; ?>').value);

'<?}?>'
 document.getElementById ('mad_hotntot<? echo $ri; ?>').value = Math.round(nhotv);
//mad_hntotal(mad_gnt);
//grand_net(grand_gnt);
}


</script>

<script>

function mad_htotal(val){
var gtotv=0 ;

'<? for($gtot=0; $gtot<count($mad_array_room_id); $gtot++){?>'

gtotv = parseFloat(gtotv) + parseFloat(document.getElementById ('mad_hottot<? echo $gtot  ; ?>').value);

'<?}?>'
val.innerHTML = gtotv;
}


function mad_hntotal(val){
var gntotv=0 ;

'<? for($gntot=0; $gntot<count($mad_array_room_id); $gntot++){?>'

gntotv = parseFloat(gntotv) + parseFloat(document.getElementById ('mad_hotntot<? echo $gntot  ; ?>').value);

'<?}?>'
val.innerHTML = gntotv;
}

</script>

<?



echo "<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" ><tr><td bgcolor=\"#FFFFFF\">&nbsp;</td></tr></table>";
$mad_hot_tot=0;
$mad_hot_ntot=0;
}


echo "<tr><td><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><FONT
style=\"BACKGROUND-COLOR: #DFDFDF\"></FONT><span id=\"mad_gnt\" ></span></font></td></tr>";


echo "<tr><td align=\"right\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">Total <FONT
style=\"BACKGROUND-COLOR: #DFDFDF\">SellingRate:</FONT> SAR <span id=\"mad_gt\">0</span>/-</font></td></tr>";


//echo "<tr><td >&nbsp;</td></tr>";

//echo "<tr><td align=\"right\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><input type=\"submit\" name=\"submit\" value=\"Book Room(s) >>\" ></font></td></tr>";



echo "</table>";






						 ?>
<script>
mad_htotal(mad_gt);
//mad_hntotal(mad_gnt);
</script>


</td>
                            </tr>


		</table>




<tr><td>&nbsp;</td></tr>

                                   <tr bgcolor="#CCCCCC">
                            <td colspan="2"><b>Grand Totals</b></td>
                          </tr>

<script>

function grand_net(val){
var g_net=0 ;


g_net = parseFloat(g_net) + parseFloat(document.getElementById("mad_gnt").firstChild.nodeValue);




val.innerHTML = g_net;
}


function grand_sell(val){
var g_sell=0 ;

g_sell = parseFloat(g_sell) + parseFloat(document.getElementById("mad_gt").firstChild.nodeValue);



val.innerHTML = g_sell;
}

</script>

<tr><td><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><FONT
style="BACKGROUND-COLOR: #DFDFDF"></FONT><span id="grand_gnt"></span></font></td></tr>


<tr><td align="right"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><FONT
style="BACKGROUND-COLOR: #DFDFDF">Grand Selling Total:</FONT> SAR <span id="grand_gt">0</span>/-</font></td></tr>


<script>
//grand_net(grand_gnt);
grand_sell(grand_gt);
</script>

                                   <tr>
                            <td colspan="2">&nbsp;</td>
                          </tr>

<tr><td colspan="2" align="center"><input type="submit" value="Get Selected Rooms Price"></td></tr>




</form>





			</td>

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
function fun2(theForm){

var rid = <? echo count($mad_array_room_id) ; ?>

 for (i=0;i<rid;i++ )
 {



if(isNaN(document.getElementById ('mad_hotntot'+i).value)){
alert("Please check the Net Rate Once Again");
return false;
}

 if(isNaN(document.getElementById ('mad_hottot'+i).value)){
alert("Please check the Selling Rate Once Again");
return false;
}



 }


}

</script>


</body>
</html>
