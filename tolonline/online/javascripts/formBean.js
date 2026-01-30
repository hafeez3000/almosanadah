document.write('<script type="text/javascript" src="/scripts-v60b/lib/Url.js"></script>');
document.write('<script type="text/javascript" src="/scripts-v60b/anti_doubleclick.js"></script>');

// Timestamp of formBean that page was last updated with
var req;
var _classNameOk='';
var _classNameError='';
var _form='';

var _submitUrl="";
var _functionOnSuccess="";
var _functionOnError="";
var _labelsFor;
var _formTarget;

function submitFormBean(classOk, classError, submitUrl, formulaire, functionOnSuccess, functionOnError, labelsFor, formTarget) {
 _classNameOk=classOk;
 _classNameError=classError;
 _form = formulaire;
 _submitUrl= submitUrl;
 _functionOnSuccess= functionOnSuccess;
 _functionOnError= functionOnError;
 _labelsFor = labelsFor || {};
 _formTarget= formTarget;
 var parameters = parseForm(formulaire);
 req = newXMLHttpRequest();
 req.open("POST","/validate.svlt", true);
 req.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
 parameters=parameters+"&formName="+formulaire.name;

 req.send(parameters);

 req.onreadystatechange = callback;
}

function parseForm(formulaire){

 var formElements = formulaire.elements;
 var param="";
 for(var i=0;i<formElements.length;i++){
 	var el = formElements[i];
 	var value = parseElement(el);
 	if (param!="undefined" && value && value!=undefined){
 		param = param +"&"+ value;
 	} 	
 }
 var codeLang = getDirLangFromHtmlAttrib();
 	if(codeLang)
 		param = param +"&lang="+codeLang;
 return param;
}

function parseElement(el){
	if(((el.type!='radio' && el.type!='checkbox') || el.checked) && el.value!=undefined)
		//Url.encode n'encode pas le '+' et le '/'
		return el.name+'='+Url.encode(el.value).replace('+','%2B').replace('/','%2F');
}

/* Permet de recuperer la langue de la page. Meta OBLIGATOIRE sur les pages incluant ce js !
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
 */
function getDirLangFromHtmlAttrib() {
	var htmlTag = document.getElementsByTagName("html")[0];
	var langue = "";
	if(htmlTag.attributes["xml:lang"] && htmlTag.attributes["xml:lang"].value)
		langue = htmlTag.attributes["xml:lang"].value;
	else if(htmlTag.attributes["lang"] && htmlTag.attributes["lang"].value)
		langue = htmlTag.attributes["lang"].value;
	return convertEn2Gb(langue);
}

function convertEn2Gb(langue) {
	if (langue && langue.toUpperCase()=="EN")
		langue = "gb";
  return langue;
}

function callback() {
    if (req.readyState == 4) {
        if (req.status == 200) {
            // update the HTML DOM based on whether or not message is valid
            parseMessage();
        }
    }
}

function parseMessage() {
    var foundLabel = {};
    var formBean = req.responseXML.getElementsByTagName("formBean")[0];
	    var formOk = formBean.getElementsByTagName("formOk")[0].firstChild.nodeValue;
	    var fields = formBean.getElementsByTagName("fields")[0].getElementsByTagName("field");
	    for (var i=0; i<fields.length;i++){
				var field = fields[i];
					var fieldName ="";
					var fieldValue ="";
					var fieldOk ="";
					var feildId="";

		    		if(field.getElementsByTagName("id")[0].firstChild!=null)
		    			fieldName = field.getElementsByTagName("id")[0].firstChild.nodeValue;

		    		if(field.getElementsByTagName("value")[0].firstChild!=null)
		    			fieldValue = field.getElementsByTagName("value")[0].firstChild.nodeValue;

		    		if(field.getElementsByTagName("fieldOk")[0].firstChild!=null)
		    			fieldOk = field.getElementsByTagName("fieldOk")[0].firstChild.nodeValue;
		    		
		    		if(_form[fieldName])	
		    	  	feildId = _form[fieldName].id;


				if((feildId!="" && document.getElementById(feildId)!=null && document.getElementById(feildId).className!=null) ||
							(document.getElementById(fieldName+'_label')!=null && document.getElementById(fieldName+'_label').className!=null)){
					var fieldLabel;


					//On recherche les elements avec un id de type fieldName+'_label'
					if(document.getElementById(fieldName+'_label')!=null){
						fieldLabel=document.getElementById(fieldName+'_label');
						if(fieldOk=='false')
							fieldLabel.className=_classNameError;
						else
							fieldLabel.className=_classNameOk;
					} else {
						//On recherche les elements label d'un champ
						var labels = _form.getElementsByTagName('label');
						for(var j=0; j<labels.length; j++){
						  if( labels[j].attributes['for']!=null ){
						    var attrFor = labels[j].attributes['for'].value;						    
							  if(!foundLabel[attrFor] && (feildId==attrFor || (_labelsFor[attrFor] && _labelsFor[attrFor].indexOf(feildId) != -1))){
								  var className = labels[j].className.replace(' '+_classNameError,'').replace(_classNameError,'').replace(' '+_classNameOk,'').replace(_classNameOk,'');
								  if(fieldOk=='false'){
									  labels[j].className=className+' '+_classNameError;
									  foundLabel[attrFor] = true;
								  }
								  else {
									  labels[j].className=className+' '+_classNameOk;
							    }
						    }
						  }
					  }
				 }
	     }
	    }
		if(formOk=='false'){
			var errorMessage = formBean.getElementsByTagName("errorMessage")[0].firstChild.nodeValue;
			if(document.getElementById('errorMessage'+"_"+_form.name)){
        document.getElementById('errorMessage'+"_"+_form.name).innerHTML=errorMessage+"<br>";
	   		document.getElementById('errorMessage'+"_"+_form.name).style.display="block";	
      }
      else{
        document.getElementById('errorMessage').innerHTML=errorMessage+"<br>";
	   		document.getElementById('errorMessage').style.display="block";      
      }	   		
   		if (_functionOnError) {eval(_functionOnError);}
   		// reset de l'anti doubleclick si present dans la form
   		if (typeof submit != 'undefined') {
   			submit = true;
   		}  
		}else{
			if(document.getElementById('errorMessage'+"_"+_form.name)){
        document.getElementById('errorMessage'+"_"+_form.name).innerHTML="";
	   		document.getElementById('errorMessage'+"_"+_form.name).style.display="none";	
      }
      else{
        document.getElementById('errorMessage').innerHTML="";
			  document.getElementById('errorMessage').style.display="none";    
      }			
      if (_functionOnSuccess) {eval(_functionOnSuccess);}
			if (_submitUrl){
					if(_submitUrl.indexOf("?")!=-1)
						_form.setAttribute ('action',_submitUrl+'&formName='+_form.name);	
					else
						_form.setAttribute('action',_submitUrl+'?formName='+_form.name);
						
					if(_formTarget)	
						_form.target=_formTarget;
					
          if(submitThisForm())							
			      _form.submit();
		  }
		}
}