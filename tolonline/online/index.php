<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" id="en" lang="en">
	<head>
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />
  <title>
      Dar Al Manasek - Leading Five Star Hotels provider in Kingdom of Saudi Arabia
  </title>
  
  <meta http-equiv="content-type" content="application/xhtml+xml; charset=UTF-8" />
  <meta name="author" content="daralmanasek.com" />
  <meta name="keywords" content="Dar Al Manasek, Online reservation system, Saudi Arabia Hotels,Saudi Arabia, Makkah, Madinah, Jeddah, Riyadh, Hotels, Cars, Umrah, Hajj" />
  <meta name="description" content="Leading tourism and pilgrimage service provider in Kingdom of Saudi Arabia, at our site, Go virtual anywhere in Kingdom of Saudi Arabia - Hotels, Cars, Umrah, Hajj, Tourism! – Dar Al Manasek Tourism and Umrah – Its pleasure to serve you" />
  <meta name="robots" content="index, follow, noarchive" />

  <meta name="googlebot" content="noarchive" />
  
 

		
    <link rel="shortcut icon" type="image/x-icon" href="images/favicon/favicon.ico" />
    
		<link type="text/css" rel="stylesheet" media="screen" href="css/template.css" />


		<link type="text/css" rel="stylesheet" media="screen" href="css/screen.css" />
  	<link type="text/css" rel="stylesheet" media="screen" href="css/bandeau.css" />

 		<link type="text/css" rel="stylesheet" media="screen" href="css/footer.css" />
  	<link type="text/css" rel="stylesheet" media="screen" href="css/moteur.css" />
		<link type="text/css" rel="stylesheet" media="print" href="css/print.css" />
		
		<link href="css/calendar.css" rel="stylesheet" type="text/css" />
		
		<link type="text/css" rel="stylesheet" media="screen" href="css/home.css" />
		
		<link rel="stylesheet" href="css/autocompletion.css" type="text/css" media="all" />
    
 
    		
  
    <script type="text/javascript" src="javascripts/prototype.js"></script>	
 

    <script type="text/javascript" src="javascripts/init-onglets.js"></script>
    <SCRIPT LANGUAGE="JavaScript1.1" SRC="../javascripts/FormChek.js"></SCRIPT>

   
 		
	</head>
	<body id="home">
	
		<!-- conteneur -->
		<div id="conteneur">	
		
			<!-- accessNav -->

			<ul id="accessNav">
				<li><a href="#navigation">main browser</a></li>
				<li><a accesskey="s" href="#core">content</a></li>
				<li><a accesskey="4" href="#search">booking form</a></li>
			</ul>
			<!-- / accessNav -->
			
			<!-- header -->

			<div id="header">
				<a class="logo" href="http://www.daralmanasek.com/"><img src="images/logo.png" alt="Dar Al Manasek" /></a>
				<p class="slogan"><strong>DAR AL MANASEK <br>It's pleasure to serve you!</strong></p>					

				<ul id="languageSelection">
            <li><a href="#" lang="ar" ><img src="images/arabic.jpg" alt="Arabic" /></a></li> 
						
				</ul>
				
				<div id="account">

						<h2>My daralmanasek.com</h2>	
						<div id="bloc_not_ident">		
							<ul>
								<li><a href="contactus.php"  >Contact Us</a></li>                              
								<li><a href="javascript:window.open('advantages.php','','width=565px,height=660px');void(0);"  >Why register?</a></li>                              
								<li><a href="newreg.php"  >Register</a></li>
								<li><a href="login.php">Login</a></li> 
							</ul>
						</div>
						<div id="bloc_ident" style="display:none;">		
							<ul>     
                            
                <li id="header_profil"><span id="profile-template"><strong>Hello #{name}</strong></span></li>

								<li><a href=""  >My favourite hotels</a></li>
								<li><a href=""  >My account</a></li>
								<li><a href="">Log out</a></li>                                
							</ul> 
						</div>			
				</div>	
			</div>
			<!-- / header -->
			
			<!-- globalContent -->

			<div id="globalContent">
				<!-- globalContentBg -->
				<div id="globalContentBg">
				
					<!-- search -->
					<div id="search">
						
							<!-- searchForm -->
							<div id="searchForm">		
								<h2><span>Search and book a hotel</span></h2>
									<ul>

									<li id="classicLink" class="activeItem"><a href="#form_classic">By destination</a></li>
									<li id="expressLink"><a href="#form_express">Express Booking</a></li>
								</ul>
                <form name="ETP_BOOKING_CLASSIC" id="form_classic" action="javascript:submitFormBean('label_ok','label_ko','/beginSubCro.svlt',$('form_classic'),null,'setDefaultValuesAfterValidatorReturn(\'ETP_BOOKING_CLASSIC\')');" method="post">
    <input name="code_chaine" value="ETP" type="hidden" />

        <div id="errorMessage_ETP_BOOKING_CLASSIC" class="label_ko" style="display:none"></div>
        
        <div class="fieldset first">

            <fieldset>
                <legend class="hidden"></legend>
                <div class="ligne">
                    <label for="hotel_ou_ville1" id="l_hotel_ou_ville1">Your destination</label>
                    <div class="c_text" id="c_hotel_ou_ville1"><input type="text" name="hotel_ou_ville" id="hotel_ou_ville1" value="City, country or hotel code"  size="25" /></div>
                </div>
            </fieldset>
        </div>

        
       <div class="fieldset">
            <fieldset>
                <legend class="hidden"></legend>   
                <span class="facultatif"><span>optional</span></span>
                <div id="bloc_date">
                    <div class="ligne">
                        <label for="arrivee1">Arrival date:</label>
												<div class="c_text" id="c_arrivee1"><input type="text" name="arrivee" id="arrivee1" size="14" /></div>

                    </div>
                    <div class="ligne" id="bloc_date_arrivee_img1">
                    	<img src="images/picto_calendrier.gif" alt="Schedule" id="date_arrivee_img1" />    
                    	<input type="hidden" name="jour_arrivee"  id="jour_arrivee1" />
                    	<input type="hidden" name="mois_arrivee"  id="mois_arrivee1" />
                    	<input type="hidden" name="annee_arrivee" id="annee_arrivee1" />    	
                    	<span class="jour"></span> <span class="date"></span>
                    </div>
                    <div class="ligne"> 
                    	<label for="nb_nuit1">Nights:</label>

                    	<select name="nb_nuit" id="nb_nuit1" class="">
                    		<option value="">-</option>
                    	</select>                
                    </div>           
                 </div>
                 <div id="depart1" style="display:none;">
                        <span>Departure date:</span> <span class="jour"></span> <span class="date"></span>
                    </div>

                
       
                <div class="ligne">
                    <label for="code_avantage" id="l_code_avantage">Preferential code</label>
										<div class="c_text" id="c_code_avantage"><input name="code_avantage" type="text" id="code_avantage" value="Code N&deg;" /></div>
                </div>

            </fieldset>
        </div>
        
        <div class="actions">
            <input type="submit"  name="bt_classic" id="bt_classic" value="Search" onClick="xt_med('C',2,'homepage::moteur::reservez','N')" />

            <a id="action_consulter" href="" >Consult/Cancel a booking</a>
         </div>
        <!--input type="checkbox" id="code_preferentiel" name="code_preferentiel" /--> 
        <!--label for="code_preferentiel">Code préférentiel</label--> 
 
