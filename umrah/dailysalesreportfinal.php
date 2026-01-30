<script type=text/javascript>
setTimeout('document.location=document.location',240000);
</script>
<script>



</script>
  <?php
include("../db/db.php");

$s_gs = "on_request";

$s_gs = $_GET["gs"];




if($s_gs=="on_request_confirmed"){
$not_arr = " and sm.booking_status!='Cancelled' ";
}

if($s_gs=="on_request"){
$not_arr = " and sm.booking_status='On Request' ";
}

if($s_gs=="confirmed"){
$not_arr = " and sm.booking_status='Confirmed' ";
}

if($s_gs=="cancelled"){
$not_arr = " and sm.ooking_status='Cancelled' ";
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
<table border="1" cellpadding="2" cellspacing="0" width="99%" align="center">
    <tr><td align="center" bgcolor="#d0ffac"><strong>New Bookings</strong></td></tr>

</table>

<table border="1"  cellpadding="2" cellspacing="0" width="99%" align="center">
    <tr><td align="left" colspan="11"><strong>Hotels</strong></td></tr>
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


	  <td><div align="center"><font size="2" face="Arial, Helvetica, sans-serif">Amount</font></div></td>




    <tr>

<?

 echo $query  = "SELECT sales_hotels_sno,sh.ocode,cin, cout, room_id,no_rooms,hotel_id,no_nights,cus_paid, guest_occ_status, room_inhouseno,cus_paid from sales_hotels as sh, sales_main as sm where sm.created_at between '$fromd 00:00:00' and '$fromd 23:59:59' and sm.ocode=sh.ocode and sm.created_at=sm.modified_at and sm.ocode!='NC'  $q_hotel $not_arr  order by sm.created_at";



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

$q_meals_sel ="select sum(day_sell_rate) as day_sell_rate from sales_meals where sales_hotels_sno=$s_hotels_sno";


$res_meals_sel = pg_query($conn, $q_meals_sel);

if (!$res_meals_sel) {
echo "An error occured.\n";
exit;
		}

while ($rows_meals_sel = pg_fetch_array($res_meals_sel)){



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

<td><font size="2" face="Arial, Helvetica, sans-serif"><? if($day_sell_rate=="") { echo "&nbsp;" ; $tot_sell_p=0;} else { echo $day_sell_rate; $tot_sell_p=$day_sell_rate;}   ?> </font></td>

    <?


$b_sno++;

$tot_net = $tot_net + $tot_net_p;
$tot_sell = $tot_sell + $tot_sell_p;

$tot_net_p = 0;
$tot_sell_p = 0;

$total_new_hotel = $tot_sell;
}




?>
    </tr>

<tr><td colspan="10" align="center"> Total </td><td><? echo $total_new_hotel ; ?></td></tr>

  </table>


<!-- New Transportation Begin -->

  <table border="1" cellpadding="2" cellspacing="0" width="99%" align="center">
      <tr><td align="left" colspan="13"><strong>Transportation</strong></td></tr>
    <tr>
        <td><div align="center"><font size="2" face="Arial, Helvetica, sans-serif">Sno</font></div></td>
        <td><div align="center"><font size="2" face="Arial, Helvetica, sans-serif">PNR</font></div></td>
        <td><div align="center"><font size="2" face="Arial, Helvetica, sans-serif">Guest
            Name</font></div></td>
            <td><div align="center"><font size="2" face="Arial, Helvetica, sans-serif">Room No</font></div></td>
  		  <td><div align="center"><font size="2" face="Arial, Helvetica, sans-serif">Type of Trans</font></div></td>

  <td><div align="center"><font size="2" face="Arial, Helvetica, sans-serif">Route</font></div></td>
  		   <td><div align="center"><font size="2" face="Arial, Helvetica, sans-serif">Travel
            Agent,Country</font></div></td>

        <td><div align="center"><font size="2" face="Arial, Helvetica, sans-serif">Request Date</font></div></td>

        <td><div align="center"><font size="2" face="Arial, Helvetica, sans-serif">Units</font></div></td>
  	        <td><div align="center"><font size="2" face="Arial, Helvetica, sans-serif">Paxs</font></div></td>
  				        <td><div align="center"><font size="2" face="Arial, Helvetica, sans-serif">Flight Det</font></div></td>


        <td><div align="center"><font size="2" face="Arial, Helvetica, sans-serif">B.Status</font></div></td>
  	  <td><div align="center"><font size="2" face="Arial, Helvetica, sans-serif">SellRate</font></div></td>




      <tr>

  <?

  //$query  = "SELECT ocode,cin, cout,hotel_id, room_id,no_rooms,no_nights,cus_paid,booking_status,net_rate,sell_rate,room_inhouseno,hotel_confirmation_no,cus_voucher, guest_occ_status, cus_paid from sales_hotels where $date_bulls between date '$fromd' and  date '$tod'  $not_arr  $q_hotel order by cin";

 $query  = "SELECT  st.ocode,f2t,type_of_trans,no_of_units,req_date_time,no_of_paxs,st.flight_det,net_rate,sell_rate,tot_net_rate,tot_sell_rate,sm.booking_status,occp,sm.order_date,sm.option_date,cus_voucher,sm.cus_account_code,supp_account_code,supp_invoice,cus_paid,sm.amend_bull,trans_id,kind_of_trans,trans_model,supp_rep,trans_id_s,room_inhouseno from sales_trans as st, sales_main as sm where sm.created_at between '$fromd 00:00:00' and '$fromd 23:59:59' and sm.ocode=st.ocode and sm.created_at=sm.modified_at $not_arr $q_hotel  order by req_date_time";






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
  <td><font size="2" face="Arial, Helvetica, sans-serif"><? echo 	strtoupper($row["room_inhouseno"])?></font></td>

  <td><font size="2" face="Arial, Helvetica, sans-serif"><? echo 	strtoupper($row["type_of_trans"])?></font></td>

  <td align="center"><font size="2" face="Arial, Helvetica, sans-serif"><?echo $row["f2t"]; ?> </font></td>

  <td><font size="2" face="Arial, Helvetica, sans-serif"><? echo 	strtoupper($s_cus_company_name) . ", " . strtoupper($s_cus_country); ?></font></td>

  <td align="center"><font size="2" face="Arial, Helvetica, sans-serif"><?echo date('d M, Y H:i', strtotime($row['req_date_time']));  ?></font></td>

  <td align="center"><font size="2" face="Arial, Helvetica, sans-serif"><?echo $row["no_of_units"]; ?></font></td>

  <td align="center"><font size="2" face="Arial, Helvetica, sans-serif"><?echo $row["no_of_paxs"]; ?> </font></td>
  <td align="center"><font size="2" face="Arial, Helvetica, sans-serif"><?echo $row["flight_det"]; ?> </font></td>



  <td><font size="2" face="Arial, Helvetica, sans-serif"><? echo $row["booking_status"];  ?> </font></td>
  <td><font size="2" face="Arial, Helvetica, sans-serif"><? if($row["sell_rate"]=="") { echo "&nbsp;" ; $tot_sell_p=0;} else { echo $row["sell_rate"]; $tot_sell_p=$row["sell_rate"];}   ?> </font></td>

      <?


  $b_sno++;

  $tot_net = $tot_net + $tot_net_p;
  $tot_sell = $tot_sell + $tot_sell_p;

  $tot_new_trans = $tot_new_trans + $tot_sell_p;
  $tot_net_p = 0;
  $tot_sell_p = 0;

  }

