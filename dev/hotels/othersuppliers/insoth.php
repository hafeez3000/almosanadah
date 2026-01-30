<?
include("db.php");

$filename = "foros.csv";

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

$rc=1;


foreach($table as $row)
{

 $asmsg = trim(safeAddSlashes($row[2]));
$asmsg1 = trim(safeAddSlashes($row[3]));

//echo "<br>";

//if($rc==1){
$sql = "insert into accmast(acc_sno,acccode,acc_name,acc_desc,parent_acc,acc_type,db_bal,cr_bal,op_bal) values ($row[0],'$row[1]','$asmsg','$asmsg1','$row[4]','$row[5]',$row[6],$row[7],$row[8])"; 
// pg_query($sql);
//  echo "One Record Inserted";
//}
$rc++;

}
echo "<br>";
echo $rc;
?> 
</table>