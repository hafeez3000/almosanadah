var tooltipAH = {
	toolTipSetter : function(){

		var tooltips = $('page').select('.tooltipLink');
		if(tooltips){
			tooltips.each(function(element){
				if(element){
					var nomTooltip = element.readAttribute('title');
					var params = element.readAttribute('rel').split(',');
					var toolTip = $(nomTooltip);
					if(toolTip){
						Event.observe(
							element,
							'mouseover',
							function(e){
								toolTip.style.width = params[2]+ "px";
								element.setAttribute('title', '');
								
								if(params[0] == 'top'){
									toolTip.style.top = (Number(Event.pointerY(e)) - Number(toolTip.offsetHeight) - 3) +"px";
								}
								else{
									toolTip.style.top = (Number(Event.pointerY(e)) + 20) +"px";
								}
								
								if(params[1] == 'left'){
									toolTip.style.left = (Number(Event.pointerX(e)) - Number(toolTip.offsetWidth))+"px";
								}
								else{
									toolTip.style.left = (Number(Event.pointerX(e)) + 10)+"px";
								}
								
								//toolTip.style.top = (Number(Event.pointerY(e)) - Number(toolTip.offsetHeight) - 5) +"px";
								//toolTip.style.left = (Number(Event.pointerX(e)) - Number(toolTip.offsetWidth) - 5)+"px";
								
								Event.observe(
									element,
									'mousemove',
									function(e2){
										if(params[0] == 'top'){
											toolTip.style.top = (Number(Event.pointerY(e2)) - Number(toolTip.offsetHeight) - 3) +"px";
										}
										else{
											toolTip.style.top = (Number(Event.pointerY(e2)) + 20) +"px";
										}
										
										if(params[1] == 'left'){
											toolTip.style.left = (Number(Event.pointerX(e2)) - Number(toolTip.offsetWidth))+"px";
										}
										else{
											toolTip.style.left = (Number(Event.pointerX(e2)) + 10)+"px";
										}
										//toolTip.style.top = (Number(Event.pointerY(e2)) - Number(toolTip.offsetHeight) - 5) +"px";
										//toolTip.style.left = (Number(Event.pointerX(e2)) - Number(toolTip.offsetWidth) - 5)+"px";
									}
								);
								
								Event.observe(
									element,
									'mouseout',
									function(){
										toolTip.style.left = (-2000)+"px";
										
									}
								);
							}
						);
					}
				}
			});
		}
	}
}

Event.observe(window, 'load', function(){tooltipAH.toolTipSetter();});
