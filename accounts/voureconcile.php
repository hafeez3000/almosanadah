<?
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// is the one accessing this page logged in or not?
if (!isset($_SESSION['db_is_logged_in_accounts']) 
   || $_SESSION['db_is_logged_in_accounts'] !== true) {

   // not logged in, move to login page
   header('Location: login.php');
   exit;
}
$suserid = $_SESSION["userid"];
$suser_sno = $_SESSION["user_sno"];
$dept = $_SESSION["deptaccounts"];

include("../db/db.php"); 
include ("../conf/mainconf.php");

$totdb = 0;
$totcr = 0;


?>
<script>
document.title= '<? echo $company_name . " ERP - Acounts - Accounts Tree"; ?>';
</script>

<html>
<link rel="stylesheet" type="text/css" href="../calendar/css.css" />
<body leftmargin="0" topmargin="0" rightmargin="0">

<table width="98%" border="0" cellspacing="2" cellpadding="2" align="center">
<tr> 
  <td valign="middle"  width="40%"><div align="center"><font size="5px" face="Arial, Helvetica, sans-serif"><b>SOHULAT AL-SAFAR UMRAH SERVICES </b></font></div></td>
  <td rowspan="2" valign="top"><img src="../images/logo.jpg"></td>
  <td valign="top"  DIR="RTL"><div align="center"><img src="../images/arname350.jpg"></div></td>
</tr>
<tr> 
  <td valign="top"><div align="center"><font size="4" face="Arial, Helvetica, sans-serif"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Ibrahim Al Juffali St, Al Andalus, Jeddah, Saudi Arabia, Web:satgurutravel.com.sa</font></font></div></td>
  <td valign="top"><div align="center"><font size="4" face="Arial, Helvetica, sans-serif"><font size="4" face="Arial, Helvetica, sans-serif"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">+966 12 605 0607, Email: res@sohulatalsafar.com</font></font></font></div></td>
 
</tr>
</table>
 <form name="re_co" action="voureconcilea.php"  method="post" onSubmit="return fun2(this)" > 
 <table width="98%" border="0" cellpadding="2" cellspacing="0" style="border: 1px solid black" align="center"><thead style="display:table-header-group;">
        
         
		   
	
	<?


 $s_act = $_GET["act"];
 $s_minv = trim($_GET["vocno"]);


$a_acc_name = array();
$a_acccode = array();

$query_hotel ="select acccode,acc_name from accmast order by acccode";

$result_hotel = pg_query($conn, $query_hotel);

if (!$result_hotel) {
	echo "An error occured.\n";
	exit;
	}
while ($rows_hotel = pg_fetch_array($result_hotel)){

$a_acc_name[] = $rows_hotel["acc_name"];
$a_acccode[] = $rows_hotel["acccode"];
}






$a_voctype = array();
$a_vocno = array();
$a_vocdate = array();
$a_narration = array();
$a_dbamt = array();
$a_cramt = array();
$a_pnr = array();
$a_moredet = array();
$aa_acccode = array();
$a_supp_inv = array();
$a_recon = array();

$query_voc ="select voctype,vocno,vocdate,acccode,narration,dbamt,cramt,pnr,moredet,supp_inv,recon from vocmast where voctype='$s_act' and vocno='$s_minv' order by  vocno,voctype,vocsno";

$result_voc = pg_query($conn, $query_voc);



if (!$result_voc) {
	echo "An error occured.\n";
	exit;
	}
while ($rows_voc = pg_fetch_array($result_voc)){

$a_voctype[] = $rows_voc["voctype"];
$a_vocno[] = $rows_voc["vocno"];
$a_vocdate[] = $rows_voc["vocdate"];  
$a_narration[] = $rows_voc["narration"];
$a_dbamt[] = $rows_voc["dbamt"];    
$a_cramt[] = $rows_voc["cramt"];    
$a_pnr[] = $rows_voc["pnr"];      
$a_moredet[] = $rows_voc["moredet"];  
$aa_acccode[] = $rows_voc["acccode"];  
$a_supp_inv[] = $rows_voc["supp_inv"];
$a_recon[] = $rows_voc["recon"];
}
	



	
	?>
 <tr>

     <td background="../images/ftr_bg.gif" colspan="9" align="center"><font color="FFFFFF" size="3" face="Arial,Verdana,  Helvetica, sans-serif"><strong><?echo $s_act ." ". $s_minv?> Transaction Summary for Reconcile...</strong></font></td></tr>



