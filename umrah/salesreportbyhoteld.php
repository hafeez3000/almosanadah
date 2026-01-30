<script type=text/javascript>
setTimeout('document.location=document.location',240000);
</script>
<script>



</script>
  <?php
include("../db/db.php");

$s_gs = "on_request";

$s_gs = $_GET["gs"];

$cin = 0;
$cout = 0;
$tot_number_nights = 0;
$tot_number_rooms = 0;

if($s_gs=="on_request_confirmed"){
$not_arr = " and booking_status!='Cancelled' ";
}

if($s_gs=="on_request"){
$not_arr = " and booking_status='On Request' ";
}

if($s_gs=="confirmed"){
$not_arr = " and booking_status='Confirmed' ";
}

if($s_gs=="cancelled"){
$not_arr = " and booking_status='Cancelled' ";
}



//$sfdate = $_GET["f_d"];
$stdate = $_GET["t_d"];

$date_bulls = "order_date";

$datei = 1;


//if($_GET["cinb"]){
$date_bulls = "cin";
$datei = 0;
//}


$tot_net_p = 0;
$tot_sell_p = 0;


$tot_net = 0;
$tot_sell = 0;


$fromd = $stdate;
$tod = $stdate;




//$fromd = '2006-09-16';
//$tod = '2006-09-16';

function diff_days($start_date, $end_date)
{
   return floor(abs(strtotime($start_date) - strtotime($end_date))/86400);
}

 //$df = diff_days($tod, $fromd)+1;




   $cina = array($cin);
   $couta = array($cout);


$hotelid= $_GET["vt"];

$q_hotel="";

//$hotelid="all";




if($hotelid=="all"){ $q_hotel="";}

else {

if($hotelid=="madinah"){ $q_hotel="and hotel_id between 12000 and 12999";}

else if($hotelid=="makkah"){ $q_hotel="and hotel_id between 11000 and 11999";}

else if($hotelid=="makkahex"){ $q_hotel="and hotel_id between 11000 and 11999 and hotel_id!=11101 and hotel_id!=11102 and hotel_id!=11107 and hotel_id!=11108 and hotel_id!=11109 and hotel_id!=11155" ;}

else if($hotelid=="kingdom"){ $q_hotel="and hotel_id > 13000";}


else{

 $q_hotel = "and hotel_id=" . $hotelid;

}  // end else if madinah

}



?>


<table border="1" cellpadding="2" cellspacing="0" width="100%">
  <tr>
      <td><div align="center"><font size="2" face="Arial, Helvetica, sans-serif">Sno</font></div></td>
      <td><div align="center"><font size="2" face="Arial, Helvetica, sans-serif">PNR</font></div></td>
      <td><div align="center"><font size="2" face="Arial, Helvetica, sans-serif">Guest
          Name</font></div></td>
		  <td><div align="center"><font size="2" face="Arial, Helvetica, sans-serif">Hotel
          Name</font></div></td>
		   <td><div align="center"><font size="2" face="Arial, Helvetica, sans-serif">Travel
          Agent,Country</font></div></td>

      <td><div align="center"><font size="2" face="Arial, Helvetica, sans-serif">Cin</font></div></td>
      <td><div align="center"><font size="2" face="Arial, Helvetica, sans-serif">Cout</font></div></td>
	        <td><div align="center"><font size="2" face="Arial, Helvetica, sans-serif">Nts</font></div></td>
				        <td><div align="center"><font size="2" face="Arial, Helvetica, sans-serif">Rooms</font></div></td>
			<td><div align="center"><font size="2" face="Arial, Helvetica, sans-serif">Room Type</font></div></td>


      <td><div align="center"><font size="2" face="Arial, Helvetica, sans-serif">NetRate</font></div></td>
	  <td><div align="center"><font size="2" face="Arial, Helvetica, sans-serif">SellRate</font></div></td>
 	  <td><div align="center"><font size="2" face="Arial, Helvetica, sans-serif">Profit</font></div></td>




    <tr>

<?

 $query  = "SELECT sales_hotels_sno,ocode,cin, cout, room_id,no_rooms,hotel_id,no_nights,cus_paid, guest_occ_status, room_inhouseno,cus_paid from sales_hotels where cout between  date '$tod' - integer '30'  and '$tod' and cout > '$fromd' and ocode!='NC'  $q_hotel $not_arr or  cin  between '$fromd' and '$tod' and ocode!='NC'  $q_hotel $not_arr or   cin between date '$tod' - integer '30' and '$tod' and  cout > '$tod' and ocode!='NC'  $q_hotel $not_arr order by cin";



$result = pg_query($conn, $query);

$rowc = pg_num_rows($result);
//printf("Records selected: %d\n", mysql_affected_rows());

$ac=0;
$afd=array();
$atd=array();
$anofn=array();

$apaid=array();
?>
    <?
