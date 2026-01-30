<center>
<body>


<script>
// Last updated 2006-02-21
function addRowToTable()
{


 

  var tbl = document.getElementById('tblSample');
  var lastRow = tbl.rows.length;
//  var pval = '<? echo $array_room_id[0] ; ?>'
   var pval = '<? if($array_room_id[0]=="") { echo $s_hotelsb . "11"; } else { echo $array_room_id[0] ;}?>'
//  var pval = 0 ; ?>'
  // if there's no header row in the table, then iteration = lastRow + 1

  var iteration = lastRow;



 // var iteration = parseInt(pval) + lastRow -1;



  var row = tbl.insertRow(lastRow);
  
  // left cell
  var cellLeft = row.insertCell(0);
 
  var rid = document.createElement('input');
  rid.type = 'text';
  rid.name = 'sno' + iteration;
  rid.id = 'sno' + iteration;
  rid.size = 3;
  cellLeft.appendChild(rid);

 

  var cellRight = row.insertCell(1);
  var el = document.createElement('input');
  el.type = 'text';
  el.name = 'spon' + iteration;
  el.id = 'spon' + iteration;
  el.size = 28;
  cellRight.appendChild(el);



  var cellviewtype = row.insertCell(2);
  var rvt = document.createElement('input');
  rvt.type = 'text';
  rvt.name = 'hotels' + iteration;
  rvt.id = 'hotels' + iteration;
  rvt.size = 50;
  cellviewtype.appendChild(rvt);



  var cellnofp = row.insertCell(3);
  var nofp = document.createElement('input');
  nofp.type = 'text';
  nofp.name = 'links' + iteration;
  nofp.id = 'links' + iteration;
  nofp.size = 20;
  cellnofp.appendChild(nofp);
  



 

}


function removeRowFromTable()
{
  var tbl = document.getElementById('tblSample');
  var lastRow = tbl.rows.length;
  if (lastRow > 2) tbl.deleteRow(lastRow - 1);
  document.getElementById('it_val').value=tbl.rows.length-1;

  document.getElementById('it_val').value = lastRow;
}








</script>

		 <form name="gquot" method="post" action="amendspra.php" onSubmit="return fun2(this)">

<table border="1" id="tblSample" width="100%">
  <tr>
    <th><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Sno</font></th>    <th><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Special Offer Name</font></th>    <th><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Hotels</font></th>    <th><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Link</font></th>
</tr>
<?
$filename = "spr.csv";


$id = fopen($filename, "r"); //open the file
while ($data = fgetcsv($id, filesize($filename))) //start a loop
$table[] = $data; //put each line into its own entry in the $table array
fclose($id);

$rowc=1;
foreach($table as $row)
{


echo "<tr>";

	echo "<td><input type=\"text\" name=\"sno$rowc\" id=\"sno$rowc\" size=\"3\"  value=\"$row[0]\" /></td>";

echo "<td><input type=\"text\" name=\"spon$rowc\" id=\"spon$rowc\" size=\"28\"  value=\"$row[1]\" /></td>";

echo "<td><input type=\"text\" name=\"hotels$rowc\" id=\"hotels$rowc\" size=\"50\"  value=\"$row[2]\" /></td>";

echo "<td><input type=\"text\" name=\"links$rowc\" id=\"links$rowc\" size=\"20\"  value=\"$row[3]\" /></td>";

echo "</tr>";

$rowc++;
}

?>

</table>


<br>
<input type="button" value="Add" onClick="addRowToTable();" />

<input type="hidden" id="it_val" name="it_val" />
<input type="hidden" name="action" value="unsubmitted" /> 
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input type="checkbox" id="inscb" name="inscb" unchecked onClick="sameas();" />
<input type="submit" value="Amend Special Offers" id="Submit" disabled />
<input type="button" value="Remove" onClick="removeRowFromTable();" />

</form>


<script>

function sameas(){



if(document.getElementById('inscb').checked==true){

 var tbl = document.getElementById('tblSample');
 var fct = tbl.rows.length; 
 document.getElementById('it_val').value = fct;


document.getElementById('Submit').disabled=false;
}
else {
document.getElementById('Submit').disabled=true;
}


  } //end of second bull





function fun2(theForm){



}

</script>
</body>
</center>