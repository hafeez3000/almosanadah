<?
set_time_limit(9000);        
include ("header.php");
?>

<script>
document.title= '<? echo $company_name . " ERP - Umrah New Booking - Transportation Processing..."; ?>';
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
   $s_trans_enj = $_GET["rm_no"];

  $s_oc_bull = "f";

  if($s_trans_enj=="true"){$s_oc_bull="t";}

 $s_oc_bull;

$uphot = "update sales_trans set occp_bull='$s_oc_bull' where ocode='$s_pnr' and sales_trans_sno= $s_hot_id ";
 pg_query($conn, $uphot);

/*add a record to pnrhistory table*/
if($s_trans_enj == 'true'){
	$msg = "Guest Arrived and enjoyed";
} else {
	$msg = "Guest Arrived and no show";
}
$restransamenda = "INSERT INTO pnrhistory(user_sno, ocode, description, created_at) VALUES ('$suser_sno', '$s_pnr', '$msg', 'now()')";
pg_query($conn, $restransamenda);
/*END - add a record to pnrhistory table*/

echo "<script>document.location.href=\"processtranssel.php?transid=$s_hot_id&spnr=$s_pnr\"</script>"; 

?>