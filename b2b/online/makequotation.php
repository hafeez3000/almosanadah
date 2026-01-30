<?
include ("header.php");

echo "<br><br>";
 
include ("gprocessing.html"); 



session_start();

$n_pax = $_SESSION['ses_npaxs'];

$s_acode =  $_POST["s_acode"];


$query_main_seq ="select quot_main from seq";

$result_main_seq = pg_query($query_main_seq);

if (!$result_main_seq) {
echo "An error occured.\n";
exit;
		}
while ($rows_main_seq = pg_fetch_array($result_main_seq)){
$main_seq = $rows_main_seq["quot_main"];
}


 $mah = array("M","O","H","A","M","M","E","D","A","B","D","U","L","H","A","F","E","E","Z","7","8","6");

$sdf = array_rand($mah, 3);

  $pnr = $mah[$sdf[0]] . $mah[$sdf[1]] .$mah[$sdf[2]] . strtoupper(base_convert($main_seq, 10, 36));
 
 $pnr = $main_seq;


$madhot = $_SESSION['madbull'];
$makhot = $_SESSION['makbull'];
$othot =  $_SESSION['otbull'];

$trans		= $_SESSION['transbull'];
$visa		= $_SESSION['visabull'];
$service	= $_SESSION['servicebull'];
$others1	= $_SESSION['ot1bull'];
$others2	= $_SESSION['ot2bull'];
$others3	= $_SESSION['ot3bull'];





$a_rooms = $_SESSION['s_rooms'];



$a_meals = $_SESSION['s_meals'];




