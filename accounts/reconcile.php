<?
include ("header.php");


?>
<script src="../javascripts/cBoxes.js"></script>
<script>
document.title= '<? echo $company_name . " ERP - Acounts - Reconcile"; ?>';
</script>
<script>
 var winl = (screen.width - 760) / 2; 
 var wint = (screen.height - 550) / 2;
</script>

<html>
<link rel="stylesheet" type="text/css" href="../calendar/css.css" />
<body  leftmargin="0" topmargin="0" rightmargin="0">
<table name="hmenutable" id="hmenutable" width="100%" border="0" cellpadding="0" cellspacing="0" style="border-bottom: 1px solid #999999 ;border-left: 3px solid #006600;border-right: 3px solid #006600"><tr>
    <td bgcolor="#CCCCCC"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">&nbsp;You 
      are here: Home</font></td>
  </tr></table>
<table name="fintert" id="fintert" width="100%" border="0" cellpadding="0" cellspacing="0" style="border-bottom: 1px solid #999999 ;border-left: 3px solid #006600;border-right: 3px solid #006600"><tr>
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
    <td width="80%" valign="top"  > <table width="100%" border="0" cellpadding="2" cellspacing="0" style="border: 1px solid red">
        
         
		   
	
	<?

$s_ac = $_POST["acname"];

$s_scode = $_POST["scode"];

if($s_ac=="select"){
$s_ac = "";
$s_acc="";
}
else{
$s_acc = " Account Code: ".$s_ac;
$s_ac = " and acccode='" . $s_ac . "'";
}

if($s_scode=="select"){
$s_scode = "";
$s_scodes = ""; 
}
else{
$s_scodes = "Voucher Type: " . $s_scode;
$s_scode = " and voctype='" . $s_scode ."'";
}



$dba=0;
$cra=0;

$totdb=0;
$totcr=0;
$acc_name="";


$madcind = $_POST['dDay'];
$madcinm = $_POST['dMonth'];
$madciny = $_POST['dYear'];

$madcin = $madciny ."-". $madcinm ."-". $madcind ; 
$fromd = $madciny ."-". $madcinm ."-". $madcind ; 

$madcoutd = $_POST['d1Day'];
$madcoutm = $_POST['d1Month'];
$madcouty = $_POST['d1Year'];

$madcout = $madcouty ."-". $madcoutm ."-". $madcoutd ; 
$tod = $madcouty ."-". $madcoutm ."-". $madcoutd ; 



$voctype= array();
$vocno= array();
$vocsno=array();
$vocdate=array();
$acccode=array();
$dbamt=array();
$cramt=array();


$array_acc_name = array();
$array_acccode = array();
$array_parent_acc = array();
$query_hotel ="select acccode,acc_name,parent_acc from accmast order BY acccode";

$result_hotel = pg_query($conn, $query_hotel);

if (!$result_hotel) {
	echo "An error occured.\n";
	exit;
	}
while ($rows_hotel = pg_fetch_array($result_hotel)){

$array_acc_name[] = $rows_hotel["acc_name"];
$array_acccode[] = $rows_hotel["acccode"];
$array_parent_acc[] = $rows_hotel["parent_acc"];
}

pg_free_result($result_hotel);


$a_recon = array();
$query_hotel ="select  voctype,vocno,vocsno,vocdate,acccode,dbamt,cramt,recon from vocmast where vocdate between '$fromd' and '$tod' $s_ac  $s_scode  order by voctype,vocno,vocsno ";

$result_hotel = pg_query($conn, $query_hotel);

if (!$result_hotel) {
	echo "An error occured.\n";
	exit;
	}
while ($rows_hotel = pg_fetch_array($result_hotel)){

$voctype[]= $rows_hotel["voctype"];
$vocno[]= $rows_hotel["vocno"];  
$vocsno[]=	 $rows_hotel["vocsno"]; 
$vocdate[]=	 $rows_hotel["vocdate"];
$acccode[]=	 $rows_hotel["acccode"];
$dbamt[]=	 $rows_hotel["dbamt"];  
$cramt[]=	 $rows_hotel["cramt"]; 
$a_recon[]=  $rows_hotel["recon"]; 
}

pg_free_result($result_hotel);





?>
 <tr>
     <td bgcolor="#FFDFDF" colspan="7"><font size="3" face="Verdana, Arial, Helvetica, sans-serif"> <strong> Start Reconcile...  <? echo $s_acc . $s_scodes ?></strong></font>                                 </td>
                                </tr>

 <tr>
     <td colspan="7"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"> <? echo "Dated: " . date("r")." (GMT)"; ?>   </font>                            </td></tr>



 <tr>
     <td colspan="7"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"> <?echo $s_acc  ?>  </font>                            </td>
                                </tr>