</form> 
                 <form  style="display:none;" name="ETP_BOOKING_EXPRESS" id="form_express" action="javascript:submitFormBean('label_ok','label_ko','/beginSubCro.svlt',$('form_express'),null,'setDefaultValuesAfterValidatorReturn(\'ETP_BOOKING_EXPRESS\')');" method="post">
    <input name="code_chaine" value="ETP" type="hidden" />
    <input name="servlet_action" value="availability" type="hidden" />  
       

        <div id="errorMessage_ETP_BOOKING_EXPRESS" class="label_ko"></div>
        <div id="errorRechGeo" class="label_ko" style="display:none"></div>

        
        <div class="fieldset first">
            <fieldset>
                <legend class="hidden"></legend>
                <div class="ligne">
                    <label id="l_nom_ville" for="nom_ville">Your destination</label>
                    <div class="c_text" id="c_nom_ville"><input type="text" name="nom_ville" id="nom_ville" value="City, Country" /></div>
                    <input type="button" name="geo_search" id="geo_search" value="ok" />
                    
                    <label for="hotel_ou_ville2" id="l_hotel_ou_ville2">Your hotel</label>

                    <select disabled="true" id="hotel_ou_ville2" name="hotel_ou_ville">
                        <option value="">choose a hotel</option>
                    </select>
                </div>
            </fieldset>
        </div>
        <div class="fieldset">
            <fieldset>

                <legend class="hidden"></legend>
                <div class="ligne">
                    <label for="arrivee2" id="l_arrivee2">Arrival date:</label>
										<div class="c_text" id="c_arrivee2"><input type="text" name="arrivee" id="arrivee2" /></div>
                     		<img src="images/picto_calendrier.gif" alt="schedule" id="date_arrivee_img2" />	
                        <input type="hidden" name="jour_arrivee"  id="jour_arrivee2" />
                      	<input type="hidden" name="mois_arrivee"  id="mois_arrivee2" />
                      	<input type="hidden" name="annee_arrivee" id="annee_arrivee2" />    	
                      	<span class="jour"></span> <span class="date"></span>

                </div>          
                <div id="bloc_personne">
                    <div class="ligne">                     
                        <label for="nb_nuit2">Nights</label>
                        <select id="nb_nuit2" name="nb_nuit">
                            <option value="">-</option>
                        </select>
                    </div>
                    <div class="ligne">

                        <label for="nb_personne">People</label>
                        <select id="nb_personne" name="nb_personne">
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                        </select>                  
                    </div>

                </div>

		            <div class="ligne" id="depart2" style="display:none;">
		               <span>Departure date:</span> <span class="jour"></span> <span class="date"></span>
		            </div>

                <div class="ligne" id="bloc_bar">
                    <input type="button" id ="bar_but" value="See the best price" disabled="true" onClick="xt_med('C',2,'homepage::moteur::afficher_prix','N')" />

                    <span class="bulle_aide" style="display:none;" id="bulle_meilleur_prix"><img src="images/picto_aide.gif" alt="Prices indicated are of course per night and per room, for one person, on the date (s) previously chosen. For local taxes, please consult tax details.  
										Foreign currency conversion is only indicative and not binding.  
										Only currency confirmed during your booking is guaranteed." /></span>			                                                     
	                  <select id="s_devise" name="s_devise"></select>
	                  <label for="s_devise" id="affich_bar"></label>	
	              </div>
	  				</fieldset>                   
            </div>
            <div class="fieldset last">
                <fieldset>
                    <legend class="hidden"></legend>
										<span class="facultatif"><span id="facultatif_2">optional</span></span>                              
                    <!--input type="checkbox" id="code_preferentiel" name="code_preferentiel" /--> 
                    <!--label for="code_preferentiel">Code préférentiel</label--> 
                    <div class="ligne" id="code2">               
                        <label for="code_avantage2" id="l_code_avantage2">Preferential code</label>	
                        <div id="c_avantage2" class="c_text"><input name="code_avantage" type="text" id="code_avantage2" value="Code N&deg;" /></div>

					
                        <input type="submit" name="bt_express" id="bt_express" value="Book" onClick="xt_med('C',2,'homepage::moteur::reservez_express','N')" />
                    </div>
                </fieldset>
            </div>                                              
	</form>
              </div>                                    
							<!-- / searchForm -->
							
							
							<!-- searchAdvanced --> 
															<div id="searchAdvanced">
								<ul>

									<li id="searchAdvanced_carte">
										<a href=""><strong>Find on a map</strong></a>
									</li>
									<li id="searchAdvanced_itinairaire">
										<a href=""><strong>On your itinerary</strong></a>
									</li>
									<li id="searchAdvanced_interets">
										<a href=""><strong>Near a point of interest</strong></a>

									</li>		
									<li id="searchAdvanced_adresse">
										<a href=""><strong>Near an address</strong></a>
									</li>		
									<li id="searchAdvanced_liste">
										<a href=""><strong>Alphabetical list</strong></a>
									</li>								
								</ul>
							</div> 
							<!-- / searchAdvanced -->

					</div>
					<!-- search -->
				
				
					<!-- core -->
					<div id="core">
					
						<!-- navigation -->
						<ul id="navigation" class="items4 navigation">
							<li class="activeItem"><strong><span>Welcome</span></strong></li>
							<li><a href=""   ><span>Search and book a hotel</span></a></li>

							<li><a href="damtuhotel.php"  ><span>Dar Al Manasek Hotel</span></a></li>
							<li><a href="howitworks.php"  ><span>How it Works ?</span></a></li>
						</ul>
						<!-- / navigation -->
						
						
						<!-- content -->
						<div id="content">
                        
              <h1 class="hidden">Dar Al Manasek</h1>

                            
							<!-- push animation -->
							<div id="pushFlash">
								
                <object width="665" height="240">
