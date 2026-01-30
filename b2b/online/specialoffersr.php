<?
include ("header.php");

?>

<script>
document.title= '<? echo $company_name . " ERP - Umrah Home"; ?>';
</script>

<script>
 var winl = (screen.width - 760) / 2; 
 var wint = (screen.height - 550) / 2;
</script>

<html>
<link rel="stylesheet" type="text/css" href="../calendar/css.css" />
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
    <td width="80%" valign="top"  > 
			
			
<table cellpadding="0" cellspacing="0" width="100%" style="border-top: 1px solid #999999; border-bottom: 1px solid #999999"><tr>
                      <td bgcolor="#00CC00"><strong>Special Offers </strong> </td> 
					  

					  


                    </tr></table>



<?


$filename = "../../spr/spr.csv";


$id = fopen($filename, "r"); //open the file
while ($data = fgetcsv($id, filesize($filename))) //start a loop
$table[] = $data; //put each line into its own entry in the $table array
fclose($id);

echo "<table width=\"100%\" cellspace=\"0\" cellpadding=\"0\"  > ";

echo "<tr >";
echo "<td align=\"center\" height=\"25\" style=\"border-bottom: 1px solid #999999;border-right: 1px solid #999999\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";
echo "Sno";
echo "</td>";
echo "<td align=\"left\" height=\"25\" style=\"border-bottom: 1px solid #999999;border-right: 1px solid #999999\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";
echo "Offer Name";
echo "</td>";
echo "<td align=\"left\" height=\"25\" style=\"border-bottom: 1px solid #999999\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";
echo "Hotels Offers";
echo "</td>";

echo "</tr>";


foreach($table as $row)
{
echo "<tr>";
echo "<td align=\"center\" height=\"25\" style=\"border-bottom: 1px solid #999999;border-right: 1px solid #999999\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";
echo $row[0];
echo "</td>";
echo "<td align=\"left\" height=\"25\" style=\"border-bottom: 1px solid #999999;border-right: 1px solid #999999\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";


echo "<a href=\"../../spr/$row[3]\"  target='sor' onClick=\"window.open('', 'sor' ,'width=775,height=450, directories=no,menubar=yes,scrollbars=yes,toolbar=no,resizable=no,fullscreen=no,titlebar=no,directories=no, top='+wint+',left='+winl+' ').focus()\" >$row[1]</a>";





echo "</td>";
echo "<td align=\"left\" height=\"25\" style=\"border-bottom: 1px solid #999999\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";
echo $row[2];
echo "</td>";

echo "</tr>";

}

echo "</table>";
?>





            </td>
                    </tr>
                  </table>
				</td>
              </tr></table> </td>
        </tr>
      </table></td></tr>
	  
	  
      </table> 
</table>	
	

	</tr></table>
</body>				
</html>


