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


$sqlinstrans = "insert into sales_trans(sales_trans_sno,ocode,user_sno,user_id,req_date_time,f2t,type_of_trans,no_of_units,no_of_paxs,flight_det,net_rate,sell_rate,tot_net_rate,tot_sell_rate,booking_status,trans_id,trans_id_s)  values($trans_seq,'NC',$suser_sno,'$suserid','$trans0rd','$tvetr0','$tvety0','$s_noofu0','$tvetp0','$s_flightdet0',$netprice1,$sellprice1,$trans1nrate,$trans1rate,'NC','$s_typeoftrans0','$s_s_trans0')"; 
pg_query($sqlinstrans);



$sequpdatetrans = "update seq set sales_trans=sales_trans+1";
pg_query($sequpdatetrans);




pg_free_result($result_trans_seq);




echo "<script>document.location.href=\"bookingchart.php\"</script>";
?>
</body>	
</center>
</html>
