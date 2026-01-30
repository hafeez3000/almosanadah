<?

include ("header.php");
?>

<script src="../javascripts/cBoxes.js"></script>
<? $vy=$vm=$vd=0; 
$vy1=$vm1=$vd1=0;

$cases_no = $_GET['caseno'];
?>

<script>
document.title= '<? echo $company_name . " ERP - Cases"; ?>';
</script>


<html>
<link rel="stylesheet" type="text/css" href="../calendar/css.css" />
<head>
<script>
 var winl = (screen.width - 700) / 2; 
 var wint = (screen.height - 500) / 2;
</script>
</head>
<body leftmargin="0" topmargin="0" rightmargin="0">
<table width="100%" border="0" cellpadding="0" cellspacing="0" style="border-bottom: 1px solid #999999 ;border-left: 3px solid #006600;border-right: 3px solid #006600"><tr>
    <td bgcolor="#CCCCCC"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">&nbsp;You 
      are here: <a href="uhome.php">Home</a> &raquo; Cases  &raquo; Create Resolution</font></td>
  </tr></table>
  
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
           
<?

$q_main_sel ="select sno,subject,date_entered,date_modified,created_by,status, priority, description, resolution from cases where sno=$cases_no ";

$main_sel = pg_query($conn, $q_main_sel);

$rows_main = pg_num_rows($main_sel);

if (!$main_sel) {
echo "An error occured.\n";
exit;
		}


while ($rows_main = pg_fetch_array($main_sel)){

$s_sno = $rows_main["sno"];
$s_subject = $rows_main["subject"];
$s_date_entered = $rows_main["date_entered"];
$s_date_modified = $rows_main["date_modified"];
$s_created_by = $rows_main["created_by"];
$s_status = $rows_main["status"];
$s_priority = $rows_main["priority"];
$s_description = $rows_main["description"];
$s_resolution = $rows_main["resolution"];

}

$q_main_sel_u ="select user_sno,user_first_name,user_last_name from users where user_sno=$s_created_by ";

$main_sel_u = pg_query($conn, $q_main_sel_u);

$rows_main_u = pg_num_rows($main_sel_u);

if (!$main_sel_u) {
echo "An error occured.\n";
exit;
		}


while ($rows_main_u = pg_fetch_array($main_sel_u)){


$s_user_first_name = $rows_main_u["user_first_name"];
$s_user_last_name = $rows_main_u["user_last_name"];

}
?>




			
            <table width="100%" cellpadding="0" cellspacing="0" ><tr><td width="85%" valign="top"> 
			<table cellpadding="0" cellspacing="0" width="100%" style="border-top: 1px solid #999999; border-bottom: 1px solid #999999"><tr>
                      <td bgcolor="#CCCCCC"><strong>Create Resolution</strong></td>
                    </tr></table>
<table width="100%" cellpadding="1" cellspacing="0"><tr>
                      <td> 
                          <table width="100%" border="0" cellspacing="0" style=" border-bottom: 1px solid #999999">
                          <form name="bbyod" method="post" action="caseresolutiona.php" onSubmit="return fun2(this)">
                            <tr>
                              <td colspan="1">&nbsp;</td>
                              <td colspan="1">&nbsp;</td>
                            </tr>
							<tr> 
                              <td colspan="1" width="20%">Case From User  </td> 
                              <td colspan="1"><? echo $s_user_first_name ." ". $s_user_last_name?></td>
                            </tr>
                            <tr>
							  <td colspan="1" >&nbsp;</td>
							  <td colspan="1">&nbsp;</td>
						    </tr>
							<tr> 
                              <td colspan="1" width="20%">Case Number </td> 
                              <td colspan="1"><input type="hidden" id="s_sno" name="s_sno" value="<? echo $s_sno ?>" ><? echo $s_sno ?></td>
                            </tr>
							<tr>
							  <td colspan="1" >&nbsp;</td>
							  <td colspan="1">&nbsp;</td>
						    </tr>
							<tr> 
                              <td colspan="1" >Priority </td> <td colspan="1"> <select name="cases_priority" id="cases_priority">

								<?   echo  "<option value=\"$s_priority\">$s_priority</option>";   ?>
								  <option value="High">High</option>
                                  <option value="Medium">Medium</option>
                                  <option value="Low">Low</option>
                                   </select></td>
                            </tr>
							 <tr>
							   <td colspan="1" >&nbsp;</td>
							   <td colspan="1">&nbsp;</td>
						    </tr>
							 <tr> 
                              <td colspan="1" >Status </td> <td colspan="1"> 

							  
							  <select name="cases_status" id="cases_status">
							  <?   echo  "<option value=\"$s_status\">$s_status</option>";   ?>
								  <option value="New">New</option>
                                  <option value="Closed">Closed</option>
                                  <option value="Pending">Pending</option>
                                  <option value="Rejected">Rejected</option>
                                  <option value="Duplicate">Duplicate</option>								  
                                   </select></td>
                            </tr>
							 <tr>
							   <td colspan="1" >&nbsp;</td>
							   <td colspan="1">&nbsp;</td>
						    </tr>
							 <tr> 
                              <td colspan="1" >Subject </td> <td colspan="1"> <input type="text" id="cases_subject" name="cases_subject" value ="<? echo $s_subject ?>"  size="70"></td>
                            </tr>
														 <tr>
														   <td colspan="1" >&nbsp;</td>
														   <td colspan="1">&nbsp;</td>
						    </tr>
														 <tr> 
                              <td colspan="1"  valign="top">Description </td> <td colspan="1"> <textarea  name="cases_desc" id="cases_desc"   rows="8" cols="54"><? echo $s_description ?></textarea></td>
                            </tr>
							                             <tr>
							                               <td colspan="1" >&nbsp;</td>
							                               <td colspan="1">&nbsp;</td>
                            </tr>
                            <tr> 
                              <td colspan="1" valign="top">Resolution </td> <td colspan="1"> <textarea name="cases_resol" id="cases_resol"  rows="6" cols="54" ><? echo $s_resolution ?></textarea></td>
                            </tr>
							 <tr> 
                              <td colspan="1" valign="top"><input type="submit" id="Submit" name="Submit" value="Save" ></td> <td colspan="1">&nbsp;</td>
                            </tr>
                          </form>
                        </table>



		
							

					  </td>
                            </tr>
                          </table>
                         </td>
                    </tr></table>									
					
			</td> 
              </tr></table> </td>
        </tr>
      </table></td></tr>
	  
	  
      </table> 
</table>	
	
	

	</tr></table>



<script>
function fun2(theForm){




 if ((document.bbyod.cases_subject.value== null) ||   ((document.bbyod.cases_subject.value).length==0))
   {
      alert ("Sorry, But enter subject for Case/Bug");
	  document.bbyod.cases_subject.focus();
	  		return false;
   }

 if(document.bbyod.cases_desc.value=="")
   {
      alert ("Sorry, But enter Description for Case/Bug");
	  document.bbyod.cases_desc.focus();
	  		return false;
   }




}
</script>

</body>				
</html>
