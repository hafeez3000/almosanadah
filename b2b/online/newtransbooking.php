<?
include ("header.php");
include ("../calendar/cal.php");
?>
<script src="../javascripts/cBoxes.js"></script>


<script>
document.title= '<? echo $company_name . " ERP - Umrah New Bookings"; ?>';
</script>
<script src="../javascripts/DS.js"></script>
<script>
 window.onload = function() {
	document.gquot.d1Day.focus();
 }
</script>

	<? 

 $vy=$vm=$vd=0;





/*$array_transt[] = array();
$array_transt_id[] = array();
$array_transt_route[] = array();
$array_nofp[] = array();
$array_transt_description[] = array();
*/





$query_transt ="select trans_id, trans_type,trans_route,no_of_paxs,trans_description from transtypes where trans_id like '116%'  ";

$result_transt = pg_query($query_transt);

if (!$result_transt) {
	echo "An error occured.\n";
	exit;
	}
while ($rows_transt = pg_fetch_array($result_transt)){


$array_transt[] = $rows_transt["trans_type"];
$array_transt_id[] = $rows_transt["trans_id"];
$array_transt_route[] = $rows_transt["trans_route"];
$array_nofp[] = $rows_transt["no_of_paxs"];
$array_transt_description[] = $rows_transt["trans_description"];

}



pg_free_result($result_transt);


?>



<html>
<link rel="stylesheet" type="text/css" href="../calendar/css.css" />
<body leftmargin="0" topmargin="0" rightmargin="0">
<table width="100%" border="0" cellpadding="0" cellspacing="0" style="border-bottom: 1px solid #999999 ;border-left: 3px solid #006600;border-right: 3px solid #006600"><tr>
    <td bgcolor="#CCCCCC"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">&nbsp;You 
      are here: <a href="uhome.php">Home</a> &raquo; <a href="bookings.php">Bookings</a>  &raquo; <a href="newbookings.php">New Bookings</a> &raquo; New Transportation Booking</a></font></td>
  </tr></table>
  
<table width="100%" border="0" cellpadding="0" cellspacing="0" style="border-bottom: 3px solid #006600; border-right: 3px solid #006600;border-left: 3px solid #006600 ">
  <tr>
    <td width="20%" style="border-right: 1px solid #999999" valign="top"> <table width="100%" border="0" cellpadding="0" cellspacing="0">
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
                      <td bgcolor="#CCCCCC"><strong>New Transport Booking </strong>- Select Transportation</td>
                    </tr></table>
<table width="100%" cellpadding="1" cellspacing="0"><tr>
                      <td  style="border-bottom: 1px solid #999999"><div align="left"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
					   
					
					  
					  </font></div></td>
                    </tr></table>
					
<?


//$vy=date('Y', strtotime($s_req_date_time));
//$vm=date('m', strtotime($s_req_date_time));
//$vd=date('d', strtotime($s_req_date_time));

$vy=$vm=$vd=0;

?>



<form name="gquot" action="transselp.php"  method="post" onSubmit="return fun2(this)">

