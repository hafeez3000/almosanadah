<html>
<head>
<title>New Hotel Booking</title>
<script src="DS.js"></script>
<script>
 window.onload = function() {
     dynamicSelect("city", "hotel");
 }
</script>
</head>
<body >


<?php
include("db.php");



$vy=$vm=$vd=0;
$vy1=$vm1=$vd1=0;

$array_city = array();
$array_city_id = array();

$array_hotel = array();
$array_hotel_id = array();

$query_city ="select city_id, city_name from cities";

$result_city = pg_query($query_city);

if (!$result_city) {
	echo "An error occured.\n";
	exit;
	}
while ($rows_city = pg_fetch_array($result_city)){

$array_city[] = $rows_city["city_name"];
$array_city_id[] = $rows_city["city_id"];

}

pg_free_result($result_city);

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
</td>
    </tr>

<form name="isc" method="post" action="det.php">

<table border="2" align="center" cellpadding="1" cellspacing="1" bordercolor="#999999">
    <tr> 
     
      <td bgcolor="#DFDFFF"><div align="center"><strong><font size="2" face="Verdana, Arial, Helvetica, sans-serif">City</font></strong></div></td>
      <td bgcolor="#DFFFDF"><div align="center"><strong><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Hotel</font></strong></div></td>
    </tr>
    <tr align="center"> 
      <td valign="top"> <select id="city" name="city">
        <option value="select">Select City...</option>
       
        <?
		for($i=0;$i<count($array_city);$i++){
  echo  "<option value=\"$array_city_id[$i]\">$array_city[$i]</option>";
}
	?>
    </select></td>

<td>
  
    <select id="hotel" name="hotel">
        <option class="select" value="select">Select Hotel...</option>
     
    
	     <?
		for($i=0;$i<count($array_hotel);$i++){
       $cv = substr($array_hotel_id[$i],0,2);
  
 echo  "<option class=\"$cv\"  value=\"$array_hotel_id[$i]\">$array_hotel[$i]</option>";
		}
	?>
	</select>


</td>
</tr>



  <tr>
  <td colspan="3" bgcolor="#CCCCCC">
  <table align="center">
   <tr> 
      <td><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Check-In</font></td>
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
    <tr> 
      <td><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Check-Out&nbsp;</font></td>
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
  </tr>
  
    <tr>
	      <td colspan="3" bgcolor="#CCCCCC"><div align="center"> 
          <input type="submit" name="mainsub" value="Get Hotel Details">
        </div></td>
    </tr>
  </table>
</FORM>

<script>

function fun2(){

 if(document.isc.hname.value == " "){

	   alert("Please Select the Hotel");
		document.isc.example.focus()
		return(false);
 }

 if(document.isc.stage3.value == " "){

	   alert("Please Select the Hotel");
		document.isc.example.focus()
		return(false);
 }
op();
}

</script>

<script src="cBoxes.js"></script>
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

	var d1 = new dateObj(document.isc.dDay, document.isc.dMonth, document.isc.dYear);
	initDates(dvy-1, dvy+1, dvy, now_month, now_day+1, d1);

   	var d2 = new dateObj(document.isc.d1Day, document.isc.d1Month, document.isc.d1Year);
	initDates(dvy-1, dvy+1, dvy, now_month, now_day1+3, d2);
 	
</script>


<form action="#">
  
</form>
</body>
</html>
		





