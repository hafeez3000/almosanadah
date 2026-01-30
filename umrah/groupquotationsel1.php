<?

include ("header.php");
$vy=$vm=$vd=0;
$vy1=$vm1=$vd1=0;
$vy2=$vm2=$vd2=0;

?>
<script src="../javascripts/cBoxes.js"></script>
<script>
document.title= '<? echo $company_name . " ERP - Umrah - Group Quotation"; ?>';

</script>

<html>

<body leftmargin="0" topmargin="0" rightmargin="0" >
<table width="100%" border="0" cellpadding="0" cellspacing="0" style="border-bottom: 1px solid #999999 ;border-left: 3px solid #006600;border-right: 3px solid #006600"><tr>
    <td bgcolor="#CCCCCC"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">&nbsp;You 
      are here: <a href="uhome.php">Home</a> &raquo; <a href="#">Quotations</a> 
      &raquo; Group Quotation Select</font></td>
  </tr></table>
  
<table width="100%" border="0" cellpadding="0" cellspacing="0" style="border-bottom: 3px solid #006600; border-right: 3px solid #006600;border-left: 3px solid #006600 ">
  <tr>
    <td width="20%" style="border-right: 1px solid #999999"  valign="top"> <table width="100%" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td valign="top"><div align="left"> 
              <?php include  ("umenupreline.php"); ?>
            </div></td>
        </tr>
      </table></td>
    <td width="80%" valign="top"  > <table width="100%" border="0" cellpadding="0" cellspacing="1">
        <tr>
          <td valign="top"> 
           
			


			
            <table width="100%" cellpadding="0" cellspacing="0" ><tr><td width="85%" valign="top"> 
			<table cellpadding="0" cellspacing="0" width="100%" style="border-top: 1px solid #999999; border-bottom: 1px solid #999999"><tr>
                      <td bgcolor="#CCCCCC"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"> <strong>Group Quotation Select</strong></font></td>
                    </tr></table>
<table width="100%" cellpadding="1" cellspacing="0"><tr>
                      <td> 
                          <table width="100%" border="0" cellspacing="0" cellpadding="1" align="center">

<?               
 $s_npaxs = $_POST["npaxs"];
$s_agentcode = $_POST["agentname"];
$a_meals = $_POST["meals"];

 $s_rts = $_POST["rtypes"];

  $s_rts1 = $_POST["rtypes"];

 $s_viewt = $_POST["viewt"];


if($_POST["hotcb0"]==on){

 $s_hotelsmad = $_POST["hotelsmad"];


$madcind = $_POST['dDay'];
$madcinm = $_POST['dMonth'];
$madciny = $_POST['dYear'];

  $madcin = $madciny ."-". $madcinm ."-". $madcind ; 


  $madn = $_POST["madn"];

  $madcout = date('Y-m-d', mktime(0,0,0,$madcinm,$madcind+$madn,$madciny));

}

if($_POST["hotcb1"]==on){

 $s_hotelsmak =  $_POST["hotelsmak"];


$makcind = $_POST['d1Day'];
$makcinm = $_POST['d1Month'];
$makciny = $_POST['d1Year'];

 $makcin = $makciny ."-". $makcinm ."-". $makcind ; 

 $makn = $_POST["makn"];

 $makcout = date('Y-m-d', mktime(0,0,0,$makcinm,$makcind+$makn,$makciny));

}

if($_POST["hotcb2"]==on){

$s_hotelsoth = $_POST["hotelsoth"];

$othcind = $_POST['d2Day'];
$othcinm = $_POST['d2Month'];
$othciny = $_POST['d2Year'];

 $othcin = $othciny ."-". $othcinm ."-". $othcind ; 

 $_POST["othn"];

 $othn = $_POST["othn"];

 $othcout = date('Y-m-d', mktime(0,0,0,$othcinm,$othcind+$othn,$othciny));

}

 $_POST["trans0"];

 $_POST["visa0"];

 $_POST["others0"];

 $_POST["others1"];

 $_POST["others2"];

  

$s_agentname = "";
$s_country = "";


if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$array_acccode = $_SESSION['a_acccode'];
$array_aname = $_SESSION['a_aname'];
$array_country = $_SESSION['a_country'];

$array_hotel	 = $_SESSION['a_hotel_name']; 
$array_hotel_id  = $_SESSION['a_hotel_id']; 
$array_city     = $_SESSION['city'];








$s_Single = "Single";
$s_Double = "Double";
$s_Triple = "Triple";
$s_Quad = "Quad";
$s_5_in_Room = "5 in Room";
$s_6_in_Room = "6 in Room";
$s_7_in_Room = "7 in Room";
$s_8_in_Room = "8 in Room";
$s_9_in_Room = "9 in Room";
$s_10_in_Room = "10 in Room";
$s_11_in_Room = "11 in Room";
$s_12_in_Room = "12 in Room";

$as_rts = explode(",", $s_rts);
$srs=0;
$srooms = array();
for($rtc=0; $rtc<count($as_rts); $rtc++){
 if(trim($as_rts[$rtc])==$s_Single){ $srooms[$srs]= "1"; $srs++;}
 if(trim($as_rts[$rtc])==$s_Double){ $srooms[$srs]= "2"; $srs++;}
 if(trim($as_rts[$rtc])==$s_Triple){ $srooms[$srs]= "3"; $srs++;}
 if(trim($as_rts[$rtc])==$s_Quad){ $srooms[$srs]= "4"; $srs++;}
 if(trim($as_rts[$rtc])==$s_5_in_Room){ $srooms[$srs]= "5"; $srs++;}
 if(trim($as_rts[$rtc])==$s_6_in_Room){ $srooms[$srs]= "6"; $srs++;}
 if(trim($as_rts[$rtc])==$s_7_in_Room){ $srooms[$srs]= "7"; $srs++;}
 if(trim($as_rts[$rtc])==$s_8_in_Room){ $srooms[$srs]= "8"; $srs++;}
 if(trim($as_rts[$rtc])==$s_9_in_Room){ $srooms[$srs]= "9"; $srs++;}
 if(trim($as_rts[$rtc])==$s_10_in_Room){ $srooms[$srs]= "10"; $srs++;}
 if(trim($as_rts[$rtc])==$s_11_in_Room){ $srooms[$srs]= "11"; $srs++;}
 if(trim($as_rts[$rtc])==$s_12_in_Room){ $srooms[$srs]= "12"; $srs++;}

}

$sa_q1 = array();
$s_q1 = "";



for($rcf=0; $rcf<count($srooms); $rcf++){
$srooms[$rcf];
$s_q1 = $s_q1 . "," . "weekd_net_r" . $srooms[$rcf] . "," . "weekd_sell_r" . $srooms[$rcf] . "," . "weeke_net_r" . $srooms[$rcf] . ", " . "weeke_sell_r" . $srooms[$rcf] ;
}

