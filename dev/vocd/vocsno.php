<?

include("db.php");


$array_voctype = array();
$array_vocno = array();

$query_hotel ="select voctype,vocno from vocmast18 group by voctype,vocno";

$result_hotel = pg_query($query_hotel);

if (!$result_hotel) {
	echo "An error occured.\n";
	exit;
	}
while ($rows_hotel = pg_fetch_array($result_hotel)){

$array_voctype[] = $rows_hotel["voctype"];
$array_vocno[] = $rows_hotel["vocno"];
}

pg_free_result($result_hotel);


for($i=0;$i<count($array_voctype);$i++){
echo $i ;
echo " - ";
echo $array_voctype[$i] ;
echo " - ";
echo $array_vocno[$i] ;
echo "<br>";


$query_voc ="select voctype,vocno,vocseq from vocmast18 where voctype='$array_voctype[$i]' and  vocno='$array_vocno[$i]' ";
$j=1;
$result_voc = pg_query($query_voc);

if (!$result_voc) {
	echo "An error occured.\n";
	exit;
	}
while ($rows_voc = pg_fetch_array($result_voc)){

$voc_seq = "";

$voc_type ="";

$voc_no= "";


echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" ;
echo $j ;
echo " - ";
echo $voc_seq = $rows_voc["vocseq"];
echo " - ";
echo $voc_type =$rows_voc["voctype"];
echo " - ";
echo $voc_no= $rows_voc["vocno"];
echo "<br>";

pg_query("update vocmast18 set vocsno=$j where voctype='$voc_type' and vocno='$voc_no' and vocseq=$voc_seq");

$j++;
}

}


?> 
