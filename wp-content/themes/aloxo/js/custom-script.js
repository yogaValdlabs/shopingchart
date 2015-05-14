/* utility functions*/
(function($) {
	"use strict";

	$.avia_utilities = $.avia_utilities || {};
	$.avia_utilities.supported = {};
	$.avia_utilities.supports = (function () {
		var div = document.createElement('div'),
			vendors = ['Khtml', 'Ms', 'Moz', 'Webkit', 'O'];  // vendors   = ['Khtml', 'Ms','Moz','Webkit','O'];  exclude opera for the moment. stil to buggy
		return function (prop, vendor_overwrite) {
			if (div.style.prop !== undefined) {
				return "";
			}
			if (vendor_overwrite !== undefined) {
				vendors = vendor_overwrite;
			}
 			prop = prop.replace(/^[a-z]/, function (val) {
				return val.toUpperCase();
			});

			var len = vendors.length;
			while (len--) {
				if (div.style[vendors[len] + prop] !== undefined) {
					return "-" + vendors[len].toLowerCase() + "-";
				}
			}
			return false;
		};
	}());
	;(function($){
	    $.fn.extend({
	        donetyping: function(callback,timeout){
	            timeout = timeout || 1e3; // 1 second default timeout
	            var timeoutReference,
	                doneTyping = function(el){
	                    if (!timeoutReference) return;
	                    timeoutReference = null;
	                    callback.call(el);
	                };
	            return this.each(function(i,el){
	                var $el = $(el);
	                // Chrome Fix (Use keyup over keypress to detect backspace)
	                // thank you @palerdot
	                $el.is(':input') && $el.on('keyup keypress',function(e){
	                    // This catches the backspace button in chrome, but also prevents
	                    // the event from triggering too premptively. Without this line,
	                    // using tab/shift+tab will make the focused element fire the callback.
	                    if (e.type=='keyup' && e.keyCode!=8) return;
	                    
	                    // Check if timeout has been set. If it has, "reset" the clock and
	                    // start over again.
	                    if (timeoutReference) clearTimeout(timeoutReference);
	                    timeoutReference = setTimeout(function(){
	                        // if we made it here, our timeout has elapsed. Fire the
	                        // callback
	                        doneTyping(el);
	                    }, timeout);
	                }).on('blur',function(){
	                    // If we can, fire the event since we're leaving the field
	                    doneTyping(el);
	                });
	            });
	        }
	    });
	})(jQuery);
	var rebindSilde = function(){
		jQuery('.wpb_tabs_nav a').click(function (e) {
			generateCarousel();
		});
	}
	var generateCarousel = function () {
		if (jQuery().carouFredSel) {
			jQuery(function ($) {
				jQuery('.products-slider').each(function () {
					var carousel = jQuery(this).find('ul');
					carousel.carouFredSel({
						auto      : false,
						prev      : jQuery(this).find('.es-nav-prev'),
						next      : jQuery(this).find('.es-nav-next'),
						align     : "left",
						left      : 0,
						width     : '100%',
						height    : 'variable',
						responsive: true,
						scroll    : {
							items: 1
						},
						items     : {
							width: '245',
							height : 'variable',
							visible: {
								min: 1,
								max: 30
							}
						}
					});
				});
			});
			jQuery('.products-slider-02').each(function () {
				jQuery(this).find('ul.slider').carouFredSel({
					auto      : false,
					prev      : jQuery(this).find('.es-nav-prev'),
					next      : jQuery(this).find('.es-nav-next'),
					align     : "left",
					left      : 0,
					width     : '100%',
					height    : 'variable',
					responsive: true,
					scroll    : {
						items: 1
					},
					items     : {
						height : 'variable',
						visible: {
							min: 1,
							max: 30
						}
					}
				});
			});
		}
	};
	/* Smartresize */
	;(function($,sr){
		// debouncing function from John Hann
		// http://unscriptable.com/index.php/2009/03/20/debouncing-javascript-methods/
		var debounce = function (func, threshold, execAsap) {
		    var timeout;
		    return function debounced () {
		        var obj = this, args = arguments;
		        function delayed () {
		            if (!execAsap)
		                func.apply(obj, args);
		            timeout = null;
		        };
		        if (timeout)
		            clearTimeout(timeout);
	        	else if (execAsap)
		            func.apply(obj, args);

		        timeout = setTimeout(delayed, threshold || 100);
		    };
		}
	 	// smartresize 
	 	jQuery.fn[sr] = function(fn){  return fn ? this.bind('resize', debounce(fn)) : this.trigger(sr); };
	})(jQuery,'smartresize');
	/* jQuery CounTo */
	(function (a) {
		a.fn.countTo = function (g) {
			g = g || {};
			return a(this).each(function () {
				function e(a) {
					a = b.formatter.call(h, a, b);
					f.html(a)
				}

				var b = a.extend({}, a.fn.countTo.defaults, {from: a(this).data("from"), to: a(this).data("to"), speed: a(this).data("speed"), refreshInterval: a(this).data("refresh-interval"), decimals: a(this).data("decimals")}, g), j = Math.ceil(b.speed / b.refreshInterval), l = (b.to - b.from) / j, h = this, f = a(this), k = 0, c = b.from, d = f.data("countTo") || {};
				f.data("countTo", d);
				d.interval && clearInterval(d.interval);
				d.interval =
					setInterval(function () {
						c += l;
						k++;
						e(c);
						"function" == typeof b.onUpdate && b.onUpdate.call(h, c);
						k >= j && (f.removeData("countTo"), clearInterval(d.interval), c = b.to, "function" == typeof b.onComplete && b.onComplete.call(h, c))
					}, b.refreshInterval);
				e(c)
			})
		};
		a.fn.countTo.defaults = {from: 0, to: 0, speed: 1E3, refreshInterval: 100, decimals: 0, formatter: function (a, e) {
			return a.toFixed(e.decimals)
		}, onUpdate                  : null, onComplete: null}
	})(jQuery);

	//Scroll To top
	var scrollToTop = function()
	{
		jQuery(window).scroll(function () {
			if (jQuery(this).scrollTop() > 100) {
				jQuery('#topcontrol').css({bottom: "15px"});
			} else {
				jQuery('#topcontrol').css({bottom: "-100px"});
			}
		});
	 	jQuery('#topcontrol').click(function () {
			jQuery('html, body').animate({scrollTop: '0px'}, 800);
			return false;
		});
	}

	/* Process show popup cart when hover cart info */
	var miniCartHover = function(){
	  	jQuery(document).on('mouseover', '.minicart_hover',function () {
			jQuery(this).children('.widget_shopping_cart_content,.widget_download_cart_content').slideDown();
		}).on('mouseleave', '.minicart_hover', function () {
			jQuery(this).children('.widget_shopping_cart_content,.widget_download_cart_content').delay(100).slideUp();
		});

		jQuery(document)
			.on('mouseenter', '.widget_shopping_cart_content,.widget_download_cart_content', function () {
				jQuery(this).stop(true, true).show()
			})
			.on('mouseleave', '.widget_shopping_cart_content,.widget_download_cart_content', function () {
				jQuery(this).delay(100).slideUp()
			});
	}

	/* onepage hover menu */
	var scrollHandler = function () {
 		var scrollPosition = parseInt(jQuery(window).scrollTop(), 10);
		jQuery('.navbar-nav li a[href^=#]').each(function () {
			var thisHref = jQuery(this).attr('href');
 			if (jQuery(thisHref).length) {
				var thisTruePosition = parseInt(jQuery(thisHref).offset().top, 10);
				if (jQuery("#wpadminbar").length) {
					var admin_height = jQuery("#wpadminbar").height();
				}else admin_height = 0;
				var thisPosition = thisTruePosition - (jQuery(".navigation").height()+2+admin_height);
				// if scroll position < data height
				if (scrollPosition <= parseInt(jQuery(jQuery('.navbar-nav li a[href^=#]').first().attr('href')).height(), 10)) {
 					if (scrollPosition >= thisPosition) {
						jQuery('.navbar-nav li a[href^=#]').removeClass('nav-active');
						jQuery('.navbar-nav li a[href=' + thisHref + ']').addClass('nav-active');
					}
				} else {
					if (scrollPosition >= thisPosition || scrollPosition >= thisPosition) {
						jQuery('.navbar-nav li a[href^=#]').removeClass('nav-active');
						jQuery('.navbar-nav li a[href=' + thisHref + ']').addClass('nav-active');
					}
				}
			}
		});
	}

	/* Social login popup */
	var aloxoLoginSocialPopup = function () {
		jQuery('.aloxo-link-login a').click(function(event) {
			var popupWrapper = '#aloxo-popup-login-wrapper';
			jQuery.ajax({
				type   : 'POST',
				data   : 'action=aloxo_social_login',
				url    : aloxo_ob_ajax_url,
				success: function (html) {
					if (jQuery(popupWrapper).length) {
						jQuery(popupWrapper).remove();
					}
					jQuery('body').append(html);
					jQuery('ul.the_champ_login_ul li i', popupWrapper).show();
					jQuery('.aloxo-popup-login-close', popupWrapper).click(function() {
						jQuery(this).parent().parent().parent().parent().remove();
					});
					jQuery(document).mouseup(function (e) {
					    var container = jQuery(".aloxo-popup-login-container-inner");

					    if (!container.is(e.target) // if the target of the click isn't the container...
					        && container.has(e.target).length === 0) // ... nor a descendant of the container
					    {
					        jQuery("#aloxo-popup-login-wrapper").remove();
					    }
					});

					jQuery(document).keyup(function(e) {
					  	if (e.keyCode == 27) {
					  		jQuery("#aloxo-popup-login-wrapper").remove();
					  	}
					});
					
					jQuery('#aloxo-popup-login-form').submit(function(event) {
						var input_data = jQuery('#aloxo-popup-login-form').serialize();

						jQuery.ajax({
							type   : 'POST',
							data   : input_data,
							url    : aloxo_ob_ajax_url,
							success: function (html) {
								var response_data = jQuery.parseJSON(html);
								jQuery('.login-message', '#aloxo-popup-login-form').html(response_data.message);
							},
							error  : function (html) {
							}
						});
						event.preventDefault();
						return false;
					});
				},
				error  : function (html) {
				}
			});
			event.preventDefault();
		});
	}

	/* aloxo Login Widget*/
	var aloxoLoginWidget = function () {
		jQuery('.aloxo-login-widget-form').each(function() {
			jQuery(this).submit(function(event){
				if (this.checkValidity()) {
					var $form = jQuery(this);
					var input_data = jQuery($form).serialize();
					jQuery.ajax({
						type   : 'POST',
						data   : input_data,
						url    : aloxo_ob_ajax_url,
						success: function (html) {
							var response_data = jQuery.parseJSON(html);
							jQuery('.aloxo-login-widget-message', $form).html(response_data.message);
						},
						error  : function (html) {
						}
					});
				}
	 			event.preventDefault();
				return false;
			});
		});
	}

	/* Product Grid, List Switch */
	var listSwitcher = function () {
		var activeClass = 'switcher-active';
		var gridClass = 'products-grid';
		var listClass = 'products-list';
		jQuery('.switchToList').click(function () {
			if (!jQuery.cookie('products_page') || jQuery.cookie('products_page') == 'grid') {
				switchToList();
			}
		});
		jQuery('.switchToGrid').click(function () {
			if (!jQuery.cookie('products_page') || jQuery.cookie('products_page') == 'list') {
				switchToGrid();
			}
		});

		function switchToList() {
			jQuery('.switchToList').addClass(activeClass);
			jQuery('.switchToGrid').removeClass(activeClass);
			jQuery('.archive_switch').fadeOut(300, function () {
				jQuery(this).removeClass(gridClass).addClass(listClass).fadeIn(300);
				jQuery.cookie('products_page', 'list', { expires: 3, path: '/' });
			});
		}

		function switchToGrid() {
			jQuery('.switchToGrid').addClass(activeClass);
			jQuery('.switchToList').removeClass(activeClass);
			jQuery('.archive_switch').fadeOut(300, function () {
				jQuery(this).removeClass(listClass).addClass(gridClass).fadeIn(300);
				jQuery.cookie('products_page', 'grid', { expires: 3, path: '/' });
			});
		}
	}

	var check_view_mod = function () {
		var activeClass = 'switcher-active';
		if (jQuery.cookie('products_page') == 'grid') {
			jQuery('.archive_switch').removeClass('products-list').addClass('products-grid');
			jQuery('.switchToGrid').addClass(activeClass);
		} else if (jQuery.cookie('products_page') == 'list') {
			jQuery('.archive_switch').removeClass('products-grid').addClass('products-list');
			jQuery('.switchToList').addClass(activeClass);
		}
		//else {
		//	jQuery('.switchToGrid').addClass(activeClass);
		//	jQuery('.archive_switch').removeClass('products-list').addClass('products-grid');
		//}
	}

	/* tab widget */
	var init_tabs = function () {
		//show first tab content
		jQuery('.wpb_tour_tabs_wrapper_thim ul.nav-tabs').each(function(index,el){
			jQuery(el).find('a:first').tab('show');
		});
		// add active tab js
		jQuery('.wpb_tour_tabs_wrapper_thim ul.nav-tabs li a').click(function (e) {
			  e.preventDefault();
			  jQuery(this).tab('show')
		})

		//$('.wg-tabs > ul a').on('click', function (e) {
		//	e.preventDefault();
		//	var
		//	elm = $(this),
		//	parent = elm.closest('.wg-tabs'),
		//	tab_page = $(elm.attr('href'), parent);
		//
		//	parent.find('> ul a').removeClass('selected');
		//	parent.find('.tab-content').hide();
		//
		//	elm.addClass('selected');
		//	tab_page.show();
		//});
		//
		//$('.wg-tabs > ul li:first-child a').trigger('click');
	};
	/* product shortcode */
	var product_center = function () {
		var container = jQuery('.wc-product');
		
		container.each(function () {
			var $this = jQuery(this);
			if ($this.find('li').hasClass('module_title_left')) {
				$this.imagesLoaded(function () {
					var heights = new Array();
					$this.find('li').each(function() {
						$(this).css('min-height', 'auto');
						$(this).css('max-height', 'auto');
						$(this).css('height', 'auto');
				 		heights.push($(this).height());
					});
					var max = Math.max.apply( Math, heights );
					$this.find('li').each(function() {
						$(this).css('min-height', max + 'px');
					});	
				});	
			}
		});
	};
	
	// Create Base64 Object
	/**
	*  Base64 encode / decode
	*  http://www.webtoolkit.info/
	**/
	var Base64 = { 
	  // private property
	  _keyStr : "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=",
	 
	  // public method for encoding
	  encode : function (input) {
	    var output = "";
	    var chr1, chr2, chr3, enc1, enc2, enc3, enc4;
	    var i = 0;
	 
	    input = Base64._utf8_encode(input);
	 
	    while (i < input.length) {
	      chr1 = input.charCodeAt(i++);
	      chr2 = input.charCodeAt(i++);
	      chr3 = input.charCodeAt(i++);
	 
	      enc1 = chr1 >> 2;
	      enc2 = ((chr1 & 3) << 4) | (chr2 >> 4);
	      enc3 = ((chr2 & 15) << 2) | (chr3 >> 6);
	      enc4 = chr3 & 63;
	 
	      if (isNaN(chr2)) {
	        enc3 = enc4 = 64;
	      } else if (isNaN(chr3)) {
	        enc4 = 64;
	      }
	 
	      output = output +
	      this._keyStr.charAt(enc1) + this._keyStr.charAt(enc2) +
	      this._keyStr.charAt(enc3) + this._keyStr.charAt(enc4);
	    }
	 
	    return output;
	  },
	 
	  // public method for decoding
	  decode : function (input) {
	    var output = "";
	    var chr1, chr2, chr3;
	    var enc1, enc2, enc3, enc4;
	    var i = 0;
	 
	    input = input.replace(/[^A-Za-z0-9\+\/\=]/g, "");
	 
	    while (i < input.length) {
	      enc1 = this._keyStr.indexOf(input.charAt(i++));
	      enc2 = this._keyStr.indexOf(input.charAt(i++));
	      enc3 = this._keyStr.indexOf(input.charAt(i++));
	      enc4 = this._keyStr.indexOf(input.charAt(i++));
	 
	      chr1 = (enc1 << 2) | (enc2 >> 4);
	      chr2 = ((enc2 & 15) << 4) | (enc3 >> 2);
	      chr3 = ((enc3 & 3) << 6) | enc4;
	 
	      output = output + String.fromCharCode(chr1);
	 
	      if (enc3 != 64) {
	        output = output + String.fromCharCode(chr2);
	      }
	      if (enc4 != 64) {
	        output = output + String.fromCharCode(chr3);
	      }
	    }
	 
	    output = Base64._utf8_decode(output);
	 
	    return output;
	  },

	  // private method for UTF-8 encoding
	  _utf8_encode : function (string) {
	    string = string.replace(/\r\n/g,"\n");
	    var utftext = "";
	 
	    for (var n = 0; n < string.length; n++) {
	      var c = string.charCodeAt(n);
	 
	      if (c < 128) {
	        utftext += String.fromCharCode(c);
	      }
	      else if((c > 127) && (c < 2048)) {
	        utftext += String.fromCharCode((c >> 6) | 192);
	        utftext += String.fromCharCode((c & 63) | 128);
	      }
	      else {
	        utftext += String.fromCharCode((c >> 12) | 224);
	        utftext += String.fromCharCode(((c >> 6) & 63) | 128);
	        utftext += String.fromCharCode((c & 63) | 128);
	      }
	    }
	 
	    return utftext;
	  },

	  // private method for UTF-8 decoding
	  _utf8_decode : function (utftext) {
	    var string = "";
	    var i = 0;
	    var c = c1 = c2 = 0;
	 
	    while ( i < utftext.length ) { 
	      c = utftext.charCodeAt(i);
	 
	      if (c < 128) {
	        string += String.fromCharCode(c);
	        i++;
	      }
	      else if((c > 191) && (c < 224)) {
	        c2 = utftext.charCodeAt(i+1);
	        string += String.fromCharCode(((c & 31) << 6) | (c2 & 63));
	        i += 2;
	      }
	      else {
	        c2 = utftext.charCodeAt(i+1);
	        c3 = utftext.charCodeAt(i+2);
	        string += String.fromCharCode(((c & 15) << 12) | ((c2 & 63) << 6) | (c3 & 63));
	        i += 3;
	      }
	    }
	 
	    return string;
	  }
	}

	var border_wave = function () {
		var bd = jQuery('[class*="border-wave"]');
		bd.each(function () {
			var $this = jQuery(this);

			var classes = $this.attr('class').split(' ');
			for (var i = 0; i < classes.length; i++) {
				if (classes[i].toLowerCase().indexOf("border-wave") >= 0) {
					var option = classes[i].split('_');

					var color = "#"+option[3].split('-')[1];
					var position = ":before";
					if (option[1] == 'style1') {
						if (option[2] == 'top') {
							position = ":before";
						}else {
							position = ":after";
						}
						var x = '<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="-30.188 -4 72.188 30" width="72.188" height="30" enable-background="new -30.188 -4 72.188 30" xml:space="preserve" preserveAspectRatio="none slice"><g><path fill="'+color+'" d="M-30.188-4C-14.99-4-5.492,3,5.906,3S26.803-4,42-4v15h-72.188V-4z"/><path fill="'+color+'" d="M42,26c-15.197,0-24.696-7.063-36.094-7.063S-14.99,26-30.188,26V11H42V26z"/></g></svg>';
						var data = Base64.encode(x);
					}else if (option[1] == 'style2') {
						if (option[2] == 'top') {
							position = ":before";
							var x = '<svg version="1.1" id="borders" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="72px" height="33px" viewBox="-26.5 -8 72 33" enable-background="new -26.5 -8 72 33" xml:space="preserve"><g id="Layer_2_2_"><g><path fill="'+color+'" d="M-26.5-8c15.158,0,24.632,6,36,6s20.842-6,36-6V7h-72V-8z"/></g></g><g id="Layer_2_3_"><image overflow="visible" opacity="0.06" width="79" height="22" xlink:href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAE8AAAAWCAYAAACBtcG5AAAACXBIWXMAAAsSAAALEgHS3X78AAAA'
+'GXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAptJREFUeNrs2N1u0zAUB3Af11kq'
+'xrppg1UCiRt2Ay/ANU/OK0xcsCtuuIFVGqxdi2id2PxP6rDE+WrKVopkS+nJd9KffBzbJO4LeTGU'
+'arHFmENJLArL0EUZnCrFYEmw/HLRKAeonghxpqPolTTmFKwHoQaWaxwwVkbK75HWX34KcYN9WrmD'
+'Q4Yja99bKd8Ka58GvDKeJZrD5xOcPgitFzleVvNQ484A9wYb77B9ElK3krK3ALRw+uiaNsprnkSq'
+'RvA9Yjisnwa8Mh5qHcejzMnZKO9rS+6ADHiVIgtGf3aE8heaoQS83Re1jz33jrI3IyG1B1AcNZYV'
+'R2oBtGsw/toduEj/ElTtGKsOSuNnhvUJR7se+tiGGqfwM8LBc44M2AC6E0y1YyyGmhagtCBaWmuv'
+'ieizMOYa5y1b7h0LKcc4/zWuG6NfGjNYAfTY9cPqMGkf8TbFmqKHvvCh0PnUhmgGlMlK65m7vqlE'
+'sVIjm6bn6OmPHJQPeugQGZM7/MPsnEdIc/XA7VUrFqAWgJp6UNk9kiRZFbYbPxbL5fIH4tfkHqMI'
+'ymiHGaYxF8B8iROeYd+4I823AlUejHXjONMA19ZedWFN3fV1UH2+tsalNjWAMuYx3uMSz3+OZ7/A'
+'+kVDmneBFp9pCkYlPJPVGqI7HgC7cZzfB/Qb9kp7tSFWH6hNuzVFUMa8RfzGs0WAPEGtvGxJ81rQ'
+'Ch4R3/OOm5m8cin3EomR8gYHrgDIL1Cdkqpp2L326rGwtgE1LkPmgJy2pHkbqH//OfZfsZNI08TN'
+'8a1v2DEZyicmKaAGg8EEL1Rqr/JU3iFWn1LXpvkpGsVxPEoBOrCWQVXN/69MhvaZhq+DEnuI9VCg'
+'dW1taRqeeg57/keobUE7//9vAQYAHiLl5zFbjQQAAAAASUVORK5CYII=" transform="matrix(1 0 0 1 -30 4.5)"></image><g><g><g><path fill="'+color+'" d="M-26.5,7h72v15c-15.158,0-24.632-6-36-6s-20.842,6-36,6V7z"/></g></g></g></g></svg>';
						}else {
							position = ":after";
							var x = '<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="72px" height="33px" viewBox="-26.5 -11 72 33" enable-background="new -26.5 -11 72 33" xml:space="preserve"><g id="Layer_2"><image overflow="visible" opacity="0.06" width="79" height="22" xlink:href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAE8AAAAWCAYAAACBtcG5AAAACXBIWXMAAAsSAAALEgHS3X78AAAA'
+'GXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAqtJREFUeNrsmEtv00AQx3fWdlzR'
+'NiktJDwkLvQCJ26c+eT9DhzoBS5IIKVQlKQNwrW9w3/iTWpt/UrS0KZ4pM3E3l2v5+eZ2QepayFH'
+'Fwk7+iHJ0vbPG2oUH2XHal3SMUa5spq3GCgV6AClY3URQIOSoPyx2vi2of9IqaM4CF5pYw45e0j+'
+'AYyLJCWaeJ53FkXRJAfwvgNtAioIw7CbpmnfY+5y5kCu/VdG619BHH/9rdS52Ovbyh0BR8wfWOu3'
+'innPpc9EEeqHypgvHc8b4laEBnFDoPyPQVKu1IGS+yHsGqDyNewfwP7QjTrYfwn7P4HTiYrj6Rze'
+'zPPgcUfo+AYX73F9cCN0mQXEBPpMAZh0bgB0ZN08ckDetleSAy0DAqcAqIMGoALoLu71YU/X9ndD'
+'dgR7GZw+2tRGc8/TnD1gX8Dh/2FB3hNjH+PnuYAgua4G+hlAvxuiHwA5BMixBbhumNeFoXhWD8AG'
+'mvkp3uMFGhxXgcKgZMF2uDjnGbQVvW/rZ2z8AlfXueKKtl+UuR7oOwD9iUG/WZBD1E/hleOGebMM'
+'XFUY9tB5d+ZZzMcY/yXe4wkaDRqAqpttdY6RcuGtOp2XAX1GErJEIwtyDK+cNsybZdIkX+2i9Iio'
+'T1kUyQoiXBJUI/E3MJvNgcqXlYmnt/DMzCvHdXmzYqy6fCVjBQWeReuC2hS8qtnO9Uy2ObUqbyYl'
+'oTub2Brmq1vxrLuCV+WZ9XmzfHm/ar7aWnir5M11t1EPFt69BrKMaNVKC6+Ft2XiO9svtvs406K5'
+'sbc17gGHv9i7ZQvWC9kA231c65V5eLJTUurCLvTNHJ6QSozW56g4BUCZ8fa2bebbsAijSyykToWT'
+'StPEnvFlm+uaw9D/Hl7RYegyx/Bt6DrH8LTtC9U7CN+F/ivAAFv2xUqrbW53AAAAAElFTkSuQmCC" transform="matrix(1 0 0 1 -30 -12.5)"></image><g><g><g><path fill="'+color+'" d="M-26.5-8c15.158,0,24.632,5.984,36,5.984S30.342-8,45.5-8V7h-72V-8z"/></g></g></g></g><g id="Layer_2_2_"><g><path fill="'+color+'" d="M-26.5,7h72v15c-15.158,0-24.632-5.984-36-5.984S-11.342,22-26.5,22V7z"/></g></g></svg>';
						}
						var data = Base64.encode(x);
					}else {
						if (option[2] == 'top') {
							position = ":before";
						}else {
							position = ":after";
						}
						var x = '<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="27px" height="5px" viewBox="0 9 27 5" enable-background="new 0 9 27 5" xml:space="preserve" preserveAspectRatio="none slice"><g id="Layer_2_2_"><g><path fill="none" stroke="'+color+'" stroke-miterlimit="10" d="M26.979,13.469c-5.675,0-9.223-3.906-13.479-3.906s-7.804,3.906-13.479,3.906"/></g></g></svg>';
						var data = Base64.encode(x);
					}
					$('head').append('<style type="text/css">.'+ classes[i] + position + '{background-image: url("data:image/svg+xml;base64,'+data+'");}' + '</style>');
				}
			}
		});
	};

 	/* sticky */
	var sticky_calc = function () {
		if ($(".height_sticky_auto").length) {
			$('.navigation').affix({
			      offset: {
			        top: $('#masthead').offset().top
			      }
			});
		}
	}

	/* audio post */
	/* ****** jp-jplayer  ******/
	var post_audio = function () {
		$('.jp-jplayer').each(function () {
			var $this = $(this),
				url = $this.data('audio'),
				type = url.substr(url.lastIndexOf('.') + 1),
				player = '#' + $this.data('player'),
				audio = {};
			audio[type] = url;

			$this.jPlayer({
				ready              : function () {
					$this.jPlayer('setMedia', audio);
				},
				swfPath            : 'jplayer/',
				cssSelectorAncestor: player
			});
		});
	}
	var post_gallery = function () {
		$('article.format-gallery .flexslider').imagesLoaded(function () {
			$('.flexslider').flexslider( {
				slideshow : true,
				animation : 'fade',
				pauseOnHover: true,
				animationSpeed : 400,
				smoothHeight : true,
				directionNav: true,
				controlNav: false
			});
		});
	}

	// DOMReady event
	$(function () {
		scrollToTop();
		miniCartHover();
		aloxoLoginSocialPopup();
		aloxoLoginWidget();
		product_center();
		jQuery(window).smartresize(function () {
			product_center();
		});
		if (jQuery("body.woocommerce").length){
			check_view_mod();
			listSwitcher();
		}

		border_wave();
		sticky_calc();

		if (jQuery(".has-gallery").length) {
			$('.pr-slides').lightSlider({
				gallery:true,
				item:1,
				vertical:true,
				verticalHeight:330,
				vThumbWidth:64,
				thumbItem:4,
				galleryMargin: 20,
				thumbMargin:20,
				slideMargin:0,
				currentPagerPosition: "right"
			}); 
		}
		if (jQuery(".no-gallery").length) {
			$('.pr-slides').lightSlider({
				gallery:true,
				item:1,
				vertical:true,
				verticalHeight:414,
				vThumbWidth:64,
				thumbItem:4,
				galleryMargin: 20,
				thumbMargin:20,
				slideMargin:0,
				currentPagerPosition: "right"
			}); 
		}

		/* blog */
		$(document).ready(function() {
			//post_gallery();
		});

		$(document).ready(function() {
			post_audio();
			post_gallery();
			var $blog = $('.blog-masonry');
			if ($('.blog-masonry').length) {
				$blog.imagesLoaded(function () {
					$blog.isotope({
						itemSelector: '.type-post'
					});

					if ($(".page-content-inner").hasClass("scroll")) {
						$blog.infinitescroll({
					        navSelector: '.loop-pagination', // selector for the paged navigation
					        nextSelector: '.loop-pagination a:first', // selector for the NEXT link (to page 2)
							extraScrollPx: 120,
					        itemSelector: 'article.type-post', // selector for all items you
					        animate: true,
							bufferPx: 40,
							errorCallback: function () {
							},
							infid: 0, //Instance ID
					    	loading: {
					 			finished: undefined,
					            finishedMsg: 'No more pages to load.',
					            img: "http://i.imgur.com/qkKy8.gif",
					            msgText: "<em>Loading the next set of posts...</em>",
								speed: 'fast',
								start: undefined
					        }
					    },
						function(newElements) {
							$blog.isotope('appended', jQuery(newElements));
							post_gallery();
							post_audio();
							$blog.imagesLoaded(function () {
								$blog.isotope( 'layout' );
							});
						});
					}
				});
			}
		});
		
		/* onepage hover menu */
		var scrollTimer = false;
		clearTimeout(scrollTimer);
		scrollHandler();
		$(window).scroll(function () {
			clearTimeout(scrollTimer);
			scrollTimer = window.setTimeout(function () {
				scrollHandler();
			}, 20);
		});

		/*Check menu in the bottom*/
		jQuery(document).ready(function () {
			var screenheight = parseInt(jQuery(window).height());
			if ($(".header_after_slider").length) {
				var scrollwd = parseInt(jQuery(this).scrollTop());
				var eloffset = parseInt(jQuery('.navigation').offset().top);
				var checkscroll = eloffset - scrollwd;
				if (checkscroll <= (screenheight / 3)) {
					jQuery('.desktop_menu').removeClass('menu_in_bottom');
				} else {
					jQuery('.desktop_menu').addClass('menu_in_bottom');
				}
			}

			jQuery(window).scroll(function () {
				if ($(".header_after_slider").length) {
					var scrollwd = parseInt(jQuery(this).scrollTop());
					var eloffset = parseInt(jQuery('.navigation').offset().top);
					var checkscroll = eloffset - scrollwd;
					if (checkscroll <= (screenheight / 3)) {
						jQuery('.desktop_menu').removeClass('menu_in_bottom');
					} else {
						jQuery('.desktop_menu').addClass('menu_in_bottom');
					}
				}
			});
		});

 		/* ****** hasTooltip  ******/
 		$('.hasTooltip').tooltip('hide');

 		/* ****** PRODUCT QUICK VIEW  ******/
 		$('.quick-view').click(function (e) {
			/* add loader  */
			$(this).css('display', 'none');
			$(this).after('<div class="loading dark"></div>');
			var product_id = $(this).attr('data-prod');
			var data = { action: 'jck_quickview', product: product_id};
			$.post(ajaxurl, data, function (response) {
				$.magnificPopup.open({
					mainClass: 'my-mfp-zoom-in',
					items    : {
						src : '<div class="product-lightbox">' + response + '</div>',
						type: 'inline'
					}
				});
				$('.quick-view').css('display', 'inline-block');
				$('.loading').remove();
				setTimeout(function () {
					$('.product-lightbox form').wc_variation_form();
				}, 600);
			});
			e.preventDefault();
		});
		/* back to top button */
		$(window).scroll(function () {
			if ($(window).scrollTop() != 0) {
				$('#back-top').fadeIn();
			} else {
				$('#back-top').fadeOut();
			}
		});

		$('#back-top').click(function () {
			$('html,body').animate({scrollTop: 0}, 500);
		});
		/* category toggle */
		jQuery('.product-categories li.cat-parent .icon-plus').click( function () {
			if (jQuery(this).parent().next('ul').is(':hidden')) {

				jQuery(this).parent().next('ul').slideDown(500, 'linear');
				jQuery(this).html('<i class="fa fa-minus"></i>');
			}
			else
			{
				jQuery(this).parent().next('ul').slideUp(500, 'linear');
				jQuery(this).html('<i class="fa fa-plus"></i>');
			}
		});
		/* Load Cate data */
		var loadding = false;
		$(".cate_btn_load_more").live('click', function(e){
			/** Prevent Default Behaviour */
	        e.preventDefault();
			if (!loadding) {
				loadding = true;
				var $this = $(this);
				var off = $(this).attr("data-off");
	            var offset = $(this).attr("data-offset");
	            var column = $(this).attr("data-column");
            	var ajax_url = $(this).attr("data-ajax_url");
     			
     			$(this).find(".dots").addClass('animated');

				$.ajax({
		            type: "POST",
		            url: ajax_url,
		            data: ({ action:'cate_paging', offset:offset, off:off, column:column}),
		        }).done(function(data) {
		        	loadding = false;
		        	$(this).find(".dots").removeClass('animated');

		        	var parent = $this.parent().parent();
		        	$this.parent().remove();
		            parent.append(data['data']);
		        });
			}
		});
		jQuery(window).load(function () {
			if (jQuery().waypoint) {
				jQuery('.counter-box').waypoint(function () {
					jQuery(this).find('.display-percentage').each(function () {
						var percentage = jQuery(this).data('percentage');
						jQuery(this).countTo({from: 0, to: percentage, refreshInterval: 10, speed: 1000});
					});
				}, {
					triggerOnce: true,
					offset     : 'bottom-in-view'
				});
			}

			if (jQuery().waypoint) {
				jQuery('.aloxo_animated ul.products').waypoint(function () {
					jQuery(function ($) {
						$('.aloxo_animated ul.products .product_animated:not(".umScaleIn")').each(function (i) {
							var el = $(this);
							setTimeout(function () {
								el.addClass('umScaleIn');
							}, i * 300);
						});
					});
				}, {
					triggerOnce: true,
					offset     : '100%'
				});
			}
			generateCarousel();
			rebindSilde();
		});
		/* mailchim */
		if (jQuery(".mc4wp-form").length > 0) {
			jQuery(".mc4wp-form").prev("p").css({"display":"none"});
		}
		
		// Parallax background
		$('.parallax_effect').each(function(){
			var $bgobj = $(this); // assigning the object

			$(window).scroll(function() {
				var yPos = -($(window).scrollTop() / 4);
				var coords = '50%'+ (yPos + 0) + 'px';
				$bgobj.css({ backgroundPosition: coords });
			}); // window scroll Ends
		});

		jQuery('#page').click(function () {
			jQuery('.slider_sidebar').removeClass('opened');
			jQuery('.menu-mobile').removeClass('opened');
			jQuery('html,body').removeClass('menu-opened');
			jQuery('html,body').removeClass('slider-bar-opened');
		});
		jQuery(document).keyup(function(e){
		 	if(e.keyCode === 27){
				jQuery('.slider_sidebar').removeClass('opened');
				jQuery('html,body').removeClass('slider-bar-opened');
				jQuery('html,body').removeClass('menu-opened');
			}
		});

		jQuery('[data-toggle=offcanvas]').click(function (e) {
			e.stopPropagation();
		 	 jQuery('.menu-mobile').toggleClass('opened');
			 jQuery('html,body').toggleClass('menu-opened');
		});

		/********************************
		 Menu Sidebar
		********************************/
		jQuery('.sliderbar-menu-controller').click(function (e) {
			e.stopPropagation();
			jQuery('.slider_sidebar').toggleClass('opened');
			jQuery('html,body').toggleClass('slider-bar-opened');
		});

		/********************onepage *********************/
		var adminbar_height = jQuery("#wpadminbar").height();
		var sticky_height = 50;
		jQuery('.navbar-nav li a').click(function(e) {
			var menu_anchor = jQuery(this).attr('href');
			if( menu_anchor &&
				menu_anchor.indexOf("#") == 0 &&
				menu_anchor.length > 1
				) {
				e.preventDefault();
				$('html,body').animate({
					scrollTop:jQuery(menu_anchor).offset().top - adminbar_height - sticky_height
				}, 850);
	 		}
		});
		/* Search Ajax */
	
		/* End Search Ajax*/
		$(".chosen-select").chosen({ width: '100%' });

		init_tabs();
		/* shortcode countdown */
		//init_countdown();

		/* shortcode message box */
		// Dismiss button for message box
		$(".wpb_alert a.close").live('click', function(){
			$(this).closest(".wpb_alert").fadeOut();
		});

		/* go to id */
		jQuery('a.goto').click(function(){
	    	if (jQuery(this).attr('href').charAt(0)=="#"){
	    		jQuery('html, body').animate({
			        scrollTop: jQuery( jQuery(this).attr('href') ).offset().top
			    }, 500);
			    return false;	
	    	}
		});
		
		/* Icon Box */
		$(".wapper_box_icon").each(function () {
			var $this = jQuery(this);
			if ($this.attr("data-icon")) {
				var $color_icon = jQuery(".boxes_icon i",$this).css('color');
				var $color_icon_change = $this.attr("data-icon");
			}
			if ($this.attr("data-icon-border")) {
				var $color_icon_border = jQuery(".boxes_icon",$this).css('border-color');
				var $color_icon_border_change = $this.attr("data-icon-border");
			}

			if ($this.attr("data-icon-bg")) {
				var $color_bg = jQuery(".boxes_icon",$this).css('background-color');
				var $color_bg_change = $this.attr("data-icon-bg");
			}
			if ($this.attr("data-btn-bg")) {
				var $color_btn_bg = jQuery(".smicon-read",$this).css('background-color');
				var $color_btn_bg_change = $this.attr("data-btn-bg");

				jQuery(".smicon-read",$this).hover(
					function() {
						/* for select style*/
						if (jQuery("#style_selector_container").length > 0) {
							if (jQuery(".smicon-read",$this).css("background-color") != $color_btn_bg)
								$color_btn_bg = jQuery(".smicon-read",$this).css('background-color');
						}

						jQuery(".smicon-read",$this).css({'background-color':$color_btn_bg_change});
					}, function() {
						jQuery(".smicon-read",$this).css({'background-color':$color_btn_bg});
				  	}
				);	
			}

			$this.hover(
				function() {
					if ($this.attr("data-icon")) {
						jQuery(".boxes_icon i",$this).css({'color':$color_icon_change});
					}
					if ($this.attr("data-icon-bg")) {
						/* for select style*/
						if (jQuery("#style_selector_container").length > 0) {
							if (jQuery(".boxes_icon",$this).css("background-color") != $color_bg)
								$color_bg = jQuery(".boxes_icon",$this).css('background-color');
						}
						
			    		jQuery(".boxes_icon",$this).css({'background-color':$color_bg_change});
			    	}
			    	if ($this.attr("data-icon-border")) {
			    		jQuery(".boxes_icon",$this).css({'border-color':$color_icon_border_change});
					}
				}, function() {
					if ($this.attr("data-icon")) {
						jQuery(".boxes_icon i",$this).css({'color':$color_icon});
					}
			    	if ($this.attr("data-icon-bg")) {
			    		jQuery(".boxes_icon",$this).css({'background-color':$color_bg});
			    	}
			    	if ($this.attr("data-icon-border")) {
			    		jQuery(".boxes_icon",$this).css({'border-color':$color_icon_border});
					}
			  	}
			);
		});
		/* End Icon Box */

		/* Load Posts data */
		var loadding = false;
		$(".blog_btn_load_more a").live('click', function(e){
			/** Prevent Default Behaviour */
	        e.preventDefault();
			if (!loadding) {
				loadding = true;
				var $this = $(this);
	            var offset = $(this).attr("data-offset");
            	var cat = $(this).attr("data-cat");
            	var type = $(this).attr("data-type");
            	var size = $(this).attr("data-size");
            	var ajax_url = $(this).attr("data-ajax_url");
            	$this.html('Loading<span class="one">.</span><span class="two">.</span><span class="three">.</span>');

				$.ajax({
		            type: "POST",
		            url: ajax_url,
		            data: ({ action:'button_paging', offset:offset, cat:cat, type:type, size:size})
		        }).done(function(data) {
		        	loadding = false;
		        	var parent = $this.parent();

		            $this.attr("data-offset",parseInt($this.attr( 'data-offset' ))+parseInt(data['offset']));
		            if (!data['next_post']) {
		            	$this.remove();
		            }else {
		            	$this.html('Load More');	
		            }
		            if ( parent.prev().hasClass("blog-masonry") ) {
		            	parent.prev().isotope( 'insert', $(data['data']) );
						post_audio();
						post_gallery();
						parent.prev().imagesLoaded(function () {
							parent.prev().isotope( 'layout' );
						});
		            }else {
		            	parent.prev().append(data['data']);
		            }
		        });
			}
		});
		
		/* Single Product Image */
		$(document).ready(function() {
			if($("#product-image").length && jQuery().owlCarousel) {
				$("#product-image").imagesLoaded(function () {
					var $em = $("#product-image");
				    $em.owlCarousel({
				    	navigation : true,
				    	navigationText: [
					    	'<i class="fa fa-angle-left"></i>',
					    	'<i class="fa fa-angle-right"></i>'
				    	],
				    	pagination:false,
				    	singleItem : true
				    	
					    ,afterUpdate: afterResize
					    ,afterInit : attachEvent
					    ,afterMove: aAction
				    });
				    if (jQuery().retina) {
				   		$(".retina").retina({preload: true});
				   	}
				});
			}
		});
	    function aAction (elem) {
	    	if (jQuery().retina) {
	    		$(".retina").retina({preload: true});
	    	}
	        var clickIndex = this.currentItem;
	        $(elem).parent().find(".thumbnails .thumb-wrapper-outer .item").removeClass('active');
	               
	        $(elem).parent().find(".thumbnails .thumb-wrapper-outer .item").eq(clickIndex).addClass('active');
	    }

	    function afterResize(elem){
	        var direct = "left";

	        if ( $(".thumbnails").offset().top != $(elem).offset().top ) {
	        	direct = "left";

	            $(elem).parent().find(".thumbnails").height($(elem).parent().find(".thumbnails .thumb-wrapper-outer img").height());

	            $(elem).parent().find(".thumbnails .thumb-wrapper-outer").width(5000);

	            var x = $(elem).parent().find(".thumbnails").offset().left + $(elem).parent().find(".thumbnails").width();
	            var y = $(elem).parent().find(".thumbnails .item").last().offset().left + $(elem).parent().find(".thumbnails .item").last().width();
                if ( y > x) {
                    $(elem).parent().addClass("has-nav");
                }else $(elem).parent().removeClass("has-nav");

	            $(elem).parent().addClass("horizontal");
	            $(elem).parent().removeClass("vertical");
	        }else {
	            direct = "top";

	            $(elem).parent().removeClass("horizontal");
	            $(elem).parent().addClass("vertical");

	            $(elem).parent().find(".thumbnails").height("auto");
	            $(elem).parent().find(".thumbnails .thumb-wrapper-outer").width("auto");

	            if ($(elem).parent().find(".thumbnails .thumb-wrapper-outer").height() > $(elem).find(".item img").height()) {
	                $(elem).parent().addClass("has-nav");
	            }else {
	                $(elem).parent().removeClass("has-nav");
	            }
	            $(elem).parent().find(".thumbnails").height($(elem).find(".item img").height());
	        }

	        var click = 0;
	        var isThumbNavClick = false;
	        $(elem).parent().find(".thumbnails .thumb-wrapper-outer").css({left: "auto"});
	        $(elem).parent().find(".thumbnails .thumb-wrapper-outer").css({top: "auto"});
	        var osLastStore = 0;
	        $(elem).parent().find(".thumbnails span").unbind('click');
	        $(elem).parent().find(".thumbnails span").click(function(e){
	        	e.preventDefault();
	            if (!isThumbNavClick) {
	                isThumbNavClick = true;

	                if ( $(".thumbnails").offset().top != $(elem).offset().top ) {
	        			direct = "left";
	        		}else direct = "top";

	                if (direct =="top") {
	                    var sliderImageHeight = parseFloat($(elem).parent().find(".thumbnails .item").eq(0).height());

	                    var osLast = $(elem).parent().find(".thumbnails .item").last().offset().top + $(elem).parent().find(".thumbnails .item").last().height();
	                    if (!osLastStore){
	                        osLastStore = osLast;
	                    }
	                    var osFirst = $(elem).parent().find(".thumbnails .item").first().offset().top + $(elem).parent().find(".thumbnails .item").first().height();

	                    var osParent = $(elem).parent().find(".thumbnails").offset().top + $(elem).parent().find(".thumbnails").height();

	                    if ($(this).attr("class") == "nav-next") {
	                        if (osLast <= osParent ) {
	                            isThumbNavClick=false;
	                            return;
	                        }
	                        click = click - sliderImageHeight;                        if ($(elem).parent().find(".thumbnails .item").last().offset().top < osParent ) {
	                            click = -(osLastStore - osParent);
	                        }
	                    }else {
	                        if ($(elem).parent().find(".thumbnails .item").first().offset().top >= $(elem).parent().find(".thumbnails").offset().top) {
	                            isThumbNavClick=false;
	                            return;
	                        }
	                        click = click + sliderImageHeight;
	                        if (click > 0) {
	                            click = 0;
	                        }

	                    }
	                }else {
	                    var sliderImageHeight = parseFloat($(elem).parent().find(".thumbnails .item").eq(0).width());
	                    var osLast = $(elem).parent().find(".thumbnails .item").last().offset().left - $(elem).parent().find(".thumbnails").offset().left + $(elem).parent().find(".thumbnails .item").last().width();
	                    if (!osLastStore){
	                        osLastStore = osLast;
	                    }
	                     var osFirst = $(elem).parent().find(".thumbnails .item").first().offset().left - $(elem).parent().find(".thumbnails").offset().left + $(elem).parent().find(".thumbnails .item").first().width();
	                    var osParent = $(elem).parent().find(".thumbnails").offset().left + $(elem).parent().find(".thumbnails").width();

	                    if ($(this).attr("class") == "nav-next") {
	                        if (osLast <= osParent ) {
	                            isThumbNavClick=false;
	                            return;
	                        }
	                        click = click - sliderImageHeight;
	                        if ($(elem).parent().find(".thumbnails .item").last().offset().left < osParent) {
	                            click = -(osLastStore - $(elem).parent().find(".thumbnails").width());
	                        }
	                    }else {
	                        if ($(elem).parent().find(".thumbnails .item").first().offset().left >= $(elem).parent().find(".thumbnails").offset().left ) {
	                            isThumbNavClick=false;
	                            return;
	                        }
	                        click = click + sliderImageHeight;
	                        if (click > 0) {
	                            click = 0;
	                        }
	                    }
	                }
	                var arg = {};
	                arg[direct] = click;

	                $(elem).parent().find(".thumbnails .thumb-wrapper-outer").animate(arg, 200, function() {
	                    isThumbNavClick=false;
	                });  
	            }
	        });
	    }
	    function attachEvent(elem){
	    	
	        var direct = "left";
	        if ( $(".thumbnails").offset().top != $(elem).offset().top ) {
	            $(elem).parent().find(".thumbnails").height($(elem).parent().find(".thumbnails .thumb-wrapper-outer img").height());

	            $(elem).parent().find(".thumbnails .thumb-wrapper-outer").width(5000);

	            var x = $(elem).parent().find(".thumbnails").offset().left + $(elem).parent().find(".thumbnails").width();
	            var y = $(elem).parent().find(".thumbnails .item").last().offset().left + $(elem).parent().find(".thumbnails .item").last().width();
                if ( y > x) {
                    $(elem).parent().addClass("has-nav");
                }

	            $(elem).parent().addClass("horizontal");
	        }else {
	            direct = "top";
	            $(elem).parent().addClass("vertical");
	            if ($(elem).parent().find(".thumbnails .thumb-wrapper-outer").height() > $(elem).find(".item img").height()) {
	                $(elem).parent().addClass("has-nav");
	            }else {
	                $(elem).parent().removeClass("has-nav");
	            }
	            $(elem).parent().find(".thumbnails").height($(elem).find(".item img").height());
	        }

	        $(elem).parent().find(".thumbnails .item").click(function () {
	            $(elem).trigger('owl.goTo', $(this).index());
	        });

	        $(elem).parent().find(".thumbnails .thumb-wrapper-outer .item").first().addClass("active");
	        /* Thumb Nav Transition */
	        var click = 0;
	        var isThumbNavClick = false;
	        $(elem).parent().find(".thumbnails .thumb-wrapper-outer").css({left: "auto"});
	        $(elem).parent().find(".thumbnails .thumb-wrapper-outer").css({top: "auto"});
	        var osLastStore = 0;
	        $(elem).parent().find(".thumbnails span").click(function(e){
	            if (!isThumbNavClick) {
	                isThumbNavClick = true;
	                if (direct =="top") {
	                    var sliderImageHeight = parseFloat($(elem).parent().find(".thumbnails .item").eq(0).height());

	                    var osLast = $(elem).parent().find(".thumbnails .item").last().offset().top + $(elem).parent().find(".thumbnails .item").last().height();
	                    if (!osLastStore){
	                        osLastStore = osLast;
	                    }
	                    var osFirst = $(elem).parent().find(".thumbnails .item").first().offset().top + $(elem).parent().find(".thumbnails .item").first().height();

	                    var osParent = $(elem).parent().find(".thumbnails").offset().top + $(elem).parent().find(".thumbnails").height();

	                    if ($(this).attr("class") == "nav-next") {
	                        if (osLast <= osParent ) {
	                            isThumbNavClick=false;
	                            return;
	                        }
	                        click = click - sliderImageHeight;
	                        if ($(elem).parent().find(".thumbnails .item").last().offset().top < osParent ) {
	                            click = -(osLastStore - osParent);
	                        }
	                    }else {
	                        if ($(elem).parent().find(".thumbnails .item").first().offset().top >= $(elem).parent().find(".thumbnails").offset().top) {
	                            isThumbNavClick=false;
	                            return;
	                        }
	                        click = click + sliderImageHeight;
	                        if (click > 0) {
	                            click = 0;
	                        }

	                    }
	                }else {
	                    var sliderImageHeight = parseFloat($(elem).parent().find(".thumbnails .item").eq(0).width());
	                    var osLast = $(elem).parent().find(".thumbnails .item").last().offset().left - $(elem).parent().find(".thumbnails").offset().left + $(elem).parent().find(".thumbnails .item").last().width();
	                    if (!osLastStore){
	                        osLastStore = osLast;
	                    }
	                     var osFirst = $(elem).parent().find(".thumbnails .item").first().offset().left - $(elem).parent().find(".thumbnails").offset().left + $(elem).parent().find(".thumbnails .item").first().width();
	                    var osParent = $(elem).parent().find(".thumbnails").offset().left + $(elem).parent().find(".thumbnails").width();

	                    if ($(this).attr("class") == "nav-next") {
	                        if (osLast <= osParent ) {
	                            isThumbNavClick=false;
	                            return;
	                        }
	                        click = click - sliderImageHeight;
	                        if ($(elem).parent().find(".thumbnails .item").last().offset().left < osParent) {
	                            click = -(osLastStore - $(elem).parent().find(".thumbnails").width());
	                        }
	                    }else {
	                        if ($(elem).parent().find(".thumbnails .item").first().offset().left >= $(elem).parent().find(".thumbnails").offset().left ) {
	                            isThumbNavClick=false;
	                            return;
	                        }
	                        click = click + sliderImageHeight;
	                        if (click > 0) {
	                            click = 0;
	                        }
	                    }
	                }
	                var arg = {};
	                arg[direct] = click;

	                $(elem).parent().find(".thumbnails .thumb-wrapper-outer").animate(arg, 200, function() {
	                    isThumbNavClick=false;
	                });  
	            }
	        });
	    }
    	/* End Single Product Image*/
    	

    	/*Ajax search*/
    	jQuery(document).click(function () {
			jQuery('.main-nav-search-form').hide();
			jQuery('.main-header-search-form-input').hide();
			jQuery('.header .row').removeClass('relative');
			jQuery('.navigation .sm-logo,.navigation .table_right').css({'opacity': 1});
		});

		jQuery('.header-search-close').click(function () {
			jQuery('.main-header-search-form-input').hide();
			jQuery('.navigation .sm-logo,.navigation .table_right').css({'opacity': 1});
		});

		jQuery('.main-nav-search-form').click(function (e) {
			e.stopPropagation();
		});
		jQuery('.main-header-search-form-input').click(function (e) {
			e.stopPropagation();
		});


    	jQuery('.main-nav-search .search-link').click(function (e) {
			e.stopPropagation();
			if (jQuery('.main-nav-search-form').css('display') == 'block') {
				jQuery('.main-nav-search-form').hide();
			} else {
				jQuery('.main-nav-search-form').stop(true, true).slideDown(250);
				jQuery('.navbar-nav #s').focus();
			}
		});

		jQuery('.widget-smartsearch').click(function (e) {
			e.preventDefault();
			e.stopPropagation();
			if (jQuery('.main-header-search-form-input').css('display') == 'block') {
				jQuery('.main-header-search-form-input').hide();
			} else {
				jQuery('.main-header-search-form-input').stop(true, true).fadeIn(400);
				jQuery('#header-search-form-input #s').focus();
				jQuery('.navigation .sm-logo,.navigation .table_right').css({'opacity': 0});
			}
		});
		jQuery(document).ready(function () {
			jQuery('.ob-search-input').on('keyup', function (event) {

				clearTimeout(jQuery.data(this, 'timer'));
				if (event.which == 13) {
					event.preventDefault();
					jQuery(this).stop();
				} else if (event.which == 38) {
					if (navigator.userAgent.indexOf('Chrome') != -1 && parseFloat(navigator.userAgent.substring(navigator.userAgent.indexOf('Chrome') + 7).split(' ')[0]) >= 15) {
						var selected = jQuery(".ob_selected");
						jQuery(".ob_list_search li").removeClass("ob_selected");

						// if there is no element before the selected one, we select the last one
						if (selected.prev().length == 0) {
							selected.siblings().last().addClass("ob_selected");
						} else { // otherwise we just select the next one
							selected.prev().addClass("ob_selected");
						}
					}
				} else if (event.which == 40) {
					if (navigator.userAgent.indexOf('Chrome') != -1 && parseFloat(navigator.userAgent.substring(navigator.userAgent.indexOf('Chrome') + 7).split(' ')[0]) >= 15) {
						var selected = jQuery(".ob_selected");
						jQuery(".ob_list_search li").removeClass("ob_selected");

						// if there is no element before the selected one, we select the last one
						if (selected.next().length == 0) {
							selected.siblings().first().addClass("ob_selected");
						} else { // otherwise we just select the next one
							selected.next().addClass("ob_selected");
						}
					}
				} else if (event.which == 27) {
					jQuery('.main-header-search-form-input').hide();
					jQuery('.navigation .sm-logo,.navigation .table_right').css({'opacity': 1});
					jQuery('.header-search-close').html('<i class="fa fa-times"></i>');
					jQuery('.ob_list_search').html('');
					jQuery(this).val('');
					jQuery(this).stop();
				} else {
					jQuery(this).data('timer', setTimeout(search, 1000));
				}
			});
			jQuery('.ob-search-input').on('keypress', function (event) {

				if (event.keyCode == 13) {
					var selected = jQuery(".ob_selected");
					if (selected.length > 0) {
						var ob_href = selected.find('a').first().attr('href');
						window.location.href = ob_href;
					}else {
						jQuery(this).parent().submit();	
					}
					event.preventDefault();
				}
				if (event.keyCode == 27) {
					jQuery('.main-header-search-form-input').hide();
					jQuery('.navigation .sm-logo,.navigation .table_right').css({'opacity': 1});
				}
				if (event.keyCode == 38) {
					var selected = jQuery(".ob_selected");
					jQuery(".ob_list_search li").removeClass("ob_selected");

					// if there is no element before the selected one, we select the last one
					if (selected.prev().length == 0) {
						selected.siblings().last().addClass("ob_selected");
					} else { // otherwise we just select the next one
						selected.prev().addClass("ob_selected");
					}
				}
				if (event.keyCode == 40) {
					var selected = jQuery(".ob_selected");
					jQuery(".ob_list_search li").removeClass("ob_selected");

					// if there is no element before the selected one, we select the last one
					if (selected.next().length == 0) {
						selected.siblings().first().addClass("ob_selected");
					} else { // otherwise we just select the next one
						selected.next().addClass("ob_selected");
					}
				}
			});
		});
		function search(waitKey) {
			var keyword = jQuery('.ob-search-input').val();

			if (keyword) {
				if (!waitKey && keyword.length < 3) {
					return;
				}
				jQuery('.header-search-close').html('<i class="fa fa-spinner fa-spin"></i>');
				jQuery.ajax({
					type   : 'POST',
					data   : 'action=result_search&keyword=' + keyword,
					url    : aloxo_ob_ajax_url,
					success: function (html) {
						var data_li = '';
						var items = jQuery.parseJSON(html);
						jQuery.each(items, function (index) {
							if (index == 0) {
								data_li += '<li class="ui-menu-item' + this['id'] + ' ob_selected"><a id="ui-id-' + this['id'] + '" class="ui-corner-all" href="' + this['guid'] + '"><i class="icon-page"></i><span class="search-title">' + this['title'] + '</span><span class="search-date">' + this['date'] + '</span></a></li>';
							} else {
								data_li += '<li class="ui-menu-item' + this['id'] + '"><a id="ui-id-' + this['id'] + '" class="ui-corner-all" href="' + this['guid'] + '"><i class="icon-page"></i><span class="search-title">' + this['title'] + '</span><span class="search-date">' + this['date'] + '</span></a></li>';
							}
						});
						jQuery('.ob_list_search').html('').append(data_li);
						jQuery('.header-search-close').html('<i class="fa fa-times"></i>');
					},
					error  : function (html) {
					}
				});
			}
		}

		/* Product Search */
		jQuery(document).ready(function () {
			jQuery(document).on('click','a.ps-selector', function(e) {
				e.preventDefault();
				e.stopPropagation();
				var $this = jQuery(this);
				$this.next("ul").slideToggle();
				return;
			});
			jQuery('.ps-option a').click(function (e) {
				e.preventDefault();
				jQuery('.ps-option a').removeClass("active");
				var $this = jQuery(this);
				$this.addClass("active");
				var cate = $this.text();
				$this.closest(".ps-option").prev('a').find("span").text(cate);
				$this.closest(".ps-option").hide();
				$this.closest(".ps-selector-container").next().find('input[name="product_cat"]').val($this.prop('rel'));
			});
			$('.ps-field').donetyping(function(){
				var $this = jQuery(this);
				var keyword = $this.val();

				if (keyword && keyword.length < 3) {
					return;
				}
				if (jQuery('.ps-option a.active').prop('rel'))
					var cate = jQuery('.ps-option a.active').prop('rel');
				else var cate = "-1";
				
				if ($this.closest(".product_search").hasClass("style-02")) {
					var $se = $this.parent().next().find("a");
				}else {
					var $se = $this.next();
				}
				$se.html('<i class="fa fa-spinner fa-spin fa-lg"></i>');

				$this.closest(".ps_container").addClass("searching");

				jQuery.ajax({
					type   : 'POST',
					data   : 'action=product_search&keyword=' + keyword+ '&cate='+cate,
					url    : aloxo_ob_ajax_url,
					success: function (html) {
						$this.closest(".ps_container").removeClass("searching");
						$se.html('<i class="fa fa-search fa-lg"></i>');

						var items = jQuery.parseJSON(html);
						var data_li = "";
						jQuery.each(items, function (index) {
							if (this['id'] != -1) {
								if (index == 0) {
									data_li += '<li class="ui-menu-item' + this['id'] + ' ob_selected"><a id="ui-id-' + this['id'] + '" class="ui-corner-all" href="' + this['url'] + '">'+this['thumb']+'<span class="search-title">' + this['value'] + '</span>'+this['rate']+this['price']+'</a></li>';
								} else {
									data_li += '<li class="ui-menu-item' + this['id'] + '"><a id="ui-id-' + this['id'] + '" class="ui-corner-all" href="' + this['url'] + '">'+this['thumb']+'<span class="search-title">' + this['value'] + '</span>'+this['rate']+this['price']+'</a></li>';
								}
							} else {
								data_li += '<li class="ui-menu-item' + this['id'] + '"><a id="ui-id-' + this['id'] + '" class="ui-corner-all" href="' + this['url'] + '">'+'<span class="search-title">' + this['value'] + '</span>'+'</a></li>';
							}
						});
						jQuery('.product_results').html('').append(data_li);
						jQuery('.product_results').show();
					},
					error  : function (html) {
						$this.closest(".ps_container").removeClass("searching");
						$se.html('<i class="fa fa-search fa-lg"></i>');
					}
				});
			});
			jQuery(document).mouseup(function (e) {
			    var container = jQuery(".ps-option");
			    var container1 = jQuery(".ps-selector");
			    var container2 = jQuery(".product_results");

			    if (!container.is(e.target) // if the target of the click isn't the container...
			        && container.has(e.target).length === 0 && !container1.is(e.target) && container1.has(e.target).length === 0) // ... nor a descendant of the container
			    {
			        jQuery('.ps-option').hide();
			    }
			    if (!container2.is(e.target) // if the target of the click isn't the container...
			        && container2.has(e.target).length === 0) {
			    	jQuery('.product_results').hide();
			    }
			});
		});
		/* End Product Search */
		//The click to hide function
	    $(".ps-option .icon-plus").click(function() {
	        if ($(this).hasClass("current") && $(this).parent().next().queue().length === 0) {
	            $(this).parent().next().slideUp();
	            $(this).html('<i class="fa fa-plus"></i>');
	            $(this).removeClass("current");
	        } else if (!$(this).hasClass("current") && $(this).parent().next().queue().length === 0) {
	            $(this).parent().next().slideDown();
	            $(this).html('<i class="fa fa-minus"></i>');
	            $(this).addClass("current");
	        }
	        var thisLi = $(this).parent().parent();
	        $(".ps-option li").each(function(){
	            if(!$(this).is(thisLi) && !$(this).find("li").is(thisLi)){
	                $(this).removeClass("current");
	            }
	        });
	    });
	});
 })(jQuery);