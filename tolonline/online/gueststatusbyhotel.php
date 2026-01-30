<script type=text/javascript>
setTimeout('document.location=document.location',240000);
</script>
<script>



</script>
  <?php
include("../db/db.php");

// $stoday = '2006-08-30';

$s_gs = $_GET["gs"];

$not_arr ="";
$no_show ="";
$in_house ="";

$s_space ="";

if($s_gs=="not_arrived"){
$not_arr = " and guest_occ_status='f'  and room_inhouseno IS NULL ";
}

if($s_gs=="no_show"){
$not_arr = "and room_inhouseno='No Show' ";
}

if($s_gs=="in_house"){
$not_arr = " and guest_occ_status='t'  and room_inhouseno IS NOT NULL ";
}

//$not_arr = " and guest_occ_status='f' and room_inhouseno IS NULL  "  ;
//room_inhouseno guest_occ_status



 $sfdate = "2006-09-25";
 $stdate = "2006-09-28";

 $sfdate = $_GET["f_d"];
 $stdate = $_GET["t_d"];

 $q_agentname = $_GET["u_a_c"];




$bpaid=0;
$pai=0;

$dTue="Tue";
$dWed="Wed";
$dThu="Thu";

$fromd = $sfdate;
$tod = $stdate;
$hotelid = 101;
$daytotr = 0;
$adaytotr = array();
$allot = array();


function diff_days($start_date, $end_date) 
{ 
   return floor(abs(strtotime($start_date) - strtotime($end_date))/86400); 
} 

 $df = diff_days($tod, $fromd)+1;


   

   $cina = array($cin);
   $couta = array($cout);

   
$hotelid= $_GET["vt"];



$q_str = "select hotel_name, hotel_image from hotels where hotel_id=$hotelid";

$h_result = pg_query($q_str);

while ($h_row = pg_fetch_array($h_result))
{ 
$hot_name = $h_row["hotel_name"];
echo "<font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><b>" . $h_row["hotel_name"] . " - Summary Between " . date('d-M-Y', strtotime($sfdate)) ." and ". date('d-M-Y', strtotime($stdate)) .
"</b></font>"; 
}


//$hotelid='11101';


$rooms=0;

?>
<table border="1" cellpadding="2" cellspacing="0" width="100%">
  <tr> 
      <td><div align="center"><font size="2" face="Arial, Helvetica, sans-serif">Sno</font></div></td>
      <td><div align="center"><font size="2" face="Arial, Helvetica, sans-serif">PNR</font></div></td>
      <td><div align="center"><font size="2" face="Arial, Helvetica, sans-serif">Guest 
          Name</font></div></td>
		   <td><div align="center"><font size="2" face="Arial, Helvetica, sans-serif">Travel 
          Agent,Country</font></div></td>

      <td><div align="center"><font size="2" face="Arial, Helvetica, sans-serif">Cin</font></div></td>
      <td><div align="center"><font size="2" face="Arial, Helvetica, sans-serif">Cout</font></div></td>
	        <td><div align="center"><font size="2" face="Arial, Helvetica, sans-serif">Nts</font></div></td>
			<td><div align="center"><font size="2" face="Arial, Helvetica, sans-serif">Room Type</font></div></td>
     
      <td><div align="center"><font size="2" face="Arial, Helvetica, sans-serif">B.Status</font></div></td>
      <td><div align="center"><font size="2" face="Arial, Helvetica, sans-serif">Agent.Voc</font></div></td>
	  <td><div align="center"><font size="2" face="Arial, Helvetica, sans-serif">HotelConf</font></div></td>
 	  <td><div align="center"><font size="2" face="Arial, Helvetica, sans-serif">HotelRoom</font></div></td>

 <? for($i = 0; $i < $df; $i++) 
{
        $fd1 = strtotime($fromd);
	   if ($dTue == date('D', strtotime("+$i DAY", $fd1)) || $dWed == date('D', strtotime("+$i DAY", $fd1)) ||  $dThu == date('D', strtotime("+$i DAY", $fd1))){ if(20050924<=date('Ymd', strtotime("+$i DAY", $fd1)) && date('Ymd', strtotime("+$i DAY", $fd1))<=20051022){ $bgc = "#FFD3A8" ;} else { $bgc="#9CFE9E";}
		  
		   ?>
      <td bgcolor="<? echo $bgc ; ?>" > <div align="center"><font size="2" face="Arial, Helvetica, sans-serif"> 
          <? echo date('D', strtotime("+$i DAY", $fd1));
	                  echo "<br>";
            		 echo date('d', strtotime("+$i DAY", $fd1)); 
					// echo "(" . ($i+1) . ")" ;
          ?></font></div></td>
      <?
	   }
      else {
		  if(20050924<=date('Ymd', strtotime("+$i DAY", $fd1)) && date('Ymd', strtotime("+$i DAY", $fd1))<=20050922){ $bgc = "#FFD3A8" ;} else { $bgc="#FFFFFF";}
     ?>
      <td bgcolor="<? echo $bgc ; ?>"> <div align="center"><font size="2" face="Arial, Helvetica, sans-serif"> 
          <? echo date('D', strtotime("+$i DAY", $fd1));
	                  echo "<br>";
            		 echo date('d', strtotime("+$i DAY", $fd1)); 
					//  echo "(" . ($i+1) . ")" ;
          ?> </font></div></td>
      <?

      }

}
?>


    <tr> 

