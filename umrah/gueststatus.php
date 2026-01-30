<?

include ("header.php");
?>

<script src="../javascripts/cBoxes.js"></script>
<script src="gueststatusjs.js"></script> 
<? $vy=$vm=$vd=0; 
$vy1=$vm1=$vd1=0;
?>

<script>
document.title= '<? echo $company_name . " ERP - Guest Status"; ?>';
</script>

<?
$array_acccode = array();
$array_aname = array();
$array_country = array();

$query_agents ="select hotel_id, hotel_name, city from hotels order by hotel_name";

$result_agents = pg_query($conn, $query_agents);

if (!$result_agents) {
	echo "An error occured.\n";
	exit;
	}
while ($rows_agents = pg_fetch_array($result_agents)){

$array_hotel_id[] = $rows_agents["hotel_id"];
$array_hotel_name[] = strtoupper($rows_agents["hotel_name"]);
$array_city[] = strtoupper($rows_agents["city"]);

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
      are here: <a href="uhome.php">Home</a> &raquo;  Reports &raquo; Guest Status</font></td>
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
    <td width="80%" valign="top"  > <table width="100%" border="0" cellpadding="0" cellspacing="1" >
        <tr>
          <td valign="top"> 
           
			


			
            <table width="100%" cellpadding="0" cellspacing="0" ><tr><td width="85%" valign="top" > 
			<table cellpadding="0" cellspacing="0" width="100%" style="border-top: 1px solid #999999; border-bottom: 1px solid #999999" ><tr>
                      <td bgcolor="#CCCCCC"><strong>Guest Status by Hotel</strong></td>
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
                              <td><div align="right"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Guest Status</font></div></td>
                              <td><font size="2" face="Arial, Helvetica, sans-serif"> 
                                <font size="2" face="Arial, Helvetica, sans-serif">

					<select  id="gueststatus" name="gueststatus">
					<option value="not_arrived">Not Arrived</option>
					<option value="in_house">In House</option>
					<option value="no_show">No Show</option>
					</select>



                                </font> </font></td>
                            </tr>

							<tr> 
                              <td><div align="right"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Select 
                                  Hotel</font></div></td>
                              <td><font size="2" face="Arial, Helvetica, sans-serif"> 
                                <font size="2" face="Arial, Helvetica, sans-serif"><strong> 
  		  <select id="hotelname" name="hotelname">
        
		<option value="11101">DAR AL TAWHID INTERCONTINENTAL - MAKKAH</option>

        <?
		for($i=0;$i<count($array_hotel_id);$i++){
  echo  "<option value=\"$array_hotel_id[$i]\">$array_hotel_name[$i] - $array_city[$i]</option>";
}
	?>
    </select>                              </strong></font> </font></td>
                            </tr>
                            <tr> 
                              <td colspan="2"><div align="left"> 
                                  <input type="button" name="get_rl" id="get_rl" value="Get Rooming List >>>" onClick="s_h();">
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
