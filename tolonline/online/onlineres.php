<? 

include("../db/db.php"); ?>

<html>

<head>


  <title>Dar Al Manasek Tourism & Umrah - Its pleasure to serve you</title>
  
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
document.title= '<? echo $company_name . " DORS Online New Hotel Booking"; ?>';
</script>

  <meta http-equiv="content-type" content="application/xhtml+xml; charset=UTF-8" />
  <meta name="author" content="daralmanasek.com" />
  <meta name="keywords" content="Dar Al Manasek, Online reservation system, Saudi Arabia Hotels, Hotels, Cars, Umrah, Hajj" />
  <meta name="description" content="Leading tourism and pilgrimage service provider in Kingdom of Saudi Arabia, at our site, Go virtual anywhere in Kingdom of Saudi Arabia - Hotels, Cars, Umrah, Hajj, Tourism! – Dar Al Manasek Tourism and Umrah – Its pleasure to serve you" />
  <meta name="robots" content="index, follow, noarchive" />
  <meta name="googlebot" content="noarchive" />

  <link rel="stylesheet" type="text/css" href="css/html.css" media="screen, projection, tv " />
  <link rel="stylesheet" type="text/css" href="css/layout.css" media="screen, projection, tv" />
  <link rel="stylesheet" type="text/css" href="css/print.css" media="print" />

  <style type="text/css">
