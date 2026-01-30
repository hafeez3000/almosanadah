<?
include ("header.php");
include ("../calendar/cal.php");
?>

<script>
document.title= '<? echo $company_name . " ERP - Umrah Operations"; ?>';
</script>

<html>
<link rel="stylesheet" type="text/css" href="../calendar/css.css" />
<body leftmargin="0" topmargin="0" rightmargin="0">
<table width="100%" border="0" cellpadding="0" cellspacing="0" style="border-bottom: 1px solid #999999 ;border-left: 3px solid #006600;border-right: 3px solid #006600"><tr>
    <td bgcolor="#CCCCCC"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">&nbsp;You
      are here: Home</font></td>
  </tr></table>
<!--<table width="100%" border="0" cellpadding="0" cellspacing="0" style="border-bottom: 1px solid #999999 ;border-left: 3px solid #006600;border-right: 3px solid #006600"><tr>
    <td ><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><?include ("../dticker/uhome.php"); ?></td>
  </tr></table>
-->
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
			<table cellpadding="0" cellspacing="0" width="100%"><tr><td></td></tr></table>
			<table width="100%" cellpadding="1" cellspacing="0" ><tr>
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
						<!--	<input type="hidden" name="texttype" value="pnr">-->
                            <input type="button" id="get_pnr" name="get_pnr" value="Get PNR Details" onClick="get_pnrdet()"></div></td>
                    </tr></table>
<!--

			<table width="100%" cellpadding="1" cellspacing="0" ><tr>
                      <td bgcolor="#F4F4FF" style="border-bottom: 1px solid #999999"><div align="left"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><img src="../images/cor_tariff.jpg" width="50" height="50" align="middle">
                          Kindom wide and complete year Tariff <a href="../tariff/index.php">click
                          here</a></font></div></td>
		            </tr></table>

-->
			<table width="100%" cellpadding="1" cellspacing="0"><tr>
                      <td bgcolor="#D5FFFF" style="border-bottom: 1px solid #999999"><div align="left"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><img src="../images/cor_hotel.jpg" width="50" height="50" align="middle">
                          For easy finding the Hotel Details <a href="hoteldetails.php">click
                          here</a></font></div></td>
                    </tr></table>
					<table width="100%" cellpadding="1" cellspacing="0"><tr>
                      <td bgcolor="#FFE2C6" style="border-bottom: 1px solid #999999"><div align="left"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><img src="../images/cor_travelagent.jpg" width="50" height="50" align="middle">
                          For easy finding the Agent Details <a href="agentdetails.php">click
                          here</a></font></div></td>
                    </tr></table>
			</td>
                <td width="15%" style="border-left: 1px solid #999999" valign="top"><table >
                    <tr>
                      <td style="border-bottom: 1px solid #999999"><?php
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

<script>
function fun2(theForm){




 if ( (document.pnrdet.tdata.value== null) ||  ((document.pnrdet.tdata.value).length==0) ||  ((document.pnrdet.tdata.value).length<5))
   {
      alert ("Sorry, But enter pnr to find orders");
	  document.pnrdet.tdata.focus();
	  		return false;
   }




}
</script>


	</tr></table>
</body>
</html>
