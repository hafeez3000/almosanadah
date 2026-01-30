<?
//session_cache_limiter('must-revalidate');
include ("header.php");
$vy=$vm=$vd=0;
$vy1=$vm1=$vd1=0;


$s_included = "Included";
$s_avi = "Available";
$s_n_avi = "Not Available";

$query_hotel ="select hotel_id, hotel_name, city from hotels order by hotel_name";

$result_hotel = pg_query($query_hotel);

if (!$result_hotel) {
	echo "An error occured.\n";
	exit;
	}
while ($rows_hotel = pg_fetch_array($result_hotel)){

$array_hotel[] = $rows_hotel["hotel_name"];
$array_hotel_id[] = $rows_hotel["hotel_id"];
$array_city[] = $rows_hotel["city"];

}

pg_free_result($result_hotel);


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

?>
<script src="../javascripts/cBoxes.js"></script>
<script>
 window.onload = function() {
	document.gquot.hotelsb.focus();
 }
</script>


<script>
document.title= '<? echo $company_name . " ERP - Umrah - Individual Rates Entry"; ?>';
</script>

<html>
<link rel="stylesheet" type="text/css" href="../calendar/css.css" />
<head>
<script>
 var winl = (screen.width - 700) / 2; 
 var wint = (screen.height - 500) / 2;
</script>

<script type="text/javascript">
      function OpenWindow(){
     
		var rr = "hotelratereportind.php";
		
        var winPop = window.open(rr,"winPop",'scrollbars=yes,toolbar=no,resizable=yes,width=550,height=300' ).focus();
      }
    </script>

</head>
<body leftmargin="0" topmargin="0" rightmargin="0" >
<table width="100%" border="0" cellpadding="0" cellspacing="0" style="border-bottom: 1px solid #999999 ;border-left: 3px solid #006600;border-right: 3px solid #006600"><tr>
    <td bgcolor="#CCCCCC"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">&nbsp;You 
      are here: <a href="uhome.php">Home</a> &raquo; <a href="#">Quotations</a> 
      &raquo; IndividualRates Entry</font></td>
  </tr></table>
  
<table width="100%" border="0" cellpadding="0" cellspacing="0" style="border-bottom: 3px solid #006600; border-right: 3px solid #006600;border-left: 3px solid #006600 ">
  <tr>
    <td width="20%" style="border-right: 1px solid #999999"  valign="top"> <table width="100%" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td valign="top"><div align="left"> 
              <?include ("umenu.php"); ?>
            </div></td>
        </tr>
      </table></td>
    <td width="80%" valign="top"  > <table width="100%" border="0" cellpadding="0" cellspacing="1">
        <tr>
          <td valign="top"> 
           
			


			
            <table width="100%" cellpadding="0" cellspacing="0" ><tr><td width="85%" valign="top"> 
			<table cellpadding="0" cellspacing="0" width="100%" style="border-top: 1px solid #999999; border-bottom: 1px solid #999999"><tr>
                      <td bgcolor="#CCCCCC"><strong>IndividualRates Entry</strong></td>
                    </tr></table>
<table width="100%" cellpadding="1" cellspacing="0"><tr>
                      <td> 
                          <table width="100%" border="0" cellspacing="0" align="center">
                          <?





$s_hotelsb = $_POST["hotelsb"];

if($s_hotelsb==""){
$s_hotelsb = $_GET["hotid"];
}


for($ac=0; $ac<count($array_hotel_id); $ac++){

$inco = $array_hotel_id[$ac];

if($s_hotelsb==$inco){
$s_hname=$array_hotel[$ac];
$s_city=$array_city[$ac];
}
}


$arr_nationality = array();
$arr_nationality_s = array();


$arr_from_dates = array();
$arr_to_dates = array();

$arr_from_dates1 = array();
$arr_to_dates1 = array();


$arr_view_type = array();


$query_g_rates ="select hotel_id,from_date,to_date,weekd_net_r1,weekd_sell_r1,weekd_net_r2,weekd_sell_r2,weekd_net_r3,weekd_sell_r3,weekd_net_r4,weekd_sell_r4,weekd_net_r5,weekd_sell_r5,weekd_net_r6,weekd_sell_r6,weekd_net_r7,weekd_sell_r7,weekd_net_r8,weekd_sell_r8,weekd_net_r9,weekd_sell_r9,weekd_net_r10,weekd_sell_r10,weekd_net_r11,weekd_sell_r11,weekd_net_r12,weekd_sell_r12,weeke_net_r1,weeke_sell_r1,weeke_net_r2,weeke_sell_r2,weeke_net_r3,weeke_sell_r3,weeke_net_r4,weeke_sell_r4,weeke_net_r5,weeke_sell_r5,weeke_net_r6,weeke_sell_r6,weeke_net_r7,weeke_sell_r7,weeke_net_r8,weeke_sell_r8,weeke_net_r9,weeke_sell_r9,weeke_net_r10,weeke_sell_r10,weeke_net_r11,weeke_sell_r11,weeke_net_r12,weeke_sell_r12,nationality,view_type,avialibility,avial_bool,allotment,breakfast,halfboard_rate,fullboard_rate,sahoor_rate,iftar_rate  from ind_rates where hotel_id='$s_hotelsb'";


$result_g_rates = pg_query($query_g_rates);

if (!$result_g_rates) {
	echo "An error occured.\n";
	exit;
	}
while ($rows_g_rates = pg_fetch_array($result_g_rates)){

$arr_hotel_id[] = $rows_g_rates["hotel_id"];
$arr_from_date[] = $rows_g_rates["from_date"];
$arr_to_date[] = $rows_g_rates["to_date"];

$arr_from_dates1[] = $rows_g_rates["from_date"];
$arr_to_dates1[] = $rows_g_rates["to_date"];


$arr_weekd_net_r1[] = $rows_g_rates["weekd_net_r1"];
$arr_weekd_sell_r1[] = $rows_g_rates["weekd_sell_r1"];
$arr_weekd_net_r2[] = $rows_g_rates["weekd_net_r2"];
$arr_weekd_sell_r2[] = $rows_g_rates["weekd_sell_r2"];
$arr_weekd_net_r3[] = $rows_g_rates["weekd_net_r3"];
$arr_weekd_sell_r3[] = $rows_g_rates["weekd_sell_r3"];
$arr_weekd_net_r4[] = $rows_g_rates["weekd_net_r4"];
$arr_weekd_sell_r4[] = $rows_g_rates["weekd_sell_r4"];
$arr_weekd_net_r5[] = $rows_g_rates["weekd_net_r5"];
$arr_weekd_sell_r5[] = $rows_g_rates["weekd_sell_r5"];
$arr_weekd_net_r6[] = $rows_g_rates["weekd_net_r6"];
$arr_weekd_sell_r6[] = $rows_g_rates["weekd_sell_r6"];
$arr_weekd_net_r7[] = $rows_g_rates["weekd_net_r7"];
$arr_weekd_sell_r7[] = $rows_g_rates["weekd_sell_r7"];
$arr_weekd_net_r8[] = $rows_g_rates["weekd_net_r8"];
$arr_weekd_sell_r8[] = $rows_g_rates["weekd_sell_r8"];
$arr_weekd_net_r9[] = $rows_g_rates["weekd_net_r9"];
$arr_weekd_sell_r9[] = $rows_g_rates["weekd_sell_r9"];
$arr_weekd_net_r10[] = $rows_g_rates["weekd_net_r10"];
$arr_weekd_sell_r10[] = $rows_g_rates["weekd_sell_r10"];
$arr_weekd_net_r11[] = $rows_g_rates["weekd_net_r11"];
$arr_weekd_sell_r11[] = $rows_g_rates["weekd_sell_r11"];
$arr_weekd_net_r12[] = $rows_g_rates["weekd_net_r12"];
$arr_weekd_sell_r12[] = $rows_g_rates["weekd_sell_r12"];

$arr_weeke_net_r1[] = $rows_g_rates["weeke_net_r1"];
$arr_weeke_sell_r1[] = $rows_g_rates["weeke_sell_r1"];
$arr_weeke_net_r2[] = $rows_g_rates["weeke_net_r2"];
$arr_weeke_sell_r2[] = $rows_g_rates["weeke_sell_r2"];
$arr_weeke_net_r3[] = $rows_g_rates["weeke_net_r3"];
$arr_weeke_sell_r3[] = $rows_g_rates["weeke_sell_r3"];
$arr_weeke_net_r4[] = $rows_g_rates["weeke_net_r4"];
$arr_weeke_sell_r4[] = $rows_g_rates["weeke_sell_r4"];
$arr_weeke_net_r5[] = $rows_g_rates["weeke_net_r5"];
$arr_weeke_sell_r5[] = $rows_g_rates["weeke_sell_r5"];
$arr_weeke_net_r6[] = $rows_g_rates["weeke_net_r6"];
$arr_weeke_sell_r6[] = $rows_g_rates["weeke_sell_r6"];
$arr_weeke_net_r7[] = $rows_g_rates["weeke_net_r7"];
$arr_weeke_sell_r7[] = $rows_g_rates["weeke_sell_r7"];
$arr_weeke_net_r8[] = $rows_g_rates["weeke_net_r8"];
$arr_weeke_sell_r8[] = $rows_g_rates["weeke_sell_r8"];
$arr_weeke_net_r9[] = $rows_g_rates["weeke_net_r9"];
$arr_weeke_sell_r9[] = $rows_g_rates["weeke_sell_r9"];
$arr_weeke_net_r10[] = $rows_g_rates["weeke_net_r10"];
$arr_weeke_sell_r10[] = $rows_g_rates["weeke_sell_r10"];
$arr_weeke_net_r11[] = $rows_g_rates["weeke_net_r11"];
$arr_weeke_sell_r11[] = $rows_g_rates["weeke_sell_r11"];
$arr_weeke_net_r12[] = $rows_g_rates["weeke_net_r12"];
$arr_weeke_sell_r12[] = $rows_g_rates["weeke_sell_r12"];


$arr_nationality[] = trim($rows_g_rates["nationality"]);
$arr_nationality_s[] = trim($rows_g_rates["nationality"]);
$arr_view_type[] = $rows_g_rates["view_type"];
$arr_avialibility[] = $rows_g_rates["avialibility"];
$arr_avial_bool[] = $rows_g_rates["avial_bool"];
$arr_allotment[] = $rows_g_rates["allotment"];
$arr_breakfast[] = $rows_g_rates["breakfast"];
$arr_halfboard_rate[] = $rows_g_rates["halfboard_rate"];
$arr_fullboard_rate[] = $rows_g_rates["fullboard_rate"];
$arr_sahoor_rate[] = $rows_g_rates["sahoor_rate"];
$arr_iftar_rate[] = $rows_g_rates["iftar_rate"];


}

