
<?
// Manual update of the room types given hotelid
set_time_limit(9000);        
include ("header.php");
?>

<?

$s_hot_id = 11157;


$a_hotel_id = array();

//select * from rates11109 order by rate_sno desc limit 1

$querycr = "select room_id, room_type, no_of_paxs from rooms where room_id like '$s_hot_id%' order by room_id"; 
$resultcr = pg_query($conn, $querycr); 

$n_roomid_chk = pg_num_rows($resultcr);

if (!$resultcr) {
	echo "An error occured.\n";
	exit;
	}
while($rowcr = pg_fetch_array($resultcr))  // main while loop 1 start
    {

echo $room_id = $rowcr["room_id"];
echo " || ";




$querycr_gl = "select rate_sno, rate_date, no_of_paxs from rates$s_hot_id where room_id='$room_id' order by rate_sno desc limit 1"; 
$resultcr_gl = pg_query($conn, $querycr_gl); 

$n_roomid_chk_gl = pg_num_rows($resultcr_gl);

if (!$resultcr_gl) {
	echo "An error occured.\n";
	exit;
	}
while($rowcr_gl = pg_fetch_array($resultcr_gl))  // main while loop 1 start
    {

echo $rate_sno = $rowcr_gl["rate_sno"];
echo " || ";

echo $no_paxs = $rowcr_gl["no_of_paxs"];
echo " || ";

echo $rate_date = $rowcr_gl["rate_date"];


	}

for($i=1; $i<=500; $i++){
echo " || ";
echo $f_rate_sno = $rate_sno+$i;

echo $sql = "insert into rates$s_hot_id ( rate_sno,room_id,no_of_paxs,rate_date,avialibility) values ( '$f_rate_sno', '$room_id', $no_paxs,  date '$rate_date' + integer '$i', '0')"; 
$result = pg_query($conn, $sql);

}

echo "<br>";

	}  // main while loop 1 end






?>