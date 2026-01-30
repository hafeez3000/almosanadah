<?
session_start();

// is the one accessing this page logged in or not?
if (!isset($_SESSION['db_is_logged_in_online']) 
   || $_SESSION['db_is_logged_in_online'] !== true) {

   // not logged in, move to login page
   header('Location: login.php');
   exit;
}
$suserid = $_SESSION["userid"];
$suser_sno = $_SESSION["user_sno"];
$dept = $_SESSION["deptaccounts"];

$s_ac =	$_SESSION['user_a_code'] ;

include("../db/db.php"); 
include ("../../conf/mainconf.php");

?>
<script>
document.title= '<? echo $company_name . " ERP - Acounts - Print Ledger"; ?>';
</script>

<html>
<link rel="stylesheet" type="text/css" href="../calendar/css.css" />
<body leftmargin="0" topmargin="0" rightmargin="0">

<table width="98%" border="0" cellspacing="2" cellpadding="2" align="center" style="border-top: 1px solid black;border-right: 1px solid black;border-left: 1px solid black">
          <tr> 
            <td valign="middle"  width="47%"><div align="center"><font size="4" face="Arial, Helvetica, sans-serif"><b>DAR 
                AL MANASEK Tourism & Umrah </b></font></div></td>
            <td rowspan="2" valign="top"><img src="../images/logo.jpg"></td>
            <td valign="top"  DIR="RTL"><div align="center"><img src="../images/arname350.jpg"></font></div></td>
          </tr>
          <tr> 
            <td valign="top"><div align="center"><font size="4" face="Arial, Helvetica, sans-serif"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">P.O.Box: 
                31646, JEDDAH 21418, Saudi Arabia <br>Web: www.daralmanasek.com</font></font></div></td>
            <td valign="top"><div align="center"><font size="4" face="Arial, Helvetica, sans-serif"><font size="4" face="Arial, Helvetica, sans-serif"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Tel: 
                00966(2)6679100, Fax: 00966(2)6679096 <br>Email: accounts@daralmanasek.com</font></font></font></div></td>
           
          </tr>
        </table>
  
 <table width="98%" border="0" cellpadding="2" cellspacing="0" style="border: 1px solid black" align="center"><thead style="display:table-header-group;">
        
         
		   
	
	<?




$currency_s = "Saudi Riyals";

if($s_ac>150300 && $s_ac<150399){
$currency_s = "United Arab Emirates Dirhams" ;
}

$madcin = $_GET["fd"];
$madcout = $_GET["td"];

$fromd = $_GET["fd"];
$tod  = $_GET["td"];

$s_assests = "A";
$s_liabilities = "L";
$s_income = "I";
$s_expenses = "E";
$s_equity = "Q";


$query_hotel ="select acccode,acc_name,acc_type,db_bal,cr_bal,op_bal from accmast where acccode='$s_ac'";

$result_hotel = pg_query($query_hotel);

if (!$result_hotel) {
	echo "An error occured.\n";
	exit;
	}
while ($rows_hotel = pg_fetch_array($result_hotel)){

$acc_name = $rows_hotel["acc_name"];
$acccode = $rows_hotel["acccode"];
$acc_type = $rows_hotel["acc_type"];
$db_bal = $rows_hotel["db_bal"];
$cr_bal = $rows_hotel["cr_bal"];
$op_bal = $rows_hotel["op_bal"];
}

pg_free_result($result_hotel);


if($acc_type==$s_assests || $acc_type==$s_expenses){
$bal = $op_bal + $db_bal - $cr_bal;
}
else{
$bal = $op_bal - $db_bal + $cr_bal;
}

$dba = number_format($db_bal, 2, "." , ",");
$cra = number_format($cr_bal, 2, "." , ",");
$bala = number_format($op_bal, 2, "." , ",");


$start_period="";
$p_query = "select startdate from period";

$p_result = pg_query($p_query);

while ($p_row = pg_fetch_array($p_result))
{ 
 $start_period = $p_row["startdate"];
}

$op_query = "select SUM(dbamt) as totdb, SUM(cramt) as totcr from vocmast where acccode='$s_ac' and vocdate between '$start_period' and date '$fromd' - interval '1 day' ";
$op_result = pg_query($op_query);
while ($op_row = pg_fetch_array($op_result))
	{
      
   
      $op_totdb = floatval($op_row["totdb"]);
 	   $op_totcr = floatval($op_row["totcr"]);
       
     if($acc_type==$s_assests || $acc_type==$s_expenses){
       $baldb = $bal + $op_totdb - $op_totcr ;
	  
	   }
	   else{

		$baldb = $bal - $op_totdb + $op_totcr ;
	 	}  
}

$bal=$baldb;
$bal_p=$bala = number_format($baldb, 2, "." , ","); //for print

$a_voctype = array();
$a_vocno = array();
$a_vocdate = array();
$a_narration = array();
$a_dbamt = array();
$a_cramt = array();
$a_pnr = array();
$a_moredet = array();
$a_supp_inv = array();

$query_voc ="select voctype,vocno,vocdate,narration,dbamt,cramt,pnr,moredet,supp_inv from vocmast where acccode='$s_ac' and vocdate between '$fromd' and '$tod' order by vocdate,voctype,vocno";

