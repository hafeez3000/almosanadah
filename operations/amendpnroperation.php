<?
include ("header.php");
include ("../calendar/cal.php");

$s_pnr = $_GET["spnr"];

$s_opid = $_GET["opid"];

session_start();
$_SESSION['pnr'] = $s_pnr;

$_SESSION['opid'] = $s_opid;

?>
<script src="../javascripts/cBoxes.js"></script>
<script src="../javascripts/DS.js"></script>
<script>
 window.onload = function() {

	document.selhotel.group_id.focus();
 }
</script>

<script>
function subdis(){
document.selhotel.mainsub.disabled = true;

}
function suben(){
document.selhotel.mainsub.disabled = false;
}

function noenter() {
  return !(window.event && window.event.keyCode == 13); }

</script>

<script>
function assv(){
document.selhotel.hotelv.value = document.selhotel.hotel.options[document.selhotel.hotel.selectedIndex].value
}
</script>
<script type="text/javascript">
      function OpenWindow(){

   if ((document.selhotel.hotelname.value== null) || ((document.selhotel.hotelname.value).length==0))
   {
      alert ("Sorry, But enter string to find hotel");
	  document.selhotel.hotelname.focus();
   }
   else {

		var rr = "hotelsearch.php?hn="+document.selhotel.hotelname.value;

        var winPop = window.open(rr,"winPop",'scrollbars=yes,toolbar=no,resizable=yes,width=550,height=300' ).focus();
      }

}
    </script>


<script>
document.title= '<? echo $company_name . " ERP - Umrah New Hotel Booking"; ?>';
</script>

<html>
<link rel="stylesheet" type="text/css" href="../calendar/css.css" />
<body leftmargin="0" topmargin="0" rightmargin="0" >
<table width="100%" border="0" cellpadding="0" cellspacing="0" style="border-bottom: 1px solid #999999 ;border-left: 3px solid #006600;border-right: 3px solid #006600"><tr>
    <td bgcolor="#CCCCCC"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">&nbsp;You
      are here: <a href="uhome.php">Home</a> &raquo; Group Operations &raquo;  Create New Operation</a></font></td>
  </tr></table>

<table width="100%" border="0" cellpadding="0" cellspacing="0" style="border-bottom: 3px solid #006600; border-right: 3px solid #006600;border-left: 3px solid #006600 ">
  <tr>
    <td width="20%" style="border-right: 1px solid #999999" valign="top"> <table width="100%" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td valign="top"><div align="left">
              <?include ("umenu.php"); ?>
            </div></td>
        </tr>
      </table></td>
    <td width="80%" valign="top"  > <table width="100%" border="0" cellpadding="0" cellspacing="1">
        <tr>
          <td valign="top">


		

	<?

$vy=$vm=$vd=0;
$vy1=$vm1=$vd1=0;






$query_operation ="select group_id,station_name,nop_estimated,nop_arrived,nop_depatured,arrived_from,arrival_det,depatured_to,depatured_det,rep_name,rep_name_d,group_leader,is_mazarat,ocode,arrived_at,depatured_at,created_at,passports,pass_rhn,tickets,tickets_rhn from umrah_gm where sno=$s_opid";

$result_operation = pg_query($query_operation);

if (!$result_operation) {
	echo "An error occured.\n";
	exit;
	}
