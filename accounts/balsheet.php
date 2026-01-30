<?
session_cache_limiter('must-revalidate');
include ("header.php");
?>
<script src="../javascripts/cBoxes.js"></script>
<script>
document.title= '<? echo $company_name . " ERP - Acounts - Balance Sheet"; ?>';
</script>
<script>
 var winl = (screen.width - 760) / 2; 
 var wint = (screen.height - 550) / 2;
</script>
<html>
<link rel="stylesheet" type="text/css" href="../calendar/css.css" />
<style type="text/css">
<!--
.style6 {font-family: Verdana, Arial, Helvetica, sans-serif}
-->
</style>
<body leftmargin="0" topmargin="0" rightmargin="0">
<table name="hmenutable" id="hmenutable" width="100%" border="0" cellpadding="0" cellspacing="0" style="border-bottom: 1px solid #999999 ;border-left: 3px solid #006600;border-right: 3px solid #006600"><tr>
    <td bgcolor="#CCCCCC"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">&nbsp;You 
      are here: Home</font></td>
  </tr></table>

  
<table name="fintert" id="fintert" width="100%" border="0" cellpadding="0" cellspacing="0" style="border-bottom: 3px solid #006600; border-right: 3px solid #006600;border-left: 3px solid #006600 ">
  <tr>
    <td width="20%" style="border-right: 1px solid #999999" valign="top"> <table width="100%" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td valign="top"><div align="left"> 
              <?include ("umenu.php"); ?>
            </div></td>
        </tr>
      </table></td>
    <td width="80%" valign="top"  > 
<?        


$madcind = $_POST['dDay'];
$madcinm = $_POST['dMonth'];
$madciny = $_POST['dYear'];

$fromd = $madciny ."-". $madcinm ."-". $madcind ; 

$madcoutd = $_POST['d1Day'];
$madcoutm = $_POST['d1Month'];
$madcouty = $_POST['d1Year'];

$tod = $madcouty ."-". $madcoutm ."-". $madcoutd ;


?>
<table width="100%" border="0" cellpadding="3" cellspacing="0" style="border: 1px solid red">

 <tr>
     <td bgcolor="#FFDFDF" ><font size="3" face="Verdana, Arial, Helvetica, sans-serif"> <strong> Balance Sheet  </strong></font>                                 </td><td bgcolor="#FFDFDF" align="right">
                          <a href="printbalsheet.php?fd=<?echo $fromd ?>&td=<? echo $tod ?>" target="printbalsheet" onClick="window.open('', 'printbalsheet','width=750,height=450,menubar=yes,scrollbars=yes, top='+wint+',left='+winl+' ').focus()"><img src="../images/print_icon.gif" width="16" height="16"></a></font>&nbsp;&nbsp;

<img src="../images/3dpie.bmp" width="16" height="16" onClick="ppg()"></td>
                                </tr>

<?
$tot_assets=0;
$tot_liabilities=0;

$tot_income=0;
$tot_expenses=0;

$tot_profit=0;

$tot_lia_eq=0;

$tot_equity=0;

$c_arr = array();
$p_arr = array();
$depth = 1;			
$exclude = array();
array_push($exclude, 0);
$acc="";

$tree = "";

$query_acc ="select acc_sno,op_bal,acccode,acc_name,acc_desc,parent_acc,acc_type from accmast order by acccode";

$nav_query = pg_query($conn, $query_acc);

while ( $nav_row = pg_fetch_array($nav_query) )
{

$c_arr[] = $nav_row['acccode'];
$p_arr[] = $nav_row['parent_acc'];

}


echo "<tr><td colspan=\"2\" style=\"border-top: 1px solid red\"  align=\"left\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><b>Assets</b></font></td></tr>";

$query_ass ="select acc_sno,op_bal,acccode,acc_name,acc_desc,parent_acc,acc_type,fa_bull from accmast where fa_bull='t' and acc_type='A' order by acccode";

$result_ass = pg_query($conn, $query_ass);



while ( $row_ass = pg_fetch_array($result_ass) )
{
echo "<tr><td style=\"border-top: 1px solid red;border-right: 1px solid red\"  align=\"left\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";
echo $row_ass['acc_name'];
echo "</font></td><td style=\"border-top: 1px solid red\" align=\"right\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";
$acc = $row_ass['acccode'];
$tree .= test_fun($acc, $conn);

$s_tree = $tree;
$ss_tree = explode(",", $s_tree);
$first = $ss_tree[0];

$last = isset($ss_tree[count($ss_tree)-2]) ? $ss_tree[count($ss_tree)-2] : '';

$op_query= "select  sum(dbamt) as db, sum(cramt) as cr, (select sum(op_bal) from accmast where acccode between '$first' and '$last') as op_bal, sum(dbamt-cramt) as bal  from vocmast where acccode between '$first' and '$last' ";

$op_result = pg_query($conn, $op_query);
while ($op_row = pg_fetch_array($op_result))
	{
	 
   $op_bal =$op_row["op_bal"];
   $bal =$op_row["bal"];
 $tot = $op_bal + $bal;
echo $tot1 = number_format($tot, 2, "." , ",");
	}
$tot_assets = $tot_assets+$tot ;

$tree="";
echo "</font></td></tr>";
}

 $tot_assets1 = number_format($tot_assets, 2, "." , ",");
