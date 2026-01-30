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
                      <td bgcolor="#CCCCCC" width="100%"><strong> <font size="2" face="Verdana, Arial, Helvetica, sans-serif">New Hotel Creation</font></td>
                    </tr></table>

<form name="selhotel" method="post" action="createnewhotela.php" >

<table border="1">


									  <?
$city_id=$_POST['cityn'];

$query_hotel ="select hotel_id, hotel_name from hotels where hotel_id like '$city_id%' order by hotel_id";

$result_hotel = pg_query($conn, $query_hotel);

if (!$result_hotel) {
	echo "An error occured.\n";
	exit;
	}
while ($rows_hotel = pg_fetch_array($result_hotel)){

$array_hotel_id[] = $rows_hotel["hotel_id"];

}

pg_free_result($result_hotel);
$hc = count($array_hotel_id);
$hotel_id = $array_hotel_id[$hc-1];
$hotel_id++;

						$q_str = "hotel_id, hotel_name,hotel_type,hotel_desc,hotel_image,account_code,city,payment_type,reception_name,reception_tel,reception_fax,reception_mobile,sales_name,sales_tel,sales_fax,sales_mobile,reservation_name,reservation_tel,reservation_fax,reservation_mobile,bank_account_name,bank_name,bank_account_number,bank_branch,bank_city,notes";
						
						$a_q_str = explode(",", $q_str);

									  

for($i=0; $i<count($a_q_str); $i++){

if($i==0){
echo "<tr><td><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";
 echo $fie = trim($a_q_str[$i]);
echo "</font></td>";

echo "<td><input type=\"text\" id=\"$fie\" name=\"$fie\" value=\"$hotel_id\" size=\"75\" /></td>";
echo "</tr>";
}else{

echo "<tr><td><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";
 echo $fie = trim($a_q_str[$i]);
echo "</font></td>";

echo "<td><input type=\"text\" id=\"$fie\" name=\"$fie\" value=\"\" size=\"75\" /></td>";
echo "</tr>";
}


}




echo "</table>";


									

									  ?>

 <input type="submit" name="submit" id="submit" value=" Create New Hotel >>> ">									  
	</form>		



     </td></tr></table> 

</td></tr></table> 

</td></tr></table> 

</td></tr></table> 




