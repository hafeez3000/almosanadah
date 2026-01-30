/*
////////////////////////////////
//  Generic linked date boxes //
////////////////////////////////

*****************************************
*   Another fine mess by Torsten Mauz   *
*****************************************

*/

//Declare date arrays
var arrYears = new Array();
var arrMonths = new Array();
var arrDays = new Array();

//the object which represents our date boxes
function dateObj(dObj, mObj, yObj)
{
	this.dayObj = dObj;
	this.dayObj.parent = this;
	this.monthObj = mObj;
	this.monthObj.parent = this;
	this.monthObj.onchange = populateDays;
	this.yearObj = yObj;
	this.yearObj.parent = this;
	this.yearObj.onchange = populateDays;
	this.dayObj.onchange = updateSelDay;
	this.selDay;
}

//main initialisation routine
function initDates(yFrom, yTo, selectedYear, selectedMonth, selectedDay, dateObject)
{
	initYears(yFrom, yTo);
	initMonths();
	initDays();
	dateObject.selDay = selectedDay;
	populateYears(arrYears, selectedYear, dateObject);
	populateMonths(arrMonths, selectedMonth, dateObject);
	populateDays(selectedDay, dateObject);
}

//setup the years array
function initYears(yFrom, yTo)
{	
	var IDX = 0;
	
	for(var i = yFrom; i < (yTo+1); i++, IDX++)
	{
		arrYears[IDX] = i;
	}
}

//setup the months array
function initMonths()
{
	arrMonths[0] = 'January';
	arrMonths[1] = 'Febuary';
	arrMonths[2] = 'March';
	arrMonths[3] = 'April';
	arrMonths[4] = 'May';
	arrMonths[5] = 'June';
	arrMonths[6] = 'July';
	arrMonths[7] = 'August';
	arrMonths[8] = 'September';
	arrMonths[9] = 'October';
	arrMonths[10] = 'November';
	arrMonths[11] = 'December';
}

//setup the days array
function initDays()
{
	arrDays[0] = 31;
	arrDays[1] = 28;
	arrDays[2] = 31;
	arrDays[3] = 30;
	arrDays[4] = 31;
	arrDays[5] = 30;
	arrDays[6] = 31;
	arrDays[7] = 31;
	arrDays[8] = 30;
	arrDays[9] = 31;
	arrDays[10] = 30;
	arrDays[11] = 31;
}

//render the years dropdown
function populateYears(arrIn, selYear, dObj)
{
	dObj.yearObj.options.length = 0;
	
	for(var i = 0; i < arrIn.length; i++)
	{
		dObj.yearObj.options.length += 1;
		dObj.yearObj.options[i].value = arrYears[i];
		dObj.yearObj.options[i].text = arrYears[i];
		if(arrYears[i] == selYear)
		{
			dObj.yearObj.options[i].selected = true;
		}
	}
}

//render the months dropdown
function populateMonths(arrIn, selMonth, dObj)
{
	dObj.monthObj.options.length = 0;
	
	for(var i = 0; i < arrIn.length; i++)
	{
		dObj.monthObj.options.length += 1;
		dObj.monthObj.options[i].value = (i+1);
		dObj.monthObj.options[i].text = arrMonths[i];
//		if(i == selMonth - 1)
		if(i == selMonth)
		{
			dObj.monthObj.options[i].selected = true;
		}
	}
}

//render the days dropdown
function populateDays(selDay, dObj)
{
	//if the calling object is a property of a date object then
	//get the parent date object
	if(dObj == null)
	{
		dObj = this.parent;
	}
	
	var month = dObj.monthObj.selectedIndex;
	var days = arrDays[month];
	
	//if the selected day is nothing then retrieve from object
	if(selDay == null)
	{
		selDay = dObj.selDay;
		
		//if selected day is larger then number of days
		//in new months the set it to the last day of the month
		if(selDay > days)
		{
			selDay = days;
			dObj.selDay = selDay;
		}
	}
	
	//reset the day list
	dObj.dayObj.options.length = 0;
	
	//check to see if we are dealing with febuary
	if(month == 1)
	{
		//if the year divided by 4 does not contain a decimal place then it is a leapyear
		if((dObj.yearObj.options[dObj.yearObj.selectedIndex].value / 4).toString().indexOf('.') == -1)
		{
			days = arrDays[month] + 1;
		}
	}

	//loop through the days for each month
	for(var i = 1; i < days + 1; i++)
	{
		dObj.dayObj.options.length += 1;
		dObj.dayObj.options[i-1].value = i;
		dObj.dayObj.options[i-1].text = i;
		if(i == selDay)
		{
			dObj.dayObj.options[i-1].selected = true;
		}
	}
}

//update the currently selected day
function updateSelDay(dObj)
{
	if(dObj == null)
	{
		dObj = this.parent;
	}
	dObj.selDay = dObj.dayObj.selectedIndex + 1;
}