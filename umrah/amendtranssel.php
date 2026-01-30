<?
include ("header.php");
include ("../calendar/cal.php");
?>
<script src="../javascripts/cBoxes.js"></script>


<script>
document.title= '<? echo $company_name . " ERP - Umrah New Bookings"; ?>';
</script>
<script src="../javascripts/DS.js"></script>
<script>
 window.onload = function() {
    dynamicSelect("s_trans0", "typeoftrans0");
 }
</script>

	<?
 $s_pnr = $_GET["spnr"];
 $g_trans_sno = $_GET["transid"];

 $vy1=$vm1=$vd1=0;

 $vmin=0;
 $vhours=0;

 $tot_amt=0;
 $amd_dis=0;

$array_trans_id = array();
$array_trans = array();
$array_trans_city = array();

$array_transt[] = array();
$array_transt_id[] = array();
$array_transt_route[] = array();
$array_nofp[] = array();
$array_transt_description[] = array();


$query_trans ="select trans_id,trans_c_name,city from s_trans";

$result_trans = pg_query($conn, $query_trans);

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

$result_transt = pg_query($conn, $query_transt);

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


if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$_SESSION["spnr"] = $s_pnr ;
$_SESSION["transid"] = $g_trans_sno;


?>



<html>
<link rel="stylesheet" type="text/css" href="../calendar/css.css" />
<body leftmargin="0" topmargin="0" rightmargin="0">
<table width="100%" border="0" cellpadding="0" cellspacing="0" style="border-bottom: 1px solid #999999 ;border-left: 3px solid #006600;border-right: 3px solid #006600"><tr>
    <td bgcolor="#CCCCCC"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">&nbsp;You
      are here: <a href="uhome.php">Home</a> &raquo; <a href="bookings.php">Bookings</a>  &raquo; <a href="newbookings.php">New Bookings</a> &raquo; New Transportation Booking</a></font></td>
  </tr></table>

<table width="100%" border="0" cellpadding="0" cellspacing="0" style="border-bottom: 3px solid #006600; border-right: 3px solid #006600;border-left: 3px solid #006600 ">
  <tr>
    <td width="20%" style="border-right: 1px solid #999999" valign="top"> <table width="100%" border="0" cellpadding="0" cellspacing="0">
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
                      <td bgcolor="#CCCCCC"><strong>New Transport Booking </strong>- Select Transportation</td>
                    </tr></table>
<table width="100%" cellpadding="1" cellspacing="0"><tr>
                      <td  style="border-bottom: 1px solid #999999"><div align="left"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">



					  </font></div></td>
                    </tr></table>

<?php
/**
 *  Listing hotels
 */
$q_hotel_sel ="select sales_hotels_sno,user_sno,hotel_id,room_id,cin,cout,no_rooms,no_nights,no_paxs,sell_rate,booking_status  from sales_hotels where ocode='$s_pnr' order by cin";

$res_hotel_sel = pg_query($conn, $q_hotel_sel);

$rows_hotels = pg_num_rows($res_hotel_sel);

if (!$res_hotel_sel) {
echo "An error occured.\n";
exit;
		}

