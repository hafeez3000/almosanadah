<?
include("db.php");

$filename = "hotelsforres.csv";

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

//echo $row[0];
echo "<br>";


//if($rc==1){
$updatesql = "update hotels set account_code='$row[0]' where hotel_id='$row[1]'";
//$sql = "insert into accmast(acc_sno,acccode,acc_name,acc_desc,parent_acc,acc_type,db_bal,cr_bal,op_bal) values ($row[0],'$row[1]','$asmsg','$asmsg1','$row[4]','$row[5]',$row[6],$row[7],$row[8])"; 
//pg_query($sql);

//pg_query($updatesql);
//  echo "One Record Inserted";

echo "One Record Updated";
//}
$rc++;

}
echo "<br>";
echo $rc;
?> 
</table>