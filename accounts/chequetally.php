<?
include ("header.php");

$totdb =0;

$madcind = $_POST['dDay'];
$madcinm = $_POST['dMonth'];
$madciny = $_POST['dYear'];

$madcin = $madciny ."-". $madcinm ."-". $madcind ; 
$fromd = $madciny ."-". $madcinm ."-". $madcind ; 

$madcoutd = $_POST['d1Day'];
$madcoutm = $_POST['d1Month'];
$madcouty = $_POST['d1Year'];

$madcout = $madcouty ."-". $madcoutm ."-". $madcoutd ; 
$tod = $madcouty ."-". $madcoutm ."-". $madcoutd ; 

$s_typed = $_POST['typed'];

if($fromd=="--"){
$fromd = $_GET["from_d"];
$tod = $_GET["to_d"];
$s_typed = "voudate";
}

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$_SESSION['fromd'] = $fromd;
$_SESSION['tod'] = $tod;

$_SESSION['bank_name_ses'] = $tod;


$bank_str =""; 

if($_POST["acname_b"]=="select"){}
else if($_POST["acname_b"]==""){}
else{
$ac_bank_code = $_POST["acname_b"];

$bank_str = "and  bank_acccode=".$ac_bank_code ." or debit_acccode=".$ac_bank_code; 

//$bank_str = "and ( bank_acccode=".$ac_bank_code." or debit_acccode=".$ac_bank_code.") order by vounum,cramt"; 
}



?>

<script>
document.title= '<? echo $company_name . " ERP - Acounts - Current Cheque Tally Sheet"; ?>';
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
                                  <td bgcolor="#FFDFDF">&nbsp;<strong>Cheque Tally Sheet</strong>                                 </td>
						
								</tr>
		</table>

	
	<table style="border: 1px solid red" width="100%"  border="0" cellpadding="2" cellspacing="0">

      <tr>
                                  <td colspan="10" align="center" style="border-bottom: 1px solid red">&nbsp;<strong>Cheque Tally Sheet</strong>                                 </td>
						
								</tr>
<tr><td colspan="10"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Cheque Tally Sheet Between <?echo date('d-M-Y', strtotime($fromd)) ." and ". date('d-M-Y', strtotime($tod)) . " and " . $s_typed; ?> </font> </td></tr>


<tr><td style="border-top: 1px solid red;border-right: 1px solid red" align="center"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">S.No</font></td><td style="border-top: 1px solid red;border-right: 1px solid red" align="center"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">VouDate</font></td><td style="border-top: 1px solid red;border-right: 1px solid red" align="center"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Voucher</font></td><td style="border-top: 1px solid red;border-right: 1px solid red" align="center"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Chq.No</font></td><td style="border-top: 1px solid red;border-right: 1px solid red" align="left"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Paticulars</font></td><td style="border-top: 1px solid red;border-right: 1px solid red;" align="center"><font size="2" face="Verdana, Arial, Helvetica, sans-serif" >Description</font></td><td style="border-top: 1px solid red;border-right: 1px solid red" align="right"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Received</font></td><td style="border-top: 1px solid red;border-right: 1px solid red"  align="right"><font size="2" face="Verdana, Arial, Helvetica, sans-serif" >Paid</font></td><td style="border-top: 1px solid red;border-right: 1px solid red" align="center"><font size="2" face="Verdana, Arial, Helvetica, sans-serif" >Encashed</font></td><td style="border-top: 1px solid red" align="center"><font size="2" face="Verdana, Arial, Helvetica, sans-serif" >More Det</font></td></tr>



<?
	$a_typeofv = array();
	$a_vounum = array();
	$a_paidto = array();
	$a_recfrom = array();
	$a_dbamt = array();
	$a_cramt = array();
	$a_voudate = array();
	$a_statementno = array();
	$a_encashedbull = array();
	$a_chequeno = array();
	$a_description = array();
	$a_errornotes = array();
	$a_encashcdate = array();

$query_voc ="select typeofv,vounum,paidto,dbamt,cramt,voudate,recfrom,encashedbull,chequeno,errornotes,encashcdate,description from chequevou where $s_typed between '$fromd' and '$tod'  $bank_str  order by vounum,cramt";

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
	$a_recfrom[] = $rows_voc["recfrom"];
	$a_dbamt[] = $rows_voc["dbamt"];
	$a_cramt[] = $rows_voc["cramt"];
	$a_voudate[] = $rows_voc["voudate"];
	$a_encashedbull[] = $rows_voc["encashedbull"];
	$a_chequeno[] = $rows_voc["chequeno"];
	$a_description[] = $rows_voc["description"];
	$a_errornotes[] = $rows_voc["errornotes"];
	$a_encashcdate[] = $rows_voc["encashcdate"];
}

