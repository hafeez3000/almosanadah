<?php
$conn = pg_connect(
    "host=musanidah-db port=5432 dbname=musanidah user=musanidah password=musanidahpw",
);
$sql = "SELECT user_sno, user_id FROM users";
$result = pg_query($sql);
if (!$result) {
    echo "An error occured.\n" . pg_last_error();
    exit();
}
echo pg_num_rows($result);
//echo phpinfo();
?>
