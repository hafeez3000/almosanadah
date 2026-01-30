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
$total_no_paxs = 0;


$not_arr = "";

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

if($s_gs=="all"){
$not_arr = "";
}



$sfdate = $_GET["f_d"];
$stdate = $_GET["t_d"];

$date_bulls = "order_date";

$datei = 1;



if($_GET["cinb"]){
$date_bulls = "req_date_time";
$datei = 1;
}


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
   return floor(abs(strtotime($start_date) - strtotime($end_date))/86400);
}

 $df = diff_days($tod, $fromd)+1;




   $cina = array($cin);
   $couta = array($cout);


$hotelid= $_GET["vt"];

$q_hotel="";

//$hotelid="all";



echo $q_hotel;

if($hotelid=="all"){ $q_hotel="";}

else {

$q_str = "select agentid, aname,scountry from agentsdet where acccode='$hotelid'";
$h_result = pg_query($conn, $q_str);

while ($h_row = pg_fetch_array($h_result))
{
  $q_hotel = "and cus_account_code=" . "'".$hotelid."'";
//$hot_name = $h_row["hotel_name"];
//echo "<font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><b>" . $h_row["hotel_name"] . " - Summary Between " . date('d-M-Y', strtotime($sfdate)) ." and ". date('d-M-Y', strtotime($stdate)) . "</b></font>";
}

}




?>
<table border="1" cellpadding="2" cellspacing="0" width="100%">
  <tr>
      <td><div align="center"><font size="2" face="Arial, Helvetica, sans-serif">Sno</font></div></td>
      <td><div align="center"><font size="2" face="Arial, Helvetica, sans-serif">PNR</font></div></td>
      <td><div align="center"><font size="2" face="Arial, Helvetica, sans-serif">Guest
          Name</font></div></td>
    
          <td><div align="center"><font size="2" face="Arial, Helvetica, sans-serif">Room No</font></div></td>
		  <td><div align="center"><font size="2" face="Arial, Helvetica, sans-serif">Supplier</font></div></td>

		  <td><div align="center"><font size="2" face="Arial, Helvetica, sans-serif">Driver Details</font></div></td>
      <td><div align="center"><font size="2" face="Arial, Helvetica, sans-serif">Type of Trans</font></div></td>

<td><div align="center"><font size="2" face="Arial, Helvetica, sans-serif">Route</font></div></td>
		   <td><div align="center"><font size="2" face="Arial, Helvetica, sans-serif">Travel
          Agent,Country</font></div></td>

      <td><div align="center"><font size="2" face="Arial, Helvetica, sans-serif">Request Date</font></div></td>

      <td><div align="center"><font size="2" face="Arial, Helvetica, sans-serif">Units</font></div></td>
	        <td><div align="center"><font size="2" face="Arial, Helvetica, sans-serif">Paxs</font></div></td>
				        <td><div align="center"><font size="2" face="Arial, Helvetica, sans-serif">Flight Det</font></div></td>
      <td><div align="center"><font size="2" face="Arial, Helvetica, sans-serif">B.Status</font></div></td>
      <td align="right"><div align="center"><font size="2" face="Arial, Helvetica, sans-serif">NetRate</font></div></td>
	  <td  align="right"><div align="center"><font size="2" face="Arial, Helvetica, sans-serif">SellRate</font></div></td>
 	  <td  align="right"><div align="center"><font size="2" face="Arial, Helvetica, sans-serif">Profit</font></div></td>
      <td align="right"><div align="center"><font size="2" face="Arial, Helvetica, sans-serif">% Margin</font></div></td>
    <tr>

<?

//$query  = "SELECT ocode,cin, cout,hotel_id, room_id,no_rooms,no_nights,cus_paid,booking_status,net_rate,sell_rate,room_inhouseno,hotel_confirmation_no,cus_voucher, guest_occ_status, cus_paid from sales_hotels where $date_bulls between date '$fromd' and  date '$tod'  $not_arr  $q_hotel order by cin";

$query  = "SELECT  ocode,f2t,type_of_trans,no_of_units,req_date_time,no_of_paxs,flight_det,net_rate,sell_rate,tot_net_rate,tot_sell_rate,booking_status,occp,order_date,option_date,cus_voucher,cus_account_code,supp_account_code,supp_invoice,cus_paid,amend_bull,trans_id,driver_name,driver_mobile,kind_of_trans,trans_model,supp_rep,trans_id_s,room_inhouseno from sales_trans where $date_bulls between date '$fromd' and  date '$tod' + integer '$datei'  $not_arr $q_hotel order by req_date_time";






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
// $s_hotel_id =  $row["hotel_id"];
$supp_account_code = $row["supp_account_code"];
$s_room_id =  $row["room_inhouseno"];
$driver_name = $row["driver_name"];
$driver_mobile = $row["driver_mobile"];


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


