<?
session_cache_limiter('must-revalidate');
include ("header.php");


?>
<script src="../javascripts/cBoxes.js"></script>
<script>
document.title= '<? echo $company_name . " ERP - Acounts - Find Transaction Entry"; ?>';
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
        
		   



		 <form name="gquot" method="post" action="findtrana.php" onSubmit="return fun2(this)">
	
	<table style="border: 1px solid red" width="100%" >
	 <tr>

                                  <td bgcolor="#FFDFDF">&nbsp;<strong>Find Transaction Entry</strong>                                 </td>
                                </tr>
	<tr>
	  <td><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Voucher Type</font>
	    <input type="text" id="voutype" name="voutype" size="1" maxlength="2" onkeyup="gquot.voutype.value=gquot.voutype.value.toUpperCase()" onblur="gquot.voutype.value=gquot.voutype.value.toUpperCase()"> 
	    &nbsp;&nbsp;<font size="2" face="Verdana, Arial, Helvetica, sans-serif">Voucher No</font><input type="text" id="vouno" name="vouno" size="10" ></td>
    
	  </tr>
	  <tr><td>
<input type="submit" value="Find Transactions Entries" id="Submit" />
</td></tr>






</td>
	  </tr></table>

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

if((document.getElementById('voutype').value).length<=1){
document.getElementById('voutype').focus();
alert("Sorry, But Enter the Voucher Type");
return false;
}

if((document.getElementById('vouno').value).length==0){
document.getElementById('vouno').focus();
alert("Sorry, But Enter the Voucher Number");
return false;
}

}

</script>
