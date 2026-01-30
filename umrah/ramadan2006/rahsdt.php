<html>
<head><title>Hotel Summary</title>
<script src="clienthint.js"></script> 
</head>
<body>
<center>
  <script type=text/javascript>
setTimeout('document.location=document.location',240000);
</script>
<script>
 var winl1 = (screen.width - 750) / 2; 
 var winl = (screen.width - 750) / 2; 
 var wint = (screen.height - 500) / 2;
</script>
  <?php
include("db.php");

// $stoday = '2006-08-30';
 $sfdate = '2006-09-23';
 $stdate = '2006-10-21';


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

?>
  <table border=1 cellpadding="1" cellspacing="1">
    <? 
   

   $cina = array($cin);
   $couta = array($cout);

   
$hotelid= $_GET["hot_id"];


$q_str = "select hotel_name, hotel_image from hotels where hotel_id=$hotelid";

$h_result = pg_query($conn, $q_str);

while ($h_row = pg_fetch_array($h_result))
{ 
$hot_name = $h_row["hotel_name"];
echo "<font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><b>" . $h_row["hotel_name"] . "</b></font>"; 
}


//$hotelid='11101';


$rooms=0;

$query  = "SELECT ocode,cin, cout, no_rooms, guest_occ_status, cus_paid from sales_hotels where cout between  date '$tod' - integer '30'  and '$tod' and cout > '$fromd' and ocode!='NC' and hotel_id='$hotelid' and booking_status!='Cancelled' or  cin  between '$fromd' and '$tod' and ocode!='NC' and hotel_id='$hotelid' and booking_status!='Cancelled' or   cin between date '$tod' - integer '30' and '$tod' and  cout > '$tod' and ocode!='NC' and hotel_id='$hotelid' and booking_status!='Cancelled' order by cin";

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
      <td><div align="center"><font color="#0000FF" size="2" face="Arial, Helvetica, sans-serif"><strong>Allotment</strong></font></div></td>
      <?
$p=0;
for ($ja=0; $ja < $df ; $ja++) {
$querya = "select sum(allotment) as allotments from rates$hotelid where rate_date between date '$fromd' + integer '$ja'  and date '$fromd' + integer '$ja'  and room_id like '$hotelid%' ";

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
      <td><div align="center"><font color="#FF0000" size="2" face="Arial, Helvetica, sans-serif"><strong>Available</strong></font></div></td>
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
	   if ($dTue == date('D', strtotime("+$i DAY", $fd1)) || $dWed == date('D', strtotime("+$i DAY", $fd1)) ||  $dThu == date('D', strtotime("+$i DAY", $fd1))){ if(20050924<=date('Ymd', strtotime("+$i DAY", $fd1)) && date('Ymd', strtotime("+$i DAY", $fd1))<=20051022){ $bgc = "#FFD3A8" ;} else { $bgc="#9CFE9E";}
		  
		   ?>
      <td bgcolor="<? echo $bgc ; ?>" > <div align="center"><font size="2" face="Arial, Helvetica, sans-serif"> <a href="raroomlist.php?hotid=<? echo $hotelid ?>&fdate=<? echo date('Y-m-d', strtotime("+$i DAY", $fd1)) ?>" target="pop" onClick="window.open('','pop', 'width=750,height=400,menubar=yes,scrollbars=yes, top='+wint+',left='+winl+' ')"  >
          <? echo date('D', strtotime("+$i DAY", $fd1));
	                  echo "<br>";
            		 echo date('d', strtotime("+$i DAY", $fd1)); 
					 echo "(" . ($i+1) . ")" ;
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
					  echo "(" . ($i+1) . ")" ;
          ?></a> </font></div></td>
      <?

      }

}
?>
    </tr>
  </table>
<br>
<div align="left"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><strong>Detailed Summary</strong></font></div>
<?
$rooms_arrary = array();
$room_sno=0;

$query_ds = "SELECT room_id,room_type from rooms where room_id like '$hotelid%' ";

$result_ds = pg_query($conn, $query_ds);

$rb=0;

echo "<table>";



while ($rows_ds = pg_fetch_array($result_ds))
{  

if($rb==4){
echo "<tr>";
$rb=0;
}

$chkb = "unchecked";




if($rows_ds["room_id"]==1110821 or $rows_ds["room_id"]==1110825 or $rows_ds["room_id"]==1110815 or $rows_ds["room_id"]==1110811 or $rows_ds["room_id"]==1110921 or $rows_ds["room_id"]==1110925 or $rows_ds["room_id"]==1110915 or $rows_ds["room_id"]==1110911){
$chkb = "checked";
}

$rooms_arrary[] = $rows_ds["room_id"];
$rrid = $rows_ds["room_id"];

echo "<td>&nbsp;&nbsp;<input type=\"checkbox\" id=\"roomsel$rrid\" name=\"roomsel\" $chkb > <font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";
echo $rows_ds["room_type"];
echo "</font></td>";

$rb++;
}

echo "</table>";
?>

<input type="hidden" id="roomsval" name="roomsval" >

<input type="button" name="get_det" id="get_det" value="Get Detailed Summary" onClick="s_h();" >
</form><p><span id="txtHint"></span></p> </body>

<script>
function s_h(){ 

var mycars = new Array();

//mycars[0] = "test";

<? for($j=0; $j<count($rooms_arrary); $j++){ ?>

   mycars[<? echo $j ;?>] = <? echo $rooms_arrary[$j] ;?>; 

<? } ?>


//   var v_t = document.getElementById("roomsel"+).checked;

document.getElementById("roomsval").value = "";
for (i=0;i<mycars.length;i++)
{

if(document.getElementById("roomsel"+mycars[i]).checked){

document.getElementById("roomsval").value += mycars[i] + ",";

}


//alert(mycars[i]);

}

//alert(v_t);
//   showHint(v_t,v_n);

var fv ="";
var sfv = document.getElementById("roomsval").value;

fv = sfv.substring(0, sfv.length-1);

 showHint(fv);


	}
</script>

<script> document.title = '<? echo $hot_name ;?>' + " - " +document.title  ; </script>
</center>
</body>
</html>