while ($rows_operation = pg_fetch_array($result_operation)){

 $s_group_id = $rows_operation["group_id"];
  $s_station_name = $rows_operation["station_name"];
  $s_nop_estimated = $rows_operation["nop_estimated"];
  $s_nop_arrived = $rows_operation["nop_arrived"];
  $s_nop_depatured = $rows_operation["nop_depatured"];
  $s_arrived_from = $rows_operation["arrived_from"];
  $s_arrival_det = $rows_operation["arrival_det"];
  $s_depatured_to = $rows_operation["depatured_to"];
  $s_depatured_det = $rows_operation["depatured_det"];

  $s_rep_name  = $rows_operation["rep_name"];
  $s_rep_name_d  = $rows_operation["rep_name_d"];
  $s_group_leader = $rows_operation["group_leader"];
  $s_is_mazarat = $rows_operation["is_mazarat"];

  $s_arrived_at = $rows_operation["arrived_at"];
  $s_depatured_at = $rows_operation["depatured_at"];
  $s_passports = $rows_operation["passports"];
  $s_pass_rhn = $rows_operation["pass_rhn"];
  $s_tickets = $rows_operation["tickets"];
  $s_tickets_rhn = $rows_operation["tickets_rhn"];




}
pg_free_result($result_operation);



	?>


            <table width="100%" cellpadding="0" cellspacing="0" ><tr><td width="85%" valign="top">
			<table cellpadding="0" cellspacing="0" width="100%" style="border-top: 1px solid #999999; border-bottom: 1px solid #999999"><tr>
                      <td bgcolor="#CCCCCC"><strong>Amend Operation </strong></td>
                    </tr></table>
<table width="100%" cellpadding="1" cellspacing="0"><tr>
                      <td style="border-bottom: 1px solid #999999"><div align="left"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">
                          <table width="100%" border="0" cellspacing="0">
						  <tr><td colspan="4">&nbsp;</td></tr>

						  <tr bgcolor="#CCCCCC"><td colspan="4">
						  <form name="selhotel" method="post" action="amendpnroperationa.php" onSubmit="return fun2(this)">

<tr><td colspan="3"><table>
<tr bgcolor="#EFEFEF">
<td width="33%" align="right"><font color="Red">*</font><font size="2" face="Verdana, Arial, Helvetica, sans-serif">
Group Id </font></td><td><input type="text" id="group_id" name="group_id"  value=<?php echo $s_group_id ?> >
</td>
<td width="33%" align="right"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">
Station Name </font></td><td>



<select id="station_name" name="station_name">
<option value='<?php echo $s_station_name ; ?>'><?php echo $s_station_name ; ?></option>
<option value="Jeddah">Jeddah</option>
<option value="Makkah">Makkah</option>
<option value="Madinah">Madinah</option>
<option value="Yambu">Yambu</option>
</select>

</td>
<td width="33%" align="right"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">
Arrived From</font> </td><td><input type="text" id="arrived_from" name="arrived_from"  value='<?php echo $s_arrived_from ; ?>' >
</td>
</tr>
<tr bgcolor="#EFEFEF">
<td align="right"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">
Estemated Paxs</font> </td><td>

<select id="est_paxs" name="est_paxs">
<option value='<?php echo $s_nop_estimated ; ?>'><?php echo $s_nop_estimated ; ?></option>

<?php
for($i=0; $i<=500 ; $i++){
echo "<option value=\"$i\">$i</option>";
}
?>
</select>



</td>
<td align="right"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">
Arrived Paxs </font></td><td><select id="arr_paxs" name="arr_paxs">
<option value='<?php echo $s_nop_arrived ; ?>'><?php echo $s_nop_arrived ; ?></option>
<?php
for($i=0; $i<=500 ; $i++){
echo "<option value=\"$i\">$i</option>";
}
?>
</select>

</td>
<td align="right"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">
Depatured Paxs </font></td><td><select id="dep_paxs" name="dep_paxs">
<option value='<?php echo $s_nop_depatured ; ?>'><?php echo $s_nop_depatured ; ?></option>
<?php
for($i=0; $i<=500 ; $i++){
echo "<option value=\"$i\">$i</option>";
}
?>
</select>

</td>
</tr>

<tr bgcolor="#EFEFEF">
<td align="right" ><font size="2" face="Verdana, Arial, Helvetica, sans-serif">
Arrival Details</font> </td><td colspan="5"><textarea id="arrival_det" name="arrival_det" cols="52" rows="3" ><?php echo $s_arrival_det ; ?></textarea>
</td>
</tr>
<tr bgcolor="#EFEFEF">
<td align="right"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">
Group Leader</font> </td><td><input type="text" id="group_leader" name="group_leader" value='<?php echo $s_group_leader; ?>' >
</td>
<td align="right"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">
Depatured to </font></td><td><input type="text" id="depatured_to" name="depatured_to" value='<?php echo $s_depatured_to ;?>' >
</td>
<td colspan="2" bgcolor="#EFEFEF">

