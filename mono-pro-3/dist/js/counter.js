(function ($) {
	$.fn.countTo = function (options) {
		options = options || {};
		
		return $(this).each(function () {
			// set options for current element
			var settings = $.extend({}, $.fn.countTo.defaults, {
				from:            $(this).data('from'),
				to:              $(this).data('to'),
				speed:           $(this).data('speed'),
				refreshInterval: $(this).data('refresh-interval'),
				decimals:        $(this).data('decimals')
			}, options);
			
			// how many times to update the value, and how much to increment the value on each update
			var loops = Math.ceil(settings.speed / settings.refreshInterval),
				increment = (settings.to - settings.from) / loops;
			
			// references & variables that will change with each update
			var self = this,
				$self = $(this),
				loopCount = 0,
				value = settings.from,
				data = $self.data('countTo') || {};
			
			$self.data('countTo', data);
			
			// if an existing interval can be found, clear it first
			if (data.interval) {
				clearInterval(data.interval);
			}
			data.interval = setInterval(updateTimer, settings.refreshInterval);
			
			// initialize the element with the starting value
			render(value);
			
			function updateTimer() {
				value += increment;
				loopCount++;
				
				render(value);
				
				if (typeof(settings.onUpdate) == 'function') {
					settings.onUpdate.call(self, value);
				}
				
				if (loopCount >= loops) {
					// remove the interval
					$self.removeData('countTo');
					clearInterval(data.interval);
					value = settings.to;
					
					if (typeof(settings.onComplete) == 'function') {
						settings.onComplete.call(self, value);
					}
				}
			}
			
			function render(value) {
				var formattedValue = settings.formatter.call(self, value, settings);
				$self.html(formattedValue);
			}
		});
	};
	
	$.fn.countTo.defaults = {
		from: 0,               // the number the element should start at
		to: 0,                 // the number the element should end at
		speed: 1000,           // how long it should take to count between the target numbers
		refreshInterval: 100,  // how often the element should be updated
		decimals: 0,           // the number of decimal places to show
		formatter: formatter,  // handler for formatting the value before rendering
		onUpdate: null,        // callback method for every time the element is updated
		onComplete: null       // callback method for when the element finishes updating
	};
	
	function formatter(value, settings) {
		return value.toFixed(settings.decimals);
	}
}(jQuery));

jQuery(function ($) {
	// custom formatting example
	$('.count-number').data('countToOptions', {
	  formatter: function (value, options) {
		return value.toFixed(options.decimals).replace(/\B(?=(?:\d{3})+(?!\d))/g, '.');
	  }
	});

	// start all the timers
	$('.timer').each(count);

	function count(options) {
		var $this = $(this);
		options = $.extend({}, options || {}, $this.data('countToOptions') || {});
		$this.countTo(options);
	} 

});

var monovoce = monovoce || {};

monovoce.counterEffects = ( function() {
	// 'use strict';

	// Classes that can be applied to elements.
	var counterClass = [ '.count-number'];


	// Whether a position check is running or not.
	var ticking = false;

	/**
	 * Injects effects CSS into the page dynamically.
	 * @since 1.0.0
	 */
	var addCSS = function() {
		var style = document.createElement( 'style' );
		style.classList.add( 'monovoce-block-effects-js' ); // To help identify where inline styles are coming from.

		document.body.appendChild( style );
	};

	/**
	 * Checks if the top or bottom of the given element is within the viewport.
	 * Uses top and bottom bounds only and ignores left and right position.
	 * @since 1.0.0
	 * @param {object} elem The element to check.
	 * @returns {bool}
	 */
	var isInViewport = function( elem ) {
		var bounding = elem.getBoundingClientRect();
		return (
			( 0 <= bounding.top &&
			bounding.top <= ( window.innerHeight || document.documentElement.clientHeight ) ) ||
			( 0 <= bounding.bottom &&
			bounding.bottom <= ( window.innerHeight || document.documentElement.clientHeight ) )
		);
	};

	/**
	 * Iterates over elements with effect classes.
	 * Applies in-viewport class when in viewport.
	 * @since 1.0.0
	 */
	var addInViewPortClass = function() {
		var i, j, elements;

		for ( i = 0; i < counterClass.length; ++i ) {
			elements = document.querySelectorAll( counterClass[i]);

			for ( j = 0; j < elements.length; ++j ) {
				if ( isInViewport( elements[j]) ) {
					elements[j].classList.add( 'has-mono-counter' );

					
				}
			}
		}

		ticking = false;
	};

	/**
	 * Triggers a new animation frame request if none are running.
	 * @since 1.0.0
	 */
	var update = function() {
		if ( ! ticking ) {
			window.requestAnimationFrame( addInViewPortClass );
			ticking = true;
		}
	};

	return {

		/**
		 * Adds CSS and sets up viewport check.
		 * Runs on ready to fade as early as possible, on load to account for
		 * reflow that moves content into the viewport, and on scroll or resize
		 * to show elements that are moved into the viewport by the user.
		 * @since 1.0.0
		 */
		init: function() {
			addCSS();
			update();
			window.addEventListener( 'load', update, false );
			window.addEventListener( 'scroll', update, false );
			window.addEventListener( 'resize', update, false );
		}

	};

}() );

monovoce.counterEffects.init();