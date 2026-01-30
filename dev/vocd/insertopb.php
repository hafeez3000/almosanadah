<?

include("db.php");


$array_newacc = array();
$array_opbal = array();

$query_hotel ="select newacc,opbal from tbs order by newacc";

$result_hotel = pg_query($query_hotel);

if (!$result_hotel) {
	echo "An error occured.\n";
	exit;
	}
while ($rows_hotel = pg_fetch_array($result_hotel)){

$array_newacc[] = $rows_hotel["newacc"];
$array_opbal[] = $rows_hotel["opbal"];
}

pg_free_result($result_hotel);


for($i=0; $i<count($array_newacc); $i++){

echo $s_na = $array_newacc[$i];
echo " - ";
echo $s_opb = $array_opbal[$i];
echo "<br>";

pg_query("update accmast set op_bal=$s_opb where acccode='$s_na' ");
}


?> 
