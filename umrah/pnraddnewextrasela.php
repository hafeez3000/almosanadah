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

  

$other2noofa=$_SESSION['other2noofa'];
$other2nrate=$_POST['other2net'];
$other2srate=$_POST['other2sell'];


$others2d = $_SESSION['d11Day'];
$others2m = $_SESSION['d11Month'];
$others2y = $_SESSION['d11Year'];

$others2rd = $others2y ."-". $others2m ."-". $others2d ; 




$query_extra_seq ="select sales_extra from seq";

$result_extra_seq = pg_query($conn, $query_extra_seq);

if (!$result_extra_seq) {
echo "An error occured.\n";
exit;
		}
while ($rows_extra_seq = pg_fetch_array($result_extra_seq)){
$extra_seq = $rows_extra_seq["sales_extra"];
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


$sqlinsextra = "insert into sales_extra( sales_extra_sno,main_sno,ocode,cus_account_code,user_sno,user_id,req_date_time,paticulars,net_rate,sell_rate,order_date,booking_status)  values($extra_seq,$smain_sno,'$s_pnr','$scus_account_code',$suser_sno,'$suserid','$others2rd','$other2noofa',$other2nrate,$other2srate,'now','On Request')"; 
pg_query($conn, $sqlinsextra);



$sequpdateextra = "update seq set sales_extra=sales_extra+1";
pg_query($conn, $sequpdateextra);


// accounts conn start


$vocno=$smain_sno."-X-".$extra_seq;
$vocsno=1;
$ac_nar ="";
$ac_nar = "CR Sales - ". $sguest_title .". ".$sguest_name." - PNR:".$s_pnr; 	
$ac_nar = substr($ac_nar,0,254);

$ac_md =$other2noofa;
$ac_md = substr($ac_md,0,254);

$sqlinsacc1 = "insert into 	vocmast(voctype,vocno,vocsno,vocdate,acccode,narration,dbamt,cramt,pnr,invno,recon,sinvno,sinvtype,moredet) values('CS','$vocno',$vocsno,'$others2rd','$scus_account_code','$ac_nar',$other2srate,0,'$s_pnr',$smain_sno,'f',$extra_seq,'X','$ac_md')"; 
pg_query($conn, $sqlinsacc1);

$vocsno++;

$ac_nar="";
$ac_nar = "CR Sales - ". $sguest_title .". ".$sguest_name." - PNR:".$s_pnr ." - ".$cus_company_name.",". $cus_country;
$ac_nar = substr($ac_nar,0,254);

$sqlinsacc2 = "insert into 	vocmast(voctype,vocno,vocsno,vocdate,acccode,narration,dbamt,cramt,pnr,invno,recon,sinvno,sinvtype,moredet) values('CS','$vocno',$vocsno,'$others2rd','501005','$ac_nar',0,$other2srate,'$s_pnr',$smain_sno,'f',$extra_seq,'X','$ac_md')"; 
pg_query($conn, $sqlinsacc2);

$vocsno=1;
$ac_nar="";
$ac_nar = "CR Purchase - Extra (Others) Suppliers  - ". $sguest_title .". ".$sguest_name." - PNR:".$s_pnr; 		
$ac_nar = substr($ac_nar,0,254);

$sqlinsacc3 = "insert into vocmast(voctype,vocno,vocsno,vocdate,acccode,narration,dbamt,cramt,pnr,invno,recon,sinvno,sinvtype,moredet) values('PV','$vocno',$vocsno,'$others2rd','600006','$ac_nar',$other2nrate,0,'$s_pnr',$smain_sno,'f',$extra_seq,'X','$ac_md')"; 
pg_query($conn, $sqlinsacc3);

$vocsno++;
$ac_nar="";
$ac_nar = "CR Purchase for - ". $sguest_title .". ".$sguest_name." - PNR:".$s_pnr ." - ".$cus_company_name.",". $cus_country;
$ac_nar = substr($ac_nar,0,254);

$sqlinsacc4 = "insert into 	vocmast(voctype,vocno,vocsno,vocdate,acccode,narration,dbamt,cramt,pnr,invno,recon,sinvno,sinvtype,moredet) values('PV','$vocno',$vocsno,'$others2rd','412000','$ac_nar',0,$other2nrate,'$s_pnr',$smain_sno,'f',$extra_seq,'X','$ac_md')"; 
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

$cbd = getdate($ts);
isset($cbdd) ? $cbdd = $cbd[mday] : null;
isset($cbdm) ? $cbdm = $cbd[mon] : null;
isset($cbdy) ? $cbdy = $cbd[year] : null;

isset($cbds) ? $cbds = $cbd[seconds] : null;
isset($cbdmi) ? $cbdmi = $cbd[minutes] : null;
isset($cbdh) ? $cbdh = $cbd[hours] : null;

$ts3=($tscin-$ts)/2;
echo "<br>";
$bd = getdate($ts+$ts3);
isset($bdd) ? $bdd = $bd[mday] : null;
isset($bdm) ? $bdm = $bd[mon] : null;
isset($bdy) ? $bdy = $bd[year] : null;

isset($bds) ? $bds = $bd[seconds] : null;
isset($bdmi) ? $bdmi = $bd[minutes] : null;
isset($bdh) ? $bdh = $bd[hours] : null;


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


$sqlhotopu = "update sales_extra set option_date='$optiondate' where  ocode='$s_pnr' "; 
pg_query($conn, $sqlhotopu);

$sqlmainopu = "update sales_main set sales_others='t', order_date='now',option_date='$optiondate',booking_status='On Request' where  ocode='$s_pnr'"; 
pg_query($conn, $sqlmainopu);

/*add a record to pnrhistory table*/
$pnraddnewextrasela = "INSERT INTO pnrhistory(user_sno, ocode, description, created_at) VALUES ('$suser_sno', '$s_pnr', 'Booking has been added with new Extra with particulars: ".$other2noofa." with amount : ".$other2srate."', 'now()')";
pg_query($conn, $pnraddnewextrasela);
/*END - add a record to pnrhistory table*/

echo "<script>document.location.href=\"pnrdet.php?spnr=$s_pnr\"</script>";  

 ?>
</body>	
</center>
</html>
