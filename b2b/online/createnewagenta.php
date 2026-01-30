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


$query_gsno ="select agentid from agentsdet where agentid='$agentid'";

$result_gsno = pg_query($query_gsno);

$hid_c = pg_num_rows($result_gsno);

pg_free_result($result_gsno);

if($hid_c>0){ }
else{

						
$query_hotel ="insert into agentsdet(sno,agentid,acccode,aname,title,cname,desig,addr1,addr2,pobox,city,country,tel1,tel2,fax,mobile,email,wsite,remarks,mpay,priority,others,scountry) values ($agentid-1000,$agentid,'$acccode','$aname','$title','$cname','$desig','$addr1','$addr2','$pobox','$city','$country','$tel1','$tel2','$fax','$mobile','$email','$wsite','$remarks','$mpay','$priority','$others','$scountry')";
pg_query($query_hotel);
									
}
									  ?>

									  
	



     </td></tr></table> 

</td></tr></table> 

</td></tr></table> 

</td></tr></table> 



<? echo "<script>document.location.href=\"agentdetailsa.php?hotid=$agentid\"</script>";  ?>