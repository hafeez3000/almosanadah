<?
include ("header.php");
?>

<script>
document.title= '<? echo $company_name . " ERP - Online Reservation"; ?>';
</script>

<html>
<link rel="stylesheet" type="text/css" href="../calendar/css.css" />
<body leftmargin="0" topmargin="0" rightmargin="0">
<table width="100%" border="0" cellpadding="0" cellspacing="0" style="border-bottom: 1px solid #999999 ;border-left: 3px solid #006600;border-right: 3px solid #006600"><tr>
     <td bgcolor="#CCCCCC"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">&nbsp;You 
      are here: <a href="uhome.php">Home</a> &raquo; Utilities &raquo; User Details</font></td>
  </tr></table>
  
<table width="100%" border="0" cellpadding="0" cellspacing="0" style="border-bottom: 3px solid #006600; border-right: 3px solid #006600;border-left: 3px solid #006600 ">
  <tr>
    <td width="20%" style="border-right: 1px solid #999999" valign="top"> <table width="100%" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td valign="top"><div align="left"> 
              <?include ("umenu.php"); ?>
            </div></td>
        </tr>
      </table></td>
    <td width="80%" valign="top"  > <table width="100%" border="0" cellpadding="0" cellspacing="1">
        <tr>
          <td valign="top"> 
           
			
			
			
            <table width="100%" cellpadding="0" cellspacing="0" ><tr><td width="85%" valign="top"> 
			<table cellpadding="0" cellspacing="0" width="100%"><tr><td></td></tr></table>

			<table cellpadding="0" cellspacing="0" width="100%" style="border-top: 1px solid #999999; border-bottom: 1px solid #999999"><tr>
                      <td bgcolor="#CCCCCC"><strong> <font size="2" face="Verdana, Arial, Helvetica, sans-serif">User Details</font></td>
                    </tr></table>
			
			<table width="100%" cellpadding="1" cellspacing="0" ><tr>
                      <td bgcolor="#FFF2F2" style="border-bottom: 1px solid #999999"  >
					  
					  
					  
					  
				<form name="selhotel" method="post" action="userdetailsamend.php" onSubmit="return valf(this)">

<?	
  

$hotel_id = trim($_SESSION["user_sno"]); 		  




?>


									  <?
					   $qt_str = "User Id, User Password, User Title, First Name, Last Name, Designation, Company Name, IATA Number,Address 1, Address 2, Post Box, Zip Code, City, Country, Phone 1, Phone 2, Mobile, Fax, Email, Web, Status";
					  
						
						$q_str = "user_id,user_password,user_title,user_first_name,user_last_name,designation,company_name, iata_number,addr1,addr2,po_box,zip_code,city,country,tel1,tel2,mobile,fax,email,web,online_status";



						
						$a_q_str = explode(",", $q_str);

						$a_qt_str = explode(",", $qt_str);

									  $query_hotel ="select " . $q_str ." from users where user_sno='$hotel_id'";

$result_hotel = pg_query($query_hotel);

if (!$result_hotel) {
echo "An error occured.\n";
exit;
		}

echo "<table border=\"1\">";
while ($rows_hotel = pg_fetch_array($result_hotel)){

// echo $hotel_name_dis = $rows_hotel["hotel_name"];

for($i=0; $i<count($a_q_str); $i++){

echo "<tr><td><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";
  $fie = trim($a_q_str[$i]);
 echo $a_qt_str[$i];
echo "</font></td>";

if($i==0 ){
echo "<td><input type=\"text\" id=\"$fie\" name=\"$fie\" value=\"$rows_hotel[$fie]\" size=\"75\" readonly /></td>";
}

elseif($i==2){

echo "<td>";

?> 

	   <select name="<? echo $fie ?>"> <option value="<? echo $rows_hotel[$fie] ;?>"><? echo $rows_hotel[$fie] ;?></option>
	   
										<option value="Mr">Mr</option> 
                                        <option value="Ms">Ms</option>
                                        <option value="Mrs">Mrs</option>
                                        <option value="Miss">Miss</option>
                                        <option value="Dr">Dr</option>
                                        <option value="Prof">Prof</option>
                                      </select>
<?
echo "</td>";

}


elseif($i==20){



if($rows_hotel[$fie]==t){
	echo "<td ><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\" color=\"#003300\"><strong>Active</strong></font></td>";
}
else {

	echo "<td ><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\" color=\"red\"><strong>Not Active</strong></font></td>";

}




}



else{
echo "<td><input type=\"text\" id=\"$fie\" name=\"$fie\" value=\"$rows_hotel[$fie]\" size=\"75\" /></td>";
}

echo "</tr>";
}


}

