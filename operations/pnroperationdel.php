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

$s_operation_id =  $_GET['operation_id'];





if(strlen(trim($s_operation_id))>0){  // start of if operation 

$operationsquery1 = "select sno,station_name from umrah_gm where sno=$s_operation_id and ocode='$s_pnr'";
$operationsresult1 = pg_query($operationsquery1);

$operationsresult1_c = pg_num_rows($operationsresult1);
if($operationsresult1_c){
//Fetching details from sales_trans
$operationsquery = "select sno,group_id,station_name from umrah_gm where sno=$s_operation_id and ocode='$s_pnr'";
$operationsresult = pg_query($operationsquery);
if (!$operationsresult) {
  echo "An error occured.\n";
  exit;
}
while ($row = pg_fetch_row($operationsresult)) {
  $group_id = $row[1];  
  $station_name = $row[2];
}
	
/*add a record to pnrhistory table*/
$operationsdelete = "INSERT INTO pnrhistory(user_sno, ocode, description, created_at) VALUES ('$suser_sno', '$s_pnr', 'Booking has been deleted with operation: Station Name :".$station_name." with Group id : ".$group_id."', 'now()')";
pg_query($operationsdelete);
/*END - add a record to pnrhistory table*/
}

$sqldelo = "delete from umrah_gm where sno=$s_operation_id and ocode='$s_pnr'";
pg_query($sqldelo);


$query_operations_sno ="select sno from umrah_gm where ocode='$s_pnr'";
$result_operations_sno = pg_query($query_operations_sno);
if(pg_num_rows($result_operations_sno)>0){ }
else{
pg_query("update sales_main set operations='f' where ocode='$s_pnr'");
}


}





echo "<script>document.location.href=\"pnrdet.php?spnr=$s_pnr\"</script>";  

 ?>
</body>	
</center>
</html>
