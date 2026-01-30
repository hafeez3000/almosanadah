<?

include ("header.php");
?>

<script src="../javascripts/cBoxes.js"></script>
<? $vy=$vm=$vd=0; 
$vy1=$vm1=$vd1=0;
?>

<script>
document.title= '<? echo $company_name . " ERP - Bookings by Check-In/Request Date"; ?>';
</script>

<?
$array_acccode = array();
$array_aname = array();
$array_country = array();

$query_agents ="select acccode, aname, country from agentsdet order by aname";

$result_agents = pg_query($query_agents);

if (!$result_agents) {
	echo "An error occured.\n";
	exit;
	}
while ($rows_agents = pg_fetch_array($result_agents)){

$array_acccode[] = $rows_agents["acccode"];
$array_aname[] = strtoupper($rows_agents["aname"]);
$array_country[] = strtoupper($rows_agents["country"]);

}

pg_free_result($result_agents);

?>

<html>
<link rel="stylesheet" type="text/css" href="../calendar/css.css" />
<head>
<script>
 var winl = (screen.width - 700) / 2; 
 var wint = (screen.height - 500) / 2;
</script>
</head>
<body leftmargin="0" topmargin="0" rightmargin="0">
<table width="100%" border="0" cellpadding="0" cellspacing="0" style="border-bottom: 1px solid #999999 ;border-left: 3px solid #006600;border-right: 3px solid #006600"><tr>
    <td bgcolor="#CCCCCC"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">&nbsp;You 
      are here: <a href="uhome.php">Home</a> &raquo; <a href="bookings.php">Booking 
      Details</a> &raquo; Bookings by Check-In/Request Date</font></td>
  </tr></table>
  
<table width="100%" border="0" cellpadding="0" cellspacing="0" style="border-bottom: 3px solid #006600; border-right: 3px solid #006600;border-left: 3px solid #006600 ">
  <tr>
    <td width="20%" style="border-right: 1px solid #999999"  valign="top"> <table width="100%" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td valign="top"><div align="left"> 
              <?include ("umenu.php"); ?>
            </div></td>
        </tr>
      </table></td>
    <td width="80%" valign="top"  > <table width="100%" border="0" cellpadding="0" cellspacing="1">
        <tr>
          <td valign="top"> 
           
			


			
            <table width="100%" cellpadding="0" cellspacing="0" ><tr><td width="85%" valign="top"> 
			<table cellpadding="0" cellspacing="0" width="100%" style="border-top: 1px solid #999999; border-bottom: 1px solid #999999"><tr>
                      <td bgcolor="#CCCCCC"><strong>Bookings by Check In / Request 
                        Date</strong></td>
                    </tr></table>
<table width="100%" cellpadding="1" cellspacing="0"><tr>
                      <td> 
                          <table width="100%" border="0" cellspacing="0" style=" border-bottom: 1px solid #999999">
                          <form name="bbyod" method="post" action="bbycrdaction.php">
                            <tr> 
                              <td colspan="2">Find Orders By</td>
                            </tr>
                            <tr> 
                              <td><div align="right"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Select 
                                  Date</font></div></td>
                              <td><font size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
                                <select name="dDay" class="selBox">
                                </select>
                                </font><font size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
                                <select name="dMonth" class="selBox">
                                </select>
                                </font><font size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
                                <select name="dYear" class="selBox">
                                </select>
                                </font></td>
                            </tr>
                            <tr> 
                              <td><div align="right"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Select 
                                  Date</font></div></td>
                              <td><font size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
                                <select name="dDay1" class="selBox">
                                </select>
                                </font><font size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
                                <select name="dMonth1" class="selBox">
                                </select>
                                </font><font size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
                                <select name="dYear1" class="selBox">
                                </select>
                                </font></td>
                            </tr>
                            <tr> 
                              <td><div align="right"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Select 
                                  Booking Status</font></div></td>
                              <td><font size="2" face="Arial, Helvetica, sans-serif"> 
                                <font size="2" face="Arial, Helvetica, sans-serif"><strong> 
                                <select name="booking_status">
                                  <option value="On Request">On Request</option>
                                  <option value="Confirmed">Confirmed</option>
                                  <option value="Cancelled">Cancelled</option>
                                  <option value="%">All</option>
                                </select>
                                </strong></font> </font></td>
                            </tr>
                            <tr> 
                              <td><div align="right"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Select 
                                  Type of Booking</font></div></td>
                              <td><font size="2" face="Arial, Helvetica, sans-serif"> 
                                <font size="2" face="Arial, Helvetica, sans-serif"><strong> 
                                <select name="type_booking">
                                  <option value="hotels">Hotels</option>
                                  <option value="trans">Transportation</option>
                               
                                  <option value="others">Extra</option>
                                  <option value="all">All</option>
                                </select>
                                </strong></font> </font></td>
                            </tr>
							
                            <tr> 
                              <td colspan="2"><div align="right"> 
                                  <input type="submit" name="Submit" value="Bookings by Check-In / Request Date >>>">
                                </div></td>
                            </tr>
                          </form>
                        </table>
<br>
                       



		
							

							  </td>
                            </tr>
                          </table>
                         </td>
                    </tr></table>									
					
			</td> 
              </tr></table> </td>
        </tr>
      </table></td></tr>
	  
	  
      </table> 
</table>	
	
	

	</tr></table>

<script>
    
	var tdddate = new Date();
 
    var dvy = <?php echo $vy; ?>; if (dvy==0) dvy=tdddate.getYear()
	var dvm = <?php echo $vm; ?>; if (dvm==0) dvm=tdddate.getMonth()
	var dnd = <?php echo $vd; ?>; if (dnd==0) dnd=tdddate.getDate()

   if (dvy < 2000) dvy += 1900;	


	var now_date = new Date(dvy,dvm,dnd);
	var now_day = now_date.getDate();
	var now_month = now_date.getMonth();

	var now_year = now_date.getYear();

	var dvy1 = <?php echo $vy1; ?>; if (dvy1==0) dvy1=tdddate.getYear()
	var dvm1 = <?php echo $vm1; ?>; if (dvm1==0) dvm1=tdddate.getMonth()
	var dnd1 = <?php echo $vd1; ?>; if (dnd1==0) dnd1=tdddate.getDate()

    if (dvy1 < 2000) dvy1 += 1900;


	var now_date1 = new Date(dvy1,dvm1,dnd1);
	var now_day1 = now_date1.getDate();
	var now_month1 = now_date1.getMonth();

	var now_year1 = now_date1.getYear();

	
	var d1 = new dateObj(document.bbyod.dDay, document.bbyod.dMonth, document.bbyod.dYear);
	initDates(dvy-1, dvy+1, dvy, now_month, now_day, d1);

	var d2 = new dateObj(document.bbyod.dDay1, document.bbyod.dMonth1, document.bbyod.dYear1);
	initDates(dvy-1, dvy+1, dvy, now_month, now_day1, d2);

 	
</script>


</body>				
</html>
