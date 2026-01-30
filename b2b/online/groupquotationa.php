<?
session_cache_limiter('must-revalidate');
include ("header.php");


$query_hotel ="select hotel_id, hotel_name from hotels order by hotel_name";

$result_hotel = pg_query($query_hotel);

if (!$result_hotel) {
	echo "An error occured.\n";
	exit;
	}
while ($rows_hotel = pg_fetch_array($result_hotel)){

$array_hotel[] = $rows_hotel["hotel_name"];
$array_hotel_id[] = $rows_hotel["hotel_id"];

}

pg_free_result($result_hotel);

?>

<script>
document.title= '<? echo $company_name . " ERP - Umrah - Group Quotation"; ?>';
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
      are here: <a href="uhome.php">Home</a> &raquo; <a href="#">Quotations</a> 
      &raquo; Group Quotation</font></td>
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
                      <td bgcolor="#CCCCCC"><strong>Group Quotation</strong></td>
                    </tr></table>
<table width="100%" cellpadding="1" cellspacing="0"><tr>
                      <td> 
                          <table width="95%" border="0" cellspacing="0" align="center">
                          <tr> 
                            <td colspan="6"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Details</font></td>
                          </tr>
                          <tr bgcolor="#CCCCCC"> 
                            <td style="border-left: 1px solid #999999; border-right: 1px solid #999999" ><div align="center"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Sno</font></div></td>
                            <td style="border-right: 1px solid #999999"><div align="center"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Paticulars</font></div></td>
                            <td style="border-right: 1px solid #999999"><div align="right"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Pax in Single</font></div></td>
                            <td style="border-right: 1px solid #999999"><div align="right"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Pax in Double</font></div></td>
                            <td style="border-right: 1px solid #999999"><div align="right"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Pax in Triple</font></div></td>
                            <td style="border-right: 1px solid #999999"><div align="right"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Pax in Quard</font></div></td>
                          </tr>
<?

$tots = 0;
$totd = 0;
$tott = 0;
$totq = 0;

$sno=1;
if($_POST['hotcb0']==on){

echo "<tr><td style=\"border-left: 1px solid #999999; border-right: 1px solid #999999;border-bottom: 1px solid #999999\"><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">$sno</div></font></td>                         <td style=\"border-right: 1px solid #999999;border-bottom: 1px solid #999999\"><div align=\"left\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">" ;

$h_id = $_POST['hotelsb0'] ;
	
$query_hotel ="select hotel_id, city, hotel_name from hotels where hotel_id=$h_id order by hotel_name";

$result_hotel = pg_query($query_hotel);

if (!$result_hotel) {
	echo "An error occured.\n";
	exit;
	}
while ($rows_hotel = pg_fetch_array($result_hotel)){

echo  $rows_hotel["city"];
echo "<br>";
echo  $rows_hotel["hotel_name"];
echo " X " ;
echo $_POST['hotn0'];
echo " Nights";

}

pg_free_result($result_hotel);

echo "</font></div></td><td style=\"border-right: 1px solid #999999;border-bottom: 1px solid #999999\"><div align=\"right\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";

echo $muls0 = ceil($_POST['single0']) * ceil($_POST['hotn0']) ;
$tots = $tots + $mul ;

echo "</font></div></td><td style=\"border-right: 1px solid #999999;border-bottom: 1px solid #999999\"><div align=\"right\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";

echo  $muld0 = ceil($_POST['double0']/2) * ceil($_POST['hotn0']) ;
$totd = $totd + $muld0 ;

echo "</font></div></td><td style=\"border-right: 1px solid #999999;border-bottom: 1px solid #999999\"><div align=\"right\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";

echo  $mult0 = ceil($_POST['triple0']/3) * ceil($_POST['hotn0']) ;

$tott = $tott + $mult0 ;

echo "</font></div></td>                      <td style=\"border-right: 1px solid #999999;border-bottom: 1px solid #999999\"><div align=\"right\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">" ;

echo  $mulq0 = ceil($_POST['quard0']/4)  * ceil($_POST['hotn0']) ;
$totq = $totq + $mulq0 ;

echo "</font></div></td>   </tr>";


$sno++;
}

