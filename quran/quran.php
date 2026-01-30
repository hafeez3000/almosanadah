<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=charset=utf-8">

</head>
<?
include("../db/db.php");

$no_rows=0;
$sno=0; 
 

   $sno = rand(1, 6236);

$sqlrec = "SELECT sno, arabic, english, chapter,ruku from quran where sno = '$sno'";
   $resultrec = pg_query($sqlrec) ;
    if (!$resultrec) {
	echo "An error occured.\n";
	exit;
	}
$rowrec = pg_fetch_array($resultrec); 
   if ($rowrec) {
 	$arabic =	 $rowrec["arabic"];
	$english =    $rowrec["english"];
	$chapter =	 $rowrec["chapter"];
	$ruku =    $rowrec["ruku"];
   }
   else {
  echo "No records found";
   }
?>
<center>
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
  <table width="100%" cellpadding="0" cellspacing="0"  >
    <tr> 
      <td bgcolor="#F3EED1" ><div align="center" DIR="RTL"><font size="6" face="Traditional Arabic">&#64831; 
          <?  echo $arabic ; ?>
          &#64830; </font></div></td>
      
    </tr>
    <tr> 
      <td bgcolor="#F3EED1"  style="border-bottom: solid 3px #F3EED1" > <div align="center"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
          <?  echo $english ; ?>
          - <strong><font size="1">Qur'an [ 
          <?  echo $chapter ; ?>
          : 
          <?  echo $ruku ; ?>
          ]</font></strong> </font> </div></td>
   
    </tr>
  </table>
</body>
</center>
</html>