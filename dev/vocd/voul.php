<?

include("db.php");


$array_voctype = array();


$query_hotel ="select acccode from accmast order by acccode";

$result_hotel = pg_query($query_hotel);

if (!$result_hotel) {
	echo "An error occured.\n";
	exit;
	}
while ($rows_hotel = pg_fetch_array($result_hotel)){

$array_voctype[] = $rows_hotel["acccode"];

}

pg_free_result($result_hotel);


for($i=0;$i<count($array_voctype);$i++){



$query_voc ="delete from vocmast where acccode='$array_voctype[$i]' ";
$j=1;
$result_voc = pg_query($query_voc);

if (!$result_voc) {
	echo "An error occured.\n";
	exit;
	}
while ($rows_voc = pg_fetch_array($result_voc)){


echo "deleted";


}

}


?> 
