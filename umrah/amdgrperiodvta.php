<?
include("../db/db.php"); 
?>
<center>
<body bgcolor="#00A800" leftmargin="10" topmargin="10" marginwidth="0" marginheight="0">
<table width="100%" height="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF">
  <tr>
    <td>

<table width="100%" height="6%" border="0" cellspacing="0" cellpadding="0" bgcolor="#CAFFCA">
  <tr>
            <td><font size="2" face="Arial, Helvetica, sans-serif"><strong>&nbsp;Amending Hotel Group Rates ...</strong></font></td>
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


$a_viewt = array("CV","NV","HV","KV");
$a_viewtype = array("City View","Non View","Haram View","Kabbah View");

$t_breakfast = 0;
$t_halfboard = 0;
$t_fullboard = 0;
$t_sahoor = 0;
$t_iftar = 0;

$s_breakfast = "Included";
$s_halfboard = "Available";
$s_fullboard = "Available";
$s_sahoor = "Not Available";
$s_iftar = "Not Available";


$g_cin = $_POST["g_cin"]; 
$g_cout = $_POST["g_cout"]; 
$g_hot = $_POST["g_hot"]; 
$g_nat = trim($_POST["g_nat"]); 





$g_viewt = $_POST["g_viewt"];

$s_rsno = $_POST["s_rsno"];


$s_hotelsb = $_POST["hotelsb"];

$mad = $_POST['dDay'];
$mam = $_POST['dMonth'];
$may = $_POST['dYear'];

$fromd = $may."-".$mam."-".$mad;

$md = $_POST['d1Day'];
$mm = $_POST['d1Month'];
$my = $_POST['d1Year'];

$tod = $my."-".$mm."-".$md;


$s_viewt = $_POST['viewtype'];
for($svt=0; $svt<count($a_viewt); $svt++){

if($s_viewt==$a_viewt[$svt])
{
$s_viewtype = $a_viewtype[$svt];
}
}


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




$s_n_gcc = "Bahrain, Kuwait, Oman, Qatar, Saudi Arabia, United Arab Emirates";

$s_n_europe = "Albania, Andorra, Austria, Belgium, Bulgaria, Croatia, Czech Republic, Cyprus, Denmark, Estonia, Finland, France, Germany, Greece, Hungary, Iceland, Ireland, Italy, Latvia, Lithuania, Luxembourg, Malta, Moldova, Monaco, Netherlands, Norway, Poland, Portugal, Romania, Russia, San Marino, Slovakia, Slovenia, Spain, Sweden, Switzerland, Turkey,Ukraine, United Kingdom"; 

$s_n_fareast = "Brunei, Cambodia, China, Hong Kong, Taiwan, Indonesia, Malaysia, Palau, Philippines, Singapore, Thailand";

$s_n_southa = "Bangladesh, Bhutan, India, Maldives, Nepal, Pakistan, Sri Lanka"; 


$a_nation = explode("," , $s_nation1);



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

$s_nation1;






for($irt=1; $irt<13; $irt++){

$forinswdn[$irt-1] = $_POST['rrwdn'.$irt];
$forinswds[$irt-1] =  $_POST['rrwds'.$irt];

$forinswen[$irt-1] = $_POST['rrwen'.$irt];
$forinswes[$irt-1] =  $_POST['rrwes'.$irt];

}


?>



<?
$q_amd_period = "update group_rates set from_date='$g_cin', to_date='$g_cout' , weekd_net_r1=$forinswdn[0], weekd_sell_r1=$forinswds[0], weekd_net_r2=$forinswdn[1], weekd_sell_r2=$forinswds[1], weekd_net_r3=$forinswdn[2], weekd_sell_r3=$forinswds[2], weekd_net_r4=$forinswdn[3], weekd_sell_r4=$forinswds[3], weekd_net_r5=$forinswdn[4], weekd_sell_r5=$forinswds[4], weekd_net_r6=$forinswdn[5], weekd_sell_r6=$forinswds[5], weekd_net_r7=$forinswdn[6], weekd_sell_r7=$forinswds[6], weekd_net_r8=$forinswdn[7], weekd_sell_r8=$forinswds[7], weekd_net_r9=$forinswdn[8], weekd_sell_r9=$forinswds[8], weekd_net_r10=$forinswdn[9], weekd_sell_r10=$forinswds[9], weekd_net_r11	=$forinswdn[10], weekd_sell_r11=$forinswds[10], weekd_net_r12=$forinswdn[11], weekd_sell_r12=$forinswds[11], weeke_net_r1=$forinswen[0], weeke_sell_r1=$forinswes[0], weeke_net_r2=$forinswen[1], weeke_sell_r2=$forinswes[1], weeke_net_r3=$forinswen[2], weeke_sell_r3=$forinswes[2], weeke_net_r4=$forinswen[3], weeke_sell_r4=$forinswes[3], weeke_net_r5=$forinswen[4], weeke_sell_r5=$forinswes[4], weeke_net_r6=$forinswen[5], weeke_sell_r6=$forinswes[5], weeke_net_r7=$forinswen[6], weeke_sell_r7=$forinswes[6], weeke_net_r8=$forinswen[7], weeke_sell_r8=$forinswes[7], weeke_net_r9=$forinswen[8], weeke_sell_r9=$forinswes[8], weeke_net_r10=$forinswen[9], weeke_sell_r10=$forinswes[9], weeke_net_r11=$forinswen[10], weeke_sell_r11=$forinswes[10], weeke_net_r12=$forinswen[11], weeke_sell_r12=$forinswes[11], nationality='$s_nation', nationalityl='$s_nation1', view_type='$s_viewtype', breakfast='$ins_breakfast', halfboard_rate='$ins_halfboard', fullboard_rate='$ins_fullboard', sahoor_rate='$ins_sahoor', iftar_rate='$ins_iftar' where rate_sno=$s_rsno";
pg_query($conn, $q_amd_period);


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

<?  echo "<script>document.location.href=\"groupratesentry.php?hotid=$g_hot\"</script>";  ?>
</body>
</center>