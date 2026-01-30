<?
       
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




  $s_pnr = $_GET["spnr"];
  $s_hot_id = $_GET["hotid"];
  $s_pd_amt = $_GET["pd_amt"];
  
  $s_pd_details = $_GET["pd_details"];
   
$s_final_t = "Agent Paid for the booking Amount $s_pd_amt and $s_pd_details";

//for loop restriction 

$loop_hotel = "select cus_paid from sales_hotels  where ocode='$s_pnr' and sales_hotels_sno=$s_hot_id and cus_paid='$s_pd_amt' ";
$res_loop_hotel = pg_query($conn, $loop_hotel);
$looprc = pg_num_rows($res_loop_hotel);

if($looprc){} else{

$uphot = "update sales_hotels set cus_paid='$s_pd_amt' where ocode='$s_pnr' and sales_hotels_sno=$s_hot_id";
 pg_query($conn, $uphot);

/*add a record to pnrhistory table*/
$suser_sno = $_SESSION['user_sno'];
$agentbpaid = "INSERT INTO pnrhistory(user_sno, ocode, description, created_at) VALUES ('$suser_sno', '$s_pnr', '$s_final_t', 'now()')";
pg_query($conn, $agentbpaid);
/*END - add a record to pnrhistory table*/
}
 echo "<script>document.location.href=\"processhotsel.php?hotid=$s_hot_id&spnr=$s_pnr\"</script>"; 

?>