<?

$query  = "SELECT ocode,cin, cout, room_id,no_rooms,no_nights,cus_paid,booking_status,room_inhouseno,hotel_confirmation_no,cus_voucher, guest_occ_status, cus_paid from sales_hotels where cus_account_code='$q_agentname' and  cout between  date '$tod' - integer '30'  and '$tod' and cout > '$fromd' and ocode!='NC' and hotel_id='$hotelid' and booking_status!='Cancelled' $not_arr or cus_account_code='$q_agentname' and  cin  between '$fromd' and '$tod' and ocode!='NC' and hotel_id='$hotelid' and booking_status!='Cancelled' $not_arr or cus_account_code='$q_agentname' and   cin between date '$tod' - integer '30' and '$tod' and  cout > '$tod' and ocode!='NC' and hotel_id='$hotelid' and booking_status!='Cancelled' $not_arr order by cin";

$result = pg_query($query);

$rowc = pg_num_rows($result);
//printf("Records selected: %d\n", mysql_affected_rows());

$ac=0;
$afd=array();
$atd=array();
$anofn=array();

$apaid=array();
?>
    <?
$b_sno=1;
while ($row = pg_fetch_array($result))
{ 



$s_ocode = $row["ocode"];

$s_room_id =  $row["room_id"];

$query_sub  = "SELECT ocode,guest_title, guest_name,option_date,cus_company_name,cus_country from sales_main where cus_account_code='$q_agentname' and  ocode='$s_ocode' ";

$result_sub = pg_query($query_sub);


while ($row_sub = pg_fetch_array($result_sub))
{
$s_guest_title = $row_sub["guest_title"];
$s_guest_name = $row_sub["guest_name"];
$s_option_date = $row_sub["option_date"];
$s_cus_company_name = $row_sub["cus_company_name"];
$s_cus_country = $row_sub["cus_country"];


}

$query_sub_room  = "SELECT room_type from rooms where room_id='$s_room_id' ";

$result_sub_room = pg_query($query_sub_room);


while ($row_sub_room = pg_fetch_array($result_sub_room))
{

$room_type =  $row_sub_room["room_type"];
}


?>
    <tr>
	
	<td align="center"><font size="2" face="Arial, Helvetica, sans-serif"><? echo $b_sno ?></font></td>
	<td ><font size="2" face="Arial, Helvetica, sans-serif"><a href="pnrdet.php?spnr=<?echo $row["ocode"];?>" target='<?echo $row["ocode"];?>' onClick="window.open('','<?echo $row["ocode"];?>', ' width='+(screen.width-10)+' , height='+(screen.height-50)+' , left=0,top=0 ').focus()"  ><?echo $row["ocode"];?></a></font></td>

<td><font size="2" face="Arial, Helvetica, sans-serif"><? echo 	$s_guest_title . ". " . strtoupper($s_guest_name); ?></font></td>
<td><font size="2" face="Arial, Helvetica, sans-serif"><? echo 	strtoupper($s_cus_company_name) . ", " . strtoupper($s_cus_country); ?></font></td>

<td align="center"><font size="2" face="Arial, Helvetica, sans-serif"><?echo date('d', strtotime($row["cin"])); ?><br><?echo date('M', strtotime($row["cin"])); ?></font></td>

<td align="center"><font size="2" face="Arial, Helvetica, sans-serif"><?echo date('d', strtotime($row["cout"])); ?><br><?echo date('M', strtotime($row["cout"])); ?></font></td>

<td align="center"><font size="2" face="Arial, Helvetica, sans-serif"><?echo $row["no_nights"]; ?> </font></td>

<td align="center"><font size="2" face="Arial, Helvetica, sans-serif"><?echo $room_type; ?> </font></td>
<td><font size="2" face="Arial, Helvetica, sans-serif"><? echo $row["booking_status"];  ?> </font></td>
<td><font size="2" face="Arial, Helvetica, sans-serif"><? if($row["cus_voucher"]=="") { echo "&nbsp;" ; } else { echo $row["cus_voucher"]; } ?> </font></td>
<td><font size="2" face="Arial, Helvetica, sans-serif"><? if($row["hotel_confirmation_no"]=="") { echo "&nbsp;" ; } else { echo $row["hotel_confirmation_no"]; }   ?> </font></td>
<td><font size="2" face="Arial, Helvetica, sans-serif"><?  if($row["room_inhouseno"]=="") { echo "&nbsp;" ; } else { echo $row["room_inhouseno"]; }   ?> </font></td>

    <?
$afd[$ac] = $row["cin"];
$atd[$ac] = $row["cout"];
$anofn[$ac] = $row["no_rooms"];

if ($bpaid < $row["cus_paid"]){
$apaid[$ac] = $row["no_rooms"];
}
else{
$apaid[$ac]=0;
}

$ac++;
//$i++;
$rooms=$rooms+$row["no_rooms"];

for ($j=0; $j < $df ; $j++) {
        $fd2 = strtotime($fromd); 
   $fdf = date('Y-m-d', strtotime("+$j DAY", $fd2)); 

if($fdf>=$row["cin"] and $fdf<=$row["cout"]){
echo "<td align=\"center\"><font size=\"2\" face=\"Arial, Helvetica, sans-serif\">";
echo $row["no_rooms"];
echo "</font></td>";
}
else {
echo "<td align=\"center\"><font size=\"2\" face=\"Arial, Helvetica, sans-serif\">";
echo "&nbsp;";
echo "</font></td>";
}


}


$b_sno++;
}