$tot_new =  $tot_sell;



  ?>
      </tr>

  <tr><td colspan="12" align="center"> Totals </td><td><? echo $tot_new_trans ; ?></td></tr>

    </table>
<table border="1" cellpadding="2" cellspacing="0" width="99%" align="center">
  <tr><td colspan="12" align="center"><strong>Total New Bookings: <? echo $tot_new ; ?></strong></tr>
</table>

<!--  Amendments -->


<br>
<table border="1" cellpadding="2" cellspacing="0" width="99%" align="center">
    <tr><td align="center" bgcolor="#ffb764"><strong>Amended Bookings</strong></td></tr>

</table>

<table border="1"  cellpadding="2" cellspacing="0" width="99%" align="center">
    <tr><td align="left" colspan="12"><strong>Hotels</strong></td></tr>
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
			<td><div align="center"><font size="2" face="Arial, Helvetica, sans-serif">Last Modified Date</font></div></td>


	  <td><div align="center"><font size="2" face="Arial, Helvetica, sans-serif">Amount</font></div></td>




    <tr>

<?

  $query_mod_hotel  = "SELECT sales_hotels_sno,sm.ocode as ocode,cin, cout, room_id,no_rooms,hotel_id,no_nights,cus_paid, guest_occ_status, room_inhouseno,cus_paid, sm.last_modified_at as last_modified_at from sales_hotels as sh, sales_main as sm where sm.created_at<>sm.modified_at and sm.ocode=sh.ocode and sm.modified_at between '$fromd 00:00:00' and '$fromd 23:59:59'  and sm.ocode!='NC' and sm.booking_status!='Cancelled'   order by sh.created_at";



