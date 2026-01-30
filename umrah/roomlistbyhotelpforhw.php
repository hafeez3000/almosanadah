<script type=text/javascript>
setTimeout('document.location=document.location',240000);
</script>
<script>



</script>
  <?php

include("printhead.php");
echo "<br>";
include("../db/db.php");

// $stoday = '2006-08-30';





 $sfdate = "2006-09-25";
 $stdate = "2006-09-28";

 $sfdate = $_GET["f_d"];
 $stdate = $_GET["t_d"];




$bpaid=0;
$pai=0;

$dTue="Tue";
$dWed="Wed";
$dThu="Thu";
$dFri="Fri";

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


   

  //  $cina = array($cin);
  //  $couta = array($cout);

   
$hotelid= $_GET["vt"];



$q_str = "select hotel_name, hotel_image from hotels where cast(hotel_id as text)='$hotelid'";

$h_result = pg_query($conn, $q_str);

while ($h_row = pg_fetch_array($h_result))
{ 
$hot_name = $h_row["hotel_name"];
echo "<div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><b>" . $h_row["hotel_name"] . " - Rooming List Between " . date('d-M-Y', strtotime($sfdate)) ." and ". date('d-M-Y', strtotime($stdate)) .
"</b></font></div>"; 

}


//$hotelid='11101';


$rooms=0;

?>
<table border="0" cellpadding="2" cellspacing="0" width="98%" style="border-top: 1px solid black;border-right: 1px solid black;border-left: 1px solid black;border-bottom: 1px solid black" align="center"><thead style="display:table-header-group;">
  <tr> 
      <td style="border-top: 1px solid black;border-right: 1px solid black;border-bottom: 1px solid black"><div align="center"><font size="2" face="Arial, Helvetica, sans-serif">Sno</font></div></td>
      <td style="border-top: 1px solid black;border-right: 1px solid black;border-bottom: 1px solid black"><div align="center"><font size="2" face="Arial, Helvetica, sans-serif">PNR</font></div></td>
      <td style="border-top: 1px solid black;border-right: 1px solid black;border-bottom: 1px solid black"><div align="center"><font size="2" face="Arial, Helvetica, sans-serif">Guest 
          Name</font></div></td>
		  

      <td style="border-top: 1px solid black;border-right: 1px solid black;border-bottom: 1px solid black"><div align="center"><font size="2" face="Arial, Helvetica, sans-serif">Cin</font></div></td>
      <td style="border-top: 1px solid black;border-right: 1px solid black;border-bottom: 1px solid black"><div align="center"><font size="2" face="Arial, Helvetica, sans-serif">Cout</font></div></td>
	        <td style="border-top: 1px solid black;border-right: 1px solid black;border-bottom: 1px solid black"><div align="center"><font size="2" face="Arial, Helvetica, sans-serif">Nts</font></div></td>
			<td style="border-top: 1px solid black;border-right: 1px solid black;border-bottom: 1px solid black"><div align="center"><font size="2" face="Arial, Helvetica, sans-serif">Room Type</font></div></td>
     
      <td style="border-top: 1px solid black;border-right: 1px solid black;border-bottom: 1px solid black"><div align="center"><font size="2" face="Arial, Helvetica, sans-serif">Meals</font></div></td>
	   <td style="border-top: 1px solid black;border-right: 1px solid black;border-bottom: 1px solid black"><div align="center"><font size="2" face="Arial, Helvetica, sans-serif">Room No</font></div></td>

 <? for($i = 0; $i < $df; $i++) 
{
        $fd1 = strtotime($fromd);
	   if ($dFri == date('D', strtotime("+$i DAY", $fd1)) || $dWed == date('D', strtotime("+$i DAY", $fd1)) ||  $dThu == date('D', strtotime("+$i DAY", $fd1))){ if(20050924<=date('Ymd', strtotime("+$i DAY", $fd1)) && date('Ymd', strtotime("+$i DAY", $fd1))<=20051022){ $bgc = "#FFD3A8" ;} else { $bgc="#9CFE9E";}
		  
		   ?>
      <td bgcolor="<? echo $bgc ; ?>" style="border-top: 1px solid black;border-right: 1px solid black;border-bottom: 1px solid black"> <div align="center"><font size="2" face="Arial, Helvetica, sans-serif"> 
          <? echo  " <b>No.of Rooms</b> on <br>" .date('D', strtotime("+$i DAY", $fd1));
	                  echo "<br>";
            		 echo date('d', strtotime("+$i DAY", $fd1)); 
					// echo "(" . ($i+1) . ")" ;
          ?> </font></div></td>
      <?
	   }
      else {
		  if(20050924<=date('Ymd', strtotime("+$i DAY", $fd1)) && date('Ymd', strtotime("+$i DAY", $fd1))<=20050922){ $bgc = "#FFD3A8" ;} else { $bgc="#FFFFFF";}
     ?>
      <td bgcolor="<? echo $bgc ; ?>" style="border-top: 1px solid black;border-right: 1px solid black;border-bottom: 1px solid black"> <div align="center"><font size="2" face="Arial, Helvetica, sans-serif">  
          <? echo "<b>No.of Rooms</b> on <br>" .date('D', strtotime("+$i DAY", $fd1));
	                  echo "<br>";
            		 echo date('d', strtotime("+$i DAY", $fd1)); 
					//  echo "(" . ($i+1) . ")" ;
          ?> </font></div></td>
      <?

      }

}
?>


    <tr> </thead>