if($_POST['hotcb1']==on){

echo "<tr><td style=\"border-left: 1px solid #999999; border-right: 1px solid #999999;border-bottom: 1px solid #999999\"><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">$sno</font></div></td>                         <td style=\"border-right: 1px solid #999999;border-bottom: 1px solid #999999\"><div align=\"left\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">" ;

$h_id = $_POST['hotelsb1'] ;
	
$query_hotel ="select hotel_id, city, hotel_name from hotels where hotel_id=$h_id order by hotel_name";

$result_hotel = pg_query($query_hotel);

if (!$result_hotel) {
	echo "An error occured.\n";
	exit;
	}
while ($rows_hotel = pg_fetch_array($result_hotel)){

echo  $rows_hotel["city"];
echo "<br>";
echo  $rows_hotel["hotel_name"];
echo " X " ;
echo $_POST['hotn1'];
echo " Nights";


}

pg_free_result($result_hotel);

echo "</font></div></td><td style=\"border-right: 1px solid #999999;border-bottom: 1px solid #999999\"><div align=\"right\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";

echo $muls1= ceil($_POST['single1'])  * ceil($_POST['hotn1']) ;
$tots = $tots + $muls1 ;

echo "</font></div></td><td style=\"border-right: 1px solid #999999;border-bottom: 1px solid #999999\"><div align=\"right\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";

echo  $muld1= ceil($_POST['double1']/2)  * ceil($_POST['hotn1']) ;
$totd = $totd + $muld1 ;

echo "</font></div></td><td style=\"border-right: 1px solid #999999;border-bottom: 1px solid #999999\"><div align=\"right\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";

echo $mult1 =  ceil($_POST['triple1']/3)  * ceil($_POST['hotn1']) ;

$tott = $tott + $mult1 ;

echo "</font></div></td>                      <td style=\"border-right: 1px solid #999999;border-bottom: 1px solid #999999\"><div align=\"right\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">" ;

echo  $mulq1= ceil($_POST['quard1']/4) * ceil($_POST['hotn1']) ;
$totq = $totq + $mulq1 ;

echo "</font></div></td>   </tr>";


$sno++;
}

if($_POST['hotcb2']==on){

echo "<tr><td style=\"border-left: 1px solid #999999; border-right: 1px solid #999999;border-bottom: 1px solid #999999\"><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">$sno</font></div></td>                         <td style=\"border-right: 1px solid #999999;border-bottom: 1px solid #999999\"><div align=\"left\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">" ;

$h_id = $_POST['hotelsb2'] ;
	
$query_hotel ="select hotel_id, city, hotel_name from hotels where hotel_id=$h_id order by hotel_name";

$result_hotel = pg_query($query_hotel);

if (!$result_hotel) {
	echo "An error occured.\n";
	exit;
	}
while ($rows_hotel = pg_fetch_array($result_hotel)){

echo  $rows_hotel["city"];
echo "<br>";
echo  $rows_hotel["hotel_name"];
echo " X " ;
echo $_POST['hotn2'];
echo " Nights";


}

pg_free_result($result_hotel);

echo "</font></div></td><td style=\"border-right: 1px solid #999999;border-bottom: 1px solid #999999\"><div align=\"right\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";

echo $muls2 = ceil($_POST['single2']) * ceil($_POST['hotn2']) ;
$tots = $tots + $muls2 ;

echo "</font></div></td><td style=\"border-right: 1px solid #999999;border-bottom: 1px solid #999999\"><div align=\"right\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";

echo  $muld2 = ceil($_POST['double2']/2) * ceil($_POST['hotn2']) ;
$totd = $totd + $muld2 ;

echo "</font></div></td><td style=\"border-right: 1px solid #999999;border-bottom: 1px solid #999999\"><div align=\"right\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";

echo $mult2 =  ceil($_POST['triple2']/3) * ceil($_POST['hotn2']) ;

$tott = $tott + $mult2 ;

echo "</font></div></td>                      <td style=\"border-right: 1px solid #999999;border-bottom: 1px solid #999999\"><div align=\"right\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">" ;

echo $mulq2 =  ceil($_POST['quard2']/4) * ceil($_POST['hotn2']) ;
$totq = $totq + $mulq2 ;

echo "</font></div></td>   </tr>";


$sno++;
}

