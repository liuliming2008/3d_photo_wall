/*! jquery.panel.js - https://github.com/amercier/jquery-panel */
(function($) {
	
	// Default options
	var defaultOptions = {
		side          : 'left',
		showButtons   : true,
		startHidden   : false,
		startCollapsed: false,
		duration      : undefined,
		easing        : undefined,
		callback      : undefined
	};
	
	function _getProperty(side) {
		return side;
	}
	
	function _opposite(value) {
		if(value === undefined || value === null || value === 'auto') {
			return value;
		}
		else {
			var matches = value.match(/^(-)?(.*[^a-z])([a-z%]+)$/);
			return (matches[1] ? 1 : -1) * parseFloat(matches[2]) + matches[3];
		}
	}
	
	function _setExpanded($this, data, expanded) {
		data = data || $this.data('panel');
		data.expanded = expanded;
		$this.stop()
			.removeClass('panel-collapsing panel-expanding')
			.css(data.property, expanded ? data.expandedValue : data.collapsedValue)
			.addClass(expanded ? 'panel-expanded' : 'panel-collapsed');
	}
	
	function _setVisible($this, data, visible) {
		data = data || $this.data('panel');
		$this.parent().toggle(visible);
	}
	
	function _isVisible($this) {
		return $this.parent().css('display') != 'none';
	}
	
	function _updateWrapperSize($this, data, visible) {
		data = data || $this.data('panel');
		
		if(data._wrapperVisible != visible || data._wrapperVisible === undefined) {
			$this.parent().css(visible ? data.wrapperStyleVisible : data.wrapperStyleHidden);
			data._wrapperVisible = visible;
		}
	}
	
	var methods = {
		
		/**
		 * Initialize the panel(s)
		 * 
		 * @param {Object}  [options=null]				 The panel initialization options
		 * @paran {Boolean} [options.vertical=false]	   Whether the panel should collapse vertically (`true`) or horizontally (`false`, default)
		 * @paran {Boolean} [options.startHidden=false]	Whether the panel should start hidden (`true`) or shown (`false`, default)
		 * @paran {Boolean} [options.startCollapsed=false] Whether the panel should start collapsed (`true`) or expanded (`false`, default)
		 * 
		 * @return {jQuery} Returns the original jQuery object to maintain chainability
		 */
		init: function(options) {
			return this.each(function() {
				
				var $this = $(this),
					data  = $this.data('panel');
				
				// If the plugin hasn't been initialized yet
				if(!data || !data._init) {
					
					var allOptions = $.extend(true, {}, defaultOptions, data || {}, options);
					
					['width', 'height', 'top', 'right', 'bottom', 'left'].forEach(function(property) {
						if(property in allOptions && allOptions[property] != 'auto') {
							$this.css(property, allOptions[property]);
						}
					});
					
					var outerWidth  = $this.outerWidth(),
					    outerHeight = $this.outerHeight(),
					    width       = $this.width(),
					    height      = $this.height(),
					    position    = $this.position(),
					    cssPosition = $this.css('position'),
					    top         = 'top'    in allOptions && allOptions.top    || $this.css('top'),
						bottom      = 'bottom' in allOptions && allOptions.bottom || $this.css('bottom'),
						left        = 'left'   in allOptions && allOptions.left   || $this.css('left'),
						right       = 'right'  in allOptions && allOptions.right  || $this.css('right'),
						side        = allOptions.side,
						fixedHSize  = (side === 'right' || side === 'left') && ('width' in allOptions) && allOptions.width != 'auto';
					
					// Ensures that position is either "absolute" ord "fixed"
					if(cssPosition !== 'absolute' && cssPosition !== 'fixed') {
						window.console && console.error('Invalid position "' + cssPosition + '" on', $this);
						throw 'Impossible to create a panel while position is "' + cssPosition + '"';
					}
					
					$this
						// Data
						.data('panel', data = {
								
							_init: true,
								
							// Options
							side     : side,
							duration : allOptions.duration,
							easing   : allOptions.easing,
							
							// Animated property
							property      : _getProperty(side),
							expandedValue : 0,
							collapsedValue: $.inArray(side, ['left','right']) > -1 ? -outerWidth : -outerHeight,
							ratio         : $.inArray(side, ['left','right']) > -1 ? -outerWidth/100.0 : -outerHeight/100.0,
							
							// Wrapper style (hidden/visible)
							wrapperStyleVisible: {
								top     : top,
								bottom  : bottom,
								left    : fixedHSize && side === 'right'  ? 'auto' : left,
								right   : fixedHSize && side === 'left' ? 'auto' : right,
								height  : top !== 'auto' && bottom !== 'auto' ? 'auto' : (/%$/.test(height) ? height : outerHeight),
								width   : !fixedHSize && left !== 'auto' && right  !== 'auto' ? 'auto' : (/%$/.test(height) ? height : outerWidth)
							},
							wrapperStyleHidden: {
								top     : top,
								bottom  : 'auto',
								left    : side === 'right' ? 'auto' : 0,
								right   : side === 'left' ? 'auto' : 0,
								width   : 16,
								height  : 16
							}
						})
						.addClass('panel-' + data.side)
						.addClass('panel-content')
						.addClass(data.collapsed ? 'panel-collapsed' : 'panel-expanded')
						;
					
					// Create Wrapper
					$this.wrap('<div></div>')
						.parent()
						.addClass('panel')
						.css({
							margin  : [
								$this.css('margin-top')    || 0,
								$this.css('margin-right')  || 0,
								$this.css('margin-bottom') || 0,
								$this.css('margin-left')   || 0
							].join(' '),
							position: cssPosition
						})
						;

					// Content's CSS
					$this.css($.extend(({
						left: {
							left  : 0,
							right : 'auto',
							top   : 0,
							bottom: 0,
							width : fixedHSize ? width : '100%',
							height: 'auto'
						},
						right: {
							bottom: 0,
							left  : 'auto',
							top   : 0,
							right : 0,
							width : fixedHSize ? width : '100%',
							height: 'auto'
						}})[data.side], { // common
							position : 'absolute',
							margin   : 0,
							boxSizing: fixedHSize ? 'content-box' : 'border-box'
						}
					));
					
					// Buttons
					if(allOptions.showButtons) {
						
						var border = {
							top   : $this.css('border-top-width'),
							left  : $this.css('border-left-width'),
							bottom: $this.css('border-bottom-width'),
							right : $this.css('border-right-width')
						};
						
						var buttonCSS = ({
							left: {
								'margin-top'   : _opposite(border.top),
								'margin-left'  : border.right,
								'margin-right' : _opposite(border.right),
								'margin-bottom': border.top
							},
							right: {
								'margin-top'   : _opposite(border.top),
								'margin-left'  : _opposite(border.left),
								'margin-right' : border.left,
								'margin-bottom': border.top
							}
						})[side];
						
						var collapseButton = $('<button class="panel-button panel-button-collapse"> </button>').css(buttonCSS).text('Collapse').appendTo($this);
						var   expandButton = $('<button class="panel-button panel-button-expand"> </button>')  .css(buttonCSS).appendTo($this);
						
						// Collapse button action
						collapseButton.click(function(event) {
							event.preventDefault();
							event.stopPropagation();
							$this.panel('collapse');
						});
	
						// Expand button action
						expandButton.click(function(event) {
							event.preventDefault();
							event.stopPropagation();
							$this.panel('expand');
						});
					}
					
					// Start enabled/disabled
					_setVisible($this, data, !allOptions.startHidden);
					
					// Start expanded/collapsed
					_setExpanded($this, data, !allOptions.startCollapsed);
					_updateWrapperSize($this, data, !allOptions.startCollapsed);
				}
			});
		},
		
		/**
		 * Show the panel(s) and set it to "expanded" mode instantly
		 * 
		 * @return {jQuery} Returns the original jQuery object to maintain chainability
		 */
		show: function() {
			return this.each(function() {
				var $this = $(this),
				    data  = $this.data('panel');
				if(!_isVisible($this)) {
					if(!data || !data._init) {
						throw 'Attempting to show an uninitialized panel';
					}
					
					_setVisible($this, data, true);
					_setExpanded($this, data, true);
					_updateWrapperSize($this, data, true);
					$this.trigger('show.panel');
				}
			});
		},
		
		/**
		 * Hide the panel(s)
		 * 
		 * @return {jQuery} Returns the original jQuery object to maintain chainability
		 */
		hide: function() {
			return this.each(function() {
				var $this = $(this),
			        data  = $this.data('panel');
				if(_isVisible($this)) {
					if(!data || !data._init) {
						throw 'Attempting to hide an uninitialized panel';
					}
					
					_setVisible($this, data, false);
					_setExpanded($this, data, false);
					_updateWrapperSize($this, data, false);
					$this.trigger('hide.panel');
				}
			});
		},
		
		/**
		 * Show/hide the panel(s)
		 * 
		 * @param {Boolean} [show] If set, force the toggling state
		 * @return {jQuery} Returns the original jQuery object to maintain chainability
		 */
		toggle: function(show) {
			return this.each(function() {
				$(this).panel(show !== undefined && show || show === undefined && $this.css('display') === 'none' ? 'show' : 'hide');
			});
		},
		
		/**
		 * Expand the panel(s)
		 * 
		 * @return {jQuery} Returns the original jQuery object to maintain chainability
		 */
		expand: function(amount, now, hide) {
			return this.each(function() {
				var $this      = $(this),
				    data       = $this.data('panel'),
				    properties = {},
				    matches;
				
				if(!data || !data._init) {
					throw 'Attempting to expand an uninitialized panel';
				}
				
				properties[data.property] = amount === undefined ? data.expandedValue : ((matches = /(.*)%$/.exec(amount)) ? data.ratio * (100 - parseFloat(matches[1])) : data.collapsedValue + parseFloat(amount));
				data.expanded = properties[data.property] == data.expandedValue;
				_setVisible($this, data, true);
				_updateWrapperSize($this, data, true);
				
				// After expanding
				function afterExpand() {
					$this
						.removeClass('panel-expanding')
						.addClass('panel-expanded')
						.trigger('afterexpand.panel');
					if(hide) {
						_setVisible($this, data, false);
					}
				}
				
				if(now) {
					$this.stop().css(properties);
					$this.trigger('expand.panel');
					afterExpand();
				}
				else {
					$this.stop().addClass('panel-expanding').animate(properties, data.duration, data.easing, afterExpand);
					$this.trigger('expand.panel');
				}
			});
		},
		
		/**
		 * Collapse the panel(s)
		 * 
		 * @return {jQuery} Returns the original jQuery object to maintain chainability
		 */
		collapse: function(amount, now, hide) {
			return this.each(function() {
				var $this      = $(this),
				    data       = $this.data('panel'),
				    properties = {},
				    matches;
				
				if(!data || !data._init) {
					throw 'Attempting to collapse an uninitialized panel';
				}
				
				properties[data.property] = amount === undefined ? data.collapsedValue : ((matches = /(.*)%$/.exec(amount)) ? data.ratio * parseFloat(matches[1]) : -parseFloat(amount));
				data.expanded = properties[data.property] == data.expandedValue;
				_setVisible($this, data, true);
				
				// After collapse
				function afterCollapse() {
					$this
						.removeClass('panel-collapsing')
						.addClass('panel-collapsed')
						.trigger('aftercollapse.panel');
					if(amount === undefined) {
						_updateWrapperSize($this, data, false);
					}
					if(hide) {
						_setVisible($this, data, false);
					}
				}
				
				if(now) {
					$this.stop().css(properties);
					$this.trigger('collapse.panel');
					afterCollapse();
				}
				else {
					$this.stop().addClass('panel-collapsing').animate(properties, data.duration, data.easing, afterCollapse);
					$this.trigger('collapse.panel');
				}
				
			});
		},
		
		/**
		 * Collapse/expand the panel(s)
		 * 
		 * @param {Boolean} [expand] If set, force the toggling state
		 * @return {jQuery} Returns the original jQuery object to maintain chainability
		 */
		toggleExpand: function(expand) {
			return this.each(function() {
				var $this = $(this),
				    data  = $this.data('panel');
				$this.panel(
						expand !== undefined && expand || expand === undefined && !data.expanded
						? 'expand'
						: 'collapse'
					);
			});
		}
	};
	
	/**
	 * Plug-in registration
	 */
	$.fn.panel = function(method) {
		
		// Method calling logic
		if(methods[method]) {
			return methods[method].apply(this, Array.prototype.slice.call(arguments, 1));
		}
		else if(typeof method === 'object' || !method) {
			return methods.init.apply(this, arguments);
		}
		else {
			$.error('Method ' +  method + ' does not exist on jQuery.panel');
		}
		
	};
	
})(jQuery);