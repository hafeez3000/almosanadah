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

$s_npaxs = 0;




?>
                        <form name="gquot" action="resroomsel.php"  method="post">
                        

                          <tr>
                            <td colspan="2">

							<?
 
 
 $_POST["hotcb0"];
 $_POST["hotcb1"];
 $_POST["hotcb2"];
 $_POST["trans0"];
 $_POST["trans1"];
 $_POST["trans2"];
 $_POST["trans3"];

 $_POST["others0"];
 $_POST["others1"];
 $_POST["others2"];



$_SESSION["hotcb0"] =  $_POST["hotcb0"];
$_SESSION["hotcb1"] =  $_POST["hotcb1"];
$_SESSION["hotcb2"] =  $_POST["hotcb2"];
$_SESSION["trans0"] =  $_POST["trans0"];
$_SESSION["trans1"] =  $_POST["trans1"];
$_SESSION["trans2"] =  $_POST["trans2"];
$_SESSION["trans3"] =  $_POST["trans3"];
$_SESSION["others0"] = $_POST["others0"];
$_SESSION["others1"] = $_POST["others1"];
$_SESSION["others2"] = $_POST["others2"];






 
if($_POST["hotcb0"]==on){ // start if for mad hotel

$s_hotelsmad = $_POST["hotelsmad"];

$madcind = $_POST['dDay'];
$madcinm = $_POST['dMonth'];
$madciny = $_POST['dYear'];

$madcin = $madciny ."-". $madcinm ."-". $madcind ; 

$madcoutd = $_POST['d1Day'];
$madcoutm = $_POST['d1Month'];
$madcouty = $_POST['d1Year'];

$madcout = $madcouty ."-". $madcoutm ."-". $madcoutd ; 


$_SESSION['dDay']  = $_POST['dDay'];
$_SESSION['dMonth'] = $_POST['dMonth'];
$_SESSION['dYear'] = $_POST['dYear'];
$_SESSION['d1Day']  = $_POST['d1Day'];
$_SESSION['d1Month'] = $_POST['d1Month'];
$_SESSION['d1Year'] = $_POST['d1Year'];

$_SESSION["hotelsmad"] = $_POST["hotelsmad"];

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


if($_POST["hotcb1"]==on){ // start if for mak hotel

$s_hotelsmak = $_POST["hotelsmak"];

$makcind = $_POST['d2Day'];
$makcinm = $_POST['d2Month'];
$makciny = $_POST['d2Year'];

$makcin = $makciny ."-". $makcinm ."-". $makcind ; 

$makcoutd = $_POST['d3Day'];
$makcoutm = $_POST['d3Month'];
$makcouty = $_POST['d3Year'];

$makcout = $makcouty ."-". $makcoutm ."-". $makcoutd ; 

$_SESSION['d2Day']  = $_POST['d2Day'];
$_SESSION['d2Month'] = $_POST['d2Month'];
$_SESSION['d2Year'] = $_POST['d2Year'];
$_SESSION['d3Day']  = $_POST['d3Day'];
$_SESSION['d3Month'] = $_POST['d3Month'];
$_SESSION['d3Year'] = $_POST['d3Year'];

$_SESSION["hotelsmak"] = $_POST["hotelsmak"];


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
						

if($_POST["hotcb2"]==on){ // start if for oth hotel

$s_hotelsoth = $_POST["hotelsoth"];

$othcind = $_POST['d4Day'];
$othcinm = $_POST['d4Month'];
$othciny = $_POST['d4Year'];

$othcin = $othciny ."-". $othcinm ."-". $othcind ; 

$othcoutd = $_POST['d5Day'];
$othcoutm = $_POST['d5Month'];
$othcouty = $_POST['d5Year'];

$othcout = $othcouty ."-". $othcoutm ."-". $othcoutd ; 

$_SESSION['d4Day']  = $_POST['d4Day'];
$_SESSION['d4Month'] = $_POST['d4Month'];
$_SESSION['d4Year'] = $_POST['d4Year'];
$_SESSION['d5Day']  = $_POST['d5Day'];
$_SESSION['d5Month'] = $_POST['d5Month'];
$_SESSION['d5Year'] = $_POST['d5Year'];

$_SESSION["hotelsoth"] = $_POST["hotelsoth"];


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


if($_POST["trans0"]==on){ // start if for  trans0



$_SESSION['d6Day']   = $_POST['d6Day'];
$_SESSION['d6Month'] = $_POST['d6Month'];
$_SESSION['d6Year']  = $_POST['d6Year'];

$trans0d = $_POST['d6Day'];
$trans0m = $_POST['d6Month'];
$trans0y = $_POST['d6Year'];

$trans0rd = $trans0y ."-". $trans0m ."-". $trans0d ; 

$s_timeselecthours0   = $_POST['timeselecthours0']; 
$s_timeselectmin0	  = $_POST['timeselectmin0'];   
$s_s_trans0			  = $_POST['s_trans0'];       
$s_typeoftrans0		  = $_POST['typeoftrans0'];     
$s_noofu0			  = $_POST['noofu0'];           
$s_flightdet0		  = $_POST['flightdet0'];       

$_SESSION['timeselecthours0']= $_POST['timeselecthours0'];  
$_SESSION['timeselectmin0']= $_POST['timeselectmin0'];    
$_SESSION['s_trans0']= $_POST['s_trans0'];          
$_SESSION['typeoftrans0']= $_POST['typeoftrans0'];      
$_SESSION['noofu0']= $_POST['noofu0'];            
$_SESSION['flightdet0']= $_POST['flightdet0'];        



} // end if for trans0


if($_POST["trans1"]==on){ // start if for  trans1


$_SESSION['d7Day']   = $_POST['d7Day'];
$_SESSION['d7Month'] = $_POST['d7Month'];
$_SESSION['d7Year']  = $_POST['d7Year'];

$trans1d = $_POST['d7Day'];
$trans1m = $_POST['d7Month'];
$trans1y = $_POST['d7Year'];



 $trans1rd = $trans1y ."-". $trans1m ."-". $trans1d ; 

 $s_timeselecthours1   = $_POST['timeselecthours1']; 
 $s_timeselectmin1	  = $_POST['timeselectmin1'];   
 $s_s_trans1			  = $_POST['s_trans1'];         
 $s_typeoftrans1		  = $_POST['typeoftrans1'];     
 $s_noofu1			  = $_POST['noofu1'];           
 $s_flightdet1		  = $_POST['flightdet1'];       


$_SESSION['timeselecthours1']= $_POST['timeselecthours1'];  
$_SESSION['timeselectmin1']= $_POST['timeselectmin1'];    
$_SESSION['s_trans1']= $_POST['s_trans1'];          
$_SESSION['typeoftrans1']= $_POST['typeoftrans1'];      
$_SESSION['noofu1']= $_POST['noofu1'];            
$_SESSION['flightdet1']= $_POST['flightdet1'];   



} // end if for trans1

if($_POST["trans2"]==on){ // start if for  trans2


$_SESSION['d8Day']   = $_POST['d8Day'];
$_SESSION['d8Month'] = $_POST['d8Month'];
$_SESSION['d8Year']  = $_POST['d8Year'];

$trans2d = $_POST['d8Day'];
$trans2m = $_POST['d8Month'];
$trans2y = $_POST['d8Year'];

 $trans2rd = $trans2y ."-". $trans2m ."-". $trans2d ; 

 $s_timeselecthours2   = $_POST['timeselecthours2']; 
 $s_timeselectmin2	  = $_POST['timeselectmin2'];   
 $s_s_trans2			  = $_POST['s_trans2'];         
 $s_typeoftrans2		  = $_POST['typeoftrans2'];     
 $s_noofu2			  = $_POST['noofu2'];           
 $s_flightdet2		  = $_POST['flightdet2'];       

 $_SESSION['timeselecthours2']= $_POST['timeselecthours2'];  
$_SESSION['timeselectmin2']= $_POST['timeselectmin2'];    
$_SESSION['s_trans2']= $_POST['s_trans2'];          
$_SESSION['typeoftrans2']= $_POST['typeoftrans2'];      
$_SESSION['noofu2']= $_POST['noofu2'];            
$_SESSION['flightdet2']= $_POST['flightdet2'];  

} // end if for trans2	


if($_POST["trans3"]==on){ // start if for  trans3

$_SESSION['d9Day']   = $_POST['d9Day'];
$_SESSION['d9Month'] = $_POST['d9Month'];
$_SESSION['d9Year']  = $_POST['d9Year'];

$trans3d = $_POST['d9Day'];
$trans3m = $_POST['d9Month'];
$trans3y = $_POST['d9Year'];

 $trans3rd = $trans3y ."-". $trans3m ."-". $trans3d ; 

 $s_timeselecthours3   = $_POST['timeselecthours3']; 
 $s_timeselectmin3	  = $_POST['timeselectmin3'];   
 $s_s_trans3			  = $_POST['s_trans3'];         
 $s_typeoftrans3		  = $_POST['typeoftrans3'];     
 $s_noofu3			  = $_POST['noofu3'];           
 $s_flightdet3		  = $_POST['flightdet3'];     
 

 $_SESSION['timeselecthours3']= $_POST['timeselecthours3'];  
$_SESSION['timeselectmin3']= $_POST['timeselectmin3'];    
$_SESSION['s_trans3']= $_POST['s_trans3'];          
$_SESSION['typeoftrans3']= $_POST['typeoftrans3'];      
$_SESSION['noofu3']= $_POST['noofu3'];            
$_SESSION['flightdet3']= $_POST['flightdet3'];  


} // end if for trans3	

if($_POST["others0"]==on){ // start if for  oth0

$_SESSION['d10Day']   = $_POST['d10Day'];
$_SESSION['d10Month'] = $_POST['d10Month'];
$_SESSION['d10Year']  = $_POST['d10Year'];


$_SESSION['other1noofa']=$_POST['other1noofa'];
$_SESSION['other1nrate']=$_POST['other1nrate'];
$_SESSION['other1srate']=$_POST['other1srate'];

$other1noofa=$_POST['other1noofa'];
$other1nrate=$_POST['other1nrate'];
$other1srate=$_POST['other1srate'];


$others1d = $_POST['d10Day'];
$others1m = $_POST['d10Month'];
$others1y = $_POST['d10Year'];

$others1rd = $others1y ."-". $others1m ."-". $others1d ; 



} // end if for other

if($_POST["others1"]==on){ // start if for  oth1
$_SESSION['d11Day']   = $_POST['d11Day'];
$_SESSION['d11Month'] = $_POST['d11Month'];
$_SESSION['d11Year']  = $_POST['d11Year'];


$_SESSION['other2noofa']=$_POST['other2noofa'];
$_SESSION['other2nrate']=$_POST['other2nrate'];
$_SESSION['other2srate']=$_POST['other2srate'];

$other2noofa=$_POST['other2noofa'];
$other2nrate=$_POST['other2nrate'];
$other2srate=$_POST['other2srate'];


$others2d = $_POST['d11Day'];
$others2m = $_POST['d11Month'];
$others2y = $_POST['d11Year'];

$others2rd = $others2y ."-". $others2m ."-". $others2d ; 
} // end if for other

if($_POST["others2"]==on){ // start if for  oth2
$_SESSION['d12Day']   = $_POST['d12Day'];
$_SESSION['d12Month'] = $_POST['d12Month'];
$_SESSION['d12Year']  = $_POST['d12Year'];


$_SESSION['other3noofa']=$_POST['other3noofa'];
$_SESSION['other3nrate']=$_POST['other3nrate'];
$_SESSION['other3srate']=$_POST['other3srate'];

$other3noofa=$_POST['other3noofa'];
$other3nrate=$_POST['other3nrate'];
$other3srate=$_POST['other3srate'];


$others3d = $_POST['d12Day'];
$others3m = $_POST['d12Month'];
$others3y = $_POST['d12Year'];

$others3rd = $others3y ."-". $others3m ."-". $others3d ; 
} // end if for other

							?>

<?
 if($_POST["hotcb0"]==on){ // start if for mad hotel
?>							

 <table width="100%" cellpadding="1" cellspacing="0">
                                   <tr bgcolor="#CCCCCC">
                            <td colspan="2">Hotel in Madinah</td>
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

 <tr bgcolor="#EFEFEF"> 
                              <td colspan="4">
							  <?
$array_room_id = array();
$array_room_type = array();
$array_no_of_paxs = array();
$array_room_description = array();
$query_room ="select room_id, room_type, no_of_paxs from rooms where room_id like '$s_hotelsmad%'";

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





if(count($array_room_id)>0){
echo "<table width=\"100%\" cellpadding=\"1\" cellspacing=\"0\"><thead><tr><td style=\"border-top: 1px solid #999999; border-right: 1px solid #999999; border-bottom: 1px solid #999999\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><strong>Room Type</strong></font></td><td align=\"center\" style=\"border-top: 1px solid #999999; border-right: 1px solid #999999; border-bottom: 1px solid #999999\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><strong>Net</strong></font></td><td align=\"center\" style=\"border-top: 1px solid #999999; border-right: 1px solid #999999; border-bottom: 1px solid #999999\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><strong>Sell</strong></font></td><td align=\"center\" style=\"border-top: 1px solid #999999; border-right: 1px solid #999999; border-bottom: 1px solid #999999\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><strong>Select</strong></font></td><td align=\"center\" style=\"border-top: 1px solid #999999; border-right: 1px solid #999999; border-bottom: 1px solid #999999\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><strong>Rooms</strong></font></td><td align=\"center\" style=\"border-top: 1px solid #999999; border-right: 1px solid #999999;  border-bottom: 1px solid #999999\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><strong>Meals</strong></font></td><td align=\"center\" style=\"border-top: 1px solid #999999; border-right: 1px solid #999999;  border-bottom: 1px solid #999999\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><strong>Paxs</strong></font></td><td align=\"center\" style=\"border-top: 1px solid #999999;  border-bottom: 1px solid #999999\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><strong>Avail</strong></font></td></tr>";
}

for($roid=0; $roid<count($array_room_id); $roid++){

$mad_rd1 = date('Y-m-d', mktime(0,0,0,$madcinm,$madcind,$madciny));

$query_g_rates ="select room_id,from_date,to_date, weekday_net,weekday_sell,weekend_net,weekend_sell,breakfast,halfboard,fullboard,sahoor,iftar,weekends,wpackage  from res_rates where '$mad_rd1' between from_date and to_date - interval '1 day' and room_id = $array_room_id[$roid] ";


$result_rates = pg_query($query_g_rates);

if (!$result_rates) {
	echo "An error occured.\n";
	exit;
	}
while ($rows_rates = pg_fetch_array($result_rates)){
//echo " ";

 
$a_weekends = explode(",", $rows_rates["weekends"]);



$s_wep = $rows_rates["wpackage"];

}

if(trim($s_wep)=="t"){ 
	





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


 $s_roid = $array_room_id[$roid];

echo "<tr>";
echo "<td  style=\"border-right: 1px solid #999999; border-bottom: 1px solid #999999\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><a href=\"#\">" . $array_room_type[$roid] . "</a>";

if($madnights==$madnights1){}
else { echo "(WP)"; };

echo "</font></td>";


for($madnit=0; $madnit<$madnights1 ;  $madnit++){
$mad_rd = date('Y-m-d', mktime(0,0,0,date('m', strtotime($madcin1)),date('d', strtotime($madcin1))+$madnit,date('Y', strtotime($madcin1)) ));



$query_g_rates ="select room_id,from_date,to_date, weekday_net,weekday_sell,weekend_net,weekend_sell,weekends,wpackage  from res_rates where '$mad_rd' between from_date and to_date - interval '1 day' and room_id = $s_roid ";


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
 $rid = $rows_rates["weekend_sell"];
}
else {
 $rid = $rows_rates["weekday_sell"];
}

$mad_status=1;
}
}




$mad_avail_bull=array();
$mad_avail_rooms = array();

for($madnit=0; $madnit<$madnights1 ;  $madnit++){
$mad_rd1 = date('Y-m-d', mktime(0,0,0,date('m', strtotime($madcin1)),date('d', strtotime($madcin1))+$madnit,date('Y', strtotime($madcin1)) ));

$mad_query_main ="select avialibility,avial_bool from rates$s_hotelsmad where room_id='$s_roid' and rate_date='$mad_rd1'  ";
$mad_result_main = pg_query($mad_query_main);
if (!$mad_result_main) {
	echo "An error occured.\n";
	exit;
	}

while ($mad_rows_main = pg_fetch_array($mad_result_main)){

if(trim($mad_rows_main["avialibility"])<="0"){
$mad_avail_rooms[] = 0;
$mad_avail_bull[]="f";
break;
}
else{
$mad_avail_rooms[] = $mad_rows_main["avialibility"];
}

//echo $rows_main["avial_bool"];
if($mad_rows_main["avial_bool"]=="f"){
$mad_avail_bull[]="f";
$mad_avail_rooms[] = 0;
break;
}
else{
$mad_avail_bull[] = $mad_rows_main["avial_bool"];
}

}

}

$mad_avail_bullt = "f";

for($bc=0; $bc<$madnights1 ;  $bc++){
if($mad_avail_bull[$bc]=="f"){
$mad_avail_bullt = "f";
break;
}
else{
$mad_avail_bullt = "t";
}
}






if($mad_status==1 && $mad_avail_bullt=="t" && min($mad_avail_rooms)>0){

//echo "<td>A</td>";
echo "<td align=\"center\" style=\" border-right: 1px solid #999999; border-bottom: 1px solid #999999\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><strong>&nbsp;</strong></font></td><td align=\"center\" style=\" border-right: 1px solid #999999; border-bottom: 1px solid #999999\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><strong>&nbsp;</strong></font></td><td align=\"center\" style=\"border-right: 1px solid #999999; border-bottom: 1px solid #999999\"><input type=\"checkbox\" name=\"madselrcb[]\" value=\"$s_roid\"></td><td align=\"center\" style=\"border-right: 1px solid #999999; border-bottom: 1px solid #999999\">";


echo "<select id=\"madrooms$s_roid\" name=\"madrooms$s_roid\" onChange=\"pc$s_roid()\" >";
for($rm=1;$rm<=min($mad_avail_rooms);$rm++){
echo "<option value=\"$rm\">$rm</option>";
}
echo "</select></td><td align=\"center\" style=\"border-right: 1px solid #999999; border-bottom: 1px solid #999999\"><select name=\"madmeals".$s_roid."[]"."\" MULTIPLE SIZE=\"1\"><option value=\"meals\">Meals</option><option value=\"breakfast\">B/B</option><option value=\"halfboard\">H/B</option><option value=\"fullboard\">F/B</option><option value=\"sahoor\">Sahoor</option><option value=\"iftar\">Iftar</option></select></td>";

echo "<td align=\"center\" style=\"border-right: 1px solid #999999; border-bottom: 1px solid #999999\"> <input type=\"hidden\" id=\"madno_paxs$s_roid\" name=\"madno_paxs$s_roid\" value=\"$array_no_of_paxs[$roid]\"><select id=\"madpaxs$s_roid\" name=\"madpaxs$s_roid\" ><option value=\"$array_no_of_paxs[$roid]\" selected>$array_no_of_paxs[$roid]</option>";
for($px=1;$px<=$array_no_of_paxs[$roid]*$rm;$px++){
echo "<option value=\"$px\">$px</option>";
}
echo "</select></td>";
echo "<td align=\"center\" style=\"border-bottom: 1px solid #999999\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";

echo "<a href=\"changeavail.php?roomid=$s_roid&cin=$madcin1&cout=$madcout1\" target=\"hotavail\" onClick=\"window.open('', 'hotavail','width=700,height=380,menubar=yes,scrollbars=yes, top='+wint+',left='+winl+' ').focus()\">Avial</a>";

echo "</font></td>";

?>
<script>
	function pc<? echo $s_roid; ?>(){ document.getElementById ('madpaxs<? echo $s_roid; ?>').value = document.getElementById ('madno_paxs<? echo $s_roid; ?>').value * document.getElementById ('madrooms<? echo $s_roid; ?>').value;
	
	}
</script>
<?


}
else {

//echo "<td align=\"center\" style=\"border-right: 1px solid #999999; border-bottom: 1px solid #999999\" colspan=\"4\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">Not Available </font></td><td align=\"center\" style=\"border-bottom: 1px solid #999999\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><a href=\"#\">Avail</a></font></td>";



echo "<td align=\"center\" style=\"border-bottom: 1px solid #999999; border-right: 1px solid #999999;\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><input type=\"text\" name=\"madputnrate$s_roid\" size=\"2\"></font></td><td align=\"center\" style=\"border-bottom: 1px solid #999999; border-right: 1px solid #999999;\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><input type=\"text\" name=\"madputrate$s_roid\" size=\"2\"></font></td><td align=\"center\" style=\"border-right: 1px solid #999999; border-bottom: 1px solid #999999\"><input type=\"checkbox\" name=\"madselrcb[]\" value=\"$s_roid\"></td><td align=\"center\" style=\"border-right: 1px solid #999999; border-bottom: 1px solid #999999\">";


echo "<select id=\"madrooms$s_roid\" name=\"madrooms$s_roid\" onChange=\"pc$s_roid()\" >";
for($rm=1;$rm<=$online_res_fix_no_rooms;$rm++){
echo "<option value=\"$rm\">$rm</option>";
}
echo "</select></td><td align=\"center\" style=\"border-right: 1px solid #999999; border-bottom: 1px solid #999999\"><select name=\"madmeals".$s_roid."[]"."\" MULTIPLE SIZE=\"1\"><option value=\"meals\">Meals</option><option value=\"breakfast\">B/B</option><option value=\"halfboard\">H/B</option><option value=\"fullboard\">F/B</option><option value=\"sahoor\">Sahoor</option><option value=\"iftar\">Iftar</option></select></td>";

echo "<td align=\"center\" style=\"border-right: 1px solid #999999; border-bottom: 1px solid #999999\"> <input type=\"hidden\" id=\"madno_paxs$s_roid\" name=\"madno_paxs$s_roid\" value=\"$array_no_of_paxs[$roid]\"><select id=\"madpaxs$s_roid\" name=\"madpaxs$s_roid\" ><option value=\"$array_no_of_paxs[$roid]\" selected>$array_no_of_paxs[$roid]</option>";
for($px=1;$px<=$array_no_of_paxs[$roid]*$rm;$px++){
echo "<option value=\"$px\">$px</option>";
}
echo "</select></td>";
echo "<td align=\"center\" style=\"border-bottom: 1px solid #999999\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";

echo "<a href=\"changeavail.php?roomid=$s_roid&cin=$madcin1&cout=$madcout1\" target=\"hotavail\" onClick=\"window.open('', 'hotavail','width=700,height=380,menubar=yes,scrollbars=yes, top='+wint+',left='+winl+' ').focus()\">Avial</a>";

echo "</font></td>";
?>
<script>
	function pc<? echo $s_roid; ?>(){ document.getElementById ('madpaxs<? echo $s_roid; ?>').value = document.getElementById ('madno_paxs<? echo $s_roid; ?>').value * document.getElementById ('madrooms<? echo $s_roid; ?>').value;
	
	}
</script>
<?



}
//echo "<br>";

}














?>



							  
							  </td>
                            </tr>		

		
		</table>


							
			<?}// end of madinah hotel?>					
							
<br>
<?
 if($_POST["hotcb1"]==on){ // start if for mak hotel
?>							

 <table width="100%" cellpadding="1" cellspacing="0">
                                   <tr bgcolor="#CCCCCC">
                            <td colspan="2">Hotel in Makkah</td>
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

 <tr bgcolor="#EFEFEF"> 
                              <td colspan="4">
							  <?
$array_room_id = array();
$array_room_type = array();
$array_no_of_paxs = array();
$array_room_description = array();
$query_room ="select room_id, room_type, no_of_paxs from rooms where room_id like '$s_hotelsmak%'";

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





if(count($array_room_id)>0){
echo "<table width=\"100%\" cellpadding=\"1\" cellspacing=\"0\"><thead><tr><td style=\"border-top: 1px solid #999999; border-right: 1px solid #999999; border-bottom: 1px solid #999999\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><strong>Room Type</strong></font></td><td align=\"center\" style=\"border-top: 1px solid #999999; border-right: 1px solid #999999; border-bottom: 1px solid #999999\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><strong>Net</strong></font></td><td align=\"center\" style=\"border-top: 1px solid #999999; border-right: 1px solid #999999; border-bottom: 1px solid #999999\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><strong>Sell</strong></font></td><td align=\"center\" style=\"border-top: 1px solid #999999; border-right: 1px solid #999999; border-bottom: 1px solid #999999\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><strong>Select</strong></font></td><td align=\"center\" style=\"border-top: 1px solid #999999; border-right: 1px solid #999999; border-bottom: 1px solid #999999\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><strong>Rooms</strong></font></td><td align=\"center\" style=\"border-top: 1px solid #999999; border-right: 1px solid #999999;  border-bottom: 1px solid #999999\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><strong>Meals</strong></font></td><td align=\"center\" style=\"border-top: 1px solid #999999; border-right: 1px solid #999999;  border-bottom: 1px solid #999999\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><strong>Paxs</strong></font></td><td align=\"center\" style=\"border-top: 1px solid #999999;  border-bottom: 1px solid #999999\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><strong>Avail</strong></font></td></tr>";
}

for($roid=0; $roid<count($array_room_id); $roid++){


$mak_rd1 = date('Y-m-d', mktime(0,0,0,$makcinm,$makcind,$makciny));

$mak_query_g_rates ="select room_id,from_date,to_date, weekday_net,weekday_sell,weekend_net,weekend_sell,breakfast,halfboard,fullboard,sahoor,iftar,weekends,wpackage  from res_rates where '$mak_rd1' between from_date and to_date - interval '1 day' and room_id = $array_room_id[$roid] ";


$mak_result_rates = pg_query($mak_query_g_rates);

if (!$mak_result_rates) {
	echo "An error occured.\n";
	exit;
	}
while ($mak_rows_rates = pg_fetch_array($mak_result_rates)){
//echo " ";

 
$mak_a_weekends = explode(",", $mak_rows_rates["weekends"]);



$mak_s_wep = $mak_rows_rates["wpackage"];

}

if(trim($mak_s_wep)=="t"){ 
	





if(count($mak_a_weekends)==2){     // two days weekend


$mak_weekes =  $mak_a_weekends[0];

$mak_weekee =  $mak_a_weekends[1];


if(date('D', strtotime($makcin1))== $mak_weekee){

$makcin1 = date('Y-m-d', mktime(0,0,0,$makcinm1,$makcind1-1,$makciny1));

}




if(date('D', strtotime($makcout1))== $mak_weekee){

$makcout1 = date('Y-m-d', mktime(0,0,0,$makcoutm1,$makcoutd1+1,$makcouty1));

}



}  // end of two days weekend


if(count($mak_a_weekends)==3){     // three days weekend

$mak_weeke0 =  $mak_a_weekends[0];
$mak_weeke1 =  $mak_a_weekends[1];
$mak_weeke2 =  $mak_a_weekends[2];


if(date('D', strtotime($makcin1))== $mak_weeke1){
$makcin1 = date('Y-m-d', mktime(0,0,0,$makcinm1,$makcind1-1,$makciny1));
}
if(date('D', strtotime($makcin1))== $mak_weeke2){
$makcin1 = date('Y-m-d', mktime(0,0,0,$makcinm1,$makcind1-2,$makciny1));
}

if(date('D', strtotime($makcout1))== $mak_weeke1){
$makcout1 = date('Y-m-d', mktime(0,0,0,$makcoutm1,$makcoutd1+2,$makcouty1));
}
if(date('D', strtotime($makcout1))== $mak_weeke2){
$makcout1 = date('Y-m-d', mktime(0,0,0,$makcoutm1,$makcoutd1+1,$makcouty1));
}


}  // end of three days weekend



$makcin1 = date('Y-m-d', strtotime($makcin1));
$makcout1 = date('Y-m-d', strtotime($makcout1));

$maknights1 = Round(((strtotime($makcout1)-strtotime($makcin1))/86400), 0) ;




}



  $s_roid = $array_room_id[$roid];

echo "<tr>";
echo "<td  style=\"border-right: 1px solid #999999; border-bottom: 1px solid #999999\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><a href=\"#\">" . $array_room_type[$roid] . "</a>";

if($maknights==$maknights1){}
else { echo "(WP)"; };

echo "</font></td>";

 


for($maknit=0; $maknit<$maknights1 ;  $maknit++){


$mak_rd = date('Y-m-d', mktime(0,0,0,date('m', strtotime($makcin1)),date('d', strtotime($makcin1))+$maknit,date('Y', strtotime($makcin1)) ));


$query_g_rates ="select room_id,from_date,to_date, weekday_net,weekday_sell,weekend_net,weekend_sell,weekends,wpackage  from res_rates where '$mak_rd' between from_date and to_date - interval '1 day' and room_id = $s_roid ";


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
 $rid = $rows_rates["weekend_sell"];
}
else {
 $rid = $rows_rates["weekday_sell"];
}

$mak_status=1;


}

}


$mak_avail_bull=array();
$mak_avail_rooms = array();

for($maknit=0; $maknit<$maknights1 ;  $maknit++){
$mak_rd1 = date('Y-m-d', mktime(0,0,0,date('m', strtotime($makcin1)),date('d', strtotime($makcin1))+$maknit,date('Y', strtotime($makcin1)) ));

$mak_query_main ="select avialibility,avial_bool from rates$s_hotelsmak where room_id='$s_roid' and rate_date='$mak_rd1'  ";
$mak_result_main = pg_query($mak_query_main);
if (!$mak_result_main) {
	echo "An error occured.\n";
	exit;
	}

while ($mak_rows_main = pg_fetch_array($mak_result_main)){

$mak_rows_main["avialibility"];

if(trim($mak_rows_main["avialibility"])<="0"){
$mak_avail_rooms[] = 0;
$mak_avail_bull[]="f";
break;
}
else{
$mak_avail_rooms[] = $mak_rows_main["avialibility"];
}

//echo $rows_main["avial_bool"];
if($mak_rows_main["avial_bool"]=="f"){
$mak_avail_bull[]="f";
$mak_avail_rooms[] = 0;
break;
}
else{
$mak_avail_bull[] = $mak_rows_main["avial_bool"];
}

}

}

$mak_avail_bullt = "f";

for($bc=0; $bc<$maknights1 ;  $bc++){
if($mak_avail_bull[$bc]=="f"){
$mak_avail_bullt = "f";
break;
}
else{
$mak_avail_bullt = "t";
}
}





if($mak_status==1 && $mak_avail_bullt=="t" && min($mak_avail_rooms)>0){     // if status is true

//echo "<td>A</td>";
echo "<td align=\"center\" style=\" border-right: 1px solid #999999; border-bottom: 1px solid #999999\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><strong>&nbsp;</strong></font></td><td align=\"center\" style=\" border-right: 1px solid #999999; border-bottom: 1px solid #999999\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><strong>&nbsp;</strong></font></td><td align=\"center\" style=\"border-right: 1px solid #999999; border-bottom: 1px solid #999999\"><input type=\"checkbox\" name=\"selrcb[]\" value=\"$s_roid\"></td><td align=\"center\" style=\"border-right: 1px solid #999999; border-bottom: 1px solid #999999\">";


echo "<select id=\"rooms$s_roid\" name=\"rooms$s_roid\" onChange=\"pc$s_roid()\" >";
for($rm=1;$rm<=min($mak_avail_rooms);$rm++){
echo "<option value=\"$rm\">$rm</option>";
}
echo "</select></td><td align=\"center\" style=\"border-right: 1px solid #999999; border-bottom: 1px solid #999999\"><select name=\"meals".$s_roid."[]"."\" MULTIPLE SIZE=\"1\"><option value=\"meals\">Meals</option><option value=\"breakfast\">B/B</option><option value=\"halfboard\">H/B</option><option value=\"fullboard\">F/B</option><option value=\"sahoor\">Sahoor</option><option value=\"iftar\">Iftar</option></select></td>";

echo "<td align=\"center\" style=\"border-right: 1px solid #999999; border-bottom: 1px solid #999999\"> <input type=\"hidden\" id=\"no_paxs$s_roid\" name=\"no_paxs$s_roid\" value=\"$array_no_of_paxs[$roid]\"><select id=\"paxs$s_roid\" name=\"paxs$s_roid\" ><option value=\"$array_no_of_paxs[$roid]\" selected>$array_no_of_paxs[$roid]</option>";
for($px=1;$px<=$array_no_of_paxs[$roid]*$rm;$px++){
echo "<option value=\"$px\">$px</option>";
}
echo "</select></td>";
echo "<td align=\"center\" style=\"border-bottom: 1px solid #999999\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";

echo "<a href=\"changeavail.php?roomid=$s_roid&cin=$makcin1&cout=$makcout1\" target=\"hotavail\" onClick=\"window.open('', 'hotavail','width=700,height=380,menubar=yes,scrollbars=yes, top='+wint+',left='+winl+' ').focus()\">Avial</a>";

echo "</font></td>";

?>
<script>
	function pc<? echo $s_roid; ?>(){ document.getElementById ('paxs<? echo $s_roid; ?>').value = document.getElementById ('no_paxs<? echo $s_roid; ?>').value * document.getElementById ('rooms<? echo $s_roid; ?>').value;
	
	}
</script>
<?


}
else {

//echo "<td align=\"center\" style=\"border-right: 1px solid #999999; border-bottom: 1px solid #999999\" colspan=\"4\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">Not Available </font></td><td align=\"center\" style=\"border-bottom: 1px solid #999999\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><a href=\"#\">Avail</a></font></td>";


echo "<td align=\"center\" style=\"border-bottom: 1px solid #999999; border-right: 1px solid #999999;\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><input type=\"text\" name=\"putnrate$s_roid\" size=\"2\"></font></td><td align=\"center\" style=\"border-bottom: 1px solid #999999; border-right: 1px solid #999999;\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><input type=\"text\" name=\"putrate$s_roid\" size=\"2\"></font></td><td align=\"center\" style=\"border-right: 1px solid #999999; border-bottom: 1px solid #999999\"><input type=\"checkbox\" name=\"selrcb[]\" value=\"$s_roid\"></td><td align=\"center\" style=\"border-right: 1px solid #999999; border-bottom: 1px solid #999999\">";


echo "<select id=\"rooms$s_roid\" name=\"rooms$s_roid\" onChange=\"pc$s_roid()\" >";
for($rm=1;$rm<=$online_res_fix_no_rooms;$rm++){
echo "<option value=\"$rm\">$rm</option>";
}
echo "</select></td><td align=\"center\" style=\"border-right: 1px solid #999999; border-bottom: 1px solid #999999\"><select name=\"meals".$s_roid."[]"."\" MULTIPLE SIZE=\"1\"><option value=\"meals\">Meals</option><option value=\"breakfast\">B/B</option><option value=\"halfboard\">H/B</option><option value=\"fullboard\">F/B</option><option value=\"sahoor\">Sahoor</option><option value=\"iftar\">Iftar</option></select></td>";

echo "<td align=\"center\" style=\"border-right: 1px solid #999999; border-bottom: 1px solid #999999\"> <input type=\"hidden\" id=\"no_paxs$s_roid\" name=\"no_paxs$s_roid\" value=\"$array_no_of_paxs[$roid]\"><select id=\"paxs$s_roid\" name=\"paxs$s_roid\" ><option value=\"$array_no_of_paxs[$roid]\" selected>$array_no_of_paxs[$roid]</option>";
for($px=1;$px<=$array_no_of_paxs[$roid]*$rm;$px++){
echo "<option value=\"$px\">$px</option>";
}
echo "</select></td>";
echo "<td align=\"center\" style=\"border-bottom: 1px solid #999999\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";

echo "<a href=\"changeavail.php?roomid=$s_roid&cin=$makcin1&cout=$makcout1\" target=\"hotavail\" onClick=\"window.open('', 'hotavail','width=700,height=380,menubar=yes,scrollbars=yes, top='+wint+',left='+winl+' ').focus()\">Avial</a>";

echo "</font></td>";


?>
<script>
	function pc<? echo $s_roid; ?>(){ document.getElementById ('paxs<? echo $s_roid; ?>').value = document.getElementById ('no_paxs<? echo $s_roid; ?>').value * document.getElementById ('rooms<? echo $s_roid; ?>').value;
	
	}
</script>
<?

}
//echo "<br>";

}














?>



							  
							  </td>
                            </tr>		

		
		</table>
					
			<?}// end of makkah hotel?>							
   
