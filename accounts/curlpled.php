<?php

$ch = curl_init(); //curl_init("http://localhost/dorsERP/accounts/printledger.php?acc=150004&fd=2006-07-19&td=2006-07-26");
//$ch = curl_init("http://localhost/dorsERP/accounts/index.php");

curl_setopt($ch,CURLOPT_URL,"http://localhost/dorsERP/accounts/printledgeragents.php");
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch,CURLOPT_POSTFIELDS,"acc=150004&fd=2006-07-01&td=2006-07-26");
curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);

$fp = fopen("agentsledger.html", "w");

curl_setopt($ch, CURLOPT_FILE, $fp);
curl_setopt($ch, CURLOPT_HEADER, 0);

$result = curl_exec($ch);
curl_close($ch);
fclose($fp);


?> 