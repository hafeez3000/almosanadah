<?
include ("header.php");


?>
<script src="../javascripts/cBoxes.js"></script>
<script>
document.title= '<? echo $company_name . " ERP - Acounts - Accounts Tree"; ?>';
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

$s_ac = $_POST["accode"];




$s_assests = "A";
$s_liabilities = "L";
$s_income = "I";
$s_expenses = "E";
$s_equity = "Q";

$bal=0;

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

if($s_ac==""){
$s_ac = $_GET["act"];
$madcin = $_GET["fromd"];
$madcout = $_GET["tod"];
$fromd = $_GET["fromd"];
$tod = $_GET["tod"];
}

$query_hotel ="select acccode,acc_name,acc_type,db_bal,cr_bal,op_bal from accmast where acccode='$s_ac'";

$result_hotel = pg_query($conn, $query_hotel);

if (!$result_hotel) {
	echo "An error occured.\n";
	exit;
	}
while ($rows_hotel = pg_fetch_array($result_hotel)){

$acc_name = $rows_hotel["acc_name"];
$acccode = $rows_hotel["acccode"];
$acc_type = $rows_hotel["acc_type"];
$db_bal = $rows_hotel["db_bal"];
$cr_bal = $rows_hotel["cr_bal"];
$op_bal = $rows_hotel["op_bal"];

}

pg_free_result($result_hotel);





if($acc_type==$s_assests || $acc_type==$s_expenses){
$bal = $op_bal + $db_bal - $cr_bal;
}
else{
$bal = $op_bal - $db_bal + $cr_bal;
}

$dba = number_format($db_bal, 2, "." , ",");
$cra = number_format($cr_bal, 2, "." , ",");
$bala = number_format($op_bal, 2, "." , ",");



$start_period="";
$p_query = "select startdate from period";

$p_result = pg_query($conn, $p_query);

while ($p_row = pg_fetch_array($p_result))
{ 
 $start_period = $p_row["startdate"];
}



$op_query = "select SUM(dbamt) as totdb, SUM(cramt) as totcr from vocmast where acccode='$s_ac' and vocdate between '$start_period' and date '$fromd' - interval '1 day' ";
$op_result = pg_query($conn, $op_query);
while ($op_row = pg_fetch_array($op_result))
	{
      
   
      $op_totdb = floatval($op_row["totdb"]);
 	   $op_totcr = floatval($op_row["totcr"]);
       
     if($acc_type==$s_assests || $acc_type==$s_expenses){
       $baldb = $bal + $op_totdb - $op_totcr ;
	  
	   }
	   else{

		$baldb = $bal - $op_totdb + $op_totcr ;
	 	}  
}

$bal=$baldb;
$bal_p=$bala = number_format($baldb, 2, "." , ","); //for print

$a_voctype = array();
$a_vocno = array();
$a_vocdate = array();
$a_narration = array();
$a_dbamt = array();
$a_cramt = array();
$a_pnr = array();
$a_moredet = array();
$a_invno = array();
$a_sinvno = array();
$a_sinvtype = array();
$a_supp_inv = array();


$query_voc ="select voctype,vocno,vocdate,narration,dbamt,cramt,pnr,moredet,invno,sinvno,sinvtype,supp_inv from vocmast where acccode='$s_ac' and vocdate between '$fromd' and '$tod' order by vocdate,voctype,vocno,pnr";

$result_voc = pg_query($conn, $query_voc);

if (!$result_voc) {
	echo "An error occured.\n";
	exit;
	}
while ($rows_voc = pg_fetch_array($result_voc)){

$a_voctype[] = $rows_voc["voctype"];
$a_vocno[] = $rows_voc["vocno"];
$a_vocdate[] = $rows_voc["vocdate"];  
$a_narration[] = $rows_voc["narration"];
$a_dbamt[] = $rows_voc["dbamt"];    
$a_cramt[] = $rows_voc["cramt"];    
$a_pnr[] = $rows_voc["pnr"];      
$a_moredet[] = $rows_voc["moredet"];  
$a_invno[] = $rows_voc["invno"];    
$a_sinvno[] = $rows_voc["sinvno"];      
$a_sinvtype[] = $rows_voc["sinvtype"];  
$a_supp_inv[] = $rows_voc["supp_inv"];


}



?>
 <tr>
     <td bgcolor="#FFDFDF" colspan="6"><font size="3" face="Verdana, Arial, Helvetica, sans-serif"> <strong><?echo $acc_name ?> Ledger  </strong></font>                                 </td><td bgcolor="#FFDFDF" align="right">


         <?

          if($s_ac>150000 && $s_ac<399999){
         echo "<img src=\"../images/mail_icon.gif\" onClick=\"send_m()\" >";

         echo "<script>function send_m(){ window.open(\"sendmbm.php?accn=$s_ac&fd=$fromd&td=$tod\",$s_ac,\"width=500,height=200,scrollbars=yes,top=0,left=0\").focus() }</script>"; 
		 echo "&nbsp;&nbsp;&nbsp;";


       

		 }
		 ?>

                          <a href="printledger.php?acc=<? echo $s_ac; ?>&fd=<?echo $madcin ?>&td=<? echo $madcout ?>" target="pledger" onClick="window.open('', 'pledger','width=750,height=450,menubar=yes,scrollbars=yes, top='+wint+',left='+winl+' ').focus()"><img src="../images/print_icon.gif" width="16" height="16"></a></font></td>
                                </tr>

 <tr>
     <td colspan="7"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"> <? echo "Dated: " . date("r")." (GMT)"; ?>   </font>                            </td></tr>



 <tr>
     <td colspan="7"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"> <?echo "Account Code: " .$acccode ." - Account Name: ". $acc_name ?>  </font>                            </td>
                                </tr>
