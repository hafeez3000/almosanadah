/*
PREREQUIS POUR AJOUT AUTOCOMPLETION :
1 - balise <html> de la page doit comporter les infos de langue :
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">

2 - Le formulaire doit avoir un id
3 - Le champ input à autocompléter doit avoir un id
4 - pas d'événement de vidage sur l'input (onfocus...)
5 - inclure les fichiers JS et CSS suivants :

Files to be included to the HTML :
<link rel="stylesheet" href="/css-v60b/autocompletion.css" type="text/css" media="all" />
<script type="text/javascript" src="/scripts-v60b/lib/Url.js"></script>	
<script type="text/javascript" src="/scripts-v60b/lib/prototype.js"></script>	
	<script type="text/javascript" src="/scripts-v60b/lib/effects.js"></script>	
	<script type="text/javascript" src="/scripts-v60b/lib/controls.js"></script>			
	<script type="text/javascript" src="/scripts-v60b/autocompletion.js"></script>	

6 - appel à addAutoCompletionDestination() au loading de la page

formID = 'bookingEngine';
fieldID = 'hotel_ou_ville';
validationID = 'bouton_validation';

window.onload=function(){
	formID = 'id_of_the_form';
	fieldID = 'id_of_text_input_field';
	validationID = id of validation button ; // facultatif
	givenBrand = 'code marque'; // facultatif, permet de filtrer sur une marque specifique dans un contexte global (sur ACH par exemple)
	addAutoCompletionDestination(formID, fieldID [, validationID, givenBrand]);
}

//Permet de recuperer la langue de la page. Meta OBLIGATOIRE sur les pages incluant ce js !
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
 */
if (!self.getDirLangFromHtmlAttrib) {
	if (!self.convertEn2Gb) {
		function convertEn2Gb(langue) {
			if (langue && langue.toUpperCase()=="EN")		langue = "gb";
			return langue;
		}
	}
	function getDirLangFromHtmlAttrib() {
		var htmlTag = document.getElementsByTagName("html")[0];
		var langue = "";
		if(htmlTag.attributes["xml:lang"] && htmlTag.attributes["xml:lang"].value)
			langue = htmlTag.attributes["xml:lang"].value;
		else if(htmlTag.attributes["lang"] && htmlTag.attributes["lang"].value)
			langue = htmlTag.attributes["lang"].value;
		return convertEn2Gb(langue);
	}
}

