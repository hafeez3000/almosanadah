<?

include("db.php");


$filename = "hotels.csv";



$rc=0;

$id = fopen($filename, "r"); //open the file
while ($data = fgetcsv($id, filesize($filename))) //start a loop
$table[] = $data; //put each line into its own entry in the $table array
fclose($id);



foreach($table as $row)
{
if($rc==0){
echo "<table width=\"100%\" border=\"1\">";
}


echo "<tr><td>$row[0]</td>";
if($row[4]=="Makkah"){
	$row[1]="11".$row[1];

}
elseif($row[4]=="Madinah"){
   $row[1]="12".$row[1];

}
elseif($row[4]=="Riyadh"){
	   $row[1]="13".$row[1];

}
elseif($row[4]=="Jeddah"){
		   $row[1]="14".$row[1];

}
elseif($row[4]=="Abha"){
		   $row[1]="19".$row[1];

}
elseif($row[4]=="Dammam"){
	   $row[1]="15".$row[1];

}
elseif($row[4]=="Khobar"){
		   $row[1]="20".$row[1];

}
elseif($row[4]=="Taif"){
		   $row[1]="16".$row[1];

}
elseif($row[4]=="Dharan"){
		   $row[1]="17".$row[1];

}
elseif($row[4]=="Jubail"){
		   $row[1]="23".$row[1];

}
elseif($row[4]=="Baha"){
		   $row[1]="25".$row[1];

}
elseif($row[4]=="Tabouk"){
		   $row[1]="21".$row[1];

}
elseif($row[4]=="Jizan"){
		   $row[1]="18".$row[1];

}



echo "<td>$row[1]</td>";


echo "<td>$row[2]</td>";
echo "<td>$row[3]</td>";
echo "<td>$row[4]</td>";
//echo "<td>$row[5]</td>";
//echo "<td>$row[6]</td>";
echo "<td>$row[7]</td></tr>";
$data = "$row[0],$row[1],$row[2],$row[3],$row[4]\n";
fwrite ($fp, $data);
$rc++;
}

fclose($fp);
?> 
</table>