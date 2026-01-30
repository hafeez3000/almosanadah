<?
include ("header.php");
include ("../calendar/cal.php");
?>
<script src="../javascripts/cBoxes.js"></script>


<script>
document.title= '<? echo $company_name . " ERP - Umrah New Bookings"; ?>';
</script>

	<?
 $s_pnr = $_SESSION["a_pnr"];
 $g_hotel_sno = $_GET["hotelid"];



$q_trans_sel ="select ocode,sales_hotels_sno,room_id,hotel_id,supp_id,supp_account_code  from sales_hotels where ocode='$s_pnr' and sales_hotels_sno = $g_hotel_sno";

$res_trans_sel = pg_query($q_trans_sel);

 $rows_trans = pg_num_rows($res_trans_sel);

if (!$res_trans_sel) {
echo "An error occured.\n";
exit;
		}

if($rows_trans>0){
}
while ($rows_trans_sel = pg_fetch_array($res_trans_sel)){

$s_sales_hotels_sno = $rows_trans_sel["sales_hotels_sno"];
$s_hotel_id = $rows_trans_sel["hotel_id"];
$s_room_id = $rows_trans_sel["room_id"];
$s_supp_id=$rows_trans_sel["supp_id"];
$s_supp_account_code = $rows_trans_sel["supp_account_code"];
$s_ocode = $rows_trans_sel["ocode"];


}

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
                      <td bgcolor="#CCCCCC"><strong>Update Supplier </strong>- Enter the more details</td>
                    </tr></table>
<table width="100%" cellpadding="1" cellspacing="0"><tr>
                      <td  style="border-bottom: 1px solid #999999"><div align="left"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">



					  </font></div></td>
                    </tr></table>

			<?




$query_trans_t ="select hotel_name,city from hotels where hotel_id='$s_hotel_id'";

$result_trans_t = pg_query($query_trans_t);

if (!$result_trans_t) {
	echo "An error occured.\n";
	exit;
	}
while ($rows_trans_t = pg_fetch_array($result_trans_t)){

$trans_name_t = $rows_trans_t["hotel_name"];
$trans_city = $rows_trans_t["city"];

}

pg_free_result($result_trans_t);


$query_room_t ="select room_type from rooms where room_id='$s_room_id'";

$result_room_t = pg_query($query_room_t);

if (!$result_room_t) {
	echo "An error occured.\n";
	exit;
	}
while ($rows_room_t = pg_fetch_array($result_room_t)){

$trans_room_t = $rows_room_t["room_type"];

}

pg_free_result($result_room_t);


$query_supp_t ="select supp_name,city from suppliers where supp_id='$s_supp_id'";

$result_supp_t = pg_query($query_supp_t);

if (!$result_supp_t) {
	echo "An error occured.\n";
	exit;
	}
while ($rows_supp_t = pg_fetch_array($result_supp_t)){

$supp_name_t = $rows_supp_t["supp_name"];
$supp_city = $rows_supp_t["city"];

}

pg_free_result($result_supp_t);


$supp_namet = array();
$supp_cityt = array();
$supp_idt = array();

$query_suppt_t ="select supp_id,supp_name,city  from suppliers order by supp_name";

$result_suppt_t = pg_query($query_suppt_t);

if (!$result_suppt_t) {
	echo "An error occured.\n";
	exit;
	}
while ($rows_suppt_t = pg_fetch_array($result_suppt_t)){


$supp_idt[] = $rows_suppt_t["supp_id"];
$supp_namet[] = $rows_suppt_t["supp_name"];
$supp_cityt[] = $rows_suppt_t["city"];

}


pg_free_result($result_suppt_t);


			?>

<table width="100%" cellpadding="1" cellspacing="0"><tr>
                      <td  style="border-bottom: 1px solid #999999"><div align="left"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">

					  <table align="center">
   <tr>
     <td>PNR</td>
     <td><div align="left"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b><?  echo $s_ocode ; ?></b></font></div></td>
     </tr>
   <tr>
     <td>Room Type</td>
     <td><? echo $trans_room_t ; ?></td>
   </tr>
   <tr>
     <td>Hotel(City)</td>
     <td><b><?  echo $trans_name_t ."(".$trans_city.")"; ?></b></td>
   </tr>
   <tr>
     <td style="border-bottom: 1px solid #999999">Present Supplier</td>
     <td style="border-bottom: 1px solid #999999">
	 <div align="left"><font size="2" face="Verdana, Arial, Helvetica, sans-serif" color="#FF0000"><strong>
     <?
	 if(trim($s_supp_id)==""){
	 echo $trans_name_t;
	 }
	 else{
     echo $supp_name_t .",".$supp_city;
	 }

	 ?>
	 </strong></font></div>
     </td>
   </tr>

   <tr>
     <td colspan="2" style="border-bottom: 1px solid #999999">Change Supplier to:</td>


   </tr>


    <script type="text/javascript">
      function hotel_chk(){

         var hb_not = "hotelsuppchange2hot.php?"+'<? echo "spnr=".$s_pnr ?>'+'<? echo "&hotelid=".$g_hotel_sno ?>'+"&hotid="+document.getElementById ("hotel").value;
		document.location.href=hb_not ;
	}

    </script>

   <tr>
     <td>Hotel</td>
     <td> <select id="hotel" name="hotel">

                                        <?



  echo  "<option value='$s_hotel_id'>$trans_name_t</option>";


	?>
                                      </select> <input type="button" id="hotelb" name="hotelb" value="Hotel ?" onClick="hotel_chk()"></td>
   </tr>
<tr><td>&nbsp;</td></tr>
   <script type="text/javascript">
      function supp_chk(){

   if (document.getElementById ("supplier").value=="select")
   {
      alert ("Sorry, But select the supplier");
	  document.getElementById ("supplier").focus();
   }
   else {
         var rm_not = "hotelsuppchange.php?"+'<? echo "spnr=".$s_pnr ?>'+'<? echo "&hotelid=".$g_hotel_sno ?>'+"&suppid="+document.getElementById ("supplier").value;
		document.location.href=rm_not ;

      }

}
    </script>
   <tr>
     <td><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Supplier</font></td><td> <select id="supplier" name="supplier">
                                        <option value="select">Select Supplier</option>
                                        <?

		for($i=0;$i<count($supp_idt);$i++){

  echo  "<option value=\"$supp_idt[$i]\">$supp_namet[$i]</option>";

}
	?>
                                      </select>



									  <input type="button" id="suppb" name="suppb" value="Supplier ?" onClick="supp_chk()"></td>
   </tr>



 </table>





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
					<tr>
                      <td><div align="center"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><a href="../calendar/index.php">DORS
                          ERP TODO</a></font></div></td>
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