<tr>
     <td colspan="7"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Period: <?echo date('d-M-Y', strtotime($madcin)) ." to ". date('d-M-Y', strtotime($madcout)); ?>  </font>                            </td></tr>

<tr><td style="border-top: 1px solid red;border-right: 1px solid red" align="center"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">No</font></td><td style="border-top: 1px solid red;border-right: 1px solid red" align="center"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Voucher No</font></td><td style="border-top: 1px solid red;border-right: 1px solid red" align="center"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Voucher Date</font></td><td style="border-top: 1px solid red;border-right: 1px solid red" align="center"><font size="2" face="Verdana, Arial, Helvetica, sans-serif" >Account Code</font></td><td style="border-top: 1px solid red;border-right: 1px solid red" align="center"><font size="2" face="Verdana, Arial, Helvetica, sans-serif" >Account Name</font></td><td style="border-top: 1px solid red;border-right: 1px solid red" align="right"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Debit</font></td><td style="border-top: 1px solid red;border-right: 1px solid red" align="right"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Credit</font></td></tr>



<?

for($i=0;$i<count($voctype);$i++){
$ii=$i+1;


$dba = number_format($dbamt[$i], 2, "." , ",");
$cra = number_format($cramt[$i], 2, "." , ",");

$acc_name="";

for($j=0; $j<count($array_acc_name); $j++){
  if(trim($array_acccode[$j])==trim($acccode[$i])){
 $acc_name=$array_acc_name[$j];
  }
}

$back_gr="";

if($a_recon[$i]=="f"){
$back_gr="background=../images/recon.gif";
}



$vd=date('d/M', strtotime($vocdate[$i]));

echo "<tr><td $back_gr style=\"border-top: 1px solid red;border-right: 1px solid red;background-repeat: no-repeat;\"  align=\"center\" valign=\"middle\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">$ii</font></td><td style=\"border-top: 1px solid red;border-right: 1px solid red\" align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">"; 

?>

<?
if($a_recon[$i]=="f"){
?>

<a href="voureconcile.php?act=<? echo $voctype[$i] ;?>&vocno=<? echo $vocno[$i]; ?>" target="pnrtrans" onClick="window.open('', 'pnrtrans','width=750,height=450,menubar=yes,scrollbars=yes, top='+wint+',left='+winl+' ').focus()"><? echo $voctype[$i] ." ". $vocno[$i] ;?></a>

<?
}else{
?>
<a href="vouunreconcile.php?act=<? echo $voctype[$i] ;?>&vocno=<? echo $vocno[$i]; ?>" target="pnrtransun" onClick="window.open('', 'pnrtransun','width=750,height=450,menubar=yes,scrollbars=yes, top='+wint+',left='+winl+' ').focus()"><? echo $voctype[$i] ." ". $vocno[$i] ;?></a>

<?
}
echo "</td><td style=\"border-top: 1px solid red;border-right: 1px solid red\" align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">$vd</font></td><td style=\"border-top: 1px solid red;border-right: 1px solid red\" align=\"left\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">$acccode[$i]</font></td><td style=\"border-top: 1px solid red;border-right: 1px solid red\" align=\"left\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">$acc_name</font></td><td style=\"border-top: 1px solid red;border-right: 1px solid red\" align=\"right\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\" >$dba</font></td><td style=\"border-top: 1px solid red;border-right: 1px solid red\" align=\"right\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\" >$cra</font></td></tr>";


$totdb = $totdb + $dbamt[$i];
$totcr = $totcr + $cramt[$i];

}

	
?>

<tr><td style="border-top: 1px solid red;border-right: 1px solid red" colspan="5" align="center"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Total in SAR</font></td><td style="border-top: 1px solid red;border-right: 1px solid red" align="right"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b><? echo number_format($totdb, 2, "." , ",") ?></b></font></td><td style="border-top: 1px solid red;border-right: 1px solid red" align="right"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b><? echo number_format($totcr, 2, "." , ","); ?></b></font></td><td style="border-top: 1px solid red" align="right"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b><? // echo $bala ?></b></font></td></tr>

      </table></td></tr>
	  
	  
      </table> 
</table>	
	
	

	</tr></table>
</body>				
</html>


<script>
document.getElementById('headertable').width=document.getElementById('fintert').offsetWidth;
document.getElementById('hmenutable').width=document.getElementById('fintert').offsetWidth;




</script>