if($madhot=="on"){

$madbf		= 0;
$madhb		= 0;
$madfb		= 0;
$madsahoor	= 0;
$madiftar	= 0;

$s_madbf		= "'N/A'";
$s_madhb		= "'N/A'";
$s_madfb		= "'N/A'";
$s_madsahoor	= "'N/A'";
$s_madiftar		= "'N/A'";

$totrn = array();
$totrs = array();


$madn = $_SESSION['madn'] ;
$madhotid = $_SESSION['madhotid'];

$madcin =  $_SESSION['madcin'];
$madcout =  $_SESSION['madcout'];

$madcinm = $_SESSION['madcinm'];
$madcind = $_SESSION['madcind'];
$madciny = $_SESSION['madciny'];

$madr = $a_rooms;

for($n=0; $n<$madn; $n++){   // for nights start

$f_date = date('Y-m-d', mktime(0,0,0,$madcinm,$madcind+$n,$madciny));




for($me=0;$me<count($a_meals); $me++){

if($a_meals[$me]=="breakfast"){



if(trim($_POST["madbf"][$n])=="INC" || trim($_POST["madbf"][$n])=="NA"){
$madbf = "0";
$s_madbf = "'" . trim($_POST["madbf"][$n]) . "'";

}
else {
$madbf = $_POST["madbf"][$n];
$s_madbf = trim($_POST["madbf"][$n]);
}


}

if($a_meals[$me]=="halfboard"){


if(trim($_POST["madhb"][$n])=="INC" || trim($_POST["madhb"][$n])=="NA"){
$madhb = "0";
$s_madhb = "'".trim($_POST["madhb"][$n]) . "'";
}
else {
$madhb = $_POST["madhb"][$n];
$s_madhb = trim($_POST["madhb"][$n]);
}

}

if($a_meals[$me]=="fullboard"){



if(trim($_POST["madfb"][$n])=="INC" || trim($_POST["madfb"][$n])=="NA"){
$madfb = "0";
$s_madfb = "'".trim($_POST["madfb"][$n]) ."'";
}
else {
$madfb = $_POST["madfb"][$n];
$s_madfb = trim($_POST["madfb"][$n]);
}

}

if($a_meals[$me]=="sahoor"){


if(trim($_POST["madsahoor"][$n])=="INC" || trim($_POST["madsahoor"][$n])=="NA"){
$s_madsahoor = "'" . trim($_POST["madsahoor"][$n]) . "'";
$madsahoor = "0";
}
else {
$madsahoor = $_POST["madsahoor"][$n];
$s_madsahoor = trim($_POST["madsahoor"][$n]);
}


}

if($a_meals[$me]=="iftar"){



if(trim($_POST["madiftar"][$n])=="INC" || trim($_POST["madiftar"][$n])=="NA"){
$madiftar = "0";
$s_madiftar = "'" . trim($_POST["madiftar"][$n]) . "'";

}
else {
$madiftar = $_POST["madiftar"][$n];
$s_madiftar = trim($_POST["madiftar"][$n]);
}


}

} //end for meals

 $totmeals  = $madbf + $madhb + $madfb + $madsahoor + $madiftar; 


for($i=0; $i<count($madr); $i++){
$roomn = $madr[$i];
${nr.$roomn} = $_POST["madnr".$madr[$i]][$n];
${sr.$roomn} = $_POST["madsr".$madr[$i]][$n];
}

$ratenm="";
$ratesm="";
for($st=0; $st<count($madr); $st++){
$nr="nr";
$sr="sr";
$roomn = $madr[$st];
$ratenm = $ratenm.${$nr . $roomn}.",";
$ratesm = $ratesm.${$sr . $roomn}.",";
}



$qins_meals =  $s_madbf .",". $s_madhb .",". $s_madfb .",". $s_madsahoor .",".  $s_madiftar.","; 



for($i=0; $i<count($madr); $i++){
$roomnt = $madr[$i];
${nr.$roomnt} = $_POST["madnr".$madr[$i]][$n]+($totmeals*$roomnt);
${sr.$roomnt} = $_POST["madsr".$madr[$i]][$n]+($totmeals*$roomnt);
}

$ratenwm="";
$rateswm="";

for($st=0; $st<count($madr); $st++){
$nr="nr";
$sr="sr";
$roomnt = $madr[$st];
$ratenwm = $ratenwm . ${$nr . $roomnt}.",";
$rateswm = $rateswm . ${$sr . $roomnt}.",";
}

//echo "net_rate" . $ratenwm   ;
//echo "sell_rate" . $rateswm   ;

$qsc_ins = $ratenm.$ratesm.$qins_meals.$ratenwm.$rateswm ; 



$sq_n="";
$sq_s="";
$sq_dn="";
$sq_ds="";

for($st=0; $st<count($madr); $st++){
$sq_n = $sq_n . "net_rate_r".$madr[$st].",";
$sq_s = $sq_s . "sell_rate_r".$madr[$st].",";
$sq_dn = $sq_dn . "day_net_rate_r".$madr[$st].",";
$sq_ds = $sq_ds . "day_sell_rate_r".$madr[$st].",";

}


$qmeals="";
for($qm=0;$qm<count($a_meals);$qm++){
$qmeals  = $qmeals . $a_meals[$qm].",";
}

 $qsc = $sq_n.$sq_s."breakfast,halfboard,fullboard,sahoor,iftar,".$sq_dn.$sq_ds;


$query_hotel_seq ="select quot_hotel from seq";

$result_hotel_seq = pg_query($query_hotel_seq);

if (!$result_hotel_seq) {
echo "An error occured.\n";
exit;
		}
while ($rows_hotel_seq = pg_fetch_array($result_hotel_seq)){
$hotel_seq = $rows_hotel_seq["quot_hotel"];
}


$query_meals_seq ="select quot_meals from seq";

$result_meals_seq = pg_query($query_meals_seq);

if (!$result_meals_seq) {
echo "An error occured.\n";
exit;
		}
while ($rows_meals_seq = pg_fetch_array($result_meals_seq)){
$meals_seq = $rows_meals_seq["quot_meals"];
}




$sqlinsmeals = "insert into quot_meals(quot_meals_sno, quot_hotels_sno,quot_hot_meals_sno,ocode,user_sno,rate_date," . $qsc . "no_of_paxs) values($meals_seq,$hotel_seq,$n+1,'$pnr',$suser_sno,'$f_date'," . $qsc_ins . "$n_pax)"; 
pg_query($sqlinsmeals);

$sequpdat_quot_meals = "update seq set quot_meals=quot_meals+1";
pg_query($sequpdat_quot_meals);


} // for nights end


$hoten="";
$hotes="";

for($ro=0; $ro<count($madr); $ro++){
$roomn = $madr[$ro];
$nr="nr";
$sr="sr";



$totnr = 0;
$totsr = 0;
for($ni=0; $ni<$madn; $ni++){
$roomnt = $madr[$ro];
$totnr = $totnr + $_POST["madnr".$roomnt][$ni]+($totmeals*$roomnt);
$totsr = $totsr + $_POST["madsr".$roomnt][$ni]+($totmeals*$roomnt);

}

$hoten = $hoten . $totnr.",";
$hotes = $hotes . $totsr.",";
}

$query_hotel_acc ="select account_code from hotels where hotel_id='$madhotid'";

$result_hotel_acc = pg_query($query_hotel_acc);

if (!$result_hotel_acc) {
echo "An error occured.\n";
exit;
		}
while ($rows_hotel_acc = pg_fetch_array($result_hotel_acc)){
$hotel_acc = $rows_hotel_acc["account_code"];
}

$sqlinshotel = "insert into quot_hotels(quot_hotels_sno, main_sno,ocode,user_sno,user_id,hotel_id,cin,cout,no_nights,no_paxs," . $sq_n . $sq_s . "cus_account_code,supp_account_code, order_date) values($hotel_seq,$main_seq,'$pnr',$suser_sno,'$suserid','$madhotid','$madcin','$madcout',$madn,$n_pax," . $hoten . $hotes . "'$s_acode','$hotel_acc', 'now()' )"; 
pg_query($sqlinshotel);

$sequpdat_quot_hotel = "update seq set quot_hotel=quot_hotel+1";
pg_query($sequpdat_quot_hotel);


} // end if of madinah hotel






