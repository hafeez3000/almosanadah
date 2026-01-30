<?
session_cache_limiter('must-revalidate');
include ("header.php");
$vy=$vm=$vd=0;
$vy1=$vm1=$vd1=0;

$rcv =1;
$s_included = "Included";
$s_avi = "Available";
$s_n_avi = "Not Available";
$arr_to_date = array();

$s_hname = "";

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
<script src="../javascripts/cBoxes.js"></script>
<script>
 window.onload = function() {
	document.gquot.hotelsb.focus();
 }
</script>


<script>
document.title= '<? echo $company_name . " ERP - Reservation - Transportation Rates Entry"; ?>';
</script>

<html>
<link rel="stylesheet" type="text/css" href="../calendar/css.css" />
<head>

<script type="text/javascript" src="../javascripts/tooltip.js"></script>
<link rel="stylesheet" href="../css/tooltip.css" type="text/css" /> 

<script>
 var winl = (screen.width - 760) / 2; 
 var wint = (screen.height - 550) / 2;
</script>

<script type="text/javascript">
      function OpenWindow(){
     
		var rr = "transratereportres.php";
		
        var winPop = window.open(rr,"winPop",'scrollbars=yes,toolbar=no,resizable=yes,width=550,height=300' ).focus();
      }
    </script>

</head>
<body leftmargin="0" topmargin="0" rightmargin="0" >
<table width="100%" border="0" cellpadding="0" cellspacing="0" style="border-bottom: 1px solid #999999 ;border-left: 3px solid #006600;border-right: 3px solid #006600"><tr>
    <td bgcolor="#CCCCCC"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">&nbsp;You 
      are here: <a href="uhome.php">Home</a> &raquo; <a href="#">Reservation</a> 
      &raquo; Transportation Rates Entry</font></td>
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
                      <td bgcolor="#CCCCCC"><strong>Reservation Transportation Rates Entry</strong></td>
                    </tr></table>
<table width="100%" cellpadding="1" cellspacing="0"><tr>
                      <td> 
                          <table width="100%" border="0" cellspacing="0" align="center">
                          <?





$s_hotelsb = isset($_POST["hotelsb"]) ? $_POST["hotelsb"] : "";

