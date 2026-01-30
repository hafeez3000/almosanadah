<?php
function getTaxCal($price, $from_date)
{
    include("../db/db.php");
    $query_tax_rate = "select tax_percentage from tax_rates where tax_id = 1 and from_date <= '$from_date' ";

    $result_tax_rate = pg_query($conn, $query_tax_rate);

    if (!$result_tax_rate) {
        echo "An error occured.\n";
        exit;
    }

    while ($row_tax_rate = pg_fetch_row($result_tax_rate)) {
       $row_tax_per = $row_tax_rate[0];
    }
    pg_free_result($result_tax_rate);

    return $price * $row_tax_per / 100;

}
