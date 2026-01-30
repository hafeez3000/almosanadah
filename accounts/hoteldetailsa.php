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

<form name="selhotel" method="post" action="hoteldetailsamend.php" >

<?	
  

$hotel_id = trim((string)(isset($_POST['hotelv']) ? $_POST['hotelv'] : ''));

if($hotel_id==""){  $hotel_id = trim((string)$_GET['hotid']); }

if (session_status() === PHP_SESSION_NONE) {
    session_start();
} 
$_SESSION['hotel_id'] = $hotel_id; 

?>



									  <?
						$q_str = "hotel_id, hotel_name,hotel_type,hotel_desc,hotel_image,account_code,city,payment_type,reception_name,reception_tel,reception_fax,reception_email,reception_mobile,sales_name,sales_tel,sales_fax,sales_mobile,reservation_name,reservation_tel,reservation_fax,reservation_mobile,bank_account_name,bank_name,bank_account_number,bank_branch,bank_city,notes";
						
						$a_q_str = explode(",", $q_str);

									  $query_hotel ="select " . $q_str ." from hotels where hotel_id='$hotel_id'";

$result_hotel = pg_query($conn, $query_hotel);

if (!$result_hotel) {
echo "An error occured.\n";
exit;
		}

echo "<table border=\"1\">";
while ($rows_hotel = pg_fetch_array($result_hotel)){

// echo $hotel_name_dis = $rows_hotel["hotel_name"];

for($i=0; $i<count($a_q_str); $i++){

echo "<tr><td><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";
 echo $fie = trim((string)$a_q_str[$i]);
echo "</font></td>";
$tv = trim((string)$rows_hotel[$fie]);
echo "<td><input type=\"text\" id=\"$fie\" name=\"$fie\" value=\"$tv\" size=\"75\" /></td>";

echo "</tr>";
}


}

echo "</table>";
pg_free_result($result_hotel);

									

									  ?>

 <input type="submit" name="submit" id="submit" value="Amend Hotel Details">									  
	</form>		



     </td></tr></table> 

</td></tr></table> 

</td></tr></table> 

</td></tr></table> 




