<?
session_cache_limiter('must-revalidate');
include ("header.php");

$array_trans_id = array();
$array_trans = array();
$array_trans_city = array();

$array_transt[] = array();
$array_transt_id[] = array();
$array_transt_route[] = array();
$array_nofp[] = array();
$array_transt_description[] = array();


$query_trans ="select trans_id,trans_c_name,city from s_trans";

$result_trans = pg_query($query_trans);

if (!$result_trans) {
	echo "An error occured.\n";
	exit;
	}
while ($rows_trans = pg_fetch_array($result_trans)){
$array_trans_id[] = $rows_trans["trans_id"];
$array_trans[] = $rows_trans["trans_c_name"];
$array_trans_city[] = $rows_trans["city"];

}

pg_free_result($result_trans);


$query_transt ="select trans_id, trans_type,trans_route,no_of_paxs,trans_description from transtypes order by trans_id";

$result_transt = pg_query($query_transt);

if (!$result_transt) {
	echo "An error occured.\n";
	exit;
	}
while ($rows_transt = pg_fetch_array($result_transt)){

$array_transt[] = $rows_transt["trans_type"];
$array_transt_id[] = $rows_transt["trans_id"];
$array_transt_route[] = $rows_transt["trans_route"];
$array_nofp[] = $rows_transt["no_of_paxs"];
$array_transt_description[] = $rows_transt["trans_description"];

}

pg_free_result($result_transt);



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

?>
<?

$ss_breakfast =  "breakfast";
$ss_halfboard =  "halfboard";
$ss_fullboard =  "fullboard";
$ss_sahoor =  "sahoor";
$ss_iftar =  "iftar";


$array_acccode = array();
$array_aname = array();
$array_country = array();

$query_agents ="select acccode, aname, scountry from agentsdet order by aname";

$result_agents = pg_query($query_agents);

if (!$result_agents) {
	echo "An error occured.\n";
	exit;
	}
while ($rows_agents = pg_fetch_array($result_agents)){

$array_acccode[] = $rows_agents["acccode"];
$array_aname[] = strtoupper($rows_agents["aname"]);
$array_country[] = strtoupper($rows_agents["scountry"]);

}

session_start();
$_SESSION['a_acccode'] = $array_acccode;
$_SESSION['a_aname'] = $array_aname;
$_SESSION['a_country'] = $array_country;

$_SESSION['a_hotel_name'] = $array_hotel;
$_SESSION['a_hotel_id'] = $array_hotel_id;
$_SESSION['city'] = $array_city;


pg_free_result($result_agents);
?>
<script src="../javascripts/cBoxes.js"></script>
<script>
document.title= '<? echo $company_name . " ERP - Umrah - Group Quotation"; ?>';

function trimString(str) {
  while (str.charAt(0) == ' ')
    str = str.substring(1);
  while (str.charAt(str.length - 1) == ' ')
    str = str.substring(0, str.length - 1);
  return str;
}

</script>

<html>
<link rel="stylesheet" type="text/css" href="../calendar/css.css" />
<head>
<script>
 var winl = (screen.width - 700) / 2; 
 var wint = (screen.height - 500) / 2;
</script>
</head>
<body leftmargin="0" topmargin="0" rightmargin="0" >
<table width="100%" border="0" cellpadding="0" cellspacing="0" style="border-bottom: 1px solid #999999 ;border-left: 3px solid #006600;border-right: 3px solid #006600"><tr>
    <td bgcolor="#CCCCCC"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">&nbsp;You 
      are here: <a href="uhome.php">Home</a> &raquo; Bookings  
      &raquo; New Booking </font></td>
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
                      <td bgcolor="#CCCCCC"><strong>New Booking</strong></td>
                    </tr></table>
<table width="100%" cellpadding="1" cellspacing="0"><tr>
                      <td><table width="100%" border="0" cellspacing="0" cellpadding="1" align="center">
                        <?






?>
                        <form name="roomselput" action="reservationpakfinal.php"  method="post" onSubmit="return fun2(this)">
                          <tr bgcolor="#CCCCCC">
                            <td colspan="2" > name to put </td>
                          </tr>

                          <tr>
                            <td colspan="2">

							<?
 


/*$_SESSION["hotcb0"];
$_SESSION["hotcb1"];
$_SESSION["hotcb2"];
$_SESSION["trans0"];
$_SESSION["trans1"];
$_SESSION["trans2"];
$_SESSION["trans3"];

$_SESSION["others0"];
$_SESSION["others1"];
$_SESSION["others2"];
*/
							
 
if($_SESSION["hotcb0"]==on){ // start if for mad hotel

$s_hotelsmad = $_SESSION["hotelsmad"];

$madcind = $_SESSION['dDay'];
$madcinm = $_SESSION['dMonth'];
$madciny = $_SESSION['dYear'];

$madcin = $madciny ."-". $madcinm ."-". $madcind ; 

$madcoutd = $_SESSION['d1Day'];
$madcoutm = $_SESSION['d1Month'];
$madcouty = $_SESSION['d1Year'];

$madcout = $madcouty ."-". $madcoutm ."-". $madcoutd ; 

$madcins = date('D, d-M-Y', strtotime($madcin));
$madcouts = date('D, d-M-Y', strtotime($madcout));

$madco = mktime(0,0,0,$madcoutm,$madcoutd,$madcouty);
$madci = mktime(0,0,0,$madcinm,$madcind,$madciny);
$madnights = Round((($madco-$madci)/86400), 0) ;


$madcind1 = $madcind;
$madcinm1 = $madcinm;
$madciny1 = $madciny;

$madcin1 = $madciny1 ."-". $madcinm1 ."-". $madcind1 ; 

$madcoutd1 = $madcoutd;
$madcoutm1 = $madcoutm;
$madcouty1 = $madcouty;


$madcout1 = $madcouty1 ."-". $madcoutm1 ."-". $madcoutd1 ; 
$madnights1= $madnights;

} // end if for mad hotel


if($_SESSION["hotcb1"]==on){ // start if for mak hotel

$s_hotelsmak = $_SESSION["hotelsmak"];

$makcind = $_SESSION['d2Day'];
$makcinm = $_SESSION['d2Month'];
$makciny = $_SESSION['d2Year'];

$makcin = $makciny ."-". $makcinm ."-". $makcind ; 

$makcoutd = $_SESSION['d3Day'];
$makcoutm = $_SESSION['d3Month'];
$makcouty = $_SESSION['d3Year'];

$makcout = $makcouty ."-". $makcoutm ."-". $makcoutd ; 

$makcins = date('D, d-M-Y', strtotime($makcin));
$makcouts = date('D, d-M-Y', strtotime($makcout));

$makco = mktime(0,0,0,$makcoutm,$makcoutd,$makcouty);
$makci = mktime(0,0,0,$makcinm,$makcind,$makciny);
$maknights = Round((($makco-$makci)/86400), 0) ;


$makcind1 = $makcind;
$makcinm1 = $makcinm;
$makciny1 = $makciny;

$makcin1 = $makciny1 ."-". $makcinm1 ."-". $makcind1 ; 

$makcoutd1 = $makcoutd;
$makcoutm1 = $makcoutm;
$makcouty1 = $makcouty;


$makcout1 = $makcouty1 ."-". $makcoutm1 ."-". $makcoutd1 ; 
$maknights1= $maknights;



} // end if for mak hotel
						

if($_SESSION["hotcb2"]==on){ // start if for oth hotel

$s_hotelsoth = $_SESSION["hotelsoth"];

$othcind = $_SESSION['d4Day'];
$othcinm = $_SESSION['d4Month'];
$othciny = $_SESSION['d4Year'];

$othcin = $othciny ."-". $othcinm ."-". $othcind ; 

$othcoutd = $_SESSION['d5Day'];
$othcoutm = $_SESSION['d5Month'];
$othcouty = $_SESSION['d5Year'];

$othcout = $othcouty ."-". $othcoutm ."-". $othcoutd ; 

$othcins = date('D, d-M-Y', strtotime($othcin));
$othcouts = date('D, d-M-Y', strtotime($othcout));

$othco = mktime(0,0,0,$othcoutm,$othcoutd,$othcouty);
$othci = mktime(0,0,0,$othcinm,$othcind,$othciny);
$othnights = Round((($othco-$othci)/86400), 0) ;


$othcind1 = $othcind;
$othcinm1 = $othcinm;
$othciny1 = $othciny;

$othcin1 = $othciny1 ."-". $othcinm1 ."-". $othcind1 ; 

$othcoutd1 = $othcoutd;
$othcoutm1 = $othcoutm;
$othcouty1 = $othcouty;


$othcout1 = $othcouty1 ."-". $othcoutm1 ."-". $othcoutd1 ; 
$othnights1= $othnights;

} // end if for oth hotel							


if($_SESSION["trans0"]==on){ // start if for  trans0

$trans0d = $_SESSION['d6Day'];
$trans0m = $_SESSION['d6Month'];
$trans0y = $_SESSION['d6Year'];

 $trans0rd = $trans0y ."-". $trans0m ."-". $trans0d ; 

 $s_timeselecthours0  = $_SESSION['timeselecthours0']; 
 $s_timeselectmin0	  = $_SESSION['timeselectmin0'];   
 $s_s_trans0		  = $_SESSION['s_trans0'];            
 $s_typeoftrans0	  = $_SESSION['typeoftrans0'];        
 $s_noofu0			  = $_SESSION['noofu0'];           
 $s_flightdet0		  = $_SESSION['flightdet0'];       

} // end if for trans0


if($_SESSION["trans1"]==on){ // start if for  trans1

$trans1d = $_SESSION['d7Day'];
$trans1m = $_SESSION['d7Month'];
$trans1y = $_SESSION['d7Year'];

 $trans1rd = $trans1y ."-". $trans1m ."-". $trans1d ; 

 $s_timeselecthours1   = $_SESSION['timeselecthours1']; 
 $s_timeselectmin1	   = $_SESSION['timeselectmin1'];   
 $s_s_trans1		   = $_SESSION['s_trans1'];         
 $s_typeoftrans1	   = $_SESSION['typeoftrans1'];     
 $s_noofu1			   = $_SESSION['noofu1'];           
 $s_flightdet1		   = $_SESSION['flightdet1'];       

} // end if for trans1

if($_SESSION["trans2"]==on){ // start if for  trans2

$trans2d = $_SESSION['d8Day'];
$trans2m = $_SESSION['d8Month'];
$trans2y = $_SESSION['d8Year'];

 $trans2rd = $trans2y ."-". $trans2m ."-". $trans2d ; 

 $s_timeselecthours2   = $_SESSION['timeselecthours2']; 
 $s_timeselectmin2	   = $_SESSION['timeselectmin2'];   
 $s_s_trans2		   = $_SESSION['s_trans2'];         
 $s_typeoftrans2	   = $_SESSION['typeoftrans2'];     
 $s_noofu2			   = $_SESSION['noofu2'];           
 $s_flightdet2		   = $_SESSION['flightdet2'];       

} // end if for trans2	


if($_SESSION["trans3"]==on){ // start if for  trans3

$trans3d = $_SESSION['d9Day'];
$trans3m = $_SESSION['d9Month'];
$trans3y = $_SESSION['d9Year'];

 $trans3rd = $trans3y ."-". $trans3m ."-". $trans3d ; 

 $s_timeselecthours3   = $_SESSION['timeselecthours3']; 
 $s_timeselectmin3	   = $_SESSION['timeselectmin3'];   
 $s_s_trans3		   = $_SESSION['s_trans3'];         
 $s_typeoftrans3	   = $_SESSION['typeoftrans3'];     
 $s_noofu3			   = $_SESSION['noofu3'];           
 $s_flightdet3		   = $_SESSION['flightdet3'];       

} // end if for trans3	

if($_SESSION["others0"]==on){ // start if for  oth0
$other1noofa=$_SESSION['other1noofa'];
$other1nrate=$_SESSION['other1nrate'];
$other1srate=$_SESSION['other1srate'];


$others1d = $_SESSION['d10Day'];
$others1m = $_SESSION['d10Month'];
$others1y = $_SESSION['d10Year'];

$others1rd = $others1y ."-". $others1m ."-". $others1d ; 
} // end if for other

if($_SESSION["others1"]==on){ // start if for  oth1
$other2noofa=$_SESSION['other2noofa'];
$other2nrate=$_SESSION['other2nrate'];
$other2srate=$_SESSION['other2srate'];


$others2d = $_SESSION['d11Day'];
$others2m = $_SESSION['d11Month'];
$others2y = $_SESSION['d11Year'];

$others2rd = $others2y ."-". $others2m ."-". $others2d ; 
} // end if for other

if($_SESSION["others2"]==on){ // start if for  oth2
$other3noofa=$_SESSION['other3noofa'];
$other3nrate=$_SESSION['other3nrate'];
$other3srate=$_SESSION['other3srate'];


$others3d = $_SESSION['d12Day'];
$others3m = $_SESSION['d12Month'];
$others3y = $_SESSION['d12Year'];

$others3rd = $others3y ."-". $others3m ."-". $others3d ; 
} // end if for other

							?>

