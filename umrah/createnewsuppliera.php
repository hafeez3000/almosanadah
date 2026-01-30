<?
include ("header.php");
?>


<table width="100%" border="0" cellpadding="0" cellspacing="0" style="border-bottom: 3px solid #006600; border-right: 3px solid #006600;border-left: 3px solid #006600 ">
  <tr>
    <td width="20%" style="border-right: 1px solid #999999"  valign="top"> <table width="100%" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td valign="top"><div align="left"> 
              <?php include  ("umenupreline.php"); ?>
            </div></td>
        </tr>
      </table></td>
    <td width="80%" valign="top"  > <table width="100%" border="0" cellpadding="0" cellspacing="1">
        <tr>
          <td valign="top"> 

<table cellpadding="0" cellspacing="0" width="100%" style="border-top: 1px solid #999999; border-bottom: 1px solid #999999"><tr>
                      <td bgcolor="#CCCCCC"><strong> <font size="2" face="Verdana, Arial, Helvetica, sans-serif">Supplier Details</font></td>
                    </tr></table>
<?
include ("gprocessing.html");  ?>


									  <?
      
$supp_sno	    =$_POST['supp_sno'];           
$supp_id	    =$_POST['supp_id'];            
$supp_name	    =$_POST['supp_name'];          
$supp_desc	    =$_POST['supp_desc'];          
$account_code	    =$_POST['account_code'];       
$city		    =$_POST['city'];               
$payment_type	    =$_POST['payment_type'];       
$contact_p_title    =$_POST['contact_p_title'];    
$contact_p_name	    =$_POST['contact_p_name'];     
$tel		    =$_POST['tel'];                
$fax		    =$_POST['fax'];                
$email		    =$_POST['email'];              
$mobile		    =$_POST['mobile'];             
$bank_account_name  =$_POST['bank_account_name'];  
$bank_account_number=$_POST['bank_account_number'];
$bank_name	    =$_POST['bank_name'];          
$bank_branch	    =$_POST['bank_branch'];        
$bank_city	    =$_POST['bank_city'];          
$notes		    =$_POST['notes'];


$query_gsno ="select supp_id from suppliers where supp_id='$supp_id'";

$result_gsno = pg_query($conn, $query_gsno);

$hid_c = pg_num_rows($result_gsno);

pg_free_result($result_gsno);

if($hid_c>0){ }
else{

						
$query_hotel ="insert into suppliers(supp_sno,supp_id,supp_name,supp_desc,account_code,city,payment_type,contact_p_title,contact_p_name,tel,fax,email,mobile,bank_account_name,bank_account_number,bank_name,bank_branch,bank_city,notes) values ($supp_id-100,'$supp_id','$supp_name','$supp_desc','$account_code','$city','$payment_type','$contact_p_title','$contact_p_name','$tel','$fax','$email','$mobile','$bank_account_name','$bank_account_number','$bank_name','$bank_branch','$bank_city','$notes')";
pg_query($conn, $query_hotel);
									
}
									  ?>

									  
	



     </td></tr></table> 

</td></tr></table> 

</td></tr></table> 

</td></tr></table> 



<? echo "<script>document.location.href=\"supplierdetailsa.php?hotid=$supp_id\"</script>";  ?>