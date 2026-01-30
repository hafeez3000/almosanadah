<?
include ("header.php");
?>
<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.15.0/dist/cdn.min.js"></script>
 <style>
        .error { color: crimson; font-size: 0.9em; }
    </style>
<script>
 window.onload = function() {
document.finalize.agentname.focus();
 }
</script>
<script>
document.title= '<? echo $company_name . " ERP - Umrah New Booking - Guest Detials"; ?>';
</script>
<html>
<link rel="stylesheet" type="text/css" href="../calendar/css.css" />

<body leftmargin="0" topmargin="0" rightmargin="0" >
<?
$array_acccode = array();
$array_aname = array();
$array_country = array();

$query_agents ="select acccode, aname, country from agentsdet where acccode!='0' and acccode!='' order by aname";

$result_agents = pg_query($conn, $query_agents);

if (!$result_agents) {
	echo "An error occured.\n";
	exit;
	}
while ($rows_agents = pg_fetch_array($result_agents)){

$array_acccode[] = $rows_agents["acccode"];
$array_aname[] = strtoupper($rows_agents["aname"]);
$array_country[] = strtoupper($rows_agents["country"]);

}

pg_free_result($result_agents);
?>
<table width="100%" border="0" cellpadding="0" cellspacing="0" style="border-bottom: 1px solid #999999 ;border-left: 3px solid #006600;border-right: 3px solid #006600"><tr>
    <td bgcolor="#CCCCCC"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">&nbsp;You
      are here: <a href="uhome.php">Home</a> &raquo; <a href="bookings.php">Bookings</a> &raquo; <a href="newbookings.php">New Bookings</a> &raquo; Guest Details</a></font></td>
  </tr></table>

<table width="100%" border="0" cellpadding="0" cellspacing="0" style="border-bottom: 3px solid #006600; border-right: 3px solid #006600;border-left: 3px solid #006600">
  <tr>
    <td width="20%" style="border-right: 1px solid #999999"  valign="top"> <table width="100%" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td valign="top"><div align="left">
              <?php include "umenupreline.php"; ?>
            </div></td>
        </tr>
      </table></td>
    <td width="80%" valign="top"  > <table width="100%" border="0" cellpadding="0" cellspacing="1">
        <tr>
          <td valign="top">





            <table width="100%" cellpadding="0" cellspacing="0" ><tr><td width="85%" valign="top">
			<table cellpadding="0" cellspacing="0" width="100%" style="border-top: 1px solid #999999; border-bottom: 1px solid #999999"><tr>
                      <td bgcolor="#CCCCCC"><strong>Guest Details</strong></td>
                    </tr></table>
<table width="100%" bgcolor="#00A800" cellpadding="5" cellspacing="0"><tr>
                      <td><table width="100%" bgcolor="#FFFFFF" cellpadding="0" cellspacing="0"><tr>
                      <td><div align="left"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">
                          <table width="100%" border="0" bgcolor="#CAFFCA"cellpadding="0" cellspacing="0">
							 <tr>
                                  <td> <strong><font size="2" face="Arial, Helvetica, sans-serif">Enter
                                    Agent / Guest Details</font></strong></td>
                                  <td valign="top"><div align="right"><img src="../images/tr.jpg"></div></td></tr>			  </table>

<script>
function form() {
    return {
        group_code: '',
        message: '',

        async checkGroupCode() {
            console.log('Checking group code:', this.group_code);
            if (!this.group_code) { this.message = ''; return; }

            const res  = await fetch('./check_group_code.php?group_code=' + encodeURIComponent(this.group_code));
            const data = await res.json();

            if (!data.valid) {
                this.message = 'Invalid group code format.';
            } else if (!data.available) {
                this.message = 'This group code is already registered.';
            } else {
                this.message = '';
            }
        }
    };
}
</script>

