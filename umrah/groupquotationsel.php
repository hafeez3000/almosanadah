<?
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
session_cache_limiter('must-revalidate');
include ("header.php");
$vy=$vm=$vd=0;
$vy1=$vm1=$vd1=0;
$vy2=$vm2=$vd2=0;

?>
<script src="../javascripts/cBoxes.js"></script>
<script>
document.title= '<? echo $company_name . " ERP - Umrah - Individual / Group  Quotation"; ?>';

</script>

<html>

<body leftmargin="0" topmargin="0" rightmargin="0" >
<table width="100%" border="0" cellpadding="0" cellspacing="0" style="border-bottom: 1px solid #999999 ;border-left: 3px solid #006600;border-right: 3px solid #006600"><tr>
    <td bgcolor="#CCCCCC"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">&nbsp;You 
      are here: <a href="uhome.php">Home</a> &raquo; <a href="#">Quotations</a> 
      &raquo; Individual / Group Quotation Select</font></td>
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
                      <td bgcolor="#CCCCCC"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"> <strong>Individual / Group Quotation Select</strong></font></td>
                    </tr></table>
<table width="100%" cellpadding="1" cellspacing="0"><tr>
                      <td> 
                          <table width="100%" border="0" cellspacing="0" cellpadding="1" align="center">

<?               
 
 $s_npaxs = $_POST["npaxs"];



if($s_npaxs>=25){
 $qtableingr = "group_rates";
}
else {
 $qtableingr = "ind_rates";

}


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



$_SESSION['madhotid'] = $s_hotelsmad;

$_SESSION['madcin'] =   $madcin ;

$_SESSION['madcind'] = $_POST['dDay'];
$_SESSION['madcinm'] = $_POST['dMonth'];
$_SESSION['madciny'] = $_POST['dYear'];

$_SESSION['madcout'] =  $madcout ;


}

if($_POST["hotcb1"]==on){

 $s_hotelsmak =  $_POST["hotelsmak"];


$makcind = $_POST['d1Day'];
$makcinm = $_POST['d1Month'];
$makciny = $_POST['d1Year'];

 $makcin = $makciny ."-". $makcinm ."-". $makcind ; 

 $makn = $_POST["makn"];

 $makcout = date('Y-m-d', mktime(0,0,0,$makcinm,$makcind+$makn,$makciny));




$_SESSION['makhotid'] = $s_hotelsmak;

$_SESSION['makcin'] =   $makcin ;

$_SESSION['makcind'] = $_POST['d1Day'];
$_SESSION['makcinm'] = $_POST['d1Month'];
$_SESSION['makciny'] = $_POST['d1Year'];

$_SESSION['makcout'] =  $makcout ;



}

if($_POST["hotcb2"]==on){

$s_hotelsoth = $_POST["hotelsoth"];

$othcind = $_POST['d2Day'];
$othcinm = $_POST['d2Month'];
$othciny = $_POST['d2Year'];

 $othcin = $othciny ."-". $othcinm ."-". $othcind ; 


$othn = $_POST["othn"];

$othcout = date('Y-m-d', mktime(0,0,0,$othcinm,$othcind+$othn,$othciny));

$_SESSION['othotid'] = $s_hotelsoth;

$_SESSION['otcin'] =   $othcin ;

$_SESSION['otcind'] = $_POST['d2Day'];
$_SESSION['otcinm'] = $_POST['d2Month'];
$_SESSION['otciny'] = $_POST['d2Year'];

$_SESSION['otcout'] =  $othcout ;

}

 $_POST["trans0"];

 $_POST["visa0"];

 $_POST["others0"];

 $_POST["others1"];

 $_POST["others2"];

  

$s_agentname = "";
$s_country = "";




$_SESSION['ses_npaxs'] = $s_npaxs;
$_SESSION['s_meals'] = $_POST["meals"];
$_SESSION['madn'] = $madn;
$_SESSION['makn'] = $makn;
$_SESSION['othn'] = $othn;
$_SESSION['madbull'] = $_POST["hotcb0"];
$_SESSION['makbull'] = $_POST["hotcb1"];
$_SESSION['otbull'] = $_POST["hotcb2"];
$_SESSION['transbull'] = $_POST["trans0"];
$_SESSION['visabull'] = $_POST["visa0"];
$_SESSION['servicebull'] = $_POST["servicec"];
$_SESSION['ot1bull'] = $_POST["others0"];
$_SESSION['ot2bull'] = $_POST["others1"];
$_SESSION['ot3bull'] = $_POST["others2"];


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

$_SESSION['s_rooms'] = $srooms;

$sa_q1 = array();
$s_q1 = "";




for($rcf=0; $rcf<count($srooms); $rcf++){
$srooms[$rcf];
$s_q1 = $s_q1 . "," . "weekd_net_r" . $srooms[$rcf] . "," . "weekd_sell_r" . $srooms[$rcf] . "," . "weeke_net_r" . $srooms[$rcf] . ", " . "weeke_sell_r" . $srooms[$rcf] ;
}

$s_q1 = trim(substr($s_q1, 1, strlen($s_q1)));



echo "<table width=\"100%\" border=\"1\" cellpadding=\"1\" cellspacing=\"0\"><form name=\"roomselput\" method=\"post\" action=\"makequotation.php\">";

echo "<tr><td><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">Group of Paxs: <b>$s_npaxs</b></font></td></tr>";

for($i=0; $i<count($array_acccode); $i++){

if($s_agentcode==$array_acccode[$i]){
$s_agentname = $array_aname[$i];
$s_country = $array_country[$i];
$s_acode = $s_agentcode;
}

}

$s_countryu = ucfirst(strtolower($s_country)); 

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

for($m=0; $m<count($a_meals) ; $m++){ echo $a_meals[$m] .","; }

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

