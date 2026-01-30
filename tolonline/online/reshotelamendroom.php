<?
include ("header.php");
include ("../calendar/cal.php");
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


session_start();

$_SESSION['a_hotel_name'] = $array_hotel;
$_SESSION['a_hotel_id'] = $array_hotel_id;
$_SESSION['city'] = $array_city;


$s_pnr = $_SESSION['pnr'];
$s_hot_id = $_SESSION['hot_id'];



if($_POST["ch_wep"]=="on"){

$s_ch_wep = "t";

$_SESSION['ch_wep_s'] = $s_ch_wep;
}
else { 
$s_ch_wep = "f"; 
$_SESSION['ch_wep_s'] = $s_ch_wep;	
	}

$s_ch_wep = "t";
$_SESSION['ch_wep_s'] = $s_ch_wep;
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
                      <td bgcolor="#CCCCCC"><strong>Amend Hotel Booking </strong></td>
                    </tr></table>
<table width="100%" cellpadding="1" cellspacing="0"><tr>
                      <td  style="border-bottom: 1px solid #999999"><div align="left"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
					   
					
					  
					  </font></div></td>
                    </tr></table>
					
<?

$q_hotel_sel ="select sales_hotels_sno,user_sno,hotel_id,room_id,cin,cout,no_rooms,no_nights,no_paxs,sell_rate,booking_status  from sales_hotels where ocode='$s_pnr' and sales_hotels_sno=$s_hot_id";

$res_hotel_sel = pg_query($q_hotel_sel);

$rows_hotels = pg_num_rows($res_hotel_sel);

if (!$res_hotel_sel) {
echo "An error occured.\n";
exit;
		}

