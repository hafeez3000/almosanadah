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

$s_hot =  $_GET['hotid'];

$s_hot1 =  $_GET['hotid'];

$s_trans = $_GET['transid'];

$s_visa =  $_GET['visaid'];

$s_extra = $_GET['extraid'];

$n_ifc = 0; 


$query_hotels_sno ="select sales_hotels_sno from sales_hotels where ocode='$s_pnr'";

$result_hotels_sno = pg_query($query_hotels_sno);

$n_ifc = $n_ifc + pg_num_rows($result_hotels_sno);



$query_trans_sno ="select sales_trans_sno from sales_trans where ocode='$s_pnr'";

$result_trans_sno = pg_query($query_trans_sno);

$n_ifc = $n_ifc + pg_num_rows($result_trans_sno);


$query_visa_sno ="select sales_visa_sno from sales_visa  where ocode='$s_pnr'";
$result_visa_sno = pg_query($query_visa_sno);

$n_ifc = $n_ifc + pg_num_rows($result_visa_sno);


$query_extra_sno ="select sales_extra_sno from sales_extra where ocode='$s_pnr'";
$result_extra_sno = pg_query($query_extra_sno);

$n_ifc = $n_ifc + pg_num_rows($result_extra_sno);

$n_ifc ;

if($n_ifc>1){     // atleast one record start

if(strlen(trim($s_hot))>0){  // start of hotel if



//loop check
$hsquery1 = "select hotel_id, sell_rate from sales_hotels where sales_hotels_sno=$s_hot1 and ocode='$s_pnr'";
$hsresult1 = pg_query($hsquery1);

$hsresult1_c = pg_num_rows($hsresult1);
if($hsresult1_c){
//Fetching hotel_id, and sell_rate from sales_hotels
$hsquery = "select hotel_id, sell_rate from sales_hotels where sales_hotels_sno=$s_hot1 and ocode='$s_pnr'";
$hsresult = pg_query($hsquery);
if (!$hsresult) {
  echo "An error occured.\n";
  exit;
}
while ($row = pg_fetch_row($hsresult)) {
  $hotelid = $row[0];  
  $sellrate = $row[1];
}	
//Fetching hotel name from hotels
$hnquery = "SELECT hotel_name FROM hotels WHERE hotel_id=$hotelid";
$hnresult = pg_query($hnquery);
if (!$hnresult) {
  echo "An error occured.\n";
  exit;
}
while ($row = pg_fetch_row($hnresult)) {
  $hotelname = $row[0];  
}
	
/*add a record to pnrhistory table*/
$hoteldelete = "INSERT INTO pnrhistory(user_sno, ocode, description, created_at) VALUES ('$suser_sno', '$s_pnr', 'Booking has been deleted with new hotel name: ".$hotelname." with amount: ".$sellrate."', 'now()')";
pg_query($hoteldelete);
/*END - add a record to pnrhistory table*/
}

echo "<br><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">Please Wait, Deleting Hotel ....</font></div>"; 

$sqldelm = "delete from sales_hotels where sales_hotels_sno=$s_hot1 and ocode='$s_pnr'";
pg_query($sqldelm);



$query_hotels_sno ="select sales_hotels_sno from sales_hotels where ocode='$s_pnr'";
$result_hotels_sno = pg_query($query_hotels_sno);
if(pg_num_rows($result_hotels_sno)>0){ }
else{



pg_query("update sales_main set sales_hotels='f' where ocode='$s_pnr'");
}



// accounts conn start

$sqldelac1 = "delete from vocmast where pnr='$s_pnr' and sinvno=$s_hot1 and voctype='CS' and sinvtype='H' ";
pg_query($sqldelac1);
$sqldelac2 = "delete from vocmast where pnr='$s_pnr' and sinvno=$s_hot1 and voctype='PV' and sinvtype='H' ";
pg_query($sqldelac2);

// accounts conn end

$sqldelmm = "delete from sales_meals where sales_hotels_sno=$s_hot1 and ocode='$s_pnr' ";
pg_query($sqldelmm);
	
}  // end of if hotel



if(strlen(trim($s_trans))>0){  // start of if trans
	
//loop check
$transquery1 = "select f2t, tot_sell_rate from sales_trans where sales_trans_sno=$s_trans and ocode='$s_pnr'";
$transresult1 = pg_query($transquery1);

$transresult1_c = pg_num_rows($transresult1);
if($transresult1_c){
//Fetching details from sales_trans
$transquery = "select f2t, tot_sell_rate from sales_trans where sales_trans_sno=$s_trans and ocode='$s_pnr'";
$transresult = pg_query($transquery);
if (!$transresult) {
  echo "An error occured.\n";
  exit;
}
while ($row = pg_fetch_row($transresult)) {
  $fromto = $row[0];  
  $transsellrate = $row[1];
}
	
/*add a record to pnrhistory table*/
$transdelete = "INSERT INTO pnrhistory(user_sno, ocode, description, created_at) VALUES ('$suser_sno', '$s_pnr', 'Booking has been deleted with new transportation: from-to :".$fromto." with amount : ".$transsellrate."', 'now()')";
pg_query($transdelete);
/*END - add a record to pnrhistory table*/
}

$sqldelt = "delete from sales_trans where sales_trans_sno=$s_trans and ocode='$s_pnr'";
pg_query($sqldelt);


$query_trans_sno ="select sales_trans_sno from sales_trans where ocode='$s_pnr'";
$result_trans_sno = pg_query($query_trans_sno);
if(pg_num_rows($result_trans_sno)>0){ }
else{
pg_query("update sales_main set sales_trans='f' where ocode='$s_pnr'");
}


// accounts conn start


$sqldelact1 = "delete from vocmast where pnr='$s_pnr' and sinvno=$s_trans and voctype='TS' and sinvtype='T' ";
pg_query($sqldelact1);

$sqldelact2 = "delete from vocmast where pnr='$s_pnr' and sinvno=$s_trans and voctype='TP' and sinvtype='T' ";
pg_query($sqldelact2);
// accounts conn end
	
} //  end of if trans



if(strlen(trim($s_visa))>0){

//loop check
$visaquery1 = "select no_adults, no_child, no_infant, tot_sell_adults, tot_sell_child, tot_sell_infant from sales_visa where sales_visa_sno=$s_visa and ocode='$s_pnr'";
$visaresult1 = pg_query($visaquery1);

$visaresult1_c = pg_num_rows($visaresult1);
if($visaresult1_c){
//Fetching details from sales_visa
$visaquery = "select no_adults, no_child, no_infant, tot_sell_adults, tot_sell_child, tot_sell_infant from sales_visa where sales_visa_sno=$s_visa and ocode='$s_pnr'";
$visaresult = pg_query($visaquery);
if (!$visaresult) {
  echo "An error occured.\n";
  exit;
}
while ($row = pg_fetch_row($visaresult)) {
  $totalpaxs = $row[0]+$row[1]+$row[2];  
  $totalvisaamount = $row[3]+$row[4]+$row[5];  
}
	
/*add a record to pnrhistory table*/
$visadelete = "INSERT INTO pnrhistory(user_sno, ocode, description, created_at) VALUES ('$suser_sno', '$s_pnr', 'Booking has been deleted with new visa with total number of paxs: ".$totalpaxs." with amount : ".$totalvisaamount."', 'now()')";
pg_query($visadelete);
/*END - add a record to pnrhistory table*/
}


$sqldelv = "delete from sales_visa where sales_visa_sno=$s_visa and ocode='$s_pnr'";
pg_query($sqldelv);


$query_visa_sno ="select sales_visa_sno from sales_visa  where ocode='$s_pnr'";
$result_visa_sno = pg_query($query_visa_sno);
if(pg_num_rows($result_visa_sno)>0){ }
else{
pg_query("update sales_main set sales_visa='f' where ocode='$s_pnr'");
}


// accounts conn start

$sqldelac1 = "delete from vocmast where pnr='$s_pnr' and sinvno=$s_visa and voctype='US' and sinvtype='V'";
pg_query($sqldelac1);
$sqldelac2 = "delete from vocmast where pnr='$s_pnr' and sinvno=$s_visa and voctype='PV' and sinvtype='V'";
pg_query($sqldelac2);

// accounts conn end

}

if(strlen(trim($s_extra))>0){ 

/*-----------------------------------------------*/
//loop check
$extraquery1 = "select paticulars, sell_rate from sales_extra where sales_extra_sno=$s_extra and ocode='$s_pnr'";
$extraresult1 = pg_query($extraquery1);

$extraresult1_c = pg_num_rows($extraresult1);
if($extraresult1_c){
//Fetching details from sales_extra
$extraquery = "select paticulars, sell_rate from sales_extra where sales_extra_sno=$s_extra and ocode='$s_pnr'";
$extraresult = pg_query($extraquery);
if (!$extraresult) {
  echo "An error occured.\n";
  exit;
}
while ($row = pg_fetch_row($extraresult)) {
  $particulars = $row[0];  
  $extrasellrate = $row[1];  
}
	
/*add a record to pnrhistory table*/
$extradelete = "INSERT INTO pnrhistory(user_sno, ocode, description, created_at) VALUES ('$suser_sno', '$s_pnr', 'Booking has been deleted with new Extra with particulars: ".$particulars." with amount : ".$extrasellrate."', 'now()')";
pg_query($extradelete);
/*END - add a record to pnrhistory table*/
}
/*-----------------------------------------------*/

$sqldelv = "delete from sales_extra where sales_extra_sno=$s_extra and ocode='$s_pnr'";

pg_query($sqldelv);

$query_extra_sno ="select sales_extra_sno from sales_extra where ocode='$s_pnr'";
$result_extra_sno = pg_query($query_extra_sno);
if(pg_num_rows($result_extra_sno)>0){ }
else{
pg_query("update sales_main set sales_others='f' where ocode='$s_pnr'");
}


// accounts conn start

$sqldelac1 = "delete from vocmast where pnr='$s_pnr' and sinvno=$s_extra and voctype='CS' and sinvtype='X'";
pg_query($sqldelac1);
$sqldelac2 = "delete from vocmast where pnr='$s_pnr' and sinvno=$s_extra and voctype='PV' and sinvtype='X'";
pg_query($sqldelac2);

// accounts conn end

}


$n_ifc = 0 ;

$query_hotels_sno ="select sales_hotels_sno from sales_hotels where (booking_status='On Request' and ocode='$s_pnr') or (booking_status='Cancelled' and ocode='$s_pnr') ";
$result_hotels_sno = pg_query($query_hotels_sno);
$n_ifc = $n_ifc + pg_num_rows($result_hotels_sno);


$query_trans_sno ="select sales_trans_sno from sales_trans where (booking_status='On Request' and ocode='$s_pnr') or (booking_status='Cancelled' and ocode='$s_pnr')";

$result_trans_sno = pg_query($query_trans_sno);

$n_ifc = $n_ifc + pg_num_rows($result_trans_sno);


$query_visa_sno ="select sales_visa_sno from sales_visa  where (booking_status='On Request' and ocode='$s_pnr') or (booking_status='Cancelled' and ocode='$s_pnr')";

$result_visa_sno = pg_query($query_visa_sno);

$n_ifc = $n_ifc + pg_num_rows($result_visa_sno);


$query_extra_sno ="select sales_extra_sno from sales_extra where (booking_status='On Request' and ocode='$s_pnr') or (booking_status='Cancelled' and ocode='$s_pnr')";

$result_extra_sno = pg_query($query_extra_sno);

$n_ifc = $n_ifc + pg_num_rows($result_extra_sno);


if($n_ifc>0){}
else{
$upmain = "update sales_main set booking_status='Confirmed' where ocode='$s_pnr' ";
pg_query($upmain);
}

}     // atleast one record start
else {
echo "<script> alert(\"Sorry Record not delete, PNR should have aleast one record\")</script>";
}

echo "<script>document.location.href=\"pnrdet.php?spnr=$s_pnr\"</script>";  

 ?>
</body>	
</center>
</html>