$query_sub_room_h  = "SELECT trans_c_name,city  from s_trans where account_code='$supp_account_code' ";

$result_sub_room_h = pg_query($conn, $query_sub_room_h);


while ($row_sub_room_h = pg_fetch_array($result_sub_room_h))
{

$trans_c_name =  $row_sub_room_h["trans_c_name"]; 
$trans_city =  $row_sub_room_h["city"];
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

<td><font size="2" face="Arial, Helvetica, sans-serif"><? echo 	$s_guest_title . ". " . strtoupper((string)$s_guest_name); ?></font></td>
<td><font size="2" face="Arial, Helvetica, sans-serif"><? echo 	strtoupper((string)$row["room_inhouseno"])?></font></td>

<td><font size="2" face="Arial, Helvetica, sans-serif"><? echo 	strtoupper((string)$trans_c_name)?>, <? echo (string)$trans_city;?></font></td>
<td><font size="2" face="Arial, Helvetica, sans-serif"><? echo 	strtoupper((string)$driver_name)?>, <? echo (string)$driver_mobile;?></font></td>
<td><font size="2" face="Arial, Helvetica, sans-serif"><? echo 	strtoupper((string)$row["type_of_trans"])?></font></td>

<td align="center"><font size="2" face="Arial, Helvetica, sans-serif"><?echo $row["f2t"]; ?> </font></td>

<td><font size="2" face="Arial, Helvetica, sans-serif"><? echo 	strtoupper((string)$s_cus_company_name) . ", " . strtoupper((string) $s_cus_country); ?></font></td>

<td align="center"><font size="2" face="Arial, Helvetica, sans-serif"><?echo date('d M, Y H:i', strtotime($row['req_date_time']));  ?></font></td>

<td align="center"><font size="2" face="Arial, Helvetica, sans-serif"><?echo $row["no_of_units"]; ?></font></td>

<td align="center"><font size="2" face="Arial, Helvetica, sans-serif"><?echo $row["no_of_paxs"]; ?> </font></td>
<td align="center"><font size="2" face="Arial, Helvetica, sans-serif"><?echo $row["flight_det"]; ?> </font></td>



<td><font size="2" face="Arial, Helvetica, sans-serif"><? echo $row["booking_status"];  ?> </font></td>
<td align="right"><font size="2" face="Arial, Helvetica, sans-serif"><? if($row["net_rate"]=="") { echo "&nbsp;" ; $tot_net_p=0;} else { echo round($row["net_rate"], 2); $tot_net_p=$row["net_rate"]; } ?> </font></td>
<td align="right"><font size="2" face="Arial, Helvetica, sans-serif"><? if($row["sell_rate"]=="") { echo "&nbsp;" ; $tot_sell_p=0;} else { echo round($row["sell_rate"], 2); $tot_sell_p=$row["sell_rate"];}   ?> </font></td>
<td align="right"><font size="2" face="Arial, Helvetica, sans-serif"><?   echo round($row["sell_rate"]-$row["net_rate"], 2);    ?> </font></td>
<td align="right"><font size="2" face="Arial, Helvetica, sans-serif"><?   if(!$row["net_rate"]) { echo 0; } else { echo round((($row["sell_rate"]-$row["net_rate"])/$row["net_rate"])*100, 2); }    ?> </font></td>

    <?

$total_no_paxs = $total_no_paxs + $row["no_of_paxs"];

$b_sno++;


$tot_net = $tot_net + $tot_net_p;
$tot_sell = $tot_sell + $tot_sell_p;

$tot_net_p = 0;
$tot_sell_p = 0;


}





?>
    </tr>

<tr><td colspan="11" align="center"> <font size="2" face="Arial, Helvetica, sans-serif">Totals</font> </td><td align="center"><font size="2" face="Arial, Helvetica, sans-serif"><? echo $total_no_paxs ; ?></font> </td><td colspan="2" align="center"> <font size="2" face="Arial, Helvetica, sans-serif"></font> </td><td align="right"><font size="2" face="Arial, Helvetica, sans-serif"><? echo round($tot_net,2) ; ?></font> </td><td align="right"><font size="2" face="Arial, Helvetica, sans-serif"><? echo round($tot_sell,2) ; ?></font></td><td align="right"><font size="2" face="Arial, Helvetica, sans-serif"><? echo round(($tot_sell-$tot_net),2) ; ?></font></td><td align="right"><font size="2" face="Arial, Helvetica, sans-serif"><? if(!$tot_net) { echo 0;} else { echo round(((($tot_sell-$tot_net)/$tot_net)*100), 2) ; } ?></font></td></tr>

  </table>




