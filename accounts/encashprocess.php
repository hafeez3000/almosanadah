<?
include ("header.php");

$voc_type_g = $_GET['voc_type'];
$voc_no_g = $_GET['voc_no'];

$vy=$vm=$vd=0;
?>
<script src="../javascripts/cBoxes.js"></script>
<script>
document.title= '<? echo $company_name . " ERP - Acounts - Current Cheque Tally Sheet"; ?>';
</script>

<html>
<link rel="stylesheet" type="text/css" href="../calendar/css.css" />

<body  leftmargin="0" topmargin="0" rightmargin="0"  >
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
    <td width="80%" valign="top"  > <table width="100%" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td valign="top"> 
   
	<table width="100%">
      <tr>
                                  <td bgcolor="#FFDFDF">&nbsp;<strong>Change the Encash status</strong>                                 </td>
						
								</tr>
		</table>

<?

$voc_type_g = $_GET['voc_type'];
$voc_no_g = $_GET['voc_no'];

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$_SESSION['v_type']=$voc_type_g ;
$_SESSION['v_no']=$voc_no_g;


$query_voc ="select typeofv,vounum,paidto,dbamt,cramt,voudate,recfrom,encashedbull,errornotes,encashcdate from chequevou where typeofv='$voc_type_g' and vounum='$voc_no_g' ";

$result_voc = pg_query($conn, $query_voc);

if (!$result_voc) {
	echo "An error occured.\n";
	exit;
	}
while ($rows_voc = pg_fetch_array($result_voc)){

  $a_typeofv = $rows_voc["typeofv"];
$a_vounum = $rows_voc["vounum"];

  $a_paidto = $rows_voc["paidto"];
  $a_recfrom = $rows_voc["recfrom"];
  $a_dbamt = $rows_voc["dbamt"];
  $a_cramt = $rows_voc["cramt"];
  $a_voudate = $rows_voc["voudate"];
$a_encashedbull = $rows_voc["encashedbull"];
$a_errornotes = $rows_voc["errornotes"];
$a_encashcdate = $rows_voc["encashcdate"];

}


$q_hotel_sel ="select voctype, vocno  from vocmast where voctype='$voc_type_g' and vocno='$voc_no_g' ";

$res_hotel_sel = pg_query($conn, $q_hotel_sel);

$rows_hotels = pg_num_rows($res_hotel_sel);

if (!$res_hotel_sel) {
echo "An error occured.\n";
exit;
		}


if($a_encashedbull=="t"){    // if encash is true

echo "<table width=\"90%\" align=\"center\"><tr><td bgcolor=\"#9FFF9F\" align=\"center\">&nbsp;<strong>Present status of the Cheque is Encashed</strong></td></tr></table>";

?>
<form name="maketrue" method="post" action="encashprocessa.php" onSubmit="return fun2(this)"> 
<table>
<tr><td><font size="2" face="Verdana, Arial, Helvetica, sans-serif">&nbsp;Encashed ? </td><td><input type="checkbox" id="encahsed_cb" name="encahsed_cb" checked></font></td></tr>
<tr><td><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Error Date</font></td><td>
<table>
   <tr> 
      
      <td><font size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
        <select name="dDay" class="selBox">
        </select>
        </font></td>
      <td><font size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
        <select name="dMonth" class="selBox">
        </select>
        </font></td>
      <td><font size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
        <select name="dYear" class="selBox">
        </select>
        </font></td>
    </tr> 
  </table> </td>

	  </tr>

<tr><td>&nbsp;Error Message: </td><td><textarea id="errorm" name="errorm" cols="40" rows="3"></textarea></td></tr>


<tr><td colspan="2" align="right">


<input type="submit" name="ssubmit" value="Error or Cancel !" ></td></tr>

</table>



</form>

<?


}
else {             // if encash is false

echo "<table width=\"90%\" align=\"center\"><tr><td bgcolor=\"#FF9F9F\" align=\"center\">&nbsp;<strong>Present status of the Cheque is not Encashed</strong></td></tr></table>";

?>
<form name="maketrue" method="post" action="encashprocessa.php" onSubmit="return fun2(this)"> 
<table>
<tr><td><font size="2" face="Verdana, Arial, Helvetica, sans-serif">&nbsp;Encashed ? &nbsp;&nbsp;&nbsp;<input type="checkbox" id="encahsed_cb" name="encahsed_cb" ></font></td></tr>
<tr><td>
<table>
   <tr> 
      <td><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Encashed Date</font></td>
      <td><font size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
        <select name="dDay" class="selBox">
        </select>
        </font></td>
      <td><font size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
        <select name="dMonth" class="selBox">
        </select>
        </font></td>
      <td><font size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
        <select name="dYear" class="selBox">
        </select>
        </font></td>
    </tr> 
  </table> </td>

	  </tr>
</table>

<tr><td>


<input type="submit" name="ssubmit" value="Encashed !" ></td></tr>
</form>

<?
}

?>

<script>

	var tdddate = new Date();
 
    var dvy = <?php echo $vy; ?>; if (dvy==0) dvy=tdddate.getYear()
	var dvm = <?php echo $vm; ?>; if (dvm==0) dvm=tdddate.getMonth()
	var dnd = <?php echo $vd; ?>; if (dnd==0) dnd=tdddate.getDate()

   if (dvy < 2000) dvy += 1900;	


	var now_date = new Date(dvy,dvm,dnd);
    now_date.setDate(now_date.getDate()+0) 
    
	var now_day = now_date.getDate();
	var now_month = now_date.getMonth();
	var now_year = now_date.getYear();


	var d1 = new dateObj(document.maketrue.dDay, document.maketrue.dMonth, document.maketrue.dYear);
	initDates(dvy-1, dvy+1, dvy, now_month, now_day, d1);

 	
</script>

<?
if($a_encashedbull=="t"){    // if encash is true
?>
<script>


function fun2(theForm){


if(document.getElementById('encahsed_cb').checked==true){
document.getElementById('encahsed_cb').focus();
alert("Sorry, But you have un-check the Encash box");
return false;
}

}


</script>
<?
}else{
?>
	
<script>


function fun2(theForm){


if(document.getElementById('encahsed_cb').checked==false){
document.getElementById('encahsed_cb').focus();
alert("Sorry, But you have to check the Encash box");
return false;
}

}


</script>


<?
}
?>

	</td></tr>
	  
	  
      </table> 
</table>	
	
	

	</tr></table>
</body>				
</html>
