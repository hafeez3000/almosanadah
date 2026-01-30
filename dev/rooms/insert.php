<?

include("db.php");

$sql = "insert into rooms ( room_sno,room_id,room_type,view_type,no_of_paxs "; 
$result = pg_query($sql);

if($result) {
echo "Record(s) inserted";
}
else{
echo "Error in instering";
}

?>