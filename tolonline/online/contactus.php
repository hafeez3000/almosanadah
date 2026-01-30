<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<title>Dar Al Manansek - Contact us</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="Content-language" content="en" />

<!-- start CSS -->
<link rel="stylesheet" href="css/profil-registration-structure.css" type="text/css" media="all" />
<link rel="stylesheet" href="css/profil-registration-couleur.css" type="text/css" media="all" />
<link type="text/css" rel="stylesheet" media="screen" href="css/bandeau_cr.css" />
<!-- end CSS -->

    <style type="text/css">

        #page #profil-overture{background: url(images/profil/img_contactus.jpg) no-repeat;}

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
            <a class="logo_cr" href="http://www.daralmanasek.com" target="_top"><img src="images/logo.png" alt="Dar Al Manasek" /></a>
              <p class="slogan_cr"><strong>DAR AL MANASEK <br>It's pleasure to serve you!</strong></p>					

                <ul id="languageSelection_cr">
                  <li><a href="#" lang="ar" ><img src="images/arabic.jpg" alt="Arabic" /></a></li> 
                </ul>	
      
                <!-- start navigation -->
                <ul id="navigation_cr" class="items4 navigation">
                  <li><a href="http://www.daralmanasek.com/" target="_top"><span>Welcome</span></a></li>
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
<form id="newUser1" name="newUser1"  method="post" action="contactusa.php"  >


				<p>
					We put customer first, and we customized various ways to reach us.
				</p>
     <script type="text/javascript">window.onload = function(){window.onload; initialize()} </script> 


	<meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=true"></script>