</tr>

<tr bgcolor="#EFEFEF">
<td align="right"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">
Arrival Agent  </font></td><td><input type="text" id="received_agentname" name="received_agentname" value='<?php echo $s_rep_name ;?>' >
</td>
<td align="right"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">
Depature Agent </font></td>
<td><input type="text" id="depatured_agentname" name="depatured_agentname" value='<?php echo $s_rep_name_d ;?>' ></td>
<td colspan="2" bgcolor="#EFEFEF">
</tr>





<tr bgcolor="#EFEFEF">
<td align="right" ><font size="2" face="Verdana, Arial, Helvetica, sans-serif">
Deparute Details</font> </td><td colspan="5"><textarea id="depature_det" name="depature_det" cols="52" rows="3" ><?php echo $s_depatured_det; ?></textarea>
</td>
</tr>




</td></tr></table>

<?php
$vy=date('Y', strtotime($s_arrived_at));
$vm=date('m', strtotime($s_arrived_at));
$vd=date('d', strtotime($s_arrived_at));
$a_vmin=date('i', strtotime($s_arrived_at));
$a_vhours=date('H', strtotime($s_arrived_at));

$vy1=date('Y', strtotime($s_depatured_at));
$vm1=date('m', strtotime($s_depatured_at));
$vd1=date('d', strtotime($s_depatured_at));
$d_vmin=date('i', strtotime($s_depatured_at));
$d_vhours=date('H', strtotime($s_depatured_at));


