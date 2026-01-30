<?
$gtotcr = $_GET['income'];
$gtotdb = $_GET['expense'];




include("../charts/charts.php"); 

echo "<body><center>";

echo InsertChart ( "../charts/charts.swf", "../charts/charts_library", "dataforpl.php?income=".$gtotcr."&expense=".$gtotdb , "700","350" );

echo "</center></body>";
?>