<?
session_cache_limiter('must-revalidate');
include ("header.php");


?>
<script src="../javascripts/cBoxes.js"></script>
<script>
 var winl = (screen.width - 760) / 2; 
 var wint = (screen.height - 550) / 2;
</script>
<script>
document.title= '<? echo $company_name . " ERP - Acounts - PNR Check"; ?>';
</script>

<html>
<link rel="stylesheet" type="text/css" href="../calendar/css.css" />
<style type="text/css">
<!--
.style6 {font-family: Verdana, Arial, Helvetica, sans-serif}
-->
</style>
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
        
		   

<form name="gquot" method="post" action="#" >

	
	
	<table style="border: 1px solid red" width="100%" >
	 <tr>

                                  <td bgcolor="#FFDFDF" colspan="2">&nbsp;<strong>Find PNR Check</strong>                                 </td>
                                </tr>
	<tr>
	  <td align="center" colspan="2"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Enter PNR<br></font>
	    <input type="text" id="pnr" name="pnr" size="4" maxlength="6" onkeyup="gquot.pnr.value=gquot.pnr.value.toUpperCase()" onblur="gquot.pnr.value=gquot.pnr.value.toUpperCase()"> <br><br>
</td>
    	  </tr>


<script>

function p_sell(){

if((document.getElementById ("pnr").value).length==5){

var pnr_v = "printconfirmation.php?spnr="+document.getElementById ("pnr").value;

window.open(pnr_v, 'confsell','width=775,height=450,menubar=yes,scrollbars=yes, top='+wint+',left='+winl+' ').focus()
}
else{
alert("Please Enter the Correct PNR");
}

}


function p_net(){

if((document.getElementById ("pnr").value).length==5){

var pnr_v = "printconfirmationnet.php?spnr="+document.getElementById ("pnr").value;

window.open(pnr_v, 'confsell','width=775,height=450,menubar=yes,scrollbars=yes, top='+wint+',left='+winl+' ').focus()

}
else{
alert("Please Enter the Correct PNR");
}

}

</script>

<tr><td align="center" ><input type="button" value="Print PNR with Net Rate" onclick="p_net()"></td><td align="center"><input type="button" value="Print PNR with Selling Rate" onclick="p_sell()" ></td></tr>

	  <tr><td>

</td></tr>


</form>



</td>
	  </tr></table>

	
	
			 
    
			 </td>
        </tr>
      </table></td></tr>
	  
	  
      </table> 
</table>	
	
	

	</tr></table>
</body>				
</html>






