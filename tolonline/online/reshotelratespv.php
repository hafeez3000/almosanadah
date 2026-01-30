<?
session_cache_limiter('must-revalidate');
include("../db/db.php"); 

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


<script>
document.title= '<? echo $company_name . " ERP - Umrah - Reservation Individual Rates Entry"; ?>';
</script>

<html>

<head>

</head>
<body leftmargin="0" topmargin="0" rightmargin="0" >

			
			<table cellpadding="0" cellspacing="0" width="100%" style="border-top: 1px solid #999999; border-bottom: 1px solid #999999"><tr>
                      <td bgcolor="#CCCCCC"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Reservation Individual Rates </font></td>
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

$query_rooms ="select room_id, room_type,view_type,no_of_paxs,room_description from rooms where room_id like '$s_hotelsb%' order by room_id";

$result_rooms = pg_query($query_rooms);

if (!$result_rooms) {
	echo "An error occured.\n";
	exit;
	}
while ($rows_rooms = pg_fetch_array($result_rooms)){

$array_rooms[] = $rows_rooms["room_type"];
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


$query_g_rates ="select room_id,from_date,to_date,weekday_net,weekday_sell,weekend_net,weekend_sell,nationality,weekends,wpackage,breakfast,halfboard,fullboard,sahoor,iftar  from res_rates where room_id like '$s_hotelsb%'";


$result_g_rates = pg_query($query_g_rates);

if (!$result_g_rates) {
	echo "An error occured.\n";
	exit;
	}
while ($rows_g_rates = pg_fetch_array($result_g_rates)){

$arr_room_id[] = $rows_g_rates["room_id"];
$arr_from_date[] = $rows_g_rates["from_date"];
$arr_to_date[] = $rows_g_rates["to_date"];

$arr_from_dates1[] = $rows_g_rates["from_date"];
$arr_to_dates1[] = $rows_g_rates["to_date"];


$arr_weekday_net[] = $rows_g_rates["weekday_net"];
$arr_weekday_sell[] = $rows_g_rates["weekday_sell"];
$arr_weekend_net[] = $rows_g_rates["weekend_net"];
$arr_weekend_sell[] = $rows_g_rates["weekend_sell"];

$arr_nationality[] = trim($rows_g_rates["nationality"]);
$arr_nationality_s[] = trim($rows_g_rates["nationality"]);
$arr_weekends[] = trim($rows_g_rates["weekends"]);
$arr_wpackage[] = $rows_g_rates["wpackage"];

$arr_breakfast[] = $rows_g_rates["breakfast"];
$arr_halfboard[] = $rows_g_rates["halfboard"];
$arr_fullboard[] = $rows_g_rates["fullboard"];
$arr_sahoor[] = $rows_g_rates["sahoor"];
$arr_iftar[] = $rows_g_rates["iftar"];


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



for($me=0; $me<count($arr_from_date); $me++){
if($arr_from_date[$me]==$arr_from_dates1[$ad]){
if($arr_wpackage[$me]=="t"){ $package="Yes" ; } else { $package="No" ; }
echo "<tr><td colspan=\"5\" align=\"center\"><font size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\">B/B:$arr_breakfast[$me] | H/B:$arr_halfboard[$me] | F/B:$arr_fullboard[$me] | Sahoor:$arr_sahoor[$me] | Iftar:$arr_iftar[$ad] | WeekEnds: $arr_weekends[$me] | WE.Package: $package</font></td></tr>";
break;
}
}

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
echo "<td colspan=\"4\" style=\"border-bottom: 1px solid #999999\"><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\" >$array_rooms[$roomta]</font></div></td>";
echo "</tr>";
echo "<tr>";
echo "<td bgcolor=\"#FFE6E6\" style=\"border-right: 1px solid #999999\" onmouseover=\"bgColor='white'\" onmouseout=\"bgColor='#FFE6E6'\" ><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";

echo "WDN<br>" . $arr_weekday_net[$av];
echo "</font></div></td>";
echo "<td bgcolor=\"#D7FFD7\" onmouseover=\"bgColor='white'\" onmouseout=\"bgColor='#D7FFD7'\"><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";

echo "WDS<br>" . $arr_weekday_sell[$av];
echo "</font></div></td>";


if($arr_weekday_net[$av]!=$arr_weekend_net[$av] || $arr_weekday_sell[$av]!=$arr_weekend_sell[$av]){
echo "<td bgcolor=\"#FFE6E6\" style=\"border-right: 1px solid #999999; border-left: 1px solid #999999\" onmouseover=\"bgColor='white'\" onmouseout=\"bgColor='#FFE6E6'\"><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";

echo "WEN<br>" . $arr_weekend_net[$av];
echo "</font></div></td>";
echo "<td  bgcolor=\"#D7FFD7\" onmouseover=\"bgColor='white'\" onmouseout=\"bgColor='#D7FFD7'\"><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";

echo "WES<br>" . $arr_weekend_sell[$av];
echo "</font></div></td>";
}
echo "</tr>";
echo "</table></td>";
//$putrow++;
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
