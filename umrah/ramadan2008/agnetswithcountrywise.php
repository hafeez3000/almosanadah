<?
include ("header.php");

include ("prebal.php");

include ("aftbal.php");


?>

<script>
document.title= '<? echo $company_name . " ERP - Umrah Home"; ?>';
</script>

<html>
<head>
<script>
 var winl1 = (screen.width - 750) / 2; 
 var winl = (screen.width - 750) / 2; 
 var wint = (screen.height - 500) / 2;
</script>
</head>
<body leftmargin="0" topmargin="0" rightmargin="0">
<table width="100%" border="0" cellpadding="0" cellspacing="0" style="border-bottom: 1px solid #999999 ;border-left: 3px solid #006600;border-right: 3px solid #006600"><tr>
    <td bgcolor="#CCCCCC"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">&nbsp;You 
      are here: <a href="../uhome.php">Home</a> &raquo; </font></td>
  </tr></table>
  
<table width="100%" border="0" cellpadding="0" cellspacing="0" style="border-bottom: 3px solid #006600; border-right: 3px solid #006600;border-left: 3px solid #006600 ">
  <tr>
    <td width="100%" valign="top"  > <table width="100%" border="0" cellpadding="0" cellspacing="1">
        <tr>
          <td valign="top"> 
           
			

<?
  $sfdate = '2009-08-22';
 $stdate = '2009-09-20';

$fromd = $sfdate;
$tod = $stdate;
$nrc=1;

$fnrc =1;

$tot_c=0;
$tot_p=0;
$tot_b=0;

$b_ramadan = 0.0;
$a_ramadan = 0.0;




$forc_sql  = "CREATE TABLE rcw$suser_sno ( sno integer, account_code character varying(50),  aname character varying(255), country character varying(255), beforeramadan numeric, rcharges numeric, rpaid numeric, rbalance numeric, afterramadan numeric,   PRIMARY KEY (sno) ) ";
$forc_sql1 =  "ALTER TABLE rcw$suser_sno OWNER TO dorserp" ;


pg_query($conn, $forc_sql);
pg_query($conn, $forc_sql1);



 $query  = "SELECT cus_account_code from sales_hotels where cout between  date '$tod' - integer '30'  and '$tod' and cout > '$fromd' and ocode!='NC' and booking_status!='Cancelled' or  cin  between '$fromd' and '$tod' and ocode!='NC'  and booking_status!='Cancelled' or   cin between date '$tod' - integer '30' and '$tod' and  cout > '$tod' and ocode!='NC' and booking_status!='Cancelled' group by cus_account_code order by cus_account_code";

// group by cus_account_code

$result = pg_query($conn, $query);

$rowc = pg_num_rows($result);
//printf("Records selected: %d\n", mysql_affected_rows());

$ac=0;
$afd=array();
$atd=array();
$anofn=array();


$a_cc = array();

$apaid=array();

?>
  
      <?
while ($row = pg_fetch_array($result))
{ 

$a_cc[] = $row["cus_account_code"];

}



$nrc=1;
for($i=0; $i<count($a_cc); $i++){

$s_cus_ac = $a_cc[$i];

$query_sub  = "SELECT aname,scountry from agentsdet where acccode='$s_cus_ac'  ";

$result_sub = pg_query($conn, $query_sub);


while ($row_sub = pg_fetch_array($result_sub))
{
$c_name =  $row_sub["aname"];
$c_country =  $row_sub["scountry"];
}


?>
  
   


<?

 $query2  = "SELECT cus_account_code,sell_rate,cus_paid from sales_hotels where cout between  date '$tod' - integer '30'  and '$tod' and cout > '$fromd' and cus_account_code='$s_cus_ac' and ocode!='NC' and booking_status!='Cancelled' or  cin  between '$fromd' and '$tod' and cus_account_code='$s_cus_ac' and ocode!='NC'  and booking_status!='Cancelled' or   cin between date '$tod' - integer '30' and '$tod' and  cout > '$tod' and cus_account_code='$s_cus_ac' and ocode!='NC' and booking_status!='Cancelled' ";

// group by cus_account_code

$result2 = pg_query($conn, $query2);

$rowc2 = pg_num_rows($result2);

while ($row2 = pg_fetch_array($result2))
{ 

$s_r = $s_r + $row2["sell_rate"];

$p_a = $p_a + $row2["cus_paid"];

}
?>




	  
<?	  

$ASS="A";
$EXP="E";
$Li="L";
$Cap="C";

$fbaldb=0.0;
$fbalcr=0.0;


$accn =$s_cus_ac;

$acsno = 0;
$op_bal = " ";


 $fromd = '2009-08-22';
 $tod = '2009-09-20';

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





 if($fbaldb>0) {  $b_ramadan = $fbaldb; }

 else if($fbalcr>0){ $b_ramadan = -$fbalcr;}

else{ $b_ramadan = 0.0;}


$ASS="A";
$EXP="E";
$Li="L";
$Cap="C";

//$accn = "150405";

$accn =$s_cus_ac;

$fbaldb=0.0;
$fbalcr=0.0;

$acsno = 0;
$op_bal = " ";


 $fromd = '2009-08-22';
 $tod = '2009-09-20';


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




  if($fbaldb>0) {  $a_ramadan = $fbaldb; }

 else if($fbalcr>0){ $a_ramadan = -$fbalcr;}

else{ $a_ramadan = 0.0;}





$p_isql = "insert into rcw$suser_sno (sno,account_code,  aname, country, beforeramadan,rcharges,rpaid,rbalance,  afterramadan) values ( $nrc,'$s_cus_ac', '$c_name', '$c_country', $b_ramadan, $s_r,$p_a,$s_r-$p_a,  $a_ramadan )";
pg_query($conn, $p_isql);

$tot_c=$tot_c+$s_r;
$tot_p=$tot_p+$p_a;
$tot_b=$tot_b+$s_r-$p_a;

$p_a=0;
$s_r=0;	  
	  
	  $nrc++;

$b_ramadan = 0.0;
$a_ramadan = 0.0;
}




