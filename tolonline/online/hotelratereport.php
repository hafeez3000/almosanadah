<center>


<?
include("../db/db.php");

$a_hotelid = array();

$query_gr ="select hotel_id from group_rates";

$result_gr = pg_query($query_gr);

if (!$result_gr) {
	echo "An error occured.\n";
	exit;
	}
while ($rows_gr = pg_fetch_array($result_gr)){

$a_hotelid[] = $rows_gr["hotel_id"];

}

$a_hotelid = array_unique($a_hotelid);
sort($a_hotelid);





$query_hotel ="select hotel_id, hotel_name,hotel_type,city from hotels order by city, hotel_name ";

$result_hotel = pg_query($query_hotel);

if (!$result_hotel) {
	echo "An error occured.\n";
	exit;
	}
$nrows = pg_num_rows($result_hotel);
?>
<FORM NAME="childForm" onSubmit="return updateParent();" >
<?
echo "<table width=\"90%\" border=\"1\"  cellspacing=\"0\"><thead style=\"display:table-header-group;\"><tr><td style=\"border-bottom: 1px solid #999999\">Sel</td><td style=\"border-bottom: 1px solid #999999\">Hotel Name</td><td style=\"border-bottom: 1px solid #999999\">Hotel Type</td><td style=\"border-bottom: 1px solid #999999\">City</td></tr></thead>";
while ($rows_hotel = pg_fetch_array($result_hotel)){

echo "<tr>";
$hid =  $rows_hotel["hotel_id"];

for($bc=0; $bc<count($a_hotelid); $bc++){
if($hid==$a_hotelid[$bc]) {
$bgc="#8AFF8A";
break;
}
else {
$bgc="#FFAEAE";
}
}

echo "<td bgcolor= \"$bgc\"><INPUT NAME=\"tem\" TYPE=\"RADIO\" value=\"$hid\"></td>" ;

echo "<INPUT NAME=\"tems\" TYPE=\"hidden\" value=\"$hid\">" ;
$cid = substr($hid,0,2);
echo "<INPUT NAME=\"cid\" TYPE=\"hidden\" value=\"$cid\">" ;

echo "<td bgcolor= \"$bgc\" >" .$rows_hotel["hotel_name"] . "</td>";
echo "<td bgcolor= \"$bgc\">" . $rows_hotel["hotel_type"] . "</td>";

echo "<td bgcolor= \"$bgc\">" .$rows_hotel["city"]. "</td></tr>";

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