<?
include '../charts/charts.php';

$tot_assets = $_GET['assets'];
$tot_liabilities = $_GET['liabilities'];
$tot_profit = $_GET['netprofit'];
$tot_equity = $_GET['equity'];
$tot_lia_eq = $_GET['liaequ'];

$chart[ 'axis_value' ] = array (  'font'=>"arial", 'bold'=>true, 'size'=>14, 'color'=>"000000", 'alpha'=>50, 'steps'=>5, 'prefix'=>"", 'suffix'=>"", 'decimals'=>0, 'separator'=>"");

$chart[ 'axis_category' ] = array ( 'font'=>"arial", 'bold'=>true, 'size'=>14, 'color'=>"000000", 'alpha'=>50, 'steps'=>5, 'prefix'=>"", 'suffix'=>"", 'decimals'=>0, 'separator'=>"" );


$chart [ 'chart_data' ] = array ( array (  "", "Assets", "Liabilities" , "Net Profit" ,"Equity","Liabilities+Equity"),array ( "", $tot_assets  ,  $tot_liabilities, $tot_profit ,$tot_equity,$tot_lia_eq) );

$chart[ 'chart_value' ] = array ( 'color'=>"ffffff", 'alpha'=>85, 'font'=>"arial", 'bold'=>true, 'size'=>10, 'position'=>"middle", 'prefix'=>"", 'suffix'=>"", 'decimals'=>0, 'separator'=>"", 'as_percentage'=>false );

//$chart[ 'draw' ] = array ( array ( 'type'=>"image", 'layer'=>"background", 'url'=>"../charts/graphics/logo120.jpg", 'alpha'=>10, 'x'=>0, 'y'=>0, 'width'=>120, 'height'=>120 )) ;

$chart[ 'draw' ] = array ( array ( 'type'=>"text", 'color'=>"FFFFFF", 'alpha'=>10, 'size'=>30, 'x'=>-20, 'y'=>1, 'width'=>700, 'height'=>80, 'text'=>"SOHULAT AL-SAFAR UMRAH SERVICES\n Balance Sheet", 'h_align'=>"right", 'v_align'=>"middle" ),array ( 'type'=>"image", 'layer'=>"background", 'url'=>"../charts/graphics/logo.jpg", 'alpha'=>10, 'h_align'=>"left", 'x'=>100, 'y'=>3 )) ;


$chart [ 'legend_rect' ] = array ( 'x'=>-1000 , 'y'=>-1000 );

$chart[ 'chart_transition' ] = array ( 'type'=>"scale", 'delay'=>.5, 'duration'=>.5, 'order'=>"category" );

$chart[ 'series_gap' ] = array ( 'set_gap'=>40, 'bar_gap'=>-25 );

$chart [ 'series_switch' ] = true;





SendChartData($chart);
?>
