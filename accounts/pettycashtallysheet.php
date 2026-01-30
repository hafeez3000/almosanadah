<?
include ("header.php");


$stateno = isset($_GET["statement_no"]) ? $_GET["statement_no"] : '';

$totdb = 0;
if($stateno==""){

$query_st ="select statementno,closingdate,openingamount,status  from pettystatement where status=1";

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

}

else {

$query_st ="select statementno,closingdate,openingamount,status  from pettystatement where statementno=$stateno ";

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


}
?>

<script>
document.title= '<? echo $company_name . " ERP - Acounts - Current Petty Cash Tally Sheet"; ?>';
</script>
<script>
 var winl = (screen.width - 760) / 2; 
 var wint = (screen.height - 550) / 2;
</script>
<html>
<link rel="stylesheet" type="text/css" href="../calendar/css.css" />

<body  leftmargin="0" topmargin="0" rightmargin="0"  >
<table width="100%" border="0" cellpadding="0" cellspacing="0" style="border-bottom: 1px solid #999999 ;border-left: 3px solid #006600;border-right: 3px solid #006600"><tr>
    <td bgcolor="#CCCCCC"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">&nbsp;You 
      are here: Home</font></td>
  </tr></table>
<table width="100%" border="0" cellpadding="0" cellspacing="0" style="border-bottom: 1px solid #999999 ;border-left: 3px solid #006600;border-right: 3px solid #006600"><tr>
    <td ><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><?include ("../dticker/uhome.php"); ?></td>
  </tr></table>
  
<table width="100%" border="0" cellpadding="0" cellspacing="0" style="border-bottom: 3px solid #006600; border-right: 3px solid #006600;border-left: 3px solid #006600 ">
  <tr>
    <td width="20%" style="border-right: 1px solid #999999" valign="top"> <table width="100%" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td valign="top"><div align="left"> 
              <?include ("umenu.php"); ?>
            </div></td>
        </tr>
      </table></td>
    <td width="80%" valign="top"  > <table width="100%" border="0" cellpadding="0" cellspacing="1">
        <tr>
          <td valign="top"> 
   
	<table width="100%">
      <tr>
                                  <td bgcolor="#FFDFDF">&nbsp;<strong>Current Petty Cash Tally Sheet</strong> 
								  
								  &nbsp;
<a href="printpettycash.php?statement_no=<? echo $statementno_s ?>" target="ppc" onClick="window.open('', 'ppc','width=760,height=450,menubar=yes,scrollbars=yes, top='+wint+',left='+winl+' ').focus()"><img src="../images/print_icon.gif" width="16" height="16"></a>

								  
								  </td>
						
								</tr>
		</table>

	
	<table style="border: 1px solid red" width="100%"  border="0" cellpadding="2" cellspacing="0">

      <tr>
                                  <td colspan="7" align="center" style="border-bottom: 1px solid red">&nbsp;<strong>Current Petty Cash Tally Sheet</strong>                                 </td>
						
								</tr>
<tr><td colspan="7"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Statement Number: <? echo $statementno_s ?></font> </td></tr>
<tr><td colspan="7"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"> <? echo "Dated: " . date("r")." (GMT)"; ?>   </font> </td></tr>

<tr><td style="border-top: 1px solid red;border-right: 1px solid red" align="center"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">S.No</font></td><td style="border-top: 1px solid red;border-right: 1px solid red" align="center"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Date</font></td><td style="border-top: 1px solid red;border-right: 1px solid red" align="center"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Voucher</font></td><td style="border-top: 1px solid red;border-right: 1px solid red" align="left"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Paticulars</font></td><td style="border-top: 1px solid red;border-right: 1px solid red" align="left"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Description</font></td><td style="border-top: 1px solid red;border-right: 1px solid red" align="right"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Debit</font></td><td style="border-top: 1px solid red" align="right"><font size="2" face="Verdana, Arial, Helvetica, sans-serif" >Credit</font></td></tr>


<tr><td style="border-top: 1px solid red;border-right: 1px solid red" align="center" colspan="5"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Cash in Hand on Dated: <? echo $cd = date('D, d-M-Y', strtotime($closingdate_s));  ?></font></td><td style="border-top: 1px solid red;border-right: 1px solid red" align="right"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><? $opb = $openingamount_s; echo $opb = number_format($opb, 2, "." , ","); ?></font></td><td style="border-top: 1px solid red" align="right"><font size="2" face="Verdana, Arial, Helvetica, sans-serif" >0.00</font></td></tr>

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

// $a_voctype[] = $rows_voc["voctype"];
// $a_vocno[] = $rows_voc["vocno"];

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


echo "<tr><td style=\"border-top: 1px solid red;border-right: 1px solid red\"  align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">$ii</font></td><td style=\"border-top: 1px solid red;border-right: 1px solid red\" align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">$vd"; 


echo "</td><td style=\"border-top: 1px solid red;border-right: 1px solid red\" align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";

if($status_s==1 && $a_amendbull[$i]=='t'){

if($a_typeofv[$i]=="CP"){
?>
<a href="amendcashpayment.php?voc_type=<? echo $a_typeofv[$i]; ?>&voc_no=<?  echo $a_vounum[$i]; ?>" onclick="return confirm('Are you sure you want to Amend Voucher?')" > <? echo  $a_typeofv[$i] . " " .$a_vounum[$i] ;?> </a>
<?
}
else {
?>
<a href="amendcashreceipt.php?voc_type=<? echo $a_typeofv[$i]; ?>&voc_no=<?  echo $a_vounum[$i]; ?>" onclick="return confirm('Are you sure you want to Amend Voucher?')" > <? echo  $a_typeofv[$i] . " " .$a_vounum[$i] ;?> </a>
<?

}
}
else {
echo $a_typeofv[$i] . " " .$a_vounum[$i];
}
echo "</font></td><td style=\"border-top: 1px solid red;border-right: 1px solid red\" align=\"left\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\" >$pati</font></td><td style=\"border-top: 1px solid red;border-right: 1px solid red\" align=\"left\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\" >$f_desc</font></td><td style=\"border-top: 1px solid red;border-right: 1px solid red\" align=\"right\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\" >$cra</font></td><td style=\"border-top: 1px solid red\" align=\"right\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\" >$dba</font></td></tr>";

}
	
?>

<tr><td style="border-top: 1px solid red;border-right: 1px solid red" colspan="5" align="center"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Total in SAR</font></td><td style="border-top: 1px solid red;border-right: 1px solid red" align="right"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b><? echo number_format($totcr, 2, "." , ",") ?></b></font></td><td style="border-top: 1px solid red" align="right"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b><? echo number_format($totdb, 2, "." , ","); ?></b></font></td></tr>

<tr><td style="border-top: 1px solid red" colspan="7" align="center"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Current Petty Cash in Hand : SAR <? echo number_format(($totcr-$totdb), 2, "." , ","); ?>/- </b></font></td></tr>


</td>
	  </tr></table>

		 </form>
	
			 
    
			 </td>
        </tr>
      </table></td></tr>
	  
	  
      </table> 
</table>	
	
	

	</tr></table>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</body>				
</html>