$result_voc = pg_query($query_voc);

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
$a_supp_inv[] = $rows_voc["supp_inv"];
}
	

	
	?>
 <tr>
     <td bgcolor="#CCCCCC" colspan="7" align="center"><font size="3" face="Arial,Verdana,  Helvetica, sans-serif"> <strong><?echo $acc_name ?> Ledger  </strong></font>                                 </td>
                                </tr>

 <tr>
     <td colspan="7"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"> <?echo "Dated: " . date("r")." (GMT)"; ?>  </font>                            </td></tr>



 <tr>
     <td colspan="7"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"> <?echo "Account Code: " .$acccode ." - Account Name: ". $acc_name ?>  </font>                            </td>
                                </tr>
<tr>
     <td colspan="7"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Period: <?echo date('d-M-Y', strtotime($madcin)) ." to ". date('d-M-Y', strtotime($madcout)); ?>  </font>                            </td></tr>
<tr><td style="border-top: 1px solid black;border-right: 1px solid black" align="center"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">S.No</font></td><td style="border-top: 1px solid black;border-right: 1px solid black" align="center"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Voucher No</font></td><td style="border-top: 1px solid black;border-right: 1px solid black" align="center"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Voucher Date</font></td><td style="border-top: 1px solid black;border-right: 1px solid black" align="center"><font size="2" face="Verdana, Arial, Helvetica, sans-serif" >Narration</font></td><td style="border-top: 1px solid black;border-right: 1px solid black" align="right"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Debit</font></td><td style="border-top: 1px solid black;border-right: 1px solid black" align="right"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Credit</font></td><td style="border-top: 1px solid black" align="right"><font size="2" face="Verdana, Arial, Helvetica, sans-serif" >Balanace</font></td></tr></thead>


<tr><td style="border-top: 1px solid black;border-right: 1px solid black" colspan="4" align="center"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Opening Balance</font></td><td style="border-top: 1px solid black;border-right: 1px solid black" align="right"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><? echo number_format($totdb, 2, "." , ",") ?></font></td><td style="border-top: 1px solid black;border-right: 1px solid black" align="right"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><? echo number_format($totcr, 2, "." , ","); ?></font></td><td style="border-top: 1px solid black" align="right"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><? echo $bal_p ?></font></td></tr>

<?
for($i=0;$i<count($a_voctype);$i++){
$ii=$i+1;
$vd="";
$vd=date('d/M', strtotime($a_vocdate[$i]));

$totdb = $totdb + $a_dbamt[$i];
$totcr = $totcr + $a_cramt[$i];

if($acc_type==$s_assests || $acc_type==$s_expenses){
$bal = $bal + $a_dbamt[$i] - $a_cramt[$i];
}
else{
$bal = $bal - $a_dbamt[$i] + $a_cramt[$i];
}

$dba = number_format($a_dbamt[$i], 2, "." , ",");
$cra = number_format($a_cramt[$i], 2, "." , ",");
$bala = number_format($bal, 2, "." , ",");

$ref_no = "";
if($a_supp_inv[$i]==""){}else {$ref_no="Ref No # " . $a_supp_inv[$i];}

echo "<tr><td style=\"border-top: 1px solid black;border-right: 1px solid black\"  align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">$ii</font></td><td style=\"border-top: 1px solid black;border-right: 1px solid black\" align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">$a_voctype[$i] $a_vocno[$i]</td><td style=\"border-top: 1px solid black;border-right: 1px solid black\" align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">$vd</font></td><td style=\"border-top: 1px solid black;border-right: 1px solid black\" align=\"left\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">$a_narration[$i]<br>$a_moredet[$i] $ref_no</font></td><td style=\"border-top: 1px solid black;border-right: 1px solid black\" align=\"right\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\" >$dba</font></td><td style=\"border-top: 1px solid black;border-right: 1px solid black\" align=\"right\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\" >$cra</font></td><td style=\"border-top: 1px solid black\" align=\"right\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\" >$bala</font></td></tr>";

}
	
?>

<tr><td style="border-top: 1px solid black;border-right: 1px solid black" colspan="4" align="center"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Total in SAR</font></td><td style="border-top: 1px solid black;border-right: 1px solid black" align="right"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b><? echo number_format($totdb, 2, "." , ",") ?></b></font></td><td style="border-top: 1px solid black;border-right: 1px solid black" align="right"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b><? echo number_format($totcr, 2, "." , ","); ?></b></font></td><td style="border-top: 1px solid black" align="right"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b><? echo $bala ?></b></font></td></tr>

<?
 if($s_ac>150000 && $s_ac<399999){
?>
<tr><td style="border-top: 1px solid black;border-right: 1px solid black;border-bottom: 1px solid black" colspan="7" align="center"><font size="3" face="Verdana, Arial, Helvetica, sans-serif"><br>Balance Amount Due: <b><? echo $bala ?> </b> /-&nbsp;<? echo $currency_s ?><br><br></font></td></font></tr>

<?
}
?>
 <tfoot style="display:table-footer-group;"><tr><td colspan="7" style="border-top: 1px solid #999999" align="right"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">End of the Page</font></td></tr></tfoot>
  </table>
	
</table>	




</body>				
</html>




