<html>
<head><title>DORS ERP 2.0 - Hajj 2009 Payment Ledger</title>


</head>
<body>
<center>


  <?php
include("../../db/db.php");

$bpaid=0;
$nrc=1;
 

// $hotelid = $_GET["hotid"];
// $fromd = $_GET["fdate"];
// $tod = $_GET["fdate"];

 $agentacc = $_GET["agentacc"];
 $agentname = "";
 $agentemail="";
 $agentcountry="";
 
 $sfdate = '2009-11-08';
 $stdate = '2009-12-07';

$fromd = $sfdate;
$tod = $stdate;

 $bal1=0;
 $bal2=0;
 $bal3=0;
 $pay1=0;
 $pay2=0;

 $hotelid="";

$agentsql ="select aname, country, email from agentsdet where acccode='$agentacc'";

$aresult = pg_query($conn, $agentsql);

while ($arow = pg_fetch_array($aresult))
{ 
 $agentname = $arow["aname"];
  $agentemail=$arow["email"];
 $agentcountry=$arow["country"];

}



//$query  = "SELECT t1.ocode,t1.gtitle,t1.gname,t1.cin, t1.cout, t1.refcname, t1.refacc, t1.acountry, t1.noofrooms, t1.orderdate, t1.status, t1.paid, t1.optdate, t1.esdate,t1.hotelid, t2.gtp, t2.bamount,  now() as sd from orderhotel as t1, ordermain as t2 where (t1.cout between DATE_SUB('$tod', INTERVAL 30 DAY) and '$tod' and t1.cout > '$fromd' and t1.gname IS NOT NULL and occp!=2  and t1.ocode=t2.ocode and t1.refacc='$agentacc' and t1.status!='Cancelled') or  (t1.cin  between '$fromd' and '$tod' and t1.gname IS NOT NULL  and t1.occp!=2  and t1.ocode=t2.ocode and t1.refacc='$agentacc' and t1.status!='Cancelled') or  ( t1.cin between DATE_SUB('$tod', INTERVAL 30 DAY) and '$tod' and  t1.cout > '$tod' and t1.gname IS NOT NULL  and t1.occp!=2  and t1.ocode=t2.ocode and t1.refacc='$agentacc' and t1.status!='Cancelled')  group by t1.ocode order by t1.orderdate";

$query  = "SELECT t1.ocode,t1.cin, t1.cout, t1.no_rooms, t1.order_date, t1.booking_status, t1.cus_paid, t1.option_date, t1.hotel_id, t1.sell_rate,t2.guest_title,t2.guest_name,t2.cus_company_name,t2.cus_country,  now() as sd from sales_hotels as t1, sales_main as t2 where cout between  date '$tod' - integer '30'  and '$tod' and cout > '$fromd' and t1.cus_account_code='$agentacc' and t1.ocode!='NC' and t1.booking_status!='Cancelled' and t1.ocode=t2.ocode or  cin  between '$fromd' and '$tod' and t1.cus_account_code='$agentacc' and t1.ocode!='NC'  and t1.booking_status!='Cancelled' and t1.ocode=t2.ocode or   cin between date '$tod' - integer '30' and '$tod' and  cout > '$tod' and t1.cus_account_code='$agentacc' and t1.ocode!='NC' and t1.booking_status!='Cancelled' and t1.ocode=t2.ocode order by t1.order_date";


$result = pg_query($conn, $query);

$rowc = pg_num_rows($result);
//printf("Records selected: %d\n", mysql_affected_rows());

$ac=0;
$afd=array();
$atd=array();
$anofn=array();

$apaid=array();
?>
  <table border=1 cellpadding="2" cellspacing="0">
    <tr bgcolor="#D4D4D4"> 
      <td colspan="10"><div align="center"> <font size="3" face="Arial, Helvetica, sans-serif">  
          <?
  echo "DORS - Hajj 2009 Payment Ledger<br>" . $agentname . ", " . $agentcountry . " Email: " . $agentemail?>
          </font></div></td>
    </tr>
    <tr> 
      <td><div align="center"><font size="2" face="Arial, Helvetica, sans-serif">Sno</font></div></td>
      <td><div align="center"><font size="2" face="Arial, Helvetica, sans-serif">Date</font></div></td>
      <td><div align="center"><font size="2" face="Arial, Helvetica, sans-serif">PNR</font></div></td>
      <td><div align="center"><font size="2" face="Arial, Helvetica, sans-serif">Guest 
          Name</font></div></td>
	<td><div align="center"><font size="2" face="Arial, Helvetica, sans-serif">C/in</font></div></td>
		  <td><div align="center"><font size="2" face="Arial, Helvetica, sans-serif">C/Out</font></div></td>
      <td>
	  <div align="center"><font size="2" face="Arial, Helvetica, sans-serif">Hotel 
          Name</font></div></td>
      <td><div align="right"><font size="2" face="Arial, Helvetica, sans-serif">Credits</font></div></td>
      <td><div align="right"><font size="2" face="Arial, Helvetica, sans-serif">Charges</font></div></td>
      <td><div align="right"><font size="2" face="Arial, Helvetica, sans-serif">Balance</font></div></td>
    <tr> 
      <?
