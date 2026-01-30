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


include ("gprocessing.html"); 

$s_pnr = $_POST["h_pnr"];


 $madcind = $_POST['dDay'];
 $madcinm = $_POST['dMonth'];
 $madciny = $_POST['dYear'];

$madcin = $madciny ."-". $madcinm ."-". $madcind ; 

$mad_hours = $_POST["op_hours"];
$mad_min = $_POST["op_min"];

$optiondate = date('Y-m-d H:i:00', mktime($mad_hours,$mad_min,0,$madcinm,$madcind,$madciny));





$sqlhotopu = "update sales_hotels set option_date='$optiondate' where ocode='$s_pnr' "; 
pg_query($sqlhotopu);


$sqltransopu = "update sales_trans set option_date='$optiondate' where ocode='$s_pnr' "; 
pg_query($sqltransopu);


$sqlvisaopu = "update sales_visa set option_date='$optiondate' where ocode='$s_pnr' "; 
pg_query($sqlvisaopu);

$sqlextraopu = "update sales_extra set option_date='$optiondate' where ocode='$s_pnr' "; 
pg_query($sqlextraopu);


$sqlmainopu = "update sales_main set order_date='now',option_date='$optiondate' where  ocode='$s_pnr'"; 
pg_query($sqlmainopu);


 echo "<script>document.location.href=\"pnrdet.php?spnr=$s_pnr\"</script>"; 

?>