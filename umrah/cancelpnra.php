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
pg_query($conn, $sqlhotopu);


$sqltransopu = "update sales_trans set booking_status='Cancelled' where ocode='$s_pnr' "; 
pg_query($conn, $sqltransopu);


$sqlvisaopu = "update sales_visa set booking_status='Cancelled' where ocode='$s_pnr' "; 
pg_query($conn, $sqlvisaopu);

$sqlextraopu = "update sales_extra set booking_status='Cancelled' where ocode='$s_pnr' "; 
pg_query($conn, $sqlextraopu);


$sqlmainopu = "update sales_main set booking_status='Cancelled',cancel_date='now',cancel_note='$s_cannote'  where ocode='$s_pnr'"; 
pg_query($conn, $sqlmainopu);


pg_query($conn, "delete from vocmast where pnr='$s_pnr'");

/*add a record to pnrhistory table*/
$restransamenda = "INSERT INTO pnrhistory(user_sno, ocode, description, created_at) VALUES ('$suser_sno', '$s_pnr', 'Booking has been cancelled for the reason : $s_cannote', 'now()')";
pg_query($conn, $restransamenda);
/*END - add a record to pnrhistory table*/


 echo "<script>document.location.href=\"pnrdet.php?spnr=$s_pnr\"</script>"; 

?>