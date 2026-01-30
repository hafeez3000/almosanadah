<?
session_start();

$suserid = $_SESSION["userid"];
$suser_sno = $_SESSION["user_sno"];

?>
<?
include("../db/db.php"); 
?>
<center>
<body bgcolor="#00A800" leftmargin="10" topmargin="10" marginwidth="0" marginheight="0">

<table width="100%" height="6%" border="0" cellspacing="0" cellpadding="0" bgcolor="#CAFFCA">
  <tr>
            <td><font size="2" face="Arial, Helvetica, sans-serif"><strong>&nbsp; 
              Amend Availability </strong></font></td>
            <td valign="top"> <div align="right"><img src="../images/tr.jpg" width="9" height="10"></div></td>
  </tr>
</table>
<table width="100%" height="86%" border="0" cellspacing="0" cellpadding="1" bgcolor="#FFFFFF">
  <tr><td valign="top">

  <table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td>
<?

include ("gprocessing.html"); 
$roomid_sno = $_POST["p_roomid"];
$hotid = substr($roomid_sno, 0,5);
$s_cin = $_POST["p_cin"]; 
$s_cout = $_POST["p_cout"]; 

$madnights1 = Round(((strtotime($s_cout)-strtotime($s_cin))/86400), 0) ;

for($madnit=0; $madnit<$madnights1 ;  $madnit++){

$mad_rd1 = date('Y-m-d', mktime(0,0,0,date('m', strtotime($s_cin)),date('d', strtotime($s_cin))+$madnit,date('Y', strtotime($s_cin))));

//echo $roomid_sno;

$s_as_bull="FALSE";

$s_as = $_POST["cb$roomid_sno$madnit"];
$s_nr = $_POST["rooms$roomid_sno$madnit"];

if(trim($s_as)=="on"){ $s_as_bull="TRUE"; }
	



$sql_up = "update rates$hotid set avial_bool='$s_as_bull' ,avialibility=$s_nr  where room_id='$roomid_sno' and rate_date='$mad_rd1' "; 
pg_query($sql_up);

}
?>

</td></tr>			
</table>			
</td></tr>
</table>

<table width="100%" height="8%" border="0" cellspacing="0" cellpadding="0" bgcolor="#CAFFCA">
  <tr>
            <td  valign="bottom"  > <img src="../images/bl.jpg" width="9" height="10"></td>
            <td valign="middle"><div align="right">
                &nbsp;&nbsp;&nbsp;
              </div></td>
  </tr>
</table>


<script>
window.opener.location.reload(true);
self.close();
</script>


</body>
</center>