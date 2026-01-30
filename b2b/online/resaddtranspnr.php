<?
include ("header.php");
include ("../calendar/cal.php");
?>
<script src="../javascripts/cBoxes.js"></script>


<script>
document.title= '<? echo $company_name . " ERP - Umrah New Bookings"; ?>';
</script>


	<? 



 $vmin=0;
 $vhours=0;



$array_trans_id = array();
$array_trans = array();
$array_trans_city = array();

$array_transt[] = array();
$array_transt_id[] = array();
$array_transt_route[] = array();
$array_nofp[] = array();
$array_transt_description[] = array();


$query_trans ="select trans_id,trans_c_name,city from s_trans";

$result_trans = pg_query($query_trans);

if (!$result_trans) {
	echo "An error occured.\n";
	exit;
	}
while ($rows_trans = pg_fetch_array($result_trans)){
$array_trans_id[] = $rows_trans["trans_id"];
$array_trans[] = $rows_trans["trans_c_name"];
$array_trans_city[] = $rows_trans["city"];

}

pg_free_result($result_trans);


$query_transt ="select trans_id, trans_type,trans_route,no_of_paxs,trans_description from transtypes order by trans_id";

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



session_start();
 $s_pnr = $_SESSION["spnr"];

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

$_SESSION['d6Day']   = $_POST['d1Day'];
$_SESSION['d6Month'] = $_POST['d1Month'];
$_SESSION['d6Year']  = $_POST['d1Year'];

$trans0d = $_POST['d1Day'];
$trans0m = $_POST['d1Month'];
$trans0y = $_POST['d1Year'];

$trans0rd = $trans0y ."-". $trans0m ."-". $trans0d ; 

$s_timeselecthours0   = $_POST['timeselecthours0']; 
$s_timeselectmin0	  = $_POST['timeselectmin0'];   
//$s_s_trans0			  = $_POST['s_trans0'];       
$s_s_trans0			  = 116;          
$s_typeoftrans0		  = $_POST['typeoftrans0'];     
$s_noofu0			  = $_POST['noofu0'];           
$s_flightdet0		  = $_POST['flightdet0'];       

$_SESSION['timeselecthours0']= $_POST['timeselecthours0'];  
$_SESSION['timeselectmin0']= $_POST['timeselectmin0'];    
$_SESSION['s_trans0']= 116;         
$_SESSION['typeoftrans0']= $_POST['typeoftrans0'];      
$_SESSION['noofu0']= $_POST['noofu0'];            
$_SESSION['flightdet0']= $_POST['flightdet0'];        

?>

<form name="roomselput" action="resaddtranspnra.php"  method="post">


<table width="100%" cellpadding="1" cellspacing="0">
                                   <tr bgcolor="#FFFFFF">
                            <td colspan="8">&nbsp;</td>
                          </tr>

								   <tr bgcolor="#CCCCCC">
                            <td colspan="8"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Transportation Sno : 1</font></td>
                          </tr>
					    <tr bgcolor="#FFFFFF">
                            <td colspan="8"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Transportation Supplier :
<?
for($t0=0; $t0<count($array_trans_id); $t0++){
if($s_s_trans0==$array_trans_id[$t0]){
echo $array_trans[$t0] . " - " . $array_trans_city[$t0];	
$_SESSION["transid"]=$array_trans_id[$t0];
}
}

?>
</font></td>      </tr>

<tr bgcolor="#EFEFEF">
                            <td colspan="1" align="center" style="border-right: 1px solid #999999; border-top: 1px solid #999999" ><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Trans Type</b></font></td>
                            <td colspan="1" align="center" style="border-right: 1px solid #999999; border-top: 1px solid #999999"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Trans Route</b></font></td>
                            <td colspan="1" align="center" style="border-right: 1px solid #999999; border-top: 1px solid #999999"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Units</b></font></td>
                            <td colspan="1" align="center" style="border-right: 1px solid #999999; border-top: 1px solid #999999"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Date & Time</b></font></td>
                            <td colspan="1" align="center" style="border-right: 1px solid #999999; border-top: 1px solid #999999"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Flight Details</b></font></td>
                            <td colspan="1" align="center" style="border-right: 1px solid #999999; border-top: 1px solid #999999"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>No of Paxs</b></font></td>

                            <td colspan="1" align="center" style="border-top: 1px solid #999999"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Sell Rate</b></font></td>


                          </tr>

<?


$trans0rd = $trans0y ."-". $trans0m ."-". $trans0d ; 

$s_typeoftrans0		  = $_SESSION['typeoftrans0'];     


for($tv0=0; $tv0<count($array_transt_id); $tv0++){
if($s_typeoftrans0==$array_transt_id[$tv0]){
$tvety0=$array_transt[$tv0] ;
$tvetr0=$array_transt_route[$tv0];	
$tvetp0=$array_nofp[$tv0];
}
}

$trans1netr=0;
$trans1sellr=0;

