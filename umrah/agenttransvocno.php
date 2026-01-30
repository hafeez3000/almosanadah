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
  $s_ag_vno = $_GET["ag_vno"];

$uphot = "update sales_trans set cus_voucher='$s_ag_vno' where ocode='$s_pnr' and sales_trans_sno=$s_hot_id";
 pg_query($conn, $uphot);
 
/*add a record to pnrhistory table*/
$restransamenda = "INSERT INTO pnrhistory(user_sno, ocode, description, created_at) VALUES ('$suser_sno', '$s_pnr', 'Agent Voucher has been received with the number# ".$s_ag_vno."', 'now()')";
pg_query($conn, $restransamenda);
/*END - add a record to pnrhistory table*/

 echo "<script>document.location.href=\"processtranssel.php?transid=$s_hot_id&spnr=$s_pnr\"</script>"; 

?>