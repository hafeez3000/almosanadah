<?
include ("header.php");
?>

<script>
document.title= '<? echo $company_name . " ERP - Accounts - Encash Processing.."; ?>';
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

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$fromd=$_SESSION['fromd'];
$tod=$_SESSION['tod'];

 $voc_type = $_SESSION['v_type'];
 $voc_no=$_SESSION['v_no'];


$cb_ec = $_POST['encahsed_cb'];

$s_dDay = $_POST["dDay"];  
$s_dMonth = $_POST["dMonth"];
$s_dYear = $_POST["dYear"]; 

$s_encashdate = $s_dYear ."-". $s_dMonth ."-".$s_dDay; // Encashed date


$s_errorm = $_POST["errorm"]; 



$q_hotel_sel ="select voctype, vocno  from vocmast where voctype='$voc_type' and vocno='$voc_no' ";

$res_hotel_sel = pg_query($conn, $q_hotel_sel);

$rows_hotels = pg_num_rows($res_hotel_sel);

if (!$res_hotel_sel) {
echo "An error occured.\n";
exit;
		}

echo "<br>";
$q_chqtelly ="select typeofv, vounum  from chequevou where typeofv='$voc_type' and vounum='$voc_no' ";

$res_chqtelly = pg_query($conn, $q_chqtelly);

$rows_chqtelly = pg_num_rows($res_chqtelly);

if (!$res_chqtelly) {
echo "An error occured.\n";
exit;
		}

if($rows_chqtelly==1 && $cb_ec!="on"){

$a_enc = "update chequevou set encashedbull='FALSE',encashcdate='$s_encashdate', errornotes='$s_errorm' where typeofv='$voc_type' and vounum='$voc_no' ";

pg_query($conn, $a_enc);


$q_vocm = "delete from vocmast where voctype='$voc_type' and vocno='$voc_no' ";

pg_query($conn, $q_vocm);

}


if($rows_chqtelly==1 && $cb_ec=="on"){

$a_enc = "update chequevou set encashedbull='TRUE',voudate='$s_encashdate',encashcdate='$s_encashdate',errornotes='$s_errorm' where typeofv='$voc_type' and vounum='$voc_no' ";

pg_query($conn, $a_enc);



$q_hotel_pe ="select typeofv,vounum,paidto,dbamt,description,voudate,inw,chequeno,chequedate,chequeissue,bankname,bank_acccode,cramt,recfrom,chequeno,encashcdate,chequereceiveddate,encashedbull,errornotes,debit_acccode  from chequevou where typeofv='$voc_type' and vounum='$voc_no'";




$res_hotel_pe = pg_query($conn, $q_hotel_pe);

if (!$res_hotel_pe) {
echo "An error occured.\n";
exit;
		}

while ($rows_pe = pg_fetch_array($res_hotel_pe)){

$s_typeofv = $rows_pe["typeofv"];    
$s_vounum = $rows_pe["vounum"];     
$s_paidto = $rows_pe["paidto"];     
$s_dbamt = $rows_pe["dbamt"];      
$s_description = $rows_pe["description"];
$s_voudate = $rows_pe["voudate"];    
$s_chequeno = $rows_pe["chequeno"];
$s_inw = $rows_pe["inw"];        
$s_chequedate = $rows_pe["chequedate"];        
$s_chequeissue = $rows_pe["chequeissue"];        
$s_bankname = $rows_pe["bankname"];        
$s_bank_acccode = $rows_pe["bank_acccode"];        

$s_cramt = $rows_pe["cramt"]; 
$s_recfrom = $rows_pe["recfrom"];
$s_chequeno = $rows_pe["chequeno"];
$s_encashcdate = $rows_pe["encashcdate"];
$s_chequereceiveddate = $rows_pe["chequereceiveddate"];
$s_encashedbull = $rows_pe["encashedbull"];
$s_errornotes = $rows_pe["errornotes"];
$s_debit_acccode = $rows_pe["debit_acccode"];


}


if($voc_type=="BV"){  // payment

$insq = "insert into vocmast(voctype,vocno,vocsno,vocdate,acccode,narration,moredet,dbamt,cramt,recon,supp_inv) values('$s_typeofv','$s_vounum',1,'$s_encashdate','$s_debit_acccode','$s_paidto','$s_description',$s_dbamt,0,'f',$s_chequeno)";

pg_query($conn, $insq);


$insq2 = "insert into vocmast(voctype,vocno,vocsno,vocdate,acccode,narration,moredet,dbamt,cramt,recon,supp_inv) values('$s_typeofv','$s_vounum',2,'$s_encashdate','$s_bank_acccode','$s_paidto','$s_description',0,$s_dbamt,'f',$s_chequeno)";

pg_query($conn, $insq2);

} 

else if($voc_type=="RC"){    // Receiving    

$insq = "insert into vocmast(voctype,vocno,vocsno,vocdate,acccode,narration,moredet,dbamt,cramt,recon,supp_inv) values('$s_typeofv','$s_vounum',1,'$s_encashdate','$s_bank_acccode','$s_recfrom','$s_description',$s_cramt,0,'f',$s_chequeno)";

pg_query($conn, $insq);


$insq2 = "insert into vocmast(voctype,vocno,vocsno,vocdate,acccode,narration,moredet,dbamt,cramt,recon,supp_inv) values('$s_typeofv','$s_vounum',2,'$s_encashdate','$s_debit_acccode','$s_recfrom','$s_description',0,$s_cramt,'f',$s_chequeno)";

pg_query($conn, $insq2);



}



}




echo "<script>document.location.href=\"chequetally.php?from_d=$fromd&to_d=$tod\"</script>"; 







?>



			 
	
			 
    
			 </td>
        </tr>
      </table></td></tr>
	  
	  
      </table> 
</table>	
	
	

	</tr></table>
</body>				
</html>


