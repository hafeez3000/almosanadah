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
document.title= '<? echo $company_name . " ERP - Acounts - Print Query Result"; ?>';
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



$s_ac = $_GET["acc"];

$s_scode = $_GET["sc"];

if($s_ac=="select"){
$s_ac = "";
$s_acc="";
}
else{
$s_acc = " Account Code: ".$s_ac;
$s_ac = " and acccode='" . $s_ac . "'";
}

if($s_scode=="select"){
$s_scode = "";
$s_scodes = ""; 
}
else{
$s_scodes = "Voucher Type: " . $s_scode;
$s_scode = " and voctype='" . $s_scode ."'";
}



$dba=0;
$cra=0;

$totdb=0;
$totcr=0;
$acc_name="";


$madcin = $_GET["fd"];
$madcout = $_GET["td"];

$fromd = $_GET["fd"];
$tod  = $_GET["td"];



$voctype= array();
$vocno= array();
$vocsno=array();
$vocdate=array();
$acccode=array();
$dbamt=array();
$cramt=array();


$array_acc_name = array();
$array_acccode = array();
$array_parent_acc = array();
$query_hotel ="select acccode,acc_name,parent_acc from accmast order BY acccode";

$result_hotel = pg_query($conn, $query_hotel);

if (!$result_hotel) {
	echo "An error occured.\n";
	exit;
	}
while ($rows_hotel = pg_fetch_array($result_hotel)){

$array_acc_name[] = $rows_hotel["acc_name"];
$array_acccode[] = $rows_hotel["acccode"];
$array_parent_acc[] = $rows_hotel["parent_acc"];
}

pg_free_result($result_hotel);



$query_hotel ="select  voctype,vocno,vocsno,vocdate,acccode,dbamt,cramt from vocmast where vocdate between '$fromd' and '$tod' $s_ac  $s_scode  order by voctype,vocno,vocsno ";

$result_hotel = pg_query($conn, $query_hotel);

if (!$result_hotel) {
	echo "An error occured.\n";
	exit;
	}
while ($rows_hotel = pg_fetch_array($result_hotel)){

$voctype[]= $rows_hotel["voctype"];
$vocno[]= $rows_hotel["vocno"];  
$vocsno[]=	 $rows_hotel["vocsno"]; 
$vocdate[]=	 $rows_hotel["vocdate"];
$acccode[]=	 $rows_hotel["acccode"];
$dbamt[]=	 $rows_hotel["dbamt"];  
$cramt[]=	 $rows_hotel["cramt"]; 

}

pg_free_result($result_hotel);





?>
 <tr>
     <td bgcolor="#CCCCCC" colspan="7"><font size="3" face="Verdana, Arial, Helvetica, sans-serif"> <strong> Query  <? echo $s_acc . $s_scodes ?></strong></font>                                 </td>
                                </tr>

 <tr>
     <td colspan="7"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"> <? echo "Dated: " . date("r")." (GMT)"; ?>   </font>                            </td></tr>



 <tr>
     <td colspan="7"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"> <?echo $s_acc  ?>  </font>                            </td>
                                </tr>
<tr>
     <td colspan="7"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Period: <?echo date('d-M-Y', strtotime($madcin)) ." to ". date('d-M-Y', strtotime($madcout)); ?>  </font>                            </td></tr>

<tr><td style="border-top: 1px solid black;border-right: 1px solid black" align="center"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">S.No</font></td><td style="border-top: 1px solid black;border-right: 1px solid black" align="center"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Voucher No</font></td><td style="border-top: 1px solid black;border-right: 1px solid black" align="center"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Voucher Date</font></td><td style="border-top: 1px solid black;border-right: 1px solid black" align="center"><font size="2" face="Verdana, Arial, Helvetica, sans-serif" >Account Code</font></td><td style="border-top: 1px solid black;border-right: 1px solid black" align="center"><font size="2" face="Verdana, Arial, Helvetica, sans-serif" >Account Name</font></td><td style="border-top: 1px solid black;border-right: 1px solid black" align="right"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Debit</font></td><td style="border-top: 1px solid black" align="right"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Credit</font></td></tr></thead>



<?

for($i=0;$i<count($voctype);$i++){
$ii=$i+1;


$dba = number_format($dbamt[$i], 2, "." , ",");
$cra = number_format($cramt[$i], 2, "." , ",");

$acc_name="";

for($j=0; $j<count($array_acc_name); $j++){
  if(trim($array_acccode[$j])==trim($acccode[$i])){
 $acc_name=$array_acc_name[$j];
  }
}



$vd=date('d/M', strtotime($vocdate[$i]));

echo "<tr><td style=\"border-top: 1px solid black;border-right: 1px solid black\"  align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">$ii</font></td><td style=\"border-top: 1px solid black;border-right: 1px solid black\" align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">"; 

?>



<? echo $voctype[$i] ." ". $vocno[$i] ;?>


<?

echo "</td><td style=\"border-top: 1px solid black;border-right: 1px solid black\" align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">$vd</font></td><td style=\"border-top: 1px solid black;border-right: 1px solid black\" align=\"left\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">$acccode[$i]</font></td><td style=\"border-top: 1px solid black;border-right: 1px solid black\" align=\"left\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">$acc_name</font></td><td style=\"border-top: 1px solid black;border-right: 1px solid black\" align=\"right\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\" >$dba</font></td><td style=\"border-top: 1px solid black\" align=\"right\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\" >$cra</font></td></tr>";


$totdb = $totdb + $dbamt[$i];
$totcr = $totcr + $cramt[$i];

}

	
?>

<tr><td style="border-top: 1px solid black;border-right: 1px solid black" colspan="5" align="center"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Total in SAR</font></td><td style="border-top: 1px solid black;border-right: 1px solid black" align="right"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b><? echo number_format($totdb, 2, "." , ",") ?></b></font></td><td style="border-top: 1px solid black" align="right"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b><? echo number_format($totcr, 2, "." , ","); ?></b></font></td></tr>

 <tfoot style="display:table-footer-group;"><tr><td colspan="7" style="border-top: 1px solid black" align="right"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">End of the Page</font></td></tr></tfoot>
      </table>

</table>


</body>				
</html>




