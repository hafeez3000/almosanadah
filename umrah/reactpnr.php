<?
   
include ("header.php");
?>

<script>
document.title= '<? echo $company_name . " ERP - Cancelling PNR"; ?>';
</script>

<html>
<link rel="stylesheet" type="text/css" href="../calendar/css.css" />
<center>
<body leftmargin="0" topmargin="0" rightmargin="0">
<br><br><br>  
<? 


include ("gprocessing.html"); 

$s_pnr = $_GET["spnr"];

$tot_amt = 0;
$s_sell_rate = 0;



$sqlhotopu = "update sales_hotels set booking_status='On Request' where ocode='$s_pnr' "; 
pg_query($conn, $sqlhotopu);


$sqltransopu = "update sales_trans set booking_status='On Request' where ocode='$s_pnr' "; 
pg_query($conn, $sqltransopu);


$sqlvisaopu = "update sales_visa set booking_status='On Request' where ocode='$s_pnr' "; 
pg_query($conn, $sqlvisaopu);

$sqlextraopu = "update sales_extra set booking_status='On Request' where ocode='$s_pnr' "; 
pg_query($conn, $sqlextraopu);


$sqlmainopu = "update sales_main set booking_status='On Request' where ocode='$s_pnr'"; 
pg_query($conn, $sqlmainopu);



$q_main_sel ="select main_sno,ocode,user_sno,user_id,guest_title,guest_name,guest_telno,guest_notes,flight_det,order_date,option_date,booking_status,cus_title,cus_name,cus_company_name,cus_country,cus_account_code,sales_hotels,sales_trans,sales_visa,sales_others from sales_main where ocode='$s_pnr'";

$main_sel = pg_query($conn, $q_main_sel);

$rows_main = pg_num_rows($main_sel);

if (!$main_sel) {
echo "An error occured.\n";
exit;
		}

if($rows_main>0){

//for loop restriction 

$loop_hotel = "select main_sno  from sales_main where ocode='$s_pnr' and booking_status ='Cancelled' ";
$res_loop_hotel = pg_query($conn, $loop_hotel);
$looprc = pg_num_rows($res_loop_hotel);



if($looprc){} else{


/*add a record to pnrhistory table*/
$restransamenda = "INSERT INTO pnrhistory(user_sno, ocode, description, created_at) VALUES ('$suser_sno', '$s_pnr', 'Booking has been reactivated', 'now()')";
pg_query($conn, $restransamenda);
/*END - add a record to pnrhistory table*/

}

echo "<table width=\"100%\" border=\"1\" cellpadding=\"1\" cellspacing=\"0\">";

}

while ($rows_main = pg_fetch_array($main_sel)){
$main_seq = $rows_main["main_sno"];
$s_user_id = $rows_main["user_id"];
$s_gtitle = $rows_main["guest_title"];
$s_gname = $rows_main["guest_name"];
$s_guest_telno = $rows_main["guest_telno"];
$s_guest_notes = $rows_main["guest_notes"];
$s_flight_det = $rows_main["flight_det"];
$s_order_date = $rows_main["order_date"];
$s_option_date = $rows_main["option_date"];
$s_booking_status = $rows_main["booking_status"];
$s_cus_title = $rows_main["cus_title"];
$s_cus_name = $rows_main["cus_name"];
$agent_c_name = $rows_main["cus_company_name"];
$agent_country = $rows_main["cus_country"];
$s_sales_hotels = $rows_main["sales_hotels"];
$s_sales_trans = $rows_main["sales_trans"];
$s_sales_visa = $rows_main["sales_visa"];
$s_sales_others = $rows_main["sales_others"];
$agent_acc_code = $rows_main["cus_account_code"];
}

$q_voc_sel ="select pnr from vocmast where pnr='$s_pnr'";

$voc_sel = pg_query($conn, $q_voc_sel);

$rows_voc = pg_num_rows($voc_sel);


