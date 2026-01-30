<?

$filename = "uploads/rates.csv";

$id = fopen($filename, "r"); //open the file
while ($data = fgetcsv($id, filesize($filename))) //start a loop
$table[] = $data; //put each line into its own entry in the $table array
fclose($id);

$hname = array();
$bfn = array();
$efn = array();

foreach($table as $row)
{


if($row[1]==BOH) {
$hname[] = $table[$row[0]][1];
$bfn[] = $table[$row[0]][0];
}

if($row[1]==EOH) {
$efn[] = $table[$row[0]-2][0] ;
}

}


?> 

<form name="rates" method="post" action="ratesata.php">
  <select name="hotel[]" MULTIPLE SIZE="5">

<?
for($i=0;$i<count($bfn);$i++){

echo "<option value=\"$bfn[$i]-$efn[$i]\">$hname[$i]</option>";

}

?>  

  </select>

  <input type="submit" name="Submit" value="Submit">
</form>
