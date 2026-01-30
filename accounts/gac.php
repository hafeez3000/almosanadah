<?
include ("header.php");
?>

<script>
document.title= '<? echo $company_name . " ERP - Accounts - Account Details"; ?>';
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

			<?



$c_ac_c = array();
$c_ac_name = array();

$s_chk ="";
$fa_bv="";

$query_pacc ="select acccode,acc_name from accmast order by acccode";
$nav_pquery = pg_query($conn, $query_pacc);
while ( $nav_prow = pg_fetch_array($nav_pquery) )
{
$c_ac_c[] = $nav_prow['acccode'];
$c_ac_name[] = $nav_prow['acc_name'];
}




$s_assests = "A";
$s_liabilities = "L";
$s_income = "I";
$s_expenses = "E";
$s_equity = "Q";

$s_ac =  isset($_POST['ac']) ? $_POST['ac'] : '';
if($s_ac==""){
 $s_ac =  isset($_GET['ac']) ? $_GET['ac'] : '';
}


$_SESSION['acc_c'] = $s_ac;

$query_acc ="select acc_sno,acccode,acc_name,acc_desc,parent_acc,acc_type,db_bal,cr_bal,op_bal,fa_bull from accmast  where acccode='$s_ac'";

	$nav_query = pg_query($conn, $query_acc);

while ( $nav_row = pg_fetch_array($nav_query) )
{

$s_acccode  =  $nav_row['acccode'];
$s_acc_name =  $nav_row['acc_name'];

$s_acc_desc  =  $nav_row['acc_desc'];
$s_acc_type =  $nav_row['acc_type'];
$s_db_bal  =  $nav_row['db_bal'];
$s_cr_bal =  $nav_row['cr_bal'];
$s_op_bal  =  $nav_row['op_bal'];
$s_parent_acc =  $nav_row['parent_acc'];
$fa_bv = $nav_row['fa_bull'];
}

if($fa_bv=="t"){
$s_chk = "checked";
}

$s_acc_type_b="";

if($s_acc_type==$s_assests){  $s_acc_type_b="Assets"; }
if($s_acc_type==$s_liabilities){  $s_acc_type_b="Liabilities"; }
if($s_acc_type==$s_income){  $s_acc_type_b="Income"; }
if($s_acc_type==$s_expenses){  $s_acc_type_b="Expenses"; }
if($s_acc_type==$s_equity){  $s_acc_type_b="Equity"; }

?>

<table style="border: 1px solid red" cellpadding="5" cellspacing="0" width="100%" height="100%">
                                <tr>

                                  <td bgcolor="#FFDFDF" colspan="2" ><form name="amd_ac" method="post" action="amendacc.php" onSubmit="return fun2(this)">&nbsp;Details of Account: <strong>

								  <? echo $s_acc_name; ?>
                                    </strong>
									</td>


                                </tr>


                  <tr>
                                  <td style="border-bottom: 1px solid red" align="right" width="20%">Account Code                        </td>
                                  <td style="border-bottom: 1px solid red" align="left">
                                    <input type="text" id="ac_code" name="ac_code" value='<? echo $s_acccode ; ?>' size="5">

                                  </td>
                                </tr>

 <tr>
                                  <td style="border-bottom: 1px solid red" align="right" >Account Name                       </td>
                                  <td style="border-bottom: 1px solid red" align="left">
                                    <input type="text" id="ac_name" name="ac_name" value="<? echo $s_acc_name ; ?>" size="75">

                                  </td>
                                </tr>
                  <tr>
                                  <td style="border-bottom: 1px solid red" align="right" >Account Description                       </td>
                                  <td style="border-bottom: 1px solid red" align="left">
                                    <input type="text" id="ac_desc" name="ac_desc" value="<? echo $s_acc_desc ; ?>" size="75">

                                  </td>
                                </tr>



<tr>
                                  <td style="border-bottom: 1px solid red" align="right" >Op Debit Bal                        </td>
                                  <td style="border-bottom: 1px solid red" align="left">
                                    <input type="text" id="ope_dbal" name="ope_dbal" value='<? echo $s_db_bal ; ?>' size="5">

                                  </td>
                                </tr>