if($s_sales_hotels=="t") {



$q_hotel_sel ="select sales_hotels_sno,user_sno,hotel_id,room_id,cin,cout,no_rooms,no_nights,no_paxs,net_rate,sell_rate,booking_status  from sales_hotels where ocode='$s_pnr' order by sales_hotels_sno";

$res_hotel_sel = pg_query($conn, $q_hotel_sel);

$rows_hotels = pg_num_rows($res_hotel_sel);

if (!$res_hotel_sel) {
echo "An error occured.\n";
exit;
		}

if($rows_hotels>0){


while ($rows_hotel_sel = pg_fetch_array($res_hotel_sel)){
$s_hotels_sno = $rows_hotel_sel["sales_hotels_sno"];
$s_user_sno = $rows_hotel_sel["user_sno"];
$s_hotel_id = $rows_hotel_sel["hotel_id"];
$s_room_id = $rows_hotel_sel["room_id"];
$s_cin = $rows_hotel_sel["cin"];
$s_cout = $rows_hotel_sel["cout"];
$s_no_rooms = $rows_hotel_sel["no_rooms"];
$s_no_nigths = $rows_hotel_sel["no_nights"];
$s_no_paxs = $rows_hotel_sel["no_paxs"];
$hotel_n_rate = $rows_hotel_sel["net_rate"];
$hotel_s_rate = $rows_hotel_sel["sell_rate"];
$s_booking_status = $rows_hotel_sel["booking_status"];

$tot_amt = $tot_amt + $s_sell_rate;

$q_hotel_subsel ="select hotel_name, city,account_code from hotels where hotel_id='$s_hotel_id'";

$res_hotel_subsel = pg_query($conn, $q_hotel_subsel);

if (!$res_hotel_subsel) {
echo "An error occured.\n";
exit;
		}
while ($rows_hotel_subsel = pg_fetch_array($res_hotel_subsel)){

$hotel_name_dis = $rows_hotel_subsel["hotel_name"];
$hotel_city = $rows_hotel_subsel["city"];
$supp_account_code=$rows_hotel_subsel["account_code"];
}

$room_room_type="";
$q_room_subsel ="select room_type  from rooms where room_id='$s_room_id'";

$res_room_subsel = pg_query($conn, $q_room_subsel);

if (!$res_room_subsel) {
echo "An error occured.\n";
exit;
		}
while ($rows_room_subsel = pg_fetch_array($res_room_subsel)){

$room_room_type = $rows_room_subsel["room_type"];

}



// accounts conn start


if($rows_voc>1){}
else {   // else check already exists
$vocno=$main_seq."-H-".$s_hotels_sno;
$vocsno=1;
$ac_nar ="";
$ac_nar = "CR Sales - ". $s_gtitle .". ".$s_gname." - PNR:".$s_pnr; 	
$ac_nar = substr($ac_nar,0,254);

$ac_md = "Hotel: ".$hotel_name_dis.",".$hotel_city." - C.In:".date('d/M', strtotime($s_cin))." - C.Out:".date('d/M', strtotime($s_cout))." - RoomType:".$s_no_rooms." X ".$room_room_type;
$ac_md = substr($ac_md,0,254);

$sqlinsacc1 = "insert into 	vocmast(voctype,vocno,vocsno,vocdate,acccode,narration,dbamt,cramt,pnr,invno,recon,sinvno,sinvtype,moredet) values('CS','$vocno',$vocsno,'$s_cin','$agent_acc_code','$ac_nar',$hotel_s_rate,0,'$s_pnr',$main_seq,'f',$s_hotels_sno,'H','$ac_md')"; 
pg_query($conn, $sqlinsacc1);

$vocsno++;

$ac_nar="";
$ac_nar = "CR Sales - ". $s_gtitle .". ".$s_gname." - PNR:".$s_pnr ." - ".$agent_c_name.",". $agent_country;
$ac_nar = substr($ac_nar,0,254);

$sqlinsacc2 = "insert into 	vocmast(voctype,vocno,vocsno,vocdate,acccode,narration,dbamt,cramt,pnr,invno,recon,sinvno,sinvtype,moredet) values('CS','$vocno',$vocsno,'$s_cin','501001','$ac_nar',0,$hotel_s_rate,'$s_pnr',$main_seq,'f',$s_hotels_sno,'H','$ac_md')"; 
pg_query($conn, $sqlinsacc2);

$vocsno=1;
$ac_nar="";
$ac_nar = "CR Purchases - ". $s_gtitle .", ".$s_gname." - PNR:".$s_pnr; 	
$ac_nar = substr($ac_nar,0,254);

$sqlinsacc3 = "insert into vocmast(voctype,vocno,vocsno,vocdate,acccode,narration,dbamt,cramt,pnr,invno,recon,sinvno,sinvtype,moredet) values('PV','$vocno',$vocsno,'$s_cin','600002','$ac_nar',$hotel_n_rate,0,'$s_pnr',$main_seq,'f',$s_hotels_sno,'H','$ac_md')"; 
pg_query($conn, $sqlinsacc3);

$vocsno++;
$ac_nar="";
$ac_nar = "CR Purchases - ". $s_gtitle .". ".$s_gname." - PNR:".$s_pnr ." - ".$agent_c_name.",". $agent_country;
$ac_nar = substr($ac_nar,0,254);

$sqlinsacc4 = "insert into 	vocmast(voctype,vocno,vocsno,vocdate,acccode,narration,dbamt,cramt,pnr,invno,recon,sinvno,sinvtype,moredet) values('PV','$vocno',$vocsno,'$s_cin','$supp_account_code','$ac_nar',0,$hotel_n_rate,'$s_pnr',$main_seq,'f',$s_hotels_sno,'H','$ac_md')"; 
pg_query($conn, $sqlinsacc4);

}   // else check already exists end
// accounts conn end

}
}

}  // end of if hotels




