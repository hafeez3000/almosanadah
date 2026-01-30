<?
include ("header.php");
include ("../calendar/cal.php");
?>
<script src="../javascripts/cBoxes.js"></script>


<script>
document.title= '<? echo $company_name . " ERP - Umrah New Bookings"; ?>';
</script>


	<?



 $vy1=$vm1=$vd1=0;



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


			

            <table width="100%" cellpadding="0" cellspacing="0" ><tr><td width="100%" valign="top">
			<table cellpadding="0" cellspacing="0" width="100%" style="border-top: 1px solid #999999; border-bottom: 1px solid #999999"><tr>
                      <td bgcolor="#CCCCCC"><strong>Add Extra Booking </strong>- Add New Select Others/Extra </td>
                    </tr></table>
<table width="100%" cellpadding="1" cellspacing="0"><tr>
                      <td  style="border-bottom: 1px solid #999999"><div align="left"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">



					  </font></div></td>
                    </tr></table>

<?

//$vy1=date('Y', strtotime($s_req_date_time));/

//$vm1=date('m', strtotime($s_req_date_time));
//$vd1=date('d', strtotime($s_req_date_time));

?>



<form name="gquot" action="extraselp.php"  method="post" onSubmit="return fun2(this)">

<table>

 <tr bgcolor="#E8D2D2">
                                  <td colspan="4" bgcolor="#B9F4AE"><div align="center">

                                  <strong>Add New Other/Extra Request</strong> </div></td>
                                </tr>

  <tr><td colspan="4">



					        <table align="center" width="100%">
                              <tr>
                                <td><div align="right"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Requesting
                                    Date</font></div></td>
                                <td colspan="2"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">
                                  <select name="d1Day" class="selBox">
                                  </select>
                                </font><font size="2" face="Verdana, Arial, Helvetica, sans-serif">
                                <select name="d1Month" class="selBox">
                                </select>
                                </font><font size="2" face="Verdana, Arial, Helvetica, sans-serif">
                                <select name="d1Year" class="selBox">
                                </select>
                                </font></td>
                              </tr>
                              <tr>
                                <td><div align="right"><font size="2" face="Arial, Helvetica, sans-serif">Enter
                                    Net Rate</font></div>                                  </td>
                                <td><input type="text" id="other2nrate" name="other2nrate" size="2" value="0"></td>
                                <td rowspan="2"><div align="center"><font size="2" face="Arial, Helvetica, sans-serif">Paticulars of the Request<strong>
                                  <textarea id="other2noofa" name="other2noofa" cols="25" rows="3" ></textarea>
                                </strong></font></div></td>
                              </tr>
							   <tr>
                                <td><div align="right"><font size="2" face="Arial, Helvetica, sans-serif">Enter
                                    Selling Rate</font></div></td>
                                <td><font size="2" face="Arial, Helvetica, sans-serif"><strong>
                                  <input type="text" id="other2srate" name="other2srate" size="2" value="0">
                                </strong></font></td>
                                </tr>
                            </table>

  </td></tr>


  <tr>
						  <td  colspan="2" align="center"></td>
						  </tr>

 <tr>
                                  <td colspan="4" style="border-top: 1px solid #673636" align="right">


                                      <input type="submit" name="Submit" value="Get Rates >>">                                    </td>
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


<script>

var tdddate = new Date();

	var dvy1 = <?php echo $vy1; ?>; if (dvy1==0) dvy1=tdddate.getYear()
	var dvm1 = <?php echo $vm1; ?>; if (dvm1==0) dvm1=tdddate.getMonth()
	var dnd1 = <?php echo $vd1; ?>; if (dnd1==0) dnd1=tdddate.getDate()

    if (dvy1 < 2000) dvy1 += 1900;


	var now_date1 = new Date(dvy1,dvm1,dnd1);
	now_date1.setDate(now_date1.getDate())

	var now_day1 = now_date1.getDate();
	var now_month1 = now_date1.getMonth();
	var now_year1 = now_date1.getYear();



   	var d2 = new dateObj(document.gquot.d1Day, document.gquot.d1Month, document.gquot.d1Year);
	initDates(dvy1-1, dvy1+1, dvy1, now_month1, now_day1, d2);

</script>

<script>
function fun2(theForm){

if(1){

var cd2= document.gquot.d1Day.value;
var cm2= document.gquot.d1Month.value;
var cy2= document.gquot.d1Year.value;

var c_date2 = new Date();
c_date2.setFullYear(document.gquot.d1Year.value,document.gquot.d1Month.value-1,document.gquot.d1Day.value);


var server_date = new Date();
server_date.setFullYear(<? echo  date("Y")  .",". (date("m")-1) .",". date("d") ; ?> );
server_date.setHours( <? echo  date("H") ; ?> );
server_date.setMinutes( <? echo  date("i") ; ?> );
server_date.setSeconds( <? echo  date("s") ; ?> );

var n_today = new Date();

//if((server_date-n_today)>1){
//alert("Please Set your computer date to current local date and time");
//return false;
//}

var one_day=1000*60*60*24;



if( ((server_date.getTime()- n_today.getTime()) / (one_day))>1 )
{
alert("Please Set your computer date to current local date and time");
return false;
}
if( ((server_date.getTime()- n_today.getTime()) / (one_day))<-1 )
{
alert("Please Set your computer date to current local date and time");
return false;
}



if(c_date2<n_today){
alert("Request date must be after Today");
return false;
}


}


if(document.gquot.other2nrate.value=="0"){
	alert("Sorry, but Enter Net Rate.");
		document.gquot.other2nrate.focus();
		return false;
	}


if(document.gquot.other2srate.value=="0"){

	alert("Sorry, but Enter Selling Rate.");
		document.gquot.other2srate.focus();
		return false;
	}

if(document.gquot.other2noofa.value==""){

	alert("Sorry, but Enter paticular details.");
		document.gquot.other2noofa.focus();
		return false;
	}






}
</script>

</body>
</html>
