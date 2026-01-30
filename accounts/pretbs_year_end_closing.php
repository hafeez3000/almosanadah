<?
include ("header.php");
$vy=$vm=$vd=0;
$vy1=$vm1=$vd1=0;

$array_acc_name = array();
$array_acccode = array();
$array_parent_acc = array();
$array_parent_acc_p = array();
$array_acc_name_p = array();

$query_hotel ="select acccode,acc_name,parent_acc from accmast order BY parent_acc";

$result_hotel = pg_query($conn, $query_hotel);

if (!$result_hotel) {
	echo "An error occured.\n";
	exit;
	}
while ($rows_hotel = pg_fetch_array($result_hotel)){

$array_acc_name[] = $rows_hotel["acc_name"];
$array_acccode[] = $rows_hotel["acccode"];
$array_parent_acc[] = $rows_hotel["parent_acc"];
}

pg_free_result($result_hotel);


$parent_acc ="select parent_acc from accmast where parent_acc!=0 group BY parent_acc";

$result_parent_acc = pg_query($conn, $parent_acc);

if (!$result_parent_acc) {
	echo "An error occured.\n";
	exit;
	}
while ($rows_parent_acc = pg_fetch_array($result_parent_acc)){
$array_parent_acc_p[] = $rows_parent_acc["parent_acc"];
}

pg_free_result($result_parent_acc);


for($p=0;$p<count($array_parent_acc_p); $p++){
for($pi=0;$pi<count($array_acccode); $pi++){
if($array_acccode[$pi]==$array_parent_acc_p[$p]){
 $ac = $array_acccode[$pi];
$array_acc_name_p[$ac] = $array_acc_name[$pi];
}
}
}
asort($array_acc_name_p);
?>

<script src="../javascripts/cBoxes.js"></script>
<script>
document.title= '<? echo $company_name . " ERP - Acounts - Accounts Tree"; ?>';
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
           
		 <form name="selhotel" method="post" action="tbs_year_end_closing.php" onSubmit="return fun2(this)">
	
	<table style="border: 1px solid red" width="100%" >
	 <tr>

                                  <td bgcolor="#FFDFDF" colspan="2">&nbsp;<strong>Get Trial Balance Sheet for ... </strong>                                 </td>
                                </tr>
	
	<tr>
	  <td colspan="2"><table align="left">
        <tr>
          <td><font size="2" face="Verdana, Arial, Helvetica, sans-serif">From Date</font></td>
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
          <td><font size="2" face="Verdana, Arial, Helvetica, sans-serif">To Date&nbsp;</font></td>
          <td><font size="2" face="Verdana, Arial, Helvetica, sans-serif">
            <select name="d1Day" class="selBox">
            </select>
          </font></td>
          <td><font size="2" face="Verdana, Arial, Helvetica, sans-serif">
            <select name="d1Month" class="selBox">
            </select>
          </font></td>
          <td><font size="2" face="Verdana, Arial, Helvetica, sans-serif">
            <select name="d1Year" class="selBox">
            </select>
          </font></td>
        </tr>
      </table></td>
	  </tr>
	<tr>
      <td>For </td>
	   <script>
	function accv(){
      
	  document.getElementById("aa_name").value=document.getElementById("acname").options[document.getElementById("acname").selectedIndex].firstChild.nodeValue;
	  }
	</script>
      <td><select id="acname" name="acname" onChange="accv();">
          <option value="select">Select Account Name...</option>
          <?

      foreach($array_acc_name_p as $key => $value) {
	   
   echo  "<option value=\"$key\">$value - $key</option>";
	 
	  }



	?>
      </select>
      With Zero (0) Balance <input type="checkbox" id="withz" name="withz" ></td>
	  </tr>
		<tr><td colspan="2" align="center"><input type="hidden" name="aa_name" id="aa_name" value="select"><input type="submit" name="ssubmit" value="Get Trial Balance" ></td></tr></table>

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
    
	var tdddate = new Date();
 
    var dvy = <?php echo $vy; ?>; if (dvy==0) dvy=tdddate.getYear()
	var dvm = <?php echo $vm; ?>; if (dvm==0) dvm=tdddate.getMonth()
	var dnd = <?php echo $vd; ?>; if (dnd==0) dnd=tdddate.getDate()

   if (dvy < 2000) dvy += 1900;	


	var now_date = new Date(dvy,dvm,dnd);
    now_date.setDate(now_date.getDate()-7) 
    
	var now_day = now_date.getDate();
	var now_month = now_date.getMonth();
	var now_year = now_date.getYear();



	var dvy1 = <?php echo $vy1; ?>; if (dvy1==0) dvy1=tdddate.getYear()
	var dvm1 = <?php echo $vm1; ?>; if (dvm1==0) dvm1=tdddate.getMonth()
	var dnd1 = <?php echo $vd1; ?>; if (dnd1==0) dnd1=tdddate.getDate()

    if (dvy1 < 2000) dvy1 += 1900;


	var now_date1 = new Date(dvy1,dvm1,dnd1);
	now_date1.setDate(now_date1.getDate()) 

	var now_day1 = now_date1.getDate();
	var now_month1 = now_date1.getMonth();
	var now_year1 = now_date1.getYear();

	var d1 = new dateObj(document.selhotel.dDay, document.selhotel.dMonth, document.selhotel.dYear);
	initDates(dvy-1, dvy+1, dvy, now_month, now_day, d1);

   	var d2 = new dateObj(document.selhotel.d1Day, document.selhotel.d1Month, document.selhotel.d1Year);
	initDates(dvy1-1, dvy1+1, dvy1, now_month1, now_day1, d2);
 	
</script>
<script>
function fun2(theForm){
accv();

}
</script>
