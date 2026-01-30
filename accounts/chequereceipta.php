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

$s_voudate2 = $s_dYear2 ."-". $s_dMonth2 ."-".$s_dDay2; // receving date

$s_refno = $_POST["refno"]; // cheque number

$s_bankname = $_POST["bankname"]; // bankname

$s_bank_acccode = $_POST["acname_b"]; // acccode debiting


$s_paidto = $_POST["paidto"];

$s_beingp = $_POST["beingp"];

$s_amount  = $_POST["camt"];

$s_inw  = $_POST["inw"];

$s_accode = $_POST["accode"]; //  acccode crediting



$q_hotel_sel ="select voctype, vocno  from vocmast where voctype='$s_voutype' and vocno='$s_vouno' ";

$res_hotel_sel = pg_query($conn, $q_hotel_sel);

$rows_hotels = pg_num_rows($res_hotel_sel);

if (!$res_hotel_sel) {
echo "An error occured.\n";
exit;
		}

$q_hotel_pe ="select typeofv, vounum  from chequevou where typeofv='$s_voutype' and vounum='$s_vouno'";

$res_hotel_pe = pg_query($conn, $q_hotel_pe);

 $rows_pe = pg_num_rows($res_hotel_pe);

if (!$res_hotel_pe) {
echo "An error occured.\n";
exit;
		}


if($rows_hotels>0 && $rows_pe>0 ){ echo "<script>alert(\"Transaction $s_voutype - $s_vouno  Already Exists!\")</script>" ;

echo "<script>document.location.href=\"chequereceipt.php\"</script>"; 

//echo "<script>document.location.href=\"prepchequepayment.php?voctype=$s_voutype&vocnum=$s_vouno\"</script>"; 

}
else{

$petq ="insert into chequevou(typeofv, vounum, dbamt,cramt, recfrom, description, voudate, chequeno, inw,chequereceiveddate,chequedate,bankname,bank_acccode,debit_acccode,encashedbull) VALUES ('$s_voutype','$s_vouno',0,$s_amount,'$s_paidto','$s_beingp','$s_voudate',$s_refno,'$s_inw','$s_voudate2','$s_voudate1','$s_bankname','$s_bank_acccode','$s_accode','TRUE')";

pg_query($conn, $petq);

pg_query($conn, "update voctypes set seq=$s_vouno where voctype='$s_voutype'");



$insq2 = "insert into vocmast(voctype,vocno,vocsno,vocdate,acccode,narration,moredet,dbamt,cramt,recon) values('$s_voutype','$s_vouno',1,'$s_voudate','$s_bank_acccode','$s_paidto','$s_beingp',$s_amount,0,'f')";

pg_query($conn, $insq2);

$insq = "insert into vocmast(voctype,vocno,vocsno,vocdate,acccode,narration,moredet,dbamt,cramt,recon) values('$s_voutype','$s_vouno',2,'$s_voudate','$s_accode','$s_paidto','$s_beingp',0,$s_amount,'f')";

pg_query($conn, $insq);




echo "<script>document.location.href=\"prepchequereceipt.php?voctype=$s_voutype&vocnum=$s_vouno\"</script>"; 

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


