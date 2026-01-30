<?php

include("../db/db.php"); 

$s_pnr = $_GET['spnr'];


$q_hotel_sel ="select sno,station_name,nop_estimated,nop_arrived,nop_depatured,arrived_from,depatured_to,arrived_at,depatured_at,rep_name,is_mazarat  from umrah_gm where ocode='$s_pnr' order by arrived_at";

$res_hotel_sel = pg_query($q_hotel_sel);
$rows_hotels = pg_num_rows($res_hotel_sel);

if (!$res_hotel_sel) {
echo "An error occured.\n";
exit; }

$a_uo = array();
$a_uos = array();

$o_sno=1;
while ($rows_hotel_sel = pg_fetch_array($res_hotel_sel)){

$s_operation_id = $rows_hotel_sel["sno"];
$s_station_name = $rows_hotel_sel["station_name"];
$s_nop_estimated = $rows_hotel_sel["nop_estimated"];
$s_nop_arrived = $rows_hotel_sel["nop_arrived"];
$s_nop_depatured = $rows_hotel_sel["nop_depatured"];
$s_arrived_from = $rows_hotel_sel["arrived_from"];
$s_depatured_to = $rows_hotel_sel["depatured_to"];
$s_arrived_at = $rows_hotel_sel["arrived_at"];
$s_depatured_at = $rows_hotel_sel["depatured_at"];
$s_rep_name = $rows_hotel_sel["rep_name"];
$s_is_mazarat = $rows_hotel_sel["is_mazarat"];


if($s_station_name=="Jeddah") { 

if($s_arrived_from!="Jeddah"){
$a_uo[] = 1 ; $a_uos['Jeddah1'] = $o_sno; 
}

if($s_depatured_to=="Makkah"){
$a_uo[] = 2 ; $a_uos['Jeddah2'] = $o_sno+1; 
}

if($s_depatured_to!="Makkah" && $s_depatured_to!="Madinah" ){
$a_uo[] = 7 ; $a_uos['Jeddah3'] = $o_sno; 
}

}

if($s_station_name=="Makkah" && $s_is_mazarat=="t") { 
$a_uo[] = 3 ; $a_uos['MakkahMazarat'] = $o_sno+1; 
}
else{

if($s_depatured_to=="Madinah"){
$a_uo[] = 4 ; $a_uos['Makkah1'] = $o_sno+2; 
}
}

if($s_station_name=="Madinah" && $s_is_mazarat=="t") { 
$a_uo[] = 5 ; $a_uos['MadinahMazarat'] = $o_sno+1; 
}
else{

if($s_depatured_to=="Jeddah"){
$a_uo[] = 6 ; $a_uos['Madinah1'] = $o_sno+2; 
}
}








$o_sno++;
}



header("Content-type: image/png");

$string = $s_pnr  ;

//$string = $a_uo[2] ;

$im     = imagecreatefrompng("umraho.png");

$red= imagecolorallocate($im, 255, 0, 0);
$m_green = imagecolorallocate($im, 86, 193, 7);
$orange = imagecolorallocate($im, 220, 210, 60);

imagestring($im, 5, 5, 9, $string, $red);




