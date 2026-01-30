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
            <td><font size="2" face="Arial, Helvetica, sans-serif"><strong>&nbsp;Deleting Period from Individual Rates ...</strong></font></td>
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

$g_cin = $_GET["cin"]; 
$g_cout = $_GET["cout"]; 
$g_hot = $_GET["hot"]; 
$_GET["nat"];
$g_nat = trim($_GET["nat"]); 
$g_viewt = $_GET["viewt"];


?>


<?
$q_del_period = "delete from ind_rates where hotel_id='$g_hot' and from_date= date '$g_cin' and  to_date = date '$g_cout' and nationality='$g_nat' and view_type='$g_viewt'";
pg_query($conn, $q_del_period);


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

<? echo "<script>document.location.href=\"indratesentry.php?hotid=$g_hot\"</script>";  ?>
</body>
</center>