if($s_sales_trans=="t") {



$q_trans_sel ="select sales_trans_sno,req_date_time,f2t,type_of_trans,no_of_units,no_of_paxs,flight_det,sell_rate,tot_net_rate,tot_sell_rate,booking_status,trans_id_s  from sales_trans where ocode='$s_pnr'  order by req_date_time";

$res_trans_sel = pg_query($conn, $q_trans_sel);

 $rows_trans = pg_num_rows($res_trans_sel);

if (!$res_trans_sel) {
echo "An error occured.\n";
exit;
		}

if($rows_trans>0){



}
while ($rows_trans_sel = pg_fetch_array($res_trans_sel)){

$s_sales_trans_sno = $rows_trans_sel["sales_trans_sno"];
	
$s_req_date_time = $rows_trans_sel["req_date_time"];
$s_req_date_time_do = substr($s_req_date_time, 0,10);
$s_f2t = $rows_trans_sel["f2t"];
$s_type_of_trans = $rows_trans_sel["type_of_trans"];
$s_no_of_units = $rows_trans_sel["no_of_units"];
$s_no_of_paxs = $rows_trans_sel["no_of_paxs"];
$s_flight_det = $rows_trans_sel["flight_det"];
$s_tot_net_rate = $rows_trans_sel["tot_net_rate"];
$s_sell_rate = $rows_trans_sel["sell_rate"];
$s_tot_sell_rate = $rows_trans_sel["tot_sell_rate"];
$s_booking_status = $rows_trans_sel["booking_status"];
$trans_id_s = $rows_trans_sel["trans_id_s"];





$query_trans ="select trans_id,account_code,trans_c_name,city from s_trans where trans_id='$trans_id_s' ";

$result_trans = pg_query($conn, $query_trans);

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


// accounts conn start
if($rows_voc>1){}
else {   // else check already exists

$vocno=$main_seq."-T-".$s_sales_trans_sno;
$vocsno=1;
$ac_nar ="";
$ac_nar = "CR Sales - ". $s_gtitle .". ".$s_gname." - PNR:".$s_pnr; 			
$ac_nar = substr($ac_nar,0,254);

$ac_md = $s_no_of_units."X".$s_type_of_trans." - ".$s_f2t." - Req Date:".date('d/M', strtotime($s_req_date_time));
$ac_md = substr($ac_md,0,254);

$sqlinsacc1 = "insert into 	vocmast(voctype,vocno,vocsno,vocdate,acccode,narration,dbamt,cramt,pnr,invno,recon,sinvno,sinvtype,moredet) values('TS','$vocno',$vocsno,'$s_req_date_time_do','$agent_acc_code','$ac_nar',$s_tot_sell_rate,0,'$s_pnr',$main_seq,'f',$s_sales_trans_sno,'T','$ac_md')"; 
pg_query($conn, $sqlinsacc1);

$vocsno++;

$ac_nar="";
$ac_nar = "CR Sales - ". $s_gtitle .". ".$s_gname." - PNR:".$s_pnr ." - ".$agent_c_name.",". $agent_country;
$ac_nar = substr($ac_nar,0,254);

$ac_md = $trans_c_name." - ".$s_no_of_units."X".$s_type_of_trans." - ".$s_f2t." - Req Date:".date('d/M', strtotime($s_req_date_time));
$ac_md = substr($ac_md,0,254);

$sqlinsacc2 = "insert into 	vocmast(voctype,vocno,vocsno,vocdate,acccode,narration,dbamt,cramt,pnr,invno,recon,sinvno,sinvtype,moredet) values('TS','$vocno',$vocsno,'$s_req_date_time_do','501004','$ac_nar',0,$s_tot_sell_rate,'$s_pnr',$main_seq,'f',$s_sales_trans_sno,'T','$ac_md')"; 
pg_query($conn, $sqlinsacc2);

$vocsno=1;
$ac_nar="";
$ac_nar = "CR Purchases - ". $s_gtitle .". ".$s_gname." - ". $trans_c_name .", ".$city." - PNR:".$s_pnr; 	 	
$ac_nar = substr($ac_nar,0,254);

$sqlinsacc3 = "insert into 	vocmast(voctype,vocno,vocsno,vocdate,acccode,narration,dbamt,cramt,pnr,invno,recon,sinvno,sinvtype,moredet) values('TP','$vocno',$vocsno,'$s_req_date_time_do','600005','$ac_nar',$s_tot_net_rate,0,'$s_pnr',$main_seq,'f',$s_sales_trans_sno,'T','$ac_md')"; 
pg_query($conn, $sqlinsacc3);

$vocsno++;
$ac_nar="";
$ac_nar = "CR Purchases - ". $s_gtitle .". ".$s_gname." - PNR:".$s_pnr ." - ".$agent_c_name.",". $agent_country;
$ac_nar = substr($ac_nar,0,254);

$sqlinsacc4 = "insert into 	vocmast(voctype,vocno,vocsno,vocdate,acccode,narration,dbamt,cramt,pnr,invno,recon,sinvno,sinvtype,moredet) values('TP','$vocno',$vocsno,'$s_req_date_time_do','$account_codet','$ac_nar',0,$s_tot_net_rate,'$s_pnr',$main_seq,'f',$s_sales_trans_sno,'T','$ac_md')"; 
pg_query($conn, $sqlinsacc4);

}   // else check already exists end
// accounts conn end

}




} //end of if trans



