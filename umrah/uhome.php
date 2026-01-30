<?
include("header.php");
include("../calendar/cal.php");
?>

<script>
  document.title = '<? echo $company_name . " ERP - Umrah Home"; ?>';
</script>

<html>
<link rel="stylesheet" type="text/css" href="../calendar/css.css" />

<body leftmargin="0" topmargin="0" rightmargin="0">
  <table width="100%" border="0" cellpadding="0" cellspacing="0"
    style="border-bottom: 1px solid #999999 ;border-left: 3px solid #006600;border-right: 3px solid #006600">
    <tr>
      <td bgcolor="#CCCCCC">
        <font size="2" face="Verdana, Arial, Helvetica, sans-serif">&nbsp;You
          are here: Home</font>
      </td>
    </tr>
  </table>
  <!-- <table width="100%" border="0" cellpadding="0" cellspacing="0"
    style="border-bottom: 1px solid #999999 ;border-left: 3px solid #006600;border-right: 3px solid #006600">
    <tr>
      <td>
        <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><?php //include("../dticker/uhome.php"); ?>
      </td>
    </tr>
  </table> -->

  <table width="100%" border="0" cellpadding="0" cellspacing="0"
    style="border-bottom: 3px solid #006600; border-right: 3px solid #006600;border-left: 3px solid #006600 ">
    <tr>
      <td width="20%" style="border-right: 1px solid #999999" valign="top">
        <table width="100%" border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td valign="top">
              <div align="left">
                <?php  include  ("umenupreline.php"); ?>
              </div>
            </td>
          </tr>
        </table>
      </td>
      <td width="80%" valign="top">
        <table width="100%" border="0" cellpadding="0" cellspacing="1">
          <tr>
            <td valign="top">




              <table width="100%" cellpadding="0" cellspacing="0">
                <tr>
                  <td width="85%" valign="top">
                    <table cellpadding="0" cellspacing="0" width="100%">
                      <tr>
                        <td></td>
                      </tr>
                    </table>
                    <!--			<table width="100%" cellpadding="1" cellspacing="0" ><tr>
                      <td bgcolor="#ECFFEC" style="border-bottom: 1px solid #999999">
                          <div align="left"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><img src="../images/cor_pnrstatus.jpg" width="50" height="50" align="middle">
                            Check the PNR status here</font>
                        <script type="text/javascript">
      function get_pnrdet(){

   if ((document.getElementById ("tdata").value== null) || ((document.getElementById ("tdata").value).length==0))
   {
      alert ("Sorry, But enter PNR to get more details");
    document.getElementById ("tdata").focus();
   }
   else {
         var ag_vn = "pnrdet.php?"+"spnr="+document.getElementById ("tdata").value;
    document.location.href=ag_vn ;

      }

}
    </script>

                            <input type="text" id="tdata" name="tdata" size="6">
            <input type="hidden" name="texttype" value="pnr">
                            <input type="button" id="get_pnr" name="get_pnr" value="Get PNR Details" onClick="get_pnrdet()">

                          </div>
                       </td>
                    </tr></table>
