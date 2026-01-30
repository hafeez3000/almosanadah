<?
session_cache_limiter('must-revalidate');
set_time_limit(9000);
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

$fromd = $_GET['fd'];

$tod = $_GET['td'];

$wz = $_GET['wz'];

$wzs = "";
if($wz==""){ $wzs="<br>Without Zero (0) Transactions and Debit or Credit Balance" ;}

 $accn =$_GET['acc'];
 $aa_name =$_GET['accn'];
$accn_s="";
$accn_qt="";
if($accn=="select"){} else { $accn_s="<br>For: " . $aa_name ;
$accn_qt="where parent_acc=".$accn ;}

?>
<script>
document.title= '<? echo $company_name . " ERP - Acounts - Accounts Tree"; ?>';
</script>

<html>
<link rel="stylesheet" type="text/css" href="../calendar/css.css" />
<body leftmargin="0" topmargin="0" rightmargin="0">

<table width="98%" border="0" cellspacing="2" cellpadding="2" align="center" style="border-top: 1px solid black;border-right: 1px solid black;border-left: 1px solid black">
          <tr>SOHULAT AL-SAFAR UMRAH SERVICES
            <td valign="middle"  width="47%"><div align="center"><font size="4" face="Arial, Helvetica, sans-serif"><b>SOHULAT AL-SAFAR UMRAH SERVICES </b></font></div></td>
            <td rowspan="2" valign="top"><img src="../images/logo.jpg"></td>
            <td valign="top"  DIR="RTL"><div align="center"><img src="../images/arname350.jpg"  height="20"></div></td>
          </tr>
          <tr>
            <td valign="top"><div align="center"><font size="4" face="Arial, Helvetica, sans-serif"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Ibrahim Al Juffali St, Al Andalus, Jeddah,<br>Saudi Arabia, Web:satgurutravel.com.sa</font></font></div></td>
            <td valign="top"><div align="center"><font size="4" face="Arial, Helvetica, sans-serif"><font size="4" face="Arial, Helvetica, sans-serif"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"> +966 12 605 0607<br>Email: res@sohulatalsafar.com</font></font></font></div></td>

          </tr>
</table>


 <table width="98%" border="0" cellpadding="1" cellspacing="0" style="border: 1px solid black" align="center"><thead style="display:table-header-group;">
<tr><td style="border-bottom: 1px solid black;border-top: 1px solid black" colspan="9" align="center" bgcolor="#CCCCCC"><div align="left"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Trial Balance Sheet <br>from: &nbsp; <? echo date('D, d-M-Y', strtotime($fromd))  ." to " . date('D, d-M-Y', strtotime($tod)) . " " . $wzs . $accn_s; ?></div></td></tr>
<tr>
      <td style="border-right: 1px solid black" align="center" ><div align="center"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Sno</font></div></td>
      <td  style="border-right: 1px solid black" align="center"><div align="center"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Account
          Code</font></div></td>
      <td  style="border-right: 1px solid black" align="center"><div align="left"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Account
          Description</font></div></td>
      <td  style="border-right: 1px solid black" align="center"><div align="center"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Type</font></div></td>
      <td  style="border-right: 1px solid black" align="center"><div align="right"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Opening Balance</font></div></td>
      <td  style="border-right: 1px solid black" align="center"><div align="right"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Total Debt</font></div></td>
      <td  style="border-right: 1px solid black" align="center"><div align="right"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Total Credit</font></div></td>
      <td  style="border-right: 1px solid black" align="center"><div align="right"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Bal Debt</font></div></td>
      <td   align="center"><div align="right"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Bal Credit</font></div></td>
    <tr>
</thead>

 <?




$acsno=0;
$accs=1;
$aaccode=array();
$aacdesc=array();
$aopbal=array();
$atype=array();
$ASS="A";
$EXP="E";
$Li="L";
$Cap="C";

$op_opbal = 0.0;
$op_totdb =0.0;
$op_totcr =0.0;

$opbal=0.0;
$baldb=0.0;
$balcr=0.0;
$ctotdb=0.0;
$ctotcr=0.0;
$copbal=0.0;

$gbaldb=0.0;
$gbalcr=0.0;
$gtotdb=0.0;
$gtotcr=0.0;

$start_period="";
$p_query = "select startdate from period";

$p_result = pg_query($conn, $p_query);

while ($p_row = pg_fetch_array($p_result))
{
 $start_period = $p_row["startdate"];
}



$query = "select acccode,acc_name,op_bal,acc_type from accmast $accn_qt order by acccode";

$result = pg_query($conn, $query);

while ($row = pg_fetch_array($result))
{
$aaccode[$acsno] = $row["acccode"];
$aacdesc[$acsno] = $row["acc_name"];
$aopbal[$acsno] = $row["op_bal"];
$atype[$acsno] = $row["acc_type"];

$acsno++;
}



