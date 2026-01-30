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
                      <td bgcolor="#CCCCCC"><strong> <font size="2" face="Verdana, Arial, Helvetica, sans-serif">User Details</font></td>
                    </tr></table>
<?
include ("gprocessing.html");  ?>


									  <?
$user_sno = trim($_SESSION["user_sno"]); 


$user_id=$_POST['user_id'];
$user_password=$_POST['user_password'];
$user_title=$_POST['user_title'];
$user_first_name=$_POST['user_first_name'];
$user_last_name=$_POST['user_last_name'];
$designation=$_POST['designation'];
$company_name=$_POST['company_name'];
$iata_number=$_POST['iata_number'];

$addr1=$_POST['addr1'];
$addr2=$_POST['addr2'];
$po_box=$_POST['po_box'];
$zip_code=$_POST['zip_code'];
$city=$_POST['city'];
$country=$_POST['country'];
$tel1=$_POST['tel1'];
$tel2=$_POST['tel2'];
$mobile=$_POST['mobile'];
$fax=$_POST['fax'];
$email=$_POST['email'];
$web=$_POST['web'];



	

						
$query_hotel ="update users set user_password='$user_password',user_title='$user_title',user_first_name='$user_first_name',user_last_name='$user_last_name',designation='$designation',company_name='$company_name',iata_number='$iata_number',addr1='$addr1',addr2='$addr2',po_box='$po_box',zip_code='$zip_code',city='$city',country='$country',tel1='$tel1',tel2='$tel2',mobile='$mobile',fax='$fax',email='$email',web='$web' where user_sno=$user_sno";

pg_query($query_hotel);
									

									  ?>

									  
	



     </td></tr></table> 

</td></tr></table> 

</td></tr></table> 

</td></tr></table> 



<? echo "<script>document.location.href=\"userdetails.php\"</script>";  ?>