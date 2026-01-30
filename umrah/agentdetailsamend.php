<?
include ("header.php");
?>


<table width="100%" border="0" cellpadding="0" cellspacing="0" style="border-bottom: 3px solid #006600; border-right: 3px solid #006600;border-left: 3px solid #006600 ">
  <tr>
    <td width="20%" style="border-right: 1px solid #999999"  valign="top"> <table width="100%" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td valign="top"><div align="left"> 
              <?php include  ("umenupreline.php"); ?>
            </div></td>
        </tr>
      </table></td>
    <td width="80%" valign="top"  > <table width="100%" border="0" cellpadding="0" cellspacing="1">
        <tr>
          <td valign="top"> 

<table cellpadding="0" cellspacing="0" width="100%" style="border-top: 1px solid #999999; border-bottom: 1px solid #999999"><tr>
                      <td bgcolor="#CCCCCC"><strong> <font size="2" face="Verdana, Arial, Helvetica, sans-serif">Travel Agent Details</font></td>
                    </tr></table>
<?
include ("gprocessing.html");  ?>


									  <?


$agentid	=$_POST['agentid']; 		
$acccode	=$_POST['acccode']; 
$aname		=$_POST['aname'];   
$title		=$_POST['title'];   
$cname		=$_POST['cname'];   
$desig		=$_POST['desig'];   
$addr1		=$_POST['addr1'];   
$addr2		=$_POST['addr2'];   
$pobox		=$_POST['pobox'];   
$city		=$_POST['city'];    
$country	=$_POST['country']; 
$tel1		=$_POST['tel1'];    
$tel2		=$_POST['tel2'];    
$fax		=$_POST['fax'];     
$mobile		=$_POST['mobile'];  
$email		=$_POST['email'];   
$wsite		=$_POST['wsite'];   
$remarks	=$_POST['remarks']; 
$mpay		=$_POST['mpay'];    
$priority	=$_POST['priority'];
$scountry	=$_POST['scountry'];
$others		=$_POST['others'];  

        

if (session_status() === PHP_SESSION_NONE) {
    session_start();
} 
$hotel_ids = $_SESSION['hotel_id'] ; 

		
$query_hotel ="update agentsdet set  agentid='$agentid',acccode='$acccode',aname='$aname',title='$title',cname='$cname',desig='$desig',addr1='$addr1',addr2='$addr2',pobox='$pobox',city='$city',country='$country',tel1='$tel1',tel2='$tel2',fax='$fax',mobile='$mobile',email='$email',wsite='$wsite ',remarks='$remarks',mpay='$mpay',priority='$priority',scountry='$scountry',others='$others'  where agentid='$hotel_ids'";

pg_query($conn, $query_hotel);
									

									  ?>

									  
	



     </td></tr></table> 

</td></tr></table> 

</td></tr></table> 

</td></tr></table> 



<?  echo "<script>document.location.href=\"agentdetailsa.php?hotid=$agentid\"</script>";  ?>