echo "</table>";
pg_free_result($result_hotel);

									

									  ?>

 <input type="submit" name="submit" id="submit" value="Amend User Details">									  
	</form>		

	
				  
					  
					  
	</td>
                    </tr>					
					</table>
							
			</td> 
               
              </tr></table> </td>
        </tr>
      </table></td></tr>
	  
	  
      </table> 
</table>	
	


	</tr></table>

<script>

   function valf(theForm){


	if ( (document.selhotel.user_password.value == null) || ((document.selhotel.user_password.value).length==0))
   {
	alert("Habibi, Enter the Password.");
		document.selhotel.user_password.focus();
		return false;
	
	}

	if ( ((document.selhotel.user_password.value).length<3) || ((document.selhotel.user_password.value).length > 14))
   {
	alert("Habibi, Enter the Password not less then 3 chars and not more than 14 chars.");
		document.selhotel.user_password.focus();
		return false;
	
	}


	
	if ( (document.selhotel.user_first_name.value == null) ||  ((document.selhotel.user_first_name.value).length==0))
   {
	alert("Habibi, Enter the User First Name.");
		document.selhotel.user_first_name.focus();
		return false;
	
	}

if (((document.selhotel.user_first_name.value).length>29))
   {
	alert("Habibi, Enter the User First Name not more than 30 chars.");
		document.selhotel.user_first_name.focus();
		return false;
	
	}
	
	
	
	
	if ((document.selhotel.user_last_name.value == null) ||  ((document.selhotel.user_last_name.value).length==0))
   {
	alert("Habibi, Enter the User Last Name.");
		document.selhotel.user_last_name.focus();
		return false;
	}

if ( ((document.selhotel.user_last_name.value).length>49))
   {
	alert("Habibi, Enter the User Last Name not more than 49 chars.");
		document.selhotel.user_last_name.focus();
		return false;
	}


if ( ((document.selhotel.designation.value).length>24))
   {
	alert("Habibi, Enter the Designation not more than 24 chars.");
		document.selhotel.designation.focus();
		return false;
	}


if ( ((document.selhotel.company_name.value).length>74))
   {
	alert("Habibi, Enter the Company not more than 74 chars.");
		document.selhotel.company_name.focus();
		return false;
	}


if ( ((document.selhotel.iata_number.value).length>9))
   {
	alert("Habibi, Enter the IATA Number not more than 9 chars.");
		document.selhotel.iata_number.focus();
		return false;
	}


if ( ((document.selhotel.addr1.value).length>99))
   {
	alert("Habibi, Enter the Address 1 not more than 99 chars.");
		document.selhotel.addr1.focus();
		return false;
	}

if ( ((document.selhotel.addr2.value).length>99))
   {
	alert("Habibi, Enter the Address 2 not more than 99 chars.");
		document.selhotel.addr2.focus();
		return false;
	}


if ( ((document.selhotel.po_box.value).length>7))
   {
	alert("Habibi, Enter the PO BOX not more than 8 chars.");
		document.selhotel.po_box.focus();
		return false;
	}

if ( ((document.selhotel.zip_code.value).length>7))
   {
	alert("Habibi, Enter the ZIP CODE not more than 8 chars.");
		document.selhotel.zip_code.focus();
		return false;
	}


if ( ((document.selhotel.city.value).length>14))
   {
	alert("Habibi, Enter the City not more than 15 chars.");
		document.selhotel.city.focus();
		return false;
	}

if ( ((document.selhotel.country.value).length>24))
   {
	alert("Habibi, Enter the Country not more than 24 chars.");
		document.selhotel.country.focus();
		return false;
	}


if ( ((document.selhotel.tel1.value).length>14))
   {
	alert("Habibi, Enter the Telephone 1 not more than 15 chars.");
		document.selhotel.tel1.focus();
		return false;
	}

if ( ((document.selhotel.tel2.value).length>14))
   {
	alert("Habibi, Enter the Telephone 2 not more than 15 chars.");
		document.selhotel.tel2.focus();
		return false;
	}

if ( ((document.selhotel.mobile.value).length>14))
   {
	alert("Habibi, Enter the Mobile not more than 15 chars.");
		document.selhotel.mobile.focus();
		return false;
	}

if ( ((document.selhotel.fax.value).length>14))
   {
	alert("Habibi, Enter the Fax not more than 15 chars.");
		document.selhotel.fax.focus();
		return false;
	}


if ( ((document.selhotel.email.value).length>49))
   {
	alert("Habibi, Enter the Email not more than 49 chars.");
		document.selhotel.email.focus();
		return false;
	}


if ( ((document.selhotel.web.value).length>34))
   {
	alert("Habibi, Enter the Web not more than 35 chars.");
		document.selhotel.web.focus();
		return false;
	}





   }

</script>
</body>				
</html>



