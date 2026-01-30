<?
include ("header.php");


$vy=$vm=$vd=0;
$vy1=$vm1=$vd1=0;




?>
<script src="../javascripts/cBoxes.js"></script>
<script>
 window.onload = function() {
	document.gquot.dDay.focus();
 }
</script>


<script>
document.title= '<? echo $company_name . " ERP - Umrah - Individual Rates Period Amend"; ?>';
</script>

<html>
<link rel="stylesheet" type="text/css" href="../calendar/css.css" />
<head>
<script>
 var winl = (screen.width - 700) / 2; 
 var wint = (screen.height - 500) / 2;
</script>
</head>
<body leftmargin="0" topmargin="0" rightmargin="0" >
<table width="100%" border="0" cellpadding="0" cellspacing="0" style="border-bottom: 1px solid #999999 ;border-left: 3px solid #006600;border-right: 3px solid #006600"><tr>
    <td bgcolor="#CCCCCC"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">&nbsp;You 
      are here: <a href="uhome.php">Home</a> &raquo; <a href="#">Quotations</a> 
      &raquo; <a href="#">IndividualRates Entry</a> &raquo; IndividualRates Entry Period Amend</font></td>
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
           
			
<?
 $g_cin = $_GET["cin"]; 
$g_cout = $_GET["cout"]; 
$g_hot = $_GET["hot"]; 
$g_nat = trim($_GET["nat"]); 

$vd = date('d', strtotime($g_cin));
$vm=date('m', strtotime($g_cin));
$vy=date('Y', strtotime($g_cin));

$vd1=date('d', strtotime($g_cout));
$vm1=date('m', strtotime($g_cout));
$vy1=date('Y', strtotime($g_cout));


?>

			
            <table width="100%" cellpadding="0" cellspacing="0" ><tr><td width="85%" valign="top"> 
			<table cellpadding="0" cellspacing="0" width="100%" style="border-top: 1px solid #999999; border-bottom: 1px solid #999999"><tr>
                      <td bgcolor="#CCCCCC"><strong>IndividualRates Entry Period Amend</strong></td>
                    </tr></table>
<table width="100%" cellpadding="1" cellspacing="0"><tr>
                      <td> 
                          <table width="100%" border="0" cellspacing="0" align="center"><tr><td>


<br>
						  <table border="0" align="center" style="border: 1px solid #009900;" cellpadding="5" cellspacing="0">
                                <form name="gquot" action="amdgrperiodinda.php"  method="post" >
                                  <tr bgcolor="#BBFFBB"> 
                                    <td colspan="2" > <div align="center"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Change 
                                        Dates to Amend Present Dates</font> </div> 
                                  <tr> 
                                    <td align="center"><table>
                                        <tr> 
                                          <td><font size="2" face="Verdana, Arial, Helvetica, sans-serif">CheckIn 
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
                                    <td align="center"><table>
                                        <tr> 
                                          <td><font size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
                                            CheckOut 
                                            <select name="d1Day" class="selBox">
                                            </select>
                                            </font></td>
                                          <td><font size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
                                            <select name="d1Month" class="selBox">
                                            </select>
                                            </font></td>
                                          <td><font size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
                                            <select name="d1Year" class="selBox">
                                            </select>
                                            </font></td>
                                        </tr>
                                      </table></td>
                                  </tr>
                                  <tr> 
                                    <td colspan="2" align="center">
									
									<input type="hidden" name="vcin" value="<? echo $g_cin ; ?>">
									<input type="hidden" name="vcout" value="<? echo $g_cout ; ?>">
									<input type="hidden" name="vhot" value="<? echo $g_hot ; ?>">
									<input type="hidden" name="vnat" value="<? echo $g_nat ; ?>">

									
									<input type="submit" name="Submit" value="Amend Period"> 
                                      <font size="2" face="Verdana, Arial, Helvetica, sans-serif">&nbsp; 
                                      </font> </td>
                                  </tr>
                                </form>
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
	var dvm = <?php echo $vm  ?>; if (dvm==0) dvm=tdddate.getMonth()
    <?	if($vm==0){echo $vm ;} else { ?>
		
    var dvm = <? echo $vm-1 ;} ?>

	var dnd = <?php echo $vd; ?>; if (dnd==0) dnd=tdddate.getDate()

   if (dvy < 2000) dvy += 1900;	


	var now_date = new Date(dvy,dvm,dnd);
	var now_day = now_date.getDate();
	var now_month = now_date.getMonth();
	var now_year = now_date.getYear();

	var dvy1 = <?php echo $vy1; ?>; if (dvy1==0) dvy1=tdddate.getYear()
	var dvm1 = <?php echo $vm1 ; ?>; if (dvm1==0) dvm1=tdddate.getMonth()

	<?	if($vm1==0){echo $vm1 ;} else { ?>
		
    var dvm1 = <? echo $vm1-1 ;} ?>

	var dnd1 = <?php echo $vd1; ?>; if (dnd1==0) dnd1=tdddate.getDate()

    if (dvy1 < 2000) dvy1 += 1900;


	var now_date1 = new Date(dvy1,dvm1,dnd1);
	var now_day1 = now_date1.getDate();
	var now_month1 = now_date1.getMonth();
	var now_year1 = now_date1.getYear();



	var d1 = new dateObj(document.gquot.dDay, document.gquot.dMonth, document.gquot.dYear);
	initDates(now_year, now_year+1, now_year, now_month, now_day, d1);

   	var d2 = new dateObj(document.gquot.d1Day, document.gquot.d1Month, document.gquot.d1Year);
	initDates(now_year1, now_year1+1, now_year1, now_month1, now_day1, d2);


</script>


</body>				
</html>
