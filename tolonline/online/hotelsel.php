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


echo "<br><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">Adding Hotel ....</font></div>"; 

session_start();

						  
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

/*

echo "hotel_seq";
echo $hotel_seq;
echo "<br>";
echo "suser_sno" ;
echo $suser_sno ;
echo "<br>";
echo "suserid" ;
echo $suserid;
echo "<br>";
echo "s_hotelsmad";
echo $s_hotelsmad;
echo "<br>";
echo "mad_s_rid";
echo $mad_s_rid;
echo "<br>";
echo "madcin";
echo $madcin;
echo "<br>";

echo "madcout";
echo $madcout;
echo "<br>";
echo "mad_s_selr";
echo $mad_s_selr;
echo "<br>";
echo "madnights";
echo $madnights;
echo "<br>";
echo "mad_s_selp";
echo $mad_s_selp;
echo "<br>";
echo "mad_s_hotnt";
echo $mad_s_hotnt;
echo "<br>";
echo "mad_s_hott";
echo $mad_s_hott;
echo "<br>";
echo "supp_empty";
echo $supp_empty;
echo "<br>";

*/

$sqlinshot = "insert into sales_hotels(sales_hotels_sno,ocode,user_sno,user_id,hotel_id,room_id,cin,cout,no_rooms,no_nights, no_paxs,net_rate,sell_rate,booking_status,supp_id,is_online) values($hotel_seq,'NC',$suser_sno , '$suserid' ,'$s_hotelsmad','$mad_s_rid','$madcin','$madcout',$mad_s_selr,$madnights,$mad_s_selp,$mad_s_hotnt,$mad_s_hott,'NC','$supp_empty',1)"; 

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






echo "<script>document.location.href=\"bookingchart.php\"</script>";

 ?>
</body>	
</center>
</html>