if($makhot=="on"){     //start of makkah hotel

$makbf		= 0;
$makhb		= 0;
$makfb		= 0;
$maksahoor	= 0;
$makiftar	= 0;

$s_makbf		= "'N/A'";
$s_makhb		= "'N/A'";
$s_makfb		= "'N/A'";
$s_maksahoor	= "'N/A'";
$s_makiftar		= "'N/A'";

$totrn = array();
$totrs = array();


$makn = $_SESSION['makn'] ;
$makhotid = $_SESSION['makhotid'];

$makcin =  $_SESSION['makcin'];
$makcout =  $_SESSION['makcout'];

$makcinm = $_SESSION['makcinm'];
$makcind = $_SESSION['makcind'];
$makciny = $_SESSION['makciny'];

$makr = $a_rooms;

for($n=0; $n<$makn; $n++){   // for nights start


 $f_date = date('Y-m-d', mktime(0,0,0,$makcinm,$makcind+$n,$makciny));




for($me=0;$me<count($a_meals); $me++){

if($a_meals[$me]=="breakfast"){



if(trim($_POST["makbf"][$n])=="INC" || trim($_POST["makbf"][$n])=="NA"){
$makbf = "0";
$s_makbf = "'".trim($_POST["makbf"][$n])."'";
}
else {
$makbf = $_POST["makbf"][$n];
$s_makbf = trim($_POST["makbf"][$n]);
}

}

if($a_meals[$me]=="halfboard"){

if(trim($_POST["makhb"][$n])=="INC" || trim($_POST["makhb"][$n])=="NA"){
$makhb = "0";
$s_makhb = "'".trim($_POST["makhb"][$n])."'";
}
else {
$makhb = $_POST["makhb"][$n];
$s_makhb = trim($_POST["makhb"][$n]);
}

}

if($a_meals[$me]=="fullboard"){

if(trim($_POST["makfb"][$n])=="INC" || trim($_POST["makfb"][$n])=="NA"){
$makfb = "0";
$s_makfb = "'".trim($_POST["makfb"][$n])."'";
}
else {
$makfb = $_POST["makfb"][$n];
$s_makfb = trim($_POST["makfb"][$n]);
}

}

if($a_meals[$me]=="sahoor"){


if(trim($_POST["maksahoor"][$n])=="INC" || trim($_POST["maksahoor"][$n])=="NA"){
$maksahoor = "0";
$s_maksahoor = "'".trim($_POST["maksahoor"][$n])."'";
}
else {
$maksahoor = $_POST["maksahoor"][$n];
$s_maksahoor = trim($_POST["maksahoor"][$n]);
}


}

if($a_meals[$me]=="iftar"){



if(trim($_POST["makiftar"][$n])=="INC" || trim($_POST["makiftar"][$n])=="NA"){
$makiftar = "0";
$s_makiftar = "'".trim($_POST["makiftar"][$n])."'";
}
else {
$makiftar = $_POST["makiftar"][$n];
$s_makiftar = trim($_POST["makiftar"][$n]);
}


}

} //end for meals

$totmeals  = $makbf + $makhb + $makfb + $maksahoor + $makiftar; 



for($i=0; $i<count($makr); $i++){
$roomn = $makr[$i];
${nr.$roomn} = $_POST["maknr".$makr[$i]][$n];
${sr.$roomn} = $_POST["maksr".$makr[$i]][$n];
}

$ratenm="";
$ratesm="";
for($st=0; $st<count($makr); $st++){
$nr="nr";
$sr="sr";
$roomn = $makr[$st];
$ratenm = $ratenm.${$nr . $roomn}.",";
$ratesm = $ratesm.${$sr . $roomn}.",";
}


$qins_meals = $s_makbf . "," . $s_makhb . ",". $s_makfb . ",". $s_maksahoor . ",". $s_makiftar. ","; 


for($i=0; $i<count($makr); $i++){
$roomnt = $makr[$i];
${nr.$roomnt} = $_POST["maknr".$makr[$i]][$n]+($totmeals*$roomnt);
${sr.$roomnt} = $_POST["maksr".$makr[$i]][$n]+($totmeals*$roomnt);
}

$ratenwm="";
$rateswm="";

for($st=0; $st<count($makr); $st++){
$nr="nr";
$sr="sr";
$roomnt = $makr[$st];
$ratenwm = $ratenwm . ${$nr . $roomnt}.",";
$rateswm = $rateswm . ${$sr . $roomnt}.",";
}

//echo "net_rate" . $ratenwm   ;
//echo "sell_rate" . $rateswm   ;

$qsc_ins = $ratenm.$ratesm.$qins_meals.$ratenwm.$rateswm ; 



$sq_n="";
$sq_s="";
$sq_dn="";
$sq_ds="";

for($st=0; $st<count($makr); $st++){
$sq_n = $sq_n . "net_rate_r".$makr[$st].",";
$sq_s = $sq_s . "sell_rate_r".$makr[$st].",";
$sq_dn = $sq_dn . "day_net_rate_r".$makr[$st].",";
$sq_ds = $sq_ds . "day_sell_rate_r".$makr[$st].",";

}


$qmeals="";
for($qm=0;$qm<count($a_meals);$qm++){
$qmeals  = $qmeals . $a_meals[$qm].",";
}

$qsc = $sq_n.$sq_s."breakfast,halfboard,fullboard,sahoor,iftar,".$sq_dn.$sq_ds;


$query_hotel_seq ="select quot_hotel from seq";

$result_hotel_seq = pg_query($query_hotel_seq);

if (!$result_hotel_seq) {
echo "An error occured.\n";
exit;
		}
while ($rows_hotel_seq = pg_fetch_array($result_hotel_seq)){
$hotel_seq = $rows_hotel_seq["quot_hotel"];
}


$query_meals_seq ="select quot_meals from seq";

$result_meals_seq = pg_query($query_meals_seq);

if (!$result_meals_seq) {
echo "An error occured.\n";
exit;
		}
while ($rows_meals_seq = pg_fetch_array($result_meals_seq)){
$meals_seq = $rows_meals_seq["quot_meals"];
}


$sqlinsmeals = "insert into quot_meals(quot_meals_sno, quot_hotels_sno,quot_hot_meals_sno,ocode,user_sno,rate_date," . $qsc . "no_of_paxs) values($meals_seq,$hotel_seq,$n+1,'$pnr',$suser_sno,'$f_date'," . $qsc_ins . "$n_pax)"; 
pg_query($sqlinsmeals);

$sequpdat_quot_meals = "update seq set quot_meals=quot_meals+1";
pg_query($sequpdat_quot_meals);


} // for nights end


$hoten="";
$hotes="";


for($ro=0; $ro<count($makr); $ro++){
$roomn = $makr[$ro];
$nr="nr";
$sr="sr";

$totnr = 0;
$totsr = 0;
for($ni=0; $ni<$makn; $ni++){
$roomnt = $makr[$ro];
$totnr = $totnr + $_POST["maknr".$roomnt][$ni]+($totmeals*$roomnt);
$totsr = $totsr + $_POST["maksr".$roomnt][$ni]+($totmeals*$roomnt);

}

$hoten = $hoten . $totnr.",";
$hotes = $hotes . $totsr.",";
}

$query_hotel_acc ="select account_code from hotels where hotel_id='$makhotid'";

$result_hotel_acc = pg_query($query_hotel_acc);

if (!$result_hotel_acc) {
echo "An error occured.\n";
exit;
		}
while ($rows_hotel_acc = pg_fetch_array($result_hotel_acc)){
$hotel_acc = $rows_hotel_acc["account_code"];
}


$sqlinshotel = "insert into quot_hotels(quot_hotels_sno, main_sno,ocode,user_sno,user_id,hotel_id,cin,cout,no_nights,no_paxs," . $sq_n . $sq_s . "cus_account_code,supp_account_code,order_date) values($hotel_seq,$main_seq,'$pnr',$suser_sno,'$suserid','$makhotid','$makcin','$makcout',$makn,$n_pax," . $hoten . $hotes . "'$s_acode','$hotel_acc', 'now')"; 
pg_query($sqlinshotel);

$sequpdat_quot_hotel = "update seq set quot_hotel=quot_hotel+1";
pg_query($sequpdat_quot_hotel);


} // end if of makkah hotel



