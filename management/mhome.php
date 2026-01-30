<?
include ("header.php");
include ("../calendar/cal.php");
?>

<script>
document.title= '<? echo $company_name . " ERP - Management Home"; ?>';
</script>

<html>
<link rel="stylesheet" type="text/css" href="../calendar/css.css" />
<body leftmargin="0" topmargin="0" rightmargin="0">
<table width="100%" border="0" cellpadding="0" cellspacing="0" style="border-bottom: 1px solid #999999 ;border-left: 3px solid #006600;border-right: 3px solid #006600"><tr>
    <td bgcolor="#CCCCCC"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">&nbsp;You
      are here: Home</font></td>
  </tr></table>
<table width="100%" border="0" cellpadding="0" cellspacing="0" style="border-bottom: 1px solid #999999 ;border-left: 3px solid #006600;border-right: 3px solid #006600"><tr>
    <td ><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><?include ("../dticker/uhome.php"); ?></td>
  </tr></table>

<table width="100%" border="0" cellpadding="0" cellspacing="0" style="border-bottom: 3px solid #006600; border-right: 3px solid #006600;border-left: 3px solid #006600 ">
  <tr>
    <td width="20%" style="border-right: 1px solid #999999" valign="top"> <table width="100%" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td valign="top"><div align="left">
              
			  <?include ("umenupreline.php"); ?>
            </div></td>
        </tr>
      </table></td>
    <td width="80%" valign="top"  > <table width="100%" border="0" cellpadding="0" cellspacing="1">
        <tr>
          <td valign="top">




            <table width="100%" cellpadding="0" cellspacing="0" ><tr><td width="85%" valign="top">
			<table cellpadding="0" cellspacing="0" width="100%"><tr><td></td></tr></table>

			<table width="100%" cellpadding="1" cellspacing="0" ><tr>
                      <td bgcolor="#FFF2F2" style="border-bottom: 1px solid #999999"  >




					   <form name="selhotel" method="post" action="gac.php" onSubmit="return fun2(this)">

	<table style="border: 1px solid red" width="100%" >
	 <tr>

                                  <td bgcolor="#FFDFDF" colspan="2">&nbsp;<strong>Enter text to Find by UserId </strong>                                 </td>

								</tr>


	  <td> Search by UserId:</td>
	  <script type="text/javascript">
      function OpenWindow(){

   if ((document.selhotel.saccode.value== null) || ((document.selhotel.saccode.value).length==0))
   {
      alert ("Sorry, But enter UserId to find User Details");
	  document.selhotel.saccode.focus();
   }
   else {

		var rr = "userfindbyid.php?hn="+document.selhotel.saccode.value;

        var winPop = window.open(rr,"winPop",'menubar=yes,scrollbars=yes,toolbar=no,resizable=yes,width=800,height=300, top='+10+',left='+10+' ').focus();
      }

}
    </script>
	  <td width="50%"><input type="text" id="saccode" name="saccode" size="20"> <input type="button" name="searchacc" value="Search by User Id" onClick="OpenWindow()"></td></tr>

	<input type="hidden" name="ac" id="ac" >
  </table>  </td></tr>	<tr><td colspan="2" align="center"></td></tr></table>

		 </form>









	</td>
                    </tr>


	<tr>
        <td bgcolor="#CCF2F2" style="border-bottom: 1px solid #999999"  >
			<form name="fbyname" method="post" action="findbyname.php" onSubmit="return fun2(this)">
				<table style="border: 1px solid Black" width="100%" >
					<tr>
						<td bgcolor="#CCDFDF" colspan="2">
						&nbsp;<strong>Enter text to Find by User Name </strong>
						</td>
					</tr>
						<td> Search by User Name:</td>
							<script type="text/javascript">
								function OpenWindow1(){

								if ((document.fbyname.saccode.value== null) || ((document.fbyname.saccode.value).length==0))
									{
									alert ("Sorry, But enter User Name to find User Details");
									document.fbyname.saccode.focus();
									}
								else {
									var rrbyn = "userfindbyname.php?hn="+document.fbyname.saccode.value;
									var winPop = window.open(rrbyn,"winPop",'menubar=yes,scrollbars=yes,toolbar=no,resizable=yes,width=700,height=300, top='+10+',left='+10+' ').focus();
									}
								}
							</script>
							<td width="50%">
								<input type="text" id="saccode" name="saccode" size="20">
								<input type="button" name="searchacc" value="Search by User Name" onClick="OpenWindow1()">
								<input type="hidden" name="ac" id="ac" >
							</td>
						</tr>
					</table>


				</form>
			</td>
		</tr>

	<tr>
        <td bgcolor="#CCF2F2" style="border-bottom: 1px solid #999999"  >
			<form name="fbycompanyname" method="post" action="findbycompanyname1.php" onSubmit="return fun3(this)">
				<table style="border: 1px solid Black" width="100%" >
					<tr>
						<td bgcolor="#CCDFDF" colspan="2">
						&nbsp;<strong>Enter text to Find users by Company Name </strong>
						</td>
					</tr>
						<td> Search Users Company Name:</td>
							<script type="text/javascript">
								function OpenWindow3(){
								//alert("adsf");
								if ((document.fbycompanyname.sbycomname.value== null) || ((document.fbycompanyname.sbycomname.value).length==0))
									{
									alert ("Sorry, But enter Company Name to find User Details");
									document.fbycompanyname.sbycomname.focus();
									}
								else {
									var rrbyn = "userfindbycompanayname.php?hn="+document.fbycompanyname.sbycomname.value;
									var winPop = window.open(rrbyn,"winPop",'menubar=yes,scrollbars=yes,toolbar=no,resizable=yes,width=700,height=300, top='+10+',left='+10+' ').focus();
									}
								}
							</script>
							<td width="50%">
								<input type="text" id="sbycomname" name="sbycomname" size="20">
								<input type="button" name="sbycomnameb" value="Get last registered users" onClick="OpenWindow3()">
								<input type="hidden" name="sbycomnameh" id="sbycomnameh" >
							</td>
						</tr>
					</table>


				</form>
			</td>
		</tr>