if($rows_hotels>0){
echo "<br><table width=\"100%\" border=\"1\" cellpadding=\"1\" cellspacing=\"0\"><tr ><td bgcolor=\"#CCCCCC\"><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><b>Hotels</b></font></div></td><td colspan=\"9\"><div align=\"right\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";

if($amd_dis==1) {
echo "Print Request";
}
else{
echo "<a href=\"printhotelreq.php?spnr=$s_pnr\" target=\"hotreqpop\" onClick=\"window.open('', 'hotreqpop','width=750,height=450,menubar=yes,scrollbars=yes, top='+wint+',left='+winl+' ').focus()\" >Print Request</a>";
}


echo "</font></div></td></tr><tr bgcolor=\"#CCCCCC\"><td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><b>Room Type</b></font></div></td><td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><b>Hotel (City)</b></font></div></td><td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><b>Check In</b></font></div></td><td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><b>Check Out</b></font></div></td><td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><b>Rooms</b></font></div></td><td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><b>Price</b></font></div></td><td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><b>Status</b></font></div></td><td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><b>Amend</b></font></div></td><td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><b>Process</b></font></div></td><td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><img src=\"../images/delete.gif\" alt=\"Delete\" ></font></div></td></tr>";
}
while ($rows_hotel_sel = pg_fetch_array($res_hotel_sel)){
$s_hotels_sno = $rows_hotel_sel["sales_hotels_sno"];
$s_user_sno = $rows_hotel_sel["user_sno"];
$s_hotel_id = $rows_hotel_sel["hotel_id"];
$s_room_id = $rows_hotel_sel["room_id"];
$s_cin = $rows_hotel_sel["cin"];
$s_cout = $rows_hotel_sel["cout"];
$s_no_rooms = $rows_hotel_sel["no_rooms"];
$s_no_nigths = $rows_hotel_sel["no_nights"];
$s_no_paxs = $rows_hotel_sel["no_paxs"];
$s_sell_rate = $rows_hotel_sel["sell_rate"];
$s_booking_status = $rows_hotel_sel["booking_status"];

$tot_amt = $tot_amt + $s_sell_rate;

$q_hotel_subsel ="select hotel_name, city from hotels where hotel_id='$s_hotel_id'";

$res_hotel_subsel = pg_query($conn, $q_hotel_subsel);

if (!$res_hotel_subsel) {
echo "An error occured.\n";
exit;
		}
while ($rows_hotel_subsel = pg_fetch_array($res_hotel_subsel)){

$s_hotel_name = $rows_hotel_subsel["hotel_name"];
$s_city = $rows_hotel_subsel["city"];
}

$q_rooms_subsel ="select  room_type from rooms where room_id='$s_room_id'";

$res_rooms_subsel = pg_query($conn, $q_rooms_subsel);

if (!$res_rooms_subsel) {
echo "An error occured.\n";
exit;
		}
while ($rows_rooms_subsel = pg_fetch_array($res_rooms_subsel)){

$s_room_type = $rows_rooms_subsel["room_type"];
}



//echo $s_hotels_sno;
//echo $s_user_sno;
//echo $s_hotel_id;
//echo $s_room_id;
echo "<tr><td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";

echo "<a href=\"roomdetails.php?hotid=$s_hotels_sno\" target=\"hotdetpop\" onClick=\"window.open('', 'hotdetpop','width=700,height=380,menubar=yes,scrollbars=yes, top='+wint+',left='+winl+' ').focus()\" >" . $s_room_type . "</a>";
echo "</font></div></td>";

if($amd_dis==1) {
echo "<td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";
echo $s_hotel_name;
echo " (" . $s_city . ")";
echo "</font></div></td>";
}else {
echo "<td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><a href=\"amendsupplier.php?hotelid=$s_hotels_sno\" onclick=\"return can_chk();\">";
echo $s_hotel_name;
echo " (" . $s_city . ")";
echo "</a></font></div></td>";
}

echo "<td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";
echo date('d-M-Y', strtotime($s_cin));
echo "</font></div></td>";
echo "<td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";

echo date('d-M-Y', strtotime($s_cout));
echo "</font></div></td>";
echo "<td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";
echo $s_no_rooms;
echo "</font></div></td>";
echo "<td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";
echo $s_sell_rate;
echo "</font></div></td>";
echo "<td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";
echo $s_booking_status;
echo "</font></div></td>";
echo "<td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";

if($amd_dis==1)
{
echo "Amend";
}else{
echo "<a href=\"amendhotsel.php?hotid=$s_hotels_sno&spnr=$s_pnr\" onclick=\"return can_chk();\">Amend</a>";
}

echo "</font></div></td>";
echo "<td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";
if($amd_dis==1) {
echo "Process";
}
else{
echo "<a href=\"processhotsel.php?hotid=$s_hotels_sno&spnr=$s_pnr\" onclick=\"return can_chk();\">Process</a>";
}
echo "</font></div></td>";

echo "<td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";

if($amd_dis==1) {
echo "NA";
}else {
echo "<a href=\"pnrhotdel.php?hotid=$s_hotels_sno&spnr=$s_pnr\" onclick=\"return confirm('Are you sure you want to delete Hotel ?')\"><img src=\"../images/delete.gif\" alt=\"Click to Delete\"></a>";
}

echo "</font></div></td>";

echo "</tr>";
}

echo " </table>";



?>




<?
$q_trans_sel ="select sales_trans_sno,req_date_time,f2t,type_of_trans,no_of_units,no_of_paxs,flight_det,sell_rate,tot_net_rate,tot_sell_rate,booking_status,trans_id,trans_id_s  from sales_trans where ocode='$s_pnr' and sales_trans_sno=$g_trans_sno";

