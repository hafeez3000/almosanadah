<?
session_cache_limiter('must-revalidate');
include ("header.php");
$vy=$vm=$vd=0;

$array_acc_name_d = array();
$array_acccodec_d = array();



$query_hotel ="select acccode,acc_name from accmast ORDER BY acc_name";

$result_hotel = pg_query($conn, $query_hotel);

if (!$result_hotel) {
	echo "An error occured.\n";
	exit;
	}
while ($rows_hotel = pg_fetch_array($result_hotel)){

$array_acc_name_d[] = $rows_hotel["acc_name"];
$array_acccode_d[] = $rows_hotel["acccode"];

}

pg_free_result($result_hotel);

$s_voctype = isset($_POST["voutype"]) ? $_POST["voutype"] : '';
$s_vocno = trim(isset($_POST["vouno"]) ? (string)$_POST["vouno"] : '');

if($s_voctype==""){
$s_voctype = $_GET["voutype"];
$s_vocno = $_GET["vouno"];
}



$query_voc ="select voctype,entry_name,firste,seconde,seq from voctypes where voctype='$s_voctype' ";

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

pg_free_result($result_voc);



$array_voctype   = array();
$array_vocno	  = array();
$array_vocsno	  = array();
$array_vocdate	  = array();
$array_acccode	  = array();
$array_narration = array();
$array_dbamt	  = array();
$array_cramt	  = array();
$array_pnr	  = array();
$array_invno	  = array();
$array_moredet	  = array();
$array_recon	  = array();
$array_sinvno	  = array();
$array_supp_inv  = array();
$array_sinvtype  = array();

$query_vocm ="select voctype,vocno,vocsno,vocdate,acccode,narration,dbamt,cramt,pnr,invno,moredet,recon,sinvno,supp_inv,sinvtype from vocmast where voctype='$s_voctype' and vocno='$s_vocno' order by vocsno";

$result_vocm = pg_query($conn, $query_vocm);

if (!$result_vocm) {
	echo "An error occured.\n";
	exit;
	}
while ($rows_vocm = pg_fetch_array($result_vocm)){

$array_voctype[] = $rows_vocm["voctype"];  
$array_vocno[] = $rows_vocm["vocno"];    
$array_vocsno[] = $rows_vocm["vocsno"];   
$array_vocdate[] = $rows_vocm["vocdate"];  
$array_acccode[] = $rows_vocm["acccode"];  
$array_narration[] = $rows_vocm["narration"];
$array_dbamt[] = $rows_vocm["dbamt"];    
$array_cramt[] = $rows_vocm["cramt"];    
$array_pnr[] = $rows_vocm["pnr"];      
$array_invno[] = $rows_vocm["invno"];    
$array_moredet[] = $rows_vocm["moredet"];  
$array_recon[] = $rows_vocm["recon"];    
$array_sinvno[] = $rows_vocm["sinvno"];   
$array_supp_inv[] = $rows_vocm["supp_inv"]; 
$array_sinvtype[] = $rows_vocm["sinvtype"]; 

}

pg_free_result($result_vocm);

if($array_vocdate[0]==0){ }
else{


$vy=date('Y', strtotime($array_vocdate[0]));
$vm=date('m', strtotime($array_vocdate[0]));
$vd=date('d', strtotime($array_vocdate[0]));
}

?>
<script src="../javascripts/cBoxes.js"></script>
<script>
document.title= '<? echo $company_name . " ERP - Acounts - Transaction Entry Details"; ?>';
</script>
<script>
 var winl = (screen.width - 760) / 2; 
 var wint = (screen.height - 550) / 2;
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
//  var pval = '<? // echo $array_room_id[0] ; ?>'
//   var pval = '<? // if($array_room_id[0]=="") { echo $s_hotelsb . "11"; } else { echo $array_room_id[0] ;}?>'

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
  debit_bt();
 }

  }


 
  var cellroomd = row.insertCell(4);
  var roomd = document.createElement('input');
  roomd.type = 'text';
  roomd.name = 'roomd' + iteration;
  roomd.id = 'roomd' + iteration;
  
  roomd.onkeyup=debit_bt;
  roomd.onfocus=debit_bt;
  roomd.onblur=debit_bt;
  roomd.onblur=emptyd_c;
  roomd.size = 3;
  roomd.value = 0;
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
  credit_bt();
 }

  }



  var cellcredit = row.insertCell(5);
  var credit = document.createElement('input');
  credit.type = 'text';
  credit.name = 'credit' + iteration;
  credit.id = 'credit' + iteration;
  credit.size = 3;
  credit.value = 0;
   
  credit.onkeyup=credit_bt;
  credit.onfocus=credit_bt;
  credit.onblur=credit_bt;
  credit.onblur=emptyc_c;

  
  cellcredit.appendChild(credit);

