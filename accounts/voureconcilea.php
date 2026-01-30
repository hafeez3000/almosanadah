<?
include("../db/db.php"); 
?>
<center>
<body bgcolor="#00A800" leftmargin="10" topmargin="10" marginwidth="0" marginheight="0">

<table width="100%" height="6%" border="0" cellspacing="0" cellpadding="0" bgcolor="#CAFFCA">
  <tr>
            <td><font size="2" face="Arial, Helvetica, sans-serif"><strong>&nbsp; 
              Reconcileing... </strong></font></td>
            <td valign="top"> <div align="right"><img src="../images/tr.jpg" width="9" height="10"></div></td>
  </tr>
</table>
<table width="100%" height="86%" border="0" cellspacing="0" cellpadding="1" bgcolor="#FFFFFF">
  <tr><td valign="top">

  <table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td>
<?

include ("gprocessing.html"); 

$s_voct = $_POST["voct"];
$s_vocn = $_POST["vocn"];

if($s_vocn==""){ }
else{
$sql_up = "update vocmast set recon='t' where voctype='$s_voct' and vocno='$s_vocn' "; 
pg_query($conn, $sql_up);
}

?>

</td></tr>			
</table>			
</td></tr>
</table>


<script>
window.opener.location.reload(true);
self.close();
</script>


</body>
</center>