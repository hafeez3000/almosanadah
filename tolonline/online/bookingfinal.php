<?
include ("header.php");
?>
<center>
<body bgcolor="#00A800" leftmargin="10" topmargin="10" marginwidth="0" marginheight="0">
<table width="100%" height="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF">
  <tr>
    <td>

<table width="100%" height="6%" border="0" cellspacing="0" cellpadding="0" bgcolor="#CAFFCA">
  <tr>
            <td><font size="2" face="Arial, Helvetica, sans-serif"><strong>&nbsp; Finalizing Booking ...</strong></font></td>
            <td valign="top"> <div align="right"><img src="../images/tr.jpg" width="9" height="10"></div></td>
  </tr>
</table>
<table width="100%" height="86%" border="0" cellspacing="0" cellpadding="1" bgcolor="#FFFFFF">
  <tr><td valign="top">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td>
<br><br><br><br><br>
<? 
include ("gprocessing.html"); 
?>


<?
 $agentccc =$_POST['agentname'];
 
 $agent_email = "res@daralmanasek.com";

 $s_tanotes = "";
 $s_gtitle = $_POST['gtitle'];
 $s_gname = $_POST['gname'];
 $s_contactno = $_POST['contactno'];
 $s_flightdet = $_POST['flightdet'];
 $s_guestnotes =  $_POST['guestnotes'];

$array_cin = array();
$s_sales_hotel_sno = array();

$s_sales_trans_sno = array();
$array_trans_req =  array();

$s_sales_visa_sno = array();
$array_visa_req =  array();

$s_sales_extra_sno = array();
$array_extra_req =  array();

echo "<br>";

$query_main_seq ="select sales_main from seq";

$result_main_seq = pg_query($query_main_seq);

if (!$result_main_seq) {
echo "An error occured.\n";
exit;
		}
while ($rows_main_seq = pg_fetch_array($result_main_seq)){
$main_seq = $rows_main_seq["sales_main"];
}

$query_hotels_sno ="select sales_hotels_sno,cin from sales_hotels where user_sno=$suser_sno and ocode='NC'";

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

$query_trans_sno ="select sales_trans_sno,req_date_time from sales_trans where user_sno=$suser_sno and ocode='NC'";

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

$query_visa_sno ="select sales_visa_sno,req_date_time from sales_visa where user_sno=$suser_sno and ocode='NC'";

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


$query_extra_sno ="select sales_extra_sno,req_date_time from sales_extra where user_sno=$suser_sno and ocode='NC'";

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


echo "<br>";

if($rows_hotels>0 || $rows_trans>0  || $rows_visa>0 || $rows_extra>0){

 $mah = array("M","O","H","A","M","M","E","D","A","B","D","U","L","H","A","F","E","E","Z","7","8","6");

$sdf = array_rand($mah, 3);

  $pnr = $mah[$sdf[0]] . $mah[$sdf[1]] .$mah[$sdf[2]] . strtoupper(base_convert($main_seq, 10, 36));

  $pnr = $main_seq;

//select acccode,aname,country,fax from agentsdet where acccode=?

$query_agent ="select acccode,aname,country,fax,email,title,cname from agentsdet where acccode ='$agentccc'";

$result_agent = pg_query($query_agent);

if (!$result_agent) {
	echo "An error occured.\n";
	exit;
	}


while ($rows_agent = pg_fetch_array($result_agent)){
$agent_acc_code = $rows_agent["acccode"];
$agent_c_name = $rows_agent["aname"];
$agent_country = $rows_agent["country"];
$agent_fax = $rows_agent["fax"];
$agent_email = $rows_agent["email"];

}

$query_user_det ="select user_title,user_first_name,user_last_name from users where user_sno ='$suser_sno'";

$result_user_det = pg_query($query_user_det);

if (!$result_user_det) {
	echo "An error occured.\n";
	exit;
	}


while ($rows_user_det = pg_fetch_array($result_user_det)){
 $s_cptitle = $rows_user_det["user_title"];
 $s_cpname = $rows_user_det["user_first_name"] ." ".$rows_user_det["user_last_name"];
}


}

