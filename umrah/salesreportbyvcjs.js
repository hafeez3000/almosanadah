var xmlHttp;

function showHint(str, fd, td, gs, cib) {
  if (str.length == 0) {
    document.getElementById("txtHint").innerHTML = "";
    return;
  }

  xmlHttp = GetXmlHttpObject();
  if (xmlHttp == null) {
    alert("Browser does not support HTTP Request");
    return;
  }
  var url = "salesreportbyvisac.php";
  url =
    url +
    "?vt=" +
    str +
    "&f_d=" +
    fd +
    "&t_d=" +
    td +
    "&gs=" +
    gs +
    "&cinb=" +
    cib;
  url = url + "&sid=" + Math.random();
  xmlHttp.onreadystatechange = stateChanged;
  xmlHttp.open("GET", url, true);
  xmlHttp.send(null);
}

function stateChanged() {
  if (xmlHttp.readyState == 1) {
    document.getElementById("txtHint").innerHTML =
      '<table><tr><td valign="middle"><img src=\'small_globe.gif\' ></td><td valign="middle" ><font size="2" face="Verdana, Arial, Helvetica, sans-serif"> <b>&nbsp;Habibi, Please Wait!  Loading...</b></font></td></tr></table>';
  } else if (xmlHttp.readyState == 4 || xmlHttp.readyState == 200) {
    document.getElementById("txtHint").innerHTML = xmlHttp.responseText;
  }
}

function GetXmlHttpObject() {
  var objXMLHttp = null;
  if (window.XMLHttpRequest) {
    objXMLHttp = new XMLHttpRequest();
  } else if (window.ActiveXObject) {
    objXMLHttp = new ActiveXObject("Microsoft.XMLHTTP");
  }
  return objXMLHttp;
}
