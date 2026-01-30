<?
include ("header1.php");

?>

<script>
document.title= '<? echo $company_name . " ERP - Umrah Home"; ?>';
</script>

<html>
<link rel="stylesheet" type="text/css" href="../calendar/css.css" />
<body leftmargin="0" topmargin="0" rightmargin="0">
<p>
<br>
<p>
<div align="center">
  <center>

<table border="0" width="50%">

      <tr>
	      <td align="center">
	        <h3>ERP - REPORTS </h3>
	        </td>

  </tr>
      <tr>
    <td align="center">
      <input type="button" value="Hotel Wise Report" name="open" onclick="openNewWindow()">
      </td>

  </tr>
  <tr>
      <td align="center">
        <input type="button" value="Agent Wise Report" name="open" onclick="openNewWindow1()">
        </td>

  </tr>
</table>

  </center>
</div>


</body>
</html>

<script language="javascript">
//MSHAM
function openNewWindow()
{
 window.open("http://192.167.1.205/dorsERP/umrah/salesreportbyh1.php");
}
function openNewWindow1()
{
 window.open("http://192.167.1.205/dorsERP/umrah/salesreportbya1.php");
}
</script>
