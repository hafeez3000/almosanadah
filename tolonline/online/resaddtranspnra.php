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

 session_start();

 $s_pnr = $_SESSION["spnr"];
$g_trans_sno = $_SESSION["transid"];

							  

$trans0d = $_SESSION['d6Day'];
$trans0m = $_SESSION['d6Month'];
$trans0y = $_SESSION['d6Year'];

 $s_timeselecthours0  = $_SESSION['timeselecthours0']; 
 $s_timeselectmin0	  = $_SESSION['timeselectmin0'];   


 $trans0rd = date('Y-m-d H:i:00', mktime($s_timeselecthours0,$s_timeselectmin0,0,$trans0m,$trans0d,$trans0y));


$s_req_date_time_do_v = substr($trans0rd, 0,10);

 $s_s_trans0		  = $_SESSION['s_trans0'];            
 $s_typeoftrans0	  = $_SESSION['typeoftrans0'];    
 
 $s_noofu0			  = $_SESSION['noofu0'];         //units   
 $s_flightdet0		  = $_SESSION['flightdet0'];      
 
$tvety0= $_SESSION['tvety0'];
$tvetr0= $_SESSION['tvetr0'];
$tvetp0= $_SESSION['tvetp0'];
$trans1nrate= $_POST["trans1nrate$s_typeoftrans0"];
$trans1rate= $_POST["trans1rate$s_typeoftrans0"];


$netprice1  = $trans1nrate / $s_noofu0;
$sellprice1 = $trans1rate / $s_noofu0;



$query_trans_seq ="select sales_trans from seq";

$result_trans_seq = pg_query($query_trans_seq);

if (!$result_trans_seq) {
echo "An error occured.\n";
exit;
		}
while ($rows_trans_seq = pg_fetch_array($result_trans_seq)){
$trans_seq = $rows_trans_seq["sales_trans"];
}

$query_trans ="select trans_id,account_code,trans_c_name,city from s_trans where trans_id='$g_trans_sno' ";

$result_trans = pg_query($query_trans);

if (!$result_trans) {
	echo "An error occured.\n";
	exit;
	}
while ($rows_trans = pg_fetch_array($result_trans)){

$trans_c_name = $rows_trans["trans_c_name"];
$city = $rows_trans["city"];
$account_code = $rows_trans["account_code"];
}

pg_free_result($result_trans);


$query_main_u ="select main_sno,user_sno,user_id,cus_account_code,cus_company_name,cus_country,guest_title,guest_name from sales_main where ocode='$s_pnr'";

$result_main_u = pg_query($query_main_u);

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


$sqlinstrans = "insert into sales_trans(sales_trans_sno,main_sno,ocode,cus_account_code,supp_account_code,user_sno,user_id,req_date_time,f2t,type_of_trans,no_of_units,no_of_paxs,flight_det,net_rate,sell_rate,tot_net_rate,tot_sell_rate,booking_status,order_date,trans_id,trans_id_s,is_online)  values($trans_seq,$smain_sno,'$s_pnr','$scus_account_code','$account_code',$suser_sno,'$suserid','$trans0rd','$tvetr0','$tvety0','$s_noofu0','$tvetp0','$s_flightdet0',$netprice1,$sellprice1,$trans1nrate,$trans1rate,'On Request','now','$s_typeoftrans0','$s_s_trans0',1)"; 
pg_query($sqlinstrans);


// accounts conn start


$vocno=$smain_sno."-T-".$trans_seq;
$vocsno=1;
$ac_nar ="";
$ac_nar = "CR Sales - ". $sguest_title .". ".$sguest_name." - ".$s_pnr; 	
$ac_nar = substr($ac_nar,0,254);

$ac_md = $s_noofu0."X".$tvety0." - ".$tvetr0." - Req Date:".date('d/M', strtotime($trans0rd));
$ac_md = substr($ac_md,0,254);

$sqlinsacc1 = "insert into 	vocmast(voctype,vocno,vocsno,vocdate,acccode,narration,dbamt,cramt,pnr,invno,recon,sinvno,sinvtype,moredet) values('TS','$vocno',$vocsno,'$s_req_date_time_do_v','$scus_account_code','$ac_nar',$trans1rate,0,'$s_pnr',$smain_sno,'f',$trans_seq,'T','$ac_md')"; 
pg_query($sqlinsacc1);

