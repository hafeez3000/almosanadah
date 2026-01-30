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
<?
include ("gprocessing.html");  ?>


									  <?

$s_id               =$_POST['id'];
$mandoop_name	      =$_POST['mandoop_name'];
$mandoop_branch	    =$_POST['mandoop_branch'];
$mandoop_mobile	    =$_POST['mandoop_mobile'];
$status	            =$_POST['status'];

if($status=="Yes"){
    $s_status = "true" ; }
else {
    $s_status = "false" ; }

 $query_hotel ="update mandoop set mandoop_name='$mandoop_name',  mandoop_branch='$mandoop_branch', mandoop_mobile='$mandoop_mobile' ,  mandoop_status=$s_status where id=$s_id ";
pg_query($conn, $query_hotel);


?>






     </td></tr></table>

</td></tr></table>

</td></tr></table>

</td></tr></table>



<?   echo "<script>document.location.href=\"mandoopdetailsa.php?hotid=$s_id\"</script>";  ?>