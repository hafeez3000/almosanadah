<html>
<body>
<center>
<?
include("../db/db.php");
$hn = strtolower($_GET['hn']);

$s_assests = "A";
$s_liabilities = "L";
$s_income = "I";
$s_expenses = "E";
$s_equity = "Q";


$query_trans ="select acccode, acc_name,acc_desc,parent_acc,acc_type,op_bal from accmast where lower(acc_name) ilike '%$hn%' order by acccode";

$result_trans = pg_query($conn, $query_trans);

if (!$result_trans) {
	echo "An error occured.\n";
	exit;
	}
$nrows = pg_num_rows($result_trans);
?>


<FORM NAME="childForm" onSubmit="return updateParent();" >
<?
echo "<table width=\"98%\" border=\"1\"  cellspacing=\"0\"><thead style=\"display:table-header-group;\"><tr><td style=\"border-bottom: 1px solid #999999\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">Sel</font></td><td style=\"border-bottom: 1px solid #999999\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">A/C Code</font></td><td style=\"border-bottom: 1px solid #999999\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">Account Name</font></td><td style=\"border-bottom: 1px solid #999999\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">Account Desc</font></td><td style=\"border-bottom: 1px solid #999999\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">Account Type</font></td><td style=\"border-bottom: 1px solid #999999\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">Open Bal</font></td><td style=\"border-bottom: 1px solid #999999\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">Parent Account</font></td></tr></thead>";

$rows=0;
$bgtr="#FFFFFF";
while ($rows_trans = pg_fetch_array($result_trans)){

if($rows%2==0){ $bgtr="#FFFFFF";}else { $bgtr="#E5E5E5";}
$rows++;

echo "<tr bgcolor=\"$bgtr\" >";
$hid =  $rows_trans["acccode"];
echo "<td><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">$rows</font></td>" ;

echo "<INPUT NAME=\"tems\" TYPE=\"hidden\" value=\"$hid\">" ;
$cid = $hid;
echo "<INPUT NAME=\"cid\" TYPE=\"hidden\" value=\"$cid\">" ;

echo "<td><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">".$rows_trans["acccode"]."</font></td>";

echo "<td><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">" .$rows_trans["acc_name"] . "</font></td>";
echo "<td><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">" . $rows_trans["acc_desc"] . "</font></td>";

$s_acc_type_b="";
$s_acc_type=$rows_trans["acc_type"];
if($s_acc_type==$s_assests){  $s_acc_type_b="Assets"; }
if($s_acc_type==$s_liabilities){  $s_acc_type_b="Liabilities"; }
if($s_acc_type==$s_income){  $s_acc_type_b="Income"; }
if($s_acc_type==$s_expenses){  $s_acc_type_b="Expenses"; }
if($s_acc_type==$s_equity){  $s_acc_type_b="Equity"; }

echo "<td><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">" .$s_acc_type_b. "</font></td>";

echo "<td><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">" .$rows_trans["parent_acc"]. "</font></td>";

echo "<td><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">" .$rows_trans["op_bal"]. "</font></td></tr>";



}
echo "<tfoot style=\"display:table-footer-group;\"><tr><td colspan=\"7\" style=\"border-top: 1px solid #999999\" align=\"right\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">End of the Page</font></td></tr></tfoot>";
echo "</table>";
pg_free_result($result_trans);

?>
<br>



</form>


<SCRIPT LANGUAGE="JavaScript">
function updateParent() {
   if(document.childForm.nor.value==1){
      if (document.childForm.tem.checked)
	 {
	opener.document.selhotel.ac.value = document.childForm.tems.value;
	opener.document.selhotel.submit();
	self.close();
	return false;
	 }
   }
	else{
  for ( var i=0 ; i<document.childForm.nor.value; i++){

	 if (document.childForm.tem[i].checked)
	 {
    opener.document.selhotel.ac.value = document.childForm.tems[i].value;
   	opener.document.selhotel.submit();
 	self.close();
	return false;
	 }
  }
    }

}

</SCRIPT>

</center>
</body>
</html>
