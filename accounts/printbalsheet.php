<?
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// is the one accessing this page logged in or not?
if (!isset($_SESSION['db_is_logged_in_accounts'])
   || $_SESSION['db_is_logged_in_accounts'] !== true) {

   // not logged in, move to login page
   header('Location: login.php');
   exit;
}
$suserid = $_SESSION["userid"];
$suser_sno = $_SESSION["user_sno"];
$dept = $_SESSION["deptaccounts"];

include("../db/db.php");
include ("../conf/mainconf.php");

$fromd = $_GET['fd'];

$tod = $_GET['td'];

?>
<script>
document.title= '<? echo $company_name . " ERP - Acounts - Profit and Loss"; ?>';
</script>

<html>
<link rel="stylesheet" type="text/css" href="../calendar/css.css" />
<body leftmargin="0" topmargin="0" rightmargin="0">
<center>

 <table width="98%" border="0" cellspacing="2" cellpadding="2" align="center" style="border-top: 1px solid black;border-right: 1px solid black;border-left: 1px solid black">
          <tr>
            <td valign="middle"  width="47%"><div align="center"><font size="4" face="Arial, Helvetica, sans-serif"><b>SOHULAT AL-SAFAR UMRAH SERVICES </b></font></div></td>
            <td rowspan="2" valign="top"><img src="../images/logo.jpg"></td>
            <td valign="top"  DIR="RTL"><div align="center"><img src="../images/arname350.jpg" height="20"></div></td>
          </tr>
          <tr>
            <td valign="top"><div align="center"><font size="4" face="Arial, Helvetica, sans-serif"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Ibrahim Al Juffali St, Al Andalus, Jeddah,<br>Saudi Arabia, Web:satgurutravel.com.sa</font></font></div></td>
            <td valign="top"><div align="center"><font size="4" face="Arial, Helvetica, sans-serif"><font size="4" face="Arial, Helvetica, sans-serif"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"> +966 12 605 0607<br>Email: res@sohulatalsafar.com</font></font></font></div></td>

          </tr>
</table>






		 <table width="95%" border="0" cellpadding="3" cellspacing="0" style="border: 1px solid black">

 <tr>
     <td align="center" colspan="2" bgcolor="#CCCCCC"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"> <strong> Balance Sheet from: &nbsp; <? echo date('D, d-M-Y', strtotime($fromd))  ." to " . date('D, d-M-Y', strtotime($tod)) ?></strong></font>                                 </td>
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


echo "<tr><td colspan=\"2\" style=\"border-top: 1px solid black\"  align=\"left\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><b>Assets</b></font></td></tr>";

$query_ass ="select acc_sno,op_bal,acccode,acc_name,acc_desc,parent_acc,acc_type,fa_bull from accmast where fa_bull='t' and acc_type='A' order by acccode";

$result_ass = pg_query($conn, $query_ass);



while ( $row_ass = pg_fetch_array($result_ass) )
{
echo "<tr><td style=\"border-top: 1px solid black\"  align=\"left\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";
echo $row_ass['acc_name'];
echo "</font></td><td style=\"border-top: 1px solid black\" align=\"right\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";
$acc = $row_ass['acccode'];
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
 $tot = $op_bal + $bal;
echo $tot1 = number_format($tot, 2, "." , ",");
	}
$tot_assets = $tot_assets+$tot ;

$tree="";
echo "</font></td></tr>";
}

 $tot_assets1 = number_format($tot_assets, 2, "." , ",");
echo "<tr><td style=\"border-top: 1px solid black;border-bottom: 1px solid black\"  align=\"right\"><font size=\"3\" face=\"Verdana, Arial, Helvetica, sans-serif\"><b>Total Assets: </b></font></td><td style=\"border-top: 1px solid black;border-bottom: 1px solid black\"  align=\"right\"><font size=\"3\" face=\"Verdana, Arial, Helvetica, sans-serif\"><b>$tot_assets1</b></font></td></tr>";

echo "<tr><td colspan=\"2\">&nbsp;</td></tr>";

echo "<tr><td colspan=\"2\" style=\"border-top: 1px solid black;border-bottom: 1px solid black\"  align=\"left\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><b>Liabilities</b></font> </td></tr>";


$query_lia ="select acc_sno,op_bal,acccode,acc_name,acc_desc,parent_acc,acc_type,fa_bull from accmast where fa_bull='t' and acc_type='L' order by acccode";

$result_lia = pg_query($conn, $query_lia);



while ( $row_lia = pg_fetch_array($result_lia) )
{
echo "<tr><td style=\"border-bottom: 1px solid black\"  align=\"left\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";
echo $row_lia['acc_name'];
echo "</font></td><td style=\"border-bottom: 1px solid black\"  align=\"right\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";
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

echo "<tr> <td style=\"border-bottom: 1px solid black\"  align=\"left\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><b> Total Liabilities:</b></font></td> <td style=\"border-bottom: 1px solid black\"  align=\"right\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><b>$tot_liabilities1</b></font></td></tr>";

echo "<tr><td colspan=\"2\" style=\"border-bottom: 1px solid black\"  align=\"left\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><b>Equity</b></font> </td></tr>";



$query_equ ="select acc_sno,op_bal,acccode,acc_name,acc_desc,parent_acc,acc_type,fa_bull from accmast where fa_bull='t' and acc_type='Q' order by acccode";

$result_equ = pg_query($conn, $query_equ);



while ( $row_equ = pg_fetch_array($result_equ) )
{
echo "<tr><td style=\"border-bottom: 1px solid black\"  align=\"left\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";
echo $row_equ['acc_name'];
echo "</font></td><td style=\"border-bottom: 1px solid black\"  align=\"right\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";
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

$last = $ss_tree[count($ss_tree)-2];

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

$last = $ss_tree[count($ss_tree)-2];

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

echo "<tr> <td style=\"border-bottom: 1px solid black\"  align=\"left\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><b>Net Profit (Retained Earnings):</b></font></td> <td style=\"border-bottom: 1px solid black\"  align=\"right\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><b>$tot_profit1</b></font></td></tr>";

echo "<tr> <td style=\"border-bottom: 1px solid black\"  align=\"left\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><b>Total Equity:</b></font></td> <td style=\"border-bottom: 1px solid black\"  align=\"right\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><b>$tot_equity1</b></font></td></tr>";


echo "<tr><td colspan=\"2\">&nbsp;</td></tr>";

$tot_lia_eq = $tot_liabilities + $tot_equity;

$tot_lia_eq = number_format($tot_lia_eq, 2, "." , ",");

echo "<tr> <td style=\"border-top: 1px solid black\"  align=\"right\"><font size=\"3\" face=\"Verdana, Arial, Helvetica, sans-serif\"><b>Liabilities + Equity:</b></font></td> <td style=\"border-top: 1px solid black\"  align=\"right\"><font size=\"3\" face=\"Verdana, Arial, Helvetica, sans-serif\"><b>$tot_lia_eq</b></font></td></tr>";



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
<br>
 <table width="75%" border="0" cellpadding="3" cellspacing="0" >
 <tr><td><font size="1" face="Verdana, Arial, Helvetica, sans-serif"> <? echo "Print Dated: " . date("r")." (GMT)"; ?>   </font>    </td></tr>
 </table>


			</td></tr>


      </table>
</table>



	</tr></table>
</center>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</body>
</html>