$s_q1 = trim(substr($s_q1, 1, strlen($s_q1)));



echo "<table width=\"100%\" border=\"1\" cellpadding=\"1\" cellspacing=\"0\"><form name=\"roomselput\" method=\"post\" action=\"hotelroomrateputa.php\">";

echo "<tr><td><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">Group of Paxs: <b>$s_npaxs</b></font></td></tr>";

for($i=0; $i<count($array_acccode); $i++){

if($s_agentcode==$array_acccode[$i]){
$s_agentname = $array_aname[$i];
$s_country = $array_country[$i];
}

}


echo "<tr><td><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";
echo "Agent Name: <b>" . $s_agentname ." - ". $s_country;
echo "</b></font></td></tr>";

if($_POST["hotcb0"]==on){



for($i=0; $i<count($array_hotel_id); $i++){

if($s_hotelsmad==$array_hotel_id[$i]){
$s_hotelsmad_name = $array_hotel[$i];
$s_hotelsmad_city = $array_city[$i];
}

}


echo "<tr><td bgcolor=\"#EAFFEA\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";
echo "Hotel Name: <b>" . $s_hotelsmad_name . " - " . $s_hotelsmad_city;
echo "</b></font></td></tr>";

echo "<tr><td bgcolor=\"#EAFFEA\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";
echo "Check-In : <b>" . date('D jS M, Y', strtotime($madcin))  . "</b> ||  Check-Out: " . date('D jS M, Y', strtotime($madcout)) . " || No. of Nights: <b>" . $madn;
echo "</b></font></td></tr>";

echo "<tr><td bgcolor=\"#EAFFEA\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";
echo "View type: " . $s_viewt . "	||  " . "Meals: ";

for($m=0; $m<count($a_meals) ; $m++){ echo $a_meals[$m] ; }

echo "</font></td></tr>";

echo "<tr><td>";



echo "<table style=\"border: 1px solid green\" border=\"1\" width=\"100%\"> <tr><td bgcolor=\"#EAFFEA\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";

echo "Req. Night";

echo "</font></td>";



for($rt=0; $rt<count($as_rts); $rt++){
echo "<td bgcolor=\"#EAFFEA\" align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";
echo $as_rts[$rt];
echo "<br>";
echo "Net || Sell";
echo "</td>";
}

echo "</tr>";


$we_bull = 0;
for($n=0; $n<$madn; $n++){

echo "<tr><td bgcolor=\"#EAFFEA\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";


//echo date('jS M, Y', strtotime($makdcin));

echo date('D jS M, y', mktime(0,0,0,$madcinm,$madcind+$n,$madciny));

echo "</font></td>";

$f_date = date('Y-m-d', mktime(0,0,0,$madcinm,$madcind+$n,$madciny));

$a_weekdays = array("Wed" , "Thu");

$query_g_rates ="select hotel_id,from_date,to_date," . $s_q1 . ", nationality, view_type,avialibility,avial_bool,allotment,breakfast,halfboard_rate,fullboard_rate,sahoor_rate,iftar_rate  from group_rates where hotel_id='$s_hotelsmad' and '$f_date' between from_date and to_date - interval '1 day' and view_type = '$s_viewt'";



$result_g_rates = pg_query($conn, $query_g_rates);

if (!$result_g_rates) {
	echo "An error occured.\n";
	exit;
	}

 $numrmad = pg_num_rows($result_g_rates);

if($numrmad>0){


while ($rows_g_rates = pg_fetch_array($result_g_rates)){


for($we=0; $we<count($a_weekdays); $we++){
if($a_weekdays[$we]==date('D', strtotime($f_date))){
$we_bull=1;
break;
}
else{
$we_bull=0;
}

}



for($rt=0; $rt<count($as_rts); $rt++){



if($we_bull==0){


 if(trim($as_rts[$rt])=="Single"){


echo "<td align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";

echo "<input type=\"text\" id=\"madnr1\" name=\"madnr1[]\" size=\"2\" value=\" " . $rows_g_rates["weekd_net_r1"] . " \"  onKeyUp=\"calt()\" onFocus=\"calt()\" onBlur=\"calt()\">";

echo "&nbsp;";

echo "<input type=\"text\" id=\"madsr1\" name=\"madsr1[]\" size=\"2\" value=\" " . $rows_g_rates["weekd_sell_r1"] . " \" onKeyUp=\"calt()\" onFocus=\"calt()\" onBlur=\"calt()\">";

echo "</font></td>";
 }



if(trim($as_rts[$rt])=="Double"){


echo "<td align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";

echo "<input type=\"text\" id=\"madnr2\" name=\"madnr2[]\" size=\"2\" value=\" " . $rows_g_rates["weekd_net_r2"] . " \" onKeyUp=\"calt()\" onFocus=\"calt()\" onBlur=\"calt()\">";

echo "&nbsp;";

echo "<input type=\"text\" id=\"madsr2\" name=\"madsr2[]\" size=\"2\" value=\" " . $rows_g_rates["weekd_sell_r2"] . " \" onKeyUp=\"calt()\" onFocus=\"calt()\" onBlur=\"calt()\">";


echo "</font></td>";
 }

 if(trim($as_rts[$rt])=="Triple"){


echo "<td align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";

echo "<input type=\"text\" id=\"madnr3\" name=\"madnr3[]\" size=\"2\" value=\" " . $rows_g_rates["weekd_net_r3"] . " \" onKeyUp=\"calt()\" onFocus=\"calt()\" onBlur=\"calt()\">";

echo "&nbsp;";

echo "<input type=\"text\" id=\"madsr3\" name=\"madsr3[]\" size=\"2\" value=\" " . $rows_g_rates["weekd_sell_r3"] . " \" onKeyUp=\"calt()\" onFocus=\"calt()\" onBlur=\"calt()\">";


echo "</font></td>";
 }


} // end of weend bull if
else{

 if(trim($as_rts[$rt])=="Single"){

 echo "<td align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";

echo "<input type=\"text\" id=\"madnr1\" name=\"madnr1[]\" size=\"2\" value=\" " . $rows_g_rates["weeke_net_r1"] . " \"  onKeyUp=\"calt()\" onFocus=\"calt()\" onBlur=\"calt()\" >";

echo "&nbsp;";

echo "<input type=\"text\" id=\"madsr1\" name=\"madsr1[]\" size=\"2\" value=\" " . $rows_g_rates["weeke_sell_r1"] . " \" onKeyUp=\"calt()\" onFocus=\"calt()\" onBlur=\"calt()\">";

echo "</font></td>";



  }


  if(trim($as_rts[$rt])=="Double"){
 echo "<td align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";

echo "<input type=\"text\" id=\"madnr2\" name=\"madnr2[]\" size=\"2\" value=\" " . $rows_g_rates["weeke_net_r2"] . " \" onKeyUp=\"calt()\" onFocus=\"calt()\" onBlur=\"calt()\">";

echo "&nbsp;";

echo "<input type=\"text\" id=\"madsr2\" name=\"madsr2[]\" size=\"2\" value=\" " . $rows_g_rates["weeke_sell_r2"] . " \" onKeyUp=\"calt()\" onFocus=\"calt()\" onBlur=\"calt()\">";

echo "</font></td>";

  }


if(trim($as_rts[$rt])=="Triple"){
 echo "<td align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";

echo "<input type=\"text\" id=\"madnr3\" name=\"madnr3[]\" size=\"2\" value=\" " . $rows_g_rates["weeke_net_r3"] . " \" onKeyUp=\"calt()\" onFocus=\"calt()\" onBlur=\"calt()\">";

echo "&nbsp;";

echo "<input type=\"text\" id=\"madsr3\" name=\"madsr3[]\" size=\"2\" value=\" " . $rows_g_rates["weeke_sell_r3"] . " \" onKeyUp=\"calt()\" onFocus=\"calt()\" onBlur=\"calt()\">";

echo "</font></td>";

  }



}  // end of weend bull else


} // end for roomtype


$rows_g_rates["breakfast"];
$rows_g_rates["halfboard_rate"];
$rows_g_rates["fullboard_rate"];
$rows_g_rates["sahoor_rate"];
$rows_g_rates["iftar_rate"];


} // end of resultset

pg_free_result($result_g_rates);


}
else {



for($rt=0; $rt<count($as_rts); $rt++){


 if(trim($as_rts[$rt])=="Single"){


echo "<td align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";

echo "<input type=\"text\" id=\"madnr1\" name=\"madnr1[]\" size=\"2\" value=\"0\" onKeyUp=\"calt()\" onFocus=\"calt()\" onBlur=\"calt()\">";

echo "&nbsp;";

echo "<input type=\"text\" id=\"madsr1\" name=\"madsr1[]\" size=\"2\" value=\"0\" onKeyUp=\"calt()\" onFocus=\"calt()\" onBlur=\"calt()\">";

echo "</font></td>";
 }



if(trim($as_rts[$rt])=="Double"){


echo "<td align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";

echo "<input type=\"text\" id=\"madnr2\" name=\"madnr2[]\" size=\"2\" value=\"0\" onKeyUp=\"calt()\" onFocus=\"calt()\" onBlur=\"calt()\">";

echo "&nbsp;";

echo "<input type=\"text\" id=\"madsr2\" name=\"madsr2[]\" size=\"2\" value=\"0\" onKeyUp=\"calt()\" onFocus=\"calt()\" onBlur=\"calt()\">";


echo "</font></td>";
 }

 if(trim($as_rts[$rt])=="Triple"){


echo "<td align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";

echo "<input type=\"text\" id=\"madnr3\" name=\"madnr3[]\" size=\"2\" value=\"0\" onKeyUp=\"calt()\" onFocus=\"calt()\" onBlur=\"calt()\">";

echo "&nbsp;";

echo "<input type=\"text\" id=\"madsr3\" name=\"madsr3[]\" size=\"2\" value=\"0\" onKeyUp=\"calt()\" onFocus=\"calt()\" onBlur=\"calt()\">";


echo "</font></td>";
 }


} 




}  // end of if else of rcount zero


echo "</tr>";

}  // end of loop nights




echo "</table>";

echo "</td></tr>" ;


echo "<tr><td>&nbsp;</td></tr>";

}  // end of if hotel





