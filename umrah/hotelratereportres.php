<center>


<?
include("../db/db.php");

$a_hotelid = array();

$query_gr ="select room_id from res_rates";

$result_gr = pg_query($conn, $query_gr);

if (!$result_gr) {
	echo "An error occured.\n";
	exit;
	}
while ($rows_gr = pg_fetch_array($result_gr)){

 

$a_roomid[] = substr($rows_gr["room_id"],0,5);

}

$a_roomid = array_unique($a_roomid);
sort($a_roomid);





$query_hotel ="select hotel_id, hotel_name,hotel_type,city from hotels order by city, hotel_name ";

$result_hotel = pg_query($conn, $query_hotel);

if (!$result_hotel) {
	echo "An error occured.\n";
	exit;
	}
$nrows = pg_num_rows($result_hotel);
?>
<FORM NAME="childForm" onSubmit="return updateParent();" >
<?
echo "<table width=\"90%\" border=\"1\"  cellspacing=\"0\"><thead style=\"display:table-header-group;\"><tr><td style=\"border-bottom: 1px solid #999999\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">Sel</font></td><td style=\"border-bottom: 1px solid #999999\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">Hotel Name</font></td><td style=\"border-bottom: 1px solid #999999\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">Hotel Type</font></td><td style=\"border-bottom: 1px solid #999999\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">City</font></td><td style=\"border-bottom: 1px solid #999999\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">Status</font></td></tr></thead>";
while ($rows_hotel = pg_fetch_array($result_hotel)){

echo "<tr>";
$hid =  $rows_hotel["hotel_id"];

for($bc=0; $bc<count($a_roomid); $bc++){
if($hid==$a_roomid[$bc]) {
$bgc="#8AFF8A";
$stb="Yes";
break;
}
else {
$bgc="#FFAEAE";
$stb="No";
}
}

echo "<td bgcolor= \"$bgc\"><INPUT NAME=\"tem\" TYPE=\"RADIO\" value=\"$hid\"></td>" ;

echo "<INPUT NAME=\"tems\" TYPE=\"hidden\" value=\"$hid\">" ;
$cid = substr($hid,0,2);
echo "<INPUT NAME=\"cid\" TYPE=\"hidden\" value=\"$cid\">" ;

echo "<td bgcolor= \"$bgc\" ><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">" .$rows_hotel["hotel_name"] . "</font></td>";
echo "<td bgcolor= \"$bgc\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">" . $rows_hotel["hotel_type"] . "</font></td>";

echo "<td bgcolor= \"$bgc\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">" .$rows_hotel["city"]. "</font></td>";

echo "<td align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">" .$stb. "</font></font></td></tr>";


}
echo "<tfoot style=\"display:table-footer-group;\"><tr><td colspan=\"5\" style=\"border-top: 1px solid #999999\" align=\"right\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">End of the Page</font></td></tr></tfoot>";
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
	opener.document.gquot.hotelsb.value = document.childForm.tems.value; 
    opener.document.gquot.submit();
	self.close();
	return false; 
	 }
   }
	else{
  for ( var i=0 ; i<document.childForm.nor.value; i++){
   
	 if (document.childForm.tem[i].checked)
	 {
    opener.document.gquot.hotelsb.value = document.childForm.tems[i].value;

    opener.document.gquot.submit();

	self.close();
	return false; 
	 }
  }
    }
	
}

</SCRIPT>

</center>