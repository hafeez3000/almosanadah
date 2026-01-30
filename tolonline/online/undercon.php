<?
include ("header.php");
include ("../calendar/cal.php");
?>

<script>
document.title= '<? echo $company_name . " ERP - Umrah Home"; ?>';
</script>

<html>
<link rel="stylesheet" type="text/css" href="../calendar/css.css" />
<body leftmargin="0" topmargin="0" rightmargin="0">
<table width="100%" border="0" cellpadding="0" cellspacing="0" style="border-bottom: 1px solid #999999 ;border-left: 3px solid #006600;border-right: 3px solid #006600"><tr>
    <td bgcolor="#CCCCCC"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">&nbsp;You 
      are here: <a href="uhome.php">Home</a></font></td>
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
           
			
			
			
			
            <table width="100%" cellpadding="0" cellspacing="0" ><tr><td width="85%" > 
		
<center>
		<font size="6" face="Verdana, Arial, Helvetica, sans-serif">Page Under Construction </font><br>
		<font size="2" face="Verdana, Arial, Helvetica, sans-serif">If you really want us to work on this, please click on email link to notify Admin at:  <A href="mailto:admin@daralmanasek.com" name="admin@daralmanasek.com">admin@daralmanasek.com</A> </font>
</center>
											
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


