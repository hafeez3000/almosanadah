<script type=text/javascript>
setTimeout('document.location=document.location',240000);
</script>
<?php
include "../db/db.php";

$cin = 0;
$cout = 0;

$tot_number_nights = 0;

$s_gs = $_GET["gs"];

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

$tot_net_p_g = 0;
$tot_sell_p_g = 0;

$no_of_paxs = 0;
$grand_total_no_of_paxs = 0;

$fromd = $sfdate;
$tod = $stdate;

function diff_days($start_date, $end_date)
{
    return floor(abs(strtotime($start_date) - strtotime($end_date)) / 86400);
}

$df = diff_days($tod, $fromd) + 1;

$cina = [$cin];
$couta = [$cout];

$hotelid = $_GET["vt"];

$q_hotel = "";

if ($hotelid == "all") {
    $q_hotel = "";
} else {
    $q_hotel = "and sm.cus_country =" . "'" . $hotelid . "'";
}
?>
<table align="center" border="1" cellpadding="2" cellspacing="0" width="80%">
  <tr>
      <td><div align="center"><font size="2" face="Arial, Helvetica, sans-serif">Segment</font></div></td>
      <td align="right"><div align="right"><font size="2" face="Arial, Helvetica, sans-serif">Paxs</font></div></td>
      <td align="right"><div align="right"><font size="2" face="Arial, Helvetica, sans-serif">NetRate</font></div></td>
	  <td align="right"><div align="right"><font size="2" face="Arial, Helvetica, sans-serif">SellRate</font></div></td>
 	  <td align="right"><div align="right"><font size="2" face="Arial, Helvetica, sans-serif">Profit</font></div></td>
     <td align="right"><div align="right"><font size="2" face="Arial, Helvetica, sans-serif">% Margin</font></div></td>
    <tr>


<?
// Strart of Hotel Sales

$query  = "SELECT
sh.ocode,cin, cout,hotel_id, room_id,no_rooms,no_nights,cus_paid,no_paxs, sh.booking_status,net_rate,sell_rate,room_inhouseno,hotel_confirmation_no,cus_voucher, guest_occ_status, cus_paid from sales_hotels as sh
LEFT JOIN sales_main as sm ON sh.ocode=sm.ocode
where sh.cin between date '$fromd' and date '$tod' + integer '1' $not_arr  $q_hotel order by sm.cus_country";

$result = pg_query($conn, $query);

$rowc = pg_num_rows($result);

$s_no_paxs = 0;

$ac=0;
$afd=array();
$atd=array();
$anofn=array();

$apaid=array();
$b_sno=1;
while ($row = pg_fetch_array($result))
{
$s_room_id =  $row["room_id"];
if($row["net_rate"]=="") { echo "&nbsp;" ; $tot_net_p=0;} else { round($row["net_rate"], 2); $tot_net_p=$row["net_rate"]; }
if($row["sell_rate"]=="") { echo "&nbsp;" ; $tot_sell_p=0;} else { round($row["sell_rate"], 2); $tot_sell_p=$row["sell_rate"];}
round($row["sell_rate"]-$row["net_rate"], 2);
round(((($row["sell_rate"]-$row["net_rate"])/$row["net_rate"])*100), 2);

$tot_number_nights = $tot_number_nights + $row["no_nights"];

$b_sno++;

$tot_net = $tot_net + $tot_net_p;
$tot_sell = $tot_sell + $tot_sell_p;

$tot_net_p = 0;
$tot_sell_p = 0;

$no_of_paxs = $no_of_paxs + $row["no_paxs"];

}

?>
<tr><td colspan="1" align="center"> <font size="2" face="Arial, Helvetica, sans-serif">Hotels </font></td><td align="right"><font size="2" face="Arial, Helvetica, sans-serif"><? echo round($no_of_paxs,2) ; ?></font> </td><td align="right"><font size="2" face="Arial, Helvetica, sans-serif"><? echo round($tot_net,2) ; ?></font> </td><td align="right"><font size="2" face="Arial, Helvetica, sans-serif"><? echo round($tot_sell,2) ; ?></font></td><td align="right"><font size="2" face="Arial, Helvetica, sans-serif"><? echo round(($tot_sell-$tot_net),2) ; ?></font></td><td align="right"><font size="2" face="Arial, Helvetica, sans-serif"><? echo (isset($tot_net) && ($tot_net != 0) ? round(((($tot_sell-$tot_net)/$tot_net)*100), 2) : 0); ?></font></td></tr>
<?
// End of Hotel Sales
$tot_net_p_g = $tot_net_p_g + $tot_net;
$tot_sell_p_g = $tot_sell_p_g + $tot_sell;

