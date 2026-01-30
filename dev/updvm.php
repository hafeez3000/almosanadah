<?
include('header.php');
?>

<?
$querycr = "SELECT vocno, pnr, invno, sinvno, sinvtype, vocdate from vocmast"; 
$resultcr = pg_query($querycr); 
if (!$resultcr) {
	echo "An error occured.\n";
	exit;
	}
while($rowcr = pg_fetch_array($resultcr))
    {

echo $s_vocno = $rowcr["vocno"];
echo " | ";
echo $s_pnr = $rowcr["pnr"];
echo " | ";
echo $s_invno = $rowcr["invno"];
echo " | ";
echo $s_sinvno = $rowcr["sinvno"];
echo " | ";
echo $s_sinvtype = $rowcr["sinvtype"];
echo " | ";
echo $s_vocdate = $rowcr["vocdate"];
echo " ==> ";



if(trim($s_sinvtype)=='H'){
$querycr_d = "SELECT cin,ocode from sales_hotels where sales_hotels_sno=$s_sinvno "; 
$resultcr_d = pg_query($querycr_d); 
if (!$resultcr_d) {
	echo "An error occured.\n";
	exit;
	}
while($rowcr_d = pg_fetch_array($resultcr_d))
    {

echo $s_cin = $rowcr_d["cin"];
echo " | ";
echo $rowcr_d["ocode"];

pg_query("update vocmast set vocdate='$s_cin' where sinvno=$s_sinvno");
	}
}

if(trim($s_sinvtype)=='T'){
$querycr_d_t = "SELECT req_date_time,ocode from sales_trans where sales_trans_sno=$s_sinvno "; 
$resultcr_d_t = pg_query($querycr_d_t); 
if (!$resultcr_d_t) {
	echo "An error occured.\n";
	exit;
	}
while($rowcr_d_t = pg_fetch_array($resultcr_d_t))
    {

echo $s_cin = substr($rowcr_d_t["req_date_time"], 0,10);
echo " | ";
echo $rowcr_d_t["ocode"];

pg_query("update vocmast set vocdate='$s_cin' where sinvno=$s_sinvno");
	}
}

if(trim($s_sinvtype)=='X'){
$querycr_d_x = "SELECT req_date_time,ocode from sales_extra where sales_extra_sno=$s_sinvno "; 
$resultcr_d_x = pg_query($querycr_d_x); 
if (!$resultcr_d_x) {
	echo "An error occured.\n";
	exit;
	}
while($rowcr_d_x = pg_fetch_array($resultcr_d_x))
    {

echo $s_cin = substr($rowcr_d_x["req_date_time"], 0,10);
echo " | ";
echo $rowcr_d_x["ocode"];

pg_query("update vocmast set vocdate='$s_cin' where sinvno=$s_sinvno");
	}
}


echo "<br>";

	}

?>