<?

 if($_SESSION["hotcb0"]==on){ // start if for mad hotel
?>							

  <table width="100%" cellpadding="1" cellspacing="0">
                                   <tr bgcolor="#CCCCCC">
                            <td colspan="2"><b>Hotel in Madinah<b></td>
                          </tr>
								  <tr> 
                                    <td width="17%" style="border-right: 1px solid #999999"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Check 
                                      In</font></td>
                                    <td ><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><? echo $madcins ?></font></td>
                                  </tr>
                                  <tr> 
                                    <td style="border-right: 1px solid #999999"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Check 
                                      Out</font></td><td><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><? echo $madcouts ?></font></td>
                                  </tr>
                                  <tr> 
                                    <td style="border-right: 1px solid #999999"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Hotel 
                                      Name</font></td><td><font size="2" face="Verdana, Arial, Helvetica, sans-serif">
									  <?
									  $query_hotel ="select hotel_id, hotel_name, city from hotels where hotel_id='$s_hotelsmad'";

$result_hotel = pg_query($query_hotel);

if (!$result_hotel) {
echo "An error occured.\n";
exit;
		}
while ($rows_hotel = pg_fetch_array($result_hotel)){
$hotel_name_dis = $rows_hotel["hotel_name"];
$hotel_city = $rows_hotel["city"];
}
pg_free_result($result_hotel);

echo $hotel_name_dis;
echo " - " ;
echo $hotel_city;
echo "&nbsp;&nbsp;&nbsp;";
echo "<a href=\"#\">more about hotel...</a>";

								

									  ?>
									  
									  </font></td>
                                  </tr>
                                						
								</table>				
		<table width="100%">

 <tr><td bgcolor="#EFEFEF"> 
                         
							  <?

							  
$_SESSION["madselrcb"] = $_POST["madselrcb"];

$mad_arr_room_id = $_POST["madselrcb"];							  



//print_r($arr_room_id);

$mad_array_sel_rooms = array();
$mad_array_sel_meals = array();
$mad_array_sel_paxs = array();

$mad_array_room_id = array();
$mad_array_room_type = array();
$mad_array_no_of_paxs = array();
$mad_array_room_description = array();

for($i=0; $i<count($mad_arr_room_id); $i++){

$query_room ="select room_id, room_type, no_of_paxs from rooms where room_id ='$mad_arr_room_id[$i]'";

$result_room = pg_query($query_room);

if (!$result_room) {
	echo "An error occured.\n";
	exit;
	}
while ($rows_room = pg_fetch_array($result_room)){

$mad_array_room_id[] = $rows_room["room_id"];
$mad_array_room_type[] = $rows_room["room_type"];
$mad_array_no_of_paxs[] = $rows_room["no_of_paxs"];
}
pg_free_result($result_room);

$mad_array_sel_rooms[] = $_POST["madrooms$mad_arr_room_id[$i]"];
$mad_array_sel_meals[] = $_POST["madmeals$mad_arr_room_id[$i]"];
$mad_array_sel_paxs[] =  $_POST["madpaxs$mad_arr_room_id[$i]"];

$mad_array_p_n_rate[] = $_POST["madputnrate$mad_arr_room_id[$i]"];
$mad_array_p_rate[] = $_POST["madputrate$mad_arr_room_id[$i]"];

}


$_SESSION["mad_array_sel_rooms"]=$mad_array_sel_rooms;
$_SESSION["mad_array_sel_meals"]=$mad_array_sel_meals;
$_SESSION["mad_array_sel_paxs"]=$mad_array_sel_paxs;


$hb_r=0;

$mad_day_room_tot=0;
$mad_day_room_ntot=0;
$mad_hot_tot=0;
$mad_hot_ntot=0;

for($ri=0; $ri<count($mad_array_room_id); $ri++){

$mad_rd1 = date('Y-m-d', mktime(0,0,0,$madcinm,$madcind,$madciny));

$query_g_rates_mad ="select room_id,from_date,to_date, weekday_net,weekday_sell,weekend_net,weekend_sell,breakfast,halfboard,fullboard,sahoor,iftar,weekends,wpackage  from res_rates where '$mad_rd1' between from_date and to_date - interval '1 day' and room_id = $mad_array_room_id[$ri] ";


$result_rates_mad = pg_query($query_g_rates_mad);

if (!$result_rates_mad) {
	echo "An error occured.\n";
	exit;
	}
while ($rows_rates_mad = pg_fetch_array($result_rates_mad)){
//echo " ";

 
$a_weekends = explode(",", $rows_rates_mad["weekends"]);



$s_wep = $rows_rates_mad["wpackage"];

}

if(trim($s_wep)=="t"){ 
	
echo "Weekend Package";



if(count($a_weekends)==2){     // two days weekend


$weekes =  $a_weekends[0];

$weekee =  $a_weekends[1];


if(date('D', strtotime($madcin1))== $weekee){

$madcin1 = date('Y-m-d', mktime(0,0,0,$madcinm1,$madcind1-1,$madciny1));

}




if(date('D', strtotime($madcout1))== $weekee){

$madcout1 = date('Y-m-d', mktime(0,0,0,$madcoutm1,$madcoutd1+1,$madcouty1));

}



}  // end of two days weekend


if(count($a_weekends)==3){     // three days weekend

$weeke0 =  $a_weekends[0];
$weeke1 =  $a_weekends[1];
$weeke2 =  $a_weekends[2];


if(date('D', strtotime($madcin1))== $weeke1){
$madcin1 = date('Y-m-d', mktime(0,0,0,$madcinm1,$madcind1-1,$madciny1));
}
if(date('D', strtotime($madcin1))== $weeke2){
$madcin1 = date('Y-m-d', mktime(0,0,0,$madcinm1,$madcind1-2,$madciny1));
}

if(date('D', strtotime($madcout1))== $weeke1){
$madcout1 = date('Y-m-d', mktime(0,0,0,$madcoutm1,$madcoutd1+2,$madcouty1));
}
if(date('D', strtotime($madcout1))== $weeke2){
$madcout1 = date('Y-m-d', mktime(0,0,0,$madcoutm1,$madcoutd1+1,$madcouty1));
}


}  // end of three days weekend



$madcin1 = date('Y-m-d', strtotime($madcin1));
$madcout1 = date('Y-m-d', strtotime($madcout1));

$madnights1 = Round(((strtotime($madcout1)-strtotime($madcin1))/86400), 0) ;




}



echo "<table width=\"100%\" border=\"1\" cellpadding=\"1\" cellspacing=\"0\"><tr><td colspan=\"8\"><div align=\"left\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><b>$mad_array_room_type[$ri]</b></font></div></td></tr><tr><td ><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">Req. Night</font></div></td><td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">Net</font></div></td><td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">Sell</font></div></td><td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">Rooms</font></div></td><td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">Paxs</font></div></td><td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">Meals</font></div></td><td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">T.Net</font></div></td><td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">T.Sell</font></div></td></tr>";

for($d=0; $d<$madnights1; $d++){


$mad_rd = date('Y-m-d', mktime(0,0,0,date('m', strtotime($madcin1)),date('d', strtotime($madcin1))+$d,date('Y', strtotime($madcin1)) ));

$query_g_rates ="select room_id,from_date,to_date, weekday_net,weekday_sell,weekend_net,weekend_sell,breakfast,halfboard,fullboard,sahoor,iftar,weekends,wpackage  from res_rates where '$mad_rd' between from_date and to_date - interval '1 day' and room_id = $mad_array_room_id[$ri] ";


$result_rates = pg_query($query_g_rates);

if (!$result_rates) {
	echo "An error occured.\n";
	exit;
	}
while ($rows_rates = pg_fetch_array($result_rates)){
//echo " ";

 
$a_weekends = explode(",", $rows_rates["weekends"]);


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
$s_breakfast =  $rows_rates["breakfast"];
$s_halfboard =  $rows_rates["halfboard"];
$s_fullboard =  $rows_rates["fullboard"];
$s_sahoor =  $rows_rates["sahoor"];
$s_iftar =  $rows_rates["iftar"];

}

if($mad_array_p_n_rate[$ri] || $mad_array_p_rate[$ri]){
$ridn = $mad_array_p_n_rate[$ri];
  $rids = $mad_array_p_rate[$ri];
}


echo "<tr><td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">" . date('D, d-M', mktime(0,0,0,date('m', strtotime($madcin1)),date('d', strtotime($madcin1))+$d,date('Y', strtotime($madcin1)))) . "</font></div></td>";

if($mad_array_p_n_rate[$ri] || $mad_array_p_rate[$ri]){
echo "<td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><input type=\"text\" id=\"mad_putnrate$ri$d\"  name=\"mad_putnrate$ri$d\" size=\"3\" value=\"$mad_array_p_n_rate[$ri]\" onKeyUp=\"mad_caldayntot$ri$d();mad_ntothot$ri()\"  onFocus=\"mad_caldayntot$ri$d();mad_ntothot$ri()\" onBlur=\"mad_caldayntot$ri$d();mad_ntothot$ri()\"></font></div></td><td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><input type=\"text\" id=\"mad_putrate$ri$d\" name=\"mad_putrate$ri$d\" size=\"3\"  value=\"$mad_array_p_rate[$ri]\" onKeyUp=\"mad_caldaytot$ri$d();mad_tothot$ri()\" onFocus=\"mad_caldaytot$ri$d();mad_tothot$ri()\" onBlur=\"mad_caldaytot$ri$d();mad_tothot$ri()\"></font></div></td>";

}
else{
echo "<td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><input type=\"text\" id=\"mad_putnrate$ri$d\"  name=\"mad_putnrate$ri$d\" size=\"3\" value='$ridn' onKeyUp=\"mad_caldayntot$ri$d();mad_ntothot$ri()\"  onFocus=\"mad_caldayntot$ri$d();mad_ntothot$ri()\" onBlur=\"mad_caldayntot$ri$d();mad_ntothot$ri()\"></font></div></td><td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><input type=\"text\" id=\"mad_putrate$ri$d\" name=\"mad_putrate$ri$d\" size=\"3\"  value='$rids' onKeyUp=\"mad_caldaytot$ri$d();mad_tothot$ri()\" onFocus=\"mad_caldaytot$ri$d();mad_tothot$ri()\" onBlur=\"mad_caldaytot$ri$d();mad_tothot$ri()\"></font></div></td>";
}



echo "<td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">$mad_array_sel_rooms[$ri]<input type=\"hidden\" id=\"mad_noofrooms$ri$d\" name=\"mad_noofrooms$ri$d\" value=\"$mad_array_sel_rooms[$ri]\" ></font></div></td><td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">$mad_array_sel_paxs[$ri]<input type=\"hidden\" id=\"mad_noofpaxs$ri$d\" name=\"mad_noofpaxs$ri$d\" value=\"$mad_array_sel_paxs[$ri]\"></font></div></td><td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><table width=\"100%\" border=\"1\" cellpadding=\"1\" cellspacing=\"0\" align=\"center\"><tr>";


$tot_meals = 0; 

for($me=0; $me<count($mad_array_sel_meals[$ri]) ; $me++){
echo "<td align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";

echo ucfirst($mad_array_sel_meals[$ri][$me]) ;
$sr_meals="0";

if($ss_breakfast==$mad_array_sel_meals[$ri][$me]){
if(trim($s_breakfast)=="Included"){
$sr_meals="INC";
}
else if(trim($s_breakfast)=="Not Available"){
$sr_meals="NA";
}
else{
$sr_meals=$s_breakfast;
$tot_meals = $tot_meals+$s_breakfast;
}
}


if($ss_halfboard==$mad_array_sel_meals[$ri][$me]){
if(trim($s_halfboard)=="Included"){
$sr_meals="INC";
}
else if(trim($s_halfboard)=="Not Available"){
$sr_meals="NA";
}
else{
$sr_meals=$s_halfboard;
$tot_meals = $tot_meals+$s_halfboard;
}
}

if($ss_fullboard==$mad_array_sel_meals[$ri][$me]){
if(trim($s_fullboard)=="Included" ){
$sr_meals="INC";
}
else if(trim($s_fullboard)=="Not Available"){
$sr_meals="NA";
}
else{
//echo $s_fullboard;
$sr_meals=$s_fullboard;
$tot_meals = $tot_meals+$s_fullboard;
}
}

if($ss_sahoor==$mad_array_sel_meals[$ri][$me]){
if(trim($s_sahoor)=="Included" ){
$sr_meals="INC";
}
else if(trim($s_sahoor)=="Not Available"){
$sr_meals="NA";
}
else{

$sr_meals=$s_sahoor;
$tot_meals = $tot_meals+$s_sahoor;
}
}

if($ss_iftar==$mad_array_sel_meals[$ri][$me]){
if(trim($s_iftar)=="Included" ){
$sr_meals="INC";
}
else if (trim($s_iftar)=="Not Available"){
$sr_meals="NA";
}
else{
//echo $s_iftar;
$sr_meals=$s_iftar;
$tot_meals = $tot_meals+$s_iftar;
}
}




if($mad_array_p_n_rate[$ri] || $mad_array_p_rate[$ri]){

echo "<br>";
echo "<input type=\"text\" id=\"mad_meals$ri$me$d\" name=\"mad_meals$ri$me$d\" size=\"1\" value=\"NA\" onKeyUp=\"mad_calmealstot$ri$me$d();mad_tothot$ri();mad_calmealsntot$ri$me$d();mad_ntothot$ri();roomselput.mad_meals$ri$me$d.value=roomselput.mad_meals$ri$me$d.value.toUpperCase()\" onFocus=\"mad_calmealstot$ri$me$d();mad_tothot$ri();mad_calmealsntot$ri$me$d();mad_ntothot$ri();roomselput.mad_meals$ri$me$d.value=roomselput.mad_meals$ri$me$d.value.toUpperCase()\" onBlur=\"mad_calmealstot$ri$me$d();mad_tothot$ri();mad_calmealsntot$ri$me$d();mad_ntothot$ri();roomselput.mad_meals$ri$me$d.value=roomselput.mad_meals$ri$me$d.value.toUpperCase()\">";
echo "</font></td>";
$tot_meals=0;
}
else{

echo "<br>";
echo "<input type=\"text\" id=\"mad_meals$ri$me$d\" name=\"mad_meals$ri$me$d\" size=\"1\" value=\"$sr_meals\" onKeyUp=\"mad_calmealstot$ri$me$d();mad_tothot$ri();mad_calmealsntot$ri$me$d();mad_ntothot$ri();roomselput.mad_meals$ri$me$d.value=roomselput.mad_meals$ri$me$d.value.toUpperCase()\" onFocus=\"mad_calmealstot$ri$me$d();mad_tothot$ri();mad_calmealsntot$ri$me$d();mad_ntothot$ri();roomselput.mad_meals$ri$me$d.value=roomselput.mad_meals$ri$me$d.value.toUpperCase()\" onBlur=\"mad_calmealstot$ri$me$d();mad_tothot$ri();mad_calmealsntot$ri$me$d();mad_ntothot$ri();roomselput.mad_meals$ri$me$d.value=roomselput.mad_meals$ri$me$d.value.toUpperCase()\">";
echo "</font></td>";

}

?>
<script>

function mad_calmealstot<? echo $ri.$me.$d; ?>(){ 

var roomt = document.getElementById ('mad_putrate<? echo $ri.$d; ?>').value * document.getElementById ('mad_noofrooms<? echo $ri.$d; ?>').value ;

var mealst = 0; 
var mea =0;

'<? for($m=0; $m<count($mad_array_sel_meals[$ri]); $m++){?>'

if(trimString(document.getElementById ('mad_meals<? echo $ri.$m.$d; ?>').value)=="INC" || trimString(document.getElementById ('mad_meals<? echo $ri.$m.$d; ?>').value)=="NA"){ mea = 0;}
else{
mea = parseFloat(document.getElementById ('mad_meals<? echo $ri.$m.$d; ?>').value);
}

mealst = mealst + mea;



'<?}?>'



var mealstt = parseFloat(mealst) * document.getElementById ('mad_noofpaxs<? echo $ri.$d; ?>').value ;


document.getElementById ('mad_daytot<? echo $ri.$d; ?>').value = parseFloat(roomt) + parseFloat(mealstt);



}


function mad_calmealsntot<? echo $ri.$me.$d; ?>(){ 

var nroomt = document.getElementById ('mad_putnrate<? echo $ri.$d; ?>').value * document.getElementById ('mad_noofrooms<? echo $ri.$d; ?>').value ;

var nmealst = 0; 
var nmea =0;
'<? for($m=0; $m<count($mad_array_sel_meals[$ri]); $m++){?>'


if(trimString(document.getElementById ('mad_meals<? echo $ri.$m.$d; ?>').value)=="INC" || trimString(document.getElementById ('mad_meals<? echo $ri.$m.$d; ?>').value)=="NA"){ nmea = 0;}
else{
nmea = parseFloat(document.getElementById ('mad_meals<? echo $ri.$m.$d; ?>').value);
}

nmealst = nmealst + nmea;





'<?}?>'



var nmealstt = parseFloat(nmealst) * document.getElementById ('mad_noofpaxs<? echo $ri.$d; ?>').value ;


document.getElementById ('mad_dayntot<? echo $ri.$d; ?>').value = parseFloat(nroomt) + parseFloat(nmealstt);

}

</script>
<?




}


//echo $day_room_tot = $rids * $array_sel_rooms[$ri] ;
//echo $day_room_ntot = $ridn * $array_sel_rooms[$ri] ;

$mad_day_room_tot = $rids * $mad_array_sel_rooms[$ri]   + $mad_array_sel_paxs[$ri]*$tot_meals;
$mad_day_room_ntot = $ridn * $mad_array_sel_rooms[$ri]  + $mad_array_sel_paxs[$ri]*$tot_meals;


echo "</tr></table></font></div></td><td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><input type=\"text\" id=\"mad_dayntot$ri$d\" name=\"mad_dayntot$ri$d\" size=\"2\" value='$mad_day_room_ntot' readonly></td><td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><input type=\"text\" id=\"mad_daytot$ri$d\" name=\"mad_daytot$ri$d\" size=\"2\" value='$mad_day_room_tot' readonly></font></div></td></tr>";



$mad_hot_tot = $mad_hot_tot + $mad_day_room_tot; 
$mad_hot_ntot = $mad_hot_ntot + $mad_day_room_ntot;
$mad_day_room_tot=0;
$mad_day_room_ntot=0;

?>
<script>
	function mad_caldaytot<? echo $ri.$d; ?>(){ 
		document.getElementById ('mad_daytot<? echo $ri.$d; ?>').value =  document.getElementById ('mad_putrate<? echo $ri.$d; ?>').value * document.getElementById ('mad_noofrooms<? echo $ri.$d; ?>').value;

'<? for($mer=0; $mer<count($mad_array_sel_meals[$ri]) ; $mer++){ ?>'
 mad_calmealstot<? echo $ri.$mer.$d; ?>();
'<?}?>'

}

	function mad_caldayntot<? echo $ri.$d; ?>(){ 
		document.getElementById ('mad_dayntot<? echo $ri.$d; ?>').value =  document.getElementById ('mad_putnrate<? echo $ri.$d; ?>').value * document.getElementById ('mad_noofrooms<? echo $ri.$d; ?>').value;

'<? for($mer=0; $mer<count($mad_array_sel_meals[$ri]) ; $mer++){ ?>'
mad_calmealsntot<? echo $ri.$mer.$d; ?>();
'<?}?>'

}

</script>
<?


}

$mad_hot_ntot = ceil($mad_hot_ntot);
$mad_hot_tot = ceil($mad_hot_tot);

echo "<tr><td colspan=\"7\"><div align=\"right\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">GT.Net:<br><input type=\"text\" id=\"mad_hotntot$ri\" name=\"mad_hotntot$ri\" size=\"2\" value='$mad_hot_ntot' readonly></font></div></td><td colspan=\"7\"><div align=\"right\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">GT.Sell:<br><input type=\"text\" id=\"mad_hottot$ri\" name=\"mad_hottot$ri\" size=\"2\" value='$mad_hot_tot' readonly></font></div></td></tr>";


?>
<script>
	function mad_tothot<? echo $ri; ?>(){ 

var hotv=0 ;

'<? for($dd=0; $dd<$madnights1; $dd++){?>'

 hotv = parseFloat(hotv) + parseFloat(document.getElementById ('mad_daytot<? echo $ri.$dd  ; ?>').value);

'<?}?>'
 document.getElementById ('mad_hottot<? echo $ri; ?>').value = Math.ceil(hotv);
 
mad_htotal(mad_gt);
grand_sell(grand_gt);
}

function mad_ntothot<? echo $ri; ?>(){ 

var nhotv=0 ;

'<? for($dd=0; $dd<$madnights1; $dd++){?>'

 nhotv = parseFloat(nhotv) + parseFloat(document.getElementById ('mad_dayntot<? echo $ri.$dd  ; ?>').value);

'<?}?>'
 document.getElementById ('mad_hotntot<? echo $ri; ?>').value = Math.ceil(nhotv);
mad_hntotal(mad_gnt);
grand_net(grand_gnt);
}


</script>

<script>

function mad_htotal(val){
var gtotv=0 ;

'<? for($gtot=0; $gtot<count($mad_array_room_id); $gtot++){?>'

gtotv = parseFloat(gtotv) + parseFloat(document.getElementById ('mad_hottot<? echo $gtot  ; ?>').value);

'<?}?>'
val.innerHTML = gtotv;
}


function mad_hntotal(val){
var gntotv=0 ;

'<? for($gntot=0; $gntot<count($mad_array_room_id); $gntot++){?>'

gntotv = parseFloat(gntotv) + parseFloat(document.getElementById ('mad_hotntot<? echo $gntot  ; ?>').value);

'<?}?>'
val.innerHTML = gntotv;
}

</script>

<?



echo "<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" ><tr><td bgcolor=\"#FFFFFF\">&nbsp;</td></tr></table>";
$mad_hot_tot=0;
$mad_hot_ntot=0;
}


echo "<tr><td><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">Madinah Room(s) Total <FONT 
style=\"BACKGROUND-COLOR: #DFDFDF\">NetRate:</FONT> SAR <span id=\"mad_gnt\">0</span>/-</font></td></tr>";


echo "<tr><td align=\"right\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">Madinah Room(s) Total <FONT 
style=\"BACKGROUND-COLOR: #DFDFDF\">SellingRate:</FONT> SAR <span id=\"mad_gt\">0</span>/-</font></td></tr>";


//echo "<tr><td >&nbsp;</td></tr>";

//echo "<tr><td align=\"right\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><input type=\"submit\" name=\"submit\" value=\"Book Room(s) >>\" ></font></td></tr>";



echo "</table>";






						 ?>
<script>
mad_htotal(mad_gt);
mad_hntotal(mad_gnt);
</script>


</td>
                            </tr>		

		
		</table>						
							
			<?}// end of madinah hotel?>					
							

