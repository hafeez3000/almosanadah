<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<title>Dar Al Manansek - Dar Al Manasek Hotel Makkah</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="Content-language" content="en" />

<!-- start CSS -->
<link rel="stylesheet" href="css/profil-registration-structure.css" type="text/css" media="all" />
<link rel="stylesheet" href="css/profil-registration-couleur.css" type="text/css" media="all" />
<link type="text/css" rel="stylesheet" media="screen" href="css/bandeau_cr.css" />
<!-- end CSS -->

    <style type="text/css">

        #page #profil-overture{background: url(images/profil/dheyafataj_hotel.jpg) no-repeat;}

            </style>

<!-- start javascript -->
<script type="text/javascript" src="javascripts/prototype.js"></script>
<script type="text/javascript" src="javascripts/tooltipAH.js"></script>
 <SCRIPT LANGUAGE="JavaScript1.1" SRC="../javascripts/FormChek.js"></SCRIPT>

	
<body id="profil-registration" >
	<div id="page" >
			<div id="profil-bandeau">
        <div id="bandeau_cr">
          <div id="header_cr">
            <a class="logo_cr" href="http://www.dheyafataj.com" target="_top"><img src="images/logo.png" alt="Dar Al Manasek" /></a>
              <p class="slogan_cr"><strong>DAR AL MANASEK <br>It's pleasure to serve you!</strong></p>					

                <ul id="languageSelection_cr">
                  <li><a href="#" lang="ar" ><img src="images/arabic.jpg" alt="Arabic" /></a></li> 
                </ul>	
      
                <!-- start navigation -->
                <ul id="navigation_cr" class="items4 navigation">
                  <li><a href="http://www.dheyafataj.com/" target="_top"><span>Welcome</span></a></li>
                  <li class="deuxLignes"><a href="" target="_top"><span>Search and book a hotel</span></a></li>
                  <li><a href="damtuhotel.php" target="_top"><span>Dar Al Manasek Hotel</span></a></li>
                  <li><a href="greatdeals.php" target="_top"><span>Great deals</span></a></li>
                </ul>
                <!-- end  navigation -->          
          </div>
        </div>
      </div>

	
		
<div id="profil-mainContainer">
  <div id="profil-overture">
	</div>
</div>

<!-- @End Bloc Overture -->
	
			<div id="profil-content">


			     <script type="text/javascript">window.onload = function(){window.onload; initialize()} </script> 


	<meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=true"></script>
<script type="text/javascript">
  function initialize() {
	  // var logitude=<?php echo $longitude ?>;
		// var latiude=<?php echo $latitude ?>;
  var logitude=21.413010;
       var latiude=39.821540;
    var latlng = new google.maps.LatLng(logitude, latiude);
    var myOptions = {
      zoom: 17,
      center: latlng,
      
          navigationControl: true,
    navigationControlOptions: 
    {style: google.maps.NavigationControlStyle.SMALL,
    position: google.maps.ControlPosition.TOP_LEFT
    },
       mapTypeControl: true,
    mapTypeControlOptions: 
    {style: google.maps.MapTypeControlStyle.DROPDOWN_MENU, 
     position: google.maps.ControlPosition.LEFT
    },


      mapTypeId: google.maps.MapTypeId.HYBRID
    };
   
      
    var map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);

  var html ='<font style="font-family: Verdana,Arial,Helveticaans-serif;font-size:11px;"><div  style=float:left;padding-right:5px></div><div style=float:left ><a href=http://www.dheyafataj.com><b>MAKKAH DAR AL MANASEK HOTEL</b></a><br> Misfala, Beside NCB, Ibrahim Al Khaleel Street<br /> Makkah-21955, Saudi Arabia. <br /> T: 00966 2 5394444, F: 00966 2 5403848 </div></font>' ;

   
	  var marker = new google.maps.Marker({
        position: latlng, 
        map: map
    });


	 var infowindow = new google.maps.InfoWindow(
    { content: html,
        size: new google.maps.Size(25,25),
        position: latlng
    });
  infowindow.open(map);

 google.maps.event.addListener(marker, 'click', function() {
    infowindow.open(map,marker);
  });




  }

