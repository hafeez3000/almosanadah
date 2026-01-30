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


if($rows_hotels>0 && $rows_pe>0 ){ echo "<script>alert(\"Transaction $s_voutype - $s_vouno  Already Exists!\")</script>" ;

echo "<script>document.location.href=\"cashreceipt.php\"</script>"; 

//echo "<script>document.location.href=\"prepcashpayment.php?voctype=$s_voutype&vocnum=$s_vouno\"</script>"; 

}
else{

$petq ="insert into pettyvou(typeofv, vounum, dbamt,cramt, recfrom, description, voudate, statementno, inw,amendbull ) VALUES ('$s_voutype','$s_vouno',0,$s_amount,'$s_paidto','$s_beingp','$s_voudate',$s_refno,'$s_inw','t')";

pg_query($conn, $petq);

pg_query($conn, "update voctypes set seq=$s_vouno where voctype='$s_voutype'");


$insq2 = "insert into vocmast(voctype,vocno,vocsno,vocdate,acccode,narration,moredet,dbamt,cramt,recon) values('$s_voutype','$s_vouno',1,'$s_voudate','102001','$s_paidto','$s_beingp',$s_amount,0,'f')";

pg_query($conn, $insq2);


$insq = "insert into vocmast(voctype,vocno,vocsno,vocdate,acccode,narration,moredet,dbamt,cramt,recon) values('$s_voutype','$s_vouno',2,'$s_voudate','$s_accode','$s_paidto','$s_beingp',0,$s_amount,'f')";

pg_query($conn, $insq);



echo "<script>document.location.href=\"prepcashreceipt.php?voctype=$s_voutype&vocnum=$s_vouno\"</script>"; 

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