<br>

<?
 if($_POST["hotcb2"]==on){ // start if for oth hotel
?>							

 <table width="100%" cellpadding="1" cellspacing="0">
                                   <tr bgcolor="#CCCCCC">
                            <td colspan="2">Hotel in Other City</td>
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

 <tr bgcolor="#EFEFEF"> 
                              <td colspan="4">
							  <?
$array_room_id = array();
$array_room_type = array();
$array_no_of_paxs = array();
$array_room_description = array();
$query_room ="select room_id, room_type, no_of_paxs from rooms where room_id like '$s_hotelsoth%'";

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





if(count($array_room_id)>0){
echo "<table width=\"100%\" cellpadding=\"1\" cellspacing=\"0\"><thead><tr><td style=\"border-top: 1px solid #999999; border-right: 1px solid #999999; border-bottom: 1px solid #999999\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><strong>Room Type</strong></font></td><td align=\"center\" style=\"border-top: 1px solid #999999; border-right: 1px solid #999999; border-bottom: 1px solid #999999\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><strong>Net</strong></font></td><td align=\"center\" style=\"border-top: 1px solid #999999; border-right: 1px solid #999999; border-bottom: 1px solid #999999\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><strong>Sell</strong></font></td><td align=\"center\" style=\"border-top: 1px solid #999999; border-right: 1px solid #999999; border-bottom: 1px solid #999999\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><strong>Select</strong></font></td><td align=\"center\" style=\"border-top: 1px solid #999999; border-right: 1px solid #999999; border-bottom: 1px solid #999999\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><strong>Rooms</strong></font></td><td align=\"center\" style=\"border-top: 1px solid #999999; border-right: 1px solid #999999;  border-bottom: 1px solid #999999\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><strong>Meals</strong></font></td><td align=\"center\" style=\"border-top: 1px solid #999999; border-right: 1px solid #999999;  border-bottom: 1px solid #999999\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><strong>Paxs</strong></font></td><td align=\"center\" style=\"border-top: 1px solid #999999;  border-bottom: 1px solid #999999\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><strong>Avail</strong></font></td></tr>";
}

for($roid=0; $roid<count($array_room_id); $roid++){


$oth_rd1 = date('Y-m-d', mktime(0,0,0,$othcinm,$othcind,$othciny));

$oth_query_g_rates ="select room_id,from_date,to_date, weekday_net,weekday_sell,weekend_net,weekend_sell,breakfast,halfboard,fullboard,sahoor,iftar,weekends,wpackage  from res_rates where '$oth_rd1' between from_date and to_date - interval '1 day' and room_id = $array_room_id[$roid] ";


$oth_result_rates = pg_query($oth_query_g_rates);

if (!$oth_result_rates) {
	echo "An error occured.\n";
	exit;
	}
while ($oth_rows_rates = pg_fetch_array($oth_result_rates)){
//echo " ";

 
$oth_a_weekends = explode(",", $oth_rows_rates["weekends"]);



$oth_s_wep = $oth_rows_rates["wpackage"];

}

if(trim($oth_s_wep)=="t"){ 
	





if(count($oth_a_weekends)==2){     // two days weekend


$oth_weekes =  $oth_a_weekends[0];

$oth_weekee =  $oth_a_weekends[1];


if(date('D', strtotime($othcin1))== $oth_weekee){

$othcin1 = date('Y-m-d', mktime(0,0,0,$othcinm1,$othcind1-1,$othciny1));

}




if(date('D', strtotime($othcout1))== $oth_weekee){

$othcout1 = date('Y-m-d', mktime(0,0,0,$othcoutm1,$othcoutd1+1,$othcouty1));

}



}  // end of two days weekend


if(count($oth_a_weekends)==3){     // three days weekend

$oth_weeke0 =  $oth_a_weekends[0];
$oth_weeke1 =  $oth_a_weekends[1];
$oth_weeke2 =  $oth_a_weekends[2];


if(date('D', strtotime($othcin1))== $oth_weeke1){
$othcin1 = date('Y-m-d', mktime(0,0,0,$othcinm1,$othcind1-1,$othciny1));
}
if(date('D', strtotime($othcin1))== $oth_weeke2){
$othcin1 = date('Y-m-d', mktime(0,0,0,$othcinm1,$othcind1-2,$othciny1));
}

if(date('D', strtotime($othcout1))== $oth_weeke1){
$othcout1 = date('Y-m-d', mktime(0,0,0,$othcoutm1,$othcoutd1+2,$othcouty1));
}
if(date('D', strtotime($othcout1))== $oth_weeke2){
$othcout1 = date('Y-m-d', mktime(0,0,0,$othcoutm1,$othcoutd1+1,$othcouty1));
}


}  // end of three days weekend



$othcin1 = date('Y-m-d', strtotime($othcin1));
$othcout1 = date('Y-m-d', strtotime($othcout1));

$othnights1 = Round(((strtotime($othcout1)-strtotime($othcin1))/86400), 0) ;




}


 $s_roid = $array_room_id[$roid];

echo "<tr>";
echo "<td  style=\"border-right: 1px solid #999999; border-bottom: 1px solid #999999\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><a href=\"#\">" . $array_room_type[$roid] . "</a></font></td>";

 

for($othnit=0; $othnit<$othnights ;  $othnit++){
$oth_rd = date('Y-m-d', mktime(0,0,0,date('m', strtotime($othcin1)),date('d', strtotime($othcin1))+$othnit,date('Y', strtotime($othcin1)) ));


$query_g_rates ="select room_id,from_date,to_date, weekday_net,weekday_sell,weekend_net,weekend_sell,weekends,wpackage  from res_rates where '$oth_rd' between from_date and to_date - interval '1 day' and room_id = $s_roid ";


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
 $rid = $rows_rates["weekend_sell"];
}
else {
 $rid = $rows_rates["weekday_sell"];
}

$oth_status=1;
}
}