for($i=0 ; $i<=count($a_uo); $i++){



//for operation 1 start
if($a_uo[$i]==1){
$myLine = array (344,532,337,522,344,513,231,479,133,390,123,394,223,489,344,532);
imagepolygon($im, $myLine, 8, $red);
imagefilledpolygon($im, $myLine, 8, $red);

$myTriangle = array (154,387,121,381,111,414,129,394);
imagepolygon($im, $myTriangle, 4, $red);
imagefilledpolygon($im, $myTriangle, 4, $red);

$so = $a_uos['Jeddah1'];

imagestring($im, 5, 212, 494, $so, $red);

}
//for operation 1 end


//for operation 2 start



if($a_uo[$i]==2){
$myLine = array (113,248,125,245,130,255,212,163,336,119,335,109,206,152,113,248);
imagepolygon($im, $myLine, 8, $red);
imagefilledpolygon($im, $myLine, 8, $red);

$myTriangle = array (322, 90, 333, 113, 326, 139, 350,113);
imagepolygon($im, $myTriangle, 4, $red);
imagefilledpolygon($im, $myTriangle, 4, $red);

$so = $a_uos['Jeddah2'];

imagestring($im, 5, 205, 125, $so, $red);

}
//for operation 2 end


//for operation 3 start



if($a_uo[$i]==3){
$myLine = array (453,179,449,172,449,61,453,56);
imagepolygon($im, $myLine, 4, $red);
imagefilledpolygon($im, $myLine, 4, $m_green);

$myLine = array (449,61,453,56,348,56,354,61);
imagepolygon($im, $myLine, 4, $red);
imagefilledpolygon($im, $myLine, 4, $m_green);

$myLine = array (348,56,354,61,354,172,348,179);
imagepolygon($im, $myLine, 4, $red);
imagefilledpolygon($im, $myLine, 4, $m_green);

$myLine = array (354,172,348,179,453,179,449,172);
imagepolygon($im, $myLine, 4, $red);
imagefilledpolygon($im, $myLine, 4, $m_green);


$so = $a_uos['MakkahMazarat'];
imagestring($im, 5, 402, 40, $so, $red);

}



//for operation 3 end

//for operation 4 start

if($a_uo[$i]==4){


$myLine = array (460,108,466,113,459,119,579,156,668,243,678,237,585,147,460,106);
imagepolygon($im, $myLine, 8, $red);
imagefilledpolygon($im, $myLine, 8, $red);

$myTriangle = array (645,246,679,253,687,218,670,240);
imagepolygon($im, $myTriangle, 4, $red);
imagefilledpolygon($im, $myTriangle, 4, $red);

imagestring($im, 5, 580, 120, "4", $red);

}
//for operation 4 end





//for operation 5 start


if($a_uo[$i]==5){

$myLine = array (769,384,758,374,758,262,769,253);
imagepolygon($im, $myLine, 4, $red);
imagefilledpolygon($im, $myLine, 4, $m_green);

$myLine = array (758,262,769,253,604,253,612,262);
imagepolygon($im, $myLine, 4, $red);
imagefilledpolygon($im, $myLine, 4, $m_green);

$myLine = array (604,253,612,262,611,374,605,384);
imagepolygon($im, $myLine, 4, $red);
imagefilledpolygon($im, $myLine, 4, $m_green);

$myLine = array (611,374,605,384,769,384,758,374);
imagepolygon($im, $myLine, 4, $red);
imagefilledpolygon($im, $myLine, 4, $m_green);

imagestring($im, 5, 783, 336, "5", $red);


}
//for operation 5 end

//for operation 6 start

if($a_uo[$i]==6){
$myLine = array (205,326,606,326,606,313,205,313);
imagepolygon($im, $myLine, 4, $red);
imagefilledpolygon($im, $myLine, 4, $red);

$myTriangle = array (196,319,221,345,211,319,221,294);
imagepolygon($im, $myTriangle, 4, $red);
imagefilledpolygon($im, $myTriangle, 4, $red);

imagestring($im, 5, 396, 290, "6", $red);

}
//for operation 6 end

//for operation 7 start

if($a_uo[$i]==7){
$myLine = array (329,505,330,494,233,460,153,373,151,381,141,379,229,468);
imagepolygon($im, $myLine, 7, $red);
imagefilledpolygon($im, $myLine, 7, $red);

$myTriangle = array (318,521,344,496,320,470,328,496);
imagepolygon($im, $myTriangle, 4, $red);
imagefilledpolygon($im, $myTriangle, 4, $red);

imagestring($im, 5, 231, 423, "7", $red);

}
//for operation 7 end



}




imagepng($im);
imagedestroy($im);



?>
