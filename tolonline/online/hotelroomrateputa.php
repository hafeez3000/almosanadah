<?
include ("header.php");
?>

<script>
document.title= '<? echo $company_name . " ERP - Umrah New Booking - Hotel Booking"; ?>';
</script>

<html>
<link rel="stylesheet" type="text/css" href="../calendar/css.css" />
<center>
<body leftmargin="0" topmargin="0" rightmargin="0">
<br><br><br>  
<? include ("gprocessing.html"); 




$suserid;
$suser_sno;

 session_start();
							  
  $cind = $_SESSION['cind'];
  $cinm = $_SESSION['cinm'];
  $ciny = $_SESSION['ciny'];

 $cin = $ciny."-".$cinm."-".$cind;
 $cindis = date('D, d-M-Y', strtotime($cin));

$ts = strtotime($cin);

$cbd = getdate($ts);
$cbdd = $cbd[mday];
$cbdm =$cbd[mon];
$cbdy =$cbd[year];

 $coutd = $_SESSION['coutd'];
 $coutm = $_SESSION['coutm'];
 $couty = $_SESSION['couty'];

 $cout = $couty."-".$coutm."-".$coutd;
$coutdis = date('D, d-M-Y', strtotime($cout));



$days = (strtotime($cout) - strtotime($cin)) / (60 * 60 * 24);

$hotel_id = $_SESSION['hotel_id']; 


$array_room_id = $_SESSION['$array_room_id'];
$array_sel_rooms = $_SESSION['$array_sel_rooms'];
$array_sel_paxs = $_SESSION['$array_sel_paxs'];
$array_sel_meals = $_SESSION['$array_sel_meals'];

//print_r($array_room_id);
//print_r($array_sel_rooms);
//print_r($array_sel_paxs);
//print_r($array_sel_meals);

$s_breakfast="N/A";
$s_halfboard="N/A";
$s_fullboard="N/A";
$s_sahoor="N/A";
$s_iftar="N/A";

for($ri=0; $ri<count($array_room_id); $ri++){



$query_hotel_seq ="select sales_hotel from seq";

$result_hotel_seq = pg_query($query_hotel_seq);

if (!$result_hotel_seq) {
echo "An error occured.\n";
exit;
		}
while ($rows_hotel_seq = pg_fetch_array($result_hotel_seq)){
$hotel_seq = $rows_hotel_seq["sales_hotel"];
}
$s_rid = $array_room_id[$ri];
$s_selr = $array_sel_rooms[$ri];
$s_selp = $array_sel_paxs[$ri];
$s_hotnt = $_POST["hotntot$ri"];
$s_hott =  $_POST["hottot$ri"];

$sqlinshot = "insert into 	sales_hotels(sales_hotels_sno,ocode,user_sno,user_id,hotel_id,room_id,cin,cout,no_rooms,no_nights, no_paxs,net_rate,sell_rate,booking_status) values($hotel_seq,'NC',$suser_sno ,'$suserid','$hotel_id','$s_rid','$cin','$cout',$s_selr,$days,$s_selp,$s_hotnt,$s_hott,'NC')"; 
pg_query($sqlinshot);

$sequpdatehot = "update seq set sales_hotel=sales_hotel+1";
pg_query($sequpdatehot);

//insert hotel here


$s_hot_meals_sno=1;
for($d=0; $d<$days; $d++){



for($me=0; $me<count($array_sel_meals[$ri]) ; $me++){

//get meals details here


if($array_sel_meals[$ri][$me]=="breakfast"){
$s_breakfast = $_POST["meals$ri$me$d"];
if($s_breakfast==0){
$s_breakfast = "INC";
}
}

if($array_sel_meals[$ri][$me]=="halfboard"){
$s_halfboard = $_POST["meals$ri$me$d"];
if($s_halfboard==0){
$s_halfboard = "INC";
}
}

if($array_sel_meals[$ri][$me]=="fullboard"){
$s_fullboard = $_POST["meals$ri$me$d"];
if($s_fullboard==0){
$s_fullboard = "INC";
}
}

if($array_sel_meals[$ri][$me]=="sahoor"){
$s_sahoor = $_POST["meals$ri$me$d"];
if($s_sahoor==0){
$s_sahoor = "INC";
}
}

if($array_sel_meals[$ri][$me]=="iftar"){
$s_iftar = $_POST["meals$ri$me$d"];
if($s_iftar==0){
$s_iftar = "INC";
}
}


}  // end of meals for

//echo $s_breakfast;
//echo $s_halfboard;
//echo $s_fullboard;
//echo $s_sahoor;
//echo $s_iftar;

$s_rate_date=date('Y-m-d', mktime(0,0,0,$cbdm,$cbdd+$d,$cbdy));
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

//insert meals here



$s_breakfast="N/A";
$s_halfboard="N/A";
$s_fullboard="N/A";
$s_sahoor="N/A";
$s_iftar="N/A";

$s_hot_meals_sno++;
}  // end of meals table for



} // end of hotel table for


echo "<script>document.location.href=\"bookingchart.php\"</script>";
?>
</body>	
</center>
</html>
