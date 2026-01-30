<?
session_cache_limiter('must-revalidate');
include ("header.php");
$vy=$vm=$vd=0;
$vy1=$vm1=$vd1=0;
$vy2=$vm2=$vd2=0;
$vy3=$vm3=$vd3=0;
$vy4=$vm4=$vd4=0;


$array_trans = array();
$array_trans_acc = array();

$query_trans ="select trans_c_name,account_code from s_trans";

$result_trans = pg_query($conn, $query_trans);

if (!$result_trans) {
	echo "An error occured.\n";
	exit;
	}
while ($rows_trans = pg_fetch_array($result_trans)){

$array_trans[] = $rows_trans["trans_c_name"];
$array_trans_acc[] = $rows_trans["account_code"];

}

pg_free_result($result_trans);


$query_hotel ="select hotel_id, hotel_name, city from hotels order by hotel_name";

$result_hotel = pg_query($conn, $query_hotel);

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

$result_agents = pg_query($conn, $query_agents);

if (!$result_agents) {
	echo "An error occured.\n";
	exit;
	}
while ($rows_agents = pg_fetch_array($result_agents)){

$array_acccode[] = $rows_agents["acccode"];
$array_aname[] = strtoupper($rows_agents["aname"]);
$array_country[] = strtoupper($rows_agents["scountry"]);

}

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
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
      are here: <a href="uhome.php">Home</a> &raquo; <a href="#">Quotations</a> 
      &raquo; Group Quotation</font></td>
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
                      <td bgcolor="#CCCCCC"><strong>Group Quotation</strong></td>
                    </tr></table>
<table width="100%" cellpadding="1" cellspacing="0"><tr>
                      <td><table width="100%" border="0" cellspacing="0" cellpadding="1" align="center">
                        <?

$s_npaxs = 0;




?>
                        <form name="gquot" action="groupquotationsel.php"  method="post">
                          <tr bgcolor="#CCCCCC">
                            <td colspan="2" > Select Paxs and Agent</td>
                          </tr>
                          <tr>
                            <td colspan="2"> Select Paxs
                              <select id="npaxs" name="npaxs" >
                                  <?

