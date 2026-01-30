<?
include ("header.php");
?>

<script src="../javascripts/cBoxes.js"></script>
<? $vy=$vm=$vd=0; 
$vy1=$vm1=$vd1=0;
?>

<script>
document.title= '<? echo $company_name . " ERP - Emails"; ?>';
</script>

<html>
<link rel="stylesheet" type="text/css" href="../calendar/css.css" />
<head>
<script>
 var winl = (screen.width - 700) / 2; 
 var wint = (screen.height - 500) / 2;
</script>
</head>
<body  leftmargin="0" topmargin="0" rightmargin="0" >
<table width="100%" border="0" cellpadding="0" cellspacing="0" style="border-bottom: 1px solid #999999 ;border-left: 3px solid #006600;border-right: 3px solid #006600"><tr>
    <td bgcolor="#CCCCCC"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">&nbsp;You 
      are here: <a href="uhome.php">Home</a> &raquo; Email Requests  &raquo; List Emails</font></td>
  </tr></table>
  
<table width="100%" border="0" cellpadding="0" cellspacing="0" style="border-bottom: 3px solid #006600; border-right: 3px solid #006600;border-left: 3px solid #006600 ">
  <tr>
    <td width="20%" style="border-right: 1px solid #999999"  valign="top"> <table width="100%" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td valign="top"><div align="left"> 
              <?php include  ("umenupreline.php"); ?>
            </div></td>
        </tr>
      </table></td>
    <td width="80%" valign="top"  > <table width="100%" border="0" cellpadding="0" cellspacing="1">
        <tr>
          <td valign="top"> 
           
			


			
            <table width="100%" cellpadding="0" cellspacing="0" ><tr><td width="85%" valign="top"> 
			<table cellpadding="0" cellspacing="0" width="100%" style="border-top: 1px solid #999999; border-bottom: 1px solid #999999"><tr>
                      <td bgcolor="#CCCCCC"><strong>List Emails</strong></td>
                    </tr></table>
<table width="100%" cellpadding="1" cellspacing="0"><tr>
                      <td>
                        


 <form name="gquot" action="<?php echo $_SERVER['PHP_SELF']; ?>"  method="post" >

  <tr> 
                              
							  <td colspan="1" width="30%"><table>
                                  <tr> 
                                    <td><font size="2" face="Verdana, Arial, Helvetica, sans-serif">From Date 
                                      <select name="dDay" class="selBox">
                                      </select>
                                      </font></td>
                                    <td><font size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
                                      <select name="dMonth" class="selBox">
                                      </select>
                                      </font></td>
                                    <td><font size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
                                      <select name="dYear" class="selBox">
                                      </select>
                                      </font></td>
                                  </tr>
                                </table></td>
                              <td colspan="1"><table>
                                  <tr> 
                                    <td><font size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
                                      To Date
                                      <select name="d1Day" class="selBox">
                                      </select>
                                      </font></td>
                                    <td><font size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
                                      <select name="d1Month" class="selBox">
                                      </select>
                                      </font></td>
                                    <td><font size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
                                      <select name="d1Year" class="selBox">
                                      </select> &nbsp;&nbsp;                                      </font><input type="hidden" name="action" value="submitted" /> <input type="button" id ="b_listcases" name="b_listcases" value="List Emails" onClick="this.form.submit();"> </td>
                                  </tr>
								</table>	
								



							

					 </td>

                            </tr>
                        
					
						  
						  </table>
                         </td>
                    </tr>
					
					<tr><td> <br><br>
					<table border="1" cellpadding="1" cellspacing="0" width="98%" align="center">
					<tr bgcolor="#CCCCCC" style="font-weight:bold; text-align:center;"><td><font size="2" face="Verdana, Arial, Helvetica, sans-serif">S.No.</font></td>
					<td><font size="2" face="Verdana, Arial, Helvetica, sans-serif">User Name</font></font></td>
					<td><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Check In</font></td>
					<td><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Check Out</font></td>
					<td><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Hotel Name</font></td>
					<td><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Guest Name</font></td>
					<td><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Created At</font></td>
					<td><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Status</font></td></tr>
				
