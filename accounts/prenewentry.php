<?
session_cache_limiter('must-revalidate');
include ("header.php");


?>
<script src="../javascripts/cBoxes.js"></script>
<script>
document.title= '<? echo $company_name . " ERP - Acounts - Select Type of Transaction Entry"; ?>';
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
 
		<?

$array_voctype = array();
$array_ename = array();

$query_hotel ="select voctype,entry_name from voctypes order by entry_name";

$result_hotel = pg_query($conn, $query_hotel);

if (!$result_hotel) {
	echo "An error occured.\n";
	exit;
	}
while ($rows_hotel = pg_fetch_array($result_hotel)){

$array_voctype[] = $rows_hotel["voctype"];
$array_ename[] = $rows_hotel["entry_name"];

}

pg_free_result($result_hotel);


		?>
		   



		 <form name="gquot" method="post" action="newentry.php" onSubmit="return fun2(this)">
	
	<table style="border: 1px solid red" width="100%" >
	 <tr>

                                  <td bgcolor="#FFDFDF" colspan="2">&nbsp;<strong>Select Type of Transaction Entry </strong>                                 </td>
                                </tr>
	<tr>
	  <td><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Select</b></font>
	    <select id="acname" name="acname" >
        <option value="select">Select Type of Transaction...</option>
       
        <?

		for($i=0;$i<count($array_voctype);$i++){
       
   echo  "<option value=\"$array_voctype[$i]\">$array_ename[$i] - $array_voctype[$i]</option>";

		}

	?>
    </select>
		
    
	  
	
<input type="submit" value="Start Transactions Entries" id="Submit" />
</tr>






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

if(document.getElementById('acname').value=="select"){
document.getElementById('acname').focus();
alert("Sorry, But Select the Voucher Type");
return false;
}


}

</script>