if($rows_hotels>0){
echo "<br><table width=\"100%\" border=\"1\" cellpadding=\"1\" cellspacing=\"0\"><tr ><td bgcolor=\"#CCCCCC\"><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><b>Hotels</b></font></div></td><td colspan=\"9\"><div align=\"right\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";


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

$tot_amt = $tot_amt + $s_sell_rate;

$q_hotel_subsel ="select hotel_name, city from hotels where hotel_id=$s_hotel_id";

$res_hotel_subsel = pg_query($q_hotel_subsel);

if (!$res_hotel_subsel) {
echo "An error occured.\n";
exit;
		}
while ($rows_hotel_subsel = pg_fetch_array($res_hotel_subsel)){

$s_hotel_name = $rows_hotel_subsel["hotel_name"];
$s_city = $rows_hotel_subsel["city"];
}

$q_rooms_subsel ="select  room_type from rooms where room_id=$s_room_id";

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

<?


$s_hotelsmad = $_POST["hotelsmad"];

$madcind = $_POST['dDay'];
$madcinm = $_POST['dMonth'];
$madciny = $_POST['dYear'];

$madcin = $madciny ."-". $madcinm ."-". $madcind ; 

$madcoutd = $_POST['d1Day'];
$madcoutm = $_POST['d1Month'];
$madcouty = $_POST['d1Year'];

$madcout = $madcouty ."-". $madcoutm ."-". $madcoutd ; 


$_SESSION['dDay']  = $_POST['dDay'];
$_SESSION['dMonth'] = $_POST['dMonth'];
$_SESSION['dYear'] = $_POST['dYear'];
$_SESSION['d1Day']  = $_POST['d1Day'];
$_SESSION['d1Month'] = $_POST['d1Month'];
$_SESSION['d1Year'] = $_POST['d1Year'];

$_SESSION["hotelsmad"] = $_POST["hotelsmad"];

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

<form name="gquot" action="resroomamendsel.php"  method="post" onSubmit="return checkval(this)">

 <table width="100%" cellpadding="1" cellspacing="0">
                                   <tr bgcolor="#CCCCCC">
                            <td colspan="2">Hotel Details</td>
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

 <tr bgcolor="#EFEFEF"> 
                              <td colspan="4">
							  <?
$array_room_id = array();
$array_room_type = array();
$array_no_of_paxs = array();
$array_room_description = array();
$query_room ="select room_id, room_type, no_of_paxs from rooms where room_id like '$s_hotelsmad%'";

$result_room = pg_query($query_room);

if (!$result_room) {
	echo "An error occured.\n";
	exit;
	}
while ($rows_room = pg_fetch_array($result_room)){

$array_room_id[] = $rows_room["room_id"];
$array_room_type[] = $rows_room["room_type"];
$array_no_of_paxs[] = $rows_room["no_of_paxs"];
}
pg_free_result($result_room);





if(count($array_room_id)>0){
echo "<table width=\"100%\" cellpadding=\"1\" cellspacing=\"0\"><thead><tr><td style=\"border-top: 1px solid #999999; border-right: 1px solid #999999; border-bottom: 1px solid #999999\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><strong>Room Type</strong></font></td><td align=\"center\" style=\"border-top: 1px solid #999999; border-right: 1px solid #999999; border-bottom: 1px solid #999999\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><strong>Status</strong></font></td><td align=\"center\" style=\"border-top: 1px solid #999999; border-right: 1px solid #999999; border-bottom: 1px solid #999999\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><strong>Rooms</strong></font></td><td align=\"center\" style=\"border-top: 1px solid #999999; border-right: 1px solid #999999;  border-bottom: 1px solid #999999\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><strong>Meals</strong></font></td><td align=\"center\" style=\"border-top: 1px solid #999999; border-right: 1px solid #999999;  border-bottom: 1px solid #999999\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><strong>Paxs</strong></font></td><td align=\"center\" style=\"border-top: 1px solid #999999;  border-bottom: 1px solid #999999\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><strong>Select</strong></font></td></tr>";
}

for($roid=0; $roid<count($array_room_id); $roid++){


$mad_rd1 = date('Y-m-d', mktime(0,0,0,$madcinm,$madcind,$madciny));

$query_g_rates ="select room_id,from_date,to_date, weekday_net,weekday_sell,weekend_net,weekend_sell,breakfast,halfboard,fullboard,sahoor,iftar,weekends,wpackage  from res_rates where '$mad_rd1' between from_date and to_date - interval '1 day' and room_id = $array_room_id[$roid] ";


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


 $s_roid = $array_room_id[$roid];

echo "<tr>";
echo "<td  style=\"border-right: 1px solid #999999; border-bottom: 1px solid #999999\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><a href=\"#\">" . $array_room_type[$roid] . "</a>";

if($madnights==$madnights1){}
else { echo "(WP)"; };

echo "</font></td>";

 

for($madnit=0; $madnit<$madnights1 ;  $madnit++){


$mad_rd = date('Y-m-d', mktime(0,0,0,date('m', strtotime($madcin1)),date('d', strtotime($madcin1))+$madnit,date('Y', strtotime($madcin1)) ));

$query_g_rates ="select room_id,from_date,to_date, weekday_net,weekday_sell,weekend_net,weekend_sell,weekends,wpackage  from res_rates where '$mad_rd' between from_date and to_date - interval '1 day' and room_id = $s_roid ";


$result_rates = pg_query($query_g_rates);

if (!$result_rates) {
	echo "An error occured.\n";
	exit;
	}
while ($rows_rates = pg_fetch_array($result_rates)){
//echo " ";

 
$a_weekends = explode(",", $rows_rates["weekends"]);


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
 $rid = $rows_rates["weekend_sell"];
}
else {
 $rid = $rows_rates["weekday_sell"];
}

$status=1;
}
}


$avail_bull= array();
$avail_rooms = array();
$rooms_booked=array();
$roomstodeduct = 0;

for($madnit=0; $madnit<$madnights1 ;  $madnit++){
$mad_rd1 = date('Y-m-d', mktime(0,0,0,date('m', strtotime($madcin1)),date('d', strtotime($madcin1))+$madnit,date('Y', strtotime($madcin1)) ));

$roomstodeduct = 0;
$query_booked  =  "SELECT ocode,cin, cout, no_rooms, guest_occ_status, cus_paid from sales_hotels where cout between  date '$mad_rd1' - integer '30'  and '$mad_rd1' and cout > '$mad_rd1' and ocode!='NC' and room_id='$s_roid' and booking_status!='Cancelled'  or  cin  between '$mad_rd1' and '$mad_rd1' and ocode!='NC' and room_id='$s_roid' and booking_status!='Cancelled'  or   cin between date '$mad_rd1' - integer '30' and '$mad_rd1' and  cout > '$mad_rd1' and ocode!='NC' and room_id='$s_roid' and booking_status!='Cancelled'   order by cin";
$result_booked = pg_query($query_booked);
$n_booked = pg_num_rows($result_booked);

if($n_booked==0){
//	$rooms_booked[] = 0;
}else {

while ($rows_booked = pg_fetch_array($result_booked)){

//echo "asdf" .$rows_booked["no_rooms"];

if($rows_booked["no_rooms"]==0){
$rooms_booked[] = 0;
}
else{	

$roomstodeduct = $roomstodeduct+$rows_booked["no_rooms"];
}

}

}

$rooms_booked[] = $roomstodeduct;


$query_main ="select avialibility,avial_bool from rates$s_hotelsmad where room_id='$s_roid' and rate_date='$mad_rd1'  ";
$result_main = pg_query($query_main);
$n_check = pg_num_rows($result_main);
if (!$result_main) {
	echo "An error occured.\n";
	exit;
	}
while ($rows_main = pg_fetch_array($result_main)){

if(trim($rows_main["avialibility"])<="0"){
$avail_rooms[] = 0;
$avail_bull[]="f";
break;
}
else{
$avail_rooms[] = $rows_main["avialibility"] - $rooms_booked[$madnit];
}

//echo $rows_main["avial_bool"];
if($rows_main["avial_bool"]=="f"){
$avail_bull[]="f";
$avail_rooms[] = 0;
break;
}
else{
$avail_bull[] = $rows_main["avial_bool"];
}

}





}

$avail_bullt = "f";

for($bc=0; $bc<$madnights1 ;  $bc++){
if($avail_bull[$bc]=="f"){
$avail_bullt = "f";
break;
}
else{
$avail_bullt = "t";
}
}

if($status==1 && $avail_bullt=="t" && min($avail_rooms)>0 ){

//echo "<td>A</td>";
echo "<td align=\"center\" style=\"border-bottom: 1px solid #999999; border-right: 1px solid #999999;\"><img src=\"../images/avail.jpg\" ></td>";

//echo "<td align=\"center\" style=\" border-right: 1px solid #999999; border-bottom: 1px solid #999999\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><strong>&nbsp;</strong></font></td>";
echo "<td align=\"center\" style=\"border-right: 1px solid #999999; border-bottom: 1px solid #999999\">";


echo "<select id=\"madrooms$s_roid\" name=\"madrooms$s_roid\" onChange=\"pc$s_roid()\" >";
for($rm=1;$rm<=min($avail_rooms);$rm++){
echo "<option value=\"$rm\">$rm</option>";
}
echo "</select></td><td align=\"center\" style=\"border-right: 1px solid #999999; border-bottom: 1px solid #999999\"><select name=\"madmeals".$s_roid."[]"."\" MULTIPLE SIZE=\"2\"><option value=\"meals\">Meals</option><option value=\"breakfast\">B/B</option><option value=\"halfboard\">H/B</option><option value=\"fullboard\">F/B</option><option value=\"sahoor\">Sahoor</option><option value=\"iftar\">Iftar</option></select></td>";

echo "<td align=\"center\" style=\"border-right: 1px solid #999999; border-bottom: 1px solid #999999\"> <input type=\"hidden\" id=\"madno_paxs$s_roid\" name=\"madno_paxs$s_roid\" value=\"$array_no_of_paxs[$roid]\"><select id=\"madpaxs$s_roid\" name=\"madpaxs$s_roid\" ><option value=\"$array_no_of_paxs[$roid]\" selected>$array_no_of_paxs[$roid]</option>";
for($px=1;$px<=$array_no_of_paxs[$roid]*$rm;$px++){
echo "<option value=\"$px\">$px</option>";
}
echo "</select></td>";
//echo "<td align=\"center\" style=\"border-bottom: 1px solid #999999\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";

//echo "<a href=\"changeavail.php?roomid=$s_roid&cin=$madcin1&cout=$madcout1\" target=\"hotavail\" onClick=\"window.open('', 'hotavail','width=700,height=380,menubar=yes,scrollbars=yes, top='+wint+',left='+winl+' ').focus()\">Avial</a>";

//echo "</font></td>";

echo "<td align=\"center\" style=\"border-bottom: 1px solid #999999\">";

echo "<input type=\"checkbox\" name=\"madselrcb[]\" value=\"$s_roid\">";
echo "</td>";

?>
<script>
	function pc<? echo $s_roid; ?>(){ document.getElementById ('madpaxs<? echo $s_roid; ?>').value = document.getElementById ('madno_paxs<? echo $s_roid; ?>').value * document.getElementById ('madrooms<? echo $s_roid; ?>').value;
	
	}
</script>
<?


}
else {

//echo "<td align=\"center\" style=\"border-right: 1px solid #999999; border-bottom: 1px solid #999999\" colspan=\"4\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">Not Available </font></td><td align=\"center\" style=\"border-bottom: 1px solid #999999\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><a href=\"#\">Avail</a></font></td>";

echo "<td align=\"center\" style=\"border-bottom: 1px solid #999999; border-right: 1px solid #999999;\"><img src=\"../images/nota.jpg\" ></td><td align=\"center\" style=\"border-right: 1px solid #999999; border-bottom: 1px solid #999999\">";


echo "<select id=\"madrooms$s_roid\" name=\"madrooms$s_roid\" onChange=\"pc$s_roid()\" >";
for($rm=1;$rm<=$online_res_fix_no_rooms;$rm++){
echo "<option value=\"$rm\">$rm</option>";
}
echo "</select></td><td align=\"center\" style=\"border-right: 1px solid #999999; border-bottom: 1px solid #999999\"><select name=\"madmeals".$s_roid."[]"."\" MULTIPLE SIZE=\"2\"><option value=\"meals\">Meals</option><option value=\"breakfast\">B/B</option><option value=\"halfboard\">H/B</option><option value=\"fullboard\">F/B</option><option value=\"sahoor\">Sahoor</option><option value=\"iftar\">Iftar</option></select></td>";

echo "<td align=\"center\" style=\"border-right: 1px solid #999999; border-bottom: 1px solid #999999\"> <input type=\"hidden\" id=\"madno_paxs$s_roid\" name=\"madno_paxs$s_roid\" value=\"$array_no_of_paxs[$roid]\"><select id=\"madpaxs$s_roid\" name=\"madpaxs$s_roid\" ><option value=\"$array_no_of_paxs[$roid]\" selected>$array_no_of_paxs[$roid]</option>";
for($px=1;$px<=$array_no_of_paxs[$roid]*$rm;$px++){
echo "<option value=\"$px\">$px</option>";
}
echo "</select></td>";

//echo "<td align=\"center\" style=\"border-bottom: 1px solid #999999\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";

// echo "<a href=\"changeavail.php?roomid=$s_roid&cin=$madcin1&cout=$madcout1\" target=\"hotavail\" onClick=\"window.open('', 'hotavail','width=700,height=380,menubar=yes,scrollbars=yes, top='+wint+',left='+winl+' ').focus()\">Avial</a>";

//echo "</font></td>";

echo "<td align=\"center\" style=\"border-bottom: 1px solid #999999;\"><img src=\"../images/requ.jpg\" ></td><td align=\"center\" style=\"border-right: 1px solid #999999; border-bottom: 1px solid #999999\">";


?>
<script>
	function pc<? echo $s_roid; ?>(){ document.getElementById ('madpaxs<? echo $s_roid; ?>').value = document.getElementById ('madno_paxs<? echo $s_roid; ?>').value * document.getElementById ('madrooms<? echo $s_roid; ?>').value;
	
	}
</script>
<?



}
//echo "<br>";

}














?>



							  
							  </td>
                            </tr>		
<tr><td colspan="8" align="center"><br><input type="submit" value="Get Selected Rooms Price"></td></tr>
		
		</table>


</form>
		

			</td> 
              </tr></table> </td>
        </tr>
      </table></td></tr>
	  
	  
      </table> 
</table>	
	
	

	</tr></table>



<script>
function checkval(theForm){

var chks = document.getElementsByName('madselrcb[]');
//alert("i got it");
//alert(chks.length);

if(chks.length==0){
alert("Rooms are are Not Available for online booking please Request by Email");
return false;
}
else {

var chks = document.getElementsByName('madselrcb[]');
var hasChecked = false;
for (var i = 0; i < chks.length; i++)
{
if (chks[i].checked)
{
hasChecked = true;
break;
}
}
if (!hasChecked)
{
alert("Please select at least one.");
chks[0].focus();
return false;
}
return true;

}

}






</script>

</body>				
</html>