<form name="finalize" method="post" action="bookingfinal.php" style="margin-top: 1px; margin-bottom: 0px"   x-data="form()" @submit.prevent="if (!message && fun2(this)) $el.submit()">
                                <table width="100%" border="1" cellpadding="5" cellspacing="0">
                                  <tr>
                                    <td align="center" colspan="2"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Enter
                                      Agent Details</font></td>
                                  </tr>


	<tr>
                                    <td align="left" width="30%"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Search
                                      Agent</font></td>

 <script type="text/javascript">
      function OpenWindow(){

   if ( (document.finalize.a_search.value == null) ||  ((document.finalize.a_search.value).length==0))
   {
      alert ("Sorry, But enter Account Name to find Account");
	  document.finalize.a_search.focus();
   }
   else {

    	var rr = "agentsearchf.php?hn="+document.finalize.a_search.value;

        var winPop = window.open(rr,"winPop",'menubar=yes,scrollbars=yes,toolbar=no,resizable=yes,width=700,height=300, top='+10+',left='+10+' ').focus();


      }

}
    </script>
                                    <td align="left"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><input type="text" id="a_search" name="a_search" size="30">
									<input type="button" id="b_search" name="b_search" value="Agent Search" onClick="OpenWindow()">
									</font></td>
                                  </tr>



                                  <tr>
                                    <td width="30%"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Travel
                                      Agent company </font></td>
                                    <td><font size="2" face="Verdana, Arial, Helvetica, sans-serif">
										  <select  name="agentname">


        <?
		for($i=0;$i<count($array_acccode);$i++){
  echo  "<option value=\"$array_acccode[$i]\">$array_aname[$i] - $array_country[$i]</option>";
}
	?>
    </select>

                                      <img src="../images/icon_redStar.gif" width="10" height="10" align="top">
                                      </font></td>
                                  </tr>
                                  <tr>
                                    <td><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Contact
                                      Person Title </font></td>
                                    <td><font size="2" face="Verdana, Arial, Helvetica, sans-serif">
                                      <select name="cptitle">
                                        <option value="Mr">Mr</option>
                                        <option value="Ms">Ms</option>
                                        <option value="Mrs">Mrs</option>
                                        <option value="Miss">Miss</option>
                                        <option value="Dr">Dr</option>
                                        <option value="Prof">Prof</option>
                                      </select>
                                      <img src="../images/icon_redStar.gif" width="10" height="10" align="top">
                                      </font></td>
                                  </tr>
                                  <tr>
                                    <td><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Contact
                                      Person Name</font></td>
                                    <td><font size="2" face="Verdana, Arial, Helvetica, sans-serif">
                                      <input type="text" id="cpname" name="cpname" size="50">
                                      <img src="../images/icon_redStar.gif" width="10" height="10" align="top">
                                      </font></td>
                                  </tr>
                                  <tr>
                                    <td><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Notes
                                      for Travel Agent</font></td>
                                    <td><font size="2" face="Verdana, Arial, Helvetica, sans-serif">
                                      <input type="text" name="tanotes" size="50">
                                      </font></td>
                                  </tr>



                                  <tr>
                                    <td align="center" colspan="2"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">
                                      Enter Guest Details</font></td>
                                  </tr>
                                  <tr>
                                    <td width="30%"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Guest
                                      Title </font></td>
                                    <td><font size="2" face="Verdana, Arial, Helvetica, sans-serif">
                                      <select name="gtitle">
                                        <option value="Mr">Mr</option>
                                        <option value="Ms">Ms</option>
                                        <option value="Mrs">Mrs</option>
                                        <option value="Miss">Miss</option>
                                        <option value="Dr">Dr</option>
                                        <option value="Prof">Prof</option>
                                      </select>
                                      <img src="../images/icon_redStar.gif" width="10" height="10" align="top">
                                      </font></td>
                                  </tr>
                                  <tr>
                                    <td><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Guest/Group
                                      Name </font></td>
                                    <td><font size="2" face="Verdana, Arial, Helvetica, sans-serif">
                                      <input type="text" id="gname" name="gname" size="50">
                                      <img src="../images/icon_redStar.gif" width="10" height="10" align="top">
                                      </font></td>
                                  </tr>
                                  <tr>
                                    <td><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Group Code</font></td>
                                    <td><font size="2" face="Verdana, Arial, Helvetica, sans-serif">
                                      <input type="text" id="group_code" name="group_code" size="50" x-model="group_code" @input.debounce.500ms="checkGroupCode()" autocomplete="off">

                                      <template x-if="message">
                                              <p class="error" x-text="message"></p>
                                      </template>

                                      </font></td>
                                  </tr>
                                  <tr>
                                    <td><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Nationality </font></td>
                                    <td><font size="2" face="Verdana, Arial, Helvetica, sans-serif">
                                      <input type="text" id="gnationality" name="gnationality" size="50">
                                      <img src="../images/icon_redStar.gif" width="10" height="10" align="top">
                                      </font></td>
                                  </tr>

                                  <tr>
                                    <td><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Contact
                                      Number </font></td>
                                    <td><font size="2" face="Verdana, Arial, Helvetica, sans-serif">
                                      <input type="text"  id="contactno" name="contactno">
                                      <img src="../images/icon_redStar.gif" width="10" height="10" align="top">
                                      </font></td>
                                  </tr>
                                  <tr>
                                    <td><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Flight
                                      Details </font></td>
                                    <td><font size="2" face="Verdana, Arial, Helvetica, sans-serif">
                                      <input type="text" name="flightdet">
                                      </font></td>
                                  </tr>
                                  <tr>
                                    <td><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Notes
                                      for Guest</font></td>
                                    <td><font size="2" face="Verdana, Arial, Helvetica, sans-serif">
                                      <input type="text" name="guestnotes" size="50">
                                      </font></td>
                                  </tr>
                                </table>

<table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#CAFFCA"><tr>
                                    <td valign="bottom"><img src="../images/bl.jpg" width="9" height="10"></td>
                                    <td align="right">

  <input type="submit" name="Submit" value="Finalize booking >>>">&nbsp;

</td></tr></table></form>

							  </td>
                            </tr>
                          </table>
							  </td>
                            </tr>
                          </table>
                          </td>
                    </tr></table>

			</td>
              </tr></table> </td>
        </tr>
      </table></td></tr>


      </table>
</table>



	</tr></table>

<script>
function fun2(theForm){

if ( (document.finalize.cpname.value == null) ||  ((document.finalize.cpname.value).length==0))
   {
	alert("Habibi, Enter the Contact Person Name.");
		document.finalize.cpname.focus();
		return false;
	}

if ( (document.finalize.gname.value == null) ||  ((document.finalize.gname.value).length==0))
   {
	alert("Habibi, Enter the Guest Name.");
		document.finalize.gname.focus();
		return false;
	}

if ( (document.finalize.contactno.value == null) ||  ((document.finalize.contactno.value).length==0))
   {
	alert("Habibi, Enter the Guest Contact No.");
		document.finalize.contactno.focus();
		return false;
	}

  return true;

}

</script>


</body>
</html>
