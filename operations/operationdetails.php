<?
session_start();

// is the one accessing this page logged in or not?
/*if (!isset($_SESSION['db_is_logged_in_umrah']) 
   || $_SESSION['db_is_logged_in_umrah'] !== true) {

   // not logged in, move to login page
   header('Location: login.php');
   exit;
}*/
$suserid = $_SESSION["userid"];
$suser_sno = $_SESSION["user_sno"];
$dept = $_SESSION["deptoperations"];
?>
<?
include("../db/db.php"); 
?>

	<?

$vy=$vm=$vd=0;
$vy1=$vm1=$vd1=0;


$s_opid = $_GET["opid"];



$query_operation ="select group_id,station_name,nop_estimated,nop_arrived,nop_depatured,arrived_from,arrival_det,depatured_to,depatured_det,rep_name,group_leader,is_mazarat,ocode,rep_name_d,arrived_at,depatured_at,created_at,passports,pass_rhn,tickets,tickets_rhn from umrah_gm where sno=$s_opid";

$result_operation = pg_query($query_operation);

if (!$result_operation) {
	echo "An error occured.\n";
	exit;
	}
while ($rows_operation = pg_fetch_array($result_operation)){

 $s_group_id = $rows_operation["group_id"];
  $s_station_name = $rows_operation["station_name"];
  $s_nop_estimated = $rows_operation["nop_estimated"];
  $s_nop_arrived = $rows_operation["nop_arrived"];
  $s_nop_depatured = $rows_operation["nop_depatured"];
  $s_arrived_from = $rows_operation["arrived_from"];
  $s_arrival_det = $rows_operation["arrival_det"];
  $s_depatured_to = $rows_operation["depatured_to"];
  $s_depatured_det = $rows_operation["depatured_det"];

  $s_rep_name  = $rows_operation["rep_name"];
$s_rep_name_d  = $rows_operation["rep_name_d"];

  $s_group_leader = $rows_operation["group_leader"];
  $s_is_mazarat = $rows_operation["is_mazarat"]; 

  $s_arrived_at = $rows_operation["arrived_at"];
  $s_depatured_at = $rows_operation["depatured_at"];
  $s_passports = $rows_operation["passports"];
  $s_pass_rhn = $rows_operation["pass_rhn"];
  $s_tickets = $rows_operation["tickets"];
  $s_tickets_rhn = $rows_operation["tickets_rhn"];




}
pg_free_result($result_operation);



	?>

<table width="98%" cellpadding="0" cellspacing="0" style="border: 1px solid #999999"><tr><td width="100%" valign="top"> 
			<table cellpadding="0" cellspacing="0" width="100%" style="border-top: 1px solid #999999; border-bottom: 1px solid #999999"><tr>
                      <td bgcolor="#CCCCCC"><strong>Operation Details </strong></td>
                    </tr></table>
<table width="100%" cellpadding="1" cellspacing="0"><tr>
                      <td style="border-bottom: 1px solid #999999"><div align="left"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
                          <table width="100%" border="0" cellspacing="0">
						  <tr><td colspan="4">&nbsp;</td></tr>
  						 
						  <tr bgcolor="#CCCCCC"><td colspan="4"> 
						 

<tr><td colspan="3"><table>
<tr bgcolor="#EFEFEF">
<td width="33%" align="right"><font color="Red">*</font><font size="2" face="Verdana, Arial, Helvetica, sans-serif">
Group Id </font></td><td><?php echo $s_group_id ?> 
</td>
<td width="33%" align="right"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">
Station Name </font></td><td>




<?php echo $s_station_name ; ?>


</td>
<td width="33%" align="right"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">
Arrived From</font> </td><td><?php echo $s_arrived_from ; ?>
</td>
</tr>
<tr bgcolor="#EFEFEF">
<td align="right"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">
Estemated Paxs</font> </td><td>


<?php echo $s_nop_estimated ; ?>


</td>
<td align="right"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">
Arrived Paxs </font></td><td><?php echo $s_nop_arrived ; ?>

</td>
<td align="right"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">
Depatured Paxs </font></td><td><?php echo $s_nop_depatured ; ?>

</td>
</tr>

<tr bgcolor="#EFEFEF">
<td align="right" ><font size="2" face="Verdana, Arial, Helvetica, sans-serif">
Arrival Details</font> </td><td colspan="5"><textarea id="arrival_det" name="arrival_det" cols="52" rows="3" ><?php echo $s_arrival_det ; ?></textarea>
</td>
</tr>
<tr bgcolor="#EFEFEF">
<td align="right"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">
Group Leader</font> </td><td><?php echo $s_group_leader; ?>
</td>
<td align="right"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">
Depatured to </font></td><td colspan="3"><?php echo $s_depatured_to ;?>
</td>

</tr>

<tr bgcolor="#EFEFEF"><td align="right"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">
Received Agent</font></td><td><?php echo $s_rep_name ;?>
</td><TD align="right"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Depature Agent</font></TD><TD colspan="3"><?php echo $s_rep_name_d ;?></TD></tr>




<tr bgcolor="#EFEFEF">
<td align="right" ><font size="2" face="Verdana, Arial, Helvetica, sans-serif">
Deparute Details</font> </td><td colspan="5"><textarea id="depature_det" name="depature_det" cols="52" rows="3" ><?php echo $s_depatured_det; ?></textarea>
</td>
</tr>




</td></tr></table>



  <tr bgcolor="#EFEFEF">
  <td colspan="3">
  <table align="center">
   <tr> 
      <td><font size="2" face="Verdana, Arial, Helvetica, sans-serif">&nbsp;&nbsp;Arrived Date</font></td>
    
      <td>
        <?php 
echo date('d-M-Y H:i A', strtotime($s_arrived_at));
?>
</td>
   


      <td><font size="2" face="Verdana, Arial, Helvetica, sans-serif">&nbsp;&nbsp;Depatured Date</font></td>
      <td>
   <?php 
echo date('d-M-Y H:i A', strtotime($s_depatured_at));
?>

</td> 
    </tr> 

  </table> 
  
  </td>
  </tr>


    <tr> <td colspan="3" align="center">
    <table>
    <tr bgcolor="#EFEFEF">
<td align="right" width="33%"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">
Passports </font> </td><td>





<?php echo $s_passports ; ?>



</td><td>

<?php echo $s_pass_rhn ; ?>





</td>
<td align="right" width="33%"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">
Tickets </font></td><td>



<?php echo $s_tickets ; ?>



</td><td>

<?php echo $s_tickets_rhn ; ?>


</td>

<?php  if($s_is_mazarat=='t'){ $ch_maz = "checked"; } else { $ch_maz = ""; } ?>

<td align="right" width="33%"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">


  <font size="2" face="Verdana, Arial, Helvetica, sans-serif">Operation Mazarath? </font> </td><td><input type="checkbox" id="ch_mazarath" name="ch_mazarath" <?php echo $ch_maz ; ?> >

</td>
</tr>
</table></td>    
    
    
    
    
    
</tr>

    <tr> 



  
   
  
</td></tr></table></font></div></td>
                    </tr></table>									
					
			</td> 
                <td width="15%" style="border-left: 1px solid #999999" valign="top"><table >
					    
					<tr>
                       
                    </tr>
                  </table>
				</td>
              </tr></table>


</body>
</center>