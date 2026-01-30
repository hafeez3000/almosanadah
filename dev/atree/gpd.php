<?

include("../../db/db.php"); 


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

$nav_query = pg_query($query_acc);

while ( $nav_row = pg_fetch_array($nav_query) )
{

$c_arr[] = $nav_row['acccode'];
$p_arr[] = $nav_row['parent_acc'];

}

echo "<table border=\"1\">";
echo "<tr><td colspan=\"2\">Assets</td></tr>";

$query_ass ="select acc_sno,op_bal,acccode,acc_name,acc_desc,parent_acc,acc_type,fa_bull from accmast where fa_bull='t' and acc_type='A' order by acccode";

$result_ass = pg_query($query_ass);



while ( $row_ass = pg_fetch_array($result_ass) )
{
echo "<tr><td>";
echo $row_ass['acc_name'];
echo "</td><td>";
$acc = $row_ass['acccode'];
$tree .= test_fun($acc);

$s_tree = $tree;
$ss_tree = split(",",$s_tree);
$first = $ss_tree[0];

$last = $ss_tree[count($ss_tree)-2];

$op_query= "select  sum(dbamt) as db, sum(cramt) as cr, (select sum(op_bal) from accmast where acccode between '$first' and '$last') as op_bal, sum(dbamt-cramt) as bal  from vocmast where acccode between '$first' and '$last' ";

$op_result = pg_query($op_query);
while ($op_row = pg_fetch_array($op_result))
	{
	 
   $op_bal =$op_row["op_bal"];
   $bal =$op_row["bal"];
echo $tot = $op_bal + $bal;
	}
$tot_assets = $tot_assets+$tot ;

$tree="";
echo "</td></tr>";
}

echo "<tr><td>Total Assets: </td><td>$tot_assets</td></tr>";

echo "<tr><td colspan=\"2\">&nbsp;</td></tr>";

echo "<tr><td colspan=\"2\">Liabilities </td></tr>";


$query_lia ="select acc_sno,op_bal,acccode,acc_name,acc_desc,parent_acc,acc_type,fa_bull from accmast where fa_bull='t' and acc_type='L' order by acccode";

$result_lia = pg_query($query_lia);



while ( $row_lia = pg_fetch_array($result_lia) )
{
echo "<tr><td>";
echo $row_lia['acc_name'];
echo "</td><td>";
$acc = $row_lia['acccode'];
$tree .= test_fun($acc);

$s_tree = $tree;
$ss_tree = split(",",$s_tree);
$first = $ss_tree[0];

$last = $ss_tree[count($ss_tree)-2];

$op_query= "select  sum(dbamt) as db, sum(cramt) as cr, (select sum(op_bal) from accmast where acccode between '$first' and '$last') as op_bal, sum(cramt-dbamt) as bal  from vocmast where acccode between '$first' and '$last' ";

$op_result = pg_query($op_query);
while ($op_row = pg_fetch_array($op_result))
	{
	 
   $op_bal =$op_row["op_bal"];
   $bal =$op_row["bal"];
echo $tot = $op_bal + $bal;
	}
$tot_liabilities = $tot_liabilities+$tot ;

$tree="";
echo "</td></tr>";
}

echo "<tr><td>Total Liabilities: </td><td>$tot_liabilities</td></tr>";


echo "<tr><td colspan=\"2\">Equity </td></tr>";


$query_equ ="select acc_sno,op_bal,acccode,acc_name,acc_desc,parent_acc,acc_type,fa_bull from accmast where fa_bull='t' and acc_type='Q' order by acccode";

$result_equ = pg_query($query_equ);



while ( $row_equ = pg_fetch_array($result_equ) )
{
echo "<tr><td>";
echo $row_equ['acc_name'];
echo "</td><td>";
$acc = $row_equ['acccode'];
$tree .= test_fun($acc);

$s_tree = $tree;
$ss_tree = split(",",$s_tree);
$first = $ss_tree[0];

$last = $ss_tree[count($ss_tree)-2];

$op_query= "select  sum(dbamt) as db, sum(cramt) as cr, (select sum(op_bal) from accmast where acccode between '$first' and '$last') as op_bal, sum(cramt-dbamt) as bal  from vocmast where acccode between '$first' and '$last' ";

$op_result = pg_query($op_query);
while ($op_row = pg_fetch_array($op_result))
	{
	 
   $op_bal =$op_row["op_bal"];
echo    $bal =$op_row["bal"];
echo $tot = $op_bal + $bal;
	}
$tot_equity = $tot_equity+$tot ;

$tree="";
echo "</td></tr>";
}



// income

$acc = '500000';
$tree .= test_fun($acc);

$s_tree = $tree;
$ss_tree = split(",",$s_tree);
$first = $ss_tree[0];

$last = $ss_tree[count($ss_tree)-2];

$op_query= "select  sum(dbamt) as db, sum(cramt) as cr, (select sum(op_bal) from accmast where acccode between '$first' and '$last') as op_bal, sum(cramt-dbamt) as bal  from vocmast where acccode between '$first' and '$last' ";

$op_result = pg_query($op_query);
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
$tree .= test_fun($acc);

$s_tree = $tree;
$ss_tree = split(",",$s_tree);
$first = $ss_tree[0];

$last = $ss_tree[count($ss_tree)-2];

$op_query= "select  sum(dbamt) as db, sum(cramt) as cr, (select sum(op_bal) from accmast where acccode between '$first' and '$last') as op_bal, sum(dbamt-cramt) as bal  from vocmast where acccode between '$first' and '$last' ";

$op_result = pg_query($op_query);
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
$tot_equity=$tot_equity+$tot_profit;

echo "<tr><td>Net Profit (Earnings): </td><td>$tot_profit</td></tr>";

echo "<tr><td>Total Equity: </td><td>$tot_equity</td></tr>";

echo "<tr><td colspan=\"2\">&nbsp;</td></tr>";

$tot_lia_eq = $tot_liabilities + $tot_equity;

echo "<tr><td>Liabilities + Equity: </td><td>$tot_lia_eq</td></tr>";

echo "</table>";











function test_fun($fc){
global $exclude,$depth,$c_arr,$p_arr;

$query_acc1 ="select acc_sno,acccode,acc_name,acc_desc,parent_acc,acc_type from accmast  where parent_acc='$fc' order by acccode";
$child_query = pg_query($query_acc1);

	while ( $child = pg_fetch_array($child_query) )
	{
		if ( $child['acccode'] != $child['parent_acc'] )
		{

for ( $c=0;$c<$depth;$c++ )	

$tempTree .= $child['acccode'].",";
$depth++;
$tempTree .= test_fun($child['acccode']);
$depth--;
array_push($exclude, $child['acccode']);	

}

}



return $tempTree;

}



?>


