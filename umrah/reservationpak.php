<?
session_cache_limiter('must-revalidate');
include ("header.php");
$vy=$vm=$vd=0;
$vy1=$vm1=$vd1=0;
$vy2=$vm2=$vd2=0;
$vy3=$vm3=$vd3=0;
$vy4=$vm4=$vd4=0;
$vy5=$vm5=$vd5=0;
$vy6=$vm6=$vd6=0;
$vy7=$vm7=$vd7=0;
$vy8=$vm8=$vd8=0;
$vy9=$vm9=$vd9=0;

$vy10=$vm10=$vd10=0;
$vy11=$vm11=$vd11=0;
$vy12=$vm12=$vd12=0;



$array_trans_id = array();
$array_trans = array();
$array_trans_acc = array();

$array_transt[] = array();
$array_transt_id[] = array();
$array_transt_route[] = array();
$array_nofp[] = array();
$array_transt_description[] = array();


$query_trans ="select trans_id,trans_c_name,account_code from s_trans";

$result_trans = pg_query($conn, $query_trans);

if (!$result_trans) {
	echo "An error occured.\n";
	exit;
	}
while ($rows_trans = pg_fetch_array($result_trans)){
$array_trans_id[] = $rows_trans["trans_id"];
$array_trans[] = $rows_trans["trans_c_name"];
$array_trans_acc[] = $rows_trans["account_code"];

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
<script src="../javascripts/DS.js"></script>
<script>
 window.onload = function() {
    dynamicSelect("s_trans0", "typeoftrans0");
	dynamicSelect("s_trans1", "typeoftrans1");
	dynamicSelect("s_trans2", "typeoftrans2");
	dynamicSelect("s_trans3", "typeoftrans3");
 }
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
              <?php include  ("umenupreline.php"); ?>
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
                        <form name="gquot" action="reservationsel.php"  method="post">
                       
                          <tr bgcolor="#CCCCCC">
                            <td colspan="3">Select Hotels, Transportation, Visa 
                              and others</td>
                          </tr>
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
                         
                          <tr>
                            <td  align="center" ><table style="border: 1px solid green" cellpadding="2" cellspacing="0" width="100%" height="100%">
                                <tr>
                                  <td bgcolor="#EAFFEA"><img src="../images/hotel_icon.gif" width="23" height="14">&nbsp;<strong>Hotel 
                                    in Madinah</strong>
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
                                  <td align="center"><table >
                                      <tr>
                                        <td><div align="center"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Check-In </font></div></td>
                                        <td colspan="3"><div align="center"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"> </font><font size="2" face="Verdana, Arial, Helvetica, sans-serif">
                                          <select name="dDay" class="selBox" >
                                          </select>
                                          <select name="dMonth" class="selBox">
                                          </select>
                                          <select name="dYear" class="selBox">
                                          </select>
                                        </font></div></td>
                                      </tr>
                                      <tr>
                                        <td><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Check-Out</font></td>
                                        <td> <select name="d1Day" class="selBox" >
                                          </select>
                                          <select name="d1Month" class="selBox">
                                          </select>
                                          <select name="d1Year" class="selBox">
                                          </select></td>
                                      </tr>
                                  </table></td>
                                </tr>
                              </table>
                                <div align="center" ></div></td>
                            <td align="center" ><table style="border: 1px solid blue" cellpadding="2" cellspacing="0" width="100%" height="100%">
                                <tr>
                                  <td bgcolor="#D5D5FF"><img src="../images/hotel_icon.gif" width="23" height="14">&nbsp;<strong>Hotel 
                                    in Makkah</strong>
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
                                  <td align="center"><table >
                                      <tr>
                                        <td><div align="center"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Check-In </font></div></td>
                                        <td ><div align="center">
                                          <select name="d2Day" class="selBox" >
                                          </select>
                                          <select name="d2Month" class="selBox">
                                          </select>
                                          <select name="d2Year" class="selBox">
                                          </select>
                                        </td>
                                      </tr>
                                      <tr>
                                        <td><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Check-Out</font></td>
                                        <td><select name="d3Day" class="selBox" ></select>
                                          <select name="d3Month" class="selBox">
                                          </select>
                                          <select name="d3Year" class="selBox">
                                          </select></td>
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
                            <td align="center"  colspan="2"><table style="border: 1px solid red" cellpadding="5" cellspacing="0" width="100%" height="100%">
                                <tr>
                                  <td bgcolor="#FFDFDF"><img src="../images/hotel_icon.gif" width="23" height="14">&nbsp;<strong>Hotel 
                                    in Other City</strong>
                                  <input type="checkbox" id="hotcb2" name="hotcb2"></td>
                                </tr>
                                <tr>
                                  <td><div align="center">
                                      <select id="hotelsoth" name="hotelsoth">
                                        <option value="select">Select Hotel</option>
                                        <?
		for($i=0;$i<count($array_hotel_id);$i++){

  echo  "<option value=\"$array_hotel_id[$i]\">$array_hotel[$i] - $array_city[$i]</option>";
}
	?>
                                      </select>
                                  </div></td>
                                </tr>
                                <tr>
                                  <td align="center"><table>
                                      <tr>
                                        <td><div align="center">Check-In</div></td>
                                        <td><font size="2" face="Verdana, Arial, Helvetica, sans-serif">
                                          <select name="d4Day" class="selBox">
                                          </select>
                                          <select name="d4Month" class="selBox">
                                          </select>
                                          <select name="d4Year" class="selBox">
                                          </select>
                                        </font></td>
                                      </tr>
                                      <tr>
                                        <td><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Check-Out</font></td>
                                        <td> <select name="d5Day" class="selBox">
                                          </select>
                                          <select name="d5Month" class="selBox">
                                          </select>
                                          <select name="d5Year" class="selBox">
                                          </select><font size="2" face="Verdana, Arial, Helvetica, sans-serif">&nbsp;
                                          
                                        </font></td>
                                      </tr>
                                  </table></td>
                                </tr>
                            </table></td>
                            
                          </tr>
                         
						  
						  
                            <td  colspan="2" width="100%" align="left"><table width="100%" align="left" style="border: 1px solid #673636" cellpadding="5" cellspacing="0">
                                
                                <tr bgcolor="#E8D2D2">
                                  <td colspan="4" align="center" bgcolor="#E8D2D2"><img src="../images/car-icon.gif" width="31" height="15"  align="absmiddle" >
                                      <input type="checkbox" id="trans0" name="trans0">
                                      <strong>Transportation 1 </strong></td>
                                </tr>
                                <tr>
                                  <td><div align="right"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"> Date</font></div></td>
                                  <td><font size="2" face="Verdana, Arial, Helvetica, sans-serif">
                                    <select name="d6Day" class="selBox">
                                    </select>
                                  </font><font size="2" face="Verdana, Arial, Helvetica, sans-serif">
                                    <select name="d6Month" class="selBox">
                                    </select>
                                                                    </font><font size="2" face="Verdana, Arial, Helvetica, sans-serif">
                                    <select name="d6Year" class="selBox">
                                    </select>                                                                                    </font></td>
                                  <td><div align="right"><font size="2" face="Arial, Helvetica, sans-serif">Time</font></div></td>
                                  <td><select id="timeselecthours0" name="timeselecthours0">
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
                                    <select id="timeselectmin0" name="timeselectmin0">
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
                                    </select></td>
                                </tr>
                                <tr>
                                  <td><div align="right"><font size="2" face="Arial, Helvetica, sans-serif">Supplier</font></div></td>
                                  <td colspan="3"><font size="2" face="Arial, Helvetica, sans-serif"><strong>
                                    <select id="s_trans0" name="s_trans0">
                                      <?
echo        "<option value=\"select\">Select Transportation Supplier ...</option>";
		

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
                                      <option class="select" value="select">Select Transportation Type...</option>
                                      <?
	

		for($i=0;$i<count($array_transt_id);$i++){
  echo $cv = substr($array_transt_id[$i],0,3);
  
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
                                    <input id="flightdet0" name="flightdet0" type="text" size="30">
                                  </font></td>
                                  <td><div align="right"><font size="2" face="Arial, Helvetica, sans-serif">No of Units</font></div></td>
                                  <td><font size="2" face="Arial, Helvetica, sans-serif"><font size="2" face="Arial, Helvetica, sans-serif"><strong>

								  
                                    <select id="noofu0" name="noofu0">
						<?  for($u0=1;$u0<=50;$u0++){ 
							echo "<option value=\"$u0\">$u0</option>";
							}?>
                                    </select>
                                  </strong></font></font></td>
                                </tr>
                                <tr>
                                  <td colspan="4"><div align="right"></div></td>
                                </tr>
                                <tr bgcolor="#E8D2D2">
                                  <td colspan="4" bgcolor="#E8D2D2"><div align="center"><img src="../images/car-icon.gif" width="31" height="15"  align="absmiddle" >
                                      <input type="checkbox" id="trans1" name="trans1">
                                      <strong>Transportation 2</strong> </div></td>
                                </tr>
                                <tr>
                                  <td><div align="right"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"> Date</font></div></td>
                                  <td><font size="2" face="Verdana, Arial, Helvetica, sans-serif">
                                    <select name="d7Day" class="selBox">
                                    </select>
                                    </font><font size="2" face="Verdana, Arial, Helvetica, sans-serif">
                                    <select name="d7Month" class="selBox">
                                    </select>
                                    </font><font size="2" face="Verdana, Arial, Helvetica, sans-serif">
                                    <select name="d7Year" class="selBox">
                                    </select>
                                  </font></td>
                                  <td><div align="right"><font size="2" face="Arial, Helvetica, sans-serif">Time</font></div></td>
                                  <td><select id="timeselecthours1" name="timeselecthours1">
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
                                      <select name="timeselectmin1">
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
                                    </select></td>
                                </tr>
                                <tr>
                                  <td><div align="right"><font size="2" face="Arial, Helvetica, sans-serif">Supplier</font></div></td>
                                  <td colspan="3"><font size="2" face="Arial, Helvetica, sans-serif"><strong>
                                    <select id="s_trans1" name="s_trans1">
                                      <?
echo        "<option value=\"select\">Select Transportation Supplier ...</option>";
		

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
                                  <td><font size="2" face="Arial, Helvetica, sans-serif"><strong>
                                    <select name="typeoftrans1">
                                     <option class="select" value="select">Select Transportation Type...</option>
                                      <?
	

		for($i=0;$i<count($array_transt_id);$i++){
  echo $cv = substr($array_transt_id[$i],0,3);
  
 echo  "<option class=\"$cv\"  value=\"$array_transt_id[$i]\">$array_transt[$i] - $array_transt_route[$i]</option>";
		}
	?>
                                    </select>
                                  </strong></font></td>
                                  <td>&nbsp;</td>
                                  <td>&nbsp;</td>
                                </tr>
                                <tr>
                                  <td><div align="right"><font size="2" face="Arial, Helvetica, sans-serif">Flight 
                                    Details</font></div></td>
                                  <td><font size="2" face="Arial, Helvetica, sans-serif">
                                    <input name="flightdet1" type="text" size="30">
                                  </font></td>
                                  <td><div align="right"><font size="2" face="Arial, Helvetica, sans-serif">No of Units</font></div></td>
                                  <td><font size="2" face="Arial, Helvetica, sans-serif"><font size="2" face="Arial, Helvetica, sans-serif"><strong>
                                    <select name="noofu1">
                                      <?  for($u1=1;$u1<=50;$u1++){ 
							echo "<option value=\"$u1\">$u1</option>";
							}?>
                                    </select>
                                  </strong></font></font></td>
                                </tr>
                                
                                <tr bgcolor="#E8D2D2">
                                  <td colspan="4" bgcolor="#E8D2D2"><div align="center"><img src="../images/car-icon.gif" width="31" height="15"  align="absmiddle" >
                                          <input type="checkbox" id="trans2" name="trans2">
                                          <strong>Transportation 3</strong> </div></td>
                                </tr>
                                <tr>
                                  <td><div align="right"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"> Date</font></div></td>
                                  <td><font size="2" face="Verdana, Arial, Helvetica, sans-serif">
                                    <select name="d8Day" class="selBox">
                                    </select>
                                    </font><font size="2" face="Verdana, Arial, Helvetica, sans-serif">
                                    <select name="d8Month" class="selBox">
                                    </select>
                                    </font><font size="2" face="Verdana, Arial, Helvetica, sans-serif">
                                    <select name="d8Year" class="selBox">
                                    </select>
                                  </font></td>
                                  <td><div align="right"><font size="2" face="Arial, Helvetica, sans-serif">Time</font></div></td>
                                  <td><div align="left">
                                    <select name="timeselecthours2">
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
                                    <select name="timeselectmin2">
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
                                      </select>
                                  </div></td>
                                </tr>
                                <tr>
                                  <td><div align="right"><font size="2" face="Arial, Helvetica, sans-serif">Supplier</font></div></td>
                                  <td colspan="3"><font size="2" face="Arial, Helvetica, sans-serif"><strong>
                                    <select id="s_trans2" name="s_trans2">
                                      <?
echo        "<option value=\"select\">Select Trans Supplier ...</option>";
		

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
                                    <select name="typeoftrans2">
									 <option class="select" value="select">Select Transportation Type...</option>
                                    <?
	

		for($i=0;$i<count($array_transt_id);$i++){
  echo $cv = substr($array_transt_id[$i],0,3);
  
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
                                    <input name="flightdet2" type="text" size="30">
                                  </font></td>
                                  <td><div align="right"><font size="2" face="Arial, Helvetica, sans-serif">No of Units</font></div></td>
                                  <td><div align="left"><font size="2" face="Arial, Helvetica, sans-serif"><font size="2" face="Arial, Helvetica, sans-serif"><strong>
                                    <select name="noofu2">
                                      <?  for($u2=1;$u2<=50;$u2++){ 
							echo "<option value=\"$u2\">$u2</option>";
							}?>
                                    </select>
                                  </strong></font></font></div></td>
                                </tr>
                               
                               <tr>
						  <td  colspan="2" align="center"></td>
						  </tr>
						  
						 <tr bgcolor="#E8D2D2">
                                  <td colspan="4" bgcolor="#E8D2D2"><div align="center"><img src="../images/car-icon.gif" width="31" height="15"  align="absmiddle" >
                                          <input type="checkbox" id="trans3" name="trans3">
                                          <strong>Transportation 4 </strong> </div></td>
                                </tr>
                                <tr>
                                  <td><div align="right"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"> Date</font></div></td>
                                  <td><font size="2" face="Verdana, Arial, Helvetica, sans-serif">
                                    <select name="d9Day" class="selBox">
                                    </select>
                                    </font><font size="2" face="Verdana, Arial, Helvetica, sans-serif">
                                    <select name="d9Month" class="selBox">
                                    </select>
                                    </font><font size="2" face="Verdana, Arial, Helvetica, sans-serif">
                                    <select name="d9Year" class="selBox">
                                    </select>
                                  </font></td>
                                  <td><div align="right"><font size="2" face="Arial, Helvetica, sans-serif">Time</font></div></td>
                                  <td><select name="timeselecthours3">
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
                                      <select name="timeselectmin3">
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
                                    </select></td>
                                </tr>
                                <tr>
                                  <td><div align="right"><font size="2" face="Arial, Helvetica, sans-serif">Supplier</font></div></td>
                                  <td colspan="3"><font size="2" face="Arial, Helvetica, sans-serif"><strong>
                                    <select id="s_trans3" name="s_trans3">
                                      <?
echo        "<option value=\"select\">Select Trans Supplier ...</option>";
		

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
                                    <select name="typeoftrans3">
									 <option class="select" value="select">Select Transportation Type...</option>
                                   <?
	

		for($i=0;$i<count($array_transt_id);$i++){
  echo $cv = substr($array_transt_id[$i],0,3);
  
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
                                    <input name="flightdet3" type="text" size="30">
                                  </font></td>
                                  <td><div align="right"><font size="2" face="Arial, Helvetica, sans-serif">No of Units</font></div></td>
                                  <td><font size="2" face="Arial, Helvetica, sans-serif"><font size="2" face="Arial, Helvetica, sans-serif"><strong>
                                    <select name="noofu3">
                                      <?  for($u3=1;$u3<=50;$u3++){ 
							echo "<option value=\"$u3\">$u3</option>";
							}?>
                                    </select>
                                  </strong></font></font></td>
                                </tr>
                               
						<tr>
						  <td  colspan="2" align="center"></td>
						  </tr>
						  
						 <tr bgcolor="#E8D2D2">
                                  <td colspan="4" bgcolor="#B9F4AE"><div align="center">
                                          <input type="checkbox" id="others0" name="others0">
                                  <strong>Other Request 1</strong> </div></td>
                                </tr>

  <tr><td colspan="4">

				

					        <table align="center" width="100%">
                              <tr> 
                                <td><div align="right"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Requesting 
                                    Date</font></div></td>
                                <td><font size="2" face="Verdana, Arial, Helvetica, sans-serif">
                                  <select name="d10Day" class="selBox">
                                  </select>
                                </font><font size="2" face="Verdana, Arial, Helvetica, sans-serif">
                                <select name="d10Month" class="selBox">
                                </select>
                                </font><font size="2" face="Verdana, Arial, Helvetica, sans-serif">
                                <select name="d10Year" class="selBox">
                                </select>
                                </font></td>
                                <td><div align="center"><font size="2" face="Arial, Helvetica, sans-serif">Paticulars 
                                  of the Request</font></div></td>
                                </tr>
                              <tr> 
                                <td><div align="right"><font size="2" face="Arial, Helvetica, sans-serif">Enter 
                                    Net Rate</font></div>                                  </td>
                                <td><input type="text" id="other1nrate" name="other1nrate" size="2"></td>
                                <td rowspan="2"><div align="center"><font size="2" face="Arial, Helvetica, sans-serif"><strong> 
                                  <textarea id="other1noofa" name="other1noofa" cols="25" rows="3"></textarea>
                                </strong></font></div></td>
                              </tr>
							   <tr> 
                                <td><div align="right"><font size="2" face="Arial, Helvetica, sans-serif">Enter 
                                    Selling Rate</font></div></td>
                                <td><font size="2" face="Arial, Helvetica, sans-serif"><strong>
                                  <input type="text" id="other1srate" name="other1srate" size="2">
                                </strong></font></td>
                                </tr>
                            </table>

  </td></tr>


  <tr>
						  <td  colspan="2" align="center"></td>
						  </tr>
						  
						 <tr bgcolor="#E8D2D2">
                                  <td colspan="4" bgcolor="#B9F4AE"><div align="center">
                                          <input type="checkbox" id="others1" name="others1">
                                  <strong>Other Request 2</strong> </div></td>
                                </tr>

  <tr><td colspan="4">

				

					        <table align="center" width="100%">
                              <tr> 
                                <td><div align="right"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Requesting 
                                    Date</font></div></td>
                                <td><font size="2" face="Verdana, Arial, Helvetica, sans-serif">
                                  <select name="d11Day" class="selBox">
                                  </select>
                                </font><font size="2" face="Verdana, Arial, Helvetica, sans-serif">
                                <select name="d11Month" class="selBox">
                                </select>
                                </font><font size="2" face="Verdana, Arial, Helvetica, sans-serif">
                                <select name="d11Year" class="selBox">
                                </select>
                                </font></td>
                                <td><div align="center"><font size="2" face="Arial, Helvetica, sans-serif">Paticulars 
                                  of the Request</font></div></td>
                                </tr>
                              <tr> 
                                <td><div align="right"><font size="2" face="Arial, Helvetica, sans-serif">Enter 
                                    Net Rate</font></div>                                  </td>
                                <td><input type="text" id="other2nrate" name="other2nrate" size="2"></td>
                                <td rowspan="2"><div align="center"><font size="2" face="Arial, Helvetica, sans-serif"><strong> 
                                  <textarea id="other2noofa" name="other2noofa" cols="25" rows="3"></textarea>
                                </strong></font></div></td>
                              </tr>
							   <tr> 
                                <td><div align="right"><font size="2" face="Arial, Helvetica, sans-serif">Enter 
                                    Selling Rate</font></div></td>
                                <td><font size="2" face="Arial, Helvetica, sans-serif"><strong>
                                  <input type="text" id="other2srate" name="other2srate" size="2">
                                </strong></font></td>
                                </tr>
                            </table>

  </td></tr>

  <tr>
						  <td  colspan="2" align="center"></td>
						  </tr>
						  
						 <tr bgcolor="#E8D2D2">
                                  <td colspan="4" bgcolor="#B9F4AE"><div align="center">
                                          <input type="checkbox" id="others2" name="others2">
                                  <strong>Other Request 3</strong> </div></td>
                                </tr>

  <tr><td colspan="4">

				

					        <table align="center" width="100%">
                              <tr> 
                                <td><div align="right"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Requesting 
                                    Date</font></div></td>
                                <td><font size="2" face="Verdana, Arial, Helvetica, sans-serif">
                                  <select name="d12Day" class="selBox">
                                  </select>
                                </font><font size="2" face="Verdana, Arial, Helvetica, sans-serif">
                                <select name="d12Month" class="selBox">
                                </select>
                                </font><font size="2" face="Verdana, Arial, Helvetica, sans-serif">
                                <select name="d12Year" class="selBox">
                                </select>
                                </font></td>
                                <td><div align="center"><font size="2" face="Arial, Helvetica, sans-serif">Paticulars 
                                  of the Request</font></div></td>
                                </tr>
                              <tr> 
                                <td><div align="right"><font size="2" face="Arial, Helvetica, sans-serif">Enter 
                                    Net Rate</font></div>                                  </td>
                                <td><input type="text" id="other3nrate" name="other3nrate" size="2"></td>
                                <td rowspan="2"><div align="center"><font size="2" face="Arial, Helvetica, sans-serif"><strong> 
                                  <textarea id="other3noofa" name="other3noofa" cols="25" rows="3"></textarea>
                                </strong></font></div></td>
                              </tr>
							   <tr> 
                                <td><div align="right"><font size="2" face="Arial, Helvetica, sans-serif">Enter 
                                    Selling Rate</font></div></td>
                                <td><font size="2" face="Arial, Helvetica, sans-serif"><strong>
                                  <input type="text" id="other3srate" name="other3srate" size="2">
                                </strong></font></td>
                                </tr>
                            </table>

  </td></tr>


                               <tr>
						  <td  colspan="2" align="center"></td>
						  </tr> 
                                <tr>
                                  <td colspan="4" style="border-top: 1px solid #673636" align="right">
								  
			<input type="hidden" name="action" value="submitted" />
                                      <input type="submit" name="Submit" value="Get Rates >>">                                    </td>
                                </tr>
                            </table></td>
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
    


	

	var tdddate = new Date();
 
    var dvy = <?php echo $vy; ?>; if (dvy==0) dvy=tdddate.getYear()
	var dvm = <?php echo $vm; ?>; if (dvm==0) dvm=tdddate.getMonth()
	var dnd = <?php echo $vd; ?>; if (dnd==0) dnd=tdddate.getDate()

   if (dvy < 2000) dvy += 1900;	


	var now_date = new Date(dvy,dvm,dnd);
	now_date.setDate(now_date.getDate()+1) 

	var now_day = now_date.getDate();
	var now_month = now_date.getMonth();
	var now_year = now_date.getYear();

	var dvy1 = <?php echo $vy1; ?>; if (dvy1==0) dvy1=tdddate.getYear()
	var dvm1 = <?php echo $vm1; ?>; if (dvm1==0) dvm1=tdddate.getMonth()
	var dnd1 = <?php echo $vd1; ?>; if (dnd1==0) dnd1=tdddate.getDate()

    if (dvy1 < 2000) dvy1 += 1900;


	var now_date1 = new Date(dvy1,dvm1,dnd1);
	now_date1.setDate(now_date1.getDate()+3) 

	var now_day1 = now_date1.getDate();
	var now_month1 = now_date1.getMonth();
	var now_year1 = now_date1.getYear();


	var dvy2 = <?php echo $vy2; ?>; if (dvy2==0) dvy2=tdddate.getYear()
	var dvm2 = <?php echo $vm2; ?>; if (dvm2==0) dvm2=tdddate.getMonth()
	var dnd2 = <?php echo $vd2; ?>; if (dnd2==0) dnd2=tdddate.getDate()

    if (dvy2 < 2000) dvy2 += 1900;


	var now_date2 = new Date(dvy2,dvm2,dnd2);
	now_date2.setDate(now_date2.getDate()+1)

	var now_day2 = now_date2.getDate();
	var now_month2 = now_date2.getMonth();

	var now_year2 = now_date2.getYear();

	var dvy3 = <?php echo $vy3; ?>; if (dvy3==0) dvy3=tdddate.getYear()
	var dvm3 = <?php echo $vm3; ?>; if (dvm3==0) dvm3=tdddate.getMonth()
	var dnd3 = <?php echo $vd3; ?>; if (dnd3==0) dnd3=tdddate.getDate()

    if (dvy3 < 2000) dvy3 += 1900;


	var now_date3 = new Date(dvy3,dvm3,dnd3);
	now_date3.setDate(now_date3.getDate()+3)
	var now_day3 = now_date3.getDate();
	var now_month3 = now_date3.getMonth();
	var now_year3 = now_date3.getYear();


	var dvy4 = <?php echo $vy4; ?>; if (dvy4==0) dvy4=tdddate.getYear()
	var dvm4 = <?php echo $vm4; ?>; if (dvm4==0) dvm4=tdddate.getMonth()
	var dnd4 = <?php echo $vd4; ?>; if (dnd4==0) dnd4=tdddate.getDate()

    if (dvy4 < 2000) dvy4 += 1900;


	var now_date4 = new Date(dvy4,dvm4,dnd4);
	now_date4.setDate(now_date4.getDate()+1) 
	var now_day4 = now_date4.getDate();
	var now_month4 = now_date4.getMonth();
	var now_year4 = now_date4.getYear();



    var dvy5 = <?php echo $vy5; ?>; if (dvy5==0) dvy5=tdddate.getYear()
	var dvm5 = <?php echo $vm5; ?>; if (dvm5==0) dvm5=tdddate.getMonth()
	var dnd5 = <?php echo $vd5; ?>; if (dnd5==0) dnd5=tdddate.getDate()

    if (dvy5 < 2000) dvy5 += 1900;


	var now_date5 = new Date(dvy5,dvm5,dnd5);
	now_date5.setDate(now_date5.getDate()+3) 
	var now_day5 = now_date5.getDate();
	var now_month5 = now_date5.getMonth();
	var now_year5 = now_date5.getYear();

    var dvy6 = <?php echo $vy6; ?>; if (dvy6==0) dvy6=tdddate.getYear()
	var dvm6 = <?php echo $vm6; ?>; if (dvm6==0) dvm6=tdddate.getMonth()
	var dnd6 = <?php echo $vd6; ?>; if (dnd6==0) dnd6=tdddate.getDate()

    if (dvy6 < 2000) dvy6 += 1900;


	var now_date6 = new Date(dvy6,dvm6,dnd6);
	var now_day6 = now_date6.getDate();
	var now_month6 = now_date6.getMonth();
	var now_year6 = now_date6.getYear();


	   var dvy7 = <?php echo $vy7; ?>; if (dvy7==0) dvy7=tdddate.getYear()
	var dvm7 = <?php echo $vm7; ?>; if (dvm7==0) dvm7=tdddate.getMonth()
	var dnd7 = <?php echo $vd7; ?>; if (dnd7==0) dnd7=tdddate.getDate()

    if (dvy7 < 2000) dvy7 += 1900;


	var now_date7 = new Date(dvy7,dvm7,dnd7);
	var now_day7 = now_date7.getDate();
	var now_month7 = now_date7.getMonth();
	var now_year7 = now_date7.getYear();


	var dvy8 = <?php echo $vy8; ?>; if (dvy8==0) dvy8=tdddate.getYear()
	var dvm8 = <?php echo $vm8; ?>; if (dvm8==0) dvm8=tdddate.getMonth()
	var dnd8 = <?php echo $vd8; ?>; if (dnd8==0) dnd8=tdddate.getDate()

    if (dvy8 < 2000) dvy8 += 1900;


	var now_date8 = new Date(dvy8,dvm8,dnd8);
	var now_day8 = now_date8.getDate();
	var now_month8 = now_date8.getMonth();
	var now_year8 = now_date8.getYear();


    var dvy9 = <?php echo $vy9; ?>; if (dvy9==0) dvy9=tdddate.getYear()
	var dvm9 = <?php echo $vm9; ?>; if (dvm9==0) dvm9=tdddate.getMonth()
	var dnd9 = <?php echo $vd9; ?>; if (dnd9==0) dnd9=tdddate.getDate()

    if (dvy9 < 2000) dvy9 += 1900;


	var now_date9 = new Date(dvy9,dvm9,dnd9);
	var now_day9 = now_date9.getDate();
	var now_month9 = now_date9.getMonth();
	var now_year9 = now_date9.getYear();



    var dvy10 = <?php echo $vy10; ?>; if (dvy10==0) dvy10=tdddate.getYear()
	var dvm10 = <?php echo $vm10; ?>; if (dvm10==0) dvm10=tdddate.getMonth()
	var dnd10 = <?php echo $vd10; ?>; if (dnd10==0) dnd10=tdddate.getDate()

    if (dvy10 < 2000) dvy10 += 1900;


	var now_date10 = new Date(dvy10,dvm10,dnd10);
	var now_day10 = now_date10.getDate();
	var now_month10 = now_date10.getMonth();
	var now_year10 = now_date10.getYear();


    var dvy11 = <?php echo $vy11; ?>; if (dvy11==0) dvy11=tdddate.getYear()
	var dvm11 = <?php echo $vm11; ?>; if (dvm11==0) dvm11=tdddate.getMonth()
	var dnd11 = <?php echo $vd11; ?>; if (dnd11==0) dnd11=tdddate.getDate()

    if (dvy11 < 2000) dvy11 += 1900;


	var now_date11 = new Date(dvy11,dvm11,dnd11);
	var now_day11 = now_date11.getDate();
	var now_month11 = now_date11.getMonth();
	var now_year11 = now_date11.getYear();


	var dvy12 = <?php echo $vy12; ?>; if (dvy12==0) dvy12=tdddate.getYear()
	var dvm12 = <?php echo $vm12; ?>; if (dvm12==0) dvm12=tdddate.getMonth()
	var dnd12 = <?php echo $vd12; ?>; if (dnd12==0) dnd12=tdddate.getDate()

    if (dvy12 < 2000) dvy12 += 1900;


	var now_date12 = new Date(dvy12,dvm12,dnd12);
	var now_day12 = now_date12.getDate();
	var now_month12 = now_date12.getMonth();
	var now_year12 = now_date12.getYear();



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


	var d6 = new dateObj(document.gquot.d5Day, document.gquot.d5Month, document.gquot.d5Year);
	initDates(dvy5, dvy5+1, dvy5, now_month5, now_day5, d6);

   	var d7 = new dateObj(document.gquot.d6Day, document.gquot.d6Month, document.gquot.d6Year);
	initDates(dvy6, dvy6+1, dvy6, now_month6, now_day6, d7);
	
   	var d8 = new dateObj(document.gquot.d7Day, document.gquot.d7Month, document.gquot.d7Year);
	initDates(dvy7, dvy7+1, dvy7, now_month7, now_day7, d8);

   	var d9 = new dateObj(document.gquot.d8Day, document.gquot.d8Month, document.gquot.d8Year);
	initDates(dvy8, dvy8+1, dvy8, now_month8, now_day8, d9);

   	var d10 = new dateObj(document.gquot.d9Day, document.gquot.d9Month, document.gquot.d9Year);
	initDates(dvy9, dvy9+1, dvy9, now_month9, now_day9, d10);


   	var d11 = new dateObj(document.gquot.d10Day, document.gquot.d10Month, document.gquot.d10Year);
	initDates(dvy10, dvy10+1, dvy10, now_month10, now_day10, d11);

   	var d12 = new dateObj(document.gquot.d11Day, document.gquot.d11Month, document.gquot.d11Year);
	initDates(dvy11, dvy11+1, dvy11, now_month11, now_day11, d12);

   	var d13 = new dateObj(document.gquot.d12Day, document.gquot.d12Month, document.gquot.d12Year);
	initDates(dvy12, dvy12+1, dvy12, now_month12, now_day12, d13);


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