if(count($a_meals)){ 
echo "<td bgcolor=\"#EAFFEA\" align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";
echo "Meals";
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

$query_g_nc ="select hotel_id,from_date,to_date," . $s_q1 . ", nationality, view_type,avialibility,avial_bool,allotment,breakfast,halfboard_rate,fullboard_rate,sahoor_rate,iftar_rate  from $qtableingr where hotel_id='$s_hotelsmad' and '$f_date' between from_date and to_date - interval '1 day' and view_type = '$s_viewt' and nationalityl like '%$s_countryu%'  ";

$result_g_nc = pg_query($conn, $query_g_nc);

if (!$result_g_nc) {
	echo "An error occured.\n";
	exit;
	}

  $numrmak_nc = pg_num_rows($result_g_nc);

if($numrmak_nc==0){
$s_countryu = "All";
}

$query_g_rates ="select hotel_id,from_date,to_date," . $s_q1 . ", nationality, view_type,avialibility,avial_bool,allotment,breakfast,halfboard_rate,fullboard_rate,sahoor_rate,iftar_rate  from $qtableingr where hotel_id='$s_hotelsmad' and '$f_date' between from_date and to_date - interval '1 day' and view_type = '$s_viewt' and nationalityl like '%$s_countryu%' ";



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

echo "<input type=\"text\" id=\"madnr1\" name=\"madnr1[]\" size=\"2\" value=\"". $rows_g_rates["weekd_net_r1"] ."\"  onKeyUp=\"calt()\" onFocus=\"calt()\" onBlur=\"calt()\">";

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

if(count($a_meals)){   // meals if true

echo "<td align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";

echo "<table width=\"100%\" border=\"1\"><tr>";

for($m=0; $m<count($a_meals) ; $m++){ 
	
	if($a_meals[$m]=="breakfast"){
	echo "<td align=\"center\"  ><font size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\">B/F</td>" ; 
    }  
    if($a_meals[$m]=="halfboard"){
	echo "<td align=\"center\"><font size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\">H/B</td>" ; 
    }
	if($a_meals[$m]=="fullboard"){
	echo "<td align=\"center\"><font size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\">F/B</td>" ; 
    }
	if($a_meals[$m]=="sahoor"){
	echo "<td align=\"center\"><font size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\">SAH</td>" ; 
    }
	if($a_meals[$m]=="iftar"){
	echo "<td align=\"center\"><font size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\">IFT</td>" ; 
    }
	
	}

echo "</tr><tr>";

for($m=0; $m<count($a_meals) ; $m++){ 
	
	if($a_meals[$m]=="breakfast"){
	
	if($rows_g_rates["breakfast"]=="Included"){
	echo "<td align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><input type=\"text\" id=\"madbf\" name=\"madbf[]\" size=\"1\" value=\" INC \" onKeyUp=\"calt()\" onFocus=\"calt()\" onBlur=\"calt()\"></td>" ; 
    }

	else if($rows_g_rates["breakfast"]=="Not Available"){
	echo "<td align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><input type=\"text\" id=\"madbf\" name=\"madbf[]\" size=\"1\" value=\" NA \" onKeyUp=\"calt()\" onFocus=\"calt()\" onBlur=\"calt()\"></td>" ;
    }
	
	else{
	echo "<td align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><input type=\"text\" id=\"madbf\" name=\"madbf[]\" size=\"1\" value=\" ". $rows_g_rates["breakfast"] ." \" onKeyUp=\"calt()\" onFocus=\"calt()\" onBlur=\"calt()\"></td>" ;
    }

    }  



    if($a_meals[$m]=="halfboard"){

	if($rows_g_rates["halfboard_rate"]=="Included"){
	echo "<td align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><input type=\"text\" id=\"madhb\" name=\"madhb[]\" size=\"1\" value=\" INC \" onKeyUp=\"calt()\" onFocus=\"calt()\" onBlur=\"calt()\"></td>" ; 
    }

	else if($rows_g_rates["halfboard_rate"]=="Not Available"){
	echo "<td align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><input type=\"text\" id=\"madhb\" name=\"madhb[]\" size=\"1\" value=\" NA \" onKeyUp=\"calt()\" onFocus=\"calt()\" onBlur=\"calt()\"></td>" ;
    }
	
	else{
	echo "<td align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><input type=\"text\" id=\"madhb\" name=\"madhb[]\" size=\"1\" value=\" ". $rows_g_rates["halfboard_rate"] ." \" onKeyUp=\"calt()\" onFocus=\"calt()\" onBlur=\"calt()\"></td>" ;
    }
	
	}
	
	
	if($a_meals[$m]=="fullboard"){
	
	if($rows_g_rates["fullboard_rate"]=="Included"){
	echo "<td align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><input type=\"text\" id=\"madfb\" name=\"madfb[]\" size=\"1\" value=\" INC \" onKeyUp=\"calt()\" onFocus=\"calt()\" onBlur=\"calt()\"></td>" ; 
    }

	else if($rows_g_rates["fullboard_rate"]=="Not Available"){
	echo "<td align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><input type=\"text\" id=\"madfb\" name=\"madfb[]\" size=\"1\" value=\" NA \" onKeyUp=\"calt()\" onFocus=\"calt()\" onBlur=\"calt()\"></td>" ;
    }
	
	else{
	echo "<td align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><input type=\"text\" id=\"madfb\" name=\"madfb[]\" size=\"1\" value=\" ". $rows_g_rates["fullboard_rate"] ." \" onKeyUp=\"calt()\" onFocus=\"calt()\" onBlur=\"calt()\"></td>" ;
    }
    
	}
	
	
	if($a_meals[$m]=="sahoor"){

	if($rows_g_rates["sahoor_rate"]=="Included"){
	echo "<td align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><input type=\"text\" id=\"madsahoor\" name=\"madsahoor[]\" size=\"1\" value=\" INC \" onKeyUp=\"calt()\" onFocus=\"calt()\" onBlur=\"calt()\"></td>" ; 
    }

	else if($rows_g_rates["sahoor_rate"]=="Not Available"){
	echo "<td align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><input type=\"text\" id=\"madsahoor\" name=\"madsahoor[]\" size=\"1\" value=\" NA \" onKeyUp=\"calt()\" onFocus=\"calt()\" onBlur=\"calt()\"></td>" ;
    }
	
	else{
	echo "<td align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><input type=\"text\" id=\"madsahoor\" name=\"madsahoor[]\" size=\"1\" value=\" ". $rows_g_rates["sahoor_rate"] ." \" onKeyUp=\"calt()\" onFocus=\"calt()\" onBlur=\"calt()\"></td>" ;
    }

    
	}

	if($a_meals[$m]=="iftar"){
	
		if($rows_g_rates["iftar_rate"]=="Included"){
	echo "<td align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><input type=\"text\" id=\"madiftar\" name=\"madiftar[]\" size=\"1\" value=\" INC \" onKeyUp=\"calt()\" onFocus=\"calt()\" onBlur=\"calt()\"></td>" ; 
    }

	else if($rows_g_rates["iftar_rate"]=="Not Available"){
	echo "<td align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><input type=\"text\" id=\"madiftar\" name=\"madiftar[]\" size=\"1\" value=\" NA \" onKeyUp=\"calt()\" onFocus=\"calt()\" onBlur=\"calt()\"></td>" ;
    }
	
	else{
	echo "<td align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><input type=\"text\" id=\"madiftar\" name=\"madiftar[]\" size=\"1\" value=\" ". $rows_g_rates["iftar_rate"] ." \" onKeyUp=\"calt()\" onFocus=\"calt()\" onBlur=\"calt()\"></td>" ;
    }
    
	}
	
	}


echo "</tr></table>";




echo "</font></td>";
	
} //end meals if




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


}  // end of else


if(count($a_meals)){   // meals if true

echo "<td align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";

echo "<table width=\"100%\" border=\"1\"><tr>";

for($m=0; $m<count($a_meals) ; $m++){ 
	
	if($a_meals[$m]=="breakfast"){
	echo "<td align=\"center\"  ><font size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\">B/F</td>" ; 
    }  
    if($a_meals[$m]=="halfboard"){
	echo "<td align=\"center\"><font size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\">H/B</td>" ; 
    }
	if($a_meals[$m]=="fullboard"){
	echo "<td align=\"center\"><font size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\">F/B</td>" ; 
    }
	if($a_meals[$m]=="sahoor"){
	echo "<td align=\"center\"><font size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\">SAH</td>" ; 
    }
	if($a_meals[$m]=="iftar"){
	echo "<td align=\"center\"><font size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\">IFT</td>" ; 
    }
	
	}

echo "</tr><tr>";

for($m=0; $m<count($a_meals) ; $m++){ 
	
	if($a_meals[$m]=="breakfast"){
	
	echo "<td align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><input type=\"text\" id=\"madbf\" name=\"madbf[]\" size=\"1\" value=\"NA\" onKeyUp=\"calt()\" onFocus=\"calt()\" onBlur=\"calt()\"></td>" ;

    }  



    if($a_meals[$m]=="halfboard"){

	echo "<td align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><input type=\"text\" id=\"madhb\" name=\"madhb[]\" size=\"1\" value=\"NA\" onKeyUp=\"calt()\" onFocus=\"calt()\" onBlur=\"calt()\"></td>" ;
	
	}
	
	
	if($a_meals[$m]=="fullboard"){
	
	echo "<td align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><input type=\"text\" id=\"madfb\" name=\"madfb[]\" size=\"1\" value=\"NA\" onKeyUp=\"calt()\" onFocus=\"calt()\" onBlur=\"calt()\"></td>" ;

    
	}
	
	
	if($a_meals[$m]=="sahoor"){

	echo "<td align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><input type=\"text\" id=\"madsahoor\" name=\"madsahoor[]\" size=\"1\" value=\"NA\" onKeyUp=\"calt()\" onFocus=\"calt()\" onBlur=\"calt()\"></td>" ;
    }

    


	if($a_meals[$m]=="iftar"){
	
	echo "<td align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><input type=\"text\" id=\"madiftar\" name=\"madiftar[]\" size=\"1\" value=\"NA\" onKeyUp=\"calt()\" onFocus=\"calt()\" onBlur=\"calt()\"></td>" ;

    
	}
	
	}


echo "</tr></table>";




echo "</font></td>";
	
} //end meals if






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
echo "View type: " . $s_viewt . "	||  " . "Meals: " ;

for($m=0; $m<count($a_meals) ; $m++){ echo $a_meals[$m] . ","; }

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

if(count($a_meals)){ 
echo "<td bgcolor=\"#D5D5FF\" align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";
echo "Meals";
echo "</td>";
}


echo "</tr>";

$s_countryu;

