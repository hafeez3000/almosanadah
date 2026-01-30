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


$q_u_det ="select user_first_name, user_last_name from users where user_id='$suserid'";

$u_sel = pg_query($conn, $q_u_det);

if (!$u_sel) {
echo "An error occured.\n";
exit;
		}

while ($rows_u_sel = pg_fetch_array($u_sel)){

 $s_user_first_name = $rows_u_sel["user_first_name"];

 $s_user_last_name = $rows_u_sel["user_last_name"];
}



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







 $q_hotel_pe ="select typeofv,vounum,paidto,dbamt,description,voudate,statementno,inw  from pettyvou where typeofv='$voc_t' and vounum='$voc_no'";

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
$s_statementno = $rows_pe["statementno"];
$s_inw = $rows_pe["inw"];        


}

?>
<script>
document.title= '<? echo $company_name . " ERP - Acounts - Print Cash Payment Voucher"; ?>';
</script>

<html>
<link rel="stylesheet" type="text/css" href="../calendar/css.css" />
<center>
<body leftmargin="0" topmargin="0" rightmargin="0">


<table width="96%" border="0" cellpadding="0" cellspacing="1" >
        <tr>
          <td valign="top"> 
        
		   


		 <form name="selhotel" method="post" action="cashpaymenta.php" onSubmit="return fun2(this)">
	
	<table style="border: 1px solid black" width="100%" cellpadding="3" cellspacing="2" >

	 <tr><td align="center"><img src="../images/letterheadb.jpg"></td></tr>

	 <tr>
      <td align="center"><font size="3" face="Arial,Verdana,Helvetica, sans-serif"><strong>Cash Payment Voucher</strong></font>                                 <br></td>
     </tr>
	

	
    
	  
	<tr>
	  <td><table align="center" width="100%">
	  <tr>
	  <td><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Voucher Number: <? echo $s_typeofv ." ". $s_vounum; ?> </font>
	   </td><td align="right"><font size="1" face="Verdana, Arial, Helvetica, sans-serif"> <?echo "Print Date: " . date("r")." (GMT)"; ?>  </font>
	   </td></tr>
   <tr> 
      <td align="left"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Voucher Date: <? echo $vd = date('D, d-M-Y', strtotime($s_voudate)); ?></font></td>
   <td align="right">
	<font size="2" face="Verdana, Arial, Helvetica, sans-serif">Statement No: <? echo $s_statementno ;?></font> </td>
	</tr>

<tr><td>&nbsp;</td><td align="right" ><b>Cash Amount SAR : <? echo $s_dbamt ;?>/-</b></td></tr>
	
  </table> 
</td>
	  </tr>
	
	<tr><td  style="border-bottom: 1px dashed black;" ><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Paid to: <? echo $s_paidto ;?></font></td></tr>	

	<tr><td  style="border-bottom: 1px dashed black;" ><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><br>Amount in Words: <? echo $s_inw ;?></font></td></tr>		  

	<tr><td  style="border-bottom: 1px dashed black;" ><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><br>Being Paid: <? echo $s_description ;?></font></td></tr>		  

<tr><td  style="border-bottom: 1px dashed red;" ><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><br>More Details:  <? echo $str_mored . $str_morec ;?></font></td></tr>

<tr><td style="border-bottom: 1px dashed black;">
<br><br><br>
<table align="center" width="100%">
<tr> 
  
	  <td align="center"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Gen.Manager</font></td>
<td align="center"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><? echo $s_user_first_name ." " . $s_user_last_name ?><br>Accountant/Prepared By</font></td>
<td align="center"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Acc.Controller</font></td>
<td align="center"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Received By</font></td>

</tr>
	
  </table></td></tr>

<tr><td align="center"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"> Ibrahim Al Juffali St, Al Andalus, Jeddah, Saudi Arabia, <br>+966 12 605 0607</font></td></tr>
<tr><td align="center"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"> Web:satgurutravel.com.sa Email: res@sohulatalsafar.com</font></td></tr>
</td>
	  </tr></table>


	
			 
    
			 </td>
        </tr>
      </table></td></tr>
	  
	  
      </table> 



</body>	
</center>
</html>




