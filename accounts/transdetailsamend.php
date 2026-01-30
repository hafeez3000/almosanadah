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
                      <td bgcolor="#CCCCCC"><strong> <font size="2" face="Verdana, Arial, Helvetica, sans-serif">Transportation Supplier Details</font></td>
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

if (session_status() === PHP_SESSION_NONE) {
    session_start();
} 
$hotel_ids = $_SESSION['hotel_id'] ; 

		
$query_hotel ="update s_trans set  trans_id=$trans_id,trans_c_name='$trans_c_name',account_code='$account_code',address='$address',city='$city',payment_type='$payment_type',reservation_name='$reservation_name',reservation_tel='$reservation_tel',reservation_fax='$reservation_fax',reservation_mobile='$reservation_mobile',reservation_email='$reservation_email ',bank_account_name='$bank_account_name',bank_account_number='$bank_account_number',bank_branch='$bank_branch',bank_city='$bank_city',notes='$notes'  where trans_id='$hotel_ids'";

pg_query($conn, $query_hotel);
									

									  ?>

									  
	



     </td></tr></table> 

</td></tr></table> 

</td></tr></table> 

</td></tr></table> 



<?  echo "<script>document.location.href=\"transdetailsa.php?hotid=$trans_id\"</script>";  ?>