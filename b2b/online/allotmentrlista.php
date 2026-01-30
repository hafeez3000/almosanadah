
 <?
include("../db/db.php");

$hotelid = $_POST['hot_id'];
$sfdate = $_POST['al_from'];
$stdate = $_POST['al_to'];

 $query_sub_room  = "SELECT room_id,room_type from rooms where room_id like '$hotelid%' ";

$result_sub_room = pg_query($query_sub_room);


while ($row_sub_room = pg_fetch_array($result_sub_room))
{
  $room_id =  $row_sub_room["room_id"];

$af_val = $_POST[$room_id];

$fq = "update rates$hotelid set allotment=$af_val where rate_date between date '$sfdate' and date '$stdate' - integer '1'  and room_id = $room_id ";

pg_query($fq);

}


 echo "<script>document.location.href=\"allotmentsetup.php\"</script>"; 
 ?>