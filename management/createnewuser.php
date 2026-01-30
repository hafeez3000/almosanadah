<?
include ("header.php");
$ch_b = "unchecked";
?>


<table width="100%" border="0" cellpadding="0" cellspacing="0" style="border-bottom: 3px solid #006600; border-right: 3px solid #006600;border-left: 3px solid #006600 ">
  <tr>
    <td width="20%" style="border-right: 1px solid #999999"  valign="top"> <table width="100%" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td valign="top"><div align="left"> 
              <?include ("umenupreline.php"); ?>
            </div></td>
        </tr>
      </table></td>
    <td width="80%" valign="top"  > <table width="100%" border="0" cellpadding="0" cellspacing="1">
        <tr>
          <td valign="top"> 

<table cellpadding="0" cellspacing="0" width="100%" style="border-top: 1px solid #999999; border-bottom: 1px solid #999999"><tr>
                      <td bgcolor="#CCCCCC" width="100%"><strong> <font size="2" face="Verdana, Arial, Helvetica, sans-serif">New User Creation</font></td>
                    </tr></table>

<form name="selhotel" method="post" action="createnewusera.php" onSubmit="return valf(this)">

<table border="1">


									  <?


$query_hotel ="select users from seq";

$result_hotel = pg_query($conn, $query_hotel);

if (!$result_hotel) {
	echo "An error occured.\n";
	exit;
	}
while ($rows_hotel = pg_fetch_array($result_hotel)){

$u_sno = $rows_hotel["users"];

}

pg_free_result($result_hotel);

$u_sno++;

						$qb_str = "User Sno,User Id,User Password,User_Title,User First Name,User Last Name,Address1,Address2,PO Box,Zip Code,City,Country,Telphone 1,Telephone 2,Mobile,Fax Number,Email,Website,User Type,Account Code,Online Status,Sales & Reservation Status,Umrah Status,Operations Status,Management Status,Accounts Status, HRM Status";

						$q_str = "user_sno,user_id,user_password,user_title,user_first_name,user_last_name,addr1,addr2,po_box,zip_code,city,country,tel1,tel2,mobile,fax,email,web,user_type,account_code,online_status,sr_status,umrah_status,operations_status,management_status,accounts_status,hrm_status";
						
						$a_q_str = explode(",", $q_str);

						$a_qb_str = explode(",", $qb_str);


									  

for($i=0; $i<count($a_q_str); $i++){

if($i==0){
echo "<tr><td><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";
echo trim($a_qb_str[$i]);
$fie = trim($a_q_str[$i]);
echo "</font></td>";

echo "<td><input type=\"text\" id=\"$fie\" name=\"$fie\" value=\"$u_sno\" size=\"70\" readonly /></td>";
echo "</tr>";
}




elseif($i==20){

echo "<tr><td><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";
 echo trim($a_qb_str[$i]);
$fie = trim($a_q_str[$i]);
echo "</font></td>";

echo "<td><input type=\"checkbox\" id=\"$fie\" name=\"$fie\" $ch_b nClick=\"sameas();\" onBlur=\"sameas();\" onFocus=\"sameas();\" /></td></tr>"; 


}


elseif($i>20){

echo "<tr><td><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";
 echo trim($a_qb_str[$i]);
$fie = trim($a_q_str[$i]);
echo "</font></td>";

echo "<td><input type=\"checkbox\" id=\"$fie\" name=\"$fie\" $ch_b /></td></tr>"; 


}




else{

echo "<tr><td><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";
 echo trim($a_qb_str[$i]);
$fie = trim($a_q_str[$i]);
echo "</font></td>";

echo "<td><input type=\"text\" id=\"$fie\" name=\"$fie\" value=\"\" size=\"70\" /></td>";
echo "</tr>";



}

?>
						





<?
}
?>
<tr>
   <td align="left" width="30%"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Search 
                                      Agent</font></td>

 <script type="text/javascript">
      function OpenWindow(){
       
   if ( (document.selhotel.a_search.value == null) ||  ((document.selhotel.a_search.value).length==0))
   {
      alert ("Sorry, But enter Account Name to find Account");
	  document.selhotel.a_search.focus();
   }
   else {
			
    	var rr = "agentsearchf.php?hn="+document.selhotel.a_search.value;
		
        var winPop = window.open(rr,"winPop",'menubar=yes,scrollbars=yes,toolbar=no,resizable=yes,width=700,height=300, top='+10+',left='+10+' ').focus();

	
      }

} 
    </script>
                                    <td align="left"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><input type="text" id="a_search" name="a_search" size="30"> 
									<input type="button" id="b_search" name="b_search" value="Agent Search" onClick="OpenWindow()"> 
									</font></td>
                                  </tr>
	
<?


echo "</table>";


									

									  ?>

 <input type="submit" name="submit" id="submit" value=" Create New User Agent >>> ">									  
	</form>		





<script>
	function sameas(){
 
   if(!document.getElementById('account_code').value)
	{
	document.getElementById('online_status').checked=false;
	alert("Account Code should not be empty for online reservation system");
	document.selhotel.a_search.focus();

	}
   else {
   document.getElementById('online_status').checked=true;
	}

   }


   
   
   
   function valf(theForm){



 if ( (document.selhotel.user_id.value == null) ||  ((document.selhotel.user_id.value).length==0))
   {
	alert("Habibi, Enter the User Id.");
	document.selhotel.user_id.focus();
	return false;
	}		


 if ( (document.selhotel.user_password.value == null) ||  ((document.selhotel.user_password.value).length==0))
   {
	alert("Habibi, Enter the User Password.");
	document.selhotel.user_password.focus();
	return false;
	}		


 if ( (document.selhotel.user_first_name.value == null) ||  ((document.selhotel.user_first_name.value).length==0))
   {
	alert("Habibi, Enter the User First Name.");
	document.selhotel.user_first_name.focus();
	return false;
	}		

 if ( (document.selhotel.user_last_name.value == null) ||  ((document.selhotel.user_last_name.value).length==0))
   {
	alert("Habibi, Enter the User last Name.");
	document.selhotel.user_last_name.focus();
	return false;
	}



	if(document.selhotel.account_code.value==" ")
	{
	document.getElementById('online_status').checked=false;
	alert("Account Code should not be empty for online reservation system");
	document.selhotel.a_search.focus();
    return false;
	}
   else {
   document.getElementById('online_status').checked=true;
   return true;
	}
	
   }

</script>

     </td></tr></table> 

</td></tr></table> 

</td></tr></table> 

</td></tr></table> 