$vocsno++;

$ac_nar="";
$ac_nar = "CR Sales - ". $sguest_title .". ".$sguest_name." - ".$s_pnr ." - ".$cus_company_name.",". $cus_country;
$ac_nar = substr($ac_nar,0,254);

$ac_md = $trans_c_name." - ".$s_noofu0."X".$tvety0." - ".$tvetr0." - Req Date:".date('d/M', strtotime($trans0rd));
$ac_md = substr($ac_md,0,254);

$sqlinsacc2 = "insert into 	vocmast(voctype,vocno,vocsno,vocdate,acccode,narration,dbamt,cramt,pnr,invno,recon,sinvno,sinvtype,moredet) values('TS','$vocno',$vocsno,'$s_req_date_time_do_v','501004','$ac_nar',0,$trans1rate,'$s_pnr',$smain_sno,'f',$trans_seq,'T','$ac_md')"; 
pg_query($sqlinsacc2);

$vocsno=1;
$ac_nar="";
$ac_nar = "CR Purchase - ". $sguest_title .". ".$sguest_name." - ".$s_pnr; 
$ac_nar = substr($ac_nar,0,254);

$sqlinsacc3 = "insert into 	vocmast(voctype,vocno,vocsno,vocdate,acccode,narration,dbamt,cramt,pnr,invno,recon,sinvno,sinvtype,moredet) values('TP','$vocno',$vocsno,'$s_req_date_time_do_v','600005','$ac_nar',$trans1nrate,0,'$s_pnr',$smain_sno,'f',$trans_seq,'T','$ac_md')"; 
pg_query($sqlinsacc3);

$vocsno++;
$ac_nar="";
$ac_nar = "CR Purchase for - ". $sguest_title .". ".$sguest_name." - ".$s_pnr ." - ".$cus_company_name.",". $cus_country;
$ac_nar = substr($ac_nar,0,254);

$sqlinsacc4 = "insert into 	vocmast(voctype,vocno,vocsno,vocdate,acccode,narration,dbamt,cramt,pnr,invno,recon,sinvno,sinvtype,moredet) values('TP','$vocno',$vocsno,'$s_req_date_time_do_v','$account_code','$ac_nar',0,$trans1nrate,'$s_pnr',$smain_sno,'f',$trans_seq,'T','$ac_md')"; 
pg_query($sqlinsacc4);


// accounts conn end



$sequpdatetrans = "update seq set sales_trans=sales_trans+1";
pg_query($sequpdatetrans);



$query_hotels_sno ="select sales_hotels_sno,cin from sales_hotels where  ocode='$s_pnr'";

$result_hotels_sno = pg_query($query_hotels_sno);

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

$result_trans_sno = pg_query($query_trans_sno);

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

$result_visa_sno = pg_query($query_visa_sno);

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

$result_extra_sno = pg_query($query_extra_sno);

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
$cbdd = $cbd[mday];
$cbdm =$cbd[mon];
$cbdy =$cbd[year];

$cbds = $cbd[seconds];
$cbdmi =$cbd[minutes];
$cbdh =$cbd[hours];

$ts3=($tscin-$ts)/2;
echo "<br>";
$bd = getdate($ts+$ts3);
$bdd = $bd[mday];
$bdm =$bd[mon];
$bdy =$bd[year];

$bds = $bd[seconds];
$bdmi =$bd[minutes];
$bdh =$bd[hours];


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


$sqlhotopu = "update sales_trans set option_date='$optiondate' where ocode='$s_pnr' "; 
pg_query($sqlhotopu);

$sqlmainopu = "update sales_main set sales_trans='t',order_date='now',option_date='$optiondate',booking_status='On Request' where  ocode='$s_pnr'"; 
pg_query($sqlmainopu);

/*add a record to pnrhistory table*/
$resaddtranspnra = "INSERT INTO pnrhistory(user_sno, ocode, description, created_at) VALUES ('$suser_sno', '$s_pnr', 'Booking has been added with new transportation: from-to: ".$tvetr0." with amount: ".$trans1rate."', 'now()')";
pg_query($resaddtranspnra);
/*END - add a record to pnrhistory table*/

 echo "<script>document.location.href=\"pnrdet.php?spnr=$s_pnr\"</script>";  

 ?>
</body>	
</center>
</html>
