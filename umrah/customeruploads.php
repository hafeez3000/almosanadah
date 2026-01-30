<?
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// is the one accessing this page logged in or not?
/*if (!isset($_SESSION['db_is_logged_in_umrah']) 
   || $_SESSION['db_is_logged_in_umrah'] !== true) {

   // not logged in, move to login page
   header('Location: login.php');
   exit;
}*/
$suserid = $_SESSION["userid"];
$suser_sno = $_SESSION["user_sno"];
$dept = $_SESSION["deptumrah"];
?>
<?
include("../db/db.php"); 


?>

<?$s_pnr = $_GET["spnr"]; 

$s_is_cus =1;

?>
<center>
<body bgcolor="#00A800" leftmargin="10" topmargin="10" marginwidth="0" marginheight="0">
<table width="100%" height="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF">
  <tr>
    <td>

<table width="100%" height="6%" border="0" cellspacing="0" cellpadding="0" bgcolor="#CAFFCA">
  <tr>
            <td><font size="2" face="Arial, Helvetica, sans-serif"><strong>&nbsp; 
              Customer Voucher & Payments for PNR: <? echo $s_pnr ; ?></strong></font></td>
            <td valign="top"> <div align="right"><img src="../images/tr.jpg" width="9" height="10"></div></td>
  </tr>
</table>
<table width="100%" height="86%" border="0" cellspacing="0" cellpadding="1" bgcolor="#FFFFFF">
  <tr><td valign="top">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td style=" padding-left: 70px; ">

<? 

//echo $u_p = $_SERVER['DOCUMENT_ROOT']."../uploads/";



?>
<?
if ($_REQUEST[completed] == 1) {

	
//$uploaddir = $_SERVER['DOCUMENT_ROOT']."/uploads/";
$uploaddir = "../uploads/";
$fnfi  = uniqid("customer_")."_".basename($_FILES['mailfile']['name']);
$uploadfile = $uploaddir . $fnfi;


move_uploaded_file($_FILES['mailfile']['tmp_name'],  "$uploadfile");
} ?>
<html>
<head><title>Upload page</title></head>
<br><br>
<?php if ($_REQUEST[completed] != 1) { ?>
<h3 style=" display: inline; ">Please upload an image</h3><br><br>
<form enctype=multipart/form-data method=post>
<input type=hidden name=MAX_FILE_SIZE value=15000000>
<input type=hidden name=completed value=1>
Choose file to upload: <input type=file name=mailfile><br>
<input type="submit" value="Upload Voucher/Payment Copy"  ></form>
<?php } else { 
	

chmod($uploadfile,0777); //Will CHMOD a file
	
	$sqlins_image = "insert into cussup_gallery (ocode,image_path, is_cus, created_at, updated_at ) values ('$s_pnr', '$fnfi', $s_is_cus, 'now' ,'now' ) ";

pg_query($conn, $sqlins_image);
	

/*add a record to pnrhistory table*/

$changeopdate = "INSERT INTO pnrhistory(user_sno, ocode, description, created_at) VALUES ('$suser_sno', '$s_pnr', 'Customer Voucher or Payments images is uploaded', 'now()')";
pg_query($conn, $changeopdate);
/*END - add a record to pnrhistory table*/	
	
	?>

<b>Image is successfully uploaded</b>

<script type="text/javascript">
 
 window.close(); 
if (window.opener && !window.opener.closed) {
window.opener.location.reload();
} 
 
</script>

<?php }

?>


</td></tr>			
</table>			
</td></tr>
</table>
<table width="100%" height="8%" border="0" cellspacing="0" cellpadding="0" bgcolor="#CAFFCA">
  <tr>
            <td  valign="bottom"  > <img src="../images/bl.jpg" width="9" height="10"></td>
            <td valign="middle"><div align="right">
                <input name="close" type="button" value="  Close  "  onClick="window.close();">&nbsp;&nbsp;&nbsp;
              </div></td>
  </tr>
</table>


</td>
  </tr>
</table>


</body>
</center>
