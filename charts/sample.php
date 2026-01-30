<?
include 'charts.php';
$chart [ 'chart_type' ] = "3d pie";
$chart [ 'chart_data' ] = array ( array ( "",         "2001", "2002", "2003", "2004" ),
                                  array ( "Region A",     5,     10,     30,     63  ),
                                  array ( "Region B",   100,     20,     65,     55  ),
                                  array ( "Region C",    56,     21,      5,     90  )
                                );
SendChartData($chart);
?>