if($_POST['trans0']==on){

echo "<tr><td style=\"border-left: 1px solid #999999; border-right: 1px solid #999999;border-bottom: 1px solid #999999\"><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">$sno</font></div></td>                         <td style=\"border-right: 1px solid #999999;border-bottom: 1px solid #999999\"><div align=\"left\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">" ;

echo "Transportation";
echo "<br>";

echo  $_POST['transdesc0'] ;
	

echo "</font></div></td><td style=\"border-right: 1px solid #999999;border-bottom: 1px solid #999999\"><div align=\"right\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";

echo ceil($_POST['transsell0']) ;
$tots = $tots + ceil($_POST['transsell0']) ;

echo "</font></div></td><td style=\"border-right: 1px solid #999999;border-bottom: 1px solid #999999\"><div align=\"right\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";

echo  ceil($_POST['transsell0']) ;
$totd = $totd + (ceil($_POST['transsell0'])) ;

echo "</font></div></td><td style=\"border-right: 1px solid #999999;border-bottom: 1px solid #999999\"><div align=\"right\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";

echo  ceil($_POST['transsell0']) ;

$tott = $tott + (ceil($_POST['transsell0'])) ;

echo "</font></div></td>                      <td style=\"border-right: 1px solid #999999;border-bottom: 1px solid #999999\"><div align=\"right\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">" ;

echo  ceil($_POST['transsell0']) ;
$totq = $totq + (ceil($_POST['transsell0'])) ;

echo "</font></div></td>   </tr>";





$sno++;
}

if($_POST['visa0']==on){

echo "<tr><td style=\"border-left: 1px solid #999999; border-right: 1px solid #999999;border-bottom: 1px solid #999999\"><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">$sno</font></div></td>                         <td style=\"border-right: 1px solid #999999;border-bottom: 1px solid #999999\"><div align=\"left\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">" ;


echo  "Total Visa Charges" ;
	

echo "</font></div></td><td style=\"border-right: 1px solid #999999;border-bottom: 1px solid #999999\"><div align=\"right\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";

echo ceil($_POST['visasell0']) ;
$tots = $tots + ceil($_POST['visasell0']) ;

echo "</font></div></td><td style=\"border-right: 1px solid #999999;border-bottom: 1px solid #999999\"><div align=\"right\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";

echo  ceil($_POST['visasell0']) ;
$totd = $totd + (ceil($_POST['visasell0'])) ;

echo "</font></div></td><td style=\"border-right: 1px solid #999999;border-bottom: 1px solid #999999\"><div align=\"right\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";

echo  ceil($_POST['visasell0']) ;

$tott = $tott + (ceil($_POST['visasell0'])) ;

echo "</font></div></td>                      <td style=\"border-right: 1px solid #999999;border-bottom: 1px solid #999999\"><div align=\"right\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">" ;

echo  ceil($_POST['visasell0']) ;
$totq = $totq + (ceil($_POST['visasell0'])) ;

echo "</font></div></td>   </tr>";




$sno++;
}

