<?
session_start();
$arr_rate_sno = $_SESSION['a_rate_sno'];
$arr_room_id = $_SESSION['a_rate_id'];

$arr_croom_id = $_SESSION['c_room_id'];



include("../db/db.php"); 
?>
<center>
<body bgcolor="#00A800" leftmargin="10" topmargin="10" marginwidth="0" marginheight="0">
<table width="100%" height="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF">
  <tr>
    <td>

<table width="100%" height="6%" border="0" cellspacing="0" cellpadding="0" bgcolor="#CAFFCA">
  <tr>
            <td><font size="2" face="Arial, Helvetica, sans-serif"><strong>&nbsp;Amending Hotel Reservation Rates ...</strong></font></td>
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

$mad = $_POST['dDay'];
$mam = $_POST['dMonth'];
$may = $_POST['dYear'];

$fromd = $may."-".$mam."-".$mad;

$md = $_POST['d1Day'];
$mm = $_POST['d1Month'];
$my = $_POST['d1Year'];

$tod = $my."-".$mm."-".$md;

$g_hot = $_POST["g_hot"]; 


$s_weekends="";
if($_POST["wetue"]=="on"){$s_weekends = $s_weekends . "Tue," ; $wetu ="checked";} else { $wetu = "unchecked";}
if($_POST["wewed"]=="on"){ $s_weekends = $s_weekends . "Wed," ;}
if($_POST["wethu"]=="on"){ $s_weekends = $s_weekends . "Thu," ;}
$s_weekendsf = substr($s_weekends,0, strlen($s_weekends)-1);

$s_wpackage="";

if($_POST["wep"]=="on"){$s_wpackage="true";} else {$s_wpackage="false";}




$s_breakfast = $_POST["bf"];
$s_halfboard = $_POST["hb"];
$s_fullboard = $_POST["fb"];
$s_sahoor = $_POST["sah"];
$s_iftar = $_POST["ift"];

$t_breakfast = $_POST["bft"];
$t_halfboard = $_POST["hbt"];
$t_fullboard = $_POST["fbt"];
$t_sahoor = $_POST["saht"];
$t_iftar = $_POST["iftt"];



$s_included = "Included";
$s_avi = "Available";
$s_n_avi = "Not Available";

if($s_breakfast==$s_included){ $ins_breakfast="Included" ;}
if($s_breakfast==$s_n_avi){ $ins_breakfast="Not Available" ;}
if($s_breakfast==$s_avi){ $ins_breakfast=$t_breakfast ;}

if($s_halfboard==$s_included){ $ins_halfboard="Included" ;}
if($s_halfboard==$s_n_avi){ $ins_halfboard="Not Available" ;}
if($s_halfboard==$s_avi){ $ins_halfboard=$t_halfboard ;}

if($s_fullboard==$s_included){ $ins_fullboard="Included" ;}
if($s_fullboard==$s_n_avi){ $ins_fullboard="Not Available" ;}
if($s_fullboard==$s_avi){ $ins_fullboard=$t_fullboard ;}

if($s_sahoor==$s_included){ $ins_sahoor="Included" ;}
if($s_sahoor==$s_n_avi){ $ins_sahoor="Not Available" ;}
if($s_sahoor==$s_avi){ $ins_sahoor=$t_sahoor ;}

if($s_iftar==$s_included){ $ins_iftar="Included" ;}
if($s_iftar==$s_n_avi){ $ins_iftar="Not Available" ;}
if($s_iftar==$s_avi){ $ins_iftar=$t_iftar ;}



$s_nation = trim($_POST["scou"]);

$s_nation1 =  $s_nation;

$s_n_gcc = "Bahrain, Kuwait, 0man, Qatar, Saudi Arabia, United Arab Emirates";

$s_n_europe = "Albania, Andorra, Austria, Belgium, Bulgaria, Croatia, Czech Republic, Cyprus, Denmark, Estonia, Finland, France, Germany, Greece, Hungary, Iceland, Ireland, Italy, Latvia, Lithuania, Luxembourg, Malta, Moldova, Monaco, Netherlands, Norway, Poland, Portugal, Romania, Russia, San Marino, Slovakia, Slovenia, Spain, Sweden, Switzerland, Turkey,Ukraine, United Kingdom"; 