<table width="100%" align="left" style="border: 1px solid #673636" cellpadding="5" cellspacing="0">
 <tr bgcolor="#E8D2D2">
                                  <td colspan="4" align="center" bgcolor="#E8D2D2">
                                      <strong>Transportation  </strong></td>
                                </tr>
                                <tr>
                                  <td width="17%"><div align="right" ><font size="2" face="Verdana, Arial, Helvetica, sans-serif"> Date</font></div></td>
                                  <td><font size="2" face="Verdana, Arial, Helvetica, sans-serif">
                                    <select name="d1Day" class="selBox">
                                    </select>
                                  </font><font size="2" face="Verdana, Arial, Helvetica, sans-serif">
                                    <select name="d1Month" class="selBox">
                                    </select>
                                                                    </font><font size="2" face="Verdana, Arial, Helvetica, sans-serif">
                                    <select name="d1Year" class="selBox">
                                    </select>                                                                                    </font></td>
                                  <td><div align="right"><font size="2" face="Arial, Helvetica, sans-serif">Time</font></div></td>
                                  <td><select id="timeselecthours0" name="timeselecthours0">
								  
 <option value="00">00</option>
 <option value="01">01</option>
 <option value="02">02</option>                                  
 <option value="03">03</option>                                  
 <option value="04">04</option>                                  
 <option value="05">05</option>                                  
 <option value="06">06</option>                                  
 <option value="07">07</option>                                  
 <option value="08">08</option>                                  
 <option value="09">09</option>                                  
 <option value="10">10</option>                                  
 <option value="11">11</option>                                  
 <option value="12">12</option>                                  
 <option value="13">13</option>                                  
 <option value="14">14</option>                                  
 <option value="15">15</option>                                  
 <option value="16">16</option>                                  
 <option value="17">17</option>                                  
 <option value="18">18</option>                                  
 <option value="19">19</option>                                  
 <option value="20">20</option>                                  
 <option value="21">21</option>                                  
 <option value="22">22</option>                                  
 <option value="23">23</option>                                  
 
                                  </select>
                                    <select id="timeselectmin0" name="timeselectmin0">

                                      <option value="00">00</option>
                                      <option value="01">01</option>
                                      <option value="02">02</option>
                                      <option value="03">03</option>
                                      <option value="04">04</option>
                                      <option value="05">05</option>
                                      <option value="06">06</option>
                                      <option value="07">07</option>
                                      <option value="08">08</option>
                                      <option value="09">09</option>
                                      <option value="10">10</option>
                                      <option value="11">11</option>
                                      <option value="12">12</option>
                                      <option value="13">13</option>
                                      <option value="14">14</option>
                                      <option value="15">15</option>
                                      <option value="16">16</option>
                                      <option value="17">17</option>
                                      <option value="18">18</option>
                                      <option value="19">19</option>
                                      <option value="20">20</option>
                                      <option value="21">21</option>
                                      <option value="22">22</option>
                                      <option value="23">23</option>
                                      <option value="24">24</option>
                                      <option value="25">25</option>
                                      <option value="26">26</option>
                                      <option value="27">27</option>
                                      <option value="28">28</option>
                                      <option value="29">29</option>
                                      <option value="30">30</option>
                                      <option value="31">31</option>
                                      <option value="32">32</option>
                                      <option value="33">33</option>
                                      <option value="34">34</option>
                                      <option value="35">35</option>
                                      <option value="36">36</option>
                                      <option value="37">37</option>
                                      <option value="38">38</option>
                                      <option value="39">39</option>
                                      <option value="40">40</option>
                                      <option value="41">41</option>
                                      <option value="42">42</option>
                                      <option value="43">43</option>
                                      <option value="44">44</option>
                                      <option value="45">45</option>
                                      <option value="46">46</option>
                                      <option value="47">47</option>
                                      <option value="48">48</option>
                                      <option value="49">49</option>
                                      <option value="50">50</option>
                                      <option value="51">51</option>
                                      <option value="52">52</option>
                                      <option value="53">53</option>
                                      <option value="54">54</option>
                                      <option value="55">55</option>
                                      <option value="56">56</option>
                                      <option value="57">57</option>
                                      <option value="58">58</option>
                                      <option value="59">59</option>
                                    </select></td>
                                </tr>
                   
                                <tr>
                                  <td><div align="right"><font size="2" face="Arial, Helvetica, sans-serif">Type 
                                  of Transportation</font></div></td>
                                  <td colspan="3"><font size="2" face="Arial, Helvetica, sans-serif"><strong>
                                    <select id="typeoftrans0" name="typeoftrans0">
                     
									  <option value="select">Select Transportation Type...</option>
                                      <?
	

		for($i=0;$i<count($array_transt_id);$i++){


 echo  "<option   value=\"$array_transt_id[$i]\">$array_transt[$i] - $array_transt_route[$i]</option>";
		}
	?>
                                    </select>
                                  </strong></font></td>
                                </tr>
                                <tr>
                                  <td><div align="right"><font size="2" face="Arial, Helvetica, sans-serif">Flight 
                                  Details</font></div></td>
                                  <td><font size="2" face="Arial, Helvetica, sans-serif">
                                    <input id="flightdet0" name="flightdet0"  type="text" size="30">
                                  </font></td>
                                  <td><div align="right"><font size="2" face="Arial, Helvetica, sans-serif">No. Units</font></div></td>
                                  <td><font size="2" face="Arial, Helvetica, sans-serif"><font size="2" face="Arial, Helvetica, sans-serif"><strong>
                                    <select id="noofu0" name="noofu0">
                                   				
                                      <?  for($u0=1;$u0<=5;$u0++){ 
							echo "<option value=\"$u0\">$u0</option>";
							}?>
                                    </select>
                                  </strong></font></font></td>
                                </tr>
 <tr>
                                  <td colspan="4" style="border-top: 1px solid #673636" align="right">
								  
			
                                      <input type="submit" name="Submit" value="Get Rates >>">                                    </td>
                                </tr>

