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
                      <td bgcolor="#CCCCCC"><strong> <font size="2" face="Verdana, Arial, Helvetica, sans-serif">Hotel Details</font></td>
                    </tr></table>
<?
include ("gprocessing.html");  ?>


									  <?
$hotel_id=$_POST['hotel_id'];
$hotel_name=$_POST['hotel_name'];
$hotel_type=$_POST['hotel_type'];
$hotel_desc=$_POST['hotel_desc'];
$hotel_image=$_POST['hotel_image'];
$account_code=$_POST['account_code'];
$city=$_POST['city'];
$payment_type=$_POST['payment_type'];
$reception_name=$_POST['reception_name'];
$reception_tel=$_POST['reception_tel'];
$reception_fax=$_POST['reception_fax'];
$reception_email=$_POST['reception_email'];
$reception_mobile=$_POST['reception_mobile'];
$sales_name=$_POST['sales_name'];
$sales_tel=$_POST['sales_tel'];
$sales_fax=$_POST['sales_fax'];
$sales_mobile=$_POST['sales_mobile'];
$reservation_name=$_POST['reservation_name'];
$reservation_tel=$_POST['reservation_tel'];
$reservation_fax=$_POST['reservation_fax'];
$reservation_mobile=$_POST['reservation_mobile'];
$bank_account_name=$_POST['bank_account_name'];
$bank_name=$_POST['bank_name'];
$bank_account_number=$_POST['bank_account_number'];
$bank_branch=$_POST['bank_branch'];
$bank_city=$_POST['bank_city'];
$notes=$_POST['notes'];


session_start(); 
$hotel_ids = $_SESSION['hotel_id'] ; 


	
	
						
$query_hotel ="update hotels set  hotel_id=$hotel_id,hotel_name='$hotel_name',hotel_type='$hotel_type',hotel_desc='$hotel_desc',hotel_image='$hotel_image',account_code='$account_code',city='$city',payment_type='$payment_type',reception_name='$reception_name',reception_tel='$reception_tel',reception_fax='$reception_fax',reception_email='$reception_email',reception_mobile='$reception_mobile',sales_name='$sales_name',sales_tel='$sales_tel',sales_fax='$sales_fax',sales_mobile='$sales_mobile',reservation_name='$reservation_name',reservation_tel='$reservation_tel',reservation_fax='$reservation_fax',reservation_mobile='$reservation_mobile',bank_account_name='$bank_account_name',bank_name='$bank_name',bank_account_number='$bank_account_number',bank_branch='$bank_branch',bank_city='$bank_city',notes='$notes'  where hotel_id='$hotel_ids'";

pg_query($conn, $query_hotel);
									

									  ?>

									  
	



     </td></tr></table> 

</td></tr></table> 

</td></tr></table> 

</td></tr></table> 



<? echo "<script>document.location.href=\"hoteldetailsa.php?hotid=$hotel_id\"</script>";  ?>