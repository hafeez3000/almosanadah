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
  $s_hotid = $_GET["hotid"];
 $supp_supp_id="";


$query_trans_t ="select account_code, hotel_name, city from hotels where hotel_id='$s_hotid'";

$result_trans_t = pg_query($conn, $query_trans_t);

if (!$result_trans_t) {
	echo "An error occured.\n";
	exit;
	}
while ($rows_trans_t = pg_fetch_array($result_trans_t)){
$hotel_name_dis = $rows_trans_t["hotel_name"];
$hotel_city = $rows_trans_t["city"];
$supp_account_code = $rows_trans_t["account_code"];


}

pg_free_result($result_trans_t);


$uphot = "update sales_hotels set supp_account_code='$supp_account_code',supp_id='$supp_supp_id' where ocode='$s_pnr' and sales_hotels_sno=$s_hot_id";
 pg_query($conn, $uphot);


// accounts conn start



$sqlinsacc3 = "update vocmast set recon='f' where pnr='$s_pnr' and sinvno=$s_hot_id and vocsno=1 and voctype='PV'";
pg_query($conn, $sqlinsacc3);



$sqlinsacc4 = "update vocmast set acccode='$supp_account_code',recon='f' where pnr='$s_pnr' and sinvno=$s_hot_id and vocsno=2 and voctype='PV'";
pg_query($conn, $sqlinsacc4);


/*add a record to pnrhistory table*/
$restransamenda = "INSERT INTO pnrhistory(user_sno, ocode, description, created_at) VALUES ('$suser_sno', '$s_pnr', 'Hotel Supplier changed to $hotel_name_dis, $hotel_city', 'now()')";
pg_query($conn, $restransamenda);
/*END - add a record to pnrhistory table*/

// accounts conn end



echo "<script>document.location.href=\"pnrdet.php?spnr=$s_pnr\"</script>"; 

?>