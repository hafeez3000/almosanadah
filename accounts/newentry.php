<?
session_cache_limiter('must-revalidate');
include ("header.php");
$vy=$vm=$vd=0;


$voc_t = isset($_POST["acname"]) ? $_POST["acname"] : '';
if($voc_t=="") { $voc_t = isset($_GET["acname"]) ? $_GET["acname"] : ''; }


$query_voc ="select voctype,entry_name,firste,seconde,seq from voctypes where voctype='$voc_t'";

$result_voc = pg_query($conn, $query_voc);

if (!$result_voc) {
	echo "An error occured.\n";
	exit;
	}
while ($rows_voc = pg_fetch_array($result_voc)){

$voctype_s = $rows_voc["voctype"];
$entry_name_s = $rows_voc["entry_name"];
$firste = $rows_voc["firste"]; 
$seconde = $rows_voc["seconde"];
$seq = $rows_voc["seq"];    
}
$seq++;
pg_free_result($result_voc);


	



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
document.title= '<? echo $company_name . " ERP - Acounts - New Entry"; ?>';
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
        
		   

<script>
// Last updated 2006-02-21
function addRowToTable()
{


 

  var tbl = document.getElementById('tblSample');
  var lastRow = tbl.rows.length;

  // if there's no header row in the table, then iteration = lastRow + 1

  var iteration = lastRow;



 // var iteration = parseInt(pval) + lastRow -1;



  var row = tbl.insertRow(lastRow);
  
  // left cell
  var cellLeft = row.insertCell(0);
 
//  var textNode = document.createTextNode(iteration);
//  cellLeft.appendChild(textNode);

  var rid = document.createElement('input');
  rid.type = 'text';
  rid.name = 'txtid' + iteration;
  rid.id = 'txtid' + iteration;
//  rid.value =  iteration;
  rid.size = 5;
 // rid.setAttribute("readOnly","true");
  cellLeft.appendChild(rid);

  var btt = iteration;
    var bttp = iteration+1;

  function opww_btt(){ 
  
  //var btt = iteration;

  
  var rr = "accountsearchfe.php?hn="+document.getElementById('txtid'+btt).value+"&bttv="+btt;
		
        var winPop = window.open(rr,"winPop",'menubar=yes,scrollbars=yes,toolbar=no,resizable=yes,width=700,height=300, top='+10+',left='+10+' ').focus();

  }



  var rids = document.createElement('input');
  rids.type = 'button';
  rids.name = 'acs' + iteration;
  rids.id = 'acs' + iteration;
  rids.value =  'S';
//  rid.size = 1;
 // rid.setAttribute("readOnly","true");
 var opw = opww_btt;
  rids.onclick = opw;
  cellLeft.appendChild(rids);
 

 


	function acc_btt(){
    document.getElementById("acname").value=document.getElementById('txtRow'+btt).value;

//  alert(document.getElementById("acname").value);

	 if(document.getElementById("acname").value!=""){
	 var c_val_2 =document.getElementById("acname").options[document.getElementById("acname").selectedIndex].firstChild.nodeValue;
     document.getElementById('acdes').innerHTML=c_val_2;
	 }

	  }


  // right cell
  var cellRight = row.insertCell(1);
  var el = document.createElement('input');
  el.type = 'text';
  el.name = 'txtRow' + iteration;
  el.id = 'txtRow' + iteration;
  el.size = 3;
  el.onkeyup=acc_btt;
  el.onfocus=acc_btt;
  el.onblur=acc_btt;
  cellRight.appendChild(el);


function narr_btt(){
var nar_val =document.getElementById('viewtype'+btt).value;
 document.getElementById('acdes').innerHTML=nar_val;
  }

//narration

  var cellviewtype = row.insertCell(2);
  var rvt = document.createElement('input');
  rvt.type = 'text';
  rvt.name = 'viewtype' + iteration;
  rvt.id = 'viewtype' + iteration;
  rvt.size = 30;
  rvt.onkeyup=narr_btt;
  rvt.onfocus=narr_btt;
  rvt.onblur=narr_btt;

  cellviewtype.appendChild(rvt);


function mored_btt(){
var nar_val =document.getElementById('nofp'+btt).value;
 document.getElementById('acdes').innerHTML=nar_val;
  }
// more details

  var cellnofp = row.insertCell(3);
  var nofp = document.createElement('input');
  nofp.type = 'text';
  nofp.name = 'nofp' + iteration;
  nofp.id = 'nofp' + iteration;
  nofp.size = 15; 
  nofp.onkeyup=mored_btt;
  nofp.onfocus=mored_btt;
  nofp.onblur=mored_btt;
  cellnofp.appendChild(nofp);

  



function debit_bt(){
/*  var tbl = document.getElementById('tblSample');
  var btttyp = tbl.rows.length-1; 
  if(btttyp>btt){
	 if(document.getElementById('credit'+bttp).value==0){ document.getElementById('credit'+bttp).value=document.getElementById('roomd'+btt).value;
	 }
 }
*/
   var fortota = tbl.rows.length;
  var tot_db=0.0;
  var tot_cr=0.0;
  for (i=1;i<fortota;i++){
  tot_db = tot_db + parseFloat(document.getElementById('roomd'+i).value);
  tot_cr = tot_cr + parseFloat(document.getElementById('credit'+i).value);
  }
    tot_db = Math.round(tot_db*100)/100;
    tot_cr = Math.round(tot_cr*100)/100;
 document.getElementById('des_db').innerHTML=tot_db;
 document.getElementById('des_cr').innerHTML=tot_cr;

  }


function emptyd_c(){
  if(((document.getElementById('roomd'+btt).value).length)==0){	document.getElementById('roomd'+btt).value=0;
//  debit_bt();
 }

  }


 
  var cellroomd = row.insertCell(4);
  var roomd = document.createElement('input');
  roomd.type = 'text';
  roomd.name = 'roomd' + iteration;
  roomd.id = 'roomd' + iteration;
  roomd.value = 0;
  
  roomd.onkeyup=debit_bt;
  roomd.onfocus=debit_bt;
  roomd.onblur=debit_bt;
  roomd.onblur=emptyd_c;
  roomd.size = 3;
  cellroomd.appendChild(roomd);
  


function credit_bt(){
 /*
  var tbl = document.getElementById('tblSample');
  var btttyp = tbl.rows.length-1; 
  if(btttyp>btt){	
if(document.getElementById('roomd'+bttp).value==0){document.getElementById('roomd'+bttp).value=document.getElementById('credit'+btt).value;}

 }
*/
  var fortota = tbl.rows.length;
  var tot_db=0.0;
  var tot_cr=0.0;
  for (i=1;i<fortota;i++){
  tot_db = tot_db + parseFloat(document.getElementById('roomd'+i).value);
  tot_cr = tot_cr + parseFloat(document.getElementById('credit'+i).value);
  }
    tot_db = Math.round(tot_db*100)/100;
    tot_cr = Math.round(tot_cr*100)/100;
 document.getElementById('des_db').innerHTML=tot_db;
 document.getElementById('des_cr').innerHTML=tot_cr;

  }

function emptyc_c(){
  if(((document.getElementById('credit'+btt).value).length)==0){	document.getElementById('credit'+btt).value=0;
//  credit_bt();
 }

  }



  var cellcredit = row.insertCell(5);
  var credit = document.createElement('input');
  credit.type = 'text';
  credit.name = 'credit' + iteration;
  credit.id = 'credit' + iteration;
  credit.value = 0;
  credit.size = 3;
  
  credit.onkeyup=credit_bt;
  credit.onfocus=credit_bt;
  credit.onblur=credit_bt;
  credit.onblur=emptyc_c;
  
  cellcredit.appendChild(credit);


//  document.getElementById('it_val').value=tbl.rows.length-1;

  if(iteration>1){
  var bt = iteration-1;
  document.getElementById('txtid' + bt).focus();
  }
document.getElementById('it_val').value = iteration;


}
function removeRowFromTable()
{
  var tbl = document.getElementById('tblSample');
  var lastRow = tbl.rows.length;
  if (lastRow > 2) tbl.deleteRow(lastRow - 1);
  document.getElementById('it_val').value=tbl.rows.length-1;

  document.getElementById('it_val').value = lastRow;
}

