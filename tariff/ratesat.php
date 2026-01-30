<STYLE type="text/css">
TD  { 
	    text-align:center;
		font-family: Verdana, Arial, Helvetica, sans-serif;
    	font-size: 12px;
	  }
</STYLE>
<?

$filename = "rates.csv";

$id = fopen($filename, "r"); //open the file
while ($data = fgetcsv($id, filesize($filename))) //start a loop
$table[] = $data; //put each line into its own entry in the $table array
fclose($id);

$rcs= 2;
$rce= 15;

echo "<table border=\"1\" cellspacing=\"0\" cellpadding=\"2\">";
for($i=$rcs-1;$i<$rce;$i++)
{
if($i==$rcs){
echo "<tr><td bgcolor=\"#CCCCCC\">Room Type</td><td bgcolor=\"#CCCCCC\">Net Rate</td><td bgcolor=\"#CCCCCC\">Sell Rate</td><td bgcolor=\"#CCCCCC\">Extras</td></tr>";
}

echo "<tr><td>" .$table[$i][1] . "&nbsp;</td>";
echo "<td>" .$table[$i][2] . "&nbsp;</td>";
echo "<td>" .$table[$i][3] . "&nbsp;</td>";
echo "<td>" .$table[$i][4] . "&nbsp;</td></tr>";

}
echo "<table>";

?> 