if($othot=="on"){     //start of other hotel

$otbf		= 0;
$othb		= 0;
$otfb		= 0;
$otsahoor	= 0;
$otiftar	= 0;

$s_otbf		= "'N/A'";
$s_othb		= "'N/A'";
$s_otfb		= "'N/A'";
$s_otsahoor	= "'N/A'";
$s_otiftar	= "'N/A'";

$totrn = array();
$totrs = array();


$othn = $_SESSION['othn'] ;
$othotid = $_SESSION['othotid'];

$otcin =  $_SESSION['otcin'];
$otcout =  $_SESSION['otcout'];

$otcinm = $_SESSION['otcinm'];
$otcind = $_SESSION['otcind'];
$otciny = $_SESSION['otciny'];

$otr = $a_rooms;



for($n=0; $n<$othn; $n++){   // for nights start


 $f_date = date('Y-m-d', mktime(0,0,0,$otcinm,$otcind+$n,$otciny));




for($me=0;$me<count($a_meals); $me++){

if($a_meals[$me]=="breakfast"){


if(trim($_POST["otbf"][$n])=="INC" || trim($_POST["otbf"][$n])=="NA"){
$otbf = "0";
$s_otbf = "'".trim($_POST["otbf"][$n])."'";
}
else {
$otbf = $_POST["otbf"][$n];
$s_otbf = trim($_POST["otbf"][$n]);
}

}

if($a_meals[$me]=="halfboard"){

if(trim($_POST["othb"][$n])=="INC" || trim($_POST["othb"][$n])=="NA"){
$othb = "0";
$s_othb = "'".trim($_POST["othb"][$n])."'";
}
else {
$othb = $_POST["othb"][$n];
$s_othb = trim($_POST["othb"][$n]);
}

}

if($a_meals[$me]=="fullboard"){

if(trim($_POST["otfb"][$n])=="INC" || trim($_POST["otfb"][$n])=="NA"){
$otfb = "0";
$s_otfb = "'".trim($_POST["otfb"][$n])."'";
}
else {
$otfb = $_POST["otfb"][$n];
$s_otfb = trim($_POST["otfb"][$n]);
}

}

if($a_meals[$me]=="sahoor"){

if(trim($_POST["otsahoor"][$n])=="INC" || trim($_POST["otsahoor"][$n])=="NA"){
$otsahoor = "0";
$s_otsahoor = "'".trim($_POST["otsahoor"][$n])."'";
}
else {
$otsahoor = $_POST["otsahoor"][$n];
$s_otsahoor = trim($_POST["otsahoor"][$n]);
}


}

if($a_meals[$me]=="iftar"){

if(trim($_POST["otiftar"][$n])=="INC" || trim($_POST["otiftar"][$n])=="NA"){
$otiftar = "0";
$s_otiftar = "'".trim($_POST["otiftar"][$n])."'";
}
else {
$otiftar = $_POST["otiftar"][$n];
$s_otiftar = trim($_POST["otiftar"][$n]);
}


}

} //end for meals

$totmeals  = $otbf + $othb + $otfb + $otsahoor + $otiftar; 



for($i=0; $i<count($otr); $i++){
$roomn = $otr[$i];
${nr.$roomn} = $_POST["otnr".$otr[$i]][$n];
${sr.$roomn} = $_POST["otsr".$otr[$i]][$n];
}

$ratenm="";
$ratesm="";
for($st=0; $st<count($otr); $st++){
$nr="nr";
$sr="sr";
$roomn = $otr[$st];
$ratenm = $ratenm.${$nr . $roomn}.",";
$ratesm = $ratesm.${$sr . $roomn}.",";
}


$qins_meals =  $s_otbf . "," . $s_othb . ",". $s_otfb . ",". $s_otsahoor . ",". $s_otiftar. ","; 


for($i=0; $i<count($otr); $i++){
$roomnt = $otr[$i];
${nr.$roomnt} = $_POST["otnr".$otrr[$i]][$n]+($totmeals*$roomnt);
${sr.$roomnt} = $_POST["otsr".$otr[$i]][$n]+($totmeals*$roomnt);
}

$ratenwm="";
$rateswm="";

for($st=0; $st<count($otr); $st++){
$nr="nr";
$sr="sr";
$roomnt = $otr[$st];
$ratenwm = $ratenwm . ${$nr . $roomnt}.",";
$rateswm = $rateswm . ${$sr . $roomnt}.",";
}

//echo "net_rate" . $ratenwm   ;
//echo "sell_rate" . $rateswm   ;

$qsc_ins = $ratenm.$ratesm.$qins_meals.$ratenwm.$rateswm ; 



$sq_n="";
$sq_s="";
$sq_dn="";
$sq_ds="";

for($st=0; $st<count($otr); $st++){
$sq_n = $sq_n . "net_rate_r".$otr[$st].",";
$sq_s = $sq_s . "sell_rate_r".$otr[$st].",";
$sq_dn = $sq_dn . "day_net_rate_r".$otr[$st].",";
$sq_ds = $sq_ds . "day_sell_rate_r".$otr[$st].",";

}


$qmeals="";
for($qm=0;$qm<count($a_meals);$qm++){
$qmeals  = $qmeals . $a_meals[$qm].",";
}

$qsc = $sq_n.$sq_s."breakfast,halfboard,fullboard,sahoor,iftar,".$sq_dn.$sq_ds;


$query_hotel_seq ="select quot_hotel from seq";

$result_hotel_seq = pg_query($query_hotel_seq);

if (!$result_hotel_seq) {
echo "An error occured.\n";
exit;
		}
while ($rows_hotel_seq = pg_fetch_array($result_hotel_seq)){
$hotel_seq = $rows_hotel_seq["quot_hotel"];
}


$query_meals_seq ="select quot_meals from seq";

$result_meals_seq = pg_query($query_meals_seq);

if (!$result_meals_seq) {
echo "An error occured.\n";
exit;
		}
while ($rows_meals_seq = pg_fetch_array($result_meals_seq)){
$meals_seq = $rows_meals_seq["quot_meals"];
}


$sqlinsmeals = "insert into quot_meals(quot_meals_sno, quot_hotels_sno,quot_hot_meals_sno,ocode,user_sno,rate_date," . $qsc . "no_of_paxs) values($meals_seq,$hotel_seq,$n+1,'$pnr',$suser_sno,'$f_date'," . $qsc_ins . "$n_pax)"; 
pg_query($sqlinsmeals);

$sequpdat_quot_meals = "update seq set quot_meals=quot_meals+1";
pg_query($sequpdat_quot_meals);


} // for nights end


$hoten="";
$hotes="";


for($ro=0; $ro<count($otr); $ro++){
$roomn = $otr[$ro];
$nr="nr";
$sr="sr";

$totnr = 0;
$totsr = 0;
for($ni=0; $ni<$othn; $ni++){
$roomnt = $otr[$ro];
$totnr = $totnr + $_POST["otnr".$roomnt][$ni]+($totmeals*$roomnt);
$totsr = $totsr + $_POST["otsr".$roomnt][$ni]+($totmeals*$roomnt);

}

$hoten = $hoten . $totnr.",";
$hotes = $hotes . $totsr.",";
}

$query_hotel_acc ="select account_code from hotels where hotel_id='$othotid'";

$result_hotel_acc = pg_query($query_hotel_acc);

if (!$result_hotel_acc) {
echo "An error occured.\n";
exit;
		}
while ($rows_hotel_acc = pg_fetch_array($result_hotel_acc)){
$hotel_acc = $rows_hotel_acc["account_code"];
}



$sqlinshotel = "insert into quot_hotels(quot_hotels_sno, main_sno,ocode,user_sno,user_id,hotel_id,cin,cout,no_nights,no_paxs," . $sq_n . $sq_s . "cus_account_code,supp_account_code,order_date) values($hotel_seq,$main_seq,'$pnr',$suser_sno,'$suserid','$othotid','$otcin','$otcout',$othn,$n_pax," . $hoten . $hotes . "'$s_acode','$hotel_acc', 'now()')"; 
pg_query($sqlinshotel);

$sequpdat_quot_hotel = "update seq set quot_hotel=quot_hotel+1";
pg_query($sequpdat_quot_hotel);


} // end if of other hotel