if($_POST["hotcb1"]==on){



for($i=0; $i<count($array_hotel_id); $i++){

if($s_hotelsmak==$array_hotel_id[$i]){
$s_hotelsmak_name = $array_hotel[$i];
$s_hotelsmak_city = $array_city[$i];
}

}


echo "<tr><td bgcolor=\"#D5D5FF\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";
echo "Hotel Name: <b>" . $s_hotelsmak_name . " - " . $s_hotelsmak_city;
echo "</b></font></td></tr>";

echo "<tr><td bgcolor=\"#D5D5FF\" ><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";
echo "Check-In : <b>" . date('D jS M, Y', strtotime($makcin))  . "</b> ||  Check-Out: " . date('D jS M, Y', strtotime($makcout)) . " || No. of Nights: <b>" . $makn;
echo "</b></font></td></tr>";

echo "<tr><td bgcolor=\"#D5D5FF\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";
echo "View type: " . $s_viewt . "	||  " . "Meals: ";

for($m=0; $m<count($a_meals) ; $m++){ echo $a_meals[$m] ; }

echo "</font></td></tr>";

echo "<tr><td>";



echo "<table style=\"border: 1px solid blue\" border=\"1\" width=\"100%\"> <tr><td bgcolor=\"#D5D5FF\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";

echo "Req. Night";

echo "</font></td>";



for($rt=0; $rt<count($as_rts); $rt++){
echo "<td bgcolor=\"#D5D5FF\" align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";
echo $as_rts[$rt];
echo "<br>";
echo "Net || Sell";
echo "</td>";
}

echo "</tr>";


$we_bull = 0;
for($n=0; $n<$makn; $n++){

echo "<tr><td bgcolor=\"#D5D5FF\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";


//echo date('jS M, Y', strtotime($makdcin));

echo date('D jS M, y', mktime(0,0,0,$makcinm,$makcind+$n,$makciny));

echo "</font></td>";

$f_date = date('Y-m-d', mktime(0,0,0,$makcinm,$makcind+$n,$makciny));

$a_weekdays = array("Wed" , "Thu");

$query_g_rates ="select hotel_id,from_date,to_date," . $s_q1 . ", nationality, view_type,avialibility,avial_bool,allotment,breakfast,halfboard_rate,fullboard_rate,sahoor_rate,iftar_rate  from group_rates where hotel_id='$s_hotelsmak' and '$f_date' between from_date and to_date - interval '1 day' and view_type = '$s_viewt'";



$result_g_rates = pg_query($conn, $query_g_rates);

if (!$result_g_rates) {
	echo "An error occured.\n";
	exit;
	}

 $numrmak = pg_num_rows($result_g_rates);

if($numrmak>0){

while ($rows_g_rates = pg_fetch_array($result_g_rates)){


for($we=0; $we<count($a_weekdays); $we++){

if($a_weekdays[$we]==date('D', strtotime($f_date))){
$we_bull=1;
break;
}
else{
 $we_bull=0;
}

}



for($rt=0; $rt<count($as_rts); $rt++){



if($we_bull==0){


 if(trim($as_rts[$rt])=="Single"){


echo "<td align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";

echo "<input type=\"text\" id=\"maknr1\" name=\"maknr1[]\" size=\"2\" value=\" " . $rows_g_rates["weekd_net_r1"] . " \" onKeyUp=\"calt()\" onFocus=\"calt()\" onBlur=\"calt()\">";

echo "&nbsp;";

echo "<input type=\"text\" id=\"maksr1\" name=\"maksr1[]\" size=\"2\" value=\" " . $rows_g_rates["weekd_sell_r1"] . " \" onKeyUp=\"calt()\" onFocus=\"calt()\" onBlur=\"calt()\">";

echo "</font></td>";
 }



if(trim($as_rts[$rt])=="Double"){


echo "<td align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";

echo "<input type=\"text\" id=\"maknr2\" name=\"maknr2[]\" size=\"2\" value=\" " . $rows_g_rates["weekd_net_r2"] . " \" onKeyUp=\"calt()\" onFocus=\"calt()\" onBlur=\"calt()\">";

echo "&nbsp;";

echo "<input type=\"text\" id=\"maksr2\" name=\"maksr2[]\" size=\"2\" value=\" " . $rows_g_rates["weekd_sell_r2"] . " \" onKeyUp=\"calt()\" onFocus=\"calt()\" onBlur=\"calt()\">";


echo "</font></td>";
 }

 if(trim($as_rts[$rt])=="Triple"){


echo "<td align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";

echo "<input type=\"text\" id=\"maknr3\" name=\"maknr3[]\" size=\"2\" value=\" " . $rows_g_rates["weekd_net_r3"] . " \" onKeyUp=\"calt()\" onFocus=\"calt()\" onBlur=\"calt()\">";

echo "&nbsp;";

echo "<input type=\"text\" id=\"maksr3\" name=\"maksr3[]\" size=\"2\" value=\" " . $rows_g_rates["weekd_sell_r3"] . " \" onKeyUp=\"calt()\" onFocus=\"calt()\" onBlur=\"calt()\">";


echo "</font></td>";
 }


} // end of weend bull if
else{

 if(trim($as_rts[$rt])=="Single"){

 echo "<td align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";

echo "<input type=\"text\" id=\"maknr1\" name=\"maknr1[]\" size=\"2\" value=\" " . $rows_g_rates["weeke_net_r1"] . " \" onKeyUp=\"calt()\" onFocus=\"calt()\" onBlur=\"calt()\">";

echo "&nbsp;";

echo "<input type=\"text\" id=\"maksr1\" name=\"maksr1[]\" size=\"2\" value=\" " . $rows_g_rates["weeke_sell_r1"] . " \" onKeyUp=\"calt()\" onFocus=\"calt()\" onBlur=\"calt()\">";

echo "</font></td>";



  }


  if(trim($as_rts[$rt])=="Double"){
 echo "<td align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";

echo "<input type=\"text\" id=\"maknr2\" name=\"maknr2[]\" size=\"2\" value=\" " . $rows_g_rates["weeke_net_r2"] . " \" onKeyUp=\"calt()\" onFocus=\"calt()\" onBlur=\"calt()\">";

echo "&nbsp;";

echo "<input type=\"text\" id=\"maksr2\" name=\"maksr2[]\" size=\"2\" value=\" " . $rows_g_rates["weeke_sell_r2"] . " \" onKeyUp=\"calt()\" onFocus=\"calt()\" onBlur=\"calt()\"> ";

echo "</font></td>";

  }


if(trim($as_rts[$rt])=="Triple"){
 echo "<td align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";

echo "<input type=\"text\" id=\"maknr3\" name=\"maknr3[]\" size=\"2\" value=\" " . $rows_g_rates["weeke_net_r3"] . " \" onKeyUp=\"calt()\" onFocus=\"calt()\" onBlur=\"calt()\">";

echo "&nbsp;";

echo "<input type=\"text\" id=\"maksr3\" name=\"maksr3[]\" size=\"2\" value=\" " . $rows_g_rates["weeke_sell_r3"] . " \" onKeyUp=\"calt()\" onFocus=\"calt()\" onBlur=\"calt()\">";

echo "</font></td>";

  }



}  // end of weend bull else


} // end for roomtype


$rows_g_rates["breakfast"];
$rows_g_rates["halfboard_rate"];
$rows_g_rates["fullboard_rate"];
$rows_g_rates["sahoor_rate"];
$rows_g_rates["iftar_rate"];


} // end of resultset

pg_free_result($result_g_rates);


}
else {



for($rt=0; $rt<count($as_rts); $rt++){


 if(trim($as_rts[$rt])=="Single"){


echo "<td align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";

echo "<input type=\"text\" id=\"maknr1\" name=\"maknr1[]\" size=\"2\" value=\"0\" onKeyUp=\"calt()\" onFocus=\"calt()\" onBlur=\"calt()\">";

echo "&nbsp;";

echo "<input type=\"text\" id=\"maksr1\" name=\"maksr1[]\" size=\"2\" value=\"0\" onKeyUp=\"calt()\" onFocus=\"calt()\" onBlur=\"calt()\">";

echo "</font></td>";
 }



if(trim($as_rts[$rt])=="Double"){


echo "<td align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";

echo "<input type=\"text\" id=\"maknr2\" name=\"maknr2[]\" size=\"2\" value=\"0\" onKeyUp=\"calt()\" onFocus=\"calt()\" onBlur=\"calt()\">";

echo "&nbsp;";

echo "<input type=\"text\" id=\"maksr2\" name=\"maksr2[]\" size=\"2\" value=\"0\" onKeyUp=\"calt()\" onFocus=\"calt()\" onBlur=\"calt()\">";


echo "</font></td>";
 }

 if(trim($as_rts[$rt])=="Triple"){


echo "<td align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";

echo "<input type=\"text\" id=\"maknr3\" name=\"maknr3[]\" size=\"2\" value=\"0\" onKeyUp=\"calt()\" onFocus=\"calt()\" onBlur=\"calt()\">";

echo "&nbsp;";

echo "<input type=\"text\" id=\"maksr3\" name=\"maksr3[]\" size=\"2\" value=\"0\" onKeyUp=\"calt()\" onFocus=\"calt()\" onBlur=\"calt()\">";


echo "</font></td>";
 }


} 




}  // end of if else of rcount zero



echo "</tr>";

}  // end of loop nights




echo "</table>";


echo "</td></tr>" ;

echo "<tr><td>&nbsp;</td></tr>";

}  // end of if hotel