echo "<br>";

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
$optiondate = date('Y-m-d h:i:00', mktime($bdh,$bdmi,$bds,$bdm,$bdd,$bdy));
}

if($ts3 > 30600 && $ts3 < 86400){

if(date('D', $ts+$ts3)=="Fri"){
$optiondate = date('Y-m-d h:i:00', mktime(14,0,0,$bdm,$bdd-1,$bdy));
}
else {

$optiondate = date('Y-m-d h:i:00', mktime(10,0,0,$bdm,$bdd,$bdy));

}
}

if($ts3 > 86400 && $ts3 < 129600){

if(date('D', $ts+$ts3)=="Fri"){
$optiondate = date('Y-m-d h:i:00', mktime(14,0,0,$bdm,$bdd-1,$bdy));
}
else {

$optiondate = date('Y-m-d h:i:00', mktime(10,0,0,$bdm,$bdd,$bdy));

}
}

if($ts3 > 129600 && $ts3 <  172800){

if(date('D', $ts+$ts3)=="Fri"){
$optiondate = date('Y-m-d h:i:00', mktime(14,0,0,$bdm,$bdd-1,$bdy));
}
else {

$optiondate = date('Y-m-d h:i:00', mktime(10,0,0,$bdm,$bdd,$bdy));

}
}

