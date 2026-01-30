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


$s_chk="f";
$s_ac = $_SESSION['acc_c'];

$s_ac_code= $_POST['ac_code'];
$s_acc_name= $_POST['ac_name'];
$s_ac_desc= $_POST['ac_desc'];
$s_ope_dbal= $_POST['ope_dbal'];
$s_ope_cbal= $_POST['ope_cbal'];
$s_acc_type= $_POST['acc_type'];
$s_ope_bal= $_POST['ope_bal'];
$s_pa_acc= $_POST['pa_acc'];
$fa_bv= isset($_POST['final_ac']) ? $_POST['final_ac'] : '';

$s_acc_name = safeAddSlashes($s_acc_name);
$s_ac_desc = safeAddSlashes($s_ac_desc);

if($fa_bv=="on"){
$s_chk ="t";
}


$accupd = "update accmast set  acccode='$s_ac_code', acc_name='$s_acc_name', acc_desc='$s_ac_desc',parent_acc='$s_pa_acc',acc_type='$s_acc_type',db_bal=$s_ope_dbal,cr_bal=$s_ope_cbal,op_bal=$s_ope_bal,fa_bull='$s_chk'  where acccode='$s_ac' and parent_acc!='0' "; 


pg_query($conn, $accupd);



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
