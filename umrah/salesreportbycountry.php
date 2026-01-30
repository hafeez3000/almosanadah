<script type=text/javascript>
setTimeout('document.location=document.location',240000);
</script>
<script>



</script>
  <?php
  include "../db/db.php";

  $cin = 0;
  $cout = 0;

  $tot_number_nights = 0;
  $tot_no_paxs = 0;

  $s_gs = $_GET["gs"];

  //$s_gs = "on_request";

  if ($s_gs == "on_request") {
      $not_arr = " and sh.booking_status='On Request' ";
  }

  if ($s_gs == "confirmed") {
      $not_arr = " and sh.booking_status='Confirmed' ";
  }

  if ($s_gs == "cancelled") {
      $not_arr = " and sh.booking_status='Cancelled' ";
  }

  $sfdate = $_GET["f_d"];
  $stdate = $_GET["t_d"];

  $tot_net_p = 0;
  $tot_sell_p = 0;

  $tot_net = 0;
  $tot_sell = 0;

  $fromd = $sfdate;
  $tod = $stdate;

  //$fromd = '2006-09-16';
  //$tod = '2006-09-16';

  function diff_days($start_date, $end_date)
  {
      return floor(abs(strtotime($start_date) - strtotime($end_date)) / 86400);
  }

  $df = diff_days($tod, $fromd) + 1;

  $cina = [$cin];
  $couta = [$cout];

  $hotelid = $_GET["vt"];

  $q_hotel = "";

  //$hotelid="all";

  if ($hotelid == "all") {
      $q_hotel = "";
  } else {
      $q_hotel = "and sm.cus_country =" . "'" . $hotelid . "'";
      // echo $q_str = "select agentid, aname,scountry from agentsdet where scountry='$hotelid'";
      // $h_result = pg_query($conn, $q_str);

      //while ($h_row = pg_fetch_array($h_result)) {
      //       $q_hotel = "and ad.scountry =" . "'" . $hotelid . "'";
      //$hot_name = $h_row["hotel_name"];
      //echo "<font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><b>" . $h_row["hotel_name"] . " - Summary Between " . date('d-M-Y', strtotime($sfdate)) ." and ". date('d-M-Y', strtotime($stdate)) . "</b></font>";
      // }
  }
  ?>
<table border="1" cellpadding="2" cellspacing="0" width="100%">
  <tr>
      <td><div align="center"><font size="2" face="Arial, Helvetica, sans-serif">Sno</font></div></td>
      <td><div align="center"><font size="2" face="Arial, Helvetica, sans-serif">PNR</font></div></td>
      <td><div align="center"><font size="2" face="Arial, Helvetica, sans-serif">Guest
          Name</font></div></td>
      <td><div align="center"><font size="2" face="Arial, Helvetica, sans-serif">Agent</font></div></td>
      <td><div align="center"><font size="2" face="Arial, Helvetica, sans-serif">Country</font></div></td>
		   <td><div align="center"><font size="2" face="Arial, Helvetica, sans-serif">Hotel</font></div></td>
		   <td><div align="center"><font size="2" face="Arial, Helvetica, sans-serif">City</font></div></td>

      <td><div align="center"><font size="2" face="Arial, Helvetica, sans-serif">Cin</font></div></td>
      <td><div align="center"><font size="2" face="Arial, Helvetica, sans-serif">Cout</font></div></td>
	        <td><div align="center"><font size="2" face="Arial, Helvetica, sans-serif">Nts</font></div></td>
			<td><div align="center"><font size="2" face="Arial, Helvetica, sans-serif">Room Type</font></div></td>
			<td><div align="center"><font size="2" face="Arial, Helvetica, sans-serif">Paxs</font></div></td>

      <td><div align="center"><font size="2" face="Arial, Helvetica, sans-serif">B.Status</font></div></td>
      <td align="right"><div align="center"><font size="2" face="Arial, Helvetica, sans-serif">NetRate</font></div></td>
	  <td align="right"><div align="center"><font size="2" face="Arial, Helvetica, sans-serif">SellRate</font></div></td>
 	  <td align="right"><div align="center"><font size="2" face="Arial, Helvetica, sans-serif">Profit</font></div></td>
     <td align="right"><div align="center"><font size="2" face="Arial, Helvetica, sans-serif">% Margin</font></div></td>




    <tr>

<?

$query  = "SELECT
sh.ocode,cin, cout,hotel_id, room_id,no_rooms,no_nights,cus_paid,sh.booking_status,no_paxs,net_rate,sell_rate,room_inhouseno,hotel_confirmation_no,cus_voucher, guest_occ_status, cus_paid from sales_hotels as sh
LEFT JOIN sales_main as sm ON sh.ocode=sm.ocode
where sh.cin between date '$fromd' and date '$tod' + integer '1' $not_arr  $q_hotel order by sm.cus_country";




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
<td><font size="2" face="Arial, Helvetica, sans-serif"><? echo $s_cus_company_name; ?></font></td>
<td><font size="2" face="Arial, Helvetica, sans-serif"><? echo 	strtoupper($s_cus_country); ?></font></td>
<td><font size="2" face="Arial, Helvetica, sans-serif"><? echo strtoupper($hotel_name); ?></font></td>
<td><font size="2" face="Arial, Helvetica, sans-serif"><? echo 	 strtoupper($hotel_city); ?></font></td>