if($trans=="on"){  //start of trans

 $transreq = $_SESSION['transreq'];

$trans_s = $_SESSION['trans_s'];

$trans_f2t = $_SESSION['trans_f2t'];

$trans_toft = $_SESSION['trans_toft'];

$trans_fd = $_SESSION['trans_fd'];

$trans_nu = $_SESSION['trans_nu'];



$i_transrn =  $_POST["transrn"];

$i_transr = $_POST["transr"];


$query_trans_seq ="select quot_trans from seq";

$result_trans_seq = pg_query($query_trans_seq);

if (!$result_trans_seq) {
echo "An error occured.\n";
exit;
		}
while ($rows_trans_seq = pg_fetch_array($result_trans_seq)){
$trans_seq = $rows_trans_seq["quot_trans"];
}





$sqlinstrans = "insert into quot_trans(quot_trans_sno,main_sno,ocode,user_sno,user_id,req_date_time,f2t,type_of_trans,no_of_units,no_of_paxs,flight_det,net_rate,sell_rate,tot_net_rate,tot_sell_rate,order_date,cus_account_code,supp_account_code) values($trans_seq,$main_seq,'$pnr',$suser_sno,'$suserid','$transreq','$trans_f2t','$trans_toft',$trans_nu,$n_pax,'$trans_fd',$i_transrn,$i_transr,$i_transrn*$trans_nu,$i_transr*$trans_nu,'now()',$s_acode,$trans_s)"; 
pg_query($sqlinstrans);

$sequpdat_quot_trans = "update seq set quot_trans=quot_trans+1";
pg_query($sequpdat_quot_trans);



}  //end of trans





