<?
session_cache_limiter('must-revalidate');
include ("header.php");
$vy=$vm=$vd=0;


$voc_t = "CP";

if($voc_t=="") { $voc_t = $_GET["acname"]; }


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




$query_st ="select statementno,status  from pettystatement where status=1";

$result_st = pg_query($conn, $query_st);

if (!$result_st) {
	echo "An error occured.\n";
	exit;
	}
while ($rows_st = pg_fetch_array($result_st)){

$statementno_s = $rows_st["statementno"];
}

pg_free_result($result_st);	



$array_acc_name = array();
$array_acccode = array();

$query_hotel ="select acccode,acc_name from accmast where parent_acc!='102000' and acccode!='102000' ORDER BY acc_name";

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
document.title= '<? echo $company_name . " ERP - Acounts - Cash Payment Voucher"; ?>';
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
    <td width="80%" valign="top"  > <table width="100%" border="0" cellpadding="0" cellspacing="1">
        <tr>
          <td valign="top"> 
        
		   


		 <form name="selhotel" method="post" action="cashpaymenta.php" onSubmit="return fun2(this)">
	
	<table style="border: 1px solid red" width="100%" >
	 <tr>

                                  <td bgcolor="#FFDFDF">&nbsp;<strong>New Cash Payment Voucher</strong>                                 </td>
                                </tr>
       <tr><td align="center"><img src="../images/letterheadb.jpg"></td></tr>

	 <tr>
      <td align="center"><font size="3" face="Arial,Verdana,Helvetica, sans-serif"><strong>Cash Payment Voucher</strong></font>                                 <br><br></td>
     </tr>
	

	<tr>
	  <td><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Voucher Type</font>
	    <input type="text" id="voutype" name="voutype" size="1" value=<? echo $voctype_s ?> maxlength="2" readonly > 
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
  </table> <font size="2" face="Verdana, Arial, Helvetica, sans-serif">Statement No</font> <input type="text" id="refno" name="refno" size="2" value="<? echo $statementno_s ;?>"></td>

	  </tr>
	
	<tr><td><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Paid to:</font> <input type="text" id="paidto" name="paidto" size="85" >	  </td></tr>	
	
	<tr><td><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Being :&nbsp; </font> <textarea id="beingp" name="beingp" cols="65" rows="3" ></textarea>	  </td></tr>	  

<script>

// Removes leading whitespaces
function LTrim( value ) {
	
	var re = /\s*((\S+\s*)*)/;
	return value.replace(re, "$1");
	
}

// Removes ending whitespaces
function RTrim( value ) {
	
	var re = /((\s*\S+)*)\s*/;
	return value.replace(re, "$1");
	
}

function trim( value ) {
	
	return LTrim(RTrim(value));
	
}


function regular(string) {
if (!string) return false;
var Chars = "0123456789.";

for (var i = 0; i < string.length; i++)
{ if (Chars.indexOf(string.charAt(i)) == -1)
return false;
}
return true;
} 


function isInt(myNum) {
alert(myNum.indexOf("."));	 
			   
      /*   if () {
                 return true;
         } else {
                 return false;
         }
		 */
}


var Suffix = new Array('units',
  'Thousand', 'Million', 'Billion', 'Tera', 'Peta', 'Exa')
var Name = new Array
  ('Zero', 'One', 'Two', 'Three', 'Four', 'Five', 'Six',
  'Seven', 'Eight', 'Nine', 'Ten', 'Eleven', 'Twelve',
  'Thirteen', 'Fourteen', 'Fifteen',  'Sixteen', 'Seventeen',
  'Eighteen', 'Nineteen')
var Namety = new Array('Twenty', 'Thirty', 'Forty',
  'Fifty', 'Sixty', 'Seventy', 'Eighty', 'Ninety')

var TryNo = 0, Tries = new Array('0', '1', '3', '14',
  '27', '100', '103', '567', '1000', '1005')


  function Small(TC, J, K) {
  if (J==0) return TC
  if (J>999) return ' Internal ERROR: J = ' + J + ' (>999)'
  var S = TC
  if (J>99) { S += Name[Math.floor(J/100)] + ' Hundred ' ; J %= 100
    if (J>0) S += 'and '
    }
    else if ((S>'') && (J>0) && (K==0)) S += 'AND '
  if (J>19) { S += Namety[Math.floor(J/10)-2] ; J %= 10 ;
    S += ( J>0 ? '-' : ' ') }
  if (J>0) S += Name[J] + ' '
  if (K>0) S += Suffix[K] + ' '
  return S }

function TextCash(L, K) {
  if (L==0) return (K>0 ? '' : 'Zero ')
  return Small(TextCash(Math.floor(L/1000), K+1), L%1000, K) }