<?

$query  = "SELECT sales_hotels_sno,ocode,cin, cout, room_id,no_rooms,no_nights,cus_paid, guest_occ_status, room_inhouseno,cus_paid from sales_hotels where cout between  date '$tod' - integer '30'  and '$tod' and cout > '$fromd' and ocode!='NC' and hotel_id='$hotelid' and booking_status!='Cancelled' or  cin  between '$fromd' and '$tod' and ocode!='NC' and hotel_id='$hotelid' and booking_status!='Cancelled' or   cin between date '$tod' - integer '30' and '$tod' and  cout > '$tod' and ocode!='NC' and hotel_id='$hotelid' and booking_status!='Cancelled' order by cin";

$result = pg_query($conn, $query);

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


$s_hotels_sno =  $row["sales_hotels_sno"];

$q_meals_sel ="select sales_meals_sno,sales_hotels_sno,sales_hot_meals_sno,user_sno,rate_date,room_id,breakfast,halfboard,fullboard,sahoor,iftar,room_net_rate,room_sell_rate,no_of_paxs,no_of_rooms,day_net_rate,day_sell_rate from sales_meals where sales_hotels_sno=$s_hotels_sno order by sales_meals_sno";

$res_meals_sel = pg_query($conn, $q_meals_sel);

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

$result_sub = pg_query($conn, $query_sub);


while ($row_sub = pg_fetch_array($result_sub))
{
$s_guest_title = $row_sub["guest_title"];
$s_guest_name = $row_sub["guest_name"];
$s_option_date = $row_sub["option_date"];
$s_cus_company_name = $row_sub["cus_company_name"];
$s_cus_country = $row_sub["cus_country"];


}

$query_sub_room  = "SELECT room_type from rooms where room_id='$s_room_id' ";

$result_sub_room = pg_query($conn, $query_sub_room);


while ($row_sub_room = pg_fetch_array($result_sub_room))
{

$room_type =  $row_sub_room["room_type"];
}


?>
    <tr>
	
	<td style="border-top: 1px solid black;border-right: 1px solid black" align="center"><font size="2" face="Arial, Helvetica, sans-serif"><? echo $b_sno ?></font></td>
	<td style="border-top: 1px solid black;border-right: 1px solid black"><font size="2" face="Arial, Helvetica, sans-serif"><?echo $row["ocode"];?></font></td>

<td style="border-top: 1px solid black;border-right: 1px solid black"><font size="2" face="Arial, Helvetica, sans-serif"><? echo 	$s_guest_title . ". " . strtoupper($s_guest_name); ?></font></td>


<td style="border-top: 1px solid black;border-right: 1px solid black" align="center"><font size="2" face="Arial, Helvetica, sans-serif"><?echo date('d', strtotime($row["cin"])); ?> <?echo date('M', strtotime($row["cin"])); ?></font></td>

<td style="border-top: 1px solid black;border-right: 1px solid black" align="center"><font size="2" face="Arial, Helvetica, sans-serif"><?echo date('d', strtotime($row["cout"])); ?>  <?echo date('M', strtotime($row["cout"])); ?></font></td>

<td style="border-top: 1px solid black;border-right: 1px solid black" align="center"><font size="2" face="Arial, Helvetica, sans-serif"><?echo $row["no_nights"]; ?> </font></td>

<td style="border-top: 1px solid black;border-right: 1px solid black" align="center"><font size="2" face="Arial, Helvetica, sans-serif"><?echo $room_type; ?> </font></td>

<td style="border-top: 1px solid black;border-right: 1px solid black" align="center"><font size="2" face="Arial, Helvetica, sans-serif"><? if(substr($p_meals,0,1)=="+") { $p_meals=substr($p_meals,1,strlen($p_meals)-1) ; } echo $p_meals ; ?> </font></td>

