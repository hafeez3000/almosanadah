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


$q_hotel_pe ="select typeofv,vounum,paidto,dbamt,description,voudate,inw,chequeno,chequedate,chequeissue,bankname,bank_acccode  from chequevou where typeofv='$voc_t' and vounum='$voc_no'";

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


}

?>
<script>
document.title= '<? echo $company_name . " ERP - Acounts - Print Cheque Payment Voucher"; ?>';
</script>



<style type="text/css">


body {background-image: url("../images/ncb100.jpg") ;   background-repeat: no-repeat; }

</style>


<STYLE type="text/css" media="print">


 BODY {background: white }




</STYLE>







<html>
<link rel="stylesheet" type="text/css" href="../calendar/css.css" />

<body leftmargin="0" topmargin="0" rightmargin="0" >


<table height="276" width="689" border="0" cellpadding="0" cellspacing="0" >
        <tr>
          <td valign="top"> 
        
		   


	
	<table width="689" cellpadding="0" cellspacing="0" >

	

	<tr>
	  <td><table align="center"  width="675" cellpadding="0" >
	   <tr> 
      
   <td align="right" height="18" valign="top">
	<font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b><? echo $vd = date('d-M-Y', strtotime($s_chequedate)); ?></b>
	
	<? for($i=0; $i<25; $i++){
	echo "&nbsp;"; 
	}
	?></font> </td>
	</tr>
   <tr> 
    
   <td align="right" height="22" valign="top">
	<font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Jeddah</b>
	
	<? for($i=0; $i<30; $i++){
	echo "&nbsp;"; 
	}
	?></font> </td>
	</tr>

	
  </table> 
<br><br>
</td>
	  </tr>
	
 <tr>
	  <td><table align="center" width="689" >

	<tr  ><td align="left" >

	<? for($i=0; $i<25; $i++){
	echo "&nbsp;"; 
	}
	?>
			<font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b><? echo $s_paidto ;?><b></font></td>
			
			<td align="right" >&nbsp;
			
			</td></tr>	

	<tr><td><br>
	
		<? for($i=0; $i<20; $i++){
	echo "&nbsp;"; 
	}
	?>

	
	<font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b><? echo $s_inw ;?><b></font></td>
	
	<td align="right"><br><b><? echo "SAR#".number_format($s_dbamt, 2, "." , ",") ;?>/-</b> 
			
	<? for($i=0; $i<20; $i++){
	echo "&nbsp;"; 
	}
	?>

			</td>
	</tr>		  
 </table>
  </td></tr>	



	<tr><td>

    <table width="689"  cellpadding="5" cellspacing="3">
	<tr><td>
			<? for($i=0; $i<5; $i++){
	echo "&nbsp;"; 
	}
	?>

	<font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b><? echo $s_description ;?></b></font>
	</td></tr>		  	
	</table>
	
	</td></tr>		  



	
			 
    
			 </td>
        </tr>
      </table></td></tr>
	  
	  
      </table> 



</body>	

</html>




