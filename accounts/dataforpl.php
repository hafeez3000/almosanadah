<?
include '../charts/charts.php';
$gtotcr = $_GET['income'];
$gtotdb = $_GET['expense'];

$chart [ 'chart_data' ] = array ( array ( "",    "Income", "Expenses" ),
                                  array ( "Region A",  $gtotcr , $gtotdb), );


$chart[ 'chart_grid_h' ] = array ( 'thickness'=>1 );
$chart[ 'chart_pref' ] = array ( 'rotation_x'=>60 );
$chart[ 'chart_rect' ] = array ( 'x'=>200, 'y'=>50, 'width'=>300, 'height'=>200, 'positive_alpha'=>5 );
$chart[ 'chart_transition' ] = array ( 'type'=>"spin", 'delay'=>.5, 'duration'=>2.0, 'order'=>"category" );
$chart[ 'chart_type' ] = "3d pie";

$chart[ 'chart_value' ] = array ( 'color'=>"000000", 'alpha'=>65, 'font'=>"arial", 'bold'=>true, 'size'=>20, 'position'=>"inside", 'prefix'=>"", 'suffix'=>"", 'decimals'=>0, 'separator'=>"", 'as_percentage'=>true );

$chart[ 'draw' ] = array ( array ( 'type'=>"text", 'color'=>"FFFFFF", 'alpha'=>10, 'size'=>30, 'x'=>-20, 'y'=>260, 'width'=>700, 'height'=>80, 'text'=>"SOHULAT AL-SAFAR UMRAH SERVICES\n Profit and Loss", 'h_align'=>"right", 'v_align'=>"middle" ),array ( 'type'=>"image", 'layer'=>"background", 'url'=>"../charts/graphics/logo.jpg", 'alpha'=>10, 'v_align'=>"middle",'h_align'=>"left", 'x'=>100, 'y'=>275 )) ;

$chart[ 'legend_label' ] = array ( 'layout'=>"horizontal", 'bullet'=>"circle", 'font'=>"arial", 'bold'=>true, 'size'=>14, 'color'=>"ffffff", 'alpha'=>85 );
$chart[ 'legend_rect' ] = array ( 'x'=>15, 'y'=>45, 'width'=>50, 'height'=>210, 'margin'=>10, 'fill_color'=>"ffffff", 'fill_alpha'=>10, 'line_color'=>"000000", 'line_alpha'=>0, 'line_thickness'=>1 );
$chart[ 'legend_transition' ] = array ( 'type'=>"dissolve", 'delay'=>0, 'duration'=>1 );
$chart[ 'series_color' ] = array ( "00ff88", "ffaa00" );
$chart[ 'series_explode' ] = array ( 5, 5 );


SendChartData($chart);
?>