<tr><td style="border-top: 1px solid black;border-right: 1px solid black" align="center"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">S.No</font></td><td style="border-top: 1px solid black;border-right: 1px solid black" align="center"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Vocher No</font></td><td style="border-top: 1px solid black;border-right: 1px solid black" align="center"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Vocher Date</font></td><td style="border-top: 1px solid black;border-right: 1px solid black" align="center"><font size="2" face="Verdana, Arial, Helvetica, sans-serif" >Narration</font></td><td style="border-top: 1px solid black;border-right: 1px solid black" align="center"><font size="2" face="Verdana, Arial, Helvetica, sans-serif" >Account</font></td><td style="border-top: 1px solid black;border-right: 1px solid black" align="center"><font size="2" face="Verdana, Arial, Helvetica, sans-serif" >Account Description</font></td><td style="border-top: 1px solid black;border-right: 1px solid black" align="right"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Debit</font></td><td style="border-top: 1px solid black;border-right: 1px solid black" align="right"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Credit</font></td><td style="border-top: 1px solid black" align="right"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Reconcile</font></td></tr></thead>




<?
for($i=0;$i<count($a_voctype);$i++){
$ii=$i+1;
$vd="";
$vd=date('d/M', strtotime($a_vocdate[$i]));

$totdb = $totdb + $a_dbamt[$i];
$totcr = $totcr + $a_cramt[$i];

$dba = number_format($a_dbamt[$i], 2, "." , ",");
$cra = number_format($a_cramt[$i], 2, "." , ",");

$s_acc_name="";
for($j=0; $j<count($a_acccode); $j++){
if($a_acccode[$j]==$aa_acccode[$i]){
$s_acc_name=$a_acc_name[$j];
}
}
$avas="unchecked";
if($a_recon[$i]=="t"){
$avas="checked";
}

$ref_no = "";
if($a_supp_inv[$i]==""){}else {$ref_no="Ref No # " . $a_supp_inv[$i];}



echo "<tr><td style=\"border-top: 1px solid black;border-right: 1px solid black\"  align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">$ii</font></td><td style=\"border-top: 1px solid black;border-right: 1px solid black\" align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";
?>
<? echo $a_voctype[$i] . $a_vocno[$i] ;?>

<?	
	
echo "</td><td style=\"border-top: 1px solid black;border-right: 1px solid black\" align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">$vd</font></td><td style=\"border-top: 1px solid black;border-right: 1px solid black\" align=\"left\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">$a_narration[$i]<br>$a_moredet[$i] $ref_no</font></td><td style=\"border-top: 1px solid black;border-right: 1px solid black\" align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\" >$aa_acccode[$i]</font></td><td style=\"border-top: 1px solid black;border-right: 1px solid black\" align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\" >$s_acc_name</font></td><td style=\"border-top: 1px solid black;border-right: 1px solid black\" align=\"right\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\" >$dba</font></td><td style=\"border-top: 1px solid black;border-right: 1px solid black\" align=\"right\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\" >$cra</font></td><td style=\"border-top: 1px solid black\" align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\" >";
echo "<input type=\"checkbox\" id=\"cb$i\" name=\"cb$i\" $avas >";

echo "</font></td></tr>";

}
	
?>

<tr><td style="border-top: 1px solid black;border-right: 1px solid black" colspan="6" align="center"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Total in SAR</font></td><td style="border-top: 1px solid black;border-right: 1px solid black" align="right"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b><? echo number_format($totdb, 2, "." , ",") ?></b></font></td><td style="border-top: 1px solid black;border-right: 1px solid black" align="right"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b><? echo number_format($totcr, 2, "." , ","); ?></b></font></td><td style="border-top: 1px solid black">&nbsp;</td></tr>


 <tfoot style="display:table-footer-group;"><tr><td colspan="9" style="border-top: 1px solid #999999" align="right"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><input type="submit" name="Submit" value="Reconcile!" ?></font></td></tr></tfoot>
  </table>

  <input type="hidden" name="voct" id="voct" value="<? echo $s_act; ?>" >
  <input type="hidden" name="vocn" id="vocn" value="<? echo $s_minv; ?>" >
</form>	
</table>	


<script>
function fun2(theFrom){

var ran = <? echo $ii ;?>;

for (i=1;i<ran ;i++){

if(document.getElementById('cb'+i).checked==false){
alert("Sorry but You should check the box for Reconcile");
return false;
}

}


}
</script>

</body>				
</html>




