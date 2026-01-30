<?

include ("header1.php");
?>

<script src="../javascripts/cBoxes.js"></script>
<script src="salesreportbyajs.js"></script> 
<? $vy=$vm=$vd=0; 
$vy1=$vm1=$vd1=0;
?>

<script>
document.title= '<? echo $company_name . " ERP - Sales Report by Agent"; ?>';
</script>

<?
$array_country = array();
$array_trans = array();
$array_trans_id = array();


$query_trans ="select acccode, aname,scountry from agentsdet order by aname";

$result_trans = pg_query($conn, $query_trans);

if (!$result_trans) {
	echo "An error occured.\n";
	exit;
	}
while ($rows_trans = pg_fetch_array($result_trans)){

$array_trans[] = $rows_trans["aname"];
$array_trans_id[] = $rows_trans["acccode"];
$array_country[] = $rows_trans["scountry"];
}

pg_free_result($result_trans);

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
      are here: <a href="uhome.php">Home</a> &raquo;  Reports &raquo; Sales Reports by Hotel</font></td>
  </tr></table>
  
<table width="100%" border="0" cellpadding="0" cellspacing="0" style="border-bottom: 3px solid #006600; border-right: 3px solid #006600;border-left: 3px solid #006600 ">
  <tr>
    
    <td width="100%" valign="top"  > <table width="100%" border="0" cellpadding="0" cellspacing="1" >
        <tr>
          <td valign="top"> 
           
            <table width="100%" cellpadding="0" cellspacing="0" ><tr><td width="85%" valign="top" > 
			<table cellpadding="0" cellspacing="0" width="100%" style="border-top: 1px solid #999999; border-bottom: 1px solid #999999" ><tr>
                      <td bgcolor="#CCCCCC"><strong>Sales Reports by Agents</strong></td>
                    </tr></table>
<table width="100%" cellpadding="1" cellspacing="0" ><tr>
                      <td> 
                          <table width="100%" border="0" cellspacing="0" style=" border-bottom: 1px solid #999999">
                          <form name="bbyod" method="post" action="#">
                            
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
                              <td><div align="right"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Booking Status</font></div></td>
                              <td><font size="2" face="Arial, Helvetica, sans-serif"> 
                                <font size="2" face="Arial, Helvetica, sans-serif">

					<select  id="gueststatus" name="gueststatus">
					<option value="on_request">On Request</option>
					<option value="confirmed">Confirmed</option>
					<option value="cancelled">Cancelled</option>
					</select>



                                </font> </font></td>
                            </tr>

							<tr> 
                              <td><div align="right"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Select 
                                  Hotel</font></div></td>
                              <td><font size="2" face="Arial, Helvetica, sans-serif"> 
                                <font size="2" face="Arial, Helvetica, sans-serif"><strong> 
  		  <select  name="hotelname">
        
		<option value="all">All Agents</option>

        <?
		for($i=0;$i<count($array_trans_id);$i++){
  echo  "<option value=\"$array_trans_id[$i]\">$array_trans[$i] - $array_country[$i]</option>";
}
	?>
    </select>                              </strong></font> </font></td>
                            </tr>
                            <tr> 
                              <td colspan="2"><div align="left"> 
                                  <input type="button" name="get_rl" id="get_rl" value="Get Sales Report >>>" onClick="s_h();">
                                </div></td>



                            </tr>

							

                          </form>





<script>
function s_h(){ 


var fv = document.getElementById("hotelname").value;

var f_year = document.bbyod.dYear.value;
var f_month = document.bbyod.dMonth.value;
var f_day  = document.bbyod.dDay.value;

var t_year = document.bbyod.dYear1.value;
var t_month = document.bbyod.dMonth1.value;
var t_day  = document.bbyod.dDay1.value;

var from_d = f_year+"-"+f_month+"-"+f_day;
var to_d = t_year+"-"+t_month+"-"+t_day;

var gs = document.getElementById("gueststatus").value;
//var from_d = "2006-09-25";
//var to_d = "2006-09-27";


showHint(fv, from_d, to_d, gs);


	}
</script>
                        </table>
	  
	



      </table> 
</table>	
	
	

	</tr></table>

<p><span id="txtHint"></span></p> 

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


<script>
function fun2(theForm){




 if ((document.bbyod1.tdata.value== null) ||   ((document.bbyod1.tdata.value).length==0))
   {
      alert ("Sorry, But enter string to find orders");
	  document.bbyod1.tdata.focus();
	  		return false;
   }




}
</script>

</body>				
</html>