$oth_avail_bull=array();
$oth_avail_rooms = array();

for($othnit=0; $othnit<$othnights1 ;  $othnit++){
$oth_rd1 = date('Y-m-d', mktime(0,0,0,date('m', strtotime($othcin1)),date('d', strtotime($othcin1))+$othnit,date('Y', strtotime($othcin1)) ));

$oth_query_main ="select avialibility,avial_bool from rates$s_hotelsoth where room_id='$s_roid' and rate_date='$oth_rd1'  ";
$oth_result_main = pg_query($oth_query_main);
if (!$oth_result_main) {
	echo "An error occured.\n";
	exit;
	}

while ($oth_rows_main = pg_fetch_array($oth_result_main)){

$oth_rows_main["avialibility"];

if(trim($oth_rows_main["avialibility"])<="0"){
$oth_avail_rooms[] = 0;
$oth_avail_bull[]="f";
break;
}
else{
$oth_avail_rooms[] = $oth_rows_main["avialibility"];
}

//echo $rows_main["avial_bool"];
if($oth_rows_main["avial_bool"]=="f"){
$oth_avail_bull[]="f";
$oth_avail_rooms[] = 0;
break;
}
else{
$oth_avail_bull[] = $oth_rows_main["avial_bool"];
}

}

}

$oth_avail_bullt = "f";

