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
                      <td bgcolor="#CCCCCC"><strong> <font size="2" face="Verdana, Arial, Helvetica, sans-serif">Supplier Details</font></td>
                    </tr></table>

<form name="selhotel" method="post" action="supplierdetailsamend.php" >

<?	


$hotel_id = trim($_POST['hotelv']); 		  

if($hotel_id==""){  $hotel_id = trim($_GET['hotid']); }

session_start(); 
$_SESSION['hotel_id'] = $hotel_id; 

?>






									  <?
					$qb_str = "Supplier Id,Supplier Name,Supplier Description,Account Code,City,Payment Type,Title,Contact Person,Telephone,Fax,Email,Mobile,Bank Account Name,Account Number,Bank Name,Bank Branch,Bank City,Notes";

						$q_str = "supp_id,supp_name,supp_desc,account_code,city,payment_type,contact_p_title,contact_p_name,tel,fax,email,mobile,bank_account_name,bank_account_number,bank_name,bank_branch,bank_city,notes";
						
						$a_q_str = explode(",", $q_str);

						$a_qb_str = explode(",", $qb_str);


									  $query_hotel ="select " . $q_str ." from suppliers where supp_id='$hotel_id'";

$result_hotel = pg_query($query_hotel);

if (!$result_hotel) {
echo "An error occured.\n";
exit;
		}

echo "<table border=\"1\">";
while ($rows_hotel = pg_fetch_array($result_hotel)){

// echo $hotel_name_dis = $rows_hotel["hotel_name"];

for($i=0; $i<count($a_q_str)-1; $i++){

echo "<tr><td><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";
echo trim($a_qb_str[$i]);
$fie = trim($a_q_str[$i]);
echo "</font></td>";
$fval = trim($rows_hotel[$fie]);
echo "<td><input type=\"text\" id=\"$fie\" name=\"$fie\" value=\"$fval\" size=\"70\" /></td>";

echo "</tr>";
}

$s_sc = trim($rows_hotel['scountry']);

?>

<?

}

echo "</table>";
pg_free_result($result_hotel);

									

									  ?>

 <input type="submit" name="submit" id="submit" value="Amend Supplier Details">									  
	</form>		



     </td></tr></table> 

</td></tr></table> 

</td></tr></table> 

</td></tr></table> 




