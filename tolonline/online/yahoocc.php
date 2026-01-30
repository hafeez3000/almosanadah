<?php

function yahoocc($currFrom, $currTo){

$us_price = '1';
$ticker= $currTo.$currFrom.'=X';
$open = fopen("http://quote.yahoo.com/d/quotes.csv?s=$ticker&f=sl1d1t1c1ohgv&e=.csv", "r");
$exchange_rate = fread($open, 2000);
fclose($open);
$exchange_rate = str_replace("\"", "", $exchange_rate);
$exchange_rate = explode(",", $exchange_rate);
$ca_price = ($us_price/$exchange_rate[1]);
//$price = $ca_price;
//$price = number_format ($ca_price, 2);
return $ca_price;
}

//echo "$us_price US dollars = \$$price Canadian dollars";

//echo yahoocc(INR, SAR);


?> 