function delcvoc_btt(){
var tbdelc = document.getElementById('tblSample');
var fctdc = tbdelc.rows.length;
var tot_db=0; 
var tot_cr=0; 
for (i=1;i<fctdc;i++){  
tot_db = tot_db + parseFloat(document.getElementById('roomd'+i).value); 
tot_cr = tot_cr + parseFloat(document.getElementById('credit'+i).value); 
} 

if(tot_db==tot_cr && (tot_db!=0 && tot_cr!=0) && (document.getElementById('roomd'+btt).value==0) && (document.getElementById('credit'+btt).value==0) ){ 
document.getElementById('it_val').value = fctdc;
var cnb = confirm('Are you sure you want to delete Voucher Transaction Entry?');
if(cnb=true){ document.gquot.submit(); }

return false;
}
else{ return false; }

 }

  var cellde = row.insertCell(6);
  var anode = document.createElement('a');
  anode.setAttribute('href','deltransitem.php?voct='+ '<? echo $s_voctype ;?>' + '&vocno=' + '<? echo $s_vocno ; ?>' + '&vocsno=' + iteration);
  var textNode = document.createElement('img');
  textNode.setAttribute('src','../images/delete.gif');
  anode.onclick = delcvoc_btt; 
  anode.appendChild(textNode);
  cellde.appendChild(anode);



  if(iteration>1){
  var bt = iteration-1;
  document.getElementById('txtid' + bt).focus();
  }



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


		 <form name="gquot" method="post" action="amendtrans.php" onSubmit="return fun2(this)">
	
	<table style="border: 1px solid red" width="100%" >
	 <tr>

                                  <td bgcolor="#FFDFDF">&nbsp;<strong>Transaction Entry Details of <? echo $s_voctype ."-". $s_vocno ?> &nbsp;&nbsp;&nbsp; </strong> <a href="delvocno.php?act=<? echo $s_voctype ;?>&minv=<? echo $s_vocno; ?>" onclick="return confirm('Are you sure you want to delete Transactions ?')">Delete Transactions </a>                               </td>
                                </tr>
 <tr>
      <td bgcolor="#FFDFDF">&nbsp;<strong><? echo $firste ?></strong>                                 </td>
     </tr>
	 <tr>
      <td bgcolor="#FFDFDF">&nbsp;<strong><? echo $seconde ?></strong>                                 </td>
     </tr>

	<tr>
	  <td><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Voucher Type</font>
	    <input type="text" id="voutype" name="voutype" size="1" maxlength="2" value=<? echo $s_voctype; ?>  onkeyup="gquot.voutype.value=gquot.voutype.value.toUpperCase()" onblur="gquot.voutype.value=gquot.voutype.value.toUpperCase()" > 
	    &nbsp;&nbsp;<font size="2" face="Verdana, Arial, Helvetica, sans-serif">Voucher No</font><input type="text" id="vouno" name="vouno" size="10" value=<? echo $s_vocno ; ?>> &nbsp;&nbsp;&nbsp; <a href="pnrtransv.php?act=<? echo $s_voctype ;?>&minv=<? echo $s_vocno; ?>" target="pnrtrans" onClick="window.open('', 'pnrtrans','width=750,height=450,menubar=yes,scrollbars=yes, top='+wint+',left='+winl+' ').focus()"><img src="../images/print_icon.gif" width="16" height="16"></a> </td>
    
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
  </table> <font size="2" face="Verdana, Arial, Helvetica, sans-serif">Reference No</font> <input type="text" id="refno" name="refno" size="5" value=<? echo isset($array_supp_inv[0]) ? $array_supp_inv[0] : ''; ?> ></td>

	  </tr>
	
	<tr>
	
	  <td>	  </td></tr>	
	  
	  <tr>
	  <td><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Account Desc</font> <select id="acname" name="acname"  onChange="accv();">
        <option value="select">Select Account Name...</option>
       
        <?

		for($i=0;$i<count($array_acccode_d);$i++){
       
   echo  "<option value=\"$array_acccode_d[$i]\">$array_acc_name_d[$i] - $array_acccode_d[$i]</option>";

		}

	?>
    </select></td></tr>
	  
	  
	  <tr>
	    <td align="center"><table border="1" id="tblSample" width="100%">
  <tr>
    <th><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Search</font></th>    <th><font size="2" face="Verdana, Arial, Helvetica, sans-serif">A/C Code</font></th>    <th><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Narration</font></th>    <th><font size="2" face="Verdana, Arial, Helvetica, sans-serif">More Details</font></th>    <th><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Debit</font></th><th><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Credit</font></th><th><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><img src="../images/delete.gif" alt="Delete" ></font></th>
