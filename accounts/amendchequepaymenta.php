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


$s_voutype = $_POST["voutype"];
$s_vouno = $_POST["vouno"]; 

$s_dDay = $_POST["dDay"];  
$s_dMonth = $_POST["dMonth"];
$s_dYear = $_POST["dYear"]; 

$s_voudate = $s_dYear ."-". $s_dMonth ."-".$s_dDay; // voucher date


$s_dDay1 = $_POST["dDay1"];  
$s_dMonth1 = $_POST["dMonth1"];
$s_dYear1 = $_POST["dYear1"]; 

$s_voudate1 = $s_dYear1 ."-". $s_dMonth1 ."-".$s_dDay1;  // cheque date


$s_dDay2 = $_POST["dDay2"];  
$s_dMonth2 = $_POST["dMonth2"];
$s_dYear2 = $_POST["dYear2"]; 

$s_voudate2 = $s_dYear2 ."-". $s_dMonth2 ."-".$s_dDay2; // issue date

$s_refno = $_POST["refno"]; // cheque number

$s_bankname = $_POST["bankname"]; // bankname

$s_bank_acccode = $_POST["acname_b"]; // bankname_acccode


$s_paidto = $_POST["paidto"];

$s_beingp = $_POST["beingp"];

$s_amount  = $_POST["camt"];

$s_inw  = $_POST["inw"];

$s_accode = $_POST["accode"];

$bank_c = $_SESSION['bank_acccode'];
$a_acccode=$_SESSION['a_acccode'];


$received_f = "Bank Name:".$s_bankname." Cheque No: ". $s_refno ." ". $s_voutype ." ".$s_vouno; 

$q_hotel_sel ="select voctype, vocno  from vocmast where voctype='$s_voutype' and vocno='$s_vouno' ";

$res_hotel_sel = pg_query($conn, $q_hotel_sel);

$rows_hotels = pg_num_rows($res_hotel_sel);

if (!$res_hotel_sel) {
echo "An error occured.\n";
exit;
		}

$q_hotel_pe ="select typeofv, vounum,pettycvt,pettycvn  from chequevou where typeofv='$s_voutype' and vounum='$s_vouno'";

$res_hotel_pe = pg_query($conn, $q_hotel_pe);

 $rows_pe = pg_num_rows($res_hotel_pe);

if (!$res_hotel_pe) {
echo "An error occured.\n";
exit;
		}

while ($rows_pe1 = pg_fetch_array($res_hotel_pe)){
$voctype_s_pe = $rows_pe1["pettycvt"];
$seq_pe = $rows_pe1["pettycvn"];    
}

if($s_accode=="102001"){  // if petty cash

echo $voctype_s_pe;
echo "<br>";
echo $seq_pe;



if($seq_pe=="0"){  // if no petty
//insert


$query_voc ="select voctype,entry_name,firste,seconde,seq from voctypes where voctype='CR'";

$result_voc = pg_query($conn, $query_voc);

if (!$result_voc) {
	echo "An error occured.\n";
	exit;
	}
while ($rows_voc = pg_fetch_array($result_voc)){

$voctype_s = $rows_voc["voctype"];
$seq = $rows_voc["seq"];    
}
$seq++;
pg_free_result($result_voc);

//statement number
$query_st ="select statementno,status  from pettystatement where status=1";

$result_st = pg_query($conn, $query_st);

if (!$result_st) {
	echo "An error occured.\n";
	exit;
	}
while ($rows_st = pg_fetch_array($result_st)){

$statementno_s = $rows_st["statementno"];
}

pg_free_result($result_st);	


$petqcr ="insert into pettyvou(typeofv, vounum, dbamt,cramt, recfrom, description, voudate, statementno, inw ) VALUES ('CR','$seq',0,$s_amount,'$received_f','$s_beingp','$s_voudate',$statementno_s,'$s_inw')";

pg_query($conn, $petqcr);

pg_query($conn, "update voctypes set seq=$seq where voctype='CR'");

pg_query($conn, "update chequevou set pettycvt='CR', pettycvn=$seq where typeofv='$s_voutype' and vounum=$s_vouno");

}
else{
// amend

$query_st ="select statementno,status  from pettystatement where status=1";

$result_st = pg_query($conn, $query_st);

if (!$result_st) {
	echo "An error occured.\n";
	exit;
	}
while ($rows_st = pg_fetch_array($result_st)){

$statementno_s = $rows_st["statementno"];
}

pg_free_result($result_st);	
//statement number

$petq_u ="update pettyvou set dbamt=0, cramt=$s_amount, recfrom='$received_f', description='$s_beingp', voudate='$s_voudate', statementno=$statementno_s, inw='$s_inw' where typeofv='$voctype_s_pe' and vounum='$seq_pe'";

pg_query($conn, $petq_u);



}  // end else no petty




}  // end if petty cash

