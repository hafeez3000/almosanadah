<?
include ("header.php");
?>

<script src="../javascripts/cBoxes.js"></script>
<? $vy=$vm=$vd=0; 
$vy1=$vm1=$vd1=0;
?>

<script>
document.title= '<? echo $company_name . " ERP - Cases"; ?>';
</script>


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
      are here: <a href="uhome.php">Home</a> &raquo; Cases  &raquo; List Cases</font></td>
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
                      <td bgcolor="#CCCCCC"><strong>List Case</strong></td>
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
                                      </select> &nbsp;&nbsp;                                      </font><input type="hidden" name="action" value="submitted" /> <input type="button" id ="b_listcases" name="b_listcases" value="List Cases" onClick="this.form.submit();"> </td>
                                  </tr>
								</table>	
								



							

					 </td>

                            </tr>
                        
					
						  
						  </table>
                         </td>
                    </tr>
					
					<tr><td> <br><br>
					<table border="1" cellpadding="1" cellspacing="0" width="98%" align="center"><tr><td><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Case No.</font></td><td><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Case Subject</font></font
					></td><td> <font size="2" face="Verdana, Arial, Helvetica, sans-serif">Date Entered</font></td><td ><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Priority</font></td><td ><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Status</font></td><td ><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Description</font></td><td ><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Resolution</font></td></tr>
				
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



				$q_main_sel ="select sno,subject,date_entered,description,resolution,status,priority  from cases where created_by=$suser_sno and date_entered between date '$fromd' and date '$tod' + integer '1' order by date_entered desc ";

$res_main_sel = pg_query($conn, $q_main_sel);

$rows_main = pg_num_rows($res_main_sel);

if (!$res_main_sel) {
echo "An error occured.\n";
exit;
		}


while ($rows_main_sel = pg_fetch_array($res_main_sel)){


$s_sno = $rows_main_sel["sno"];

$s_subject = $rows_main_sel["subject"];
$s_date_entered = $rows_main_sel["date_entered"];
$s_description = $rows_main_sel["description"];
$s_resolution = $rows_main_sel["resolution"];
$s_status = $rows_main_sel["status"];
$s_priority = $rows_main_sel["priority"];

if($rows_main>0){


echo "<tr><td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";
echo $s_sno;
echo "</font></div></td>";
echo "<td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";
echo $s_subject;
echo "</font></div></td>";
echo "<td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";
echo date('d-M-Y', strtotime($s_date_entered));
echo "</font></div></td>";
echo "<td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";
echo $s_priority;
echo "</font></div></td>";
echo "<td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";
echo $s_status;
echo "</font></div></td>";
echo "<td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";
echo $s_description;
echo "</font></div></td>";
echo "<td><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";
echo $s_resolution;
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
