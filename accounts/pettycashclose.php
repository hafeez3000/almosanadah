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
<table width="100%" border="0" cellpadding="0" cellspacing="0" style="border-bottom: 1px solid #999999 ;border-left: 3px solid #006600;border-right: 3px solid #006600"><tr>
    <td ><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><?include ("../dticker/uhome.php"); ?></td>
  </tr></table>
  
<table width="100%" height="76%" border="0" cellpadding="0" cellspacing="0" style="border-bottom: 3px solid #006600; border-right: 3px solid #006600;border-left: 3px solid #006600 ">
  <tr>
    <td width="100%"  valign="top"  > <table width="100%" border="0" cellpadding="0" cellspacing="1">
        <tr>
          <td valign="top"> 
           <br><br><br>
			<?

include ("gprocessing.html"); 


$s_statement_no = $_GET["statement_no"];
$s_status = $_GET["status"];

$new_stno = $s_statement_no+1;



$query_st ="select sno,statementno,closingdate,openingamount,status  from pettystatement where statementno=$s_statement_no ";

$result_st = pg_query($conn, $query_st);

if (!$result_st) {
	echo "An error occured.\n";
	exit;
	}
while ($rows_st = pg_fetch_array($result_st)){
$sno_s=$rows_st["sno_s"];
$statementno_s = $rows_st["statementno"];
$openingamount_s = $rows_st["openingamount"];
$closingdate_s = $rows_st["closingdate"];
$status_s = $rows_st["status"];
}

pg_free_result($result_st);	

$new_sno = $sno_s+1;


$f_amount = 0;

  $a_typeofv = array();
  $a_vounum = array();
  $a_paidto = array();
  $a_recfrom = array();
  $a_dbamt = array();
  $a_cramt = array();
  $a_voudate = array();
  $a_statementno = array();

$query_voc ="select typeofv,vounum,paidto,dbamt,cramt,voudate,recfrom,statementno from pettyvou where statementno='$statementno_s' order by vounum,cramt";

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
  $a_recfrom[] = $rows_voc["recfrom"];
  $a_dbamt[] = $rows_voc["dbamt"];
  $a_cramt[] = $rows_voc["cramt"];
  $a_voudate[] = $rows_voc["voudate"];
  $a_statementno[] = $rows_voc["statementno"];


}

$totcr = $openingamount_s;

for($i=0;$i<count($a_vounum);$i++){
$ii=$i+1;
$vd="";
$vd=date('d/M', strtotime($a_voudate[$i]));


$totdb = $totdb + $a_dbamt[$i];
$totcr = $totcr + $a_cramt[$i];
}

$f_amount=$totcr-$totdb;


if($status_s==0){ echo "<script>alert(\"The statement is alread closed\")</script>" ;}
else{
$q_update = "update pettystatement set closingamount=$f_amount, status=0 where statementno=$s_statement_no and status=$s_status ";

pg_query($conn, $q_update);

$q_ins = "insert into pettystatement(sno,statementno, closingdate, openingamount, status) values($new_sno, $new_stno,'now',$f_amount,1)";

pg_query($conn, $q_ins);
}

echo "<script>document.location.href=\"pettycashtallysheet.php\"</script>"; 





?>



			 
	
			 
    
			 </td>
        </tr>
      </table></td></tr>
	  
	  
      </table> 
</table>	
	
	

	</tr></table>
</body>				
</html>


