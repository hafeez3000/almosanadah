
<?
include("../db/db.php"); 


?>

<?

$s_pnr = $_GET["spnr"]; 
$s_sid = $_GET["sid"]; 
$s_img = $_GET["img"]; 

$uploaddir = "..//uploads/";




$sqldelm = "delete from cussup_gallery where ocode='$s_pnr' and cussupgid=$s_sid ";
pg_query($conn, $sqldelm);


/*add a record to pnrhistory table*/

$changeopdate = "INSERT INTO pnrhistory(user_sno, ocode, description, created_at) VALUES ('$suser_sno', '$s_pnr', 'Customer / Supplier Voucher or Payments images is deleted', 'now()')";
pg_query($conn, $changeopdate);
/*END - add a record to pnrhistory table*/	


unlink($uploaddir.$s_img);


?>

<script type="text/javascript">
 
 window.close(); 
if (window.opener && !window.opener.closed) {
window.opener.location.reload();
} 
 
</script>