$grand_total_no_of_paxs = $grand_total_no_of_paxs + $no_of_paxs;

?>


<?
// Strart of Transport Sales

$tot_net = 0;
$tot_sell = 0;

$s_no_paxs = 0;
$no_of_paxs = 0;

   $not_arr = " and st.booking_status='Confirmed' ";

$date_bulls = "req_date_time";
$datei = 0;

if ($hotelid == "all") {
    $q_hotel = "";
} else {
    $q_hotel = "and sm.cus_country =" . "'" . $hotelid . "'";
}


$query  = "SELECT  st.ocode,f2t,type_of_trans,no_of_units,req_date_time,no_of_paxs,st.flight_det,net_rate,sell_rate,tot_net_rate,tot_sell_rate,st.booking_status,occp,st.order_date,st.option_date,cus_voucher,st.cus_account_code,supp_account_code,supp_invoice,cus_paid,st.amend_bull,trans_id,driver_name,driver_mobile,kind_of_trans,trans_model,supp_rep,trans_id_s,room_inhouseno
from sales_trans as st
LEFT JOIN sales_main as sm ON st.ocode=sm.ocode
where $date_bulls between date '$fromd' and  date '$tod' + integer '$datei'   $not_arr $q_hotel order by sm.cus_country, req_date_time";

$result = pg_query($conn, $query);

$rowc = pg_num_rows($result);

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
$no_of_paxs = $no_of_paxs + $row["no_of_paxs"];

if($row["net_rate"]=="") {  $tot_net_p=0;} else { round($row["net_rate"], 2); $tot_net_p=$row["net_rate"]; }
if($row["sell_rate"]=="") { $tot_sell_p=0;} else { round($row["sell_rate"], 2); $tot_sell_p=$row["sell_rate"];}
round($row["sell_rate"]-$row["net_rate"], 2);
if(!$row["net_rate"]) {  } else {  round((($row["sell_rate"]-$row["net_rate"])/$row["net_rate"])*100, 2); }




$b_sno++;

$tot_net = $tot_net + $tot_net_p;
$tot_sell = $tot_sell + $tot_sell_p;

$tot_net_p = 0;
$tot_sell_p = 0;
}
?>
</tr>

<tr><td colspan="1" align="center"> <font size="2" face="Arial, Helvetica, sans-serif">Transportation</font> </td><td align="right"><font size="2" face="Arial, Helvetica, sans-serif"><? echo round($no_of_paxs, 2); ?></font> </td><td align="right"><font size="2" face="Arial, Helvetica, sans-serif"><? echo round($tot_net, 2); ?></font> </td><td align="right"><font size="2" face="Arial, Helvetica, sans-serif"><? echo round($tot_sell, 2); ?></font></td><td align="right"><font size="2" face="Arial, Helvetica, sans-serif"><? echo round(($tot_sell - $tot_net), 2); ?></font></td><td align="right"><font size="2" face="Arial, Helvetica, sans-serif"><? if (!$tot_net) {
                echo 0; } else { echo round(((($tot_sell-$tot_net)/$tot_net)*100), 2) ; } ?></font></td></tr>




<?
$grand_total_no_of_paxs = $grand_total_no_of_paxs + $no_of_paxs;
$tot_net_p_g = $tot_net_p_g + $tot_net;
$tot_sell_p_g = $tot_sell_p_g + $tot_sell;
// End of Transport Sales
// Strart of Visa Sales

if ($hotelid == "all") {
    $q_hotel = "";
} else {
    $q_hotel = "and sm.cus_country =" . "'" . $hotelid . "'";
}

$s_no_paxs = 0;
$no_of_paxs = 0;

$tot_no_a = 0;
$tot_no_c = 0;
$tot_no_i = 0;

$tot_net_p = 0;
$tot_sell_p = 0;

$tot_net = 0;
$tot_sell = 0;

$not_arr = " and sv.booking_status='Confirmed' ";

