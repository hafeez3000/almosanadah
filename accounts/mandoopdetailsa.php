<?
include ("header.php");

$vy=$vm=$vd=0;
$vy1=$vm1=$vd1=0;
?>

<script src="../javascripts/cBoxes.js"></script>
<table width="100%" border="0" cellpadding="0" cellspacing="0" style="border-bottom: 3px solid #006600; border-right: 3px solid #006600;border-left: 3px solid #006600 ">

  <tr>
    <td width="20%" style="border-right: 1px solid #999999"  valign="top"> <table width="100%" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td valign="top"><div align="left">
              <?include ("umenu.php"); ?>
            </div></td>
        </tr>
      </table></td>
    <td width="80%" valign="top"  > <table width="100%" border="0" cellpadding="0" cellspacing="1">
        <tr>
          <td valign="top">

<table cellpadding="0" cellspacing="0" width="100%" style="border-top: 1px solid #999999; border-bottom: 1px solid #999999"><tr>
                      <td bgcolor="#CCCCCC"><strong> <font size="2" face="Verdana, Arial, Helvetica, sans-serif">Supplier Details</font></td>
                    </tr></table>

<form name="selhotel" method="post" action="mandoopdetailsamend.php" >

<?


$hotel_id = trim($_POST['hotelv']);

if($hotel_id==""){  $hotel_id = trim($_GET['hotid']); }

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$_SESSION['hotel_id'] = $hotel_id;

?>






<?
$qb_str = "Representative Id,  Representative Name,  Representative Branch, Representative Mobile, Status";

$q_str = "id,  mandoop_name,  mandoop_branch, mandoop_mobile, mandoop_status";

$a_q_str = explode(",", $q_str);

$a_qb_str = explode(",", $qb_str);



$query_hotel ="select " . $q_str ." from mandoop where id=$hotel_id";

$result_hotel = pg_query($conn, $query_hotel);

if (!$result_hotel) {
  echo "An error occured.\n";
  exit;
}

echo "<table border=\"1\">";
while ($rows_hotel = pg_fetch_array($result_hotel)){

  // echo $hotel_name_dis = $rows_hotel["hotel_name"];

  for($i=0; $i<count($a_q_str)-1; $i++){

    if($i==0){
      echo "<tr><td><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";
      echo trim($a_qb_str[$i]);
      $fie = trim($a_q_str[$i]);
      echo "</font></td>";

      echo "<td><input type=\"text\" id=\"$fie\" name=\"$fie\" value=\"$hotel_id\" size=\"70\" readonly /></td>";
      echo "</tr>";
    }else{

      echo "<tr><td><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";
      echo trim($a_qb_str[$i]);
      $fie = trim($a_q_str[$i]);
      echo "</font></td>";
      $fval = trim($rows_hotel[$fie]);
      echo "<td><input type=\"text\" id=\"$fie\" name=\"$fie\" value=\"$fval\" size=\"70\" /></td>";

      echo "</tr>";
    }


  }
  if($rows_hotel['mandoop_status'] == 't'){
    $s_status = "checked";
  }
  else{
    $s_status = "";
  }

?>

  <tr><TD><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Status</font></TD><TD><input type="checkbox" id="status" name="status" value="Yes" <?php echo $s_status ?> ></TD></td></tr>

<?

}

echo "</table>";
pg_free_result($result_hotel);



?>

 <input type="submit" name="submit" id="submit" value="Amend Supplier Details">
  </form>




<script>

var tdddate = new Date();

var dvy = <?php echo $vy; ?>; if (dvy==0) dvy=tdddate.getYear()
  var dvm = <?php echo $vm; ?>; if (dvm==0) dvm=tdddate.getMonth()
  var dnd = <?php echo $vd; ?>; if (dnd==0) dnd=tdddate.getDate()

  if (dvy < 2000) dvy += 1900;


var now_date = new Date(dvy,dvm,dnd);
now_date.setDate(now_date.getDate())

  var now_day = now_date.getDate();
var now_month = now_date.getMonth();
var now_year = now_date.getYear();



var dvy1 = <?php echo $vy1; ?>; if (dvy1==0) dvy1=tdddate.getYear()
  var dvm1 = <?php echo $vm1; ?>; if (dvm1==0) dvm1=tdddate.getMonth()
  var dnd1 = <?php echo $vd1; ?>; if (dnd1==0) dnd1=tdddate.getDate()

  if (dvy1 < 2000) dvy1 += 1900;


var now_date1 = new Date(dvy1,dvm1,dnd1);
now_date1.setDate(now_date1.getDate())

  var now_day1 = now_date1.getDate();
var now_month1 = now_date1.getMonth();
var now_year1 = now_date1.getYear();

var d1 = new dateObj(document.selhotel.dDay, document.selhotel.dMonth, document.selhotel.dYear);
initDates(dvy-1, dvy+1, dvy, now_month, now_day, d1);

var d2 = new dateObj(document.selhotel.d1Day, document.selhotel.d1Month, document.selhotel.d1Year);
initDates(dvy1-1, dvy1+1, dvy1, now_month1, now_day1, d2);

</script>




     </td></tr></table>

</td></tr></table>

</td></tr></table>

</td></tr></table>




