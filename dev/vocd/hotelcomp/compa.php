<?

include("db.php");

echo $acc_mast = $_POST['acname'];
echo $uno = $_POST['acname2'];

pg_query("update hotels set newac='$acc_mast' where hotel_id='$uno' ");

pg_query("update accmast set che_b=1 where acccode='$acc_mast' ");


echo "<script>document.location.href=\"comp.php\"</script>"; 
?> 
