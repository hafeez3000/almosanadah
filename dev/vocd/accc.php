<?

include("db.php");

$filename = "tbs.csv";

$id = fopen($filename, "r"); //open the file
while ($data = fgetcsv($id, filesize($filename))) //start a loop
$table[] = $data; //put each line into its own entry in the $table array
fclose($id);


foreach($table as $row)
{

$a_old = $row[1];
$a_new = $row[9];
pg_query("update vocmast18 set acccode='$a_new',dech=1 where acccode='$a_old' and dech=0");
echo "updated" . $a_old;
echo "<br>";
}


?> 