for($bc=0; $bc<$othnights1 ;  $bc++){
if($oth_avail_bull[$bc]=="f"){
$oth_avail_bullt = "f";
break;
}
else{
$oth_avail_bullt = "t";
}
}



if($oth_status==1 && $oth_avail_bullt=="t" && min($oth_avail_rooms)>0){

//echo "<td>A</td>";
echo "<td align=\"center\" style=\" border-right: 1px solid #999999; border-bottom: 1px solid #999999\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><strong>&nbsp;</strong></font></td><td align=\"center\" style=\" border-right: 1px solid #999999; border-bottom: 1px solid #999999\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><strong>&nbsp;</strong></font></td><td align=\"center\" style=\"border-right: 1px solid #999999; border-bottom: 1px solid #999999\"><input type=\"checkbox\" name=\"othselrcb[]\" value=\"$s_roid\"></td><td align=\"center\" style=\"border-right: 1px solid #999999; border-bottom: 1px solid #999999\">";


echo "<select id=\"othrooms$s_roid\" name=\"othrooms$s_roid\" onChange=\"pc$s_roid()\" >";
for($rm=1;$rm<=$online_res_fix_no_rooms;$rm++){
echo "<option value=\"$rm\">$rm</option>";
}
echo "</select></td><td align=\"center\" style=\"border-right: 1px solid #999999; border-bottom: 1px solid #999999\"><select name=\"othmeals".$s_roid."[]"."\" MULTIPLE SIZE=\"1\"><option value=\"meals\">Meals</option><option value=\"breakfast\">B/B</option><option value=\"halfboard\">H/B</option><option value=\"fullboard\">F/B</option><option value=\"sahoor\">Sahoor</option><option value=\"iftar\">Iftar</option></select></td>";

echo "<td align=\"center\" style=\"border-right: 1px solid #999999; border-bottom: 1px solid #999999\"> <input type=\"hidden\" id=\"othno_paxs$s_roid\" name=\"othno_paxs$s_roid\" value=\"$array_no_of_paxs[$roid]\"><select id=\"othpaxs$s_roid\" name=\"othpaxs$s_roid\" ><option value=\"$array_no_of_paxs[$roid]\" selected>$array_no_of_paxs[$roid]</option>";
for($px=1;$px<=$array_no_of_paxs[$roid]*$rm;$px++){
echo "<option value=\"$px\">$px</option>";
}
echo "</select></td>";
echo "<td align=\"center\" style=\"border-bottom: 1px solid #999999\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";

echo "<a href=\"changeavail.php?roomid=$s_roid&cin=$othcin1&cout=$othcout1\" target=\"hotavail\" onClick=\"window.open('', 'hotavail','width=700,height=380,menubar=yes,scrollbars=yes, top='+wint+',left='+winl+' ').focus()\">Avial</a>";

echo "</font></td>";

?>
<script>
	function pc<? echo $s_roid; ?>(){ document.getElementById ('othpaxs<? echo $s_roid; ?>').value = document.getElementById ('othno_paxs<? echo $s_roid; ?>').value * document.getElementById ('othrooms<? echo $s_roid; ?>').value;
	
	}
</script>
<?


}
else {

//echo "<td align=\"center\" style=\"border-right: 1px solid #999999; border-bottom: 1px solid #999999\" colspan=\"4\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">Not Available </font></td><td align=\"center\" style=\"border-bottom: 1px solid #999999\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><a href=\"#\">Avail</a></font></td>";


echo "<td align=\"center\" style=\"border-bottom: 1px solid #999999; border-right: 1px solid #999999;\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><input type=\"text\" name=\"othputnrate$s_roid\" size=\"2\"></font></td><td align=\"center\" style=\"border-bottom: 1px solid #999999; border-right: 1px solid #999999;\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><input type=\"text\" name=\"othputrate$s_roid\" size=\"2\"></font></td><td align=\"center\" style=\"border-right: 1px solid #999999; border-bottom: 1px solid #999999\"><input type=\"checkbox\" name=\"othselrcb[]\" value=\"$s_roid\"></td><td align=\"center\" style=\"border-right: 1px solid #999999; border-bottom: 1px solid #999999\">";


echo "<select id=\"othrooms$s_roid\" name=\"othrooms$s_roid\" onChange=\"pc$s_roid()\" >";
for($rm=1;$rm<=$online_res_fix_no_rooms;$rm++){
echo "<option value=\"$rm\">$rm</option>";
}
echo "</select></td><td align=\"center\" style=\"border-right: 1px solid #999999; border-bottom: 1px solid #999999\"><select name=\"othmeals".$s_roid."[]"."\" MULTIPLE SIZE=\"1\"><option value=\"meals\">Meals</option><option value=\"breakfast\">B/B</option><option value=\"halfboard\">H/B</option><option value=\"fullboard\">F/B</option><option value=\"sahoor\">Sahoor</option><option value=\"iftar\">Iftar</option></select></td>";

echo "<td align=\"center\" style=\"border-right: 1px solid #999999; border-bottom: 1px solid #999999\"> <input type=\"hidden\" id=\"othno_paxs$s_roid\" name=\"othno_paxs$s_roid\" value=\"$array_no_of_paxs[$roid]\"><select id=\"othpaxs$s_roid\" name=\"othpaxs$s_roid\" ><option value=\"$array_no_of_paxs[$roid]\" selected>$array_no_of_paxs[$roid]</option>";
for($px=1;$px<=$array_no_of_paxs[$roid]*$rm;$px++){
echo "<option value=\"$px\">$px</option>";
}
echo "</select></td>";
echo "<td align=\"center\" style=\"border-bottom: 1px solid #999999\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";

echo "<a href=\"changeavail.php?roomid=$s_roid&cin=$othcin1&cout=$othcout1\" target=\"hotavail\" onClick=\"window.open('', 'hotavail','width=700,height=380,menubar=yes,scrollbars=yes, top='+wint+',left='+winl+' ').focus()\">Avial</a>";

echo "</font></td>";

?>
<script>
	function pc<? echo $s_roid; ?>(){ document.getElementById ('othpaxs<? echo $s_roid; ?>').value = document.getElementById ('othno_paxs<? echo $s_roid; ?>').value * document.getElementById ('othrooms<? echo $s_roid; ?>').value;
	
	}
</script>
<?


}
//echo "<br>";

}














