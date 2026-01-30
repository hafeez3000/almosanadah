<?
include ("header.php");
?>

<script>
document.title= '<? echo $company_name . " ERP - Accounts - Account Details"; ?>';
</script>

<html>
<link rel="stylesheet" type="text/css" href="../calendar/css.css" />
<body leftmargin="0" topmargin="0" rightmargin="0">
<table width="100%" border="0" cellpadding="0" cellspacing="0" style="border-bottom: 1px solid #999999 ;border-left: 3px solid #006600;border-right: 3px solid #006600"><tr>
    <td bgcolor="#CCCCCC"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">&nbsp;You 
      are here: Home</font></td>
  </tr></table>
<table width="100%" border="0" cellpadding="0" cellspacing="0" style="border-bottom: 1px solid #999999 ;border-left: 3px solid #006600;border-right: 3px solid #006600"><tr>
    <td ><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><?include ("../dticker/uhome.php"); ?></td>
  </tr></table>
  
<table width="100%" height="76%" border="0" cellpadding="0" cellspacing="0" style="border-bottom: 3px solid #006600; border-right: 3px solid #006600;border-left: 3px solid #006600 ">
  <tr>
    <td width="100%"  valign="top"  > <table width="100%" border="0" cellpadding="0" cellspacing="1">
        <tr>
          <td valign="top"> 
           <br><br><br>
			<?

include ("gprocessing.html"); 


$s_voutype = $_POST["voutype"];
$s_vouno = $_POST["vouno"]; 

$s_invnost = $_POST["vouno"]; 
settype($s_invnost, "integer");



$s_dDay = $_POST["dDay"];  
$s_dMonth = $_POST["dMonth"];
$s_dYear = $_POST["dYear"]; 

$s_voudate = $s_dYear ."-". $s_dMonth ."-".$s_dDay;

$s_refno = $_POST["refno"]; 
$s_rows = $_POST["it_val"];



$q_voc_c ="select voctype, vocno  from vocmast where voctype='$s_voutype' and vocno='$s_vouno' ";

$r_voc_c = pg_query($conn, $q_voc_c);
$rows_vm = pg_num_rows($r_voc_c);

if($rows_vm>=$s_rows){  // start if first check

for ($i=1; $i<$s_rows; $i++){
$s_acccode =  $_POST["txtRow".$i];
$s_narration =  pg_escape_string($conn, $_POST["viewtype".$i]);
$s_moredet =    pg_escape_string($conn, $_POST["nofp".$i]);
$s_debit =  $_POST["roomd".$i];
$s_credit = $_POST["credit".$i];

$q_hotel_sel ="select voctype, vocno  from vocmast where voctype='$s_voutype' and vocno='$s_vouno' and vocsno='$i'";

$res_hotel_sel = pg_query($conn, $q_hotel_sel);
$rows_hotels = pg_num_rows($res_hotel_sel);


if($rows_hotels==1){ 

$insqamend = "update vocmast set voctype='$s_voutype',invno=$s_invnost,vocno='$s_vouno',vocsno=$i,vocdate='$s_voudate',acccode='$s_acccode',narration='$s_narration',moredet='$s_moredet',dbamt=$s_debit,cramt=$s_credit,supp_inv='$s_refno',recon='f' where voctype='$s_voutype' and vocno='$s_vouno' and vocsno=$i ";
pg_query($conn, $insqamend);

}

}  // end of the for loop for present rows


$insq = "delete from vocmast where voctype='$s_voutype' and vocno='$s_vouno' and vocsno>=$s_rows";
pg_query($conn, $insq);




}   // end of if first check 
else {   // start else first check


for ($i=1; $i<$s_rows; $i++){
$s_acccode =  $_POST["txtRow".$i];
$s_narration =  pg_escape_string($conn, $_POST["viewtype".$i]);
$s_moredet =    pg_escape_string($conn, $_POST["nofp".$i]);
$s_debit =  $_POST["roomd".$i];
$s_credit = $_POST["credit".$i];

$q_hotel_sel ="select voctype, vocno  from vocmast where voctype='$s_voutype' and vocno='$s_vouno' and vocsno='$i'";

$res_hotel_sel = pg_query($conn, $q_hotel_sel);
$rows_hotels = pg_num_rows($res_hotel_sel);



if($rows_hotels>0){ 

$insqamend = "update vocmast set voctype='$s_voutype',invno=$s_invnost,vocno='$s_vouno',vocsno=$i,vocdate='$s_voudate',acccode='$s_acccode',narration='$s_narration',moredet='$s_moredet',dbamt=$s_debit,cramt=$s_credit,supp_inv='$s_refno',recon='f' where voctype='$s_voutype' and vocno='$s_vouno' and vocsno=$i ";
pg_query($conn, $insqamend);

}
else{

$insq = "insert into vocmast(voctype,vocno,vocsno,vocdate,acccode,narration,moredet,dbamt,cramt,supp_inv,recon,invno) values('$s_voutype','$s_vouno',$i,'$s_voudate','$s_acccode','$s_narration','$s_moredet',$s_debit,$s_credit,'$s_refno','f',$s_invnost) ";
pg_query($conn, $insq);
}


}  // end of the for loop for present rows

} // end of else first check 


$q_voc_cf ="select voctype, vocno,vocsno,dbamt,cramt  from vocmast where voctype='$s_voutype' and vocno='$s_vouno' ";
$r_voc_cf = pg_query($conn, $q_voc_cf);

if (!$r_voc_cf) {
	echo "An error occured.\n";
	exit;
	}
while ($rows_voc_cf = pg_fetch_array($r_voc_cf)){

if(($rows_voc_cf["dbamt"]==0)&&($rows_voc_cf["cramt"]==0)){
$del_v_sno = $rows_voc_cf["vocsno"];
$insq_d = "delete from vocmast where voctype='$s_voutype' and vocno='$s_vouno' and vocsno=$del_v_sno";
pg_query($conn, $insq_d);
}

}


$q_voc_cfs ="select voctype, vocno,vocsno,dbamt,cramt  from vocmast where voctype='$s_voutype' and vocno='$s_vouno' order by vocsno";
$r_voc_cfs = pg_query($conn, $q_voc_cfs);
$voc_sort=1;
while ($rows_voc_cfs = pg_fetch_array($r_voc_cfs)){
$forvs = $rows_voc_cfs["vocsno"];
$insq_up= "update vocmast set vocsno=$voc_sort where voctype='$s_voutype' and vocno='$s_vouno' and vocsno=$forvs";
pg_query($conn, $insq_up);
$voc_sort++;
}


?>



			 
	
			 
    
			 </td>
        </tr>
      </table></td></tr>
	  
	  
      </table> 
</table>	
	
	

	</tr></table>
</body>				
</html>

<?
echo "<script>document.location.href=\"findtrana.php?voutype=$s_voutype&vouno=$s_vouno\"</script>"; 
?>
