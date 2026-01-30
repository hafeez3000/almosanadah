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

  if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

 $s_pnr = $_SESSION["spnr"];
 $g_extraid = $_SESSION["extraid"];

							  

$other2noofa=$_SESSION['other2noofa'];
$other2nrate=$_POST['other2net'];
$other2srate=$_POST['other2sell'];


$others2d = $_SESSION['d11Day'];
$others2m = $_SESSION['d11Month'];
$others2y = $_SESSION['d11Year'];

$others2rd = $others2y ."-". $others2m ."-". $others2d ; 



$sqlinstrans = "update sales_extra set req_date_time='$others2rd',paticulars='$other2noofa',net_rate=$other2nrate,sell_rate=$other2srate,booking_status='On Request',order_date='now' where sales_extra_sno=$g_extraid and ocode='$s_pnr' "; 

pg_query($conn, $sqlinstrans);


// accounts conn start


$ac_md =$other2noofa;
$ac_md = substr($ac_md,0,254);


$sqlinsacc1 = "update vocmast set vocdate='$others2rd',moredet='$ac_md',dbamt=$other2srate,recon='f' where pnr='$s_pnr' and sinvno=$g_extraid and vocsno=1 and voctype='CS' and sinvtype='X' ";
pg_query($conn, $sqlinsacc1);

$sqlinsacc2 = "update vocmast set vocdate='$others2rd',moredet='$ac_md',cramt=$other2srate,recon='f' where pnr='$s_pnr' and sinvno=$g_extraid and vocsno=2 and voctype='CS' and sinvtype='X'";
pg_query($conn, $sqlinsacc2);



$sqlinsacc3 = "update vocmast set vocdate='$others2rd',moredet='$ac_md',recon='f',dbamt=$other2nrate where pnr='$s_pnr' and sinvno=$g_extraid and vocsno=1 and voctype='PV' and sinvtype='X'";
pg_query($conn, $sqlinsacc3);



$sqlinsacc4 = "update vocmast set vocdate='$others2rd',moredet='$ac_md',recon='f',cramt=$other2nrate where pnr='$s_pnr' and sinvno=$g_extraid and vocsno=2 and voctype='PV' and sinvtype='X'";
pg_query($conn, $sqlinsacc4);



// accounts conn end


$query_hotels_sno ="select sales_hotels_sno,cin from sales_hotels where  ocode='$s_pnr'";

$result_hotels_sno = pg_query($conn, $query_hotels_sno);

$rows_hotels = pg_num_rows($result_hotels_sno);

if (!$result_hotels_sno) {
echo "An error occured.\n";
exit;
		}
while ($rows_hotels_sno = pg_fetch_array($result_hotels_sno)){

$s_sales_hotel_sno[] = $rows_hotels_sno["sales_hotels_sno"];
$array_cin[] =  $rows_hotels_sno["cin"];
}

$query_trans_sno ="select sales_trans_sno,req_date_time from sales_trans where  ocode='$s_pnr'";

$result_trans_sno = pg_query($conn, $query_trans_sno);

$rows_trans = pg_num_rows($result_trans_sno);

if (!$result_trans_sno) {
echo "An error occured.\n";
exit;
		}
while ($rows_trans_sno = pg_fetch_array($result_trans_sno)){

$s_sales_trans_sno[] = $rows_trans_sno["sales_trans_sno"];
$array_trans_req[] =  $rows_trans_sno["req_date_time"];
}

$query_visa_sno ="select sales_visa_sno,req_date_time from sales_visa where  ocode='$s_pnr'";

$result_visa_sno = pg_query($conn, $query_visa_sno);

$rows_visa = pg_num_rows($result_visa_sno);

if (!$result_visa_sno) {
echo "An error occured.\n";
exit;
		}
while ($rows_visa_sno = pg_fetch_array($result_visa_sno)){

$s_sales_visa_sno[] = $rows_visa_sno["sales_visa_sno"];
$array_visa_req[] =  $rows_visa_sno["req_date_time"];
}


$query_extra_sno ="select sales_extra_sno,req_date_time from sales_extra where ocode='$s_pnr'";

$result_extra_sno = pg_query($conn, $query_extra_sno);

$rows_extra = pg_num_rows($result_extra_sno);

if (!$result_extra_sno) {
echo "An error occured.\n";
exit;
		}
while ($rows_extra_sno = pg_fetch_array($result_extra_sno)){

$s_sales_extra_sno[] = $rows_extra_sno["sales_extra_sno"];
$array_extra_req[] =  $rows_extra_sno["req_date_time"];
}



$cinda = array();

$b_hotel="FALSE";
$b_trans="FALSE";
$b_visa="FALSE";
$b_extra="FALSE";


if($rows_hotels>0){
$cinda[] =  min($array_cin)." 17:00:00";
$b_hotel="TRUE";
}


