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

$loop_hotel = "select room_inhouseno from sales_hotels  where ocode='$s_pnr' and sales_hotels_sno=$s_hot_id and room_inhouseno='$s_rm_no' ";
$res_loop_hotel = pg_query($conn, $loop_hotel);
$looprc = pg_num_rows($res_loop_hotel);

if($looprc){} else{


$uphot = "update sales_hotels set room_inhouseno='$s_rm_no', guest_occ_status='$s_g_s' where ocode='$s_pnr' and sales_hotels_sno=$s_hot_id";
 pg_query($conn, $uphot);

/*add a record to pnrhistory table*/
$suser_sno = $_SESSION['user_sno'];
if($s_guest_scb=='true'){
	$guestinhno = "INSERT INTO pnrhistory(user_sno, ocode, description, created_at) VALUES ('$suser_sno', '$s_pnr', 'Guest Arrived and In-House with the room no# ".$s_rm_no."', 'now()')";
} else {
	$guestinhno = "INSERT INTO pnrhistory(user_sno, ocode, description, created_at) VALUES ('$suser_sno', '$s_pnr', 'Guest Not Arrived and No-Show', 'now()')";
}
pg_query($conn, $guestinhno);
/*END - add a record to pnrhistory table*/
}
echo "<script>document.location.href=\"processhotsel.php?hotid=$s_hot_id&spnr=$s_pnr\"</script>"; 

?>