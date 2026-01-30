<?
include ("header.php");

$array_acc_name = array();
$array_acccode = array();

$query_hotel ="select acccode,acc_name from accmast ORDER BY acc_name";

$result_hotel = pg_query($conn, $query_hotel);

if (!$result_hotel) {
	echo "An error occured.\n";
	exit;
	}
while ($rows_hotel = pg_fetch_array($result_hotel)){

$array_acc_name[] = $rows_hotel["acc_name"];
$array_acccode[] = $rows_hotel["acccode"];

}

pg_free_result($result_hotel);
?>
<script src="../javascripts/cBoxes.js"></script>
<script>
document.title= '<? echo $company_name . " ERP - Acounts - Find Account"; ?>';
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
              <?include ("umenu.php"); ?>
            </div></td>
        </tr>
      </table></td>
    <td width="80%" valign="top"  > <table width="100%" border="0" cellpadding="0" cellspacing="1">
        <tr>
          <td valign="top">

		 <form name="selhotel" method="post" action="gac.php" onSubmit="return fun2(this)">

	<table style="border: 1px solid red" width="100%" >
	 <tr>

                                  <td bgcolor="#FFDFDF" colspan="2">&nbsp;<strong>Find Account </strong>                                 </td>

								</tr>

	<tr>
	  <td>Select A/C Name:</td>

	 <script>
	function accv(){
      var c_val =document.getElementById("acname").options[document.getElementById("acname").selectedIndex].firstChild.nodeValue;

	  var word = c_val.split("-");


	   document.getElementById("saccode").value = word[0];
	  }
	</script>


	<td><select id="acname" name="acname" onChange="accv();">
        <option value="select">Select Account Name...</option>

        <?

		for($i=0;$i<count($array_acccode);$i++){

   echo  "<option value=\"$array_acccode[$i]\">$array_acc_name[$i] - $array_acccode[$i]</option>";

		}

	?>
    </select></td></tr>
	<tr>
	  <td> Search for A/c name:</td>
	  <script type="text/javascript">
      function OpenWindow(){

   if ((document.selhotel.saccode.value== null) || ((document.selhotel.saccode.value).length==0))
   {
      alert ("Sorry, But enter Account Name to find Account");
	  document.selhotel.saccode.focus();
   }
   else {

		var rr = "accountsearchfindacc.php?hn="+document.selhotel.saccode.value;

        var winPop = window.open(rr,"winPop",'menubar=yes,scrollbars=yes,toolbar=no,resizable=yes,width=700,height=300, top='+10+',left='+10+' ').focus();
      }

}
    </script>
	  <td><input type="text" id="saccode" name="saccode" size="20"> <input type="button" name="searchacc" value="Search" onClick="OpenWindow()"></td></tr>

	<input type="hidden" name="ac" id="ac" >
  </table>  </td></tr>	<tr><td colspan="2" align="center"></td></tr></table>

		 </form>



			 </td>
        </tr>
      </table></td></tr>


      </table>
</table>



	</tr></table>
</body>
</html>





<script>
function fun2(theForm){

if ((document.selhotel.accode.value== null) || ((document.selhotel.accode.value).length<6) || ((document.selhotel.accode.value).length>6))
   {
      alert ("Sorry, But enter Account code");
	  document.selhotel.accode.focus();
		return false;
   }

if(document.selhotel.acname.value=="select"){
alert ("Sorry, But Select Account Code");
  document.selhotel.acname.focus();
return false;
}


}
</script>
