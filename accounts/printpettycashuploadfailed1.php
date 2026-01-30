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

?>
<script>
document.title= '<? echo $company_name . " ERP - Acounts - Print Ledger"; ?>';
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
  
 <table width="98%" border="0" cellpadding="2" cellspacing="0" style="border: 1px solid black" align="center"><thead style="display:table-header-group;">
        
         
		   
	
	<?


$statementno_s = $_GET["statement_no"];



$query_st ="select statementno,closingdate,openingamount,status  from pettystatement where statementno=$statementno_s ";

$result_st = pg_query($conn, $query_st);

if (!$result_st) {
	echo "An error occured.\n";
	exit;
	}
while ($rows_st = pg_fetch_array($result_st)){

$statementno_s = $rows_st["statementno"];
$openingamount_s = $rows_st["openingamount"];
$closingdate_s = $rows_st["closingdate"];
$status_s = $rows_st["status"];
}

pg_free_result($result_st);	



?>


	
      <tr>
                                  <td colspan="6" align="center" style="border-bottom: 1px solid black;border-top: 1px solid black">&nbsp;<strong>Current Petty Cash Tally Sheet</strong>                                 </td>
						
								</tr>
<tr><td colspan="6"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Statement Number: <? echo $statementno_s ?></font> </td></tr>
<tr><td colspan="6"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"> <? echo "Dated: " . date("r")." (GMT)"; ?>   </font> </td></tr>

<tr><td style="border-top: 1px solid black;border-right: 1px solid black" align="center"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">S.No</font></td><td style="border-top: 1px solid black;border-right: 1px solid black" align="center"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Date</font></td><td style="border-top: 1px solid black;border-right: 1px solid black" align="center"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Voucher</font></td><td style="border-top: 1px solid black;border-right: 1px solid black" align="left"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Paticulars</font></td><td style="border-top: 1px solid black;border-right: 1px solid black" align="left"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Description</font></td><td style="border-top: 1px solid black;border-right: 1px solid black" align="right"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Debit</font></td><td style="border-top: 1px solid black" align="right"><font size="2" face="Verdana, Arial, Helvetica, sans-serif" >Credit</font></td></tr></thead>


<tr><td style="border-top: 1px solid black;border-right: 1px solid black" align="center" colspan="4"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Cash in Hand on Dated: <? echo $cd = date('D, d-M-Y', strtotime($closingdate_s));  ?></font></td><td style="border-top: 1px solid black;border-right: 1px solid black" align="right"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><? $opb = $openingamount_s; echo $opb = number_format($opb, 2, "." , ","); ?></font></td><td style="border-top: 1px solid black" align="right"><font size="2" face="Verdana, Arial, Helvetica, sans-serif" >0.00</font></td></tr>

<?


  $a_typeofv = array();
  $a_vounum = array();
  $a_paidto = array();
  $a_desc = array();
  $a_recfrom = array();
  $a_dbamt = array();
  $a_cramt = array();
  $a_voudate = array();
  $a_statementno = array();
  $a_amendbull = array();

$query_voc ="select typeofv,vounum,paidto,dbamt,cramt,voudate,recfrom,statementno,amendbull,description from pettyvou where statementno='$statementno_s' order by vounum,cramt";

$result_voc = pg_query($conn, $query_voc);

if (!$result_voc) {
	echo "An error occured.\n";
	exit;
	}
while ($rows_voc = pg_fetch_array($result_voc)){

$a_voctype[] = $rows_voc["voctype"];
$a_vocno[] = $rows_voc["vocno"];

  $a_typeofv[] = $rows_voc["typeofv"];
  $a_vounum[] = $rows_voc["vounum"];
  $a_paidto[] = $rows_voc["paidto"];
  $a_desc[] = $rows_voc["description"];
  $a_recfrom[] = $rows_voc["recfrom"];
  $a_dbamt[] = $rows_voc["dbamt"];
  $a_cramt[] = $rows_voc["cramt"];
  $a_voudate[] = $rows_voc["voudate"];
  $a_statementno[] = $rows_voc["statementno"];
  $a_amendbull[] = $rows_voc["amendbull"];


}

$totcr = $openingamount_s;

for($i=0;$i<count($a_vounum);$i++){
$ii=$i+1;
$vd="";
$vd=date('d/M', strtotime($a_voudate[$i]));
$f_desc = $a_desc[$i];

$totdb = $totdb + $a_dbamt[$i];
$totcr = $totcr + $a_cramt[$i];


$dba = number_format($a_dbamt[$i], 2, "." , ",");
$cra = number_format($a_cramt[$i], 2, "." , ",");

if($a_typeofv[$i]=='CR'){ 
	$pati =$a_recfrom[$i] ;}
else { $pati = $a_paidto[$i] ;}


echo "<tr><td style=\"border-top: 1px solid black;border-right: 1px solid black\"  align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">$ii</font></td><td style=\"border-top: 1px solid black;border-right: 1px solid black\" align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">$vd"; 


echo "</td><td style=\"border-top: 1px solid black;border-right: 1px solid black\" align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";


echo  $a_typeofv[$i] . " " .$a_vounum[$i] ;


echo "</font></td><td style=\"border-top: 1px solid black;border-right: 1px solid black\" align=\"left\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\" >$pati</font></td><td style=\"border-top: 1px solid black;border-right: 1px solid black\" align=\"left\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\" >$f_desc</font></td><td style=\"border-top: 1px solid black;border-right: 1px solid black\" align=\"right\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\" >$cra</font></td><td style=\"border-top: 1px solid black\" align=\"right\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\" >$dba</font></td></tr>";

}
	
?>

<tr><td style="border-top: 1px solid black;border-right: 1px solid black" colspan="5" align="center"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Total in SAR</font></td><td style="border-top: 1px solid black;border-right: 1px solid black" align="right"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b><? echo number_format($totcr, 2, "." , ",") ?></b></font></td><td style="border-top: 1px solid black" align="right"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b><? echo number_format($totdb, 2, "." , ","); ?></b></font></td></tr>

<tr><td style="border-top: 1px solid black;border-bottom: 1px solid black" colspan="6" align="center"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Current Petty Cash in Hand : SAR <? echo number_format(($totcr-$totdb), 2, "." , ","); ?>/- </b></font></td></tr>


 <tfoot style="display:table-footer-group;"><tr><td colspan="8" style="border-top: 1px solid #999999;border-bottom: 1px solid black" align="right"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">End of the Page</font></td></tr></tfoot>

</td>
	  </tr></table>


</body>				
</html>




