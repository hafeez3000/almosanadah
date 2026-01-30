<?
session_start();

// is the one accessing this page logged in or not?
if (!isset($_SESSION['db_is_logged_in_online']) 
   || $_SESSION['db_is_logged_in_online'] !== true) {

   // not logged in, move to login page
   header('Location: login.php');
   exit;
}
$suserid = $_SESSION["userid"];
$suser_sno = $_SESSION["user_sno"];
$dept = $_SESSION["deptsr"];
$ol_c_n = $_SESSION["ol_company_name"];
$ol_country = $_SESSION['ol_country'];
$ol_email = $_SESSION['ol_email'];
?>
<html>
<center>
<body leftmargin="0" topmargin="0" rightmargin="0">
<table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0" style="border-top: 5px solid #006600 ;border-bottom: 5px solid #006600 ;border-left: 5px solid #006600;border-right: 5px solid #006600"><tr><td valign="top">
<?
include("../db/db.php"); 
$roomid = $_GET['roomid'];

$madcin = $_GET['madcin'];
$madcout = $_GET['madcout'];
$hotel = $_GET['hotel'];

$nofr = $_GET['nofr'];
$nofp = $_GET['nofp'];

$madcins = date('D, d-M-Y', strtotime($madcin));
$madcouts = date('D, d-M-Y', strtotime($madcout));

//Fetching city name from hotel
$haystack = $hotel;
$needle   = '-';
$pos      = strripos($haystack, $needle);
$city = substr($hotel, $pos+2);
//End - Fetching city name from hotel

//$mad_array_sel_meals[] = $_GET["madmeals$mad_arr_room_id[$i]"];
$madmeals =   $_GET["madmeals"];


 if(trim($madmeals)=="" or trim($madmeals)=="meals"){$madmeals_f = "No Meals";} else {$madmeals_f = ucwords($madmeals); }


$query_room ="select room_id, room_type from rooms where room_id=$roomid";

$result_room = pg_query($query_room);

if (!$result_room) {
	echo "An error occured.\n";
	exit;
	}
while ($rows_room = pg_fetch_array($result_room)){

$room_id = $rows_room["room_id"];
$room_type = $rows_room["room_type"];

}
pg_free_result($result_room);





?>
<?

$e_body = <<<ENDH





                                
								    
								   <tr >
                            <td colspan="2" align="center"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Hotel Request</b></font></td>
                          </tr>
	
							 

								  <tr> 
                                    <td width="17%" style="border-right: 1px solid #999999" ><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Check 
                                      In</font></td>
                                    <td ><font size="2" face="Verdana, Arial, Helvetica, sans-serif"> $madcins </font></td>
                                  </tr>
                                  <tr> 
                                    <td style="border-right: 1px solid #999999"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Check 
                                      Out</font></td><td><font size="2" face="Verdana, Arial, Helvetica, sans-serif"> $madcouts </font></td>
                                  </tr>
                                  <tr> 
                                    <td style="border-right: 1px solid #999999" ><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Hotel 
                                      Name</font></td><td><font size="2" face="Verdana, Arial, Helvetica, sans-serif">  $hotel 
									  
									  </font></td>
                                  </tr>
								  <tr> 
                                    <td style="border-right: 1px solid #999999" ><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Room Type 
                                      </font></td><td><font size="2" face="Verdana, Arial, Helvetica, sans-serif">  $room_type 
									  
									  </font></td>
                                  </tr>
                                  <tr> 
                                    <td style="border-right: 1px solid #999999" ><font size="2" face="Verdana, Arial, Helvetica, sans-serif">No of Rooms</font></td><td><font size="2" face="Verdana, Arial, Helvetica, sans-serif">  $nofr 
									  
									  </font></td>
                                  </tr>
								   <tr> 
                                    <td style="border-right: 1px solid #999999" ><font size="2" face="Verdana, Arial, Helvetica, sans-serif">No of Paxs</font></td><td><font size="2" face="Verdana, Arial, Helvetica, sans-serif">   $nofp 
									  
									  </font></td>
                                  </tr>
<tr> 
                                    <td style="border-right: 1px solid #999999" ><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Meals</font></td><td><font size="2" face="Verdana, Arial, Helvetica, sans-serif"> $madmeals_f
									  
									  </font></td>
                                  </tr>

</table>

ENDH;