</script>

			
		
				
				<h1><span class="titleNumberOn"></span>MAKKAH DAR AL MANASEK HOTEL ****</h1>
				<div class="separateur"></div>
				
				<fieldset class="fieldset-container" id="fieldset1">

					<div class="left-col">
						
						<table cellpadding="0" cellspacing="0">			
							<tr id="user-civility-container">
								<td class="libelle"><label for="user-civility">
                
              Misfala, Beside NCB,<br />
Ibrahim Al Khaleel Street<br />
P.O.Box: 51101 Makkah - 21955.<br />
KINGDOM OF SAUDI ARABIA<br />
T: 00966 2 5394444<br />
F: 00966 2 5403848<br />
                
                </label></td>
							</tr>
              
						  						
													
						
						</table>
					</div>
					
					<div class="right-col">
						<table cellpadding="0" cellspacing="0" >			
						
            	<tr id="user-email-container">
								<td  >
                
						 <div id="map_canvas" style="width:400px; height: 200px"  ></div>
             
             </td>

						
							</table>							
					</div>
				</fieldset>

				
            
            

             

				
				<div class="separateur"></div>
        



   

				
	    
                	<link rel="stylesheet" href="css/profil-footer.css">
           
			</div>
			<!-- @End Bloc Content -->
		
		</div>
		<!-- @End Bloc mainContainer -->
		
			
	





		<!-- @End Tooltip Contents -->
	</div>
	<!-- @End Bloc Page -->


<script>  
   function valf(theForm){
     
   
     
     if(isLetter(document.newUser1.user_name.value)){ 
      if((document.newUser1.user_name.value.length < 6) || (document.newUser1.user_name.value.length > 150 )){
        document.getElementById("txtHint").innerHTML="Enter your Frist Name  more than 6 characters";
        document.newUser1.user_name.style.background = '#FFAAAA';
        document.newUser1.user_name.focus();
        return false;
       }
       document.newUser1.user_name.style.background = 'White';
      }
    else{
      document.getElementById("txtHint").innerHTML="Enter your  Name ";
      document.newUser1.user_name.style.background = '#FFAAAA'
      document.newUser1.user_name.focus();
      return false;
    }
      
 
    if(isEmail(document.newUser1.user_email.value)){ 
      document.newUser1.user_email.style.background = 'White';
      }
    else{
    document.getElementById("txtHint").innerHTML="Enter your Valid Email Address";
    document.newUser1.user_email.style.background = '#FFAAAA';
    document.newUser1.user_email.focus();
    return false;
    } 
                                                     



    if (document.newUser1.user_subject.value == "-") 
    {
      document.getElementById("txtHint").innerHTML="Select your message type";
      document.newUser1.user_subject.style.background = '#FFAAAA';
      document.newUser1.user_subject.focus();
      return false;
    
    }
    else {
      document.newUser1.user_subject.style.background = 'White';
    }
   
if(isLetter(document.newUser1.user_messagetext.value)){ 
  if(document.newUser1.user_messagetext.value.length < 6 ){
    document.getElementById("txtHint").innerHTML="Enter your message  more than 6 characters";
    document.newUser1.user_messagetext.style.background = '#FFAAAA';
    document.newUser1.user_messagetext.focus();
    return false;
  }
  document.newUser1.user_messagetext.style.background = 'White';
  }
  else{
  document.getElementById("txtHint").innerHTML="Enter your message";
  document.newUser1.user_messagetext.style.background = '#FFAAAA';
  document.newUser1.user_messagetext.focus();
  return false;
}    


if ((document.newUser1.recaptcha_response_field.value == null) || ((document.newUser1.recaptcha_response_field.value).length==0))
    {
      document.getElementById("txtHint").innerHTML="Enter the CAPTCHA";
      document.newUser1.recaptcha_response_field.style.background = '#FFAAAA';
      document.newUser1.recaptcha_response_field.focus();
      return false;
    
    }      
    else {
      
      
       document.newUser1.recaptcha_response_field.style.background = 'White';
      
    }

    





}

</script>


</body>
</html>
