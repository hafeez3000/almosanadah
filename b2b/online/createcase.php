<?

include ("header.php");
?>

<script src="../javascripts/cBoxes.js"></script>
<? $vy=$vm=$vd=0; 
$vy1=$vm1=$vd1=0;


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
      are here: <a href="uhome.php">Home</a> &raquo; Cases  &raquo; Create Cases</font></td>
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
           
			


			
            <table width="100%" cellpadding="0" cellspacing="0" ><tr><td width="85%" valign="top"> 
			<table cellpadding="0" cellspacing="0" width="100%" style="border-top: 1px solid #999999; border-bottom: 1px solid #999999"><tr>
                      <td bgcolor="#CCCCCC"><strong>Create Case</strong></td>
                    </tr></table>
<table width="100%" cellpadding="1" cellspacing="0"><tr>
                      <td> 
                          <table width="100%" border="0" cellspacing="0" style=" border-bottom: 1px solid #999999">
                          <form name="bbyod" method="post" action="createcasea.php" onSubmit="return fun2(this)">
                            <tr>
                              <td colspan="1">&nbsp;</td>
                              <td colspan="1">&nbsp;</td>
                            </tr>
                            <tr> 
                              <td colspan="1" width="20%">Case Number </td> 
                              <td colspan="1">#</td>
                            </tr>
							<tr>
							  <td colspan="1" >&nbsp;</td>
							  <td colspan="1">&nbsp;</td>
						    </tr>
							<tr> 
                              <td colspan="1" >Priority </td> <td colspan="1"> <select name="cases_priority" id="cases_priority">
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
                              <td colspan="1" >Subject </td> <td colspan="1"> <input type="text" id="cases_subject" name="cases_subject" size="70"></td>
                            </tr>
														 <tr>
														   <td colspan="1" >&nbsp;</td>
														   <td colspan="1">&nbsp;</td>
						    </tr>
														 <tr> 
                              <td colspan="1"  valign="top">Description </td> <td colspan="1"> <textarea  name="cases_desc" id="cases_desc"   rows="8" cols="54"></textarea></td>
                            </tr>
							                             <tr>
							                               <td colspan="1" >&nbsp;</td>
							                               <td colspan="1">&nbsp;</td>
                            </tr>
                            <!--<tr> 
                              <td colspan="1" valign="top">Resolution </td> <td colspan="1"> <textarea name="cases_resol" id="cases_resol"  rows="6" cols="54" ></textarea></td>
                            </tr>-->
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
