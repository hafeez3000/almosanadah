<?
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$suserid = $_SESSION["userid"];
$suser_sno = $_SESSION["user_sno"];
$dept = $_SESSION["deptumrah"];
?>
<?
include("../db/db.php"); 


?>

<?

$s_pnr = $_GET["spnr"]; 



$q_recon_c ="select voctype, vocno, recon from vocmast where pnr='$s_pnr' and recon='t' ";

$recon_c = pg_query($conn, $q_recon_c);

$rows_recon_c = pg_num_rows($recon_c);

$amd_dis = 0;

if($rows_recon_c>=1){
$amd_dis = 1;
}

$s_img = $_GET["img"]; 
$s_sid = $_GET["sid"]; 

$uploaddir = "../uploads/";




?>
<center>
<body bgcolor="#00A800" leftmargin="10" topmargin="10" marginwidth="0" marginheight="0">
<table width="100%" height="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF">
  <tr>
  <td valign="top" width="100%" height="15" style="border-bottom: 1px solid #999999;"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">
<?
if($amd_dis==1){ } else{
?>
<a href="pnrimgdel.php?sid=<?php echo $s_sid ?>&spnr=<?php echo $s_pnr ?>&img=<?php echo $s_img ?>" onclick="return confirm('Are you sure you want to delete Image ?')">Delete</a>
<?
}
?>
 | <a href="javascript:window.close();">  Close</a> </font>
  </td>
  </tr>
  
  <tr>
  <td>

<img src='<?php echo $uploaddir.$s_img ?>'  >
  </td>
  </tr>
  
</table>


</body>
</center>