$res_trans_sel = pg_query($conn, $q_trans_sel);

 $rows_trans = pg_num_rows($res_trans_sel);

if (!$res_trans_sel) {
echo "An error occured.\n";
exit;
		}

if($rows_trans>0){
echo "<br><table width=\"100%\" border=\"1\" cellpadding=\"1\" cellspacing=\"0\"><tr ><td bgcolor=\"#CCCCCC\"><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><b>Transportation</b></font></div></td><td colspan=\"10\"><div align=\"right\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"></font></div></td></tr><tr bgcolor=\"#CCCCCC\"><td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><b>From - To</b></font></div></td><td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><b>Units</b></font></div></td><td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><b>Type of Trans</b></font></div></td><td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><b>Date & Time</b></font></div></td><td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><b>Flight Details</b></font></div></td><td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><b>No of Paxs</b></font></div></td><td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><b>Total Net Price</b></font></div></td><td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><b>Total Selling Price</b></font></div></td></tr>";


}
while ($rows_trans_sel = pg_fetch_array($res_trans_sel)){

$s_sales_trans_sno = $rows_trans_sel["sales_trans_sno"];

$s_req_date_time = $rows_trans_sel["req_date_time"];
$s_f2t = $rows_trans_sel["f2t"];
$s_type_of_trans = $rows_trans_sel["type_of_trans"];
$s_no_of_units = $rows_trans_sel["no_of_units"];
$s_no_of_paxs = $rows_trans_sel["no_of_paxs"];
$s_flight_det = $rows_trans_sel["flight_det"];
$s_sell_rate = $rows_trans_sel["sell_rate"];
$s_tot_net_rate = $rows_trans_sel["tot_net_rate"];
$s_tot_sell_rate = $rows_trans_sel["tot_sell_rate"];
$s_booking_status = $rows_trans_sel["booking_status"];
$s_trans_id_s = $rows_trans_sel["trans_id_s"];
$s_trans_id = $rows_trans_sel["trans_id"];

$tot_amt = $tot_amt + $s_tot_sell_rate;

echo "<tr><td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";

echo "$s_f2t";
echo "</font></div></td>";
echo "<td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";
echo $s_no_of_units;
echo "</font></div></td>";
echo "<td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";
echo $s_type_of_trans;
echo "</font></div></td>";
echo "<td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";
echo date('d-M-Y H:i A', strtotime($s_req_date_time));
echo "</font></div></td>";
echo "<td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";

echo $s_flight_det;
echo "</font></div></td>";
echo "<td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";
echo $s_no_of_paxs;
echo "</font></div></td>";
echo "<td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";
echo $s_tot_net_rate;
echo "</font></div></td>";
echo "<td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";
echo $s_tot_sell_rate;
echo "</font></div></td>";


echo "</tr>";
}

echo "</table>";

$vy1=date('Y', strtotime($s_req_date_time));
$vm1=date('m', strtotime($s_req_date_time));
$vd1=date('d', strtotime($s_req_date_time));


$vmin=date('i', strtotime($s_req_date_time));
$vhours=date('H', strtotime($s_req_date_time));


?>



<form name="gquot" action="restransamend.php"  method="post">

<table width="100%" align="left" style="border: 1px solid #673636" cellpadding="5" cellspacing="0">
 <tr bgcolor="#E8D2D2">
                                  <td colspan="4" align="center" bgcolor="#E8D2D2">
                                      <strong>Transportation  </strong></td>
                                </tr>
                                <tr>
                                  <td width="17%"><div align="right" ><font size="2" face="Verdana, Arial, Helvetica, sans-serif"> Date</font></div></td>
                                  <td><font size="2" face="Verdana, Arial, Helvetica, sans-serif">
                                    <select name="d1Day" class="selBox">
                                    </select>
                                  </font><font size="2" face="Verdana, Arial, Helvetica, sans-serif">
                                    <select name="d1Month" class="selBox">
                                    </select>
                                                                    </font><font size="2" face="Verdana, Arial, Helvetica, sans-serif">
                                    <select name="d1Year" class="selBox">
                                    </select>                                                                                    </font></td>
                                  <td><div align="right"><font size="2" face="Arial, Helvetica, sans-serif">Time</font></div></td>
                                  <td><select id="timeselecthours0" name="timeselecthours0">
								   <? echo "<option value=\"$vhours\">$vhours</option>" ;?>
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
									 <? echo "<option value=\"$vmin\">$vmin</option>" ;?>
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
                                <tr>
                                  <td><div align="right"><font size="2" face="Arial, Helvetica, sans-serif">Supplier</font></div></td>
                                  <td colspan="3"><font size="2" face="Arial, Helvetica, sans-serif"><strong>
                                    <select id="s_trans0" name="s_trans0">
                                      <?
