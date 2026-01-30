<?
include ("../conf/mainconf.php");
?>
<html>
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
document.title= '<? echo $company_name . " ERP -  HRM Login"; ?>';
</script>

<table width="100%" >
  <tr> 
    <td><div align="center"><img src="../images/logo.gif" width="56" height="56"></div></td>
  </tr>
  <tr> 
    <td><div align="center"><font size="4" face="Arial, Helvetica, sans-serif"> 
        <? echo $ar_company_name ; ?>
        </font></div></td>
  </tr>
  <tr> 
    <td><div align="center"><font size="4" face="Arial, Helvetica, sans-serif"> 
        <? echo $company_name ; ?>
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
    <td bgcolor="#D5FFD5" style="border-bottom: 1px solid #006600 ; border-top: 1px solid #006600"><div align="right"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">To select other department :<a href="../index.php">Home</a></font></div></td>
  </tr>
</table>
<br>
<table width="100%"><tr><td><center>
       <table width="60%" border="3" cellspacing="1" bordercolor="#006600"><tr><td>
	   <form name="login" action="logina.php" method="post" onsubmit="return val(this)">
	    <table width="100%" align="center" >
                <tr> 
                  <td colspan="2"><div align="center"><font size="3" face="Verdana, Arial, Helvetica, sans-serif"><font color="#FF3CFF" size="4" face="Arial, Helvetica, sans-serif">Welcome 
                        to HRM</font></font></div></td>
                </tr>
                <tr> 
                  <td colspan="2" style="border-bottom: 1px dotted #006600;"><div align="center"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Login 
                      to Enter </font></div></td>
                </tr>
                <tr> 
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
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
                  <td colspan="2">&nbsp;</td>
                </tr>
                <tr> 
                  <td colspan="2"><div align="center"> <font size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
                      <input type="submit" name="submit" value="Login">
                      </font></div></td>
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
</body>
</html>
