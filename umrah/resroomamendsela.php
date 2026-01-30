<?
include ("header.php");
?>

<script>
document.title= '<? echo $company_name . " ERP - Reservation Booking"; ?>';
</script>

<html>
<link rel="stylesheet" type="text/css" href="../calendar/css.css" />
<center>
<body leftmargin="0" topmargin="0" rightmargin="0">
<br><br><br>
<? include ("gprocessing.html");

$s_wep = isset($_SESSION['ch_wep_s']) ? $_SESSION['ch_wep_s'] : 'f';
$a_weekends = array();
//$suserid;
//$suser_sno;

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$s_pnr = $_SESSION['pnr'];
$s_hot_id = $_SESSION['hot_id'];
$s_ins_user_sno = $_SESSION['ins_user_sno'];
//$_SESSION["hotcb0"];
//$_SESSION["hotcb1"];

if($_SESSION['ch_wep_s']=="t"){

$s_ch_wep = "t";
}
else {
$s_ch_wep = "f";

	}


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


$s_hotelsmad = $_SESSION["hotelsmad"];

$mad_array_room_id = $_SESSION["madselrcb"];

$mad_array_sel_rooms  = $_SESSION["mad_array_sel_rooms"];
$mad_array_sel_meals  = $_SESSION["mad_array_sel_meals"];
$mad_array_sel_paxs	  = $_SESSION["mad_array_sel_paxs"];



$mad_s_breakfast="N/A";
$mad_s_halfboard="N/A";
$mad_s_fullboard="N/A";
$mad_s_sahoor="N/A";
$mad_s_iftar="N/A";

