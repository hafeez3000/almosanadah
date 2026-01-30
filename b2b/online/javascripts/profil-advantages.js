var profilAvantages = {
	
	originViewBean : null,
	codeLangDirectory : null,
	
	/**
	 * Liste des noms d'objets à utiliser.
	 */
	getBeans: function() {
	    return "OriginViewBean";
	},
	
	/**
	 * Initialisation de la variable JSON
	 */
	initJSON: function() {  
	  this.originViewBean = viewBeans["OriginViewBean"];
	},
	    
	/**
	 * Ecrivez votre code sur l'initialisation des affichage de la page
	 * ici.
	 * Cette méthode est appelée sur le onload de la page.
	 */
	rewrite: function() {
		this.init();
	},
	
  init: function() {
  		profil.init();
      this.setContext();
      this.setCloseLink();
      
      if(this.originViewBean && this.originViewBean.siteCode && this.originViewBean.siteCode !=''){			
				profil.siteCode = this.originViewBean.siteCode;
			}
			else{
				profil.siteCode = "ALL";
			}
			
			if(this.originViewBean && this.originViewBean.codeLangDirectory && this.originViewBean.codeLangDirectory !=''){			
				this.codeLangDirectory = this.originViewBean.codeLangDirectory;
			}
			else{
				this.codeLangDirectory = "gb";
			}
				
			switch(profil.siteCode){
				case "ALL": this.setHomeLink('accorhotels', this.codeLangDirectory);	break;
				case "PUL": this.setHomeLink('pullmanhotels', this.codeLangDirectory);	break;
				case "SOF": this.setHomeLink('sofitel', this.codeLangDirectory);	break;
				case "NOV": this.setHomeLink('novotel', this.codeLangDirectory);	break;
				case "MER": this.setHomeLink('mercure', this.codeLangDirectory);	break;
				case "IBI": this.setHomeLink('ibishotel', this.codeLangDirectory);	break;
				case "ASE": this.setHomeLink('all-seasons-hotels', this.codeLangDirectory);	break;
				case "THA": this.setHomeLink('accorthalassa', this.codeLangDirectory);	break;
				case "ETP": this.setHomeLink('etaphotel', this.codeLangDirectory);	break;
				case "FOR": this.setHomeLink('hotelformule1', this.codeLangDirectory);	break;
				case "SUI": this.setHomeLink('suitehotel', this.codeLangDirectory);	break;
				default: this.setHomeLink('accorhotels', this.codeLangDirectory);	break;
			}
			
			this.setSubmitLink();
			this.setOffersLink();
			this.setContactLink();

  },
  
  setContext : function(){
  	if($('contextB2C') && $('contextB2B')){
  		if(profil.context == "B2C") $('contextB2C').style.display="block";
  		if(profil.context == "B2B") $('contextB2B').style.display="block";
  	}
  	
  	if(profil.context == "B2B" && $('advantages')){
  		$('advantages').addClassName('pro');
  	}
  	
  	$('advantages').style.display = "block";
  },
  
  setSubmitLink : function(){
  	if($('submitForm')){
  		Event.observe(
  			$('submitForm'),
  			'click',
  			function(evt){
  				Event.stop(evt);
  				var parentPageUrl = top.document.location.href;
  				var pageName = parentPageUrl.split('/');
  				pageName = pageName[pageName.length-1];
  				if(pageName.indexOf('advantages.shtml') != -1){
  					window.opener.parent.location.href=$('submitForm').href;
						window.close();
  				}
  				else{
  					top.document.location.href = $('submitForm').href;
  				}

  			}
  		);
  	}
  },
  
  setCloseLink : function(){
  	if($('closePopin')){
  		Event.observe(
  			$('closePopin'),
  			'click',
  			function(evt){
  				Event.stop(evt);
  				var parentPageUrl = top.document.location.href;
  				var pageName = parentPageUrl.split('/');
  				pageName = pageName[pageName.length-1];
  				if(pageName.indexOf('advantages.shtml') != -1){
						window.close();
  				}
  				else{
  					var body = top.document.getElementsByTagName('body')[0];
  					var popin = body.select('div.dialog')[0];
  					if(popin){
  						var btClose = popin.select('.accor_close')[0];
  						if(btClose) fireEvent(btClose, 'click');
  					}
  				}

  			}
  		);
  	}
  },
  
  setHomeLink : function(site, lang){
  	if($('submitForm')){
  		$('submitForm').href="https://secure."+site+".com/"+lang+"/profil/home.shtml?context="+profil.context; // le "?" au lieu du "#" est volontaire.
  	}
  },
  
  setOffersLink : function(){
  	if($('ourOffers')){
  		Event.observe(
  			$('ourOffers'),
  			'click',
  			function(evt){
  				Event.stop(evt);
  				var parentPageUrl = top.document.location.href;
  				var pageName = parentPageUrl.split('/');
  				pageName = pageName[pageName.length-1];
  				if(pageName.indexOf('advantages.shtml') != -1){
  					window.opener.parent.location.href=$('ourOffers').href;
						window.close();
  				}
  				else{
  					top.document.location.href = $('ourOffers').href;
  				}

  			}
  		);
  	}
  },
  
  setContactLink : function(){
  	if($('contactLink')){
  		Event.observe(
  			$('contactLink'),
  			'click',
  			function(evt){
  				Event.stop(evt);
  				var parentPageUrl = top.document.location.href;
  				var pageName = parentPageUrl.split('/');
  				pageName = pageName[pageName.length-1];
  				if(pageName.indexOf('advantages.shtml') != -1){
  					window.opener.parent.location.href=$('contactLink').href;
						window.close();
  				}
  				else{
  					top.document.location.href = $('contactLink').href;
  				}

  			}
  		);
  	}
  }
}

core.push(profilAvantages);
//Event.observe(window, 'load', function(){profilAvantages.init();});