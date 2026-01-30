
<?  
include '../conf/mainconf.php';
$a_sno = array("1","2");
$sno = array_rand($a_sno, 2);
$f_sno =  $a_sno[$sno[0]];
?>

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Header</title>
<style type="text/css">
body {
 background: #666 url(images/bg/header<? echo $f_sno ;?>.jpg) repeat-x top left; 
}
</style>
</head>


<script>
var currentTime = new Date()
//var month = currentTime.getMonth() + 1
var day = currentTime.getDate()
//var year = currentTime.getFullYear()
var monthname=new Array("Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec")


</script>

<body>

<div id="header">

    <div id="title">
      <img src="../images/arnameformain.gif">
	  <h1 align="right">Dar Al Manasek</h1><h3><script>document.write(monthname[currentTime.getMonth()] + " " + day) </script></h3>
	  <h2>Its pleasure to serve you</h2>
    </div>

    <img src="images/bg/balloons.gif" alt="balloons" class="balloons" />
    <img src="images/bg/header_left<? echo $f_sno ;?>.jpg" alt="left slice" class="left" />
    <img src="images/bg/header_right<? echo $f_sno ;?>.jpg" alt="right slice" class="right" />

  </div>


</body>
</html>
