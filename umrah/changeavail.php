<?
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$suserid = $_SESSION["userid"];
$suser_sno = $_SESSION["user_sno"];

?>
<?
include("../db/db.php"); 
?>
<center>
<body bgcolor="#00A800" leftmargin="10" topmargin="10" marginwidth="0" marginheight="0">

<table width="100%" height="6%" border="0" cellspacing="0" cellpadding="0" bgcolor="#CAFFCA">
  <tr>
            <td><font size="2" face="Arial, Helvetica, sans-serif"><strong>&nbsp; 
              Amend Availability </strong></font></td>
            <td valign="top"> <div align="right"><img src="../images/tr.jpg" width="9" height="10"></div></td>
  </tr>
</table>
<table width="100%" height="86%" border="0" cellspacing="0" cellpadding="1" bgcolor="#FFFFFF">
  <tr><td valign="top">

  <table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td>
<?
$roomid_sno = $_GET["roomid"]; 
$hotid = substr($roomid_sno, 0,5);
$s_cin = $_GET["cin"]; 
$s_cout = $_GET["cout"]; 

$ridn=0;
$rids=0;

$ridnt=0;
$ridst=0;





$madnights1 = Round(((strtotime($s_cout)-strtotime($s_cin))/86400), 0) ;


$query_room ="select room_id, room_type, no_of_paxs from rooms where room_id ='$roomid_sno'";

$result_room = pg_query($conn, $query_room);

if (!$result_room) {
	echo "An error occured.\n";
	exit;
	}
while ($rows_room = pg_fetch_array($result_room)){

$array_room_id = $rows_room["room_id"];
$array_room_type = $rows_room["room_type"];
$array_no_of_paxs = $rows_room["no_of_paxs"];
}
pg_free_result($result_room);

echo "<form name=\"cava\" action=\"changeavaila.php\"  method=\"post\" >";

echo "<table width=\"100%\" cellpadding=\"1\" cellspacing=\"0\"><thead><tr><td colspan=\"5\" style=\"border-top: 1px solid #999999; border-bottom: 1px solid #999999\" align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\" color=\"#ff0000\"><strong>Room Type: $array_room_type</strong></font></td><tr>";

echo "<tr><td style=\"border-bottom: 1px solid #999999\" align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><strong>Night</strong></font></td><td style=\"border-bottom: 1px solid #999999\" align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><strong>Net</strong></font></td><td style=\"border-bottom: 1px solid #999999\" align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><strong>Sell</strong></font></td><td style=\"border-bottom: 1px solid #999999\" align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><strong>Avial Status <input type=\"button\" id=\"samecb\" name=\"samecb\"  size=\"1\"  value=\"do\" onClick=\"sameascb();\"></strong></font></td><td style=\"border-bottom: 1px solid #999999\" align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><strong>No of Rooms <input type=\"button\" id=\"samear\" name=\"samear\"  size=\"1\"  value=\"do\" onClick=\"sameasar();\"></strong></font></td><tr>";

