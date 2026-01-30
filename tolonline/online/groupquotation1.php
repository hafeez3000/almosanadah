
<?
session_cache_limiter('must-revalidate');
include ("header.php");
$vy=$vm=$vd=0;
$vy1=$vm1=$vd1=0;
$vy2=$vm2=$vd2=0;


$query_hotel ="select hotel_id, hotel_name from hotels order by hotel_name";

$result_hotel = pg_query($query_hotel);

if (!$result_hotel) {
	echo "An error occured.\n";
	exit;
	}
while ($rows_hotel = pg_fetch_array($result_hotel)){

$array_hotel[] = $rows_hotel["hotel_name"];
$array_hotel_id[] = $rows_hotel["hotel_id"];

}

pg_free_result($result_hotel);

?>
<?
$array_acccode = array();
$array_aname = array();
$array_country = array();

$query_agents ="select acccode, aname, country from agentsdet order by aname";

$result_agents = pg_query($query_agents);

if (!$result_agents) {
	echo "An error occured.\n";
	exit;
	}
while ($rows_agents = pg_fetch_array($result_agents)){

$array_acccode[] = $rows_agents["acccode"];
$array_aname[] = strtoupper($rows_agents["aname"]);
$array_country[] = strtoupper($rows_agents["country"]);

}

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
      are here: <a href="uhome.php">Home</a> &raquo; <a href="#">Quotations</a> 
      &raquo; Group Quotation</font></td>
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
                      <td bgcolor="#CCCCCC"><strong>Group Quotation</strong></td>
                    </tr></table>
<table width="100%" cellpadding="1" cellspacing="0"><tr>
                      <td> 
                          <table width="100%" border="0" cellspacing="0" align="center">
                          
<?

$s_npaxs = 0;

$s_acccode=$array_acccode[0];
$s_aname=$array_aname[0];
$s_country=$array_country[0];

if (isset($_POST['action']) && $_POST['action'] == 'submitted') {



 $s_npaxs =  $_POST["npaxs"];


 $s_acccode = $_POST["agentname"];

for($ac=0; $ac<count($array_acccode); $ac++){

$inco = $array_acccode[$ac];
if($s_acccode==$inco){

 $s_aname=$array_aname[$ac];
$s_country=$array_country[$ac];

}
}


 $mad = $_POST['dDay'];
$mam = $_POST['dMonth'];
$may = $_POST['dYear'];

$vd=$mad;
$vm=$mam-1;
$vy=$may;


$md = $_POST['d1Day'];
$mm = $_POST['d1Month'];
$my = $_POST['d1Year'];

$vd1=$md;
$vm1=$mm-1;
$vy1=$my;


$od = $_POST['d2Day'];
$om = $_POST['d2Month'];
$oy = $_POST['d2Year'];

$vd2=$od;
$vm2=$om-1;
$vy2=$oy;

$roomselt =  array();

$roomselt[] =  $_POST['roomtype1'];


} //end if submit
?>




						  <form name="gquot" action="<?php echo $_SERVER['PHP_SELF']; ?>"  method="post">
                            <tr bgcolor="#CCCCCC"> 
                              <td colspan="4"> Select Paxs and Agent</td>
                            </tr>
                            <tr> 
                              <td colspan="4"> Select Paxs 
                                <select id="npaxs" name="npaxs" >
                                  
								  <?

echo "<option value=\"$s_npaxs\">$s_npaxs</option>";

		for($i=1;$i<201;$i++){

  echo  "<option value=\"$i\">$i</option>";

}
	?>
                                </select> &nbsp;(Group of ? Paxs)</td>
                            </tr>
                            <tr> 
                              <td colspan="4">Select Agent 
                                <select id="agentname" name="agentname" onChange="this.form.submit();">
                                  <?