for($i=0;$i<count($array_trans_id);$i++){
if($array_trans_id[$i]==$s_trans_id_s){
echo  "<option value=\"$s_trans_id_s\">$array_trans[$i]</option>";
}
}

for($i=0;$i<count($array_trans_id);$i++){

 echo  "<option value=\"$array_trans_id[$i]\">$array_trans[$i]</option>";
}
	?>
                                    </select>
                                  </strong></font></td>
                                </tr>
                                <tr>
                                  <td><div align="right"><font size="2" face="Arial, Helvetica, sans-serif">Type
                                  of Transportation</font></div></td>
                                  <td colspan="3"><font size="2" face="Arial, Helvetica, sans-serif"><strong>

                                    <select id="typeoftrans0" name="typeoftrans0">
<?php
$query_trans_toftype ="select trans_type,trans_route from transtypes where trans_id='$s_trans_id' ";
$result_trans_toftype = pg_query($conn, $query_trans_toftype);
if (!$result_trans_toftype) {
    echo "An error occured.\n";
    exit;
}
while($rows_trans_toftype = pg_fetch_array($result_trans_toftype)){
?>

    <option class="select"   value="<?php echo $s_trans_id ; ?>" > <?php echo $rows_trans_toftype['trans_type']. " - " . $rows_trans_toftype['trans_route'] ; ?></option>

<?php
}
?>
    <option class="select"  value="select">Select Transportation Type...</option>
<?

		for($i=0;$i<count($array_transt_id);$i++){
  echo $cv = substr((string)$array_transt_id[$i],0,3);

 echo  "<option class=\"$cv\"  value=\"$array_transt_id[$i]\">$array_transt[$i] - $array_transt_route[$i]</option>";
		}
	?>
                                    </select>
                                  </strong></font></td>
                                </tr>
                                <tr>
                                  <td><div align="right"><font size="2" face="Arial, Helvetica, sans-serif">Flight
                                  Details</font></div></td>
                                  <td><font size="2" face="Arial, Helvetica, sans-serif">
                                    <input id="flightdet0" name="flightdet0" value ='<? echo $s_flight_det ?>' type="text" size="30">
                                  </font></td>
                                  <td><div align="right"><font size="2" face="Arial, Helvetica, sans-serif">No. Units</font></div></td>
                                  <td><font size="2" face="Arial, Helvetica, sans-serif"><font size="2" face="Arial, Helvetica, sans-serif"><strong>
                                    <select id="noofu0" name="noofu0">
                                      <option value="<? echo $s_no_of_units ; ?>"><? echo $s_no_of_units ; ?></option>
                                      <?  for($u0=1;$u0<=50;$u0++){
							echo "<option value=\"$u0\">$u0</option>";
							}?>
                                    </select>
                                  </strong></font></font></td>
                                </tr>
 <tr>
                                  <td colspan="4" style="border-top: 1px solid #673636" align="right">


                                      <input type="submit" name="Submit" value="Get Rates >>">                                    </td>
                                </tr>

</table>



</form>


					  </font></div></td>
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


	var dvy1 = <?php echo $vy1; ?>; if (dvy1==0) dvy1=tdddate.getYear()
	var dvm1 = <?php echo $vm1; ?>; if (dvm1==0) dvm1=tdddate.getMonth()
	var dnd1 = <?php echo $vd1; ?>; if (dnd1==0) dnd1=tdddate.getDate()

    if (dvy1 < 2000) dvy1 += 1900;


	var now_date1 = new Date(dvy1,dvm1-1,dnd1);
	now_date1.setDate(now_date1.getDate())

	var now_day1 = now_date1.getDate();
	var now_month1 = now_date1.getMonth();
	var now_year1 = now_date1.getYear();



   	var d2 = new dateObj(document.gquot.d1Day, document.gquot.d1Month, document.gquot.d1Year);
	initDates(dvy1-1, dvy1+1, dvy1, now_month1, now_day1, d2);

</script>


</body>
</html>