</table>



</form>
					
					  
					  </font></div></td>
                    </tr></table>

			</td> 
                <td width="15%" style="border-left: 1px solid #999999" valign="top"><table >
                    <tr>
                      <td style="border-bottom: 1px solid #999999" valign="top"><?php 


$time = time(); 
$today = date('j',$time); 
$days = array($today=>array(NULL,NULL,'<span style="color: red; font-weight: bold; font-size: larger; text-decoration: none;">'.$today.'</span>')); 
echo generate_calendar(date('Y', $time), date('n', $time), $days, 2); 
?>

                        </td>
                    </tr>
					      <tr>
                      <td style="border-bottom: 1px solid #999999"><?php 
    $time = time(); 
    echo generate_calendar(date('Y', $time), date('n', $time)+1, NULL, 2); 
?> 

                        </td>
                    </tr>
					
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
    now_date.setDate(now_date.getDate()+1) 
    
	var now_day = now_date.getDate();
	var now_month = now_date.getMonth();
	var now_year = now_date.getYear();

	var d1 = new dateObj(document.gquot.d1Day, document.gquot.d1Month, document.gquot.d1Year);
	initDates(dvy-1, dvy+1, dvy, now_month, now_day, d1);


//   	var d2 = new dateObj(document.gquot.d1Day, document.gquot.d1Month, document.gquot.d1Year);
//	initDates(dvy1-1, dvy1+1, dvy1, now_month1, now_day1, d2);

</script>

<script>
function fun2(theForm){

if(1){

var cd2= document.gquot.d1Day.value;
var cm2= document.gquot.d1Month.value;
var cy2= document.gquot.d1Year.value;

var c_date2 = new Date();
c_date2.setFullYear(document.gquot.d1Year.value,document.gquot.d1Month.value-1,document.gquot.d1Day.value);


var server_date = new Date();
server_date.setFullYear(<? echo  date("Y")  .",". (date("m")-1) .",". date("d") ; ?> );
server_date.setHours( <? echo  date("H") ; ?> );
server_date.setMinutes( <? echo  date("i") ; ?> );
server_date.setSeconds( <? echo  date("s") ; ?> );

var n_today = new Date();

//if((server_date-n_today)>1){
//alert("Please Set your computer date to current local date and time");
//return false;	
//}

var one_day=1000*60*60*24;



if( ((server_date.getTime()- n_today.getTime()) / (one_day))>1 )
{
alert("Please Set your computer date to current local date and time");
return false;	
}
if( ((server_date.getTime()- n_today.getTime()) / (one_day))<-1 )
{
alert("Please Set your computer date to current local date and time");
return false;	
}



if(c_date2<n_today){
alert("Request date must be after Today");
return false;	
}


}



if(document.gquot.typeoftrans0.value=="select"){

	alert("Sorry, but select Transportation Type.");
		document.gquot.typeoftrans0.focus();
		return false;
	}







}
</script>



</body>				
</html>
