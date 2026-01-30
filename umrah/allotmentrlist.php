<script type=text/javascript>
setTimeout('document.location=document.location',240000);
</script>
<?php
include("../db/db.php");

$sfdate = $_GET["f_d"];
$stdate = $_GET["t_d"];

$fromd = $sfdate;
$tod = $stdate;


function diff_days($start_date, $end_date) 
{ 
   return floor(abs(strtotime($start_date) - strtotime($end_date))/86400); 
} 

$df = diff_days($tod, $fromd)+1;

// $cina = array($cin);
// $couta = array($cout);

   
$hotelid= $_GET["vt"];



$q_str = "select hotel_name, hotel_image from hotels where hotel_id='$hotelid'";

$h_result = pg_query($conn, $q_str);

while ($h_row = pg_fetch_array($h_result))
{ 
$hot_name = $h_row["hotel_name"];
echo "<font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><b>" . $h_row["hotel_name"] . " - Allotment  From " . date('d-M-Y', strtotime($sfdate)) ." to ". date('d-M-Y', strtotime($stdate)) .
"</b></font>"; 
}

$rooms=0;

?>

<form name="selhotel" method="post" action="allotmentrlista.php" >

<table border="1" cellpadding="2" cellspacing="0" width="100%">
  <tr> 
      <td><div align="center"><font size="2" face="Arial, Helvetica, sans-serif">RoomId</font></div></td>
      <td><div align="center"><font size="2" face="Arial, Helvetica, sans-serif">Room Type</font></div></td>
      <td><div align="left"><font size="2" face="Arial, Helvetica, sans-serif">Alloted Rooms</font></div></td>
		  
     </tr>
 <? 
  $query_sub_room  = "SELECT room_id,room_type from rooms where room_id like '$hotelid%' ";

$result_sub_room = pg_query($conn, $query_sub_room);


while ($row_sub_room = pg_fetch_array($result_sub_room))
{
 $room_id =  $row_sub_room["room_id"];

$room_type =  $row_sub_room["room_type"];


$query_sub_room_allot  = "SELECT allotment from rates$hotelid where rate_date between date '$sfdate'  and date '$stdate'  and room_id = '$room_id' order by rate_date ";
$room_id_allot = 0;

$result_sub_room_allot = pg_query($conn, $query_sub_room_allot);


while ($row_sub_room_allot = pg_fetch_array($result_sub_room_allot))
{
 $room_id_allot =  $row_sub_room_allot["allotment"];
}
if($room_id_allot=="" or $room_id_allot=="0"){$room_id_allot=0;}

echo "<tr>"; 
echo "<td><div align=\"center\"><font size=\"2\" face=\"Arial, Helvetica, sans-serif\">$room_id</font></div></td>";
echo "<td><div align=\"left\"><font size=\"2\" face=\"Arial, Helvetica, sans-serif\">$room_type</font></div></td>";
echo "<td><div align=\"left\"><font size=\"2\" face=\"Arial, Helvetica, sans-serif\"><input type=\"text\" value=\"$room_id_allot\" name= $room_id  id=$room_id size=\"3\"</font></div></td>";
echo "</td>";
}

?>

<input type="hidden" name="hot_id" id="hot_id" value='<? echo $hotelid ; ?>' >
<input type="hidden" name="al_from" id="al_from" value='<? echo $sfdate ; ?>' >
<input type="hidden" name="al_to" id="al_to" value='<? echo $stdate ; ?>' >
  
  </table>

<table  width="100%"><tr><td align="right"><input type="submit" value="Allot Rooms"></td></tr></table>
</form>

<script> document.title = '<? echo $hot_name ;?>' + " - " +document.title  ; </script>