echo "<tr><td style=\"border-top: 1px solid red;border-right: 1px solid red;border-bottom: 1px solid red\"  align=\"right\"><font size=\"3\" face=\"Verdana, Arial, Helvetica, sans-serif\"><b>Total Assets: </b></font></td><td style=\"border-top: 1px solid red;border-bottom: 1px solid red\"  align=\"right\"><font size=\"3\" face=\"Verdana, Arial, Helvetica, sans-serif\"><b>$tot_assets1</b></font></td></tr>";

echo "<tr><td colspan=\"2\">&nbsp;</td></tr>";

echo "<tr><td colspan=\"2\" style=\"border-top: 1px solid red;border-bottom: 1px solid red\"  align=\"left\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><b>Liabilities</b></font> </td></tr>";


$query_lia ="select acc_sno,op_bal,acccode,acc_name,acc_desc,parent_acc,acc_type,fa_bull from accmast where fa_bull='t' and acc_type='L' order by acccode";

$result_lia = pg_query($conn, $query_lia);



while ( $row_lia = pg_fetch_array($result_lia) )
{
echo "<tr><td style=\"border-bottom: 1px solid red;border-right: 1px solid red\"  align=\"left\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";
echo $row_lia['acc_name'];
echo "</font></td><td style=\"border-bottom: 1px solid red\"  align=\"right\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";
$acc = $row_lia['acccode'];
$tree .= test_fun($acc, $conn);

$s_tree = $tree;
$ss_tree = explode(",",$s_tree);
$first = $ss_tree[0];

$last = isset($ss_tree[count($ss_tree)-2]) ? $ss_tree[count($ss_tree)-2] : '';

$op_query= "select  sum(dbamt) as db, sum(cramt) as cr, (select sum(op_bal) from accmast where acccode between '$first' and '$last') as op_bal, sum(cramt-dbamt) as bal  from vocmast where acccode between '$first' and '$last' ";

$op_result = pg_query($conn, $op_query);
while ($op_row = pg_fetch_array($op_result))
	{
	 
   $op_bal =$op_row["op_bal"];
   $bal =$op_row["bal"];
$tot = $op_bal + $bal;
echo $tot1 = number_format($tot, 2, "." , ",");
	}
$tot_liabilities = $tot_liabilities+$tot ;

$tree="";
echo "</font></td></tr>";
}

$tot_liabilities1 = number_format($tot_liabilities, 2, "." , ",");

echo "<tr> <td style=\"border-bottom: 1px solid red;border-right: 1px solid red\"  align=\"left\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><b> Total Liabilities:</b></font></td> <td style=\"border-bottom: 1px solid red\"  align=\"right\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><b>$tot_liabilities1</b></font></td></tr>";

echo "<tr><td colspan=\"2\" style=\"border-bottom: 1px solid red\"  align=\"left\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><b>Equity</b></font> </td></tr>";



$query_equ ="select acc_sno,op_bal,acccode,acc_name,acc_desc,parent_acc,acc_type,fa_bull from accmast where fa_bull='t' and acc_type='Q' order by acccode";

$result_equ = pg_query($conn, $query_equ);



while ( $row_equ = pg_fetch_array($result_equ) )
{
echo "<tr><td style=\"border-bottom: 1px solid red;border-right: 1px solid red\"  align=\"left\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";
echo $row_equ['acc_name'];
echo "</font></td><td style=\"border-bottom: 1px solid red\"  align=\"right\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";
$acc = $row_equ['acccode'];
$tree .= test_fun($acc, $conn);

$s_tree = $tree;
$ss_tree = explode(",",$s_tree);
$first = $ss_tree[0];

$last = isset($ss_tree[count($ss_tree)-2]) ? $ss_tree[count($ss_tree)-2] : '';

$op_query= "select  sum(dbamt) as db, sum(cramt) as cr, (select sum(op_bal) from accmast where acccode between '$first' and '$last') as op_bal, sum(cramt-dbamt) as bal  from vocmast where acccode between '$first' and '$last' ";

$op_result = pg_query($conn, $op_query);
while ($op_row = pg_fetch_array($op_result))
	{
	 
   $op_bal =$op_row["op_bal"];
   $bal =$op_row["bal"];
   $tot = $op_bal + $bal;
echo $tot1 = number_format($tot, 2, "." , ",");

	}
 $tot_equity = $tot_equity+$tot ;

$tree="";
echo "</font></td></tr>";
}



