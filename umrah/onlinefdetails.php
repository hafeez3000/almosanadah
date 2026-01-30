<?php
include("../db/db.php");

$s_vt=$_GET[vt];

$rooms_main = explode(",", $s_vt);




$roomid = 1110811;



for($ds=0; $ds<count($rooms_main); $ds++){  // main loop start

$rooms_main[$ds];

//$roomid = 1110811;

$roomid = $rooms_main[$ds];


$query_sub_room  = "SELECT room_type from rooms where room_id='$roomid' ";

$result_sub_room = pg_query($conn, $query_sub_room);


while ($row_sub_room = pg_fetch_array($result_sub_room))
{
$room_type =  $row_sub_room["room_type"];
}

echo "<font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><b>";
echo $room_type;
echo "</b></font>";

 //$sfdate = '2006-09-24';
// $stdate = '2006-10-22';

 

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


$df = floor(abs(strtotime($stdate) - strtotime($sfdate))/86400)+1;




?>
  <table border=1 cellpadding="1" cellspacing="1">
    <? 
   

   $cina = array($cin);
   $couta = array($cout);

$hoteid_s = $roomid;
$hoteid_s = substr($hoteid_s,0,5);   
$hotelid= $hoteid_s;



//$hotelid='11101';


$rooms=0;

$query  = "SELECT ocode,cin, cout, no_rooms, guest_occ_status, cus_paid from sales_hotels where cout between  date '$tod' - integer '30'  and '$tod' and cout > '$fromd' and ocode!='NC' and room_id='$roomid' and booking_status!='Cancelled' and is_online=1 or  cin  between '$fromd' and '$tod' and ocode!='NC' and room_id='$roomid' and booking_status!='Cancelled' and is_online=1 or   cin between date '$tod' - integer '30' and '$tod' and  cout > '$tod' and ocode!='NC' and room_id='$roomid' and booking_status!='Cancelled' and is_online=1 order by cin";

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
while ($row = pg_fetch_array($result))
{ 
?>
    <!--<tr><td><?echo $row["ocode"];?></td><td><?echo $row["cin"];?></td><td><?echo $row["cout"]; ?></td><td><?echo $row["noofrooms"]; ?></td></tr> -->
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
}

?>
    <?//echo $rooms ?>
    <tr> 
      <td><div align="center"><font color="#F735F1" size="2" face="Arial, Helvetica, sans-serif"><strong>Paid</strong></font></div><div align="center"><font color="#004000" size="2" face="Arial, Helvetica, sans-serif"><strong>Sales</strong></font></div></td>
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
      <td><div align="center"><font color="#0000FF" size="2" face="Arial, Helvetica, sans-serif"><strong>Availability</strong></font></div></td>
      <?
$p=0;
for ($ja=0; $ja < $df ; $ja++) {
$querya = "select sum(avialibility) as allotments from rates$hotelid where rate_date between date '$fromd' + integer '$ja'  and date '$fromd' + integer '$ja'  and room_id='$roomid' ";

$resulta = pg_query($conn, $querya);

$rowaa = pg_num_rows($resulta);


while ($rowa = pg_fetch_array($resulta))
{  

	?>
          <td> <div align="center"><strong><font color="#0000FF" size="2" face="Arial, Helvetica, sans-serif"><? if($rowa["allotments"]==""){ $alltd = 0;} else {$alltd = $rowa["allotments"];} echo $alltd; $allot[$p] = $alltd;?> 
         </font></strong></div></td>
      <?	
$p++;
	}

}
?>
    </tr>
    <tr> 
      <td><div align="center"><font color="#FF0000" size="2" face="Arial, Helvetica, sans-serif"><strong>Open Rooms</strong></font></div></td>
      <?
 $daytc = count($adaytotr);

for($m=0; $m < $daytc; $m++)
{ ?>
      <td><div align="center"><strong><font color="#FF0000" size="2" face="Arial, Helvetica, sans-serif"><? echo $allot[$m] - $adaytotr[$m] ;?> 
          </font></strong></div></td>
      <?
} 


?>
    </tr>
    <tr> 
      <td><div align="center"><font size="2" face="Arial, Helvetica, sans-serif"><strong>Date</strong></font></div></td>
      <? for($i = 0; $i < $df; $i++) 
{
        $fd1 = strtotime($fromd);
	   if ($dFri== date('D', strtotime("+$i DAY", $fd1)) || $dWed == date('D', strtotime("+$i DAY", $fd1)) ||  $dThu == date('D', strtotime("+$i DAY", $fd1))){ if(20050924<=date('Ymd', strtotime("+$i DAY", $fd1)) && date('Ymd', strtotime("+$i DAY", $fd1))<=20051022){ $bgc = "#FFD3A8" ;} else { $bgc="#9CFE9E";}
		  
		   ?>
      <td bgcolor="<? echo $bgc ; ?>" > <div align="center"><font size="2" face="Arial, Helvetica, sans-serif"> <a href="raroomlist.php?hotid=<? echo $hotelid ?>&fdate=<? echo date('Y-m-d', strtotime("+$i DAY", $fd1)) ?>" target="pop" onClick="window.open('','pop', 'width=750,height=400,menubar=yes,scrollbars=yes, top='+wint+',left='+winl+' ')"  >
          <? echo date('D', strtotime("+$i DAY", $fd1));
	                  echo "<br>";
            		 echo date('d', strtotime("+$i DAY", $fd1)); 
					// echo "(" . ($i+1) . ")" ;
          ?> </a></font></div></td>
      <?
	   }
      else {
		  if(20050924<=date('Ymd', strtotime("+$i DAY", $fd1)) && date('Ymd', strtotime("+$i DAY", $fd1))<=20050922){ $bgc = "#FFD3A8" ;} else { $bgc="#FFFFFF";}
     ?>
      <td bgcolor="<? echo $bgc ; ?>"> <div align="center"><font size="2" face="Arial, Helvetica, sans-serif">  <a href="raroomlist.php?hotid=<? echo $hotelid ?>&fdate=<? echo date('Y-m-d', strtotime("+$i DAY", $fd1)) ?>" target="pop" onClick="window.open('','pop', 'width=750,height=400,menubar=yes,scrollbars=yes, top='+wint+',left='+winl+' ')" >
          <? echo date('D', strtotime("+$i DAY", $fd1));
	                  echo "<br>";
            		 echo date('d', strtotime("+$i DAY", $fd1)); 
				//	  echo "(" . ($i+1) . ")" ;
          ?></a> </font></div></td>
      <?

      }

}

echo "</tr></table><br>";

}  // main loop end


?>
