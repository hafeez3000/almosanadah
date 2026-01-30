



<STYLE type="text/css">


TABLE{
 border-collapse: collapse  ;
 border: 1px solid black;

}

TD  { 
	    text-align:center;
		font-family: Verdana, Arial, Helvetica, sans-serif;
    	font-size: 12px;
	  }
</STYLE>

<center>

<?

 $photel = $_POST['hotel'];




$filename = "uploads/rates.csv";

$id = fopen($filename, "r"); //open the file
while ($data = fgetcsv($id, filesize($filename))) //start a loop
$table[] = $data; //put each line into its own entry in the $table array
fclose($id);

foreach($photel as $row){

 $ephotel = explode("-",$row);


 $rcs= $ephotel[0];
 $rce= $ephotel[1];

echo "<table border=\"1\" cellspacing=\"0\" cellpadding=\"2\" width=\"95%\">";
for($i=$rcs-1;$i<$rce;$i++)
{
if($i==$rcs){
echo "<tr><td style=\"border-right: 1px solid black;border-bottom: 1px solid #666666;\">Room Type</td><td style=\"border-right: 1px solid black;border-bottom: 1px solid #666666;\">Net Rate</td><td style=\"border-right: 1px solid black;border-bottom: 1px solid #666666;\">Sell Rate</td><td style=\"border-right: 1px solid black;border-bottom: 1px solid #666666;\">Extras</td></tr>";
}

if($i==$rcs-1){
echo "<tr><td colspan=\"4\" style=\"border-bottom: 1px solid black;\" bgcolor=\"#EFEFEF\"><b>" .$table[$i][1] . "</b>&nbsp;</td>";
}
else {
echo "<tr><td style=\"border-right: 1px solid black;\">" .$table[$i][1] . "&nbsp;</td>";
echo "<td style=\"border-right: 1px solid black;\">" .$table[$i][2] . "&nbsp;</td>";
echo "<td style=\"border-right: 1px solid black;\">" .$table[$i][3] . "&nbsp;</td>";
echo "<td style=\"border-right: 1px solid black;\">" .$table[$i][4] . "&nbsp;</td></tr>";
}


}
echo "<table>";

echo "<br>";
}
?> 

</center>