function addAutoCompletionDestination(formID, fieldID, validationID, givenBrand)
{
	typeGeoID = 'type_geo'; // ne peut pas être changé
	codeGeoID = 'code_geo' ; // idem
	codeChaine = 'code_chaine'; //idem
	
	var homeEngine = $(formID);
	if(!$(fieldID+'_update')){
		// creer via le dom le div fieldID+"_update"
		var update = 	document.createElement('div'); // a proximite de fieldID
		// add class, add id
		update.setAttribute('style','display:none;');
		update.setAttribute('id',fieldID+'_update');
		update.setAttribute('class','update');

		$(fieldID).parentNode.insertBefore(update,$(fieldID));
	}

	// creer via le dom l'input typeGeoID
	var geocode = document.createElement('input');// id="type_geo" name="type_geo" type="hidden"
	geocode.setAttribute('id',typeGeoID);
	geocode.setAttribute('name',typeGeoID);
	geocode.setAttribute('type','hidden');
	homeEngine.appendChild(geocode);
	// creer via le dom l'input codeGeoID
	var geotype = document.createElement('input');// id="code_geo" name="code_geo" type="hidden"
	geotype.setAttribute('id',codeGeoID);
	geotype.setAttribute('name',codeGeoID);
	geotype.setAttribute('type','hidden');
	homeEngine.appendChild(geotype);
	// creer via le dom l'input codeChaine
	var geobrand = document.createElement('input');// id="code_chaine" name="code_chaine" type="hidden"
	geobrand.setAttribute('id',codeChaine);
	geobrand.setAttribute('name',codeChaine);
	geobrand.setAttribute('type','hidden');
	homeEngine.appendChild(geobrand);

	var emptyGeoCode = function(e) {
		if(window.event && window.event.keyCode == 13) { if (validationID != null) 	$(validationID).focus(); /* Enter IE */ }
		else if(e.keyCode == 13) { ; /* Enter FF */ }
		else { $(typeGeoID).value="";$(codeGeoID).value=""; /* other keys */ }
	};

	Event.observe($(fieldID), 'keydown', emptyGeoCode.bind(homeEngine), false);


	/*AutoCompletion******************************/
	var _autoCompleterMinChars = 2;
	var _maxReponse = 10;
	
	var _inputDestExtract = function (inputValue){
		//Traitement de la saisie utilisateur pour ignorer certains mot-clefs (les marques) et isoler la partie "destination"
		var pattern = '';	
		brandsFilter.each( 
			function(brand) {
				pattern += brand.patterns.join(' |')+' |';
			}
		);
		var exclusionBrands = new RegExp(pattern.substring(0,pattern.length-1), 'gi');
		var ret = inputValue.replace(exclusionBrands, '');
	    if (ret.length>1)
			return ret;
	    return inputValue;    
	};
	
	var _inputBrandExtract = function (inputValue){
		var brandCode = 'ALL';
		
		//Initialisation du code marque (cas des sites marques)
		webSites.each( 
			function(site) {
				var exp = new RegExp(site.domain , 'gi');
				if (exp.test(document.domain)) 
				{
					brandCode = site.code_chaine;
					throw $break;
				}
			}
		);
		
		//Traitement de la saisie utilisateur pour isoler une marque (sur les portails mutlimarques uniquement)
		if (brandCode == 'ALL')
		{
			brandsFilter.each( 
				function(brand) {
					var exp = new RegExp(brand.patterns.join(' |')+' ' , 'gi');
					if (exp.test(inputValue)) 
					{
						brandCode = brand.code_chaine;
						throw $break;
					}
				}
			);
		}
		return brandCode;
	};

	var _urlGenerator = function (inputValue){
		var codeLang = getDirLangFromHtmlAttrib();
		if (codeLang == 'sv') codeLang = 'gb';
		// Vérification des includes
		if(typeof Url == 'undefined')
			throw("_urlGenerator method requires including scripts/lib/Url.js library");
		var index = 0;
		
		var extractedBrandValue = _inputBrandExtract(inputValue);;
		
		if(givenBrand != null){
			$(codeChaine).value = givenBrand;
			extractedBrandValue = givenBrand;
		}
		else{
			$(codeChaine).value = extractedBrandValue;
		}
		
		var extractedDestinationValue = _inputDestExtract(inputValue);
		if (extractedDestinationValue.length>=_autoCompleterMinChars)
			var UTF8inputValue = Url.encode(extractedDestinationValue.substring(0,_autoCompleterMinChars).toLowerCase());
		// Construit l'URL à partir de la saisie utilisateur
		var autoCompletionFileUrl = '/auto/'+extractedBrandValue+'/'+codeLang+'_'+UTF8inputValue+'.txt';
		return autoCompletionFileUrl;
	};
	
	var _responseFormatter = function (cityArray){
		//Reçoit une liste de ville
		var _innerHtml="<ul class=\"liste_dest\">";
		for (var i=0;i < cityArray.length; i++) {
			var cityInfo = cityArray[i].split('\\');
			country = "";
			if (cityInfo[2].length>0)
				country = ", "+cityInfo[1];
			code=cityInfo[2];
			type=cityInfo[3]
			_innerHtml = _innerHtml+"<li><div class=\"city\"><b>"+cityInfo[0]+"</b>"+country+"</div>";
			//_innerHtml = _innerHtml+"<div class=\"cityInfo\"><span class=\"informal\">"+cityInfo[1]+ " hôtels</span></div>";//*/
			_innerHtml = _innerHtml+"<div class=\"cityInfo\"><span class=\"informal\" style=\"display:none\">"+code+ "-code-"+type+ "-type</span></div>";//*/
			_innerHtml = _innerHtml+"</li>"; 
		}
		return _innerHtml+"</ul>";
	};
	
	var _setHiddenField = function (field, item){
		var regex = new RegExp('[a-z0123456789]*-type', 'i');
		var str = regex.exec($(item).innerHTML);
		var geo = str[0].replace('-type', '');
		$(typeGeoID).value = geo;

		regex = new RegExp('[a-z0123456789]*-code', 'i');
		str = regex.exec($(item).innerHTML);
		geo = str[0].replace('-code', '');
		$(codeGeoID).value = geo; 
	};
	
	/* Activation AutoCompletion */
	var destCompleter = new Autocompleter.Specific (
		fieldID,
		fieldID+"_update",
		_urlGenerator,
		_responseFormatter,
		_inputDestExtract,
		_maxReponse,
		{
			method: "get",
			minChars: _autoCompleterMinChars,
			afterUpdateElement: _setHiddenField
		}
	);
}