while ($row =  pg_fetch_array($result))
{ 
?>
     <? if($bpaid!=$row["cus_paid"]){ $pay2=$pay2-$row["cus_paid"]; echo "<tr><td colspan=7>&nbsp;</td><td><div align=right><font size=2 face=Arial, Helvetica, sans-serif>" . number_format($pay2, 2,'.', ',')
		 ."</td><td>&nbsp;</td><td>&nbsp;</font></div></td></tr>" ;  $pay1=$pay1+$pay2;}
	
	?>

	<tr> 
      <td><div align="center"><font size="2" face="Arial, Helvetica, sans-serif"><?echo $nrc;?></font></div></td>
      <td><font size="2" face="Arial, Helvetica, sans-serif"><? echo date( 'd-M' , strtotime($row["order_date"])) ;?></font></td>



	    	<td ><font size="2" face="Arial, Helvetica, sans-serif"><a href="../pnrdet.php?spnr=<?echo $row["ocode"];?>" target='<?echo $row["ocode"];?>' onClick="window.open('','<?echo $row["ocode"];?>', 'scrollbars=yes, width='+(screen.width-10)+' , height='+(screen.height-50)+' , left=0,top=0 ').focus()"  ><?echo $row["ocode"];?></a></font></td>

      <td><font size="2" face="Arial, Helvetica, sans-serif"><? echo $row["guest_title"] .". ". strtoupper($row["guest_name"]);?></font></td>
<td><font size="2" face="Arial, Helvetica, sans-serif"><? echo date( 'd-M' , strtotime($row["cin"]));?></font></td>
<td><font size="2" face="Arial, Helvetica, sans-serif"><? echo date( 'd-M' , strtotime($row["cout"]));?></font></td>
      <td><font size="1" face="Arial, Helvetica, sans-serif"> 
        <? 
      $hotelid = $row["hotel_id"];	  
	  $hquery = "select hotel_name from hotels where hotel_id='$hotelid' ";
	  $hresult = pg_query($conn, $hquery);
      while ($hrow = pg_fetch_array($hresult))
	  {
	   echo strtoupper($hrow["hotel_name"]);
	  }	  
?>
        </font></td>
      <td><font size="2" face="Arial, Helvetica, sans-serif">&nbsp;</font></td>
      <? if($bpaid==$row["cus_paid"] || $pay2>-$row["sell_rate"]){ echo "<td bgcolor=\"#FFE1E1\"><div  align=\"right\"><font color=\"#FF0000\" size=\"2\" face=\"Arial, Helvetica, sans-serif\">" . number_format($row["sell_rate"], 2,'.', ',') ."</font></div></td>" ; }

	  else {
	   
		echo "<td><div align=\"right\"><font size=\"2\" face=\"Arial, Helvetica, sans-serif\">" . number_format($row["sell_rate"], 2,'.', ',') ."</font></div></td>" ; }
	  ?>

      <td><div align="right"><font size="2" face="Arial, Helvetica, sans-serif"> 
          <? $bal1=$bal1+$row["sell_rate"]; $bal2=$bal2+$bal1;  $bal3=$bal3+$bal1+$pay2 ; echo number_format($bal3, 2,'.', ',') ; $pay2=0;  $bal1=0;?>
          </font></div></td>
    </tr>
   
    <?
$nrc++;
$ac++;
//$i++;
}
?>

    <tr bgcolor="#EFEFEF"> 
      <td colspan="7"><div align="left"><font size="2" face="Arial, Helvetica, sans-serif">Total 
          Credits and Charges in Saudi Riyals</font></div></td>
      <td> <div align="right"><font size="2" face="Arial, Helvetica, sans-serif"><strong><font color="#000000"><? echo number_format($pay1, 2,'.', ',');  ?></font></strong></font></div></td>
      <td> <div align="right"><font size="2" face="Arial, Helvetica, sans-serif"><strong><font color="#000000"><? echo number_format($bal2, 2,'.', ',') ; ?></font></strong></font></div></td>
      <td> <div align="center"><font size="2" face="Arial, Helvetica, sans-serif"><strong>&nbsp;</strong></font></div></td>
    </tr>
    <tr bgcolor="#D4D4D4"> 
      <td colspan="9" bgcolor="#D4D4D4"> <div align="left"><font size="2" face="Arial, Helvetica, sans-serif"><strong>Outstanding 
          Balance in Saudi Riyals</strong></font></div></td>
      <td><div align="right"><strong><font color="#000000" size="2" face="Arial, Helvetica, sans-serif"><? echo number_format($bal3, 2,'.', ',') ; ?></font></strong></div></td>
    </tr>
  </table>


</center>
</body>
</html>