echo  "<option value=\"$s_acccode\">$s_aname - $s_country</option>";
	
		for($i=0;$i<count($array_acccode);$i++){
  echo  "<option value=\"$array_acccode[$i]\">$array_aname[$i] - $array_country[$i]</option>";
}
	?>
                                </select></td>
                            </tr>
                            <tr> 
                              <td colspan="4">&nbsp;</td>
                            </tr>
                            <tr bgcolor="#CCCCCC"> 
                              <td colspan="4"> Select Hotels</td>
                            </tr>
                            <tr> 
                              <td colspan="2"><img src="../images/hotel_icon.gif" width="23" height="14">&nbsp;Hotel 
                                in Madinah</td>
                              <td align="center" colspan="2">&nbsp;</td>
                            </tr>
                            <tr> 
                              <td> Check-In </td>
                              <td colspan="2"> <table>
                                  <tr> 
                                    <td><font size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
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
                                </table> </td>
                              <td>Nights 
                                <select id="hotn0" name="hotn0" onChange="gdate();">
                                  <?
		for($i=1;$i<32;$i++){

  echo  "<option value=\"$i\">$i</option>";

}
	?>
                                </select></td>
                            </tr>
                            <tr> 
                              <td><input type="checkbox" id="hotcb0" name="hotcb0" ></td>
                              <td colspan="3" > <select id="hotelsb0" name="hotelsb0">
                                  <option value="select">Select Hotel in Madinah</option>
                                  <?
		for($i=0;$i<count($array_hotel_id);$i++){
if(substr($array_hotel_id[$i],0,2)==12){
  echo  "<option value=\"$array_hotel_id[$i]\">$array_hotel[$i]</option>";
}
}
	?>
                                </select> &nbsp;Meals <select name="meals" MULTIPLE SIZE="1">
                                  <option value="meals">Meals</option>
                                  <option value="breakfast">B/B</option>
                                  <option value="halfboard">H/B</option>
                                  <option value="fullboard">F/B</option>
                                  <option value="sahoor">Sahoor</option>
                                  <option value="iftar">Iftar</option>
                                </select> </td>
                            </tr>
							<tr><td colspan="4"> Type of Room <select id="roomtype1" name="roomtype1[]" MULTIPLE SIZE="1" onChange="roomt1();"  >
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
                                </select> <input type="button" name="showa" value="show" onClick="roomt1();"></td></tr>

							




							
<script>

'<? for($rs=0; $rs<count($roomselt[0]); $rs++){ ?>'

document.getElementById ('roomtype1').options['<? echo $roomselt[0][$rs]-1 ?>'].selected = true;



'<?}?>'	

		
	
	function roomt1(){ 


'<? for($vt=0; $vt<12; $vt++){ ?>'


var v = document.getElementById ('roomtype1').options['<? echo $vt ?>'].selected ;


if(v){

	
	document.getElementById ('rtl<? echo $vt ?>').style.visibility = 'visible';
	document.getElementById ('rtt<? echo $vt ?>').style.visibility = 'visible';
    document.getElementById ('rts<? echo $vt ?>').style.visibility = 'visible';


}
else {
	document.getElementById ('rtl<? echo $vt ?>').style.visibility = 'hidden';
		document.getElementById ('rtt<? echo $vt ?>').style.visibility = 'hidden';
		document.getElementById ('rts<? echo $vt ?>').style.visibility = 'hidden';
}


'<?}?>'	


}
</script>

<tr><td colspan="4" align="center" >

<label id="rtl0" name="rtl0" style="visibility:hidden" >Single</label>							
 <input type="text" id="rtt0" name="rtt0" size="1" style="visibility:hidden">
 <input type="text" id="rts0" name="rts0" size="1" style="visibility:hidden">

 <label id="rtl1" name="rtll" style="visibility:hidden" >Double</label>							
 <input type="text" id="rtt1" name="rtt1" size="1" style="visibility:hidden">
 <input type="text" id="rts1" name="rts1" size="1" style="visibility:hidden">


 <label id="rtl2" name="rtl2" style="visibility:hidden" >Triple</label>							
 <input type="text" id="rtt2" name="rtt2" size="1" style="visibility:hidden">
