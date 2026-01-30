<?

include("db.php");

echo $old_acc = $_POST['acname'];
echo $new_acc = $_POST['acname2'];

pg_query("update tbs set newacc='$new_acc' where account_code='$old_acc' ");

pg_query("update accmast set che_b=1 where acccode='$new_acc' ");


echo "<script>document.location.href=\"comp.php\"</script>"; 
?> 