<tr>
     <td colspan="7"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Period: <?echo date('d-M-Y', strtotime($madcin)) ." to ". date('d-M-Y', strtotime($madcout)); ?>  </font>                            </td></tr>

<tr><td style="border-top: 1px solid red;border-right: 1px solid red" align="center"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">S.No</font></td><td style="border-top: 1px solid red;border-right: 1px solid red" align="center"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Voucher No</font></td><td style="border-top: 1px solid red;border-right: 1px solid red" align="center"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Voucher Date</font></td><td style="border-top: 1px solid red;border-right: 1px solid red" align="center"><font size="2" face="Verdana, Arial, Helvetica, sans-serif" >Narration</font></td><td style="border-top: 1px solid red;border-right: 1px solid red" align="right"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Debit</font></td><td style="border-top: 1px solid red;border-right: 1px solid red" align="right"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Credit</font></td><td style="border-top: 1px solid red" align="right"><font size="2" face="Verdana, Arial, Helvetica, sans-serif" >Balanace</font></td></tr>


<tr><td style="border-top: 1px solid red;border-right: 1px solid red" colspan="4" align="center"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Opening Balance</font></td><td style="border-top: 1px solid red;border-right: 1px solid red" align="right"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><? echo number_format($totdb, 2, "." , ",") ?></font></td><td style="border-top: 1px solid red;border-right: 1px solid red" align="right"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><? echo number_format($totcr, 2, "." , ","); ?></font></td><td style="border-top: 1px solid red" align="right"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><? echo $bal_p ?></font></td></tr>

<?

for($i=0;$i<count($a_voctype);$i++){
$ii=$i+1;
$vd="";
$vd=date('d/M', strtotime($a_vocdate[$i]));

$totdb = $totdb + $a_dbamt[$i];
$totcr = $totcr + $a_cramt[$i];



if($acc_type==$s_assests || $acc_type==$s_expenses){
$bal = $bal + $a_dbamt[$i] - $a_cramt[$i];
}
else{
$bal = $bal - $a_dbamt[$i] + $a_cramt[$i];
}

$bal;

$dba = number_format($a_dbamt[$i], 2, "." , ",");
$cra = number_format($a_cramt[$i], 2, "." , ",");
$bala = number_format($bal, 2, "." , ",");

$ref_no = "";


if($a_supp_inv[$i]=="" || $a_supp_inv[$i]=="0"){}else {$ref_no="Ref No # " . $a_supp_inv[$i];}



echo "<tr><td style=\"border-top: 1px solid red;border-right: 1px solid red\"  align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">$ii</font></td><td style=\"border-top: 1px solid red;border-right: 1px solid red\" align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">$a_voctype[$i] "; 


?>

<? if($a_invno[$i]=="" || $a_invno[$i]=="0"){ ?>


<a href="pnrtransvoc.php?act=<? echo $a_voctype[$i] ;?>&vocno=<? echo $a_vocno[$i]; ?>" target="pnrtrans" onClick="window.open('', 'pnrtrans','width=750,height=450,menubar=yes,scrollbars=yes, top='+wint+',left='+winl+' ').focus()"><? echo $a_vocno[$i] ;?></a>

<? } else { ?>

<a href="pnrtrans.php?act=<? echo $a_voctype[$i] ;?>&minv=<? echo $a_invno[$i]; ?>" target="pnrtrans" onClick="window.open('', 'pnrtrans','width=750,height=450,menubar=yes,scrollbars=yes, top='+wint+',left='+winl+' ').focus()"><? echo $a_invno[$i] ;?></a>-<? echo $a_sinvtype[$i] ;?>-<a href="pnritemtrans.php?act=<? echo $a_voctype[$i]; ?>&minv=<? echo $a_invno[$i]; ?>&itno=<? echo $a_sinvno[$i] ;?>&itt=<? echo $a_sinvtype[$i] ;?>" target="pnritemtrans" onClick="window.open('', 'pnritemtrans','width=750,height=450,menubar=yes,scrollbars=yes,resizable=yes top='+wint+',left='+winl+' ').focus()"><? echo $a_sinvno[$i] ;?></a>

<?
}
echo "</td><td style=\"border-top: 1px solid red;border-right: 1px solid red\" align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">$vd</font></td><td style=\"border-top: 1px solid red;border-right: 1px solid red\" align=\"left\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">$a_narration[$i]<br>$a_moredet[$i] $ref_no</font></td><td style=\"border-top: 1px solid red;border-right: 1px solid red\" align=\"right\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\" >$dba</font></td><td style=\"border-top: 1px solid red;border-right: 1px solid red\" align=\"right\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\" >$cra</font></td><td style=\"border-top: 1px solid red\" align=\"right\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\" >$bala</font></td></tr>";

}
	
?>

<tr><td style="border-top: 1px solid red;border-right: 1px solid red" colspan="4" align="center"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Total in SAR</font></td><td style="border-top: 1px solid red;border-right: 1px solid red" align="right"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b><? echo number_format($totdb, 2, "." , ",") ?></b></font></td><td style="border-top: 1px solid red;border-right: 1px solid red" align="right"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b><? echo number_format($totcr, 2, "." , ","); ?></b></font></td><td style="border-top: 1px solid red" align="right"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b><? echo $bala ?></b></font></td></tr>

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

