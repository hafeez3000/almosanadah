<?
include("db.php");

$filename = "agentsforaccounts.csv";

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


//echo
$r0=trim($row[0]);
//echo
	$r1=trim($row[1]);
//echo
	$asmsg = trim(safeAddSlashes($row[2]));
//echo
	$asmsg1 = trim(safeAddSlashes($row[3]));
//echo
	$r4=trim($row[4]);
//echo
	$r5=trim($row[5]);
//echo
	$r6=$row[6];
//echo
	$r7=$row[7];
//echo
	$r8=$row[8];

//echo "<br>";
 

//if($rc==1){
$sql = "insert into accmast(acc_sno,acccode,acc_name,acc_desc,parent_acc,acc_type,db_bal,cr_bal,op_bal) values ($r0,'$r1','$asmsg','$asmsg1','$r4','$r5',$r6,$r7,$r8)"; 
 // pg_query($sql);
  echo "One Record Inserted"." - ".$rc;
//}
$rc++;

}
echo "<br>";
echo $rc;
?> 
</table>