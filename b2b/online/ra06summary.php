<?
include ("header.php");
include ("../calendar/cal.php");
?>
<script src="../javascripts/cBoxes.js"></script>
<script src="../javascripts/DS.js"></script>
<script>
 window.onload = function() {
    dynamicSelect("city", "hotel");
	document.selhotel.dDay.focus();
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
      are here: <a href="uhome.php">Home</a> </font></td>
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


            <table width="100%" cellpadding="0" cellspacing="0" ><tr><td width="85%" valign="top">
			<table cellpadding="0" cellspacing="0" width="100%" style="border-top: 1px solid #999999; border-bottom: 1px solid #999999"><tr>
                      <td bgcolor="#CCCCCC"><strong>Hotel Summary </strong>- Select Hotel </td>
                    </tr></table>
<table width="100%" cellpadding="1" cellspacing="0"><tr>
                      <td style="border-bottom: 1px solid #999999"><div align="left"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">
                          <table width="100%" border="0" cellspacing="0">
						  <tr><td colspan="4">&nbsp;</td></tr>

						  <tr bgcolor="#CCCCCC"><td colspan="4">
						  <form name="selhotel" method="post" action="#" >






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


<script>
function g_hs(){

//alert("Habibi");

//var rr = "hotelsearch.php?hn="+document.selhotel.hotelname.value;

var hid = document.selhotel.hotelv.value;
var rr = "ramadan2006/rahsdt.php?hot_id="+document.selhotel.hotelv.value;

window.open(rr, hid ,'width='+screen.width+',height='+screen.height+', directories=no,menubar=yes,scrollbars=yes,toolbar=no,resizable=yes,fullscreen=no,titlebar=no,directories=no, top=0,left=0  ').focus();

}

</script>



    <tr>
	      <td colspan="3" bgcolor="#EFEFEF"><div align="center">

         <input type="hidden" name="hotelv">
		  <input type="button" name="mainsub" value="Get Hotel Summary" onclick="g_hs();">
        </div></td>
    </tr>


</form></td></tr></table></font></div></td>
                    </tr></table>

			</td>
                <td width="15%" style="border-left: 1px solid #999999"><table >
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
                      <td><div align="center"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><a href="../calendar/index.php">DORS
                          ERP TODO</a></font></div></td>
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


if(c_date1<n_today){
alert("Check In must be after Today");
return false;
}

if(c_date2<n_today){
alert("Check Out must be after Today");
return false;
}


if(c_date1>=c_date2){
alert("Check Out must be after Check In");
return false;
}



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