?>

  <tr bgcolor="#EFEFEF">
  <td colspan="3">
  <table align="center">
   <tr>
      <td><font size="2" face="Verdana, Arial, Helvetica, sans-serif">&nbsp;&nbsp;Arrived Date</font></td>
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
        </font></td> <td><select id="timeselecthours0" name="timeselecthours0">


 <option value='<?php echo $a_vhours ; ?>'><?php echo $a_vhours ; ?></option>
 <option value="00">00</option>
 <option value="01">01</option>
 <option value="02">02</option>
 <option value="03">03</option>
 <option value="04">04</option>
 <option value="05">05</option>
 <option value="06">06</option>
 <option value="07">07</option>
 <option value="08">08</option>
 <option value="09">09</option>
 <option value="10">10</option>
 <option value="11">11</option>
 <option value="12">12</option>
 <option value="13">13</option>
 <option value="14">14</option>
 <option value="15">15</option>
 <option value="16">16</option>
 <option value="17">17</option>
 <option value="18">18</option>
 <option value="19">19</option>
 <option value="20">20</option>
 <option value="21">21</option>
 <option value="22">22</option>
 <option value="23">23</option>

                                  </select>
                                    <select id="timeselectmin0" name="timeselectmin0">
									 <option value='<?php echo $a_vmin ; ?>'><?php echo $a_vmin ; ?></option>
                                      <option value="00">00</option>
                                      <option value="01">01</option>
                                      <option value="02">02</option>
                                      <option value="03">03</option>
                                      <option value="04">04</option>
                                      <option value="05">05</option>
                                      <option value="06">06</option>
                                      <option value="07">07</option>
                                      <option value="08">08</option>
                                      <option value="09">09</option>
                                      <option value="10">10</option>
                                      <option value="11">11</option>
                                      <option value="12">12</option>
                                      <option value="13">13</option>
                                      <option value="14">14</option>
                                      <option value="15">15</option>
                                      <option value="16">16</option>
                                      <option value="17">17</option>
                                      <option value="18">18</option>
                                      <option value="19">19</option>
                                      <option value="20">20</option>
                                      <option value="21">21</option>
                                      <option value="22">22</option>
                                      <option value="23">23</option>
                                      <option value="24">24</option>
                                      <option value="25">25</option>
                                      <option value="26">26</option>
                                      <option value="27">27</option>
                                      <option value="28">28</option>
                                      <option value="29">29</option>
                                      <option value="30">30</option>
                                      <option value="31">31</option>
                                      <option value="32">32</option>
                                      <option value="33">33</option>
                                      <option value="34">34</option>
                                      <option value="35">35</option>
                                      <option value="36">36</option>
                                      <option value="37">37</option>
                                      <option value="38">38</option>
                                      <option value="39">39</option>
                                      <option value="40">40</option>
                                      <option value="41">41</option>
                                      <option value="42">42</option>
                                      <option value="43">43</option>
                                      <option value="44">44</option>
                                      <option value="45">45</option>
                                      <option value="46">46</option>
                                      <option value="47">47</option>
                                      <option value="48">48</option>
                                      <option value="49">49</option>
                                      <option value="50">50</option>
                                      <option value="51">51</option>
                                      <option value="52">52</option>
                                      <option value="53">53</option>
                                      <option value="54">54</option>
                                      <option value="55">55</option>
                                      <option value="56">56</option>
                                      <option value="57">57</option>
                                      <option value="58">58</option>
                                      <option value="59">59</option>
                                    </select></td>



      <td><font size="2" face="Verdana, Arial, Helvetica, sans-serif">&nbsp;&nbsp;Depatured Date</font></td>
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
        </font></td> <td><select id="timeselecthours1" name="timeselecthours1">
	 <option value='<?php echo $d_vhours ; ?>'><?php echo $d_vhours ; ?></option>
 <option value="00">00</option>
 <option value="01">01</option>
 <option value="02">02</option>
 <option value="03">03</option>
 <option value="04">04</option>
 <option value="05">05</option>
 <option value="06">06</option>
 <option value="07">07</option>
 <option value="08">08</option>
 <option value="09">09</option>
 <option value="10">10</option>
 <option value="11">11</option>
 <option value="12">12</option>
 <option value="13">13</option>
 <option value="14">14</option>
 <option value="15">15</option>
 <option value="16">16</option>
 <option value="17">17</option>
 <option value="18">18</option>
 <option value="19">19</option>
 <option value="20">20</option>
 <option value="21">21</option>
 <option value="22">22</option>
 <option value="23">23</option>

                                  </select>
                                    <select id="timeselectmin1" name="timeselectmin1">
										 <option value='<?php echo $d_vmin ; ?>'><?php echo $d_vmin ; ?></option>
                                      <option value="00">00</option>
                                      <option value="01">01</option>
                                      <option value="02">02</option>
                                      <option value="03">03</option>
                                      <option value="04">04</option>
                                      <option value="05">05</option>
                                      <option value="06">06</option>
                                      <option value="07">07</option>
                                      <option value="08">08</option>
                                      <option value="09">09</option>
                                      <option value="10">10</option>
                                      <option value="11">11</option>
                                      <option value="12">12</option>
                                      <option value="13">13</option>
                                      <option value="14">14</option>
                                      <option value="15">15</option>
                                      <option value="16">16</option>
                                      <option value="17">17</option>
                                      <option value="18">18</option>
                                      <option value="19">19</option>
                                      <option value="20">20</option>
                                      <option value="21">21</option>
                                      <option value="22">22</option>
                                      <option value="23">23</option>
                                      <option value="24">24</option>
                                      <option value="25">25</option>
                                      <option value="26">26</option>
                                      <option value="27">27</option>
                                      <option value="28">28</option>
                                      <option value="29">29</option>
                                      <option value="30">30</option>
                                      <option value="31">31</option>
                                      <option value="32">32</option>
                                      <option value="33">33</option>
                                      <option value="34">34</option>
                                      <option value="35">35</option>
                                      <option value="36">36</option>
                                      <option value="37">37</option>
                                      <option value="38">38</option>
                                      <option value="39">39</option>
                                      <option value="40">40</option>
                                      <option value="41">41</option>
                                      <option value="42">42</option>
                                      <option value="43">43</option>
                                      <option value="44">44</option>
                                      <option value="45">45</option>
                                      <option value="46">46</option>
                                      <option value="47">47</option>
                                      <option value="48">48</option>
                                      <option value="49">49</option>
                                      <option value="50">50</option>
                                      <option value="51">51</option>
                                      <option value="52">52</option>
                                      <option value="53">53</option>
                                      <option value="54">54</option>
                                      <option value="55">55</option>
                                      <option value="56">56</option>
                                      <option value="57">57</option>
                                      <option value="58">58</option>
                                      <option value="59">59</option>
                                    </select></td>
    </tr>

  </table>

  </td>
  </tr>


    <tr> <td colspan="3" align="center">
    <table>
    <tr bgcolor="#EFEFEF">