if($visa=="on"){  //start of visa

$visareq=$_SESSION['visareq'];

$query_visa_seq ="select quot_visa from seq";

$result_visa_seq = pg_query($query_visa_seq);

if (!$result_visa_seq) {
echo "An error occured.\n";
exit;
		}
while ($rows_visa_seq = pg_fetch_array($result_visa_seq)){
$visa_seq = $rows_visa_seq["quot_visa"];
}


$vnet = $_POST["vnet"];
$vsell = $_POST["vsell"];



$sqlinsvisa = "insert into quot_visa(quot_visa_sno,main_sno,ocode,user_sno,user_id,req_date_time,no_adults,net_adults,sell_adults,tot_net_adults,tot_sell_adults,order_date,cus_account_code,supp_account_code) values($visa_seq,$main_seq,'$pnr',$suser_sno,'$suserid','$visareq',$n_pax,$vnet,$vsell,$vnet*$n_pax,$vsell*$n_pax,'now()',$s_acode,600154)"; 
pg_query($sqlinsvisa);

$sequpdat_quot_visa = "update seq set quot_visa=quot_visa+1";
pg_query($sequpdat_quot_visa);



}  //end of visa


if($service=="on"){  //start of service


$query_extra_seq ="select quot_extra from seq";

$result_extra_seq = pg_query($query_extra_seq);

if (!$result_extra_seq) {
echo "An error occured.\n";
exit;
		}
while ($rows_extra_seq = pg_fetch_array($result_extra_seq)){
$extra_seq = $rows_extra_seq["quot_extra"];
}

 $scnet = $_POST["scnet"];
 $scsell = $_POST["scsell"];

$sqlinsextra = "insert into quot_extra(quot_extra_sno,main_sno,ocode,user_sno,user_id,no_paxs,paticulars,net_rate,sell_rate,tot_net_rate,tot_sell_rate,order_date,cus_account_code,supp_account_code,service_bull) values($extra_seq,$main_seq,'$pnr',$suser_sno,'$suserid',$n_pax,'Service Charges',$scnet,$scsell,$scnet*$n_pax,$scsell*$n_pax,'now()',$s_acode,600154,true)"; 
pg_query($sqlinsextra);

$sequpdat_quot_extra = "update seq set quot_extra=quot_extra+1";
pg_query($sequpdat_quot_extra);



}  //end of service