pg_free_result($result_g_rates);

echo "<tr><td colspan=\"5\">";


if($s_hname==""){ }
else{

echo "<table width=\"100%\" border=\"1\"  cellspacing=\"0\" cellpadding=\"0\">";

echo "<tr><td colspan=\"2\"><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><strong>";
echo $s_hname ;
echo " - ";
echo $s_city;
echo "</strong></font></div></td></tr>";


$arr_nationality_s = array_unique($arr_nationality_s);
sort($arr_nationality_s);

$arr_from_dates1 = array_unique($arr_from_dates1);
sort($arr_from_dates1);

$arr_to_dates1 = array_unique($arr_to_dates1);
sort($arr_to_dates1);



for($an=0; $an<count($arr_nationality_s); $an++){

echo "<tr><td colspan=\"2\" bgcolor=\"#FFE6E6\"><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";

echo "Nationality: " . $arr_nationality_s[$an];
echo "</font></div></td></tr>";




for($ad=0; $ad<count($arr_from_dates1); $ad++){





echo "<tr><td colspan=\"2\" bgcolor=\"#CCCCCC\"><div align=\"left\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";
echo "Check In: " . date('D, jS M, Y', strtotime($arr_from_dates1[$ad])) . " - Check Out: " . date('D, jS M, Y', strtotime($arr_to_dates1[$ad]));
echo " <a href=\"amdgrperiodind.php?cin=$arr_from_dates1[$ad]&cout=$arr_to_dates1[$ad]&hot=$s_hotelsb&nat=$arr_nationality_s[$an]\">Amend Period</a>&nbsp; <a href=\"delgrperiodind.php?cin=$arr_from_dates1[$ad]&cout=$arr_to_dates1[$ad]&hot=$s_hotelsb&nat=$arr_nationality_s[$an]\">Delete Period</a></font></div></td></tr>";



for($av=0;$av<count($arr_view_type);$av++){




if($arr_from_dates1[$ad]==$arr_from_date[$av] && $arr_to_dates1[$ad]==$arr_to_date[$av] && $arr_nationality_s[$an]==$arr_nationality[$av]){   

echo "<tr><td><div align=\"left\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";
echo "View Type: " . $arr_view_type[$av];
echo "</font></div>";

echo "<a href=\"amdgrperiodvtind.php?cin=$arr_from_dates1[$ad]&cout=$arr_to_dates1[$ad]&hot=$s_hotelsb&viewt=$arr_view_type[$av]&nat=$arr_nationality_s[$an]\">Amend</a>&nbsp;&nbsp;";
echo "<a href=\"delgrperiodvtind.php?cin=$arr_from_dates1[$ad]&cout=$arr_to_dates1[$ad]&hot=$s_hotelsb&viewt=$arr_view_type[$av]&nat=$arr_nationality_s[$an]\">Delete</a>";

echo "</td>";

echo "<td>";


echo "<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\"><tr>";

if($arr_weekd_net_r1[$av]!=0){
echo "<td><table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" style=\"border-right: 1px solid #999999\">";
echo "<tr>";
echo "<td colspan=\"4\" style=\"border-bottom: 1px solid #999999\"><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">Single</font></div></td>";
echo "</tr>";
echo "<tr>";
echo "<td bgcolor=\"#FFE6E6\" style=\"border-right: 1px solid #999999\"><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";
echo "WDN<br>" . $arr_weekd_net_r1[$av];
echo "</font></div></td>";
echo "<td bgcolor=\"#D7FFD7\"><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";
echo "WDS<br>" . $arr_weekd_sell_r1[$av];
echo "</font></div></td>";


if($arr_weekd_net_r1[$av]!=$arr_weeke_net_r1[$av]){
echo "<td bgcolor=\"#FFE6E6\" style=\"border-right: 1px solid #999999; border-left: 1px solid #999999\"><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";
echo "WEN<br>" . $arr_weeke_net_r1[$av];
echo "</font></div></td>";
echo "<td  bgcolor=\"#D7FFD7\"><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";
echo "WES<br>" . $arr_weeke_sell_r1[$av];
echo "</font></div></td>";
}
echo "</tr>";
echo "</table></td>";
}

if($arr_weekd_net_r2[$av]!=0){
echo "<td>";
echo "<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" style=\"border-right: 1px solid #999999\">";
echo "<tr>";
echo "<td colspan=\"4\" style=\"border-bottom: 1px solid #999999\"><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">Double</font></div></td>";
echo "</tr>";
echo "<tr>";
echo "<td bgcolor=\"#FFE6E6\" style=\"border-right: 1px solid #999999\"><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";
echo "WDN<br>" . $arr_weekd_net_r2[$av];
echo "</font></div></td>";
echo "<td bgcolor=\"#D7FFD7\"><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";
echo "WDS<br>" . $arr_weekd_sell_r2[$av];
echo "</font></div></td>";
if($arr_weekd_net_r2[$av]!=$arr_weeke_net_r2[$av]){
echo "<td bgcolor=\"#FFE6E6\" style=\"border-right: 1px solid #999999; border-left: 1px solid #999999\"><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";
echo "WEN<br>" . $arr_weeke_net_r2[$av];
echo "</td>";
echo "</font></div><td bgcolor=\"#D7FFD7\"><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"> ";
echo "WES<br>" . $arr_weeke_sell_r2[$av];
echo "</font></div></td>";
}
echo "</tr>";
echo "</table>";
echo "</td>";
}


if($arr_weekd_net_r3[$av]!=0){
echo "<td>";
echo "<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" style=\"border-right: 1px solid #999999\">";
echo "<tr>";
echo "<td colspan=\"4\" style=\"border-bottom: 1px solid #999999\"><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">Triple</font></div></td>";
echo "</tr>";
echo "<tr>";
echo "<td bgcolor=\"#FFE6E6\" style=\"border-right: 1px solid #999999\"><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";
echo "WDN<br>" . $arr_weekd_net_r3[$av];
echo "</font></div></td>";
echo "<td bgcolor=\"#D7FFD7\"><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";
echo "WDS<br>" . $arr_weekd_sell_r3[$av];
echo "</font></div></td>";
if($arr_weekd_net_r3[$av]!=$arr_weeke_net_r3[$av]){
echo "<td bgcolor=\"#FFE6E6\" style=\"border-right: 1px solid #999999; border-left: 1px solid #999999\"><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";
echo "WEN<br>" . $arr_weeke_net_r3[$av];
echo "</td>";
echo "</font></div><td bgcolor=\"#D7FFD7\"><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"> ";
echo "WES<br>" . $arr_weeke_sell_r3[$av];
echo "</font></div></td>";
}
echo "</tr>";
echo "</table>";
echo "</td>";
}

if($arr_weekd_net_r4[$av]!=0){
echo "<td>";
echo "<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" style=\"border-right: 1px solid #999999\">";
echo "<tr>";
echo "<td colspan=\"4\" style=\"border-bottom: 1px solid #999999\"><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">Quad</font></div></td>";
echo "</tr>";
echo "<tr>";
echo "<td bgcolor=\"#FFE6E6\" style=\"border-right: 1px solid #999999\"><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";
echo "WDN<br>" . $arr_weekd_net_r4[$av];
echo "</font></div></td>";
echo "<td bgcolor=\"#D7FFD7\"><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";
echo "WDS<br>" . $arr_weekd_sell_r4[$av];
echo "</font></div></td>";
if($arr_weekd_net_r4[$av]!=$arr_weeke_net_r4[$av]){
echo "<td bgcolor=\"#FFE6E6\" style=\"border-right: 1px solid #999999; border-left: 1px solid #999999\"><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";
echo "WEN<br>" . $arr_weeke_net_r4[$av];
echo "</td>";
echo "</font></div><td bgcolor=\"#D7FFD7\"><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"> ";
echo "WES<br>" . $arr_weeke_sell_r4[$av];
echo "</font></div></td>";
}
echo "</tr>";
echo "</table>";
echo "</td>";
}

if($arr_weekd_net_r5[$av]!=0){
echo "<td>";
echo "<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" style=\"border-right: 1px solid #999999\">";
echo "<tr>";
echo "<td colspan=\"4\" style=\"border-bottom: 1px solid #999999\"><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">5 Bed Room</font></div></td>";
echo "</tr>";
echo "<tr>";
echo "<td bgcolor=\"#FFE6E6\" style=\"border-right: 1px solid #999999\"><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";
echo "WDN<br>" . $arr_weekd_net_r5[$av];
echo "</font></div></td>";
echo "<td bgcolor=\"#D7FFD7\"><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";
echo "WDS<br>" . $arr_weekd_sell_r5[$av];
echo "</font></div></td>";
if($arr_weekd_net_r5[$av]!=$arr_weeke_net_r5[$av]){
echo "<td bgcolor=\"#FFE6E6\" style=\"border-right: 1px solid #999999; border-left: 1px solid #999999\"><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";
echo "WEN<br>" . $arr_weeke_net_r5[$av];
echo "</td>";
echo "</font></div><td bgcolor=\"#D7FFD7\"><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"> ";
echo "WES<br>" . $arr_weeke_sell_r5[$av];
echo "</font></div></td>";
}
echo "</tr>";
echo "</table>";
echo "</td>";
}

if($arr_weekd_net_r6[$av]!=0){
echo "<td>";
echo "<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" style=\"border-right: 1px solid #999999\">";
echo "<tr>";
echo "<td colspan=\"4\" style=\"border-bottom: 1px solid #999999\"><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">6 Bed Room</font></div></td>";
echo "</tr>";
echo "<tr>";
echo "<td bgcolor=\"#FFE6E6\" style=\"border-right: 1px solid #999999\"><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";
echo "WDN<br>" . $arr_weekd_net_r6[$av];
echo "</font></div></td>";
echo "<td bgcolor=\"#D7FFD7\"><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";
echo "WDS<br>" . $arr_weekd_sell_r6[$av];
echo "</font></div></td>";
if($arr_weekd_net_r6[$av]!=$arr_weeke_net_r6[$av]){
echo "<td bgcolor=\"#FFE6E6\" style=\"border-right: 1px solid #999999; border-left: 1px solid #999999\"><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";
echo "WEN<br>" . $arr_weeke_net_r6[$av];
echo "</td>";
echo "</font></div><td bgcolor=\"#D7FFD7\"><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"> ";
echo "WES<br>" . $arr_weeke_sell_r6[$av];
echo "</font></div></td>";
}
echo "</tr>";
echo "</table>";
echo "</td>";
}


if($arr_weekd_net_r7[$av]!=0){
echo "<td>";
echo "<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" style=\"border-right: 1px solid #999999\">";
echo "<tr>";
echo "<td colspan=\"4\" style=\"border-bottom: 1px solid #999999\"><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">7 Bed Room</font></div></td>";
echo "</tr>";
echo "<tr>";
echo "<td bgcolor=\"#FFE6E6\" style=\"border-right: 1px solid #999999\"><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";
echo "WDN<br>" . $arr_weekd_net_r7[$av];
echo "</font></div></td>";
echo "<td bgcolor=\"#D7FFD7\"><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";
echo "WDS<br>" . $arr_weekd_sell_r7[$av];
echo "</font></div></td>";
if($arr_weekd_net_r7[$av]!=$arr_weeke_net_r7[$av]){
echo "<td bgcolor=\"#FFE6E6\" style=\"border-right: 1px solid #999999; border-left: 1px solid #999999\"><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";
echo "WEN<br>" . $arr_weeke_net_r7[$av];
echo "</td>";
echo "</font></div><td bgcolor=\"#D7FFD7\"><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"> ";
echo "WES<br>" . $arr_weeke_sell_r7[$av];
echo "</font></div></td>";
}
echo "</tr>";
echo "</table>";
echo "</td>";
}

if($arr_weekd_net_r8[$av]!=0){
echo "<td>";
echo "<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" style=\"border-right: 1px solid #999999\">";
echo "<tr>";
echo "<td colspan=\"4\" style=\"border-bottom: 1px solid #999999\"><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">8 Bed Room</font></div></td>";
echo "</tr>";
echo "<tr>";
echo "<td bgcolor=\"#FFE6E6\" style=\"border-right: 1px solid #999999\"><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";
echo "WDN<br>" . $arr_weekd_net_r8[$av];
echo "</font></div></td>";
echo "<td bgcolor=\"#D7FFD7\"><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";
echo "WDS<br>" . $arr_weekd_sell_r8[$av];
echo "</font></div></td>";
if($arr_weekd_net_r8[$av]!=$arr_weeke_net_r8[$av]){
echo "<td bgcolor=\"#FFE6E6\" style=\"border-right: 1px solid #999999; border-left: 1px solid #999999\"><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";
echo "WEN<br>" . $arr_weeke_net_r8[$av];
echo "</td>";
echo "</font></div><td bgcolor=\"#D7FFD7\"><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"> ";
echo "WES<br>" . $arr_weeke_sell_r8[$av];
echo "</font></div></td>";
}
echo "</tr>";
echo "</table>";
echo "</td>";
}

if($arr_weekd_net_r9[$av]!=0){
echo "<td>";
echo "<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" style=\"border-right: 1px solid #999999\">";
echo "<tr>";
echo "<td colspan=\"4\" style=\"border-bottom: 1px solid #999999\"><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">9 Bed Room</font></div></td>";
echo "</tr>";
echo "<tr>";
echo "<td bgcolor=\"#FFE6E6\" style=\"border-right: 1px solid #999999\"><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";
echo "WDN<br>" . $arr_weekd_net_r9[$av];
echo "</font></div></td>";
echo "<td bgcolor=\"#D7FFD7\"><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";
echo "WDS<br>" . $arr_weekd_sell_r9[$av];
echo "</font></div></td>";
if($arr_weekd_net_r9[$av]!=$arr_weeke_net_r9[$av]){
echo "<td bgcolor=\"#FFE6E6\" style=\"border-right: 1px solid #999999; border-left: 1px solid #999999\"><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";
echo "WEN<br>" . $arr_weeke_net_r9[$av];
echo "</td>";
echo "</font></div><td bgcolor=\"#D7FFD7\"><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"> ";
echo "WES<br>" . $arr_weeke_sell_r9[$av];
echo "</font></div></td>";
}
echo "</tr>";
echo "</table>";
echo "</td>";
}

if($arr_weekd_net_r10[$av]!=0){
echo "<td>";
echo "<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" style=\"border-right: 1px solid #999999\">";
echo "<tr>";
echo "<td colspan=\"4\" style=\"border-bottom: 1px solid #999999\"><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">10 Bed Room</font></div></td>";
echo "</tr>";
echo "<tr>";
echo "<td bgcolor=\"#FFE6E6\" style=\"border-right: 1px solid #999999\"><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";
echo "WDN<br>" . $arr_weekd_net_r10[$av];
echo "</font></div></td>";
echo "<td bgcolor=\"#D7FFD7\"><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";
echo "WDS<br>" . $arr_weekd_sell_r10[$av];
echo "</font></div></td>";
if($arr_weekd_net_r10[$av]!=$arr_weeke_net_r10[$av]){
echo "<td bgcolor=\"#FFE6E6\" style=\"border-right: 1px solid #999999; border-left: 1px solid #999999\"><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";
echo "WEN<br>" . $arr_weeke_net_r10[$av];
echo "</td>";
echo "</font></div><td bgcolor=\"#D7FFD7\"><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"> ";
echo "WES<br>" . $arr_weeke_sell_r10[$av];
echo "</font></div></td>";
}
echo "</tr>";
echo "</table>";
echo "</td>";
}

if($arr_weekd_net_r11[$av]!=0){
echo "<td>";
echo "<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" style=\"border-right: 1px solid #999999\">";
echo "<tr>";
echo "<td colspan=\"4\" style=\"border-bottom: 1px solid #999999\"><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">11 Bed Room</font></div></td>";
echo "</tr>";
echo "<tr>";
echo "<td bgcolor=\"#FFE6E6\" style=\"border-right: 1px solid #999999\"><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";
echo "WDN<br>" . $arr_weekd_net_r11[$av];
echo "</font></div></td>";
echo "<td bgcolor=\"#D7FFD7\"><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";
echo "WDS<br>" . $arr_weekd_sell_r11[$av];
echo "</font></div></td>";
if($arr_weekd_net_r11[$av]!=$arr_weeke_net_r11[$av]){
echo "<td bgcolor=\"#FFE6E6\" style=\"border-right: 1px solid #999999; border-left: 1px solid #999999\"><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";
echo "WEN<br>" . $arr_weeke_net_r11[$av];
echo "</td>";
echo "</font></div><td bgcolor=\"#D7FFD7\"><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"> ";
echo "WES<br>" . $arr_weeke_sell_r11[$av];
echo "</font></div></td>";
}
echo "</tr>";
echo "</table>";
echo "</td>";
}

if($arr_weekd_net_r12[$av]!=0){
echo "<td>";
echo "<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" style=\"border-right: 1px solid #999999\">";
echo "<tr>";
echo "<td colspan=\"4\" style=\"border-bottom: 1px solid #999999\"><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">12 Bed Room</font></div></td>";
echo "</tr>";
echo "<tr>";
echo "<td bgcolor=\"#FFE6E6\" style=\"border-right: 1px solid #999999\"><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";
echo "WDN<br>" . $arr_weekd_net_r12[$av];
echo "</font></div></td>";
echo "<td bgcolor=\"#D7FFD7\"><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";
echo "WDS<br>" . $arr_weekd_sell_r12[$av];
echo "</font></div></td>";
if($arr_weekd_net_r12[$av]!=$arr_weeke_net_r12[$av]){
echo "<td bgcolor=\"#FFE6E6\" style=\"border-right: 1px solid #999999; border-left: 1px solid #999999\"><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";
echo "WEN<br>" . $arr_weeke_net_r12[$av];
echo "</td>";
echo "</font></div><td bgcolor=\"#D7FFD7\"><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"> ";
echo "WES<br>" . $arr_weeke_sell_r12[$av];
echo "</font></div></td>";
}
echo "</tr>";
echo "</table>";
echo "</td>";
}








echo "</tr></table>";


echo "</td>"; //end of view type </td>

echo "</tr>";  //end of view type </tr>


} // end if for date check


}  // end of for view type




}  // end of for period 


echo "<tr><td colspan=\"2\">&nbsp;</td></tr>";
}  // end of for nationality

echo "<table>";


}


