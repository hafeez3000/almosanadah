<?

$filename = "spr.csv";




$s_rows = $_POST["it_val"];

$fp = fopen($filename, "w"); //open the file
$data = " ";
fwrite ($fp, $data);
fclose($fp);

$fp2 = fopen($filename, "a"); //open the file

for ($i=1; $i<$s_rows; $i++){

$s_sno =  $_POST["sno".$i];
$s_spon =  $_POST["spon".$i];
$s_hotels =  $_POST["hotels".$i];
$s_links =  $_POST["links".$i];

$data2 = $s_sno.",".$s_spon.",".$s_hotels.",".$s_links."\n";
fwrite ($fp2, $data2);

}

fclose($fp2);


	echo "<center>Habibi!  Special Offers has been send successfull!</center>";

	echo "<script>setTimeout('self.close()',1000);</script>";

?>