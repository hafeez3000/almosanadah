<?
include ("header.php");
?>

<script>
document.title= '<? echo $company_name . " ERP - Reservation Booking"; ?>';
</script>

<html>
<link rel="stylesheet" type="text/css" href="../calendar/css.css" />
<center>
<body leftmargin="0" topmargin="0" rightmargin="0">
<br><br><br>  
<? include ("gprocessing.html"); 

//$suserid;
//$suser_sno;

$s_pnr = $_GET['spnr'];

$n_ifcdel = 0; 

echo "<br><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">Please Wait, Deleting PNR ". $s_pnr . "....</font></div>"; 


$query_main_sno ="select main_sno from sales_main where ocode='$s_pnr'";
$result_main_sno = pg_query($query_main_sno);

$n_ifcdel = pg_num_rows($result_main_sno);


if($n_ifcdel==1){
$sqldelm = "delete from sales_hotels where ocode='$s_pnr'";
pg_query($sqldelm);

$sqldelmm = "delete from sales_meals where ocode='$s_pnr'";
pg_query($sqldelmm);

$sqldelt = "delete from sales_trans where  ocode='$s_pnr'";
pg_query($sqldelt);
	
$sqldelv = "delete from sales_visa where ocode='$s_pnr'";
pg_query($sqldelv);

$sqldele = "delete from sales_extra where ocode='$s_pnr'";
pg_query($sqldele);

$sqldelvmain = "delete from sales_main where ocode='$s_pnr'";
pg_query($sqldelvmain);

}


//echo "<script>document.location.href=\"uhome.php\"</script>";  

 ?>
</body>	
</center>
</html>
