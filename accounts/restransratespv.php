<?
session_cache_limiter('must-revalidate');
include("../db/db.php"); 


$query_hotel ="select trans_id, trans_c_name, city from s_trans order by trans_c_name";

$result_hotel = pg_query($conn, $query_hotel);

if (!$result_hotel) {
	echo "An error occured.\n";
	exit;
	}
while ($rows_hotel = pg_fetch_array($result_hotel)){

$array_hotel[] = $rows_hotel["trans_c_name"];
$array_hotel_id[] = $rows_hotel["trans_id"];
$array_city[] = $rows_hotel["city"];

}

pg_free_result($result_hotel);






?>


<script>
document.title= '<? echo $company_name . " ERP - Umrah - Reservation Transportation Rates Entry"; ?>';
</script>

<html>

<head>

</head>
<body leftmargin="0" topmargin="0" rightmargin="0" >

			
			<table cellpadding="0" cellspacing="0" width="100%" style="border-top: 1px solid #999999; border-bottom: 1px solid #999999"><tr>
                      <td bgcolor="#CCCCCC"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Reservation Transportation Rates </font></td>
                    </tr></table>
<table width="100%" cellpadding="1" cellspacing="0"><tr>
                      <td> 
                          <table width="100%" border="0" cellspacing="0" align="center">
                          <?





$s_hotelsb = $_POST["hotelsb"];

if($s_hotelsb==""){
$s_hotelsb = $_GET["hotid"];
}


$wetu = "unchecked";
$wepc = "unchecked";



if($s_hotelsb==""){}
else{

$query_rooms ="select trans_id, trans_type,trans_route,no_of_paxs,trans_description from transtypes where trans_id like '$s_hotelsb%' order by trans_id";

$result_rooms = pg_query($conn, $query_rooms);

if (!$result_rooms) {
	echo "An error occured.\n";
	exit;
	}
while ($rows_rooms = pg_fetch_array($result_rooms)){

$array_rooms[] = $rows_rooms["trans_type"];
$array_route[] = $rows_rooms["trans_route"];
$array_room_id[] = $rows_rooms["room_id"];


}

pg_free_result($result_rooms);

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


$query_g_rates ="select rate_sno,trans_id,from_date,to_date,net_rate,sell_rate,nationality  from res_trans_rates where trans_id like '$s_hotelsb%'";


$result_g_rates = pg_query($conn, $query_g_rates);

if (!$result_g_rates) {
	echo "An error occured.\n";
	exit;
	}
while ($rows_g_rates = pg_fetch_array($result_g_rates)){

$arr_rate_sno[] = $rows_g_rates["rate_sno"];
$arr_room_id[] = $rows_g_rates["trans_id"];
$arr_from_date[] = $rows_g_rates["from_date"];
$arr_to_date[] = $rows_g_rates["to_date"];

$arr_from_dates1[] = $rows_g_rates["from_date"];
$arr_to_dates1[] = $rows_g_rates["to_date"];


$arr_weekday_net[] = $rows_g_rates["net_rate"];
$arr_weekday_sell[] = $rows_g_rates["sell_rate"];

$arr_nationality[] = trim($rows_g_rates["nationality"]);
$arr_nationality_s[] = trim($rows_g_rates["nationality"]);



}

pg_free_result($result_g_rates);

echo "<tr><td colspan=\"5\">";


if($s_hname==""){ }
else{

echo "<table width=\"100%\" border=\"1\"  cellspacing=\"0\" cellpadding=\"0\">";

echo "<tr><td colspan=\"4\"><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><strong>";
echo $s_hname ;
echo " - ";
echo $s_city;



echo "</strong></font></div>";





echo "</td></tr>";

$arr_nationality_s = array_unique($arr_nationality_s);
sort($arr_nationality_s);

$arr_from_dates1 = array_unique($arr_from_dates1);
sort($arr_from_dates1);

$arr_to_dates1 = array_unique($arr_to_dates1);
sort($arr_to_dates1);



for($an=0; $an<count($arr_nationality_s); $an++){

echo "<tr><td colspan=\"4\" bgcolor=\"#FFE6E6\"><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";

echo "Nationality: " . $arr_nationality_s[$an];
echo "</font></div></td></tr>";




for($ad=0; $ad<count($arr_from_dates1); $ad++){





echo "<tr><td colspan=\"4\" bgcolor=\"#CCCCCC\"><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";
echo "Check In: " . date('D, jS M, Y', strtotime($arr_from_dates1[$ad])) . " - Check Out: " . date('D, jS M, Y', strtotime($arr_to_dates1[$ad]));

$tipt_dates = date('jS M, Y', strtotime($arr_from_dates1[$ad])) . " - " . date('jS M, Y', strtotime($arr_to_dates1[$ad]));


echo "</td></tr>";





$roomta=0;

$putrow=0;
for($av=0;$av<count($arr_weekday_net);$av++){






if($arr_from_dates1[$ad]==$arr_from_date[$av] && $arr_to_dates1[$ad]==$arr_to_date[$av] && $arr_nationality_s[$an]==$arr_nationality[$av]){   


if($putrow%4==0){echo "<tr>" ;}



echo "<td>";


echo "<table border=\"0\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\"><tr>";

if($arr_weekday_net[$av]!=0){
echo "<td><table border=\"0\"  width=\"100%\"  cellspacing=\"0\" cellpadding=\"0\" style=\"border-right: 1px solid #999999\">";
echo "<tr>";
echo "<td colspan=\"4\" style=\"border-bottom: 1px solid #999999\"><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\" >$array_rooms[$roomta]<br>$array_route[$roomta]</font></div></td>";
echo "</tr>";
echo "<tr>";
echo "<td bgcolor=\"#FFE6E6\" style=\"border-right: 1px solid #999999\" onmouseover=\"bgColor='white'\" onmouseout=\"bgColor='#FFE6E6'\" ><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";

echo "Net<br>" . $arr_weekday_net[$av];
echo "</font></div></td>";
echo "<td bgcolor=\"#D7FFD7\" onmouseover=\"bgColor='white'\" onmouseout=\"bgColor='#D7FFD7'\"><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";

echo "Sell<br>" . $arr_weekday_sell[$av];
echo "</font></div></td>";



echo "</tr>";
echo "</table></td>";
}
$putrow++;

$roomta++;



echo "</tr></table>";


echo "</td>"; //end of view type </td>


if($putrow%4==0){echo "</tr>" ;}

//echo "</tr>";  //end of view type </tr>


} // end if for date check


}  // end of for view type




}  // end of for period 


echo "<tr><td colspan=\"4\">&nbsp;</td></tr>";
}  // end of for nationality

echo "<table>";




echo "<table>";


}


?>


</body>				
</html>