if($_POST["hotcb2"]==on){



for($i=0; $i<count($array_hotel_id); $i++){

if($s_hotelsoth==$array_hotel_id[$i]){
$s_hotelsoth_name = $array_hotel[$i];
$s_hotelsoth_city = $array_city[$i];
}

}


echo "<tr><td bgcolor=\"#FFDFDF\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";
echo "Hotel Name: <b>" . $s_hotelsoth_name . " - " . $s_hotelsoth_city;
echo "</b></font></td></tr>";

echo "<tr><td bgcolor=\"#FFDFDF\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";
echo "Check-In : <b>" . date('D jS M, Y', strtotime($othcin))  . "</b> ||  Check-Out: " . date('D jS M, Y', strtotime($othcout)) . " || No. of Nights: <b>" . $othn;
echo "</b></font></td></tr>";

echo "<tr><td bgcolor=\"#FFDFDF\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";
echo "View type: " . $s_viewt . "	||  " . "Meals: ";

for($m=0; $m<count($a_meals) ; $m++){ echo $a_meals[$m] ; }

echo "</font></td></tr>";

echo "<tr><td>";



echo "<table style=\"border: 1px solid red\" border=\"1\" width=\"100%\"> <tr><td bgcolor=\"#FFDFDF\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";

echo "Req. Night";

echo "</font></td>";



for($rt=0; $rt<count($as_rts); $rt++){
echo "<td bgcolor=\"#FFDFDF\" align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";
echo $as_rts[$rt];
echo "<br>";
echo "Net || Sell";
echo "</td>";
}

echo "</tr>";


$we_bull = 0;
for($n=0; $n<$othn; $n++){

echo "<tr><td bgcolor=\"#FFDFDF\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";




echo date('D jS M, y', mktime(0,0,0,$othcinm,$othcind+$n,$othciny));

echo "</font></td>";

$f_date = date('Y-m-d', mktime(0,0,0,$othcinm,$othcind+$n,$othciny));

$a_weekdays = array("Wed" , "Thu");

$query_g_rates ="select hotel_id,from_date,to_date," . $s_q1 . ", nationality, view_type,avialibility,avial_bool,allotment,breakfast,halfboard_rate,fullboard_rate,sahoor_rate,iftar_rate  from group_rates where hotel_id='$s_hotelsoth' and '$f_date' between from_date and to_date - interval '1 day' and view_type = '$s_viewt'";



$result_g_rates = pg_query($conn, $query_g_rates);

if (!$result_g_rates) {
	echo "An error occured.\n";
	exit;
	}

 $numroth = pg_num_rows($result_g_rates);

if($numroth>0){

while ($rows_g_rates = pg_fetch_array($result_g_rates)){


for($we=0; $we<count($a_weekdays); $we++){

if($a_weekdays[$we]==date('D', strtotime($f_date))){
$we_bull=1;
break;
}
else{
 $we_bull=0;
}

}



for($rt=0; $rt<count($as_rts); $rt++){



if($we_bull==0){


 if(trim($as_rts[$rt])=="Single"){


echo "<td align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";

echo "<input type=\"text\" id=\"otnr1\" name=\"otnr1[]\" size=\"2\" value=\" " . $rows_g_rates["weekd_net_r1"] . " \" onKeyUp=\"calt()\" onFocus=\"calt()\" onBlur=\"calt()\">";

echo "&nbsp;";

echo "<input type=\"text\" id=\"otsr1\" name=\"otsr1[]\" size=\"2\" value=\" " . $rows_g_rates["weekd_sell_r1"] . " \" onKeyUp=\"calt()\" onFocus=\"calt()\" onBlur=\"calt()\">";

echo "</font></td>";
 }



if(trim($as_rts[$rt])=="Double"){


echo "<td align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";

echo "<input type=\"text\" id=\"otnr2\" name=\"otnr2[]\" size=\"2\" value=\" " . $rows_g_rates["weekd_net_r2"] . " \" onKeyUp=\"calt()\" onFocus=\"calt()\" onBlur=\"calt()\">";

echo "&nbsp;";

echo "<input type=\"text\" id=\"otsr2\" name=\"otsr2[]\" size=\"2\" value=\" " . $rows_g_rates["weekd_sell_r2"] . " \" onKeyUp=\"calt()\" onFocus=\"calt()\" onBlur=\"calt()\">";


echo "</font></td>";
 }

 if(trim($as_rts[$rt])=="Triple"){


echo "<td align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";

echo "<input type=\"text\" id=\"otnr3\" name=\"otnr3[]\" size=\"2\" value=\" " . $rows_g_rates["weekd_net_r3"] . " \" onKeyUp=\"calt()\" onFocus=\"calt()\" onBlur=\"calt()\">";

echo "&nbsp;";

echo "<input type=\"text\" id=\"otsr3\" name=\"otsr3[]\" size=\"2\" value=\" " . $rows_g_rates["weekd_sell_r3"] . " \" onKeyUp=\"calt()\" onFocus=\"calt()\" onBlur=\"calt()\">";


echo "</font></td>";
 }


} // end of weend bull if
else{

 if(trim($as_rts[$rt])=="Single"){

 echo "<td align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";

echo "<input type=\"text\" id=\"otnr1\" name=\"otnr1[]\" size=\"2\" value=\" " . $rows_g_rates["weeke_net_r1"] . " \" onKeyUp=\"calt()\" onFocus=\"calt()\" onBlur=\"calt()\">";

echo "&nbsp;";

echo "<input type=\"text\" id=\"otsr1\" name=\"otsr1[]\" size=\"2\" value=\" " . $rows_g_rates["weeke_sell_r1"] . " \" onKeyUp=\"calt()\" onFocus=\"calt()\" onBlur=\"calt()\">";

echo "</font></td>";



  }


  if(trim($as_rts[$rt])=="Double"){
 echo "<td align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";

echo "<input type=\"text\" id=\"otnr2\" name=\"otnr2[]\" size=\"2\" value=\" " . $rows_g_rates["weeke_net_r2"] . " \" onKeyUp=\"calt()\" onFocus=\"calt()\" onBlur=\"calt()\">";

echo "&nbsp;";

echo "<input type=\"text\" id=\"otsr2\" name=\"otsr2[]\" size=\"2\" value=\" " . $rows_g_rates["weeke_sell_r2"] . " \" onKeyUp=\"calt()\" onFocus=\"calt()\" onBlur=\"calt()\">";

echo "</font></td>";

  }


if(trim($as_rts[$rt])=="Triple"){
 echo "<td align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";

echo "<input type=\"text\" id=\"otnr3\" name=\"otnr3[]\" size=\"2\" value=\" " . $rows_g_rates["weeke_net_r3"] . " \" onKeyUp=\"calt()\" onFocus=\"calt()\" onBlur=\"calt()\">";

echo "&nbsp;";

echo "<input type=\"text\" id=\"otsr3\" name=\"otsr3[]\" size=\"2\" value=\" " . $rows_g_rates["weeke_sell_r3"] . " \" onKeyUp=\"calt()\" onFocus=\"calt()\" onBlur=\"calt()\">";

echo "</font></td>";

  }



}  // end of weend bull else


} // end for roomtype


$rows_g_rates["breakfast"];
$rows_g_rates["halfboard_rate"];
$rows_g_rates["fullboard_rate"];
$rows_g_rates["sahoor_rate"];
$rows_g_rates["iftar_rate"];


} // end of resultset

pg_free_result($result_g_rates);



} // end of if rowcount

else {



for($rt=0; $rt<count($as_rts); $rt++){


 if(trim($as_rts[$rt])=="Single"){


echo "<td align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";

echo "<input type=\"text\" id=\"otnr1\" name=\"otnr1[]\" size=\"2\" value=\"0\" onKeyUp=\"calt()\" onFocus=\"calt()\" onBlur=\"calt()\">";

echo "&nbsp;";

echo "<input type=\"text\" id=\"otsr1\" name=\"otsr1[]\" size=\"2\" value=\"0\" onKeyUp=\"calt()\" onFocus=\"calt()\" onBlur=\"calt()\">";

echo "</font></td>";
 }



if(trim($as_rts[$rt])=="Double"){


echo "<td align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";

echo "<input type=\"text\" id=\"otnr2\" name=\"otnr2[]\" size=\"2\" value=\"0\" onKeyUp=\"calt()\" onFocus=\"calt()\" onBlur=\"calt()\">";

echo "&nbsp;";

echo "<input type=\"text\" id=\"otsr2\" name=\"otsr2\" size=\"2\" value=\"0\" onKeyUp=\"calt()\" onFocus=\"calt()\" onBlur=\"calt()\">";


echo "</font></td>";
 }

 if(trim($as_rts[$rt])=="Triple"){


echo "<td align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";

echo "<input type=\"text\" id=\"otnr3\" name=\"otnr3[]\" size=\"2\" value=\"0\" onKeyUp=\"calt()\" onFocus=\"calt()\" onBlur=\"calt()\">";

echo "&nbsp;";

echo "<input type=\"text\" id=\"otsr3\" name=\"otsr3[]\" size=\"2\" value=\"0\" onKeyUp=\"calt()\" onFocus=\"calt()\" onBlur=\"calt()\">";


echo "</font></td>";
 }


} 




}  // end of if else of rcount zero

echo "</tr>";





}  // end of loop nights




echo "</table>";

echo "</td></tr>" ;
echo "<tr><td>&nbsp</td></tr>";
}  // end of if hotel







