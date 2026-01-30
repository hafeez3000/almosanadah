<?
include ("header.php");
?>

<script>
document.title= '<? echo $company_name . " ERP - Reservation Booking"; ?>';
</script>

<html>
<link rel="stylesheet" type="text/css" href="../calendar/css.css" />
<center>
<body leftmargin="0" topmargin="0" rightmargin="0">
<br><br><br>  
<? include ("gprocessing.html"); 

//$suserid;
//$suser_sno;

$s_pnr = $_GET['spnr'];

$s_hot =  $_GET['hotid'];

$s_hot1 =  $_GET['hotid'];

$s_trans = $_GET['transid'];

$s_visa =  $_GET['visaid'];

$s_extra = $_GET['extraid'];

$n_ifc = 0; 


$query_hotels_sno ="select sales_hotels_sno from sales_hotels where ocode='$s_pnr'";

$result_hotels_sno = pg_query($query_hotels_sno);

$n_ifc = $n_ifc + pg_num_rows($result_hotels_sno);



$query_trans_sno ="select sales_trans_sno from sales_trans where ocode='$s_pnr'";

$result_trans_sno = pg_query($query_trans_sno);

$n_ifc = $n_ifc + pg_num_rows($result_trans_sno);


$query_visa_sno ="select sales_visa_sno from sales_visa  where ocode='$s_pnr'";
$result_visa_sno = pg_query($query_visa_sno);

$n_ifc = $n_ifc + pg_num_rows($result_visa_sno);


$query_extra_sno ="select sales_extra_sno from sales_extra where ocode='$s_pnr'";
$result_extra_sno = pg_query($query_extra_sno);

$n_ifc = $n_ifc + pg_num_rows($result_extra_sno);

$n_ifc ;

if($n_ifc>1){     // atleast one record start

if(strlen(trim($s_hot))>0){  // start of hotel if
	

echo "<br><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">Please Wait, Deleting Hotel ....</font></div>"; 

$sqldelm = "delete from sales_hotels where sales_hotels_sno=$s_hot1 and ocode='$s_pnr'";
pg_query($sqldelm);

$query_hotels_sno ="select sales_hotels_sno from sales_hotels where ocode='$s_pnr'";
$result_hotels_sno = pg_query($query_hotels_sno);
if(pg_num_rows($result_hotels_sno)>0){ }
else{
pg_query("update sales_main set sales_hotels='f' where ocode='$s_pnr'");
}



// accounts conn start

$sqldelac1 = "delete from vocmast where pnr='$s_pnr' and sinvno=$s_hot1 and voctype='CS' and sinvtype='H' ";
pg_query($sqldelac1);
$sqldelac2 = "delete from vocmast where pnr='$s_pnr' and sinvno=$s_hot1 and voctype='PV' and sinvtype='H' ";
pg_query($sqldelac2);

// accounts conn end

$sqldelmm = "delete from sales_meals where sales_hotels_sno=$s_hot1 and ocode='$s_pnr' ";
pg_query($sqldelmm);


	
}  // end of if hotel



if(strlen(trim($s_trans))>0){  // start of if trans
	


$sqldelt = "delete from sales_trans where sales_trans_sno=$s_trans and ocode='$s_pnr'";
pg_query($sqldelt);


$query_trans_sno ="select sales_trans_sno from sales_trans where ocode='$s_pnr'";
$result_trans_sno = pg_query($query_trans_sno);
if(pg_num_rows($result_trans_sno)>0){ }
else{
pg_query("update sales_main set sales_trans='f' where ocode='$s_pnr'");
}


// accounts conn start


$sqldelact1 = "delete from vocmast where pnr='$s_pnr' and sinvno=$s_trans and voctype='TS' and sinvtype='T' ";
pg_query($sqldelact1);

$sqldelact2 = "delete from vocmast where pnr='$s_pnr' and sinvno=$s_trans and voctype='TP' and sinvtype='T' ";
pg_query($sqldelact2);


// accounts conn end
	
} //  end of if trans



if(strlen(trim($s_visa))>0){
$sqldelv = "delete from sales_visa where sales_visa_sno=$s_visa and ocode='$s_pnr'";
pg_query($sqldelv);


$query_visa_sno ="select sales_visa_sno from sales_visa  where ocode='$s_pnr'";
$result_visa_sno = pg_query($query_visa_sno);
if(pg_num_rows($result_visa_sno)>0){ }
else{
pg_query("update sales_main set sales_visa='f' where ocode='$s_pnr'");
}


// accounts conn start

$sqldelac1 = "delete from vocmast where pnr='$s_pnr' and sinvno=$s_visa and voctype='US' and sinvtype='V'";
pg_query($sqldelac1);
$sqldelac2 = "delete from vocmast where pnr='$s_pnr' and sinvno=$s_visa and voctype='UP' and sinvtype='V'";
pg_query($sqldelac2);

// accounts conn end

}

if(strlen(trim($s_extra))>0){ 

$sqldelv = "delete from sales_extra where sales_extra_sno=$s_extra and ocode='$s_pnr'";

pg_query($sqldelv);

$query_extra_sno ="select sales_extra_sno from sales_extra where ocode='$s_pnr'";
$result_extra_sno = pg_query($query_extra_sno);
if(pg_num_rows($result_extra_sno)>0){ }
else{
pg_query("update sales_main set sales_others='f' where ocode='$s_pnr'");
}


// accounts conn start

$sqldelac1 = "delete from vocmast where pnr='$s_pnr' and sinvno=$s_extra and voctype='CS' and sinvtype='X'";
pg_query($sqldelac1);
$sqldelac2 = "delete from vocmast where pnr='$s_pnr' and sinvno=$s_extra and voctype='PV' and sinvtype='X'";
pg_query($sqldelac2);

// accounts conn end

}


$n_ifc = 0 ;

$query_hotels_sno ="select sales_hotels_sno from sales_hotels where (booking_status='On Request' and ocode='$s_pnr') or (booking_status='Cancelled' and ocode='$s_pnr') ";
$result_hotels_sno = pg_query($query_hotels_sno);
$n_ifc = $n_ifc + pg_num_rows($result_hotels_sno);


$query_trans_sno ="select sales_trans_sno from sales_trans where (booking_status='On Request' and ocode='$s_pnr') or (booking_status='Cancelled' and ocode='$s_pnr')";

$result_trans_sno = pg_query($query_trans_sno);

$n_ifc = $n_ifc + pg_num_rows($result_trans_sno);


$query_visa_sno ="select sales_visa_sno from sales_visa  where (booking_status='On Request' and ocode='$s_pnr') or (booking_status='Cancelled' and ocode='$s_pnr')";

$result_visa_sno = pg_query($query_visa_sno);

$n_ifc = $n_ifc + pg_num_rows($result_visa_sno);


$query_extra_sno ="select sales_extra_sno from sales_extra where (booking_status='On Request' and ocode='$s_pnr') or (booking_status='Cancelled' and ocode='$s_pnr')";

$result_extra_sno = pg_query($query_extra_sno);

$n_ifc = $n_ifc + pg_num_rows($result_extra_sno);


if($n_ifc>0){}
else{
$upmain = "update sales_main set booking_status='Confirmed' where ocode='$s_pnr' ";
pg_query($upmain);
}



}     // atleast one record start
else {
echo "<script> alert(\"Sorry Record not delete, PNR should have aleast one record\")</script>";
}

echo "<script>document.location.href=\"pnrdet.php?spnr=$s_pnr\"</script>";  

 ?>
</body>	
</center>
</html>
