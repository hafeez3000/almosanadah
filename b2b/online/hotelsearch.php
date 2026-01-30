<html>
<body>
<center>


<?
include("../db/db.php");
$hn = strtolower($_GET['hn']);

$query_hotel ="select hotel_id, hotel_name,hotel_type,city from hotels where lower(hotel_name) like '%$hn%' order by hotel_name";

$result_hotel = pg_query($query_hotel);

if (!$result_hotel) {
	echo "An error occured.\n";
	exit;
	}
$nrows = pg_num_rows($result_hotel);
?>
<FORM NAME="childForm" onSubmit="return updateParent();" >
<?
echo "<table width=\"98%\" border=\"1\"  cellspacing=\"0\"><thead style=\"display:table-header-group;\"><tr><td style=\"border-bottom: 1px solid #999999\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">Sel</font></td><td style=\"border-bottom: 1px solid #999999\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">OK</font></td><td style=\"border-bottom: 1px solid #999999\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">Hotel Name</font></td><td style=\"border-bottom: 1px solid #999999\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">Hotel Type</font></td><td style=\"border-bottom: 1px solid #999999\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">City</font></td></tr></thead>";
$rows=0;
$bgtr="#FFFFFF";
while ($rows_hotel = pg_fetch_array($result_hotel)){

if($rows%2==0){ $bgtr="#FFFFFF";}else { $bgtr="#E5E5E5";}
$rows++; 

echo "<tr bgcolor=\"$bgtr\" >";
$hid =  $rows_hotel["hotel_id"];
echo "<td><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><INPUT NAME=\"tem\" TYPE=\"RADIO\" value=\"$hid\"></font></td>" ;

echo "<td><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><INPUT NAME=\"oks\" TYPE=\"submit\" value=\"OK\" onclick=\"document.childForm.submit()\"></font></td>" ;

echo "<INPUT NAME=\"tems\" TYPE=\"hidden\" value=\"$hid\">" ;
//echo $cid = substr($hid,0,2);

 $cid = $hid;

echo "<INPUT NAME=\"cid\" TYPE=\"hidden\" value=\"$cid\">" ;

echo "<td><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">" .$rows_hotel["hotel_name"] . "</font></td>";
echo "<td><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">" . $rows_hotel["hotel_type"] . "</font></td>";

echo "<td><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">" .$rows_hotel["city"]. "</font></td></tr>";

}
echo "<tfoot style=\"display:table-footer-group;\"><tr><td colspan=\"4\" style=\"border-top: 1px solid #999999\" align=\"right\">End of the Page</td></tr></tfoot>";
echo "</table>";
pg_free_result($result_hotel);

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