<param name="movie" value="images/dorsmain.swf">
<embed src="images/dorsmain.swf" width="665" height="240">
</embed>
</object>
              			
							</div>
							<!-- / push animation -->
			
								<div class="col1">
									<!-- bloc actus -->
									<div id="actus-noh">
										<div id="actus-noh">
<div class="affichage2">
<h2><a href="damtuhotel.php" target="_blank">Dar Al Manasek Makkah Hotel, Makkah - 4 Star </a></h2>
<img src="images/daralmanasek.jpg" alt="Dar Al Manasek" />

<div class="texte-noh">
<h3>Dar Al Manasek Makkah</h3>
<p class="accroche-noh">Ibrahim Al Khalil Street</p>
<p class="description-noh">
Just 600mts away from Holy-Haram, frequent shattle service.
</p>
<a href="damtuhotel.php" target="_blank"><strong>Learn more</strong></a>
</div>
</div>
</div>
                                          
									</div>

									<!-- bloc actus -->
										
									<!-- espace formule1 -->
									<div id="espFormule1-noh">	
										<!-- bloc infos -->
<div class="affichage2">
<h2><a href="damcat/index.html" target="_top">Dar Al Manasek Catering Services</a></h2>
<img src="images/catering.jpg" alt="Dar Al Manasek Catering" />
<div class="texte-noh">
<h3>With Passion, Experience & Creativity we have the perfect formula...</h3>
<p class="description-noh">
Weddings, Buffets, Dinners, Farewells & Business Lunches, Conferences and much more
</p>

