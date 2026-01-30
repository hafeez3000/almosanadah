<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
 "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">


<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<title>Access your privilege Profile</title>

    <meta name="robots" content="noindex, nofollow" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="Content-language" content="en" />
	<!-- start CSS -->
		<link rel="stylesheet" href="css/profil-identification-structure.css" type="text/css" media="all" />
		<link rel="stylesheet" href="css/profil-identification-couleur.css" type="text/css" media="all" />
    <link type="text/css" rel="stylesheet" media="screen" href="css/bandeau_cr.css" />
  <!-- end CSS -->

  <!-- start Javascript -->
    <SCRIPT SRC="javascripts/FormChek.js"></SCRIPT>
    <script src="javascripts/validateuser.js"></script>
  <!-- end Javascript -->
</head>


<body id="profil-identification" onLoad="document.login_form.login.focus();">
		<div id="page" >
			<div id="profil-bandeau">
        <div id="bandeau_cr">
          <div id="header_cr">
            <a class="logo_cr" href="http://www.daralmanasek.com" target="_top"><img src="images/logo.png" alt="Dar Al Manasek" /></a>
              <p class="slogan_cr"><strong>DAR AL MANASEK <br>It's pleasure to serve you!</strong></p>

                <ul id="languageSelection_cr">
                  <li><a href="#" lang="ar" ><img src="images/arabic.jpg" alt="Arabic" /></a></li>
                </ul>

                <!-- navigation -->
                <ul id="navigation_cr" class="items4 navigation">
                  <li><a href="http://www.daralmanasek.com/" target="_top"><span>Welcome</span></a></li>
                  <li class="deuxLignes"><a href="" target="_top"><span>Search and book a hotel</span></a></li>
                  <li><a href="damtuhotel.php" target="_top"><span>Dar Al Manasek Hotel</span></a></li>
                  <li><a href="greatdeals.php" target="_top"><span>Great deals</span></a></li>
                </ul>
                <!-- / navigation -->
          </div>
        </div>
      </div>


      <div id="profil-mainContainer">
				<div id="profil-overture">
          <div id="profil-titre-page"></div>
        </div>
			<!-- @End Bloc Overture -->

        <div id="profil-content">
          <h1>Access Your Profile</h1>

          <div id="non-inscrit" class="contour-simple-small">

            <span class="contour-simple-top-small"></span>
              <h2>Have you created Your Profile yet?</h2>
                <p>Welcome to a world of privileges:</p>
                  <ul>
                    <li>- take advantage of exclusive offers and benefits</li>
                    <li>- receive our promotions and enjoy the best rates</li>
                    <li>- check online availablity and rates</li>
                    <li>- get updates of financial records</li>
                  </ul>

                  <a href="" class="more-infos popin">Find out more about your benefits</a><br />

                  <span class="btn bottom-right">
                    <a id="createUserLink" href="newreg.php">Create Your Profile</a>
                      <span class="btn_left"></span>
                  </span>
          </div>
				<!-- @End Bloc Non Inscrit -->

    <style>
    .eLogin{position:relative; background: transparent; width:260px;}
    .eForm{position:relative;}
    .login input{width:256px;}
    .identification input{padding:2px; border:0px;}
    .identification label{display:none;}
    .pwd input{width:256px;}
    .pwd{ margin-bottom:10px;}
    .submit input{background-color:#95003c; width:256px; height:21px; color:White; padding:0; padding-bottom:2px; font-weight:normal; cursor: pointer;  margin-left:3px;margin-bottom:2px;}


    </style>

				<!-- Bloc Inscrit  -->
          <div  id="inscrit" class="contour-double-small">
            <span class="contour-double-top-small"></span>

            <div class="eLogin">

              <div class="eForm">
                <form id="login_form" name="login_form" method="post" action="" onSubmit="return validate(this)">
                  <fieldset class="identification">
                      <div class="login">
                          User Id<br>
                          <input id="login" name="login"  type="text"  maxlength="255" autocomplete="on"/>
                      </div>

                      <div class="pwd">
                          Password<br>

                          <input id="pwd"  type="password" name="pwd"  maxlength="20" autocomplete="off"  />
                      </div>

                         <p><span id="txtHint" style="color:Red" ></span></p>

                      <div class="submit">
                          <input id="login_submit" type="button" value="LOGIN" onClick="validate_user();" onSubmit="validate_user();" />
                      </div>
                  </fieldset>
                </form>
              </div>


              <div id="forgot-pwd">
                  <a id="forgot-pwd-lnk" target="_top" href="">Forgotten password?</a>
              </div>

              <div id="create-account">
                  <a id="create-account-lnk" target="_top" href="newreg.php">Create your profile</a>
              </div>
          </div>

        </div>
				<!-- @End Bloc Inscrit -->

          <script type="text/javascript">
          function validate(theFrom)
          {
            defaultEmptyOK = true;
            for (defaultEmptyOKLoop = 0; defaultEmptyOKLoop < 2; defaultEmptyOKLoop++)
            {
              defaultEmptyOK = !defaultEmptyOK;
              if(isEmpty(document.login_form.login.value)){
                alert("Enter your User Id");
                document.login_form.login.focus();
                return false;
              }
              if(isEmpty(document.login_form.pwd.value)){
                alert("Enter your Password");
                document.login_form.pwd.focus();
                return false;
              }
            }
          }
          </script>

          <script type="text/javascript">
          function validate_user(){
            var s_login = document.login_form.login.value;
            var s_pwd = document.login_form.pwd.value;
            passVar(s_login, s_pwd);
          }
          </script>

			</div>
			<!-- @End Bloc Content -->


		</div>
		<!-- @End Bloc mainContainer -->

		<link rel="stylesheet" href="css/profil-footer.css">
      <div id="footer">
          <div id="footer-content">
            The data collected is compulsory and will undergo computer processing. The data will be sent to Dar Al Manasek, in order to manage your hotel booking and to send you information on Dar Al Manasek products and services, unless you specify otherwise.<br />
            You can access, correct or delete your personal information or exercise your right to object by sending a request to: Dar Al Manasek, Jeddah, Saudi Arabia.
          </div>
      </div>
	</div>
	<!-- @End Bloc Page -->


</body>
</html>
