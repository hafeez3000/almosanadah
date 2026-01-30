<?

include ("header.php");
?>

<script src="../javascripts/cBoxes.js"></script>
<script src="salesreportbyvcjs.js"></script>
<? $vy=$vm=$vd=0;
$vy1=$vm1=$vd1=0;
?>

<script>
document.title= '<? echo $company_name . " ERP - Sales Report by Visa"; ?>';
</script>

<?
$array_country = array();
$array_trans = array();
$array_trans_id = array();


$query_trans ="select acccode, aname,scountry from agentsdet order by aname";

$result_trans = pg_query($conn, $query_trans);

if (!$result_trans) {
	echo "An error occured.\n";
	exit;
	}
while ($rows_trans = pg_fetch_array($result_trans)){

$array_trans[] = $rows_trans["aname"];
$array_trans_id[] = $rows_trans["acccode"];
$array_country[] = $rows_trans["scountry"];
}

pg_free_result($result_trans);

?>

<html>
<link rel="stylesheet" type="text/css" href="../calendar/css.css" />
<head>
<script>
 var winl = (screen.width - 700) / 2;
 var wint = (screen.height - 500) / 2;
</script>
</head>
<body leftmargin="0" topmargin="0" rightmargin="0">
<table width="100%" border="0" cellpadding="0" cellspacing="0" style="border-bottom: 1px solid #999999 ;border-left: 3px solid #006600;border-right: 3px solid #006600"><tr>
    <td bgcolor="#CCCCCC"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">&nbsp;You
      are here: <a href="uhome.php">Home</a> &raquo;  Reports &raquo; Sales Visa Reports by Country</font></td>
  </tr></table>

<table width="100%" border="0" cellpadding="0" cellspacing="0" style="border-bottom: 3px solid #006600; border-right: 3px solid #006600;border-left: 3px solid #006600 ">
  <tr>
    <td width="20%" style="border-right: 1px solid #999999"  valign="top"> <table width="100%" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td valign="top"><div align="left">
              <?php include "umenupreline.php"; ?>
            </div></td>
        </tr>
      </table></td>
    <td width="80%" valign="top"  > <table width="100%" border="0" cellpadding="0" cellspacing="1" >
        <tr>
          <td valign="top">





            <table width="100%" cellpadding="0" cellspacing="0" ><tr><td width="85%" valign="top" >
			<table cellpadding="0" cellspacing="0" width="100%" style="border-top: 1px solid #999999; border-bottom: 1px solid #999999" ><tr>
                      <td bgcolor="#CCCCCC"><strong>Sales Visa Reports by Country</strong></td>
                    </tr></table>
<table width="100%" cellpadding="1" cellspacing="0" ><tr>
                      <td>
                          <table width="100%" border="0" cellspacing="0" style=" border-bottom: 1px solid #999999">
                          <form name="bbyod" method="post" action="#">

                            <tr>
                              <td><div align="right"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Select From
                                  Date</font></div></td>
                              <td><font size="2" face="Verdana, Arial, Helvetica, sans-serif">
                                <select name="dDay" class="selBox">
                                </select>
                                </font><font size="2" face="Verdana, Arial, Helvetica, sans-serif">
                                <select name="dMonth" class="selBox">
                                </select>
                                </font><font size="2" face="Verdana, Arial, Helvetica, sans-serif">
                                <select name="dYear" class="selBox">
                                </select>
                                </font></td> <td align="left"> <img src="../images/print_icon.gif""> <a href="printvisareport.php" target="visareportpop" onclick="window.open('', 'visareportpop','width=775,height=450,menubar=yes,scrollbars=yes, top='+wint+',left='+winl+' ').focus()">Print</a></td>
                            </tr>
                            <tr>
                              <td><div align="right"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Select To
                                  Date</font></div></td>
                              <td><font size="2" face="Verdana, Arial, Helvetica, sans-serif">
                                <select name="dDay1" class="selBox">
                                </select>
                                </font><font size="2" face="Verdana, Arial, Helvetica, sans-serif">
                                <select name="dMonth1" class="selBox">
                                </select>
                                </font><font size="2" face="Verdana, Arial, Helvetica, sans-serif">
                                <select name="dYear1" class="selBox">
                                </select>
                                </font></td>
                            </tr>
                                                        <tr>
                              <td><div align="right"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Booking Status</font></div></td>
                              <td><font size="2" face="Arial, Helvetica, sans-serif">
                                <font size="2" face="Arial, Helvetica, sans-serif">

					<select  id="gueststatus" name="gueststatus">
					<option value="on_request_confirmed">On Request + Confirmed</option>
					<option value="on_request">On Request</option>
					<option value="confirmed">Confirmed</option>
					<option value="cancelled">Cancelled</option>
          <option value="all">All</option>

					</select>



                                </font> </font></td>
                            </tr>
                            		<tr>
                              <td><div align="right"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Select
                                  Country</font></div></td>
                              <td><font size="2" face="Arial, Helvetica, sans-serif">
                                <font size="2" face="Arial, Helvetica, sans-serif"><strong>
                                    <select id="scountry" name="scountry">
                                        		<option value="all">All Countries</option>
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
                                                <option value="UAE">United Arab Emirates</option>
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
  		                      </strong></font> </font></td>
                            </tr>


                            <tr>
                              <td colspan="2"><div align="center">
                                  <input type="button" name="get_rl" id="get_rl" value="Get Visa Sales Report >>>" onClick="s_h();">
                                </div></td>



                            </tr>



                          </form>





