<script type=text/javascript>
setTimeout('document.location=document.location',240000);
</script>
<script>



</script>
  <?php
include("../db/db.php");

$s_gs = "on_request";

$s_gs = $_GET["gs"];

$not_arr = " and booking_status!='Cancelled' ";

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


$cin = 0;
$cout = 0;


$sfdate = $_GET["f_d"];
$stdate = $_GET["t_d"];

$date_bulls = "order_date";

$datei = 1;


if($_GET["cinb"]){
$date_bulls = "req_date_time";
$datei = 0;
}


$tot_no_a = 0;
$tot_no_c = 0;
$tot_no_i = 0;



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



//$hotelid="all";







?>
<table border="1" cellpadding="2" cellspacing="0" width="100%">
  <tr> 
      <td><div align="center"><font size="2" face="Arial, Helvetica, sans-serif">Sno</font></div></td>
      <td><div align="center"><font size="2" face="Arial, Helvetica, sans-serif">PNR</font></div></td>
      <td><div align="center"><font size="2" face="Arial, Helvetica, sans-serif">Guest 
          Name</font></div></td>
		  
		   <td><div align="center"><font size="2" face="Arial, Helvetica, sans-serif">Travel 
          Agent,Country</font></div></td>

      <td><div align="center"><font size="2" face="Arial, Helvetica, sans-serif">Request Date</font></div></td>
      <td><div align="center"><font size="2" face="Arial, Helvetica, sans-serif">Status</font></div></td>

      <td><div align="center"><font size="2" face="Arial, Helvetica, sans-serif">Adults</font></div></td>
	        <td><div align="center"><font size="2" face="Arial, Helvetica, sans-serif">Childs</font></div></td>
				        <td><div align="center"><font size="2" face="Arial, Helvetica, sans-serif">Infants</font></div></td>
			
      <td><div align="center"><font size="2" face="Arial, Helvetica, sans-serif">Adults<br>Net Rate</font></div></td>
	        <td><div align="center"><font size="2" face="Arial, Helvetica, sans-serif">Child<br>Net Rate</font></div></td>

     
	       <td><div align="center"><font size="2" face="Arial, Helvetica, sans-serif">Adults<br>Sell Rate</font></div></td>
	        <td><div align="center"><font size="2" face="Arial, Helvetica, sans-serif">Child<br>Sell Rate</font></div></td>


      <td><div align="center"><font size="2" face="Arial, Helvetica, sans-serif">Total<br>NetRate</font></div></td>
	  <td><div align="center"><font size="2" face="Arial, Helvetica, sans-serif">Total<br>SellRate</font></div></td>
 	  <td><div align="center"><font size="2" face="Arial, Helvetica, sans-serif">Profit</font></div></td>
          <td align="right"><div align="center"><font size="2" face="Arial, Helvetica, sans-serif">% Margin</font></div></td>




    <tr> 

<?



//$query  = "SELECT  ocode,f2t,type_of_trans,no_of_units,req_date_time,no_of_paxs,flight_det,net_rate,sell_rate,tot_net_rate,tot_sell_rate,booking_status,occp,order_date,option_date,cus_voucher,cus_account_code,supp_account_code,supp_invoice,cus_paid,amend_bull,trans_id,kind_of_trans,trans_model,supp_rep,trans_id_s from sales_trans where $date_bulls between date '$fromd' and  date '$tod' + integer '$datei'  $not_arr  order by req_date_time";




$query = "select ocode,req_date_time,no_adults,no_child,no_infant,net_adults,net_child,net_infant,sell_adults,sell_child,sell_infant,tot_net_adults,tot_net_child,tot_net_infant,tot_sell_adults,tot_sell_child,tot_sell_infant,booking_status,mofa,order_date,option_date,cus_voucher,cus_account_code,supp_account_code,supp_invoice,cus_paid,amend_bull,mofa_bull from sales_visa where $date_bulls between date '$fromd' and  date '$tod' + integer '$datei' $not_arr $q_hotel order by req_date_time";
  


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




?>
    <tr>
	
	<td align="center"><font size="2" face="Arial, Helvetica, sans-serif"><? echo $b_sno ?></font></td>
	<td ><font size="2" face="Arial, Helvetica, sans-serif"><a href="pnrdet.php?spnr=<?echo $row["ocode"];?>" target='<?echo $row["ocode"];?>' onClick="window.open('','<?echo $row["ocode"];?>', ' width='+(screen.width-10)+' , height='+(screen.height-50)+' , left=0,top=0 ').focus()"  ><?echo $row["ocode"];?></a></font></td>

