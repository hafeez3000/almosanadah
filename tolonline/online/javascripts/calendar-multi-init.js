(function() {

var W = this;

W.MultiCalendars = function(datas) {
	this.initialize(datas);
};

W.MultiCalendars.prototype = {
	initialize: function(datas) {
		this.arrivalID = datas.arrivalID;
		this.buttonID = datas.buttonID;
		this.arrivalDayID = datas.arrivalDayID;
		this.arrivalMonthID = datas.arrivalMonthID;
		this.arrivalYearID = datas.arrivalYearID;
		this.nightsID = datas.nightsID;
		this.nightsNb = parseInt($(datas.nightsID).value, 10);
		this.departureID = datas.departureID;
		this.arrivalDate = null;
		this.maxStay = datas.maxStay || 6;
		this.maxPeriod = datas.maxPeriod || 250;
		this.jPlusX = datas.jPlusX || 0;
		this.nightsNb = datas.nightsNb || 0 ;
		
		Event.observe($(datas.arrivalID), 'focus', function() {this.blur();});
		
		var arrival = $(datas.arrivalID);
		if (arrival.value) {
			var d = Date.parseDate(arrival.value, Calendar._TT.DEF_DATE_FORMAT);
			this.setHiddenFields(d);
			this.arrivalDate = d;
		}
		
		W.Calendar.setup({
			inputField: datas.arrivalID,
			button: datas.buttonID,
			button_eventNames: ['click'],
			inputField_eventNames: ['click','focus'],
			ifFormat: W.Calendar._TT["DEF_DATE_FORMAT"],
			singleClick: true,
			onSelect: this.selectDate.bind(this),
			dateStatusFunc: this.disableDates.bind(this)
		});
		
		if ($(datas.nightsID)) {
			this.setupMaxStayDropDown();
		}
	},
	
	setDisplayField: function(date,d) {
		$(this.arrivalID).value = date;
		var weekDay = $(this.arrivalID).previous(".jour");
		if(weekDay) 
				weekDay.innerHTML =(W.calendar) ? W.Calendar._DN[W.calendar.date.getDay()] : Calendar._DN[d.getDay()] ;
	},
	
	setHiddenFields: function(cDate, date) {
		$(this.arrivalDayID).value = cDate.getDate();
		fireEvent($(this.arrivalDayID), 'change');
		$(this.arrivalMonthID).value = cDate.getMonth() + 1;
		fireEvent($(this.arrivalMonthID), 'change');
		$(this.arrivalYearID).value = cDate.getFullYear();
		fireEvent($(this.arrivalYearID), 'change');
		if (!$(this.nightsID).value) {
			$(this.nightsID).value = 1;
			fireEvent($(this.nightsID), 'change');
		}
	},
	
	setupMaxStayDropDown: function() {
		var select = $(this.nightsID);
		// empty select box if not empty
		if(select.options.length > 1) {
			select.options.length = 1;
		}
		// fill select box with maxStay value
		for(var i = 1; i <= this.maxStay; i++) {
			select.options[select.options.length] = new Option(i, i);
		}
		select.selectedIndex = this.nightsNb;
		Event.observe(select, 'change', function(e) {
			var el = Event.element(e);
			var date = new Date();
			if($(this.arrivalID).value==''){
				$(this.arrivalID).value=date.print(Calendar._TT.DEF_DATE_FORMAT);
				this.setDisplayField(date.print(Calendar._TT.DEF_DATE_FORMAT),date);
				this.setHiddenFields(date);
				this.arrivalDate = date;
			}else{
			if (W.calendar && W.calendar.date) {
				date.setTime(W.calendar.date.getTime());
			} else if (this.arrivalDate) {
				date.setTime(this.arrivalDate.getTime());
			}
			date.setTime(date.getTime() + Date.DAY * parseInt(el.value, 10));
			if (!this.checkDate(date)) {
				el.selectedIndex = this.nightsNb;
				return false;
			}
			this.nightsNb = el.selectedIndex;
		}		  
			this.updateDepartureDate();
		}.bind(this));
		if (this.arrivalDate) {this.updateDepartureDate();}
	},
	
	updateDepartureDate: function() {
		if (this.arrivalDate === undefined) {
			var d = new Date();
			$(this.arrivalID).value = d.print(Calendar._TT.DEF_DATE_FORMAT);
			this.setDisplayField(d.print(Calendar._TT.DEF_DATE_FORMAT));
			this.setHiddenFields(d);
			this.arrivalDate = d;
		}

		var select = $(this.nightsID);
		if (select) {
			var departureDisplay = $(this.departureID);
			var weekDay = departureDisplay.down("span.jour");
			var date = departureDisplay.down("span.date");
			//compute new date
			var nightsStayInDays = Number(select.value);
			var nightsStayInMS = nightsStayInDays * Date.DAY;
			var departureDate = new Date();
			if(!this.arrivalDate)this.arrivalDate=new Date();
			departureDate.setTime(((W.calendar) ? W.calendar.date.getTime() : this.arrivalDate.getTime()) + nightsStayInMS);
			if (weekDay) {
				weekDay.innerHTML = W.Calendar._DN[departureDate.getDay()];
			}
			date.innerHTML= departureDate.print(Calendar._TT.DEF_DATE_FORMAT);
			//var dayLeadingZero = (departureDate.getDate() < 10) ? '0' : '';
			//var monthLeadingZero = ((Number(departureDate.getMonth()) + 1) < 10) ? '0' : '';
			//date.innerHTML = dayLeadingZero + departureDate.getDate() + '/' + monthLeadingZero + (Number(departureDate.getMonth()) + 1) + '/' + departureDate.getFullYear();
		}
	},
	
	checkDate: function(date) {
		var b = true;
		var msg = null;
		var now = new Date();
		if (date.getTime() < now.getTime()) {
			b = false;
			msg = "outOfMinDate";
			var min = new Date();
			min.setTime(now.getTime());
			window.calendar.setDate(min);
		}
		var max = now.getTime() + (Date.DAY * this.maxPeriod);
		if (date.getTime() >= max) {
			b = false;
			msg = "outOfMaxDate";
			var safe = new Date();
			safe.setTime(max - ((this.nightsNb + 1) * Date.DAY));
			window.calendar.setDate(safe);
		}
		return b;
	},
	
	disableDates: function(dDate, y, m, d) {
		var now = new Date();
		if(dDate.getTime() < now.getTime() + (this.jPlusX - 1)*Date.DAY) {
			return true;
		}
		var max = now.getTime() + (Date.DAY * this.maxPeriod) - (Date.DAY * (this.nightsNb + 1));
		if(dDate.getTime() > max) {
			return true;
		}
		return false;
	},
	
	selectDate: function(cal, date) {
		var departure = new Date();
		departure.setTime(cal.date.getTime() + (this.nightsNb + 1) * Date.DAY);
		if(!this.checkDate(departure)) {
			return false;
		}
		if(cal.dateClicked) {
			this.arrivalDate = cal.date;
			this.setDisplayField(date);
			this.setHiddenFields(cal.date);
			this.updateDepartureDate();
			cal.hide();
		}
		return true;
	}
};

})();

//Declanche un evenement
function fireEvent(element,event){
if (document.createEventObject){
// dispatch for IE
var evt = document.createEventObject();
element.fireEvent('on'+event,evt);
}
else{
// dispatch for firefox + others
var evt = document.createEvent("HTMLEvents");
evt.initEvent(event, true, true ); // event type,bubbling,cancelable
!element.dispatchEvent(evt);
}
}