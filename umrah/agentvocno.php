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
  $s_ag_vno = $_GET["ag_vno"];


//for loop restriction 

$loop_hotel = "select cus_voucher from sales_hotels  where ocode='$s_pnr' and sales_hotels_sno=$s_hot_id and cus_voucher='$s_ag_vno' ";
$res_loop_hotel = pg_query($conn, $loop_hotel);
$looprc = pg_num_rows($res_loop_hotel);


if($looprc){} else{
 $uphot = "update sales_hotels set cus_voucher='$s_ag_vno' where ocode='$s_pnr' and sales_hotels_sno=$s_hot_id";
 pg_query($conn, $uphot);

$uphotv = "update vocmast set supp_inv='$s_ag_vno' where pnr='$s_pnr' and sinvno=$s_hot_id and voctype='CS'";
 pg_query($conn, $uphotv);
 
/*add a record to pnrhistory table*/
$suser_sno = $_SESSION['user_sno'];
$agentvocno = "INSERT INTO pnrhistory(user_sno, ocode, description, created_at) VALUES ('$suser_sno', '$s_pnr', 'Agent Voucher has been received with the number# ".$s_ag_vno."', 'now()')";
pg_query($conn, $agentvocno);
/*END - add a record to pnrhistory table*/
}
 echo "<script>document.location.href=\"processhotsel.php?hotid=$s_hot_id&spnr=$s_pnr\"</script>"; 

?>