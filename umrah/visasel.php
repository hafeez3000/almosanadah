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

 $reqd = $_POST['d1Day'];
 $reqm = $_POST['d1Month'];
 $reqy = $_POST['d1Year'];

$n_adult = $_POST['noofa'];

$n_child = $_POST['noofc'];

$n_infant = $_POST['noofi'];

$s_adult_net_rate = $_POST['anetprice'];

$s_adult_sell_rate = $_POST['asellprice'];

$tot_adult_net_rate = $s_adult_net_rate * $n_adult;
$tot_adult_sell_rate = $s_adult_sell_rate * $n_adult;


$s_child_net_rate = $_POST['cnetprice'];

$s_child_sell_rate = $_POST['csellprice'];

$tot_child_net_rate = $s_child_net_rate * $n_child;
$tot_child_sell_rate = $s_child_sell_rate * $n_child;


$s_infant_net_rate = $_POST['inetprice'];
$s_infant_sell_rate = $_POST['isellprice'];

$tot_infant_net_rate = $s_infant_net_rate * $n_infant;
$tot_infant_sell_rate = $s_infant_sell_rate * $n_infant;


$reqdate = date('Y-m-d', mktime(0,0,0,$reqm,$reqd,$reqy));


$query_visa_seq ="select sales_visa from seq";

$result_visa_seq = pg_query($conn, $query_visa_seq);

if (!$result_visa_seq) {
echo "An error occured.\n";
exit;
		}
while ($rows_visa_seq = pg_fetch_array($result_visa_seq)){
$visa_seq = $rows_visa_seq["sales_visa"];
}

$sqlinsvisa = "insert into sales_visa(	sales_visa_sno,	ocode,	user_sno,	user_id, req_date_time,	no_adults, no_child,no_infant,net_adults,sell_adults,net_child,sell_child,net_infant,	 sell_infant,tot_net_adults,	tot_sell_adults,tot_net_child,	tot_sell_child,tot_net_infant,	tot_sell_infant,order_date )  values($visa_seq,'NC',$suser_sno,'$suserid','$reqdate', $n_adult, $n_child, $n_infant, $s_adult_net_rate, $s_adult_sell_rate, $s_child_net_rate, $s_child_sell_rate, $s_infant_net_rate, $s_infant_sell_rate, $tot_adult_net_rate, $tot_adult_sell_rate, $tot_child_net_rate, $tot_child_sell_rate, $tot_infant_net_rate, $tot_infant_sell_rate, 'now' )"; 
pg_query($conn, $sqlinsvisa);



$sequpdatevisa = "update seq set sales_visa=sales_visa+1";
pg_query($conn, $sequpdatevisa);




pg_free_result($result_visa_seq);




echo "<script>document.location.href=\"bookingchart.php\"</script>";
?>
</body>	
</center>
</html>