echo "</td></tr>";


if (isset($_POST['action']) && $_POST['action'] == 'submitted') {




$cbb=0;

if($_POST["inscb"]=="on"){
session_start();
$_SESSION['cb'] = 1;
}

$cbb=$_SESSION['cb'];
unset($_SESSION['cb']);

$vy=$vm=$vd=0;
$vy1=$vm1=$vd1=0;

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


$roomselt =  array();

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





for($irt=1; $irt<13; $irt++){

$forinswdn[$irt-1] = $_POST['rrwdn'.$irt];
$forinswds[$irt-1] =  $_POST['rrwds'.$irt];

$forinswen[$irt-1] = $_POST['rrwen'.$irt];
$forinswes[$irt-1] =  $_POST['rrwes'.$irt];

}


$insbul = 1;

if($cbb==1) {

$query_gsno ="select i_rate_sno from seq";

$result_gsno = pg_query($query_gsno);

if (!$result_gsno) {
echo "An error occured.\n";
exit;
		}
while ($rows_gsno = pg_fetch_array($result_gsno)){
$gsno_seq = $rows_gsno["i_rate_sno"];
}

pg_free_result($result_gsno);


$sqlinsgr = "insert into 	ind_rates(rate_sno,hotel_id,from_date,to_date,weekd_net_r1,weekd_sell_r1,weekd_net_r2,weekd_sell_r2,weekd_net_r3,weekd_sell_r3,weekd_net_r4,weekd_sell_r4,weekd_net_r5,weekd_sell_r5,weekd_net_r6,weekd_sell_r6,weekd_net_r7,weekd_sell_r7,weekd_net_r8,weekd_sell_r8,weekd_net_r9,weekd_sell_r9,weekd_net_r10,weekd_sell_r10,weekd_net_r11,weekd_sell_r11,weekd_net_r12,weekd_sell_r12,weeke_net_r1,weeke_sell_r1,weeke_net_r2,weeke_sell_r2,weeke_net_r3,weeke_sell_r3,weeke_net_r4,weeke_sell_r4,weeke_net_r5,weeke_sell_r5,weeke_net_r6,weeke_sell_r6,weeke_net_r7,weeke_sell_r7,weeke_net_r8,weeke_sell_r8,weeke_net_r9,weeke_sell_r9,weeke_net_r10,weeke_sell_r10,weeke_net_r11,weeke_sell_r11,weeke_net_r12,weeke_sell_r12,nationality,nationalityl,view_type,breakfast,halfboard_rate,fullboard_rate,sahoor_rate,iftar_rate) values($gsno_seq,$s_hotelsb,'$fromd','$tod',$forinswdn[0],$forinswds[0],$forinswdn[1],$forinswds[1],$forinswdn[2],$forinswds[2],$forinswdn[3],$forinswds[3],$forinswdn[4],$forinswds[4],$forinswdn[5],$forinswds[5],$forinswdn[6],$forinswds[6],$forinswdn[7],$forinswds[7],$forinswdn[8],$forinswds[8],$forinswdn[9],$forinswds[9],$forinswdn[10],$forinswds[10],$forinswdn[11],$forinswds[11],$forinswen[0],$forinswes[0],$forinswen[1],$forinswes[1],$forinswen[2],$forinswes[2],$forinswen[3],$forinswes[3],$forinswen[4],$forinswes[4],$forinswen[5],$forinswes[5],$forinswen[6],$forinswes[6],$forinswen[7],$forinswes[7],$forinswen[8],$forinswes[8],$forinswen[9],$forinswes[9],$forinswen[10],$forinswes[10],$forinswen[11],$forinswes[11],'$s_nation', '$s_nation1','$s_viewtype','$ins_breakfast','$ins_halfboard','$ins_fullboard','$ins_sahoor','$ins_iftar')"; 
pg_query($sqlinsgr);


$sequpdateg_rate_sno = "update seq set i_rate_sno=i_rate_sno+1";
pg_query($sequpdateg_rate_sno);

$cbb=0;



} //end if insert








$vd=$mad;
$vm=$mam;
$vy=$may;

$vd1=$md;
$vm1=$mm;
$vy1=$my;




$roomselt[] =  $_POST['roomtype1'];

//print_r($roomselt);

} //end if submit
?>
                          <form name="gquot" action="<?php echo $_SERVER['PHP_SELF']; ?>"  method="post" onSubmit="return fun2(this)">
                            <tr> 
                              <td colspan="5">&nbsp;</td>
                            </tr>
                            <tr bgcolor="#CCCCCC"> 
                              <td colspan="5"><img src="../images/hotel_icon.gif" width="23" height="14" align="absmiddle">&nbsp;Hotel 
                                Rates Entry  
                              <input type="button" id ="hotelreport" name="hotelreport" value="Hotel Rates Report" onClick="OpenWindow()"> </td>
                            </tr>
                            <tr> 
                              <td colspan="5">Hotel: 
                                <select id="hotelsb" name="hotelsb">