echo "<option value=\"$s_npaxs\">$s_npaxs</option>";

		for($i=1;$i<1000;$i++){

  echo  "<option value=\"$i\">$i</option>";

}
	?>
                                </select>
                              &nbsp;(Group of ? Paxs)</td>
                          </tr>
                          <tr>
                            <td colspan="2">Select Agent
                              <select id="agentname" name="agentname" >
                                  <?
	
		for($i=0;$i<count($array_acccode);$i++){
  echo  "<option value=\"$array_acccode[$i]\">$array_aname[$i] - $array_country[$i]</option>";
}
	?>
                              </select></td>
                          </tr>
                          <tr>
                            <td colspan="2">&nbsp;</td>
                          </tr>
                          <tr bgcolor="#CCCCCC">
                            <td colspan="2">Select Hotels, Transportation, Visa 
                              and others</td>
                          </tr>
                          <tr>
                            <td colspan="2"> Type of Room
                              <select id="roomtype1" name="roomtype1[]" multiple size="1" onChange="roomt1();"  >
                                  <option value="Single">Single</option>
                                  <option value="Double">Double</option>
                                  <option value="Triple">Triple</option>
                                  <option value="Quad">Quad</option>
                                  <option value="5 in Room">5 in Room</option>
                                  <option value="6 in Room">6 in Room</option>
                                  <option value="7 in Room">7 in Room</option>
                                  <option value="8 in Room">8 in Room</option>
                                  <option value="9 in Room">9 in Room</option>
                                  <option value="10 in Room">10 in Room</option>
                                  <option value="11 in Room">11 in Room</option>
                                  <option value="12 in Room">12 in Room</option>
                                </select>
                                <script>

	
	function roomt1(){ 
     
var obj = document.getElementById('roomtype1').length; 
var j = 0; 
var selva = "";


for(j=0;j<obj;j++){ 

if(document.getElementById("roomtype1").options[j].selected == true){ 
selva = selva.concat(document.getElementById("roomtype1").options[j].value, ", ");

}
}



document.getElementById('rtypes').value = selva.substr(0,selva.length-2);


			}
	                    </script>
                              and View Type
                              <select name="viewt">
                                <option value="City View">City View</option>
                                <option value="Haram View">Haram View</option>
                                <option value="Non View">Non View</option>
                                <option value="Kabbah View">Kabbah View</option>
                              </select>
                              and Meals
                              <select name="meals[]" multiple size="1">
                                <option value="meals">Meals</option>
                                <option value="breakfast">B/B</option>
                                <option value="halfboard">H/B</option>
                                <option value="fullboard">F/B</option>
                                <option value="sahoor">Sahoor</option>
                                <option value="iftar">Iftar</option>
                              </select></td>
                          </tr>
                          <tr>
                            <td colspan="2">Room Types
                              <input type="text" name="rtypes" id="rtypes" size="80" readonly></td>
                          </tr>
                          <tr>
                            <td colspan="1"  align="center" width="100%"><table style="border: 1px solid green" cellpadding="5" cellspacing="0" width="100%">
                                <tr>
                                  <td bgcolor="#EAFFEA"><img src="../images/hotel_icon.gif" width="23" height="14">&nbsp;Hotel 
                                    in Madinah
                                    <input type="checkbox" id="hotcb0" name="hotcb0" ></td>
                                </tr>
                                <tr>
                                  <td><div align="center">
                                      <select id="hotelsmad" name="hotelsmad">
                                        <option value="select">Select Hotel 
                                          in Madinah</option>
                                        <?
		for($i=0;$i<count($array_hotel_id);$i++){
if(substr($array_hotel_id[$i],0,2)==12){
  echo  "<option value=\"$array_hotel_id[$i]\">$array_hotel[$i]</option>";
}
}
	?>
                                      </select>
                                  </div></td>
                                </tr>
                                <tr>
                                  <td align="center"><table>
                                      <tr>
                                        <td colspan="3"><div align="center"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Check-In </font></div></td>
                                        <td colspan="2"><div align="center"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"> </font>Nights</div></td>
                                      </tr>
                                      <tr>
                                        <td><font size="2" face="Verdana, Arial, Helvetica, sans-serif">&nbsp;</font>
                                            <select name="dDay" class="selBox" >
                                            </select>                                        </td>
                                        <td><font size="2" face="Verdana, Arial, Helvetica, sans-serif">
                                          <select name="dMonth" class="selBox">
                                          </select>
                                        </font></td>
                                        <td><font size="2" face="Verdana, Arial, Helvetica, sans-serif">
                                          <select name="dYear" class="selBox">
                                          </select>
                                        </font></td>
                                        <td><font size="2" face="Verdana, Arial, Helvetica, sans-serif">
                                          <select id="madn" name="madn" onChange="gdate();">
                                            <?
		for($i=1;$i<32;$i++){

  echo  "<option value=\"$i\">$i</option>";

}
	?>
                                          </select>
                                        </font></td>
                                      </tr>
                                  </table></td>
                                </tr>
                              </table>
                                <div align="center" ></div></td>
                            <td align="center"><table style="border: 1px solid blue" cellpadding="5" cellspacing="0" width="100%">
                                <tr>
                                  <td bgcolor="#D5D5FF"><img src="../images/hotel_icon.gif" width="23" height="14">&nbsp;Hotel 
                                    in Makkah
                                    <input type="checkbox" id="hotcb1" name="hotcb1"></td>
                                </tr>
                                <tr>
                                  <td><div align="center">
                                      <select id="hotelsmak" name="hotelsmak">
                                        <option value="select">Select Hotel 
                                          in Makkah</option>
                                        <?
		for($i=0;$i<count($array_hotel_id);$i++){
			if(substr($array_hotel_id[$i],0,2)==11){

  echo  "<option value=\"$array_hotel_id[$i]\">$array_hotel[$i]</option>";
			}
}
	?>
                                      </select>
                                  </div></td>
                                </tr>
                                <tr>
                                  <td align="center"><table>
                                      <tr>
                                        <td colspan="3"><div align="center"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Check-In </font></div></td>
                                        <td colspan="2"><div align="center"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"> </font>Nights</div></td>
                                      </tr>
                                      <tr>
                                        <td><font size="2" face="Verdana, Arial, Helvetica, sans-serif">&nbsp;</font>
                                            <select name="d1Day" class="selBox" >
                                            </select>                                        </td>
                                        <td><font size="2" face="Verdana, Arial, Helvetica, sans-serif">
                                          <select name="d1Month" class="selBox">
                                          </select>
                                        </font></td>
                                        <td><font size="2" face="Verdana, Arial, Helvetica, sans-serif">
                                          <select name="d1Year" class="selBox">
                                          </select>
                                        </font></td>
                                        <td><font size="2" face="Verdana, Arial, Helvetica, sans-serif">
                                          <select id="makn" name="makn" >
                                            <?
		for($i=1;$i<32;$i++){

  echo  "<option value=\"$i\">$i</option>";

}
	?>
                                          </select>
                                        </font></td>
                                      </tr>
                                  </table></td>
                                </tr>
                              </table>
                            <td align="center" colspan="1">&nbsp;</td>
                          </tr>
                          <tr>
                            <td><div align="center"> </div></td>
                            <td><div align="center"> </div></td>
                          </tr>
                          <tr>
                            <td align="center" width="100%" height="100%"><table style="border: 1px solid red" cellpadding="5" cellspacing="0" width="100%" height="100%">
                                <tr>
                                  <td bgcolor="#FFDFDF"><img src="../images/hotel_icon.gif" width="23" height="14">&nbsp;Hotel 
                                    in Other City
                                    <input type="checkbox" id="hotcb2" name="hotcb2"></td>
                                </tr>
                                <tr>
                                  <td><div align="center">
                                      <select id="hotelsoth" name="hotelsoth">
                                        <option value="select">Select Hotel</option>
                                        <?
		for($i=0;$i<count($array_hotel_id);$i++){

  echo  "<option value=\"$array_hotel_id[$i]\">$array_hotel[$i]</option>";
}
	?>
                                      </select>
                                  </div></td>
                                </tr>
                                <tr>
                                  <td align="center"><table>
                                      <tr>
                                        <td colspan="3"><div align="center">Check-In</div></td>
                                        <td>Nights </td>
                                      </tr>
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
                                        <td><font size="2" face="Verdana, Arial, Helvetica, sans-serif">
                                          <select id="othn" name="othn" onChange="gdate();">
                                            <?
		for($i=1;$i<32;$i++){

  echo  "<option value=\"$i\">$i</option>";

}
	?>
                                          </select>
                                        </font></td>
                                      </tr>
                                  </table></td>
                                </tr>
                            </table></td>
                            <td align="center" width="100%" height="100%"><table width="100%" height="100%" style="border: 1px solid #FF8000" cellpadding="5" cellspacing="0" >
                                <tr>
                                  <td bgcolor="#FFE4CA">Visa, Service Charges&amp; 
                                    Others</td>
                                </tr>
                                <tr>
                                  <td><img src="../images/i_visa.gif" width="23" height="22" align="absmiddle" >
                                      <input type="checkbox" id="visa02" name="visa0">
                                    Visa
                                    <table width="100%">
                                      <tr>
                                        <td><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Request Date</font></td>
                                        <td><font size="2" face="Verdana, Arial, Helvetica, sans-serif">
                                          <select name="d4Day" class="selBox">
                                          </select>
                                        </font></td>
                                        <td><font size="2" face="Verdana, Arial, Helvetica, sans-serif">
                                          <select name="d4Month" class="selBox">
                                          </select>
                                        </font></td>
                                        <td><font size="2" face="Verdana, Arial, Helvetica, sans-serif">
                                          <select name="d4Year" class="selBox">
                                          </select>
                                        </font></td>
                                      </tr>
                                    </table></td>
                                </tr>
                                <tr>
                                  <td><input type="checkbox" id="servicec" name="servicec">
                                    Service Chanrge(s)</td>
                                </tr>
                                <tr>
                                  <td><input type="checkbox" id="others0" name="others0">
                                    others1 &nbsp;&nbsp;
                                    <input type="checkbox" id="others1" name="others1">
                                    others2 &nbsp;&nbsp;
                                    <input type="checkbox" id="others2" name="others2">
                                    others3 </td>
                                </tr>
                            </table></td>
                          </tr>
                          <tr>
                            <td  colspan="2" width="100%" align="left"><table width="100%" align="left" style="border: 1px solid #673636" cellpadding="5" cellspacing="0">
                                <tr bgcolor="#E8D2D2">
                                  <td colspan="2" align="center"><img src="../images/car-icon.gif" width="31" height="15"  align="absmiddle" >
                                      <input type="checkbox" id="trans0" name="trans0">
                                    Transportation </td>
                                </tr>
                                <tr>
                                  <td><div align="right"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"> Date</font></div></td>
                                  <td><font size="2" face="Verdana, Arial, Helvetica, sans-serif">
                                    <select name="d3Day" class="selBox">
                                    </select>
                                  </font><font size="2" face="Verdana, Arial, Helvetica, sans-serif">
                                    <select name="d3Month" class="selBox">
                                    </select>
                                                                    </font><font size="2" face="Verdana, Arial, Helvetica, sans-serif">
                                    <select name="d3Year" class="selBox">
                                    </select>
                                                                                                      </font></td>
                                  </tr>
                                <tr>
                                  <td><div align="right"><font size="2" face="Arial, Helvetica, sans-serif">Time</font></div></td>
                                  <td><select name="timeselecthours">
                                      <option>00</option>
                                      <option>01</option>
                                      <option>02</option>
                                      <option>03</option>
                                      <option>04</option>
                                      <option>05</option>
                                      <option>06</option>
                                      <option>07</option>
                                      <option>08</option>
                                      <option>09</option>
                                      <option>10</option>
                                      <option>11</option>
                                      <option>12</option>
                                      <option>13</option>
                                      <option>14</option>
                                      <option>15</option>
                                      <option>16</option>
                                      <option>17</option>
                                      <option>18</option>
                                      <option>19</option>
                                      <option>20</option>
                                      <option>21</option>
                                      <option>22</option>
                                      <option>23</option>
                                    </select>
                                      <select name="timeselectmin">
                                        <option>00</option>
                                        <option>01</option>
                                        <option>02</option>
                                        <option>03</option>
                                        <option>04</option>
                                        <option>05</option>
                                        <option>06</option>
                                        <option>07</option>
                                        <option>08</option>
                                        <option>09</option>
                                        <option>10</option>
                                        <option>11</option>
                                        <option>12</option>
                                        <option>13</option>
                                        <option>14</option>
                                        <option>15</option>
                                        <option>16</option>
                                        <option>17</option>
                                        <option>18</option>
                                        <option>19</option>
                                        <option>20</option>
                                        <option>21</option>
                                        <option>22</option>
                                        <option>23</option>
                                        <option>24</option>
                                        <option>25</option>
                                        <option>26</option>
                                        <option>27</option>
                                        <option>28</option>
                                        <option>29</option>
                                        <option>30</option>
                                        <option>31</option>
                                        <option>32</option>
                                        <option>33</option>
                                        <option>34</option>
                                        <option>35</option>
                                        <option>36</option>
                                        <option>37</option>
                                        <option>38</option>
                                        <option>39</option>
                                        <option>40</option>
                                        <option>41</option>
                                        <option>42</option>
                                        <option>43</option>
                                        <option>44</option>
                                        <option>45</option>
                                        <option>46</option>
                                        <option>47</option>
                                        <option>48</option>
                                        <option>49</option>
                                        <option>50</option>
                                        <option>51</option>
                                        <option>52</option>
                                        <option>53</option>
                                        <option>54</option>
                                        <option>55</option>
                                        <option>56</option>
                                        <option>57</option>
                                        <option>58</option>
                                        <option>59</option>
                                      </select>                                  </td>
                                </tr>
                                <tr>
                                  <td><div align="right"><font size="2" face="Arial, Helvetica, sans-serif"> Supplier</font></div></td>
                                  <td><font size="2" face="Arial, Helvetica, sans-serif"><strong>
                                    <select id="s_trans" name="s_trans">
                                      <?