$b_sno=1;
while ($row = pg_fetch_array($result))
{

$s_hotels_sno =  $row["sales_hotels_sno"];

$q_meals_sel ="select sales_meals_sno,sales_hotels_sno,sales_hot_meals_sno,user_sno,rate_date,no_of_rooms,day_net_rate,day_sell_rate from sales_meals where sales_hotels_sno=$s_hotels_sno and rate_date='$tod' order by sales_meals_sno";


$res_meals_sel = pg_query($conn, $q_meals_sel);

if (!$res_meals_sel) {
echo "An error occured.\n";
exit;
		}

while ($rows_meals_sel = pg_fetch_array($res_meals_sel)){


$no_of_rooms = $rows_meals_sel["no_of_rooms"];
$day_net_rate = $rows_meals_sel["day_net_rate"];
$day_sell_rate = $rows_meals_sel["day_sell_rate"];
}

$s_ocode = $row["ocode"];
$s_hotel_id =  $row["hotel_id"];
$s_room_id =  $row["room_id"];

$query_sub  = "SELECT ocode,guest_title, guest_name,option_date,cus_company_name,cus_country from sales_main where ocode='$s_ocode' ";

$result_sub = pg_query($conn, $query_sub);


while ($row_sub = pg_fetch_array($result_sub))
{
$s_guest_title = $row_sub["guest_title"];
$s_guest_name = $row_sub["guest_name"];
$s_option_date = $row_sub["option_date"];
$s_cus_company_name = $row_sub["cus_company_name"];
$s_cus_country = $row_sub["cus_country"];


}


$query_sub_room_h  = "SELECT hotel_id, hotel_name,city  from hotels where hotel_id='$s_hotel_id' ";

$result_sub_room_h = pg_query($conn, $query_sub_room_h);


while ($row_sub_room_h = pg_fetch_array($result_sub_room_h))
{

$hotel_name =  $row_sub_room_h["hotel_name"];
$hotel_city =  $row_sub_room_h["city"];
}

$query_sub_room  = "SELECT room_type from rooms where room_id='$s_room_id' ";

$result_sub_room = pg_query($conn, $query_sub_room);


while ($row_sub_room = pg_fetch_array($result_sub_room))
{

$room_type =  $row_sub_room["room_type"];
}


?>
    <tr>

	<td align="center"><font size="2" face="Arial, Helvetica, sans-serif"><? echo $b_sno ?></font></td>
	<td ><font size="2" face="Arial, Helvetica, sans-serif"><a href="pnrdet.php?spnr=<?echo $row["ocode"];?>" target='<?echo $row["ocode"];?>' onClick="window.open('','<?echo $row["ocode"];?>', ' width='+(screen.width-10)+' , height='+(screen.height-50)+' , left=0,top=0 ').focus()"  ><?echo $row["ocode"];?></a></font></td>

<td><font size="2" face="Arial, Helvetica, sans-serif"><? echo 	$s_guest_title . ". " . strtoupper($s_guest_name); ?></font></td>
<td><font size="2" face="Arial, Helvetica, sans-serif"><? echo 	strtoupper($hotel_name) . ", " . strtoupper($hotel_city); ?></font></td>

<td><font size="2" face="Arial, Helvetica, sans-serif"><? echo 	strtoupper($s_cus_company_name) . ", " . strtoupper($s_cus_country); ?></font></td>

<td align="center"><font size="2" face="Arial, Helvetica, sans-serif"><?echo date('d', strtotime($row["cin"])); ?><?echo date('M', strtotime($row["cin"])); ?></font></td>

<td align="center"><font size="2" face="Arial, Helvetica, sans-serif"><?echo date('d', strtotime($row["cout"])); ?><?echo date('M', strtotime($row["cout"])); ?></font></td>

<td align="center"><font size="2" face="Arial, Helvetica, sans-serif"><?echo $row["no_nights"]; ?> </font></td>
<td align="center"><font size="2" face="Arial, Helvetica, sans-serif"><?echo $row["no_rooms"]; ?> </font></td>


<td align="center"><font size="2" face="Arial, Helvetica, sans-serif"><?echo $room_type; ?> </font></td>

<td><font size="2" face="Arial, Helvetica, sans-serif"><? if($day_net_rate=="") { echo "&nbsp;" ; $tot_net_p=0;} else { echo $day_net_rate; $tot_net_p=$day_net_rate; } ?> </font></td>
<td><font size="2" face="Arial, Helvetica, sans-serif"><? if($day_sell_rate=="") { echo "&nbsp;" ; $tot_sell_p=0;} else { echo $day_sell_rate; $tot_sell_p=$day_sell_rate;}   ?> </font></td>
<td><font size="2" face="Arial, Helvetica, sans-serif"><?   echo ($day_sell_rate-$day_net_rate);    ?> </font></td>

    <?

$tot_number_nights = $tot_number_nights + $row["no_nights"];
$tot_number_rooms = $tot_number_rooms + $row["no_rooms"];


$b_sno++;

$tot_net = $tot_net + $tot_net_p;
$tot_sell = $tot_sell + $tot_sell_p;

$tot_net_p = 0;
$tot_sell_p = 0;


}




?>
    </tr>

<tr><td colspan="7" align="center"> Totals </td><td colspan="1" align="center"><font size="2" face="Arial, Helvetica, sans-serif"><? echo $tot_number_nights ; ?> </font></td><td colspan="1" align="center"><font size="2" face="Arial, Helvetica, sans-serif"><? echo $tot_number_rooms ; ?> </font></td><td colspan="1" align="center"><font size="2" face="Arial, Helvetica, sans-serif"> </font></td><td><? echo $tot_net ; ?> </td><td><font size="2" face="Arial, Helvetica, sans-serif"><? echo $tot_sell ; ?></font></td><td><font size="2" face="Arial, Helvetica, sans-serif"><? echo $tot_sell-$tot_net ; ?></font></td></tr>

  </table>