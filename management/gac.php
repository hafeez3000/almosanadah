<?
include ("header.php");
?>

<script>
document.title= '<? echo $company_name . " ERP - Management Home"; ?>';
</script>

<html>
<link rel="stylesheet" type="text/css" href="../calendar/css.css" />
<body leftmargin="0" topmargin="0" rightmargin="0">
<table width="100%" border="0" cellpadding="0" cellspacing="0" style="border-bottom: 1px solid #999999 ;border-left: 3px solid #006600;border-right: 3px solid #006600"><tr>
    <td bgcolor="#CCCCCC"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">&nbsp;You
      are here: Home</font></td>
  </tr></table>
<table width="100%" border="0" cellpadding="0" cellspacing="0" style="border-bottom: 1px solid #999999 ;border-left: 3px solid #006600;border-right: 3px solid #006600"><tr>
    <td ><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><?include ("../dticker/uhome.php"); ?></td>
  </tr></table>

<table width="100%" border="0" cellpadding="0" cellspacing="0" style="border-bottom: 3px solid #006600; border-right: 3px solid #006600;border-left: 3px solid #006600 ">
  <tr>
    <td width="20%" style="border-right: 1px solid #999999" valign="top"> <table width="100%" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td valign="top"><div align="left">
              <?include ("umenupreline.php"); ?>
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


$hotel_id = trim(isset($_POST['ac']) ? (string)$_POST['ac'] : '');


if($hotel_id==""){  $hotel_id = trim($_GET['hotid']); }

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$_SESSION['hotel_id'] = $hotel_id;

?>



									  <?
						$q_str = "user_sno,user_id,user_password,user_title,user_first_name,user_last_name,designation,company_name, iata_number,addr1,addr2,po_box,zip_code,city,country,tel1,tel2,mobile,fax,email,email_active_c,web,user_type,reg_date,account_code,online_status,sr_status,umrah_status,operations_status,management_status,accounts_status,hrm_status";

						$a_q_str = explode(",", $q_str);

									  $query_hotel ="select " . $q_str ." from users where user_sno='$hotel_id'";

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

if($i==0 || $i==1 ){
echo "<td><input type=\"text\" id=\"$fie\" name=\"$fie\" value=\"$rows_hotel[$fie]\" size=\"75\" readonly /></td>";
}

elseif($i==24){

	echo "<td><input type=\"text\" id=\"$fie\" name=\"$fie\" value=\"$rows_hotel[$fie]\" size=\"75\" readonly /></td>";
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
}


elseif($i==25){

if($rows_hotel[$fie]=='t'){
$ch_b = "checked";
}
else {
$ch_b="";
}

echo "<td><input type=\"checkbox\" id=\"$fie\" name=\"$fie\" $ch_b onClick=\"sameas();\" onBlur=\"sameas();\" onFocus=\"sameas();\" /></td>";

}

elseif($i>25){

if($rows_hotel[$fie]=='t'){
$ch_b = "checked";
}
else {
$ch_b="";
}
echo "<td><input type=\"checkbox\" id=\"$fie\" name=\"$fie\" $ch_b /></td>";

//echo "<td><input type=\"text\" id=\"$fie\" name=\"$fie\" value=\"$rows_hotel[$fie]\" size=\"75\" readonly /></td>";

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
	function sameas(){

   if(!document.getElementById('account_code').value)
	{
	document.getElementById('online_status').checked=false;
	alert("Account Code should not be empty for online reservation system");
	document.selhotel.a_search.focus();

	}
 //  else {
//   document.getElementById('online_status').checked=true;
//	}

   }

   function valf(theForm){


	if ( (document.selhotel.user_first_name.value == null) ||  ((document.selhotel.user_first_name.value).length==0))
   {
	alert("Habibi, Enter the User First Name.");
		document.selhotel.user_first_name.focus();
		return false;

	}

	if ((document.selhotel.user_last_name.value == null) ||  ((document.selhotel.user_last_name.value).length==0))
   {
	alert("Habibi, Enter the User Last Name.");
		document.selhotel.user_last_name.focus();
		return false;
	}



	if(document.selhotel.user_last_name.account_code.value==" ")
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
</body>
</html>
