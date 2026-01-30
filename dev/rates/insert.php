<?
set_time_limit(900);        
include("db.php");

$dc=0;
$rc=1;
$room_id = "1110111";
$no_of_paxs = 1;
$rdate = '2006-01-01';

$querycr = "SELECT room_id, no_of_paxs from rooms order by room_id"; 
$resultcr = pg_query($querycr); 
if (!$resultcr) {
	echo "An error occured.\n";
	exit;
	}
while($rowcr = pg_fetch_array($resultcr))
    {

$room_id = $rowcr["room_id"];
$no_of_paxs = $rowcr["no_of_paxs"];


for ( $i=0; $i<365; $i++ ){
$sql = "insert into rates ( rate_sno,room_id,no_of_paxs,rate_date,avialibility,avial_bool) values ( $rc, '$room_id', $no_of_paxs,  date '$rdate' + integer '$i', '10', 'true')"; 
$result = pg_query($sql);

if($result) {
flush();
ob_flush();
echo "Record(s) inserted";
}
else{
flush();
ob_flush();
echo "Error in instering";
}
$rc++;
}

}
?>