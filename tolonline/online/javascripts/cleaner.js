var Cleaner= {

  // fonction qui vide la value d'un élément de formulaire s'il s'agit de sa valeur par défaut
   cleanDefaultValue: function(formElement) {
  	if(formElement){
			var defaultValue = formElement.defaultValue.toLowerCase();
			var givenValue = formElement.value.toLowerCase();
			if(givenValue == defaultValue){
				formElement.value = "";
			}
		}  
  },
  
  // fonction affecte sa valeur par défaut à un élément de formulaire dont la valeur est vide
  setDefaultValue: function(formElement) {
    if(formElement  &&  formElement.value == ""){
      formElement.value = formElement.defaultValue;
    }      
  }
  
}