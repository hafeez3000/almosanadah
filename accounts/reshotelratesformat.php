<?
include("../db/db.php"); 
?>
<script>
document.title= '<? echo $company_name . " ERP - Umrah - Reservation Individual Rates Entry"; ?>';
</script>

<html>

<head>

</head>
<body leftmargin="0" topmargin="0" rightmargin="0" >

<?

$s_hotelsb = $_GET["hotid"];
$array_rooms = array();
$array_room_id = array();


$query_rooms ="select room_id, room_type,view_type,no_of_paxs,room_description from rooms where room_id like '$s_hotelsb%' order by room_id";

$result_rooms = pg_query($conn, $query_rooms);

if (!$result_rooms) {
	echo "An error occured.\n";
	exit;
	}
while ($rows_rooms = pg_fetch_array($result_rooms)){

$array_rooms[] = $rows_rooms["room_type"];
$array_room_id[] = $rows_rooms["room_id"];
}

for($ac=0; $ac<count($array_room_id); $ac++){

$inco = $array_room_id[$ac];

$del_str = "delete from res_rates where room_id='$inco'";

pg_query($conn, $del_str);

}

echo "Hotel Rates are formated";

?>


</body>				
</html>
