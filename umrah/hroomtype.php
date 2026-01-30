<?
include ("header.php");
?>

<table width="100%" border="0" cellpadding="0" cellspacing="0" style="border-bottom: 3px solid #006600; border-right: 3px solid #006600;border-left: 3px solid #006600 ">
  <tr>
    <td width="20%" style="border-right: 1px solid #999999"  valign="top"> <table width="100%" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td valign="top"><div align="left"> 
              <?php include  ("umenupreline.php"); ?>
            </div></td>
        </tr>
      </table></td>
    <td width="80%" valign="top"  > <table width="100%" border="0" cellpadding="0" cellspacing="1">
        <tr>
          <td valign="top"> 

		  <table cellpadding="0" cellspacing="0" width="100%" style="border-top: 1px solid #999999; border-bottom: 1px solid #999999"><tr>
                      <td bgcolor="#CCCCCC"><strong> <font size="2" face="Verdana, Arial, Helvetica, sans-serif">Hotel Room Types</font></td>
                    </tr></table>


<?

$s_hotelsb = $_GET["shotid"];

if(trim($s_hotelsb)==""){
$s_hotelsb = $_POST["hotelsb"];
}





$query_hotel ="select hotel_id, hotel_name, city from hotels order by hotel_name";

$result_hotel = pg_query($conn, $query_hotel);

if (!$result_hotel) {
	echo "An error occured.\n";
	exit;
	}
while ($rows_hotel = pg_fetch_array($result_hotel)){

$array_hotel[] = $rows_hotel["hotel_name"];
$array_hotel_id[] = $rows_hotel["hotel_id"];
$array_city[] = $rows_hotel["city"];

}

pg_free_result($result_hotel);



if($s_hotelsb==""){}
else{

$query_rooms ="select room_id, room_type,view_type,no_of_paxs,room_description from rooms where room_id like '$s_hotelsb%' order by room_id";

$result_rooms = pg_query($conn, $query_rooms);

if (!$result_rooms) {
	echo "An error occured.\n";
	exit;
	}
while ($rows_rooms = pg_fetch_array($result_rooms)){

$array_rooms[] = $rows_rooms["room_type"];
$array_room_id[] = $rows_rooms["room_id"];
$array_view_type[] = $rows_rooms["view_type"];
$array_nofp[] = $rows_rooms["no_of_paxs"];
$array_room_description[] = $rows_rooms["room_description"];


}

pg_free_result($result_rooms);

}



for($ac=0; $ac<count($array_hotel_id); $ac++){

$inco = $array_hotel_id[$ac];

if($s_hotelsb==$inco){
$s_hname=$array_hotel[$ac];
$s_city=$array_city[$ac];
}
}

?>


<script>
// Last updated 2006-02-21
function addRowToTable()
{

if(document.getElementById ('hotelsb').value == "selecth"){
			alert("Please Select Hotel");
		
} else {
 

  var tbl = document.getElementById('tblSample');
  var lastRow = tbl.rows.length;
//  var pval = '<? echo $array_room_id[0] ; ?>'
   var pval = '<? if($array_room_id[0]=="") { echo $s_hotelsb . "11"; } else { echo $array_room_id[0] ;}?>'
//  var pval = 0 ; ?>'
  // if there's no header row in the table, then iteration = lastRow + 1
//  var iteration = lastRow;
  var iteration = parseInt(pval) + lastRow -1;
  

  var row = tbl.insertRow(lastRow);
  
  // left cell
  var cellLeft = row.insertCell(0);
 
//  var textNode = document.createTextNode(iteration);
//  cellLeft.appendChild(textNode);

  var rid = document.createElement('input');
  rid.type = 'text';
  rid.name = 'txtid' + iteration;
  rid.id = 'txtid' + iteration;
  rid.value =  iteration;
  rid.size = 5;
  rid.setAttribute("readOnly","true");
  cellLeft.appendChild(rid);

 
  // right cell
  var cellRight = row.insertCell(1);
  var el = document.createElement('input');
  el.type = 'text';
  el.name = 'txtRow' + iteration;
  el.id = 'txtRow' + iteration;
  el.size = 30;
  cellRight.appendChild(el);

  var cellviewtype = row.insertCell(2);
  var rvt = document.createElement('input');
  rvt.type = 'text';
  rvt.name = 'viewtype' + iteration;
  rvt.id = 'viewtype' + iteration;
  rvt.size = 7;
  cellviewtype.appendChild(rvt);


  var cellnofp = row.insertCell(3);
  var nofp = document.createElement('input');
  nofp.type = 'text';
  nofp.name = 'nofp' + iteration;
  nofp.id = 'nofp' + iteration;
  nofp.size = 1;
  cellnofp.appendChild(nofp);
  

 
  var cellroomd = row.insertCell(4);
  var roomd = document.createElement('input');
  roomd.type = 'text';
  roomd.name = 'roomd' + iteration;
  roomd.id = 'roomd' + iteration;
  roomd.size = 30;
  cellroomd.appendChild(roomd);
  


  document.getElementById('txtRow' + iteration).focus();
  document.getElementById('it_val').value=tbl.rows.length-1;


} // checking hotel select

}
function removeRowFromTable()
{
  var tbl = document.getElementById('tblSample');
  var lastRow = tbl.rows.length;
  if (lastRow > 2) tbl.deleteRow(lastRow - 1);
  document.getElementById('it_val').value=tbl.rows.length-1;
}
</script>


<?