<tr>
                                  <td style="border-bottom: 1px solid red" align="right" >Op Credit Bal                        </td>
                                  <td style="border-bottom: 1px solid red" align="left">
                                    <input type="text" id="ope_cbal" name="ope_cbal" value='<? echo $s_cr_bal ; ?>' size="5">

                                  </td>
                                </tr>
                    <tr>
                                  <td style="border-bottom: 1px solid red" align="right" >Account Type                        </td>
                                  <td style="border-bottom: 1px solid red" align="left">
                                   <select id="acc_type" name="acc_type">

                                    <option value=<? echo $s_acc_type ; ?>><? echo $s_acc_type_b ; ?></option>
                                    <option value="A">Assests</option>
                                    <option value="L">Liabilities</option>
                                    <option value="I">Income</option>
									<option value="E">Expenses</option>
									<option value="Q">Equity</option>

									</select>

                                  </td>
                                </tr>
                          <tr>
                                  <td style="border-bottom: 1px solid red" align="right" >Opening Bal                        </td>
                                  <td style="border-bottom: 1px solid red" align="left">
                                    <input type="text" id="ope_bal" name="ope_bal" value='<? echo $s_op_bal ; ?>' size="5">

                                  </td></tr>

						 <tr>
                                  <td style="border-bottom: 1px solid red" align="right" >Show in Final Accounts                        </td>
                                  <td style="border-bottom: 1px solid red" align="left">
								  <input type="checkbox" id="final_ac" name="final_ac" <? echo $s_chk ?> >


                                  </td></tr>


   <tr>
                                  <td style="border-bottom: 1px solid red" align="right" width="20%">Parent Account                        </td>
                                  <td style="border-bottom: 1px solid red" align="left">



					<select id="pa_acc" name="pa_acc">
<?
for($j=0;$j<count($c_ac_c);$j++){

if($s_parent_acc==$c_ac_c[$j]){

  echo  "<option value=\"$c_ac_c[$j]\">$c_ac_c[$j] - $c_ac_name[$j]</option>";
}

}
?>

										<?
		for($i=0;$i<count($c_ac_c);$i++){

  echo  "<option value=\"$c_ac_c[$i]\">$c_ac_c[$i] - $c_ac_name[$i]</option>";

}
	?>
                                      </select>

                                  </td>
                                </tr>


   <tr>
                                  <td style="border-bottom: 1px solid red" align="center" width="20%" colspan="2">
<input type="submit" id="fa_sub" name="fa_sub" value="Update" >

</form>


<script type="text/javascript">
      function cre_cacc(){

   if ((document.getElementById ("ac_code").value== null) || ((document.getElementById ("ac_code").value).length==0))
   {
      alert ("Sorry, Check the present account code");
	  document.getElementById ("ac_code").focus();
   }
   else {
         var pd_amtt = "creatcacc.php?"+"pacc="+document.getElementById ("ac_code").value;
		document.location.href=pd_amtt ;

      }

}


 function del_acc(){
     var result = confirm("Want to delete this account ?");
     if (result==true) {

   if ((document.getElementById ("ac_code").value== null) || ((document.getElementById ("ac_code").value).length==0))
   {
      alert ("Sorry, Check the present account code");
	  document.getElementById ("ac_code").focus();
   }
   else {
         var pd_amtt = "delpacc.php?"+"pacc="+document.getElementById ("ac_code").value;
		document.location.href=pd_amtt ;

      }
      }
}


	</script>

<input type="button" id="cr_ca" name="cr_ca" value="Create New Child Account" onClick="cre_cacc()">





<input type="button" id="del_ac" name="del_ac" value="Delete" onClick="del_acc()">
                                  </td>
                                </tr>


</table>





			 </td>
        </tr>
      </table></td></tr>


      </table>
</table>
	<script>
function fun2(theForm){



 if ((document.amd_ac.ac_code.value== null) || ((document.amd_ac.ac_code.value).length==0))
   {
      alert ("Sorry, But enter Enter Account Code");
	  document.amd_ac.ac_code.focus();
	  return false;
   }

 if ((document.amd_ac.ac_name.value== null) || ((document.amd_ac.ac_name.value).length==0))
   {
      alert ("Sorry, But enter Enter Account Name");
	  document.amd_ac.ac_name.focus();
	  return false;
   }

 if ((document.amd_ac.ac_desc.value== null) || ((document.amd_ac.ac_desc.value).length==0))
   {
      alert ("Sorry, But enter Enter Account Description");
	  document.amd_ac.ac_desc.focus();
	  return false;
   }

   if ((document.amd_ac.ope_dbal.value== null) || ((document.amd_ac.ope_dbal.value).length==0))
   {
      alert ("Sorry, But enter Enter Opening Debit Balance");
	  document.amd_ac.ope_dbal.focus();
	  return false;
   }

if ((document.amd_ac.ope_cbal.value== null) || ((document.amd_ac.ope_cbal.value).length==0))
   {
      alert ("Sorry, But enter Enter Opening Credit Balance");
	  document.amd_ac.ope_cbal.focus();
	  return false;
   }

if ((document.amd_ac.ope_bal.value== null) || ((document.amd_ac.ope_bal.value).length==0))
   {
      alert ("Sorry, But enter Enter Opening Balance");
	  document.amd_ac.ope_bal.focus();
	  return false;
   }



}
</script>


	</tr></table>
</body>
</html>




