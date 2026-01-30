<?php

include "printheadprintconf.php";
include "../conf/mainconf.php";
include "../db/db.php";
require_once "yahoocc.php";
?>




<html>
<head><title>Sohulat Al Safar Umrah Services - Report</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">





<script>
const from_day =  window.opener.document.getElementsByName('dDay')[0];
const from_month =  window.opener.document.getElementsByName('dMonth')[0];
const from_year =  window.opener.document.getElementsByName('dYear')[0];

const to_day =  window.opener.document.getElementsByName('dDay1')[0];
const to_month =  window.opener.document.getElementsByName('dMonth1')[0];
const to_year =  window.opener.document.getElementsByName('dYear1')[0];


const v_gueststatus = window.opener.document.getElementById('gueststatus');
const v_hotelname = window.opener.document.getElementById('hotelname');

var cinb = "No";
if(window.opener.document.getElementById('cbc').checked == true){
cinb="Yes";
}else{
cinb="No";
}




</script>

</head>





<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<center>

<table width="97%" border="0" cellspacing="0" cellpadding="0" ><tr><td>



<?php
$s_online = "";
$s_pnr = isset($_GET["spnr"]) ? $_GET["spnr"] : "";

//$s_pnr = "ODZ2DU";

$s_date = [];
$s_rate = [];
$s_rate_u = [];
$s_final = [];

$print_con_zam_zam = 0;

$q_main_sel = "select main_sno,ocode,is_online,user_sno,user_id,guest_title,guest_name,guest_nationality,guest_telno,guest_notes,order_date,option_date,booking_status,cus_account_code,cus_title,cus_name,cus_company_name,cus_country,cus_contact,cus_email,agent_notes,sales_hotels,sales_trans,sales_visa,sales_others from sales_main where ocode='$s_pnr'";

$main_sel = pg_query($conn, $q_main_sel);

$rows_main = pg_num_rows($main_sel);

if (!$main_sel) {
    echo "An error occured.\n";
    exit();
}

while ($rows_main = pg_fetch_array($main_sel)) {
    $s_user_id = $rows_main["user_id"];
    $s_guest_title = $rows_main["guest_title"];
    $s_guest_name = $rows_main["guest_name"];
    $s_guest_telno = $rows_main["guest_telno"];
    $s_gnationality = $rows_main["guest_nationality"];
    $s_guest_notes = $rows_main["guest_notes"];
    $s_order_date = $rows_main["order_date"];
    $s_option_date = $rows_main["option_date"];
    $s_cus_account_code = $rows_main["cus_account_code"];
    $s_cus_title = $rows_main["cus_title"];
    $s_cus_name = $rows_main["cus_name"];
    $s_cus_company_name = $rows_main["cus_company_name"];
    $s_cus_country = $rows_main["cus_country"];
    $s_cus_fax = $rows_main["cus_contact"];
    $s_cus_email = $rows_main["cus_email"];
    $s_agent_notes = $rows_main["agent_notes"];
    $s_sales_hotels = $rows_main["sales_hotels"];
    $s_sales_trans = $rows_main["sales_trans"];
    $s_sales_visa = $rows_main["sales_visa"];
    $s_sales_others = $rows_main["sales_others"];
    if ($rows_main["is_online"]) {
        $s_online = "ONLINE";
    }
    $s_main_sno = $rows_main["main_sno"];
    $s_main_booking_status = $rows_main["booking_status"];
}

$currency_s = "SAR";

$ac_det =
    "A/C: Sohulat Al Safar Umrah Services, SASABB221547706001, SAB (Saudi Awwal Bank), Riyadh, Saudi Arabia, K.S.A";

// if($s_cus_country=="UAE"){
// $currency_s = "AED" ;

// $ac_det = "A/C: Mr. JAMAL ABDULLAH M MUKHTAR, 021-12294004-01, Emirates Bank, WTC Branch, Dubai, U.A.E";

// }
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0" >
<tr><td><img src="../images/space.jpg"></td></tr>
<tr>
<td  align="center" ><font face="Arial, Helvetica, sans-serif"><strong>Transportation Report</strong></font></td>

    </tr></table>





<?
echo "<table width=\"95%\" align=\"center\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" >";

echo "<tr><td align=\"left\" ><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";

echo "From Date:  ";

$from_date = "<script> document.write(from_year.value +'-'+ from_month.value +'-'+ from_day.value); </script>";
echo   "<script> document.write(from_day.value +'-'+ from_month.value +'-'+ from_year.value); </script>";

echo "</font></td>";

echo "<td align=\"right\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";



echo "Booking Status: " . "<script> document.write(v_gueststatus.options[v_gueststatus.selectedIndex].text); </script>";

echo "</font></td></tr>";


echo "<tr><td align=\"left\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";

echo "To Date:  ";
$to_date = "<script> document.write(to_year.value +'-'+ to_month.value +'-'+ to_day.value); </script>";
echo  "<script> document.write(to_day.value +'-'+ to_month.value +'-'+ to_year.value); </script>";


echo "</font></td>";

echo "<td align=\"right\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";

$for_hotels = "<script>document.write(v_hotelname.value)</script>";





echo "For Agents(s): " . "<script> document.write(v_hotelname.options[v_hotelname.selectedIndex].text); </script>";



echo "</font></td></tr>";



echo "<tr><td align=\"left\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";


echo "By Check-In Date:  ";

