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
                      <td bgcolor="#CCCCCC"><strong> <font size="2" face="Verdana, Arial, Helvetica, sans-serif">User Details</font></td>
                    </tr></table>



									  <?
$user_sno=$_POST['user_sno'];
$user_id=$_POST['user_id'];

$user_password=$_POST['user_password'];
$user_title=$_POST['user_title'];
$user_first_name=$_POST['user_first_name'];
$user_last_name=$_POST['user_last_name'];
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
$user_type=$_POST['user_type'];
// $reg_date=$_POST['reg_date'];
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




$query_gsno ="select user_id from users where user_id='$user_id'";

$result_gsno = pg_query($conn, $query_gsno);

$hid_c = pg_num_rows($result_gsno);

pg_free_result($result_gsno);


if($hid_c>0){ 
  
  echo "User ID already exists.<br>";
  
  echo "<button onclick=\"document.location.href='createnewuser.php'\">Create New User by choosing a different User ID</button>";
}
else{


include ("gprocessing.html"); 


//user_password='$user_password',user_title='$user_title',user_first_name='$user_first_name',user_last_name='$user_last_name',addr1='$addr1',addr2='$add
	


	$query_hotel ="insert into users(user_sno,user_id,user_password,user_title,user_first_name,user_last_name,addr1,addr2,po_box,zip_code,city,country,tel1,tel2,mobile,fax,email,web,user_type,reg_date,account_code,online_status,sr_status,umrah_status,operations_status,management_status,accounts_status,hrm_status) values ($user_sno,'$user_id','$user_password','$user_title','$user_first_name','$user_last_name','$addr1','$addr2','$po_box','$zip_code','$city','$country','$tel1','$tel2','$mobile','$fax','$email','$web','$user_type','now()','$account_code','$online_status','$sr_status','$umrah_status','$operations_status','$management_status','$accounts_status','$hrm_status')";
pg_query($conn, $query_hotel);
						

									
$sequpdateg_rate_sno = "update seq set users=$user_sno";
pg_query($conn, $sequpdateg_rate_sno);
									  ?>

									  
	



     </td></tr></table> 

</td></tr></table> 

</td></tr></table> 

</td></tr></table> 



<?  echo "<script>document.location.href=\"gac.php?hotid=$user_sno\"</script>"; ?>


<?
}
?>
