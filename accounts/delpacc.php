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


$s_ac =  $_GET['pacc'];
$hid_c=0;

$ac_chk = "select acccode from accmast where acccode='$s_ac'";
$result_ac_chk = pg_query($conn, $ac_chk);
$hid_c = pg_num_rows($result_ac_chk);

$ac_chkp = "select acccode from accmast where parent_acc='$s_ac'";
$result_ac_chkp = pg_query($conn, $ac_chkp);
$hid_c = pg_num_rows($result_ac_chkp);

if($hid_c>0){ 
echo "<script>alert (\"Sorry, You Can't delete Account Having Child Accounts\") </script>"; 
}
else{

$accupd = "delete from accmast where acccode='$s_ac'";

pg_query($conn, $accupd);

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
echo "<script>document.location.href=\"accountstree.php\"</script>"; 
?>
