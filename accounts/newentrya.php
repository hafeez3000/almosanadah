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

  
<table width="100%" height="76%" border="0" cellpadding="0" cellspacing="0" style="border-bottom: 3px solid #006600; border-right: 3px solid #006600;border-left: 3px solid #006600 ">
  <tr>
    <td width="100%"  valign="top"  > <table width="100%" border="0" cellpadding="0" cellspacing="1">
        <tr>
          <td valign="top"> 
           <br><br><br>
			<?

include ("gprocessing.html"); 


$s_voutype = $_POST["voutype"];
$s_vouno = $_POST["vouno"]; 

$s_dDay = $_POST["dDay"];  
$s_dMonth = $_POST["dMonth"];
$s_dYear = $_POST["dYear"]; 

$s_voudate = $s_dYear ."-". $s_dMonth ."-".$s_dDay;

if($_POST["refno"]==""){
$s_refno = 0;
}
else{
$s_refno = $_POST["refno"];
}
settype($s_refno, "integer");

$s_rows = $_POST["it_val"];

$s_seq_val = $_POST["seq_val"];

for ($i=1; $i<=$s_rows; $i++){
$s_acccode =  $_POST["txtRow".$i];

$s_narration = pg_escape_string($conn, $_POST["viewtype".$i]);
$s_moredet =   pg_escape_string($conn, $_POST["nofp".$i]);
$s_debit =  $_POST["roomd".$i];
$s_credit = $_POST["credit".$i];

$q_hotel_sel ="select voctype, vocno  from vocmast where voctype='$s_voutype' and vocno='$s_vouno' and vocsno='$i'";

$res_hotel_sel = pg_query($conn, $q_hotel_sel);

$rows_hotels = pg_num_rows($res_hotel_sel);

if (!$res_hotel_sel) {
echo "An error occured.\n";
exit;
		}

if($rows_hotels>0){ echo "<script>alert(\"Transaction $s_voutype - $s_vouno  Already Exists!\")</script>" ; break;}
else{


$insq = "insert into vocmast(voctype,vocno,vocsno,vocdate,acccode,narration,moredet,dbamt,cramt,supp_inv,recon,invno) values('$s_voutype','$s_vouno',$i,'$s_voudate','$s_acccode','$s_narration','$s_moredet','$s_debit','$s_credit','$s_refno','f',$s_refno)";
pg_query($conn, $insq);
}

pg_query($conn, "update voctypes set seq=$s_seq_val where voctype='$s_voutype'");

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

echo "<script>document.location.href=\"newentry.php?acname=$s_voutype\"</script>"; 
?>
