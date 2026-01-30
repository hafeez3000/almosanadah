<?
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include("../db/db.php"); 
$erid = $_GET['id'];
$query ="SELECT e.sno, e.user_sno, e.cin, e.cout, e.email, e.hotel_name, e.city, e.guest_title, e.guest_name, e.room_type, e.no_of_rooms, e.no_of_paxs, e.meals, e.created_at, e.status,e.comments, u.user_id, u.user_first_name, u.user_last_name, u.company_name FROM emailrequests e, users u WHERE e.user_sno = u.user_sno AND e.sno = $erid";
	$pgq = pg_query($conn, $query);
	$pgnr = pg_num_rows($pgq);
	if (!$pgq) {
		echo "An error occured.\n";
		exit;
	}
	while ($pgfa = pg_fetch_array($pgq)){
		$sno = $pgfa["sno"];
		$user_first_name = $pgfa["user_first_name"];
		$user_last_name = $pgfa["user_last_name"];
		$user_name = $user_first_name." ".$user_last_name;
		$company_name = $pgfa["company_name"];
		$cin = $pgfa["cin"];
		$cout = $pgfa["cout"];
    $email = $pgfa["email"];
		$madcins = date('D, d-M-Y', strtotime($cin));
		$madcouts = date('D, d-M-Y', strtotime($cout));
		$hotel_name = $pgfa["hotel_name"];
		$city = $pgfa["city"];		
		$guest_name = $pgfa["guest_name"];
		$guest_title = $pgfa["guest_title"];
		$guestname = $guest_title.". ".$guest_name;
		$room_type = $pgfa["room_type"];
		$no_of_rooms = $pgfa["no_of_rooms"];
		$no_of_paxs = $pgfa["no_of_paxs"];
		$meals = $pgfa["meals"];
		$created_at = $pgfa["created_at"];
		$createdat = date('D, d-M-Y', strtotime($created_at));
		$status = $pgfa["status"];
	        $e_comments = $pgfa["comments"];
	}

//After Submit	
if($_POST['submit'] == 'Send Response'){
	$comments = $_POST['comments'];
	$status = $_POST['status'];
	$sno = $_POST['sno'];
	$erquery ="UPDATE emailrequests SET comments = '$comments', status = '$status' WHERE sno = $sno";
	$erpgq = pg_query($conn, $erquery);
	if (!$erpgq) {
		echo "An error occured. Please try again.\n";
		exit;
	} else {
?>
<script language="JavaScript">
<!--
function closeMyWinOrTab(){
	window.opener.location.href="listemails.php";
	window.close();
}
closeMyWinOrTab();
// -->
</script> 
<?php		
	}
}
//End - After Sutmit
?>
<html>
<center>
<body leftmargin="0" topmargin="0" rightmargin="0">
<table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0" style="border-top: 5px solid #006600 ;border-bottom: 5px solid #006600 ;border-left: 5px solid #006600;border-right: 5px solid #006600">
<tr><td valign="top">
	<table width="98%" cellpadding="3" cellspacing="3" align="center">
	<tr>
		<td colspan="2" align="center"><img src="../dors/images/logo.jpg"></td>
	</tr>
	<tr bgcolor="#CCCCCC">
		<td colspan="2" align="center"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Email Request Response</b></font></td>
	</tr>
	<tr>
		<td width="17%" style="border-right: 1px solid #999999" bgcolor="#CCCCCC"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">User Name</font></td>
		<td ><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><?=$user_name?></font></td>
	</tr>
	<tr>
		<td width="17%" style="border-right: 1px solid #999999" bgcolor="#CCCCCC"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Company Name</font></td>
		<td ><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><?=$company_name?></font></td>
	</tr>
	
