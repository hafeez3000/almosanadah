<?
include("db.php");

$filename = "rooms.csv";

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
$asmsg = safeAddSlashes($row[5]);
$sql = "insert into rooms(room_sno,room_id,room_type,view_type,no_of_paxs,room_description) values ($row[0],'$row[1]','$row[2]','$row[3]',$row[4],'$asmsg')"; 
      pg_query($sql);


}


?> 
</table>