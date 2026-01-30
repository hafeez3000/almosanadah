<?
include ("header.php");

?>
<script src="../javascripts/cBoxes.js"></script>
<script>
 var winl = (screen.width - 760) / 2;
 var wint = (screen.height - 550) / 2;
</script>

<script>
document.title= '<? echo $company_name . " ERP - Amend Bookings"; ?>';
</script>

	<?

$vy=$vm=$vd=0;


 $s_pnr = $_GET["spnr"];







?>




<html>
<link rel="stylesheet" type="text/css" href="../calendar/css.css" />
<body leftmargin="0" topmargin="0" rightmargin="0">
<table width="100%" border="0" cellpadding="0" cellspacing="0" style="border-bottom: 1px solid #999999 ;border-left: 3px solid #006600;border-right: 3px solid #006600"><tr>
    <td bgcolor="#CCCCCC"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">&nbsp;You
      are here: <a href="uhome.php">Home</a> &raquo; <a href="bookings.php">Bookings</a> &raquo; Amend Hotel Booking</a></font></td>
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


			

            <table width="100%" cellpadding="0" cellspacing="0" ><tr><td width="85%" valign="top">
			<table cellpadding="0" cellspacing="0" width="100%" style="border-top: 1px solid #999999; border-bottom: 1px solid #999999"><tr>
                      <td bgcolor="#CCCCCC"><strong>Processing Booking </strong></td>
                    </tr></table>
<table width="100%" cellpadding="1" cellspacing="0"><tr>
                      <td  style="border-bottom: 1px solid #999999"><div align="right"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">

				<a href="pnrdet.php?spnr=<? echo $s_pnr ?>"><? echo $s_pnr ?></a>

					  </font></div></td>
                    </tr></table>

<?

$q_main_sel ="select main_sno,ocode,user_sno,user_id,guest_title,guest_name,guest_telno,guest_notes,flight_det,order_date,option_date,booking_status,cus_title,cus_name,cus_company_name,cus_country,sales_hotels,sales_trans,sales_visa,sales_others from sales_main where ocode='$s_pnr'";

$main_sel = pg_query($q_main_sel);

$rows_main = pg_num_rows($main_sel);

if (!$main_sel) {
echo "An error occured.\n";
exit;
		}

if($rows_main>0){

echo "<table width=\"100%\" border=\"1\" cellpadding=\"1\" cellspacing=\"0\">";

}

while ($rows_main = pg_fetch_array($main_sel)){

$s_user_id = $rows_main["user_id"];
$s_guest_title = $rows_main["guest_title"];
$s_guest_name = $rows_main["guest_name"];
$s_guest_telno = $rows_main["guest_telno"];
$s_guest_notes = $rows_main["guest_notes"];
$s_flight_det = $rows_main["flight_det"];
$s_order_date = $rows_main["order_date"];
$s_option_date = $rows_main["option_date"];
$s_booking_status = $rows_main["booking_status"];
$s_cus_title = $rows_main["cus_title"];
$s_cus_name = $rows_main["cus_name"];
$s_cus_company_name = $rows_main["cus_company_name"];
$s_cus_country = $rows_main["cus_country"];
$s_sales_hotels = $rows_main["sales_hotels"];
$s_sales_trans = $rows_main["sales_trans"];
$s_sales_visa = $rows_main["sales_visa"];
$s_sales_others = $rows_main["sales_others"];


echo "<tr ><td bgcolor=\"#CCCCCC\"><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><b>PNR</b></font></div></td>";
echo "<td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";
echo $s_pnr;
echo "</font></div></td>";

echo "<td bgcolor=\"#CCCCCC\"><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><b>Guest Details </b></font></div></td>";

echo "<td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";

echo "<b>".$s_guest_title.". " .$s_guest_name ."</b>";

echo "<br>";
echo "Tel: " . $s_guest_telno ;
echo "<br>";
echo "Flight: ". $s_flight_det ;



echo "</font></div></td></tr>";

echo "<tr ><td bgcolor=\"#CCCCCC\"><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><b>Order Date</b></font></div></td>";
echo "<td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";
echo date('d-M-Y', strtotime($s_order_date)) ;
echo "</font></div></td>";

echo "<td bgcolor=\"#CCCCCC\"><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><b>Option Date</b></font></div></td>";

echo "<td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";
echo date('d-M-Y', strtotime($s_option_date)) ;
echo "</font></div></td></tr>";


echo "<tr ><td bgcolor=\"#CCCCCC\"><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><b>User Id </b></font></div></td>";
echo "<td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";
echo $s_user_id;
echo "</font></div></td>";

echo "<td bgcolor=\"#CCCCCC\"><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><b>Booking Status</b></font></div></td>";

echo "<td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\" color=\"#FF0000\"><strong>";

echo $s_booking_status;
echo "</strong></font></div></td></tr>";


echo "<tr ><td bgcolor=\"#CCCCCC\"><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><b>Requested By </b></font></div></td>";
echo "<td  colspan=\"3\"><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";
echo $s_cus_title . ". " .$s_cus_name . ", For ";
echo $s_cus_company_name .", ";
echo $s_cus_country;
echo "</font></div></td></tr>";

echo "</table>";
}




$vy=date('Y', strtotime($s_option_date));
$vm=date('m', strtotime($s_option_date));
$vd=date('d', strtotime($s_option_date));

$vhours=date('H', strtotime($s_option_date));
$vmin =date('i', strtotime($s_option_date));





?>

<br>




<table style="border: 1px solid red" cellpadding="5" cellspacing="0" width="100%" height="100%">
                                <tr>

                                  <td bgcolor="#FFDFDF" colspan="2"><strong>Change Option Date
                                    </strong>                                 </td>
                                </tr>




								<tr>

								  <td align="center" colspan="2"><form name="gquot" action="changeopdate.php"  method="post"><table width="100%">
                                      <tr>
                                        <td><div align="center">Option Date</div></td>
                                        <td><font size="2" face="Verdana, Arial, Helvetica, sans-serif">
                                          <select name="dDay" class="selBox">
                                          </select>
                                          <select name="dMonth" class="selBox">
                                          </select>
                                          <select name="dYear" class="selBox">
                                          </select>
                                        </font></td> <td>Hours:<select name="op_hours">
                                      <option><? echo $vhours ?></option>
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
                                    </select></td><td>Minutes:
                                      <select name="op_min">
									  <option><? echo $vmin ?></option>
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
                                    </select></td><td>
									<input type="hidden" id="h_pnr" name="h_pnr" value='<? echo $s_pnr ?>'>
										<input type="hidden" id="h_hotid" name="h_hotid" value='<? echo $s_hot_id ?>'>


									<input type="submit" id="Submit" name="Submit" value="Change"></td>
                                      </tr>


                                  </table></form></td>
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

    var dvy = <?  echo $vy; ?>; if (dvy==0) dvy=tdddate.getYear()
	var dvm = <?  echo $vm; ?>; if (dvm==0) dvm=tdddate.getMonth()
	var dnd = <?  echo $vd; ?>; if (dnd==0) dnd=tdddate.getDate()

   if (dvy < 2000) dvy += 1900;


	var now_date = new Date(dvy,dvm-1,dnd);
	now_date.setDate(now_date.getDate())

	var now_day = now_date.getDate();
	var now_month = now_date.getMonth();
	var now_year = now_date.getYear();



	var d1 = new dateObj(document.gquot.dDay, document.gquot.dMonth, document.gquot.dYear);
	initDates(dvy-1, dvy+1, dvy, now_month, now_day, d1);


</script>


</body>
</html>
