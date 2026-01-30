<?
include ("header.php");
?>

<script>
document.title= '<? echo $company_name . " ERP - Umrah Home"; ?>';
</script>

<html>
<link rel="stylesheet" type="text/css" href="../calendar/css.css" />
<body leftmargin="0" topmargin="0" rightmargin="0">
<table width="100%" border="0" cellpadding="0" cellspacing="0" style="border-bottom: 1px solid #999999 ;border-left: 3px solid #006600;border-right: 3px solid #006600"><tr>
    <td bgcolor="#CCCCCC"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">&nbsp;You 
      are here: Home</font></td>
  </tr></table>
<table width="100%" border="0" cellpadding="0" cellspacing="0" style="border-bottom: 1px solid #999999 ;border-left: 3px solid #006600;border-right: 3px solid #006600"><tr>
    <td ><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><?include ("../dticker/uhome.php"); ?></td>
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
			<table cellpadding="0" cellspacing="0" width="100%"><tr><td></td></tr></table>
			<table width="100%" cellpadding="1" cellspacing="0" ><tr>
                      <td bgcolor="#ECFFEC" style="border-bottom: 1px solid #999999"> <form name="pnrdet" method="post" action="#" style="margin-bottom:0">
                          <div align="left"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><img src="../images/cor_pnrstatus.jpg" width="50" height="50" align="middle"> 
                            Check the PNR status here</font> 
                            <input type="text" name="pnrdet" size="15">
                            <input name="submit" type="submit" value="Get Details">
                          </div>
                        </form></td>
                    </tr></table>
			<table width="100%" cellpadding="1" cellspacing="0" ><tr>
                      <td bgcolor="#FFF2F2" style="border-bottom: 1px solid #999999"  ><div align="left"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><img src="../images/cor_specialoffer.jpg" width="50" height="50" align="middle"> 
                          Check out latest and privious special offers <a href="../specialoffers/index.php">click 
                          here</a></font></div></td>
                    </tr></table>
			<table width="100%" cellpadding="1" cellspacing="0" ><tr>
                      <td bgcolor="#F4F4FF" style="border-bottom: 1px solid #999999"><div align="left"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><img src="../images/cor_tariff.jpg" width="50" height="50" align="middle"> 
                          Kindom wide and complete year Tariff <a href="../tariff/index.php">click 
                          here</a></font></div></td>
                    </tr></table>
			<table width="100%" cellpadding="1" cellspacing="0"><tr>
                      <td bgcolor="#D5FFFF" style="border-bottom: 1px solid #999999"><div align="left"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><img src="../images/cor_hotel.jpg" width="50" height="50" align="middle"> 
                          For easy finding the Hotel Details <a href="../tariff/index.php">click 
                          here</a></font></div></td>
                    </tr></table>
					<table width="100%" cellpadding="1" cellspacing="0"><tr>
                      <td bgcolor="#FFE2C6" style="border-bottom: 1px solid #999999"><div align="left"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><img src="../images/cor_travelagent.jpg" width="50" height="50" align="middle"> 
                          For easy finding the Agent Details <a href="../tariff/index.php">click 
                          here</a></font></div></td>
                    </tr></table>						
			</td> 
              </tr></table> </td>
        </tr>
      </table></td></tr>
	  
	  
      </table> 
</table>	
	
	

	</tr></table>
</body>				
</html>
