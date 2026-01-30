<?
include ("header.php");
?> 

<center>
<body bgcolor="#00A800" leftmargin="10" topmargin="10" marginwidth="0" marginheight="0">
<table width="100%" height="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF">
  <tr>
    <td>

<table width="100%" height="6%" border="0" cellspacing="0" cellpadding="0" bgcolor="#CAFFCA">
  <tr>
            <td><font size="2" face="Arial, Helvetica, sans-serif"><strong>&nbsp; Finalizing Booking ...</strong></font></td>
            <td valign="top"> <div align="right"><img src="../images/tr.jpg" width="9" height="10"></div></td>
  </tr>
</table>
<table width="100%" height="86%" border="0" cellspacing="0" cellpadding="1" bgcolor="#FFFFFF">
  <tr><td valign="top">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td>
<br><br><br><br><br>
<? 
include ("gprocessing.html"); 
?>


<?
 $s_pnr = $_POST['s_pnr'];
 $agentccc =$_POST['agentname'];
 $s_cptitle = $_POST['cptitle'];
 $s_cpname = $_POST['cpname'];
 $s_tanotes = $_POST['tanotes'];
 $s_gtitle = $_POST['gtitle'];
 $s_gname = $_POST['gname'];
 $s_contactno = $_POST['contactno'];
 $s_flightdet = $_POST['flightdet'];
 $s_guestnotes =  $_POST['guestnotes'];



$query_agent ="select acccode,aname,country,fax,email,title,cname from agentsdet where acccode ='$agentccc'";

$result_agent = pg_query($query_agent);

if (!$result_agent) {
	echo "An error occured.\n";
	exit;
	}


while ($rows_agent = pg_fetch_array($result_agent)){
$agent_acc_code = $rows_agent["acccode"];
$agent_c_name = $rows_agent["aname"];
$agent_country = $rows_agent["country"];
$agent_fax = $rows_agent["fax"];
$agent_email = $rows_agent["email"];
$s_cptitle = $rows_agent["title"];
 $s_cpname = $rows_agent["cname"];
}


$query_user_det ="select user_title,user_first_name,user_last_name from users where user_sno ='$suser_sno'";

$result_user_det = pg_query($query_user_det);

if (!$result_user_det) {
	echo "An error occured.\n";
	exit;
	}


while ($rows_user_det = pg_fetch_array($result_user_det)){
 $s_cptitle = $rows_user_det["user_title"];
 $s_cpname = $rows_user_det["user_first_name"] ." ".$rows_user_det["user_last_name"];
}

 




$sqlinsmain = "update sales_main set guest_title='$s_gtitle',guest_name='$s_gname',guest_telno='$s_contactno',flight_det='$s_flightdet',guest_notes='$s_guestnotes',cus_account_code='$agent_acc_code',cus_title='$s_cptitle',cus_name='$s_cpname',cus_company_name='$agent_c_name',cus_country='$agent_country',cus_contact='$agent_fax',cus_email='$agent_email',agent_notes='$s_tanotes' where ocode='$s_pnr'";

pg_query($sqlinsmain);


$sqlinshotel = "update sales_hotels set cus_account_code='$agent_acc_code' where ocode='$s_pnr'";
pg_query($sqlinshotel);

$sqlinstrans = "update sales_trans set cus_account_code='$agent_acc_code' where ocode='$s_pnr'";
pg_query($sqlinstrans);

$sqlinsvisa = "update sales_visa set cus_account_code='$agent_acc_code' where ocode='$s_pnr'";
pg_query($sqlinsvisa);

$sqlinsextra = "update sales_extra set cus_account_code='$agent_acc_code' where ocode='$s_pnr'";
pg_query($sqlinsextra);


// accounts conn start


$ac_nar ="";
$ac_nar = "CR Sales - ". $s_gtitle .". ".$s_gname." - ".$s_pnr;
$ac_nar = substr($ac_nar,0,254);

$sqlinsacc1 = "update vocmast set narration='$ac_nar',acccode='$agent_acc_code' where pnr='$s_pnr' and vocsno=1 and voctype='CS' ";
pg_query($sqlinsacc1);

$ac_nar ="";
$ac_nar = "CR Purchases - ". $s_gtitle .". ".$s_gname." - ".$s_pnr;
$ac_nar = substr($ac_nar,0,254);

$sqlinsacc2 = "update vocmast set narration='$ac_nar' where pnr='$s_pnr' and vocsno=1 and voctype='PV' ";
pg_query($sqlinsacc2);


$ac_nar="";
$ac_nar = "CR Sales - ". $s_gtitle .". ".$s_gname." - ".$s_pnr ." - ".$agent_c_name.",". $agent_country;
$ac_nar = substr($ac_nar,0,254);

$sqlinsacc3 = "update vocmast set narration='$ac_nar' where pnr='$s_pnr' and vocsno=2 and voctype='CS'";
pg_query($sqlinsacc3);

$ac_nar="";
$ac_nar = "CR Purchases - ". $s_gtitle .". ".$s_gname." - ".$s_pnr ." - ".$agent_c_name.",". $agent_country;
$ac_nar = substr($ac_nar,0,254);

$sqlinsacc4 = "update vocmast set narration='$ac_nar' where pnr='$s_pnr' and vocsno=2 and voctype='PV'";
pg_query($sqlinsacc4);




// accounts conn end


?>


</td></tr>			
</table>			
</td></tr>
</table>
<table width="100%" height="8%" border="0" cellspacing="0" cellpadding="0" bgcolor="#CAFFCA">
  <tr>
            <td  valign="bottom"  > <img src="../images/bl.jpg" width="9" height="10"></td>
            <td valign="middle"><div align="right"><font size="2" face="Arial, Helvetica, sans-serif"><strong>Please Wait ... &nbsp;</strong></font></div>
              </td>
  </tr>
</table>


</td>
  </tr>
</table>
<?
 echo "<script>document.location.href=\"pnrdet.php?spnr=$s_pnr\"</script>";  
?>


</body>
</center>