?>



							  
							  </td>
                            </tr>		

		
		</table>


							
			<?}// end of others hotel?>





<?
if($_POST["trans0"]==on){ // start if transportation 1
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

$s_typeoftrans0		  = $_POST['typeoftrans0'];     


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
                            <td colspan="1" align="center" style="border-bottom: 1px solid #999999; border-right: 1px solid #999999; border-top: 1px solid #999999" ><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><? echo $tvety0 ?></font></td>
                            <td colspan="1" align="center" style="border-bottom: 1px solid #999999;border-right: 1px solid #999999; border-top: 1px solid #999999"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><? echo $tvetr0 ?></font></td>
                            <td colspan="1" align="center" style="border-bottom: 1px solid #999999;border-right: 1px solid #999999; border-top: 1px solid #999999"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><? echo $s_noofu0 ?></font></td>
                            <td colspan="1" align="center" style="border-bottom: 1px solid #999999;border-right: 1px solid #999999; border-top: 1px solid #999999"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><? echo date('d-M-Y', strtotime($trans0rd)) ."<br>". $s_timeselecthours0 .":".$s_timeselectmin0; ?></font></td>
                            <td colspan="1" align="center" style="border-bottom: 1px solid #999999;border-right: 1px solid #999999; border-top: 1px solid #999999"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><? echo $s_flightdet0 ?></font></td>
                            <td colspan="1" align="center" style="border-bottom: 1px solid #999999;border-right: 1px solid #999999; border-top: 1px solid #999999"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><? echo $tvetp0 * $s_noofu0?></font></td>
                            <td colspan="1" align="center" style="border-bottom: 1px solid #999999;border-right: 1px solid #999999; border-top: 1px solid #999999"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><input type="text" name="trans1nrate<? echo $s_typeoftrans0 ?>" value='<? echo $trans1netr * $s_noofu0 ?>' size="2" readonly></font></td>
                            <td colspan="1" align="center" style="border-bottom: 1px solid #999999;border-top: 1px solid #999999"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><input type="text" name="trans1rate<? echo $s_typeoftrans0 ?>" value='<? echo $trans1sellr * $s_noofu0 ?>' size="2" readonly></font></td>


                          </tr>





</table>

<?}// end of transportation 1?>



