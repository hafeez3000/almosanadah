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
              <?php include  ("umenupreline.php"); ?>
            </div></td>
        </tr>
      </table></td>
    <td width="80%" valign="top"  > <table width="100%" border="0" cellpadding="0" cellspacing="1">
        <tr>
          <td valign="top"> 
           
			


			
            <table width="100%" cellpadding="0" cellspacing="0" ><tr><td width="85%" valign="top"> 
			<table cellpadding="0" cellspacing="0" width="100%" style="border-top: 1px solid #999999; border-bottom: 1px solid #999999"><tr>
                      <td bgcolor="#CCCCCC"><strong>Creating Case</strong></td>
                    </tr></table>
<table width="100%" cellpadding="1" cellspacing="0"><tr>
                      <td> <br><br><br>
                          <? 
include ("gprocessing.html"); 


$cases_priority =$_POST['cases_priority'];
$cases_status =$_POST['cases_status'];

$cases_subject =$_POST['cases_subject'];
$cases_desc =$_POST['cases_desc'];
$cases_resol =$_POST['cases_resol'];



$sqlins_case = "insert into cases (subject,date_entered,created_by,description,status,priority ) values ('$cases_subject', 'now' , $suser_sno, '$cases_desc', '$cases_status', '$cases_priority'  ) ";

pg_query($conn, $sqlins_case);





 echo "<script> document.location.href=\"listcases.php\" </script>" ;  
?>


		
							

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
