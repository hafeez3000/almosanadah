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

//echo $suserid;
//echo $suser_sno;

 session_start();


//$_SESSION["hotcb0"];
//$_SESSION["hotcb1"];
//$_SESSION["hotcb2"];

//$_SESSION["trans0"];
//$_SESSION["trans1"];
//$_SESSION["trans2"];
//$_SESSION["trans3"];

//$_SESSION["others0"];
//$_SESSION["others1"];
//$_SESSION["others2"];
							  

if($_SESSION["hotcb0"]==on){ // start if for mad hotel


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

for($ri=0; $ri<count($mad_array_room_id); $ri++){  //start for room_id



$mad_rd1 = date('Y-m-d', mktime(0,0,0,$madcinm,$madcind,$madciny));

$query_g_rates ="select room_id,from_date,to_date, weekday_net,weekday_sell,weekend_net,weekend_sell,breakfast,halfboard,fullboard,sahoor,iftar,weekends,wpackage  from res_rates where '$mad_rd1' between from_date and to_date - interval '1 day' and room_id = $mad_array_room_id[$ri] ";


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




$mad_s_rid = $mad_array_room_id[$ri];

$mad_s_selr = $mad_array_sel_rooms[$ri];

$mad_s_selp = $mad_array_sel_paxs[$ri];

$mad_s_hotnt = $_POST["mad_hotntot$ri"];

$mad_s_hott =  $_POST["mad_hottot$ri"];



$query_hotel_seq ="select sales_hotel from seq";

$result_hotel_seq = pg_query($query_hotel_seq);

if (!$result_hotel_seq) {
echo "An error occured.\n";
exit;
		}
while ($rows_hotel_seq = pg_fetch_array($result_hotel_seq)){
$hotel_seq = $rows_hotel_seq["sales_hotel"];
}

/*$s_rid = $array_room_id[$ri];
$s_selr = $array_sel_rooms[$ri];
$s_selp = $array_sel_paxs[$ri];
$s_hotnt = $_POST["hotntot$ri"];
$s_hott =  $_POST["hottot$ri"];
*/
$supp_empty="";
$sqlinshot = "insert into 	sales_hotels(sales_hotels_sno,ocode,user_sno,user_id,hotel_id,room_id,cin,cout,no_rooms,no_nights, no_paxs,net_rate,sell_rate,booking_status,supp_id) values($hotel_seq,'NC',$suser_sno ,'$suserid','$s_hotelsmad','$mad_s_rid','$madcin','$madcout',$mad_s_selr,$madnights,$mad_s_selp,$mad_s_hotnt,$mad_s_hott,'NC','$supp_empty')"; 
pg_query($sqlinshot);

$sequpdatehot = "update seq set sales_hotel=sales_hotel+1";
pg_query($sequpdatehot);



$s_hot_meals_sno=1;
for($d=0; $d<$madnights1; $d++){   //start days for


for($me=0; $me<count($mad_array_sel_meals[$ri]) ; $me++){  //start meals for


$mad_array_sel_meals[$ri][$me];


if($mad_array_sel_meals[$ri][$me]=="breakfast"){
$mad_s_breakfast = $_POST["mad_meals$ri$me$d"];
if(trim($mad_s_breakfast)=="0" || trim($mad_s_breakfast)=="NA"){
$mad_s_breakfast = "N/A";
}
}

if($mad_array_sel_meals[$ri][$me]=="halfboard"){
$mad_s_halfboard = $_POST["mad_meals$ri$me$d"];
if(trim($mad_s_halfboard)=="0" || trim($mad_s_halfboard)=="NA" ){
$mad_s_halfboard = "N/A";
}
}

if($mad_array_sel_meals[$ri][$me]=="fullboard"){
$mad_s_fullboard = $_POST["mad_meals$ri$me$d"];
if(trim($mad_s_fullboard)=="0" || trim($mad_s_fullboard)=="NA"){
$mad_s_fullboard = "N/A";
}
}

if($mad_array_sel_meals[$ri][$me]=="sahoor"){
$mad_s_sahoor = $_POST["mad_meals$ri$me$d"];
if(trim($mad_s_sahoor)=="0" || trim($mad_s_sahoor)=="NA"){
$mad_s_sahoor = "N/A";
}
}

if($mad_array_sel_meals[$ri][$me]=="iftar"){
$mad_s_iftar = $_POST["mad_meals$ri$me$d"];
if(trim($mad_s_iftar)=="0" || trim($mad_s_iftar)=="NA"){
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


$query_meals_seq ="select sales_meals from seq";

$result_meals_seq = pg_query($query_meals_seq);

if (!$result_meals_seq) {
echo "An error occured.\n";
exit;
		}
while ($rows_meals_seq = pg_fetch_array($result_meals_seq)){
$meals_seq = $rows_meals_seq["sales_meals"];
}



$sqlinsmeals = "insert into sales_meals(sales_meals_sno,sales_hotels_sno,sales_hot_meals_sno,ocode,user_sno,rate_date,	room_id,breakfast,halfboard,fullboard,sahoor,iftar,room_net_rate,room_sell_rate,no_of_paxs,no_of_rooms,day_net_rate,day_sell_rate) values($meals_seq,$hotel_seq,$s_hot_meals_sno,'NC',$suser_sno,'$mad_s_rate_date','$mad_s_rid','$mad_s_breakfast','$mad_s_halfboard','$mad_s_fullboard','$mad_s_sahoor','$mad_s_iftar',$mad_s_room_net_rate,$mad_s_room_sell_rate,$mad_s_selp,$mad_s_selr,$mad_s_day_net_rate,$mad_s_day_sell_rate)" ;
pg_query($sqlinsmeals);


$sequpdatemeals = "update seq set sales_meals=sales_meals+1";
pg_query($sequpdatemeals);


$mad_s_breakfast="N/A";
$mad_s_halfboard="N/A";
$mad_s_fullboard="N/A";
$mad_s_sahoor="N/A";
$mad_s_iftar="N/A";

$s_hot_meals_sno++;
} //end of days for


}  //end of for room_id

} // end if for mad hotel




if($_SESSION["hotcb1"]==on){ // start if for mak hotel

$makcind = $_SESSION['d2Day'];
$makcinm = $_SESSION['d2Month'];
$makciny = $_SESSION['d2Year'];

$makcin = $makciny ."-". $makcinm ."-". $makcind ; 

$makcoutd = $_SESSION['d3Day'];
$makcoutm = $_SESSION['d3Month'];
$makcouty = $_SESSION['d3Year'];

$makcout = $makcouty ."-". $makcoutm ."-". $makcoutd ; 

$makcins = date('D, d-M-Y', strtotime($makcin));
$makcouts = date('D, d-M-Y', strtotime($makcout));

$makco = mktime(0,0,0,$makcoutm,$makcoutd,$makcouty);
$makci = mktime(0,0,0,$makcinm,$makcind,$makciny);
$maknights = Round((($makco-$makci)/86400), 0) ;


$makcind1 = $makcind;
$makcinm1 = $makcinm;
$makciny1 = $makciny;

$makcin1 = $makciny1 ."-". $makcinm1 ."-". $makcind1 ; 

$makcoutd1 = $makcoutd;
$makcoutm1 = $makcoutm;
$makcouty1 = $makcouty;


$makcout1 = $makcouty1 ."-". $makcoutm1 ."-". $makcoutd1 ; 
$maknights1= $maknights;




$s_hotelsmak = $_SESSION["hotelsmak"];


$array_room_id = $_SESSION["selrcb"];

$array_sel_rooms  = $_SESSION["array_sel_rooms"];
$array_sel_meals  = $_SESSION["array_sel_meals"];
$array_sel_paxs	  = $_SESSION["array_sel_paxs"]; 



$s_breakfast="N/A";
$s_halfboard="N/A";
$s_fullboard="N/A";
$s_sahoor="N/A";
$s_iftar="N/A";

for($ri=0; $ri<count($array_room_id); $ri++){  //start for room_id


$mak_rd1 = date('Y-m-d', mktime(0,0,0,$makcinm,$makcind,$makciny));

$query_g_rates ="select room_id,from_date,to_date, weekday_net,weekday_sell,weekend_net,weekend_sell,breakfast,halfboard,fullboard,sahoor,iftar,weekends,wpackage  from res_rates where '$mak_rd1' between from_date and to_date - interval '1 day' and room_id = $array_room_id[$ri] ";


$result_rates = pg_query($query_g_rates);

if (!$result_rates) {
	echo "An error occured.\n";
	exit;
	}
while ($rows_rates = pg_fetch_array($result_rates)){
//echo " ";

 
$a_weekends_mak = explode(",", $rows_rates["weekends"]);



$s_wep_mak = $rows_rates["wpackage"];

}

if(trim($s_wep_mak)=="t"){ 
	
echo "Weekend Package";


if(count($a_weekends_mak)==2){     // two days weekend


$weekes_mak =  $a_weekends_mak[0];

$weekee_mak =  $a_weekends_mak[1];


if(date('D', strtotime($makcin1))== $weekee_mak){

$makcin1 = date('Y-m-d', mktime(0,0,0,$makcinm1,$makcind1-1,$makciny1));

}




if(date('D', strtotime($makcout1))== $weekee_mak){

$makcout1 = date('Y-m-d', mktime(0,0,0,$makcoutm1,$makcoutd1+1,$makcouty1));

}



}  // end of two days weekend


if(count($a_weekends_mak)==3){     // three days weekend

$weeke0_mak =  $a_weekends_mak[0];
$weeke1_mak =  $a_weekends_mak[1];
$weeke2_mak =  $a_weekends_mak[2];


if(date('D', strtotime($makcin1))== $weeke1_mak){
$makcin1 = date('Y-m-d', mktime(0,0,0,$makcinm1,$makcind1-1,$makciny1));
}
if(date('D', strtotime($makcin1))== $weeke2_mak){
$makcin1 = date('Y-m-d', mktime(0,0,0,$makcinm1,$makcind1-2,$makciny1));
}

if(date('D', strtotime($makcout1))== $weeke1_mak){
$makcout1 = date('Y-m-d', mktime(0,0,0,$makcoutm1,$makcoutd1+2,$makcouty1));
}
if(date('D', strtotime($makcout1))== $weeke2_mak){
$makcout1 = date('Y-m-d', mktime(0,0,0,$makcoutm1,$makcoutd1+1,$makcouty1));
}


}  // end of three days weekend



$makcin1 = date('Y-m-d', strtotime($makcin1));

$makcout1 = date('Y-m-d', strtotime($makcout1));

$maknights1 = Round(((strtotime($makcout1)-strtotime($makcin1))/86400), 0) ;




}




$s_rid = $array_room_id[$ri];

$s_selr = $array_sel_rooms[$ri];

$s_selp = $array_sel_paxs[$ri];

$s_hotnt = $_POST["hotntot$ri"];

$s_hott =  $_POST["hottot$ri"];



$query_hotel_seq ="select sales_hotel from seq";

$result_hotel_seq = pg_query($query_hotel_seq);

if (!$result_hotel_seq) {
echo "An error occured.\n";
exit;
		}
while ($rows_hotel_seq = pg_fetch_array($result_hotel_seq)){
$hotel_seq = $rows_hotel_seq["sales_hotel"];
}



/*$s_rid = $array_room_id[$ri];
$s_selr = $array_sel_rooms[$ri];
$s_selp = $array_sel_paxs[$ri];
$s_hotnt = $_POST["hotntot$ri"];
$s_hott =  $_POST["hottot$ri"];
*/
$supp_empty="";
$sqlinshot = "insert into 	sales_hotels(sales_hotels_sno,ocode,user_sno,user_id,hotel_id,room_id,cin,cout,no_rooms,no_nights, no_paxs,net_rate,sell_rate,booking_status,supp_id) values($hotel_seq,'NC',$suser_sno ,'$suserid','$s_hotelsmak','$s_rid','$makcin','$makcout',$s_selr,$maknights,$s_selp,$s_hotnt,$s_hott,'NC','$supp_empty')"; 
pg_query($sqlinshot);

$sequpdatehot = "update seq set sales_hotel=sales_hotel+1";
pg_query($sequpdatehot);



$s_hot_meals_sno=1;
for($d=0; $d<$maknights1; $d++){   //start days for


for($me=0; $me<count($array_sel_meals[$ri]) ; $me++){  //start meals for


$array_sel_meals[$ri][$me];


if($array_sel_meals[$ri][$me]=="breakfast"){
$s_breakfast = $_POST["meals$ri$me$d"];
if(trim(s_breakfast)=="0" || trim($s_breakfast)=="NA"){
$s_breakfast = "N/A";
}
}

if($array_sel_meals[$ri][$me]=="halfboard"){
$s_halfboard = $_POST["meals$ri$me$d"];
if(trim($s_halfboard)=="0" || trim($s_halfboard)=="NA" ){
$s_halfboard = "N/A";
}
}

if($array_sel_meals[$ri][$me]=="fullboard"){
$s_fullboard = $_POST["meals$ri$me$d"];
if(trim($s_fullboard)=="0" || trim($s_fullboard)=="NA"){
$s_fullboard = "N/A";
}
}

if($array_sel_meals[$ri][$me]=="sahoor"){
$s_sahoor = $_POST["meals$ri$me$d"];
if(trim($s_sahoor)=="0" || trim($s_sahoor)=="NA"){
$s_sahoor = "N/A";
}
}

if($array_sel_meals[$ri][$me]=="iftar"){
$s_iftar = $_POST["meals$ri$me$d"];
if(trim($s_iftar)=="0" || trim($s_iftar)=="NA"){
$s_iftar = "N/A";
}
}


} //end of arr meals


//echo $s_breakfast;
//echo $s_halfboard;
//echo $s_fullboard;
//echo $s_sahoor;
//echo $s_iftar;

$s_rate_date= date('Y-m-d', mktime(0,0,0,date('m', strtotime($makcin1)),date('d', strtotime($makcin1))+$d,date('Y', strtotime($makcin1)) ));

$s_room_net_rate = $_POST["putnrate$ri$d"];
$s_room_sell_rate = $_POST["putrate$ri$d"];

$s_day_net_rate = $_POST["dayntot$ri$d"];
$s_day_sell_rate = $_POST["daytot$ri$d"];


$query_meals_seq ="select sales_meals from seq";

$result_meals_seq = pg_query($query_meals_seq);

if (!$result_meals_seq) {
echo "An error occured.\n";
exit;
		}
while ($rows_meals_seq = pg_fetch_array($result_meals_seq)){
$meals_seq = $rows_meals_seq["sales_meals"];
}



$sqlinsmeals = "insert into sales_meals(sales_meals_sno,sales_hotels_sno,sales_hot_meals_sno,ocode,user_sno,rate_date,	room_id,breakfast,halfboard,fullboard,sahoor,iftar,room_net_rate,room_sell_rate,no_of_paxs,no_of_rooms,day_net_rate,day_sell_rate) values($meals_seq,$hotel_seq,$s_hot_meals_sno,'NC',$suser_sno,'$s_rate_date','$s_rid','$s_breakfast','$s_halfboard','$s_fullboard','$s_sahoor','$s_iftar',$s_room_net_rate,$s_room_sell_rate,$s_selp,$s_selr,$s_day_net_rate,$s_day_sell_rate)" ;
pg_query($sqlinsmeals);


$sequpdatemeals = "update seq set sales_meals=sales_meals+1";
pg_query($sequpdatemeals);




$s_breakfast="N/A";
$s_halfboard="N/A";
$s_fullboard="N/A";
$s_sahoor="N/A";
$s_iftar="N/A";

$s_hot_meals_sno++;
} //end of days for


}  //end of for room_id

} // end if for MAK hotel


if($_SESSION["hotcb2"]==on){ // start if for oth hotel

$othcind = $_SESSION['d4Day'];
$othcinm = $_SESSION['d4Month'];
$othciny = $_SESSION['d4Year'];

$othcin = $othciny ."-". $othcinm ."-". $othcind ; 

$othcoutd = $_SESSION['d5Day'];
$othcoutm = $_SESSION['d5Month'];
$othcouty = $_SESSION['d5Year'];

$othcout = $othcouty ."-". $othcoutm ."-". $othcoutd ; 

$othcins = date('D, d-M-Y', strtotime($othcin));
$othcouts = date('D, d-M-Y', strtotime($othcout));

$othco = mktime(0,0,0,$othcoutm,$othcoutd,$othcouty);
$othci = mktime(0,0,0,$othcinm,$othcind,$othciny);
$othnights = Round((($othco-$othci)/86400), 0) ;


$othcind1 = $othcind;
$othcinm1 = $othcinm;
$othciny1 = $othciny;

$othcin1 = $othciny1 ."-". $othcinm1 ."-". $othcind1 ; 

$othcoutd1 = $othcoutd;
$othcoutm1 = $othcoutm;
$othcouty1 = $othcouty;


$othcout1 = $othcouty1 ."-". $othcoutm1 ."-". $othcoutd1 ; 
$othnights1= $othnights;



$s_hotelsoth = $_SESSION["hotelsoth"];


$oth_array_room_id = $_SESSION["othselrcb"];

$oth_array_sel_rooms  = $_SESSION["oth_array_sel_rooms"];
$oth_array_sel_meals  = $_SESSION["oth_array_sel_meals"];
$oth_array_sel_paxs	  = $_SESSION["oth_array_sel_paxs"]; 


$oth_s_breakfast="N/A";
$oth_s_halfboard="N/A";
$oth_s_fullboard="N/A";
$oth_s_sahoor="N/A";
$oth_s_iftar="N/A";

for($ri=0; $ri<count($oth_array_room_id); $ri++){  //start for room_id


$oth_rd1 = date('Y-m-d', mktime(0,0,0,$othcinm,$othcind,$othciny));

$query_g_rates ="select room_id,from_date,to_date, weekday_net,weekday_sell,weekend_net,weekend_sell,breakfast,halfboard,fullboard,sahoor,iftar,weekends,wpackage  from res_rates where '$oth_rd1' between from_date and to_date - interval '1 day' and room_id = $oth_array_room_id[$ri] ";


$result_rates = pg_query($query_g_rates);

if (!$result_rates) {
	echo "An error occured.\n";
	exit;
	}
while ($rows_rates = pg_fetch_array($result_rates)){
//echo " ";

 
$a_weekends_oth = explode(",", $rows_rates["weekends"]);



$s_wep_oth = $rows_rates["wpackage"];

}

if(trim($s_wep_oth)=="t"){ 
	
echo "Weekend Package";


if(count($a_weekends_oth)==2){     // two days weekend


$weekes_oth =  $a_weekends_oth[0];

$weekee_oth =  $a_weekends_oth[1];


if(date('D', strtotime($othcin1))== $weekee_oth){

$othcin1 = date('Y-m-d', mktime(0,0,0,$othcinm1,$othcind1-1,$othciny1));

}




if(date('D', strtotime($othcout1))== $weekee_oth){

$othcout1 = date('Y-m-d', mktime(0,0,0,$othcoutm1,$othcoutd1+1,$othcouty1));

}



}  // end of two days weekend


if(count($a_weekends_oth)==3){     // three days weekend

$weeke0_oth =  $a_weekends_oth[0];
$weeke1_oth =  $a_weekends_oth[1];
$weeke2_oth =  $a_weekends_oth[2];


if(date('D', strtotime($othcin1))== $weeke1_oth){
$othcin1 = date('Y-m-d', mktime(0,0,0,$othcinm1,$othcind1-1,$othciny1));
}
if(date('D', strtotime($othcin1))== $weeke2_oth){
$othcin1 = date('Y-m-d', mktime(0,0,0,$othcinm1,$othcind1-2,$othciny1));
}

if(date('D', strtotime($othcout1))== $weeke1_oth){
$othcout1 = date('Y-m-d', mktime(0,0,0,$othcoutm1,$othcoutd1+2,$othcouty1));
}
if(date('D', strtotime($othcout1))== $weeke2_oth){
$othcout1 = date('Y-m-d', mktime(0,0,0,$othcoutm1,$othcoutd1+1,$othcouty1));
}


}  // end of three days weekend



$othcins1 = date('Y-m-d', strtotime($othcin1));
$othcout1 = date('Y-m-d', strtotime($othcout1));
$othnight1 = Round(((strtotime($othcout1)-strtotime($othcin1))/86400), 0) ;




}



$oth_s_rid = $oth_array_room_id[$ri];

$oth_s_selr = $oth_array_sel_rooms[$ri];

$oth_s_selp = $oth_array_sel_paxs[$ri];

$oth_s_hotnt = $_POST["oth_hotntot$ri"];

$oth_s_hott =  $_POST["oth_hottot$ri"];



$query_hotel_seq ="select sales_hotel from seq";

$result_hotel_seq = pg_query($query_hotel_seq);

if (!$result_hotel_seq) {
echo "An error occured.\n";
exit;
		}
while ($rows_hotel_seq = pg_fetch_array($result_hotel_seq)){
$hotel_seq = $rows_hotel_seq["sales_hotel"];
}

/*$s_rid = $array_room_id[$ri];
$s_selr = $array_sel_rooms[$ri];
$s_selp = $array_sel_paxs[$ri];
$s_hotnt = $_POST["hotntot$ri"];
$s_hott =  $_POST["hottot$ri"];
*/
$supp_empty="";
$sqlinshot = "insert into 	sales_hotels(sales_hotels_sno,ocode,user_sno,user_id,hotel_id,room_id,cin,cout,no_rooms,no_nights, no_paxs,net_rate,sell_rate,booking_status,supp_id) values($hotel_seq,'NC',$suser_sno ,'$suserid','$s_hotelsoth','$oth_s_rid','$othcin','$othcout',$oth_s_selr,$othnights,$oth_s_selp,$oth_s_hotnt,$oth_s_hott,'NC','$supp_empty')"; 
pg_query($sqlinshot);

$sequpdatehot = "update seq set sales_hotel=sales_hotel+1";
pg_query($sequpdatehot);



$s_hot_meals_sno=1;
for($d=0; $d<$othnights1; $d++){   //start days for


for($me=0; $me<count($oth_array_sel_meals[$ri]) ; $me++){  //start meals for


$oth_array_sel_meals[$ri][$me];


if($oth_array_sel_meals[$ri][$me]=="breakfast"){
$oth_s_breakfast = $_POST["oth_meals$ri$me$d"];
if(trim($oth_s_breakfast)=="0" || trim($oth_s_breakfast)=="NA"){
$oth_s_breakfast = "N/A";
}
}

if($oth_array_sel_meals[$ri][$me]=="halfboard"){
$oth_s_halfboard = $_POST["oth_meals$ri$me$d"];
if(trim($oth_s_halfboard)=="0" || trim($oth_s_halfboard)=="NA" ){
$oth_s_halfboard = "N/A";
}
}

if($oth_array_sel_meals[$ri][$me]=="fullboard"){
$oth_s_fullboard = $_POST["oth_meals$ri$me$d"];
if(trim($oth_s_fullboard)=="0" || trim($oth_s_fullboard)=="NA"){
$oth_s_fullboard = "N/A";
}
}

if($oth_array_sel_meals[$ri][$me]=="sahoor"){
$oth_s_sahoor = $_POST["oth_meals$ri$me$d"];
if(trim($oth_s_sahoor)=="0" || trim($oth_s_sahoor)=="NA"){
$oth_s_sahoor = "N/A";
}
}

if($oth_array_sel_meals[$ri][$me]=="iftar"){
$oth_s_iftar = $_POST["oth_meals$ri$me$d"];
if(trim($oth_s_iftar)=="0" || trim($oth_s_iftar)=="NA"){
$oth_s_iftar = "N/A";
}
}


} //end of arr meals


//echo $oth_s_breakfast;
//echo $oth_s_halfboard;
//echo $oth_s_fullboard;
//echo $oth_s_sahoor;
//echo $oth_s_iftar;


$oth_s_rate_date= date('Y-m-d', mktime(0,0,0,date('m', strtotime($othcin1)),date('d', strtotime($othcin1))+$d,date('Y', strtotime($othcin1)) ));

$oth_s_room_net_rate = $_POST["oth_putnrate$ri$d"];
$oth_s_room_sell_rate = $_POST["oth_putrate$ri$d"];

$oth_s_day_net_rate = $_POST["oth_dayntot$ri$d"];
$oth_s_day_sell_rate = $_POST["oth_daytot$ri$d"];


$query_meals_seq ="select sales_meals from seq";

$result_meals_seq = pg_query($query_meals_seq);

if (!$result_meals_seq) {
echo "An error occured.\n";
exit;
		}
while ($rows_meals_seq = pg_fetch_array($result_meals_seq)){
$meals_seq = $rows_meals_seq["sales_meals"];
}



$sqlinsmeals = "insert into sales_meals(sales_meals_sno,sales_hotels_sno,sales_hot_meals_sno,ocode,user_sno,rate_date,	room_id,breakfast,halfboard,fullboard,sahoor,iftar,room_net_rate,room_sell_rate,no_of_paxs,no_of_rooms,day_net_rate,day_sell_rate) values($meals_seq,$hotel_seq,$s_hot_meals_sno,'NC',$suser_sno,'$oth_s_rate_date','$oth_s_rid','$oth_s_breakfast','$oth_s_halfboard','$oth_s_fullboard','$oth_s_sahoor','$oth_s_iftar',$oth_s_room_net_rate,$oth_s_room_sell_rate,$oth_s_selp,$oth_s_selr,$oth_s_day_net_rate,$oth_s_day_sell_rate)" ;
pg_query($sqlinsmeals);


$sequpdatemeals = "update seq set sales_meals=sales_meals+1";
pg_query($sequpdatemeals);


$oth_s_breakfast="N/A";
$oth_s_halfboard="N/A";
$oth_s_fullboard="N/A";
$oth_s_sahoor="N/A";
$oth_s_iftar="N/A";

$s_hot_meals_sno++;
} //end of days for


}  //end of for room_id


} // end if for oth hotel			



if($_SESSION["trans0"]==on){ // start if for  trans0

$trans0d = $_SESSION['d6Day'];
$trans0m = $_SESSION['d6Month'];
$trans0y = $_SESSION['d6Year'];

 $s_timeselecthours0  = $_SESSION['timeselecthours0']; 
 $s_timeselectmin0	  = $_SESSION['timeselectmin0'];   


 $trans0rd = date('Y-m-d H:i:00', mktime($s_timeselecthours0,$s_timeselectmin0,0,$trans0m,$trans0d,$trans0y));

 $s_s_trans0		  = $_SESSION['s_trans0'];            
 $s_typeoftrans0	  = $_SESSION['typeoftrans0'];    
 
 $s_noofu0			  = $_SESSION['noofu0'];         //units   
 $s_flightdet0		  = $_SESSION['flightdet0'];      
 
$tvety0= $_SESSION['tvety0'];
$tvetr0= $_SESSION['tvetr0'];
$tvetp0= $_SESSION['tvetp0'];
$trans1nrate= $_POST["trans1nrate$s_typeoftrans0"];
$trans1rate= $_POST["trans1rate$s_typeoftrans0"];


$netprice1  = $trans1nrate / $s_noofu0;
$sellprice1 = $trans1rate / $s_noofu0;


$query_trans_seq ="select sales_trans from seq";

$result_trans_seq = pg_query($query_trans_seq);

if (!$result_trans_seq) {
echo "An error occured.\n";
exit;
		}
while ($rows_trans_seq = pg_fetch_array($result_trans_seq)){
$trans_seq = $rows_trans_seq["sales_trans"];
}

$sqlinstrans = "insert into sales_trans(sales_trans_sno,ocode,user_sno,user_id,req_date_time,f2t,type_of_trans,no_of_units,no_of_paxs,flight_det,net_rate,sell_rate,tot_net_rate,tot_sell_rate,booking_status,order_date,trans_id,trans_id_s)  values($trans_seq,'NC',$suser_sno,'$suserid','$trans0rd','$tvetr0','$tvety0','$s_noofu0','$tvetp0','$s_flightdet0',$netprice1,$sellprice1,$trans1nrate,$trans1rate,'On Request','now','$s_typeoftrans0','$s_s_trans0')"; 
pg_query($sqlinstrans);




$sequpdatetrans = "update seq set sales_trans=sales_trans+1";
pg_query($sequpdatetrans);




} // end if for trans0


if($_SESSION["trans1"]==on){ // start if for  trans1

$trans1d = $_SESSION['d7Day'];
$trans1m = $_SESSION['d7Month'];
$trans1y = $_SESSION['d7Year'];

 $s_timeselecthours1  = $_SESSION['timeselecthours1']; 
 $s_timeselectmin1	  = $_SESSION['timeselectmin1'];   


 $trans1rd = date('Y-m-d H:i:00', mktime($s_timeselecthours1,$s_timeselectmin1,0,$trans1m,$trans1d,$trans1y));

 $s_s_trans1		  = $_SESSION['s_trans1'];            
 $s_typeoftrans1	  = $_SESSION['typeoftrans1'];    
 
 $s_noofu1			  = $_SESSION['noofu1'];         //units   
 $s_flightdet1		  = $_SESSION['flightdet1'];      
 
$tvety1= $_SESSION['tvety1'];
$tvetr1= $_SESSION['tvetr1'];
$tvetp1= $_SESSION['tvetp1'];
$trans2nrate= $_POST["trans2nrate$s_typeoftrans1"];
$trans2rate= $_POST["trans2rate$s_typeoftrans1"];


$netprice2  = $trans2nrate / $s_noofu1;
$sellprice2 = $trans2rate / $s_noofu1;



$query_trans_seq ="select sales_trans from seq";

$result_trans_seq = pg_query($query_trans_seq);

if (!$result_trans_seq) {
echo "An error occured.\n";
exit;
		}
while ($rows_trans_seq = pg_fetch_array($result_trans_seq)){
$trans_seq = $rows_trans_seq["sales_trans"];
}

$sqlinstrans = "insert into sales_trans(sales_trans_sno,ocode,user_sno,user_id,req_date_time,f2t,type_of_trans,no_of_units,no_of_paxs,flight_det,net_rate,sell_rate,tot_net_rate,tot_sell_rate,booking_status,order_date,trans_id,trans_id_s)  values($trans_seq,'NC',$suser_sno,'$suserid','$trans1rd','$tvetr1','$tvety1','$s_noofu1','$tvetp1','$s_flightdet1',$netprice2,$sellprice2,$trans2nrate,$trans2rate,'On Request','now','$s_typeoftrans1','$s_s_trans1')"; 
pg_query($sqlinstrans);




$sequpdatetrans = "update seq set sales_trans=sales_trans+1";
pg_query($sequpdatetrans);




} // end if for trans1



if($_SESSION["trans2"]==on){ // start if for  trans2

$trans2d = $_SESSION['d8Day'];
$trans2m = $_SESSION['d8Month'];
$trans2y = $_SESSION['d8Year'];

 $s_timeselecthours2  = $_SESSION['timeselecthours2']; 
 $s_timeselectmin2	  = $_SESSION['timeselectmin2'];   


 $trans2rd = date('Y-m-d H:i:00', mktime($s_timeselecthours2,$s_timeselectmin2,0,$trans2m,$trans2d,$trans2y));

 $s_s_trans2		  = $_SESSION['s_trans2'];            
 $s_typeoftrans2	  = $_SESSION['typeoftrans2'];    
 
 $s_noofu2			  = $_SESSION['noofu2'];         //units   
 $s_flightdet2		  = $_SESSION['flightdet2'];      
 
$tvety2= $_SESSION['tvety2'];
$tvetr2= $_SESSION['tvetr2'];
$tvetp2= $_SESSION['tvetp2'];
$trans3nrate= $_POST["trans3nrate$s_typeoftrans2"];
$trans3rate= $_POST["trans3rate$s_typeoftrans2"];


$netprice3  = $trans3nrate / $s_noofu2;
$sellprice3 = $trans3rate / $s_noofu2;



$query_trans_seq ="select sales_trans from seq";

$result_trans_seq = pg_query($query_trans_seq);

if (!$result_trans_seq) {
echo "An error occured.\n";
exit;
		}
while ($rows_trans_seq = pg_fetch_array($result_trans_seq)){
$trans_seq = $rows_trans_seq["sales_trans"];
}

$sqlinstrans = "insert into sales_trans(sales_trans_sno,ocode,user_sno,user_id,req_date_time,f2t,type_of_trans,no_of_units,no_of_paxs,flight_det,net_rate,sell_rate,tot_net_rate,tot_sell_rate,booking_status,order_date,trans_id,trans_id_s)  values($trans_seq,'NC',$suser_sno,'$suserid','$trans2rd','$tvetr2','$tvety2','$s_noofu2','$tvetp2','$s_flightdet2',$netprice3,$sellprice3,$trans3nrate,$trans3rate,'On Request','now','$s_typeoftrans2','$s_s_trans2')"; 
pg_query($sqlinstrans);




$sequpdatetrans = "update seq set sales_trans=sales_trans+1";
pg_query($sequpdatetrans);




} // end if for trans2


if($_SESSION["trans3"]==on){ // start if for  trans3

$trans3d = $_SESSION['d9Day'];
$trans3m = $_SESSION['d9Month'];
$trans3y = $_SESSION['d9Year'];

 $s_timeselecthours3  = $_SESSION['timeselecthours3']; 
 $s_timeselectmin3	  = $_SESSION['timeselectmin3'];   


 $trans3rd = date('Y-m-d H:i:00', mktime($s_timeselecthours3,$s_timeselectmin3,0,$trans3m,$trans3d,$trans3y));

 $s_s_trans3		  = $_SESSION['s_trans3'];            
 $s_typeoftrans3	  = $_SESSION['typeoftrans3'];    
 
 $s_noofu3			  = $_SESSION['noofu3'];         //units   
 $s_flightdet3		  = $_SESSION['flightdet3'];      
 
$tvety3= $_SESSION['tvety3'];
$tvetr3= $_SESSION['tvetr3'];
$tvetp3= $_SESSION['tvetp3'];
$trans4nrate= $_POST["trans4nrate$s_typeoftrans3"];
$trans4rate= $_POST["trans4rate$s_typeoftrans3"];


$netprice4  = $trans4nrate / $s_noofu3;
$sellprice4 = $trans4rate / $s_noofu3;



$query_trans_seq ="select sales_trans from seq";

$result_trans_seq = pg_query($query_trans_seq);

if (!$result_trans_seq) {
echo "An error occured.\n";
exit;
		}
while ($rows_trans_seq = pg_fetch_array($result_trans_seq)){
$trans_seq = $rows_trans_seq["sales_trans"];
}

$sqlinstrans = "insert into sales_trans(sales_trans_sno,ocode,user_sno,user_id,req_date_time,f2t,type_of_trans,no_of_units,no_of_paxs,flight_det,net_rate,sell_rate,tot_net_rate,tot_sell_rate,booking_status,order_date,trans_id,trans_id_s)  values($trans_seq,'NC',$suser_sno,'$suserid','$trans3rd','$tvetr3','$tvety3','$s_noofu3','$tvetp3','$s_flightdet3',$netprice4,$sellprice4,$trans4nrate,$trans4rate,'On Request','now','$s_typeoftrans3','$s_s_trans3')"; 
pg_query($sqlinstrans);




$sequpdatetrans = "update seq set sales_trans=sales_trans+1";
pg_query($sequpdatetrans);



} // end if for trans2


if($_SESSION["others0"]==on){ // start if for  oth0

$other1noofa=$_SESSION['other1noofa'];
$other1net = $_POST['other1net'];
$other1sell= $_POST['other1sell'];

$others1d = $_SESSION['d10Day'];
$others1m = $_SESSION['d10Month'];
$others1y = $_SESSION['d10Year'];

$others1rd = $others1y ."-". $others1m ."-". $others1d ; 

$query_extra_seq ="select sales_extra from seq";

$result_extra_seq = pg_query($query_extra_seq);

if (!$result_extra_seq) {
echo "An error occured.\n";
exit;
		}
while ($rows_extra_seq = pg_fetch_array($result_extra_seq)){
$extra_seq = $rows_extra_seq["sales_extra"];
}

$sqlinsextra = "insert into sales_extra( sales_extra_sno,ocode,	user_sno,user_id,req_date_time,	paticulars,	net_rate,sell_rate,order_date)  values( $extra_seq,'NC',$suser_sno,'$suserid','$others1rd','$other1noofa',$other1net,$other1sell,  'now' )"; 
pg_query($sqlinsextra);



$sequpdateextra = "update seq set sales_extra=sales_extra+1";
pg_query($sequpdateextra);



} // end if for other

if($_SESSION["others1"]==on){ // start if for  oth1
$other2noofa=$_SESSION['other2noofa'];
$other2net = $_POST['other2net'];
$other2sell= $_POST['other2sell'];



$others2d = $_SESSION['d11Day'];
$others2m = $_SESSION['d11Month'];
$others2y = $_SESSION['d11Year'];

$others2rd = $others2y ."-". $others2m ."-". $others2d ; 


$query_extra_seq ="select sales_extra from seq";

$result_extra_seq = pg_query($query_extra_seq);

if (!$result_extra_seq) {
echo "An error occured.\n";
exit;
		}
while ($rows_extra_seq = pg_fetch_array($result_extra_seq)){
$extra_seq = $rows_extra_seq["sales_extra"];
}

$sqlinsextra = "insert into sales_extra( sales_extra_sno,ocode,	user_sno,user_id,req_date_time,	paticulars,	net_rate,sell_rate,order_date)  values( $extra_seq,'NC',$suser_sno,'$suserid','$others2rd','$other2noofa',$other2net,$other2sell,  'now' )"; 
pg_query($sqlinsextra);



$sequpdateextra = "update seq set sales_extra=sales_extra+1";
pg_query($sequpdateextra);

} // end if for other

if($_SESSION["others2"]==on){ // start if for  oth2
$other3noofa=$_SESSION['other3noofa'];
$other3net = $_POST['other3net'];
$other3sell= $_POST['other3sell'];



$others3d = $_SESSION['d12Day'];
$others3m = $_SESSION['d12Month'];
$others3y = $_SESSION['d12Year'];

$others3rd = $others3y ."-". $others3m ."-". $others3d ; 


$query_extra_seq ="select sales_extra from seq";

$result_extra_seq = pg_query($query_extra_seq);

if (!$result_extra_seq) {
echo "An error occured.\n";
exit;
		}
while ($rows_extra_seq = pg_fetch_array($result_extra_seq)){
$extra_seq = $rows_extra_seq["sales_extra"];
}

$sqlinsextra = "insert into sales_extra( sales_extra_sno,ocode,	user_sno,user_id,req_date_time,	paticulars,	net_rate,sell_rate,order_date)  values( $extra_seq,'NC',$suser_sno,'$suserid','$others3rd','$other3noofa',$other3net,$other3sell,  'now' )"; 
pg_query($sqlinsextra);



$sequpdateextra = "update seq set sales_extra=sales_extra+1";
pg_query($sequpdateextra);

} // end if for other



 echo "<script>document.location.href=\"bookingchart.php\"</script>";
 ?>
</body>	
</center>
</html>