if($ts3 > 172800){

if(date('D', $ts+$ts3)=="Fri"){

if(date('D', mktime(14,0,0,$cbdm,$cbdd+2,$cbdy))=="Fri"){
$optiondate = date('Y-m-d h:i:00', mktime(14,0,0,$cbdm,$cbdd+1,$cbdy));
}
else {
$optiondate = date('Y-m-d h:i:00', mktime(10,0,0,$cbdm,$cbdd+2,$cbdy));
}
}
else {

if(date('D', mktime(14,0,0,$cbdm,$cbdd+2,$cbdy))=="Fri"){

$optiondate = date('Y-m-d h:i:00', mktime(14,0,0,$cbdm,$cbdd+1,$cbdy));
}
else {
$optiondate = date('Y-m-d h:i:00', mktime(10,0,0,$cbdm,$cbdd+3,$cbdy));
}

}
}

} // end of if $rows_hotels if



 
if($rows_hotels>0 || $rows_trans>0  || $rows_visa>0 || $rows_extra>0){

$sqlinsmain = "insert into sales_main ( main_sno,ocode,user_sno,user_id,guest_title,guest_name,guest_telno,flight_det,guest_notes,order_date,option_date,booking_status,cus_account_code,cus_title,cus_name,cus_company_name,cus_country,cus_contact,cus_email,agent_notes,sales_hotels,sales_trans,sales_visa,sales_others,is_online) values( $main_seq,'$pnr',$suser_sno,'$suserid','$s_gtitle','$s_gname','$s_contactno','$s_flightdet','$s_guestnotes','now','$optiondate','On Request','$agent_acc_code','$s_cptitle','$s_cpname','$agent_c_name','$agent_country','$agent_fax','$agent_email','$s_tanotes',$b_hotel,$b_trans,$b_visa,$b_extra,1 )"; 
pg_query($sqlinsmain);

$sequpdatemain = "update seq set sales_main=sales_main+1";
pg_query($sequpdatemain);

if($rows_hotels>0){
for($i=0;$i<count($s_sales_hotel_sno);$i++){


$s_hotelsmad_hid="";




$query_hotel_s ="select hotel_id,room_id,cin,cout,no_rooms,net_rate,sell_rate from sales_hotels where sales_hotels_sno=$s_sales_hotel_sno[$i]";

$result_hotel_s = pg_query($query_hotel_s);

if (!$result_hotel_s) {
echo "An error occured.\n";
exit;
		}
while ($rows_hotel_s = pg_fetch_array($result_hotel_s)){
$hotel_c_id = $rows_hotel_s["hotel_id"];
$hotel_n_rate = $rows_hotel_s["net_rate"];
$hotel_s_rate = $rows_hotel_s["sell_rate"];
$s_room_id = $rows_hotel_s["room_id"];
$s_cin = $rows_hotel_s["cin"];
$s_cout = $rows_hotel_s["cout"];
$s_no_rooms = $rows_hotel_s["no_rooms"];

$tot_amt = $tot_amt + $hotel_s_rate;
}


$query_hotel ="select hotel_id, hotel_name, city,account_code from hotels where hotel_id='$hotel_c_id'";

$result_hotel = pg_query($query_hotel);

if (!$result_hotel) {
echo "An error occured.\n";
exit;
		}
while ($rows_hotel = pg_fetch_array($result_hotel)){
$hotel_name_dis = $rows_hotel["hotel_name"];
$hotel_city = $rows_hotel["city"];
$supp_account_code=$rows_hotel["account_code"];
}
pg_free_result($result_hotel);


$room_room_type="";
$q_room_subsel ="select room_type  from rooms where room_id=$s_room_id";

$res_room_subsel = pg_query($q_room_subsel);

if (!$res_room_subsel) {
echo "An error occured.\n";
exit;
		}
while ($rows_room_subsel = pg_fetch_array($res_room_subsel)){

$room_room_type = $rows_room_subsel["room_type"];

}


$sqlupdatehotel = "update sales_hotels set main_sno=$main_seq,ocode='$pnr',booking_status='On Request',cus_account_code='$agent_acc_code',supp_account_code='$supp_account_code',order_date='now',option_date='$optiondate',is_online=1 where sales_hotels_sno=$s_sales_hotel_sno[$i]";
pg_query($sqlupdatehotel);


// accounts conn start


$vocno=$main_seq."-H-".$s_sales_hotel_sno[$i];
$vocsno=1;
$ac_nar ="";
$ac_nar = "CR Sales - ". $s_gtitle .". ".$s_gname." - ".$pnr; 	
$ac_nar = substr($ac_nar,0,254);

$ac_md = "Hotel: ".$hotel_name_dis.",".$hotel_city." - C.In:".date('d/M', strtotime($s_cin))." - C.Out:".date('d/M', strtotime($s_cout))." - RoomType:".$s_no_rooms." X ".$room_room_type;
$ac_md = substr($ac_md,0,254);

$sqlinsacc1 = "insert into 	vocmast(voctype,vocno,vocsno,vocdate,acccode,narration,dbamt,cramt,pnr,invno,recon,sinvno,sinvtype,moredet) values('CS','$vocno',$vocsno,'$s_cin','$agent_acc_code','$ac_nar',$hotel_s_rate,0,'$pnr',$main_seq,'f',$s_sales_hotel_sno[$i],'H','$ac_md')"; 
pg_query($sqlinsacc1);

$vocsno++;

$ac_nar="";
$ac_nar = "CR Sales - ". $s_gtitle .". ".$s_gname." - ".$pnr ." - ".$agent_c_name.",". $agent_country;
$ac_nar = substr($ac_nar,0,254);

$sqlinsacc2 = "insert into 	vocmast(voctype,vocno,vocsno,vocdate,acccode,narration,dbamt,cramt,pnr,invno,recon,sinvno,sinvtype,moredet) values('CS','$vocno',$vocsno,'$s_cin','501001','$ac_nar',0,$hotel_s_rate,'$pnr',$main_seq,'f',$s_sales_hotel_sno[$i],'H','$ac_md')"; 
pg_query($sqlinsacc2);

$vocsno=1;
$ac_nar="";
$ac_nar = "CR Purchases - ". $s_gtitle .". ".$s_gname." - ".$pnr;	
$ac_nar = substr($ac_nar,0,254);

$sqlinsacc3 = "insert into vocmast(voctype,vocno,vocsno,vocdate,acccode,narration,dbamt,cramt,pnr,invno,recon,sinvno,sinvtype,moredet) values('PV','$vocno',$vocsno,'$s_cin','600002','$ac_nar',$hotel_n_rate,0,'$pnr',$main_seq,'f',$s_sales_hotel_sno[$i],'H','$ac_md')"; 
pg_query($sqlinsacc3);

$vocsno++;
$ac_nar="";
$ac_nar = "CR Purchases - ". $s_gtitle .". ".$s_gname." - ".$pnr ." - ".$agent_c_name.",". $agent_country;
$ac_nar = substr($ac_nar,0,254);

$sqlinsacc4 = "insert into 	vocmast(voctype,vocno,vocsno,vocdate,acccode,narration,dbamt,cramt,pnr,invno,recon,sinvno,sinvtype,moredet) values('PV','$vocno',$vocsno,'$s_cin','$supp_account_code','$ac_nar',0,$hotel_n_rate,'$pnr',$main_seq,'f',$s_sales_hotel_sno[$i],'H','$ac_md')"; 
pg_query($sqlinsacc4);


// accounts conn end



$sqlupdatemeals = "update sales_meals set ocode='$pnr' where sales_hotels_sno=$s_sales_hotel_sno[$i]";
pg_query($sqlupdatemeals);
}

} // end if of row_hotels

if($rows_trans>0){
for($i=0;$i<count($s_sales_trans_sno);$i++){


$query_trans_t ="select trans_id_s,req_date_time,f2t,type_of_trans,no_of_units,tot_net_rate,tot_sell_rate from sales_trans where sales_trans_sno=$s_sales_trans_sno[$i] ";

$result_trans_t = pg_query($query_trans_t);

if (!$result_trans_t) {
	echo "An error occured.\n";
	exit;
	}
while ($rows_trans_t = pg_fetch_array($result_trans_t)){

$s_req_date_time = $rows_trans_t["req_date_time"];
$s_req_date_time_do = substr($s_req_date_time, 0,10);
$s_f2t = $rows_trans_t["f2t"];
$s_type_of_trans = $rows_trans_t["type_of_trans"];
$s_no_of_units = $rows_trans_t["no_of_units"];

$trans_c_id = $rows_trans_t["trans_id_s"];
$s_tot_net_rate = $rows_trans_t["tot_net_rate"];
$s_tot_sell_rate = $rows_trans_t["tot_sell_rate"];
}


$query_trans ="select trans_id,account_code,trans_c_name,city from s_trans where trans_id='$trans_c_id' ";

$result_trans = pg_query($query_trans);

if (!$result_trans) {
	echo "An error occured.\n";
	exit;
	}
while ($rows_trans = pg_fetch_array($result_trans)){

$trans_c_name = $rows_trans["trans_c_name"];
$city = $rows_trans["city"];
$account_codet = $rows_trans["account_code"];
}

pg_free_result($result_trans);


$sqlupdatetrans = "update sales_trans set main_sno=$main_seq,ocode='$pnr',booking_status='On Request',cus_account_code='$agent_acc_code',supp_account_code='$account_codet',order_date='now',option_date='$optiondate',is_online=1 where sales_trans_sno=$s_sales_trans_sno[$i]";
pg_query($sqlupdatetrans);

// accounts conn start


$vocno=$main_seq."-T-".$s_sales_trans_sno[$i];
$vocsno=1;
$ac_nar ="";
$ac_nar = "CR Sales - ". $s_gtitle .". ".$s_gname." - ".$pnr; 		
$ac_nar = substr($ac_nar,0,254);

$ac_md = $s_no_of_units."X".$s_type_of_trans." - ".$s_f2t." - Req Date:".date('d/M', strtotime($s_req_date_time));
$ac_md = substr($ac_md,0,254);

$sqlinsacc1 = "insert into 	vocmast(voctype,vocno,vocsno,vocdate,acccode,narration,dbamt,cramt,pnr,invno,recon,sinvno,sinvtype,moredet) values('TS','$vocno',$vocsno,'$s_req_date_time_do','$agent_acc_code','$ac_nar',$s_tot_sell_rate,0,'$pnr',$main_seq,'f',$s_sales_trans_sno[$i],'T','$ac_md')"; 
pg_query($sqlinsacc1);

$vocsno++;

$ac_nar="";
$ac_nar = "CR Sales - ". $s_gtitle .". ".$s_gname." - ".$pnr ." - ".$agent_c_name.",". $agent_country;
$ac_nar = substr($ac_nar,0,254);

$ac_md = $trans_c_name." - ".$s_no_of_units."X".$s_type_of_trans." - ".$s_f2t." - Req Date:".date('d/M', strtotime($s_req_date_time));
$ac_md = substr($ac_md,0,254);

$sqlinsacc2 = "insert into 	vocmast(voctype,vocno,vocsno,vocdate,acccode,narration,dbamt,cramt,pnr,invno,recon,sinvno,sinvtype,moredet) values('TS','$vocno',$vocsno,'$s_req_date_time_do','501004','$ac_nar',0,$s_tot_sell_rate,'$pnr',$main_seq,'f',$s_sales_trans_sno[$i],'T','$ac_md')"; 
pg_query($sqlinsacc2);

$vocsno=1;
$ac_nar="";
$ac_nar = "CR Purchases - ". $trans_c_name .", ".$city." - ". $s_gtitle .". ".$s_gname." - ".$pnr; 	
$ac_nar = substr($ac_nar,0,254);

$sqlinsacc3 = "insert into 	vocmast(voctype,vocno,vocsno,vocdate,acccode,narration,dbamt,cramt,pnr,invno,recon,sinvno,sinvtype,moredet) values('TP','$vocno',$vocsno,'$s_req_date_time_do','600005','$ac_nar',$s_tot_net_rate,0,'$pnr',$main_seq,'f',$s_sales_trans_sno[$i],'T','$ac_md')"; 
pg_query($sqlinsacc3);

$vocsno++;
$ac_nar="";
$ac_nar = "CR Purchases - ". $s_gtitle .". ".$s_gname." - ".$pnr ." - ".$agent_c_name.",". $agent_country;
$ac_nar = substr($ac_nar,0,254);

$sqlinsacc4 = "insert into 	vocmast(voctype,vocno,vocsno,vocdate,acccode,narration,dbamt,cramt,pnr,invno,recon,sinvno,sinvtype,moredet) values('TP','$vocno',$vocsno,'$s_req_date_time_do','$account_codet','$ac_nar',0,$s_tot_net_rate,'$pnr',$main_seq,'f',$s_sales_trans_sno[$i],'T','$ac_md')"; 
pg_query($sqlinsacc4);


// accounts conn end


}

} // end if of row_trans

if($rows_visa>0){
for($i=0;$i<count($s_sales_visa_sno);$i++){


$query_visa_t ="select no_adults,no_child,no_infant,tot_net_adults,tot_sell_adults,req_date_time,tot_net_child,tot_sell_child,tot_net_infant,tot_sell_infant from sales_visa where sales_visa_sno=$s_sales_visa_sno[$i] ";

$result_visa_t = pg_query($query_visa_t);

if (!$result_visa_t) {
	echo "An error occured.\n";
	exit;
	}
while ($rows_visa_t = pg_fetch_array($result_visa_t)){

$no_adults = $rows_visa_t["no_adults"];
$no_child = $rows_visa_t["no_child"];
$no_infant = $rows_visa_t["no_infant"];
$s_req_date_time = $rows_visa_t["req_date_time"];

$s_req_date_time_do_v = substr($s_req_date_time, 0,10);

$tot_net_adults= $rows_visa_t["tot_net_adults"];  
$tot_sell_adults= $rows_visa_t["tot_sell_adults"]; 
$tot_net_child= $rows_visa_t["tot_net_child"];  
$tot_sell_child= $rows_visa_t["tot_sell_child"]; 
$tot_net_infant= $rows_visa_t["tot_net_infant"]; 
$tot_sell_infant= $rows_visa_t["tot_sell_infant"];

}

$gtotv_net = $tot_net_adults + $tot_net_child + $tot_net_infant;
$gtotv_sell = $tot_sell_adults + $tot_sell_child + $tot_sell_infant;



$sqlupdatevisa = "update sales_visa set main_sno=$main_seq,ocode='$pnr',booking_status='On Request',cus_account_code='$agent_acc_code',supp_account_code='101123',order_date='now',option_date='$optiondate',is_online=1 where sales_visa_sno=$s_sales_visa_sno[$i]";
pg_query($sqlupdatevisa);


// accounts conn start


$vocno=$main_seq."-V-".$s_sales_visa_sno[$i];
$vocsno=1;
$ac_nar ="";
$ac_nar = "CR Sales - ". $s_gtitle .". ".$s_gname." - ".$pnr; 		
$ac_nar = substr($ac_nar,0,254);

$ac_md =" ";
if($no_adults>0){ $ac_md = $no_adults."X Adults"; }
if($no_child>0){$ac_md = $ac_md . " - ". $no_child. "X Children"; }
if($no_infant>0){$ac_md = $ac_md . " - ". $no_infant."X Infants"; }
$ac_md = substr($ac_md,0,254);


$sqlinsacc1 = "insert into 	vocmast(voctype,vocno,vocsno,vocdate,acccode,narration,dbamt,cramt,pnr,invno,recon,sinvno,sinvtype,moredet) values('US','$vocno',$vocsno,'$s_req_date_time_do_v','$agent_acc_code','$ac_nar',$gtotv_sell,0,'$pnr',$main_seq,'f',$s_sales_visa_sno[$i],'V','$ac_md')"; 
pg_query($sqlinsacc1);

$vocsno++;

$ac_nar="";
$ac_nar = "CR Sales - ". $s_gtitle .". ".$s_gname." - ".$pnr ." - ".$agent_c_name.",". $agent_country;
$ac_nar = substr($ac_nar,0,254);

$sqlinsacc2 = "insert into 	vocmast(voctype,vocno,vocsno,vocdate,acccode,narration,dbamt,cramt,pnr,invno,recon,sinvno,sinvtype,moredet) values('US','$vocno',$vocsno,'$s_req_date_time_do_v','501003','$ac_nar',0,$gtotv_sell,'$pnr',$main_seq,'f',$s_sales_visa_sno[$i],'V','$ac_md')"; 
pg_query($sqlinsacc2);

$vocsno=1;
$ac_nar="";
$ac_nar = "CR Purchase - SABB 021 308 713 001 (Way to Umrah) - ". $s_gtitle .". ".$s_gname." - ".$pnr; 	
$ac_nar = substr($ac_nar,0,254);

$sqlinsacc3 = "insert into vocmast(voctype,vocno,vocsno,vocdate,acccode,narration,dbamt,cramt,pnr,invno,recon,sinvno,sinvtype,moredet) values('UP','$vocno',$vocsno,'$s_req_date_time_do_v','600004','$ac_nar',$gtotv_net,0,'$pnr',$main_seq,'f',$s_sales_visa_sno[$i],'V','$ac_md')"; 
pg_query($sqlinsacc3);

$vocsno++;
$ac_nar="";
$ac_nar = "CR Purchase for - ". $s_gtitle .". ".$s_gname." - ".$pnr ." - ".$agent_c_name.",". $agent_country;
$ac_nar = substr($ac_nar,0,254);

$sqlinsacc4 = "insert into 	vocmast(voctype,vocno,vocsno,vocdate,acccode,narration,dbamt,cramt,pnr,invno,recon,sinvno,sinvtype,moredet) values('UP','$vocno',$vocsno,'$s_req_date_time_do_v','101123','$ac_nar',0,$gtotv_net,'$pnr',$main_seq,'f',$s_sales_visa_sno[$i],'V','$ac_md')"; 
pg_query($sqlinsacc4);


// accounts conn end

}

} // end if of row_visa

if($rows_extra>0){
for($i=0;$i<count($s_sales_extra_sno);$i++){


$query_oth_t ="select net_rate,sell_rate,paticulars,req_date_time from sales_extra where sales_extra_sno=$s_sales_extra_sno[$i] ";

$result_oth_t = pg_query($query_oth_t);

if (!$result_oth_t) {
	echo "An error occured.\n";
	exit;
	}
while ($rows_oth_t = pg_fetch_array($result_oth_t)){
$s_paticulars = $rows_oth_t["paticulars"];
$net_rate= $rows_oth_t["net_rate"];  
$sell_rate= $rows_oth_t["sell_rate"]; 
$s_req_date_time_x= $rows_oth_t["req_date_time"]; 
$s_req_date_time_do_x = substr($s_req_date_time_x, 0,10);
}


$sqlupdateextra = "update sales_extra set main_sno=$main_seq,ocode='$pnr',booking_status='On Request',cus_account_code='$agent_acc_code',supp_account_code='412000',order_date='now',option_date='$optiondate',is_online=1 where sales_extra_sno=$s_sales_extra_sno[$i]";
pg_query($sqlupdateextra);


// accounts conn start


$vocno=$main_seq."-X-".$s_sales_extra_sno[$i];
$vocsno=1;
$ac_nar ="";
$ac_nar = "CR Sales - ". $s_gtitle .". ".$s_gname." - ".$pnr; 	
$ac_nar = substr($ac_nar,0,254);

$ac_md =$s_paticulars;
$ac_md = substr($ac_md,0,254);

$sqlinsacc1 = "insert into 	vocmast(voctype,vocno,vocsno,vocdate,acccode,narration,dbamt,cramt,pnr,invno,recon,sinvno,sinvtype,moredet) values('CS','$vocno',$vocsno,'$s_req_date_time_do_x','$agent_acc_code','$ac_nar',$sell_rate,0,'$pnr',$main_seq,'f',$s_sales_extra_sno[$i],'X','$ac_md')"; 
pg_query($sqlinsacc1);

$vocsno++;

$ac_nar="";
$ac_nar = "CR Sales - ". $s_gtitle .". ".$s_gname." - ".$pnr ." - ".$agent_c_name.",". $agent_country;
$ac_nar = substr($ac_nar,0,254);

$sqlinsacc2 = "insert into 	vocmast(voctype,vocno,vocsno,vocdate,acccode,narration,dbamt,cramt,pnr,invno,recon,sinvno,sinvtype,moredet) values('CS','$vocno',$vocsno,'$s_req_date_time_do_x','501005','$ac_nar',0,$sell_rate,'$pnr',$main_seq,'f',$s_sales_extra_sno[$i],'X','$ac_md')"; 
pg_query($sqlinsacc2);

$vocsno=1;
$ac_nar="";
$ac_nar = "CR Purchase - Extra (Others) Suppliers  - ". $s_gtitle .". ".$s_gname." - ".$pnr;	
$ac_nar = substr($ac_nar,0,254);

$sqlinsacc3 = "insert into vocmast(voctype,vocno,vocsno,vocdate,acccode,narration,dbamt,cramt,pnr,invno,recon,sinvno,sinvtype,moredet) values('PV','$vocno',$vocsno,'$s_req_date_time_do_x','600006','$ac_nar',$net_rate,0,'$pnr',$main_seq,'f',$s_sales_extra_sno[$i],'X','$ac_md')"; 
pg_query($sqlinsacc3);

$vocsno++;
$ac_nar="";
$ac_nar = "CR Purchase for - ". $s_gtitle .". ".$s_gname." - ".$pnr ." - ".$agent_c_name.",". $agent_country;
$ac_nar = substr($ac_nar,0,254);

$sqlinsacc4 = "insert into 	vocmast(voctype,vocno,vocsno,vocdate,acccode,narration,dbamt,cramt,pnr,invno,recon,sinvno,sinvtype,moredet) values('PV','$vocno',$vocsno,'$s_req_date_time_do_x','412000','$ac_nar',0,$net_rate,'$pnr',$main_seq,'f',$s_sales_extra_sno[$i],'X','$ac_md')"; 
pg_query($sqlinsacc4);


// accounts conn end


}

} // end if of row_extras

/*add a record to pnrhistory table*/
$createpnr = "INSERT INTO pnrhistory(user_sno, ocode, description, created_at) VALUES ('$suser_sno', '$pnr', 'New Booking Created with PNR#(".$pnr.") Guest Name:".$s_gtitle.". ".$s_gname." with Total Booking Price:$tot_amt', 'now()')";
pg_query($createpnr);
/*END - add a record to pnrhistory table*/

}


