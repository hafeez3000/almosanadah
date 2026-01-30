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

$s_pnr = $_SESSION["a_pnr"];

 $reqd = $_POST['dDay'];
 $reqm = $_POST['dMonth'];
 $reqy = $_POST['dYear'];

 $s_trans = $_POST['s_trans']; 
 
 $reqhh = $_POST['timeselecthours'];
 $reqmm = $_POST['timeselectmin'];
 $fromto2 = $_POST['fromto2'];

$typeoftrans = $_POST['typeoftrans'];
 $flightdet = $_POST['flightdet'];
$netprice = $_POST['netprice'];

$sellprice = $_POST['sellprice'];

$nopaxs = $_POST['nopaxs'];

$no_units = $_POST['noofu'];

$t_sno = $_POST['tsno'];

$tot_net_price = $netprice * $no_units;
$tot_sell_price = $sellprice * $no_units;

$reqdate = date('Y-m-d h:i:00', mktime($reqhh,$reqmm,0,$reqm,$reqd,$reqy));



$sqlinstrans = "update sales_trans set req_date_time='$reqdate',f2t='$fromto2',type_of_trans='$typeoftrans',no_of_units=$no_units,no_of_paxs=$nopaxs,flight_det='$flightdet',net_rate=$netprice,sell_rate=$sellprice,tot_net_rate=$tot_net_price,tot_sell_rate=$tot_sell_price,booking_status='On Request', order_date='now',supp_account_code='$s_trans' where ocode='$s_pnr' and sales_trans_sno=$t_sno"; 

pg_query($sqlinstrans);






echo "<script>document.location.href=\"pnrdet.php?spnr=$s_pnr\" </script>";

?>
</body>	
</center>
</html>