function accv(){

    var c_val =document.getElementById("acname").options[document.getElementById("acname").selectedIndex].firstChild.nodeValue;

document.getElementById('acdes').innerHTML=c_val;

 var tbl = document.getElementById('tblSample');
  var bttt = tbl.rows.length; 
  for (i =1;i<bttt;i++){
	if(((document.getElementById('txtRow'+i).value).length)==0){
	document.getElementById('txtRow'+i).value= document.getElementById("acname").value; 
	break;
	}
  } 

 
 }







</script>


		 <form name="gquot" method="post" action="newentrya.php" onSubmit="return fun2(this)">
	
	<table style="border: 1px solid red" width="100%" >
	 <tr>

                                  <td bgcolor="#FFDFDF">&nbsp;<strong>New Transaction Entry - <? echo $entry_name_s ." - ". $voctype_s?>  </strong>                                 </td>
                                </tr>
	 <tr>
      <td bgcolor="#FFDFDF">&nbsp;<strong><? echo $firste ?></strong>                                 </td>
     </tr>
	 <tr>
      <td bgcolor="#FFDFDF">&nbsp;<strong><? echo $seconde ?></strong>                                 </td>
     </tr>

	<tr>
	  <td><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Voucher Type</font>
	    <input type="text" id="voutype" name="voutype" size="1" value=<? echo $voctype_s ?> maxlength="2" onkeyup="gquot.voutype.value=gquot.voutype.value.toUpperCase()" onblur="gquot.voutype.value=gquot.voutype.value.toUpperCase()" > 
	    &nbsp;&nbsp;<font size="2" face="Verdana, Arial, Helvetica, sans-serif">Voucher No</font><input type="text" id="vouno" name="vouno" value=<? echo $seq ?> size="10" ></td>
    
	  </tr>
	<tr>
	  <td><table align="left">
   <tr> 
      <td><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Voucher Date</font></td>
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
  </table> <font size="2" face="Verdana, Arial, Helvetica, sans-serif">Reference No</font> <input type="text" id="refno" name="refno" size="2" ></td>

	  </tr>
	
	<tr>
	
	  <td>	  </td></tr>	
	  
	  <tr>
	  <td><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Account Desc</font> <select id="acname" name="acname"  onChange="accv();">
        <option value="select">Select Account Name...</option>
       
        <?

		for($i=0;$i<count($array_acccode);$i++){
       
   echo  "<option value=\"$array_acccode[$i]\">$array_acc_name[$i] - $array_acccode[$i]</option>";

		}

	?>
    </select></td></tr>
	  
	  
	  <tr>
	    <td align="center"><table border="1" id="tblSample" width="100%">
  <tr>
    <th><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Search</font></th>    <th><font size="2" face="Verdana, Arial, Helvetica, sans-serif">A/C Code</font></th>    <th><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Narration</font></th>    <th><font size="2" face="Verdana, Arial, Helvetica, sans-serif">More Details</font></th>    <th><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Debit</font></th><th><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Credit</font></th>