if($rows_trans>0){
$cinda[] =  min($array_trans_req);
$b_trans="TRUE";
}

if($rows_visa>0){
$cinda[] =  min($array_visa_req);
$b_visa="TRUE";
}

if($rows_extra>0){
$cinda[] =  min($array_extra_req);
$b_extra="TRUE";
}

if($rows_hotels>0 || $rows_trans>0  || $rows_visa>0 || $rows_extra>0){

$cind = min($cinda);

}

$optiondate = " ";

if($rows_hotels>0 || $rows_trans>0  || $rows_visa>0 || $rows_extra>0){

$tscin = strtotime($cind); 
$ts = strtotime("now");

$cbd = DateTimeImmutable::createFromTimestamp($ts);
$cbd = $cbd->setTimezone(new DateTimeZone(date_default_timezone_get()));

$cbdd = $cbd->format('d');
$cbdm = $cbd->format('m');
$cbdy = $cbd->format('Y');

$cbds = $cbd->format('s');
$cbdmi = $cbd->format('i');
$cbdh = $cbd->format('H');


$ts3=($tscin-$ts)/2;
echo "<br>";
// $bd = getdate($ts+$ts3);
$bd = DateTimeImmutable::createFromTimestamp($ts+$ts3);
$bd = $bd->setTimezone(new DateTimeZone(date_default_timezone_get()));

$bdd = $bd->format('d');
$bdm = $bd->format('m');
$bdy = $bd->format('Y');

$bds = $bd->format('s');
$bdmi = $bd->format('i');
$bdh = $bd->format('H');


if($ts3 < 30600){
$optiondate = date('Y-m-d H:i:00', mktime($bdh,$bdmi,$bds,$bdm,$bdd,$bdy));
}

if($ts3 > 30600 && $ts3 < 86400){

if(date('D', $ts+$ts3)=="Fri"){
$optiondate = date('Y-m-d H:i:00', mktime(14,0,0,$bdm,$bdd-1,$bdy));
}
else {

$optiondate = date('Y-m-d h:i:00', mktime(10,0,0,$bdm,$bdd,$bdy));

}
}

if($ts3 > 86400 && $ts3 < 129600){

if(date('D', $ts+$ts3)=="Fri"){
$optiondate = date('Y-m-d H:i:00', mktime(14,0,0,$bdm,$bdd-1,$bdy));
}
else {

$optiondate = date('Y-m-d h:i:00', mktime(10,0,0,$bdm,$bdd,$bdy));

}
}

if($ts3 > 129600 && $ts3 <  172800){

if(date('D', $ts+$ts3)=="Fri"){
$optiondate = date('Y-m-d H:i:00', mktime(14,0,0,$bdm,$bdd-1,$bdy));
}
else {

$optiondate = date('Y-m-d h:i:00', mktime(10,0,0,$bdm,$bdd,$bdy));

}
}

if($ts3 > 172800){

if(date('D', $ts+$ts3)=="Fri"){

if(date('D', mktime(14,0,0,$cbdm,$cbdd+2,$cbdy))=="Fri"){
$optiondate = date('Y-m-d H:i:00', mktime(14,0,0,$cbdm,$cbdd+1,$cbdy));
}
else {
$optiondate = date('Y-m-d h:i:00', mktime(10,0,0,$cbdm,$cbdd+2,$cbdy));
}
}
else {

if(date('D', mktime(14,0,0,$cbdm,$cbdd+2,$cbdy))=="Fri"){

$optiondate = date('Y-m-d H:i:00', mktime(14,0,0,$cbdm,$cbdd+1,$cbdy));
}
else {
$optiondate = date('Y-m-d h:i:00', mktime(10,0,0,$cbdm,$cbdd+3,$cbdy));
}

}
}

} // end of if $rows_hotels if

$optiondate;


$sqlhotopu = "update sales_extra set option_date='$optiondate' where sales_extra_sno=$g_extraid and ocode='$s_pnr' "; 
pg_query($conn, $sqlhotopu);

$sqlmainopu = "update sales_main set order_date='now',option_date='$optiondate',booking_status='On Request' where  ocode='$s_pnr'"; 
pg_query($conn, $sqlmainopu);

/*add a record to pnrhistory table*/
$resextraamenda = "INSERT INTO pnrhistory(user_sno, ocode, description, created_at) VALUES ('$suser_sno', '$s_pnr', 'Booking has been amended with new Extra with particulars: ".$other2noofa." with amount : ".$other2srate."', 'now()')";
pg_query($conn, $resextraamenda);
/*END - add a record to pnrhistory table*/


 echo "<script>document.location.href=\"pnrdet.php?spnr=$s_pnr\"</script>";  

 ?>
</body>	
</center>
</html>