<input type="text" id="rts2" name="rts2" size="1" style="visibility:hidden">


 <label id="rtl3" name="rtl3" style="visibility:hidden" >Quad</label>							
 <input type="text" id="rtt3" name="rtt3" size="1" style="visibility:hidden">
 <input type="text" id="rts3" name="rts3" size="1" style="visibility:hidden">

 </td><td></tr><tr><td colspan="4" align="center">

 <label id="rtl4" name="rtl4" style="visibility:hidden" >5InRoom</label>							
 <input type="text" id="rtt4" name="rtt4" size="1" style="visibility:hidden">
<input type="text" id="rts4" name="rts4" size="1" style="visibility:hidden">


 <label id="rtl5" name="rtl5" style="visibility:hidden" >6InRoom</label>							
 <input type="text" id="rtt5" name="rtt5" size="1" style="visibility:hidden">
 <input type="text" id="rts5" name="rts5" size="1" style="visibility:hidden">


 <label id="rtl6" name="rtl6" style="visibility:hidden" >7InRoom</label>							
 <input type="text" id="rtt6" name="rtt6" size="1" style="visibility:hidden">
 <input type="text" id="rts6" name="rts6" size="1" style="visibility:hidden">


 <label id="rtl7" name="rtl7" style="visibility:hidden" >8InRoom</label>							
 <input type="text" id="rtt7" name="rtt7" size="1" style="visibility:hidden">
 <input type="text" id="rts7" name="rts7" size="1" style="visibility:hidden">

 </td><td></tr><tr><td colspan="4" align="center">
 <label id="rtl8" name="rtl8" style="visibility:hidden" >9InRoom</label>							
 <input type="text" id="rtt8" name="rtt8" size="1" style="visibility:hidden">
