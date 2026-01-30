<?
include ("../conf/mainconf.php");
?>


<html>

<head>


  <title>Dar Al Manasek Tourism & Umrah - Login</title>

  <meta http-equiv="content-type" content="application/xhtml+xml; charset=UTF-8" />
  <meta name="author" content="daralmanasek.com" />
  <meta name="keywords" content="Dar Al Manasek, Online reservation system, Saudi Arabia Hotels, Hotels, Cars, Umrah, Hajj" />
  <meta name="description" content="Leading tourism and pilgrimage service provider in Kingdom of Saudi Arabia, at our site, Go virtual anywhere in Kingdom of Saudi Arabia - Hotels, Cars, Umrah, Hajj, Tourism! – Dar Al Manasek Tourism and Umrah – Its pleasure to serve you" />
  <meta name="robots" content="index, follow, noarchive" />
  <meta name="googlebot" content="noarchive" />

  <link rel="stylesheet" type="text/css" href="../css/html.css" media="screen, projection, tv " />
  <link rel="stylesheet" type="text/css" href="../css/layout.css" media="screen, projection, tv" />
  <link rel="stylesheet" type="text/css" href="../css/print.css" media="print" />

  <style type="text/css">
<!--
.style1 {color: #FFFFFF}
-->
  </style>
</head>


<body>

<!-- CONTENT: Holds all site content except for the footer.  This is what causes the footer to stick to the bottom -->
<div id="content">



  <!-- HEADER: Holds title, subtitle and header images -->
  <? include 'headerm.php' ?>


  <!-- MAIN MENU: Top horizontal menu of the site.  Use class="here" to turn the current page tab on -->
  <div id="mainMenu">
    <ul class="floatRight">
      <li><a href="../index.php" title="Dar Al Manasek" >Intro</a></li>
      <li><a href="../hotels.php" title="Online Reservation for 165+ hotels in Saudi Arabia">Hotels</a></li>
      <li><a href="../umrah.php" title="Serving Allah's Guests for Umrah piligrimage">Umrah</a></li>
      <li><a href="../hajj.php" title="Serving Allah's Guests for Hajj Pilgrimage">Hajj</a></li>
      <li><a href="../contactus.php" title="Reach us at any time" class="last">Contact Us</a></li>
    </ul>
  </div>




  <!-- PAGE CONTENT BEGINS: This is where you would define the columns (number, width and alignment) -->
  <div id="page">


    <!-- 25 percent width column, aligned to the left -->
    <div class="width25 floatLeft leftColumn">

      <h1>Login</h1>

      <ul class="sideMenu">
        <li class="here">
          Sign Up
            <ul>
           <li><a href="newreg.php" title="New Registration">New Registration</a></li>
            <li><a href="login.php" title="Already User!, Login">Already User!, Login </a></li>
          </ul>
        </li>
        <li><a href="../newbooking.php" title="New Booking">New Booking</a></li>
        <li><a href="../usermenu.php" title="User Menu">User Menu</a></li>
      </ul>

      <p align="center">
        <img src="../images/atm07.jpg"  align="middle"><br>
		Dar Al Manasek at Arabian Travel Market 2007, DUBAI
      </p>

     

      

    </div>




    <!-- 75 percent width column, aligned to the right -->
    <div class="width75 floatRight">


      <!-- Gives the gradient block -->
      <div class="gradient">

      

       	
		<SCRIPT LANGUAGE="JavaScript1.1" SRC="../javascripts/FormChek.js"></SCRIPT>
<script>
var myDate = new Date();

function formatDate(strFullDate, strFormatString) {
 var strMonths = new Array();
 var strDay = new Array();

 strMonths[0]  = "January";
 strMonths[1]  = "February";
 strMonths[2]  = "March";
 strMonths[3]  = "April";
 strMonths[4]  = "May";
 strMonths[5]  = "June";
 strMonths[6]  = "July";
 strMonths[7]  = "August";
 strMonths[8]  = "September";
 strMonths[9]  = "October";
 strMonths[10] = "November";
 strMonths[11] = "December";

 strDay[0]  = "Sunday";
 strDay[1]  = "Monday";
 strDay[2]  = "Tuesday";
 strDay[3]  = "Wednesday";
 strDay[4]  = "Thursday";
 strDay[5]  = "Friday";
 strDay[6]  = "Saturday";

 var strValue_d    = strFullDate.getDate();
 var strValue_dd   = (strValue_d < 10) ? '0' + strValue_d : strValue_d;
 var strValue_m    = strFullDate.getMonth() + 1;
 var strValue_mm   = (strValue_m < 10) ? '0' + strValue_m : strValue_m;
 var strValue_mmmm = strMonths[strFullDate.getMonth()];
 var strValue_mmm  = strValue_mmmm.substr(0,3);
 var cd = strFullDate.getYear();
 if(cd <2000) { cd +=1900 }
 var strValue_yy   = cd + "";

 var strValue_y    = strValue_yy.substr(2,2);
 var strValue_ww   = strDay[strFullDate.getDay()];
 var strValue_w    = strValue_ww.substr(0,3);

 if (strFormatString.indexOf("dd") > -1) {
  strFormatString = strFormatString.replace("dd", "strValue_dd");
 }
 else {
  if (strFormatString.indexOf("d") > -1) {
   strFormatString = strFormatString.replace("d", "strValue_d");
  }
 }

 if (strFormatString.indexOf("mmmm") > -1) {
  strFormatString = strFormatString.replace("mmmm", "strValue_mmmm");
 }
 else {
  if (strFormatString.indexOf("mmm") > -1) {
   strFormatString = strFormatString.replace("mmm", "strValue_mmm");
  }
  else {
   if (strFormatString.indexOf("mm") > -1) {
    strFormatString = strFormatString.replace("mm", "strValue_mm");
   }
   else {
    if (strFormatString.indexOf("m") > -1) {
     strFormatString = strFormatString.replace("m", "strValue_m");
    }
   }
  }
 }

 if (strFormatString.indexOf("yy") > -1) {
  strFormatString = strFormatString.replace("yy", "strValue_yy");
 }
 else {
  if (strFormatString.indexOf("y") > -1) {
   strFormatString = strFormatString.replace("y", "strValue_y");
  }
 }

 if (strFormatString.indexOf("ww") > -1) {
  strFormatString = strFormatString.replace("ww", "strValue_ww");
 }
 else {
  if (strFormatString.indexOf("w") > -1) {
   strFormatString = strFormatString.replace("w", "strValue_w");
  }
 }

 strFormatString = strFormatString.replace("strValue_dd", strValue_dd);
 strFormatString = strFormatString.replace("strValue_d", strValue_d);
 strFormatString = strFormatString.replace("strValue_mmmm", strValue_mmmm);
 strFormatString = strFormatString.replace("strValue_mmm", strValue_mmm);
 strFormatString = strFormatString.replace("strValue_mm", strValue_mm);
 strFormatString = strFormatString.replace("strValue_m", strValue_m);
 strFormatString = strFormatString.replace("strValue_yy", strValue_yy);
 strFormatString = strFormatString.replace("strValue_y", strValue_y);
 strFormatString = strFormatString.replace("strValue_ww", strValue_ww);
 strFormatString = strFormatString.replace("strValue_w", strValue_w);

 return strFormatString;
}
</script>
<SCRIPT LANGUAGE="JAVASCRIPT">

// Check if IE4 or greater.
 var MS=navigator.appVersion.indexOf("MSIE")
 window.isIE4 = (MS>0) && (parseInt(navigator.appVersion) >= 4)

 function lead0(val) {
  // add leading 0s when necessary
  return val<10 ? "0"+val.toString() : val
 }

 function buildTime() {
  var time = new Date()
  var ampm = "AM"
  var h=time.getHours()
  // fix military time and determine ampm
  if (h > 12) {h = h - 12; ampm = " PM";}  
   return lead0(h)+":"+lead0(time.getMinutes())+":"+ lead0(time.getSeconds()) + ampm
 }

 function tick() {
  // Replace the plain-text contents of the clock element
  document.all.clock.innerHTML = buildTime()
 }    

 // Start clock when page is loaded.
 window.onload = new Function("if (window.isIE4) setInterval('tick()',1000)")
</SCRIPT>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<body onLoad=" if (window.isIE4) setInterval('tick()',1000); document.login.userid.focus();" leftmargin="0" topmargin="0">



<script>
document.title= '<? echo $company_name . " Online Reservation Login"; ?>';
</script>

<table width="100%" >
  <tr> 
    <td><div align="center"><img src="logot.gif" width="56" height="56"></div></td>
  </tr>
   <tr> 
    <td><div align="center"><img src="../../images/arname.gif"></div></td>
  </tr>
  <tr> 
    <td><div align="center"><font size="3" face="Arial, Helvetica, sans-serif"> 
       <strong> <? echo $company_name ; ?></strong>
        </font></div></td>
  </tr>
  <tr> 
    <td><div align="center"><strong><font size="3" face="Arial, Helvetica, sans-serif">ERP 
        2.0</font></strong></div></td>
  </tr>
  <tr>
    <td ><div align="center"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
        <script>document.write(formatDate(myDate, "ww, dd,  mmmm  yy")); </script>
        <span id=clock> 
        <script language=Javascript>
          document.write(buildTime())
    </script>
        </span></font></div></td>
  </tr>
  <tr> 
    <td bgcolor="#D5FFD5" style="border-bottom: 1px solid #ffffff ; border-top: 1px solid #ffffff"><div align="right">&nbsp;</div></td>
  </tr>
</table>
<br>
<table width="100%"><tr><td><center>
       <table width="60%" border="3" cellspacing="1" bordercolor="#FFFFFF">
         <tr><td>
	   <form name="login" action="logina.php" method="post" onSubmit="return val(this)">
	    <table width="100%" align="center" >
                <tr> 
                  <td colspan="2"><div align="center" class="style1"><font size="3" face="Verdana, Arial, Helvetica, sans-serif"><font size="4" face="Arial, Helvetica, sans-serif">Welcome 
                      to Onine Reservation System</font></font></div></td>
                </tr>
                <tr> 
                  <td colspan="2" style="border-bottom: 1px dotted #FFFFFF;"><div align="center"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Login 
                      to Enter,  If you want to make <a href="newreg.php">New Registration</a> </font></div></td>
                </tr>
                 <tr> 
                    <td colspan="2"><div align="center"><font color="#FF0000" size="2"><strong><font face="Verdana, Arial, Helvetica, sans-serif">Invalid 
                        userid or password </font></strong></font> </div></td>
                  </tr>
                <tr> 
                  <td width="50%" ><div align="right"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Userid 
                      </font></div></td>
                  <td><font size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
                    <input type="text" name="userid">
                    </font></td>
                </tr>
                <tr> 
                  <td width="50%" ><div align="right"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Password</font></div></td>
                  <td><font size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
                    <input type="password" name="password">
                    </font></td>
                </tr>
               
                <tr> 
                  <td colspan="2"><div align="center"> <font size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
                      <input type="submit" name="submit" value="Login">
                      </font></div></td>
                </tr>
				<tr>
                  <td colspan="2"><div align="center"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Forget Password,  click here to set <a href="newreg.php">New Password</a> </font></div></td>
                </tr>
              </table>
			  </form>
      </td></tr></table>
      </center>
</td></tr></table>
<script>
function val(theFrom)
{
defaultEmptyOK = true;

for (defaultEmptyOKLoop = 0; defaultEmptyOKLoop < 2; defaultEmptyOKLoop++)
{

defaultEmptyOK = !defaultEmptyOK;

  
    
	
	
	if(isEmpty(document.login.userid.value)){
	alert("Sorry, but enter userid");
	document.login.userid.focus();
  	return false;
	}
	if(isEmpty(document.login.password.value)){
	alert("Sorry, but enter Password");
	document.login.password.focus();
  	return false;
	}
 
   

}

}
</script>

        <blockquote class="go">
         
        </blockquote>

        
      </div>





      

    </div>

  </div>

</div>


<!-- FOOTER: Site footer for links, copyright, etc. -->
<div id="footer">

  <div id="width">
      <span class="floatLeft">
         design <a href="http://www.daralmanasek.com" title="Goto Dar Al Manasek">dors team</a> <span class="grey">|</span>
      Send us <a href="../feedback.php" title="Validate XHTML">Feedback</a> <span class="grey">|</span>
      Get Latest by  <a href="../rsslink.php" title="Validate CSS">RSS</a> </span>
	  
	  

    <span class="floatRight">
      <a href="../index.php" title="Introduction">Intro</a> <span class="grey">|</span>
      <a href="../hotels.php" title="Hotel Booking">Hotels</a> <span class="grey">|</span>
      <a href="../umrah.php" title="Umrah">Umrah</a> <span class="grey">|</span>
      <a href="../hajj.php" title="Hajj">Hajj</a> <span class="grey">|</span>
       <a href="../contactus.php" title="Contact Us">Contact Us</a>    </span>  </div>

</div>

</body>

</html>