<tr>
		<td width="17%" style="border-right: 1px solid #999999" bgcolor="#CCCCCC"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">From Email</font></td>
		<td ><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><?=$email?></font></td>
	</tr>
  

  <tr>
		<td width="17%" style="border-right: 1px solid #999999" bgcolor="#CCCCCC"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Guest Name</font></td>
		<td ><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><?=$guestname?></font></td>
	</tr>
	<tr>
		<td width="17%" style="border-right: 1px solid #999999" bgcolor="#CCCCCC"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Check In</font></td>
		<td ><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><?=$madcins?></font></td>
	</tr>
	<tr>
		<td style="border-right: 1px solid #999999" bgcolor="#CCCCCC"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Check Out</font></td>
		<td><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><?=$madcouts?></font></td>
	</tr>
	<tr>
		<td style="border-right: 1px solid #999999" bgcolor="#CCCCCC"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Hotel Name</font></td>
		<td><font size="2" face="Verdana, Arial, Helvetica, sans-serif"> <?=$hotel_name?></font></td>
	</tr>
	<tr>
		<td style="border-right: 1px solid #999999" bgcolor="#CCCCCC"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">City</font></td>
		<td><font size="2" face="Verdana, Arial, Helvetica, sans-serif"> <?=$city?></font></td>
	</tr>
	<tr> 
		<td style="border-right: 1px solid #999999" bgcolor="#CCCCCC"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Room Type</font></td>
		<td><font size="2" face="Verdana, Arial, Helvetica, sans-serif"> <?=$room_type?></font></td>
	</tr>
	<tr> 
		<td style="border-right: 1px solid #999999" bgcolor="#CCCCCC"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">No of Rooms</font></td>
		<td><font size="2" face="Verdana, Arial, Helvetica, sans-serif"> <?=$no_of_rooms?></font></td>
	</tr>
	<tr> 
		<td style="border-right: 1px solid #999999" bgcolor="#CCCCCC"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">No of Paxs</font></td>
		<td><font size="2" face="Verdana, Arial, Helvetica, sans-serif"> <?=$no_of_paxs?></font></td>
	</tr>
	<tr> 
		<td style="border-right: 1px solid #999999" bgcolor="#CCCCCC"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Meals</font></td>
		<td><font size="2" face="Verdana, Arial, Helvetica, sans-serif"> <?=$meals?></font></td>
	</tr>
	<tr> 
		<td style="border-right: 1px solid #999999" bgcolor="#CCCCCC"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Created At</font></td>
		<td><font size="2" face="Verdana, Arial, Helvetica, sans-serif"> <?=$createdat?></font></td>
	</tr>
	<form name="erform" method="post" action="" onSubmit="return validate()">
	<tr> 
		<td style="border-right: 1px solid #999999" bgcolor="#CCCCCC"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Select Status</font></td>
		<td><font size="2" face="Verdana, Arial, Helvetica, sans-serif"> <select id="status" name="status">
		<option value="New" <?php if($status == "New") { echo 'selected="selected"'; } ?>>New</option>
		<option value="Replied" <?php if($status == "Replied") { echo 'selected="selected"'; } ?>>Replied</option>
		<option value="Duplicate" <?php if($status == "Duplicate") { echo 'selected="selected"'; } ?>>Duplicate</option>
		</select> 
	</tr>
	<tr> 
		<td style="border-right: 1px solid #999999" bgcolor="#CCCCCC"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Enter Comments</font></td>
		<td><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><textarea id="comments" name="comments" rows="5" cols="40"><?=$e_comments?></textarea><input type="hidden" name="sno" id="sno" value="<?=$erid?>">
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td align="left"><input  type="submit" name="submit" id="submit" value="Send Response"></td>
	</tr>
	</form >
	<tr bgcolor="#CCCCCC">
		<td colspan="2"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>&nbsp;</b></font></td>
	</tr>
</table>	
</td></tr></table>

<script>
function validate(){
/*	if((document.erform.status.value == 'New')) {
		alert("Habibi, Please change the status.");
		document.erform.status.focus();
		return false;
	}*/
	if((document.erform.comments.value == '')) {
		alert("Habibi, Enter your comments.");
		document.erform.comments.focus();
		return false;
	}
}
</script>

</body>
</center>
</html>