-->
                    <table width="100%" border="0" cellspacing="0" style=" border-bottom: 1px solid #999999"
                      bgcolor="#ECFFEC">
                      <form name="bbyod1" method="post" action="bbyodactiont.php" onSubmit="return fun2(this)">
                        <tr>
                          <td rowspan="3" style="width:180px" ;><img src="../images/cor_pnrstatus.jpg" width="50"
                              height="50" align="middle">&nbsp;Find Orders By</td>
                        </tr>
                        <tr>
                          <td>
                            <font size="2" face="Verdana, Arial, Helvetica, sans-serif">Enter
                              Text </font>
                          </td>
                          <td><input type="text" id="tdata" name="tdata"></td>
                        </tr>
                        <tr>
                          <td style="width:180px" ;>
                            <font size="2" face="Verdana, Arial, Helvetica, sans-serif">Select
                              Text Type</font>
                          </td>
                          <td>
                            <font size="2" face="Arial, Helvetica, sans-serif">
                              <font size="2" face="Arial, Helvetica, sans-serif"><strong>
                                  <select name="texttype">
                                    <option value="pnr">PNR</option>
                                    <option value="gname">Guest Name</option>
                                    <option value="userid">User ID</option>
                                  </select>
                                </strong></font>
                            </font>
                            <input type="submit" name="Submit" value="Find Bookings by  >>>">
                          </td>
                        </tr>
                      </form>
                    </table>



                    <table width="100%" cellpadding="1" cellspacing="0">
                      <tr>
                        <td bgcolor="#FFF2F2" style="border-bottom: 1px solid #999999">
                          <div align="left">
                            <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><img
                                src="../images/cor_specialoffer.jpg" width="50" height="50" align="middle">
                              Check out latest and privious special offers <a href="specialoffersr.php">click
                                here</a></font>
                          </div>
                        </td>
                      </tr>
                    </table>
                    <!--

      <table width="100%" cellpadding="1" cellspacing="0" ><tr>
                      <td bgcolor="#F4F4FF" style="border-bottom: 1px solid #999999"><div align="left"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><img src="../images/cor_tariff.jpg" width="50" height="50" align="middle">
                          Kindom wide and complete year Tariff <a href="../tariff/index.php">click
                          here</a></font></div></td>
                </tr></table>