echo        "<option value=\"select\">Select Trans Supplier ...</option>";
		

		for($i=0;$i<count($array_trans);$i++){
  echo  "<option value=\"$array_trans_acc[$i]\">$array_trans[$i]</option>";
}
	?>
                                    </select>
                                  </strong></font></td>
                                </tr>
                                <tr>
                                  <td><div align="right"><font size="2" face="Arial, Helvetica, sans-serif"> From - To </font></div></td>
                                  <td><font size="2" face="Arial, Helvetica, sans-serif"><strong>
                                    <select name="f2t">
                                      <option value="Round Trip">Round Trip</option>
                                      <option value="Jeddah To Makkah">Jeddah To Makkah</option>
                                      <option value="Jeddah To Makkah and Back">Jeddah To Makkah and Back</option>
                                      <option value="Makkah To Jeddah">Makkah To Jeddah</option>
                                      <option value="Jeddah To Madinah">Jeddah To Madinah</option>
                                      <option value="Madinah To Jeddah">Madinah To Jeddah</option>
                                      <option value="Makkah To Madinah">Makkah To Madinah</option>
                                      <option value="Madinah To Makkah">Madinah To Makkah</option>
                                      <option value="Madinah Airport To Madinah Hotel">Madinah Airport To Madinah Hotel</option>
                                      <option value="Madinah Hotel To Madinah Airport">Madinah Hotel To Madinah Airport</option>
                                      <option value="Mazarat In Makkah">Mazarat In Makkah</option>
                                      <option value="Mazarat In Madinah">Mazarat In Madinah</option>
                                      <option value="Jeddah Airport To Jeddah Hotel">Jeddah Airport To Jeddah Hotel</option>
                                      <option value="Jeddah Hotel To Jeddah Airport">Jeddah Hotel To Jeddah Airport</option>
                                      <option value="Others">Others</option>
                                    </select>
                                  </strong></font></td>
                                </tr>
                                <tr>
                                  <td><div align="right"><font size="2" face="Arial, Helvetica, sans-serif">Type 
                                    of Transportation</font></div></td>
                                  <td><font size="2" face="Arial, Helvetica, sans-serif"><strong>
                                    <select name="typeoftrans">
                                      <option value="Private Car">Private Car 
                                        - ( 4 Paxs )</option>
                                      <option value="GMC">GMC - ( 6 Paxs )</option>
                                      <option value="Mini Bus">Mini Bus - ( 
                                        14 Paxs )</option>
                                      <option value="Coaster V I P">Coaster 
                                        V I P - ( 25 Paxs )</option>
                                      <option value="Bus">Bus - ( 49 Paxs )</option>
                                    </select>
                                  </strong></font></td>
                                </tr>
                                <tr>
                                  <td><div align="right"><font size="2" face="Arial, Helvetica, sans-serif">Flight 
                                    Details</font></div></td>
                                  <td><font size="2" face="Arial, Helvetica, sans-serif">
                                    <input name="flightdet" type="text" size="30">
                                  </font></td>
                                </tr>
                                <tr>
                                  <td><div align="right"><font size="2" face="Arial, Helvetica, sans-serif"> No of Units</font></div></td>
                                  <td><font size="2" face="Arial, Helvetica, sans-serif"> <font size="2" face="Arial, Helvetica, sans-serif"><strong>
                                    <select name="noofu">
                                      <option value="1">1</option>
                                      <option value="2">2</option>
                                      <option value="3">3</option>
                                      <option value="4">4</option>
                                      <option value="5">5</option>
                                    </select>
                                  </strong></font> </font></td>
                                </tr>
                            </table></td>
                          </tr>
                          <tr>
                            <td colspan="2"  align="right"><input type="hidden" name="action" value="submitted" />
                                <input type="submit" name="Submit" value="Get Rates >>"></td>
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

	var dvy3 = <?php echo $vy3; ?>; if (dvy3==0) dvy3=tdddate.getYear()
	var dvm3 = <?php echo $vm3; ?>; if (dvm3==0) dvm3=tdddate.getMonth()
	var dnd3 = <?php echo $vd3; ?>; if (dnd3==0) dnd3=tdddate.getDate()

    if (dvy3 < 2000) dvy3 += 1900;


	var now_date3 = new Date(dvy3,dvm3,dnd3);
	var now_day3 = now_date3.getDate();
	var now_month3 = now_date3.getMonth();
	var now_year3 = now_date3.getYear();


	var dvy4 = <?php echo $vy4; ?>; if (dvy4==0) dvy4=tdddate.getYear()
	var dvm4 = <?php echo $vm4; ?>; if (dvm4==0) dvm4=tdddate.getMonth()
	var dnd4 = <?php echo $vd4; ?>; if (dnd4==0) dnd4=tdddate.getDate()

    if (dvy4 < 2000) dvy4 += 1900;


	var now_date4 = new Date(dvy4,dvm4,dnd4);
	var now_day4 = now_date4.getDate();
	var now_month4 = now_date4.getMonth();
	var now_year4 = now_date4.getYear();



	var d1 = new dateObj(document.gquot.dDay, document.gquot.dMonth, document.gquot.dYear);
	initDates(dvy-1, dvy+1, dvy, now_month, now_day, d1);

   	var d2 = new dateObj(document.gquot.d1Day, document.gquot.d1Month, document.gquot.d1Year);
	initDates(dvy1-1, dvy1+1, dvy1, now_month1, now_day1, d2);

   	var d3 = new dateObj(document.gquot.d2Day, document.gquot.d2Month, document.gquot.d2Year);
	initDates(dvy2, dvy2+1, dvy2, now_month2, now_day2, d3);
	
   	var d4 = new dateObj(document.gquot.d3Day, document.gquot.d3Month, document.gquot.d3Year);
	initDates(dvy3, dvy3+1, dvy3, now_month3, now_day3, d4);

   	var d5 = new dateObj(document.gquot.d4Day, document.gquot.d4Month, document.gquot.d4Year);
	initDates(dvy4, dvy4+1, dvy4, now_month4, now_day4, d5);
 
	function gdate(){

	var now_date4 = new Date(parseInt(document.getElementById ('dYear').value),parseInt(document.getElementById ('dMonth').value)-1,parseInt(document.getElementById ('dDay').value));
    
	now_date4.setDate(now_date4.getDate()+parseInt(document.getElementById ('madn').value)) 

	var now_day4 = now_date4.getDate();
	var now_month4 = now_date4.getMonth();
	var now_year4 = now_date4.getYear();

	var d2 = new dateObj(document.gquot.d1Day, document.gquot.d1Month, document.gquot.d1Year);
	initDates(now_year4, now_year4+1, now_year4, now_month4,now_day4, d2);

	}	

</script>





</body>				
</html>
