<?php


function Prebal($s_cus_ac){

$ASS="A";
$EXP="E";
$Li="L";
$Cap="C";

//$accn = "150405";

$accn =$s_cus_ac;

$acsno = 0;
$op_bal = " ";

$fromd = '2010-01-01';
$tod = '2010-08-11';

$query = "select acccode,acc_name,op_bal,acc_type from accmast where acccode='$accn' order by acccode";

 $result = pg_query($conn, $query);
 $nrows = pg_num_rows($result);

while ($row = pg_fetch_array($result))
{ 
$acccode = $row["acccode"];
$acc_name = $row["acc_name"];

$op_bal = $row["op_bal"];

$acc_type = $row["acc_type"];

$acsno++;
}


$totquery = "select  SUM(dbamt) as totdb, SUM(cramt) as totcr from vocmast where acccode= '$accn' and vocdate between '$fromd' and '$tod' ";
$totresult = pg_query($conn, $totquery);
while ($totrow = pg_fetch_array($totresult))
	{

		$copbal = 	$op_bal;
   //    $copbal = floatval($aopbal[$i]);
 	   $ctotdb = floatval($totrow["totdb"]);
 	   $ctotcr = floatval($totrow["totcr"]);
   
       
     if($ASS==$acc_type || $EXP==$acc_type){
       $baldb = $copbal + $ctotdb - $ctotcr ;
		
   
	   }
	   else{
			$baldb = $copbal - $ctotdb + $ctotcr ;

	 	}  

		     if($ASS==$acc_type || $EXP==$acc_type){

            if ($baldb<0) { $fbaldb = 0.0; $fbalcr = abs($baldb);}
			if ($baldb>0) {  $fbalcr = 0.0; $fbaldb = $baldb;} }
			else 
		         { 

            if ($baldb<0) { $fbaldb = abs($baldb); $fbalcr = 0.0;}
			if ($baldb>0) {  $fbalcr = $baldb; $fbaldb = 0.0;} 
			}


}





 if($fbaldb>0) { echo number_format(round(($fbaldb*100/100),2), 2, "." , ","); }

 else if($fbalcr>0){echo "-" . number_format(round(($fbalcr*100/100),2), 2, "." , ",");}

else{echo "0.00";}
}


?>