<a href="damcat/index.html" target="_top"><strong>Discover our Catering Services</strong></a>
</div>
</div>
                                        
									</div>
									<!-- / espace formule1 -->			
								</div>	
					
					
								<div class="col2">
									<!-- espace bons plans --> 
									
                    <div id="bonsPlans-noh">
<div class="title-noh">
<h2><a target="_top" href="greatdeals.php">Discover our great deals</a></h2>
</div>
<div id="offers-noh">
<div id="scrollZone">
<ul id="scrollZoneList">
</ul>

</div>
</div>


</div>
<img src="images/great_deals_animation.gif" width="275" height="195" >
									<!-- / espace bons plans -->
									
									<!-- bloc nbewsletter --> 
										<script type="text/javascript" src=""></script>

<div id="insNewsletter">
    <form id="newsletter"  name="newsletter" method="post" action="newslettera.php">
    <label for="c_insNewsletter">All the Great ideas in our newsletter</label>
		<div class="ligne">
     <script type="text/javascript">
            //temp
                // var = d_profileData;       
                var d_profileData;
				        var libelleMail="E-mail address";
				        if (d_profileData != null) {
				        if(d_profileData.email==''){
				        	document.write('<input id="c_insNewsletter" type="text" name="email" size="15" value="'+libelleMail+'" onfocus="javascript:delete_label()" />');
				        }
				        else{
				        	document.write('<input id="c_insNewsletter" type="text" name="email" size="15" value="'+d_profileData.email+'" disabled="disabled" />');
				        }
				        }else{
				        document.write('<input id="c_insNewsletter" type="text" name="email" size="15" value="'+libelleMail+'" onfocus="javascript:delete_label()" />');
				        }
				 </script>

         <input value="ok" type="submit" id="submit" name="submit"   onclick="return valf(this);" />
		</div>
	</form>

