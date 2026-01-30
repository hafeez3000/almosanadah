/**
 * Objet javascript permettant de gérer la recherche Géographique pour la réservation Express ETP
 */
var RechGeo= {
		resaExpressGeoSearchViewBean: null,	 // liste des hôtels
    actionErrorViewBean : null,		       // message d'erreur   		
    antiBounceGeo	: false,						   // bloque recherche de bar qd déjà lancée
    libelleChoixHotel: "",
    
    /**
     * Liste des noms d'objets à utiliser.
     */
		getBeans: function() {        
        return "ResaExpressGeoSearchViewBean;ActionErrorViewBean";
    },
    
    getResaExpressGeoSearchViewBean: function()
    {
        return resaExpressGeoSearchViewBean;
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
              if("ResaExpressGeoSearchViewBean" == beans[num].nom) {
                   resaExpressGeoSearchViewBean = beans[num].bean;
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
      // récupération du libelle de la valeur nulle pour le combo des hotels 
      this.libelleChoixHotel = document.forms['ETP_BOOKING_EXPRESS'].hotel_ou_ville.options[0].text;      
      
      
			
    }, 
	  
	  // Appel Ajax de recherche Geo
	  doGeoSearchAction: function(){	     
      if(this.antiBounceGeo == false){	
  	  			this.antiBounceGeo = true;
  	  	$("errorRechGeo").style.display='none'; // message d'erreur geo masqué		
        var url = buildParamsUrlGeo_usingNames();	       
         
  	    updateView("doGeoSearchAction", "", url+"&beans="+this.getBeans()); // appel Ajax
  		  this.initJSON();  // récupération des beans rech_geo et/ou erreur   		  
  		  if(actionErrorViewBean != null){  		    	   
  		         // si le bean d'erreur est présent on traite l'erreur
  		    	   this.rewriteActionErrorMessageGeo();
                   $("hotel_ou_ville2").disabled=true;
  		  }  	   
  		  else{  		     
            // sinon on construit le combo des hôtels avec les info du bean rech_geo    		      
            fillSelect("hotel_ou_ville2", resaExpressGeoSearchViewBean.hotelsData, "", this.libelleChoixHotel);
            $("hotel_ou_ville2").disabled=false;

            $("arrivee2").disabled=false;    
            $("nb_nuit2").disabled=false;    
            $("nb_personne").disabled=false;             

        } 
  		  this.antiBounceGeo = false;
  		} 
    },
    
    // en cas d'erreur sur la recherche geo
    rewriteActionErrorMessageGeo: function (){
        // on vide le combo des hôtels
        document.forms['ETP_BOOKING_EXPRESS'].hotel_ou_ville.options.length=0;
        document.forms['ETP_BOOKING_EXPRESS'].hotel_ou_ville.options[0] = new Option(this.libelleChoixHotel,"");
        // on affiche le message correspondant à l'erreur        
        $("errorRechGeo").style.display='block'; 
    		$("errorRechGeo").innerHTML = actionErrorViewBean.errorMessage;
    }
      
 
}
core.push(RechGeo);

Event.observe(window, 'load', function () {
  // ecouteur sur le click du bouton lançant la recherche geo                   
  Event.observe("geo_search", 'click', function(event){Cleaner.cleanDefaultValue($("nom_ville"));RechGeo.doGeoSearchAction();Event.stop(event);});
});


  // construction de l'url contenant les param de rech Geo pour l'appel Ajax
 function buildParamsUrlGeo_usingNames(){
    var nom_ville = document.forms['ETP_BOOKING_EXPRESS'].nom_ville.value;
		var code_chaine = document.forms['ETP_BOOKING_EXPRESS'].code_chaine.value;
    				
		return '&nom_ville='+nom_ville+"&code_chaine="+code_chaine;
 }




