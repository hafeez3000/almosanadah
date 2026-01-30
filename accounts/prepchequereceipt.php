<?

include ("header.php");



 $voc_t = $_GET["voctype"];
 $voc_no = $_GET["vocnum"];


$array_acc_name = array();
$array_acccode = array();

$query_hotel ="select acccode,acc_name from accmast ORDER BY acc_name";

$result_hotel = pg_query($conn, $query_hotel);

if (!$result_hotel) {
	echo "An error occured.\n";
	exit;
	}
while ($rows_hotel = pg_fetch_array($result_hotel)){

$array_acc_name[] = $rows_hotel["acc_name"];
$array_acccode[] = $rows_hotel["acccode"];

}

pg_free_result($result_hotel);

$q_hotel_sel ="select voctype, vocno,acccode,dbamt,cramt  from vocmast where voctype='$voc_t' and vocno='$voc_no'";

$res_hotel_sel = pg_query($conn, $q_hotel_sel);

$rows_hotels = pg_num_rows($res_hotel_sel);

if (!$res_hotel_sel) {
echo "An error occured.\n";
exit;
		}
while ($rows_sel = pg_fetch_array($res_hotel_sel)){

$acccode_s_hot[] = $rows_sel["acccode"];
$acccode_s_debit[] = $rows_sel["dbamt"];
$acccode_s_credit[] = $rows_sel["cramt"];

}

$str_mored = "Debited to ";
$str_morec = "Credited to ";

for($i=0; $i<count($acccode_s_hot); $i++){
if($acccode_s_credit[$i]==0){


for($j=0; $j<count($array_acc_name); $j++){
if($array_acccode[$j]==$acccode_s_hot[$i]){
$ac_name=$array_acc_name[$j];
} 
}


$str_mored = $str_mored . $ac_name . "-";
}

if($acccode_s_debit[$i]==0){


for($j=0; $j<count($array_acc_name); $j++){
if($array_acccode[$j]==$acccode_s_hot[$i]){
$ac_name=$array_acc_name[$j];
} 
}


$str_morec = $str_morec . $ac_name . "-";
}


}






$q_hotel_pe ="select typeofv,vounum,recfrom,cramt,description,voudate,inw,chequeno,chequedate,chequeissue,bankname,bank_acccode  from chequevou where typeofv='$voc_t' and vounum='$voc_no'";

$res_hotel_pe = pg_query($conn, $q_hotel_pe);

if (!$res_hotel_pe) {
echo "An error occured.\n";
exit;
		}

while ($rows_pe = pg_fetch_array($res_hotel_pe)){

$s_typeofv = $rows_pe["typeofv"];    
$s_vounum = $rows_pe["vounum"];     
$s_paidto = $rows_pe["recfrom"];     
$s_dbamt = $rows_pe["cramt"];      
$s_description = $rows_pe["description"];
$s_voudate = $rows_pe["voudate"];    
$s_chequeno = $rows_pe["chequeno"];
$s_inw = $rows_pe["inw"];        
$s_chequedate = $rows_pe["chequedate"];        
$s_chequeissue = $rows_pe["chequeissue"];        
$s_bankname = $rows_pe["bankname"];        
$s_bank_acccode = $rows_pe["bank_acccode"];        

}




?>
<script src="../javascripts/cBoxes.js"></script>
<script>
 var winl = (screen.width - 760) / 2; 
 var wint = (screen.height - 550) / 2;