$s_n_fareast = "Brunei, Cambodia, China, Hong Kong, Taiwan, Indonesia, Malaysia, Palau, Philippines, Singapore, Thailand";

$s_n_southa = "Bangladesh, Bhutan, India, Maldives, Nepal, Pakistan, Sri Lanka"; 


$a_nation = explode(",", $s_nation1);


for($i=0;$i<count($a_nation);$i++){

if(trim($a_nation[$i])=="Far East"){
$s_nation1 = str_replace("Far East", $s_n_fareast, $s_nation1); 
}

if(trim($a_nation[$i])=="GCC"){
$s_nation1 = str_replace("GCC", $s_n_gcc, $s_nation1); 
}

if(trim($a_nation[$i])=="Europe"){
$s_nation1 = str_replace("Europe", $s_n_europe, $s_nation1); 
}

if(trim($a_nation[$i])=="South Asia"){
$s_nation1 = str_replace("South Asia", $s_n_southa, $s_nation1); 
}

}


if(count($arr_croom_id)==count($arr_room_id)){
//echo "update";

for($qf=0; $qf<count($arr_room_id); $qf++){

$r_sno = $arr_rate_sno[$qf];

$ins_wdn = $_POST["weekdayn".$arr_room_id[$qf]];
$ins_wds = $_POST["weekdays".$arr_room_id[$qf]];
$ins_wen = $_POST["weekendn".$arr_room_id[$qf]];
$ins_wes = $_POST["weekends".$arr_room_id[$qf]];


$sqlinsgr = "update res_rates set from_date='$fromd', to_date='$tod', weekday_net='$ins_wdn', weekday_sell='$ins_wds', weekend_net='$ins_wen', weekend_sell='$ins_wes', nationality='$s_nation', nationalityl='$s_nation1',weekends='$s_weekendsf', wpackage='$s_wpackage', breakfast='$ins_breakfast', halfboard='$ins_halfboard', fullboard='$ins_fullboard', sahoor='$ins_sahoor', iftar='$ins_iftar' where rate_sno=$r_sno"; 
pg_query($conn, $sqlinsgr);

}



}
else {


// echo "delete";

for($qfd=0; $qfd<count($arr_room_id); $qfd++){
$r_snod = $arr_rate_sno[$qfd];
$sqldel = "delete from res_rates  where rate_sno=$r_snod"; 
pg_query($conn, $sqldel);
}

//echo "insert";



for($qf=0; $qf<count($arr_croom_id); $qf++){


$query_gsno ="select r_rate_sno from seq";

$result_gsno = pg_query($conn, $query_gsno);

if (!$result_gsno) {
echo "An error occured.\n";
exit;
		}
while ($rows_gsno = pg_fetch_array($result_gsno)){
$gsno_seq = $rows_gsno["r_rate_sno"];
}

pg_free_result($result_gsno);

$ins_wdn = $_POST["weekdayn".$arr_croom_id[$qf]];
$ins_wds = $_POST["weekdays".$arr_croom_id[$qf]];
$ins_wen = $_POST["weekendn".$arr_croom_id[$qf]];
$ins_wes = $_POST["weekends".$arr_croom_id[$qf]];

$r_id = $arr_croom_id[$qf];



$sqlinsgr = "insert into res_rates(rate_sno, room_id, from_date, to_date, weekday_net, weekday_sell, weekend_net, weekend_sell, nationality, nationalityl,weekends, wpackage, breakfast, halfboard, fullboard, sahoor, iftar) values($gsno_seq, $r_id, '$fromd', '$tod', $ins_wdn, $ins_wds, $ins_wen, $ins_wes, '$s_nation', '$s_nation1','$s_weekendsf', '$s_wpackage','$ins_breakfast', '$ins_halfboard', '$ins_fullboard', '$ins_sahoor', '$ins_iftar')"; 
pg_query($conn, $sqlinsgr);


$sequpdateg_rate_sno = "update seq set r_rate_sno=r_rate_sno+1";
pg_query($conn, $sequpdateg_rate_sno);

}    // date check if else end


}






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

<? echo "<script>document.location.href=\"resratesentry.php?hotid=$g_hot\"</script>";  ?>