echo $checking_flag = "<script>document.write(cinb)</script>";

echo "</font></td>";

echo "<td align=\"right\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";


echo "</font></td></tr>";

echo "</table>";
echo "<br>";

?>
 <?php
 include "../db/db.php";

 // if($s_gs=="on_request_confirmed"){

 // $not_arr = " and booking_status!='Cancelled' ";
 // }

 // if($s_gs=="on_request"){
 // $not_arr = " and booking_status='On Request' ";
 // }

 // if($s_gs=="confirmed"){
 // $not_arr = " and booking_status='Confirmed' ";
 // }

 // if($s_gs=="cancelled"){
 // $not_arr = " and booking_status='Cancelled' ";
 // }

 $sfdate = $from_date;
 $stdate = $to_date;

 $date_bulls = "order_date";

 $datei = 1;

 if ($checking_flag == "Yes") {
     $date_bulls = "cin";
     $datei = 0;
 }

 $tot_net_p = 0;
 $tot_sell_p = 0;

 $tot_net = 0;
 $tot_sell = 0;

 $tot_nofrn = 0;

 $fromd = $sfdate;
 $tod = $stdate;

 //$fromd = '2006-09-16';
 //$tod = '2006-09-16';

 function diff_days($start_date, $end_date)
 {
     return floor(abs(strtotime($start_date) - strtotime($end_date)) / 86400);
 }

 $df = diff_days($tod, $fromd) + 1;

 // $cina = array($cin);
 // $couta = array($cout);

 $hotelid = isset($_GET["vt"]) ? $_GET["vt"] : "";

 $q_hotel = "";

 //$hotelid="all";

 echo $q_hotel;

 if ($hotelid == "all") {
     $q_hotel = "";
 } else {
     if ($hotelid == "madinah") {
         $q_hotel = "and hotel_id between 12000 and 12999";
     } elseif ($hotelid == "makkah") {
         $q_hotel = "and hotel_id between 11000 and 11999";
     } elseif ($hotelid == "makkahex") {
         $q_hotel =
             "and hotel_id between 11000 and 11999 and hotel_id!=11101 and hotel_id!=11102 and hotel_id!=11107 and hotel_id!=11108 and hotel_id!=11109 and hotel_id!=11155";
     } elseif ($hotelid == "kingdom") {
         $q_hotel = "and hotel_id > 13000";
     } else {
         $q_str = "select hotel_name, hotel_image from hotels where hotel_id='$hotelid'";

         $h_result = pg_query($conn, $q_str);

         while ($h_row = pg_fetch_array($h_result)) {
             $q_hotel = "and hotel_id=" . $hotelid;
             //$hot_name = $h_row["hotel_name"];
             //echo "<font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><b>" . $h_row["hotel_name"] . " - Summary Between " . date('d-M-Y', strtotime($sfdate)) ." and ". date('d-M-Y', strtotime($stdate)) . "</b></font>";
         }
     } // end else if madinah
 }
 ?>

<div id="parentContent">Loading parent content...</div>
<script>






// Access the parent (opener) window
let parentWindow = window.opener;

// Example: Get text content of an element in the parent


const parentMessage = window.opener.document.getElementById("txtHint").outerHTML;

// Remove script tags from the content
const cleanContent = parentMessage.replace(/<script\b[^<]*(?:(?!<\/script>)<[^<]*)*<\/script>/gi, '');
document.getElementById("parentContent").innerHTML = cleanContent;
//document.getElementById("parentContent").innerHTML =  parentMessage;

// Function to export HTML table to CSV
function exportTableToCSV() {
  // Create a temporary element to parse HTML
  const tempDiv = document.createElement('div');
  tempDiv.innerHTML = parentMessage;

  // Find the table in the HTML
  const table = tempDiv.querySelector('table');

  if (!table) {
    alert('No table found in the content!');
    return;
  }

  // Create CSV content
  let csvContent = "data:text/csv;charset=utf-8,";

  // Get all rows from the table
  const rows = table.querySelectorAll('tr');

  rows.forEach(row => {
    // Get all cells (th or td) in the row
    const cells = row.querySelectorAll('th, td');

    // Extract text from each cell and create CSV row
    const csvRow = Array.from(cells).map(cell => {
      // Get text content and clean it
      let text = cell.innerText || cell.textContent || '';
      text = text.trim();

      // Escape quotes and wrap in quotes
      text = text.replace(/"/g, '""');
      return `"${text}"`;
    }).join(',');

    csvContent += csvRow + '\n';
  });

  // Create blob instead of data URI to avoid # encoding issues
  const blob = new Blob([csvContent.replace('data:text/csv;charset=utf-8,', '')], {
    type: 'text/csv;charset=utf-8;'
  });

  // Create download link
  const link = document.createElement("a");
  const url = URL.createObjectURL(blob);
  link.setAttribute("href", url);
  link.setAttribute("download", "transportation_by_country_export.csv");
  document.body.appendChild(link);

  // Trigger download
  link.click();

  // Clean up
  document.body.removeChild(link);
  URL.revokeObjectURL(url);
}


// Add button to trigger export
const exportButton = document.createElement('button');
exportButton.textContent = 'Export Table to CSV';
exportButton.onclick = exportTableToCSV;
exportButton.style.padding = '10px 20px';
exportButton.style.margin = '10px';
exportButton.style.cursor = 'pointer';
document.body.appendChild(exportButton);



</script>
</body>
</html>