if (isset($_POST['action']) && $_POST['action'] == 'submitted') {

$cbb=0;

if($_POST["inscb"]=="on"){
session_start();
$_SESSION['cb'] = 1;
}

$cbb=$_SESSION['cb'];
unset($_SESSION['cb']);



if($cbb==1) {  // ins first
$delrs = "delete from rooms where room_id like '$s_hotelsb%' ";
pg_query($conn, $delrs);






echo $it_val = $_POST["it_val"];
echo "<br>";

for($vt=0;$vt<$it_val;$vt++){

$query_gsno ="select roomtype_sno from seq";

$result_gsno = pg_query($conn, $query_gsno);

if (!$result_gsno) {
echo "An error occured.\n";
exit;
		}
while ($rows_gsno = pg_fetch_array($result_gsno)){
$gsno_seq = $rows_gsno["roomtype_sno"];
}

pg_free_result($result_gsno);

if($array_room_id[0]=="") { echo $vt1 = $s_hotelsb . "11" + $vt; } else { echo $vt1 =  $array_room_id[0] + $vt;}
//echo $vt1 = $array_room_id[0]+$vt;
echo "=>";
echo $rtname  = $_POST["txtRow".$vt1];
echo "|";
echo $rviewtype = $_POST["viewtype".$vt1];
echo "|";
echo $rnoofp  = $_POST["nofp".$vt1];
echo "|";
echo $rdesc  = $_POST["roomd".$vt1];
echo "<br>";

$sqlinsgr = "insert into rooms(room_sno, room_id, room_type, view_type, no_of_paxs,room_description) values($gsno_seq, $vt1, '$rtname', '$rviewtype', $rnoofp, '$rdesc')"; 
pg_query($conn, $sqlinsgr);

$sequpdateg_rate_sno = "update seq set roomtype_sno=roomtype_sno+1";
pg_query($conn, $sequpdateg_rate_sno);

}


$cbb=0;

echo "<script>document.location.href=\"updateaval.php?shot_id=$s_hotelsb\"</script>";

} // ins first

}  // ins second

?>

<form name="gquot" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" onSubmit="return fun2(this)">
                                <select id="hotelsb" name="hotelsb" onchange="this.form.submit();">
<?
if ($s_hotelsb!="") {
	
echo  "<option value=\"$s_hotelsb\">$s_hname - $s_city</option>";}
?>
								  <option value="selecth">Select Hotel</option>
                                  <?


		for($i=0;$i<count($array_hotel_id);$i++){

  echo  "<option value=\"$array_hotel_id[$i]\">$array_hotel[$i] - $array_city[$i]</option>";

}
	?>
                                </select><input type="button" name="grates" value="Get Room Types" onClick="checkh();">  
                                <script>
			
			function checkh(){
			if(document.getElementById ('hotelsb').value == "selecth"){
			alert("Please Select Hotel");
		
			}
			else{
			document.gquot.submit();
			}
            }



function sameas(){

if(document.getElementById('inscb').checked==true){
document.getElementById('Submit').disabled=false;
}
else {
document.getElementById('Submit').disabled=true;
}

}




			</script>
<br><br>
<div align="center"><font size="3" face="Verdana, Arial, Helvetica, sans-serif"><b>Hotel Room Types Modifications</b></font></div> 
<table border="1" id="tblSample" width="100%">
  <tr>
    <th><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Room_Id</font></th>    <th><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Room_Type</font></th>    <th><font size="2" face="Verdana, Arial, Helvetica, sans-serif">View_Type</font></th>    <th><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Paxs</font></th>    <th><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Room_Description</font></th>
</tr>
  

<?
		for($i=0;$i<count($array_room_id);$i++){

 	echo "<tr>";
	echo "<td><input type=\"text\" name=\"txtid$array_room_id[$i]\" id=\"txtid$array_room_id[$i]\" size=\"5\" value=\"$array_room_id[$i]\" readonly /></td>";

    echo "<td><input type=\"text\" name=\"txtRow$array_room_id[$i]\" id=\"txtRow$array_room_id[$i]\" size=\"30\" value=\"$array_rooms[$i]\" /></td>";
		

    echo "<td><input type=\"text\" name=\"viewtype$array_room_id[$i]\" id=\"viewtype$array_room_id[$i]\" size=\"7\" value=\"$array_view_type[$i]\" /></td>";

	 echo "<td><input type=\"text\" name=\"nofp$array_room_id[$i]\" id=\"nofp$array_room_id[$i]\" size=\"1\" value=\"$array_nofp[$i]\" /></td>";

	  echo "<td><input type=\"text\" name=\"roomd$array_room_id[$i]\" id=\"roomd$array_room_id[$i]\" size=\"30\" value=\"$array_room_description[$i]\" /></td>";


		  echo 	"</tr>";
		}
?>

</table>

<p>
<input type="button" value="Add" onclick="addRowToTable();" />

<input type="hidden" id="it_val" name="it_val" value='<? echo count($array_room_id) ; ?>'/>
<input type="hidden" name="action" value="unsubmitted" /> 
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input type="checkbox" id="inscb" name="inscb" unchecked onClick="sameas();" onBlur="sameas();" onFocus="sameas();"/>
<input type="submit" value="Submit" id="Submit" disabled />
<input type="button" value="Remove" onclick="removeRowFromTable();" />
<div align="center"><font size="3" face="Verdana, Arial, Helvetica, sans-serif" color="#FF0000"><b>Submit Process may take very long time ....</b></font></div>

</p>

</form>


     </td></tr></table> 

</td></tr></table> 

</td></tr></table> 

</td></tr></table> 


<script>
   

function fun2(theForm){






if(document.getElementById("inscb").checked == true){ 
document.getElementById("action").value="submitted";
}




}
</script>