else {  // else if petty cash


$q_hotel_pee ="select typeofv, vounum,pettycvt,pettycvn  from chequevou where typeofv='$s_voutype' and vounum='$s_vouno'";

$res_hotel_pee = pg_query($conn, $q_hotel_pee);

 $rows_pee = pg_num_rows($res_hotel_pee);

if (!$res_hotel_pee) {
echo "An error occured.\n";
exit;
		}

while ($rows_pe1e = pg_fetch_array($res_hotel_pee)){
$voctype_s_pee = $rows_pe1e["pettycvt"];
$seq_pee = $rows_pe1e["pettycvn"];    
}


if($seq_pee==0){ }
else {

$delpq = "delete from  pettyvou where typeofv='$voctype_s_pee' and vounum=$seq_pee";

pg_query($conn, $delpq);

$sn="";
pg_query($conn, "update chequevou set pettycvt='$sn', pettycvn=0 where typeofv='$s_voutype' and vounum=$s_vouno");


}


}  // else if petty cash



if($rows_pe==1){ 


$petq ="update chequevou set dbamt=$s_amount,cramt=0, paidto='$s_paidto', description='$s_beingp', voudate='$s_voudate', chequeno='$s_refno', inw='$s_inw',chequeissue='$s_voudate2',chequedate='$s_voudate1',bankname='$s_bankname',bank_acccode='$s_bank_acccode',debit_acccode='$s_accode',encashedbull='TRUE' where typeofv='$s_voutype' and vounum='$s_vouno'";  

pg_query($conn, $petq);
	

}



if($rows_hotels==2){ 

$insq = "update vocmast set vocdate='$s_voudate',acccode='$s_accode',narration='$s_paidto',moredet='$s_beingp',dbamt=$s_amount,cramt=0,recon='f' where voctype='$s_voutype' and vocno='$s_vouno' and acccode='$a_acccode'";

pg_query($conn, $insq);

$insq2 = "update vocmast set vocdate='$s_voudate',acccode='$s_bank_acccode',narration='$s_paidto',moredet='$s_beingp',cramt=$s_amount,dbamt=0,recon='f' where voctype='$s_voutype' and vocno='$s_vouno' and acccode='$bank_c'";

pg_query($conn, $insq2);

}
else{

$delq = "delete from  vocmast where voctype='$s_voutype' and vocno='$s_vouno'";

pg_query($conn, $delq);


$insq = "insert into vocmast(voctype,vocno,vocsno,vocdate,acccode,narration,moredet,dbamt,cramt,recon,supp_inv) values('$s_voutype','$s_vouno',1,'$s_voudate','$s_accode','$s_paidto','$s_beingp',$s_amount,0,'f',$s_refno)";

pg_query($conn, $insq);

$insq2 = "insert into vocmast(voctype,vocno,vocsno,vocdate,acccode,narration,moredet,dbamt,cramt,recon,supp_inv) values('$s_voutype','$s_vouno',2,'$s_voudate','$s_bank_acccode','$s_paidto','$s_beingp',0,$s_amount,'f',$s_refno)";

pg_query($conn, $insq2);


echo "<script>document.location.href=\"prepchequepayment.php?voctype=$s_voutype&vocnum=$s_vouno\"</script>"; 

}



if($rows_hotels==2 && $rows_pe==1 ){
echo "<script>document.location.href=\"prepchequepayment.php?voctype=$s_voutype&vocnum=$s_vouno\"</script>"; 
}
else{

echo "<script>alert(\"Transaction $s_voutype - $s_vouno  Does Not Exists! or Posting in more than two account\")</script>" ;

echo "<script>document.location.href=\"chequepayment.php\"</script>"; 

}


?>



			 
	
			 
    
			 </td>
        </tr>
      </table></td></tr>
	  
	  
      </table> 
</table>	
	
	

	</tr></table>
</body>				
</html>


