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



$query_visa_seq ="select sales_visa from seq";

$result_visa_seq = pg_query($conn, $query_visa_seq);

if (!$result_visa_seq) {
echo "An error occured.\n";
exit;
		}
while ($rows_visa_seq = pg_fetch_array($result_visa_seq)){
$visa_seq = $rows_visa_seq["sales_visa"];
}


$query_main_u ="select main_sno,user_sno,user_id,guest_title,guest_name,cus_company_name,cus_country,cus_account_code from sales_main where ocode='$s_pnr'";

$result_main_u = pg_query($conn, $query_main_u);

if (!$result_main_u) {
echo "An error occured.\n";
exit;
		}
while ($rows_main_u = pg_fetch_array($result_main_u)){


$smain_sno = $rows_main_u["main_sno"];
$suser_sno = $rows_main_u["user_sno"];
$scus_account_code = $rows_main_u["cus_account_code"];
$sguest_title = $rows_main_u["guest_title"];
$sguest_name = $rows_main_u["guest_name"];
$cus_company_name = $rows_main_u["cus_company_name"];
$cus_country = $rows_main_u["cus_country"];


$suserid = $rows_main_u["user_id"];
}


$sqlinsvisa = "insert into sales_visa(sales_visa_sno,main_sno,ocode,cus_account_code,	user_sno,	user_id, req_date_time,	no_adults, no_child,no_infant,net_adults,sell_adults,net_child,sell_child,net_infant,	 sell_infant,tot_net_adults,	tot_sell_adults,tot_net_child,	tot_sell_child,tot_net_infant,	tot_sell_infant,order_date,booking_status )  values($visa_seq,$smain_sno,'$s_pnr','$scus_account_code',$suser_sno,'$suserid','$reqdate', $n_adult, $n_child, $n_infant, $s_adult_net_rate, $s_adult_sell_rate, $s_child_net_rate, $s_child_sell_rate, $s_infant_net_rate, $s_infant_sell_rate, $tot_adult_net_rate, $tot_adult_sell_rate, $tot_child_net_rate, $tot_child_sell_rate, $tot_infant_net_rate, $tot_infant_sell_rate, 'now','On Request' )";
pg_query($conn, $sqlinsvisa);


// accounts conn start


$vocno=$smain_sno."-V-".$visa_seq;
$vocsno=1;
$ac_nar ="";
$ac_nar = "CR Sales - ". $sguest_title .". ".$sguest_name." - PNR:".$s_pnr;
$ac_nar = substr($ac_nar,0,254);

$ac_md =" ";
if($n_adult>0){ $ac_md = $n_adult."X Adults"; }
if($n_child>0){$ac_md = $ac_md . " - ". $n_child. "X Children"; }
if($n_infant>0){$ac_md = $ac_md . " - ". $n_infant."X Infants"; }
$ac_md = substr($ac_md,0,254);

$sqlinsacc1 = "insert into 	vocmast(voctype,vocno,vocsno,vocdate,acccode,narration,dbamt,cramt,pnr,invno,recon,sinvno,sinvtype,moredet) values('US','$vocno',$vocsno,'$reqdate','$scus_account_code','$ac_nar',$gtotv_sell,0,'$s_pnr',$smain_sno,'f',$visa_seq,'V','$ac_md')";
pg_query($conn, $sqlinsacc1);

$vocsno++;

$ac_nar="";
$ac_nar = "CR Sales - ". $sguest_title .". ".$sguest_name." - PNR:".$s_pnr ." - ".$cus_company_name.",". $cus_country;
$ac_nar = substr($ac_nar,0,254);

$sqlinsacc2 = "insert into 	vocmast(voctype,vocno,vocsno,vocdate,acccode,narration,dbamt,cramt,pnr,invno,recon,sinvno,sinvtype,moredet) values('US','$vocno',$vocsno,'$reqdate','501003','$ac_nar',0,$gtotv_sell,'$s_pnr',$smain_sno,'f',$visa_seq,'V','$ac_md')";
pg_query($conn, $sqlinsacc2);

$vocsno=1;
$ac_nar="";
$ac_nar = "CR Purchase - Nusuk Umrah - ". $sguest_title .". ".$sguest_name." - PNR:".$s_pnr;
$ac_nar = substr($ac_nar,0,254);

$sqlinsacc3 = "insert into vocmast(voctype,vocno,vocsno,vocdate,acccode,narration,dbamt,cramt,pnr,invno,recon,sinvno,sinvtype,moredet) values('UP','$vocno',$vocsno,'$reqdate','600004','$ac_nar',$gtotv_net,0,'$s_pnr',$smain_sno,'f',$visa_seq,'V','$ac_md')";
pg_query($conn, $sqlinsacc3);

$vocsno++;
$ac_nar="";
$ac_nar = "CR Purchase for - ". $sguest_title .". ".$sguest_name." - PNR:".$s_pnr ." - ".$cus_company_name.",". $cus_country;
$ac_nar = substr($ac_nar,0,254);

$sqlinsacc4 = "insert into 	vocmast(voctype,vocno,vocsno,vocdate,acccode,narration,dbamt,cramt,pnr,invno,recon,sinvno,sinvtype,moredet) values('UP','$vocno',$vocsno,'$reqdate','413001','$ac_nar',0,$gtotv_net,'$s_pnr',$smain_sno,'f',$visa_seq,'V','$ac_md')";
pg_query($conn, $sqlinsacc4);


// accounts conn end


$sequpdatevisa = "update seq set sales_visa=sales_visa+1";
pg_query($conn, $sequpdatevisa);


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

$sqlmainopu = "update sales_main set sales_visa='t',order_date='now',option_date='$optiondate',booking_status='On Request' where  ocode='$s_pnr'";
pg_query($conn, $sqlmainopu);

/*add a record to pnrhistory table*/
$suser_sno = $_SESSION['user_sno'];
$pnraddnewvisaa = "INSERT INTO pnrhistory(user_sno, ocode, description, created_at) VALUES ('$suser_sno', '$s_pnr', 'Booking has been added with new visa with total number of paxs: ".$totpaxs." with amount : ".$gtotv_sell."', 'now()')";
pg_query($conn, $pnraddnewvisaa);
/*END - add a record to pnrhistory table*/

echo "<script>document.location.href=\"pnrdet.php?spnr=$s_pnr\"</script>";
?>
</body>
</center>
</html>
