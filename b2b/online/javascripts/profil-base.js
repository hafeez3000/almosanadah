 /*
 /	Objet global appele sur l'ensemble des pages du profil
 /	Contient des methodes communes
 */
 var profil = {

	retry : false,
	context : "B2C",
	siteCode : null,
	
	/*
	/	Etablit le contexte de navigation : B2C ou B2B
	*/
	init : function(){
		var paramContext = Url.getUrlParameter('context').toUpperCase();
		
		// Différents cas : 
		// on force le contexte B2B sur les sites pro en laissant l'accès possible à un profil B2C
		// on force le contexte B2C sur Ibis, Etap et F1, sans accès possible à un profil pro
		// sur les autres sites, le contexte est B2C par défaut, avec possibilité d'accès à un profil B2B
		var isB2BSite = new RegExp('^(s-)*(businesstravel|meetings|travelagencies).accorhotels.com$','g');
		if (this.siteCode == 'ALL' && isB2BSite.test(document.domain)){
			if(paramContext && (paramContext == 'B2B' || paramContext == 'B2C')){
				this.context = paramContext;
			}
			else{
				this.context = 'B2B';
			}
		}
		else if(this.siteCode != "IBI" && this.siteCode != "ETP" && this.siteCode != "FOR"){
			if(paramContext && (paramContext == 'B2B' || paramContext == 'B2C')){
				this.context = paramContext;
			}
			else{
				this.context = 'B2C';
			}
		}
		else{
			this.context = 'B2C';
			if($('profil-change-access-bg') && $('profil-change-access')){
				$('profil-change-access-bg').style.display = "none";
				$('profil-change-access').style.display = "none";
			}
		}
	},
	
	adaptAlphaBackground : function(referent, modified){
		if(referent && modified){
			modified.style.width= referent.offsetWidth + "px";
			modified.style.height= referent.offsetHeight + "px";
		}
	},
	
	/*
	/	Passe tous les elements input et select de container a disable = true
	/ param container = String : ID de l'element englobant les elements a modifier
	*/
	disableFormElements : function(container){
		if($(container)){
			var inputs = $(container).select('input');
			var selects = $(container).select('select');
			
			inputs.each(function(el){
				if(el){
					el.disabled = true;
				}
			});
			
			selects.each(function(el){
				if(el){
					el.disabled = true;
				}
			});
		}
	},
	
	/*
	/	Passe tous les elements input et select de container a disable = false
	/ param container = String : ID de l'element englobant les elements a modifier
	*/
	enableFormElements : function(container){
		if($(container)){
			var inputs = $(container).select('input');
			var selects = $(container).select('select');
			
			inputs.each(function(el){
				if(el){
					el.disabled = false;
				}
			});
			
			selects.each(function(el){
				if(el){
					el.disabled = false;
				}
			});
		}
	},
	
	/*
	/	Rempli un select avec une liste de nombre (utilise pour les dates)
	/ param selectElement = DOM Element (ex : $('leSelect'))
	/ param startValue = Number (premier nombre de la liste)
	/ param endValue = Number (dernier nombre de la liste)
	/ param blankValue = String (chaine a afficher comme premier element du select, valeur par defaut)
	/ param order = String (desc:pour generer la liste dans l'ordre descendant / asc: pour l'ordre ascendant qui est le comportement par defaut)
	*/
	fillDateSelect : function(selectElement, startValue, endValue, blankValue, order){
		selectElement.options.length=0;
		selectElement.innerHTML="";
	
		var index = 0;
		var selectIndex = -1;
	
		if(blankValue!=null)
			selectElement[index++]=new Option(blankValue, "");
	
		if(order && order == "desc"){
			for(var i=endValue; i> startValue-1; i --){
				selectElement.options[index] = new Option(i,i);
				index++;
			}
		}
		else{
			for(var i=startValue; i< endValue+1; i ++){
				selectElement.options[index] = new Option(i,i);
				index++;
			}
		}
	},
	
	/*
	/	Methodes relatives a l'appel Ajax
	*/
	isNotEmpty : function(object) {
	  for(var i in object) { return true; }
	  return false;
	},
	
	getSessionId : function() {
    var sessionCookieName = "JSESSIONID"; 
    var cookies = document.cookie.split(';');
    for (var i = 0; i < cookies.length; i++) {
      var cookie = cookies[i];
      while (cookie.charAt(0) == ' ') cookie = cookie.substring(1, cookie.length);
      if (cookie.indexOf(sessionCookieName + "=") == 0) {
        return cookie.substring(sessionCookieName.length + 1, cookie.length);
      }
    }
    return "";
  },
	
	execute : function(formId, errorMsgDiv, callbackExternalFunction, onCompleteExternalFunction){
	  var form = $(formId);  
	  if (this.retry == false){
	    this.retry = true;
	    
	      new Ajax.Request(
	        form.action, 
	        {
	            method: 'post',              
	            parameters: Form.serialize(form) + "&httpSessionId=" + this.getSessionId(),
	            onComplete : function(request){
	             profil.postValidation(request, formId, errorMsgDiv, callbackExternalFunction, onCompleteExternalFunction);
	            }
	        });
	  }
	  return false;   
  },

	
	postValidation : function(request, formId, errorMsgDiv, callbackExternalFunction, onCompleteExternalFunction) {
 
    var form = $(formId);
    var errorKeys = new Array();
    var messageKeys = new Array();
 
    //clear previous validation errors, if any
    StrutsUtils.clearValidationErrors(form);
    StrutsUtils.clearActionErrors(errorMsgDiv);
 
    //get errors from response
    var response = StrutsUtils.getValidationErrors(request.responseText);
 
    if(response && request.status == 200) {
      // Functional errors on Actions (functional errors keys)
      if(response.actionErrors && response.actionErrors.length > 0)
      	errorKeys = errorKeys.concat(response.actionErrors)

      // Functional messages on Actions (actionMessages)
      if(response.actionMessages && response.actionMessages.length > 0)
      	messageKeys = messageKeys.concat(response.actionMessages)
 
      // Errors on fields (not validated fields/keys OR fields which caused action error)
      if(response.fieldErrors && this.isNotEmpty(response.fieldErrors)){
        hightlightErrorFields(response);
        if (errorKeys.length==0) // si on a pas d'actionErrors, alors il s'agit d'erreur de validation
          errorKeys.push("generic.error.validation"); // on fixe un message generique
      }
 
      // Technical error (textual message from application server "OOoops + stack")
      if (response.technicalErrors && response.technicalErrors.length > 0) {
        if (response.technicalErrors[0].indexOf("9000-") >= 0) {
          var redirect = "/"+getDirLangFromHtmlAttrib()+"/session/expired.html";
        } else if (response.technicalErrors[0].indexOf("2101") >= 0 || response.technicalErrors[0].indexOf("2100-3") >= 0 || response.technicalErrors[0].indexOf("2200-3") >= 0){
        	errorKeys.push("generic.error.service.down");
          errorKeys = errorKeys.concat(response.technicalErrors);
        }
        else if (response.technicalErrors.length > 0) { // "[xxx:xxxx] "
          errorKeys.push("generic.error.technical");
          errorKeys = errorKeys.concat(response.technicalErrors);
        }
      }
    } else if (request.status) {
        errorKeys.push("generic.error.server");
        errorKeys.push("[" + request.status + "]");
    }
 
    for(var i=0; i<errorKeys.length; i++){
    	errorKeys[i] = I18N._('profil.errors', errorKeys[i]);
    }
    for(var i=0; i<messageKeys.length; i++){
    	messageKeys[i] = I18N._('profil.messages', messageKeys[i]);
    }
 

    if (errorKeys.length > 0) {
      $(errorMsgDiv).innerHTML = errorKeys.join("<br />");
      $(errorMsgDiv).style.display = "block";
      eval(callbackExternalFunction);
      if($('errorComeback'))
				window.location="#errorComeback";
    } else {
        if (messageKeys.length > 0) {
          $(errorMsgDiv).innerHTML = messageKeys.join("<br />");
          $(errorMsgDiv).style.display = "block";
        }
	    	//get returned viewBeans object
	     if(response['viewBeans'] && viewBeans){
	     	for(var beanName in response['viewBeans']) {
	     		viewBeans[beanName] = response['viewBeans'][beanName];
	     	}
	     	
	     	for(var i=0;i<core.length;i++)
          core[i].initJSON();

	     }
      eval(onCompleteExternalFunction);
    }
    
    if (redirect)
      document.location = redirect;
 
    this.retry = false;

    return errorKeys;
  },
  
  gotoUrl : function(URL){
  	if(URL) document.location = URL;
  },
  
  /*
  /	Lors du changement de context B2C / B2B, on doit changer les images des tooltips
  / changement qui n'est pas gere par le CSS
  */
  changeTooltipImg : function(){
		var listTooltip = $('profil-content').select('a.tooltipLink');
		listTooltip.each(function(tooltip){
			if(tooltip){
				var tooltipImg = tooltip.select('img')[0];
				if(tooltipImg){
					if(profil.context == "B2B"){
						if(tooltipImg.hasClassName('tooltip')) tooltipImg.src="/imagerie/profil/tooltip_pro2.png";
						else tooltipImg.src = "/imagerie/profil/tooltip_pro.png";
					}
					else if(profil.context == "B2C"){
						if(tooltipImg.hasClassName('tooltip')) tooltipImg.src="/imagerie/profil/tooltip2.png";
						else tooltipImg.src = "/imagerie/profil/tooltip.png";
					}
				}
			}
		});
	},
	
	/*
	/	Lors du changement de context B2C / B2B, force l'affichage des select pour que le nouveau style soit bien pris en compte
	*/
	reloadSelects : function(){
		var listeSelects = $('profil-content').select('select');
		listeSelects.each(function(sel){
			if(sel){
				sel.style.display = "none";
				sel.style.display = "inline";
			}
		});
	},
	
	/*
  /	Lors du changement de context B2C / B2B, on doit changer les images des boutons de suppresion
  / changement qui n'est pas gere par le CSS
  */
	changeDeleteButtons : function(){
		var listButtons = $('profil-content').select('a.suppression');
		listButtons.each(function(but){
			if(but){
				var butImg = but.select('img')[0];
				if(butImg){
					if(profil.context == "B2B"){
						butImg.src = "/imagerie/profil/bt-supp-pro.png";
					}
					else if(profil.context == "B2C"){
						butImg.src = "/imagerie/profil/bt-supp.png";
					}
				}
			}
		});		
	},
	
	/*
  / Selectionne une valeur donnee dans un select
  */
	preselectGivenValue : function(selectId, value){
		if($(selectId) && value != ""){
			for(var i=0; i< $(selectId).options.length; i++){
				if($(selectId).options[i].value == value){
					$(selectId).selectedIndex = i;
				}
			}
		}
	},
	
	/*
  /	Pour la date de naissance de l'utilisateur
  /	Set la value du champ input type hidden d'apres les values des select jour, mois, annee
  */
	setHiddenFieldBirthDate : function(){
		if($('user-birthDay') && $('user-birthMonth') && $('user-birthYear') && $('user-birthDate')){		
			if($('user-birthDay').value == '' && $('user-birthMonth').value == '' && $('user-birthYear').value == ''){
				$('user-birthDate').value = "";
				$('v-user-birthday').innerHTML = I18N._('profil.modify', 'unknown');				
			}
			else{
				$('user-birthDate').value = $('user-birthDay').value + "/"+ $('user-birthMonth').value + "/" + $('user-birthYear').value;
			}
		}
	},
	
	/*
  /	Pour les dates de naissance des enfants
  /	Set la value du champ input type hidden d'apres les values des select jour, mois, annee
  */
	setHiddenFieldChildrenBirthDate : function(evt){
		var target = evt.target || evt.srcElement;
		var childRef = target.id.split('-')[1];
		var inputID = "user-"+childRef+"-birthDate";
		
		if($("user-"+childRef+"-day") && $("user-"+childRef+"-month") && $("user-"+childRef+"-year") && $(inputID)){
			if($("user-"+childRef+"-day").value == '' && $("user-"+childRef+"-month").value == '' && $("user-"+childRef+"-year").value == ''){
				$(inputID).value = "01/01/1899";
			}
			else{
				var birthDate = $("user-"+childRef+"-day").value + "/" + $("user-"+childRef+"-month").value + "/" + $("user-"+childRef+"-year").value;
				$(inputID).value = birthDate;
			}
		}
	},
	
	/*
	/	Methodes pour la gestion des enfants (ajout, suppression)
	*/
	displayChildrenList : function(){
		if($('details-enfants') && $('user-childs-y') && $('user-childs-n')){
			Event.observe(
				$('user-childs-y'),
				'click',
				function(){
					if($('user-childs-y').checked == true){
						var childsOn = $('details-enfants').select('div.on');
						childsOn.each(function(child){
							profil.enableFormElements(child);
						});
						$('details-enfants').style.display="block";
					}
				}
			);
			
			Event.observe(
				$('user-childs-n'),
				'click',
				function(){
					if($('user-childs-n').checked == true){
						$('details-enfants').style.display="none";
						var childsOn = $('details-enfants').select('div.on');
						childsOn.each(function(child){
							profil.disableFormElements(child);
						});
					}
				}
			);
		}
	},
	
	addChild : function(){
		var childsOff = $('details-enfants').select('div.off');
		if(childsOff && childsOff.length > 0){
			childsOff[0].removeClassName('off');
			childsOff[0].addClassName('on');
			
			var childSelects = childsOff[0].select('select');
			childSelects.each(function(sel){
				if(sel)
					sel.selectedIndex = 0;
			});
			
			profil.enableFormElements(childsOff[0]);
			childsOff[0].style.display="block";
			profil.displayDeleteChildButtons();
		}
	},
	
	// Action sur le click du bt supprimer
	// Principe : afficher / masquer les lignes, reporter les valeurs saisies dans les premieres lignes
	// afin que la prochaine ligne ajoutee soit vide et toujours en fin de liste
	deleteChild : function(refButton){
		if(refButton){
			var refChild = refButton.parentNode.parentNode.parentNode;
			
			var selectDayValues = new Array();
			var selectMonthValues = new Array();
			var selectYearValues = new Array();
			var inputValues = new Array();
			
			if(refChild){
				refChild.removeClassName('on');
				refChild.addClassName('off');
				var allChilds = $('details-enfants').select('div.liste-enfant');
				var childsOn = $('details-enfants').select('div.on');
				childsOn.each(function(child){
					var childSelectDay = child.select('select.jour')[0];
					if(childSelectDay){
						selectDayValues.push(childSelectDay.selectedIndex);
					}
					var childSelectMonth = child.select('select.mois')[0];
					if(childSelectMonth){
						selectMonthValues.push(childSelectMonth.selectedIndex);
					}
					var childSelectYear = child.select('select.annee')[0];
					if(childSelectYear){
						selectYearValues.push(childSelectYear.selectedIndex);
					}
					var childInput = child.select('input')[0];
					if(childInput){
						inputValues.push(childInput.value);
					}
				});

				if(allChilds && allChilds.length > 0){
					
					for(i=0; i< selectDayValues.length; i++){
						if(allChilds[i].hasClassName('off')) allChilds[i].removeClassName('off');
						allChilds[i].addClassName('on');
						profil.enableFormElements(allChilds[i]);

						childSelectDay = allChilds[i].select('select.jour')[0];
						if(childSelectDay){
							childSelectDay.selectedIndex = selectDayValues[i];
						}
						childSelectMonth = allChilds[i].select('select.mois')[0];
						if(childSelectMonth){
							childSelectMonth.selectedIndex = selectMonthValues[i];
						}
						childSelectYear = allChilds[i].select('select.annee')[0];
						if(childSelectYear){
							childSelectYear.selectedIndex = selectYearValues[i];
						}
						
						childInput = allChilds[i].select('input')[0];
						if(childInput){
							childInput.value = inputValues[i];
						}
						
						allChilds[i].style.display="block";
					}
					
					for(i=selectDayValues.length; i< allChilds.length; i++){
						allChilds[i].style.display="none";
						if(allChilds[i].hasClassName('on')) allChilds[i].removeClassName('on');
						allChilds[i].addClassName('off');

						var childSelects = allChilds[i].select('select');
						childSelects.each(function(sel){
							if(sel)
								sel.selectedIndex = 0;
						});
						
						var childInputs = allChilds[i].select('input');
						childInputs.each(function(ipt){
							if(ipt)
								ipt.value = '';
						});
						
						profil.disableFormElements(allChilds[i]);
					}
				}
				profil.displayDeleteChildButtons();
			}
		}
	},
	
	displayDeleteChildButtons : function(){
		
			var childsOn = $('details-enfants').select('div.on');
			if(childsOn && childsOn.length < 2){
				childsOn.each(function(child){
					if(child){
						var deleteButton = child.select('a.suppression')[0];
						if(deleteButton){
							deleteButton.hide();
						}
					}
				});
			}
			else{
				childsOn.each(function(child){
					if(child){
						var deleteButton = child.select('a.suppression')[0];
						if(deleteButton){
							deleteButton.show();
						}
					}
				});
			}
			
			var childsOff = $('details-enfants').select('div.off');
			if(childsOff && childsOff.length == 0){
				$('addChild-container').style.display="none";
			}
			else{
				$('addChild-container').style.display="block";
			}
	},
	// Fin des methodes des enfants
	
	displayReasonsDetails : function(){
		if($('user-marketingData-reservationReason') && $('professionnal') && $('private')){
			Event.observe(
				$('user-marketingData-reservationReason'),
				'change',
				function(){
					var cas = $('user-marketingData-reservationReason').value;
					switch(cas){
						case "1":
							$('private').removeClassName('hide');
							$('professionnal').addClassName('hide');
							profil.enableFormElements($('private'));
							profil.disableFormElements($('professionnal'));
							break;
							
						case "2":
							$('private').addClassName('hide');
							$('professionnal').removeClassName('hide');
							profil.enableFormElements($('professionnal'));
							profil.disableFormElements($('private'));
							break;
							
						case "3":
							$('private').removeClassName('hide');
							$('professionnal').removeClassName('hide');
							profil.enableFormElements($('private'));
							profil.enableFormElements($('professionnal'));
							break;
							
						default:
							$('private').addClassName('hide');
							$('professionnal').addClassName('hide');
							profil.disableFormElements($('private'));
							profil.disableFormElements($('professionnal'));
							break;
					}
				}
			);
		}
	},
	
	setNavLinks : function(brand, lang){
		if($('bt-offers'))
			var moreOffersLink = $('bt-offers').select('a')[0];
			
		if($('bt-home'))
			var homeLink = $('bt-home').select('a')[0];
			
		switch(brand){
			case "ALL" :
				if(homeLink) homeLink.href="http://www.accorhotels.com";
				if(moreOffersLink) moreOffersLink.href="http://www.accorhotels.com/"+lang+"/promotion/discount-hotel-reservation.shtml";
				break;
				
			case "SOF" :
				if(homeLink) homeLink.href="http://www.sofitel.com";
				if(moreOffersLink) moreOffersLink.href="http://www.sofitel.com/"+lang+"/hotel-deals/index.shtml";
				break;
				
			case "PUL" :
				if(homeLink) homeLink.href="http://www.pullmanhotels.com";
				if(moreOffersLink) moreOffersLink.href="http://www.pullmanhotels.com/"+lang+"/hotel-deals/index.shtml";
				break;
				
			case "NOV" :
				if(homeLink) homeLink.href="http://www.novotel.com";
				if(moreOffersLink) moreOffersLink.href="http://www.novotel.com/"+lang+"/hotel-deals/index.shtml";
				break;
				
			case "MER" :
				if(homeLink) homeLink.href="http://www.mercure.com";
				if(moreOffersLink) moreOffersLink.href="http://www.mercure.com/"+lang+"/hotel-deals/index.shtml";
				break;
				
			case "SUI" :
				if(homeLink) homeLink.href="http://www.suitehotel.com";
				if(moreOffersLink) moreOffersLink.href="http://www.suitehotel.com/hotel-cms/"+lang+"/pages_index/page_index_16.shtml";
				break;
				
			case "IBI" :
				if(homeLink) homeLink.href="http://www.ibishotel.com";
				if(moreOffersLink) moreOffersLink.href="http://www.ibishotel.com/"+lang+"/hotel-deals/index.shtml";
				break;
				
			case "ASE" :
				if(homeLink) homeLink.href="http://www.all-seasons-hotels.com";
				if(moreOffersLink) moreOffersLink.href="http://www.all-seasons-hotels.com/"+lang+"/discovering-allseasons-hotel/special-offers/index.shtml";
				break;
				
			case "ETP" :
				if(homeLink) homeLink.href="http://www.etaphotel.com";
				if(moreOffersLink) moreOffersLink.href="http://www.etaphotel.com/"+lang+"/etap-hotel-deals/index.shtml";
				break;
				
			case "THA" :
				if(homeLink) homeLink.href="http://www.accorthalassa.com";
				if(moreOffersLink) moreOffersLink.href="http://www.accorthalassa.com/hotel-cms/"+lang+"/promotion/promotion-thalasso.shtml ";
				break;
				
			case "FOR" : 
				if(homeLink) homeLink.href="http://www.hotelformule1.com";
				if($('bt-offers')) $('bt-offers').style.display = "none";
				break;
		}
	},
	
	/*
	/	Cree l'element <li> contenant la chackbox et l'intitule de la newsletter demandee
	/ param ulId = String (ID de la liste <ul> contenant les <li> crees)
	/ param nlCode = String (code de la newsletter a creer, ex: AEC, PUL_AEC, etc ...)
	/ param num = Number (numero d'indexation de la liste, utile pour la validation Struts)
	/ param classCss = String (classCss a appliquer au <li> en cours de creation)
	*/
	createNewsletterChoice : function(ulId, nlCode, num, classCss){
		if($(ulId)){
			var inputElement = document.createElement('input');
			inputElement.name = "user.newsletters["+num+"].codeSubscription";
			inputElement.type = "checkbox";
			inputElement.className = "checkbox";
			inputElement.id = "user-newsletters-"+nlCode;
			inputElement.value = nlCode;
			
			var labelElement = document.createElement('label');
			newatt=document.createAttribute("for");
			newatt.nodeValue="user-newsletters-"+nlCode;
			labelElement.setAttributeNode(newatt);
			labelElement.innerHTML = I18N._('profil.newsletter', nlCode);
			
			var liElement = document.createElement('li');
			if(classCss) liElement.className = classCss;
			liElement.appendChild(inputElement);
			liElement.appendChild(labelElement);
			
			$(ulId).appendChild(liElement);
		}		
	}
}

