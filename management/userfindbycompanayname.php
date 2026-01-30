<html>
<body>
<center>
<script>
 var winl = (screen.width - 760) / 2; 
 var wint = (screen.height - 550) / 2;
</script>
<?
	include("../db/db.php");
	$hn = strtolower($_GET['hn']);
	
	$query_trans ="select user_sno,user_id,user_title,user_first_name,user_last_name,company_name ,online_status,sr_status,umrah_status,operations_status,management_status,accounts_status,hrm_status from users where lower(company_name) like '%$hn%' order by user_id";

	$result_trans = pg_query($conn, $query_trans);
	if (!$result_trans) 
	{
		echo "An error occured.\n";
		exit;
	}
	$nrows = pg_num_rows($result_trans);
?>

<table width="98%" ><tr><td bgcolor="#FFFFFF" align="right">
                          <a href="printusers.php?hn=<? echo $hn; ?>" target="printusers" onClick="window.open('', 'printusers','width=750,height=450,menubar=yes,scrollbars=yes, top='+wint+',left='+winl+' ').focus()"><img src="../images/print_icon.gif" width="16" height="16" ></a></font></td></tr></table>

<FORM NAME="childForm" onSubmit="return updateParent();" >
<?
echo "<table width=\"98%\" border=\"1\"  cellspacing=\"0\"><thead style=\"display:table-header-group;\"><tr><td style=\"border-bottom: 1px solid #999999\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">Sel</font></td><td style=\"border-bottom: 1px solid #999999\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">&nbsp;</font></td><td style=\"border-bottom: 1px solid #999999\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">User Id</font></td><td style=\"border-bottom: 1px solid #999999\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">User Name</font></td>
<td style=\"border-bottom: 1px solid #999999\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">Company Name</font></td>
<td style=\"border-bottom: 1px solid #999999\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">Online</font></td><td style=\"border-bottom: 1px solid #999999\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">S&R</font></td><td style=\"border-bottom: 1px solid #999999\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">Umrah</font></td><td style=\"border-bottom: 1px solid #999999\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">Operations</font></td><td style=\"border-bottom: 1px solid #999999\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">Management</font></td><td style=\"border-bottom: 1px solid #999999\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">Accounts</font></td><td style=\"border-bottom: 1px solid #999999\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">HRM</font></td></tr></thead>";

$rows=0;
$bgtr="#FFFFFF";
while ($rows_trans = pg_fetch_array($result_trans)){

if($rows%2==0){ $bgtr="#FFFFFF";}else { $bgtr="#E5E5E5";}
$rows++;

echo "<tr bgcolor=\"$bgtr\" >";
$hid =  $rows_trans["user_sno"];
echo "<td><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><INPUT NAME=\"tem\" TYPE=\"RADIO\" value=\"$hid\"></font></td>" ;

echo "<td><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><INPUT NAME=\"oks\" TYPE=\"submit\" value=\"OK\" onclick=\"document.childForm.submit()\"></font></td>" ;

echo "<INPUT NAME=\"tems\" TYPE=\"hidden\" value=\"$hid\">" ;
$cid = $hid;
echo "<INPUT NAME=\"cid\" TYPE=\"hidden\" value=\"$cid\">" ;

echo "<td><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">".$rows_trans["user_id"]."</font></td>";

echo "<td><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">" .$rows_trans["user_title"] ."." . $rows_trans["user_first_name"] ." " . $rows_trans["user_last_name"] . "</font></td>";

echo "<td><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">" . $rows_trans["company_name"] . "</font></td>";

echo "<td align =\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">" . $rows_trans["online_status"] . "</font></td>";



echo "<td align =\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">" .$rows_trans["sr_status"]. "</font></td>";
echo "<td align =\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">" .$rows_trans["umrah_status"]. "</font></td>";
echo "<td align =\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">" .$rows_trans["operations_status"]. "</font></td>";
echo "<td align =\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">" .$rows_trans["management_status"]. "</font></td>";
echo "<td align =\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">" .$rows_trans["accounts_status"]. "</font></td>";
 
echo "<td align =\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">" .$rows_trans["hrm_status"]. "</font></td></tr>";




}
echo "<tfoot style=\"display:table-footer-group;\"><tr><td colspan=\"12\" style=\"border-top: 1px solid #999999\" align=\"right\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">End of the Page</font></td></tr></tfoot>";
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