echo "<tr>";

?>


    <?//echo $rooms ?>
    <tr> 
      <td colspan="12"><div align="center"><font color="#F735F1" size="2" face="Arial, Helvetica, sans-serif"><strong>Paid</strong></font></div><div align="center"><font color="#004000" size="2" face="Arial, Helvetica, sans-serif"><strong>Sales</strong></font></div></td>
      <? $acc = count($afd); 

for ($j=0; $j < $df ; $j++) {
        $fd2 = strtotime($fromd); 
    $fdf = date('Y-m-d', strtotime("+$j DAY", $fd2)); 

for($k=0; $k < $acc ; $k++){

if($afd[$k]<= $fdf AND $fdf < $atd[$k])
	{
     $daytotr=$daytotr+$anofn[$k];
	 $pai =$pai+$apaid[$k];
	} 


}

?>
      <td><div align="center"><strong><font color="#F735F1" size="2" face="Arial, Helvetica, sans-serif"><? echo $pai ."<br>"; ?></font></strong></div><div align="center"> <strong><font color="#004000" size="2" face="Arial, Helvetica, sans-serif"><? echo $daytotr ;  $adaytotr[$j]=$daytotr;?></font></strong></div></td>
      <?
$daytotr=0;
$pai=0;

}

?>
    </tr>
   
    
    <tr> 
      <td colspan="12"><div align="center"><font size="2" face="Arial, Helvetica, sans-serif"><strong>Date</strong></font></div></td>
      <? for($i = 0; $i < $df; $i++) 
{
        $fd1 = strtotime($fromd);
	   if ($dTue == date('D', strtotime("+$i DAY", $fd1)) || $dWed == date('D', strtotime("+$i DAY", $fd1)) ||  $dThu == date('D', strtotime("+$i DAY", $fd1))){ if(20050924<=date('Ymd', strtotime("+$i DAY", $fd1)) && date('Ymd', strtotime("+$i DAY", $fd1))<=20051022){ $bgc = "#FFD3A8" ;} else { $bgc="#9CFE9E";}
		  
		   ?>
      <td bgcolor="<? echo $bgc ; ?>" > <div align="center"><font size="2" face="Arial, Helvetica, sans-serif"> 
          <? echo date('D', strtotime("+$i DAY", $fd1));
	                  echo "<br>";
            		 echo date('d', strtotime("+$i DAY", $fd1)); 
					// echo "(" . ($i+1) . ")" ;
          ?> </font></div></td>
      <?
	   }
      else {
		  if(20050924<=date('Ymd', strtotime("+$i DAY", $fd1)) && date('Ymd', strtotime("+$i DAY", $fd1))<=20050922){ $bgc = "#FFD3A8" ;} else { $bgc="#FFFFFF";}
     ?>
      <td bgcolor="<? echo $bgc ; ?>"> <div align="center"><font size="2" face="Arial, Helvetica, sans-serif"> 
          <? echo date('D', strtotime("+$i DAY", $fd1));
	                  echo "<br>";
            		 echo date('d', strtotime("+$i DAY", $fd1)); 
					//  echo "(" . ($i+1) . ")" ;
          ?> </font></div></td>
      <?

      }

}
?>
    </tr>
  </table>

<script> document.title = '<? echo $hot_name ;?>' + " - " +document.title  ; </script>
