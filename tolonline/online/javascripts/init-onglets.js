Event.observe(window,"load",function() {
    
	$$("#searchForm li a").each(function(elmt,i){
		elmt.observe("click", function(event){
             Event.stop(event);
			toggleSearch(elmt);
		});
	});
	$("form_express").hide();
	
});


function toggleSearch(obj) {
	$$("#search form").invoke("hide");
	$$("#search li").invoke("removeClassName", "activeItem");
	
	obj.up().addClassName("activeItem");

	$(obj.hash.split("#")[1]).show();
}