for($ri=0; $ri<count((array)$mad_array_room_id); $ri++){  //start for room_id


$mad_rd1 = date('Y-m-d', mktime(0,0,0,$madcinm,$madcind,$madciny));

$query_g_rates ="select room_id,from_date,to_date, weekday_net,weekday_sell,weekend_net,weekend_sell,breakfast,halfboard,fullboard,sahoor,iftar,weekends,wpackage  from res_rates where '$mad_rd1' between from_date and to_date - interval '1 day' and room_id = '$mad_array_room_id[$ri]' ";


$result_rates = pg_query($conn, $query_g_rates);

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





if(count((array)$a_weekends)==2){     // two days weekend


$weekes =  $a_weekends[0];

$weekee =  $a_weekends[1];


if(date('D', strtotime($madcin1))== $weekee){

$madcin1 = date('Y-m-d', mktime(0,0,0,$madcinm1,$madcind1-1,$madciny1));

}




if(date('D', strtotime($madcout1))== $weekee){

$madcout1 = date('Y-m-d', mktime(0,0,0,$madcoutm1,$madcoutd1+1,$madcouty1));

}



}  // end of two days weekend


if(count((array)$a_weekends)==3){     // three days weekend

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




$mad_s_rid = $mad_array_room_id[$ri];

$mad_s_selr = $mad_array_sel_rooms[$ri];

$mad_s_selp = $mad_array_sel_paxs[$ri];

$mad_s_hotnt = $_POST["mad_hotntot$ri"];

$mad_s_hott =  $_POST["mad_hottot$ri"];

$mad_s_hotnt_tax = $_POST["mad_hotntot_tax$ri"];
$mad_s_hott_tax =  $_POST["mad_hottot_tax$ri"];


$hotel_seq = $s_hot_id;

 $query_hotel ="select hotel_id, hotel_name, city,account_code from hotels where hotel_id='$s_hotelsmad'";

$result_hotel = pg_query($conn, $query_hotel);

if (!$result_hotel) {
echo "An error occured.\n";
exit;
		}
while ($rows_hotel = pg_fetch_array($result_hotel)){
$hotel_account_code = $rows_hotel["account_code"];
$hotel_name_dis = $rows_hotel["hotel_name"];
$hotel_city = $rows_hotel["city"];
}
pg_free_result($result_hotel);




$room_room_type="";
$q_room_subsel ="select room_type  from rooms where room_id='$mad_s_rid'";

$res_room_subsel = pg_query($conn, $q_room_subsel);

if (!$res_room_subsel) {
echo "An error occured.\n";
exit;
		}
while ($rows_room_subsel = pg_fetch_array($res_room_subsel)){

$room_room_type = $rows_room_subsel["room_type"];

}


/*$s_rid = $array_room_id[$ri];
$s_selr = $array_sel_rooms[$ri];
$s_selp = $array_sel_paxs[$ri];
$s_hotnt = $_POST["hotntot$ri"];
$s_hott =  $_POST["hottot$ri"];
*/
$supp_empty="";

$sqlinshot = "update sales_hotels set hotel_id='$s_hotelsmad',room_id='$mad_s_rid',cin='$madcin',cout='$madcout',no_rooms=$mad_s_selr,no_nights=$madnights,no_paxs=$mad_s_selp,net_rate_tax=$mad_s_hotnt_tax,sell_rate_tax=$mad_s_hott_tax,net_rate=$mad_s_hotnt,sell_rate=$mad_s_hott,booking_status='On Request',order_date='now',supp_account_code='$hotel_account_code',supp_id='$supp_empty' where sales_hotels_sno=$hotel_seq and ocode='$s_pnr'";
pg_query($conn, $sqlinshot);


// accounts conn start


$ac_md = "Hotel: ".$hotel_name_dis.",".$hotel_city." - C.In:".date('d/M', strtotime($madcin))." - C.Out:".date('d/M', strtotime($madcout))." - RoomType:".$mad_s_selr." X ".$room_room_type;
$ac_md = substr($ac_md,0,254);

$sqlinsacc1 = "update vocmast set vocdate='$madcin',moredet='$ac_md',dbamt=$mad_s_hott,recon='f' where pnr='$s_pnr' and sinvno=$hotel_seq and vocsno=1 and voctype='CS' and sinvtype='H' ";
pg_query($conn, $sqlinsacc1);

$sqlinsacc2 = "update vocmast set vocdate='$madcin',moredet='$ac_md',cramt=$mad_s_hott,recon='f' where pnr='$s_pnr' and sinvno=$hotel_seq and vocsno=2 and voctype='CS' and sinvtype='H'";
pg_query($conn, $sqlinsacc2);




$sqlinsacc3 = "update vocmast set vocdate='$madcin',moredet='$ac_md',recon='f',dbamt=$mad_s_hotnt where pnr='$s_pnr' and sinvno=$hotel_seq and vocsno=1 and voctype='PV' and sinvtype='H'";
pg_query($conn, $sqlinsacc3);



$sqlinsacc4 = "update vocmast set vocdate='$madcin',acccode='$hotel_account_code',moredet='$ac_md',recon='f',cramt=$mad_s_hotnt where pnr='$s_pnr' and sinvno=$hotel_seq and vocsno=2 and voctype='PV' and sinvtype='H'";
pg_query($conn, $sqlinsacc4);



// accounts conn end


$sqldelm = "delete from sales_meals where sales_hotels_sno=$s_hot_id";
pg_query($conn, $sqldelm);


$s_hot_meals_sno=1;
for($d=0; $d<$madnights1; $d++){   //start days for


for($me=0; $me<count((array)$mad_array_sel_meals[$ri]) ; $me++){  //start meals for


// $mad_array_sel_meals[$ri][$me];


if(is_array($mad_array_sel_meals[$ri]) && $mad_array_sel_meals[$ri][$me]=="breakfast"){
$mad_s_breakfast = (isset($_POST["mad_meals$ri$me$d"])) ? $_POST["mad_meals$ri$me$d"] : "N/A";
if(trim((string)$mad_s_breakfast)=="0" || trim((string)$mad_s_breakfast)=="NA"){
$mad_s_breakfast = "N/A";
}
}

if(is_array($mad_array_sel_meals[$ri]) && $mad_array_sel_meals[$ri][$me]=="halfboard"){
$mad_s_halfboard = (isset($_POST["mad_meals$ri$me$d"])) ? $_POST["mad_meals$ri$me$d"] : "N/A";
if(trim((string)$mad_s_halfboard)=="0" || trim((string)$mad_s_halfboard)=="NA" ){
$mad_s_halfboard = "N/A";
}
}

if(is_array($mad_array_sel_meals[$ri]) && $mad_array_sel_meals[$ri][$me]=="fullboard"){
$mad_s_fullboard = (isset($_POST["mad_meals$ri$me$d"])) ? $_POST["mad_meals$ri$me$d"] : "N/A";
if(trim((string)$mad_s_fullboard)=="0" || trim((string)$mad_s_fullboard)=="NA"){
$mad_s_fullboard = "N/A";
}
}

if(is_array($mad_array_sel_meals[$ri]) && $mad_array_sel_meals[$ri][$me]=="sahoor"){
$mad_s_sahoor = (isset($_POST["mad_meals$ri$me$d"])) ? $_POST["mad_meals$ri$me$d"] : "N/A";
if(trim((string)$mad_s_sahoor)=="0" || trim((string)$mad_s_sahoor)=="NA"){
$mad_s_sahoor = "N/A";
}
}

if(is_array($mad_array_sel_meals[$ri]) && $mad_array_sel_meals[$ri][$me]=="iftar"){
$mad_s_iftar = (isset($_POST["mad_meals$ri$me$d"])) ? $_POST["mad_meals$ri$me$d"] : "N/A";
if(trim((string)$mad_s_iftar)=="0" || trim((string)$mad_s_iftar)=="NA"){
$mad_s_iftar = "N/A";
}
}


} //end of arr meals


//echo $mad_s_breakfast;
//echo $mad_s_halfboard;
//echo $mad_s_fullboard;
//echo $mad_s_sahoor;
//echo $mad_s_iftar;


$mad_s_rate_date= date('Y-m-d', mktime(0,0,0,date('m', strtotime($madcin1)),date('d', strtotime($madcin1))+$d,date('Y', strtotime($madcin1)) ));


$mad_s_room_net_rate = $_POST["mad_putnrate$ri$d"];
$mad_s_room_sell_rate = $_POST["mad_putrate$ri$d"];

$mad_s_day_net_rate = $_POST["mad_dayntot$ri$d"];
$mad_s_day_sell_rate = $_POST["mad_daytot$ri$d"];
$mad_s_day_net_rate_tax = $_POST["mad_dayntot_tax$ri$d"];
$mad_s_day_sell_rate_tax = $_POST["mad_daytot_tax$ri$d"];


$query_meals_seq ="select sales_meals from seq";

$result_meals_seq = pg_query($conn, $query_meals_seq);

if (!$result_meals_seq) {
echo "An error occured.\n";
exit;
		}
while ($rows_meals_seq = pg_fetch_array($result_meals_seq)){
$meals_seq = $rows_meals_seq["sales_meals"];
}



$sqlinsmeals = "insert into sales_meals(sales_meals_sno,sales_hotels_sno,sales_hot_meals_sno,ocode,user_sno,rate_date,	room_id,breakfast,halfboard,fullboard,sahoor,iftar,room_net_rate,room_sell_rate,no_of_paxs,no_of_rooms,day_net_rate_tax,day_sell_rate_tax,day_net_rate,day_sell_rate) values($meals_seq,$s_hot_id,$s_hot_meals_sno,'$s_pnr',$s_ins_user_sno,'$mad_s_rate_date','$mad_s_rid','$mad_s_breakfast','$mad_s_halfboard','$mad_s_fullboard','$mad_s_sahoor','$mad_s_iftar',$mad_s_room_net_rate,$mad_s_room_sell_rate,$mad_s_selp,$mad_s_selr,$mad_s_day_net_rate_tax,$mad_s_day_sell_rate_tax,$mad_s_day_net_rate,$mad_s_day_sell_rate)" ;
pg_query($conn, $sqlinsmeals);


$sequpdatemeals = "update seq set sales_meals=sales_meals+1";
pg_query($conn, $sequpdatemeals);


$mad_s_breakfast="N/A";
$mad_s_halfboard="N/A";
$mad_s_fullboard="N/A";
$mad_s_sahoor="N/A";
$mad_s_iftar="N/A";

$s_hot_meals_sno++;
} //end of days for



}  //end of for room_id



$query_hotels_sno ="select sales_hotels_sno,cin from sales_hotels where  ocode='$s_pnr'";

$result_hotels_sno = pg_query($conn, $query_hotels_sno);

$rows_hotels = pg_num_rows($result_hotels_sno);

if (!$result_hotels_sno) {
echo "An error occured.\n";
exit;
		}
while ($rows_hotels_sno = pg_fetch_array($result_hotels_sno)){

$s_sales_hotel_sno[] = $rows_hotels_sno["sales_hotels_sno"];
$array_cin[] =  $rows_hotels_sno["cin"];
}

$query_trans_sno ="select sales_trans_sno,req_date_time from sales_trans where  ocode='$s_pnr'";

$result_trans_sno = pg_query($conn, $query_trans_sno);

$rows_trans = pg_num_rows($result_trans_sno);

if (!$result_trans_sno) {
echo "An error occured.\n";
exit;
		}
while ($rows_trans_sno = pg_fetch_array($result_trans_sno)){

$s_sales_trans_sno[] = $rows_trans_sno["sales_trans_sno"];
$array_trans_req[] =  $rows_trans_sno["req_date_time"];
}

$query_visa_sno ="select sales_visa_sno,req_date_time from sales_visa where  ocode='$s_pnr'";

$result_visa_sno = pg_query($conn, $query_visa_sno);

$rows_visa = pg_num_rows($result_visa_sno);

if (!$result_visa_sno) {
echo "An error occured.\n";
exit;
		}
while ($rows_visa_sno = pg_fetch_array($result_visa_sno)){

$s_sales_visa_sno[] = $rows_visa_sno["sales_visa_sno"];
$array_visa_req[] =  $rows_visa_sno["req_date_time"];
}


$query_extra_sno ="select sales_extra_sno,req_date_time from sales_extra where ocode='$s_pnr'";

$result_extra_sno = pg_query($conn, $query_extra_sno);

$rows_extra = pg_num_rows($result_extra_sno);

if (!$result_extra_sno) {
echo "An error occured.\n";
exit;
		}
while ($rows_extra_sno = pg_fetch_array($result_extra_sno)){

$s_sales_extra_sno[] = $rows_extra_sno["sales_extra_sno"];
$array_extra_req[] =  $rows_extra_sno["req_date_time"];
}



$cinda = array();

$b_hotel="FALSE";
$b_trans="FALSE";
$b_visa="FALSE";
$b_extra="FALSE";


if($rows_hotels>0){
$cinda[] =  min($array_cin)." 17:00:00";
$b_hotel="TRUE";
}


if($rows_trans>0){
$cinda[] =  min($array_trans_req);
$b_trans="TRUE";
}

if($rows_visa>0){
$cinda[] =  min($array_visa_req);
$b_visa="TRUE";
}

if($rows_extra>0){
$cinda[] =  min($array_extra_req);
$b_extra="TRUE";
}

if($rows_hotels>0 || $rows_trans>0  || $rows_visa>0 || $rows_extra>0){

$cind = min($cinda);

}

$optiondate = " ";

if($rows_hotels>0 || $rows_trans>0  || $rows_visa>0 || $rows_extra>0){

$tscin = strtotime($cind);
$ts = strtotime("now");

$cbd = DateTimeImmutable::createFromTimestamp($ts);
$cbd = $cbd->setTimezone(new DateTimeZone(date_default_timezone_get()));


$cbdd = $cbd->format('d');
$cbdm = $cbd->format('m');
$cbdy = $cbd->format('Y');

$cbds = $cbd->format('s');
$cbdmi = $cbd->format('i');
$cbdh = $cbd->format('H');

$ts3=($tscin-$ts)/2;
echo "<br>";
$bd = DateTimeImmutable::createFromTimestamp($ts+$ts3);
$bd = $bd->setTimezone(new DateTimeZone(date_default_timezone_get()));


$bdd = $bd->format('d');
$bdm = $bd->format('m');
$bdy = $bd->format('Y');

$bds = $bd->format('s');
$bdmi = $bd->format('i');
$bdh = $bd->format('H');


if($ts3 < 30600){
$optiondate = date('Y-m-d H:i:00', mktime($bdh,$bdmi,$bds,$bdm,$bdd,$bdy));
}

if($ts3 > 30600 && $ts3 < 86400){

if(date('D', $ts+$ts3)=="Fri"){
$optiondate = date('Y-m-d H:i:00', mktime(14,0,0,$bdm,$bdd-1,$bdy));
}
else {

$optiondate = date('Y-m-d h:i:00', mktime(10,0,0,$bdm,$bdd,$bdy));

}
}

if($ts3 > 86400 && $ts3 < 129600){

if(date('D', $ts+$ts3)=="Fri"){
$optiondate = date('Y-m-d H:i:00', mktime(14,0,0,$bdm,$bdd-1,$bdy));
}
else {

$optiondate = date('Y-m-d h:i:00', mktime(10,0,0,$bdm,$bdd,$bdy));

}
}

if($ts3 > 129600 && $ts3 <  172800){




if(date('D', $ts+$ts3)=="Fri"){
$optiondate = date('Y-m-d H:i:00', mktime(14,0,0,$bdm,$bdd-1,$bdy));
}
else {

$optiondate = date('Y-m-d h:i:00', mktime(10,0,0,$bdm,$bdd,$bdy));

}
}

if($ts3 > 172800){

if(date('D', $ts+$ts3)=="Fri"){

if(date('D', mktime(14,0,0,$cbdm,$cbdd+2,$cbdy))=="Fri"){
$optiondate = date('Y-m-d H:i:00', mktime(14,0,0,$cbdm,$cbdd+1,$cbdy));
}
else {
$optiondate = date('Y-m-d h:i:00', mktime(10,0,0,$cbdm,$cbdd+2,$cbdy));
}
}
else {

if(date('D', mktime(14,0,0,$cbdm,$cbdd+2,$cbdy))=="Fri"){

$optiondate = date('Y-m-d H:i:00', mktime(14,0,0,$cbdm,$cbdd+1,$cbdy));
}
else {
$optiondate = date('Y-m-d h:i:00', mktime(10,0,0,$cbdm,$cbdd+3,$cbdy));
}

}
}

} // end of if $rows_hotels if



$sqlhotopu = "update sales_hotels set option_date='$optiondate' where sales_hotels_sno=$hotel_seq and ocode='$s_pnr'";
pg_query($conn, $sqlhotopu);


$now_date = date('Y-m-d H:i:s');

$sqlmainopu = "update sales_main set order_date='now',option_date='$optiondate',booking_status='On Request', last_modified_at=modified_at , modified_at='$now_date' where  ocode='$s_pnr'";
pg_query($conn, $sqlmainopu);

/*add a record to pnrhistory table*/
$suser_sno = $_SESSION['user_sno'];
$resroomamendsela = "INSERT INTO pnrhistory(user_sno, ocode, description, created_at) VALUES ('$suser_sno', '$s_pnr', 'Booking has been amended with new hotel name: ".$hotel_name_dis." with amount: ".$mad_s_hott."', 'now()')";
pg_query($conn, $resroomamendsela);
/*END - add a record to pnrhistory table*/



 echo "<script>document.location.href=\"pnrdet.php?spnr=$s_pnr\"</script>";

 ?>
</body>
</center>
</html>