<?
if ($s_hotelsb!="") {
	
echo  "<option value=\"$s_hotelsb\">$s_hname - $s_city</option>";}
?>
								  <option value="selecth">Select Hotel</option>
                                  <?


		for($i=0;$i<count($array_hotel_id);$i++){

  echo  "<option value=\"$array_hotel_id[$i]\">$array_hotel[$i] - $array_city[$i]</option>";

}
	?>
                                </select> <input type="button" name="grates" value="Get Rates" onClick="checkh();"> 
                                <script>
			
			function checkh(){
			if(document.getElementById ('hotelsb').value == "selecth"){
			alert("Please Select Hotel");
            }
			else{
			document.gquot.submit();
			}
            }

			</script> </td>
                            </tr>
                            <tr> 
                              <td colspan="2"><table>
                                  <tr> 
                                    <td><font size="2" face="Verdana, Arial, Helvetica, sans-serif">CheckIn 
                                      <select name="dDay" class="selBox">
                                      </select>
                                      </font></td>
                                    <td><font size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
                                      <select name="dMonth" class="selBox">
                                      </select>
                                      </font></td>
                                    <td><font size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
                                      <select name="dYear" class="selBox">
                                      </select>
                                      </font></td>
                                  </tr>
                                </table></td>
                              <td colspan="3"><table>
                                  <tr> 
                                    <td><font size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
                                      CheckOut
                                      <select name="d1Day" class="selBox">
                                      </select>
                                      </font></td>
                                    <td><font size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
                                      <select name="d1Month" class="selBox">
                                      </select>
                                      </font></td>
                                    <td><font size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
                                      <select name="d1Year" class="selBox">
                                      </select>
                                      </font></td>
                                  </tr>
                                </table></td>
                            </tr>
                            <tr> 
                              <td colspan="5"> Type of Room 
                                <select id="roomtype1" name="roomtype1[]" MULTIPLE SIZE="1" onChange="roomt1();"  >
                                  <option value="1">Single</option>
                                  <option value="2">Double</option>
                                  <option value="3">Triple</option>
                                  <option value="4">Quad</option>
                                  <option value="5">5 in Room</option>
                                  <option value="6">6 in Room</option>
                                  <option value="7">7 in Room</option>
                                  <option value="8">8 in Room</option>
                                  <option value="9">9 in Room</option>
                                  <option value="10">10 in Room</option>
                                  <option value="11">11 in Room</option>
                                  <option value="12">12 in Room</option>
                                </select> <input type="button" name="showa" value="show" onClick="roomt1();">
                                View Type 
                                <select id="viewtype" name="viewtype">
                              
							  <?
if (isset($_POST['action']) && $_POST['action'] == 'submitted') {
				echo  "<option value=\"$s_viewt\">$s_viewtype</option>";
			  }
						for($vt=0; $vt<count($a_viewt); $vt++){
							
							  echo  "<option value=\"$a_viewt[$vt]\">$a_viewtype[$vt]</option>";
							  
							  }

							  ?>
								  
                                </select> </td>
                            </tr>
                            <script>

'<? for($rs=0; $rs<count($roomselt[0]); $rs++){ ?>'

document.getElementById ('roomtype1').options['<? echo $roomselt[0][$rs]-1 ?>'].selected = true;



'<?}?>'	

		
	
	function roomt1(){ 


'<? for($vt=1; $vt<13; $vt++){ ?>'


var v = document.getElementById ('roomtype1').options['<? echo $vt-1 ?>'].selected ;


if(v){

	document.getElementById ('roomtypelab').style.visibility = 'visible';
	document.getElementById ('weekdayslab').style.visibility = 'visible';
	document.getElementById ('weekendslab').style.visibility = 'visible';
	document.getElementById ('samev').style.visibility = 'visible';

	document.getElementById ('rtlab<? echo $vt ?>').style.visibility = 'visible';
	document.getElementById ('rrwdn<? echo $vt ?>').style.visibility = 'visible';
    document.getElementById ('rrwds<? echo $vt ?>').style.visibility = 'visible';
	document.getElementById ('rrwen<? echo $vt ?>').style.visibility = 'visible';
    document.getElementById ('rrwes<? echo $vt ?>').style.visibility = 'visible';

    document.getElementById ('rrwdnb<? echo $vt ?>').style.visibility = 'visible';
    document.getElementById ('rrwdsb<? echo $vt ?>').style.visibility = 'visible';


}
else {
	document.getElementById ('rtlab<? echo $vt ?>').style.visibility = 'hidden';
	document.getElementById ('rrwdn<? echo $vt ?>').style.visibility = 'hidden';
    document.getElementById ('rrwds<? echo $vt ?>').style.visibility = 'hidden';
	document.getElementById ('rrwen<? echo $vt ?>').style.visibility = 'hidden';
    document.getElementById ('rrwes<? echo $vt ?>').style.visibility = 'hidden';

	document.getElementById ('rrwdnb<? echo $vt ?>').style.visibility = 'hidden';
    document.getElementById ('rrwdsb<? echo $vt ?>').style.visibility = 'hidden';

}


'<?}?>'	


}

