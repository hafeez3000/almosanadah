<?
include ("header.php");

?>
<script>
document.title= '<? echo $company_name . " ERP - Umrah New Bookings"; ?>';
</script>

	<?
$s_pnr = $_SESSION["a_pnr"];
$g_trans_sno = $_POST["tsno"];

$s_trans_kind = $_POST["trans_kind"];
$s_trans_model= $_POST["trans_model"];
$s_trans_supp = $_POST["trans_supp"];
$s_trans_route = $_POST["trans_route"];
$s_driver_name = $_POST["driver_name"];
$s_driver_mobile = $_POST["driver_mobile"];
// $s_agent_jeddah = $_POST["agent_jeddah"];
// $s_agent_makkah = $_POST["agent_makkah"];
// $s_agent_madinah = $_POST["agent_madinah"];

?>

<br><br><br><br><br>

<?
include ("gprocessing.html");
?>

<?

  // $sequpdatetrans = "update sales_trans set kind_of_trans='$s_trans_kind',trans_model='$s_trans_model',supp_rep='$s_trans_supp',f2t='$s_trans_route', driver_name='$s_driver_name', driver_mobile='$s_driver_mobile', agent_jeddah='$s_agent_jeddah', agent_makkah='$s_agent_makkah', agent_madinah='$s_agent_madinah'  where ocode='$s_pnr' and sales_trans_sno = '$g_trans_sno'";
    $sequpdatetrans = "update sales_trans set kind_of_trans='$s_trans_kind',trans_model='$s_trans_model',supp_rep='$s_trans_supp',f2t='$s_trans_route', driver_name='$s_driver_name', driver_mobile='$s_driver_mobile'  where ocode='$s_pnr' and sales_trans_sno = '$g_trans_sno'";
pg_query($conn, $sequpdatetrans);


echo "<script>document.location.href=\"pnrdet.php?spnr=$s_pnr\"</script>";


?>