-->
                    <table width="100%" cellpadding="1" cellspacing="0">
                      <tr>
                        <td bgcolor="#D5FFFF" style="border-bottom: 1px solid #999999">
                          <div align="left">
                            <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><img
                                src="../images/cor_hotel.jpg" width="50" height="50" align="middle">
                              For easy finding the Hotel Details <a href="hoteldetails.php">click
                                here</a></font>
                          </div>
                        </td>
                      </tr>
                    </table>
                    <table width="100%" cellpadding="1" cellspacing="0">
                      <tr>
                        <td bgcolor="#FFE2C6" style="border-bottom: 1px solid #999999">
                          <div align="left">
                            <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><img
                                src="../images/cor_travelagent.jpg" width="50" height="50" align="middle">
                              For easy finding the Agent Details <a href="agentdetails.php">click
                                here</a></font>
                          </div>
                        </td>
                      </tr>
                    </table>
                  </td>
                  <td width="15%" style="border-left: 1px solid #999999" valign="top">
                    <table class="border-separate border-spacing-3" width="100%" cellpadding="0" cellspacing="0">
                      <tr>
                        <td style="border-bottom: 1px solid #999999">
                          <?php
                          $time = time();
                          $today = date('j', $time);
                          $days = array($today => array(NULL, NULL, '<span style="color: red; font-weight: bold; font-size: larger; text-decoration: none;">' . $today . '</span>'));
                          echo generate_calendar(date('Y', $time), date('n', $time), $days, 2);
                          ?>

                        </td>
                      </tr>
                      <tr>
                        <td style="border-bottom: 1px solid #999999">
                          <?php
                          $time = time();
                          echo generate_calendar(date('Y', $time), date('n', $time) + 1, NULL, 2);
                          ?>

                        </td>
                      </tr>
                      <tr>

                      </tr>
                    </table>
                  </td>
                </tr>
              </table>
              <!--  Dashboard report table  -->


              <table class="dashboard-hotel" cellpadding="2" cellspacing="0" width="98%">
                <tr class="dashboard-hotel-tr-head">
                  <td>
                    <div align="center">
                      <font size="2" face="Arial, Helvetica, sans-serif">Sno</font>
                    </div>
                  </td>
                  <td>
                    <div align="center">
                      <font size="2" face="Arial, Helvetica, sans-serif">PNR</font>
                    </div>
                  </td>
                  <td>
                    <div align="center">
                      <font size="2" face="Arial, Helvetica, sans-serif">Guest
                        Name</font>
                    </div>
                  </td>
                  <td>
                    <div align="center">
                      <font size="2" face="Arial, Helvetica, sans-serif">Cin</font>
                    </div>
                  </td>
                  <td>
                    <div align="center">
                      <font size="2" face="Arial, Helvetica, sans-serif">Cout</font>
                    </div>
                  </td>
                  <td>
                    <div align="center">
                      <font size="2" face="Arial, Helvetica, sans-serif">Hotel
                        Name, City</font>
                    </div>
                  </td>
                  <td>
                    <div align="center">
                      <font size="2" face="Arial, Helvetica, sans-serif">Travel
                        Agent, Country</font>
                    </div>
                  </td>

                  <td>
                    <div align="center">
                      <font size="2" face="Arial, Helvetica, sans-serif">Nts</font>
                    </div>
                  </td>
                  <td>
                    <div align="center">
                      <font size="2" face="Arial, Helvetica, sans-serif">Rooms</font>
                    </div>
                  </td>
                  <td>
                    <div align="center">
                      <font size="2" face="Arial, Helvetica, sans-serif">Room Type</font>
                    </div>
                  </td>

                  <td width="80px">
                    <div align="center">
                      <font size="2" face="Arial, Helvetica, sans-serif">Status</font>
                    </div>
                  </td>
                  <td>
                    <div align="center">
                      <font size="2" face="Arial, Helvetica, sans-serif">Option Date</font>
                    </div>
                  </td>




                <tr>

                  <?

                  $query = "SELECT ocode,cin, cout,hotel_id, room_id,no_rooms,no_nights,cus_paid,booking_status,net_rate,sell_rate,room_inhouseno,hotel_confirmation_no,cus_voucher, guest_occ_status, cus_paid, option_date from sales_hotels where ocode!='NC' and booking_status='On Request' order by option_date desc limit 10";



                  $result = pg_query($conn,  $query);

                  $rowc = pg_num_rows($result);
                  //printf("Records selected: %d\n", mysql_affected_rows());
                  
                  $ac = 0;
                  $afd = array();
                  $atd = array();
                  $anofn = array();

                  $apaid = array();
                  ?>
                  <?
                  $b_sno = 1;

                  $tot_nofrn = 0;

                  $tot_net = 0;
                  $tot_sell = 0;

                  $tot_net_p = 0;
                  $tot_sell_p = 0;

                  while ($row = pg_fetch_array($result)) {



                    $s_ocode = $row["ocode"];
                    $s_hotel_id = $row["hotel_id"];
                    $s_room_id = $row["room_id"];

                    $query_sub = "SELECT ocode,guest_title, guest_name,option_date,cus_company_name,cus_country, option_date from sales_main where ocode='$s_ocode' ";

                    $result_sub = pg_query($conn, $query_sub);


                    while ($row_sub = pg_fetch_array($result_sub)) {
                      $s_guest_title = $row_sub["guest_title"];
                      $s_guest_name = $row_sub["guest_name"];
                      $s_option_date = $row_sub["option_date"];
                      $s_cus_company_name = $row_sub["cus_company_name"];
                      $s_cus_country = $row_sub["cus_country"];
                      $s_option_date = $row_sub["option_date"];


                    }


                    $query_sub_room_h = "SELECT hotel_id, hotel_name,city  from hotels where hotel_id='$s_hotel_id' ";

                    $result_sub_room_h = pg_query($conn,  $query_sub_room_h);


                    while ($row_sub_room_h = pg_fetch_array($result_sub_room_h)) {

                      $hotel_name = $row_sub_room_h["hotel_name"];
                      $hotel_city = $row_sub_room_h["city"];
                    }

                    $query_sub_room = "SELECT room_type from rooms where room_id='$s_room_id' ";

                    $result_sub_room = pg_query($conn,  $query_sub_room);


                    while ($row_sub_room = pg_fetch_array($result_sub_room)) {

                      $room_type = $row_sub_room["room_type"];
                    }


                    ?>
                  <tr style=<?php if ($b_sno % 2 != 0) {
                    echo "\"background:#FFF\"";
                  } ?>>

                    <td align="center">
                      <font size="2" face="Arial, Helvetica, sans-serif"><? echo $b_sno ?></font>
                    </td>
                    <td>
                      <font size="2" face="Arial, Helvetica, sans-serif"><a href="pnrdet.php?spnr=<? echo $row["ocode"]; ?>"
                          target='<? echo $row["ocode"]; ?>'
                          onClick="window.open('','<? echo $row["ocode"]; ?>', ' width='+(screen.width-10)+' , height='+(screen.height-50)+' , left=0,top=0 ').focus()"><? echo $row["ocode"]; ?></a>
                      </font>
                    </td>

                    <td>
                      <font size="2" face="Arial, Helvetica, sans-serif">
                        <? echo $s_guest_title . ". " . strtoupper($s_guest_name); ?></font>
                    </td>
                    <td align="center">
                      <font size="2" face="Arial, Helvetica, sans-serif">
                        <? echo date('d', strtotime($row["cin"])); ?>  <? echo date('M', strtotime($row["cin"])); ?></font>
                    </td>
                    <td align="center">
                      <font size="2" face="Arial, Helvetica, sans-serif">
                        <? echo date('d', strtotime($row["cout"])); ?>  <? echo date('M', strtotime($row["cout"])); ?></font>
                    </td>
                    <td>
                      <font size="2" face="Arial, Helvetica, sans-serif">
                        <? echo strtoupper($hotel_name) . ", " . strtoupper($hotel_city); ?></font>
                    </td>
                    <td>
                      <font size="2" face="Arial, Helvetica, sans-serif">
                        <? echo strtoupper($s_cus_company_name) . ", " . strtoupper($s_cus_country); ?></font>
                    </td>

                    <td align="center">
                      <font size="2" face="Arial, Helvetica, sans-serif"><? echo $row["no_nights"]; ?> </font>
                    </td>
                    <td align="center">
                      <font size="2" face="Arial, Helvetica, sans-serif"><? echo $row["no_rooms"]; ?> </font>
                    </td>


                    <td align="center">
                      <font size="2" face="Arial, Helvetica, sans-serif"><? echo $room_type; ?> </font>
                    </td>
                    <td style=<?php if ($row["booking_status"] == "Confirmed") {
                      echo "background:green";
                    } else {
                      echo "background:red";
                    } ?>>
                      <font size="2" face="Arial, Helvetica, sans-serif" color="#FFF">
                        <b><?php echo $row["booking_status"]; ?></b> </font>
                    </td>
                    <td>
                      <font size="2" face="Arial, Helvetica, sans-serif">
                        <? echo date('d-M-Y H:i:s', strtotime($s_option_date)); ?> </font>
                    </td>

                    <?


                    $b_sno++;



                    $tot_nofrn = $tot_nofrn + ($row["no_nights"] * $row["no_rooms"]);

                    $tot_net = $tot_net + $tot_net_p;
                    $tot_sell = $tot_sell + $tot_sell_p;

                    $tot_net_p = 0;
                    $tot_sell_p = 0;


                  }





                  ?>
                </tr>


              </table>




            </td>
          </tr>
        </table>
      </td>
    </tr>


  </table>
  </table>

  <script>
    function fun2(theForm) {




      if ((document.pnrdet.tdata.value == null) || ((document.pnrdet.tdata.value).length == 0) || ((document.pnrdet.tdata.value).length < 5)) {
        alert("Sorry, But enter pnr to find orders");
        document.pnrdet.tdata.focus();
        return false;
      }




    }
  </script>


  </tr>
  </table>
</body>

</html>