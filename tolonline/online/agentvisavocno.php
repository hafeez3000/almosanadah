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
 $g_visaid = $_GET["visaid"];
 $s_ag_vno = $_GET["ag_vno"];

$uphot = "update sales_visa set cus_voucher='$s_ag_vno' where ocode='$s_pnr' and sales_visa_sno=$g_visaid";
 pg_query($uphot);

 echo "<script>document.location.href=\"processvisasel.php?visaid=$g_visaid&spnr=$s_pnr\"</script>"; 

?>