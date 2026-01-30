<?
session_start();

// is the one accessing this page logged in or not?
if (!isset($_SESSION['db_is_logged_in_online'])
   || $_SESSION['db_is_logged_in_online'] !== true) {

   // not logged in, move to login page
   header('Location: login.php');
   exit;
}
$suserid = $_SESSION["userid"];
$suser_sno = $_SESSION["user_sno"];
$dept = $_SESSION["deptsr"];

include("../db/db.php");
include ("../conf/mainconf.php");
?>
<html>





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

<link rel="stylesheet" href="../css/links.css" type="text/css">

<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<body leftmargin="0" topmargin="0" rightmargin="0">



<table width="100%"  border="0" cellpadding="0" cellspacing="0" style="border-bottom: 1px solid #006600; border-top: 3px solid #006600; border-right: 3px solid #006600">
  <tr>
    <td width="56" rowspan="2" style="padding-right: 30px;
padding-left: 10px; border-left: 3px solid #006600;" ><img class="header-log-img" src="../images/logo.jpg"></td>
    <td width="200" DIR="RTL" align="left"><img class="header-arabic-logo" src="../images/arname.jpg"></td>
    <td width="1" bgcolor="#006600">&nbsp;</td>
    <td width="100" rowspan="2" bgcolor="#87D37E" style="border-right: 3px solid #006600"><div align="center"><font size="4" face="Verdana, Arial, Helvetica, sans-serif"><strong><font size="3" face="Arial, Helvetica, sans-serif">ERP 3.0</font></strong></font></div></td>
    <td colspan="2" style="border-bottom: 1px solid #006600; padding-left:5px;"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><strong>Department:</strong>
      <? echo $dept ?>
      </font></td>
    <td align="left" width="300px"  style="border-bottom: 1px solid #006600; padding-left:5px;"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><strong>User:</strong>
      <? echo $suserid ?>,
      </font> <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><a class="head" style="text-align:left; margin-left:5px;  " href="logout.php" >Logout</a></font> </td>
  </tr>
  <tr>
    <td  width="200"><font  face="Arial, Helvetica, sans-serif" style="font-size: 22px;" >
      <strong><? echo $company_name ; ?></strong>
      </font></td>
    <td width="1" bgcolor="#006600">&nbsp;</td>
    <td width="350px" style="padding-left:5px;"><div align="left"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">
        <script>document.write(formatDate(myDate, "ww, dd,  mmmm  yy")); </script>
        <SPAN ID=clock>
        <SCRIPT Language=Javascript>
          document.write(buildTime())
    </SCRIPT>
        </SPAN></font></div></td>
    <td></td>
    <td>&nbsp;</td>
  </tr>
</table>


<script>
document.title= '<? echo $company_name . " ERP - Login"; ?>';
</script>


</body>
</html>