<?
 if($_SESSION["hotcb1"]==on){ // start if for mak hotel
?>							

 <table width="100%" cellpadding="1" cellspacing="0">
                                   <tr bgcolor="#CCCCCC">
                            <td colspan="2"><b>Hotel in Makkah</b></td>
                          </tr>
								  <tr> 
                                    <td width="17%" style="border-right: 1px solid #999999"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Check 
                                      In</font></td>
                                    <td ><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><? echo $makcins ?></font></td>
                                  </tr>
                                  <tr> 
                                    <td style="border-right: 1px solid #999999"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Check 
                                      Out</font></td><td><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><? echo $makcouts ?></font></td>
                                  </tr>
                                  <tr> 
                                    <td style="border-right: 1px solid #999999"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Hotel 
                                      Name</font></td><td><font size="2" face="Verdana, Arial, Helvetica, sans-serif">
									  <?
									  $query_hotel ="select hotel_id, hotel_name, city from hotels where hotel_id='$s_hotelsmak'";

$result_hotel = pg_query($query_hotel);

if (!$result_hotel) {
echo "An error occured.\n";
exit;
		}
while ($rows_hotel = pg_fetch_array($result_hotel)){
$hotel_name_dis = $rows_hotel["hotel_name"];
$hotel_city = $rows_hotel["city"];
}
pg_free_result($result_hotel);

echo $hotel_name_dis;
echo " - " ;
echo $hotel_city;
echo "&nbsp;&nbsp;&nbsp;";
echo "<a href=\"#\">more about hotel...</a>";

								

									  ?>
									  
									  </font></td>
                                  </tr>
                                						
								</table>				
		<table width="100%">

 <tr><td bgcolor="#EFEFEF"> 
                         
							  <?

							  
$_SESSION["selrcb"] = $_POST["selrcb"];
							  
$arr_room_id = $_POST["selrcb"];							  
//print_r($arr_room_id);


$array_sel_rooms = array();
$array_sel_meals = array();
$array_sel_paxs = array();

$array_room_id = array();
$array_room_type = array();
$array_no_of_paxs = array();
$array_room_description = array();

for($i=0; $i<count($arr_room_id); $i++){

$query_room ="select room_id, room_type, no_of_paxs from rooms where room_id ='$arr_room_id[$i]'";

$result_room = pg_query($query_room);

if (!$result_room) {
	echo "An error occured.\n";
	exit;
	}
while ($rows_room = pg_fetch_array($result_room)){

$array_room_id[] = $rows_room["room_id"];
$array_room_type[] = $rows_room["room_type"];
$array_no_of_paxs[] = $rows_room["no_of_paxs"];
}
pg_free_result($result_room);


$array_sel_rooms[] = $_POST["rooms$arr_room_id[$i]"];
$array_sel_meals[] = $_POST["meals$arr_room_id[$i]"];
$array_sel_paxs[] =  $_POST["paxs$arr_room_id[$i]"];


$array_p_n_rate[] = $_POST["putnrate$arr_room_id[$i]"];
$array_p_rate[] = $_POST["putrate$arr_room_id[$i]"];


}


$_SESSION["array_sel_rooms"]=$array_sel_rooms;
$_SESSION["array_sel_meals"]=$array_sel_meals;
$_SESSION["array_sel_paxs"]=$array_sel_paxs;


$hb_r=0;

$day_room_tot=0;
$day_room_ntot=0;
$hot_tot=0;
$hot_ntot=0;

for($ri=0; $ri<count($array_room_id); $ri++){


$mak_rd1 = date('Y-m-d', mktime(0,0,0,$makcinm,$makcind,$makciny));

$query_g_rates ="select room_id,from_date,to_date, weekday_net,weekday_sell,weekend_net,weekend_sell,breakfast,halfboard,fullboard,sahoor,iftar,weekends,wpackage  from res_rates where '$mak_rd1' between from_date and to_date - interval '1 day' and room_id = $array_room_id[$ri] ";


$result_rates = pg_query($query_g_rates);

if (!$result_rates) {
	echo "An error occured.\n";
	exit;
	}
while ($rows_rates = pg_fetch_array($result_rates)){
//echo " ";

 
$a_weekends_mak = explode(",", $rows_rates["weekends"]);



$s_wep_mak = $rows_rates["wpackage"];

}

if(trim($s_wep_mak)=="t"){ 
	
echo "Weekend Package";


if(count($a_weekends_mak)==2){     // two days weekend


$weekes_mak =  $a_weekends_mak[0];

$weekee_mak =  $a_weekends_mak[1];


if(date('D', strtotime($makcin1))== $weekee_mak){

$makcin1 = date('Y-m-d', mktime(0,0,0,$makcinm1,$makcind1-1,$makciny1));

}


if(date('D', strtotime($makcout1))== $weekee_mak){

$makcout1 = date('Y-m-d', mktime(0,0,0,$makcoutm1,$makcoutd1+1,$makcouty1));

}



}  // end of two days weekend


if(count($a_weekends_mak)==3){     // three days weekend

$weeke0_mak =  $a_weekends_mak[0];
$weeke1_mak =  $a_weekends_mak[1];
$weeke2_mak =  $a_weekends_mak[2];


if(date('D', strtotime($makcin1))== $weeke1_mak){
$makcin1 = date('Y-m-d', mktime(0,0,0,$makcinm1,$makcind1-1,$makciny1));
}
if(date('D', strtotime($makcin1))== $weeke2_mak){
$makcin1 = date('Y-m-d', mktime(0,0,0,$makcinm1,$makcind1-2,$makciny1));
}

if(date('D', strtotime($makcout1))== $weeke1_mak){
$makcout1 = date('Y-m-d', mktime(0,0,0,$makcoutm1,$makcoutd1+2,$makcouty1));
}
if(date('D', strtotime($makcout1))== $weeke2_mak){
$makcout1 = date('Y-m-d', mktime(0,0,0,$makcoutm1,$makcoutd1+1,$makcouty1));
}


}  // end of three days weekend



$makcin1 = date('Y-m-d', strtotime($makcin1));
$makcout1 = date('D, d-M-Y', strtotime($makcout1));

$maknights1 = Round(((strtotime($makcout1)-strtotime($makcin1))/86400), 0) ;




}

echo "<table width=\"100%\" border=\"1\" cellpadding=\"1\" cellspacing=\"0\"><tr><td colspan=\"8\"><div align=\"left\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><b>$array_room_type[$ri]</b></font></div></td></tr><tr><td ><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">Req. Night</font></div></td><td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">Net</font></div></td><td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">Sell</font></div></td><td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">Rooms</font></div></td><td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">Paxs</font></div></td><td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">Meals</font></div></td><td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">T.Net</font></div></td><td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">T.Sell</font></div></td></tr>";

for($d=0; $d<$maknights1; $d++){

$mak_rd = date('Y-m-d', mktime(0,0,0,date('m', strtotime($makcin1)),date('d', strtotime($makcin1))+$d,date('Y', strtotime($makcin1)) ));


$query_g_rates ="select room_id,from_date,to_date, weekday_net,weekday_sell,weekend_net,weekend_sell,breakfast,halfboard,fullboard,sahoor,iftar,weekends,wpackage  from res_rates where '$mak_rd' between from_date and to_date - interval '1 day' and room_id = $array_room_id[$ri] ";


$result_rates = pg_query($query_g_rates);

if (!$result_rates) {
	echo "An error occured.\n";
	exit;
	}
while ($rows_rates = pg_fetch_array($result_rates)){
//echo " ";

 
$a_weekends = explode(",", $rows_rates["weekends"]);


for($we=0; $we<count($a_weekends); $we++){

if($a_weekends[$we]==date('D', strtotime($mak_rd))){
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
$s_breakfast =  $rows_rates["breakfast"];
$s_halfboard =  $rows_rates["halfboard"];
$s_fullboard =  $rows_rates["fullboard"];
$s_sahoor =  $rows_rates["sahoor"];
$s_iftar =  $rows_rates["iftar"];

}

if($array_p_n_rate[$ri] || $array_p_rate[$ri]){
$ridn = $array_p_n_rate[$ri];
  $rids = $array_p_rate[$ri];
}


echo "<tr><td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">" . date('Y-m-d', mktime(0,0,0,date('m', strtotime($makcin1)),date('d', strtotime($makcin1))+$d,date('Y', strtotime($makcin1)) )) . "</font></div></td>";

if($array_p_n_rate[$ri] || $array_p_rate[$ri]){ 
echo "<td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><input type=\"text\" id=\"putnrate$ri$d\"  name=\"putnrate$ri$d\" size=\"3\" value=\"$array_p_n_rate[$ri]\" onKeyUp=\"caldayntot$ri$d();ntothot$ri()\"  onFocus=\"caldayntot$ri$d();ntothot$ri()\" onBlur=\"caldayntot$ri$d();ntothot$ri()\"></font></div></td><td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><input type=\"text\" id=\"putrate$ri$d\" name=\"putrate$ri$d\" size=\"3\"  value=\"$array_p_rate[$ri]\" onKeyUp=\"caldaytot$ri$d();tothot$ri()\" onFocus=\"caldaytot$ri$d();tothot$ri()\" onBlur=\"caldaytot$ri$d();tothot$ri()\"></font></div></td>";
}
else{
echo "<td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><input type=\"text\" id=\"putnrate$ri$d\"  name=\"putnrate$ri$d\" size=\"3\" value='$ridn' onKeyUp=\"caldayntot$ri$d();ntothot$ri()\"  onFocus=\"caldayntot$ri$d();ntothot$ri()\" onBlur=\"caldayntot$ri$d();ntothot$ri()\"></font></div></td><td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><input type=\"text\" id=\"putrate$ri$d\" name=\"putrate$ri$d\" size=\"3\"  value='$rids' onKeyUp=\"caldaytot$ri$d();tothot$ri()\" onFocus=\"caldaytot$ri$d();tothot$ri()\" onBlur=\"caldaytot$ri$d();tothot$ri()\"></font></div></td>";
}

echo "<td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">$array_sel_rooms[$ri]<input type=\"hidden\" id=\"noofrooms$ri$d\" name=\"noofrooms$ri$d\" value=\"$array_sel_rooms[$ri]\" ></font></div></td><td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">$array_sel_paxs[$ri]<input type=\"hidden\" id=\"noofpaxs$ri$d\" name=\"noofpaxs$ri$d\" value=\"$array_sel_paxs[$ri]\"></font></div></td><td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><table width=\"100%\" border=\"1\" cellpadding=\"1\" cellspacing=\"0\" align=\"center\"><tr>";


$tot_meals = 0; 

for($me=0; $me<count($array_sel_meals[$ri]) ; $me++){
echo "<td align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";

echo ucfirst($array_sel_meals[$ri][$me]) ;
$sr_meals="0";

if($ss_breakfast==$array_sel_meals[$ri][$me]){
if(trim($s_breakfast)=="Included"){
$sr_meals="INC";
}
else if(trim($s_breakfast)=="Not Available"){
$sr_meals="NA";
}
else{
$sr_meals=$s_breakfast;
$tot_meals = $tot_meals+$s_breakfast;
}
}


if($ss_halfboard==$array_sel_meals[$ri][$me]){
if(trim($s_halfboard)=="Included"){
$sr_meals="INC";
}
else if(trim($s_halfboard)=="Not Available"){
$sr_meals="NA";
}
else{
$sr_meals=$s_halfboard;
$tot_meals = $tot_meals+$s_halfboard;
}
}

if($ss_fullboard==$array_sel_meals[$ri][$me]){
if(trim($s_fullboard)=="Included" ){
$sr_meals="INC";
}
else if(trim($s_fullboard)=="Not Available"){
$sr_meals="NA";
}
else{
//echo $s_fullboard;
$sr_meals=$s_fullboard;
$tot_meals = $tot_meals+$s_fullboard;
}
}

if($ss_sahoor==$array_sel_meals[$ri][$me]){
if(trim($s_sahoor)=="Included" ){
$sr_meals="INC";
}
else if(trim($s_sahoor)=="Not Available"){
$sr_meals="NA";
}
else{

$sr_meals=$s_sahoor;
$tot_meals = $tot_meals+$s_sahoor;
}
}

if($ss_iftar==$array_sel_meals[$ri][$me]){
if(trim($s_iftar)=="Included" ){
$sr_meals="INC";
}
else if (trim($s_iftar)=="Not Available"){
$sr_meals="NA";
}
else{
//echo $s_iftar;
$sr_meals=$s_iftar;
$tot_meals = $tot_meals+$s_iftar;
}
}





if($array_p_n_rate[$ri] || $array_p_rate[$ri]){ 

echo "<br>";
echo "<input type=\"text\" id=\"meals$ri$me$d\" name=\"meals$ri$me$d\" size=\"1\" value=\"NA\" onKeyUp=\"calmealstot$ri$me$d();tothot$ri();calmealsntot$ri$me$d();ntothot$ri();roomselput.meals$ri$me$d.value=roomselput.meals$ri$me$d.value.toUpperCase()\" onFocus=\"calmealstot$ri$me$d();tothot$ri();calmealsntot$ri$me$d();ntothot$ri();roomselput.meals$ri$me$d.value=roomselput.meals$ri$me$d.value.toUpperCase()\" onBlur=\"calmealstot$ri$me$d();tothot$ri();calmealsntot$ri$me$d();ntothot$ri();roomselput.meals$ri$me$d.value=roomselput.meals$ri$me$d.value.toUpperCase()\">";
echo "</font></td>";
$tot_meals=0;
}
else {
echo "<br>";
echo "<input type=\"text\" id=\"meals$ri$me$d\" name=\"meals$ri$me$d\" size=\"1\" value=\"$sr_meals\" onKeyUp=\"calmealstot$ri$me$d();tothot$ri();calmealsntot$ri$me$d();ntothot$ri();roomselput.meals$ri$me$d.value=roomselput.meals$ri$me$d.value.toUpperCase()\" onFocus=\"calmealstot$ri$me$d();tothot$ri();calmealsntot$ri$me$d();ntothot$ri();roomselput.meals$ri$me$d.value=roomselput.meals$ri$me$d.value.toUpperCase()\" onBlur=\"calmealstot$ri$me$d();tothot$ri();calmealsntot$ri$me$d();ntothot$ri();roomselput.meals$ri$me$d.value=roomselput.meals$ri$me$d.value.toUpperCase()\">";
echo "</font></td>";
}


?>
<script>

function calmealstot<? echo $ri.$me.$d; ?>(){ 

var roomt = document.getElementById ('putrate<? echo $ri.$d; ?>').value * document.getElementById ('noofrooms<? echo $ri.$d; ?>').value ;

var mealst = 0; 
var mea =0;

'<? for($m=0; $m<count($array_sel_meals[$ri]); $m++){?>'

if(trimString(document.getElementById ('meals<? echo $ri.$m.$d; ?>').value)=="INC" || trimString(document.getElementById ('meals<? echo $ri.$m.$d; ?>').value)=="NA"){ mea = 0;}
else{
mea = parseFloat(document.getElementById ('meals<? echo $ri.$m.$d; ?>').value);
}

mealst = mealst + mea;



'<?}?>'



var mealstt = parseFloat(mealst) * document.getElementById ('noofpaxs<? echo $ri.$d; ?>').value ;


document.getElementById ('daytot<? echo $ri.$d; ?>').value = parseFloat(roomt) + parseFloat(mealstt);



}


function calmealsntot<? echo $ri.$me.$d; ?>(){ 

var nroomt = document.getElementById ('putnrate<? echo $ri.$d; ?>').value * document.getElementById ('noofrooms<? echo $ri.$d; ?>').value ;

var nmealst = 0; 
var nmea =0;
'<? for($m=0; $m<count($array_sel_meals[$ri]); $m++){?>'


if(trimString(document.getElementById ('meals<? echo $ri.$m.$d; ?>').value)=="INC" || trimString(document.getElementById ('meals<? echo $ri.$m.$d; ?>').value)=="NA"){ nmea = 0;}
else{
nmea = parseFloat(document.getElementById ('meals<? echo $ri.$m.$d; ?>').value);
}

nmealst = nmealst + nmea;





'<?}?>'



var nmealstt = parseFloat(nmealst) * document.getElementById ('noofpaxs<? echo $ri.$d; ?>').value ;


document.getElementById ('dayntot<? echo $ri.$d; ?>').value = parseFloat(nroomt) + parseFloat(nmealstt);

}

</script>
<?




}


//echo $day_room_tot = $rids * $array_sel_rooms[$ri] ;
//echo $day_room_ntot = $ridn * $array_sel_rooms[$ri] ;

$day_room_tot = $rids * $array_sel_rooms[$ri]   + $array_sel_paxs[$ri]*$tot_meals;
$day_room_ntot = $ridn * $array_sel_rooms[$ri]  + $array_sel_paxs[$ri]*$tot_meals;


echo "</tr></table></font></div></td><td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><input type=\"text\" id=\"dayntot$ri$d\" name=\"dayntot$ri$d\" size=\"2\" value='$day_room_ntot' readonly></td><td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><input type=\"text\" id=\"daytot$ri$d\" name=\"daytot$ri$d\" size=\"2\" value='$day_room_tot' readonly></font></div></td></tr>";



$hot_tot = $hot_tot + $day_room_tot; 
$hot_ntot = $hot_ntot + $day_room_ntot;
$day_room_tot=0;
$day_room_ntot=0;

?>
<script>
	function caldaytot<? echo $ri.$d; ?>(){ 
		document.getElementById ('daytot<? echo $ri.$d; ?>').value =  document.getElementById ('putrate<? echo $ri.$d; ?>').value * document.getElementById ('noofrooms<? echo $ri.$d; ?>').value;

'<? for($mer=0; $mer<count($array_sel_meals[$ri]) ; $mer++){ ?>'
 calmealstot<? echo $ri.$mer.$d; ?>();
'<?}?>'

}

	function caldayntot<? echo $ri.$d; ?>(){ 
		document.getElementById ('dayntot<? echo $ri.$d; ?>').value =  document.getElementById ('putnrate<? echo $ri.$d; ?>').value * document.getElementById ('noofrooms<? echo $ri.$d; ?>').value;

'<? for($mer=0; $mer<count($array_sel_meals[$ri]) ; $mer++){ ?>'
calmealsntot<? echo $ri.$mer.$d; ?>();
'<?}?>'

}

</script>
<?


}

$hot_ntot = ceil($hot_ntot);
$hot_tot = ceil($hot_tot);

echo "<tr><td colspan=\"7\"><div align=\"right\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">GT.Net:<br><input type=\"text\" id=\"hotntot$ri\" name=\"hotntot$ri\" size=\"2\" value='$hot_ntot' readonly></font></div></td><td colspan=\"7\"><div align=\"right\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">GT.Sell:<br><input type=\"text\" id=\"hottot$ri\" name=\"hottot$ri\" size=\"2\" value='$hot_tot' readonly></font></div></td></tr>";


?>
<script>
	function tothot<? echo $ri; ?>(){ 

var hotv=0 ;

'<? for($dd=0; $dd<$maknights1; $dd++){?>'

 hotv = parseFloat(hotv) + parseFloat(document.getElementById ('daytot<? echo $ri.$dd  ; ?>').value);

'<?}?>'
 document.getElementById ('hottot<? echo $ri; ?>').value = Math.ceil(hotv);
 
htotal(gt);
grand_sell(grand_gt);
}

function ntothot<? echo $ri; ?>(){ 

var nhotv=0 ;

'<? for($dd=0; $dd<$maknights1; $dd++){?>'

 nhotv = parseFloat(nhotv) + parseFloat(document.getElementById ('dayntot<? echo $ri.$dd  ; ?>').value);

'<?}?>'
 document.getElementById ('hotntot<? echo $ri; ?>').value = Math.ceil(nhotv);
hntotal(gnt); 
grand_net(grand_gnt);
}


</script>

<script>

function htotal(val){
var gtotv=0 ;

'<? for($gtot=0; $gtot<count($array_room_id); $gtot++){?>'

gtotv = parseFloat(gtotv) + parseFloat(document.getElementById ('hottot<? echo $gtot  ; ?>').value);

'<?}?>'
val.innerHTML = gtotv;
}


function hntotal(val){
var gntotv=0 ;

'<? for($gntot=0; $gntot<count($array_room_id); $gntot++){?>'

gntotv = parseFloat(gntotv) + parseFloat(document.getElementById ('hotntot<? echo $gntot  ; ?>').value);

'<?}?>'
val.innerHTML = gntotv;

}

</script>

<?



echo "<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" ><tr><td bgcolor=\"#FFFFFF\">&nbsp;</td></tr></table>";
$hot_tot=0;
$hot_ntot=0;
}


echo "<tr><td><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">Makkah Room(s) Total <FONT 
style=\"BACKGROUND-COLOR: #DFDFDF\">NetRate:</FONT> SAR <span id=\"gnt\">0</span>/-</font></td></tr>";


echo "<tr><td align=\"right\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">Makkah Room(s) Total <FONT 
style=\"BACKGROUND-COLOR: #DFDFDF\">SellingRate:</FONT> SAR <span id=\"gt\">0</span>/-</font></td></tr>";





//echo "<tr><td >&nbsp;</td></tr>";

//echo "<tr><td align=\"right\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><input type=\"submit\" name=\"submit\" value=\"Book Room(s) >>\" ></font></td></tr>";



echo "</table>";






						 ?>
<script>
htotal(gt);
hntotal(gnt);
</script>


</td>
                            </tr>		

		
		</table>
					
			<?}// end of makkah hotel?>							
   


<?

 if($_SESSION["hotcb2"]==on){ // start if for other hotel
?>							

  <table width="100%" cellpadding="1" cellspacing="0">
                                   <tr bgcolor="#CCCCCC">
                            <td colspan="2"><b>Hotel in Other City<b></td>
                          </tr>
								  <tr> 
                                    <td width="17%" style="border-right: 1px solid #999999"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Check 
                                      In</font></td>
                                    <td ><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><? echo $othcins ?></font></td>
                                  </tr>
                                  <tr> 
                                    <td style="border-right: 1px solid #999999"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Check 
                                      Out</font></td><td><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><? echo $othcouts ?></font></td>
                                  </tr>
                                  <tr> 
                                    <td style="border-right: 1px solid #999999"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Hotel 
                                      Name</font></td><td><font size="2" face="Verdana, Arial, Helvetica, sans-serif">
									  <?
									  $query_hotel ="select hotel_id, hotel_name, city from hotels where hotel_id='$s_hotelsoth'";

$result_hotel = pg_query($query_hotel);

if (!$result_hotel) {
echo "An error occured.\n";
exit;
		}
while ($rows_hotel = pg_fetch_array($result_hotel)){
$hotel_name_dis = $rows_hotel["hotel_name"];
$hotel_city = $rows_hotel["city"];
}
pg_free_result($result_hotel);

echo $hotel_name_dis;
echo " - " ;
echo $hotel_city;
echo "&nbsp;&nbsp;&nbsp;";
echo "<a href=\"#\">more about hotel...</a>";

								

									  ?>
									  
									  </font></td>
                                  </tr>
                                						
								</table>				
		<table width="100%">

 <tr><td bgcolor="#EFEFEF"> 
                         
							  <?

$_SESSION["othselrcb"] = $_POST["othselrcb"];
                        
$oth_arr_room_id = $_POST["othselrcb"];							  
//print_r($arr_room_id);

$oth_array_sel_rooms = array();
$oth_array_sel_meals = array();
$oth_array_sel_paxs = array();

$oth_array_room_id = array();
$oth_array_room_type = array();
$oth_array_no_of_paxs = array();
$oth_array_room_description = array();

for($i=0; $i<count($oth_arr_room_id); $i++){

$query_room ="select room_id, room_type, no_of_paxs from rooms where room_id ='$oth_arr_room_id[$i]'";

$result_room = pg_query($query_room);

if (!$result_room) {
	echo "An error occured.\n";
	exit;
	}
while ($rows_room = pg_fetch_array($result_room)){

$oth_array_room_id[] = $rows_room["room_id"];
$oth_array_room_type[] = $rows_room["room_type"];
$oth_array_no_of_paxs[] = $rows_room["no_of_paxs"];
}
pg_free_result($result_room);


$oth_array_sel_rooms[] = $_POST["othrooms$oth_arr_room_id[$i]"];
$oth_array_sel_meals[] = $_POST["othmeals$oth_arr_room_id[$i]"];
$oth_array_sel_paxs[] =  $_POST["othpaxs$oth_arr_room_id[$i]"];

$oth_array_p_n_rate[] = $_POST["othputnrate$oth_arr_room_id[$i]"];
$oth_array_p_rate[] = $_POST["othputrate$oth_arr_room_id[$i]"];

}


$_SESSION["oth_array_sel_rooms"]=$oth_array_sel_rooms;
$_SESSION["oth_array_sel_meals"]=$oth_array_sel_meals;
$_SESSION["oth_array_sel_paxs"]=$oth_array_sel_paxs;


$hb_r=0;

$oth_day_room_tot=0;
$oth_day_room_ntot=0;
$oth_hot_tot=0;
$oth_hot_ntot=0;

for($ri=0; $ri<count($oth_array_room_id); $ri++){



$oth_rd1 = date('Y-m-d', mktime(0,0,0,$othcinm,$othcind,$othciny));

$query_g_rates_oth ="select room_id,from_date,to_date, weekday_net,weekday_sell,weekend_net,weekend_sell,breakfast,halfboard,fullboard,sahoor,iftar,weekends,wpackage  from res_rates where '$oth_rd1' between from_date and to_date - interval '1 day' and room_id = $oth_arr_room_id[$ri] ";


$result_rates_oth = pg_query($query_g_rates_oth);

if (!$result_rates_oth) {
	echo "An error occured.\n";
	exit;
	}
while ($rows_rates_oth = pg_fetch_array($result_rates_oth)){
//echo " ";

 
$a_weekends_oth = explode(",", $rows_rates_oth["weekends"]);

$s_wep_oth = $rows_rates_oth["wpackage"];

}

if(trim($s_wep_oth)=="t"){ 
	
echo "Weekend Package";


if(count($a_weekends_oth)==2){     // two days weekend


$weekes_oth =  $a_weekends_oth[0];

$weekee_oth =  $a_weekends_oth[1];


if(date('D', strtotime($othcin1))== $weekee_oth){

$othcin1 = date('Y-m-d', mktime(0,0,0,$othcinm1,$othcind1-1,$othciny1));

}




if(date('D', strtotime($othcout1))== $weekee_oth){

$othcout1 = date('Y-m-d', mktime(0,0,0,$othcoutm1,$othcoutd1+1,$othcouty1));

}



}  // end of two days weekend


if(count($a_weekends_oth)==3){     // three days weekend

$weeke0_oth =  $a_weekends_oth[0];
$weeke1_oth =  $a_weekends_oth[1];
$weeke2_oth =  $a_weekends_oth[2];


if(date('D', strtotime($othcin1))== $weeke1_oth){
$othcin1 = date('Y-m-d', mktime(0,0,0,$othcinm1,$othcind1-1,$othciny1));
}
if(date('D', strtotime($othcin1))== $weeke2_oth){
$othcin1 = date('Y-m-d', mktime(0,0,0,$othcinm1,$othcind1-2,$othciny1));
}

if(date('D', strtotime($othcout1))== $weeke1_oth){
$othcout1 = date('Y-m-d', mktime(0,0,0,$othcoutm1,$othcoutd1+2,$othcouty1));
}
if(date('D', strtotime($othcout1))== $weeke2_oth){
$othcout1 = date('Y-m-d', mktime(0,0,0,$othcoutm1,$othcoutd1+1,$othcouty1));
}


}  // end of three days weekend



$othcin1 = date('Y-m-d', strtotime($othcin1));

$othcout1 = date('Y-m-d', strtotime($othcout1));

$othnights1 = Round(((strtotime($othcout1)-strtotime($othcin1))/86400), 0) ;


}



echo "<table width=\"100%\" border=\"1\" cellpadding=\"1\" cellspacing=\"0\"><tr><td colspan=\"8\"><div align=\"left\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><b>$oth_array_room_type[$ri]</b></font></div></td></tr><tr><td ><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">Req. Night</font></div></td><td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">Net</font></div></td><td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">Sell</font></div></td><td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">Rooms</font></div></td><td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">Paxs</font></div></td><td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">Meals</font></div></td><td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">T.Net</font></div></td><td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">T.Sell</font></div></td></tr>";

for($d=0; $d<$othnights1; $d++){

$oth_rd = date('Y-m-d', mktime(0,0,0,date('m', strtotime($othcin1)),date('d', strtotime($othcin1))+$d,date('Y', strtotime($othcin1)) ));


$query_g_rates ="select room_id,from_date,to_date, weekday_net,weekday_sell,weekend_net,weekend_sell,breakfast,halfboard,fullboard,sahoor,iftar,weekends,wpackage  from res_rates where '$oth_rd' between from_date and to_date - interval '1 day' and room_id = $oth_array_room_id[$ri] ";


$result_rates = pg_query($query_g_rates);

if (!$result_rates) {
	echo "An error occured.\n";
	exit;
	}
while ($rows_rates = pg_fetch_array($result_rates)){
//echo " ";

 
$a_weekends = explode(",", $rows_rates["weekends"]);


for($we=0; $we<count($a_weekends); $we++){

if($a_weekends[$we]==date('D', strtotime($oth_rd))){
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
$s_breakfast =  $rows_rates["breakfast"];
$s_halfboard =  $rows_rates["halfboard"];
$s_fullboard =  $rows_rates["fullboard"];
$s_sahoor =  $rows_rates["sahoor"];
$s_iftar =  $rows_rates["iftar"];

}

if($oth_array_p_n_rate[$ri] || $oth_array_p_rate[$ri]){
$ridn = $oth_array_p_n_rate[$ri];
  $rids = $oth_array_p_rate[$ri];
}


echo "<tr><td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">" . date('Y-m-d', mktime(0,0,0,date('m', strtotime($othcin1)),date('d', strtotime($othcin1))+$d,date('Y', strtotime($othcin1)) )) . "</font></div></td>";

if($oth_array_p_n_rate[$ri] || $oth_array_p_rate[$ri]){
echo "<td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><input type=\"text\" id=\"oth_putnrate$ri$d\"  name=\"oth_putnrate$ri$d\" size=\"3\" value=\"$oth_array_p_n_rate[$ri]\" onKeyUp=\"oth_caldayntot$ri$d();oth_ntothot$ri()\"  onFocus=\"oth_caldayntot$ri$d();oth_ntothot$ri()\" onBlur=\"oth_caldayntot$ri$d();oth_ntothot$ri()\"></font></div></td><td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><input type=\"text\" id=\"oth_putrate$ri$d\" name=\"oth_putrate$ri$d\" size=\"3\"  value=\"$oth_array_p_rate[$ri]\" onKeyUp=\"oth_caldaytot$ri$d();oth_tothot$ri()\" onFocus=\"oth_caldaytot$ri$d();oth_tothot$ri()\" onBlur=\"oth_caldaytot$ri$d();oth_tothot$ri()\"></font></div></td>";
}
else{
echo "<td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><input type=\"text\" id=\"oth_putnrate$ri$d\"  name=\"oth_putnrate$ri$d\" size=\"3\" value='$ridn' onKeyUp=\"oth_caldayntot$ri$d();oth_ntothot$ri()\"  onFocus=\"oth_caldayntot$ri$d();oth_ntothot$ri()\" onBlur=\"oth_caldayntot$ri$d();oth_ntothot$ri()\"></font></div></td><td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><input type=\"text\" id=\"oth_putrate$ri$d\" name=\"oth_putrate$ri$d\" size=\"3\"  value='$rids' onKeyUp=\"oth_caldaytot$ri$d();oth_tothot$ri()\" onFocus=\"oth_caldaytot$ri$d();oth_tothot$ri()\" onBlur=\"oth_caldaytot$ri$d();oth_tothot$ri()\"></font></div></td>";
}


echo "<td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">$oth_array_sel_rooms[$ri]<input type=\"hidden\" id=\"oth_noofrooms$ri$d\" name=\"oth_noofrooms$ri$d\" value=\"$oth_array_sel_rooms[$ri]\" ></font></div></td><td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">$oth_array_sel_paxs[$ri]<input type=\"hidden\" id=\"oth_noofpaxs$ri$d\" name=\"oth_noofpaxs$ri$d\" value=\"$oth_array_sel_paxs[$ri]\"></font></div></td><td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><table width=\"100%\" border=\"1\" cellpadding=\"1\" cellspacing=\"0\" align=\"center\"><tr>";


$tot_meals = 0; 

for($me=0; $me<count($oth_array_sel_meals[$ri]) ; $me++){
echo "<td align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";

echo ucfirst($oth_array_sel_meals[$ri][$me]) ;
$sr_meals="0";

if($ss_breakfast==$oth_array_sel_meals[$ri][$me]){
if(trim($s_breakfast)=="Included"){
$sr_meals="INC";
}
else if(trim($s_breakfast)=="Not Available"){
$sr_meals="NA";
}
else{
$sr_meals=$s_breakfast;
$tot_meals = $tot_meals+$s_breakfast;
}
}


if($ss_halfboard==$oth_array_sel_meals[$ri][$me]){
if(trim($s_halfboard)=="Included"){
$sr_meals="INC";
}
else if(trim($s_halfboard)=="Not Available"){
$sr_meals="NA";
}
else{
$sr_meals=$s_halfboard;
$tot_meals = $tot_meals+$s_halfboard;
}
}

if($ss_fullboard==$oth_array_sel_meals[$ri][$me]){
if(trim($s_fullboard)=="Included" ){
$sr_meals="INC";
}
else if(trim($s_fullboard)=="Not Available"){
$sr_meals="NA";
}
else{
//echo $s_fullboard;
$sr_meals=$s_fullboard;
$tot_meals = $tot_meals+$s_fullboard;
}
}

if($ss_sahoor==$oth_array_sel_meals[$ri][$me]){
if(trim($s_sahoor)=="Included" ){
$sr_meals="INC";
}
else if(trim($s_sahoor)=="Not Available"){
$sr_meals="NA";
}
else{

$sr_meals=$s_sahoor;
$tot_meals = $tot_meals+$s_sahoor;
}
}

if($ss_iftar==$oth_array_sel_meals[$ri][$me]){
if(trim($s_iftar)=="Included" ){
$sr_meals="INC";
}
else if (trim($s_iftar)=="Not Available"){
$sr_meals="NA";
}
else{
//echo $s_iftar;
$sr_meals=$s_iftar;
$tot_meals = $tot_meals+$s_iftar;
}
}




if($oth_array_p_n_rate[$ri] || $oth_array_p_rate[$ri]){
echo "<br>";
echo "<input type=\"text\" id=\"oth_meals$ri$me$d\" name=\"oth_meals$ri$me$d\" size=\"1\" value=\"NA\" onKeyUp=\"oth_calmealstot$ri$me$d();oth_tothot$ri();oth_calmealsntot$ri$me$d();oth_ntothot$ri();roomselput.oth_meals$ri$me$d.value=roomselput.oth_meals$ri$me$d.value.toUpperCase()\" onFocus=\"oth_calmealstot$ri$me$d();oth_tothot$ri();oth_calmealsntot$ri$me$d();oth_ntothot$ri();roomselput.oth_meals$ri$me$d.value=roomselput.oth_meals$ri$me$d.value.toUpperCase()\" onBlur=\"oth_calmealstot$ri$me$d();oth_tothot$ri();oth_calmealsntot$ri$me$d();oth_ntothot$ri();roomselput.oth_meals$ri$me$d.value=roomselput.oth_meals$ri$me$d.value.toUpperCase()\">";
echo "</font></td>";
$tot_meals=0;
}
else{
echo "<br>";
echo "<input type=\"text\" id=\"oth_meals$ri$me$d\" name=\"oth_meals$ri$me$d\" size=\"1\" value=\"$sr_meals\" onKeyUp=\"oth_calmealstot$ri$me$d();oth_tothot$ri();oth_calmealsntot$ri$me$d();oth_ntothot$ri();roomselput.oth_meals$ri$me$d.value=roomselput.oth_meals$ri$me$d.value.toUpperCase()\" onFocus=\"oth_calmealstot$ri$me$d();oth_tothot$ri();oth_calmealsntot$ri$me$d();oth_ntothot$ri();roomselput.oth_meals$ri$me$d.value=roomselput.oth_meals$ri$me$d.value.toUpperCase()\" onBlur=\"oth_calmealstot$ri$me$d();oth_tothot$ri();oth_calmealsntot$ri$me$d();oth_ntothot$ri();roomselput.oth_meals$ri$me$d.value=roomselput.oth_meals$ri$me$d.value.toUpperCase()\">";
echo "</font></td>";
}

?>
<script>

function oth_calmealstot<? echo $ri.$me.$d; ?>(){ 

var roomt = document.getElementById ('oth_putrate<? echo $ri.$d; ?>').value * document.getElementById ('oth_noofrooms<? echo $ri.$d; ?>').value ;

var mealst = 0; 
var mea =0;

'<? for($m=0; $m<count($oth_array_sel_meals[$ri]); $m++){?>'

if(trimString(document.getElementById ('oth_meals<? echo $ri.$m.$d; ?>').value)=="INC" || trimString(document.getElementById ('oth_meals<? echo $ri.$m.$d; ?>').value)=="NA"){ mea = 0;}
else{
mea = parseFloat(document.getElementById ('oth_meals<? echo $ri.$m.$d; ?>').value);
}

mealst = mealst + mea;



'<?}?>'



var mealstt = parseFloat(mealst) * document.getElementById ('oth_noofpaxs<? echo $ri.$d; ?>').value ;


document.getElementById ('oth_daytot<? echo $ri.$d; ?>').value = parseFloat(roomt) + parseFloat(mealstt);



}


function oth_calmealsntot<? echo $ri.$me.$d; ?>(){ 

var nroomt = document.getElementById ('oth_putnrate<? echo $ri.$d; ?>').value * document.getElementById ('oth_noofrooms<? echo $ri.$d; ?>').value ;

var nmealst = 0; 
var nmea =0;
'<? for($m=0; $m<count($oth_array_sel_meals[$ri]); $m++){?>'


if(trimString(document.getElementById ('oth_meals<? echo $ri.$m.$d; ?>').value)=="INC" || trimString(document.getElementById ('oth_meals<? echo $ri.$m.$d; ?>').value)=="NA"){ nmea = 0;}
else{
nmea = parseFloat(document.getElementById ('oth_meals<? echo $ri.$m.$d; ?>').value);
}

nmealst = nmealst + nmea;





'<?}?>'



var nmealstt = parseFloat(nmealst) * document.getElementById ('oth_noofpaxs<? echo $ri.$d; ?>').value ;


document.getElementById ('oth_dayntot<? echo $ri.$d; ?>').value = parseFloat(nroomt) + parseFloat(nmealstt);

}

</script>
<?




}


//echo $day_room_tot = $rids * $array_sel_rooms[$ri] ;
//echo $day_room_ntot = $ridn * $array_sel_rooms[$ri] ;

$oth_day_room_tot = $rids * $oth_array_sel_rooms[$ri]   + $oth_array_sel_paxs[$ri]*$tot_meals;
$oth_day_room_ntot = $ridn * $oth_array_sel_rooms[$ri]  + $oth_array_sel_paxs[$ri]*$tot_meals;


echo "</tr></table></font></div></td><td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><input type=\"text\" id=\"oth_dayntot$ri$d\" name=\"oth_dayntot$ri$d\" size=\"2\" value='$oth_day_room_ntot' readonly></td><td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><input type=\"text\" id=\"oth_daytot$ri$d\" name=\"oth_daytot$ri$d\" size=\"2\" value='$oth_day_room_tot' readonly></font></div></td></tr>";



$oth_hot_tot = $oth_hot_tot + $oth_day_room_tot; 
$oth_hot_ntot = $oth_hot_ntot + $oth_day_room_ntot;
$oth_day_room_tot=0;
$oth_day_room_ntot=0;

?>
<script>
	function oth_caldaytot<? echo $ri.$d; ?>(){ 
		document.getElementById ('oth_daytot<? echo $ri.$d; ?>').value =  document.getElementById ('oth_putrate<? echo $ri.$d; ?>').value * document.getElementById ('oth_noofrooms<? echo $ri.$d; ?>').value;

'<? for($mer=0; $mer<count($oth_array_sel_meals[$ri]) ; $mer++){ ?>'
 oth_calmealstot<? echo $ri.$mer.$d; ?>();
'<?}?>'

}

	function oth_caldayntot<? echo $ri.$d; ?>(){ 
		document.getElementById ('oth_dayntot<? echo $ri.$d; ?>').value =  document.getElementById ('oth_putnrate<? echo $ri.$d; ?>').value * document.getElementById ('oth_noofrooms<? echo $ri.$d; ?>').value;

'<? for($mer=0; $mer<count($oth_array_sel_meals[$ri]) ; $mer++){ ?>'
oth_calmealsntot<? echo $ri.$mer.$d; ?>();
'<?}?>'

}

</script>
<?


}

$oth_hot_ntot = ceil($oth_hot_ntot);
$oth_hot_tot = ceil($oth_hot_tot);

echo "<tr><td colspan=\"7\"><div align=\"right\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">GT.Net:<br><input type=\"text\" id=\"oth_hotntot$ri\" name=\"oth_hotntot$ri\" size=\"2\" value='$oth_hot_ntot' readonly></font></div></td><td colspan=\"7\"><div align=\"right\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">GT.Sell:<br><input type=\"text\" id=\"oth_hottot$ri\" name=\"oth_hottot$ri\" size=\"2\" value='$oth_hot_tot' readonly></font></div></td></tr>";


?>
<script>
	function oth_tothot<? echo $ri; ?>(){ 

var hotv=0 ;

'<? for($dd=0; $dd<$othnights1; $dd++){?>'

 hotv = parseFloat(hotv) + parseFloat(document.getElementById ('oth_daytot<? echo $ri.$dd  ; ?>').value);

'<?}?>'
 document.getElementById ('oth_hottot<? echo $ri; ?>').value = Math.ceil(hotv);
 
oth_htotal(oth_gt);
grand_sell(grand_gt);
}

function oth_ntothot<? echo $ri; ?>(){ 

var nhotv=0 ;

'<? for($dd=0; $dd<$othnights1; $dd++){?>'

 nhotv = parseFloat(nhotv) + parseFloat(document.getElementById ('oth_dayntot<? echo $ri.$dd  ; ?>').value);

'<?}?>'
 document.getElementById ('oth_hotntot<? echo $ri; ?>').value = Math.ceil(nhotv);
oth_hntotal(oth_gnt);
grand_net(grand_gnt);
}


</script>

<script>

function oth_htotal(val){
var gtotv=0 ;

'<? for($gtot=0; $gtot<count($oth_array_room_id); $gtot++){?>'

gtotv = parseFloat(gtotv) + parseFloat(document.getElementById ('oth_hottot<? echo $gtot  ; ?>').value);

'<?}?>'
val.innerHTML = gtotv;
}


function oth_hntotal(val){
var gntotv=0 ;

'<? for($gntot=0; $gntot<count($oth_array_room_id); $gntot++){?>'

gntotv = parseFloat(gntotv) + parseFloat(document.getElementById ('oth_hotntot<? echo $gntot  ; ?>').value);

'<?}?>'
val.innerHTML = gntotv;
}

</script>

<?



echo "<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" ><tr><td bgcolor=\"#FFFFFF\">&nbsp;</td></tr></table>";
$oth_hot_tot=0;
$oth_hot_ntot=0;
}


echo "<tr><td><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">Other City  Room(s) Total <FONT 
style=\"BACKGROUND-COLOR: #DFDFDF\">NetRate:</FONT> SAR <span id=\"oth_gnt\">0</span>/-</font></td></tr>";


echo "<tr><td align=\"right\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">Other City Room(s) Total <FONT 
style=\"BACKGROUND-COLOR: #DFDFDF\">SellingRate:</FONT> SAR <span id=\"oth_gt\">0</span>/-</font></td></tr>";


//echo "<tr><td >&nbsp;</td></tr>";

//echo "<tr><td align=\"right\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><input type=\"submit\" name=\"submit\" value=\"Book Room(s) >>\" ></font></td></tr>";



echo "</table>";






						 ?>
<script>
oth_htotal(oth_gt);
oth_hntotal(oth_gnt);
</script>


</td>
                            </tr>		

		
		</table>						
							
			<?}// end of other hotel?>



<?
if($_SESSION["trans0"]==on){ // start if transportation 1
?>		

 <table width="100%" cellpadding="1" cellspacing="0">
                                   <tr bgcolor="#FFFFFF">
                            <td colspan="8">&nbsp;</td>
                          </tr>

								   <tr bgcolor="#CCCCCC">
                            <td colspan="8"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Transportation Sno : 1</font></td>
                          </tr>
					    <tr bgcolor="#FFFFFF">
                            <td colspan="8"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Transportation Supplier :
<?
for($t0=0; $t0<count($array_trans_id); $t0++){
if($s_s_trans0==$array_trans_id[$t0]){
echo $array_trans[$t0] . " - " . $array_trans_city[$t0];	

}
}

?>
</font></td>      </tr>

<tr bgcolor="#EFEFEF">
                            <td colspan="1" align="center" style="border-right: 1px solid #999999; border-top: 1px solid #999999" ><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Trans Type</b></font></td>
                            <td colspan="1" align="center" style="border-right: 1px solid #999999; border-top: 1px solid #999999"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Trans Route</b></font></td>
                            <td colspan="1" align="center" style="border-right: 1px solid #999999; border-top: 1px solid #999999"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Units</b></font></td>
                            <td colspan="1" align="center" style="border-right: 1px solid #999999; border-top: 1px solid #999999"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Date & Time</b></font></td>
                            <td colspan="1" align="center" style="border-right: 1px solid #999999; border-top: 1px solid #999999"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Flight Details</b></font></td>
                            <td colspan="1" align="center" style="border-right: 1px solid #999999; border-top: 1px solid #999999"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>No of Paxs</b></font></td>
                            <td colspan="1" align="center" style="border-right: 1px solid #999999; border-top: 1px solid #999999"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Net Rate</b></font></td>
                            <td colspan="1" align="center" style="border-top: 1px solid #999999"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Sell Rate</b></font></td>


                          </tr>

<?


$trans0rd = $trans0y ."-". $trans0m ."-". $trans0d ; 

$s_typeoftrans0		  = $_SESSION['typeoftrans0'];     


for($tv0=0; $tv0<count($array_transt_id); $tv0++){
if($s_typeoftrans0==$array_transt_id[$tv0]){
$tvety0=$array_transt[$tv0] ;
$tvetr0=$array_transt_route[$tv0];	
$tvetp0=$array_nofp[$tv0];
}
}

$trans1netr=0;
$trans1sellr=0;

$query_trans1_rates ="select trans_id,from_date,to_date, net_rate,sell_rate  from res_trans_rates where '$trans0rd' between from_date and to_date - interval '1 day' and trans_id = $s_typeoftrans0 ";

$result_trans1_rates = pg_query($query_trans1_rates);

if (!$result_trans1_rates) {
	echo "An error occured.\n";
	exit;
	}
while ($rows_trans1_rates = pg_fetch_array($result_trans1_rates)){

$trans1netr=$rows_trans1_rates["net_rate"];
$trans1sellr=$rows_trans1_rates["sell_rate"];

}
	   


?>

<tr bgcolor="#EFEFEF">
                            <td colspan="1" align="center" style="border-bottom: 1px solid #999999; border-right: 1px solid #999999; border-top: 1px solid #999999" ><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><? $_SESSION['tvety0'] = $tvety0 ; echo $tvety0 ;?></font></td>
                            <td colspan="1" align="center" style="border-bottom: 1px solid #999999;border-right: 1px solid #999999; border-top: 1px solid #999999"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><? $_SESSION['tvetr0'] = $tvetr0 ; echo $tvetr0 ; ?></font></td>
                            <td colspan="1" align="center" style="border-bottom: 1px solid #999999;border-right: 1px solid #999999; border-top: 1px solid #999999"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><? echo $s_noofu0 ?></font></td>
                            <td colspan="1" align="center" style="border-bottom: 1px solid #999999;border-right: 1px solid #999999; border-top: 1px solid #999999"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><? echo date('d-M-Y', strtotime($trans0rd)) ."<br>". $s_timeselecthours0 .":".$s_timeselectmin0; ?></font></td>
                            <td colspan="1" align="center" style="border-bottom: 1px solid #999999;border-right: 1px solid #999999; border-top: 1px solid #999999"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><? echo $s_flightdet0 ?></font></td>
                            <td colspan="1" align="center" style="border-bottom: 1px solid #999999;border-right: 1px solid #999999; border-top: 1px solid #999999"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><? $_SESSION['tvetp0'] = $tvetp0 ; echo $tvetp0 * $s_noofu0?></font></td>
                            
							


							<script>
function trans1n<? echo $s_typeoftrans0 ;?>(){ 
grand_net(grand_gnt);
}
function trans1<? echo $s_typeoftrans0 ;?>(){ 
grand_sell(grand_gt);
}
</script>
							
							<td colspan="1" align="center" style="border-bottom: 1px solid #999999;border-right: 1px solid #999999; border-top: 1px solid #999999"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><input type="text" id="trans1nrate<? echo $s_typeoftrans0 ?>" name="trans1nrate<? echo $s_typeoftrans0 ?>" value='<? echo $trans1netr * $s_noofu0 ?>' size="2" onKeyUp="trans1n<? echo $s_typeoftrans0 ?>()"  onFocus="trans1n<? echo $s_typeoftrans0 ?>()" onBlur="trans1n<? echo $s_typeoftrans0 ?>()"></font></td>
                            <td colspan="1" align="center" style="border-bottom: 1px solid #999999;border-top: 1px solid #999999"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><input type="text" id="trans1rate<? echo $s_typeoftrans0 ?>" name="trans1rate<? echo $s_typeoftrans0 ?>" value='<? echo $trans1sellr * $s_noofu0 ?>' size="2" onKeyUp="trans1<? echo $s_typeoftrans0 ?>()"  onFocus="trans1<? echo $s_typeoftrans0 ?>()" onBlur="trans1<? echo $s_typeoftrans0 ?>()"></font></td>


                          </tr>




</table>

<?}// end of transportation 1?>


<?
if($_SESSION["trans1"]==on){ // start if transportation 2
?>		

 <table width="100%" cellpadding="1" cellspacing="0">
                                   <tr bgcolor="#FFFFFF">
                            <td colspan="8">&nbsp;</td>
                          </tr>

								   <tr bgcolor="#CCCCCC">
                            <td colspan="8"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Transportation Sno : 2</font></td>
                          </tr>
					    <tr bgcolor="#FFFFFF">
                            <td colspan="8"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Transportation Supplier :
<?
for($t1=0; $t1<count($array_trans_id); $t1++){
if($s_s_trans1==$array_trans_id[$t1]){
echo $array_trans[$t1] . " - " . $array_trans_city[$t1];	

}
}

?>
</font></td>      </tr>

<tr bgcolor="#EFEFEF">
                            <td colspan="1" align="center" style="border-right: 1px solid #999999; border-top: 1px solid #999999" ><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Trans Type</b></font></td>
                            <td colspan="1" align="center" style="border-right: 1px solid #999999; border-top: 1px solid #999999"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Trans Route</b></font></td>
                            <td colspan="1" align="center" style="border-right: 1px solid #999999; border-top: 1px solid #999999"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Units</b></font></td>
                            <td colspan="1" align="center" style="border-right: 1px solid #999999; border-top: 1px solid #999999"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Date & Time</b></font></td>
                            <td colspan="1" align="center" style="border-right: 1px solid #999999; border-top: 1px solid #999999"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Flight Details</b></font></td>
                            <td colspan="1" align="center" style="border-right: 1px solid #999999; border-top: 1px solid #999999"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>No of Paxs</b></font></td>
                            <td colspan="1" align="center" style="border-right: 1px solid #999999; border-top: 1px solid #999999"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Net Rate</b></font></td>
                            <td colspan="1" align="center" style="border-top: 1px solid #999999"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Sell Rate</b></font></td>


                          </tr>

<?


$trans1rd = $trans1y ."-". $trans1m ."-". $trans1d ; 

$s_typeoftrans1		  = $_SESSION['typeoftrans1'];     


for($tv1=0; $tv1<count($array_transt_id); $tv1++){
if($s_typeoftrans1==$array_transt_id[$tv1]){
$tvety1=$array_transt[$tv1] ;
$tvetr1=$array_transt_route[$tv1];	
$tvetp1=$array_nofp[$tv1];
}
}

$trans2netr=0;
$trans2sellr=0;

$query_trans2_rates ="select trans_id,from_date,to_date, net_rate,sell_rate  from res_trans_rates where '$trans1rd' between from_date and to_date - interval '1 day' and trans_id = $s_typeoftrans1 ";

$result_trans2_rates = pg_query($query_trans2_rates);

if (!$result_trans2_rates) {
	echo "An error occured.\n";
	exit;
	}
while ($rows_trans2_rates = pg_fetch_array($result_trans2_rates)){

$trans2netr=$rows_trans2_rates["net_rate"];
$trans2sellr=$rows_trans2_rates["sell_rate"];

}
	   


?>

<tr bgcolor="#EFEFEF">
                            <td colspan="1" align="center" style="border-bottom: 1px solid #999999; border-right: 1px solid #999999; border-top: 1px solid #999999" ><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><? $_SESSION['tvety1'] = $tvety1 ; echo $tvety1; ?></font></td>
                            <td colspan="1" align="center" style="border-bottom: 1px solid #999999;border-right: 1px solid #999999; border-top: 1px solid #999999"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><? $_SESSION['tvetr1'] = $tvetr1 ; echo $tvetr1 ;?></font></td>
                            <td colspan="1" align="center" style="border-bottom: 1px solid #999999;border-right: 1px solid #999999; border-top: 1px solid #999999"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><? echo $s_noofu1 ?></font></td>
                            <td colspan="1" align="center" style="border-bottom: 1px solid #999999;border-right: 1px solid #999999; border-top: 1px solid #999999"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><? echo date('d-M-Y', strtotime($trans1rd)) ."<br>". $s_timeselecthours1 .":".$s_timeselectmin1; ?></font></td>
                            <td colspan="1" align="center" style="border-bottom: 1px solid #999999;border-right: 1px solid #999999; border-top: 1px solid #999999"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><? echo $s_flightdet1 ?></font></td>
                            <td colspan="1" align="center" style="border-bottom: 1px solid #999999;border-right: 1px solid #999999; border-top: 1px solid #999999"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><? $_SESSION['tvetp1'] = $tvetp1 ; echo $tvetp1 * $s_noofu1 ;?></font></td>
<script>
function trans2n<? echo $s_typeoftrans1 ;?>(){ 
grand_net(grand_gnt);
}
function trans2<? echo $s_typeoftrans1 ;?>(){ 
grand_sell(grand_gt);
}
</script>

                            <td colspan="1" align="center" style="border-bottom: 1px solid #999999;border-right: 1px solid #999999; border-top: 1px solid #999999"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><input type="text" name="trans2nrate<? echo $s_typeoftrans1 ?>" value='<? echo $trans2netr * $s_noofu1 ?>' size="2" onKeyUp="trans2n<? echo $s_typeoftrans1 ?>()"  onFocus="trans2n<? echo $s_typeoftrans1 ?>()" onBlur="trans2n<? echo $s_typeoftrans1 ?>()"></font></td>
                            <td colspan="1" align="center" style="border-bottom: 1px solid #999999;border-top: 1px solid #999999"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><input type="text" name="trans2rate<? echo $s_typeoftrans1 ?>" value='<? echo $trans2sellr * $s_noofu1?>' size="2" onKeyUp="trans2<? echo $s_typeoftrans1 ?>()"  onFocus="trans2<? echo $s_typeoftrans1 ?>()" onBlur="trans2<? echo $s_typeoftrans1 ?>()"></font></td>


                          </tr>





</table>

<?}// end of transportation 2?>



<?
if($_SESSION["trans2"]==on){ // start if transportation 3
?>		

<table width="100%" cellpadding="1" cellspacing="0">
                                   <tr bgcolor="#FFFFFF">
                            <td colspan="8">&nbsp;</td>
                          </tr>

								   <tr bgcolor="#CCCCCC">
                            <td colspan="8"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Transportation Sno : 3</font></td>
                          </tr>
					    <tr bgcolor="#FFFFFF">
                            <td colspan="8"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Transportation Supplier :
<?
for($t2=0; $t2<count($array_trans_id); $t2++){
if($s_s_trans2==$array_trans_id[$t2]){
echo $array_trans[$t2] . " - " . $array_trans_city[$t2];	

}
}

?>
</font></td>      </tr>

<tr bgcolor="#EFEFEF">
                            <td colspan="1" align="center" style="border-right: 1px solid #999999; border-top: 1px solid #999999" ><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Trans Type</b></font></td>
                            <td colspan="1" align="center" style="border-right: 1px solid #999999; border-top: 1px solid #999999"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Trans Route</b></font></td>
                            <td colspan="1" align="center" style="border-right: 1px solid #999999; border-top: 1px solid #999999"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Units</b></font></td>
                            <td colspan="1" align="center" style="border-right: 1px solid #999999; border-top: 1px solid #999999"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Date & Time</b></font></td>
                            <td colspan="1" align="center" style="border-right: 1px solid #999999; border-top: 1px solid #999999"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Flight Details</b></font></td>
                            <td colspan="1" align="center" style="border-right: 1px solid #999999; border-top: 1px solid #999999"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>No of Paxs</b></font></td>
                            <td colspan="1" align="center" style="border-right: 1px solid #999999; border-top: 1px solid #999999"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Net Rate</b></font></td>
                            <td colspan="1" align="center" style="border-top: 1px solid #999999"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Sell Rate</b></font></td>


                          </tr>

<?


$trans2rd = $trans2y ."-". $trans2m ."-". $trans2d ; 

$s_typeoftrans2	  = $_SESSION['typeoftrans2'];     


for($tv2=0; $tv2<count($array_transt_id); $tv2++){
if($s_typeoftrans2==$array_transt_id[$tv2]){
$tvety2=$array_transt[$tv2] ;
$tvetr2=$array_transt_route[$tv2];	
$tvetp2=$array_nofp[$tv2];
}
}

$trans3netr=0;
$trans3sellr=0;

$query_trans3_rates ="select trans_id,from_date,to_date, net_rate,sell_rate  from res_trans_rates where '$trans2rd' between from_date and to_date - interval '1 day' and trans_id = $s_typeoftrans2 ";

$result_trans3_rates = pg_query($query_trans3_rates);

if (!$result_trans3_rates) {
	echo "An error occured.\n";
	exit;
	}
while ($rows_trans3_rates = pg_fetch_array($result_trans3_rates)){

$trans3netr=$rows_trans3_rates["net_rate"];
$trans3sellr=$rows_trans3_rates["sell_rate"];

}
	   


?>

<tr bgcolor="#EFEFEF">
                            <td colspan="1" align="center" style="border-bottom: 1px solid #999999; border-right: 1px solid #999999; border-top: 1px solid #999999" ><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><? $_SESSION['tvety2'] = $tvety2 ; echo $tvety2 ;?></font></td>
                            <td colspan="1" align="center" style="border-bottom: 1px solid #999999;border-right: 1px solid #999999; border-top: 1px solid #999999"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><? $_SESSION['tvetr2'] = $tvetr2 ;  echo $tvetr2; ?></font></td>
                            <td colspan="1" align="center" style="border-bottom: 1px solid #999999;border-right: 1px solid #999999; border-top: 1px solid #999999"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><? echo $s_noofu2 ?></font></td>
                            <td colspan="1" align="center" style="border-bottom: 1px solid #999999;border-right: 1px solid #999999; border-top: 1px solid #999999"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><? echo date('d-M-Y', strtotime($trans2rd)) ."<br>". $s_timeselecthours2 .":".$s_timeselectmin2; ?></font></td>
                            <td colspan="1" align="center" style="border-bottom: 1px solid #999999;border-right: 1px solid #999999; border-top: 1px solid #999999"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><? echo $s_flightdet2 ?></font></td>
                            <td colspan="1" align="center" style="border-bottom: 1px solid #999999;border-right: 1px solid #999999; border-top: 1px solid #999999"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><? $_SESSION['tvetp2'] = $tvetp2 ;  echo $tvetp2 * $s_noofu2 ; ?></font></td>
<script>
function trans3n<? echo $s_typeoftrans2 ;?>(){ 
grand_net(grand_gnt);
}
function trans3<? echo $s_typeoftrans2 ;?>(){ 
grand_sell(grand_gt);
}
</script>


                            <td colspan="1" align="center" style="border-bottom: 1px solid #999999;border-right: 1px solid #999999; border-top: 1px solid #999999"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><input type="text" name="trans3nrate<? echo $s_typeoftrans2 ?>" value='<? echo $trans3netr * $s_noofu2?>' size="2" onKeyUp="trans3n<? echo $s_typeoftrans2?>()"  onFocus="trans3n<? echo $s_typeoftrans2 ?>()" onBlur="trans3n<? echo $s_typeoftrans2 ?>()"></font></td>
                            <td colspan="1" align="center" style="border-bottom: 1px solid #999999;border-top: 1px solid #999999"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><input type="text" name="trans3rate<? echo $s_typeoftrans2 ?>" value='<? echo $trans3sellr * $s_noofu2?>' size="2" onKeyUp="trans3<? echo $s_typeoftrans2?>()"  onFocus="trans3<? echo $s_typeoftrans2 ?>()" onBlur="trans3<? echo $s_typeoftrans2 ?>()"></font></td>


                          </tr>





</table>

<?}// end of transportation 3?>
							


							<?
if($_SESSION["trans3"]==on){ // start if transportation 4
?>		

<table width="100%" cellpadding="1" cellspacing="0">
                                   <tr bgcolor="#FFFFFF">
                            <td colspan="8">&nbsp;</td>
                          </tr>

								   <tr bgcolor="#CCCCCC">
                            <td colspan="8"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Transportation Sno : 4</font></td>
                          </tr>
					    <tr bgcolor="#FFFFFF">
                            <td colspan="8"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Transportation Supplier :
<?
for($t3=0; $t3<count($array_trans_id); $t3++){
if($s_s_trans3==$array_trans_id[$t3]){
echo $array_trans[$t3] . " - " . $array_trans_city[$t3];	

}
}

?>
</font></td>      </tr>

<tr bgcolor="#EFEFEF">
                            <td colspan="1" align="center" style="border-right: 1px solid #999999; border-top: 1px solid #999999" ><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Trans Type</b></font></td>
                            <td colspan="1" align="center" style="border-right: 1px solid #999999; border-top: 1px solid #999999"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Trans Route</b></font></td>
                            <td colspan="1" align="center" style="border-right: 1px solid #999999; border-top: 1px solid #999999"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Units</b></font></td>
                            <td colspan="1" align="center" style="border-right: 1px solid #999999; border-top: 1px solid #999999"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Date & Time</b></font></td>
                            <td colspan="1" align="center" style="border-right: 1px solid #999999; border-top: 1px solid #999999"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Flight Details</b></font></td>
                            <td colspan="1" align="center" style="border-right: 1px solid #999999; border-top: 1px solid #999999"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>No of Paxs</b></font></td>
                            <td colspan="1" align="center" style="border-right: 1px solid #999999; border-top: 1px solid #999999"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Net Rate</b></font></td>
                            <td colspan="1" align="center" style="border-top: 1px solid #999999"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Sell Rate</b></font></td>


                          </tr>

<?


$trans3rd = $trans3y ."-". $trans3m ."-". $trans3d ; 

$s_typeoftrans3	  = $_SESSION['typeoftrans3'];     


for($tv3=0; $tv3<count($array_transt_id); $tv3++){
if($s_typeoftrans3==$array_transt_id[$tv3]){
$tvety3=$array_transt[$tv3] ;
$tvetr3=$array_transt_route[$tv3];	
$tvetp3=$array_nofp[$tv3];
}
}

$trans4netr=0;
$trans4sellr=0;

$query_trans4_rates ="select trans_id,from_date,to_date, net_rate,sell_rate  from res_trans_rates where '$trans3rd' between from_date and to_date - interval '1 day' and trans_id = $s_typeoftrans3 ";

$result_trans4_rates = pg_query($query_trans4_rates);

if (!$result_trans4_rates) {
	echo "An error occured.\n";
	exit;
	}
while ($rows_trans4_rates = pg_fetch_array($result_trans4_rates)){

$trans4netr=$rows_trans4_rates["net_rate"];
$trans4sellr=$rows_trans4_rates["sell_rate"];

}
	   


?>

<tr bgcolor="#EFEFEF">
                            <td colspan="1" align="center" style="border-bottom: 1px solid #999999; border-right: 1px solid #999999; border-top: 1px solid #999999" ><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><? $_SESSION['tvety3'] = $tvety3 ; echo $tvety3; ?></font></td>
                            <td colspan="1" align="center" style="border-bottom: 1px solid #999999;border-right: 1px solid #999999; border-top: 1px solid #999999"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><? $_SESSION['tvetr3'] = $tvetr3 ;  echo $tvetr3; ?></font></td>
                            <td colspan="1" align="center" style="border-bottom: 1px solid #999999;border-right: 1px solid #999999; border-top: 1px solid #999999"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><? echo $s_noofu3 ?></font></td>
                            <td colspan="1" align="center" style="border-bottom: 1px solid #999999;border-right: 1px solid #999999; border-top: 1px solid #999999"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><? echo date('d-M-Y', strtotime($trans3rd)) ."<br>". $s_timeselecthours3 .":".$s_timeselectmin3; ?></font></td>
                            <td colspan="1" align="center" style="border-bottom: 1px solid #999999;border-right: 1px solid #999999; border-top: 1px solid #999999"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><? echo $s_flightdet3 ?></font></td>
                            <td colspan="1" align="center" style="border-bottom: 1px solid #999999;border-right: 1px solid #999999; border-top: 1px solid #999999"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><? $_SESSION['tvetp3'] = $tvetp3 ;  echo $tvetp3 * $s_noofu3 ;?></font></td>

<script>
function trans4n<? echo $s_typeoftrans3 ;?>(){ 
grand_net(grand_gnt);
}
function trans4<? echo $s_typeoftrans3 ;?>(){ 
grand_sell(grand_gt);
}
</script>

                            <td colspan="1" align="center" style="border-bottom: 1px solid #999999;border-right: 1px solid #999999; border-top: 1px solid #999999"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><input type="text" name="trans4nrate<? echo $s_typeoftrans3 ?>" value='<? echo $trans4netr * $s_noofu3 ?>' size="2" onKeyUp="trans4n<? echo $s_typeoftrans3?>()"  onFocus="trans4n<? echo $s_typeoftrans3 ?>()" onBlur="trans4n<? echo $s_typeoftrans3 ?>()"></font></td>
                            <td colspan="1" align="center" style="border-bottom: 1px solid #999999;border-top: 1px solid #999999"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><input type="text" name="trans4rate<? echo $s_typeoftrans3 ?>" value='<? echo $trans4sellr * $s_noofu3 ?>' size="2" onKeyUp="trans4<? echo $s_typeoftrans3?>()"  onFocus="trans4<? echo $s_typeoftrans3 ?>()" onBlur="trans4<? echo $s_typeoftrans3 ?>()"></font></td>


                          </tr>





</table>

<?}// end of transportation 4?>



<?
if($_SESSION["others0"]==on){ // start if others1
?>		
							
<table width="100%" cellpadding="1" cellspacing="0">
                                   <tr bgcolor="#FFFFFF">
                            <td colspan="8">&nbsp;</td>
                          </tr>

								   <tr bgcolor="#CCCCCC">
                            <td colspan="8"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Other Request Sno : 1</font></td>
                          </tr>

                                   <tr>
                                     <td colspan="1" align="center" bgcolor="#EFEFEF" style="border-right: 1px solid #999999; border-top: 1px solid #999999"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Request Date </b></font></td>
                                     <td colspan="1" align="center" bgcolor="#EFEFEF" style="border-right: 1px solid #999999; border-top: 1px solid #999999"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b> Paticulars</b></font></td>


                                     <td colspan="1" align="center" bgcolor="#EFEFEF" style="border-right: 1px solid #999999; border-top: 1px solid #999999"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Net Rate</b></font></td>
                                     <td colspan="1" align="center" bgcolor="#EFEFEF" style="border-top: 1px solid #999999"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Sell Rate</b></font></td>
                                   </tr>
                                  <tr>
  <td colspan="1" align="center" bgcolor="#EFEFEF" style="border-right: 1px solid #999999; border-top: 1px solid #999999"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><? echo date('d-M-Y', strtotime($others1rd))  ?> </font></td>

  <td colspan="1" align="center" bgcolor="#EFEFEF" style="border-right: 1px solid #999999; border-top: 1px solid #999999"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"> <? echo $other1noofa  ?></font></td>

  <script>
function other1nt(){ 
grand_net(grand_gnt);
}
function other1t(){ 
grand_sell(grand_gt);
}
</script>

  <td colspan="1" align="center" bgcolor="#EFEFEF" style="border-right: 1px solid #999999; border-top: 1px solid #999999"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><input type="text" name="other1net" name="other1net" value='<? echo $other1nrate ?>' size="2" onKeyUp="other1nt()"  onFocus="other1nt()" onBlur="other1nt()"></font></td>
  <td colspan="1" align="center" bgcolor="#EFEFEF" style="border-top: 1px solid #999999"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><input type="text" name="other1sell" name="other1sell" value='<? echo $other1srate ?>' size="2" onKeyUp="other1t()"  onFocus="other1t()" onBlur="other1t()"></font></td>
</tr>
</table>


<?}// end of other 1?>


<?
if($_SESSION["others1"]==on){ // start if others2
?>		
							
<table width="100%" cellpadding="1" cellspacing="0">
                                   <tr bgcolor="#FFFFFF">
                            <td colspan="8">&nbsp;</td>
                          </tr>

								   <tr bgcolor="#CCCCCC">
                            <td colspan="8"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Other Request Sno : 2</font></td>
                          </tr>

                                   <tr>
                                     <td colspan="1" align="center" bgcolor="#EFEFEF" style="border-right: 1px solid #999999; border-top: 1px solid #999999"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Request Date </b></font></td>
                                     <td colspan="1" align="center" bgcolor="#EFEFEF" style="border-right: 1px solid #999999; border-top: 1px solid #999999"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b> Paticulars</b></font></td>
                                     <td colspan="1" align="center" bgcolor="#EFEFEF" style="border-right: 1px solid #999999; border-top: 1px solid #999999"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Net Rate</b></font></td>
                                     <td colspan="1" align="center" bgcolor="#EFEFEF" style="border-top: 1px solid #999999"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Sell Rate</b></font></td>
                                   </tr>
                                  <tr>
  <td colspan="1" align="center" bgcolor="#EFEFEF" style="border-right: 1px solid #999999; border-top: 1px solid #999999"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><? echo date('d-M-Y', strtotime($others2rd))  ?> </font></td>

  <td colspan="1" align="center" bgcolor="#EFEFEF" style="border-right: 1px solid #999999; border-top: 1px solid #999999"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"> <? echo $other2noofa  ?></font></td>

    <script>
function other2nt(){ 
grand_net(grand_gnt);
}
function other2t(){ 
grand_sell(grand_gt);
}
</script>
  <td colspan="1" align="center" bgcolor="#EFEFEF" style="border-right: 1px solid #999999; border-top: 1px solid #999999"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><input type="text" name="other2net" name="other2net" value='<? echo $other2nrate ?>' size="2" onKeyUp="other2nt()"  onFocus="other2nt()" onBlur="other2nt()"></font></td>
  <td colspan="1" align="center" bgcolor="#EFEFEF" style="border-top: 1px solid #999999"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><input type="text" name="other2sell" name="other2sell" value='<? echo $other2srate ?>' size="2" onKeyUp="other2t()"  onFocus="other2t()" onBlur="other2t()"></font></td>
</tr>
</table>


<?}// end of other 2?>

<?
if($_SESSION["others2"]==on){ // start if others3
?>		
							
<table width="100%" cellpadding="1" cellspacing="0">
                                   <tr bgcolor="#FFFFFF">
                            <td colspan="8">&nbsp;</td>
                          </tr>

								   <tr bgcolor="#CCCCCC">
                            <td colspan="8"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Other Request Sno : 3</font></td>
                          </tr>

                                   <tr>
                                     <td colspan="1" align="center" bgcolor="#EFEFEF" style="border-right: 1px solid #999999; border-top: 1px solid #999999"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Request Date </b></font></td>
                                     <td colspan="1" align="center" bgcolor="#EFEFEF" style="border-right: 1px solid #999999; border-top: 1px solid #999999"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b> Paticulars</b></font></td>
                                     <td colspan="1" align="center" bgcolor="#EFEFEF" style="border-right: 1px solid #999999; border-top: 1px solid #999999"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Net Rate</b></font></td>
                                     <td colspan="1" align="center" bgcolor="#EFEFEF" style="border-top: 1px solid #999999"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Sell Rate</b></font></td>
                                   </tr>
                                  <tr>
  <td colspan="1" align="center" bgcolor="#EFEFEF" style="border-right: 1px solid #999999; border-top: 1px solid #999999"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><? echo date('d-M-Y', strtotime($others3rd))  ?> </font></td>

  <td colspan="1" align="center" bgcolor="#EFEFEF" style="border-right: 1px solid #999999; border-top: 1px solid #999999"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"> <? echo $other3noofa  ?></font></td>
  <script>
function other3nt(){ 
grand_net(grand_gnt);
}
function other3t(){ 
grand_sell(grand_gt);
}
</script>

  <td colspan="1" align="center" bgcolor="#EFEFEF" style="border-right: 1px solid #999999; border-top: 1px solid #999999"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><input type="text" name="other3net" name="other3net" value='<? echo $other3nrate ?>' size="2" onKeyUp="other3nt()"  onFocus="other3nt()" onBlur="other3nt()"></font></td>
  <td colspan="1" align="center" bgcolor="#EFEFEF" style="border-top: 1px solid #999999"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><input type="text" name="other3sell" name="other3sell" value='<? echo $other3srate ?>' size="2" onKeyUp="other3t()"  onFocus="other3t()" onBlur="other3t()"></font></td>
</tr>
</table>


<?}// end of other 3?>

							
							</td>
                          </tr>

<tr><td>&nbsp;</td></tr>

                                   <tr bgcolor="#CCCCCC">
                            <td colspan="2"><b>Grand Totals</b></td>
                          </tr>

<script>

function grand_net(val){
var g_net=0 ;

'<? if($_SESSION["hotcb0"]==on){?>'
g_net = parseFloat(g_net) + parseFloat(document.getElementById("mad_gnt").firstChild.nodeValue);
'<?}?>'
'<? if($_SESSION["hotcb1"]==on){?>'
g_net = parseFloat(g_net) + parseFloat(document.getElementById("gnt").firstChild.nodeValue);
'<?}?>'

'<? if($_SESSION["hotcb2"]==on){?>'
g_net = parseFloat(g_net) + parseFloat(document.getElementById("oth_gnt").firstChild.nodeValue);
'<?}?>'

'<? if($_SESSION["trans0"]==on){?>'
g_net = parseFloat(g_net) + parseFloat(document.getElementById("trans1nrate<? echo $s_typeoftrans0 ?>").value);
'<?}?>'

'<? if($_SESSION["trans1"]==on){?>'
g_net = parseFloat(g_net) + parseFloat(document.getElementById("trans2nrate<? echo $s_typeoftrans1 ?>").value);
'<?}?>'

'<? if($_SESSION["trans2"]==on){?>'
g_net = parseFloat(g_net) + parseFloat(document.getElementById("trans3nrate<? echo $s_typeoftrans2 ?>").value);
'<?}?>'

'<? if($_SESSION["trans3"]==on){?>'
g_net = parseFloat(g_net) + parseFloat(document.getElementById("trans4nrate<? echo $s_typeoftrans3 ?>").value);
'<?}?>'

'<? if($_SESSION["others0"]==on){?>'
g_net = parseFloat(g_net) + parseFloat(document.getElementById("other1net").value);
'<?}?>'

'<? if($_SESSION["others1"]==on){?>'
g_net = parseFloat(g_net) + parseFloat(document.getElementById("other2net").value);
'<?}?>'

'<? if($_SESSION["others2"]==on){?>'
g_net = parseFloat(g_net) + parseFloat(document.getElementById("other3net").value);
'<?}?>'



val.innerHTML = g_net;
}


function grand_sell(val){
var g_sell=0 ;

'<? if($_SESSION["hotcb0"]==on){?>'
g_sell = parseFloat(g_sell) + parseFloat(document.getElementById("mad_gt").firstChild.nodeValue);
'<?}?>'
'<? if($_SESSION["hotcb1"]==on){?>'
g_sell = parseFloat(g_sell) + parseFloat(document.getElementById("gt").firstChild.nodeValue);
'<?}?>'
'<? if($_SESSION["hotcb2"]==on){?>'
g_sell = parseFloat(g_sell) + parseFloat(document.getElementById("oth_gt").firstChild.nodeValue);
'<?}?>'

'<? if($_SESSION["trans0"]==on){?>'
g_sell = parseFloat(g_sell) + parseFloat(document.getElementById("trans1rate<? echo $s_typeoftrans0 ?>").value);
'<?}?>'

'<? if($_SESSION["trans1"]==on){?>'
g_sell = parseFloat(g_sell) + parseFloat(document.getElementById("trans2rate<? echo $s_typeoftrans1 ?>").value);
'<?}?>'

'<? if($_SESSION["trans2"]==on){?>'
g_sell = parseFloat(g_sell) + parseFloat(document.getElementById("trans3rate<? echo $s_typeoftrans2 ?>").value);
'<?}?>'

'<? if($_SESSION["trans3"]==on){?>'
g_sell = parseFloat(g_sell) + parseFloat(document.getElementById("trans4rate<? echo $s_typeoftrans3 ?>").value);
'<?}?>'


'<? if($_SESSION["others0"]==on){?>'
g_sell = parseFloat(g_sell) + parseFloat(document.getElementById("other1sell").value);
'<?}?>'

'<? if($_SESSION["others1"]==on){?>'
g_sell = parseFloat(g_sell) + parseFloat(document.getElementById("other2sell").value);
'<?}?>'

'<? if($_SESSION["others2"]==on){?>'
g_sell = parseFloat(g_sell) + parseFloat(document.getElementById("other3sell").value);
'<?}?>'


val.innerHTML = g_sell;
}

</script>

<tr><td><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><FONT 
style="BACKGROUND-COLOR: #DFDFDF">Grand Net Total :</FONT> SAR <span id="grand_gnt">0</span>/-</font></td></tr>


<tr><td align="right"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><FONT 
style="BACKGROUND-COLOR: #DFDFDF">Grand Selling Total:</FONT> SAR <span id="grand_gt">0</span>/-</font></td></tr>


<script>
grand_net(grand_gnt);
grand_sell(grand_gt);
</script>

                                   <tr>
                            <td colspan="2">&nbsp;</td>
                          </tr>

<tr><td colspan="2" align="center"><input type="submit" value="Get Selected Rooms Price"></td></tr>
                          


						  <tr>
                            <td colspan="2"></td>
                          </tr>
                          
                         
                                 
                               
                             
                          <tr>
                            <td colspan="2"  align="right">&nbsp;</td>
                          </tr>
                        </form>
                      </table></td>
                    </tr></table>									
					
			</td> 
              </tr></table> </td>
        </tr>
      </table></td></tr>
	  
	  
      </table> 
</table>	
	
	

	</tr></table>


<script>
function fun2(theForm){

var rid = <? echo count($mad_array_room_id) ; ?>

 for (i=0;i<rid;i++ )
 {



if(isNaN(document.getElementById ('mad_hotntot'+i).value)){
alert("Please check the Madinah Hotel Net Rate Once Again");
return false;
}

 if(isNaN(document.getElementById ('mad_hottot'+i).value)){
alert("Please check the Madinah Hotel Selling Rate Once Again");
return false;
}

if(isNaN(document.getElementById ('hotntot'+i).value)){
alert("Please check the Makkah Hotel Net Rate Once Again");
return false;
}

 if(isNaN(document.getElementById ('hottot'+i).value)){
alert("Please check the Makkah Hotel Selling Rate Once Again");
return false;
}


if(isNaN(document.getElementById ('oth_hotntot'+i).value)){
alert("Please check the Other Hotel Net Rate Once Again");
return false;
}

 if(isNaN(document.getElementById ('oth_hottot'+i).value)){
alert("Please check the Other Hotel Selling Rate Once Again");
return false;
}


 }
 
   


}

</script>



</body>				
</html>