?>

<script>
function fun2(theForm){




 if ( (document.pnrdet.tdata.value== null) ||  ((document.pnrdet.tdata.value).length==0) ||  ((document.pnrdet.tdata.value).length<5))
   {
      alert ("Sorry, But enter pnr to find orders");
	  document.pnrdet.tdata.focus();
	  		return false;
   }




}
</script>
	



 <table border=1 cellpadding="2" cellspacing="0" align="center">
    <tr> 
      <td colspan="8"> <div align="center"> <font size="3" face="Arial, Helvetica, sans-serif"> 
          <?
  echo "DORS ERP 2.0 - Ramadan 2009 Balance Payment - All Agents Country Wise" ?>
          </font></div></td>
    </tr>
    <tr> 
      <td><div align="center"><font size="2" face="Arial, Helvetica, sans-serif">Sno</font></div></td>
      <td><div align="center"><font size="2" face="Arial, Helvetica, sans-serif">Travel 
          Agent</font></div></td>
      <td><div align="center"><font size="2" face="Arial, Helvetica, sans-serif">Country</font></div></td>
<td><div align="center"><font size="2" face="Arial, Helvetica, sans-serif">Before Ramadan</font></div></td>
	  <td><div align="center"><font size="2" face="Arial, Helvetica, sans-serif">Charges</font></div></td>
      <td><div align="center"><font size="2" face="Arial, Helvetica, sans-serif">Paid</font></div></td>
      <td><div align="center"><font size="2" face="Arial, Helvetica, sans-serif">Balance</font></div></td>
<td><div align="center"><font size="2" face="Arial, Helvetica, sans-serif">After Ramadan</font></div></td>
      
    </tr> 
<?php
$ford_sql = "select country, SUM(beforeramadan) as tot_beforeramadan, SUM(rcharges) as tot_rcharges, SUM(rpaid) as tot_rpaid, SUM(rbalance) as tot_rbalance, SUM(afterramadan)  as tot_afterramadan from rcw$suser_sno  group by country order by country ";
$fordresult = pg_query($conn, $ford_sql);
while ($fordrow = pg_fetch_array($fordresult))
	{

 $n_country = $fordrow["country"];
//echo $fordrow["tot_sum"];



$ford_sql1 = "select sno,account_code, aname,country,beforeramadan, rcharges, rpaid, rbalance, afterramadan from rcw$suser_sno where country= '$n_country'  ";
$fordresult1 = pg_query($conn, $ford_sql1);
while ($fordrow1 = pg_fetch_array($fordresult1))
	{
?>
<tr>
   <td><div align="center"><font size="2" face="Arial, Helvetica, sans-serif"><? echo $fnrc;?></font></div></td>
      <td><font size="2" face="Arial, Helvetica, sans-serif"><a href="agentwiseledger.php?agentacc=<? echo $fordrow1['account_code']; ?>" target="popa" onClick="window.open('','popa', 'width=750,height=500,menubar=yes,scrollbars=yes,status=no top='+wint+',left='+winl+' ')" ><? echo strtoupper($fordrow1['aname']); ?></a></font></td>
      <td><div align="center"><font size="2" face="Arial, Helvetica, sans-serif"><? echo $fordrow1['country']; ?></font></div></td>
<td><div align="center"><font size="2" face="Arial, Helvetica, sans-serif"><?  echo  number_format(round(($fordrow1['beforeramadan']*100/100),2), 2, "." , ","); ?></font></div></td>

<td><div align="center"><font size="2" face="Arial, Helvetica, sans-serif"><?  echo  number_format(round(($fordrow1['rcharges']*100/100),2), 2, "." , ","); ?></font></div></td>

<td><div align="center"><font size="2" face="Arial, Helvetica, sans-serif"><?  echo  number_format(round(($fordrow1['rpaid']*100/100),2), 2, "." , ","); ?></font></div></td>

<td><div align="center"><font size="2" face="Arial, Helvetica, sans-serif"><?  echo  number_format(round(($fordrow1['rbalance']*100/100),2), 2, "." , ","); ?></font></div></td>
<td><div align="center"><font size="2" face="Arial, Helvetica, sans-serif"><?  echo number_format(round(($fordrow1['afterramadan']*100/100),2), 2, "." , ","); ?></font></div></td>
</tr>



<?
$fnrc++;
   } 

?>

<tr><TD colspan="3" align="center">Total <? echo $n_country; ?> </TD>

<TD align="center"> <? echo number_format(round(($fordrow['tot_beforeramadan']*100/100),2), 2, "." , ","); ?> </TD>
<TD align="center"> <? echo number_format(round(($fordrow['tot_rcharges']*100/100),2), 2, "." , ","); ?> </TD>
<TD align="center"> <? echo number_format(round(($fordrow['tot_rpaid']*100/100),2), 2, "." , ","); ?> </TD>
<TD align="center"><? echo number_format(round(($fordrow['tot_rbalance']*100/100),2), 2, "." , ","); ?> </TD>
<TD align="center"> <? echo number_format(round(($fordrow['tot_afterramadan']*100/100),2), 2, "." , ","); ?> </TD>

</tr>

<tr><TD colspan="8">&nbsp;</TD></tr>
<?



}


$forc_sql0 =  "DROP TABLE rcw$suser_sno" ;
pg_query($conn, $forc_sql0);
?>


</table>
</td>
</table>
</body>				
</html>