for($i=0; $i<count($aaccode) ; $i++)
{
//echo $aaccode[$i];

$z_check=0;

$op_query = "select  SUM(dbamt) as totdb, SUM(cramt) as totcr from vocmast where acccode= $aaccode[$i] and vocdate between '$start_period' and date '$fromd' - interval '1 day' ";
$op_result = pg_query($conn, $op_query);
while ($op_row = pg_fetch_array($op_result))
	{
       $op_opbal = floatval($aopbal[$i]);
 	   $op_totdb = floatval($op_row["totdb"]);
  	   $op_totcr = floatval($op_row["totcr"]);


     if($ASS==$atype[$i] || $EXP==$atype[$i]){
       $baldb = $op_opbal + $op_totdb - $op_totcr ;

	   }
	   else{

		$baldb = $op_opbal - $op_totdb + $op_totcr ;
	 	}
}


$totquery = "select  SUM(dbamt) as totdb, SUM(cramt) as totcr from vocmast where acccode= $aaccode[$i] and vocdate between '$fromd' and '$tod' ";
$totresult = pg_query($conn, $totquery);
while ($totrow = pg_fetch_array($totresult))
	{

		$copbal = 	$baldb;
   //    $copbal = floatval($aopbal[$i]);
 	   $ctotdb = floatval($totrow["totdb"]);
 	   $ctotcr = floatval($totrow["totcr"]);


     if($ASS==$atype[$i] || $EXP==$atype[$i]){
       $baldb = $copbal + $ctotdb - $ctotcr ;


	   }
	   else{
			$baldb = $copbal - $ctotdb + $ctotcr ;

	 	}

		     if($ASS==$atype[$i] || $EXP==$atype[$i]){

            if ($baldb<0) { $fbaldb = 0.0; $fbalcr = abs($baldb);}
			if ($baldb>0) {  $fbalcr = 0.0; $fbaldb = $baldb;} }
			else
		         {

            if ($baldb<0) { $fbaldb = abs($baldb); $fbalcr = 0.0;}
			if ($baldb>0) {  $fbalcr = $baldb; $fbaldb = 0.0;}
			}


 if( ($totrow["totdb"]!=0 && $totrow["totcr"]!=0 ) || ($fbaldb>0) || ($fbalcr>0) ) {$z_check=1;} else {$z_check=0;}

if($_GET['wz']=="on"){$z_check=1;}
if($z_check==1){  // if zero check


	  echo "<tr>";
	  echo "<td style=\"border-top: 1px solid black;border-right: 1px solid black\"><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">" . $accs . "</font></div></td>";
	  echo "<td style=\"border-top: 1px solid black;border-right: 1px solid black\"><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">" . $aaccode[$i] . "</font></div></td>";
	  echo "<td style=\"border-top: 1px solid black;border-right: 1px solid black\"><div align=\"left\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">" . $aacdesc[$i] . "</font></div></td>";
	  echo "<td style=\"border-top: 1px solid black;border-right: 1px solid black\"><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">" . $atype[$i] . "</font></div></td>";

      echo "<td style=\"border-top: 1px solid black;border-right: 1px solid black\"><div align=\"right\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">" . number_format(round(($copbal*100/100),2), 2, "." , ",") . "</font></div></td>";
	  echo "<td style=\"border-top: 1px solid black;border-right: 1px solid black\"><div align=\"right\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">" . number_format(round(($ctotdb*100/100),2), 2, "." , ",") . "</font></div></td>";
      echo "<td style=\"border-top: 1px solid black;border-right: 1px solid black\"><div align=\"right\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">" . number_format(round(($ctotcr*100/100),2), 2, "." , ",") . "</font></div></td>";

	  echo "<td style=\"border-top: 1px solid black;border-right: 1px solid black\"><div align=\"right\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">" . number_format(round(($fbaldb*100/100),2), 2, "." , ",") . "</font></div></td>";
      echo "<td style=\"border-top: 1px solid black\"><div align=\"right\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">" . number_format(round(($fbalcr*100/100),2), 2, "." , ",") . "</font></div></td>";


	  echo "</tr>";
	$accs++;

$gbaldb=$gbaldb + round(($ctotdb*100/100),2);
$gbalcr=$gbalcr + round(($ctotcr*100/100),2);
$gtotdb=$gtotdb + round(($fbaldb*100/100),2);
$gtotcr=$gtotcr + round(($fbalcr*100/100),2);



	$baldb=0.0;
	$fbaldb=0.0;
	$fbalcr=0.0;
} // end of zero check




ob_start();
flush();
 ob_flush();
 ob_end_clean();

	}


}

?>

<tr>
<td colspan="5"  style="border-top: 1px solid black;border-right: 1px solid black"><div align="center"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Total</font></div></td>
<td style="border-top: 1px solid black;border-right: 1px solid black"><div align="right"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><strong><? echo number_format($gbaldb, 2, "." , ",") ?></strong></font></div></td>
<td style="border-top: 1px solid black;border-right: 1px solid black"><div align="right"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><strong><? echo number_format($gbalcr, 2, "." , ",") ?></strong></font></div></td>
<td style="border-top: 1px solid black;border-right: 1px solid black"><div align="right"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><strong><? echo number_format($gtotdb, 2, "." , ",") ?></strong></font></div></td>
<td style="border-top: 1px solid black"><div align="right"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><strong><? echo number_format($gtotcr, 2, "." , ",") ?></strong></font></div></td>
</tr>


 <tfoot style="display:table-footer-group;"><tr><td colspan="9" style="border-top: 1px solid #999999;border-bottom: 1px solid black" align="right"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">End of the Page</font></td></tr></tfoot>
  </table>

</table>



<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</body>
</html>
