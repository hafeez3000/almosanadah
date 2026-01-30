<?
set_time_limit(9000);        
include ("header.php");
?>

<script>
document.title= '<? echo $company_name . " ERP - Extras/Others Processing..."; ?>';
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
  $s_trans_enj = $_GET["rm_no"];

  $s_oc_bull = "f";

  if($s_trans_enj=="true"){$s_oc_bull="t";}

 $s_oc_bull;

$uphot = "update sales_extra set made_bull='$s_oc_bull',booking_status='Confirmed' where ocode='$s_pnr' and sales_extra_sno= $g_extraid ";
 pg_query($conn, $uphot);



  if($s_trans_enj=="true")
  {

	  $n_ifc = 0 ;

$query_hotels_sno ="select sales_hotels_sno from sales_hotels where (booking_status='On Request' and ocode='$s_pnr') or (booking_status='Cancelled' and ocode='$s_pnr') ";
$result_hotels_sno = pg_query($conn, $query_hotels_sno);
$n_ifc = $n_ifc + pg_num_rows($result_hotels_sno);


$query_trans_sno ="select sales_trans_sno from sales_trans where (booking_status='On Request' and ocode='$s_pnr') or (booking_status='Cancelled' and ocode='$s_pnr')";

$result_trans_sno = pg_query($conn, $query_trans_sno);

$n_ifc = $n_ifc + pg_num_rows($result_trans_sno);


$query_visa_sno ="select sales_visa_sno from sales_visa  where (booking_status='On Request' and ocode='$s_pnr') or (booking_status='Cancelled' and ocode='$s_pnr')";

$result_visa_sno = pg_query($conn, $query_visa_sno);

$n_ifc = $n_ifc + pg_num_rows($result_visa_sno);


$query_extra_sno ="select sales_extra_sno from sales_extra where (booking_status='On Request' and ocode='$s_pnr') or (booking_status='Cancelled' and ocode='$s_pnr')";

$result_extra_sno = pg_query($conn, $query_extra_sno);

$n_ifc = $n_ifc + pg_num_rows($result_extra_sno);


if($n_ifc>0){}
else{
$upmain = "update sales_main set booking_status='Confirmed' where ocode='$s_pnr' ";
pg_query($conn, $upmain);
}

  }
  
  else{

$uphot = "update sales_extra set made_bull='$s_oc_bull',booking_status='On Request' where ocode='$s_pnr' and sales_extra_sno= $g_extraid ";
 pg_query($conn, $uphot);

$upmain = "update sales_main set booking_status='On Request' where ocode='$s_pnr' ";
pg_query($conn, $upmain);
  
  }





echo "<script>document.location.href=\"processextrasel.php?extraid=$g_extraid&spnr=$s_pnr\"</script>"; 

?>