// income

$acc = '500000';
$tree .= test_fun($acc, $conn);

$s_tree = $tree;
$ss_tree = explode(",",$s_tree);
$first = $ss_tree[0];

$last = isset($ss_tree[count($ss_tree)-2]) ? $ss_tree[count($ss_tree)-2] : '';

$op_query= "select  sum(dbamt) as db, sum(cramt) as cr, (select sum(op_bal) from accmast where acccode between '$first' and '$last') as op_bal, sum(cramt-dbamt) as bal  from vocmast where acccode between '$first' and '$last' ";

$op_result = pg_query($conn, $op_query);
while ($op_row = pg_fetch_array($op_result))
	{
	 
   $op_bal =$op_row["op_bal"];
    $bal =$op_row["bal"];
  $tot_income = $op_bal + $bal;
	}

$tree="";
// income end

// income

$acc = '600000';
$tree .= test_fun($acc, $conn);

$s_tree = $tree;
$ss_tree = explode(",",$s_tree);
$first = $ss_tree[0];

$last = isset($ss_tree[count($ss_tree)-2]) ? $ss_tree[count($ss_tree)-2] : '';

$op_query= "select  sum(dbamt) as db, sum(cramt) as cr, (select sum(op_bal) from accmast where acccode between '$first' and '$last') as op_bal, sum(dbamt-cramt) as bal  from vocmast where acccode between '$first' and '$last' ";

$op_result = pg_query($conn, $op_query);
while ($op_row = pg_fetch_array($op_result))
	{
	 
   $op_bal =$op_row["op_bal"];
    $bal =$op_row["bal"];
    $tot_expenses = $op_bal + $bal;
	}

$tree="";
// income end

//$tot_income=0;
//$tot_expenses=0;

$tot_profit=$tot_income-$tot_expenses;
//echo $tot_equity;
$tot_equity=$tot_equity+$tot_profit;

$tot_profit1 = number_format($tot_profit, 2, "." , ",");
$tot_equity1 = number_format($tot_equity, 2, "." , ",");

echo "<tr> <td style=\"border-bottom: 1px solid red;border-right: 1px solid red\"  align=\"left\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><b>Net Profit (Retained Earnings):</b></font></td> <td style=\"border-bottom: 1px solid red\"  align=\"right\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><b>$tot_profit1</b></font></td></tr>";

echo "<tr><td style=\"border-bottom: 1px solid red;border-right: 1px solid red\"  align=\"left\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><b>Total Equity:</b></font></td> <td style=\"border-bottom: 1px solid red\"  align=\"right\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><b>$tot_equity1</b></font></td></tr>";


echo "<tr><td colspan=\"2\">&nbsp;</td></tr>";

$tot_lia_eq = $tot_liabilities + $tot_equity;

$tot_lia_eq1 = number_format($tot_lia_eq, 2, "." , ",");

echo "<tr> <td style=\"border-top: 1px solid red;border-right: 1px solid red\"  align=\"right\"><font size=\"3\" face=\"Verdana, Arial, Helvetica, sans-serif\"><b>Liabilities + Equity:</b></font></td> <td style=\"border-top: 1px solid red\"  align=\"right\"><font size=\"3\" face=\"Verdana, Arial, Helvetica, sans-serif\"><b>$tot_lia_eq1</b></font></td></tr>";



echo "</table>";











function test_fun($fc, $conn){
global $exclude,$depth,$c_arr,$p_arr;
$tempTree = "";

$query_acc1 ="select acc_sno,acccode,acc_name,acc_desc,parent_acc,acc_type from accmast  where parent_acc='$fc' order by acccode";
$child_query = pg_query($conn, $query_acc1);

	while ( $child = pg_fetch_array($child_query) )
	{
		if ( $child['acccode'] != $child['parent_acc'] )
		{

for ( $c=0;$c<$depth;$c++ )	

$tempTree .= $child['acccode'].",";
$depth++;
$tempTree .= test_fun($child['acccode'], $conn);
$depth--;
array_push($exclude, $child['acccode']);	

}

}



return $tempTree;

}


?>
		
		 

    
			</td></tr>
	  
	  
      </table> 
</table>	
	
	

	</tr></table>
</body>				
</html>


<script>
function ppg(){
window.open('printbsgraph.php?assets=<? echo $tot_assets; ?>&liabilities=<? echo $tot_liabilities; ?>&netprofit=<? echo $tot_profit; ?>&equity=<? echo $tot_equity; ?>&liaequ=<? echo $tot_lia_eq; ?>', 'printbsgraph','width=760,height=400,menubar=yes,scrollbars=yes, top='+wint+',left='+winl+' ').focus();
}
</script>

<script>

document.getElementById('headertable').width=document.getElementById('fintert').offsetWidth;
document.getElementById('hmenutable').width=document.getElementById('fintert').offsetWidth;




</script>


