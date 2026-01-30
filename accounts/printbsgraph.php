<?


$tot_assets = $_GET['assets'];
$tot_liabilities = $_GET['liabilities'];
$tot_profit = $_GET['netprofit'];
$tot_equity = $_GET['equity'];
$tot_lia_eq = $_GET['liaequ'];


include("../charts/charts.php"); 

echo "<body><center>";

echo InsertChart ( "../charts/charts.swf", "../charts/charts_library", "dataforbs.php?assets=".$tot_assets."&liabilities=".$tot_liabilities."&netprofit=".$tot_profit."&equity=".$tot_equity."&liaequ=".$tot_lia_eq , "700","400" );

echo "</center></body>";
?>