<?
if($_POST["trans1"]==on){ // start if transportation 2
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

$s_typeoftrans1		  = $_POST['typeoftrans1'];     


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
                            <td colspan="1" align="center" style="border-bottom: 1px solid #999999; border-right: 1px solid #999999; border-top: 1px solid #999999" ><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><? echo $tvety1 ?></font></td>
                            <td colspan="1" align="center" style="border-bottom: 1px solid #999999;border-right: 1px solid #999999; border-top: 1px solid #999999"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><? echo $tvetr1 ?></font></td>
                            <td colspan="1" align="center" style="border-bottom: 1px solid #999999;border-right: 1px solid #999999; border-top: 1px solid #999999"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><? echo $s_noofu1 ?></font></td>
                            <td colspan="1" align="center" style="border-bottom: 1px solid #999999;border-right: 1px solid #999999; border-top: 1px solid #999999"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><? echo date('d-M-Y', strtotime($trans1rd)) ."<br>". $s_timeselecthours1 .":".$s_timeselectmin1; ?></font></td>
                            <td colspan="1" align="center" style="border-bottom: 1px solid #999999;border-right: 1px solid #999999; border-top: 1px solid #999999"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><? echo $s_flightdet1 ?></font></td>
                            <td colspan="1" align="center" style="border-bottom: 1px solid #999999;border-right: 1px solid #999999; border-top: 1px solid #999999"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><? echo $tvetp1 * $s_noofu1?></font></td>
                            <td colspan="1" align="center" style="border-bottom: 1px solid #999999;border-right: 1px solid #999999; border-top: 1px solid #999999"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><input type="text" name="trans2nrate<? echo $s_typeoftrans1 ?>" value='<? echo $trans2netr * $s_noofu1 ?>' size="2" readonly></font></td>
                            <td colspan="1" align="center" style="border-bottom: 1px solid #999999;border-top: 1px solid #999999"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><input type="text" name="trans2rate<? echo $s_typeoftrans1 ?>" value='<? echo $trans2sellr * $s_noofu1?>' size="2" readonly></font></td>


                          </tr>





</table>

<?}// end of transportation 2?>
							


