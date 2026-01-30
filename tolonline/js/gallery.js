"use strict";
/* jshint globalstrict: true */
/* global jQuery:false */

jQuery(document).ready(function($) {

	var $container = $('#container_isotope');

	$container.isotope({
		masonry : {
			columnWidth : 154
		},
		sortBy : 'number',
		getSortData : {
			number : function($elem) {
				var number = $elem.hasClass('element') ? $elem.find('.number').text() : $elem.attr('data-number');
				return parseInt(number, 10);
			},
			alphabetical : function($elem) {
				var name = $elem.find('.name'), itemText = name.length ? name : $elem;
				return itemText.text();
			}
		}
	});

	var $optionSets = $('#options .option-set'), $optionLinks = $optionSets.find('a');

	$optionLinks.click(function() {
		var $this = $(this);
		// don't proceed if already selected
		if ($this.hasClass('selected')) {
			return false;
		}
		var $optionSet = $this.parents('.option-set');
		$optionSet.find('.selected').removeClass('selected');
		$this.addClass('selected');

		// make option object dynamically, i.e. { filter: '.my-filter-class' }
		var options = {}, key = $optionSet.attr('data-option-key'), value = $this.attr('data-option-value');
		// parse 'false' as false boolean
		value = value === 'false' ? false : value;
		options[key] = value;
		
		$container.isotope(options);

		return false;
	});

});
