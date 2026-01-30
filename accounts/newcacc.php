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

if (!function_exists('get_magic_quotes_gpc')) {
    function get_magic_quotes_gpc() {
        return false;
    }
}
function safeAddSlashes($string) 
{ 
 if (get_magic_quotes_gpc()) { 
   return $string; 
 } else { 
   return addslashes($string); 
 } 
} 

$s_ac_code= $_POST['ac_code'];
$s_acc_name= $_POST['ac_name'];
$s_ac_desc= $_POST['ac_desc'];
$s_ope_dbal= $_POST['ope_dbal'];
$s_ope_cbal= $_POST['ope_cbal'];
$s_acc_type= $_POST['acc_type'];
$s_ope_bal= $_POST['ope_bal'];
$s_pa_acc= $_POST['pa_acc'];

$s_acc_name = safeAddSlashes($s_acc_name);
$s_ac_desc = safeAddSlashes($s_ac_desc);

$ac_chk = "select acccode from accmast where acccode='$s_ac_code'";
$result_ac_chk = pg_query($conn, $ac_chk);
$hid_c = pg_num_rows($result_ac_chk);

if($hid_c>0){ }
else{

$query_hotel ="select acc_sno from accmast  order by acccode";

$result_hotel = pg_query($conn, $query_hotel);

if (!$result_hotel) {
	echo "An error occured.\n";
	exit;
	}
while ($rows_hotel = pg_fetch_array($result_hotel)){

$array_hotel_id[] = $rows_hotel["acc_sno"];

}

pg_free_result($result_hotel);
$hc = count($array_hotel_id);
$hotel_id = $array_hotel_id[$hc-1];
$hotel_id++;


$accupd = "insert into accmast(acc_sno,acccode,acc_name,acc_desc,parent_acc,acc_type,db_bal,cr_bal,op_bal) values($hotel_id,'$s_ac_code','$s_acc_name','$s_ac_desc','$s_pa_acc','$s_acc_type',$s_ope_dbal,$s_ope_cbal,$s_ope_bal)";

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