require_once '../../emails/swiftm/lib/swift_required.php';

require_once '../../emails/emailuser.php';

//Create the Transport
$transport = Swift_SmtpTransport::newInstance()
  ->setHost('smtp.gmail.com')
  ->setPort(465)
  ->setEncryption('ssl')
//  ;

//$transport = Swift_SmtpTransport::newInstance('smtp.gmail.com',  587 )
  ->setUsername($euser)
  ->setPassword($epass)
  ;

/*
You could alternatively use a different transport such as Sendmail or Mail:

//Sendmail
$transport = Swift_SendmailTransport::newInstance('/usr/sbin/sendmail -bs');

//Mail
$transport = Swift_MailTransport::newInstance();
*/

//Create the Mailer using your created Transport
$mailer = Swift_Mailer::newInstance($transport);

$mailer1 = Swift_Mailer::newInstance($transport);

$e_body = "New Booking is created with PNR: " . $pnr ;

$subject_s = "DORS - New Booking (" . $pnr . ") is Created  : " . date("r")." (GMT)"; 
//Create a message


$message = Swift_Message::newInstance($subject_s)
  ->setFrom(array('res@daralmanasek.com' => 'DORS - Reservation'))
  ->setTo(array($agent_email))

  ->setBody($e_body, 'text/html')
  ;
sleep(2);

$message1 = Swift_Message::newInstance($subject_s)
  ->setFrom(array('res@daralmanasek.com' => 'DORS - Reservation'))
  ->setTo('res@daralmanasek.com')
  ->setBody($e_body, 'text/html')
  ;  
    
//Send the message
$result = $mailer->send($message);
		
$mailer1->send($message1);	


?>


</td></tr>			
</table>			
</td></tr>
</table>
<table width="100%" height="8%" border="0" cellspacing="0" cellpadding="0" bgcolor="#CAFFCA">
  <tr>
            <td  valign="bottom"  > <img src="../images/bl.jpg" width="9" height="10"></td>
            <td valign="middle"><div align="right"><font size="2" face="Arial, Helvetica, sans-serif"><strong>Please Wait ... &nbsp;</strong></font></div>
              </td>
  </tr>
</table>


</td>
  </tr>
</table>
<?
 $_SESSION['fpnr'] = $pnr;
?>


 <?echo "<script>document.location.href=\"pnrdet.php?spnr=$pnr\"</script>";  ?>
</body>
</center>
