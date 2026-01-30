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
 $g_trans_sno = $_GET["transid"];



 $q_trans_sel ="select ocode,sales_trans_sno,req_date_time,f2t,type_of_trans,kind_of_trans,trans_model,supp_rep,supp_account_code,trans_id, driver_name, driver_mobile  from sales_trans where ocode='$s_pnr' and sales_trans_sno = $g_trans_sno";


$res_trans_sel = pg_query($conn, $q_trans_sel);

 $rows_trans = pg_num_rows($res_trans_sel);

if (!$res_trans_sel) {
echo "An error occured.\n";
exit;
		}

if($rows_trans>0){
}
while ($rows_trans_sel = pg_fetch_array($res_trans_sel)){

$s_sales_trans_sno = $rows_trans_sel["sales_trans_sno"];
$s_req_date_time = $rows_trans_sel["req_date_time"];


$ts = strtotime($s_req_date_time);
$cbd = getdate($ts);
isset($cbdd) ? $cbdd = $cbd[mday] : null;
isset($cbdm) ? $cbdm = $cbd[mon] - 1 : null;
isset($cbdy) ? $cbdy = $cbd[year] : null;

isset($cbds) ? $cbds = $cbd[seconds] : null;
isset($cbdmi) ? $cbdmi = $cbd[minutes] : null;
isset($cbdh) ? $cbdh = $cbd[hours] : null;




if( isset($cbdmi) && strlen((string)$cbdmi)==1) { $cbdmi = "0".$cbdmi; }
if( isset($cbdh) && strlen((string)$cbdh)==1) { $cbdh = "0".$cbdh; }

$vd1 = isset($cbdd) ? $cbdd : null;
$vy1= isset($cbdy) ? $cbdy : null;
$vm1= isset($cbdm) ? $cbdm : null;

$s_trans_id = $rows_trans_sel["trans_id"];
$s_trans_supp_id = substr($s_trans_id,0,3);

$kind_of_trans=$rows_trans_sel["kind_of_trans"];
$trans_model=$rows_trans_sel["trans_model"];
$supp_rep=$rows_trans_sel["supp_rep"];

$s_ocode = $rows_trans_sel["ocode"];
$s_f2t = $rows_trans_sel["f2t"];
$s_type_of_trans = $rows_trans_sel["type_of_trans"];

$s_supp_account_code = $rows_trans_sel["supp_account_code"];

$driver_name = $rows_trans_sel["driver_name"];
$driver_mobile =  $rows_trans_sel["driver_mobile"];
// $agent_jeddah =  $rows_trans_sel["agent_jeddah"];
// $agent_makkah =  $rows_trans_sel["agent_makkah"];
// $agent_madinah =  $rows_trans_sel["agent_madinah"];


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
              <?php include  ("umenupreline.php"); ?>
            </div></td>
        </tr>
      </table></td>
    <td width="80%" valign="top"  > <table width="100%" border="0" cellpadding="0" cellspacing="1">
        <tr>
          <td valign="top">


		


            <table width="100%" cellpadding="0" cellspacing="0" ><tr><td width="85%" valign="top">
			<table cellpadding="0" cellspacing="0" width="100%" style="border-top: 1px solid #999999; border-bottom: 1px solid #999999"><tr>
                      <td bgcolor="#CCCCCC"><strong>Update Transportation Booking </strong>- Enter the more details</td>
                    </tr></table>
<table width="100%" cellpadding="1" cellspacing="0"><tr>
                      <td  style="border-bottom: 1px solid #999999"><div align="left"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">



					  </font></div></td>
                    </tr></table>

			<?




$query_trans_t ="select trans_c_name,city from s_trans where trans_id='$s_trans_supp_id'";

$result_trans_t = pg_query($conn, $query_trans_t);

if (!$result_trans_t) {
	echo "An error occured.\n";
	exit;
	}
while ($rows_trans_t = pg_fetch_array($result_trans_t)){

$trans_name_t = $rows_trans_t["trans_c_name"];
$trans_city = $rows_trans_t["city"];
}

pg_free_result($result_trans_t);




			?>

<table width="100%" cellpadding="1" cellspacing="0"><tr>
                      <td  style="border-bottom: 1px solid #999999"><div align="left"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">
					   <form name="transp" method="post" action="amendtranskinda.php" >

					  <table align="center" width="100%">
   <tr>
     <td>PNR</td>
     <td><div align="left"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b><?  echo $s_ocode ; ?></b></font></div></td>
     </tr>
   <tr>
     <td>Transportation Route</td>
     <td><input type="text" size="100"  id="trans_route" name="trans_route" value='<? echo $s_f2t ; ?>' ></td>
   </tr>
   <tr>
     <td>Transportation Type</td>
     <td><b><?  echo $s_type_of_trans ; ?></b></td>
   </tr>
   <tr>
     <td>Transportation Kind</td>
     <td>
       <input type="text" size="100" id="trans_kind" name="trans_kind" value='<? echo $kind_of_trans ; ?>' >
     </td>
   </tr>
   <tr>
     <td>Transportation Model</td>
     <td>  <input type="text" size="100"  id="trans_model" name="trans_model" value='<? echo $trans_model ; ?>' ></td>
   </tr>
   <tr>
     <td><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Transportation Supplier</font></td>
     <td><b><?  echo $trans_name_t ." - ". $trans_city; ?></b></td>
   </tr>
   <tr>
     <td><font size="2" face="Verdana, Arial, Helvetica, sans-serif">  Transportation Supplier Representative </font> </td>
     <td><input type="text" size="100"  id="trans_supp" name="trans_supp" value='<? echo $supp_rep ; ?>' ></td>
   </tr>
   <tr>
     <td><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Driver name</font> </td>
     <td><input type="text" size="100"  id="driver_name" name="driver_name" value='<? echo $driver_name ; ?>' ></td>
   </tr>

   <tr>
     <td><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Driver mobile</font> </td>
     <td><input type="text"  size="100" id="dirver_mobile" name="driver_mobile" value='<? echo $driver_mobile ; ?>' ></td>
   </tr>
   <!-- <tr>
     <td><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Our Agent in Jeddah</font> </td>
     <td><input type="text" size="100"  id="agent_jeddah" name="agent_jeddah" value='<? echo $agent_jeddah ; ?>' ></td>
   </tr>
   <tr>
     <td><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Our Agent in Makkah</font> </td>
     <td><input type="text" size="100"  id="agent_makkah" name="agent_makkah" value='<? echo $agent_makkah ; ?>' ></td>
   </tr>
   <tr>
     <td><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Our Agent in Madinah</font> </td>
     <td><input type="text" size="100" id="agent_madinah" name="agent_madinah" value='<? echo $agent_madinah ; ?>' ></td>
   </tr> -->
  <tr>
        <td colspan="5"><div align="center"><a style="margin-right: 20px;
    padding: 3px;
    border-color: #000;
    background-color: #CCC;" href="pnrdet.php?spnr=<? echo $s_pnr ?>"><? echo 'Show PNR  Details' ?></a>
		 <input type="hidden" name="tsno" value='<? echo $g_trans_sno ?>'>
            <input type="submit" name="Submit" value="Updated Trans Details">
          </div></td>
      </tr>
 </table>


					   </form>


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
