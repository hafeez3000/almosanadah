<?
set_time_limit(9000);        
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
<? 


include ("gprocessing.html"); 

  $s_pnr = $_GET["spnr"];
   $s_hot_id = $_GET["transid"];
   $s_pd_amt = $_GET["pd_amt"];

$uphot = "update sales_trans set cus_paid='$s_pd_amt' where ocode='$s_pnr' and sales_trans_sno=$s_hot_id";
 pg_query($uphot);



 echo "<script>document.location.href=\"processtranssel.php?transid=$s_hot_id&spnr=$s_pnr\"</script>"; 

?>