$result_mod_hotel = pg_query($conn, $query_mod_hotel);

$rowc_mod_hotel = pg_num_rows($result_mod_hotel);
//printf("Records selected: %d\n", mysql_affected_rows());

$ac=0;
$afd=array();
$atd=array();
$anofn=array();

$apaid=array();
?>
    <?
$b_sno=1;
while ($row_mod_hotel = pg_fetch_array($result_mod_hotel))
{

$s_hotels_sno =  $row_mod_hotel["sales_hotels_sno"];

$q_meals_sel ="select sum(day_sell_rate) as day_sell_rate from sales_meals where sales_hotels_sno=$s_hotels_sno";


$res_meals_sel = pg_query($conn, $q_meals_sel);

if (!$res_meals_sel) {
echo "An error occured.\n";
exit;
		}

while ($rows_meals_sel = pg_fetch_array($res_meals_sel)){



$day_sell_rate = $rows_meals_sel["day_sell_rate"];
}

$s_ocode = $row_mod_hotel["ocode"];
$s_hotel_id =  $row_mod_hotel["hotel_id"];
$s_room_id =  $row_mod_hotel["room_id"];

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
	<td ><font size="2" face="Arial, Helvetica, sans-serif"><a href="pnrdet.php?spnr=<?echo $row["ocode"];?>" target='<?echo $row["ocode"];?>' onClick="window.open('','<?echo $row["ocode"];?>', ' width='+(screen.width-10)+' , height='+(screen.height-50)+' , left=0,top=0 ').focus()"  ><?echo $row_mod_hotel["ocode"];?></a></font></td>

<td><font size="2" face="Arial, Helvetica, sans-serif"><? echo 	$s_guest_title . ". " . strtoupper($s_guest_name); ?></font></td>
<td><font size="2" face="Arial, Helvetica, sans-serif"><? echo 	strtoupper($hotel_name) . ", " . strtoupper($hotel_city); ?></font></td>

<td><font size="2" face="Arial, Helvetica, sans-serif"><? echo 	strtoupper($s_cus_company_name) . ", " . strtoupper($s_cus_country); ?></font></td>

<td align="center"><font size="2" face="Arial, Helvetica, sans-serif"><?echo date('d', strtotime($row_mod_hotel["cin"])); ?><?echo date('M', strtotime($row_mod_hotel["cin"])); ?></font></td>

<td align="center"><font size="2" face="Arial, Helvetica, sans-serif"><?echo date('d', strtotime($row_mod_hotel["cout"])); ?><?echo date('M', strtotime($row_mod_hotel["cout"])); ?></font></td>

<td align="center"><font size="2" face="Arial, Helvetica, sans-serif"><?echo $row_mod_hotel["no_nights"]; ?> </font></td>
<td align="center"><font size="2" face="Arial, Helvetica, sans-serif"><?echo $row_mod_hotel["no_rooms"]; ?> </font></td>


<td align="center"><font size="2" face="Arial, Helvetica, sans-serif"><?echo $room_type; ?> </font></td>
<td align="center"><font size="2" face="Arial, Helvetica, sans-serif"><?echo $row_mod_hotel["last_modified_at"]; ?> </font></td>

<td><font size="2" face="Arial, Helvetica, sans-serif"><? if($day_sell_rate=="") { echo "&nbsp;" ; $tot_sell_p=0;} else { echo $day_sell_rate; $tot_sell_p=$day_sell_rate;}   ?> </font></td>

    <?


$b_sno++;

$tot_net = $tot_net + $tot_net_p;
$tot_sell = $tot_sell + $tot_sell_p;
$tot_amd_hotel = $tot_amd_hotel + $tot_sell_p;
$tot_net_p = 0;
$tot_sell_p = 0;


}



?>
    </tr>

