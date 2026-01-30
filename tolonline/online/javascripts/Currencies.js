/**
 * Objet javascript permettant de g?rer les donn?es des devises
 */
 var niveau ;
var class_technique = "techPrice" ; 
var Currencies = {
    currenciesViewBean: null,
		OriginalCurrency: null,
    CrtCurrency: null,
    /**
     * Liste des noms d'objets ? utiliser.
     */
    getBeans: function() {
        return "CurrenciesViewBean";
    },
    
    /**
     * Initialisation de la variable JSON
     */
    initJSON: function() {
        var num;
    	try {
        	for( num in beans){
                if("CurrenciesViewBean" == beans[num].nom) {
            		currenciesViewBean = beans[num].bean;
            	} 
					
            }
        } catch(e) {
    		alert(e);
    	}
    },
	
    /**
     * Retourne la variable de classe instanci?e.
     */
    getCurrenciesViewBean: function() {
        return currenciesViewBean;
    }, 
    getScriptArg: function() {
    	var ss_oas = document.getElementsByTagName("head")[0].getElementsByTagName("script"); var s_oas;
			for (var i =0;i<ss_oas.length;i++){if (ss_oas[i].src && ss_oas[i].src.match(/Currencies\.js(\#.*)?$/)) {s_oas = ss_oas[i]; break;}}
			if (s_oas)
				var arg = s_oas.src.match(/\#.*currency=([\w]+)/i); 
	
			if(arg) return arg[1]; else return null ;
			
    },
    observeSelect: function(sel, whattodonext) {
    	selectHandle = sel ;
    	Event.observe( sel, "change" ,      
	      	function()
		      {
		      	if (selectIsBusy) return ;
		      	else {
			      	selectIsBusy = true;
			      	
			      	var cur = sel.value;
			    		Currencies.convertEverythingFromPage( Currencies.CrtCurrency, cur);
			    		Currencies.setCrtCurrency(cur);    //	        	
			    		if (whattodonext)	eval (whattodonext) ; // si des sommes sont calculées, relancer les calculs dans chaque programme (Upsale, Meetings...) pour éviter les pbs d'arrondi
			    		selectIsBusy = false ;
			    	}
		      }.bind(this)		    );
        
    },
   /**
     * Ecrivez votre code sur l'initialisation des affichage de la page
     * ici.
     * Cette m?thode est appel?e sur le onload de la page.
     */
    rewrite: function() {
				var b = this.getCurrenciesViewBean();
				if (b) {
					this.setCrtCurrency( b.defaultCurrency); // LH, multirates, upsale
					this.setOriginalCurrency( b.defaultCurrency); // LH, multirates, upsale
					if (this.getScriptArg()) {
						this.setCrtCurrency( b.basketCurrency) ; //customer Details, confirmation 
						this.setOriginalCurrency( b.basketCurrency); 
						
					// si appel <script type="text/javascript" src="/scripts-v60b/view/json/modules/Currencies.js#currency=BasketCurrency"></script>
					}
					this.writeSelectCurrencies("s_devise", this.OriginalCurrency);
		   }
    },
    		
		setCrtCurrency: function(crt) {
			this.CrtCurrency = crt ;
		},
		setOriginalCurrency: function(crt) {
			this.OriginalCurrency = crt ;
		},
		doSelectCurrency: function(idSelect, currency, doc){
			if (!doc) doc =top.document;
			var select= doc.getElementById(idSelect);
			if (select) {
				for(i=0 ; i <  select.options.length ; i++) {
					if (select.options[i].value == currency) {
						select.options[i].selected = true;
						break;
					}
				}
			}
			else {
				var sousDocs = doc.getElementsByTagName("iframe");
				for(var i=0, l = sousDocs.length; i<l; i++){
					this.doSelectCurrency(idSelect, currency,sousDocs[i].contentWindow.document	);
					
				}
			}
			
		},
	    /*
			* G?re la cr?ation du menu d?roulant contenant les devises
			* @idSelect		    : ID du Select
			* @currenciesTab    : Tableau de l'ensemble des devises
			* @defaultCurrency  : Valeur ? s?lectionner par d?faut
			*****************************************************************************************************/
		writeSelectCurrencies: function(idSelect, Selectedcurrency){

			var select= getElement(idSelect);
			if (select && select.nodeName== "SELECT") {
				select.options.length 	= 0; // mise à zero 
				var count = 0;
				var def = Selectedcurrency ;
				
				for(var currency in Currencies.getCurrenciesViewBean().currencies){
		      select.options[count] = new Option(currency, currency);
		      
		      if(def == currency)
		        select.options[count].selected = true;
		      count++;
		    }
		  }
		},
		registerEverythingFromPage:function(currency, doc){
			//console.log('register');
			if (currency == null) return 0;
			if (!doc) { doc =top.document; tarifListDevise = currency ; }
			initPrices(doc, class_technique, 'span');
			var sousDocs = doc.getElementsByTagName("iframe");
				for( i = sousDocs.length; i>0; i--){
					this.registerEverythingFromPage(currency, sousDocs[i-1].contentWindow.document	);
				}
		},
		purgeTarifs:function() {
			tarifListByPriceClass.length = 0;
			tarifListDevise = null ;  
		},
    convertEverythingFromPage: function(oldCurrency, newCurrency, doc){
    	if (!doc) { niveau = 0 ; doc =top.document;} else niveau = 1;
    	var pleaseAddtarifListDevise = null ;
   		if (oldCurrency != newCurrency) {
    		// sommes
  			var tabSpan = getElementsByClassName(doc, 'span', class_technique);
 				for(var i = 0; i < tabSpan.length; i++){
					if(tabSpan[i].innerHTML){
						if (newCurrency != tarifListDevise || tarifListDevise == null) { // s'il n'existe pas de memoire qu'elle n'est pas utilisable (conversion vers une autre devise)
  						if (tarifListDevise != null && tabSpan[i].className.indexOf('doNotRegister') == -1
  																				&& tarifListByPriceClass[doc.body.id + "|" + class_technique] 
 																					&& tarifListByPriceClass[doc.body.id + "|" + class_technique][i]) { // si une memoire existe, est utilisable et qu'on a le droit de l'utiliser (doNotRegister = somme calculée)
  							tabSpan[i].innerHTML	= this.convert( tarifListByPriceClass[doc.body.id + "|" + class_technique][i], tarifListDevise, newCurrency); // convertir a partir de la memoire (evite les arrondis successifs
  						}
  						else {
  							if (tarifListDevise == null && tabSpan[i].className.indexOf('doNotRegister') == -1) { // si c'est juste qu'on n'a pas de memoire (cas de convertEverything appelé avant rewrite), en profiter pour la creer
  								pleaseAddtarifListDevise = oldCurrency ;
  								if (tarifListByPriceClass == null) 		tarifListByPriceClass = new Array();
  								if (tarifListByPriceClass[doc.body.id + "|" + class_technique] == null) 	tarifListByPriceClass[doc.body.id + "|" + class_technique] = new Array();
  								
  								tarifListByPriceClass[doc.body.id + "|" + class_technique].push( Number(tabSpan[i].innerHTML) ); // enregistrer la valeur affichée en HTML
  							}
  							// convertir celle-ci
  							tabSpan[i].innerHTML = this.convert( Number(tabSpan[i].innerHTML), oldCurrency, newCurrency); 
  							
  						}
  					} else { // back to original currency
 							if (tabSpan[i].className.indexOf('doNotRegister') == -1 && tarifListByPriceClass[doc.body.id + "|" + class_technique] 
 																														&& tarifListByPriceClass[doc.body.id + "|" + class_technique][i]) {
								tabSpan[i].innerHTML = deuxDec(tarifListByPriceClass[doc.body.id + "|" + class_technique][i]) ; // utiliser la memoire si on a le droit
							} else {
								converted = this.convert( Number(tabSpan[i].innerHTML), oldCurrency, newCurrency); // sinon conversion (risque d'erreur d'arrondi, d'ou le recalcul apres)
  							tabSpan[i].innerHTML	= converted ;
  						}
						}
					}
				}
				if (pleaseAddtarifListDevise != null) {tarifListDevise = pleaseAddtarifListDevise ;pleaseAddtarifListDevise = null}
				// devise
				var tabSpand = getElementsByClassName(doc, 'span', 'mdevise');
				for(var i = 0; i < tabSpand.length; i++){
					if(tabSpand[i].innerHTML){
							tabSpand[i].innerHTML	= newCurrency ;
					}
				}
				
				if (!niveau) { // pas plus d'un niveau d'imbrication
					var sousDocs = doc.getElementsByTagName("iframe");
					for( i= sousDocs.length; i>0; i--){ // on passe à l'envers pour s'éviter des soucis avec les "details du prix"
						//var sousDocs = doc.getElementsByTagName("iframe"); // remettons les choses d'equerre malgré la recursivité...
						theIframe = sousDocs[i-1]; 
						this.convertEverythingFromPage(oldCurrency, newCurrency, theIframe.contentWindow.document	);
					}
				}
    	}
    	
    },
    convert: function( sum, deviseFrom, deviseTo) {
    	
			var curAr = Currencies.getCurrenciesViewBean().currencies ;
			var ratioConv = curAr[deviseTo] / curAr[deviseFrom];
			var prixConv = ""+ truncate(sum/ (ratioConv)) ;
			return deuxDec(prixConv);

 	 }
}

core.push(Currencies);

/**
 * Mettez ci-dessous les m?thodes utilis?es par la page, utilisant le JSON.
 * Toute m?thode n'ayant pas de rapport avec le JSON ne sera pas accept?e.
 */

document.write('<script type="text/javascript" src="/scripts-v60b/getElementsByClassName.js"></script>');
document.write('<script type="text/javascript" src="/scripts-v60b/fct_diverses.js"></script>');
var selectIsBusy = false ;
var devises				= new Array();
var tarifListByPriceClass	= new Array();
var tarifListDevise = null;
//var tarif_ref			= null;
var indexEUR			= 28;

function deuxDec(prixConv)
{
	prixConv = String(prixConv) ;
	if (prixConv.indexOf(".",0)==-1) prixConv = prixConv +".00";
	else 
	{
		var nb_decimale = prixConv.length-prixConv.indexOf(".",0)-1;
		if (nb_decimale==1) prixConv = prixConv +"0";
	}
	return prixConv;
}

function initPrices(oElm, oClassPrix, strTagNameP){
    //console.log(oElm.body.id+" "+oClassPrix);
      var tabPrix	= getElementsByClassName(oElm, strTagNameP, oClassPrix);
      var tarif_ref2 = new Array();
      for(var i = 0; i < tabPrix.length; i++){
          if(isNaN(tabPrix[i].innerHTML)) {							mPrix = 0;						}
					else {							mPrix = tabPrix[i].innerHTML;						}
					tarif_ref2[i] = truncate(mPrix);
    	}
    	tarifListByPriceClass[oElm.body.id + "|" + oClassPrix] = tarif_ref2;
  
}



function truncate(nombre) {
	nombre_tronque = ""+nombre;	
	if (nombre_tronque.indexOf(".",0) !=-1) {
		return(Number(nombre_tronque.substring(0,Number(nombre_tronque.indexOf(".",0)+3))));
	} else {
		return(Number(nombre));	
	}
}