<td align="right" width="33%"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">
Passports </font> </td><td>




<select id="passports" name="passports">
<option value='<?php echo $s_passports ; ?>'><?php echo $s_passports ; ?></option>

<?php
for($i=0; $i<=500 ; $i++){
echo "<option value=\"$i\">$i</option>";
}
?>
</select>
</td><td>
<select id="pass_rhn" name="pass_rhn">
<option value='<?php echo $s_pass_rhn ; ?>'><?php echo $s_pass_rhn ; ?></option>
<option value="Nill">Nill</option>
<option value="Received">Received</option>
<option value="Handover">Handover</option>

</select>



</td>
<td align="right" width="33%"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">
Tickets </font></td><td>


<select id="tickets" name="tickets">
<option value='<?php echo $s_tickets ; ?>'><?php echo $s_tickets ; ?></option>
<?php
for($i=0; $i<=500 ; $i++){
echo "<option value=\"$i\">$i</option>";
}
?>

</select>
</td><td>

<select id="tickets_rhn" name="tickets_rhn">
<option value='<?php echo $s_tickets_rhn ; ?>'><?php echo $s_tickets_rhn ; ?></option>
<option value="Nill">Nill</option>
<option value="Received">Received</option>
<option value="Handover">Handover</option>

</select>


</td>

<?php  if($s_is_mazarat=='t'){ $ch_maz = "checked"; } else { $ch_maz = ""; } ?>

<td align="right" width="33%"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">


  <font size="2" face="Verdana, Arial, Helvetica, sans-serif">Operation Mazarath? </font> </td><td><input type="checkbox" id="ch_mazarath" name="ch_mazarath" <?php echo $ch_maz ; ?> >

</td>
</tr>
</table></td>





</tr>

    <tr>




    <tr>
	      <td colspan="3" bgcolor="#EFEFEF"><div align="center">

         <input type="hidden" name="hotelv">
		  <input type="submit" name="mainsub" value="Amend Operation">
        </div></td>
    </tr>


</form></td></tr></table></font></div></td>
                    </tr></table>

			</td>
                <td width="15%" style="border-left: 1px solid #999999" valign="top"><table >
                    <tr>
                      <td style="border-bottom: 1px solid #999999" valign="top"><?php
$time = time();
$today = date('j',$time);
$days = array($today=>array(NULL,NULL,'<span style="color: red; font-weight: bold; font-size: larger; text-decoration: none;">'.$today.'</span>'));
echo generate_calendar(date('Y', $time), date('n', $time), $days, 2);
?>

                        </td>
                    </tr>
					      <tr>
                      <td style="border-bottom: 1px solid #999999"><?php
    $time = time();
    echo generate_calendar(date('Y', $time), date('n', $time)+1, NULL, 2);
