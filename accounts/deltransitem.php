<?
include ("header.php");
?>

<script>
document.title= '<? echo $company_name . " ERP - Accounts - Account Details"; ?>';
</script>

<html>
<link rel="stylesheet" type="text/css" href="../calendar/css.css" />
<body leftmargin="0" topmargin="0" rightmargin="0">
<table width="100%" border="0" cellpadding="0" cellspacing="0" style="border-bottom: 1px solid #999999 ;border-left: 3px solid #006600;border-right: 3px solid #006600"><tr>
    <td bgcolor="#CCCCCC"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">&nbsp;You
      are here: Home</font></td>
  </tr></table>
<table width="100%" border="0" cellpadding="0" cellspacing="0" style="border-bottom: 1px solid #999999 ;border-left: 3px solid #006600;border-right: 3px solid #006600"><tr>
    <td ><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><?include ("../dticker/uhome.php"); ?></td>
  </tr></table>

<table width="100%" height="76%" border="0" cellpadding="0" cellspacing="0" style="border-bottom: 3px solid #006600; border-right: 3px solid #006600;border-left: 3px solid #006600 ">
  <tr>
    <td width="100%"  valign="top"  > <table width="100%" border="0" cellpadding="0" cellspacing="1">
        <tr>
          <td valign="top">
           <br><br><br>
			<?

include ("gprocessing.html");

$s_voctype = $_GET["voct"];
$s_vocno = $_GET["vocno"];
$s_vocsno = $_GET["vocsno"];

if($s_vocsno==1){$s_vocsno=0;}


$q_hotel_sel ="select voctype, vocno  from vocmast where voctype='$s_voctype' and vocno='$s_vocno' and vocsno='$s_vocsno'";

$res_hotel_sel = pg_query($conn, $q_hotel_sel);

$rows_hotels = pg_num_rows($res_hotel_sel);

if (!$res_hotel_sel) {
echo "An error occured.\n";
exit;
		}

if($rows_hotels>0){

$insqamend = "delete from vocmast  where voctype='$s_voctype' and vocno='$s_vocno' and vocsno=$s_vocsno";
pg_query($conn, $insqamend);

}





?>







			 </td>
        </tr>
      </table></td></tr>


      </table>
</table>



	</tr></table>
</body>
</html>

<?
echo "<script>document.location.href=\"findtrana.php?voutype=$s_voctype&vouno=$s_vocno\"</script>";
?>
