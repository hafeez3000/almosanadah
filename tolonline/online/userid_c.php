<? 
include("../db/db.php");
?>

<html>
<center>
<body bgcolor="green">
<table width="98%" height="98%" bgcolor="white" align="center">
<tr><td align="center">

<script>
document.title= '<? echo "DORS ERP - Userid Check"; ?>';
</script>

<?
 
 $uid = $_GET['u_id'] ;

 $uid = strtolower($uid);

 $sql = "SELECT user_sno,user_id FROM users WHERE LOWER(user_id) = '$uid' ";

   $result = pg_query($sql) ;
    if (!$result) {
	echo "An error occured.\n";
	exit;
	}


   if (pg_num_rows($result) == 1) {

  echo "<font size=\"3\" face=\"Verdana, Arial, Helvetica, sans-serif\"><b>Sorry!, <br><br>Userid <font color=\"red\" >$uid</font> already taken</b></font>";

   
   }
else {

   echo "<font size=\"3\" face=\"Verdana, Arial, Helvetica, sans-serif\"><b>Congratulation!, <br><br>Userid <font color=\"red\" >$uid</font> is Available</b></font>";
 
}

?>

</td>
</tr>

<tr>
<td align="center">
<input type="button" value="Close" onclick="self.close()">
</td>
</tr>
</table>



</body>
</center>
</html>