<?
if($_POST["trans2"]==on){ // start if transportation 3
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

$s_typeoftrans2	  = $_POST['typeoftrans2'];     


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
                            <td colspan="1" align="center" style="border-bottom: 1px solid #999999; border-right: 1px solid #999999; border-top: 1px solid #999999" ><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><? echo $tvety2 ?></font></td>
                            <td colspan="1" align="center" style="border-bottom: 1px solid #999999;border-right: 1px solid #999999; border-top: 1px solid #999999"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><? echo $tvetr2 ?></font></td>
                            <td colspan="1" align="center" style="border-bottom: 1px solid #999999;border-right: 1px solid #999999; border-top: 1px solid #999999"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><? echo $s_noofu2 ?></font></td>
                            <td colspan="1" align="center" style="border-bottom: 1px solid #999999;border-right: 1px solid #999999; border-top: 1px solid #999999"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><? echo date('d-M-Y', strtotime($trans2rd)) ."<br>". $s_timeselecthours2 .":".$s_timeselectmin2; ?></font></td>
                            <td colspan="1" align="center" style="border-bottom: 1px solid #999999;border-right: 1px solid #999999; border-top: 1px solid #999999"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><? echo $s_flightdet2 ?></font></td>
                            <td colspan="1" align="center" style="border-bottom: 1px solid #999999;border-right: 1px solid #999999; border-top: 1px solid #999999"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><? echo $tvetp2 * $s_noofu2 ?></font></td>
                            <td colspan="1" align="center" style="border-bottom: 1px solid #999999;border-right: 1px solid #999999; border-top: 1px solid #999999"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><input type="text" name="trans3nrate<? echo $s_typeoftrans2 ?>" value='<? echo $trans3netr * $s_noofu2?>' size="2" readonly></font></td>
                            <td colspan="1" align="center" style="border-bottom: 1px solid #999999;border-top: 1px solid #999999"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><input type="text" name="trans3rate<? echo $s_typeoftrans2 ?>" value='<? echo $trans3sellr * $s_noofu2?>' size="2" readonly></font></td>


                          </tr>





</table>

<?}// end of transportation 3?>
							


							<?
