<?
include ("header.php");
?>
<script src="../javascripts/DS.js"></script>
<script>
 window.onload = function() {
   	document.selhotel.city.focus();
 }
</script>

<script>
function subdis(){
document.selhotel.mainsub.disabled = true;
}

function suben(){
document.selhotel.mainsub.disabled = false;
}

function noenter() {
return !(window.event && window.event.keyCode == 13); }
</script>

<script>
function assv(){
document.selhotel.hotelv.value = document.selhotel.city.options[document.selhotel.city.selectedIndex].value
}
</script>

<script type="text/javascript">
      function OpenWindow(){
     
		var rr = "transsearchdet.php?hn="+document.selhotel.hotelname.value;
		
        var winPop = window.open(rr,"winPop",'scrollbars=yes,toolbar=no,resizable=yes,width=550,height=300' ).focus();
      }
    </script>

    <style type="text/css">
<!--
.style2 {
	font-size: 14px;
	font-weight: bold;
	color: #FF0000;
}
.style3 {
	color: #FF0000;
	font-weight: bold;
}
-->
    </style>
    
<table width="100%" border="0" cellpadding="0" cellspacing="0" style="border-bottom: 3px solid #006600; border-right: 3px solid #006600;border-left: 3px solid #006600 ">
  <tr>
    <td width="20%" style="border-right: 1px solid #999999"  valign="top"> <table width="100%" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td valign="top"><div align="left"> 
              <?include ("umenu.php"); ?>
            </div></td>
        </tr>
      </table></td>
    <td width="80%" valign="top"  > <table width="100%" border="0" cellpadding="0" cellspacing="1">
        <tr>
          <td valign="top"> 

<table cellpadding="0" cellspacing="0" width="100%" style="border-top: 1px solid #999999; border-bottom: 1px solid #999999"><tr>
                      <td bgcolor="#CCCCCC"><strong> <font size="2" face="Verdana, Arial, Helvetica, sans-serif">Transportation Suppliers Details</font></td>
                    </tr></table>


<?

$array_trans = array();
$array_trans_id = array();


$query_trans ="select trans_id, trans_c_name from s_trans order by trans_c_name";

$result_trans = pg_query($query_trans);

if (!$result_trans) {
	echo "An error occured.\n";
	exit;
	}
while ($rows_trans = pg_fetch_array($result_trans)){

$array_trans[] = $rows_trans["trans_c_name"];
$array_trans_id[] = $rows_trans["trans_id"];

}

pg_free_result($result_trans);

?>
		  

 <table width="100%" border="0" cellspacing="0">
						  <tr><td colspan="4">&nbsp;</td></tr>
  						 
						  <tr bgcolor="#CCCCCC"><td colspan="4"> 
						  <form name="selhotel" method="post" action="transdetailsa.php" >


  <tr bgcolor="#EFEFEF">
  <td colspan="3">
  <table align="center">
   

  </table> 
  
  </td>
  </tr>

    <tr> 
     
      <td bgcolor="#DFDFFF" colspan="2"><div align="center"><strong><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Transportation Supplier Details</font></strong></div></td>
         </tr>
    <tr> 
      <td valign="top" bgcolor="#EFEFEF" align="right"> 
	  
	  <select id="city" name="city"  onFocus="assv();" onBlur="assv();" onChange="assv();">
        <option value="select">Select Transportation Supplier...</option>
       
        <?
		for($i=0;$i<count($array_trans_id);$i++){
  echo  "<option value=\"$array_trans_id[$i]\">$array_trans[$i]</option>";
}
	?>
    </select></td>

  <td bgcolor="#EFEFEF" align="left"> 
		  
         <input type="hidden" name="hotelv">
		  <input type="submit" name="mainsub" value="Get Transportation Details">
        </td>

</tr>




  
    
	    
    
	<tr><td colspan="4"><div align="center"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">OR</font></div></td></tr>						   
	<tr><td colspan="4" bgcolor="#EFEFEF" align="center" ><font size="2" face="Verdana, Arial, Helvetica, sans-serif">   Enter the Transportation Supplier Name :</font><input type="text" name="hotelname" onFocus="subdis()" onKeyPress="return noenter()" > <input type="button" name="searchhotel" value="search" onClick="OpenWindow()"></td></tr>
  
</form></td></tr></table>


<br>

<form name="newhotel" method="post" action="createnewtrans.php">
<table width="100%">
  <tr>
    <td bgcolor="#EFEFEF"><div align="center"><span class="style3"><font face="Verdana, Arial, Helvetica, sans-serif">Do You Want to create New Tranportation Supplier ?</font></span></div></td>
  </tr>
    <tr>
    <td bgcolor="#EFEFEF"><div align="center"><span class="style3"><font face="Verdana, Arial, Helvetica, sans-serif">Have you check the Transportation supplier existance ?</font></span></div></td>
  </tr>
  
  <tr><td bgcolor="#EFEFEF"><div align="center"><span class="style2"><font face="Verdana, Arial, Helvetica, sans-serif">
   
    <input type="submit" name="Submit" value="Create New Transporation Supplier" />
   
  </font></span></div></td>
</tr>
</table>
</form>


     </td></tr></table> 

</td></tr></table> 

</td></tr></table> 

</td></tr></table> 




