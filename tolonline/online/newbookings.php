<?
include ("header.php");
include ("../calendar/cal.php");
?>

<script>
document.title= '<? echo $company_name . " ERP - Umrah New Bookings"; ?>';
</script>

<html>
<link rel="stylesheet" type="text/css" href="../calendar/css.css" />
<body leftmargin="0" topmargin="0" rightmargin="0">
<table width="100%" border="0" cellpadding="0" cellspacing="0" style="border-bottom: 1px solid #999999 ;border-left: 3px solid #006600;border-right: 3px solid #006600"><tr>
    <td bgcolor="#CCCCCC"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">&nbsp;You 
      are here: <a href="uhome.php">Home</a> &raquo; <a href="bookings.php">Bookings</a>  &raquo; New Bookings</font></td>
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
                      <td bgcolor="#CCCCCC"><strong>New Bookings</strong></td>
                    </tr></table>
<table width="100%" cellpadding="1" cellspacing="0"><tr>
                      <td height="50" bgcolor="#EAFFEA" style="border-bottom: 1px solid #999999"><div align="left"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
                          New Hotel Bookings <a href="newhotelbooking.php">click here</a></font></div></td>
                    </tr></table>									
					<table width="100%" cellpadding="1" cellspacing="0"><tr>
                      <td height="50" bgcolor="#FFE2C6" style="border-bottom: 1px solid #999999"><div align="left"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
                          New Transportation <a href="newtransbooking.php">click here</a></font></div></td>
                    </tr></table>
					
					<table width="100%" cellpadding="1" cellspacing="0"><tr>
                      <td height="50" bgcolor="#FFCCFF" style="border-bottom: 1px solid #999999"><div align="left"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
                          New Other/Extras Bookings <a href="newotherbooking.php">click 
                          here</a></font></div></td>
                    </tr></table>						
			</td> 
                <td width="15%" style="border-left: 1px solid #999999"><table >
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
