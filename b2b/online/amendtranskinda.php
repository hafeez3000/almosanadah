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

?>

<br><br><br><br><br>

<? 
include ("gprocessing.html"); 
?>

<?

$sequpdatetrans = "update sales_trans set kind_of_trans='$s_trans_kind',trans_model='$s_trans_model',supp_rep='$s_trans_supp',f2t='$s_trans_route' where ocode='$s_pnr' and sales_trans_sno = $g_trans_sno";
pg_query($sequpdatetrans);


echo "<script>document.location.href=\"pnrdet.php?spnr=$s_pnr\"</script>";


?>