</tr>


<?

		
		for($i=0;$i<count($array_vocsno);$i++){
$ac = count($array_vocsno)+1;
$ii=$i+1;

echo "<script>function opww_$array_vocsno[$i](){ var rr =  \"accountsearchfe.php?hn=\"+document.getElementById(\"txtid$array_vocsno[$i]\").value+\"&bttv=\"+$array_vocsno[$i]; var winPop = window.open(rr,\"winPop\",'menubar=yes,scrollbars=yes,toolbar=no,resizable=yes,width=700,height=300, top='+10+',left='+10+' ').focus(); } </script>";

echo "<script>function acc_$array_vocsno[$i](){ document.getElementById(\"acname\").value=document.getElementById(\"txtRow$array_vocsno[$i]\").value ; var c_val_2 =document.getElementById(\"acname\").options[document.getElementById(\"acname\").selectedIndex].firstChild.nodeValue; document.getElementById('acdes').innerHTML=c_val_2  } </script>";

//echo "<script>function debit_$array_vocsno[$i](){  var tbl = document.getElementById(\"tblSample\"); var btttyp = tbl.rows.length-1; if(btttyp>$array_vocsno[$i]){document.getElementById(\"credit$array_vocsno[$ii]\").value=document.getElementById(\"roomd$array_vocsno[$i]\").value;}}</script>";

echo "<script>function debit_$array_vocsno[$i](){  var fortota = $ac;  var tot_db=0.0;  var tot_cr=0.0;   for (i=1;i<fortota;i++){   tot_db = parseFloat(tot_db) + parseFloat(document.getElementById(\"roomd\"+i).value);  tot_cr = parseFloat(tot_cr) + parseFloat(document.getElementById(\"credit\"+i).value);  } tot_db = Math.round(tot_db*100)/100;   tot_cr = Math.round(tot_cr*100)/100; document.getElementById(\"des_db\").innerHTML=tot_db; document.getElementById(\"des_cr\").innerHTML=tot_cr;}</script>";


echo "<script>function emptyd_c(){ if(((document.getElementById(\"roomd$array_vocsno[$i]\").value).length)==0){document.getElementById(\"roomd$array_vocsno[$i]\").value=0;debit_$array_vocsno[$i]();}}</script>";	

//echo "<script>function credit_$array_vocsno[$i](){var tbl = document.getElementById(\"tblSample\");  var btttyp = tbl.rows.length-1;  if(btttyp>$array_vocsno[$i]){document.getElementById(\"roomd$array_vocsno[$ii]\").value=document.getElementById(\"credit$array_vocsno[$i]\").value; }  } </script>";

echo "<script>function credit_$array_vocsno[$i](){  var fortota = $ac;  var tot_db=0.0;  var tot_cr=0.0;   for (i=1;i<fortota;i++){   tot_db = tot_db + parseFloat(document.getElementById(\"roomd\"+i).value);  tot_cr = tot_cr + parseFloat(document.getElementById(\"credit\"+i).value);  } tot_db = Math.round(tot_db*100)/100;   tot_cr = Math.round(tot_cr*100)/100; document.getElementById(\"des_db\").innerHTML=tot_db; document.getElementById(\"des_cr\").innerHTML=tot_cr;}</script>";


echo "<script>function narr_$array_vocsno[$i](){var nar_val =document.getElementById(\"viewtype$array_vocsno[$i]\").value; document.getElementById(\"acdes\").innerHTML=nar_val;  }</script>";

echo "<script>function mored_$array_vocsno[$i](){var nar_val =document.getElementById(\"nofp$array_vocsno[$i]\").value; document.getElementById(\"acdes\").innerHTML=nar_val;  }</script>";

echo "<script>function emptyc_c(){ if(((document.getElementById(\"credit$array_vocsno[$i]\").value).length)==0){document.getElementById(\"credit$array_vocsno[$i]\").value=0; credit_$array_vocsno[$i]();  } } </script>";

	
	echo "<tr>";

	echo "<td><input type=\"text\" name=\"txtid$array_vocsno[$i]\" id=\"txtid$array_vocsno[$i]\" size=\"5\"  />";

	echo "<input type=\"button\" name=\"acs$array_vocsno[$i]\" id=\"acs$array_vocsno[$i]\" value=\"S\" onClick=\"opww_$array_vocsno[$i]();\" /></td>";



    echo "<td><input type=\"text\" name=\"txtRow$array_vocsno[$i]\" id=\"txtRow$array_vocsno[$i]\" size=\"3\" value=\"$array_acccode[$i]\" onClick=\"acc_$array_vocsno[$i]();\" onBlur=\"acc_$array_vocsno[$i]();\" onFocus=\"acc_$array_vocsno[$i]();\" onkeyup=\"acc_$array_vocsno[$i]();\" /></td>";
		


    echo "<td><input type=\"text\" name=\"viewtype$array_vocsno[$i]\" id=\"viewtype$array_vocsno[$i]\" size=\"30\" value=\"$array_narration[$i]\" onBlur=\"narr_$array_vocsno[$i]();\" onFocus=\"narr_$array_vocsno[$i]();\" onkeyup=\"narr_$array_vocsno[$i]();\" /></td>";

	 echo "<td><input type=\"text\" name=\"nofp$array_vocsno[$i]\" id=\"nofp$array_vocsno[$i]\" size=\"15\" value=\"$array_moredet[$i]\" onBlur=\"mored_$array_vocsno[$i]();\" onFocus=\"mored_$array_vocsno[$i]();\" onkeyup=\"mored_$array_vocsno[$i]();\" /></td>";




	  echo "<td><input type=\"text\" name=\"roomd$array_vocsno[$i]\" id=\"roomd$array_vocsno[$i]\" size=\"3\" value=\"$array_dbamt[$i]\" onkeyup=\"debit_$array_vocsno[$i]();\" onfocus =\"debit_$array_vocsno[$i]();\" onBlur=\"debit_$array_vocsno[$i]();\" onBlur=\"emptyd_c();\"  /></td>";

	  echo "<td><input type=\"text\" name=\"credit$array_vocsno[$i]\" id=\"credit$array_vocsno[$i]\" size=\"3\" value=\"$array_cramt[$i]\" onkeyup=\"credit_$array_vocsno[$i]();\" onfocus=\"credit_$array_vocsno[$i]();\" onBlur=\"credit_$array_vocsno[$i]();\" onBlur=\"emptyc_c();\"/></td>";

 echo "<td>";



//echo "<script>function del_ch_$array_vocsno[$i](){ var tbl = document.getElementById('tblSample');  var fctdc = tbl.rows.length; var tot_db=0; var tot_cr=0; for (i=1;i<fctdc;i++){  tot_db = tot_db + parseFloat(document.getElementById(\"roomd\"+i).value); tot_cr = tot_cr + parseFloat(document.getElementById(\"credit\"+i).value); } if(tot_db==tot_cr && (tot_db!=0 && tot_cr!=0) && (document.getElementById(\"roomd$array_vocsno[$i]\").value==0) && (document.getElementById(\"credit$array_vocsno[$i]\").value==0) ){ document.getElementById('it_val').value = fctdc; var cnb = confirm('Are you sure you want to delete Voucher Transaction Entry?'); if(cnb=true){ document.gquot.submit(); }  return false;}else{ return false; }  }</script>"; 

echo "<script>function del_ch_$array_vocsno[$i](){  var cnb = confirm('Are you sure you want to delete Voucher Transaction Entry?'); if(cnb){ return true; }}</script>"; 


 echo "<a href=\"deltransitem.php?voct=$s_voctype&vocno=$s_vocno&vocsno=$array_vocsno[$i]\" onclick=\"return del_ch_$array_vocsno[$i]()\"><img src=\"../images/delete.gif\" alt=\"Click to Delete\"></a>";
echo "</td>";
		  echo 	"</tr>";

		
		}