if($others1=="on"){  //start of others1


$query_extra_seq ="select quot_extra from seq";

$result_extra_seq = pg_query($query_extra_seq);

if (!$result_extra_seq) {
echo "An error occured.\n";
exit;
		}
while ($rows_extra_seq = pg_fetch_array($result_extra_seq)){
$extra_seq = $rows_extra_seq["quot_extra"];
}

$ex1d = $_POST['dDay'];
$ex1m = $_POST['dMonth'];
$ex1y = $_POST['dYear'];

$ex1date = $ex1y."-".$ex1m."-".$ex1d;

$ex1desc = $_POST['ex1pat'];

$ex1net = $_POST['ex1net'];
$ex1sell = $_POST['ex1sell'];


$sqlinsextra1 = "insert into quot_extra(quot_extra_sno,main_sno,ocode,user_sno,user_id,req_date_time,no_paxs,paticulars,net_rate,sell_rate,tot_net_rate,tot_sell_rate,order_date,cus_account_code,supp_account_code) values($extra_seq,$main_seq,'$pnr',$suser_sno,'$suserid','$ex1date', $n_pax,'$ex1desc',$ex1net,$ex1sell,$ex1net*$n_pax,$ex1sell*$n_pax,'now()',$s_acode,600154)"; 
pg_query($sqlinsextra1);

$sequpdat_quot_extra1 = "update seq set quot_extra=quot_extra+1";
pg_query($sequpdat_quot_extra1);



}  //end of others1

if($others2=="on"){  //start of others2

$query_extra_seq ="select quot_extra from seq";

$result_extra_seq = pg_query($query_extra_seq);

if (!$result_extra_seq) {
echo "An error occured.\n";
exit;
		}
while ($rows_extra_seq = pg_fetch_array($result_extra_seq)){
$extra_seq = $rows_extra_seq["quot_extra"];
}

$ex2d = $_POST['d1Day'];
$ex2m = $_POST['d1Month'];
$ex2y = $_POST['d1Year'];

$ex2date = $ex2y."-".$ex2m."-".$ex2d;

$ex2desc = $_POST['ex2pat'];

$ex2net = $_POST['ex2net'];
$ex2sell = $_POST['ex2sell'];


$sqlinsextra2 = "insert into quot_extra(quot_extra_sno,main_sno,ocode,user_sno,user_id,req_date_time,no_paxs,paticulars,net_rate,sell_rate,tot_net_rate,tot_sell_rate,order_date,cus_account_code,supp_account_code) values($extra_seq,$main_seq,'$pnr',$suser_sno,'$suserid','$ex2date', $n_pax,'$ex2desc',$ex2net,$ex2sell,$ex2net*$n_pax,$ex2sell*$n_pax,'now()',$s_acode,600154)"; 
pg_query($sqlinsextra2);

$sequpdat_quot_extra2 = "update seq set quot_extra=quot_extra+1";
pg_query($sequpdat_quot_extra2);


}  //end of others2

