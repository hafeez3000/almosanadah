<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
 "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<title>Create Your Profile</title>
	
	<meta name="robots" content="noindex, nofollow" />
	
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="Content-language" content="en" />
	
		<!-- start CSS -->
		<link rel="stylesheet" href="css/profil-registration-structure.css" type="text/css" media="all" />
		<link rel="stylesheet" href="css/profil-registration-couleur.css" type="text/css" media="all" />
    <link type="text/css" rel="stylesheet" media="screen" href="css/bandeau_cr.css" />
    
        <style type="text/css">
    #page #profil-overture{background: url(images/profil/img-registration_verify.jpg) no-repeat;}
    </style>
    
  <!-- end CSS -->
	<script type="text/javascript" src="javascripts/prototype.js"></script>

  <script type="text/javascript" src="javascripts/tooltipAH.js"></script>
  <SCRIPT LANGUAGE="JavaScript1.1" SRC="../javascripts/FormChek.js"></SCRIPT>

	
<body id="profil-registration" onLoad="document.newUser1.user_civility.focus();">
	<div id="page" >
			<div id="profil-bandeau">
        <div id="bandeau_cr">
          <div id="header_cr">
            <a class="logo_cr" href="http://www.dheyafataj.com" target="_top"><img src="images/logo.png" alt="Dar Al Manasek" /></a>
              <p class="slogan_cr"><strong>DAR AL MANASEK <br>It's pleasure to serve you!</strong></p>					

                <ul id="languageSelection_cr">
                  <li><a href="#" lang="ar" ><img src="images/arabic.jpg" alt="Arabic" /></a></li> 
                </ul>	
      
                <!-- navigation -->
                <ul id="navigation_cr" class="items4 navigation">
                  <li><a href="http://www.dheyafataj.com/" target="_top"><span>Welcome</span></a></li>
                  <li class="deuxLignes"><a href="" target="_top"><span>Search and book a hotel</span></a></li>
                  <li><a href="" target="_top"><span>Dar Al Manasek Hotel</span></a></li>
                  <li><a href="" target="_top"><span>Great ideas</span></a></li>
                </ul>
                <!-- / navigation -->          
          </div>
        </div>
      </div>

	
		
		<div id="profil-mainContainer">
			
			<div id="profil-overture">
		
			
					
				</div>
			</div>
			<!-- @End Bloc Overture -->
      
      
      <div id="profil-content">
        
	<?
	include("../db/db.php");

    $suid = $_GET['email'];
    $suid = strtolower($suid); 
    $sverify = trim($_GET['verify']);
    $sql = "SELECT semail FROM nlsubscribe WHERE LOWER(semail) = '$suid' AND TRIM(verify) = '$sverify'";

   $result = pg_query($sql) ;
    if (!$result) {
	echo "An error occured.\n";
	exit;
	}


   if (pg_num_rows($result) == 1) {
	   $sc = 1;
      pg_query("update  nlsubscribe set is_active='$sc' where LOWER(semail)= '$suid' and verify = '$sverify'");
	  ?>
	  <tr>
            <td><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Thank 
              you for verifying!  <br><br>
              </font></td>
          </tr>

<tr>
            <td align="center"><font color="#ffffff" size="2" face="Verdana, Arial, Helvetica, sans-serif"><br><br>Do you want help? We are online at <br>
            </font><font color="#FF0000" size="2" face="Verdana, Arial, Helvetica, sans-serif"><br>
              <font color="#000000">Call</font> </font><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><span class="style2">-</span> 00 966 667 9100 <br></font><font color="#FF0000" size="2" face="Verdana, Arial, Helvetica, sans-serif">( Timings: 9:00 AM - 07:00 PM  ) <br>
              <font color="#000000">Email</font> </font><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><span class="style2">-</span> it@dheyafataj.com </font><font color="#FF0000" size="2" face="Verdana, Arial, Helvetica, sans-serif"><br>
              <font color="#000000">MSN Messanger</font> </font><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><span class="style2">-</span> <span class="style1">deyafahsales@gmail.com</span></font><font color="#FF0000" size="2" face="Verdana, Arial, Helvetica, sans-serif"><br>
              <font color="#000000">Yahoo! -</font> </font><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><span class="style1">dheyafataj</span> </font></td>
          </tr>
				  <?
   }
   else {
?>

 <tr>
            <td><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Your Email Verification has been failed!   <br><br>
              </font></td>
          </tr>

<tr>
            <td align="center"><font size="4" face="Verdana, Arial, Helvetica, sans-serif"><br><br> Please contact our Administration people for requesting email again inorder to activate your userid.<br><br>
              </font></td>
          </tr>
<tr>
            <td align="center"><font color="#ffffff" size="2" face="Verdana, Arial, Helvetica, sans-serif"><br><br>Do you want help? We are online at <br>
            </font><font color="#FF0000" size="2" face="Verdana, Arial, Helvetica, sans-serif"><br>
              <font color="#000000">Call</font> </font><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><span class="style2">-</span> 00 966 667 9100 <br></font><font color="#FF0000" size="2" face="Verdana, Arial, Helvetica, sans-serif">( Timings: 9:00 AM - 07:00PM ) <br>
              <font color="#000000">Email</font> </font><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><span class="style2">-</span> it@dheyafataj.com </font><font color="#FF0000" size="2" face="Verdana, Arial, Helvetica, sans-serif"><br>
              <font color="#000000">MSN Messanger</font> </font><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><span class="style2">-</span> <span class="style1">deyafahsales@gmail.com</span></font><font color="#FF0000" size="2" face="Verdana, Arial, Helvetica, sans-serif"><br>
              <font color="#000000">Yahoo! -</font> </font><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><span class="style1">dheyafataj</span> </font></td>
          </tr>
<?
   }


	?>
		
	</table>
      </center>
</td></tr></table>


      
			</div>
			<!-- @End Bloc Content -->
		
		</div>
		<!-- @End Bloc mainContainer -->