?>



</table>

<table border="1" width="100%">
<tr><td colspan="4"><SPAN ID="acdes"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Account Description</font></SPAN>
</td><td width="55"><SPAN ID="des_db"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Debit</font></SPAN></td><td width="55"><SPAN ID="des_cr"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Credit</font></SPAN></td><td width="15">&nbsp;</td></tr>
</table>

 <?	$ac = count($array_vocsno)+1; ?>

<script>function debit_credit(){ 
	var fortota =parseInt('<? echo $ac ;?>');
	var tot_db=0.00;  
	var tot_cr=0.00;   
	var db_amt=0.00;
	var cr_amt=0.00;

	for (i=1;i<fortota;i++){  
        
		db_amt = parseFloat(document.getElementById('roomd'+i).value);  
		tot_db = parseFloat(tot_db + db_amt);  
  		cr_amt = parseFloat(document.getElementById('credit'+i).value);  
		tot_cr = parseFloat(tot_cr + cr_amt);
       
	   	} 
    tot_db = Math.round(tot_db*100)/100;
    tot_cr = Math.round(tot_cr*100)/100;
		document.getElementById('des_db').innerHTML=tot_db; document.getElementById('des_cr').innerHTML=tot_cr;
		
		}
	debit_credit();	
		</script>

<br>
<input type="button" value="Add" onClick="addRowToTable();addRowToTable();" />