if($_POST["trans0"]==on){

echo "<tr><td>" ;  // trans start



echo "<table style=\"border: 1px solid #673636\" border=\"1\" width=\"100%\" ><tr><td  bgcolor=\"#E8D2D2\" colspan=\"6\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><b>Transportation</b></font></td></tr>";

$transd = $_POST['d3Day'];
$transm = $_POST['d3Month'];
$transy = $_POST['d3Year'];



$transh = $_POST['timeselecthours'];
$transmin = $_POST['timeselectmin'];

$transreq  = date('Y-m-d h:i', mktime($transh,$transmin,0,$transm,$transd,$transy));

 $transh;
 $transmin;

 $trans_s = $_POST['s_trans'];

 $trans_f2t = $_POST['f2t'];

 $trans_toft = $_POST['typeoftrans'];

 $trans_fd = $_POST['flightdet'];

 $trans_nu = $_POST['noofu'];

echo "<tr><td bgcolor=\"#E8D2D2\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">From - To</font></td><td bgcolor=\"#E8D2D2\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">Units</font></td><td bgcolor=\"#E8D2D2\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">Type</font></td><td bgcolor=\"#E8D2D2\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">Request Date</font></td><td bgcolor=\"#E8D2D2\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">Price</font></td></tr>";

echo "<tr><td bgcolor=\"#E8D2D2\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">$trans_f2t</font></td><td><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">$trans_nu</font></td><td><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">$trans_toft</font></td><td><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">" . date('D jS M, Y H:i A', strtotime($transreq)) . "</font></td><td><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><input type=\"text\" id=\"transrn\" name=\"transrn\" size=\"2\" value=\"0\" onKeyUp=\"calt()\" onFocus=\"calt()\" onBlur=\"calt()\" >&nbsp;<input type=\"text\" id=\"transr\" name=\"transr\" size=\"2\" value=\"0\" onKeyUp=\"calt()\" onFocus=\"calt()\" onBlur=\"calt()\"></font></td></tr></table>";

echo "</td></tr>";  // trans end
echo "<tr><td>&nbsp</td></tr>";
}

