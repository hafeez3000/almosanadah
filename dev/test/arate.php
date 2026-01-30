<?
$s_date = array();
$s_rate = array();
$s_rate_u = array();
$s_final = array();


$s_date[0] = "2006-02-01";
$s_date[1] = "2006-02-02";
$s_date[2] = "2006-02-03";
$s_date[3] = "2006-02-04";
$s_date[4] = "2006-02-05";
$s_date[5] = "2006-02-06";
$s_date[6] = "2006-02-07";
$s_date[7] = "2006-02-08";
$s_date[8] = "2006-02-09";
$s_date[9] = "2006-02-10";

$s_rate[0] = 500;
$s_rate[1] = 500;
$s_rate[2] = 500;
$s_rate[3] = 500;
$s_rate[4] = 500;
$s_rate[5] = 700;
$s_rate[6] = 700;
$s_rate[7] = 700;
$s_rate[8] = 500;
$s_rate[9] = 500;

$s_rate_u = $s_rate;

array_multisort($s_rate, $s_date);
$k=0;
for($i=0; $i<count($s_rate) ; $i++){
$s_final[current($s_rate)][$k] = $s_date[$i];
$k++;
if($s_rate[$i] != next($s_rate)){
$k=0;
}
}

echo "<br>";

print_r($s_final);


$s_rate_u = array_unique($s_rate_u);
sort($s_rate_u);

echo "<br>";

print_r($s_rate_u);

echo "<br>";


for($i=0; $i<count($s_rate_u); $i++){
$sv_final = $s_rate_u[$i];
$p=1;
for($j=0; $j<count($s_final[$sv_final]); $j++){
//$sv_final;
//$s_final[$sv_final][$j]; 
$a = $s_final[$sv_final][$j]; 
$b = $s_final[$sv_final][$j]; 
$c="";
if($p==1){
echo $c = date('j', strtotime($b)) ;
}

if( date('j', strtotime($a))+1 != date('j', strtotime(next($s_final[$sv_final]))) ){

if($c== date('j', strtotime($b)) ){
//echo ",";
}
else{
echo "-";
echo date('j', strtotime($b)) ;
echo ",";
}
$p=1;

}
else{
$p=0;

}


}

echo "<br>";
}

echo "<br>";

$s_rate_u=0;

print_r($s_rate_u);




?>