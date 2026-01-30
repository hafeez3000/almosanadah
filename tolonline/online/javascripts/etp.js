/**
 * Objet javascript permettant de gérer les données d'affichage des moteur de la home ETP
 *   
 */
var Etp= {
		bookingEngineViewBean: null,
   
    /**
     * Liste des noms d'objets à utiliser.
     */
		getBeans: function() {        
        return "BookingEngineViewBean";
    },

    getBookingEngineViewBean: function()
    {
        return bookingEngineViewBean;
    }, 

    
    /**
     * Initialisation de la variable JSON
     */
    initJSON: function() {
        var num;
    	try {
        	for( num in beans){
            if("BookingEngineViewBean" == beans[num].nom) {
                    bookingEngineViewBean = beans[num].bean;            	
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

        if(document.forms["ETP_BOOKING_CLASSIC"]&& bookingEngineViewBean ){
          var formClassic = document.forms["ETP_BOOKING_CLASSIC"];
          // destination
          if(bookingEngineViewBean.destination){          
    			 formClassic.hotel_ou_ville.value=bookingEngineViewBean.destination;
    			}
          //date arrivee 
    		  if(bookingEngineViewBean.dayIn && bookingEngineViewBean.monthIn && bookingEngineViewBean.yearIn){
  	    		formClassic.jour_arrivee.value=bookingEngineViewBean.dayIn;
  	    		formClassic.mois_arrivee.value=bookingEngineViewBean.monthIn;
  	    		formClassic.annee_arrivee.value=bookingEngineViewBean.yearIn;  	    		
  	    		formClassic.nb_nuit.value = bookingEngineViewBean.nightsNumber;
  	    		this.rewriteDate(formClassic);
  	      }
          // code préférentiel 	    		    			    		
  	    	if(bookingEngineViewBean.preferentialCode && formClassic.code_avantage){
  		    	formClassic.code_avantage.value=bookingEngineViewBean.preferentialCode;
  	    	}
        }                            			       		     			     		     			
    },
    
	  rewriteDate: function(formular) {
			var arrival_date = new Date();
			arrival_date.setFullYear(formular.annee_arrivee.value);
			arrival_date.setMonth   (formular.mois_arrivee.value-1);
			arrival_date.setDate    (formular.jour_arrivee.value);	
			var arrival_date2 =arrival_date.print(Calendar._TT["DEF_DATE_FORMAT"]);
			if(formular.arrivee){
				formular.arrivee.value = arrival_date2;
				fireEvent(formular.arrivee, 'change');
			}	
	  },    

    // actions sur le submit de la resa classique
	  onSubmitFormClassic: function(){     
      var formClassic = document.forms["ETP_BOOKING_CLASSIC"];
      
      Cleaner.cleanDefaultValue(formClassic.hotel_ou_ville);
      Cleaner.cleanDefaultValue(formClassic.code_avantage);
      
      formClassic.submit();      
    },  
	  
	  // actions sur le submit de la resa express
    onSubmitFormExpress: function(){     
      var formExpress = document.forms["ETP_BOOKING_EXPRESS"];
      
      Cleaner.cleanDefaultValue(formExpress.nom_ville);
      Cleaner.cleanDefaultValue(formExpress.code_avantage);
      
      formExpress.submit();      
    },
    
	  // actions sur le submit de la recharche par destination
    onSubmitFormDestination: function(){     
      var formDestination = document.forms["ETP_BOOKING_DESTINATION"];
      
      Cleaner.cleanDefaultValue(formDestination.hotel_ou_ville);
      Cleaner.cleanDefaultValue(formDestination.code_avantage);
      
      formDestination.submit();      
    }
      
 
}
core.push(Etp);

Event.observe(window, 'load', function () {
      var formClassic = document.forms["ETP_BOOKING_CLASSIC"];               
      // vidage remplissage des zones de saisie   
      Event.observe(formClassic.hotel_ou_ville, 'focus', function(event){Cleaner.cleanDefaultValue(formClassic.hotel_ou_ville);});
      Event.observe(formClassic.hotel_ou_ville, 'blur' , function(event){Cleaner.setDefaultValue(formClassic.hotel_ou_ville);}); 
      Event.observe(formClassic.code_avantage, 'focus', function(event){Cleaner.cleanDefaultValue(formClassic.code_avantage);});
      Event.observe(formClassic.code_avantage, 'blur' , function(event){Cleaner.setDefaultValue(formClassic.code_avantage);});
      // action sur le submit            			
      Event.observe($("bt_classic"),'click',	function(event) {Event.stop(event);Etp.onSubmitFormClassic();}.bind(Etp));
      
      if(document.forms["ETP_BOOKING_EXPRESS"]){
        var formExpress = document.forms["ETP_BOOKING_EXPRESS"];
        // vidage remplissage des zones de saisie           
        Event.observe(formExpress.nom_ville, 'focus', function(event){Cleaner.cleanDefaultValue(formExpress.nom_ville);});
        Event.observe(formExpress.nom_ville, 'blur' , function(event){Cleaner.setDefaultValue(formExpress.nom_ville);}); 
        Event.observe(formExpress.code_avantage, 'focus', function(event){Cleaner.cleanDefaultValue(formExpress.code_avantage);});
        Event.observe(formExpress.code_avantage, 'blur' , function(event){Cleaner.setDefaultValue(formExpress.code_avantage);});
        // action sur le submit
        Event.observe($("bt_express"),'click',	function(event) {Event.stop(event);Etp.onSubmitFormExpress();}.bind(Etp));
      }
      
      if(document.forms["ETP_BOOKING_DESTINATION"]){
        var formDest = document.forms["ETP_BOOKING_DESTINATION"];
        // vidage remplissage des zones de saisie           
        Event.observe(formDest.hotel_ou_ville, 'focus', function(event){Cleaner.cleanDefaultValue(formDest.hotel_ou_ville);});
        Event.observe(formDest.hotel_ou_ville, 'blur' , function(event){Cleaner.setDefaultValue(formDest.hotel_ou_ville);});
        Event.observe(formDest.code_avantage, 'focus', function(event){Cleaner.cleanDefaultValue(formDest.code_avantage);});
        Event.observe(formDest.code_avantage, 'blur' , function(event){Cleaner.setDefaultValue(formDest.code_avantage);});
        // Remplissage de la destination par click sur bouton radio           
        Event.observe($('Amsterdam')  , 'click' , function(event){fillDest('Amsterdam');});
        Event.observe($('Berlin')     , 'click' , function(event){fillDest('Berlin');});
        Event.observe($('Bordeaux')   , 'click' , function(event){fillDest('Bordeaux');});
        Event.observe($('Bruxelles')  , 'click' , function(event){fillDest('Bruxelles');});
        Event.observe($('Budapest')   , 'click' , function(event){fillDest('Budapest');});
        Event.observe($('Hambourg')   , 'click' , function(event){fillDest('Hambourg');});
        Event.observe($('Lille')      , 'click' , function(event){fillDest('Lille');});
        Event.observe($('Londres')    , 'click' , function(event){fillDest('Londres');});
        Event.observe($('Lyon')       , 'click' , function(event){fillDest('Lyon');});
        Event.observe($('Marseille')  , 'click' , function(event){fillDest('Marseille');});
        Event.observe($('Montpellier'), 'click' , function(event){fillDest('Montpellier');});
        Event.observe($('Munich')     , 'click' , function(event){fillDest('Munich');});
        Event.observe($('Nice')       , 'click' , function(event){fillDest('Nice');});
        Event.observe($('Paris')      , 'click' , function(event){fillDest('Paris');});
        Event.observe($('Toulouse')   , 'click' , function(event){fillDest('Toulouse');});
        Event.observe($('Vienne')     , 'click' , function(event){fillDest('Vienne');});
        // action sur le submit
        Event.observe($("bt_destination"),'click',	function(event) {Event.stop(event);Etp.onSubmitFormDestination();}.bind(Etp));

      } else{
        // autocompletion pour le moteur classique sur la home uniquement
        addAutoCompletionDestination('form_classic', 'hotel_ou_ville1', 'bt_classic');
      }    

});


// remplissage des zones de saisie après retour validator   
function setDefaultValuesAfterValidatorReturn(nomForm){
  var form = document.forms[nomForm];
  if(nomForm == 'ETP_BOOKING_CLASSIC'){
    Cleaner.setDefaultValue(form.hotel_ou_ville);
    Cleaner.setDefaultValue(form.code_avantage);  
  }else if(nomForm == 'ETP_BOOKING_EXPRESS'){
    Cleaner.setDefaultValue(form.nom_ville);
    Cleaner.setDefaultValue(form.code_avantage);
  }else if(nomForm == 'ETP_BOOKING_DESTINATION'){
    Cleaner.setDefaultValue(form.nom_ville);
    Cleaner.setDefaultValue(form.code_avantage);
  }  
}

// remplissage de la destination 
function fillDest(nomDest){  
  document.forms['ETP_BOOKING_DESTINATION'].hotel_ou_ville.value=nomDest;
}

