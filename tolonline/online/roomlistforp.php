<html>
<head><title>Detailed Rooming List</title></head>
<body>
<center>
<script>
 var winl1 = (screen.width - 750) / 2; 
 var winl = (screen.width - 500) / 2; 
 var wint = (screen.height - 200) / 2;
</script>
<script src="roominglistbyh.js"></script> 



  <?php
include("../db/db.php");

$bpaid=0;
$nrc=1;
$rooms=0; 


 $bf="";
 $hb="";
 $fb="";
 $sa="";
 $ift="";
 $pmeals="";
 
 $hotelid = $_GET["hotid"];
 $fromd = $_GET["fdate"];
 $tod = $_GET["fdate"];
$cocode="";

$query  = "SELECT sales_hotels_sno,ocode,cin,room_id,  cout, no_rooms, guest_occ_status,cus_voucher,hotel_confirmation_no,room_inhouseno, cus_paid from sales_hotels where cout between  date '$tod' - integer '30'  and '$tod' and cout > '$fromd' and ocode!='NC' and hotel_id='$hotelid' and booking_status!='Cancelled' or  cin  between '$fromd' and '$tod' and ocode!='NC' and hotel_id='$hotelid' and booking_status!='Cancelled' or   cin between date '$tod' - integer '30' and '$tod' and  cout > '$tod' and ocode!='NC' and hotel_id='$hotelid' and booking_status!='Cancelled' order by cin";

$result = pg_query($query);

$rowc = pg_num_rows($result);
//printf("Records selected: %d\n", mysql_affected_rows());

$ac=0;
$afd=array();
$atd=array();
$anofn=array();

$apaid=array();
?>
  <table border=1 cellpadding="2" cellspacing="0" width="98%">
    <tr> 
      <td colspan="11"> <div align="center"> <font size="3" face="Arial, Helvetica, sans-serif"> 
          <?
  echo "Rooming List on " . date( 'd-M-Y' , strtotime($_GET["fdate"])); ?>
          </font></div></td>
    </tr>
    <tr> 
      <td><div align="center"><font size="2" face="Arial, Helvetica, sans-serif">Sno</font></div></td>
      <td><div align="center"><font size="2" face="Arial, Helvetica, sans-serif">PNR</font></div></td>
      <td><div align="center"><font size="2" face="Arial, Helvetica, sans-serif">Guest 
          Name</font></div></td>
      <td><div align="center"><font size="2" face="Arial, Helvetica, sans-serif">Cin</font></div></td>
      <td><div align="center"><font size="2" face="Arial, Helvetica, sans-serif">Cout</font></div></td>
	        <td><div align="center"><font size="2" face="Arial, Helvetica, sans-serif">Room Type</font></div></td>
      <td><div align="center"><font size="2" face="Arial, Helvetica, sans-serif">VocNo</font></div></td>
      <td><div align="center"><font size="2" face="Arial, Helvetica, sans-serif">HotelConf</font></div></td>
      <td><div align="center"><font size="2" face="Arial, Helvetica, sans-serif">RoomNumber</font></div></td>
      <td><div align="center"><font size="2" face="Arial, Helvetica, sans-serif">Meals</font></div></td>
      <td><div align="center"><font size="2" face="Arial, Helvetica, sans-serif">Rooms</font></div></td>

    <tr> 
      <?