function DoIt() { with (document.selhotel) { 
	
    var SVAL = +camt.value;
      SVAL +='';  
 
   var isf=SVAL.indexOf(".");
  
  var Q = 0; 
  var R = 0; 
  

   if(isf>=0){
   var word = SVAL.split(".");     
    Q = parseInt(word[0]);
	var sR = word[1];
       sR = trim(sR);
    R = parseInt(sR);  
   }
   else {
	 var Q = parseInt(SVAL);  
   }
   
  // var Q = parseIN(SVAL);
  //var Q = +camt.value;


    var v1  =  isNaN(Q) ? 'NaN' :
    Q<0 ? 'Neg' :
    TextCash(Q, 0) + 'Saudi Riyal' + (Q==1?'':'s') 

 
   var v2  =  isNaN(R) ? 'NaN' :
    R<0 ? 'Neg' :
    TextCash(R, 0) + 'Halala' + (R==1?'':'s') 

   if(isf>=0){
   inw.value = v1.concat(' and '+v2);
   }
   else {
	inw.value = v1;
   }
   	   
   
   } }




function TryVal() {
  document.selhotel.camt.value = Tries[TryNo++]
  TryNo %= Tries.length }


 </script>



	<tr><td><br><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Amount:</font> <input type="text" id="camt" name="camt" value="0" size="5" onKeyUp="if (regular(this.value)) { DoIt() } else { alert('Not Valid') }">	  /-</td></tr>	

	<tr> 
            
            <td><font size="2" face="Verdana, Arial, Helvetica, sans-serif">In words:</font><input type="text" id="inw" name="inw" size="80"></td>
          </tr>

	<tr>
    <script>
	function acc(){
       document.getElementById("acname").value=document.getElementById("accode").value;
	  }
	</script>

<script type="text/javascript">
      function OpenWindow(){
          if ((document.selhotel.saccode.value== null) || ((document.selhotel.saccode.value).length==0))
   {
      alert ("Sorry, But enter Account Name to find Account");
	  document.selhotel.saccode.focus();
   }
   else {
			
		var rr = "accountsearch.php?hn="+document.selhotel.saccode.value;
		
        var winPop = window.open(rr,"winPop",'menubar=yes,scrollbars=yes,toolbar=no,resizable=yes,width=700,height=300, top='+10+',left='+10+' ').focus();
      }


} 
    </script>
	  <td style="border-top: 1px solid red"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"> Enter A/c Code : <input type="text" id="accode" name="accode" size="2" onKeyUp="acc()"  onFocus="acc()" onBlur="acc()">
	    or Search for A/c:<input type="text" id="saccode" name="saccode" size="20"> <input type="button" id="searchacc" name="searchacc" value="Search" onClick="OpenWindow()"></font></td>
	  </tr>
	 
    
	 <script>
	function accv(){
       document.getElementById("accode").value=document.getElementById("acname").value;
	  }
	</script>


	<td><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Select A/C Name:<select id="acname" name="acname" onChange="accv();">
        <option value="select">Select Account Name...</option>
       
        <?

		for($i=0;$i<count($array_acccode);$i++){
       
   echo  "<option value=\"$array_acccode[$i]\">$array_acc_name[$i] - $array_acccode[$i]</option>";

		}

	?>
    </select></font></td></tr>
	  
	  
<tr><td align="right">
<input type="submit" value="Post & Print Voucher" id="Submit" />
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


	var d1 = new dateObj(document.selhotel.dDay, document.selhotel.dMonth, document.selhotel.dYear);
	initDates(dvy-1, dvy+1, dvy, now_month, now_day, d1);

 	
</script>
<script>


function fun2(theForm){


if((document.getElementById('vouno').value).length==0){
document.getElementById('vouno').focus();
alert("Sorry, But Enter the Voucher Number");
return false;
}

if((document.getElementById('refno').value).length==0){
document.getElementById('refno').focus();
alert("Sorry, But Enter the Statement Number");
return false;
}

if((document.getElementById('paidto').value).length==0){
document.getElementById('paidto').focus();
alert("Sorry, But Enter the details to whom you are paying");
return false;
}

if((document.getElementById('beingp').value).length==0){
document.getElementById('beingp').focus();
alert("Sorry, But Enter the details of Being paid ");
return false;
}

if((document.getElementById('camt').value).length==0){
document.getElementById('camt').focus();
alert("Sorry, But Enter the Amount");
return false;
}

if((document.getElementById('accode').value).length==0 || (document.getElementById('accode').value).length<6){
document.getElementById('accode').focus();
alert("Sorry, But Enter the account code");
return false;
}

   

}


</script>