<input type="text" id="rts8" name="rts8" size="1" style="visibility:hidden">


 <label id="rtl9" name="rtl9" style="visibility:hidden" >10InRoom</label>							
 <input type="text" id="rtt9" name="rtt9" size="1" style="visibility:hidden">
 <input type="text" id="rts9" name="rts9" size="1" style="visibility:hidden">

  <label id="rtl10" name="rtl10" style="visibility:hidden" >11InRoom</label>							
 <input type="text" id="rtt10" name="rtt10" size="1" style="visibility:hidden">
 <input type="text" id="rts10" name="rts10" size="1" style="visibility:hidden">
 

  <label id="rtl11" name="rtl11" style="visibility:hidden" >12InRoom</label>							
 <input type="text" id="rtt11" name="rtt11" size="1" style="visibility:hidden">
 <input type="text" id="rts11" name="rts11" size="1" style="visibility:hidden">
							
							</td></tr>


                           
                            <tr> 
                              <td colspan="4" style="border-bottom: 1px dotted #999999;">&nbsp;</td>
                            </tr>
                            <tr> 
                              <td colspan="4">&nbsp; </td>
                            </tr>
                            <tr> 
                              <td colspan="2"><img src="../images/hotel_icon.gif" width="23" height="14">&nbsp;Hotel 
                                in Makkah</td>
                              <td  align="center" colspan="2">&nbsp;</td>
                            </tr>
                            <tr> 
                              <td>Check-In </td>
                              <td colspan="2"> <table>
                                  <tr> 
                                    <td><font size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
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
                                </table>
                              </td>
                              <td>Nights 
                                <select id="select5" name="hotn1">
                                  <?
		for($i=1;$i<32;$i++){

  echo  "<option value=\"$i\">$i</option>";

}
	?>
                                </select></td>
                            </tr>
                            <tr> 
                              <td><input type="checkbox" id="hotcb1" name="hotcb1"></td>
                              <td colspan="3" > <select id="hotelsb1" name="hotelsb1">
                                  <option value="select">Select Hotel in Makkah</option>
                                  <?
		for($i=0;$i<count($array_hotel_id);$i++){
			if(substr($array_hotel_id[$i],0,2)==11){

  echo  "<option value=\"$array_hotel_id[$i]\">$array_hotel[$i]</option>";
			}
}
	?>
                                </select>
                                Meals 
                                <select name="select" MULTIPLE SIZE="1">
                                  <option value="meals">Meals</option>
                                  <option value="breakfast">B/B</option>
                                  <option value="halfboard">H/B</option>
                                  <option value="fullboard">F/B</option>
                                  <option value="sahoor">Sahoor</option>
                                  <option value="iftar">Iftar</option>
                                </select> </td>
                            </tr>
                            <tr> 
                              <td colspan="4"  align="center">Single Net 
                                <input type="text" name="singlen1" size="2">
                                Double Net 
                                <input type="text" name="doublen1" size="2">
                                Triple Net 
                                <input type="text" name="triplen1" size="2">
                                Quard Net 
                                <input type="text" name="quardn1" size="2"></td>
                            </tr>
                            <tr> 
                              <td colspan="4"  align="center">Single Sell 
                                <input type="text" name="single1" size="2">
                                Double Sell 
                                <input type="text" name="double1" size="2">
                                Triple Sell 
                                <input type="text" name="triple1" size="2">
                                Quard Sell 
                                <input type="text" name="quard1" size="2"></td>
                            </tr>
                            <tr> 
                              <td colspan="4" style="border-bottom: 1px dotted #999999;">&nbsp;</td>
                            </tr>
                            <tr> 
                              <td colspan="4">&nbsp; </td>
                            </tr>
                            <tr> 
                              <td colspan="2"><img src="../images/hotel_icon.gif" width="23" height="14">&nbsp;Hotel 
                                in Jeddah (Others)</td>
                              <td  align="center" colspan="2">&nbsp;</td>
                            </tr>
                            <tr> 
                              <td>Check-In </td>
                              <td colspan="2" > <table>
                                  <tr> 
                                    <td><font size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
                                      <select name="d2Day" class="selBox">
                                      </select>
                                      </font></td>
                                    <td><font size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
                                      <select name="d2Month" class="selBox">
                                      </select>
                                      </font></td>
                                    <td><font size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
                                      <select name="d2Year" class="selBox">
                                      </select>
                                      </font></td>
                                  </tr>
                                </table></td>
                              <td >Nights 
                                <select id="select3" name="hotn2">
                                  <?
		for($i=1;$i<32;$i++){

  echo  "<option value=\"$i\">$i</option>";

}
	?>
                                </select></td>
                            </tr>
                            <tr> 
                              <td><input type="checkbox" id="hotcb2" name="hotcb2"></td>
                              <td colspan="3" > <select id="hotelsb2" name="hotelsb2">
                                  <option value="select">Select Hotel</option>
                                  <?
		for($i=0;$i<count($array_hotel_id);$i++){

  echo  "<option value=\"$array_hotel_id[$i]\">$array_hotel[$i]</option>";
}
	?>
                                </select>
                                Meals 
                                <select name="select2" MULTIPLE SIZE="1">
                                  <option value="meals">Meals</option>
                                  <option value="breakfast">B/B</option>
                                  <option value="halfboard">H/B</option>
                                  <option value="fullboard">F/B</option>
                                  <option value="sahoor">Sahoor</option>
                                  <option value="iftar">Iftar</option>
                                </select> </td>
                            </tr>
                            <tr> 
                              <td colspan="4"  align="center">Single Net 
                                <input type="text" name="singlen2" size="2">
                                Double Net 
                                <input type="text" name="doublen2" size="2">
                                Triple Net 
                                <input type="text" name="triplen2" size="2">
                                Quard Net 
                                <input type="text" name="quardn2" size="2"></td>
                            </tr>
                            <tr> 
                              <td colspan="4"  align="center">Single Sell 
                                <input type="text" name="single2" size="2">
                                Double Sell 
                                <input type="text" name="double2" size="2">
                                Triple Sell 
                                <input type="text" name="triple2" size="2">
                                Quard Sell 
                                <input type="text" name="quard2" size="2"></td>
                            </tr>
                            <tr> 
                              <td colspan="4">&nbsp;</td>
                            </tr>
                            <tr bgcolor="#CCCCCC"> 
                              <td colspan="4"><img src="../images/car-icon.gif" width="31" height="15"  align="absmiddle" >&nbsp;Select 
                                Tansportation &amp; Enter rates/pax</td>
                            </tr>
                            <tr> 
                              <td>&nbsp;</td>
                              <td>Trans Description</td>
                              <td  align="center">Net</td>
                              <td  align="center">Sell</td>
                            </tr>
                            <tr> 
                              <td><input type="checkbox" id="trans0" name="trans0"></td>
                              <td ><input type="text" name="transdesc0" size="40"> 
                              </td>
                              <td  align="center" ><input type="text" name="transnet0" size="2"></td>
                              <td  align="center" ><input type="text" name="transsell0" size="2"> 
                              </td>
                            </tr>
                            <tr> 
                              <td colspan="4" >&nbsp; </td>
                            </tr>
                            <tr bgcolor="#CCCCCC"> 
                              <td colspan="4"><img src="../images/i_visa.gif" width="23" height="22" align="absmiddle" >&nbsp 
                                Select Visa &amp; Enter rates/pax</td>
                            </tr>
                            <tr> 
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                              <td  align="center">Net</td>
                              <td  align="center">Sell</td>
                            </tr>
                            <tr> 
                              <td><input type="checkbox" id="visa0" name="visa0"></td>
                              <td >Enter Adult Visa Price</td>
                              <td  align="center" ><input type="text" name="visanet0" size="2"> 
                              </td>
                              <td  align="center" > <input type="text" name="visasell0" size="2"> 
                              </td>
                            </tr>
                            <tr> 
                              <td colspan="3" >&nbsp; </td>
                            </tr>
                            <tr bgcolor="#CCCCCC"> 
                              <td colspan="4">Select Others &amp; Enter rates/pax</td>
                            </tr>
                            <tr> 
                              <td>&nbsp;</td>
                              <td>Others Description</td>
                              <td  align="center">Net</td>
                              <td  align="center">Sell</td>
                            </tr>
                            <tr> 
                              <td><input type="checkbox" id="others0" name="others0"></td>
                              <td ><input type="text" name="othersdesc0" size="40"> 
                              </td>
                              <td  align="center" ><input type="text" name="othersnet0" size="2"> 
                              </td>
                              <td  align="center" > <input type="text" name="otherssell0" size="2"> 
                              </td>
                            </tr>
                            <tr> 
                              <td colspan="4" >&nbsp; </td>
                            </tr>
                            <tr> 
                              <td colspan="4"  align="right">
							  
							     <input type="hidden" name="action" value="submitted" />
							  <input type="submit" name="Submit" value="Make Quotation >>"></td>
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



	var d1 = new dateObj(document.gquot.dDay, document.gquot.dMonth, document.gquot.dYear);
	initDates(dvy-1, dvy+1, dvy, now_month, now_day, d1);

   	var d2 = new dateObj(document.gquot.d1Day, document.gquot.d1Month, document.gquot.d1Year);
	initDates(dvy1-1, dvy1+1, dvy1, now_month1, now_day1, d2);

   	var d3 = new dateObj(document.gquot.d2Day, document.gquot.d2Month, document.gquot.d2Year);
	initDates(dvy2, dvy2+1, dvy2, now_month2, now_day2, d3);
	
 
	function gdate(){

	var now_date4 = new Date(parseInt(document.getElementById ('dYear').value),parseInt(document.getElementById ('dMonth').value)-1,parseInt(document.getElementById ('dDay').value));
    
	now_date4.setDate(now_date4.getDate()+parseInt(document.getElementById ('hotn0').value)) 

	var now_day4 = now_date4.getDate();
	var now_month4 = now_date4.getMonth();
	var now_year4 = now_date4.getYear();

	var d2 = new dateObj(document.gquot.d1Day, document.gquot.d1Month, document.gquot.d1Year);
	initDates(now_year4, now_year4+1, now_year4, now_month4,now_day4, d2);

	}	

</script>





</body>				
</html>
