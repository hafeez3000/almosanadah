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

 $other2noofa=$_SESSION['other2noofa'];
$other2nrate=$_POST['other2net'];
$other2srate=$_POST['other2sell'];


$others2d = $_SESSION['d11Day'];
$others2m = $_SESSION['d11Month'];
$others2y = $_SESSION['d11Year'];

$others2rd = $others2y ."-". $others2m ."-". $others2d ; 




$query_extra_seq ="select sales_extra from seq";

$result_extra_seq = pg_query($conn, $query_extra_seq);

if (!$result_extra_seq) {
echo "An error occured.\n";
exit;
		}
while ($rows_extra_seq = pg_fetch_array($result_extra_seq)){
$extra_seq = $rows_extra_seq["sales_extra"];
}


$sqlinsextra = "insert into sales_extra( sales_extra_sno,ocode,user_sno,user_id,req_date_time,paticulars,net_rate,sell_rate,booking_status)  values($extra_seq,'NC',$suser_sno,'$suserid','$others2rd','$other2noofa',$other2nrate,$other2srate,'NC')"; 
pg_query($conn, $sqlinsextra);




$sequpdateextra = "update seq set sales_extra=sales_extra+1";
pg_query($conn, $sequpdateextra);




pg_free_result($result_extra_seq);




echo "<script>document.location.href=\"bookingchart.php\"</script>";
?>
</body>	
</center>
</html>