<script>

    function valf(theForm){
      if(isEmail(document.newsletter.email.value)){ 
        document.newsletter.email.style.background = 'White';
      }
      else{
        alert("Enter your Valid Email Address");
        document.newsletter.email.style.background = '#FFAAAA';
        document.newsletter.email.focus();
        return false;
    } 
 }

</script>

</div> 
									<!-- /bloc nbewsletter -->
								
								</div>
								
								



								<!-- nouveaux hotels -->
								<div id="listeNouveuxHotels-noh">
									<!-- bloc ouvertures -->
<h2 class="titre-noh">DORS special offers</h2>
<div class="col">
<h3 class="pays-noh">
Makkah
</h3>
<ul class="listeHotels-noh">

<li>
<a href="#">Grand Zam Zam</a>
</li>
<li>
<a href="#">Makkah Hilton Towers</a>
</li>
<li>
<a href="#">Makkah Clock Royal Towers</a>
</li>
</ul>
</div>
<div class="col">
<h3 class="pays-noh">
Madinah
</h3>
<ul class="listeHotels-noh">
<li>
<a href="">Dar Al Iman</a>

</li>
<li>
<a href="">Anwar Al Madinah Movenpick</a>
</li>
<li>
<a href="">	Dyar International Hotel</a>
</li>
</ul>
</div>
<div class="col">
<h3 class="pays-noh">
Jeddah
</h3>
<ul class="listeHotels-noh">
<li>

<a href="">Hilton Jeddah</a>
</li>
<li>
<a href="">Intercontinental Jeddah</a>
</li>
<li>
<a href="">Crown Plaza Jeddah</a>
</li>
<li>
<a href="">Red Sea Palace</a>
</li>

	
</ul>
</div>
<a href="" class="lienAll-noh"><span>See all the hotels</span></a>

								</div>

								<!-- / nouveaux hotels -->

						</div>
						<!-- content -->
					</div>
					<!-- / core -->
                    
				</div>
				<!-- / globalContentBg -->
			</div>

			<!-- / globalContent -->
			
			
			<!-- footers -->
			<div id="footers">
                          
        <!-- footer  -->
				<div id="footer">
						<ul>		
							<li class="first"><a href="" >Help</a></li>	
              <li><a href="contactus.php" >Contact Us</a></li>
							<li><a href="" >Legal information</a></li>
							<li><a href=""  >Newsletter subscription</a></li>
							<li><a href="http://www.facebook.com/profile.php?id=113050495417547" target="_blank"  ><img src="images/Facebook_logo.jpg" border="0" >Become a Fan, Facebook</a></li>
							<li><a href="http://www.twitter.com/daralmanasek" target="_blank"  ><img src="images/Twitter_logo.jpg" border="0" >Follow Us, Twitter</a></li>

							
						</ul>						
				</div>
				<!-- / footer -->
				
				
				<!--  footer SEO -->
				<div id="footer-seo">
					<div id="listeVille">
            <p class="description">

                
At our web site, Go virtual anywhere in Kingdom of Saudi Arabia - Hotels, Cars, Umrah, Hajj, Tourism! 
            </p>
  
					</div>
					<div id="listeHotels" >

						<ul>
							<li><a href="#" target="_blank" >Hotel Bookings</a></li>
							<li><a href="#" target="_blank" >Umrah</a></li>
							<li><a href="#" target="_blank" >Hajj</a></li>
							<li><a href="#" target="_blank" >Transfers</a></li>
							<li><a href="contactus.php" target="_blank" >Contact Us</a></li>
						</ul>
					</div>			
				</div>
				<!-- / footer SEO -->

				<p id="copyright"> &copy; <?php 
$copyYear = 1992; 
$curYear = date('Y'); 
echo $copyYear . (($copyYear != $curYear) ? ' - ' . $curYear : '');
?>  Dar Al Manasek</p>
             
             
			</div>
			<!-- / footers -->									
		</div>
		<!-- / conteneur -->
		
		
	<!-- GOOGLE ANALYTICS -->
<script type="text/javascript">
	var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
	document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
</script>
<script type="text/javascript">
	try {
		var pageTracker = _gat._getTracker("UA-12640304-1");
		pageTracker._trackPageview();
	} catch(err) {}
</script>
<!-- END GOOGLE ANALYTICS -->
		
	
	</body>
</html>
