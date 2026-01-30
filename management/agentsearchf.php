<html>
<body>
<center>
<?
include("../db/db.php");
$hn = strtolower($_GET['hn']);


$query_trans ="select acccode, aname, country from agentsdet where lower(aname)  like '%$hn%' and acccode!='0' and acccode!='' order by aname";

$result_trans = pg_query($conn, $query_trans);

if (!$result_trans) {
	echo "An error occured.\n";
	exit;
	}
$nrows = pg_num_rows($result_trans);
?>
<FORM NAME="childForm" onSubmit="return updateParent();" >
<?
echo "<table width=\"98%\" border=\"1\"  cellspacing=\"0\"><thead style=\"display:table-header-group;\"><tr><td style=\"border-bottom: 1px solid #999999\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">Sel</font></td><td style=\"border-bottom: 1px solid #999999\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">OK</font></td><td style=\"border-bottom: 1px solid #999999\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">A/C Code</font></td><td style=\"border-bottom: 1px solid #999999\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">Agent Name</font></td><td style=\"border-bottom: 1px solid #999999\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">Agent Country</font></td></tr></thead>";

$rows=0;
$bgtr="#FFFFFF";
while ($rows_trans = pg_fetch_array($result_trans)){

if($rows%2==0){ $bgtr="#FFFFFF";}else { $bgtr="#E5E5E5";}
$rows++;

echo "<tr bgcolor=\"$bgtr\" >";
$hid =  $rows_trans["acccode"];
echo "<td><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><INPUT NAME=\"tem\" TYPE=\"RADIO\" value=\"$hid\"></font></td>" ;

echo "<td><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><INPUT NAME=\"oks\" TYPE=\"submit\" value=\"OK\" onclick=\"document.childForm.submit()\"></font></td>" ;

echo "<INPUT NAME=\"tems\" TYPE=\"hidden\" value=\"$hid\">" ;
$cid = $hid;
echo "<INPUT NAME=\"cid\" TYPE=\"hidden\" value=\"$cid\">" ;

echo "<td><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">".$rows_trans["acccode"]."</font></td>";

echo "<td><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">" .$rows_trans["aname"] . "</font></td>";
echo "<td><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">" . $rows_trans["country"] . "</font></td>";
 


}
echo "<tfoot style=\"display:table-footer-group;\"><tr><td colspan=\"7\" style=\"border-top: 1px solid #999999\" align=\"right\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">End of the Page</font></td></tr></tfoot>";
echo "</table>";
pg_free_result($result_trans);

?>
<br>

<input type="submit" name="submit" value="Ok, I have Selected" > 
<input type="hidden" name="nor" value="<? echo $nrows; ?>">
</form>


<SCRIPT LANGUAGE="JavaScript">
function updateParent() {
   if(document.childForm.nor.value==1){
      if (document.childForm.tem.checked)
	 {      
	opener.document.selhotel.account_code.value = document.childForm.tems.value; 
    opener.document.selhotel.account_code.focus();

	self.close();
	return false; 
	 }
   }
	else{
  for ( var i=0 ; i<document.childForm.nor.value; i++){
   
	 if (document.childForm.tem[i].checked)
	 {
    opener.document.selhotel.account_code.value = document.childForm.tems[i].value;
    opener.document.selhotel.account_code.focus();	
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