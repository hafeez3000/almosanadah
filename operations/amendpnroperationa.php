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
            <td><font size="2" face="Arial, Helvetica, sans-serif"><strong>&nbsp; Creating new operations ...</strong></font></td>
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

 $group_id = $_POST["group_id"];
 $station_name = $_POST["station_name"];
 $arrived_from = $_POST["arrived_from"];
 $est_paxs = $_POST["est_paxs"];
 $arr_paxs = $_POST["arr_paxs"];
 $dep_paxs = $_POST["dep_paxs"];
 $arrival_det = $_POST["arrival_det"];
 $group_leader = $_POST["group_leader"];
 $depatured_to = $_POST["depatured_to"];
 $received_agentname = $_POST["received_agentname"];
  $depatured_agentname = $_POST["depatured_agentname"];
 $depature_det = $_POST["depature_det"];

$timeselecthours0 = $_POST["timeselecthours0"];
$timeselectmin0 = $_POST["timeselectmin0"];


$madcind = $_POST['dDay'];
$madcinm = $_POST['dMonth'];
$madciny = $_POST['dYear'];

  $trans0rd0 = date('Y-m-d H:i:00', mktime($timeselecthours0,$timeselectmin0,0,$madcinm,$madcind,$madciny));


$madcoutd = $_POST['d1Day'];
$madcoutm = $_POST['d1Month'];
$madcouty = $_POST['d1Year'];

$timeselecthours1 = $_POST["timeselecthours1"];
$timeselectmin1 = $_POST["timeselectmin1"];

  $trans0rd1 = date('Y-m-d H:i:00', mktime($timeselecthours1,$timeselectmin1,0,$madcoutm,$madcoutd,$madcouty));






 $passports = $_POST["passports"];
 $pass_rhn = $_POST["pass_rhn"];
 $tickets = $_POST["tickets"];
 $tickets_rhn = $_POST["tickets_rhn"];
//echo $ch_mazarath = $_POST["ch_mazarath"];

if($_POST["ch_mazarath"]=="on"){

$ch_mazarath = "t";
} else { 
$ch_mazarath = "f"; 
}



 $s_pnr = $_SESSION['pnr'];

$s_opid = $_SESSION['opid'];







  
 $sqlinsoperations = "update  umrah_gm set group_id='$group_id',station_name = '$station_name',nop_estimated = $est_paxs,nop_arrived = $arr_paxs,nop_depatured = $dep_paxs,arrived_from = '$arrived_from',arrival_det = '$arrival_det',depatured_to = '$depatured_to',depatured_det = '$depature_det',rep_name =  '$received_agentname', rep_name_d =  '$depatured_agentname', group_leader = '$group_leader',is_mazarat = '$ch_mazarath',arrived_at = '$trans0rd0',depatured_at = '$trans0rd1',created_at = 'now',passports = $passports, pass_rhn = '$pass_rhn', tickets = $tickets,tickets_rhn = '$tickets_rhn' where sno = $s_opid " ;

 
pg_query($sqlinsoperations);

/*Start Add a record to pnrhistory table*/
$createpnr = "INSERT INTO pnrhistory(user_sno, ocode, description, created_at) VALUES ('$suser_sno', '$s_pnr', 'Opetation Amended Station Name:".$station_name." , Group Id: $group_id, Representative: $received_agentname', 'now()')";
pg_query($createpnr);
/*END - Add a record to pnrhistory table*/

 
 ?>
<? echo  "<script>document.location.href=\"pnrdet.php?spnr=$s_pnr\"</script>";  ?>
 
</body>
</center>