<input type="hidden" id="it_val" name="it_val" />
<input type="hidden" name="action" value="unsubmitted" /> 
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input type="checkbox" id="inscb" name="inscb" unchecked onClick="sameas();" />
<input type="submit" value="Amend Transactions" id="Submit" disabled />
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
    // alert(dvy);

    var dvy = <?php echo $vy; ?>; if (dvy==0) dvy=tdddate.getYear()
	var dvm = <?php echo $vm; ?>; if (dvm==0) dvm=tdddate.getMonth()
	var dnd = <?php echo $vd; ?>; if (dnd==0) dnd=tdddate.getDate()
  //  alert(dvy);



   if (dvy < 2000) dvy += 1900;	



	var now_date = new Date(dvy,dvm-1,dnd);
    now_date.setDate(now_date.getDate()) 
    
	var now_day = now_date.getDate();
	var now_month = now_date.getMonth();
	var now_year = now_date.getYear();
//    alert(dvy);
  
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
else if(isNaN(document.getElementById('roomd'+i).value)){
document.getElementById('roomd'+i).focus();
alert("Sorry but Amount shoud not be empty");
sb=0;
document.getElementById('inscb').checked=false;
break;
}
else if(isNaN(document.getElementById('credit'+i).value)){
document.getElementById('credit'+i).focus();
alert("Sorry but Amount shoud not be empty");
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


var tblf = document.getElementById('tblSample');
document.getElementById('it_val').value = tblf.rows.length;


}

</script>
