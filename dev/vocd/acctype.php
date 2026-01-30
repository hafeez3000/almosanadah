<?

include("db.php");

$filename = "voctypes.csv";

$id = fopen($filename, "r"); //open the file
while ($data = fgetcsv($id, filesize($filename))) //start a loop
$table[] = $data; //put each line into its own entry in the $table array
fclose($id);


foreach($table as $row)
{
$a_old = $row[2];
$a_new = $row[1];
pg_query("update vocmast18 set voctype='$a_new',vcty=1 where voctype='$a_old' and vcty=0");
echo "updated" . $a_old . "to" . $a_new ; 
echo "<br>";
}


?> 