<td align="center"><font size="2" face="Arial, Helvetica, sans-serif"><?echo date('d', strtotime($row["cin"])); ?><br><?echo date('M', strtotime($row["cin"])); ?></font></td>

<td align="center"><font size="2" face="Arial, Helvetica, sans-serif"><?echo date('d', strtotime($row["cout"])); ?><br><?echo date('M', strtotime($row["cout"])); ?></font></td>

<td align="center"><font size="2" face="Arial, Helvetica, sans-serif"><?echo $row["no_nights"]; ?> </font></td>

<td align="center"><font size="2" face="Arial, Helvetica, sans-serif"><?echo $room_type; ?> </font></td>
<td align="center"><font size="2" face="Arial, Helvetica, sans-serif"><?echo $row["no_paxs"]; ?> </font></td>
<td><font size="2" face="Arial, Helvetica, sans-serif"><? echo $row["booking_status"];  ?> </font></td>
<td align="right"><font size="2" face="Arial, Helvetica, sans-serif"><? if($row["net_rate"]=="") { echo "&nbsp;" ; $tot_net_p=0;} else { echo round($row["net_rate"], 2); $tot_net_p=$row["net_rate"]; } ?> </font></td>
<td align="right"><font size="2" face="Arial, Helvetica, sans-serif"><? if($row["sell_rate"]=="") { echo "&nbsp;" ; $tot_sell_p=0;} else { echo round($row["sell_rate"], 2); $tot_sell_p=$row["sell_rate"];}   ?> </font></td>
<td align="right"><font size="2" face="Arial, Helvetica, sans-serif"><?   echo round($row["sell_rate"]-$row["net_rate"], 2);    ?> </font></td>
<td align="right"><font size="2" face="Arial, Helvetica, sans-serif"><?   echo round(((($row["sell_rate"]-$row["net_rate"])/$row["net_rate"])*100), 2);    ?> </font></td>

    <?

$tot_number_nights = $tot_number_nights + $row["no_nights"];
$tot_no_paxs = $tot_no_paxs + $row["no_paxs"];


$b_sno++;

$tot_net = $tot_net + $tot_net_p;
$tot_sell = $tot_sell + $tot_sell_p;

$tot_net_p = 0;
$tot_sell_p = 0;


}





?>
    </tr>

<tr><td align="center"> <font size="2" face="Arial, Helvetica, sans-serif">Totals </font></td>
    <td align="center"><font size="2" face="Arial, Helvetica, sans-serif"></font> <? echo "&nbsp" ; ?></td>
    <td align="center"><font size="2" face="Arial, Helvetica, sans-serif"></font> <? echo "&nbsp" ; ?></td>
    <td align="center"><font size="2" face="Arial, Helvetica, sans-serif"></font> <? echo "&nbsp" ; ?></td>
    <td align="center"><font size="2" face="Arial, Helvetica, sans-serif"></font> <? echo "&nbsp" ; ?></td>
    <td align="center"><font size="2" face="Arial, Helvetica, sans-serif"></font> <? echo "&nbsp" ; ?></td>
    <td align="center"><font size="2" face="Arial, Helvetica, sans-serif"></font> <? echo "&nbsp" ; ?></td>
    <td align="center"><font size="2" face="Arial, Helvetica, sans-serif"></font> <? echo "&nbsp" ; ?></td>
    <td align="center"><font size="2" face="Arial, Helvetica, sans-serif"></font> <? echo "&nbsp" ; ?></td>
    <td align="center"><font size="2" face="Arial, Helvetica, sans-serif"><? echo $tot_number_nights ; ?></font> </td>
    <td align="center"><font size="2" face="Arial, Helvetica, sans-serif"></font> <? echo "&nbsp" ; ?></td>
    <td align="center"><font size="2" face="Arial, Helvetica, sans-serif"><? echo $tot_no_paxs ; ?></font> </td>
    <td align="center"><font size="2" face="Arial, Helvetica, sans-serif"></font><? echo "&nbsp" ; ?> </font> </td>
    <td align="right"><font size="2" face="Arial, Helvetica, sans-serif"><? echo round($tot_net,2) ; ?></font> </td>
    <td align="right"><font size="2" face="Arial, Helvetica, sans-serif"><? echo round($tot_sell,2) ; ?></font></td>
    <td align="right"><font size="2" face="Arial, Helvetica, sans-serif"><? echo round(($tot_sell-$tot_net),2) ; ?></font></td>
    <td align="right"><font size="2" face="Arial, Helvetica, sans-serif"><? echo (isset($tot_net) && ($tot_net != 0) ? round(((($tot_sell-$tot_net)/$tot_net)*100), 2) : 0); ?></font></td>
</tr>

  </table>