function sameas(){
'<? for($vts=1; $vts<13; $vts++){ ?>'


var vs = document.getElementById ('roomtype1').options['<? echo $vts-1 ?>'].selected ;


if(vs){
    if(document.getElementById ('rrwen<? echo $vts ?>').value==0){
	document.getElementById ('rrwen<? echo $vts ?>').value = document.getElementById ('rrwdn<? echo $vts ?>').value;} 
    if(document.getElementById ('rrwes<? echo $vts ?>').value==0){
    document.getElementById ('rrwes<? echo $vts ?>').value = document.getElementById ('rrwds<? echo $vts ?>').value; }

}

'<?}?>'	

}


</script>
                            <tr><td align="center"><label id="roomtypelab" name="roomtypelab" style="visibility:hidden" >Room Type</label>	
                            </td>  
							<td colspan="3" align="center">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							<label id="weekdayslab" name="weekdayslab" style="visibility:hidden" >WeekDays</label>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<input type="button" id="samev" name="samev"  size="1" style="visibility:hidden" value="-->" onClick="sameas();"> 
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							<label id="weekendslab" name="weekendslab" style="visibility:hidden" >WeekEnds</label>
							</td>

							<tr> 
                              <td colspan="1" align="center" > 
							  <label id="rtlab1" name="rtlab1" style="visibility:hidden" >Single</label>
							  </td>
							  <td colspan="2" align="center"><INPUT TYPE="button"  id="rrwdnb1" name="rrwdnb1" VALUE="+" onClick="add1()" style="visibility:hidden"><input type="text" id="rrwdn1" name="rrwdn1" size="1" style="visibility:hidden" value="0"> 
                                <input type="text" id="rrwds1" name="rrwds1" size="1" style="visibility:hidden" value="0"><INPUT TYPE="button" id="rrwdsb1" name="rrwdsb1" VALUE="c" onClick="caln1()" style="visibility:hidden">
						
                        <SCRIPT LANGUAGE="JavaScript">

function add1() {
    var favorite = prompt('How much you want to add ?', 0);
     
     if (favorite) {  
		document.getElementById('rrwds1').value = Math.ceil( parseFloat(document.getElementById('rrwdn1').value) + parseFloat(favorite));
     }
     else alert("You pressed Cancel or no value was entered!");
}

function caln1() {
    var favorite = prompt('Agent Commission % ?', 0);

     if (favorite) {  
		document.getElementById('rrwdn1').value =  parseFloat(document.getElementById('rrwds1').value) - (( parseFloat(document.getElementById('rrwds1').value)*parseFloat(favorite))/100);
     }
     else alert("You pressed Cancel or no value was entered!");
}


</SCRIPT>

                     
							  </td>	
							  	<td  colspan="2" align="left">
                                <input type="text" id="rrwen1" name="rrwen1" size="1" style="visibility:hidden" value="0"> 
                                <input type="text" id="rrwes1" name="rrwes1" size="1" style="visibility:hidden" value="0">
							  </td>	
                            </tr>

							<tr> 
                              <td colspan="1" align="center" > 
							  <label id="rtlab2" name="rtlab2" style="visibility:hidden" >Double</label>
							  </td>
							  <td colspan="2" align="center"><INPUT TYPE="button"  id="rrwdnb2" name="rrwdnb2" VALUE="+" onClick="add2()" style="visibility:hidden"><input type="text" id="rrwdn2" name="rrwdn2" size="1" style="visibility:hidden" value="0"> 
                                <input type="text" id="rrwds2" name="rrwds2" size="1" style="visibility:hidden" value="0"><INPUT TYPE="button" id="rrwdsb2" name="rrwdsb2" VALUE="c" onClick="caln2()" style="visibility:hidden">
 <SCRIPT LANGUAGE="JavaScript">

function add2() {
    var favorite = prompt('How much you want to add ?', 0);
     
     if (favorite) {  
		document.getElementById('rrwds2').value = Math.ceil( parseFloat(document.getElementById('rrwdn2').value) + parseFloat(favorite));
     }
     else alert("You pressed Cancel or no value was entered!");
}

function caln2() {
    var favorite = prompt('Agent Commission % ?', 0);

     if (favorite) {  
		document.getElementById('rrwdn2').value = parseFloat(document.getElementById('rrwds2').value) - (( parseFloat(document.getElementById('rrwds2').value)*parseFloat(favorite))/100);
     }
     else alert("You pressed Cancel or no value was entered!");
}


</SCRIPT>

							  </td>	
							  	<td  colspan="2" align="left">
                                <input type="text" id="rrwen2" name="rrwen2" size="1" style="visibility:hidden" value="0"> 
                                <input type="text" id="rrwes2" name="rrwes2" size="1" style="visibility:hidden" value="0">
							  </td>	
                            </tr>

							<tr> 
                              <td colspan="1" align="center" > 
							  <label id="rtlab3" name="rtlab3" style="visibility:hidden" >Triple</label>
							  </td>
							  <td colspan="2" align="center">
                                <INPUT TYPE="button"  id="rrwdnb3" name="rrwdnb3" VALUE="+" onClick="add3()" style="visibility:hidden"><input type="text" id="rrwdn3" name="rrwdn3" size="1" style="visibility:hidden" value="0"> 
                                <input type="text" id="rrwds3" name="rrwds3" size="1" style="visibility:hidden" value="0"><INPUT TYPE="button" id="rrwdsb3" name="rrwdsb3" VALUE="c" onClick="caln3()" style="visibility:hidden">
 <SCRIPT LANGUAGE="JavaScript">

function add3() {
    var favorite = prompt('How much you want to add ?', 0);
     
     if (favorite) {  
		document.getElementById('rrwds3').value = Math.ceil( parseFloat(document.getElementById('rrwdn3').value) + parseFloat(favorite));
     }
     else alert("You pressed Cancel or no value was entered!");
}

function caln3() {
    var favorite = prompt('Agent Commission % ?', 0);

     if (favorite) {  
		document.getElementById('rrwdn3').value = parseFloat(document.getElementById('rrwds3').value) - (( parseFloat(document.getElementById('rrwds3').value)*parseFloat(favorite))/100);
     }
     else alert("You pressed Cancel or no value was entered!");
}


</SCRIPT>

							  </td>	
							  	<td  colspan="2" align="left">
                                <input type="text" id="rrwen3" name="rrwen3" size="1" style="visibility:hidden" value="0"> 
                                <input type="text" id="rrwes3" name="rrwes3" size="1" style="visibility:hidden" value="0">
							  </td>	
                            </tr>

							<tr> 
                              <td colspan="1" align="center" > 
							  <label id="rtlab4" name="rtlab4" style="visibility:hidden" >Quad</label>
							  </td>
							  <td colspan="2" align="center">
                                <INPUT TYPE="button"  id="rrwdnb4" name="rrwdnb4" VALUE="+" onClick="add4()" style="visibility:hidden"><input type="text" id="rrwdn4" name="rrwdn4" size="1" style="visibility:hidden" value="0"> 
                                <input type="text" id="rrwds4" name="rrwds4" size="1" style="visibility:hidden" value="0"><INPUT TYPE="button" id="rrwdsb4" name="rrwdsb4" VALUE="c" onClick="caln4()" style="visibility:hidden">
 <SCRIPT LANGUAGE="JavaScript">

function add4() {
    var favorite = prompt('How much you want to add ?', 0);
     
     if (favorite) {  
		document.getElementById('rrwds4').value = Math.ceil( parseFloat(document.getElementById('rrwdn4').value) + parseFloat(favorite));
     }
     else alert("You pressed Cancel or no value was entered!");
}

function caln4() {
    var favorite = prompt('Agent Commission % ?', 0);

     if (favorite) {  
		document.getElementById('rrwdn4').value = parseFloat(document.getElementById('rrwds4').value) - (( parseFloat(document.getElementById('rrwds4').value)*parseFloat(favorite))/100);
     }
     else alert("You pressed Cancel or no value was entered!");
}


</SCRIPT>
							  </td>	
							  	<td  colspan="2" align="left">
                                <input type="text" id="rrwen4" name="rrwen4" size="1" style="visibility:hidden" value="0">  
                                <input type="text" id="rrwes4" name="rrwes4" size="1" style="visibility:hidden" value="0">
							  </td>	
                            </tr>

							<tr> 
                              <td colspan="1" align="center" > 
							  <label id="rtlab5" name="rtlab5" style="visibility:hidden" >5 Paxs In Room</label>
							  </td>
							  <td colspan="2" align="center">
                                 <INPUT TYPE="button"  id="rrwdnb5" name="rrwdnb5" VALUE="+" onClick="add5()" style="visibility:hidden"><input type="text" id="rrwdn5" name="rrwdn5" size="1" style="visibility:hidden" value="0"> 
                                <input type="text" id="rrwds5" name="rrwds5" size="1" style="visibility:hidden" value="0"><INPUT TYPE="button" id="rrwdsb5" name="rrwdsb5" VALUE="c" onClick="caln5()" style="visibility:hidden">
 <SCRIPT LANGUAGE="JavaScript">

function add5() {
    var favorite = prompt('How much you want to add ?', 0);
     
     if (favorite) {  
		document.getElementById('rrwds5').value = Math.ceil( parseFloat(document.getElementById('rrwdn5').value) + parseFloat(favorite));
     }
     else alert("You pressed Cancel or no value was entered!");
}

function caln5() {
    var favorite = prompt('Agent Commission % ?', 0);

     if (favorite) {  
		document.getElementById('rrwdn5').value = parseFloat(document.getElementById('rrwds5').value) - (( parseFloat(document.getElementById('rrwds5').value)*parseFloat(favorite))/100);
     }
     else alert("You pressed Cancel or no value was entered!");
}