if($_POST["trans3"]==on){ // start if transportation 4
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

$s_typeoftrans3	  = $_POST['typeoftrans3'];     


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
                            <td colspan="1" align="center" style="border-bottom: 1px solid #999999; border-right: 1px solid #999999; border-top: 1px solid #999999" ><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><? echo $tvety3 ?></font></td>
                            <td colspan="1" align="center" style="border-bottom: 1px solid #999999;border-right: 1px solid #999999; border-top: 1px solid #999999"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><? echo $tvetr3 ?></font></td>
                            <td colspan="1" align="center" style="border-bottom: 1px solid #999999;border-right: 1px solid #999999; border-top: 1px solid #999999"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><? echo $s_noofu3 ?></font></td>
                            <td colspan="1" align="center" style="border-bottom: 1px solid #999999;border-right: 1px solid #999999; border-top: 1px solid #999999"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><? echo date('d-M-Y', strtotime($trans3rd)) ."<br>". $s_timeselecthours3 .":".$s_timeselectmin3; ?></font></td>
                            <td colspan="1" align="center" style="border-bottom: 1px solid #999999;border-right: 1px solid #999999; border-top: 1px solid #999999"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><? echo $s_flightdet3 ?></font></td>
                            <td colspan="1" align="center" style="border-bottom: 1px solid #999999;border-right: 1px solid #999999; border-top: 1px solid #999999"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><? echo $tvetp3 * $s_noofu3?></font></td>
                            <td colspan="1" align="center" style="border-bottom: 1px solid #999999;border-right: 1px solid #999999; border-top: 1px solid #999999"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><input type="text" name="trans4nrate<? echo $s_typeoftrans3 ?>" value='<? echo $trans4netr * $s_noofu3 ?>' size="2" readonly></font></td>
                            <td colspan="1" align="center" style="border-bottom: 1px solid #999999;border-top: 1px solid #999999"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><input type="text" name="trans4rate<? echo $s_typeoftrans3 ?>" value='<? echo $trans4sellr * $s_noofu3 ?>' size="2" readonly></font></td>


                          </tr>





</table>

<?}// end of transportation 4?>

							


<?
if($_POST["others0"]==on){ // start if others1
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
  <td colspan="1" align="center" bgcolor="#EFEFEF" style="border-right: 1px solid #999999; border-top: 1px solid #999999"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><input type="text" name="other1net" name="other1net" value='<? echo $other1nrate ?>' size="2" readonly></font></td>
  <td colspan="1" align="center" bgcolor="#EFEFEF" style="border-top: 1px solid #999999"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><input type="text" name="other1sell" name="other1sell" value='<? echo $other1srate ?>' size="2" readonly></font></td>
</tr>
</table>


<?}// end of other 1?>


<?
if($_POST["others1"]==on){ // start if others2
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
  <td colspan="1" align="center" bgcolor="#EFEFEF" style="border-right: 1px solid #999999; border-top: 1px solid #999999"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><input type="text" name="other2net" name="other2net" value='<? echo $other2nrate ?>' size="2" readonly></font></td>
  <td colspan="1" align="center" bgcolor="#EFEFEF" style="border-top: 1px solid #999999"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><input type="text" name="other2sell" name="other2sell" value='<? echo $other2srate ?>' size="2" readonly></font></td>
</tr>
</table>


<?}// end of other 2?>

<?
if($_POST["others2"]==on){ // start if others3
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
  <td colspan="1" align="center" bgcolor="#EFEFEF" style="border-right: 1px solid #999999; border-top: 1px solid #999999"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><input type="text" name="other3net" name="other3net" value='<? echo $other3nrate ?>' size="2" readonly></font></td>
  <td colspan="1" align="center" bgcolor="#EFEFEF" style="border-top: 1px solid #999999"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><input type="text" name="other3sell" name="other3sell" value='<? echo $other3srate ?>' size="2" readonly></font></td>
</tr>
</table>


<?}// end of other 3?>
							
							</td>
                          </tr>
                         
                         
<tr><td colspan="2" align="center"><br><input type="submit" value="Get Selected Rooms Price"></td></tr>
                          


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






</body>				
</html>
