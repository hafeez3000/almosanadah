<center>


<?
include("../db/db.php");
$hn = $_GET['hn'];

$query_hotel ="select hotel_id, hotel_name,hotel_type,city from hotels where lower(hotel_name) ilike '%$hn%' order by hotel_name";

$result_hotel = pg_query($conn, $query_hotel);

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
echo "<td><INPUT NAME=\"tem\" TYPE=\"RADIO\" value=\"$hid\"></td>" ;

echo "<INPUT NAME=\"tems\" TYPE=\"hidden\" value=\"$hid\">" ;
$cid = substr($hid,0,2);
echo "<INPUT NAME=\"cid\" TYPE=\"hidden\" value=\"$cid\">" ;

echo "<td>" .$rows_hotel["hotel_name"] . "</td>";
echo "<td>" . $rows_hotel["hotel_type"] . "</td>";

echo "<td>" .$rows_hotel["city"]. "</td></tr>";

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
