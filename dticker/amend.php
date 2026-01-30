<center>
<?

$filename = "news.csv";

$id = fopen($filename, "r"); //open the file
while ($data = fgetcsv($id, filesize($filename))) //start a loop
$table[] = $data; //put each line into its own entry in the $table array
fclose($id);

?>

<form name="changep" method="post" action="amenda.php" onsubmit="return val(this)">

<?
foreach($table as $row)
{


echo "News Head<input type=\"text\" name=\"ntype[]\" maxlength=\"12\" size=\"12\" value=\"$row[0]\"> ";
echo " News Details<input type=\"text\" name=\"ndet[]\" maxlength=\"100\" size=\"60\" value=\"$row[1]\">";

echo "<br>";	       

}

?>

<input type="submit" name="submit" value="Amend">
</form>

</center>