</tr>
</table>
<table border="1" width="100%">
<tr><td colspan="4"><SPAN ID="acdes"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Account Description</font></SPAN>
</td><td width="55"><SPAN ID="des_db"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Debit</font></SPAN></td><td width="55"><SPAN ID="des_cr"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Credit</font></SPAN></td></tr>
</table>
<br>
<input type="button" value="Add" onClick="addRowToTable();addRowToTable();" />
<input type="hidden" id="seq_val" name="seq_val" value="<? echo $seq ;?>"/>
<input type="hidden" id="it_val" name="it_val" />
<input type="hidden" name="action" value="unsubmitted" /> 
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input type="checkbox" id="inscb" name="inscb" unchecked onClick="sameas();" />
<input type="submit" value="Post Transactions" id="Submit" disabled />
<input type="button" value="Remove" onClick="removeRowFromTable();" />






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


	var d1 = new dateObj(document.gquot.dDay, document.gquot.dMonth, document.gquot.dYear);
	initDates(dvy-1, dvy+1, dvy, now_month, now_day, d1);

 	
</script>
<script>

function sameas(){


var sb=0;

 
 
 var tbl = document.getElementById('tblSample');
 var fctl = tbl.rows.length; 


 
for (i=1;i<fctl;i++){
if((document.getElementById('txtRow'+i).value).length==0){
document.getElementById('txtRow'+i).focus();
alert("Enter the Account Code");
sb=0;
document.getElementById('inscb').checked=false;
break;
}
else if((document.getElementById('viewtype'+i).value).length==0){
document.getElementById('viewtype'+i).focus();
alert("Enter the Narration");
sb=0;
document.getElementById('inscb').checked=false;
break;
}
else {sb=1;}
}
  
  
  
  
  var tot_db=0;
  var tot_cr=0;
  
  if(sb==1) {  //start second bull

  for (i=1;i<fctl;i++){
  tot_db = tot_db + parseFloat(document.getElementById('roomd'+i).value);
  tot_cr = tot_cr + parseFloat(document.getElementById('credit'+i).value);
  }
    tot_db = Math.round(tot_db*100)/100;
    tot_cr = Math.round(tot_cr*100)/100;

if(tot_db==tot_cr && (tot_db!=0 && tot_cr!=0)){

if(document.getElementById('inscb').checked==true){
document.getElementById('Submit').disabled=false;
}
else {
document.getElementById('Submit').disabled=true;
}

}
else { alert("Make Sure the Debit and Credit Amounts are Equal"); 
document.getElementById('inscb').checked=false;
}

  } //end of second bull






} // end of sameas



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

addRowToTable();
addRowToTable();
</script>
