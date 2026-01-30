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
pg_query($conn, $sqlhotopu);


$sqltransopu = "update sales_trans set option_date='$optiondate' where ocode='$s_pnr' "; 
pg_query($conn, $sqltransopu);


$sqlvisaopu = "update sales_visa set option_date='$optiondate' where ocode='$s_pnr' "; 
pg_query($conn, $sqlvisaopu);

$sqlextraopu = "update sales_extra set option_date='$optiondate' where ocode='$s_pnr' "; 
pg_query($conn, $sqlextraopu);

//Fetching details from sales_extra
$changeopdatequery = "select option_date from sales_main where ocode='$s_pnr'";
$changeopdateresult = pg_query($conn, $changeopdatequery);
if (!$changeopdateresult) {
  echo "An error occured.\n";
  exit;
}
while ($row = pg_fetch_row($changeopdateresult)) {
  $preopdate = $row[0];  
}

/*add a record to pnrhistory table*/
$presentdate = date("Y-m-d H:i:00");
$changeopdate = "INSERT INTO pnrhistory(user_sno, ocode, description, created_at) VALUES ('$suser_sno', '$s_pnr', 'Option date has been changed from ".$preopdate." to ".$presentdate."', 'now()')";
pg_query($conn, $changeopdate);
/*END - add a record to pnrhistory table*/

$sqlmainopu = "update sales_main set order_date='now',option_date='$optiondate' where  ocode='$s_pnr'"; 
pg_query($conn, $sqlmainopu);

echo "<script>document.location.href=\"pnrdet.php?spnr=$s_pnr\"</script>"; 

?>