</SCRIPT>
							  </td>	
							  	<td  colspan="2" align="left">
                                <input type="text" id="rrwen5" name="rrwen5" size="1" style="visibility:hidden" value="0"> 
                                <input type="text" id="rrwes5" name="rrwes5" size="1" style="visibility:hidden" value="0">
							  </td>	
                            </tr>


							<tr> 
                              <td colspan="1" align="center" > 
							  <label id="rtlab6" name="rtlab6" style="visibility:hidden" >6 Paxs In Room</label>
							  </td>
							  <td colspan="2" align="center">
                                <INPUT TYPE="button"  id="rrwdnb6" name="rrwdnb6" VALUE="+" onClick="add6()" style="visibility:hidden"><input type="text" id="rrwdn6" name="rrwdn6" size="1" style="visibility:hidden" value="0"> 
                                <input type="text" id="rrwds6" name="rrwds6" size="1" style="visibility:hidden" value="0"><INPUT TYPE="button" id="rrwdsb6" name="rrwdsb6" VALUE="c" onClick="caln6()" style="visibility:hidden">
 <SCRIPT LANGUAGE="JavaScript">

function add6() {
    var favorite = prompt('How much you want to add ?', 0);
     
     if (favorite) {  
		document.getElementById('rrwds6').value = Math.ceil( parseFloat(document.getElementById('rrwdn6').value) + parseFloat(favorite));
     }
     else alert("You pressed Cancel or no value was entered!");
}

function caln6() {
    var favorite = prompt('Agent Commission % ?', 0);

     if (favorite) {  
		document.getElementById('rrwdn6').value = parseFloat(document.getElementById('rrwds6').value) - (( parseFloat(document.getElementById('rrwds6').value)*parseFloat(favorite))/100);
     }
     else alert("You pressed Cancel or no value was entered!");
}


</SCRIPT>
							  </td>	
							  	<td  colspan="2" align="left">
                                <input type="text" id="rrwen6" name="rrwen6" size="1" style="visibility:hidden" value="0"> 
                                <input type="text" id="rrwes6" name="rrwes6" size="1" style="visibility:hidden" value="0">
							  </td>	
                            </tr>


							<tr> 
                              <td colspan="1" align="center" > 
							  <label id="rtlab7" name="rtlab7" style="visibility:hidden" >7 Paxs In Room</label>
							  </td>
							  <td colspan="2" align="center">
                                <INPUT TYPE="button"  id="rrwdnb7" name="rrwdnb7" VALUE="+" onClick="add7()" style="visibility:hidden"><input type="text" id="rrwdn7" name="rrwdn7" size="1" style="visibility:hidden" value="0"> 
                                <input type="text" id="rrwds7" name="rrwds7" size="1" style="visibility:hidden" value="0"><INPUT TYPE="button" id="rrwdsb7" name="rrwdsb7" VALUE="c" onClick="caln7()" style="visibility:hidden">
 <SCRIPT LANGUAGE="JavaScript">

function add7() {
    var favorite = prompt('How much you want to add ?', 0);
     
     if (favorite) {  
		document.getElementById('rrwds7').value = Math.ceil( parseFloat(document.getElementById('rrwdn7').value) + parseFloat(favorite));
     }
     else alert("You pressed Cancel or no value was entered!");
}

function caln7() {
    var favorite = prompt('Agent Commission % ?', 0);

     if (favorite) {  
		document.getElementById('rrwdn7').value = parseFloat(document.getElementById('rrwds7').value) - (( parseFloat(document.getElementById('rrwds7').value)*parseFloat(favorite))/100);
     }
     else alert("You pressed Cancel or no value was entered!");
}


</SCRIPT>
							  </td>	
							  	<td  colspan="2" align="left">
                                <input type="text" id="rrwen7" name="rrwen7" size="1" style="visibility:hidden" value="0"> 
                                <input type="text" id="rrwes7" name="rrwes7" size="1" style="visibility:hidden" value="0">
							  </td>	
                            </tr>

							<tr> 
                              <td colspan="1" align="center" > 
							  <label id="rtlab8" name="rtlab8" style="visibility:hidden" >8 Paxs In Room</label>
							  </td>
							  <td colspan="2" align="center">
                                <INPUT TYPE="button"  id="rrwdnb8" name="rrwdnb8" VALUE="+" onClick="add8()" style="visibility:hidden"><input type="text" id="rrwdn8" name="rrwdn8" size="1" style="visibility:hidden" value="0"> 
                                <input type="text" id="rrwds8" name="rrwds8" size="1" style="visibility:hidden" value="0"><INPUT TYPE="button" id="rrwdsb8" name="rrwdsb8" VALUE="c" onClick="caln8()" style="visibility:hidden">
 <SCRIPT LANGUAGE="JavaScript">

function add8() {
    var favorite = prompt('How much you want to add ?', 0);
     
     if (favorite) {  
		document.getElementById('rrwds8').value = Math.ceil( parseFloat(document.getElementById('rrwdn8').value) + parseFloat(favorite));
     }
     else alert("You pressed Cancel or no value was entered!");
}

function caln8() {
    var favorite = prompt('Agent Commission % ?', 0);

     if (favorite) {  
		document.getElementById('rrwdn8').value = parseFloat(document.getElementById('rrwds8').value) - (( parseFloat(document.getElementById('rrwds8').value)*parseFloat(favorite))/100);
     }
     else alert("You pressed Cancel or no value was entered!");
}


</SCRIPT>
							  </td>	
							  	<td  colspan="2" align="left">
                                <input type="text" id="rrwen8" name="rrwen8" size="1" style="visibility:hidden" value="0"> 
                                <input type="text" id="rrwes8" name="rrwes8" size="1" style="visibility:hidden" value="0">
							  </td>	
                            </tr>

							<tr> 
                              <td colspan="1" align="center" > 
							  <label id="rtlab9" name="rtlab9" style="visibility:hidden" >9 Paxs In Room</label>
							  </td>
							  <td colspan="2" align="center">
                                 <INPUT TYPE="button"  id="rrwdnb9" name="rrwdnb9" VALUE="+" onClick="add9()" style="visibility:hidden"><input type="text" id="rrwdn9" name="rrwdn9" size="1" style="visibility:hidden" value="0"> 
                                <input type="text" id="rrwds9" name="rrwds9" size="1" style="visibility:hidden" value="0"><INPUT TYPE="button" id="rrwdsb9" name="rrwdsb9" VALUE="c" onClick="caln9()" style="visibility:hidden">
 <SCRIPT LANGUAGE="JavaScript">

function add9() {
    var favorite = prompt('How much you want to add ?', 0);
     
     if (favorite) {  
		document.getElementById('rrwds9').value = Math.ceil( parseFloat(document.getElementById('rrwdn9').value) + parseFloat(favorite));
     }
     else alert("You pressed Cancel or no value was entered!");
}

function caln9() {
    var favorite = prompt('Agent Commission % ?', 0);

     if (favorite) {  
		document.getElementById('rrwdn9').value = parseFloat(document.getElementById('rrwds9').value) - (( parseFloat(document.getElementById('rrwds9').value)*parseFloat(favorite))/100);
     }
     else alert("You pressed Cancel or no value was entered!");
}


</SCRIPT>
							  </td>	
							  	<td  colspan="2" align="left">
                                <input type="text" id="rrwen9" name="rrwen9" size="1" style="visibility:hidden" value="0"> 
                                <input type="text" id="rrwes9" name="rrwes9" size="1" style="visibility:hidden" value="0">
							  </td>	
                            </tr>

							<tr> 
                              <td colspan="1" align="center" > 
							  <label id="rtlab10" name="rtlab10" style="visibility:hidden" >10 Paxs In Room</label>
							  </td>
							  <td colspan="2" align="center">
                                 <INPUT TYPE="button"  id="rrwdnb10" name="rrwdnb10" VALUE="+" onClick="add10()" style="visibility:hidden"><input type="text" id="rrwdn10" name="rrwdn10" size="1" style="visibility:hidden" value="0"> 
                                <input type="text" id="rrwds10" name="rrwds10" size="1" style="visibility:hidden" value="0"><INPUT TYPE="button" id="rrwdsb10" name="rrwdsb10" VALUE="c" onClick="caln10()" style="visibility:hidden">
 <SCRIPT LANGUAGE="JavaScript">

function add10() {
    var favorite = prompt('How much you want to add ?', 0);
     
     if (favorite) {  
		document.getElementById('rrwds10').value = Math.ceil( parseFloat(document.getElementById('rrwdn10').value) + parseFloat(favorite));
     }
     else alert("You pressed Cancel or no value was entered!");
}

function caln10() {
    var favorite = prompt('Agent Commission % ?', 0);

     if (favorite) {  
		document.getElementById('rrwdn10').value = parseFloat(document.getElementById('rrwds10').value) - (( parseFloat(document.getElementById('rrwds10').value)*parseFloat(favorite))/100);
     }
     else alert("You pressed Cancel or no value was entered!");
}


</SCRIPT>
							  </td>	
							  	<td  colspan="2" align="left">
                                <input type="text" id="rrwen10" name="rrwen10" size="1" style="visibility:hidden" value="0"> 
                                <input type="text" id="rrwes10" name="rrwes10" size="1" style="visibility:hidden" value="0">
							  </td>	
                            </tr>

							<tr> 
                              <td colspan="1" align="center" > 
							  <label id="rtlab11" name="rtlab11" style="visibility:hidden" >11 Paxs In Room</label>
							  </td>
							  <td colspan="2" align="center">
                                <INPUT TYPE="button"  id="rrwdnb11" name="rrwdnb11" VALUE="+" onClick="add11()" style="visibility:hidden"><input type="text" id="rrwdn11" name="rrwdn11" size="1" style="visibility:hidden" value="0"> 
                                <input type="text" id="rrwds11" name="rrwds11" size="1" style="visibility:hidden" value="0"><INPUT TYPE="button" id="rrwdsb11" name="rrwdsb11" VALUE="c" onClick="caln11()" style="visibility:hidden">
 <SCRIPT LANGUAGE="JavaScript">

