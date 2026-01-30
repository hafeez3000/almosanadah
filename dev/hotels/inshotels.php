<?
include("db.php");

$filename = "hotels.csv";

function safeAddSlashes($string) 
{ 
 if (get_magic_quotes_gpc()) { 
   return $string; 
 } else { 
   return addslashes($string); 
 } 
} 

$id = fopen($filename, "r"); //open the file
while ($data = fgetcsv($id, filesize($filename))) //start a loop
$table[] = $data; //put each line into its own entry in the $table array
fclose($id);

foreach($table as $row)
{
$asmsg = safeAddSlashes($row[6]);
$sql = "insert into hotels(hotel_sno,hotel_id,hotel_name,hotel_type,city,hotel_desc,hotel_image) values ($row[0],'$row[1]','$row[2]','$row[4]','$row[5]','$asmsg','$row[7]')"; 
      pg_query($sql);


}


?> 
</table>