if($_POST["visa0"]==on){


echo "<tr><td>";
echo "<table style=\"border: 1px solid #FF8000\" border=\"1\" width=\"100%\" ><tr><td bgcolor=\"#FFE4CA\" colspan=\"6\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><b>Visa</b></font></td></tr>";

$visad = $_POST['d4Day'];
$visam = $_POST['d4Month'];
$visay = $_POST['d4Year'];




$visareq  = date('Y-m-d h:i', mktime(0,0,0,$visam,$visad,$visay));


echo "<tr><td bgcolor=\"#FFE4CA\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">Visa Request Date</font></td><td bgcolor=\"#FFE4CA\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">paxs</font></td><td bgcolor=\"#FFE4CA\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">Net Rate</font></td><td bgcolor=\"#FFE4CA\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">Selling Rate</font></td></tr>";

echo "<tr><td bgcolor=\"#FFE4CA\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">" . date('D jS M, Y ', strtotime($visareq)) . "</font></td><td><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">per pax</font></td><td><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><input type=\"text\" id=\"vnet\" name=\"vnet\" size=\"2\" value=\"75\" onKeyUp=\"calt()\" onFocus=\"calt()\" onBlur=\"calt()\"></font></td><td><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><input type=\"text\" id=\"vsell\" name=\"vsell\" size=\"2\" value=\"120\" onKeyUp=\"calt()\" onFocus=\"calt()\" onBlur=\"calt()\"></font></td></tr>";
echo "</table>";
echo "</td></tr>";  // trans end


echo "<tr><td>&nbsp</td></tr>";
}

if($_POST["servicec"]==on){


echo "<tr><td >";
echo "<table style=\"border: 1px solid #FF8000\" border=\"1\" width=\"100%\" ><tr><td bgcolor=\"#FFE4CA\" colspan=\"6\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><b>Service Charges</b></font></td></tr>";



echo "<tr><td bgcolor=\"#FFE4CA\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">Service Charge</font></td><td bgcolor=\"#FFE4CA\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">Net Rate / pax </font></td><td bgcolor=\"#FFE4CA\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">Selling Rate / pax</font></td></tr>";

echo "<tr><td bgcolor=\"#FFE4CA\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">Service Charges per pax</font></td><td><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><input type=\"text\" id=\"scnet\" name=\"scnet\" size=\"2\" value=\"0\" onKeyUp=\"calt()\" onFocus=\"calt()\" onBlur=\"calt()\"></font></td><td><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><input type=\"text\" id=\"scsell\" name=\"scsell\" size=\"2\" value=\"0\" onKeyUp=\"calt()\" onFocus=\"calt()\" onBlur=\"calt()\"></font></td></tr>";
echo "</table>";
echo "</td></tr>";  
echo "<tr><td>&nbsp</td></tr>";
}

