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


$s_hot_id = $_GET['shot_id'];






$a_hotel_id = array();

$query_hotel ="select hotel_id from hotels where hotel_id='$s_hot_id' ";
$result_hotel = pg_query($conn, $query_hotel);
if (!$result_hotel) {
echo "An error occured.\n";
exit;
}
while ($rows_hotel = pg_fetch_array($result_hotel)){
$hotel_id[] = $rows_hotel["hotel_id"];
//echo "<br>";
}
pg_free_result($result_hotel);



$query_hotel_che ="SELECT relname FROM pg_class WHERE relname = 'rates$s_hot_id'";
$result_hotel_che = pg_query($conn, $query_hotel_che);
$tb_c =   pg_num_rows($result_hotel_che);

if($tb_c==1){}
else{

pg_query($conn, "create table rates$s_hot_id ( rate_sno int8 NOT NULL, room_id varchar(10),   no_of_paxs int2,   rate_date date, avialibility int2,   avial_bool bool,   allotment int2,  PRIMARY KEY (rate_sno))" );

}



for($i=0; $i<count($hotel_id); $i++){    // start of hotel

$querycr = "select room_id, room_type, no_of_paxs from rooms where room_id like '$hotel_id[$i]%' order by room_id"; 
$resultcr = pg_query($conn, $querycr); 

$n_roomid_chk = pg_num_rows($resultcr);

if (!$resultcr) {
	echo "An error occured.\n";
	exit;
	}
while($rowcr = pg_fetch_array($resultcr))
    {

$room_id = $rowcr["room_id"];
$no_of_paxs = $rowcr["no_of_paxs"];

$rc=1;
$dac=-45;
for ( $di=0; $di<500; $di++ ){           


$query_main_del ="select rate_sno from rates$hotel_id[$i] where room_id='$room_id' and rate_date < date 'now' - integer '45' ";
$result_main_del = pg_query($conn, $query_main_del);
$n_check_del = pg_num_rows($result_main_del);

if($n_check_del!=0) {     // deleteing after dates start if

$sqldel = "delete from rates$hotel_id[$i] where room_id='$room_id' and rate_date < date 'now' - integer '45' ";  
$result_del = pg_query($conn, $sqldel);


if($dac<0){  //start if before month

$dacp = -($dac);

$query_main_sno ="select rate_sno from rates$hotel_id[$i] where rate_sno='$room_id$rc' ";
$result_main_sno = pg_query($conn, $query_main_sno);
$n_check = pg_num_rows($result_main_sno);

while ($rows_room_main = pg_fetch_array($result_main_sno)){

$a_rate_id = $rows_room_main["rate_sno"];

}



if($n_check!=0){ 

$sql_up = "update rates$hotel_id[$i] set rate_date=date 'now' - integer '$dacp' where rate_sno='$room_id$rc' "; 
pg_query($conn, $sql_up);


}
else {

$sql = "insert into rates$hotel_id[$i] ( rate_sno,room_id,no_of_paxs,rate_date,avialibility) values ( '$room_id$rc', '$room_id', $no_of_paxs,  date 'now' - integer '$dacp', '0')"; 
$result = pg_query($conn, $sql);

if($result) {
flush();
ob_flush();
//echo "Record(s) inserted";
}
else{
flush();
ob_flush();
//echo "Error in instering";
}

} // end check

$rc++;
}             // end if before month

if($dac>=0){    // start if after now


$query_main_sno ="select rate_sno from rates$hotel_id[$i] where where rate_sno='$room_id$rc' ";
$result_main_sno = pg_query($conn, $query_main_sno);
$n_check = pg_num_rows($result_main_sno);

if($n_check){

$sql_up1 = "update rates$hotel_id[$i] set rate_date=date 'now' + integer '$dac' where rate_sno='$room_id$rc'"; 
pg_query($conn, $sql_up1);

}
else {

$sql = "insert into rates$hotel_id[$i] ( rate_sno,room_id,no_of_paxs,rate_date,avialibility) values ( '$room_id$rc', '$room_id', $no_of_paxs,  date 'now' + integer '$dac', '0')"; 
$result = pg_query($conn, $sql);

if($result) {
	ob_start();
flush();
ob_flush();
ob_end_flush();
//echo "Record(s) inserted";
}
else{

ob_start();
flush();
ob_flush();
ob_end_flush();
//echo "Error in instering";
}

}  // end check

$rc++;

}               // end if after now 




}  // deleteing after dates end if


else {  // deleteing after dates start else


if($dac<0){  //start if before month

$dacp = -($dac);

$query_main_sno ="select rate_sno from rates$hotel_id[$i] where rate_sno='$room_id$rc' ";
$result_main_sno = pg_query($conn, $query_main_sno);
$n_check = pg_num_rows($result_main_sno);

while ($rows_room_main = pg_fetch_array($result_main_sno)){

$a_rate_id = $rows_room_main["rate_sno"];

}


if($n_check!=0){ 

$sql_up = "update rates$hotel_id[$i] set rate_date=date 'now' - integer '$dacp' where rate_sno='$room_id$rc' "; 
pg_query($conn, $sql_up);


}
else {

$sql = "insert into rates$hotel_id[$i] ( rate_sno,room_id,no_of_paxs,rate_date,avialibility) values ( '$room_id$rc', '$room_id', $no_of_paxs,  date 'now' - integer '$dacp', '0')"; 
$result = pg_query($conn, $sql);

if($result) {
flush();
ob_flush();
//echo "Record(s) inserted";
}
else{
flush();
ob_flush();
//echo "Error in instering";
}

} // end check

$rc++;
}             // end if before month


if($dac>=0){    // start if after now


$query_main_sno ="select rate_sno from rates$hotel_id[$i] where  rate_sno='$room_id$rc' ";
$result_main_sno = pg_query($conn, $query_main_sno);
$n_check = pg_num_rows($result_main_sno);

if($n_check){

$sql_up1 = "update rates$hotel_id[$i] set rate_date=date 'now' + integer '$dac' where rate_sno='$room_id$rc'"; 
pg_query($conn, $sql_up1);

}
else {

$sql = "insert into rates$hotel_id[$i] ( rate_sno,room_id,no_of_paxs,rate_date,avialibility) values ( '$room_id$rc', '$room_id', $no_of_paxs,  date 'now' + integer '$dac', '0')"; 
$result = pg_query($conn, $sql);

if($result) {
flush();
ob_flush();
//echo "Record(s) inserted";
}
else{
flush();
ob_flush();
//echo "Error in instering";
}

}  // end check

$rc++;

}               // end if after now 


} // deleteing after dates end else





$dac++;
}

	}



// deleteing extra roomtypes data start

$query_del_extra ="delete from rates$hotel_id[$i] where room_id like '$hotel_id[$i]%' and room_id between $room_id+1 and $room_id+50";
pg_query($conn, $query_del_extra);


// deleteing extra roomtypes data start


}   // end of hotel




echo "<script>document.location.href=\"hroomtype.php?shotid=$s_hot_id\"</script>"; 

?>