// AutoCompleter spécifique Accor basé sur Ajax.AutoCompleter de la librairie sciptaculous
// Specific Accor autocompletion required parameter:
// - element - Nom de l'input à completer
// - update - Nom de la div où afficher les entrées de complétion
// - urlGenerator - Fonction de génération de l'URL
// - responseFormatter - Fonction  de formattage de la réponse pour affichage.

// Vérification des includes
if(typeof Autocompleter.Base == 'undefined')
	throw("autocompletion.js requires including script.aculo.us' controls.js library");
  
Autocompleter.Specific = Class.create(Autocompleter.Base, {
	initialize: function(element, update, urlGenerator, responseFormatter, inputValueExtract, maxResponse, options) {
		this.baseInitialize(element, update, options);
		this.options.asynchronous  = true;
		this.options.onComplete    = this.onComplete.bind(this);
		this.options.defaultParams = this.options.parameters || null;
		this.urlGenerator = urlGenerator;
		this.inputValueExtract = inputValueExtract;
		this.maxResponse = maxResponse;
		this.responseFormatter = responseFormatter;
	},

	getUpdatedChoices: function() {
		// Permet d'afficher un indicateur d'attente
		//this.startIndicator();

		var entry = ''; //QueryString

		// Appel à la méthode de génération de l'URL
		this.url = this.urlGenerator(this.element.value);

		// On ne fait pas 2 fois la même requête de suite
		if (this.previousUrl != this.url){
			new Ajax.Request(this.url, this.options);
			this.previousUrl=this.url;
		}
		else {
			this.onComplete(this.previousRequest);
		}
	},

	onComplete: function(request) {
		this.previousRequest=request;
		//Filtre les réponses du fichier texte
		var list = this.responseFilter(request.responseText,this.element.value);
		//Appel à la fonction de formatage des données
		this.innerHtml = this.responseFormatter(list);            
		this.updateChoices(this.innerHtml);
	},
  
	responseFilter: function(response, inputValue){
		//Reçoit le conenu d'un fichier et la saisie utilisateur pour filtrer le résultat
		var array = new Array();
		array = response.split('\n');
		var sortedList=new Array();
		if (array.length>0){
			for (var i=0,j=0; i < array.length && j<this.maxResponse; i++) {
				var entry = array[i];
				inputValue = inputValue.replace('-',' ');
				inputValue = this.inputValueExtract(inputValue);
				if (entry.toLowerCase().indexOf(inputValue.toLowerCase())==0){ 
					// on ajoute les entrées dont les premiers caractères correspondent 
					// à la saisie (comparaison insensible à la casse) 
					sortedList.push(entry);
					j++;
				}
			}
		}
		return sortedList;
	}
});

