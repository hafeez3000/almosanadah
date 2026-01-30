<?
include("db.php");

//where newacc=0
 
$array_account_code = array();
$array_account_desc = array();
$array_newacc = array();
$query_hotel ="select account_code,account_desc,newacc from tbs where newacc=0 ORDER BY account_desc";

$result_hotel = pg_query($query_hotel);

if (!$result_hotel) {
	echo "An error occured.\n";
	exit;
	}
while ($rows_hotel = pg_fetch_array($result_hotel)){

$array_account_code[] = $rows_hotel["account_code"];
$array_account_desc[] = $rows_hotel["account_desc"];
$array_newacc[] = $rows_hotel["newacc"];
}

pg_free_result($result_hotel);


$array_acc_name = array();
$array_acccode = array();

//where che_b='0' 

$query_hotel2 ="select acccode,acc_name from accmast  where che_b=0  ORDER BY acc_name";

$result_hotel2 = pg_query($query_hotel2);

if (!$result_hotel2) {
	echo "An error occured.\n";
	exit;
	}
while ($rows_hotel2 = pg_fetch_array($result_hotel2)){

$array_acc_name[] = $rows_hotel2["acc_name"];
$array_acccode[] = $rows_hotel2["acccode"];

}

pg_free_result($result_hotel2);


?> 

 <form name="selhotel" method="post" action="compa.php">

 <select id="acname" name="acname" >
     
       
        <?

		for($i=0;$i<count($array_account_code);$i++){
       
   echo  "<option value=\"$array_account_code[$i]\">$array_account_desc[$i] - $array_account_code[$i] - $array_newacc[$i]</option>";

		}

	?>
    </select>
<br><br>
	<select id="acname2" name="acname2" >
      
       
        <?

		for($i=0;$i<count($array_acccode);$i++){
       
   echo  "<option value=\"$array_acccode[$i]\">$array_acc_name[$i] - $array_acccode[$i]</option>";

		}

	?>
    </select>
<br>
<br>

<br>
<br>

<br>
<br>
   <input type="submit" name="submit" value="Update">

	</form>
<script>
 window.onload = function() {
	document.selhotel.acname2.focus();
 }
</script>