if($s_sales_visa=="t") {


$q_visa_sel ="select sales_visa_sno,req_date_time,no_adults,no_child,no_infant,req_date_time,sell_adults,tot_sell_adults,tot_sell_child,tot_sell_infant,tot_net_adults,tot_net_child,tot_net_infant,booking_status from sales_visa where ocode='$s_pnr' order by sales_visa_sno";

$res_visa_sel = pg_query($conn, $q_visa_sel);

$rows_visa = pg_num_rows($res_visa_sel);

if (!$res_visa_sel) {
echo "An error occured.\n";
exit;
		}

if($rows_visa>0){

}
while ($rows_visa_sel = pg_fetch_array($res_visa_sel)){

$s_sales_visa_sno = $rows_visa_sel["sales_visa_sno"];

$no_adults = $rows_visa_sel["no_adults"];
$no_child = $rows_visa_sel["no_child"];
$no_infant = $rows_visa_sel["no_infant"];

$tot_net_adults = $rows_visa_sel["tot_net_adults"];
$tot_net_child = $rows_visa_sel["tot_net_child"];
$tot_net_infant = $rows_visa_sel["tot_net_infant"];
$s_req_date_time = $rows_visa_sel["req_date_time"];

$s_req_date_time_do_v = substr($s_req_date_time, 0,10);

$tot_sell_adults = $rows_visa_sel["tot_sell_adults"];
$tot_sell_child = $rows_visa_sel["tot_sell_child"];
$tot_sell_infant = $rows_visa_sel["tot_sell_infant"];


$gtotv_net = $tot_net_adults + $tot_net_child + $tot_net_infant;
$gtotv_sell = $tot_sell_adults + $tot_sell_child + $tot_sell_infant;

// accounts conn start
if($rows_voc>1){}
else {   // else check already exists

$vocno=$main_seq."-V-".$s_sales_visa_sno;
$vocsno=1;
$ac_nar ="";
$ac_nar = "CR Sales - ". $s_gtitle .". ".$s_gname." - PNR:".$s_pnr; 		
$ac_nar = substr($ac_nar,0,254);


$ac_md =" ";
if($no_adults>0){ $ac_md = $no_adults."X Adults"; }
if($no_child>0){$ac_md = $ac_md . " - ". $no_child. "X Children"; }
if($no_infant>0){$ac_md = $ac_md . " - ". $no_infant."X Infants"; }
$ac_md = substr($ac_md,0,254);

$sqlinsacc1 = "insert into 	vocmast(voctype,vocno,vocsno,vocdate,acccode,narration,dbamt,cramt,pnr,invno,recon,sinvno,sinvtype,moredet) values('US','$vocno',$vocsno,'$s_req_date_time_do_v','$agent_acc_code','$ac_nar',$gtotv_sell,0,'$s_pnr',$main_seq,'f',$s_sales_visa_sno,'V','$ac_md')"; 
pg_query($conn, $sqlinsacc1);

$vocsno++;

$ac_nar="";
$ac_nar = "CR Sales - ". $s_gtitle .". ".$s_gname." - PNR:".$s_pnr ." - ".$agent_c_name.",". $agent_country;
$ac_nar = substr($ac_nar,0,254);

$sqlinsacc2 = "insert into 	vocmast(voctype,vocno,vocsno,vocdate,acccode,narration,dbamt,cramt,pnr,invno,recon,sinvno,sinvtype,moredet) values('US','$vocno',$vocsno,'$s_req_date_time_do_v','501003','$ac_nar',0,$gtotv_sell,'$s_pnr',$main_seq,'f',$s_sales_visa_sno,'V','$ac_md')"; 
pg_query($conn, $sqlinsacc2);

$vocsno=1;
$ac_nar="";
$ac_nar = "CR Purchase - Nusuk Umrah - ". $s_gtitle .". ".$s_gname." - PNR:".$s_pnr; 	
$ac_nar = substr($ac_nar,0,254);

$sqlinsacc3 = "insert into vocmast(voctype,vocno,vocsno,vocdate,acccode,narration,dbamt,cramt,pnr,invno,recon,sinvno,sinvtype,moredet) values('UP','$vocno',$vocsno,'$s_req_date_time_do_v','600004','$ac_nar',$gtotv_net,0,'$s_pnr',$main_seq,'f',$s_sales_visa_sno,'V','$ac_md')"; 
pg_query($conn, $sqlinsacc3);

$vocsno++;
$ac_nar="";
$ac_nar = "CR Purchase for - ". $s_gtitle .". ".$s_gname." - PNR:".$s_pnr ." - ".$agent_c_name.",". $agent_country;
$ac_nar = substr($ac_nar,0,254);

$sqlinsacc4 = "insert into 	vocmast(voctype,vocno,vocsno,vocdate,acccode,narration,dbamt,cramt,pnr,invno,recon,sinvno,sinvtype,moredet) values('UP','$vocno',$vocsno,'$s_req_date_time_do_v','413001','$ac_nar',0,$gtotv_net,'$s_pnr',$main_seq,'f',$s_sales_visa_sno,'V','$ac_md')"; 
pg_query($conn, $sqlinsacc4);

}   // else check already exists end
// accounts conn end

}


} //end of if visa