<td><font size="2" face="Arial, Helvetica, sans-serif"><? echo 	$s_guest_title . ". " . strtoupper($s_guest_name); ?></font></td>

<td><font size="2" face="Arial, Helvetica, sans-serif"><? echo 	strtoupper($s_cus_company_name) . ", " . strtoupper($s_cus_country); ?></font></td>

<td align="center"><font size="2" face="Arial, Helvetica, sans-serif"><?echo date('d M, Y H:i', strtotime($row['req_date_time']));  ?></font></td>

<td align="center"><font size="2" face="Arial, Helvetica, sans-serif"><?echo $row["booking_status"]; ?></font></td>
<td align="center"><font size="2" face="Arial, Helvetica, sans-serif"><?echo $row["no_adults"]; ?></font></td>

<td align="center"><font size="2" face="Arial, Helvetica, sans-serif"><?echo $row["no_child"]; ?> </font></td>
<td align="center"><font size="2" face="Arial, Helvetica, sans-serif"><?echo $row["no_infant"]; ?> </font></td>

<td align="center"><font size="2" face="Arial, Helvetica, sans-serif"><?echo $row["net_adults"]; ?></font></td>
<td align="center"><font size="2" face="Arial, Helvetica, sans-serif"><?echo $row["net_child"]; ?> </font></td>


<td align="center"><font size="2" face="Arial, Helvetica, sans-serif"><?echo $row["sell_adults"]; ?></font></td>

<td align="center"><font size="2" face="Arial, Helvetica, sans-serif"><?echo $row["sell_child"]; ?> </font></td>



<td align="right"><font size="2" face="Arial, Helvetica, sans-serif"><? if($row["net_adults"]=="" || $row["net_child"]=="") { echo "&nbsp;" ; $tot_net_p=0;} else { echo round(($row["no_adults"]*$row["net_adults"])+($row["no_child"]*$row["net_child"]), 2); $tot_net_p=($row["no_adults"]*$row["net_adults"])+($row["no_child"]*$row["net_child"]); } ?> </font></td>
<td align="right"><font size="2" face="Arial, Helvetica, sans-serif"><? if($row["sell_adults"]=="" || $row["sell_child"]=="") { echo "&nbsp;" ; $tot_sell_p=0;} else { echo round(($row["no_adults"]*$row["sell_adults"])+($row["no_child"]*$row["sell_child"]), 2); $tot_sell_p=($row["no_adults"]*$row["sell_adults"])+($row["no_child"]*$row["sell_child"]); }   ?> </font></td>
<td align="right"><font size="2" face="Arial, Helvetica, sans-serif"><?   echo round(($tot_sell_p-$tot_net_p), 2);    ?> </font></td>
<td align="right"><font size="2" face="Arial, Helvetica, sans-serif"><?   if(!$tot_net_p) { echo 0; } else { echo round(((($tot_sell_p-$tot_net_p)/$tot_net_p)*100), 2); }    ?> </font></td>

    <?


$b_sno++;

$tot_net = $tot_net + $tot_net_p;
$tot_sell = $tot_sell + $tot_sell_p;

$tot_net_p = 0;
$tot_sell_p = 0;

$tot_no_a = $tot_no_a+ $row["no_adults"];
$tot_no_c = $tot_no_c+ $row["no_child"];
$tot_no_i = $tot_no_i+ $row["no_infant"];


}





?>
    </tr>

<tr><td colspan="6" align="center"> Totals </td><td align="center"><? echo $tot_no_a ; ?> </td><td align="center"><? echo $tot_no_c ; ?>  </td><td align="center"><font size="2" face="Arial, Helvetica, sans-serif"><? echo $tot_no_i ; ?> </font> </td><td align="center" colspan="4"><? echo "&nbsp;" ; ?> </td><td align="right"><font size="2" face="Arial, Helvetica, sans-serif"><? echo round($tot_net,2) ; ?> </font></td><td align="right"><? echo round($tot_sell,2) ; ?></td><td align="right"><? echo round(($tot_sell-$tot_net),2); ?></td><td align="right"><font size="2" face="Arial, Helvetica, sans-serif"><? if(!$tot_net) { echo 0; } else { echo round(((($tot_sell-$tot_net)/$tot_net)*100), 2); } ?></font></td></tr></tr>

  </table>