</script>
<script>
document.title= '<? echo $company_name . " ERP - Acounts - Cheque Receipt Voucher"; ?>';
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
        
		   


		 <form name="selhotel" method="post" action="cashpaymenta.php" onSubmit="return fun2(this)">
	
	<table style="border: 1px solid red" width="100%" >
	 <tr>

                                  <td bgcolor="#FFDFDF">&nbsp;<strong>Cheque Receipt Voucher</strong>                                 
								  <a href="printchequervou.php?voctype=<? echo $voc_t; ?>&vocnum=<?echo $voc_no ?>" target="pcashpayment" onClick="window.open('', 'pcashpayment','width=750,height=450,menubar=yes,scrollbars=yes, top='+wint+',left='+winl+' ').focus()"><img src="../images/print_icon.gif"  align="middle"></a>
								  
								  <!--
								  &nbsp;&nbsp;<a href="printchequevou.php?voctype=<? echo $voc_t; ?>&vocnum=<?echo $voc_no ?>" target="pcashpayment" onClick="window.open('', 'pcashpayment','width=750,height=450,menubar=yes,scrollbars=yes, top='+wint+',left='+winl+' ').focus()"><img src="../images/ncb.jpg" align="middle"></a>&nbsp;&nbsp;<a href="printchequevou.php?voctype=<? echo $voc_t; ?>&vocnum=<?echo $voc_no ?>" target="pcashpayment" onClick="window.open('', 'pcashpayment','width=750,height=450,menubar=yes,scrollbars=yes, top='+wint+',left='+winl+' ').focus()"><img src="../images/sabb.jpg" align="middle"></a>
                                   -->  

								  </td>
                                </tr>
       <tr><td align="center"><img src="../images/letterheadb.jpg"></td></tr>

	 <tr>
      <td align="center"><font size="3" face="Arial,Verdana,Helvetica, sans-serif"><strong>Cheque Receipt Voucher</strong></font>                                 <br><br></td>
     </tr>
	

	
	<tr>
	  <td><table align="center" width="100%">
<tr>
	  <td><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Voucher Number: <? echo $s_typeofv ." ". $s_vounum; ?> </font>
	   </td> 
	    <td align="right">
	<font size="2" face="Verdana, Arial, Helvetica, sans-serif">Cheque Date: <? echo $vd = date('d-M-Y', strtotime($s_chequedate)); ?></font> </td>
    
	  </tr>
   <tr> 
      <td align="left"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Voucher Date: <? echo $vd = date('D, d-M-Y', strtotime($s_voudate)); ?></font></td>
   <td align="right">
	<font size="2" face="Verdana, Arial, Helvetica, sans-serif">Cheque No: <? echo $s_chequeno ;?></font> </td>
	</tr>

<tr><td>&nbsp;</td><td align="right" ><b>Cheque Amount SAR : <? echo $s_dbamt ;?>/-</b></td></tr>
	
  </table> 
</td>
	  </tr>
	
	<tr><td  style="border-bottom: 1px dashed red;" ><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Received from: <? echo $s_paidto ;?></font></td></tr>	


	<tr><td  style="border-bottom: 1px dashed red;" ><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><br>Amount in Words: <? echo $s_inw ;?></font></td></tr>		  

	<tr><td  style="border-bottom: 1px dashed red;" ><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><br>Paid For: <? echo $s_description ;?></font></td></tr>		  


	<tr><td  style="border-bottom: 1px dashed red;" ><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><br>More Details:  <? echo $str_mored . $str_morec . " and Cheque Received on : " . date('D, d-M-Y', strtotime($s_chequeissue)) ;?></font></td></tr>		  

<tr><td style="border-bottom: 1px dashed red;">
<br><br>
<table align="center" width="100%">
<tr> 
  
	  <td align="center"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Gen.Manager</font></td>
<td align="center"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Accountant</font></td>
<td align="center"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Acc.Controller</font></td>
<td align="center"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Received By</font></td>

</tr>
	
  </table><br></td></tr>

<tr><td align="center"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"> Ibrahim Al Juffali St, Al Andalus, Jeddah, Saudi Arabia, <br>+966 12 605 0607</font></td></tr>
<tr><td align="center"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"> Web:satgurutravel.com.sa Email: res@sohulatalsafar.com</font></td></tr>
</td>
	  </tr></table>


	
			 
    
			 </td>
        </tr>
      </table></td></tr>
	  
	  
      </table> 
</table>	
	
	

	</tr></table>
</body>				
</html>