?>

                        </td>
                    </tr>
					<tr>

                    </tr>
                  </table>
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


	var now_date = new Date(dvy,dvm-1,dnd);
    now_date.setDate(now_date.getDate())

	var now_day = now_date.getDate();
	var now_month = now_date.getMonth();
	var now_year = now_date.getYear();



	var dvy1 = <?php echo $vy1; ?>; if (dvy1==0) dvy1=tdddate.getYear()
	var dvm1 = <?php echo $vm1; ?>; if (dvm1==0) dvm1=tdddate.getMonth()
	var dnd1 = <?php echo $vd1; ?>; if (dnd1==0) dnd1=tdddate.getDate()

    if (dvy1 < 2000) dvy1 += 1900;


	var now_date1 = new Date(dvy1,dvm1-1,dnd1);
	now_date1.setDate(now_date1.getDate())

	var now_day1 = now_date1.getDate();
	var now_month1 = now_date1.getMonth();
	var now_year1 = now_date1.getYear();

	var d1 = new dateObj(document.selhotel.dDay, document.selhotel.dMonth, document.selhotel.dYear);
	initDates(dvy-1, dvy+1, dvy, now_month, now_day, d1);

   	var d2 = new dateObj(document.selhotel.d1Day, document.selhotel.d1Month, document.selhotel.d1Year);
	initDates(dvy1-1, dvy1+1, dvy1, now_month1, now_day1, d2);

</script>

<script>
// Dates Check Script





</script>

<script>
function fun2(theForm){

if(1){
var cd1= document.selhotel.dDay.value;
var cm1= document.selhotel.dMonth.value;
var cy1= document.selhotel.dYear.value;

var cd2= document.selhotel.d1Day.value;
var cm2= document.selhotel.d1Month.value;
var cy2= document.selhotel.d1Year.value;

var c_date1 = new Date();
c_date1.setFullYear(document.selhotel.dYear.value,document.selhotel.dMonth.value-1,document.selhotel.dDay.value);

var c_date2 = new Date();
c_date2.setFullYear(document.selhotel.d1Year.value,document.selhotel.d1Month.value-1,document.selhotel.d1Day.value);


var server_date = new Date();
server_date.setFullYear(<? echo  date("Y")  .",". (date("m")-1) .",". date("d") ; ?> );
server_date.setHours( <? echo  date("H") ; ?> );
server_date.setMinutes( <? echo  date("i") ; ?> );
server_date.setSeconds( <? echo  date("s") ; ?> );

var n_today = new Date();

//if((server_date-n_today)>1){
//alert("Please Set your computer date to current local date and time");
//return false;
//}

var one_day=1000*60*60*24;



if( ((server_date.getTime()- n_today.getTime()) / (one_day))>1 )
{
alert("Please Set your computer date to current local date and time");
return false;
}
if( ((server_date.getTime()- n_today.getTime()) / (one_day))<-1 )
{
alert("Please Set your computer date to current local date and time");
return false;
}





if(c_date1>c_date2){
alert("Check Out must be after Check In");
return false;
}



}




if ( (document.selhotel.group_id.value == null) ||  ((document.selhotel.group_id.value).length==0))
   {
	alert("Habibi, Enter the Group Id.");
		document.selhotel.group_id.focus();
		return false;
	}else {

	return validateInt();
	}


 function validateInt()
   {
      var o = selhotel.group_id;
      switch (isInteger(o.value))
      {
         case true:
           // alert(o.value + " is an integer")
			return true;
            break;
         case false:
            alert("Please enter numbers")
			return false;
      }
   }




 function isInteger (s)
   {
      var i;

      if (isEmpty(s))
      if (isInteger.arguments.length == 1) return 0;
      else return (isInteger.arguments[1] == true);

      for (i = 0; i < s.length; i++)
      {
         var c = s.charAt(i);

         if (!isDigit(c)) return false;
      }

      return true;
   }

   function isEmpty(s)
   {
      return ((s == null) || (s.length == 0))
   }

   function isDigit (c)
   {
      return ((c >= "0") && (c <= "9"))
   }




if(document.selhotel.city.value=="select"){
	alert("Sorry, but select city first.");
		document.selhotel.city.focus();
		return false;
	}

if(document.selhotel.hotel.value=="select"){
	alert("Sorry, but select Hotel.");
		document.selhotel.hotel.focus();
		return false;
	}





}
</script>


</body>
</html>