while ($row = pg_fetch_array($result))
{ 

$s_hotels_sno =  $row["sales_hotels_sno"];

$q_meals_sel ="select sales_meals_sno,sales_hotels_sno,sales_hot_meals_sno,user_sno,rate_date,room_id,breakfast,halfboard,fullboard,sahoor,iftar,room_net_rate,room_sell_rate,no_of_paxs,no_of_rooms,day_net_rate,day_sell_rate from sales_meals where sales_hotels_sno=$s_hotels_sno order by sales_meals_sno";

$res_meals_sel = pg_query($q_meals_sel);

if (!$res_meals_sel) {
echo "An error occured.\n";
exit;
		}

while ($rows_meals_sel = pg_fetch_array($res_meals_sel)){

$s_breakfast = $rows_meals_sel["breakfast"];
$s_halfboard = $rows_meals_sel["halfboard"];
$s_fullboard = $rows_meals_sel["fullboard"];
$s_sahoor = $rows_meals_sel["sahoor"];
$s_iftar = $rows_meals_sel["iftar"];




$p_meals="";


if($s_breakfast=="N/A"){
}
else
{
//echo " X ";
//echo "B/F: $s_breakfast";
$p_meals = $p_meals . "B/F" ;
}

if($s_halfboard=="N/A") {
}
else
{
//echo " X ";
//echo "H/B: $s_halfboard";
$p_meals = $p_meals . "+H/B" ;
}

if($s_fullboard=="N/A") {
}
else
{
//echo " X ";
//echo "F/B: $s_fullboard";
$p_meals = $p_meals . "+F/B" ;
}

if($s_sahoor=="N/A") {
}
else
{
//echo " X ";
//echo "SAH: $s_sahoor";
$p_meals = $p_meals . "+SAH" ;
}

if($s_iftar=="N/A") {
}
else
{
//echo " X ";
//echo "IFT: $s_iftar";
$p_meals = $p_meals . "+IFT" ;
}

//echo $p_meals;
//echo "<br>";
}	

if($p_meals==""){ $p_meals="R/O" ;}



$s_ocode = $row["ocode"];

$s_room_id =  $row["room_id"];

$query_sub  = "SELECT ocode,guest_title, guest_name,option_date,cus_company_name,cus_country from sales_main where ocode='$s_ocode' ";

$result_sub = pg_query($query_sub);


while ($row_sub = pg_fetch_array($result_sub))
{



$query_sub_room  = "SELECT room_type from rooms where room_id='$s_room_id' ";

$result_sub_room = pg_query($query_sub_room);


while ($row_sub_room = pg_fetch_array($result_sub_room))
{

$room_type =  $row_sub_room["room_type"];
}

?>

    <tr> 
      <td><div align="center"><font size="2" face="Arial, Helvetica, sans-serif"><?echo $nrc;?></font></div></td>
      <td><font size="2" face="Arial, Helvetica, sans-serif"><?echo $row["ocode"]; $cocode=$row["ocode"];?></font></td>
    
	<td><font size="2" face="Arial, Helvetica, sans-serif"><?echo strtoupper($row_sub["guest_name"]); ?></font></td>



      <td><font size="2" face="Arial, Helvetica, sans-serif"><?echo date('d/m', strtotime($row["cin"])); ?></font></td>
      <td><font size="2" face="Arial, Helvetica, sans-serif"><?echo date('d/m', strtotime($row["cout"])); ?></font></td>

      <td><font size="2" face="Arial, Helvetica, sans-serif"><?echo $room_type; ?></font></td>

		<td><font size="2" face="Arial, Helvetica, sans-serif"><? if($row_sub["cus_voucher"]==""){ echo "&nbsp;" ;} else { echo $row_sub["cus_voucher"]; }?></font></td>

		<td><font size="2" face="Arial, Helvetica, sans-serif"><?  if($row_sub["hotel_confirmation_no"]==""){ echo "&nbsp;" ;} else { echo $row_sub["hotel_confirmation_no"]; } ?></font></td>

		<td><font size="2" face="Arial, Helvetica, sans-serif"><?		
		if($row_sub["room_inhouseno"]==""){ echo "&nbsp;" ;} else { echo $row_sub["room_inhouseno"]; }
		?></font></td>		
		
		 <td> <div align="center"><font size="2" face="Arial, Helvetica, sans-serif"> 
          <? if(substr($p_meals,0,1)=="+") { $p_meals=substr($p_meals,1,strlen($p_meals)-1) ; } echo $p_meals ; ?>
          </font></div></td>

		<td align="center"><font size="2" face="Arial, Helvetica, sans-serif"><?echo $row["no_rooms"]; ?></font></td>

    </tr>
    <?
$p_meals="";
}

$afd[$ac] = $row["cin"];
$atd[$ac] = $row["cout"];
$anofn[$ac] = $row["no_rooms"];

if ($bpaid < $row["cus_paid"]){
$apaid[$ac] = $row["no_rooms"];

}
$nrc++;
$ac++;
//$i++;
$rooms=$rooms+$row["no_rooms"];
}

?>
    <tr> 
      <td colspan="10"><div align="center"><font size="2" face="Arial, Helvetica, sans-serif">Total 
          Number of Rooms</font></div></td>
      <td> <div align="center"><strong><font color="#FF0000" size="2" face="Arial, Helvetica, sans-serif"><? echo $rooms ?></font></strong></div></td>
	  
    </tr>
  </table>
</center>
</body>
</html>