$query_trans1_rates ="select trans_id,from_date,to_date, net_rate,sell_rate  from res_trans_rates where '$trans0rd' between from_date and to_date - interval '1 day' and trans_id = $s_typeoftrans0 ";

$result_trans1_rates = pg_query($query_trans1_rates);

if (!$result_trans1_rates) {
	echo "An error occured.\n";
	exit;
	}
while ($rows_trans1_rates = pg_fetch_array($result_trans1_rates)){

$trans1netr=$rows_trans1_rates["net_rate"];
$trans1sellr=$rows_trans1_rates["sell_rate"];

}
	   


?>

<tr bgcolor="#EFEFEF">
                            <td colspan="1" align="center" style="border-bottom: 1px solid #999999; border-right: 1px solid #999999; border-top: 1px solid #999999" ><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><? $_SESSION['tvety0'] = $tvety0 ; echo $tvety0 ;?></font></td>
                            <td colspan="1" align="center" style="border-bottom: 1px solid #999999;border-right: 1px solid #999999; border-top: 1px solid #999999"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><? $_SESSION['tvetr0'] = $tvetr0 ; echo $tvetr0 ; ?></font></td>
                            <td colspan="1" align="center" style="border-bottom: 1px solid #999999;border-right: 1px solid #999999; border-top: 1px solid #999999"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><? echo $s_noofu0 ?></font></td>
                            <td colspan="1" align="center" style="border-bottom: 1px solid #999999;border-right: 1px solid #999999; border-top: 1px solid #999999"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><? echo date('d-M-Y', strtotime($trans0rd)) ."<br>". $s_timeselecthours0 .":".$s_timeselectmin0; ?></font></td>
                            <td colspan="1" align="center" style="border-bottom: 1px solid #999999;border-right: 1px solid #999999; border-top: 1px solid #999999"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><? if(strlen($s_flightdet0)>0){ echo $s_flightdet0 ; } else { echo "&nbsp;" ; } ?></font></td>
                            <td colspan="1" align="center" style="border-bottom: 1px solid #999999;border-right: 1px solid #999999; border-top: 1px solid #999999"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><? $_SESSION['tvetp0'] = $tvetp0 ; echo $tvetp0 * $s_noofu0?></font></td>
                            
							


							<script>
function trans1n<? echo $s_typeoftrans0 ;?>(){ 
//grand_net(grand_gnt);
}
function trans1<? echo $s_typeoftrans0 ;?>(){ 
grand_sell(grand_gt);
}
</script>
							
						<td colspan="1" align="center" style="border-bottom: 1px solid #999999;border-top: 1px solid #999999"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><input type="hidden" id="trans1nrate<? echo $s_typeoftrans0 ?>" name="trans1nrate<? echo $s_typeoftrans0 ?>" value='<? echo $trans1netr * $s_noofu0 ?>' size="2" onKeyUp="trans1n<? echo $s_typeoftrans0 ?>()"  onFocus="trans1n<? echo $s_typeoftrans0 ?>()" onBlur="trans1n<? echo $s_typeoftrans0 ?>()"><input type="text" id="trans1rate<? echo $s_typeoftrans0 ?>" name="trans1rate<? echo $s_typeoftrans0 ?>" value='<? echo $trans1sellr * $s_noofu0 ?>' size="2" onKeyUp="trans1<? echo $s_typeoftrans0 ?>()"  onFocus="trans1<? echo $s_typeoftrans0 ?>()" onBlur="trans1<? echo $s_typeoftrans0 ?>()" readonly></font></td>


                          </tr>




</table>

</td>
                          </tr>

<tr><td>&nbsp;</td></tr>

     <tr bgcolor="#CCCCCC">
                            <td colspan="2"><b>Grand Totals</b></td>
                          </tr>

<script>

function grand_net(val){
var g_net=0 ;

g_net = parseFloat(g_net) + parseFloat(document.getElementById("trans1nrate<? echo $s_typeoftrans0 ?>").value);



val.innerHTML = g_net;
}


function grand_sell(val){
var g_sell=0 ;

g_sell = parseFloat(g_sell) + parseFloat(document.getElementById("trans1rate<? echo $s_typeoftrans0 ?>").value);


val.innerHTML = g_sell;
}

</script>

<tr><td><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><FONT 
style="BACKGROUND-COLOR: #DFDFDF"></FONT><span id="grand_gnt"></span></font></td></tr>

<tr><td align="right"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><FONT 
style="BACKGROUND-COLOR: #DFDFDF">Grand Selling Total:</FONT> SAR <span id="grand_gt">0</span>/-</font></td></tr>


<script>
//grand_net(grand_gnt);
grand_sell(grand_gt);
</script>

                                   <tr>
                            <td colspan="2">&nbsp;</td>
                          </tr>

<tr><td colspan="2" align="center"><input type="submit" value="Make Transportation Booking"></td></tr>



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





</body>				
</html>
