<?
include("../db/db.php"); 
?>
<center>
<body bgcolor="#00A800" leftmargin="10" topmargin="10" marginwidth="0" marginheight="0">
<table width="100%" height="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF">
  <tr>
    <td>

<table width="100%" height="6%" border="0" cellspacing="0" cellpadding="0" bgcolor="#CAFFCA">
  <tr>
            <td><font size="2" face="Arial, Helvetica, sans-serif"><strong>&nbsp;Deleting Selected Booking ...</strong></font></td>
            <td valign="top"> <div align="right"><img src="../images/tr.jpg" width="9" height="10"></div></td>
  </tr>
</table>
<table width="100%" height="86%" border="0" cellspacing="0" cellpadding="1" bgcolor="#FFFFFF">
  <tr><td valign="top">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td>
<br><br><br><br><br>
<? 
include ("gprocessing.html"); 
$hotel_sel_sno = $_GET["hotid"]; ?>


<?
$q_del_hotel = "delete from sales_hotels where sales_hotels_sno = $hotel_sel_sno";
pg_query($q_del_hotel);

$q_del_meals = "delete from sales_meals where sales_hotels_sno = $hotel_sel_sno";
pg_query($q_del_meals);

?>


</td></tr>			
</table>			
</td></tr>
</table>
<table width="100%" height="8%" border="0" cellspacing="0" cellpadding="0" bgcolor="#CAFFCA">
  <tr>
            <td  valign="bottom"  > <img src="../images/bl.jpg" width="9" height="10"></td>
            <td valign="middle"><div align="right"><font size="2" face="Arial, Helvetica, sans-serif"><strong>Please Wait ... &nbsp;</strong></font></div>
              </td>
  </tr>
</table>


</td>
  </tr>
</table>

<? echo "<script>document.location.href=\"bookingchart.php\"</script>";  ?>
</body>
</center>