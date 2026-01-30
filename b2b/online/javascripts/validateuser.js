var xmlHttp

function passVar(login, password)
{
  
  
  if (login.length==0)
  { 
    document.getElementById("txtHint").innerHTML="Enter your User Id"
    document.login_form.login.focus();
    return false;
    
  }
  
  if (password.length==0)
  { 
    document.getElementById("txtHint").innerHTML="Enter your Password"
    document.login_form.pwd.focus();
    return false;
  }
  
    xmlHttp=GetXmlHttpObject()
    if (xmlHttp==null)
  {
    alert ("Browser does not support HTTP Request")
    return false;
  } 
    var url="validateonlineuser.php"
     url=url+"?login="+login+"&password="+password
    //url=url+"&sid="+Math.random()
    xmlHttp.onreadystatechange=stateChanged 
    xmlHttp.open("GET",url,true)
    xmlHttp.send(null)
} 

function stateChanged() 
{ 

  if (xmlHttp.readyState==1)
  { 
  document.getElementById("txtHint").innerHTML="Verifying User..."; 
  } 


  else if (xmlHttp.readyState==4 || xmlHttp.readyState==200)
  { 
 
  //document.getElementById("txtHint").innerHTML=xmlHttp.responseText
  if(xmlHttp.responseText=="OK"){
  document.location.href="uhome.php"
   }
   else {
     document.getElementById("txtHint").innerHTML="Invalid UserId or Password";
     
     //document.getElementById("txtHint").innerHTML=xmlHttp.responseText;
   }
  
  } 

} 

function GetXmlHttpObject()
{ 
  var objXMLHttp=null
  if (window.XMLHttpRequest)
  {
    objXMLHttp=new XMLHttpRequest()
  }
  else if (window.ActiveXObject)
  {
    objXMLHttp=new ActiveXObject("Microsoft.XMLHTTP")
  }
  return objXMLHttp
} 