$query = "select sv.ocode,req_date_time,no_adults,no_child,no_infant,net_adults,net_child,net_infant,sell_adults,sell_child,sell_infant,tot_net_adults,tot_net_child,tot_net_infant,tot_sell_adults,tot_sell_child,tot_sell_infant,sv.booking_status,mofa,sv.order_date,sv.option_date,cus_voucher,sv.cus_account_code,supp_account_code,supp_invoice,cus_paid,sv.amend_bull,mofa_bull
from sales_visa as sv
LEFT JOIN sales_main as sm ON sv.ocode=sm.ocode
where $date_bulls between date '$fromd' and  date '$tod' + integer '$datei' $not_arr $q_hotel order by sm.cus_country, req_date_time";



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
// $s_room_id =  $row["room_id"];






?>



<?


if($row["net_adults"]=="" || $row["net_child"]=="") {   $tot_net_p=0;} else {  round(($row["no_adults"]*$row["net_adults"])+($row["no_child"]*$row["net_child"]), 2); $tot_net_p=($row["no_adults"]*$row["net_adults"])+($row["no_child"]*$row["net_child"]); } if($row["sell_adults"]=="" || $row["sell_child"]=="") {$tot_sell_p=0;} else {  round(($row["no_adults"]*$row["sell_adults"])+($row["no_child"]*$row["sell_child"]), 2); $tot_sell_p=($row["no_adults"]*$row["sell_adults"])+($row["no_child"]*$row["sell_child"]); }
round(($tot_sell_p-$tot_net_p), 2);
if(!$tot_net_p) { echo 0; } else {  round(((($tot_sell_p-$tot_net_p)/$tot_net_p)*100), 2); }

$b_sno++;

$tot_net = $tot_net + $tot_net_p;
$tot_sell = $tot_sell + $tot_sell_p;

$tot_net_p = 0;
$tot_sell_p = 0;

$tot_no_a = $tot_no_a+ $row["no_adults"];
$tot_no_c = $tot_no_c+ $row["no_child"];
$tot_no_i = $tot_no_i+ $row["no_infant"];

$no_of_paxs = $row["no_adults"] + $row["no_child"] + $row["no_infant"] + $no_of_paxs;

}
?>

<tr><td colspan="1" align="center"><font size="2" face="Arial, Helvetica, sans-serif"> Visas </font> </td><td align="right"><font size="2" face="Arial, Helvetica, sans-serif"><? echo round($no_of_paxs,2) ; ?> </font></td><td align="right"><font size="2" face="Arial, Helvetica, sans-serif"><? echo round($tot_net,2) ; ?> </font></td><td align="right"><font size="2" face="Arial, Helvetica, sans-serif"><? echo round($tot_sell,2) ; ?></font></td><td align="right"><font size="2" face="Arial, Helvetica, sans-serif"><? echo round(($tot_sell-$tot_net),2); ?></font></td><td align="right"><font size="2" face="Arial, Helvetica, sans-serif"><? if(!$tot_net) { echo 0; } else { echo round(((($tot_sell-$tot_net)/$tot_net)*100), 2); } ?></font></td></tr></tr>

<?
$tot_net_p_g = $tot_net_p_g + $tot_net;
$tot_sell_p_g = $tot_sell_p_g + $tot_sell;
$grand_total_no_of_paxs = $grand_total_no_of_paxs + $no_of_paxs;
?>


<tr><td colspan="1" align="center"><font size="2" face="Arial, Helvetica, sans-serif"> Total </font> </td><td align="right"><font size="2" face="Arial, Helvetica, sans-serif"><? echo round($grand_total_no_of_paxs,2) ; ?> </font></td><td align="right"><font size="2" face="Arial, Helvetica, sans-serif"><? echo round($tot_net_p_g,2) ; ?> </font></td><td align="right"><font size="2" face="Arial, Helvetica, sans-serif"><? echo round($tot_sell_p_g,2) ; ?></font></td><td align="right"><font size="2" face="Arial, Helvetica, sans-serif"><? echo round(($tot_sell_p_g-$tot_net_p_g),2); ?></font></td><td align="right"><font size="2" face="Arial, Helvetica, sans-serif"><? if(!$tot_net_p_g) { echo 0; } else { echo round(((($tot_sell_p_g-$tot_net_p_g)/$tot_net_p_g)*100), 2); } ?></font></td></tr></tr>

  </table>
