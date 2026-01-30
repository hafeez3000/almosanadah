<?
include ("header.php");

include ("hajjprebal.php");

include ("hajjaftbal.php");

$r_totbal_f =0.0;
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
           
			
    <td width="100%" valign="top"  >
<?
  
 $sfdate = '2009-11-08';
 $stdate = '2009-12-07';

$fromd = $sfdate;
$tod = $stdate;
$nrc=1;

$tot_c=0;
$tot_p=0;
$tot_b=0;

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
  <table border=1 cellpadding="2" cellspacing="0" align="center">
    <tr> 
      <td colspan="8"> <div align="center"> <font size="3" face="Arial, Helvetica, sans-serif"> 
          <?
  echo "DORS ERP 2.0 - Hajj 2009 Balance Payment - All Agents wise List" ?>
          </font></div></td>
    </tr>
    <tr> 
      <td><div align="center"><font size="2" face="Arial, Helvetica, sans-serif">Sno</font></div></td>
      <td><div align="center"><font size="2" face="Arial, Helvetica, sans-serif">Travel 
          Agent</font></div></td>
      <td><div align="center"><font size="2" face="Arial, Helvetica, sans-serif">Country</font></div></td>
<td><div align="center"><font size="2" face="Arial, Helvetica, sans-serif">Before Hajj</font></div></td>
	  <td><div align="center"><font size="2" face="Arial, Helvetica, sans-serif">Charges</font></div></td>
      <td><div align="center"><font size="2" face="Arial, Helvetica, sans-serif">Paid</font></div></td>
      <td><div align="center"><font size="2" face="Arial, Helvetica, sans-serif">Balance</font></div></td>
<td><div align="center"><font size="2" face="Arial, Helvetica, sans-serif">After Hajj</font></div></td>
      
    <tr> 
      <?

while ($row = pg_fetch_array($result))
{ 

$a_cc[] = $row["cus_account_code"];

}



$nrc=1;
for($i=0; $i<count($a_cc); $i++){

$s_cus_ac = $a_cc[$i];

$query_sub  = "SELECT aname,country from agentsdet where acccode='$s_cus_ac'  ";

$result_sub = pg_query($conn, $query_sub);


while ($row_sub = pg_fetch_array($result_sub))
{
$c_name =  $row_sub["aname"];
$c_country =  $row_sub["country"];
}

?>
    <tr> 
      <td><div align="center"><font size="2" face="Arial, Helvetica, sans-serif"><?echo $nrc;?></font></div></td>
      <td><font size="2" face="Arial, Helvetica, sans-serif"><a href="hajjagentwiseledger.php?agentacc=<? echo $s_cus_ac; ?>" target="popa" onClick="window.open('','popa', 'width=750,height=500,menubar=yes,scrollbars=yes,status=no top='+wint+',left='+winl+' ')" ><? echo strtoupper($c_name); ?></a></font></td>
      <td><div align="center"><font size="2" face="Arial, Helvetica, sans-serif"><? echo $c_country; ?></font></div></td>
<td><div align="right"><font size="2" face="Arial, Helvetica, sans-serif"><? echo Prebal($s_cus_ac) ; ?></font></div></td>


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

<td align="right" ><font size="2" face="Arial, Helvetica, sans-serif"><? echo number_format(round(($s_r*100/100),2), 2, "." , ","); ?></font></td>
<td align="right" ><font size="2" face="Arial, Helvetica, sans-serif"><? echo number_format(round(($p_a*100/100),2), 2, "." , ","); ?></font></td>
<td align="right" ><font size="2" face="Arial, Helvetica, sans-serif"><? echo number_format(round((($s_r-$p_a)*100/100),2), 2, "." , ","); ?></font></td>

<td><div align="right"><font size="2" face="Arial, Helvetica, sans-serif"><?  $r_totbal = Aftbal($s_cus_ac) ; ?></font></div></td>
</tr>

	  
	  
<?	  

$r_totbal_f = $r_totbal_f + $r_totbal;
$r_totbal=0.0;


$tot_c=$tot_c+$s_r;
$tot_p=$tot_p+$p_a;
$tot_b=$tot_b+$s_r-$p_a;

$p_a=0;
$s_r=0;	  
	  
	  $nrc++;
}




?>
<tr><td colspan="4" align="center"><font size="2" face="Arial, Helvetica, sans-serif">Total</font></td>



<td align="right" ><font size="2" face="Arial, Helvetica, sans-serif"><? echo number_format(round(($tot_c*100/100),2), 2, "." , ","); ?></font></td>
<td align="right" ><font size="2" face="Arial, Helvetica, sans-serif"><? echo number_format(round(($tot_p*100/100),2), 2, "." , ","); ?></font></td>
<td align="right" ><font size="2" face="Arial, Helvetica, sans-serif"><? echo number_format(round((($tot_b)*100/100),2), 2, "." , ","); ?></font></td><td align="right" ><font size="2" face="Arial, Helvetica, sans-serif"><? echo number_format(round((($r_totbal_f)*100/100),2), 2, "." , ","); ?></font></td></tr>

			

			









				

				</td>
              </tr></table> </td>
        </tr>
      </table></td></tr>
	  
	  
      </table> 
</table>	
	
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
	

	</tr></table>
</body>				
</html>


