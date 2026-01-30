<?
include ("header.php");
?>
<script src="../javascripts/DS.js"></script>
<script>
 window.onload = function() {
    dynamicSelect("city", "hotel");
	document.selhotel.city.focus();
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
     
		var rr = "hotelsearchdet.php?hn="+document.selhotel.hotelname.value;
		
        var winPop = window.open(rr,"winPop",'scrollbars=yes,toolbar=no,resizable=yes,width=550,height=300' ).focus();
      }
    </script>
    <style type="text/css">
<!--
.style2 {
	font-size: 14px;
	font-weight: bold;
	color: #FF0000;
}
.style3 {
	color: #FF0000;
	font-weight: bold;
}
-->
    </style>
    
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

<table cellpadding="0" cellspacing="0" width="100%" style="border-top: 1px solid #999999; border-bottom: 1px solid #999999"><tr>
                      <td bgcolor="#CCCCCC"><strong> <font size="2" face="Verdana, Arial, Helvetica, sans-serif">Hotel Details</font></td>
                    </tr></table>


<?
$array_city = array();
$array_city_id = array();

$array_hotel = array();
$array_hotel_id = array();

$query_city ="select city_id, city_name from cities";

$result_city = pg_query($conn, $query_city);

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

$result_hotel = pg_query($conn, $query_hotel);

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
		  

 <table width="100%" border="0" cellspacing="0">
						  <tr><td colspan="4">&nbsp;</td></tr>
  						 
						  <tr bgcolor="#CCCCCC"><td colspan="4"> 
						  <form name="selhotel" method="post" action="hoteldetailsa.php" >


  <tr bgcolor="#EFEFEF">
  <td colspan="3">
  <table align="center">
   

  </table> 
  
  </td>
  </tr>

    <tr> 
     
      <td bgcolor="#DFDFFF" ><div align="center"><strong><font size="2" face="Verdana, Arial, Helvetica, sans-serif">City</font></strong></div></td>
      <td bgcolor="#DFFFDF" ><div align="center"><strong><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Hotel</font></strong></div></td>
    </tr>
    <tr align="center"> 
      <td valign="top" bgcolor="#EFEFEF"> 
	  
	  <select id="city" name="city" onFocus="suben()">
        <option value="select">Select City...</option>
       
        <?
		for($i=0;$i<count($array_city);$i++){
  echo  "<option value=\"$array_city_id[$i]\">$array_city[$i]</option>";
}
	?>
    </select></td>

<td bgcolor="#EFEFEF">
  
    <select id="hotel" name="hotel"  onFocus="assv();" onBlur="assv();" onChange="assv();">
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
	      <td colspan="3" bgcolor="#EFEFEF"><div align="center"> 
		  
         <input type="hidden" name="hotelv">
		  <input type="submit" name="mainsub" value="Get Hotel Details">
        </div></td>
    </tr>
	<tr><td colspan="4"><div align="center"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">OR</font></div></td></tr>						   
	<tr><td colspan="4" bgcolor="#EFEFEF" align="center" ><font size="2" face="Verdana, Arial, Helvetica, sans-serif">   Enter the Hotel Name :</font><input type="text" name="hotelname" onFocus="subdis()" onKeyPress="return noenter()" > <input type="button" name="searchhotel" value="search" onClick="OpenWindow()"></td></tr>
  
</form></td></tr></table>


<br>

<form name="newhotel" method="post" action="createnewhotel.php">
<table width="100%">
  <tr>
    <td bgcolor="#EFEFEF"><div align="center"><span class="style3"><font face="Verdana, Arial, Helvetica, sans-serif">Do You Want to create New Hotel ?</font></span></div></td>
  </tr>
    <tr>
    <td bgcolor="#EFEFEF"><div align="center"><span class="style3"><font face="Verdana, Arial, Helvetica, sans-serif">Have you check the hotel existance ?</font></span></div></td>
  </tr>
  <tr><td valign="top" bgcolor="#EFEFEF" align="center"> 
	  
	  <select id="cityn" name="cityn" >
             
        <?
		for($i=0;$i<count($array_city);$i++){
  echo  "<option value=\"$array_city_id[$i]\">$array_city[$i]</option>";
}
	?>
    </select></td></tr>
  <tr><td bgcolor="#EFEFEF"><div align="center"><span class="style2"><font face="Verdana, Arial, Helvetica, sans-serif">
   
    <input type="submit" name="Submit" value="Create New Hotel" />
   
  </font></span></div></td>
</tr>
</table>
</form>


     </td></tr></table> 

</td></tr></table> 

</td></tr></table> 

</td></tr></table> 




