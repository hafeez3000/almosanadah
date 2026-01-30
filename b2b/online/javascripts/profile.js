
var Profile = {
  
  initialized: false,
  
  elm_ident: null,
  elm_not_ident: null,
  elm_name: null,
  
  init: function() {
    if (!this.initialized) {
      this.elm_ident = document.getElementById("bloc_ident");
      this.elm_notIdent = document.getElementById("bloc_not_ident");
      this.elm_template = $("profile-template");
      this.initialized = !!this.elm_ident && !!this.elm_notIdent && !!this.elm_template;
    }
  },
  
  getBeans: function() {
    return "ProfileViewBean";
  },
  
  initJSON: function() {
  },
  
  rewrite: function() {
    
    this.init();
    var bean = viewBeans["ProfileViewBean"];

    if(bean && this.initialized){
    
      // creation et replissage du template
      var data = {name: (bean.firstName.toLowerCase().capitalize())};
      var template = new Template(unescape(this.elm_template.innerHTML));
      Element.update(this.elm_template, template.evaluate(data));

      this.elm_ident.style.display = "block";
      this.elm_notIdent.style.display = "none";
    }
  }

}

core.push(Profile);