?>




 <table width="98%" cellpadding="3" cellspacing="3" align="center">
                                
								      <tr>
                            <td colspan="2" align="center"><img src="../images/logo.jpg"></td>
                          </tr>
								   <tr bgcolor="#CCCCCC">
                            <td colspan="2" align="center"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Confirm Hotel Room Details and Guest Name before sending Email Request</b></font></td>
                          </tr>
	
							 

								  <tr> 
                                    <td width="17%" style="border-right: 1px solid #999999" bgcolor="#CCCCCC"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Check 
                                      In</font></td>
                                    <td ><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><? echo $madcins ?></font></td>
                                  </tr>
                                  <tr> 
                                    <td style="border-right: 1px solid #999999" bgcolor="#CCCCCC"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Check 
                                      Out</font></td><td><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><? echo $madcouts ?></font></td>
                                  </tr>
                                  <tr> 
                                    <td style="border-right: 1px solid #999999" bgcolor="#CCCCCC"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Hotel 
                                      Name</font></td><td><font size="2" face="Verdana, Arial, Helvetica, sans-serif"> <? echo $hotel ?>
									  
									  </font></td>
                                  </tr>
								  <tr> 
                                    <td style="border-right: 1px solid #999999" bgcolor="#CCCCCC"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Room Type 
                                      </font></td><td><font size="2" face="Verdana, Arial, Helvetica, sans-serif"> <? echo $room_type ?>
									  
									  </font></td>
                                  </tr>
                                  <tr> 
                                    <td style="border-right: 1px solid #999999" bgcolor="#CCCCCC"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">No of Rooms</font></td><td><font size="2" face="Verdana, Arial, Helvetica, sans-serif"> <? echo $nofr ?>
									  
									  </font></td>
                                  </tr>
								   <tr> 
                                    <td style="border-right: 1px solid #999999" bgcolor="#CCCCCC"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">No of Paxs</font></td><td><font size="2" face="Verdana, Arial, Helvetica, sans-serif"> <? echo $nofp ?>
									  
									  </font></td>
                                  </tr>
<tr> 
                                    <td style="border-right: 1px solid #999999" bgcolor="#CCCCCC"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Meals</font></td><td><font size="2" face="Verdana, Arial, Helvetica, sans-serif"> <? if(trim($madmeals)=="" or trim($madmeals)=="meals"){echo "No Meals";} else {echo ucwords($madmeals); }?>
									  
									  </font></td>
                                  </tr>
								  <form name="selhotel" method="post" action="sendrreqa.php" onSubmit="return valf(this)">
<tr> 
                                    <td style="border-right: 1px solid #999999" bgcolor="#CCCCCC"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Enter Guest Name</font></td><td><font size="2" face="Verdana, Arial, Helvetica, sans-serif"> <select id="gtitle" name="gtitle">
                                        <option value="Mr">Mr</option>
										<option value="Mrns">Mr & Mrs</option>
                                        <option value="Ms">Ms</option>
                                        <option value="Mrs">Mrs</option>
                                        <option value="Miss">Miss</option>
                                        <option value="Dr">Dr</option>
                                        <option value="Prof">Prof</option>
                                      </select> 
									   <input type="text" name="guestname" id="guestname" value="" size="65">
									  <input type="hidden" name="e_body" id="e_body" value='<?  echo $e_body ; ?>' >
									  <input type="hidden" name="ol_c_n" id="ol_c_n" value='<?  echo $ol_c_n ; ?>' >
									  <input type="hidden" name="ol_country" id="ol_country" value='<?  echo $ol_country ; ?>' >
									  <input type="hidden" name="ol_email" id="ol_email" value='<?  echo $ol_email ; ?>' >
									  <input type="hidden" name="cin" id="cin" value='<?  echo $madcin; ?>' >
									  <input type="hidden" name="cout" id="cout" value='<?  echo $madcout; ?>' >
									  <input type="hidden" name="hotel_name" id="hotel_name" value='<?  echo $hotel; ?>' >
									  <input type="hidden" name="city" id="city" value='<?  echo $city; ?>' >
									  <input type="hidden" name="room_type" id="room_type" value='<?  echo $room_type; ?>' >
									  <input type="hidden" name="no_of_rooms" id="no_of_rooms" value='<?  echo $nofr; ?>' >
									  <input type="hidden" name="no_of_paxs" id="no_of_paxs" value='<?  echo $nofp; ?>' >
									  <? if(trim($madmeals)=="" or trim($madmeals)=="meals"){ $meals = "No Meals"; } else { $meals = ucwords($madmeals); }
									  $meals = trim($meals);
									  ?>
									  <input type="hidden" name="meals" id="meals" value='<?  echo $meals; ?>' >
									  
									  </font></td>
                                  </tr>
<tr>
                            <td colspan="2" align="center"><input  type="submit" name="submit" id="submit" value="Send Request"></td>






                          </tr>

</form >

<tr bgcolor="#CCCCCC">
                            <td colspan="2"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>&nbsp;</b></font></td>
                          </tr>

                                </table>	




</td></tr></table>

<script>
function valf(theForm){



if ( (document.selhotel.guestname.value == null) ||  ((document.selhotel.guestname.value).length==0) ||  ((document.selhotel.guestname.value).length<4) )
   {
	alert("Habibi, Enter the Guest Name.");
		document.selhotel.guestname.focus();
		return false;
	}



}

</script>

</body>
</center>
</html>

