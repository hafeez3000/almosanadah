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
$s_hot_id = $_GET["hotelid"];
$s_suppid = $_GET["suppid"];


$query_supp_t ="select supp_id,account_code,supp_name,city from suppliers where supp_id='$s_suppid'";

$result_supp_t = pg_query($conn, $query_supp_t);

if (!$result_supp_t) {
	echo "An error occured.\n";
	exit;
	}
while ($rows_supp_t = pg_fetch_array($result_supp_t)){

$supp_supp_id = $rows_supp_t["supp_id"];
$supp_account_code = $rows_supp_t["account_code"];
$supp_name = $rows_supp_t["supp_name"];
$city = $rows_supp_t["city"];

}

pg_free_result($result_supp_t);


$uphot = "update sales_hotels set supp_account_code='$supp_account_code',supp_id='$supp_supp_id' where ocode='$s_pnr' and sales_hotels_sno=$s_hot_id";
 pg_query($conn, $uphot);

// accounts conn start





$sqlinsacc3 = "update vocmast set recon='f' where pnr='$s_pnr' and sinvno=$s_hot_id and vocsno=1 and voctype='PV'";
pg_query($conn, $sqlinsacc3);



$sqlinsacc4 = "update vocmast set acccode='$supp_account_code',recon='f' where pnr='$s_pnr' and sinvno=$s_hot_id and vocsno=2 and voctype='PV'";
pg_query($conn, $sqlinsacc4);


/*add a record to pnrhistory table*/
$restransamenda = "INSERT INTO pnrhistory(user_sno, ocode, description, created_at) VALUES ('$suser_sno', '$s_pnr', 'Hotel Supplier changed to $supp_name, $city', 'now()')";
pg_query($conn, $restransamenda);
/*END - add a record to pnrhistory table*/

// accounts conn end

echo "<script>document.location.href=\"pnrdet.php?spnr=$s_pnr\"</script>";

?>