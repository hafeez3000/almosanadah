<?
include ("header.php");
?>


<table width="100%" border="0" cellpadding="0" cellspacing="0" style="border-bottom: 3px solid #006600; border-right: 3px solid #006600;border-left: 3px solid #006600 ">
  <tr>
    <td width="20%" style="border-right: 1px solid #999999"  valign="top"> <table width="100%" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td valign="top"><div align="left"> 
              <?include ("umenu.php"); ?>
            </div></td>
        </tr>
      </table></td>
    <td width="80%" valign="top"  > <table width="100%" border="0" cellpadding="0" cellspacing="1">
        <tr>
          <td valign="top"> 

<table cellpadding="0" cellspacing="0" width="100%" style="border-top: 1px solid #999999; border-bottom: 1px solid #999999"><tr>
                      <td bgcolor="#CCCCCC"><strong> <font size="2" face="Verdana, Arial, Helvetica, sans-serif">Transportation Suppleir Details</font></td>
                    </tr></table>
<?
include ("gprocessing.html");  ?>


									  <?
      
$trans_id           	=$_POST['trans_id'];           
$trans_c_name       	=$_POST['trans_c_name'];       
$account_code       	=$_POST['account_code'];       
$address            	=$_POST['address'];            
$city               	=$_POST['city'];               
$payment_type       	=$_POST['payment_type'];       
$reservation_name   	=$_POST['reservation_name'];   
$reservation_tel    	=$_POST['reservation_tel'];    
$reservation_fax    	=$_POST['reservation_fax'];    
$reservation_mobile 	=$_POST['reservation_mobile']; 
$reservation_email  	=$_POST['reservation_email'];  
$bank_account_name  	=$_POST['bank_account_name'];  
$bank_account_number	=$_POST['bank_account_number'];
$bank_branch        	=$_POST['bank_branch'];        
$bank_city          	=$_POST['bank_city'];          
$notes              	=$_POST['notes'];   


$query_gsno ="select trans_id from s_trans where trans_id='$trans_id'";

$result_gsno = pg_query($conn, $query_gsno);

$hid_c = pg_num_rows($result_gsno);

pg_free_result($result_gsno);

if($hid_c>0){ }
else{


$query_gsno ="select s_trans_supp from seq";

$result_gsno = pg_query($conn, $query_gsno);

if (!$result_gsno) {
echo "An error occured.\n";
exit;
		}
while ($rows_gsno = pg_fetch_array($result_gsno)){
$gsno_seq = $rows_gsno["s_trans_supp"];
}

pg_free_result($result_gsno);

	
	
						
$query_hotel ="insert into s_trans (trans_id,trans_c_name,account_code,address,city,payment_type,reservation_name,reservation_tel,reservation_fax,reservation_mobile,reservation_email,bank_account_name,bank_account_number,bank_branch,bank_city,notes) values ($trans_id,'$trans_c_name','$account_code','$address','$city','$payment_type','$reservation_name','$reservation_tel','$reservation_fax','$reservation_mobile','$reservation_email','$bank_account_name','$bank_account_number','$bank_branch','$bank_city','$notes')";
pg_query($conn, $query_hotel);
									

$sequpdateg_rate_sno = "update seq set s_trans_supp=s_trans_supp+1";
pg_query($conn, $sequpdateg_rate_sno);

}
									  ?>

									  
	



     </td></tr></table> 

</td></tr></table> 

</td></tr></table> 

</td></tr></table> 



<?  echo "<script>document.location.href=\"transdetailsa.php?hotid=$trans_id\"</script>";  ?>