// Liste des libellés exclus pour l'autocomplétion 
// Autocomplétion sur un destination : faire en sorte que si on tape "Sofitel par", on propose toutes les destinations commençant par "par" en filtrant sur "SOF"
var brandsFilter = [
	{
		"code_chaine": "SOF",
		"patterns": [
			"sofitel",
			"ソフィテル",
			"索菲特"
		]
	},
	{
		"code_chaine": "NOV",
		"patterns": [
			"novotel",
			"ノボテル",
			"诺富特"
		]
	},
	{
		"code_chaine": "IBI",
		"patterns": [
			"ibis",
			"イビス",
			"宜必思"
		]
	},
	{
		"code_chaine": "MER",
		"patterns": [
			"mercure",
			"メルキュール",
			"美居"
		]
	},
	{
		"code_chaine": "ETP",
		"patterns": [
			"etap hotel",
			"etap",
			"etaphotel", 
			"hotel etap",
			"エタップ"
		]
	},
	{
		"code_chaine": "FOR",
		"patterns": [
			"f1",
			"formule 1",
			"formule un",
			"formule1",
			"hotel f1",
			"hotel formule 1",
			"hôtel formule 1",
			"hotel formule1",
			"hotelf1",
			"フォーミュラワン"
		]
	},
	{
		"code_chaine": "PUL",
		"patterns": [
			"pullman",
			"プルマン",
			"铂尔曼"
		]
	},
	{
		"code_chaine": "SUI",
		"patterns": [
			"hotel suite hotel",
			"suite hotel",
			"suite hôtel",
			"suite hotels",
			"suite",
			"suitehotel",
			"suitehotels",
			"suite-hotel",
			"スイートホテルズ"
		]
	},
	{
		"code_chaine": "ASE",
		"patterns": [
			"all season",
			"all seasons",
			"allseasons",
			"all-seasons",
			"オールシーズンズ"
		]
	},
	{
		"code_chaine": "MGA",
		"patterns": [
			"gallery",
			"m gallery",
			"mgallery",
			"Mギャラリー",
			"美憬阁"
		]
	},
	{
		"code_chaine": "ADG",
		"patterns": [
			"adagio",
			"アダジオ"
		]
	},
	{
		"code_chaine": "MOT",
		"patterns": [
			"motel 6",
			"motel6",
			"モーテルシックス"
		]
	},
	{
		"code_chaine": "STD",
		"patterns": [
			"studio 6",
			"studio6",
			"ストュディオシックス"
		]
	},
	{
		"code_chaine": "ALL",
		"patterns": [
			"accor thalassa",
			"accorthalassa",
			"thalassa",
			"アコータラサ"
		]
	},
	{
		"code_chaine": "CM",
		"patterns": [
			"club méditerranée",
			"club mediterranee",
			"club med"
		]
	},
	{
		"code_chaine": "ORB",
		"patterns": [
			"orbis"
		]
	},
	{
		"code_chaine": "COR",
		"patterns": [
			"coralia"
		]
	}
];

var webSites = [
	{
		"domain": "sofitel.com",
		"code_chaine": "SOF"
	},
	{
		"domain": "pullmanhotels.com",
		"code_chaine": "PUL"
	},
	{
		"domain": "novotel.com",
		"code_chaine": "NOV"
	},
	{
		"domain": "mercure.com",
		"code_chaine": "MER"
	},
	{
		"domain": "suitehotel.com",
		"code_chaine": "SUI"
	},
	{
		"domain": "all-seasons-hotels.com",
		"code_chaine": "ASE"
	},
	{
		"domain": "ibishotel.com",
		"code_chaine": "IBI"
	},
	{
		"domain": "etaphotel.com",
		"code_chaine": "ETP"
	},
	{
		"domain": "hotelformule1.com",
		"code_chaine": "FOR"
	}
];