if($s_hotelsb==""){
$s_hotelsb = isset($_GET["hotid"]) ? $_GET["hotid"] : "";
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
$array_room_id[] = $rows_rooms["trans_id"];


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





$query_g_rates ="select trans_id,from_date,to_date,net_rate,sell_rate,nationality  from res_trans_rates where trans_id like '$s_hotelsb%' order by trans_id";







$result_g_rates = pg_query($conn, $query_g_rates);

if (!$result_g_rates) {
	echo "An error occured.\n";
	exit;
	}

if (pg_num_rows($result_g_rates) == 0) { $rcv = 0 ;}



while ($rows_g_rates = pg_fetch_array($result_g_rates)){

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

echo "<div align=\"right\"><img src=\"../images/print_icon.gif\" width=\"16\" height=\"16\"><a href=\"restransratespv.php?hotid=$s_hotelsb\" target=\"hotdetpop\" onClick=\"window.open('', 'hotdetpop','width=750,height=450,menubar=yes,scrollbars=yes, top='+wint+',left='+winl+' ').focus()\" >Printable View</a>";



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





echo "<tr><td colspan=\"4\" bgcolor=\"#CCCCCC\"><div align=\"left\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";
echo "Check In: " . date('D, jS M, Y', strtotime($arr_from_dates1[$ad])) . " - Check Out: " . date('D, jS M, Y', strtotime($arr_to_dates1[$ad]));

$tipt_dates = date('jS M, Y', strtotime($arr_from_dates1[$ad])) . " - " . date('jS M, Y', strtotime($arr_to_dates1[$ad]));


echo " </font></div></td></tr>";



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
echo "<div id=\"WDN.$arr_weekday_net[$av]\" class=\"tip\">$tipt_dates <b>$array_rooms[$roomta] / $array_route[$roomta]</b> Net Rate  <b>$arr_weekday_net[$av]</b></div>";
echo "<a href=\"#\" onmouseout=\"popUp(event,'WDN.$arr_weekday_net[$av]')\" onmouseover=\"popUp(event,'WDN.$arr_weekday_net[$av]')\" style=\"text-decoration : none;\" onclick=\"return false\">"; 
echo "Net<br>" . $arr_weekday_net[$av];
echo "</font></div></td>";
echo "<td bgcolor=\"#D7FFD7\" onmouseover=\"bgColor='white'\" onmouseout=\"bgColor='#D7FFD7'\"><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";
echo "<div id=\"WDS.$arr_weekday_sell[$av]\" class=\"tip\">$tipt_dates <b>$array_rooms[$roomta] / $array_route[$roomta]</b> Sell Rate  <b>$arr_weekday_sell[$av]</b></div>";
echo "<a href=\"#\" onmouseout=\"popUp(event,'WDS.$arr_weekday_sell[$av]')\" onmouseover=\"popUp(event,'WDS.$arr_weekday_sell[$av]')\"  onclick=\"return false\">";
echo "Sell<br>" . $arr_weekday_sell[$av];
echo "</font></div></td>";



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

// $tscin = strtotime($cind); 
// $ts = strtotime("now");

// $cbd = DateTimeImmutable::createFromTimestamp($ts);
// $cbd = $cbd->setTimezone(new DateTimeZone(date_default_timezone_get()));

// $cbdd = $cbd->format('d');
// $cbdm = $cbd->format('m');
// $cbdy = $cbd->format('Y');

// $cbds = $cbd->format('s');
// $cbdmi = $cbd->format('i');
// $cbdh = $cbd->format('H');

// $ts3=($tscin-$ts)/2;
// echo "<br>";
// // $bd = getdate($ts+$ts3);
// $bd = DateTimeImmutable::createFromTimestamp($ts+$ts3);
// $bd = $bd->setTimezone(new DateTimeZone(date_default_timezone_get()));

//echo $arr_to_date[count($arr_to_date)-1]; die();
if(isset($arr_to_date[count($arr_to_date)-1])) {

$con_d1 = DateTimeImmutable::createFromFormat('Y-m-d', $arr_to_date[count($arr_to_date)-1]);
}
else {
$con_d1 = new DateTimeImmutable();
}

$con_cbd = $con_d1->setTimezone(new DateTimeZone(date_default_timezone_get()));
$cbdd = $con_cbd->format('d');
$cbdm = $con_cbd->format('m');
$cbdy = $con_cbd->format('Y');

$vd=$cbdd;
$vm=$cbdm;
$vy=$cbdy;

$vd1=$cbdd;
$vm1=$cbdm;
$vy1=$cbdy;



echo "</td></tr>";

$s_nation ="All";

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










if($cbb==1) {


$query_dc ="select from_date,to_date from res_trans_rates where (trans_id=$array_room_id[0] and from_date between date '$fromd' and date '$tod') or ( trans_id=$array_room_id[0] and to_date - interval '1 day' between date '$fromd' and date '$tod' )";

$result_dc = pg_query($conn, $query_dc);

if (!$result_dc) {
echo "An error occured.\n";
exit;
		}

echo "sdf" . $rows_dc = pg_num_rows($result_dc);

if($rows_dc>0){
echo "<script> alert (\"Please ensure the dates for which you are entering\");</script>";
}
else {    // date check if else start



for($qf=0; $qf<count($array_room_id); $qf++){


$query_gsno ="select r_t_rate_sno from seq";

$result_gsno = pg_query($conn, $query_gsno);

if (!$result_gsno) {
echo "An error occured.\n";
exit;
		}
while ($rows_gsno = pg_fetch_array($result_gsno)){
$gsno_seq = $rows_gsno["r_t_rate_sno"];
}

pg_free_result($result_gsno);


$ins_wdn = $_POST["weekdayn".$array_room_id[$qf]];
$ins_wds = $_POST["weekdays".$array_room_id[$qf]];


$r_id = $array_room_id[$qf];



$sqlinsgr = "insert into res_trans_rates(rate_sno, trans_id, from_date, to_date, net_rate, sell_rate, nationality, nationalityl) values($gsno_seq, $r_id, '$fromd', '$tod', $ins_wdn, $ins_wds, '$s_nation', '$s_nation1')"; 
pg_query($conn, $sqlinsgr);


$sequpdateg_rate_sno = "update seq set r_t_rate_sno=r_t_rate_sno+1";
pg_query($conn, $sequpdateg_rate_sno);

$cbb=0;


}    // date check if else end



}







} //end if insert







$vd=$mad;
$vm=$mam;
$vy=$may;

if($md==""){
}
else{
$vd1=$md;
$vd1--;
}
$vm1=$mm;
$vy1=$my;








} //end if submit
?>
                          <form name="gquot" action="<?php echo $_SERVER['PHP_SELF']; ?>"  method="post" onSubmit="return fun2(this)">
                            <tr> 
                              <td colspan="5">&nbsp;</td>
                            </tr>
                            <tr bgcolor="#CCCCCC"> 
                              <td colspan="5"><img src="../images/car-icon.gif" width="23" height="14" align="absmiddle">&nbsp;Transportation Rates Entry  
                              <input type="button" id ="hotelreport" name="hotelreport" value="Transportation Rates Report" onClick="OpenWindow()"> </td>
                            </tr>
                            <tr> 
                              <td colspan="5">Hotel: 
                                <select id="hotelsb" name="hotelsb" onchange="this.form.submit();">
<?
if ($s_hotelsb!="") {
	
echo  "<option value=\"$s_hotelsb\">$s_hname - $s_city</option>";}
?>
								  <option value="selecth">Select Transportation Supplier</option>
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
                           </table>									
					
			</td> 
              </tr></table> </td>
        </tr>
      </table></td></tr>
	  
	  
      </table> 
</table>	
	
	

	</tr></table>
<? 


if($rcv==0) {  $vy=$vm=$vd=0; 
  
   $vy1=$vm1=$vd1=0;  } ?>

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

	now_date1.setDate(now_date1.getDate()+1) ;

	var now_day1 = now_date1.getDate();
	var now_month1 = now_date1.getMonth();
	var now_year1 = now_date1.getYear();

    
    

	var d1 = new dateObj(document.gquot.dDay, document.gquot.dMonth, document.gquot.dYear);
	initDates(now_year, now_year+1, now_year, now_month, now_day, d1);

   	var d2 = new dateObj(document.gquot.d1Day, document.gquot.d1Month, document.gquot.d1Year);
	initDates(now_year1, now_year1+1, now_year1, now_month1, now_day1, d2);


</script>

<script>
   

function fun2(theForm){


'<? for($vts=0; $vts<count($array_room_id); $vts++){ ?>'


    if((document.gquot.weekdayn<? echo $array_room_id[$vts] ?>.value == null ) || ( (document.gquot.weekdayn<? echo $array_room_id[$vts] ?>.value).length == 0  )){

    alert("Sorry, but Rates should not be null.");
		document.gquot.weekdayn<? echo $array_room_id[$vts] ?>.focus();
		return false;
   } 

    if((document.gquot.weekdays<? echo $array_room_id[$vts] ?>.value == null ) || ( (document.gquot.weekdays<? echo $array_room_id[$vts] ?>.value).length == 0  )){

    alert("Sorry, but Rates should not be null.");
		document.gquot.weekdays<? echo $array_room_id[$vts] ?>.focus();
		return false;
   } 



'<?}?>'	



if(document.getElementById("inscb").checked == true){ 
document.getElementById("action").value="submitted";
}




}
</script>

</body>				
</html>
