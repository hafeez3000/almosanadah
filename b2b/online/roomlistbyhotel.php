<html>
<head><title>Detailed Rooming List</title></head>
<body>
<center>
<script>
 var winl1 = (screen.width - 750) / 2; 
 var winl = (screen.width - 500) / 2; 
 var wint = (screen.height - 200) / 2;
</script>




  <?php
include("../db/db.php");

$bpaid=0;
$nrc=1;
$rooms=0; 


 $bf="";
 $hb="";
 $fb="";
 $sa="";
 $ift="";
 $pmeals="";
 
 $hotelid = $_GET["hotid"];
 $fromd = $_GET["fdate"];
 $tod = $_GET["fdate"];

 $hotelid = "11101";
 $fromd = "2006-09-25";
 $tod = "2006-09-25";



$cocode="";

$query  = "SELECT ocode,cin,room_id,  cout, no_rooms, guest_occ_status, cus_paid from sales_hotels where cout between  date '$tod' - integer '30'  and '$tod' and cout > '$fromd' and ocode!='NC' and hotel_id='$hotelid' and booking_status!='Cancelled' or  cin  between '$fromd' and '$tod' and ocode!='NC' and hotel_id='$hotelid' and booking_status!='Cancelled' or   cin between date '$tod' - integer '30' and '$tod' and  cout > '$tod' and ocode!='NC' and hotel_id='$hotelid' and booking_status!='Cancelled' order by cin";

$result = pg_query($query);

$rowc = pg_num_rows($result);
//printf("Records selected: %d\n", mysql_affected_rows());

$ac=0;
$afd=array();
$atd=array();
$anofn=array();

$apaid=array();
?>
  <table border=1 cellpadding="2" cellspacing="0">
    <tr> 
      <td colspan="11"> <div align="center"> <font size="3" face="Arial, Helvetica, sans-serif"> 
          <?
  echo "Rooming List on " . date( 'd-M-Y' , strtotime($_GET["fdate"])); ?>
          </font></div></td>
    </tr>
    <tr> 
      <td><div align="center"><font size="2" face="Arial, Helvetica, sans-serif">Sno</font></div></td>
      <td><div align="center"><font size="2" face="Arial, Helvetica, sans-serif">PNR</font></div></td>
      <td><div align="center"><font size="2" face="Arial, Helvetica, sans-serif">Guest 
          Name</font></div></td>
      <td><div align="center"><font size="2" face="Arial, Helvetica, sans-serif">Cin</font></div></td>
      <td><div align="center"><font size="2" face="Arial, Helvetica, sans-serif">Cout</font></div></td>
	        <td><div align="center"><font size="2" face="Arial, Helvetica, sans-serif">Room Type</font></div></td>
      <td><div align="center"><font size="2" face="Arial, Helvetica, sans-serif">Travel 
          Agent</font></div></td>
      <td><div align="center"><font size="2" face="Arial, Helvetica, sans-serif">Country</font></div></td>
      <td><div align="center"><font size="2" face="Arial, Helvetica, sans-serif">SendMail</font></div></td>
      <td><div align="center"><font size="2" face="Arial, Helvetica, sans-serif">Paid</font></div></td>
      <td><div align="center"><font size="2" face="Arial, Helvetica, sans-serif">Rooms</font></div></td>
      <td><div align="center"><font size="2" face="Arial, Helvetica, sans-serif">&nbsp;</font></div></td>
    <tr> 
      <?
while ($row = pg_fetch_array($result))
{ 


$s_ocode = $row["ocode"];

$s_room_id =  $row["room_id"];

$query_sub  = "SELECT ocode,guest_title, guest_name,option_date,cus_company_name,cus_country from sales_main where ocode='$s_ocode' ";

$result_sub = pg_query($query_sub);


while ($row_sub = pg_fetch_array($result_sub))
{



$query_sub_room  = "SELECT room_type from rooms where room_id='$s_room_id' ";

$result_sub_room = pg_query($query_sub_room);


while ($row_sub_room = pg_fetch_array($result_sub_room))
{

$room_type =  $row_sub_room["room_type"];
}

?>

    <tr> 
      <td><div align="center"><font size="2" face="Arial, Helvetica, sans-serif"><?echo $nrc;?></font></div></td>
      <td><font size="2" face="Arial, Helvetica, sans-serif"><?echo $row["ocode"]; $cocode=$row["ocode"];?></font></td>
    
	<td><font size="2" face="Arial, Helvetica, sans-serif"><?echo $row_sub["guest_name"]; ?></font></td>



      <td><font size="2" face="Arial, Helvetica, sans-serif"><?echo date('d/m', strtotime($row["cin"])); ?></font></td>
      <td><font size="2" face="Arial, Helvetica, sans-serif"><?echo date('d/m', strtotime($row["cout"])); ?></font></td>

      <td><font size="2" face="Arial, Helvetica, sans-serif"><?echo $room_type; ?></font></td>

		<td><font size="2" face="Arial, Helvetica, sans-serif"><?echo $row_sub["cus_company_name"]; ?></font></td>

		<td><font size="2" face="Arial, Helvetica, sans-serif"><?echo $row_sub["cus_country"]; ?></font></td>

		<td><font size="2" face="Arial, Helvetica, sans-serif"><?echo "&nbsp;" ;?></font></td>		
		
		 <td> <div align="center"><font size="2" face="Arial, Helvetica, sans-serif"> 
          <? if ($bpaid<$row["cus_paid"]) { echo "<div align= center><font color=#006600 size=2 face=Arial, Helvetica, sans-serif>Yes</font></div>"; } else { echo "<div align=center><font color=#FF0000 size=2 face=Arial, Helvetica, sans-serif>No</font></div>";}; ?>
          </font></div></td>

		<td align="center"><font size="2" face="Arial, Helvetica, sans-serif"><?echo $row["no_rooms"]; ?></font></td>
     <td><div align="center"><font size="2" face="Arial, Helvetica, sans-serif">&nbsp;</font></div></td>

    </tr>
    <?
}

$afd[$ac] = $row["cin"];
$atd[$ac] = $row["cout"];
$anofn[$ac] = $row["no_rooms"];

if ($bpaid < $row["cus_paid"]){
$apaid[$ac] = $row["no_rooms"];

}
$nrc++;
$ac++;
//$i++;
$rooms=$rooms+$row["no_rooms"];
}

?>
    <tr> 
      <td colspan="10"><div align="center"><font size="2" face="Arial, Helvetica, sans-serif">Total 
          Number of Rooms</font></div></td>
      <td> <div align="center"><strong><font color="#FF0000" size="2" face="Arial, Helvetica, sans-serif"><? echo $rooms ?></font></strong></div></td>
	  <td>&nbsp;</td>
    </tr>
  </table>
</center>
</body>
</html>