if($s_sales_others=="t") { // start of extras


$q_extra_sel ="select sales_extra_sno,req_date_time,paticulars,sell_rate,net_rate,booking_status from sales_extra where ocode='$s_pnr' order by sales_extra_sno";

$res_extra_sel = pg_query($conn, $q_extra_sel);

$rows_extra = pg_num_rows($res_extra_sel);

if (!$res_extra_sel) {
echo "An error occured.\n";
exit;
		}

if($rows_extra>0){

}
while ($rows_extra_sel = pg_fetch_array($res_extra_sel)){

$s_sales_extra_sno = $rows_extra_sel["sales_extra_sno"];


$s_paticulars = $rows_extra_sel["paticulars"];
$net_rate = $rows_extra_sel["net_rate"];
$sell_rate = $rows_extra_sel["sell_rate"];
$s_req_date_time_x= $rows_extra_sel["req_date_time"]; 
$s_req_date_time_do_x = substr($s_req_date_time_x, 0,10);

// accounts conn start
if($rows_voc>1){}
else {   // else check already exists

$vocno=$main_seq."-X-".$s_sales_extra_sno;
$vocsno=1;
$ac_nar ="";
$ac_nar = "CR Sales - ". $s_gtitle .". ".$s_gname." - PNR:".$s_pnr;
$ac_nar = substr($ac_nar,0,254);

$ac_md =$s_paticulars;
$ac_md = substr($ac_md,0,254);

$sqlinsacc1 = "insert into 	vocmast(voctype,vocno,vocsno,vocdate,acccode,narration,dbamt,cramt,pnr,invno,recon,sinvno,sinvtype,moredet) values('CS','$vocno',$vocsno,'$s_req_date_time_do_x','$agent_acc_code','$ac_nar',$sell_rate,0,'$s_pnr',$main_seq,'f',$s_sales_extra_sno,'X','$ac_md')"; 
pg_query($conn, $sqlinsacc1);

$vocsno++;

$ac_nar="";
$ac_nar = "CR Sales - ". $s_gtitle .". ".$s_gname." - PNR:".$s_pnr ." - ".$agent_c_name.",". $agent_country;
$ac_nar = substr($ac_nar,0,254);

$sqlinsacc2 = "insert into 	vocmast(voctype,vocno,vocsno,vocdate,acccode,narration,dbamt,cramt,pnr,invno,recon,sinvno,sinvtype,moredet) values('CS','$vocno',$vocsno,'$s_req_date_time_do_x','501005','$ac_nar',0,$sell_rate,'$s_pnr',$main_seq,'f',$s_sales_extra_sno,'X','$ac_md')"; 
pg_query($conn, $sqlinsacc2);

$vocsno=1;
$ac_nar="";
$ac_nar = "CR Purchase - Extra (Others) Suppliers  - ". $s_gtitle .". ".$s_gname." - PNR:".$s_pnr; 	
$ac_nar = substr($ac_nar,0,254);

$sqlinsacc3 = "insert into vocmast(voctype,vocno,vocsno,vocdate,acccode,narration,dbamt,cramt,pnr,invno,recon,sinvno,sinvtype,moredet) values('PV','$vocno',$vocsno,'$s_req_date_time_do_x','600006','$ac_nar',$net_rate,0,'$s_pnr',$main_seq,'f',$s_sales_extra_sno,'X','$ac_md')"; 
pg_query($conn, $sqlinsacc3);

$vocsno++;
$ac_nar="";
$ac_nar = "CR Purchase for - ". $s_gtitle .". ".$s_gname." - PNR:".$s_pnr ." - ".$agent_c_name.",". $agent_country;
$ac_nar = substr($ac_nar,0,254);

$sqlinsacc4 = "insert into 	vocmast(voctype,vocno,vocsno,vocdate,acccode,narration,dbamt,cramt,pnr,invno,recon,sinvno,sinvtype,moredet) values('PV','$vocno',$vocsno,'$s_req_date_time_do_x','412000','$ac_nar',0,$net_rate,'$s_pnr',$main_seq,'f',$s_sales_extra_sno,'X','$ac_md')"; 
pg_query($conn, $sqlinsacc4);


}   // else check already exists end

// accounts conn end
}




} // end of extras



 echo "<script>document.location.href=\"pnrdet.php?spnr=$s_pnr\"</script>"; 

?>
