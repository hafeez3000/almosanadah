Event.observe(window,"load",function() {		
		$$(".bulle_aide img").findAll(function(node){
			return node.getAttribute('alt');
		}).each(function(node){
			   new Tooltip(node,node.alt);
				node.removeAttribute("alt");
	 });

      doChangeTooltipDOM();
});     

function doChangeTooltipDOM(){
    $$(".tooltip").each(function(node){
       var element = node.firstChild;
              
         var title = element.innerHTML;
        var div_bg = $(document.createElement("div")); 
        div_bg.addClassName("bg");
            node.appendChild(div_bg);
        
        var div_bloc = $(document.createElement("div")); 
        div_bloc.addClassName("bloc");
        node.appendChild(div_bloc);
        div_bloc.innerHTML = title;
  
      element.style.display = "none"; /* IE */
    
   });
 
}
