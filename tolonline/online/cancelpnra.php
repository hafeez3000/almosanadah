<?
   
include ("header.php");
?>

<script>
document.title= '<? echo $company_name . " ERP - Cancelling PNR"; ?>';
</script>

<html>
<link rel="stylesheet" type="text/css" href="../calendar/css.css" />
<center>
<body leftmargin="0" topmargin="0" rightmargin="0">
<br><br><br>  
<? 


include ("gprocessing.html"); 

$s_pnr = $_POST["h_pnr"];

$s_cannote = $_POST["cannote"];



$sqlhotopu = "update sales_hotels set booking_status='Cancelled' where ocode='$s_pnr' "; 
pg_query($sqlhotopu);


$sqltransopu = "update sales_trans set booking_status='Cancelled' where ocode='$s_pnr' "; 
pg_query($sqltransopu);


$sqlvisaopu = "update sales_visa set booking_status='Cancelled' where ocode='$s_pnr' "; 
pg_query($sqlvisaopu);

$sqlextraopu = "update sales_extra set booking_status='Cancelled' where ocode='$s_pnr' "; 
pg_query($sqlextraopu);


$sqlmainopu = "update sales_main set booking_status='Cancelled',cancel_date='now',cancel_note='$s_cannote'  where ocode='$s_pnr'"; 
pg_query($sqlmainopu);


pg_query("delete from vocmast where pnr='$s_pnr'");


 echo "<script>document.location.href=\"pnrdet.php?spnr=$s_pnr\"</script>"; 

?>