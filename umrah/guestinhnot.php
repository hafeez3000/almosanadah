<?
set_time_limit(9000);        
include ("header.php");
?>

<script>
document.title= '<? echo $company_name . " ERP - Umrah New Booking - Transport processing"; ?>';
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
   $s_guest_rno = $_GET["guest_rno"];
   
   
   $loop_hotel = "select room_inhouseno from sales_trans  where ocode='$s_pnr' and sales_trans_sno=$s_hot_id and room_inhouseno='$s_guest_rno' ";
$res_loop_hotel = pg_query($conn, $loop_hotel);
$looprc = pg_num_rows($res_loop_hotel);

if($looprc){} else{
   

$uphot = "update sales_trans set room_inhouseno='$s_guest_rno' where ocode='$s_pnr' and sales_trans_sno=$s_hot_id";
 pg_query($conn, $uphot);

/*add a record to pnrhistory table*/
$restransamenda = "INSERT INTO pnrhistory(user_sno, ocode, description, created_at) VALUES ('$suser_sno', '$s_pnr', 'Transportation Guest room number entered # ".$s_guest_rno."', 'now()')";
pg_query($conn, $restransamenda);
/*END - add a record to pnrhistory table*/
}
 echo "<script>document.location.href=\"processtranssel.php?transid=$s_hot_id&spnr=$s_pnr\"</script>"; 

?>
