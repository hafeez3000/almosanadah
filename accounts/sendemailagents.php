<center>
<?


include("../db/db.php"); 

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$acco =  $_SESSION['email_ac'];

$fromd = $_GET["fd"];
$tod  = $_GET["td"];
$acc = "";



function send_email($accn, $fd, $td){

echo "Sending Email to " .$accn;
echo "<br>";

echo "<script>window.open(\"sendmbm.php?accn=$accn&fd=$fd&td=$td\",$accn,\"width=500,height=200,scrollbars=yes,top=0,left=0\").focus();</script>";

}



for($i=0; $i<count($acco); $i++){
$s_ac= $acco[$i];

send_email($s_ac,$fromd,$tod);

}







    


?>
</table>
</center>