if($others3=="on"){  //start of others3

$query_extra_seq ="select quot_extra from seq";

$result_extra_seq = pg_query($query_extra_seq);

if (!$result_extra_seq) {
echo "An error occured.\n";
exit;
		}
while ($rows_extra_seq = pg_fetch_array($result_extra_seq)){
$extra_seq = $rows_extra_seq["quot_extra"];
}

$ex3d = $_POST['d2Day'];
$ex3m = $_POST['d2Month'];
$ex3y = $_POST['d2Year'];

$ex3date = $ex3y."-".$ex3m."-".$ex3d;

$ex3desc = $_POST['ex3pat'];

$ex3net = $_POST['ex3net'];
$ex3sell = $_POST['ex3sell'];


$sqlinsextra3 = "insert into quot_extra(quot_extra_sno,main_sno,ocode,user_sno,user_id,req_date_time,no_paxs,paticulars,net_rate,sell_rate,tot_net_rate,tot_sell_rate,order_date,cus_account_code,supp_account_code) values($extra_seq,$main_seq,'$pnr',$suser_sno,'$suserid','$ex3date', $n_pax,'$ex3desc',$ex3net,$ex3sell,$ex3net*$n_pax,$ex3sell*$n_pax,'now()',$s_acode,600154)"; 
pg_query($sqlinsextra3);

$sequpdat_quot_extra3 = "update seq set quot_extra=quot_extra+1";
pg_query($sequpdat_quot_extra3);

}  //end of others3




$sel_ins_rooms="";
for($roo=0; $roo<count($a_rooms); $roo++){
$sel_ins_rooms = $sel_ins_rooms . $a_rooms[$roo].",";
}

$sel_ins_rooms = trim(substr($sel_ins_rooms,0,strlen($sel_ins_rooms)-1));

$sqmain_n="";
$sqmain_s="";

for($st=0; $st<count($a_rooms); $st++){
$sqmain_n = $sqmain_n . "net_rate_r".$a_rooms[$st].",";
$sqmain_s = $sqmain_s . "sell_rate_r".$a_rooms[$st].",";

}

$qscmain = $sqmain_n.$sqmain_s;


for($i=0; $i<count($a_rooms); $i++){
$roomn = $a_rooms[$i];
${nr.$roomn} = $_POST["finalpn".$a_rooms[$i]];
${sr.$roomn} = $_POST["finalp".$a_rooms[$i]];
}

$ratenm="";
$ratesm="";
for($st=0; $st<count($a_rooms); $st++){
$nr="nr";
$sr="sr";
$roomn = $a_rooms[$st];
$ratenm = $ratenm.${$nr . $roomn}.",";
$ratesm = $ratesm.${$sr . $roomn}.",";
}


 $ins_qscmain = $ratenm . $ratesm;

$gname = "Quotation" . $main_seq. " for " . $n_pax." Pax(s)";


$b_hotbull="false";
$b_transbull="false";
$b_visabull="false";
$b_extrabull="false";




if($madhot=="on" || $makhot=="on" || $othot=="on"){
$b_hotbull="true";	
}

if($trans=="on"){ $b_transbull="true" ;}

if($visa=="on"){$b_visabull="true";}

if($service=="on" || $others1=="on" || $others2=="on" || $others3=="on"){
$b_extrabull="true";
}




$sqlinsmain = "insert into quot_main(main_sno,ocode,user_sno,user_id,no_pax,guest_name,sel_rooms,order_date,option_date,cus_account_code," . $qscmain . "sales_hotels,sales_trans,sales_visa,sales_others)values($main_seq,'$pnr',$suser_sno,'$suserid',$n_pax,'$gname','$sel_ins_rooms','now()',date 'now()' + interval '3 day', $s_acode," . $ins_qscmain . " '$b_hotbull','$b_transbull','$b_visabull','$b_extrabull')"; 
pg_query($sqlinsmain);

$sequpdat_quot_main = "update seq set quot_main=quot_main+1";
pg_query($sequpdat_quot_main);


?>

<? echo "<script>document.location.href=\"quotpnrdet.php?spnr=$pnr\"</script>";  ?>