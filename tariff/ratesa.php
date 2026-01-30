<?

$filename = "rates.csv";

$id = fopen($filename, "r"); //open the file
while ($data = fgetcsv($id, filesize($filename))) //start a loop
$table[] = $data; //put each line into its own entry in the $table array
fclose($id);

$rcs= 27;
$rce= 31;
echo "<pre>";
for($i=$rcs-1;$i<$rce;$i++)
{
if($i==$rcs){
echo "--------------------------------------------------------<br>";
echo "Room type			Net	Sell	Extras<br>";
echo "--------------------------------------------------------<br>";
}
if($i==$rce-2){
echo "--------------------------------------------------------<br>";
}
if($table[$i+2][5]==SC){
echo "--------------------------------------------------------<br>";
}
if($table[$i][5]==SC){
echo "--------------------------------------------------------<br>";
}
echo $table[$i][1];
echo "		".$table[$i][2];
echo "	".$table[$i][3];
echo "	".$table[$i][4];
echo "<br>";
if($i==$rce-1){
echo "========================================================<br>";
}

}
echo "</pre>";

?> 
