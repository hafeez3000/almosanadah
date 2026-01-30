<?

include("db.php");


$filename = "vocmastold.csv";

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
$narration = safeAddSlashes($row[5]);
$narration1 = safeAddSlashes($row[8]);
if($narration==$narration1){ }
else { $narration = $narration . $narration1 ; }

$more_det = safeAddSlashes($row[9]);

if($more_det==""){}

else {
$g_city =  safeAddSlashes($row[10]);
if($g_city==""){ } else { $more_det = "Hotel: " .$more_det . "," . $g_city;}

$g_cin =  safeAddSlashes($row[11]);
if($g_cin==""){ } else { $more_det = $more_det . " - C.In:" . $g_cin;}

$g_cout =  safeAddSlashes($row[12]);
if($g_cout==""){ } else { $more_det = $more_det . " - C.Out:" . $g_cout;}

$g_noofr =  safeAddSlashes($row[14]);
$g_viewt =  safeAddSlashes($row[15]);

$g_rt =  safeAddSlashes($row[13]);
if($g_cout==""){ } else { $more_det = $more_det . " - RoomType:" . $g_noofr ."X". $g_rt ." " .$g_viewt;}

$g_gvo =  safeAddSlashes($row[18]);
if($g_gvo==""){ } else { $more_det = $more_det . " - GVOU:" . $g_gvo;}


}  // end of more_det chk

$s_iref =  safeAddSlashes($row[17]);



 $sql = "insert into vocmast18(voctype,vocno,vocdate,acccode,narration,moredet,supp_inv,vocseq,recon,dbamt,cramt) values ('$row[0]','$row[1]','$row[2]','$row[3]','$narration','$more_det','$s_iref',$rc,'f',$row[6],$row[7])"; 
      pg_query($sql);

echo $rc++;
echo "<br>";  

}


?> 
