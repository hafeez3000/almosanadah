/**
 * Objet javascript permettant de gérer la récupérartion et
 * l'affichage du BAR (best average rate) pour la resa express (etap hotel)
 * 
 */
var Bar= {

     barViewBean: null,							// infos de bar
     actionErrorViewBean : null,		// message d'erreur     
     antiBounce	: false,						// bloque recherche de bar qd déjà lancée
    
    /**
     * Liste des noms d'objets à utiliser.
     */
    getBeans: function() {
        return "BarViewBean;ActionErrorViewBean;CurrenciesViewBean";
    },


    getBarViewBean: function()
    {
        return barViewBean;
    }, 
    
    getActionErrorViewBean: function()
    {
        return actionErrorViewBean;
    },  

    
    /**
     * Initialisation de la variable JSON
     */
    initJSON: function() {
        var num;
    	try {
           	for( num in beans){
           	  
                if("BarViewBean" == beans[num].nom) {
                    barViewBean = beans[num].bean;                    
                }                
                else if("ActionErrorViewBean" == beans[num].nom) {
                    actionErrorViewBean = beans[num].bean;
                }             	          	            	
            }
        } catch(e) {
    	    alert(e);
    	}
    },
        
    /**
     * Cette méthode est appelée sur le onload de la page.
     */
    rewrite: function() {
      this.rewriteDefault('all'); // on masque le résultat du bar      				    			
    },
    
     /**
     *  appel du service de récupération du BAR
     *	si le blocage n'est pas actif
     */
    doBarAction: function(){	    		        
  			if(this.antiBounce == false){	
	  			this.antiBounce = true;	 // blocage activé	  			
	        var url = buildParamsUrl_usingNames();
	        updateView("bar", "", url+"&beans="+this.getBeans());// appel Ajax	        
		      this.initJSON(); // récupération des beans bar et/ou erreur 
		    	if(this.getActionErrorViewBean())
		    	    this.rewriteActionErrorMessage();
		    	else{
		    	    this.rewriteBarViewBean();
           }   		
	    }	    
    },

    // etat par défaut
		rewriteDefault: function (elem){	    
		    var formExpress = document.forms["ETP_BOOKING_EXPRESS"];
             $("bulle_meilleur_prix").style.display = "none";
		    // si on a modifié un nb de nuit par un autre on ne change pas le bar affiché
		    if(elem != 'nb_nuit' || formExpress.nb_nuit.value==""){
  		    // on masque la zone d'affichage du bar
          if($("affich_bar"))       
            $("affich_bar").innerHTML = '';
          // on masque la zone d'affichage de la devise du bar  
          if($("s_devise"))       
            $("s_devise").style.display = "none"  ; 
        }  
        // si une des valeurs necessaires au calcul du bar est vide on désactive le bouton de recherche de bar  
        if(formExpress.hotel_ou_ville.value == "" || formExpress.jour_arrivee.value   == "" ||
           formExpress.mois_arrivee.value   == "" || formExpress.annee_arrivee.value  == "" || 
           formExpress.nb_nuit.value        == ""    ){
          $("bar_but").disabled=true;
        }
        // sinon on active le bouton de recherche de bar
        else{
          $("bar_but").disabled=false;
        }
    },

    /**
     * affichage du bar trouvé
     */         
		rewriteBarViewBean: function (){
   	    if(barViewBean.price != null){
   	      if($("affich_bar")){
		        $("affich_bar").innerHTML = '<span class="techPrice mtarif">'+barViewBean.price.priceWithTaxes+'</span> <span class="mdevise" style="display: none;">'+barViewBean.price.currencyCode+'</span>';
		        $("bulle_meilleur_prix").style.display = "block";
		        var c = barViewBean.price.currencyCode; // je recupere la devise dans laquelle les prix sont renvoyés
		     		Currencies.doSelectCurrency("s_devise", c); // je fais le select
		         if ($('s_devise')) {
		         	   $("s_devise").style.display = "block"  ;
					    	Currencies.setOriginalCurrency(c);	// j'enregistre la devise de départ des conversions
						    Currencies.setCrtCurrency(c); // j'enregistre la devise courante
						    Currencies.observeSelect( $('s_devise')); // je me mets à l'affut 
							}
    	   
          }  		       						
        }        
    },


    /**
     * affichage du du message d'erreur (bar inconnu)
     */
    rewriteActionErrorMessage: function (){
    		$("affich_bar").innerHTML = actionErrorViewBean.errorMessage;
    		$("s_devise").style.display = "none"  ; 
            $("bulle_meilleur_prix").style.display = "none";
    }
}
core.push(Bar);
Event.observe(window, 'load', function () {
    var formExpress = document.forms["ETP_BOOKING_EXPRESS"];
    // ecouteur sur le click du bouton lançant la recherche de bar
    Event.observe(formExpress.bar_but, 'click', function(event){Bar.doBarAction();});
     
    // listeners, permettent une nouvelle recherche de bar et effacent le bar precedent
    if(formExpress){
    	Event.observe(formExpress.hotel_ou_ville,'change',	function(e) {  Bar.antiBounce = false;	Bar.rewriteDefault('hotel_ou_ville'); }.bind(Bar)	);
    	Event.observe(formExpress.jour_arrivee  ,'change',	function(e) {  Bar.antiBounce = false;	Bar.rewriteDefault('jour_arrivee'); }.bind(Bar)	);
    	Event.observe(formExpress.mois_arrivee  ,'change',	function(e) {  Bar.antiBounce = false;	Bar.rewriteDefault('mois_arrivee'); }.bind(Bar)	);
    	Event.observe(formExpress.annee_arrivee ,'change',	function(e) {  Bar.antiBounce = false;	Bar.rewriteDefault('annee_arrivee'); }.bind(Bar)	);
    	Event.observe(formExpress.nb_nuit       ,'change',	function(e) {  Bar.antiBounce = false;	Bar.rewriteDefault('nb_nuit'); }.bind(Bar)	);     
    }
});
   
  // construction de l'url contenant les param de rech de bar pour l'appel Ajax 
  function buildParamsUrl_usingNames(){
	  
    var formExpress = document.forms["ETP_BOOKING_EXPRESS"];
    var hotel = formExpress.hotel_ou_ville.value;
		var jour  = formExpress.jour_arrivee.value;
		var mois  = formExpress.mois_arrivee.value;
		var annee = formExpress.annee_arrivee.value;
		var nuit  = formExpress.nb_nuit.value;
	
	
		if(hotel == '0')
			hotel = '';  
		if(jour == '-')
			jour = '';
	 	if(mois == '-')
			mois = '';
		if(annee == '-')
			annee = '';
		if(nuit == '-')
			nuit = '';
				
		return '&code_hotel='+hotel+"&jour_arrivee="+jour+"&mois_arrivee="+mois+"&annee_arrivee="+annee+"&nb_nuit="+nuit;


   }
