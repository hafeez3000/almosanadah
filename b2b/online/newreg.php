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
  <!-- end CSS -->
	<script type="text/javascript" src="javascripts/prototype.js"></script>

  <script type="text/javascript" src="javascripts/tooltipAH.js"></script>
  <SCRIPT LANGUAGE="JavaScript1.1" SRC="../javascripts/FormChek.js"></SCRIPT>


<body id="profil-registration" onLoad="document.newUser1.user_civility.focus();">
	<div id="page" >
			<div id="profil-bandeau">
        <div id="bandeau_cr">
          <div id="header_cr">
            <a class="logo_cr" href="http://www.dheyafataj.com" target="_top"><img src="images/logo.jpg" alt="Tripoflife" /></a>
                <p class="slogan_cr"><strong>Dheyafa Al Taj</strong></p>


                <!-- <ul id="languageSelection_cr">
                  <li><a href="#" lang="ar" ><img src="images/arabic.jpg" alt="Arabic" /></a></li>
                </ul> -->

                <!-- navigation -->
                <!-- <ul id="navigation_cr" class="items4 navigation">
                  <li><a href="http://www.dheyafataj.com/" target="_top"><span>Welcome</span></a></li>
                  <li class="deuxLignes"><a href="" target="_top"><span>Search and book a hotel</span></a></li>
                  <li><a href="" target="_top"><span>Dheyafa Al Taj Hotel</span></a></li>
                  <li><a href="greatdeals.php" target="_top"><span>Great deals</span></a></li>
                </ul> -->
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

				<form id="newUser1" name="newUser1"  method="post" action="newrega.php"  >
				<p>
					To enjoy a whole range of benefits and become a privileged visitor, fill in the form below. <span class="note">(* Compulsory information)</span>
				</p>





				<h1><span class="titleNumberOn">1</span>. Your personal details</h1>
				<div class="separateur"></div>

				<fieldset class="fieldset-container" id="fieldset1">

					<div class="left-col">

						<table cellpadding="0" cellspacing="0">
							<tr id="user-civility-container">
								<td class="libelle"><label for="user-civility">Title *</label></td>
								<td class="user-infos">
									<select id="user_civility" name="user_civility">
                    <option value="-">-</option>
                    <option value="Mr">Mr</option>
                    <option value="Mrs">Mrs</option>
                    <option value="Ms">Ms</option>
                    <option value="Dr">Dr</option>
                    <option value="Prof">Prof</option>
                  </select>
								</td>
							</tr>

              	<tr id="user-firstName-container">
								<td class="libelle"><label for="user-firstName">First name *</label></td>
								<td class="user-infos">

									<input type="text" maxlength="50" id="user_firstName" name="user_firstName" value="" class="text" />
								</td>
							</tr>

							<tr id="user-lastName-container">

								<td class="libelle"><label for="user-lastName">Last name *</label></td>
								<td class="user-infos">
									<input type="text" maxlength="50" id="user_lastName" name="user_lastName" value="" class="text" />
								</td>
							</tr>


						</table>
					</div>

					<div class="right-col">
						<table cellpadding="0" cellspacing="0">

            	<tr id="user-email-container">
								<td class="libelle">UserId *</td>

								<td class="user-infos">


                  <input type="text" maxlength="150" name="user_login" id="user_login" value="" class="text"  />
									<a href="javascript:void(0);" title="tooltip_login" rel="top,left,200" class="tooltipLink"><img src="images/profil/tooltip.png"></a>
								</td>
							</tr>

							<tr id="user-password-container">
								<td class="libelle"><label for="user-password">Password *</label></td>
								<td class="user-infos">

									<input type="password" maxlength="20" id="user_password" name="user_password" value="" class="text"  />
									<a href="javascript:void(0);" title="tooltip_password" rel="top,left,200" class="tooltipLink"><img src="images/profil/tooltip.png"></a>
								</td>
							</tr>

							<tr id="user-confirmPassword-container">
								<td class="libelle"><label for="user-confirmPassword">Confirm your password *</label></td>
								<td class="user-infos">
									<input type="password" maxlength="20" id="user_confirmPassword" name="user_confirmPassword"  value="" class="text"  />

								</td>
							</tr>

							</table>
					</div>
				</fieldset>



				<h1><span class="titleNumberOn">2</span>. Additional information</h1>
				<div class="separateur"></div>

				<fieldset class="fieldset-container" id="fieldset2">
					<div class="left-col">

						<table cellpadding="0" cellspacing="0">
							<tr id="user-companyName-container">
									<td class="libelle"><label for="user-companyName">Company name</label></td>
									<td class="user-infos">

										<input type="text" class="text" maxlength="200" value="" name="user_companyName" id="user_companyName"/>
									</td>
								</tr>

								<tr id="user-extensionAddress-container">
									<td class="libelle"><label for="user-designation">Designation</label></td>
									<td class="user-infos">
										<input type="text" class="text" maxlength="150" value="" name="user_designation" id="user_designation"/>
									</td>
								</tr>

								<tr id="user-address1-container">
									<td class="libelle"><label for="user-address1">Address *</label></td>
									<td class="user-infos">
										<input type="text" class="text" maxlength="200" value="" name="user_address1" id="user_address1"/>
									</td>
								</tr>

								<tr id="user-address2-container">
									<td class="libelle"><label for="user-address2">Additional address information</label></td>

									<td class="user-infos">
										<input type="text" class="text" maxlength="200" value="" name="user_address2" id="user_address2"/>
									</td>
								</tr>

								<tr id="user-country-container">
									<td class="libelle"><label for="user-country">Country&nbsp;*</label></td>
									<td class="user-infos">

										<select id="user_country" name="user_country">
                    <option value="-">-</option>
                    <option value="Afghanistan">Afghanistan</option>
              <option value="Albania">Albania</option>
              <option value="Algeria">Algeria</option>
              <option value="American Samoa">American Samoa</option>
              <option value="Andorra">Andorra</option>
              <option value="Angola">Angola</option>
              <option value="Anguilla">Anguilla</option>
              <option value="Antarctica">Antarctica</option>
              <option value="Antigua and Barbuda">Antigua and Barbuda</option>
              <option value="Argentina">Argentina</option>
              <option value="Aruba">Aruba</option>
              <option value="Australia">Australia</option>
              <option value="Austria">Austria</option>
              <option value="Bahamas">Bahamas</option>
              <option value="Bahrain">Bahrain</option>
              <option value="Bangladesh">Bangladesh</option>
              <option value="Barbados">Barbados</option>
              <option value="Belgium">Belgium</option>
              <option value="Belize">Belize</option>
              <option value="Benin">Benin</option>
              <option value="Bermuda">Bermuda</option>
              <option value="Bhutan">Bhutan</option>
              <option value="Bolivia">Bolivia</option>
              <option value="Botswana">Botswana</option>
              <option value="Brazil">Brazil</option>
              <option value="Brunei">Brunei</option>
              <option value="Bulgaria">Bulgaria</option>
              <option value="Burkina Faso">Burkina Faso</option>
              <option value="Burundi">Burundi</option>
              <option value="Cambodia">Cambodia</option>
              <option value="Cameroon">Cameroon</option>
              <option value="Canada">Canada</option>
              <option value="Cape Verde">Cape Verde</option>
              <option value="Cayman Islands">Cayman Islands</option>
              <option value="Central African Republic">Central African Republic</option>
              <option value="Chad">Chad</option>
              <option value="Chile">Chile</option>
              <option value="China">China</option>
              <option value="Christmas Island">Christmas Island</option>
              <option value="Cocos Keeling Islands">Cocos Keeling Islands</option>
              <option value="Colombia">Colombia</option>
              <option value="Comoros">Comoros</option>
              <option value="Congo">Congo</option>
              <option value="Cook Islands">Cook Islands</option>
              <option value="Costa Rica">Costa Rica</option>
              <option value="Croatia">Croatia</option>
              <option value="Cuba">Cuba</option>
              <option value="Cyprus">Cyprus</option>
              <option value="Czech Republic">Czech Republic</option>
              <option value="Denmark">Denmark</option>
              <option value="Djibouti">Djibouti</option>
              <option value="Dominica">Dominica</option>
              <option value="Dominican Republic">Dominican Republic</option>
              <option value="Ecuador">Ecuador</option>
              <option value="Egypt">Egypt</option>
              <option value="El Salvador">El Salvador</option>
              <option value="Enderbury Islands">Enderbury Islands</option>
              <option value="Equatorial Guinea">Equatorial Guinea</option>
              <option value="Estonia">Estonia</option>
              <option value="Ethiopia">Ethiopia</option>
              <option value="Falkland Islands">Falkland Islands</option>
              <option value="Faroe Islands">Faroe Islands</option>
              <option value="Fiji">Fiji</option>
              <option value="Finland">Finland</option>
              <option value="France">France</option>
              <option value="French Guiana">French Guiana</option>
              <option value="French Polynesia">French Polynesia</option>
              <option value="Gabon">Gabon</option>
              <option value="Gambia">Gambia</option>
              <option value="Germany">Germany</option>
              <option value="Ghana">Ghana</option>
              <option value="Gibraltar">Gibraltar</option>
              <option value="Greece">Greece</option>
              <option value="Greenland">Greenland</option>
              <option value="Grenada">Grenada</option>
              <option value="Grenadines St Vincent">Grenadines St Vincent</option>
              <option value="Guadeloupe and Martinique">Guadeloupe and Martinique</option>
              <option value="Guam">Guam</option>
              <option value="Guatemala">Guatemala</option>
              <option value="Guinea">Guinea</option>
              <option value="Guinea Bissau">Guinea Bissau</option>
              <option value="Guyana">Guyana</option>
              <option value="Haiti">Haiti</option>
              <option value="Honduras">Honduras</option>
              <option value="Hong Kong">Hong Kong</option>
              <option value="Hungary">Hungary</option>
              <option value="Iceland">Iceland</option>
              <option value="India">India</option>
              <option value="Indonesia">Indonesia</option>
              <option value="Iran">Iran</option>
              <option value="Iraq">Iraq</option>
              <option value="Ireland">Ireland</option>
              <option value="Israel">Israel</option>
              <option value="Italy">Italy</option>
              <option value="Ivory Coast">Ivory Coast</option>
              <option value="Jamaica">Jamaica</option>
              <option value="Japan">Japan</option>
              <option value="Jordan">Jordan</option>
              <option value="Kenya">Kenya</option>
              <option value="Kirbati">Kirbati</option>
              <option value="Korea Dem Peoples Rep">Korea Dem Peoples Rep</option>
              <option value="Korea Repof">Korea Repof</option>
              <option value="Kuwait">Kuwait</option>
              <option value="Lao Peoples Dem Rep">Lao Peoples Dem Rep</option>
              <option value="Latvia">Latvia</option>
              <option value="Lebanon">Lebanon</option>
              <option value="Lesotho">Lesotho</option>
              <option value="Liberia">Liberia</option>
              <option value="Libya">Libya</option>
              <option value="Lithuania">Lithuania</option>
              <option value="Luxembourg">Luxembourg</option>
              <option value="Macau">Macau</option>
              <option value="Madagascar">Madagascar</option>
              <option value="Malawi">Malawi</option>
              <option value="Malaysia">Malaysia</option>
              <option value="Maldives">Maldives</option>
              <option value="Mali">Mali</option>
              <option value="Malta">Malta</option>
              <option value="Marshall Islands">Marshall Islands</option>
              <option value="Martinique">Martinique</option>
              <option value="Mauritania">Mauritania</option>
              <option value="Mauritius">Mauritius</option>
              <option value="Mayotte">Mayotte</option>
              <option value="Mexico">Mexico</option>
              <option value="Micronesia">Micronesia</option>
              <option value="Moldova">Moldova</option>
              <option value="Monaco">Monaco</option>
              <option value="Mongolia">Mongolia</option>
              <option value="Montserrat">Montserrat</option>
              <option value="Morocco">Morocco</option>
              <option value="Mozambique">Mozambique</option>
              <option value="Myanmar">Myanmar</option>
              <option value="Namibia">Namibia</option>
              <option value="Nauru">Nauru</option>
              <option value="Nepal">Nepal</option>
              <option value="Netherlands">Netherlands</option>
              <option value="New Caledonia">New Caledonia</option>
              <option value="New Zealand">New Zealand</option>
              <option value="Nicaragua">Nicaragua</option>
              <option value="Niger">Niger</option>
              <option value="Nigeria">Nigeria</option>
              <option value="Niue">Niue</option>
              <option value="Norfolk Island">Norfolk Island</option>
              <option value="Northern Mariana Islands">Northern Mariana Islands</option>
              <option value="Norway">Norway</option>
              <option value="Oman">Oman</option>
              <option value="Pakistan">Pakistan</option>
              <option value="Palau">Palau</option>
              <option value="Palestine">Palestine</option>
              <option value="Panama">Panama</option>
              <option value="Papua New Guinea">Papua New Guinea</option>
              <option value="Paraguay">Paraguay</option>
              <option value="Peru">Peru</option>
              <option value="Philippines">Philippines</option>
              <option value="Poland">Poland</option>
              <option value="Portugal">Portugal</option>
              <option value="Puerto Rico">Puerto Rico</option>
              <option value="Qatar">Qatar</option>
              <option value="Reunion">Reunion</option>
              <option value="Romania">Romania</option>
              <option value="Russian Federation">Russian Federation</option>
              <option value="Rwanda">Rwanda</option>
              <option value="Saint Lucia">Saint Lucia</option>
              <option value="Samoa Western">Samoa Western</option>
              <option value="San Marino">San Marino</option>
              <option value="Sao Tome and Principe">Sao Tome and Principe</option>
              <option value="Saudi Arabia">Saudi Arabia</option>
              <option value="Senegal">Senegal</option>
              <option value="Seychelles Islands">Seychelles Islands</option>
              <option value="Sierra Leone">Sierra Leone</option>
              <option value="Singapore">Singapore</option>
              <option value="Slovakia">Slovakia</option>
              <option value="Slovenia">Slovenia</option>
              <option value="Solomon Islands">Solomon Islands</option>
              <option value="Somalia">Somalia</option>
              <option value="South Africa">South Africa</option>
              <option value="Spain and Canary Islands">Spain and Canary Islands</option>
              <option value="Sri Lanka">Sri Lanka</option>
              <option value="St Helena">St Helena</option>
              <option value="St Kitts">St Kitts</option>
              <option value="St Pierre and Miquelon">St Pierre and Miquelon</option>
              <option value="Sudan">Sudan</option>
              <option value="Suriname">Suriname</option>
              <option value="Swaziland">Swaziland</option>
              <option value="Sweden">Sweden</option>
              <option value="Switzerland">Switzerland</option>
              <option value="Syria">Syria</option>
              <option value="Taiwan">Taiwan</option>
              <option value="Tanzania">Tanzania</option>
              <option value="Thailand">Thailand</option>
              <option value="Togo">Togo</option>
              <option value="Tonga">Tonga</option>
              <option value="Trinidad and Tobago">Trinidad and Tobago</option>
              <option value="Tunisia">Tunisia</option>
              <option value="Turkey">Turkey</option>
              <option value="Turks and Caicos Islands">Turks and Caicos Islands</option>
              <option value="Tuvalu">Tuvalu</option>
              <option value="US Minor Outlying Islands">US Minor Outlying Islands</option>
              <option value="Uganda">Uganda</option>
              <option value="Ukraine">Ukraine</option>
              <option value="United Arab Emirates">United Arab Emirates</option>
              <option value="United Kingdom">United Kingdom</option>
              <option value="United States">United States</option>
              <option value="Uruguay">Uruguay</option>
              <option value="Vanuatu">Vanuatu</option>
              <option value="Venezuela">Venezuela</option>
              <option value="Vietnam">Vietnam</option>
              <option value="Virgin Islands British">Virgin Islands British</option>
              <option value="Virgin Islands US">Virgin Islands US</option>
              <option value="Wallis and Futuna Islands">Wallis and Futuna Islands</option>
              <option value="Yemen">Yemen</option>
              <option value="Yugoslavia">Yugoslavia</option>
              <option value="Zaire">Zaire</option>
              <option value="Zambia">Zambia</option>
              <option value="Zimbabwe">Zimbabwe</option>


                    </select>
									</td>
								</tr>


							</table>
					</div>

					<div class="right-col">
						<table cellpadding="0" cellspacing="0">
							<tr id="user-zipCode-container" class="zipcode">
								<td class="libelle"><label for="user-zipCode">Postal/Zip code *</label></td>

								<td class="user-infos">
									<input type="text" maxlength="9" class="text" value="" name="user_zipCode" id="user_zipCode"/>
								</td>
							</tr>

							<tr id="user-city-container" class="city">
								<td class="libelle"><label for="user-city">City *</label></td>
								<td class="user-infos">
									<input type="text" class="text" maxlength="100" value="" name="user_city" id="user_city"/>

								</td>
							</tr>

              <tr id="user-email-container">
								<td class="libelle">Email *</td>

								<td class="user-infos">


                  <input type="text" maxlength="150" name="user_email" id="user_email" value="" class="text"  />
									<a href="javascript:void(0);" title="tooltip_email" rel="top,left,200" class="tooltipLink"><img src="images/profil/tooltip.png"></a>
								</td>
							</tr>

							<tr id="user-phoneNumber-container">

								<td class="libelle"><label for="user-phoneNumber">Telephone *</label></td>
								<td class="user-infos">
									+ <input type="text" maxlength="4" class="indicatif" name="user_phonePrefix" id="user_phonePrefix" value="" />
									<input type="text" maxlength="20" id="user_phoneNumber" name="user_phoneNumber" value="" class="text" />
									<a href="javascript:void(0);" title="tooltip_telephone" rel="bottom,left,200" class="tooltipLink"><img src="images/profil/tooltip.png"></a>
								</td>
							</tr>


              <tr id="user-phoneNumber-container">

								<td class="libelle"><label for="user-phoneNumber">Fax</label></td>
								<td class="user-infos">
									+ <input type="text" maxlength="4" class="indicatif" name="user_faxPrefix" id="user_faxPrefix" value="" />
									<input type="text" maxlength="20" id="user_faxNumber" name="user_faxNumber" value="" class="text" />

								</td>
							</tr>

               <tr id="user-phoneNumber-container">

								<td class="libelle"><label for="user-phoneNumber">Mobile *</label></td>
								<td class="user-infos">
									+ <input type="text" maxlength="4" class="indicatif" name="user_mobilePrefix" id="user_mobilePrefix" value="" />
									<input type="text" maxlength="20" id="user_mobileNumber" name="user_mobileNumber" value="" class="text" />
									<a href="javascript:void(0);" title="tooltip_mobile" rel="bottom,left,200" class="tooltipLink"><img src="images/profil/tooltip.png"></a>
								</td>
							</tr>


							<tr>
								<td colspan="2" class="datas">Receive your reservation confirmations by  message.</label></td>
							</tr>
						</table>
					</div>
				</fieldset>


				<h1><span class="titleNumberOn">3</span>. Security</h1>
				<div class="separateur"></div>

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
						<a href="javascript:document.newUser1.submit()" onclick="return valf(this);"  >Confirm your registration</a>
						<span class="btn-submit-left"></span>

					</span>
				</div>



				</form>

                	<link rel="stylesheet" href="css/profil-footer.css">
      <div id="footer">
          <div id="footer-content"><br><br><br>
            The data collected is compulsory and will undergo computer processing. The data will be sent to Dheyafa Al Taj, in order to manage your hotel booking and to send you information on Dheyafa Al Taj products and services, unless you specify otherwise.<br />
            You can access, correct or delete your personal information or exercise your right to object by sending a request to: Dheyafa Al Taj, Jeddah, Saudi Arabia.
          </div>
      </div>

			</div>
			<!-- @End Bloc Content -->

		</div>
		<!-- @End Bloc mainContainer -->







		<!-- Tooltip Contents -->
		<div id="tooltip_email" class="tooltipAH">

			Your valid email address will be your future communication channel.
		</div>

		<div id="tooltip_password" class="tooltipAH">
			Your password must contain a minimum of six characters, including at least one numerical character and one alphabetical character.
		</div>



		<!--<div id="tooltip_devise" class="tooltipAH">
			Select a currency that will automatically be used for your future visits.
		</div>//-->

		<div id="tooltip_telephone" class="tooltipAH">

			Please enter your phone number without any spaces or non-numeric characters.
		</div>

		<div id="tooltip_mobile" class="tooltipAH">

			Please enter your mobile phone number without any spaces or non-numeric characters.
		</div>

		<div id="tooltip_login" class="tooltipAH">

			Your userid must contain a minimum of six characters.
		</div>



		<!-- @End Tooltip Contents -->
	</div>
	<!-- @End Bloc Page -->