$we_bull = 0;
for($n=0; $n<$makn; $n++){

echo "<tr><td bgcolor=\"#D5D5FF\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";


//echo date('jS M, Y', strtotime($makdcin));

echo date('D jS M, y', mktime(0,0,0,$makcinm,$makcind+$n,$makciny));

echo "</font></td>";

$f_date = date('Y-m-d', mktime(0,0,0,$makcinm,$makcind+$n,$makciny));

$a_weekdays = array("Wed" , "Thu");


$query_g_nc ="select hotel_id,from_date,to_date," . $s_q1 . ", nationality, view_type,avialibility,avial_bool,allotment,breakfast,halfboard_rate,fullboard_rate,sahoor_rate,iftar_rate  from $qtableingr where hotel_id='$s_hotelsmak' and '$f_date' between from_date and to_date - interval '1 day' and view_type = '$s_viewt' and nationalityl like '%$s_countryu%'  ";

$result_g_nc = pg_query($conn, $query_g_nc);

if (!$result_g_nc) {
	echo "An error occured.\n";
	exit;
	}

  $numrmak_nc = pg_num_rows($result_g_nc);

if($numrmak_nc==0){
$s_countryu = "All";
}


$query_g_rates ="select hotel_id,from_date,to_date," . $s_q1 . ", nationality, view_type,avialibility,avial_bool,allotment,breakfast,halfboard_rate,fullboard_rate,sahoor_rate,iftar_rate  from $qtableingr where hotel_id='$s_hotelsmak' and '$f_date' between from_date and to_date - interval '1 day' and view_type = '$s_viewt' and nationalityl like '%$s_countryu%'  ";



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


if(count($a_meals)){   // meals if true

echo "<td align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";

echo "<table width=\"100%\" border=\"1\"><tr>";

for($m=0; $m<count($a_meals) ; $m++){ 
	
	if($a_meals[$m]=="breakfast"){
	echo "<td align=\"center\"  ><font size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\">B/F</td>" ; 
    }  
    if($a_meals[$m]=="halfboard"){
	echo "<td align=\"center\"><font size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\">H/B</td>" ; 
    }
	if($a_meals[$m]=="fullboard"){
	echo "<td align=\"center\"><font size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\">F/B</td>" ; 
    }
	if($a_meals[$m]=="sahoor"){
	echo "<td align=\"center\"><font size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\">SAH</td>" ; 
    }
	if($a_meals[$m]=="iftar"){
	echo "<td align=\"center\"><font size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\">IFT</td>" ; 
    }
	
	}

echo "</tr><tr>";

for($m=0; $m<count($a_meals) ; $m++){ 
	
	if($a_meals[$m]=="breakfast"){
	
	if($rows_g_rates["breakfast"]=="Included"){
	echo "<td align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><input type=\"text\" id=\"makbf\" name=\"makbf[]\" size=\"1\" value=\" INC \" onKeyUp=\"calt()\" onFocus=\"calt()\" onBlur=\"calt()\"></td>" ; 
    }

	else if($rows_g_rates["breakfast"]=="Not Available"){
	echo "<td align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><input type=\"text\" id=\"makbf\" name=\"makbf[]\" size=\"1\" value=\" NA \" onKeyUp=\"calt()\" onFocus=\"calt()\" onBlur=\"calt()\"></td>" ;
    }
	
	else{
	echo "<td align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><input type=\"text\" id=\"makbf\" name=\"makbf[]\" size=\"1\" value=\" ". $rows_g_rates["breakfast"] ." \" onKeyUp=\"calt()\" onFocus=\"calt()\" onBlur=\"calt()\"></td>" ;
    }

    }  



    if($a_meals[$m]=="halfboard"){

	if($rows_g_rates["halfboard_rate"]=="Included"){
	echo "<td align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><input type=\"text\" id=\"makhb\" name=\"makhb[]\" size=\"1\" value=\" INC \" onKeyUp=\"calt()\" onFocus=\"calt()\" onBlur=\"calt()\"></td>" ; 
    }

	else if($rows_g_rates["halfboard_rate"]=="Not Available"){
	echo "<td align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><input type=\"text\" id=\"makhb\" name=\"makhb[]\" size=\"1\" value=\" NA \" onKeyUp=\"calt()\" onFocus=\"calt()\" onBlur=\"calt()\"></td>" ;
    }
	
	else{
	echo "<td align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><input type=\"text\" id=\"makhb\" name=\"makhb[]\" size=\"1\" value=\" ". $rows_g_rates["halfboard_rate"] ." \" onKeyUp=\"calt()\" onFocus=\"calt()\" onBlur=\"calt()\"></td>" ;
    }
	
	}
	
	
	if($a_meals[$m]=="fullboard"){
	
	if($rows_g_rates["fullboard_rate"]=="Included"){
	echo "<td align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><input type=\"text\" id=\"makfb\" name=\"makfb[]\" size=\"1\" value=\" INC \" onKeyUp=\"calt()\" onFocus=\"calt()\" onBlur=\"calt()\"></td>" ; 
    }

	else if($rows_g_rates["fullboard_rate"]=="Not Available"){
	echo "<td align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><input type=\"text\" id=\"makfb\" name=\"makfb[]\" size=\"1\" value=\" NA \" onKeyUp=\"calt()\" onFocus=\"calt()\" onBlur=\"calt()\"></td>" ;
    }
	
	else{
	echo "<td align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><input type=\"text\" id=\"makfb\" name=\"makfb[]\" size=\"1\" value=\" ". $rows_g_rates["fullboard_rate"] ." \" onKeyUp=\"calt()\" onFocus=\"calt()\" onBlur=\"calt()\"></td>" ;
    }
    
	}
	
	
	if($a_meals[$m]=="sahoor"){

	if($rows_g_rates["sahoor_rate"]=="Included"){
	echo "<td align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><input type=\"text\" id=\"maksahoor\" name=\"maksahoor[]\" size=\"1\" value=\" INC \" onKeyUp=\"calt()\" onFocus=\"calt()\" onBlur=\"calt()\"></td>" ; 
    }

	else if($rows_g_rates["sahoor_rate"]=="Not Available"){
	echo "<td align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><input type=\"text\" id=\"maksahoor\" name=\"maksahoor[]\" size=\"1\" value=\" NA \" onKeyUp=\"calt()\" onFocus=\"calt()\" onBlur=\"calt()\"></td>" ;
    }
	
	else{
	echo "<td align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><input type=\"text\" id=\"maksahoor\" name=\"maksahoor[]\" size=\"1\" value=\" ". $rows_g_rates["sahoor_rate"] ." \" onKeyUp=\"calt()\" onFocus=\"calt()\" onBlur=\"calt()\"></td>" ;
    }

    
	}

	if($a_meals[$m]=="iftar"){
	
		if($rows_g_rates["iftar_rate"]=="Included"){
	echo "<td align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><input type=\"text\" id=\"makiftar\" name=\"makiftar[]\" size=\"1\" value=\" INC \" onKeyUp=\"calt()\" onFocus=\"calt()\" onBlur=\"calt()\"></td>" ; 
    }

	else if($rows_g_rates["iftar_rate"]=="Not Available"){
	echo "<td align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><input type=\"text\" id=\"makiftar\" name=\"makiftar[]\" size=\"1\" value=\" NA \" onKeyUp=\"calt()\" onFocus=\"calt()\" onBlur=\"calt()\"></td>" ;
    }
	
	else{
	echo "<td align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><input type=\"text\" id=\"makiftar\" name=\"makiftar[]\" size=\"1\" value=\" ". $rows_g_rates["iftar_rate"] ." \" onKeyUp=\"calt()\" onFocus=\"calt()\" onBlur=\"calt()\"></td>" ;
    }
    
	}
	
	}


echo "</tr></table>";




echo "</font></td>";
	
} //end meals if





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


if(count($a_meals)){   // meals if true

echo "<td align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";

echo "<table width=\"100%\" border=\"1\"><tr>";

for($m=0; $m<count($a_meals) ; $m++){ 
	
	if($a_meals[$m]=="breakfast"){
	echo "<td align=\"center\"  ><font size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\">B/F</td>" ; 
    }  
    if($a_meals[$m]=="halfboard"){
	echo "<td align=\"center\"><font size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\">H/B</td>" ; 
    }
	if($a_meals[$m]=="fullboard"){
	echo "<td align=\"center\"><font size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\">F/B</td>" ; 
    }
	if($a_meals[$m]=="sahoor"){
	echo "<td align=\"center\"><font size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\">SAH</td>" ; 
    }
	if($a_meals[$m]=="iftar"){
	echo "<td align=\"center\"><font size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\">IFT</td>" ; 
    }
	
	}

echo "</tr><tr>";

for($m=0; $m<count($a_meals) ; $m++){ 
	
	if($a_meals[$m]=="breakfast"){
	
	echo "<td align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><input type=\"text\" id=\"makbf\" name=\"makbf[]\" size=\"1\" value=\"NA\" onKeyUp=\"calt()\" onFocus=\"calt()\" onBlur=\"calt()\"></td>" ;

    }  



    if($a_meals[$m]=="halfboard"){

	echo "<td align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><input type=\"text\" id=\"makhb\" name=\"makhb[]\" size=\"1\" value=\"NA\" onKeyUp=\"calt()\" onFocus=\"calt()\" onBlur=\"calt()\"></td>" ;
	
	}
	
	
	if($a_meals[$m]=="fullboard"){
	
	echo "<td align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><input type=\"text\" id=\"makfb\" name=\"makfb[]\" size=\"1\" value=\"NA\" onKeyUp=\"calt()\" onFocus=\"calt()\" onBlur=\"calt()\"></td>" ;

    
	}
	
	
	if($a_meals[$m]=="sahoor"){

	echo "<td align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><input type=\"text\" id=\"maksahoor\" name=\"maksahoor[]\" size=\"1\" value=\"NA\" onKeyUp=\"calt()\" onFocus=\"calt()\" onBlur=\"calt()\"></td>" ;
    }

    


	if($a_meals[$m]=="iftar"){
	
	echo "<td align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><input type=\"text\" id=\"makiftar\" name=\"makiftar[]\" size=\"1\" value=\"NA\" onKeyUp=\"calt()\" onFocus=\"calt()\" onBlur=\"calt()\"></td>" ;

    
	}
	
	}


echo "</tr></table>";




echo "</font></td>";
	
} //end meals if


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

for($m=0; $m<count($a_meals) ; $m++){ echo $a_meals[$m] .","; }

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

if(count($a_meals)){ 
echo "<td bgcolor=\"#FFDFDF\" align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";
echo "Meals";
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

$query_g_nc ="select hotel_id,from_date,to_date," . $s_q1 . ", nationality, view_type,avialibility,avial_bool,allotment,breakfast,halfboard_rate,fullboard_rate,sahoor_rate,iftar_rate  from $qtableingr where hotel_id='$s_hotelsoth' and '$f_date' between from_date and to_date - interval '1 day' and view_type = '$s_viewt' and nationalityl like '%$s_countryu%'  ";

$result_g_nc = pg_query($conn, $query_g_nc);

if (!$result_g_nc) {
	echo "An error occured.\n";
	exit;
	}

  $numrmak_nc = pg_num_rows($result_g_nc);

if($numrmak_nc==0){
$s_countryu = "All";
}


$query_g_rates ="select hotel_id,from_date,to_date," . $s_q1 . ", nationality, view_type,avialibility,avial_bool,allotment,breakfast,halfboard_rate,fullboard_rate,sahoor_rate,iftar_rate  from $qtableingr where hotel_id='$s_hotelsoth' and '$f_date' between from_date and to_date - interval '1 day' and view_type = '$s_viewt' and nationalityl like '%$s_countryu%' ";



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


if(count($a_meals)){   // meals if true

echo "<td align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";

echo "<table width=\"100%\" border=\"1\"><tr>";

for($m=0; $m<count($a_meals) ; $m++){ 
	
	if($a_meals[$m]=="breakfast"){
	echo "<td align=\"center\"  ><font size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\">B/F</td>" ; 
    }  
    if($a_meals[$m]=="halfboard"){
	echo "<td align=\"center\"><font size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\">H/B</td>" ; 
    }
	if($a_meals[$m]=="fullboard"){
	echo "<td align=\"center\"><font size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\">F/B</td>" ; 
    }
	if($a_meals[$m]=="sahoor"){
	echo "<td align=\"center\"><font size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\">SAH</td>" ; 
    }
	if($a_meals[$m]=="iftar"){
	echo "<td align=\"center\"><font size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\">IFT</td>" ; 
    }
	
	}

echo "</tr><tr>";

for($m=0; $m<count($a_meals) ; $m++){ 
	
	if($a_meals[$m]=="breakfast"){
	
	if($rows_g_rates["breakfast"]=="Included"){
	echo "<td align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><input type=\"text\" id=\"otbf\" name=\"otbf[]\" size=\"1\" value=\" INC \" onKeyUp=\"calt()\" onFocus=\"calt()\" onBlur=\"calt()\"></td>" ; 
    }

	else if($rows_g_rates["breakfast"]=="Not Available"){
	echo "<td align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><input type=\"text\" id=\"otbf\" name=\"otbf[]\" size=\"1\" value=\" NA \" onKeyUp=\"calt()\" onFocus=\"calt()\" onBlur=\"calt()\"></td>" ;
    }
	
	else{
	echo "<td align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><input type=\"text\" id=\"otbf\" name=\"otbf[]\" size=\"1\" value=\" ". $rows_g_rates["breakfast"] ." \" onKeyUp=\"calt()\" onFocus=\"calt()\" onBlur=\"calt()\"></td>" ;
    }

    }  



    if($a_meals[$m]=="halfboard"){

	if($rows_g_rates["halfboard_rate"]=="Included"){
	echo "<td align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><input type=\"text\" id=\"othb\" name=\"othb[]\" size=\"1\" value=\" INC \" onKeyUp=\"calt()\" onFocus=\"calt()\" onBlur=\"calt()\"></td>" ; 
    }

	else if($rows_g_rates["halfboard_rate"]=="Not Available"){
	echo "<td align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><input type=\"text\" id=\"othb\" name=\"othb[]\" size=\"1\" value=\" NA \" onKeyUp=\"calt()\" onFocus=\"calt()\" onBlur=\"calt()\"></td>" ;
    }
	
	else{
	echo "<td align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><input type=\"text\" id=\"othb\" name=\"othb[]\" size=\"1\" value=\" ". $rows_g_rates["halfboard_rate"] ." \" onKeyUp=\"calt()\" onFocus=\"calt()\" onBlur=\"calt()\"></td>" ;
    }
	
	}
	
	
	if($a_meals[$m]=="fullboard"){
	
	if($rows_g_rates["fullboard_rate"]=="Included"){
	echo "<td align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><input type=\"text\" id=\"otfb\" name=\"otfb[]\" size=\"1\" value=\" INC \" onKeyUp=\"calt()\" onFocus=\"calt()\" onBlur=\"calt()\"></td>" ; 
    }

	else if($rows_g_rates["fullboard_rate"]=="Not Available"){
	echo "<td align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><input type=\"text\" id=\"otfb\" name=\"otfb[]\" size=\"1\" value=\" NA \" onKeyUp=\"calt()\" onFocus=\"calt()\" onBlur=\"calt()\"></td>" ;
    }
	
	else{
	echo "<td align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><input type=\"text\" id=\"otfb\" name=\"otfb[]\" size=\"1\" value=\" ". $rows_g_rates["fullboard_rate"] ." \" onKeyUp=\"calt()\" onFocus=\"calt()\" onBlur=\"calt()\"></td>" ;
    }
    
	}
	
	
	if($a_meals[$m]=="sahoor"){

	if($rows_g_rates["sahoor_rate"]=="Included"){
	echo "<td align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><input type=\"text\" id=\"otsahoor\" name=\"otsahoor[]\" size=\"1\" value=\" INC \" onKeyUp=\"calt()\" onFocus=\"calt()\" onBlur=\"calt()\"></td>" ; 
    }

	else if($rows_g_rates["sahoor_rate"]=="Not Available"){
	echo "<td align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><input type=\"text\" id=\"otsahoor\" name=\"otsahoor[]\" size=\"1\" value=\" NA \" onKeyUp=\"calt()\" onFocus=\"calt()\" onBlur=\"calt()\"></td>" ;
    }
	
	else{
	echo "<td align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><input type=\"text\" id=\"otsahoor\" name=\"otsahoor[]\" size=\"1\" value=\" ". $rows_g_rates["sahoor_rate"] ." \" onKeyUp=\"calt()\" onFocus=\"calt()\" onBlur=\"calt()\"></td>" ;
    }

    
	}

	if($a_meals[$m]=="iftar"){
	
		if($rows_g_rates["iftar_rate"]=="Included"){
	echo "<td align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><input type=\"text\" id=\"otiftar\" name=\"otiftar[]\" size=\"1\" value=\" INC \" onKeyUp=\"calt()\" onFocus=\"calt()\" onBlur=\"calt()\"></td>" ; 
    }

	else if($rows_g_rates["iftar_rate"]=="Not Available"){
	echo "<td align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><input type=\"text\" id=\"otiftar\" name=\"otiftar[]\" size=\"1\" value=\" NA \" onKeyUp=\"calt()\" onFocus=\"calt()\" onBlur=\"calt()\"></td>" ;
    }
	
	else{
	echo "<td align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><input type=\"text\" id=\"otiftar\" name=\"otiftar[]\" size=\"1\" value=\" ". $rows_g_rates["iftar_rate"] ." \" onKeyUp=\"calt()\" onFocus=\"calt()\" onBlur=\"calt()\"></td>" ;
    }
    
	}
	
	}


echo "</tr></table>";




echo "</font></td>";
	
} //end meals if




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


if(count($a_meals)){   // meals if true

echo "<td align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";

echo "<table width=\"100%\" border=\"1\"><tr>";

for($m=0; $m<count($a_meals) ; $m++){ 
	
	if($a_meals[$m]=="breakfast"){
	echo "<td align=\"center\"  ><font size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\">B/F</td>" ; 
    }  
    if($a_meals[$m]=="halfboard"){
	echo "<td align=\"center\"><font size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\">H/B</td>" ; 
    }
	if($a_meals[$m]=="fullboard"){
	echo "<td align=\"center\"><font size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\">F/B</td>" ; 
    }
	if($a_meals[$m]=="sahoor"){
	echo "<td align=\"center\"><font size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\">SAH</td>" ; 
    }
	if($a_meals[$m]=="iftar"){
	echo "<td align=\"center\"><font size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\">IFT</td>" ; 
    }
	
	}

echo "</tr><tr>";

for($m=0; $m<count($a_meals) ; $m++){ 
	
	if($a_meals[$m]=="breakfast"){
	
	echo "<td align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><input type=\"text\" id=\"otbf\" name=\"otbf[]\" size=\"1\" value=\"NA\" onKeyUp=\"calt()\" onFocus=\"calt()\" onBlur=\"calt()\"></td>" ;

    }  



    if($a_meals[$m]=="halfboard"){

	echo "<td align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><input type=\"text\" id=\"othb\" name=\"othb[]\" size=\"1\" value=\"NA\" onKeyUp=\"calt()\" onFocus=\"calt()\" onBlur=\"calt()\"></td>" ;
	
	}
	
	
	if($a_meals[$m]=="fullboard"){
	
	echo "<td align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><input type=\"text\" id=\"otfb\" name=\"otfb[]\" size=\"1\" value=\"NA\" onKeyUp=\"calt()\" onFocus=\"calt()\" onBlur=\"calt()\"></td>" ;

    
	}
	
	
	if($a_meals[$m]=="sahoor"){

	echo "<td align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><input type=\"text\" id=\"otsahoor\" name=\"otsahoor[]\" size=\"1\" value=\"NA\" onKeyUp=\"calt()\" onFocus=\"calt()\" onBlur=\"calt()\"></td>" ;
    }

    


	if($a_meals[$m]=="iftar"){
	
	echo "<td align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><input type=\"text\" id=\"otiftar\" name=\"otiftar[]\" size=\"1\" value=\"NA\" onKeyUp=\"calt()\" onFocus=\"calt()\" onBlur=\"calt()\"></td>" ;

    
	}
	
	}


echo "</tr></table>";




echo "</font></td>";
	
} //end meals if





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

$transreq  = date('Y-m-d H:i', mktime($transh,$transmin,0,$transm,$transd,$transy));

$_SESSION['transreq'] = $transreq;


 $trans_s = $_POST['s_trans'];

 $_SESSION['trans_s'] = $trans_s;

 $trans_f2t = $_POST['f2t'];

  $_SESSION['trans_f2t'] = $trans_f2t;

 $trans_toft = $_POST['typeoftrans'];

   $_SESSION['trans_toft'] = $trans_toft;

 $trans_fd = $_POST['flightdet'];

  $_SESSION['trans_fd'] = $trans_fd;

 $trans_nu = $_POST['noofu'];

 $_SESSION['trans_nu'] = $trans_nu;

echo "<tr><td bgcolor=\"#E8D2D2\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">From - To</font></td><td bgcolor=\"#E8D2D2\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">Units</font></td><td bgcolor=\"#E8D2D2\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">Type</font></td><td bgcolor=\"#E8D2D2\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">Request Date</font></td><td bgcolor=\"#E8D2D2\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">Price</font></td></tr>";

echo "<tr><td bgcolor=\"#E8D2D2\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">$trans_f2t</font></td><td><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">$trans_nu</font></td><td><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">$trans_toft</font></td><td><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">" . date('D jS M, Y H:i ', strtotime($transreq)) . "</font></td><td><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><input type=\"text\" id=\"transrn\" name=\"transrn\" size=\"2\" value=\"0\" onKeyUp=\"calt()\" onFocus=\"calt()\" onBlur=\"calt()\" >&nbsp;<input type=\"text\" id=\"transr\" name=\"transr\" size=\"2\" value=\"0\" onKeyUp=\"calt()\" onFocus=\"calt()\" onBlur=\"calt()\"></font></td></tr></table>";

echo "</td></tr>";  // trans end
echo "<tr><td>&nbsp</td></tr>";
}

if($_POST["visa0"]==on){

echo "<tr><td>";
echo "<table style=\"border: 1px solid #FF8000\" border=\"1\" width=\"100%\" ><tr><td bgcolor=\"#FFE4CA\" colspan=\"6\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><b>Visa</b></font></td></tr>";

$visad = $_POST['d4Day'];
$visam = $_POST['d4Month'];
$visay = $_POST['d4Year'];




$visareq  = date('Y-m-d H:i', mktime(0,0,0,$visam,$visad,$visay));

$_SESSION['visareq'] = $visareq;


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

echo "<tr><td bgcolor=\"#FFE4CA\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><input type=\"text\" id=\"ex2pat\" name=\"ex2pat\" size=\"25\" ></font></td><td><select name=\"d1Day\" class=\"selBox\" ></select><select name=\"d1Month\" class=\"selBox\"></select><select name=\"d1Year\" class=\"selBox\"></select></td><td><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><input type=\"text\" id=\"ex2net\" name=\"ex2net\" size=\"2\" value=\"0\" onKeyUp=\"calt()\" onFocus=\"calt()\" onBlur=\"calt()\"></font></td><td><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><input type=\"text\" id=\"ex2sell\" name=\"ex2sell\" size=\"2\" value=\"0\" onKeyUp=\"calt()\" onFocus=\"calt()\" onBlur=\"calt()\"></font></td></tr>";



echo "</table>";
echo "</td></tr>";  // trans end

echo "<tr><td>&nbsp</td></tr>";
}


if($_POST["others2"]==on){


echo "<tr><td>";
echo "<table style=\"border: 1px solid #FF8000\" border=\"1\" width=\"100%\" ><tr><td bgcolor=\"#FFE4CA\" colspan=\"6\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><b>Extra Requests 3</b></font></td></tr>";



echo "<tr><td bgcolor=\"#FFE4CA\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">Request Paticulars</font></td><td bgcolor=\"#FFE4CA\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">Req Date</font></td><td bgcolor=\"#FFE4CA\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">Net Rate / pax</font></td><td bgcolor=\"#FFE4CA\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">Selling Rate / pax</font></td></tr>";

echo "<tr><td bgcolor=\"#FFE4CA\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><input type=\"text\" id=\"ex3pat\" name=\"ex3pat\" size=\"25\" ></font></td><td><select name=\"d2Day\" class=\"selBox\" ></select><select name=\"d2Month\" class=\"selBox\"></select><select name=\"d2Year\" class=\"selBox\"></select></td><td><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><input type=\"text\" id=\"ex3net\" name=\"ex3net\" size=\"2\" value=\"0\" onKeyUp=\"calt()\" onFocus=\"calt()\" onBlur=\"calt()\"></font></td><td><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><input type=\"text\" id=\"ex3sell\" name=\"ex3sell\" size=\"2\" value=\"0\" onKeyUp=\"calt()\" onFocus=\"calt()\" onBlur=\"calt()\"></font></td></tr>";



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

function trimString(str) {
  while (str.charAt(0) == ' ')
    str = str.substring(1);
  while (str.charAt(str.length - 1) == ' ')
    str = str.substring(0, str.length - 1);
  return str;
}


function calt(){
 var rooms = new Array('<? $x=0; echo count($srooms) ?>');


'<? for($xx=0; $xx<count($srooms); $xx++){ ?>'


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

'<? if($_POST["hotcb0"]==on){ ?>'

'<? if($madn==1){ ?>'

totnetmad = totnetmad + parseFloat(document.roomselput.madnr<? echo $srooms[$xx] ; ?>.value) ;


'<?for($m=0; $m<count($a_meals) ; $m++) { if(trim($a_meals[$m])=="breakfast") { ?>'
if(trimString(document.roomselput.madbf.value)=="INC" || trimString(document.roomselput.madbf.value)=="NA"){ }
else{
totnetmad = totnetmad + parseFloat(document.roomselput.madbf.value)* <? echo $srooms[$xx] ; ?>;
}
'<?}}?>'

'<?for($m=0; $m<count($a_meals) ; $m++) { if(trim($a_meals[$m])=="halfboard") { ?>'

if(trimString(document.roomselput.madhb.value)=="INC" ||  trimString(document.roomselput.madhb.value)=="NA"){ }
else{
totnetmad = totnetmad + parseFloat(document.roomselput.madhb.value)* <? echo $srooms[$xx] ; ?>;
}
'<?}}?>'
'<?for($m=0; $m<count($a_meals) ; $m++) { if(trim($a_meals[$m])=="fullboard") { ?>'

if(trimString(document.roomselput.madfb.value)=="INC" ||  trimString(document.roomselput.madfb.value)=="NA"){ }
else{
totnetmad = totnetmad + parseFloat(document.roomselput.madfb.value)* <? echo $srooms[$xx] ; ?>;
}
'<?}}?>'
'<?for($m=0; $m<count($a_meals) ; $m++) { if(trim($a_meals[$m])=="sahoor") { ?>'

if(trimString(document.roomselput.madsahoor.value)=="INC" ||  trimString(document.roomselput.madsahoor.value)=="NA"){ }
else{
totnetmad = totnetmad + parseFloat(document.roomselput.madsahoor.value)* <? echo $srooms[$xx] ; ?>;
}
'<?}}?>'
'<?for($m=0; $m<count($a_meals) ; $m++) { if(trim($a_meals[$m])=="iftar") { ?>'

if(trimString(document.roomselput.madiftar.value)=="INC" ||  trimString(document.roomselput.madiftar.value)=="NA"){ }
else{
totnetmad = totnetmad + parseFloat(document.roomselput.madiftar.value)* <? echo $srooms[$xx] ; ?>;
}
'<?}}?>'




'<?}else{?>'

for(x=0; x<document.roomselput.madnr<? echo $srooms[$xx] ; ?>.length; x++){

totnetmad = totnetmad + parseFloat(document.roomselput.madnr<? echo $srooms[$xx] ; ?>[x].value);

'<?for($m=0; $m<count($a_meals) ; $m++) { if(trim($a_meals[$m])=="breakfast") { ?>'
if(trimString(document.roomselput.madbf[x].value)=="INC" ||  trimString(document.roomselput.madbf[x].value)=="NA"){ }
else{
totnetmad = totnetmad + parseFloat(document.roomselput.madbf[x].value) * <? echo $srooms[$xx] ; ?>;
}
'<?}}?>'

'<?for($m=0; $m<count($a_meals) ; $m++) { if(trim($a_meals[$m])=="halfboard") { ?>'

if(trimString(document.roomselput.madhb[x].value)=="INC" ||  trimString(document.roomselput.madhb[x].value)=="NA"){ }
else{
totnetmad = totnetmad + parseFloat(document.roomselput.madhb[x].value) * <? echo $srooms[$xx] ; ?>;
}
'<?}}?>'
'<?for($m=0; $m<count($a_meals) ; $m++) { if(trim($a_meals[$m])=="fullboard") { ?>'

if(trimString(document.roomselput.madfb[x].value)=="INC" ||  trimString(document.roomselput.madfb[x].value)=="NA"){ }
else{
totnetmad = totnetmad + parseFloat(document.roomselput.madfb[x].value) * <? echo $srooms[$xx] ; ?>;
}
'<?}}?>'
'<?for($m=0; $m<count($a_meals) ; $m++) { if(trim($a_meals[$m])=="sahoor") { ?>'
if(trimString(document.roomselput.madsahoor[x].value)=="INC" ||  trimString(document.roomselput.madsahoor[x].value)=="NA"){ }
else{
totnetmad = totnetmad + parseFloat(document.roomselput.madsahoor[x].value);
}
'<?}}?>'
'<?for($m=0; $m<count($a_meals) ; $m++) { if(trim($a_meals[$m])=="iftar") { ?>'
if(trimString(document.roomselput.madiftar[x].value)=="INC" ||  trimString(document.roomselput.madiftar[x].value)=="NA"){ }
else{
totnetmad = totnetmad + parseFloat(document.roomselput.madiftar[x].value);
}
'<?}}?>'

}

'<?}}?>'	



'<? if($_POST["hotcb1"]==on){ ?>'
'<? if($makn==1){ ?>'

totnetmak = totnetmak + parseFloat(document.roomselput.maknr<? echo $srooms[$xx] ; ?>.value) ;


'<?for($m=0; $m<count($a_meals) ; $m++) { if(trim($a_meals[$m])=="breakfast") { ?>'
if(trimString(document.roomselput.makbf.value)=="INC" || trimString(document.roomselput.makbf.value)=="NA"){ }
else{
totnetmak = totnetmak + parseFloat(document.roomselput.makbf.value)* <? echo $srooms[$xx] ; ?>;
}
'<?}}?>'

'<?for($m=0; $m<count($a_meals) ; $m++) { if(trim($a_meals[$m])=="halfboard") { ?>'

if(trimString(document.roomselput.makhb.value)=="INC" ||  trimString(document.roomselput.makhb.value)=="NA"){ }
else{
totnetmak = totnetmak + parseFloat(document.roomselput.makhb.value)* <? echo $srooms[$xx] ; ?>;
}
'<?}}?>'
'<?for($m=0; $m<count($a_meals) ; $m++) { if(trim($a_meals[$m])=="fullboard") { ?>'

if(trimString(document.roomselput.makfb.value)=="INC" ||  trimString(document.roomselput.makfb.value)=="NA"){ }
else{
totnetmak = totnetmak + parseFloat(document.roomselput.makfb.value)* <? echo $srooms[$xx] ; ?>;
}
'<?}}?>'
'<?for($m=0; $m<count($a_meals) ; $m++) { if(trim($a_meals[$m])=="sahoor") { ?>'

if(trimString(document.roomselput.maksahoor.value)=="INC" ||  trimString(document.roomselput.maksahoor.value)=="NA"){ }
else{
totnetmak = totnetmak + parseFloat(document.roomselput.maksahoor.value)* <? echo $srooms[$xx] ; ?>;
}
'<?}}?>'
'<?for($m=0; $m<count($a_meals) ; $m++) { if(trim($a_meals[$m])=="iftar") { ?>'

if(trimString(document.roomselput.makiftar.value)=="INC" ||  trimString(document.roomselput.makiftar.value)=="NA"){ }
else{
totnetmak = totnetmak + parseFloat(document.roomselput.makiftar.value)* <? echo $srooms[$xx] ; ?>;
}
'<?}}?>'




'<?}else{?>'
for(y=0; y<document.roomselput.maknr<? echo $srooms[$xx] ; ?>.length; y++){
totnetmak = totnetmak + parseFloat(document.roomselput.maknr<? echo $srooms[$xx] ; ?>[y].value) ;


'<?for($m=0; $m<count($a_meals) ; $m++) { if(trim($a_meals[$m])=="breakfast") { ?>'
if(trimString(document.roomselput.makbf[y].value)=="INC" ||  trimString(document.roomselput.makbf[y].value)=="NA"){ }
else{
totnetmak = totnetmak + parseFloat(document.roomselput.makbf[y].value)* <? echo $srooms[$xx] ; ?>;
}
'<?}}?>'

'<?for($m=0; $m<count($a_meals) ; $m++) { if(trim($a_meals[$m])=="halfboard") { ?>'

if(trimString(document.roomselput.makhb[y].value)=="INC" ||  trimString(document.roomselput.makhb[y].value)=="NA"){ }
else{
totnetmak = totnetmak + parseFloat(document.roomselput.makhb[y].value)* <? echo $srooms[$xx] ; ?>;
}
'<?}}?>'
'<?for($m=0; $m<count($a_meals) ; $m++) { if(trim($a_meals[$m])=="fullboard") { ?>'

if(trimString(document.roomselput.makfb[y].value)=="INC" ||  trimString(document.roomselput.makfb[y].value)=="NA"){ }
else{
totnetmak = totnetmak + parseFloat(document.roomselput.makfb[y].value)* <? echo $srooms[$xx] ; ?>;
}
'<?}}?>'
'<?for($m=0; $m<count($a_meals) ; $m++) { if(trim($a_meals[$m])=="sahoor") { ?>'
if(trimString(document.roomselput.maksahoor[y].value)=="INC" ||  trimString(document.roomselput.maksahoor[y].value)=="NA"){ }
else{
totnetmak = totnetmak + parseFloat(document.roomselput.maksahoor[y].value)* <? echo $srooms[$xx] ; ?>;
}
'<?}}?>'
'<?for($m=0; $m<count($a_meals) ; $m++) { if(trim($a_meals[$m])=="iftar") { ?>'
if(trimString(document.roomselput.makiftar[y].value)=="INC" ||  trimString(document.roomselput.makiftar[y].value)=="NA"){ }
else{
totnetmak = totnetmak + parseFloat(document.roomselput.makiftar[y].value)* <? echo $srooms[$xx] ; ?>;
}
'<?}}?>'


}
'<?}}?>'	

'<? if($_POST["hotcb2"]==on){ ?>'

'<? if($othn==1){ ?>'

totnetot = totnetot + parseFloat(document.roomselput.otnr<? echo $srooms[$xx] ; ?>.value) ;


'<?for($m=0; $m<count($a_meals) ; $m++) { if(trim($a_meals[$m])=="breakfast") { ?>'
if(trimString(document.roomselput.otbf.value)=="INC" || trimString(document.roomselput.otbf.value)=="NA"){ }
else{
totnetot = totnetot + parseFloat(document.roomselput.otbf.value)* <? echo $srooms[$xx] ; ?>;
}
'<?}}?>'

'<?for($m=0; $m<count($a_meals) ; $m++) { if(trim($a_meals[$m])=="halfboard") { ?>'

if(trimString(document.roomselput.othb.value)=="INC" ||  trimString(document.roomselput.othb.value)=="NA"){ }
else{
totnetot = totnetot + parseFloat(document.roomselput.othb.value)* <? echo $srooms[$xx] ; ?>;
}
'<?}}?>'
'<?for($m=0; $m<count($a_meals) ; $m++) { if(trim($a_meals[$m])=="fullboard") { ?>'

if(trimString(document.roomselput.otfb.value)=="INC" ||  trimString(document.roomselput.otfb.value)=="NA"){ }
else{
totnetot = totnetot + parseFloat(document.roomselput.otfb.value)* <? echo $srooms[$xx] ; ?>;
}
'<?}}?>'
'<?for($m=0; $m<count($a_meals) ; $m++) { if(trim($a_meals[$m])=="sahoor") { ?>'

if(trimString(document.roomselput.otsahoor.value)=="INC" ||  trimString(document.roomselput.otsahoor.value)=="NA"){ }
else{
totnetot = totnetot + parseFloat(document.roomselput.otsahoor.value)* <? echo $srooms[$xx] ; ?>;
}
'<?}}?>'
'<?for($m=0; $m<count($a_meals) ; $m++) { if(trim($a_meals[$m])=="iftar") { ?>'

if(trimString(document.roomselput.otiftar.value)=="INC" ||  trimString(document.roomselput.otiftar.value)=="NA"){ }
else{
totnetot = totnetot + parseFloat(document.roomselput.otiftar.value)* <? echo $srooms[$xx] ; ?>;
}
'<?}}?>'


'<?}else{?>'

for(z=0; z<document.roomselput.otnr<? echo $srooms[$xx] ; ?>.length; z++){
totnetot = totnetot + parseFloat(document.roomselput.otnr<? echo $srooms[$xx] ; ?>[z].value) ;

'<?for($m=0; $m<count($a_meals) ; $m++) { if(trim($a_meals[$m])=="breakfast") { ?>'
if(trimString(document.roomselput.otbf[z].value)=="INC" ||  trimString(document.roomselput.otbf[z].value)=="NA"){ }
else{
totnetot = totnetot + parseFloat(document.roomselput.otbf[z].value)* <? echo $srooms[$xx] ; ?>;
}
'<?}}?>'

'<?for($m=0; $m<count($a_meals) ; $m++) { if(trim($a_meals[$m])=="halfboard") { ?>'

if(trimString(document.roomselput.othb[z].value)=="INC" ||  trimString(document.roomselput.othb[z].value)=="NA"){ }
else{
totnetot = totnetot + parseFloat(document.roomselput.othb[z].value)* <? echo $srooms[$xx] ; ?>;
}
'<?}}?>'
'<?for($m=0; $m<count($a_meals) ; $m++) { if(trim($a_meals[$m])=="fullboard") { ?>'

if(trimString(document.roomselput.otfb[z].value)=="INC" ||  trimString(document.roomselput.otfb[z].value)=="NA"){ }
else{
totnetot = totnetot + parseFloat(document.roomselput.otfb[z].value)* <? echo $srooms[$xx] ; ?>;
}
'<?}}?>'
'<?for($m=0; $m<count($a_meals) ; $m++) { if(trim($a_meals[$m])=="sahoor") { ?>'
if(trimString(document.roomselput.otsahoor[z].value)=="INC" ||  trimString(document.roomselput.otsahoor[z].value)=="NA"){ }
else{
totnetot = totnetot + parseFloat(document.roomselput.otsahoor[z].value)* <? echo $srooms[$xx] ; ?>;
}
'<?}}?>'
'<?for($m=0; $m<count($a_meals) ; $m++) { if(trim($a_meals[$m])=="iftar") { ?>'
if(trimString(document.roomselput.otiftar[z].value)=="INC" ||  trimString(document.roomselput.otiftar[z].value)=="NA"){ }
else{
totnetot = totnetot + parseFloat(document.roomselput.otiftar[z].value)* <? echo $srooms[$xx] ; ?>;
}
'<?}}?>'



}
'<?}}?>'	


totnet = (totnetmad + totnetmak + totnetot)/'<? echo $srooms[$xx] ; ?>';



'<? if($_POST["trans0"]==on){ ?>'
transn = parseFloat(document.getElementById('transrn').value/<? echo $s_npaxs ; ?>); 
totnet = totnet + transn; 
'<?}?>'	




'<? if($_POST["visa0"]==on){ ?>'
visan = parseFloat(document.getElementById('vnet').value); 
totnet = totnet + visan; 
'<?}?>'	
'<? if($_POST["servicec"]==on){ ?>'
scnet = parseFloat(document.getElementById('scnet').value);
totnet = totnet + scnet; 
'<?}?>'	

'<? if($_POST["others0"]==on){ ?>'
ex1net = parseFloat(document.getElementById('ex1net').value);
totnet = totnet + ex1net; 
'<?}?>'	
'<? if($_POST["others1"]==on){ ?>'
ex2net = parseFloat(document.getElementById('ex2net').value);
totnet = totnet + ex2net; 
'<?}?>'	
'<? if($_POST["others2"]==on){ ?>'
ex3net = parseFloat(document.getElementById('ex3net').value);
totnet = totnet + ex3net; 
'<?}?>'	

'<? if($_POST["hotcb0"]==on){ ?>'
'<? if($madn==1){ ?>'

totsellmad = totsellmad + parseFloat(document.roomselput.madsr<? echo $srooms[$xx] ; ?>.value) ;


'<?for($m=0; $m<count($a_meals) ; $m++) { if(trim($a_meals[$m])=="breakfast") { ?>'
if(trimString(document.roomselput.madbf.value)=="INC" || trimString(document.roomselput.madbf.value)=="NA"){ }
else{
totsellmad = totsellmad + parseFloat(document.roomselput.madbf.value)* <? echo $srooms[$xx] ; ?>;
}
'<?}}?>'

'<?for($m=0; $m<count($a_meals) ; $m++) { if(trim($a_meals[$m])=="halfboard") { ?>'

if(trimString(document.roomselput.madhb.value)=="INC" ||  trimString(document.roomselput.madhb.value)=="NA"){ }
else{
totsellmad = totsellmad + parseFloat(document.roomselput.madhb.value)* <? echo $srooms[$xx] ; ?>;
}
'<?}}?>'
'<?for($m=0; $m<count($a_meals) ; $m++) { if(trim($a_meals[$m])=="fullboard") { ?>'

if(trimString(document.roomselput.madfb.value)=="INC" ||  trimString(document.roomselput.madfb.value)=="NA"){ }
else{
totsellmad = totsellmad + parseFloat(document.roomselput.madfb.value)* <? echo $srooms[$xx] ; ?>;
}
'<?}}?>'
'<?for($m=0; $m<count($a_meals) ; $m++) { if(trim($a_meals[$m])=="sahoor") { ?>'
if(trimString(document.roomselput.madsahoor.value)=="INC" ||  trimString(document.roomselput.madsahoor.value)=="NA"){ }
else{
totsellmad = totsellmad + parseFloat(document.roomselput.madsahoor.value)* <? echo $srooms[$xx] ; ?>;
}
'<?}}?>'
'<?for($m=0; $m<count($a_meals) ; $m++) { if(trim($a_meals[$m])=="iftar") { ?>'
if(trimString(document.roomselput.madiftar.value)=="INC" ||  trimString(document.roomselput.madiftar.value)=="NA"){ }
else{
totsellmad = totsellmad + parseFloat(document.roomselput.madiftar.value)* <? echo $srooms[$xx] ; ?>;
}
'<?}}?>'


'<?}else{?>'

for(x=0; x<document.roomselput.madsr<? echo $srooms[$xx] ; ?>.length; x++){
totsellmad = totsellmad + parseFloat(document.roomselput.madsr<? echo $srooms[$xx] ; ?>[x].value) ;

'<?for($m=0; $m<count($a_meals) ; $m++) { if(trim($a_meals[$m])=="breakfast") { ?>'
if(trimString(document.roomselput.madbf[x].value)=="INC" ||  trimString(document.roomselput.madbf[x].value)=="NA"){ }
else{
totsellmad = totsellmad + parseFloat(document.roomselput.madbf[x].value)* <? echo $srooms[$xx] ; ?>;
}
'<?}}?>'

'<?for($m=0; $m<count($a_meals) ; $m++) { if(trim($a_meals[$m])=="halfboard") { ?>'

if(trimString(document.roomselput.madhb[x].value)=="INC" ||  trimString(document.roomselput.madhb[x].value)=="NA"){ }
else{
totsellmad = totsellmad + parseFloat(document.roomselput.madhb[x].value)* <? echo $srooms[$xx] ; ?>;
}
'<?}}?>'
'<?for($m=0; $m<count($a_meals) ; $m++) { if(trim($a_meals[$m])=="fullboard") { ?>'

if(trimString(document.roomselput.madfb[x].value)=="INC" ||  trimString(document.roomselput.madfb[x].value)=="NA"){ }
else{
totsellmad = totsellmad + parseFloat(document.roomselput.madfb[x].value)* <? echo $srooms[$xx] ; ?>;
}
'<?}}?>'
'<?for($m=0; $m<count($a_meals) ; $m++) { if(trim($a_meals[$m])=="sahoor") { ?>'
if(trimString(document.roomselput.madsahoor[x].value)=="INC" ||  trimString(document.roomselput.madsahoor[x].value)=="NA"){ }
else{
totsellmad = totsellmad + parseFloat(document.roomselput.madsahoor[x].value)* <? echo $srooms[$xx] ; ?>;
}
'<?}}?>'
'<?for($m=0; $m<count($a_meals) ; $m++) { if(trim($a_meals[$m])=="iftar") { ?>'
if(trimString(document.roomselput.madiftar[x].value)=="INC" ||  trimString(document.roomselput.madiftar[x].value)=="NA"){ }
else{
totsellmad = totsellmad + parseFloat(document.roomselput.madiftar[x].value)* <? echo $srooms[$xx] ; ?>;
}

'<?}}?>'



}
'<?}}?>'	

'<? if($_POST["hotcb1"]==on){ ?>'
'<? if($makn==1){ ?>'

totsellmak = totsellmak + parseFloat(document.roomselput.maksr<? echo $srooms[$xx] ; ?>.value) ;

'<?for($m=0; $m<count($a_meals) ; $m++) { if(trim($a_meals[$m])=="breakfast") { ?>'
if(trimString(document.roomselput.makbf.value)=="INC" || trimString(document.roomselput.makbf.value)=="NA"){ }
else{
totsellmak = totsellmak + parseFloat(document.roomselput.makbf.value)* <? echo $srooms[$xx] ; ?>;
}
'<?}}?>'

'<?for($m=0; $m<count($a_meals) ; $m++) { if(trim($a_meals[$m])=="halfboard") { ?>'

if(trimString(document.roomselput.makhb.value)=="INC" ||  trimString(document.roomselput.makhb.value)=="NA"){ }
else{
totsellmak = totsellmak + parseFloat(document.roomselput.makhb.value)* <? echo $srooms[$xx] ; ?>;
}
'<?}}?>'
'<?for($m=0; $m<count($a_meals) ; $m++) { if(trim($a_meals[$m])=="fullboard") { ?>'

if(trimString(document.roomselput.makfb.value)=="INC" ||  trimString(document.roomselput.makfb.value)=="NA"){ }
else{
totsellmak = totsellmak + parseFloat(document.roomselput.makfb.value)* <? echo $srooms[$xx] ; ?>;
}
'<?}}?>'
'<?for($m=0; $m<count($a_meals) ; $m++) { if(trim($a_meals[$m])=="sahoor") { ?>'
if(trimString(document.roomselput.maksahoor.value)=="INC" ||  trimString(document.roomselput.maksahoor.value)=="NA"){ }
else{
totsellmak = totsellmak + parseFloat(document.roomselput.maksahoor.value)* <? echo $srooms[$xx] ; ?>;
}
'<?}}?>'
'<?for($m=0; $m<count($a_meals) ; $m++) { if(trim($a_meals[$m])=="iftar") { ?>'
if(trimString(document.roomselput.makiftar.value)=="INC" ||  trimString(document.roomselput.makiftar.value)=="NA"){ }
else{
totsellmak = totsellmak + parseFloat(document.roomselput.makiftar.value)* <? echo $srooms[$xx] ; ?>;
}
'<?}}?>'



'<?}else{?>'

for(y=0; y<document.roomselput.maksr<? echo $srooms[$xx] ; ?>.length; y++){
totsellmak = totsellmak + parseFloat(document.roomselput.maksr<? echo $srooms[$xx] ; ?>[y].value) ;


'<?for($m=0; $m<count($a_meals) ; $m++) { if(trim($a_meals[$m])=="breakfast") { ?>'
if(trimString(document.roomselput.makbf[y].value)=="INC" ||  trimString(document.roomselput.makbf[y].value)=="NA"){ }
else{
totsellmak = totsellmak + parseFloat(document.roomselput.makbf[y].value)* <? echo $srooms[$xx] ; ?>;
}
'<?}}?>'

'<?for($m=0; $m<count($a_meals) ; $m++) { if(trim($a_meals[$m])=="halfboard") { ?>'

if(trimString(document.roomselput.makhb[y].value)=="INC" ||  trimString(document.roomselput.makhb[y].value)=="NA"){ }
else{
totsellmak = totsellmak + parseFloat(document.roomselput.makhb[y].value)* <? echo $srooms[$xx] ; ?>;
}
'<?}}?>'
'<?for($m=0; $m<count($a_meals) ; $m++) { if(trim($a_meals[$m])=="fullboard") { ?>'

if(trimString(document.roomselput.makfb[y].value)=="INC" ||  trimString(document.roomselput.makfb[y].value)=="NA"){ }
else{
totsellmak = totsellmak + parseFloat(document.roomselput.makfb[y].value)* <? echo $srooms[$xx] ; ?>;
}
'<?}}?>'
'<?for($m=0; $m<count($a_meals) ; $m++) { if(trim($a_meals[$m])=="sahoor") { ?>'
if(trimString(document.roomselput.maksahoor[y].value)=="INC" ||  trimString(document.roomselput.maksahoor[y].value)=="NA"){ }
else{
totsellmak = totsellmak + parseFloat(document.roomselput.maksahoor[y].value)* <? echo $srooms[$xx] ; ?>;
}
'<?}}?>'
'<?for($m=0; $m<count($a_meals) ; $m++) { if(trim($a_meals[$m])=="iftar") { ?>'
if(trimString(document.roomselput.makiftar[y].value)=="INC" ||  trimString(document.roomselput.makiftar[y].value)=="NA"){ }
else{
totsellmak = totsellmak + parseFloat(document.roomselput.makiftar[y].value)* <? echo $srooms[$xx] ; ?>;
}
'<?}}?>'



}
'<?}}?>'	

'<? if($_POST["hotcb2"]==on){ ?>'
'<? if($othn==1){ ?>'

totsellot = totsellot + parseFloat(document.roomselput.otsr<? echo $srooms[$xx] ; ?>.value) ;

'<?for($m=0; $m<count($a_meals) ; $m++) { if(trim($a_meals[$m])=="breakfast") { ?>'
if(trimString(document.roomselput.otbf.value)=="INC" || trimString(document.roomselput.otbf.value)=="NA"){ }
else{
totsellot = totsellot + parseFloat(document.roomselput.otbf.value)* <? echo $srooms[$xx] ; ?>;
}
'<?}}?>'

'<?for($m=0; $m<count($a_meals) ; $m++) { if(trim($a_meals[$m])=="halfboard") { ?>'

if(trimString(document.roomselput.othb.value)=="INC" ||  trimString(document.roomselput.othb.value)=="NA"){ }
else{
totsellot = totsellot + parseFloat(document.roomselput.othb.value)* <? echo $srooms[$xx] ; ?>;
}
'<?}}?>'
'<?for($m=0; $m<count($a_meals) ; $m++) { if(trim($a_meals[$m])=="fullboard") { ?>'

if(trimString(document.roomselput.otfb.value)=="INC" ||  trimString(document.roomselput.otfb.value)=="NA"){ }
else{
totsellot = totsellot + parseFloat(document.roomselput.otfb.value)* <? echo $srooms[$xx] ; ?>;
}
'<?}}?>'
'<?for($m=0; $m<count($a_meals) ; $m++) { if(trim($a_meals[$m])=="sahoor") { ?>'

if(trimString(document.roomselput.otsahoor.value)=="INC" ||  trimString(document.roomselput.otsahoor.value)=="NA"){ }
else{
totsellot = totsellot + parseFloat(document.roomselput.otsahoor.value)* <? echo $srooms[$xx] ; ?>;
}
'<?}}?>'
'<?for($m=0; $m<count($a_meals) ; $m++) { if(trim($a_meals[$m])=="iftar") { ?>'

if(trimString(document.roomselput.otiftar.value)=="INC" ||  trimString(document.roomselput.otiftar.value)=="NA"){ }
else{
totsellot = totsellot + parseFloat(document.roomselput.otiftar.value)* <? echo $srooms[$xx] ; ?>;
}
'<?}}?>'



'<?}else{?>'

for(z=0; z<document.roomselput.otsr<? echo $srooms[$xx] ; ?>.length; z++){
totsellot = totsellot + parseFloat(document.roomselput.otsr<? echo $srooms[$xx] ; ?>[z].value) ;


'<?for($m=0; $m<count($a_meals) ; $m++) { if(trim($a_meals[$m])=="breakfast") { ?>'
if(trimString(document.roomselput.otbf[z].value)=="INC" ||  trimString(document.roomselput.otbf[z].value)=="NA"){ }
else{
totsellot = totsellot + parseFloat(document.roomselput.otbf[z].value)* <? echo $srooms[$xx] ; ?>;
}
'<?}}?>'

'<?for($m=0; $m<count($a_meals) ; $m++) { if(trim($a_meals[$m])=="halfboard") { ?>'

if(trimString(document.roomselput.othb[z].value)=="INC" ||  trimString(document.roomselput.othb[z].value)=="NA"){ }
else{
totsellot = totsellot + parseFloat(document.roomselput.othb[z].value)* <? echo $srooms[$xx] ; ?>;
}
'<?}}?>'
'<?for($m=0; $m<count($a_meals) ; $m++) { if(trim($a_meals[$m])=="fullboard") { ?>'

if(trimString(document.roomselput.otfb[z].value)=="INC" ||  trimString(document.roomselput.otfb[z].value)=="NA"){ }
else{
totsellot = totsellot + parseFloat(document.roomselput.otfb[z].value)* <? echo $srooms[$xx] ; ?>;
}
'<?}}?>'
'<?for($m=0; $m<count($a_meals) ; $m++) { if(trim($a_meals[$m])=="sahoor") { ?>'
if(trimString(document.roomselput.otsahoor[z].value)=="INC" ||  trimString(document.roomselput.otsahoor[z].value)=="NA"){ }
else{
totsellot = totsellot + parseFloat(document.roomselput.otsahoor[z].value)* <? echo $srooms[$xx] ; ?>;
}
'<?}}?>'
'<?for($m=0; $m<count($a_meals) ; $m++) { if(trim($a_meals[$m])=="iftar") { ?>'
if(trimString(document.roomselput.otiftar[z].value)=="INC" ||  trimString(document.roomselput.otiftar[z].value)=="NA"){ }
else{
totsellot = totsellot + parseFloat(document.roomselput.otiftar[z].value)* <? echo $srooms[$xx] ; ?>;
}
'<?}}?>'



}
'<?}}?>'	


totsell = (totsellmad + totsellmak + totsellot)/'<? echo $srooms[$xx] ; ?>';

'<? if($_POST["visa0"]==on){ ?>'
visa = parseFloat(document.getElementById('vsell').value); 
totsell = totsell  + visa ;

'<?}?>'	
'<? if($_POST["trans0"]==on){ ?>'
trans = parseFloat(document.getElementById('transr').value/<? echo $s_npaxs ; ?>); 
totsell = totsell  + trans ;
'<?}?>'	
'<? if($_POST["servicec"]==on){ ?>'
scsell = parseFloat(document.getElementById('scsell').value);
totsell = totsell  + scsell ;
'<?}?>'	
'<? if($_POST["others0"]==on){ ?>'
ex1sell = parseFloat(document.getElementById('ex1sell').value);
totsell = totsell  + ex1sell ;
'<?}?>'	
'<? if($_POST["others1"]==on){ ?>'
ex2sell = parseFloat(document.getElementById('ex2sell').value);
totsell = totsell  + ex2sell ;
'<?}?>'	
'<? if($_POST["others2"]==on){ ?>'
ex3sell = parseFloat(document.getElementById('ex3sell').value);
totsell = totsell  + ex3sell ;
'<?}?>'	

document.getElementById('finalpn<? echo $srooms[$xx] ; ?>').value = Math.ceil(totnet);

document.getElementById('finalp<? echo $srooms[$xx] ; ?>').value = Math.ceil(totsell);

document.getElementById('finalpnusd<? echo $srooms[$xx] ; ?>').value = Math.ceil(totnet/document.getElementById('usdr').value);

document.getElementById('finalpusd<? echo $srooms[$xx] ; ?>').value = Math.ceil(totsell/document.getElementById('usdr').value);


'<?}?>'	
 

}
calt();
</script>

<?

echo "<input type=\"hidden\" id=\"s_acode\" name=\"s_acode\" value=\"".$s_acode."\">";



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



'<? if($_POST["others0"]==on){ ?>'
	var d1 = new dateObj(document.roomselput.dDay, document.roomselput.dMonth, document.roomselput.dYear);
	initDates(dvy-1, dvy+1, dvy, now_month, now_day, d1);
'<?} ?>'

'<? if($_POST["others1"]==on){ ?>'

   	var d2 = new dateObj(document.roomselput.d1Day, document.roomselput.d1Month, document.roomselput.d1Year);
	initDates(dvy1-1, dvy1+1, dvy1, now_month1, now_day1, d2);
'<?} ?>'
'<? if($_POST["others2"]==on){ ?>'
 	var d3 = new dateObj(document.roomselput.d2Day, document.roomselput.d2Month, document.roomselput.d2Year);
	initDates(dvy2, dvy2+1, dvy2, now_month2, now_day2, d3);
	
 '<?} ?>'

</script>




</body>				
</html>
