<?

set_time_limit(900);
session_cache_limiter('must-revalidate');
include ("header.php");
?>
<script src="../javascripts/cBoxes.js"></script>
<script>
document.title= '<? echo $company_name . " ERP - Acounts - Trial Balance Sheet"; ?>';
</script>
<script>
 var winl = (screen.width - 760) / 2;
 var wint = (screen.height - 550) / 2;
</script>
<html>
<link rel="stylesheet" type="text/css" href="../calendar/css.css" />
<style type="text/css">
<!--
.style6 {font-family: Verdana, Arial, Helvetica, sans-serif}
-->
</style>
<body leftmargin="0" topmargin="0" rightmargin="0">
<table name="hmenutable" id="hmenutable" width="100%" border="0" cellpadding="0" cellspacing="0" style="border-bottom: 1px solid #999999 ;border-left: 3px solid #006600;border-right: 3px solid #006600"><tr>
    <td bgcolor="#CCCCCC"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">&nbsp;You
      are here: Home</font></td>
  </tr></table>


<table name="fintert" id="fintert" width="100%" border="0" cellpadding="0" cellspacing="0" style="border-bottom: 3px solid #006600; border-right: 3px solid #006600;border-left: 3px solid #006600 ">
  <tr>
    <td width="20%" style="border-right: 1px solid #999999" valign="top"> <table width="100%" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td valign="top"><div align="left">
              <?include ("umenu.php"); ?>
            </div></td>
        </tr>
      </table></td>
    <td width="80%" valign="top"  >
<?

$fbaldb = 0;
$fbalcr = 0;

$madcind = $_POST['dDay'];
$madcinm = $_POST['dMonth'];
$madciny = $_POST['dYear'];

$fromd = $madciny ."-". $madcinm ."-". $madcind ;

$madcoutd = $_POST['d1Day'];
$madcoutm = $_POST['d1Month'];
$madcouty = $_POST['d1Year'];

$tod = $madcouty ."-". $madcoutm ."-". $madcoutd ;

$wz = isset($_POST["withz"]) ? $_POST["withz"] : "";

$wzs = "";
if($wz==""){ $wzs="<br>Without Zero (0) Transactions and  Debit or Credit Balance" ;}

 $accn = isset($_POST["acname"]) ? $_POST["acname"] : "";
 $aa_name = isset($_POST["aa_name"]) ? $_POST["aa_name"] : "";
$accn_s="";
$accn_qt="";
if($accn=="select"){} else { $accn_s="<br>For: " . $aa_name ;
$accn_qt="where cast(parent_acc as varchar)='".$accn."'" ;}


?>
		  <table width="100%" border="0" cellpadding="1" cellspacing="0">
		  <tr><td><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Trial Balance Sheet <br>from: &nbsp; <? echo date('D, d-M-Y', strtotime($fromd))  ." to " . date('D, d-M-Y', strtotime($tod)) . " " . $wzs . $accn_s; ?></b></font>


		   <a href="printtbs.php?wz=<? echo $wz ?>&fd=<? echo $fromd ?>&td=<? echo $tod ?>&acc=<? echo $accn ?>&accn=<? echo $aa_name ?>" target="ptbs" onClick="window.open('', 'ptbs','width=760,height=450,menubar=yes,scrollbars=yes, top='+wint+',left='+winl+' ').focus()"><img src="../images/print_icon.gif" width="16" height="16"></a>

		  </td></tr>
      </table>



		  <table width="100%" border="1" cellpadding="1" cellspacing="0">
<thead style="display:table-header-group;">
	<tr>
      <td><div align="center"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Sno</font></div></td>
      <td><div align="center"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Account
          Code</font></div></td>
      <td><div align="left"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Account
          Description</font></div></td>
      <td><div align="center"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Type</font></div></td>
      <td><div align="right"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Opening Balance</font></div></td>
      <td><div align="right"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Total Debt</font></div></td>
      <td><div align="right"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Total Credit</font></div></td>
      <td><div align="right"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Bal Debt</font></div></td>
      <td><div align="right"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Bal Credit</font></div></td>
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

$query = "select acccode,acc_name,op_bal,acc_type from accmast  $accn_qt order by acccode";

$result = pg_query($conn, $query);

if (!$result) {
	echo "An error occured.\n";
	exit;
	}

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



 $op_query = "select  SUM(dbamt) as totdb, SUM(cramt) as totcr from vocmast where acccode= '$aaccode[$i]' and vocdate between '$start_period' and date '$fromd' - interval '1 day' ";
$op_result = pg_query($conn, $op_query);

if (!$op_result) {
	echo "An error occured.\n";
	exit;
	}

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


$totquery = "select  SUM(dbamt) as totdb, SUM(cramt) as totcr from vocmast where acccode= '$aaccode[$i]' and vocdate between '$fromd' and '$tod' ";
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


 if( ($totrow["totdb"]!=0 && $totrow["totcr"]!=0 ) || ($fbaldb>0) || ($fbalcr>0)) {$z_check=1;} else {$z_check=0;}

if(isset($_POST["withz"]) && $_POST["withz"]=="on"){$z_check=1;}
if($z_check==1){  // if zero check

	  echo "<tr>";
	  echo "<td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">" . $accs . "</font></div></td>";
	  echo "<td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">"
	  ?>
	  <a href="getledgera.php?act=<? echo $aaccode[$i] ;?>&fromd=<? echo $fromd; ?>&tod=<? echo $tod; ?>" target="getledger" onClick="window.open('', 'getledger','width=750,height=450,menubar=yes,scrollbars=yes, top='+wint+',left='+winl+' ').focus()"><? echo $aaccode[$i] ;?></a>

      <?
      echo "</font></div></td>";
	  echo "<td><div align=\"left\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">" . $aacdesc[$i] . "</font></div></td>";
	  echo "<td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">" . $atype[$i] . "</font></div></td>";

      echo "<td><div align=\"right\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">" . number_format(round(($copbal*100/100),2), 2, "." , ",") . "</font></div></td>";
	  echo "<td><div align=\"right\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">" . number_format(round(($ctotdb*100/100),2), 2, "." , ",") . "</font></div></td>";
      echo "<td><div align=\"right\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">" . number_format(round(($ctotcr*100/100),2), 2, "." , ",") . "</font></div></td>";

	  echo "<td><div align=\"right\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">" . number_format(round(($fbaldb*100/100),2), 2, "." , ",") . "</font></div></td>";
      echo "<td><div align=\"right\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">" . number_format(round(($fbalcr*100/100),2), 2, "." , ",") . "</font></div></td>";


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
 ob_end_flush();

	}


}

?>

<tr>
<td colspan="5"><div align="center"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Total</font></div></td>
<td><div align="right"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><strong><? echo number_format($gbaldb, 2, "." , ",") ?></strong></font></div></td>
<td><div align="right"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><strong><? echo number_format($gbalcr, 2, "." , ",") ?></strong></font></div></td>
<td><div align="right"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><strong><? echo number_format($gtotdb, 2, "." , ",") ?></strong></font></div></td>
<td><div align="right"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><strong><? echo number_format($gtotcr, 2, "." , ",") ?></strong></font></div></td>
</tr>
<tfoot style="display:table-footer-group;"><tr><td colspan="9" style="border-top: 1px solid #999999" align="right">End of the Page</td></tr></tfoot>
  </table>



			</td></tr>


      </table>
</table>



	</tr></table>
</body>
</html>


<script>
document.getElementById('headertable').width=document.getElementById('fintert').offsetWidth;
document.getElementById('hmenutable').width=document.getElementById('fintert').offsetWidth;
</script>
