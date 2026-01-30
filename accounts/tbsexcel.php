<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td>
<br><br><br><br><br>
<?
include ("gprocessing.html");
?>

</td>
</tr>
</table>
<?php
include("../db/db.php");

/** Error reporting */
//error_reporting(E_ALL);
//ini_set('display_errors', '1');

/** PHPExcel */
require_once 'phpe/Classes/PHPExcel.php';

/** PHPExcel_IOFactory */
require_once 'phpe/Classes/PHPExcel/IOFactory.php';

// Create new PHPExcel object
  date('H:i:s') . " Create new PHPExcel object\n";
$objPHPExcel = new PHPExcel();

// Set properties
  date('H:i:s') . " Set properties\n";
$objPHPExcel->getProperties()->setCreator("DORS")
							 ->setLastModifiedBy("DORS")
							 ->setTitle("Agent Ledger")
							 ->setSubject("Agent Ledger")
							 ->setDescription("Agent Ledger")
							 ->setKeywords("ledger")
							 ->setCategory("Agent Ledger");


// Add some data
  date('H:i:s') . " Add some data\n";

$objPHPExcel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
$objPHPExcel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4);




//start database
 $s_fromd = $_GET["fromd"];
 $s_tod = $_GET["tod"];
 $withz = $_GET["wch"];

 $accn_s="";
$accn_qt="";

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

$fbaldb=0.0;
$fbalcr=0.0;

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



$op_query = "select  SUM(dbamt) as totdb, SUM(cramt) as totcr from vocmast where acccode= '$aaccode[$i]' and vocdate between '$start_period' and date '$s_fromd' - interval '1 day' ";
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


$totquery = "select  SUM(dbamt) as totdb, SUM(cramt) as totcr from vocmast where acccode= '$aaccode[$i]' and vocdate between '$s_fromd' and '$s_tod' ";
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

if($withz=="true"){$z_check=1;}


if($z_check==1){  // if zero check

	  echo "<tr>";
	  echo "<td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">" . $accs . "</font></div></td>";
	  echo "<td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">"
	  ?>
	  <a href="getledgera.php?act=<? echo $aaccode[$i] ;?>&fromd=<? echo $s_fromd; ?>&tod=<? echo $s_tod; ?>" target="getledger" onClick="window.open('', 'getledger','width=750,height=450,menubar=yes,scrollbars=yes, top='+wint+',left='+winl+' ').focus()"><? echo $aaccode[$i] ;?></a>

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
 ob_end_clean();

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