if($_POST["others0"]==on){


echo "<tr><td>";
echo "<table style=\"border: 1px solid #FF8000\" border=\"1\" width=\"100%\" ><tr><td bgcolor=\"#FFE4CA\" colspan=\"6\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><b>Extra Requests 1</b></font></td></tr>";



echo "<tr><td bgcolor=\"#FFE4CA\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">Request Paticulars</font></td><td bgcolor=\"#FFE4CA\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">Req Date</font></td><td bgcolor=\"#FFE4CA\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">Net Rate / pax</font></td><td bgcolor=\"#FFE4CA\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">Selling Rate / pax</font></td></tr>";

echo "<tr><td bgcolor=\"#FFE4CA\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><input type=\"text\" id=\"ex1pat\" name=\"ex1pat\" size=\"25\" ></font></td><td><select name=\"dDay\" class=\"selBox\" ></select><select name=\"dMonth\" class=\"selBox\"></select><select name=\"dYear\" class=\"selBox\"></select></td><td><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><input type=\"text\" id=\"ex1net\" name=\"ex1net\" size=\"2\" value=\"0\" onKeyUp=\"calt()\" onFocus=\"calt()\" onBlur=\"calt()\"></font></td><td><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><input type=\"text\" id=\"ex1sell\" name=\"ex1sell\" size=\"2\" value=\"0\" onKeyUp=\"calt()\" onFocus=\"calt()\" onBlur=\"calt()\"></font></td></tr>";



echo "</table>";
echo "</td></tr>";  // trans end

echo "<tr><td>&nbsp</td></tr>";
}


if($_POST["others1"]==on){


echo "<tr><td>";
echo "<table style=\"border: 1px solid #FF8000\" border=\"1\" width=\"100%\" ><tr><td bgcolor=\"#FFE4CA\" colspan=\"6\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><b>Extra Requests 2</b></font></td></tr>";



echo "<tr><td bgcolor=\"#FFE4CA\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">Request Paticulars</font></td><td bgcolor=\"#FFE4CA\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">Req Date</font></td><td bgcolor=\"#FFE4CA\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">Net Rate / pax</font></td><td bgcolor=\"#FFE4CA\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">Selling Rate / pax</font></td></tr>";

echo "<tr><td bgcolor=\"#FFE4CA\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><input type=\"text\" id=\"ex1pat\" name=\"ex1pat\" size=\"25\" ></font></td><td><select name=\"d1Day\" class=\"selBox\" ></select><select name=\"d1Month\" class=\"selBox\"></select><select name=\"d1Year\" class=\"selBox\"></select></td><td><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><input type=\"text\" id=\"ex2net\" name=\"ex2net\" size=\"2\" value=\"0\" onKeyUp=\"calt()\" onFocus=\"calt()\" onBlur=\"calt()\"></font></td><td><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><input type=\"text\" id=\"ex2sell\" name=\"ex2sell\" size=\"2\" value=\"0\" onKeyUp=\"calt()\" onFocus=\"calt()\" onBlur=\"calt()\"></font></td></tr>";



echo "</table>";
echo "</td></tr>";  // trans end

echo "<tr><td>&nbsp</td></tr>";
}


if($_POST["others2"]==on){


echo "<tr><td>";
echo "<table style=\"border: 1px solid #FF8000\" border=\"1\" width=\"100%\" ><tr><td bgcolor=\"#FFE4CA\" colspan=\"6\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><b>Extra Requests 3</b></font></td></tr>";



echo "<tr><td bgcolor=\"#FFE4CA\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">Request Paticulars</font></td><td bgcolor=\"#FFE4CA\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">Req Date</font></td><td bgcolor=\"#FFE4CA\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">Net Rate / pax</font></td><td bgcolor=\"#FFE4CA\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">Selling Rate / pax</font></td></tr>";

echo "<tr><td bgcolor=\"#FFE4CA\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><input type=\"text\" id=\"ex1pat\" name=\"ex1pat\" size=\"25\" ></font></td><td><select name=\"d2Day\" class=\"selBox\" ></select><select name=\"d2Month\" class=\"selBox\"></select><select name=\"d2Year\" class=\"selBox\"></select></td><td><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><input type=\"text\" id=\"ex3net\" name=\"ex3net\" size=\"2\" value=\"0\" onKeyUp=\"calt()\" onFocus=\"calt()\" onBlur=\"calt()\"></font></td><td><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><input type=\"text\" id=\"ex3sell\" name=\"ex3sell\" size=\"2\" value=\"0\" onKeyUp=\"calt()\" onFocus=\"calt()\" onBlur=\"calt()\"></font></td></tr>";



echo "</table>";
echo "</td></tr>";  // trans end

echo "<tr><td>&nbsp</td></tr>";
}


echo "<tr><td><table width=\"100%\" border=\"1\"><tr>";

$as_rts1 = explode(",", $s_rts1);

for($fp=0; $fp<count($srooms); $fp++){

echo "<td align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">Pax in $as_rts1[$fp]: <br><input type=\"text\" id=\"finalpn$srooms[$fp]\" name=\"finalpn$srooms[$fp]\" size=\"2\" value=\"0\" readonly> <input type=\"text\" id=\"finalp$srooms[$fp]\" name=\"finalp$srooms[$fp]\" size=\"2\" value=\"0\" readonly>SAR</font></td>";

}
echo "</tr></table></td></tr>";

echo "<tr><td align=\"center\">";

echo "<font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">1 USD = <input type=\"text\" id=\"usdr\" name=\"usdr\" size=\"2\" value=\"3.75\" onKeyUp=\"calt()\" onFocus=\"calt()\" onBlur=\"calt()\"> Riyals";

echo "</font></td></tr>";


echo "<tr><td><table width=\"100%\" border=\"1\"><tr>";

$as_rts1 = explode(",", $s_rts1);

for($fp=0; $fp<count($srooms); $fp++){

echo "<td align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">Pax in $as_rts1[$fp]: <br><input type=\"text\" id=\"finalpnusd$srooms[$fp]\" name=\"finalpnusd$srooms[$fp]\" size=\"2\" value=\"0\" readonly > <input type=\"text\" id=\"finalpusd$srooms[$fp]\" name=\"finalpusd$srooms[$fp]\" size=\"2\" value=\"0\" readonly>USD</font></td>";

}
echo "</tr></table></td></tr>";



?>

<script>

