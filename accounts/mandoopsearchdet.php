

<html>
<body>
<center>
<?
include("../db/db.php");
$hn = $_GET['hn'];

$query_trans ="select sno,  mandoop_id,  mandoop_name,  mandoop_bathaka,  designation,  branch_name,  bravo_number,  mobile_number,  joing_date,  termination_date,  is_active from mandoop where lower(mandoop_name) like '%$hn%' order by mandoop_name";

$result_trans = pg_query($conn, $query_trans);

if (!$result_trans) {
	echo "An error occured.\n";
	exit;
	}
$nrows = pg_num_rows($result_trans);
?>
<FORM NAME="childForm" onSubmit="return updateParent();" >
<?
echo "<table width=\"98%\" border=\"1\"  cellspacing=\"0\"><thead style=\"display:table-header-group;\"><tr><td style=\"border-bottom: 1px solid #999999\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">Sel</font></td><td style=\"border-bottom: 1px solid #999999\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">Representative Name</font></td><td style=\"border-bottom: 1px solid #999999\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">Branch</font></td><td style=\"border-bottom: 1px solid #999999\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">Designation</font></td><td style=\"border-bottom: 1px solid #999999\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">Telephone</font></td><td style=\"border-bottom: 1px solid #999999\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">Bravo Number</font></td><td style=\"border-bottom: 1px solid #999999\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">Active</font></td></tr></thead>";
while ($rows_trans = pg_fetch_array($result_trans)){

echo "<tr>";
$hid =  $rows_trans["sno"];
echo "<td><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><INPUT NAME=\"tem\" TYPE=\"RADIO\" value=\"$hid\"></font></td>" ;

echo "<INPUT NAME=\"tems\" TYPE=\"hidden\" value=\"$hid\">" ;
$cid = $hid;
echo "<INPUT NAME=\"cid\" TYPE=\"hidden\" value=\"$cid\">" ;

echo "<td><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">" .ucwords(strtolower($rows_trans["mandoop_name"])) . "</font></td>";
echo "<td><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">" . ucwords(strtolower($rows_trans["branch_name"])) . "</font></td>";

echo "<td><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">" .$rows_trans["designation"]. "</font></td>";

echo "<td><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">" .$rows_trans["mobile_number"]. "</font></td>";
echo "<td><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">" .$rows_trans["bravo_number"]. "</font></td>";



echo "<td><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";

if($rows_trans["is_active"]=="t"){ echo "Yes" ;} else { echo "No" ; }

echo "</font></font></td></tr>";
 


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
	opener.document.selhotel.hotelv.value = document.childForm.tems.value; 
    opener.document.selhotel.submit();
	self.close();
	return false; 
	 }
   }
	else{
  for ( var i=0 ; i<document.childForm.nor.value; i++){
   
	 if (document.childForm.tem[i].checked)
	 {
    opener.document.selhotel.hotelv.value = document.childForm.tems[i].value;

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