function add11() {
    var favorite = prompt('How much you want to add ?', 0);
     
     if (favorite) {  
		document.getElementById('rrwds11').value = Math.ceil( parseFloat(document.getElementById('rrwdn11').value) + parseFloat(favorite));
     }
     else alert("You pressed Cancel or no value was entered!");
}

function caln11() {
    var favorite = prompt('Agent Commission % ?', 0);

     if (favorite) {  
		document.getElementById('rrwdn11').value = parseFloat(document.getElementById('rrwds11').value) - (( parseFloat(document.getElementById('rrwds11').value)*parseFloat(favorite))/100);
     }
     else alert("You pressed Cancel or no value was entered!");
}


</SCRIPT>
							  </td>	
							  	<td  colspan="2" align="left">
                                <input type="text" id="rrwen11" name="rrwen11" size="1" style="visibility:hidden" value="0"> 
                                <input type="text" id="rrwes11" name="rrwes11" size="1" style="visibility:hidden" value="0">
							  </td>	
                            </tr>

							<tr> 
                              <td colspan="1" align="center" > 
							  <label id="rtlab12" name="rtlab12" style="visibility:hidden" >12 Paxs In Room</label>
							  </td>
							  <td colspan="2" align="center">
                                <INPUT TYPE="button"  id="rrwdnb12" name="rrwdnb12" VALUE="+" onClick="add12()" style="visibility:hidden"><input type="text" id="rrwdn12" name="rrwdn12" size="1" style="visibility:hidden" value="0"> 
                                <input type="text" id="rrwds12" name="rrwds12" size="1" style="visibility:hidden" value="0"><INPUT TYPE="button" id="rrwdsb12" name="rrwdsb12" VALUE="c" onClick="caln12()" style="visibility:hidden">
 <SCRIPT LANGUAGE="JavaScript">

function add12() {
    var favorite = prompt('How much you want to add ?', 0);
     
     if (favorite) {  
		document.getElementById('rrwds12').value = Math.ceil( parseFloat(document.getElementById('rrwdn12').value) + parseFloat(favorite));
     }
     else alert("You pressed Cancel or no value was entered!");
}

function caln12() {
    var favorite = prompt('Agent Commission % ?', 0);

     if (favorite) {  
		document.getElementById('rrwdn12').value = parseFloat(document.getElementById('rrwds12').value) - (( parseFloat(document.getElementById('rrwds12').value)*parseFloat(favorite))/100);
     }
     else alert("You pressed Cancel or no value was entered!");
}


</SCRIPT>
							  </td>	
							  	<td  colspan="2" align="left">
                                <input type="text" id="rrwen12" name="rrwen12" size="1" style="visibility:hidden" value="0"> 
                                <input type="text" id="rrwes12" name="rrwes12" size="1" style="visibility:hidden" value="0">
							  </td>	
                            </tr>




							<tr> 
                              <td>BreakFast<br>
                                <select id="bf" name="bf">
 
								<option value="<? echo $s_breakfast; ?>"><? echo $s_breakfast; ?></option>

                                  <option value="Included">Included</option>
                                  <option value="Available">Available</option>
                                  <option value="Not Available">Not Available</option>
                                </select>
                                <br>
                                <input type="text" id="bft" name="bft" size="1" value="<? echo $t_breakfast; ?>"> 
                              </td>
                              <td>HalfBoard<br>
								<select id="hb" name="hb">
							<option value="<? echo $s_halfboard; ?>"><? echo $s_halfboard; ?></option>

								  <option value="Included">Included</option>
                                  <option value="Available">Available</option>
                                  <option value="Not Available">Not Available</option>
                                </select>
                                <br>
                                <input type="text" id="hbt" name="hbt" size="1" value="<? echo $t_halfboard; ?>"> 
                              </td>
                              <td>FullBoard<br>
                                <select id="fb" name="fb">
										<option value="<? echo $s_fullboard; ?>"><? echo $s_fullboard; ?></option>

                                  <option value="Included">Included</option>
                                  <option value="Available">Available</option>
                                  <option value="Not Available">Not Available</option>
                                </select>
                                <br>
                                <input type="text" id="fbt" name="fbt" size="1" value="<? echo $t_fullboard; ?>"> 
                              </td>
                                    <td>Sahoor<br>

									  <select id="sah" name="sah">
											<option value="<? echo $s_sahoor; ?>"><? echo $s_sahoor; ?></option>
                                  <option value="Included">Included</option>
                                  <option value="Available">Available</option>
                                  <option value="Not Available">Not Available</option>

                                      </select>
                                      <br>
                                      <input type="text" id="saht" name="saht" size="1" value="<? echo $t_sahoor; ?>"></td>
                                    <td>Iftar<br>

                                      <select id="ift" name="ift">
											<option value="<? echo $s_iftar; ?>"><? echo $s_iftar; ?></option>

								  <option value="Included">Included</option>
                                  <option value="Available">Available</option>
                                  <option value="Not Available">Not Available</option>
                                      </select>
                                      <br>
                                      <input type="text" id="iftt" name="iftt" size="1" value="<? echo $t_iftar; ?>"></td>

                            </tr>
                            <tr>
                              <td colspan="5">Nationality:             <select id="scountry" name="scountry[]" multiple size=3 onChange="getnat();">
              <option value="All">All</option>
			  <option value="GCC">GCC</option>
			  <option value="Europe">Europe</option>
			  <option value="Far East">Far East</option>
			  <option value="South Asia">South Asia</option>
              <option value="Afghanistan">Afghanistan</option>
              <option value="Albania">Albania</option>
              <option value="Algeria">Algeria</option>
              <option value="American Samoa">American Samoa</option>
              <option value="Andorra">Andorra</option>
              <option value="Angola">Angola</option>
              <option value="Anguilla">Anguilla</option>
              <option value="Antarctica">Antarctica</option>
              <option value="Antigua and Barbuda">Antigua and Barbuda</option>
              <option value="Argentina">Argentina</option>
              <option value="Aruba">Aruba</option>
              <option value="Australia">Australia</option>
              <option value="Austria">Austria</option>
              <option value="Bahamas">Bahamas</option>
              <option value="Bahrain">Bahrain</option>
              <option value="Bangladesh">Bangladesh</option>
              <option value="Barbados">Barbados</option>
              <option value="Belgium">Belgium</option>
              <option value="Belize">Belize</option>
              <option value="Benin">Benin</option>
              <option value="Bermuda">Bermuda</option>
              <option value="Bhutan">Bhutan</option>
              <option value="Bolivia">Bolivia</option>
              <option value="Botswana">Botswana</option>
              <option value="Brazil">Brazil</option>
              <option value="Brunei">Brunei</option>
              <option value="Bulgaria">Bulgaria</option>
              <option value="Burkina Faso">Burkina Faso</option>
              <option value="Burundi">Burundi</option>
              <option value="Cambodia">Cambodia</option>
              <option value="Cameroon">Cameroon</option>
              <option value="Canada">Canada</option>
              <option value="Cape Verde">Cape Verde</option>
              <option value="Cayman Islands">Cayman Islands</option>
              <option value="Central African Republic">Central African Republic</option>
              <option value="Chad">Chad</option>
              <option value="Chile">Chile</option>
              <option value="China">China</option>
              <option value="Christmas Island">Christmas Island</option>
              <option value="Cocos Keeling Islands">Cocos Keeling Islands</option>
              <option value="Colombia">Colombia</option>
              <option value="Comoros">Comoros</option>
              <option value="Congo">Congo</option>
              <option value="Cook Islands">Cook Islands</option>
              <option value="Costa Rica">Costa Rica</option>
              <option value="Croatia">Croatia</option>
              <option value="Cuba">Cuba</option>
              <option value="Cyprus">Cyprus</option>
              <option value="Czech Republic">Czech Republic</option>
              <option value="Denmark">Denmark</option>
              <option value="Djibouti">Djibouti</option>
              <option value="Dominica">Dominica</option>
              <option value="Dominican Republic">Dominican Republic</option>
              <option value="Ecuador">Ecuador</option>
              <option value="Egypt">Egypt</option>
              <option value="El Salvador">El Salvador</option>
              <option value="Enderbury Islands">Enderbury Islands</option>
              <option value="Equatorial Guinea">Equatorial Guinea</option>
              <option value="Estonia">Estonia</option>
              <option value="Ethiopia">Ethiopia</option>
              <option value="Falkland Islands">Falkland Islands</option>
              <option value="Faroe Islands">Faroe Islands</option>
              <option value="Fiji">Fiji</option>
              <option value="Finland">Finland</option>
              <option value="France">France</option>
              <option value="French Guiana">French Guiana</option>
              <option value="French Polynesia">French Polynesia</option>
              <option value="Gabon">Gabon</option>
              <option value="Gambia">Gambia</option>
              <option value="Germany">Germany</option>
              <option value="Ghana">Ghana</option>
              <option value="Gibraltar">Gibraltar</option>
              <option value="Greece">Greece</option>
              <option value="Greenland">Greenland</option>
              <option value="Grenada">Grenada</option>
              <option value="Grenadines St Vincent">Grenadines St Vincent</option>
              <option value="Guadeloupe and Martinique">Guadeloupe and Martinique</option>
              <option value="Guam">Guam</option>
              <option value="Guatemala">Guatemala</option>
              <option value="Guinea">Guinea</option>
              <option value="Guinea Bissau">Guinea Bissau</option>
              <option value="Guyana">Guyana</option>
              <option value="Haiti">Haiti</option>
              <option value="Honduras">Honduras</option>
              <option value="Hong Kong">Hong Kong</option>
              <option value="Hungary">Hungary</option>
              <option value="Iceland">Iceland</option>
              <option value="India">India</option>
              <option value="Indonesia">Indonesia</option>
              <option value="Iran">Iran</option>
              <option value="Iraq">Iraq</option>
              <option value="Ireland">Ireland</option>
              <option value="Israel">Israel</option>
              <option value="Italy">Italy</option>
              <option value="Ivory Coast">Ivory Coast</option>
              <option value="Jamaica">Jamaica</option>
              <option value="Japan">Japan</option>
              <option value="Jordan">Jordan</option>
              <option value="Kenya">Kenya</option>
              <option value="Kirbati">Kirbati</option>
              <option value="Korea Dem Peoples Rep">Korea Dem Peoples Rep</option>
              <option value="Korea Repof">Korea Repof</option>
              <option value="Kuwait">Kuwait</option>
              <option value="Lao Peoples Dem Rep">Lao Peoples Dem Rep</option>
              <option value="Latvia">Latvia</option>
              <option value="Lebanon">Lebanon</option>
              <option value="Lesotho">Lesotho</option>
              <option value="Liberia">Liberia</option>
			  <option value="Libya">Libya</option>
              <option value="Lithuania">Lithuania</option>
              <option value="Luxembourg">Luxembourg</option>
              <option value="Macau">Macau</option>
              <option value="Madagascar">Madagascar</option>
              <option value="Malawi">Malawi</option>
              <option value="Malaysia">Malaysia</option>
              <option value="Maldives">Maldives</option>
              <option value="Mali">Mali</option>
              <option value="Malta">Malta</option>
              <option value="Marshall Islands">Marshall Islands</option>
              <option value="Martinique">Martinique</option>
              <option value="Mauritania">Mauritania</option>
              <option value="Mauritius">Mauritius</option>
              <option value="Mayotte">Mayotte</option>
              <option value="Mexico">Mexico</option>
              <option value="Micronesia">Micronesia</option>
              <option value="Moldova">Moldova</option>
              <option value="Monaco">Monaco</option>
              <option value="Mongolia">Mongolia</option>
              <option value="Montserrat">Montserrat</option>
              <option value="Morocco">Morocco</option>
              <option value="Mozambique">Mozambique</option>
              <option value="Myanmar">Myanmar</option>
              <option value="Namibia">Namibia</option>
              <option value="Nauru">Nauru</option>
              <option value="Nepal">Nepal</option>
              <option value="Netherlands">Netherlands</option>
              <option value="New Caledonia">New Caledonia</option>
              <option value="New Zealand">New Zealand</option>
              <option value="Nicaragua">Nicaragua</option>
              <option value="Niger">Niger</option>
              <option value="Nigeria">Nigeria</option>
              <option value="Niue">Niue</option>
              <option value="Norfolk Island">Norfolk Island</option>
              <option value="Northern Mariana Islands">Northern Mariana Islands</option>
              <option value="Norway">Norway</option>
              <option value="Oman">Oman</option>
              <option value="Pakistan">Pakistan</option>
              <option value="Palau">Palau</option>
              <option value="Panama">Panama</option>
              <option value="Papua New Guinea">Papua New Guinea</option>
              <option value="Paraguay">Paraguay</option>
              <option value="Peru">Peru</option>
              <option value="Philippines">Philippines</option>
              <option value="Poland">Poland</option>
              <option value="Portugal">Portugal</option>
              <option value="Puerto Rico">Puerto Rico</option>
              <option value="Qatar">Qatar</option>
              <option value="Reunion">Reunion</option>
              <option value="Romania">Romania</option>
              <option value="Russian Federation">Russian Federation</option>
              <option value="Rwanda">Rwanda</option>
              <option value="Saint Lucia">Saint Lucia</option>
              <option value="Samoa Western">Samoa Western</option>
              <option value="San Marino">San Marino</option>
              <option value="Sao Tome and Principe">Sao Tome and Principe</option>
              <option value="Saudi Arabia">Saudi Arabia</option>
              <option value="Senegal">Senegal</option>
              <option value="Seychelles Islands">Seychelles Islands</option>
              <option value="Sierra Leone">Sierra Leone</option>
              <option value="Singapore">Singapore</option>
              <option value="Slovakia">Slovakia</option>
              <option value="Slovenia">Slovenia</option>
              <option value="Solomon Islands">Solomon Islands</option>
              <option value="Somalia">Somalia</option>
              <option value="South Africa">South Africa</option>
              <option value="Spain and Canary Islands">Spain and Canary Islands</option>
              <option value="Sri Lanka">Sri Lanka</option>
              <option value="St Helena">St Helena</option>
              <option value="St Kitts">St Kitts</option>
              <option value="St Pierre and Miquelon">St Pierre and Miquelon</option>
              <option value="Sudan">Sudan</option>
              <option value="Suriname">Suriname</option>
              <option value="Swaziland">Swaziland</option>
              <option value="Sweden">Sweden</option>
              <option value="Switzerland">Switzerland</option>
              <option value="Syria">Syria</option>
              <option value="Taiwan">Taiwan</option>
              <option value="Tanzania">Tanzania</option>
              <option value="Thailand">Thailand</option>
              <option value="Togo">Togo</option>
              <option value="Tonga">Tonga</option>
              <option value="Trinidad and Tobago">Trinidad and Tobago</option>
              <option value="Tunisia">Tunisia</option>
              <option value="Turkey">Turkey</option>
              <option value="Turks and Caicos Islands">Turks and Caicos Islands</option>
              <option value="Tuvalu">Tuvalu</option>
              <option value="US Minor Outlying Islands">US Minor Outlying Islands</option>
              <option value="Uganda">Uganda</option>
              <option value="Ukraine">Ukraine</option>
              <option value="United Arab Emirates">United Arab Emirates</option>
              <option value="United Kingdom">United Kingdom</option>
              <option value="United States">United States</option>
              <option value="Uruguay">Uruguay</option>
              <option value="Vanuatu">Vanuatu</option>
              <option value="Venezuela">Venezuela</option>
              <option value="Vietnam">Vietnam</option>
              <option value="Virgin Islands British">Virgin Islands British</option>
              <option value="Virgin Islands US">Virgin Islands US</option>
              <option value="Wallis and Futuna Islands">Wallis and Futuna Islands</option>
              <option value="Yemen">Yemen</option>
              <option value="Yugoslavia">Yugoslavia</option>
              <option value="Zaire">Zaire</option>
              <option value="Zambia">Zambia</option>
              <option value="Zimbabwe">Zimbabwe</option>
            </select></td>
                            </tr>
                            <tr> 
                              <td colspan="5" ><input type="text" id="scou" name="scou" size="100%" value="<? echo $s_nation ; ?> " readonly></td>
                            </tr>

