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
 $g_extraid = $_GET["extraid"];
   $s_pd_amt = $_GET["pd_amt"];

$uphot = "update sales_extra set cus_paid='$s_pd_amt' where ocode='$s_pnr' and sales_extra_sno=$g_extraid";
 pg_query($conn, $uphot);



 echo "<script>document.location.href=\"processextrasel.php?extraid=$g_extraid&spnr=$s_pnr\"</script>"; 

?>