function calt(){
 var rooms = new Array('<? $x=0; echo count($srooms) ?>');
'<? for($xx=0; $xx<count($srooms); $xx++){ ?>'

//var sn = document.roomselput.madnr1.length;
var totnet = 0;
var totnetmad = 0;
var totnetmak = 0;
var totnetot = 0;

var totsell = 0;
var totsellmad = 0;
var totsellmak = 0;
var totsellot = 0;

var transn = 0;
var trans = 0;

var visan = 0;
var visa = 0; 

var scnet = 0;
var scsell = 0;

var ex1net =0;
var ex1sell =0;

var ex2net =0;
var ex2sell =0;

var ex3net =0;
var ex3sell =0;

for(x=0; x<document.roomselput.madnr<? echo $srooms[$xx] ; ?>.length; x++){
totnetmad = totnetmad + parseFloat(document.roomselput.madnr<? echo $srooms[$xx] ; ?>[x].value) ;
}

for(y=0; y<document.roomselput.maknr<? echo $srooms[$xx] ; ?>.length; y++){
totnetmak = totnetmak + parseFloat(document.roomselput.maknr<? echo $srooms[$xx] ; ?>[y].value) ;
}

for(z=0; z<document.roomselput.otnr<? echo $srooms[$xx] ; ?>.length; z++){
totnetot = totnetot + parseFloat(document.roomselput.otnr<? echo $srooms[$xx] ; ?>[z].value) ;
}



totnet = (totnetmad + totnetmak + totnetot)/'<? echo $srooms[$xx] ; ?>';

alert(document.getElementById("transrn").value);

//if(document.getElementById('transrn').value != "undefined"){
//transn = parseFloat(document.getElementById('transrn').value/<? echo $s_npaxs ; ?>); 

totnet = totnet + transn; 
}

visan = parseFloat(document.getElementById('vnet').value); 
totnet = totnet + visan; 
scnet = parseFloat(document.getElementById('scnet').value);
totnet = totnet + scnet; 
ex1net = parseFloat(document.getElementById('ex1net').value);
totnet = totnet + ex1net; 
ex2net = parseFloat(document.getElementById('ex2net').value);
totnet = totnet + ex2net; 
ex3net = parseFloat(document.getElementById('ex3net').value);
totnet = totnet + ex3net; 



for(x=0; x<document.roomselput.madsr<? echo $srooms[$xx] ; ?>.length; x++){
totsellmad = totsellmad + parseFloat(document.roomselput.madsr<? echo $srooms[$xx] ; ?>[x].value) ;
}

for(y=0; y<document.roomselput.maksr<? echo $srooms[$xx] ; ?>.length; y++){
totsellmak = totsellmak + parseFloat(document.roomselput.maksr<? echo $srooms[$xx] ; ?>[y].value) ;
}

for(z=0; z<document.roomselput.otsr<? echo $srooms[$xx] ; ?>.length; z++){
totsellot = totsellot + parseFloat(document.roomselput.otsr<? echo $srooms[$xx] ; ?>[z].value) ;
}



totsell = (totsellmad + totsellmak + totsellot)/'<? echo $srooms[$xx] ; ?>';

visa = parseFloat(document.getElementById('vsell').value); 
totsell = totsell  + visa ;
trans = parseFloat(document.getElementById('transr').value/<? echo $s_npaxs ; ?>); 
totsell = totsell  + trans ;
scsell = parseFloat(document.getElementById('scsell').value);
totsell = totsell  + scsell ;
ex1sell = parseFloat(document.getElementById('ex1sell').value);
totsell = totsell  + ex1sell ;
ex2sell = parseFloat(document.getElementById('ex2sell').value);
totsell = totsell  + ex2sell ;
ex3sell = parseFloat(document.getElementById('ex3sell').value);
totsell = totsell  + ex3sell ;


document.getElementById('finalpn<? echo $srooms[$xx] ; ?>').value = Math.ceil(totnet);

document.getElementById('finalp<? echo $srooms[$xx] ; ?>').value = Math.ceil(totsell);

document.getElementById('finalpnusd<? echo $srooms[$xx] ; ?>').value = Math.ceil(totnet/document.getElementById('usdr').value);

document.getElementById('finalpusd<? echo $srooms[$xx] ; ?>').value = Math.ceil(totsell/document.getElementById('usdr').value);


'<?}?>'	
 

}
calt();
</script>

<?

echo "<tr><td align=\"right\"><input type=\"submit\" name=\"submitf\" value=\"Make Quotation >>>\"></td></tr>";

echo "</form></table>";






?>





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
	var dvm = <?php echo $vm; ?>; if (dvm==0) dvm=tdddate.getMonth()
	var dnd = <?php echo $vd; ?>; if (dnd==0) dnd=tdddate.getDate()

   if (dvy < 2000) dvy += 1900;	


	var now_date = new Date(dvy,dvm,dnd);
	var now_day = now_date.getDate();
	var now_month = now_date.getMonth();

	var now_year = now_date.getYear();

	var dvy1 = <?php echo $vy1; ?>; if (dvy1==0) dvy1=tdddate.getYear()
	var dvm1 = <?php echo $vm1; ?>; if (dvm1==0) dvm1=tdddate.getMonth()
	var dnd1 = <?php echo $vd1; ?>; if (dnd1==0) dnd1=tdddate.getDate()

    if (dvy1 < 2000) dvy1 += 1900;


	var now_date1 = new Date(dvy1,dvm1,dnd1);
	var now_day1 = now_date1.getDate();
	var now_month1 = now_date1.getMonth();

	var now_year1 = now_date1.getYear();


	var dvy2 = <?php echo $vy2; ?>; if (dvy2==0) dvy2=tdddate.getYear()
	var dvm2 = <?php echo $vm2; ?>; if (dvm2==0) dvm2=tdddate.getMonth()
	var dnd2 = <?php echo $vd2; ?>; if (dnd2==0) dnd2=tdddate.getDate()

    if (dvy2 < 2000) dvy2 += 1900;


	var now_date2 = new Date(dvy2,dvm2,dnd2);
	var now_day2 = now_date2.getDate();
	var now_month2 = now_date2.getMonth();

	var now_year2 = now_date2.getYear();




	var d1 = new dateObj(document.roomselput.dDay, document.roomselput.dMonth, document.roomselput.dYear);
	initDates(dvy-1, dvy+1, dvy, now_month, now_day, d1);

   	var d2 = new dateObj(document.roomselput.d1Day, document.roomselput.d1Month, document.roomselput.d1Year);
	initDates(dvy1-1, dvy1+1, dvy1, now_month1, now_day1, d2);

 	var d3 = new dateObj(document.roomselput.d2Day, document.roomselput.d2Month, document.roomselput.d2Year);
	initDates(dvy2, dvy2+1, dvy2, now_month2, now_day2, d3);
	
 

</script>




</body>				
</html>