<tr><td colspan="11" align="center"> Total </td><td><? echo $tot_amd_hotel ; ?></td></tr>

  </table>


<!-- New Transportation Begin -->

  <table border="1" cellpadding="2" cellspacing="0" width="99%" align="center">
      <tr><td align="left" colspan="13"><strong>Transportation</strong></td></tr>
    <tr>
        <td><div align="center"><font size="2" face="Arial, Helvetica, sans-serif">Sno</font></div></td>
        <td><div align="center"><font size="2" face="Arial, Helvetica, sans-serif">PNR</font></div></td>
        <td><div align="center"><font size="2" face="Arial, Helvetica, sans-serif">Guest
            Name</font></div></td>
            <td><div align="center"><font size="2" face="Arial, Helvetica, sans-serif">Room No</font></div></td>
  		  <td><div align="center"><font size="2" face="Arial, Helvetica, sans-serif">Type of Trans</font></div></td>

  <td><div align="center"><font size="2" face="Arial, Helvetica, sans-serif">Route</font></div></td>
  		   <td><div align="center"><font size="2" face="Arial, Helvetica, sans-serif">Travel
            Agent,Country</font></div></td>

        <td><div align="center"><font size="2" face="Arial, Helvetica, sans-serif">Request Date</font></div></td>

        <td><div align="center"><font size="2" face="Arial, Helvetica, sans-serif">Units</font></div></td>
  	        <td><div align="center"><font size="2" face="Arial, Helvetica, sans-serif">Paxs</font></div></td>
  				        <td><div align="center"><font size="2" face="Arial, Helvetica, sans-serif">Flight Det</font></div></td>


        <td><div align="center"><font size="2" face="Arial, Helvetica, sans-serif">Last Modified Date</font></div></td>
  	  <td><div align="center"><font size="2" face="Arial, Helvetica, sans-serif">SellRate</font></div></td>




      <tr>

  <?

  //$query  = "SELECT ocode,cin, cout,hotel_id, room_id,no_rooms,no_nights,cus_paid,booking_status,net_rate,sell_rate,room_inhouseno,hotel_confirmation_no,cus_voucher, guest_occ_status, cus_paid from sales_hotels where $date_bulls between date '$fromd' and  date '$tod'  $not_arr  $q_hotel order by cin";

 $query  = "SELECT  st.ocode,f2t,type_of_trans,no_of_units,req_date_time,no_of_paxs,st.flight_det,net_rate,sell_rate,tot_net_rate,tot_sell_rate,sm.booking_status,occp,sm.order_date,st.option_date,cus_voucher,st.cus_account_code,supp_account_code,supp_invoice,cus_paid,st.amend_bull,trans_id,kind_of_trans,trans_model,supp_rep,trans_id_s,room_inhouseno, sm.last_modified_at as last_modified_at from sales_trans as st, sales_main as sm where sm.created_at<>sm.modified_at and sm.ocode=st.ocode and sm.modified_at between '$fromd 00:00:00' and '$fromd 23:59:59' and sm.booking_status!='Cancelled'   order by req_date_time";






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
  <td><font size="2" face="Arial, Helvetica, sans-serif"><? echo 	strtoupper($row["room_inhouseno"])?></font></td>

  <td><font size="2" face="Arial, Helvetica, sans-serif"><? echo 	strtoupper($row["type_of_trans"])?></font></td>

  <td align="center"><font size="2" face="Arial, Helvetica, sans-serif"><?echo $row["f2t"]; ?> </font></td>

  <td><font size="2" face="Arial, Helvetica, sans-serif"><? echo 	strtoupper($s_cus_company_name) . ", " . strtoupper($s_cus_country); ?></font></td>

  <td align="center"><font size="2" face="Arial, Helvetica, sans-serif"><?echo date('d M, Y H:i', strtotime($row['req_date_time']));  ?></font></td>

  <td align="center"><font size="2" face="Arial, Helvetica, sans-serif"><?echo $row["no_of_units"]; ?></font></td>

  <td align="center"><font size="2" face="Arial, Helvetica, sans-serif"><?echo $row["no_of_paxs"]; ?> </font></td>
  <td align="center"><font size="2" face="Arial, Helvetica, sans-serif"><?echo $row["flight_det"]; ?> </font></td>



  <td><font size="2" face="Arial, Helvetica, sans-serif"><? echo $row["last_modified_at"];  ?> </font></td>
  <td><font size="2" face="Arial, Helvetica, sans-serif"><? if($row["sell_rate"]=="") { echo "&nbsp;" ; $tot_sell_p=0;} else { echo $row["sell_rate"]; $tot_sell_p=$row["sell_rate"];}   ?> </font></td>

      <?


  $b_sno++;

  $tot_net = $tot_net + $tot_net_p;
  $tot_sell = $tot_sell + $tot_sell_p;
  $tot_amd_trans = $tot_amd_trans + $tot_sell_p;
  $tot_net_p = 0;
  $tot_sell_p = 0;


  }

  $tot_amended = $tot_amd_hotel + $tot_amd_trans;



  ?>
      </tr>

  <tr><td colspan="12" align="center"> Totals </td><td><? echo $tot_amd_trans ; ?></td></tr>

    </table>