<script>

   function valf(theForm){

       //alert(document.newUser1.recaptcha_response_field.value);

    if (document.newUser1.user_civility.value == "-")
    {
      document.getElementById("txtHint").innerHTML="Select your Title";
      document.newUser1.user_civility.style.background = '#FFAAAA';
      document.newUser1.user_civility.focus();
      return false;

    }
    else {
      document.newUser1.user_civility.style.background = 'White';
    }


    if(isAlphanumeric(document.newUser1.user_firstName.value)){
      if((document.newUser1.user_firstName.value.length < 3) || (document.newUser1.user_firstName.value.length > 150 )){
        document.getElementById("txtHint").innerHTML="Enter your Frist Name  more than 3 characters";
        document.newUser1.user_firstName.style.background = '#FFAAAA';
        document.newUser1.user_firstName.focus();
        return false;
       }
       document.newUser1.user_firstName.style.background = 'White';
      }
    else{
      document.getElementById("txtHint").innerHTML="Enter your Frist Name with Alphanumeric without spaces";
      document.newUser1.user_firstName.style.background = '#FFAAAA'
      document.newUser1.user_firstName.focus();
      return false;
    }

    if(isLetter(document.newUser1.user_lastName.value)){
      if((document.newUser1.user_lastName.value.length < 3) || (document.newUser1.user_lastName.value.length > 150 )){
        document.getElementById("txtHint").innerHTML="Enter your Last Name  more than 3 characters";
    document.newUser1.user_lastName.style.background = '#FFAAAA';
        document.newUser1.user_lastName.focus();
        return false;
       }
       document.newUser1.user_lastName.style.background = 'White';
      }
    else{
      document.getElementById("txtHint").innerHTML="Enter your Last Name";
      document.newUser1.user_lastName.style.background = '#FFAAAA';
      document.newUser1.user_lastName.focus();
      return false;
    }


    if(isAlphanumeric(document.newUser1.user_login.value)){
      if((document.newUser1.user_login.value.length < 6) || (document.newUser1.user_login.value.length > 150 )){
        document.getElementById("txtHint").innerHTML="Enter your User Id  more than 6 characters";
        document.newUser1.user_login.style.background = '#FFAAAA'
        document.newUser1.user_login.focus();
        return false;
       }
       document.newUser1.user_login.style.background = 'White'
      }
    else{
      document.getElementById("txtHint").innerHTML="Enter your User Id with Alphanumeric without spaces";
      document.newUser1.user_login.style.background = '#FFAAAA'
      document.newUser1.user_login.focus();
      return false;
    }

    if(isAlphanumeric(document.newUser1.user_password.value)){
      if((document.newUser1.user_password.value.length < 6) || (document.newUser1.user_password.value.length > 150 )){
        document.getElementById("txtHint").innerHTML="Enter your password  more than 6 characters";
        document.newUser1.user_password.style.background = '#FFAAAA';
        document.newUser1.user_password.focus();
        return false;
       }
       document.newUser1.user_password.style.background = 'White';
      }
    else{
      document.getElementById("txtHint").innerHTML="Enter your password with Alphanumeric without spaces";
      document.newUser1.user_password.style.background = '#FFAAAA';
      document.newUser1.user_password.focus();
      return false;
    }


    if(isAlphanumeric(document.newUser1.user_confirmPassword.value)){
      if((document.newUser1.user_confirmPassword.value.length < 6) || (document.newUser1.user_confirmPassword.value.length > 150 )){
        document.getElementById("txtHint").innerHTML="Enter your Confirm password  more than 6 characters";
         document.newUser1.user_confirmPassword.style.background = '#FFAAAA';
        document.newUser1.user_confirmPassword.focus();
        return false;
       }
       document.newUser1.user_password.style.background = 'White';
      }
    else{
      document.getElementById("txtHint").innerHTML="Enter your Confirm password with Alphanumeric without spaces";
      document.newUser1.user_confirmPassword.style.background = '#FFAAAA';
      document.newUser1.user_confirmPassword.focus();
      return false;
    }





    if (document.newUser1.user_password.value != document.newUser1.user_confirmPassword.value){
         document.getElementById("txtHint").innerHTML="Your Password and confirm_password is not matching";
         document.newUser1.user_password.style.background = '#FFAAAA';
         document.newUser1.user_confirmPassword.style.background = '#FFAAAA';
         document.newUser1.user_password.focus();
         return false;

    }
    else {
         document.newUser1.user_password.style.background = 'White';
         document.newUser1.user_confirmPassword.style.background = 'White';
    }



 if ((document.newUser1.user_address1.value == null) || ((document.newUser1.user_address1.value).length==0))
    {
      document.getElementById("txtHint").innerHTML="Enter your Address";
      document.newUser1.user_address1.style.background = '#FFAAAA';
      document.newUser1.user_address1.focus();
      return false;

    }
    else {


       document.newUser1.user_address1.style.background = 'White';

    }







    if (document.newUser1.user_country.value == "-")
    {
      document.getElementById("txtHint").innerHTML="Select your Country";
      document.newUser1.user_country.style.background = '#FFAAAA';
      document.newUser1.user_country.focus();
      return false;

    }
    else {
       document.newUser1.user_country.style.background = 'White';
    }




    if(isLetterOrDigit(document.newUser1.user_zipCode.value)){
            document.newUser1.user_zipCode.style.background = 'White';
      }
    else{
      document.getElementById("txtHint").innerHTML="Enter your Postal / ZIP Code without spaces and special charectors";
      document.newUser1.user_zipCode.style.background = '#FFAAAA';
      document.newUser1.user_zipCode.focus();
      return false;
    }


 if(isLetterOrDigit(document.newUser1.user_city.value)){
            document.newUser1.user_city.style.background = 'White';
      }
    else{
      document.getElementById("txtHint").innerHTML="Enter your City without special charectors";
      document.newUser1.user_city.style.background = '#FFAAAA';
      document.newUser1.user_city.focus();
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





     if(isInteger(document.newUser1.user_phonePrefix.value)){
            document.newUser1.user_phonePrefix.style.background = 'White';
      }
    else{
      document.getElementById("txtHint").innerHTML="Enter your Phone Country Code";
      document.newUser1.user_phonePrefix.style.background = '#FFAAAA';
      document.newUser1.user_phonePrefix.focus();
      return false;
    }

     if(isInteger(document.newUser1.user_phoneNumber.value)){
            document.newUser1.user_phoneNumber.style.background = 'White';
      }
    else{
      document.getElementById("txtHint").innerHTML="Enter your Phone Number";
      document.newUser1.user_phoneNumber.style.background = '#FFAAAA';
      document.newUser1.user_phoneNumber.focus();
      return false;
    }

     if(isInteger(document.newUser1.user_mobilePrefix.value)){
            document.newUser1.user_mobilePrefix.style.background = 'White';
      }
    else{
      document.getElementById("txtHint").innerHTML="Enter your Mobile Country Code";
      document.newUser1.user_mobilePrefix.style.background = '#FFAAAA';
      document.newUser1.user_mobilePrefix.focus();
      return false;
    }


      if(isInteger(document.newUser1.user_mobileNumber.value)){
            document.newUser1.user_mobileNumber.style.background = 'White';
      }
    else{
      document.getElementById("txtHint").innerHTML="Enter your Mobile Number";
      document.newUser1.user_mobileNumber.style.background = '#FFAAAA';
      document.newUser1.user_mobileNumber.focus();
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