<script>
function s_h(){


var fv = document.getElementById("scountry").value;



var f_year = document.bbyod.dYear.value;
var f_month = document.bbyod.dMonth.value;
var f_day  = document.bbyod.dDay.value;

var t_year = document.bbyod.dYear1.value;
var t_month = document.bbyod.dMonth1.value;
var t_day  = document.bbyod.dDay1.value;

var from_d = f_year+"-"+f_month+"-"+f_day;
var to_d = t_year+"-"+t_month+"-"+t_day;

var gs = document.getElementById("gueststatus").value;


//var from_d = "2006-09-25";
//var to_d = "2006-09-27";

var cinb=1 ;


showHint(fv,from_d, to_d, gs, cinb);


	}
</script>
                        </table>





      </table>
</table>



	</tr></table>

<p><span id="txtHint"></span></p>

<script>

	var tdddate = new Date();

    var dvy = <?php echo $vy; ?>; if (dvy==0) dvy=tdddate.getYear()
	var dvm = <?php echo $vm; ?>; if (dvm==0) dvm=tdddate.getMonth()
	var dnd = <?php echo $vd; ?>; if (dnd==0) dnd=tdddate.getDate()

   if (dvy < 2000) dvy += 1900;


	var now_date = new Date(dvy,dvm,dnd);
	var now_day = now_date.getDate();
	var now_month = now_date.getMonth();

	var now_year = now_date.getYear();

	var dvy1 = <?php echo $vy1; ?>; if (dvy1==0) dvy1=tdddate.getYear()
	var dvm1 = <?php echo $vm1; ?>; if (dvm1==0) dvm1=tdddate.getMonth()
	var dnd1 = <?php echo $vd1; ?>; if (dnd1==0) dnd1=tdddate.getDate()

    if (dvy1 < 2000) dvy1 += 1900;


	var now_date1 = new Date(dvy1,dvm1,dnd1);
	var now_day1 = now_date1.getDate();
	var now_month1 = now_date1.getMonth();

	var now_year1 = now_date1.getYear();


	var d1 = new dateObj(document.bbyod.dDay, document.bbyod.dMonth, document.bbyod.dYear);
	initDates(dvy-1, dvy+1, dvy, now_month, now_day, d1);

	var d2 = new dateObj(document.bbyod.dDay1, document.bbyod.dMonth1, document.bbyod.dYear1);
	initDates(dvy-1, dvy+1, dvy, now_month, now_day1, d2);


</script>


<script>
function fun2(theForm){




 if ((document.bbyod1.tdata.value== null) ||   ((document.bbyod1.tdata.value).length==0))
   {
      alert ("Sorry, But enter string to find orders");
	  document.bbyod1.tdata.focus();
	  		return false;
   }




}
</script>

</body>
</html>
