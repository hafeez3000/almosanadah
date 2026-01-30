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
 $s_group_code = $_POST['group_code'];
 $s_gnationality = $_POST['gnationality'];
 $s_contactno = $_POST['contactno'];
 $s_flightdet = $_POST['flightdet'];
 $s_guestnotes =  $_POST['guestnotes'];



$query_agent ="select acccode,aname,country,fax,email from agentsdet where acccode ='$agentccc'";

$result_agent = pg_query($conn, $query_agent);

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
}





$sqlinsmain = "update sales_main set guest_title='$s_gtitle',guest_name='$s_gname',group_code='$s_group_code',guest_nationality='$s_gnationality' , guest_telno='$s_contactno',flight_det='$s_flightdet',guest_notes='$s_guestnotes',cus_account_code='$agent_acc_code',cus_title='$s_cptitle',cus_name='$s_cpname',cus_company_name='$agent_c_name',cus_country='$agent_country',cus_contact='$agent_fax',cus_email='$agent_email',agent_notes='$s_tanotes' where ocode='$s_pnr'";

pg_query($conn, $sqlinsmain);

$sqlinshotel = "update sales_hotels set cus_account_code='$agent_acc_code' where ocode='$s_pnr'";
pg_query($conn, $sqlinshotel);

$sqlinstrans = "update sales_trans set cus_account_code='$agent_acc_code' where ocode='$s_pnr'";
pg_query($conn, $sqlinstrans);

$sqlinsvisa = "update sales_visa set cus_account_code='$agent_acc_code' where ocode='$s_pnr'";
pg_query($conn, $sqlinsvisa);

$sqlinsextra = "update sales_extra set cus_account_code='$agent_acc_code' where ocode='$s_pnr'";
pg_query($conn, $sqlinsextra);

// accounts conn start
$ac_nar ="";
$ac_nar = "CR Sales - ". $s_gtitle .". ".$s_gname." - PNR:".$s_pnr;
$ac_nar = substr($ac_nar,0,254);
$sqlinsacc1 = "update vocmast set narration='$ac_nar',acccode='$agent_acc_code' where pnr='$s_pnr' and vocsno=1 and voctype='CS' ";
pg_query($conn, $sqlinsacc1);

$ac_nar ="";
$ac_nar = "CR Purchases - ". $s_gtitle .". ".$s_gname." - PNR:".$s_pnr;
$ac_nar = substr($ac_nar,0,254);
$sqlinsacc2 = "update vocmast set narration='$ac_nar' where pnr='$s_pnr' and vocsno=1 and voctype='PV' ";
pg_query($conn, $sqlinsacc2);

$ac_nar="";
$ac_nar = "CR Sales - ". $s_gtitle .". ".$s_gname." - PNR:".$s_pnr ." - ".$agent_c_name.",". $agent_country;
$ac_nar = substr($ac_nar,0,254);
$sqlinsacc3 = "update vocmast set narration='$ac_nar' where pnr='$s_pnr' and vocsno=2 and voctype='CS'";
pg_query($conn, $sqlinsacc3);


$ac_nar="";
$ac_nar = "CR Purchases - ". $s_gtitle .". ".$s_gname." - PNR:".$s_pnr ." - ".$agent_c_name.",". $agent_country;
$ac_nar = substr($ac_nar,0,254);

$sqlinsacc4 = "update vocmast set narration='$ac_nar' where pnr='$s_pnr' and vocsno=2 and voctype='PV'";
pg_query($conn, $sqlinsacc4);

// accounts conn end

// accounts conn start transportation
$ac_nar ="";
$ac_nar = "CR Sales - ". $s_gtitle .". ".$s_gname." - PNR:".$s_pnr;
$ac_nar = substr($ac_nar,0,254);
$sqlinsacct1 = "update vocmast set narration='$ac_nar',acccode='$agent_acc_code' where pnr='$s_pnr' and vocsno=1 and voctype='TS' ";
pg_query($conn, $sqlinsacct1);

$ac_nar ="";
$ac_nar = "CR Purchases - ". $s_gtitle .". ".$s_gname." - PNR:".$s_pnr;
$ac_nar = substr($ac_nar,0,254);
$sqlinsacct2 = "update vocmast set narration='$ac_nar' where pnr='$s_pnr' and vocsno=1 and voctype='TP' ";
pg_query($conn, $sqlinsacct2);

$ac_nar="";
$ac_nar = "CR Sales - ". $s_gtitle .". ".$s_gname." - PNR:".$s_pnr ." - ".$agent_c_name.",". $agent_country;
$ac_nar = substr($ac_nar,0,254);
$sqlinsacct3 = "update vocmast set narration='$ac_nar' where pnr='$s_pnr' and vocsno=2 and voctype='TS'";
pg_query($conn, $sqlinsacct3);


$ac_nar="";
$ac_nar = "CR Purchases - ". $s_gtitle .". ".$s_gname." - PNR:".$s_pnr ." - ".$agent_c_name.",". $agent_country;
$ac_nar = substr($ac_nar,0,254);

$sqlinsacct4 = "update vocmast set narration='$ac_nar' where pnr='$s_pnr' and vocsno=2 and voctype='TP'";
pg_query($conn, $sqlinsacct4);

// accounts conn end transportation


// accounts conn start umrah
$ac_nar ="";
$ac_nar = "CR Sales - ". $s_gtitle .". ".$s_gname." - PNR:".$s_pnr;
$ac_nar = substr($ac_nar,0,254);
$sqlinsaccu1 = "update vocmast set narration='$ac_nar',acccode='$agent_acc_code' where pnr='$s_pnr' and vocsno=1 and voctype='US' ";
pg_query($conn, $sqlinsaccu1);

$ac_nar ="";
$ac_nar = "CR Purchases - ". $s_gtitle .". ".$s_gname." - PNR:".$s_pnr;
$ac_nar = substr($ac_nar,0,254);
$sqlinsaccu2 = "update vocmast set narration='$ac_nar' where pnr='$s_pnr' and vocsno=1 and voctype='UP' ";
pg_query($conn, $sqlinsaccu2);

$ac_nar="";
$ac_nar = "CR Sales - ". $s_gtitle .". ".$s_gname." - PNR:".$s_pnr ." - ".$agent_c_name.",". $agent_country;
$ac_nar = substr($ac_nar,0,254);
$sqlinsaccu3 = "update vocmast set narration='$ac_nar' where pnr='$s_pnr' and vocsno=2 and voctype='US'";
pg_query($conn, $sqlinsaccu3);


$ac_nar="";
$ac_nar = "CR Purchases - ". $s_gtitle .". ".$s_gname." - PNR:".$s_pnr ." - ".$agent_c_name.",". $agent_country;
$ac_nar = substr($ac_nar,0,254);

$sqlinsaccu4 = "update vocmast set narration='$ac_nar' where pnr='$s_pnr' and vocsno=2 and voctype='UP'";
pg_query($conn, $sqlinsaccu4);

// accounts conn end umrah

/*add a record to pnrhistory table*/
$amendguestdeta = "INSERT INTO pnrhistory(user_sno, ocode, description, created_at) VALUES ('$suser_sno', '$s_pnr', 'Booking Guest Name changed to : ".$s_gname." from the Agent Name: ".$agent_c_name."', 'now()')";
pg_query($conn, $amendguestdeta);
/*END - add a record to pnrhistory table*/

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
