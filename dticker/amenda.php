<?
function safeAddSlashes($string) 
{ 
 if (get_magic_quotes_gpc()) { 
   return $string; 
 } else { 
   return addslashes($string); 
 } 
} 


 $anewsh = safeAddSlashes($_POST['ntype']);
 $anewsd = safeAddSlashes($_POST['ndet']);

$fp = fopen ("news.csv", "w");

for($i=0; $i<count($anewsh);$i++){
echo $data = "$anewsh[$i],$anewsd[$i]\n";
fwrite ($fp, $data);
}

fclose($fp);
header('Location: amend.php');
?>