$totcr = isset($openingamount_s) ? $openingamount_s : 0;

$more_det="";

for($i=0;$i<count($a_vounum);$i++){
$ii=$i+1;
$vd="";
$vd=date('d/M', strtotime(isset($a_voudate[$i]) ? $a_voudate[$i] : ''));

 if($a_encashedbull[$i]=="t"){
    $en_cahsed="Yes";

  $more_det ="Encashed on " . date('d/M/Y', strtotime(isset($a_encashcdate[$i]) ? $a_encashcdate[$i] : ''));
  }else
{
    $en_cahsed="No";

$more_det = $a_errornotes[$i];
  }
$totdb = $totdb + $a_dbamt[$i];
$totcr = $totcr + $a_cramt[$i];


$dba = number_format($a_dbamt[$i], 2, "." , ",");
$cra = number_format($a_cramt[$i], 2, "." , ",");

if($a_typeofv[$i]=='RC'){ 
	$pati =$a_recfrom[$i] ;}
else { $pati = $a_paidto[$i] ;}



echo "<tr><td style=\"border-top: 1px solid red;border-right: 1px solid red\"  align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">$ii</font></td><td style=\"border-top: 1px solid red;border-right: 1px solid red\" align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">$vd"; 


echo "</td><td style=\"border-top: 1px solid red;border-right: 1px solid red\" align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";

$status_s=1;
if($status_s==1){

if($a_typeofv[$i]=="BV"){
?>
<a href="amendchequepayment.php?voc_type=<? echo $a_typeofv[$i]; ?>&voc_no=<?  echo $a_vounum[$i]; ?>" onClick="return confirm('Are you sure you want to Amend Voucher?')" > <? echo  $a_typeofv[$i] . " " .$a_vounum[$i] ;?> </a>
<?
}
else {
?>
<a href="amendchequereceipt.php?voc_type=<? echo $a_typeofv[$i]; ?>&voc_no=<?  echo $a_vounum[$i]; ?>" onClick="return confirm('Are you sure you want to Amend Voucher?')" > <? echo  $a_typeofv[$i] . " " .$a_vounum[$i] ;?> </a>
<?

}
}
else {
echo $a_typeofv[$i] . " " .$a_vounum[$i];
}
echo "</font></td>";



echo "<td style=\"border-top: 1px solid red;border-right: 1px solid red\" align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\" >$a_chequeno[$i]</font></td><td style=\"border-top: 1px solid red;border-right: 1px solid red\" align=\"left\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\" >$pati</font></td><td style=\"border-top: 1px solid red;border-right: 1px solid red\" align=\"left\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\" >$a_description[$i]</font></td><td style=\"border-top: 1px solid red;border-right: 1px solid red\" align=\"right\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\" >$cra</font></td><td style=\"border-top: 1px solid red;border-right: 1px solid red\" align=\"right\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\" >$dba</font></td>";


echo "<td style=\"border-top: 1px solid red;border-right: 1px solid red\" align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\" >";
?>
<a href="encashprocess.php?voc_type=<? echo $a_typeofv[$i]; ?>&voc_no=<?  echo $a_vounum[$i]; ?>" > <? echo $en_cahsed ;?> </a>
<?


echo "</font></td><td style=\"border-top: 1px solid red\" align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\" >$more_det</font></td></tr>";



}
	
?>

<tr><td style="border-top: 1px solid red;border-right: 1px solid red" colspan="6" align="center"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Total in SAR</font></td><td style="border-top: 1px solid red;border-right: 1px solid red" align="right"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b><? echo number_format($totcr, 2, "." , ",") ?></b></font></td><td style="border-top: 1px solid red" align="right"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b><? echo number_format($totdb, 2, "." , ","); ?></b></font></td><td colspan="2" style="border-top: 1px solid red;border-left: 1px solid red"  align="center"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">&nbsp;</font></td></tr>



</td>
	  </tr></table>

		 </form>
	
			 
    
			 </td>
        </tr>
      </table></td></tr>
	  
	  
      </table> 
</table>	
	
	

	</tr></table>
</body>				
</html>