<td style="border-top: 1px solid black;border-right: 1px solid black" align="center"><font size="2" face="Arial, Helvetica, sans-serif"><?		
		if($row["room_inhouseno"]==""){ echo "&nbsp;" ;} else { echo $row["room_inhouseno"]; }
		?></font></td>


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

if($fdf>=$row["cin"] and $fdf<$row["cout"]){
echo "<td align=\"center\" style=\"border-top: 1px solid black;border-right: 1px solid black\"><font size=\"2\" face=\"Arial, Helvetica, sans-serif\">";
echo $row["no_rooms"];
echo "</font></td>";
}
else {
echo "<td align=\"center\" style=\"border-top: 1px solid black;border-right: 1px solid black\"><font size=\"2\" face=\"Arial, Helvetica, sans-serif\">";
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
      <td colspan="9" style="border-top: 1px solid black;border-right: 1px solid black"><div align="center"><font color="#004000" size="2" face="Arial, Helvetica, sans-serif"><strong>Total Rooms</strong></font></div></td>
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
      <td style="border-top: 1px solid black;border-right: 1px solid black"><div align="center" > <strong><font color="#004000" size="2" face="Arial, Helvetica, sans-serif"><? echo $daytotr  ;  $adaytotr[$j]=$daytotr;?></font></strong></div></td>
      <?
$daytotr=0;
$pai=0;

}

?>
    </tr>
    <tr> 
      <td colspan="9" style="border-top: 1px solid black;border-right: 1px solid black"><div align="center"><font color="#0000FF" size="2" face="Arial, Helvetica, sans-serif"><strong>Allotment</strong></font></div></td>
      <?
$p=0;
for ($ja=0; $ja < $df ; $ja++) {
$querya = "select sum(allotment) as allotments from rates$hotelid where rate_date between date '$fromd' + integer '$ja'  and date '$fromd' + integer '$ja'  and room_id like '$hotelid%' ";

$resulta = pg_query($conn, $querya);

$rowaa = pg_num_rows($resulta);


while ($rowa = pg_fetch_array($resulta))
{  

	?>
      <td style="border-top: 1px solid black;border-right: 1px solid black" > <div align="center" ><strong><font color="#0000FF" size="2" face="Arial, Helvetica, sans-serif"><? if($rowa["allotments"]==""){ $alltd = 0;} else {$alltd = $rowa["allotments"];} echo $alltd; $allot[$p] = $alltd;?> 
         </font></strong></div></td>
      <?	
$p++;
	}

}
?>
    </tr>
   
    <tr> 
      <td colspan="9" style="border-top: 1px solid black;border-right: 1px solid black"><div align="center"><font size="2" face="Arial, Helvetica, sans-serif"><strong>Date</strong></font></div></td>
      <? for($i = 0; $i < $df; $i++) 
{
        $fd1 = strtotime($fromd);
	   if ($dFri == date('D', strtotime("+$i DAY", $fd1)) || $dWed == date('D', strtotime("+$i DAY", $fd1)) ||  $dThu == date('D', strtotime("+$i DAY", $fd1))){ if(20050924<=date('Ymd', strtotime("+$i DAY", $fd1)) && date('Ymd', strtotime("+$i DAY", $fd1))<=20051022){ $bgc = "#FFD3A8" ;} else { $bgc="#9CFE9E";}
		  
		   ?>
      <td bgcolor="<? echo $bgc ; ?>" style="border-top: 1px solid black;border-right: 1px solid black"> <div align="center"><font size="2" face="Arial, Helvetica, sans-serif"> 
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
      <td bgcolor="<? echo $bgc ; ?>" style="border-top: 1px solid black;border-right: 1px solid black"> <div align="center"><font size="2" face="Arial, Helvetica, sans-serif"> 
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
	 <tfoot style="display:table-footer-group;">
	 
	 <tr><td colspan=<? echo $df+9 ; ?> style="border-top: 1px solid #999999" align="right"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">End of the Page</font></td></tr>
	 <tr><td colspan=<? echo $df+9 ; ?> style="border-top: 1px solid black" align="left"><font size="1" face="Verdana, Arial, Helvetica, sans-serif"><?echo "Print Date: " . date("r")." (GMT)"; ?></font></td></tr>
	 </tfoot>
  </table>

  <font size="2" face="Verdana, Arial, Helvetica, sans-serif">   </font>
	

<script> document.title = '<? echo $hot_name ;?>' + " - " +document.title  ; </script>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">