<table border="1" cellpadding="2" cellspacing="0" width="99%" align="center">
  <tr><td colspan="12" align="center"><strong>Total Amended Bookings: <? echo $tot_amended ; ?></strong></tr>
</table>

    <!--  Cancelled -->


    <br>
    <table border="1" cellpadding="2" cellspacing="0" width="99%" align="center">
        <tr><td align="center" bgcolor="#ff6464"><strong>Cancelled Bookings</strong></td></tr>

    </table>

    <table border="1"  cellpadding="2" cellspacing="0" width="99%" align="center">
        <tr><td align="left" colspan="11"><strong>Hotels</strong></td></tr>
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


    	  <td><div align="center"><font size="2" face="Arial, Helvetica, sans-serif">Amount</font></div></td>




        <tr>

    <?

    $query  = "SELECT sales_hotels_sno,sh.ocode,cin, cout, room_id,no_rooms,hotel_id,no_nights,cus_paid, guest_occ_status, room_inhouseno,cus_paid from sales_hotels as sh, sales_main as sm where sh.ocode=sm.ocode and cancel_date  between '$fromd 00:00:00' and '$fromd 23:59:59' and sh.ocode!='NC' and sm.booking_status='Cancelled'   order by sh.created_at";



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

    $q_meals_sel ="select sum(day_sell_rate) as day_sell_rate from sales_meals where sales_hotels_sno=$s_hotels_sno";


    $res_meals_sel = pg_query($conn, $q_meals_sel);

    if (!$res_meals_sel) {
    echo "An error occured.\n";
    exit;
    		}

    while ($rows_meals_sel = pg_fetch_array($res_meals_sel)){



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

    <td><font size="2" face="Arial, Helvetica, sans-serif"><? if($day_sell_rate=="") { echo "&nbsp;" ; $tot_sell_p=0;} else { echo $day_sell_rate; $tot_sell_p=$day_sell_rate;}   ?> </font></td>

        <?


    $b_sno++;

    $tot_net = $tot_net + $tot_net_p;
    $tot_can_hotel = $tot_can_hotel + $tot_sell_p;
    $tot_net_p = 0;
    $tot_sell_p = 0;


    }




    ?>
        </tr>

    <tr><td colspan="10" align="center"> Total </td><td><? echo $tot_can_hotel ; ?></td></tr>

      </table>


    <!-- New Transportation Begin -->

      <table border="1" cellpadding="2" cellspacing="0" width="99%" align="center">
          <tr><td align="left" colspan="13"><strong>Transportation</strong></td></tr>
        <tr>
            <td><div align="center"><font size="2" face="Arial, Helvetica, sans-serif">Sno</font></div></td>
            <td><div align="center"><font size="2" face="Arial, Helvetica, sans-serif">PNR</font></div></td>
            <td><div align="center"><font size="2" face="Arial, Helvetica, sans-serif">Guest
                Name</font></div></td>
                <td><div align="center"><font size="2" face="Arial, Helvetica, sans-serif">Room No</font></div></td>
      		  <td><div align="center"><font size="2" face="Arial, Helvetica, sans-serif">Type of Trans</font></div></td>

      <td><div align="center"><font size="2" face="Arial, Helvetica, sans-serif">Route</font></div></td>
      		   <td><div align="center"><font size="2" face="Arial, Helvetica, sans-serif">Travel
                Agent,Country</font></div></td>

            <td><div align="center"><font size="2" face="Arial, Helvetica, sans-serif">Request Date</font></div></td>

            <td><div align="center"><font size="2" face="Arial, Helvetica, sans-serif">Units</font></div></td>
      	        <td><div align="center"><font size="2" face="Arial, Helvetica, sans-serif">Paxs</font></div></td>
      				        <td><div align="center"><font size="2" face="Arial, Helvetica, sans-serif">Flight Det</font></div></td>


            <td><div align="center"><font size="2" face="Arial, Helvetica, sans-serif">B.Status</font></div></td>
      	  <td><div align="center"><font size="2" face="Arial, Helvetica, sans-serif">SellRate</font></div></td>




          <tr>

      <?

      //$query  = "SELECT ocode,cin, cout,hotel_id, room_id,no_rooms,no_nights,cus_paid,booking_status,net_rate,sell_rate,room_inhouseno,hotel_confirmation_no,cus_voucher, guest_occ_status, cus_paid from sales_hotels where $date_bulls between date '$fromd' and  date '$tod'  $not_arr  $q_hotel order by cin";

        $query  = "SELECT  st.ocode,f2t,type_of_trans,no_of_units,req_date_time,no_of_paxs,st.flight_det,net_rate,sell_rate,tot_net_rate,tot_sell_rate,st.booking_status,occp,st.order_date,st.option_date,cus_voucher,st.cus_account_code,supp_account_code,supp_invoice,cus_paid,st.amend_bull,trans_id,kind_of_trans,trans_model,supp_rep,trans_id_s,room_inhouseno from sales_trans as st, sales_main as sm where cancel_date  between '$fromd 00:00:00' and '$fromd 23:59:59' and st.ocode=sm.ocode and sm.booking_status='Cancelled' order by req_date_time";






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
      <td><font size="2" face="Arial, Helvetica, sans-serif"><? echo 	strtoupper($row["room_inhouseno"])?></font></td>

      <td><font size="2" face="Arial, Helvetica, sans-serif"><? echo 	strtoupper($row["type_of_trans"])?></font></td>

      <td align="center"><font size="2" face="Arial, Helvetica, sans-serif"><?echo $row["f2t"]; ?> </font></td>

      <td><font size="2" face="Arial, Helvetica, sans-serif"><? echo 	strtoupper($s_cus_company_name) . ", " . strtoupper($s_cus_country); ?></font></td>

      <td align="center"><font size="2" face="Arial, Helvetica, sans-serif"><?echo date('d M, Y H:i', strtotime($row['req_date_time']));  ?></font></td>

      <td align="center"><font size="2" face="Arial, Helvetica, sans-serif"><?echo $row["no_of_units"]; ?></font></td>

      <td align="center"><font size="2" face="Arial, Helvetica, sans-serif"><?echo $row["no_of_paxs"]; ?> </font></td>
      <td align="center"><font size="2" face="Arial, Helvetica, sans-serif"><?echo $row["flight_det"]; ?> </font></td>



      <td><font size="2" face="Arial, Helvetica, sans-serif"><? echo $row["booking_status"];  ?> </font></td>
      <td><font size="2" face="Arial, Helvetica, sans-serif"><? if($row["sell_rate"]=="") { echo "&nbsp;" ; $tot_sell_p=0;} else { echo $row["sell_rate"]; $tot_sell_p=$row["sell_rate"];}   ?> </font></td>

          <?


      $b_sno++;

      $tot_net = $tot_net + $tot_net_p;
      $tot_can_trans = $tot_can_trans + $tot_sell_p;
      $tot_net_p = 0;
      $tot_sell_p = 0;


      }

      $tot_can = $tot_can_hotel + $tot_can_trans;



      ?>
          </tr>

      <tr><td colspan="12" align="center"> Totals </td><td><? echo $tot_can_trans ; ?></td></tr>

        </table>

<table border="1" cellpadding="2" cellspacing="0" width="99%" align="center">
  <tr><td colspan="12" align="center"><strong>Total Cancelled Bookings: <? echo $tot_can ; ?></strong></tr>
</table>
<br>
<table border="1" cellpadding="2" cellspacing="0" width="99%" align="center">
  <tr><td colspan="12" align="center"><strong>Grand Net Total Bookings: <?php echo  $grand_tot =  $tot_sell -  $tot_can;   ?></strong></tr>
</table>