<!--
.style1 {color: #000000}
-->
  </style>
</head>


<body>

<!-- CONTENT: Holds all site content except for the footer.  This is what causes the footer to stick to the bottom -->
<div id="content">
<?
include 'headerm.php' ;
?>

  <!-- HEADER: Holds title, subtitle and header images -->
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


  <!-- MAIN MENU: Top horizontal menu of the site.  Use class="here" to turn the current page tab on -->
  <div id="mainMenu">
    <ul class="floatRight">
      <li><a href="../index.php" title="Dar Al Manasek" >Intro</a></li>
      <li><a href="../hotels.php" title="Online Reservation for 165+ hotels in Saudi Arabia" class="here">Hotels</a></li>
      <li><a href="../umrah.php" title="Serving Allah's Guests for Umrah piligrimage">Umrah</a></li>
      <li><a href="../hajj.php" title="Serving Allah's Guests for Hajj Pilgrimage">Hajj</a></li>
      <li><a href="../contactus.php" title="Reach us at any time" class="last">Contact Us</a></li>
    </ul>
  </div>




  <!-- PAGE CONTENT BEGINS: This is where you would define the columns (number, width and alignment) -->
  <div id="page">


    <!-- 25 percent width column, aligned to the left -->
    <div class="width25 floatLeft leftColumn">

      <h1>Hotels</h1>

      <ul class="sideMenu">
        <li class="here">
          Sign Up
            <ul>
             <li><a href="newreg.php" title="New Registration">New Registration</a></li>
            <li><a href="login.php" title="Already User!, Login">Already User!, Login </a></li>
          </ul>
        </li>
        <li><a href="newbookings.php" title="New Booking">New Booking</a></li>
        <li><a href="login.php" title="User Menu">User Menu</a></li>
      </ul>

      <p align="center">
        <img src="images/atm07.jpg"  align="middle"><br>
		Dar Al Manasek at Arabian Travel Market 2007, DUBAI
      </p>

     

      

    </div>




    <!-- 75 percent width column, aligned to the right -->
    <div class="width75 floatRight">


      <!-- Gives the gradient block -->
      <div class="gradient">

        <a name="fluidity"></a>

        <h1>Online Reservation </h1>
       
      <table width="100%" border="0" cellspacing="0" bgcolor="#666666">
						  
  						 
						  <tr bgcolor="#CCCCCC"><td > 
						  <form name="selhotel" method="post" action="hotelroomdet.php" onSubmit="return fun2(this)"> 


  <tr bgcolor="#EFEFEF">
  <td >
  <table align="left">
   <tr> 
      <td><span class="style1"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Check-In</font></span></td>
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
      <td><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><span class="style1">Check-Out</span></font></td>
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
  </table>  </td>
  </tr>

 

    <tr> 
     
      <td bgcolor="#DFDFFF" class="style1" ><div align="left"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">City&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</font><font size="2" face="Verdana, Arial, Helvetica, sans-serif">
        <select  id="city" name="city" onFocus="suben()">
          <option value="select">Select City...</option>
          <?
		for($i=0;$i<count($array_city);$i++){
  echo  "<option value=\"$array_city_id[$i]\">$array_city[$i]</option>";
}
	?>
        </select>
      </font></div></td>
      
    </tr>
    <tr align="center"> 
      <td valign="top" bgcolor="#EFEFEF" align="left" class="style1"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Hotel&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong><font size="2" face="Verdana, Arial, Helvetica, sans-serif">
        <select id="hotel" name="hotel"  onFocus="assv();" onBlur="assv();" onChange="assv();">
          <option class="select" value="select">Select Hotel...</option>
          <?
		for($i=0;$i<count($array_hotel);$i++){
       $cv = substr($array_hotel_id[$i],0,2);
  
 echo  "<option class=\"$cv\"  value=\"$array_hotel_id[$i]\">$array_hotel[$i]</option>";
		}
	?>
        </select>
        <input name="mainsub" type="submit"  value="Get Hotel Details" >
        <input type="hidden" name="hotelv">
      </font></strong></font></td>


</tr>




  
    
	<tr><td  bgcolor="#EFEFEF"><div align="center" class="style1"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">OR</font></div></td>
	</tr>						   
	<tr><td  bgcolor="#EFEFEF">   <span class="style1"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Enter the Hotel Name :</font></span><font size="2" face="Verdana, Arial, Helvetica, sans-serif">
	  <input type="text" id="hotelname" name="hotelname" onFocus="subdis()" onKeyPress="return noenter()" > <input  type="button" name="searchhotel" value="search" onClick="OpenWindow()"></font></td></tr>
  
</form></td></tr></table>        
	  

        <blockquote class="go">
          <p>
            A part from Hotel Booking, Dar al manasek tourism and umrah has its own hotels in Makkah and Madinah.  With high class premium services our hotels makes you to feel more comfort as you are staying at your home.  <a href="../darmh/index.html" title="Makkah Dar Al Manasek Hotel">Click here</a> to go to our hotels site.           </p>
        </blockquote>

        
      </div>





      

    </div>

  </div>

</div>


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

	var d1 = new dateObj(document.selhotel.dDay, document.selhotel.dMonth, document.selhotel.dYear);
	initDates(dvy-1, dvy+1, dvy, now_month, now_day, d1);

   	var d2 = new dateObj(document.selhotel.d1Day, document.selhotel.d1Month, document.selhotel.d1Year);
	initDates(dvy1-1, dvy1+1, dvy1, now_month1, now_day1, d2);
 	
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


<!-- FOOTER: Site footer for links, copyright, etc. -->
<div id="footer">

  <div id="width">
      <span class="floatLeft">
         design <a href="http://www.daralmanasek.com" title="Goto Dar Al Manasek">dors team</a> <span class="grey">|</span>
      Send us <a href="feedback.php" title="Validate XHTML">Feedback</a> <span class="grey">|</span>
      Get Latest by  <a href="rsslink.php" title="Validate CSS">RSS</a> </span>
	  
	  

    <span class="floatRight">
      <a href="../index.php" title="Introduction">Intro</a> <span class="grey">|</span>
      <a href="../hotels.php" title="Hotel Booking">Hotels</a> <span class="grey">|</span>
      <a href="../umrah.php" title="Umrah">Umrah</a> <span class="grey">|</span>
      <a href="../hajj.php" title="Hajj">Hajj</a> <span class="grey">|</span>
         <a href="../contactus.php" title="Contact Us">Contact Us</a>    </span>  </div>

</div>



</body>

</html>