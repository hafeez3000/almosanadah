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
<? include ("gprocessing.html"); 

 $s_pnr = $_SESSION["spnr"];
 $g_visaid = $_SESSION["visaid"];


 $reqd = $_POST['d1Day'];
 $reqm = $_POST['d1Month'];
 $reqy = $_POST['d1Year'];

$n_adult = $_POST['noofa'];

$n_child = $_POST['noofc'];

$n_infant = $_POST['noofi'];

$totpaxs = $n_adult + $n_child + $n_infant;

$s_adult_net_rate = $_POST['anetprice'];

$s_adult_sell_rate = $_POST['asellprice'];

$tot_adult_net_rate = $s_adult_net_rate * $n_adult;
$tot_adult_sell_rate = $s_adult_sell_rate * $n_adult;


$s_child_net_rate = $_POST['cnetprice'];

$s_child_sell_rate = $_POST['csellprice'];

$tot_child_net_rate = $s_child_net_rate * $n_child;
$tot_child_sell_rate = $s_child_sell_rate * $n_child;


$s_infant_net_rate = $_POST['inetprice'];
$s_infant_sell_rate = $_POST['isellprice'];

$tot_infant_net_rate = $s_infant_net_rate * $n_infant;
$tot_infant_sell_rate = $s_infant_sell_rate * $n_infant;


$gtotv_net = $tot_adult_net_rate + $tot_child_net_rate + $tot_infant_net_rate;
$gtotv_sell = $tot_adult_sell_rate + $tot_child_sell_rate + $tot_infant_sell_rate;

$reqdate = date('Y-m-d', mktime(0,0,0,$reqm,$reqd,$reqy));




$sqlinsvisa = "update sales_visa set req_date_time='$reqdate', no_adults=$n_adult, no_child=$n_child, no_infant=$n_infant, net_adults=$s_adult_net_rate, sell_adults=$s_adult_sell_rate, net_child=$s_child_net_rate, sell_child=$s_child_sell_rate, net_infant=$s_infant_net_rate, sell_infant=$s_infant_sell_rate, tot_net_adults=$tot_adult_net_rate, tot_sell_adults=$tot_adult_sell_rate, tot_net_child=$tot_child_net_rate, tot_sell_child=$tot_child_sell_rate, tot_net_infant=$tot_infant_net_rate, tot_sell_infant=$tot_infant_sell_rate, order_date='now' where sales_visa_sno=$g_visaid  and ocode='$s_pnr' "; 

pg_query($conn, $sqlinsvisa);


// accounts conn start

$ac_md ="";
if($n_adult>0){ $ac_md = $n_adult."X Adults"; }
if($n_child>0){$ac_md = $ac_md . " - ". $n_child. "X Children"; }
if($n_infant>0){$ac_md = $ac_md . " - ". $n_infant."X Infants"; }
$ac_md = substr($ac_md,0,254);


$sqlinsacc1 = "update vocmast set vocdate='$reqdate',moredet='$ac_md',dbamt=$gtotv_sell,recon='f' where pnr='$s_pnr' and sinvno=$g_visaid and vocsno=1 and voctype='US' and sinvtype='V' ";
pg_query($conn, $sqlinsacc1);

$sqlinsacc2 = "update vocmast set vocdate='$reqdate',moredet='$ac_md',cramt=$gtotv_sell,recon='f' where pnr='$s_pnr' and sinvno=$g_visaid and vocsno=2 and voctype='US' and sinvtype='V'";
pg_query($conn, $sqlinsacc2);



$sqlinsacc3 = "update vocmast set vocdate='$reqdate',moredet='$ac_md',recon='f',dbamt=$gtotv_net where pnr='$s_pnr' and sinvno=$g_visaid and vocsno=1 and voctype='UP' and sinvtype='V'";
pg_query($conn, $sqlinsacc3);



$sqlinsacc4 = "update vocmast set vocdate='$reqdate',moredet='$ac_md',recon='f',cramt=$gtotv_net where pnr='$s_pnr' and sinvno=$g_visaid and vocsno=2 and voctype='UP' and sinvtype='V'";
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


$sqlhotopu = "update sales_visa set option_date='$optiondate' where ocode='$s_pnr' "; 
pg_query($conn, $sqlhotopu);

$sqlmainopu = "update sales_main set order_date='now',option_date='$optiondate',booking_status='On Request' where  ocode='$s_pnr'"; 
pg_query($conn, $sqlmainopu);

/*add a record to pnrhistory table*/
$suser_sno = $_SESSION['user_sno'];
$amendvisasela = "INSERT INTO pnrhistory(user_sno, ocode, description, created_at) VALUES ('$suser_sno', '$s_pnr', 'Booking has been amended with new visa with total number of paxs: ".$totpaxs." with amount : ".$gtotv_sell."', 'now()')";
pg_query($conn, $amendvisasela);
/*END - add a record to pnrhistory table*/

 echo "<script>document.location.href=\"pnrdet.php?spnr=$s_pnr\"</script>";  
?>
</body>	
</center>
</html>