<tr>
        <td bgcolor="#CCF2F2" style="border-bottom: 1px solid #999999"  >
			<form name="fbycompanynametop" method="post" action="findbycompanyname1.php" onSubmit="return fun4(this)">
				<table style="border: 1px solid Black" width="100%" >
					<tr>
						<td bgcolor="#CCDFDF" colspan="2">
						&nbsp;<strong>Enter number of latest registered users </strong>
						</td>
					</tr>
						<td> Get last registered users:</td>
							<script type="text/javascript">
								function OpenWindow4(){
								//alert("adsf");
								if ((document.fbycompanynametop.sbycomname.value== null) || ((document.fbycompanynametop.sbycomname.value).length==0))
									{
									alert ("Sorry, But enter the string to get number of users");
									document.fbycompanynametop.sbycomname.focus();
									}
								else {
									var rrbyn = "userfindbyidt100.php?hn="+document.fbycompanynametop.sbycomname.value;
									var winPop = window.open(rrbyn,"winPop",'menubar=yes,scrollbars=yes,toolbar=no,resizable=yes,width=700,height=300, top='+10+',left='+10+' ').focus();
									}
								}
							</script>
							<td width="50%">
								<input type="text" id="sbycomname" name="sbycomname" size="20">
								<input type="button" name="sbycomnameb" value="Search by Company Name" onClick="OpenWindow4()">
								<input type="hidden" name="sbycomnameh" id="sbycomnameh" >
							</td>
						</tr>
					</table>


				</form>
			</td>
		</tr>


	</table>
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
		if ( (document.selhotel.saccode.value== null) ||  ((document.selhotel.saccode.value).length==0) ||  ((document.selhotel.saccode.value).length<3))
		{
			alert ("Sorry, But enter the string to find users");
			document.selhotel.saccode.focus();
			return false;
		}
	}
</script>

<script>
	function fun3(theForm){
		if ( (document.selhotel.saccode.value== null) ||  ((document.selhotel.saccode.value).length==0) ||  ((document.selhotel.saccode.value).length<3))
		{
			alert ("Sorry, But enter the string to find users by company name");
			document.selhotel.saccode.focus();
			return false;
		}
	}
</script>

<script>
	function fun4(theForm){
		if ( (document.fbycompanynametop.saccode.value== null) ||  ((document.fbycompanynametop.saccode.value).length==0) ||  ((document.fbycompanynametop.saccode.value).length<3))
		{
			alert ("Sorry, But enter the string to get number of users");
			document.fbycompanynametop.saccode.focus();
			return false;
		}
	}
</script>



	</tr></table>
</body>
</html>