<script type="text/javascript">
  function initialize() {
	  // var logitude=<?php echo $longitude ?>;
		// var latiude=<?php echo $latitude ?>;
  var logitude=21.52797567543267;
       var latiude=39.1814249753952;
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

  var html ='<font style="font-family: Verdana,Arial,Helveticaans-serif;font-size:11px;"><div  style=float:left;padding-right:5px></div><div style=float:left ><a href=http://www.daralmanasek.com><b>Dar Al Manasek Tourism & Umrah</b></a><br>201, Gulf Center, Madinah Road,<br /> Jeddah-21418, Saudi Arabia</div></font>' ;

   
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

			
		
				
				<h1><span class="titleNumberOn">1</span>. Address</h1>
				<div class="separateur"></div>
				
				<fieldset class="fieldset-container" id="fieldset1">

					<div class="left-col">
						
						<table cellpadding="0" cellspacing="0">			
							<tr id="user-civility-container">
								<td class="libelle"><label for="user-civility">
                
                Head Office:<br />
201, Gulf Center, Madinah Road,<br />
P.O. Box 31646, Jeddah -21418.<br />
KINGDOM OF SAUDI ARABIA<br />
Tel: 00966 2 6679100 <br />
Fax: 00966 2 6679096<br />
                
                </label></td>
							</tr>
              
								<tr id="user-civility-container">
								<td class="libelle"><label for="user-civility">
                
                Office Working Hours: 09:00 AM - 07:00 PM ( Sat - Thu )
                
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

				
				
				<h1><span class="titleNumberOn">2</span>.Email list</h1>
				<div class="separateur"></div>
				
				<fieldset class="fieldset-container" id="fieldset2">
					<div class="left-col">
						
						<table cellpadding="0" cellspacing="0">		
							<tr id="user-companyName-container">
									<td class="libelle"><label for="user-companyName">Reservations Department
                  </label></td>
									<td class="libelle"><a href="mailto:res@daralmanasek.com">
              res@daralmanasek.com</a>      
									</td>
								</tr>	

										<tr id="user-companyName-container">
									<td class="libelle"><label for="user-companyName">Umrah Department
                  </label></td>
									<td class="libelle"><a href="mailto:umrah@daralmanasek.com">
              umrah@daralmanasek.com</a>      
									</td>
								</tr>					
									<tr id="user-companyName-container">
									<td class="libelle"><label for="user-companyName">Admin Department
                  </label></td>
									<td class="libelle"><a href="mailto:admin@daralmanasek.com">
              admin@daralmanasek.com</a>      
									</td>
								</tr>	
                <tr id="user-companyName-container">
									<td class="libelle"><label for="user-companyName">Accounts Department
                  </label></td>
									<td class="libelle"><a href="mailto:accounts@daralmanasek.com">
              accounts@daralmanasek.com</a>      
									</td>
								</tr>	
							</table>
					</div>

					<div class="right-col">
						<table cellpadding="0" cellspacing="0">			
							
          
              
          
							
					              
             						</table>						
					</div>
				</fieldset>

			

		<h1><span class="titleNumberOn">3</span>. Mobile Number list</h1>
				<div class="separateur"></div>
				
				<fieldset class="fieldset-container" id="fieldset2">
					<div class="left-col">
						
						<table cellpadding="0" cellspacing="0">		
							<tr id="user-companyName-container">
									<td class="libelle"><label for="user-companyName">Syed Meer (Reservations Manager)
                  </label></td>
									<td class="libelle">00966 508372732      
									</td>
								</tr>	
							<tr id="user-companyName-container">
									<td class="libelle"><label for="user-companyName">Mohammed Husny(Reservation Dept)
                  </label></td>
									<td class="libelle">00966 568650718 / 515044161  
									</td>
								</tr>	

										<tr id="user-companyName-container">
									<td class="libelle"><label for="user-companyName">Mahamood Bawazir (Accounts Department)
                  </label></td>
									<td class="libelle">00966 507639947 / 506694556 / 515052574     
									</td>
								</tr>					
	<!--										<tr id="user-companyName-container">
									<td class="libelle"><label for="user-companyName">Ahmad Al Nashawati (Reservations Department)

                  </label></td>
									<td class="libelle">00966  0506181836     
									</td>
								</tr>	
      -->    
          </table>
					</div>

					<div class="right-col">
						<table cellpadding="0" cellspacing="0">			
							<!--	
          			<tr id="user-companyName-container">
									<td class="libelle"><label for="user-companyName">Waheed Anjum (Reservations Department)
                  </label></td>
									<td class="libelle">00966 555386128      
									</td>
								</tr>	

										<tr id="user-companyName-container">
									<td class="libelle"><label for="user-companyName">Mohammed Hosny (Reservation Department)
                  </label></td>
									<td class="libelle">00966 553699309      
									</td>
								</tr>					
 --> 
              	          
							
					              
             						</table>						
					</div>
				</fieldset>


	<h1><span class="titleNumberOn">4</span>. Internet Messenger Chat support</h1>
				<div class="separateur"></div>
				
				<fieldset class="fieldset-container" id="fieldset2">
					<div class="left-col">
						
						<table cellpadding="0" cellspacing="0">		
							<tr id="user-companyName-container">
									<td class="libelle"><label for="user-companyName">Syed Meer (Reservations Manager)
                  </label></td>
									<td class="libelle">res@daralmanasek.com (MSN)      
									</td>
								</tr>	
		<!--					<tr id="user-companyName-container">
									<td class="libelle"><label for="user-companyName">Waheed Anjum (Reservations Department)
                  </label></td>
									<td class="libelle">waheed.anjum@daralmanasek.com(MSN)      
									</td>
								</tr>
                -->		
                        <tr id="user-companyName-container">
                            <td class="libelle"><label for="user-companyName">Mahamood Bawazir (Accounts Department)
                  </label></td>
                            <td class="libelle">accounts@daralmanasek.com(MSN)      
                            </td>
								</tr>



															</table>
					</div>

					<div class="right-col">
						<table cellpadding="0" cellspacing="0">			
					<!--		
          	<tr id="user-companyName-container">
									<td class="libelle"><label for="user-companyName">Mohammed Hosny (Reservations Department)
                  </label></td>
									<td class="libelle">mohd.hosny@daralmanasek.com (MSN)      
									</td>
								</tr>	
							<tr id="user-companyName-container">
									<td class="libelle"><label for="user-companyName">Ahmad Al Nashawati (Reservations Department)
                  </label></td>
									<td class="libelle">ahmad.alnashawati@daralmanasek.com (MSN)      
									</td>
								</tr>	

          -->    
          
							
					              
             						</table>						
					</div>
				</fieldset>


	<h1><span class="titleNumberOn">5</span>. We're Hiring</h1>
				<div class="separateur"></div>
				
				<fieldset class="fieldset-container" id="fieldset2">
					<div class="left-col">
						
						<table cellpadding="0" cellspacing="0">		
							<tr id="user-companyName-container">
									<td class="libelle" colspan="2"><label for="user-companyName">At Dar Al Manasek, we understand that our sevice success results from our diverse workforce.  You will find challenging work  and smart people with potential to change the booking / umrah & Hajj world.</td>
							</tr>
          						


															</table>
					</div>

					<div class="right-col">
						<table cellpadding="0" cellspacing="0">			
							
          	<tr id="user-companyName-container">
									<td class="libelle"><label for="user-companyName">Send your Latest Resume
                  </label></td>
									<td class="libelle"><a href="mailto:ceo@daralmanasek.com">ceo@daralmanasek.com </a>
									</td>
								</tr>	
					
              
          
							
					              
             						</table>						
					</div>
				</fieldset>


	<h1><span class="titleNumberOn">6</span>. See us on Social Networking sites</h1>
				<div class="separateur"></div>
				
				<fieldset class="fieldset-container" id="fieldset2">
					<div class="left-col">
						
						<table cellpadding="0" cellspacing="0">		
							<tr id="user-companyName-container">
									<td class="libelle" ><label for="user-companyName">Dar Al Manasek on Facebook
                  </td>
                  <td class="libelle"><a href="http://www.facebook.com/profile.php?id=113050495417547" target="_blank"><img src="images/facebook.jpg" border="0" ></a>

							</tr>
          				  	<tr id="user-companyName-container">
									<td class="libelle"><label for="user-companyName">Dar Al Manasek on Twitter
                  </label></td>
									<td class="libelle"><a href="http://www.twitter.com/daralmanasek" target="_blank"><img src="images/twitter.jpg" border="0" ></a>

									</td>
								</tr>	
					
		


															</table>
					</div>

					<div class="right-col">
						<table cellpadding="0" cellspacing="0">			
							
                      
          
							
					              
             						</table>						
					</div>
				</fieldset>


	<h1><span class="titleNumberOn">7</span>. Quick contact us form(* Compulsory information)</h1>
				<div class="separateur"></div>
				
				<fieldset class="fieldset-container" id="fieldset2">
					<div >
						
				
						<table cellpadding="0" cellspacing="0" >		
							<tr id="user-companyName-container">
									<td class="libelle" ><label for="user-companyName">Your Name *
                  </td>
                  <td class="libelle">	<input type="text" maxlength="150" id="user_name" name="user_name" value="" class="text" />
							</tr>

              <tr id="user-companyName-container">
									<td class="libelle" ><label for="user-companyName">Your Email *
                  </td>
                  <td class="libelle">	<input type="text" maxlength="150" id="user_email" name="user_email" value="" class="text" />
							</tr>
             <tr id="user-companyName-container">
									<td class="libelle" ><label for="user-companyName">Subject *
                  </td>
                  <td class="libelle">		<select id="user_subject" name="user_subject">
                  <option value="-">-</option>
                  <option value="Generic Information">Generic Information</option>
                  <option value="Reservation request">Reservation request</option>
                  <option value="Bookings cancellation">Bookings cancellation</option>
                  <option value="Suggestions">Banks / Corporates</option>
                  <option value="Tour Operators / Travel Agents">Tour Operators / Travel Agents</option>
                  <option value="Careers">Careers</option>

</select>

							</tr>


                <tr id="user-companyName-container">
									<td class="libelle" ><label for="user-companyName">Message Text *
                  </td>
                  <td class="libelle"><textarea rows="13" cols="57" name="user_messagetext" id="user_messagetext"></textarea> 	
                  </tr>


          				 
															</table>
					</div>

								</fieldset>


			        
         <script type="text/javascript">
 var RecaptchaOptions = {
    theme : 'clean'
 };
 </script>
        
           <?php
              require_once('recaptchalib.php');
              $publickey = "6LfxVrwSAAAAANsmnKqi0G19oZL-vKbs-xSUv5qU";
       
              echo recaptcha_get_html($publickey);

?>
  
             
            

             

				
				<div class="separateur"></div>
        

 <div   style="text-align:center;font-size:1.5em"> <span id="txtHint" style=" color:Red; "></span></div>



				<div class="submit-button-container">
    
					<span class="btn-submit top-right" id="submitForm">
              <a href="javascript:document.newUser1.submit()" onclick="return valf(this);"  >Confirm your contact form</a>
						<span class="btn-submit-left"></span>

					</span>
				</div>
    

				
				</form>
        
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
