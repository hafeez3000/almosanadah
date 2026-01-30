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
  $s_hot_id = $_GET["hotid"];
  $s_rm_no = $_GET["rm_no"];
  $s_guest_scb =  $_GET["guest_scb"];

$s_g_s = "f";
if($s_guest_scb=="true"){
$s_g_s="t";
}

$uphot = "update sales_hotels set room_inhouseno='$s_rm_no', guest_occ_status='$s_g_s' where ocode='$s_pnr' and sales_hotels_sno=$s_hot_id";
 pg_query($uphot);




echo "<script>document.location.href=\"processhotsel.php?hotid=$s_hot_id&spnr=$s_pnr\"</script>"; 

?>