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


$query_gsno ="select hotel_id from hotels where hotel_id='$hotel_id'";

$result_gsno = pg_query($query_gsno);

$hid_c = pg_num_rows($result_gsno);

pg_free_result($result_gsno);

if($hid_c>0){ }
else{


$query_gsno ="select hotel_sno from seq";

$result_gsno = pg_query($query_gsno);

if (!$result_gsno) {
echo "An error occured.\n";
exit;
		}
while ($rows_gsno = pg_fetch_array($result_gsno)){
$gsno_seq = $rows_gsno["hotel_sno"];
}

pg_free_result($result_gsno);

	
	
						
$query_hotel ="insert into hotels (hotel_sno,hotel_id,hotel_name,hotel_type,hotel_desc,hotel_image,account_code,city,payment_type,reception_name,reception_tel,reception_fax,reception_mobile,sales_name,sales_tel,sales_fax,sales_mobile,reservation_name,reservation_tel,reservation_fax,reservation_mobile,bank_account_name,bank_name,bank_account_number,bank_branch,bank_city,notes) values ($gsno_seq,$hotel_id,'$hotel_name','$hotel_type','$hotel_desc','$hotel_image','$account_code','$city','$payment_type','$reception_name','$reception_tel','$reception_fax','$reception_mobile','$sales_name','$sales_tel','$sales_fax','$sales_mobile','$reservation_name','$reservation_tel','$reservation_fax','$reservation_mobile','$bank_account_name','$bank_name','$bank_account_number','$bank_branch','$bank_city','$notes')";
pg_query($query_hotel);
									

$sequpdateg_rate_sno = "update seq set hotel_sno=hotel_sno+1";
pg_query($sequpdateg_rate_sno);

}
									  ?>

									  
	



     </td></tr></table> 

</td></tr></table> 

</td></tr></table> 

</td></tr></table> 



<? echo "<script>document.location.href=\"hoteldetailsa.php?hotid=$hotel_id\"</script>";  ?>