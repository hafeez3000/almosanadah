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

$s_voudate = $s_dYear ."-". $s_dMonth ."-".$s_dDay;

$s_refno = $_POST["refno"]; 

$s_paidto = $_POST["paidto"];

$s_beingp = $_POST["beingp"];

$s_amount  = $_POST["camt"];

$s_inw  = $_POST["inw"];

$s_accode = $_POST["accode"];



$q_hotel_sel ="select voctype, vocno  from vocmast where voctype='$s_voutype' and vocno='$s_vouno' ";

$res_hotel_sel = pg_query($conn, $q_hotel_sel);

$rows_hotels = pg_num_rows($res_hotel_sel);

if (!$res_hotel_sel) {
echo "An error occured.\n";
exit;
		}

$q_hotel_pe ="select typeofv, vounum  from pettyvou where typeofv='$s_voutype' and vounum='$s_vouno'";

$res_hotel_pe = pg_query($conn, $q_hotel_pe);

 $rows_pe = pg_num_rows($res_hotel_pe);

if (!$res_hotel_pe) {
echo "An error occured.\n";
exit;
		}


if($rows_pe==1){ 



$petq ="update pettyvou set dbamt=$s_amount, cramt=0, paidto='$s_paidto', description='$s_beingp', voudate='$s_voudate', statementno=$s_refno, inw='$s_inw' where typeofv='$s_voutype' and vounum='$s_vouno'";

pg_query($conn, $petq);




	
	

}



if($rows_hotels==2){ 

$insq = "update vocmast set vocdate='$s_voudate',acccode='$s_accode',narration='$s_paidto',moredet='$s_beingp',dbamt=$s_amount,cramt=0,recon='f' where voctype='$s_voutype' and vocno='$s_vouno' and acccode!='102001'";

pg_query($conn, $insq);

$insq2 = "update vocmast set vocdate='$s_voudate',narration='$s_paidto',moredet='$s_beingp',cramt=$s_amount,dbamt=0,recon='f' where voctype='$s_voutype' and vocno='$s_vouno' and acccode='102001'";

pg_query($conn, $insq2);

}
else{

$delq = "delete from  vocmast where voctype='$s_voutype' and vocno='$s_vouno'";

pg_query($conn, $delq);



$insq = "insert into vocmast(voctype,vocno,vocsno,vocdate,acccode,narration,moredet,dbamt,cramt,recon) values('$s_voutype','$s_vouno',1,'$s_voudate','$s_accode','$s_paidto','$s_beingp',$s_amount,0,'f')";

pg_query($conn, $insq);

$insq2 = "insert into vocmast(voctype,vocno,vocsno,vocdate,acccode,narration,moredet,dbamt,cramt,recon) values('$s_voutype','$s_vouno',2,'$s_voudate','102001','$s_paidto','$s_beingp',0,$s_amount,'f')";

pg_query($conn, $insq2);


echo "<script>document.location.href=\"prepcashpayment.php?voctype=$s_voutype&vocnum=$s_vouno\"</script>"; 

}



if($rows_hotels==2 && $rows_pe==1 ){
echo "<script>document.location.href=\"prepcashpayment.php?voctype=$s_voutype&vocnum=$s_vouno\"</script>"; 
}
else{

echo "<script>alert(\"Transaction $s_voutype - $s_vouno  Does Not Exists! or Posting in more than two account\")</script>" ;

echo "<script>document.location.href=\"cashpayment.php\"</script>"; 

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