<script>
	function getnat(){ 

var obj = document.getElementById('scountry').length; 
var j = 0; 
var selva = "";


for(j=0;j<obj;j++){ 

if(document.getElementById("scountry").options[j].selected == true){ 
selva = selva.concat(document.getElementById("scountry").options[j].value, ", ");

}
}



document.getElementById('scou').value = selva.substr(0,selva.length-2);

}
</script>



							<tr> 
                              <td colspan="5" style="border-bottom: 1px dotted #999999;">&nbsp;</td>
                            </tr>
                            <tr> 
                              <td colspan="5">&nbsp; </td>
                            </tr>
                            <tr> 
                              <td colspan="5"  align="right"> <input type="hidden" name="action" value="unsubmitted" /> 
                                <input type="checkbox" id="inscb" name="inscb" unchecked onClick="sameas();" onBlur="sameas();" onFocus="sameas();"><input type="submit" name="Submit" value="Insert Hotel Rates >>"></td>
                            </tr>
                          </form>
                        </table>
                         </td>
                    </tr></table>									
					
			</td> 
              </tr></table> </td>
        </tr>
      </table></td></tr>
	  
	  
      </table> 
</table>	
	
	

	</tr></table>
<script>

	var tdddate = new Date();
 
    var dvy = <?php echo $vy; ?>; if (dvy==0) dvy=tdddate.getYear()
	var dvm = <?php echo $vm  ?>; if (dvm==0) dvm=tdddate.getMonth()
    <?	if($vm==0){echo $vm ;} else { ?>
		
    var dvm = <? echo $vm-1 ;} ?>

	var dnd = <?php echo $vd; ?>; if (dnd==0) dnd=tdddate.getDate()

   if (dvy < 2000) dvy += 1900;	


	var now_date = new Date(dvy,dvm,dnd);
	var now_day = now_date.getDate();
	var now_month = now_date.getMonth();
	var now_year = now_date.getYear();

	var dvy1 = <?php echo $vy1; ?>; if (dvy1==0) dvy1=tdddate.getYear()
	var dvm1 = <?php echo $vm1 ; ?>; if (dvm1==0) dvm1=tdddate.getMonth()

	<?	if($vm1==0){echo $vm1 ;} else { ?>
		
    var dvm1 = <? echo $vm1-1 ;} ?>

	var dnd1 = <?php echo $vd1; ?>; if (dnd1==0) dnd1=tdddate.getDate()

    if (dvy1 < 2000) dvy1 += 1900;


	var now_date1 = new Date(dvy1,dvm1,dnd1);
	var now_day1 = now_date1.getDate();
	var now_month1 = now_date1.getMonth();
	var now_year1 = now_date1.getYear();



	var d1 = new dateObj(document.gquot.dDay, document.gquot.dMonth, document.gquot.dYear);
	initDates(now_year, now_year+1, now_year, now_month, now_day, d1);

   	var d2 = new dateObj(document.gquot.d1Day, document.gquot.d1Month, document.gquot.d1Year);
	initDates(now_year1, now_year1+1, now_year1, now_month1, now_day1, d2);


</script>

<script>
function fun2(theForm)
{
if(document.getElementById("inscb").checked == true){ 
document.getElementById("action").value="submitted";
}
}
</script>

</body>				
</html>