/* 
/	Permet de recuperer la langue de la page. Meta OBLIGATOIRE sur les pages incluant ce js !
/	<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
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

//Declanche un evenement
function fireEvent(element,event){
  if (document.createEventObject){
      // dispatch for IE
      var evt = document.createEventObject();
      element.fireEvent('on'+event,evt)
  }
  else{
      // dispatch for firefox + others
      var evt = document.createEvent("HTMLEvents");
      evt.initEvent(event, true, true ); // event type,bubbling,cancelable
       !element.dispatchEvent(evt);
  }
}

if(!Calendar){var Calendar = function(){}}
/* Prints the date in a string according to the given format. */
Date.prototype.print = function (str) {
	var m = this.getMonth();
	var d = this.getDate();
	var y = this.getFullYear();
	var wn = this.getWeekNumber();
	var w = this.getDay();
	var s = {};
	var hr = this.getHours();
	var pm = (hr >= 12);
	var ir = (pm) ? (hr - 12) : hr;
	var dy = this.getDayOfYear();
	if (ir == 0)
		ir = 12;
	var min = this.getMinutes();
	var sec = this.getSeconds();
	s["%a"] = Calendar._SDN[w]; // abbreviated weekday name [FIXME: I18N]
	s["%A"] = Calendar._DN[w]; // full weekday name
	s["%b"] = Calendar._SMN[m]; // abbreviated month name [FIXME: I18N]
	s["%B"] = Calendar._MN[m]; // full month name
	// FIXME: %c : preferred date and time representation for the current locale
	s["%C"] = 1 + Math.floor(y / 100); // the century number
	s["%d"] = (d < 10) ? ("0" + d) : d; // the day of the month (range 01 to 31)
	s["%e"] = d; // the day of the month (range 1 to 31)
	// FIXME: %D : american date style: %m/%d/%y
	// FIXME: %E, %F, %G, %g, %h (man strftime)
	s["%H"] = (hr < 10) ? ("0" + hr) : hr; // hour, range 00 to 23 (24h format)
	s["%I"] = (ir < 10) ? ("0" + ir) : ir; // hour, range 01 to 12 (12h format)
	s["%j"] = (dy < 100) ? ((dy < 10) ? ("00" + dy) : ("0" + dy)) : dy; // day of the year (range 001 to 366)
	s["%k"] = hr;		// hour, range 0 to 23 (24h format)
	s["%l"] = ir;		// hour, range 1 to 12 (12h format)
	s["%m"] = (m < 9) ? ("0" + (1+m)) : (1+m); // month, range 01 to 12
	s["%M"] = (min < 10) ? ("0" + min) : min; // minute, range 00 to 59
	s["%n"] = "\n";		// a newline character
	s["%p"] = pm ? "PM" : "AM";
	s["%P"] = pm ? "pm" : "am";
	// FIXME: %r : the time in am/pm notation %I:%M:%S %p
	// FIXME: %R : the time in 24-hour notation %H:%M
	s["%s"] = Math.floor(this.getTime() / 1000);
	s["%S"] = (sec < 10) ? ("0" + sec) : sec; // seconds, range 00 to 59
	s["%t"] = "\t";		// a tab character
	// FIXME: %T : the time in 24-hour notation (%H:%M:%S)
	s["%U"] = s["%W"] = s["%V"] = (wn < 10) ? ("0" + wn) : wn;
	s["%u"] = w + 1;	// the day of the week (range 1 to 7, 1 = MON)
	s["%w"] = w;		// the day of the week (range 0 to 6, 0 = SUN)
	// FIXME: %x : preferred date representation for the current locale without the time
	// FIXME: %X : preferred time representation for the current locale without the date
	s["%y"] = ('' + y).substr(2, 2); // year without the century (range 00 to 99)
	s["%Y"] = y;		// year with the century
	s["%%"] = "%";		// a literal '%' character

	var re = /%./g;
	if (!Calendar.is_ie5 && !Calendar.is_khtml)
		return str.replace(re, function (par) { return s[par] || par; });

	var a = str.match(re);
	for (var i = 0; i < a.length; i++) {
		var tmp = s[a[i]];
		if (tmp) {
			re = new RegExp(a[i], 'g');
			str = str.replace(re, tmp);
		}
	}

	return str;
};

/* Returns the number of the week in year, as defined in ISO 8601. */
Date.prototype.getWeekNumber = function() {
	var d = new Date(this.getFullYear(), this.getMonth(), this.getDate(), 0, 0, 0);
	var DoW = d.getDay();
	d.setDate(d.getDate() - (DoW + 6) % 7 + 3); // Nearest Thu
	var ms = d.valueOf(); // GMT
	d.setMonth(0);
	d.setDate(4); // Thu in Week 1
	return Math.round((ms - d.valueOf()) / (7 * 864e5)) + 1;
};

/* Returns the number of day in the year. */
Date.prototype.getDayOfYear = function() {
	var now = new Date(this.getFullYear(), this.getMonth(), this.getDate(), 0, 0, 0);
	var then = new Date(this.getFullYear(), 0, 0, 0, 0, 0);
	var time = now - then;
	return Math.floor(time / Date.DAY);
};
