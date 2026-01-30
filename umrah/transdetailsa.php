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
                      <td bgcolor="#CCCCCC"><strong> <font size="2" face="Verdana, Arial, Helvetica, sans-serif">Transportation Suppliers Details</font></td>
                    </tr></table>

<form name="selhotel" method="post" action="#" >

<?	


$hotel_id = trim($_POST['hotelv']); 		  

if($hotel_id==""){  $hotel_id = trim($_GET['hotid']); }

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}; 
$_SESSION['hotel_id'] = $hotel_id; 

?>



									  <?
						$q_str = "trans_id,trans_c_name,account_code,address,city,payment_type,reservation_name,reservation_tel,reservation_fax,reservation_mobile,reservation_email,bank_account_name,bank_account_number,bank_branch,bank_city,notes";
						
						$a_q_str = explode(",", $q_str);

									  $query_hotel ="select " . $q_str ." from s_trans where trans_id='$hotel_id'";

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
 echo $fie = trim($a_q_str[$i]);
echo "</font></td>";
$fval = trim($rows_hotel[$fie]);
echo "<td><input type=\"text\" id=\"$fie\" name=\"$fie\" value=\"$fval\" size=\"70\" /></td>";

echo "</tr>";
}


}

echo "</table>";
pg_free_result($result_hotel);

									

									  ?>

			  
	</form>		



     </td></tr></table> 

</td></tr></table> 

</td></tr></table> 

</td></tr></table> 