<?
if (isset($_POST['action']) && $_POST['action'] == 'submitted') {
		$mad = $_POST['dDay'];
	    $mam = $_POST['dMonth'];
	    $may = $_POST['dYear'];
	    $fromd = $may."-".$mam."-".$mad;
	    $md = $_POST['d1Day'];
	    $mm = $_POST['d1Month'];
	    $my = $_POST['d1Year'];
	    $tod = $my."-".$mm."-".$md;
	$q_main_sel ="SELECT e.sno, e.user_sno, e.cin, e.cout, e.hotel_name, e.guest_name, e.created_at, e.status, u.user_id, u.user_first_name, u.user_last_name FROM emailrequests e, users u WHERE  e.user_sno = 'u.user_sno' AND e.created_at BETWEEN date '$fromd' AND date '$tod' + integer '1' ORDER BY e.created_at DESC";
	$res_main_sel = pg_query($conn, $q_main_sel);
	$rows_main = pg_num_rows($res_main_sel);
	if (!$res_main_sel) {
		echo "An error occured.\n";
		exit;
	}
	if(!$rows_main>0){
		echo "<tr><td colspan=\"8\"><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">No Results were found.</font></div></td></tr>";	
	}
	while ($rows_main_sel = pg_fetch_array($res_main_sel)){
		$sno = $rows_main_sel["sno"];
		$user_first_name = $rows_main_sel["user_first_name"];
		$user_last_name = $rows_main_sel["user_last_name"];
		$cin = $rows_main_sel["cin"];
		$cout = $rows_main_sel["cout"];
		$hotel_name = $rows_main_sel["hotel_name"];
		$guest_name = $rows_main_sel["guest_name"];
		$created_at = $rows_main_sel["created_at"];
		$status = $rows_main_sel["status"];
		if($rows_main>0){
			echo "<tr><td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";
			echo "<a href='#' onClick='response(".$sno.")'>".$sno."</a>";
			echo "</font></div></td>";
			echo "<td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";
			echo $user_first_name." ".$user_last_name;
			echo "</font></div></td>";
			echo "<td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";
			echo date('d-M-Y', strtotime($cin));
			echo "</font></div></td>";
			echo "<td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";
			echo date('d-M-Y', strtotime($cout));
			echo "</font></div></td>";
			echo "<td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";
			echo $hotel_name;
			echo "</font></div></td>";
			echo "<td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";
			echo $guest_name;
			echo "</font></div></td>";
			echo "<td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";
			echo date('d-M-Y', strtotime($created_at));
			echo "<td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";
			echo $status;
			echo "</font></div></td></tr>";
		}
	}
} else {
	//When window loads the first 10 emails having status New are shown.
	$query ="SELECT e.sno, e.user_sno, e.cin, e.cout, e.hotel_name, e.guest_name, e.created_at, e.status, u.user_id, u.user_first_name, u.user_last_name FROM emailrequests e, users u WHERE e.user_sno = 'u.user_sno' AND status = 'New' ORDER BY created_at DESC LIMIT 10";
	$pgq = pg_query($conn, $query);
	$pgnr = pg_num_rows($pgq);
	if (!$pgq) {
		echo "An error occured1.\n";
		exit;
	}
	if(!$pgnr>0){
		echo "<tr><td colspan=\"8\"><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">No Results were found.</font></div></td></tr>";	
	}
	while ($pgfa = pg_fetch_array($pgq)){
		$sno = $pgfa["sno"];
		$user_first_name = $pgfa["user_first_name"];
		$user_last_name = $pgfa["user_last_name"];
		$cin = $pgfa["cin"];
		$cout = $pgfa["cout"];
		$hotel_name = $pgfa["hotel_name"];
		$guest_name = $pgfa["guest_name"];
		$created_at = $pgfa["created_at"];
		$status = $pgfa["status"];
		if($pgnr>0){
			echo "<tr><td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";
			echo "<a href='#' onClick='response(".$sno.")'>".$sno."</a>";
			echo "</font></div></td>";
			echo "<td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";
			echo $user_first_name." ".$user_last_name;
			echo "</font></div></td>";
			echo "<td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";
			echo date('d-M-Y', strtotime($cin));
			echo "</font></div></td>";
			echo "<td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";
			echo date('d-M-Y', strtotime($cout));
			echo "</font></div></td>";
			echo "<td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";
			echo $hotel_name;
			echo "</font></div></td>";
			echo "<td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";
			echo $guest_name;
			echo "</font></div></td>";
			echo "<td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";
			echo date('d-M-Y', strtotime($created_at));
			echo "<td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";
			echo $status;
			echo "</font></div></td></tr>";
		}
	}
}
?>
					
					</table>	
					
					
					
					</td></tr>
					
					
					</table>									
					
			</td> 
              </tr></table> </td>
        </tr>
      </table></td></tr>
	  
	  
      </table> 
</table>	
	
	

	</tr></table>

<script type="text/javascript">
function response(i){ 
	var id = i;
	window.open('emailresponse.php?id='+i, 'popup', 'width=700,height=600,scrollbars=yes,top='+wint+',left='+winl+' ').focus(); 
}
</script>

<script>
    
	var tdddate = new Date();
 
    var dvy = <?php echo $vy; ?>; if (dvy==0) dvy=tdddate.getYear()
	var dvm = <?php echo $vm; ?>; if (dvm==0) dvm=tdddate.getMonth()
	var dnd = <?php echo $vd; ?>; if (dnd==0) dnd=tdddate.getDate()

   if (dvy < 2000) dvy += 1900;	


	var now_date = new Date(dvy,dvm,dnd);
	 now_date.setDate(now_date.getDate()-30) 
	var now_day = now_date.getDate();
	var now_month = now_date.getMonth();
	var now_year = now_date.getYear();

	var dvy1 = <?php echo $vy1; ?>; if (dvy1==0) dvy1=tdddate.getYear()
	var dvm1 = <?php echo $vm1; ?>; if (dvm1==0) dvm1=tdddate.getMonth()
	var dnd1 = <?php echo $vd1; ?>; if (dnd1==0) dnd1=tdddate.getDate()

    if (dvy1 < 2000) dvy1 += 1900;


	var now_date1 = new Date(dvy1,dvm1,dnd1);
	 now_date1.setDate(now_date1.getDate()+0) 
	var now_day1 = now_date1.getDate();
	var now_month1 = now_date1.getMonth();
	var now_year1 = now_date1.getYear();

	
	var d1 = new dateObj(document.gquot.dDay, document.gquot.dMonth, document.gquot.dYear);
	initDates(dvy-1, dvy+1, dvy, now_month, now_day, d1);

	var d2 = new dateObj(document.gquot.d1Day, document.gquot.d1Month, document.gquot.d1Year);
	initDates(dvy-1, dvy+1, dvy, now_month1, now_day1, d2);

 	
</script>


</body>				
</html>
