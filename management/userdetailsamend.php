<?
include ("header.php");
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
                      <td bgcolor="#CCCCCC"><strong> <font size="2" face="Verdana, Arial, Helvetica, sans-serif">Hotel Details</font></td>
                    </tr></table>
<?
include ("gprocessing.html");  ?>


									  <?
$user_sno=$_POST['user_sno'];
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
$email_active_c=$_POST['email_active_c'];

$web=$_POST['web'];
$user_type=$_POST['user_type'];
$reg_date=$_POST['reg_date'];


$account_code=$_POST['account_code'];


if(isset($_POST['online_status']) && $_POST['online_status']=="on"){
$online_status='t';
} else {
$online_status='f';}


if(isset($_POST['sr_status']) && $_POST['sr_status']=="on"){
$sr_status='t';
} else {
$sr_status='f';}

if(isset($_POST['umrah_status']) && $_POST['umrah_status']=="on"){
$umrah_status='t';
} else {
$umrah_status='f';}


if(isset($_POST['operations_status']) && $_POST['operations_status']=="on"){
$operations_status='t';
} else {
$operations_status='f';}

if(isset($_POST['accounts_status']) && $_POST['accounts_status']=="on"){
$accounts_status='t';
} else {
$accounts_status='f';}

if(isset($_POST['hrm_status']) && $_POST['hrm_status']=="on"){
$hrm_status='t';
} else {
$hrm_status='f';}

if(isset($_POST['management_status']) && $_POST['management_status']=="on"){
$management_status='t';
} else {
$management_status='f';}

//$online_status=$_POST['online_status'];
//$sr_status=$_POST['sr_status'];
//$umrah_status=$_POST['umrah_status'];
//$operations_status=$_POST['operations_status'];
//$management_status=$_POST['management_status'];
//$accounts_status=$_POST['accounts_status'];
//$hrm_status=$_POST['hrm_status'];









//user_password='$user_password',user_title='$user_title',user_first_name='$user_first_name',user_last_name='$user_last_name',addr1='$addr1',addr2='$addr2',po_box='$po_box',zip_code='$zip_code',city='$city',country='$country',tel1='$tel1',tel2='$tel2',mobile='$mobile',fax='$fax',email='$email',web='$web',user_type='$user_type',reg_date='$reg_date',online_status='$online_status',sr_status='$sr_status',umrah_status='$umrah_status',operations_status='$operations_status',management_status='$management_status'  
	

						
$query_hotel ="update users set user_password='$user_password',user_title='$user_title',user_first_name='$user_first_name',user_last_name='$user_last_name',designation='$designation',company_name='$company_name',iata_number='$iata_number',addr1='$addr1',addr2='$addr2',po_box='$po_box',zip_code='$zip_code',city='$city',country='$country',tel1='$tel1',tel2='$tel2',mobile='$mobile',fax='$fax',email_active_c='$email_active_c',email='$email',web='$web',user_type='$user_type',reg_date='$reg_date',account_code='$account_code',online_status='$online_status',sr_status='$sr_status',umrah_status='$umrah_status',operations_status='$operations_status',management_status='$management_status',accounts_status='$accounts_status',hrm_status='$hrm_status' where user_sno=$user_sno";



pg_query($conn, $query_hotel);
									

									  ?>

									  
	



     </td></tr></table> 

</td></tr></table> 

</td></tr></table> 

</td></tr></table> 



<?  echo "<script>document.location.href=\"gac.php?hotid=$user_sno\"</script>";  ?>