if($_POST['others0']==on){

echo "<tr><td style=\"border-left: 1px solid #999999; border-right: 1px solid #999999;border-bottom: 1px solid #999999\"><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">$sno</font></div></td>                         <td style=\"border-right: 1px solid #999999;border-bottom: 1px solid #999999\"><div align=\"left\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">" ;

echo "Others";
echo "<br>";

echo $_POST['othersdesc0'];


echo "</font></div></td><td style=\"border-right: 1px solid #999999;border-bottom: 1px solid #999999\"><div align=\"right\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";

echo ceil($_POST['otherssell0']) ;
$tots = $tots + ceil($_POST['otherssell0']) ;

echo "</font></div></td><td style=\"border-right: 1px solid #999999;border-bottom: 1px solid #999999\"><div align=\"right\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";

echo  ceil($_POST['otherssell0']) ;
$totd = $totd + (ceil($_POST['otherssell0'])) ;

echo "</font></div></td><td style=\"border-right: 1px solid #999999;border-bottom: 1px solid #999999\"><div align=\"right\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";

echo  ceil($_POST['otherssell0']) ;

$tott = $tott + (ceil($_POST['otherssell0'])) ;

echo "</font></div></td>                      <td style=\"border-right: 1px solid #999999;border-bottom: 1px solid #999999\"><div align=\"right\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">" ;

echo  ceil($_POST['otherssell0']) ;
$totq = $totq + (ceil($_POST['otherssell0'])) ;

echo "</font></div></td>   </tr>";




$sno++;
}

echo "<tr><td style=\"border-left: 1px solid #999999; border-right: 1px solid #999999;border-bottom: 1px solid #999999\"><div align=\"center\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">$sno</font></div></td>                         <td style=\"border-right: 1px solid #999999;border-bottom: 1px solid #999999\"><div align=\"left\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">" ;

echo "Total in Saudi Riyals";


echo "</font></div></td><td style=\"border-right: 1px solid #999999;border-bottom: 1px solid #999999\"><div align=\"right\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";

echo ceil($tots) ;
//$tots = $tots + ceil($_POST['otherssell0']) ;

echo "</font></div></td><td style=\"border-right: 1px solid #999999;border-bottom: 1px solid #999999\"><div align=\"right\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";

echo  ceil($totd) ;
//$totd = $totd + (ceil($_POST['otherssell0'])) ;

echo "</font></div></td><td style=\"border-right: 1px solid #999999;border-bottom: 1px solid #999999\"><div align=\"right\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";

echo  ceil($tott) ;

//$tott = $tott + (ceil($_POST['otherssell0'])) ;

echo "</font></div></td>                      <td style=\"border-right: 1px solid #999999;border-bottom: 1px solid #999999\"><div align=\"right\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">" ;

echo  ceil($totq) ;
//$totq = $tott + (ceil($_POST['otherssell0'])) ;

echo "</font></div></td>   </tr>";

echo "<tr><td colspan=\"6\">&nbsp;</td></tr>";

echo "<tr><td style=\"border-left: 1px solid #999999; border-right: 1px solid #999999;border-bottom: 1px solid #999999;border-top: 1px solid #999999\"><div align=\"center\">&nbsp;</div></td>                         <td style=\"border-right: 1px solid #999999;border-bottom: 1px solid #999999;border-top: 1px solid #999999\"><div align=\"left\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">" ;

echo "Total in US Dollors";


echo "</font></div></td><td style=\"border-right: 1px solid #999999;border-bottom: 1px solid #999999;border-top: 1px solid #999999\"><div align=\"right\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";

echo ceil($tots/3.75) ;
//$tots = $tots + ceil($_POST['otherssell0']) ;

echo "</font></div></td><td style=\"border-right: 1px solid #999999;border-bottom: 1px solid #999999;border-top: 1px solid #999999\"><div align=\"right\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";

echo  ceil($totd/3.75) ;
//$totd = $totd + (ceil($_POST['otherssell0'])) ;

echo "</font></div></td><td style=\"border-right: 1px solid #999999;border-bottom: 1px solid #999999;border-top: 1px solid #999999\"><div align=\"right\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">";

echo  ceil($tott/3.75) ;

//$tott = $tott + (ceil($_POST['otherssell0'])) ;

echo "</font></div></td>                      <td style=\"border-right: 1px solid #999999;border-bottom: 1px solid #999999;border-top: 1px solid #999999\"><div align=\"right\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">" ;

echo  ceil($totq/3.75) ;
//$totq = $tott + (ceil($_POST['otherssell0'])) ;

echo "</font></div></td>   </tr>";


?>

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




</body>				
</html>
