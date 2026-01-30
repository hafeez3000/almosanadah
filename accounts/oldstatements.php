<?
include ("header.php");


?>

<script>
document.title= '<? echo $company_name . " ERP - Acounts - Current Petty Cash Tally Sheet"; ?>';
</script>

<html>
<link rel="stylesheet" type="text/css" href="../calendar/css.css" />

<body  leftmargin="0" topmargin="0" rightmargin="0"  >
<table width="100%" border="0" cellpadding="0" cellspacing="0" style="border-bottom: 1px solid #999999 ;border-left: 3px solid #006600;border-right: 3px solid #006600"><tr>
    <td bgcolor="#CCCCCC"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">&nbsp;You 
      are here: Home</font></td>
  </tr></table>
<table width="100%" border="0" cellpadding="0" cellspacing="0" style="border-bottom: 1px solid #999999 ;border-left: 3px solid #006600;border-right: 3px solid #006600"><tr>
    <td ><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><?include ("../dticker/uhome.php"); ?></td>
  </tr></table>
  
<table width="100%" border="0" cellpadding="0" cellspacing="0" style="border-bottom: 3px solid #006600; border-right: 3px solid #006600;border-left: 3px solid #006600 ">
  <tr>
    <td width="20%" style="border-right: 1px solid #999999" valign="top"> <table width="100%" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td valign="top"><div align="left"> 
              <?include ("umenu.php"); ?>
            </div></td>
        </tr>
      </table></td>
    <td width="80%" valign="top"  > <table width="100%" border="0" cellpadding="0" cellspacing="1">
        <tr>
          <td valign="top"> 
   
	<table width="100%">
      <tr>
                                  <td bgcolor="#FFDFDF">&nbsp;<strong>Previous Petty Cash Statments</strong>                                 </td>
						
								</tr>
		</table>

	
	<table style="border: 1px solid red" width="100%"  border="0" cellpadding="2" cellspacing="0">

      <tr>
                                  <td colspan="7" align="center" >&nbsp;<strong>Previous Petty Cash Statments</strong>                                 </td>
						
								</tr>

<tr><td style="border-top: 1px solid red;border-right: 1px solid red" align="center"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">S.No</font></td><td style="border-top: 1px solid red;border-right: 1px solid red" align="center"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Statement No</font></td><td style="border-top: 1px solid red;border-right: 1px solid red" align="center"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Closing Date</font></td><td style="border-top: 1px solid red;border-right: 1px solid red" align="left"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Opening Amount</font></td><td style="border-top: 1px solid red;border-right: 1px solid red" align="right"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Closing Amount</font></td><td style="border-top: 1px solid red;border-right: 1px solid red" align="right"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Status</font></td><td style="border-top: 1px solid red" align="right"><font size="2" face="Verdana, Arial, Helvetica, sans-serif" >Close Satement</font></td></tr>




<?

$a_statementno = array();
$a_closingdate = array();
$a_openingamount = array();
$a_closingamount = array();
$a_status = array();

$query_voc ="select statementno,closingdate,openingamount,closingamount,status  from pettystatement order by statementno desc";

$result_voc = pg_query($conn, $query_voc);

if (!$result_voc) {
	echo "An error occured.\n";
	exit;
	}
while ($rows_voc = pg_fetch_array($result_voc)){

$a_statementno[] = $rows_voc["statementno"];
$a_closingdate[] = $rows_voc["closingdate"];
$a_openingamount[] = $rows_voc["openingamount"];
$a_closingamount[] = $rows_voc["closingamount"];
$a_status[] = $rows_voc["status"];


}



for($i=0;$i<count($a_statementno);$i++){
$ii=$i+1;
$vd="";
$vd=date('d-M-Y', strtotime($a_closingdate[$i]));


$dba = number_format((float)$a_openingamount[$i], 2, "." , ",");
$cra = number_format((float)$a_closingamount[$i], 2, "." , ",");



echo "<tr><td style=\"border-top: 1px solid red;border-right: 1px solid red\"  align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">$ii</font></td>";

echo "<td style=\"border-top: 1px solid red;border-right: 1px solid red\"  align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";
?>
<a href="pettycashtallysheet.php?statement_no=<? echo $a_statementno[$i] ;?>" > <? echo $a_statementno[$i]; ?> </a>
<?

	
echo "</font></td><td style=\"border-top: 1px solid red;border-right: 1px solid red\" align=\"left\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">$vd"; 


echo "</td><td style=\"border-top: 1px solid red;border-right: 1px solid red\" align=\"right\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">$dba</font></td><td style=\"border-top: 1px solid red;border-right: 1px solid red\" align=\"right\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\" >$cra</font></td><td style=\"border-top: 1px solid red;border-right: 1px solid red\" align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\" >$a_status[$i]</font></td><td style=\"border-top: 1px solid red\" align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\" >";

if($a_status[$i]==1){
?>
<a href="pettycashclose.php?statement_no=<? echo $a_statementno[$i]; ?>&status=<?  echo $a_status[$i]; ?>" onclick="return confirm('Are you sure you want to Close Statement ?')" > Close </a>
<?
}
else {
echo "Close";
}
echo "</font></td></tr>";

}
	
?>



</td>
	  </tr></table>

		 </form>
	
			 
    
			 </td>
        </tr>
      </table></td></tr>
	  
	  
      </table> 
</table>	
	
	

	</tr></table>
</body>				
</html>