for($madnit=0; $madnit<$madnights1 ;  $madnit++){
$mad_rd = date('D, d-M', mktime(0,0,0,date('m', strtotime($s_cin)),date('d', strtotime($s_cin))+$madnit,date('Y', strtotime($s_cin))));
$mad_rd1 = date('Y-m-d', mktime(0,0,0,date('m', strtotime($s_cin)),date('d', strtotime($s_cin))+$madnit,date('Y', strtotime($s_cin))));

$avas="unchecked";
$query_main ="select avialibility,avial_bool from rates$hotid where room_id='$roomid_sno' and rate_date='$mad_rd1'  ";
$result_main = pg_query($conn, $query_main);
$n_check = pg_num_rows($result_main);
if (!$result_main) {
	echo "An error occured.\n";
	exit;
	}
while ($rows_main = pg_fetch_array($result_main)){
$avail_rooms = $rows_main["avialibility"];
$avail_bull = $rows_main["avial_bool"];

if($avail_bull=="t"){
$avas="checked";
}
}

$query_g_rates ="select room_id,from_date,to_date, weekday_net,weekday_sell,weekend_net,weekend_sell,breakfast,halfboard,fullboard,sahoor,iftar,weekends,wpackage  from res_rates where '$mad_rd1' between from_date and to_date - interval '1 day' and room_id = '$roomid_sno' ";


$result_rates = pg_query($conn, $query_g_rates);

if (!$result_rates) {
	echo "An error occured.\n";
	exit;
	}
while ($rows_rates = pg_fetch_array($result_rates)){
//echo " ";

 
$a_weekends = explode(",", $rows_rates["weekends"]);

 $s_wep = $rows_rates["wpackage"];

for($we=0; $we<count($a_weekends); $we++){

if($a_weekends[$we]==date('D', strtotime($mad_rd))){
$we_bull=1;
break;
}
else{
 $we_bull=0;
}

}

if($we_bull){
 $ridn = $rows_rates["weekend_net"];
  $rids = $rows_rates["weekend_sell"];
}
else {
 $ridn = $rows_rates["weekday_net"];
  $rids = $rows_rates["weekday_sell"];
}

$status=1;


}






echo "<tr><td style=\" border-bottom: 1px solid #999999\" align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"> $mad_rd</font></td><td style=\"border-bottom: 1px solid #999999\" align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">$ridn</font></td><td style=\"border-bottom: 1px solid #999999\" align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">$rids</font></td><td style=\"border-bottom: 1px solid #999999\" align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><input type=\"checkbox\" id=\"cb$roomid_sno$madnit\" name=\"cb$roomid_sno$madnit\" $avas ></font></td><td style=\"border-bottom: 1px solid #999999\" align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><input type=\"text\" id=\"rooms$roomid_sno$madnit\" name=\"rooms$roomid_sno$madnit\" size=\"2\" value=\"$avail_rooms\"></font></td><tr>";



$ridnt=$ridnt+$ridn;
$ridst=$ridst+$rids;

}

echo "<tr><td style=\" border-bottom: 1px solid #999999\" align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">Total:</font></td><td style=\"border-bottom: 1px solid #999999\" align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">$ridnt</font></td><td style=\"border-bottom: 1px solid #999999\" align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">$ridst</font></td><td style=\"border-bottom: 1px solid #999999\" align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">&nbsp;</font></td><td style=\"border-bottom: 1px solid #999999\" align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><input type=\"submit\" name=\"submit\" size=\"2\" value=\"Amend >>\"></font></td><tr>";


echo "</table>";

?>

<input type="hidden" name="p_roomid"  value=<? echo $roomid_sno;?>>
<input type="hidden" name="p_cin"  value=<? echo date('Y-m-d', strtotime($_GET["cin"])) ;?>>
<input type="hidden" name="p_cout"  value=<? echo date('Y-m-d', strtotime($_GET["cout"])) ;?>>

<form>

</td></tr>			
</table>			
</td></tr>
</table>

<table width="100%" height="8%" border="0" cellspacing="0" cellpadding="0" bgcolor="#CAFFCA">
  <tr>
            <td  valign="bottom"  > <img src="../images/bl.jpg" width="9" height="10"></td>
            <td valign="middle"><div align="right">
                <input name="close" type="button" value="  Close  "  onClick="window.close()">&nbsp;&nbsp;&nbsp;
              </div></td>
  </tr>
</table>

<script>

function sameascb(){

if(document.getElementById ('cb<? echo $roomid_sno ; ?>0').checked==true){
'<? for($vts=0; $vts<$madnights1; $vts++){ ?>'
document.getElementById ('cb<? echo $roomid_sno.$vts ?>').checked=false;
'<?}?>'	
}
else
{
'<? for($vts=0; $vts<$madnights1; $vts++){ ?>'
document.getElementById ('cb<? echo $roomid_sno.$vts  ?>').checked=true;
'<?}?>'
}

}


function sameasar(){

var etn = document.getElementById ('rooms<? echo $roomid_sno ; ?>0').value;

'<? for($vts=0; $vts<$madnights1; $vts++){ ?>'
document.getElementById ('rooms<? echo $roomid_sno.$vts ?>').value=etn;
'<?}?>'	


}
</script>								




</body>
</center>