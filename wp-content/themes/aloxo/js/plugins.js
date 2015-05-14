/* CONTENT: 
 - vAlign (vertical align text)
 - Scroll to top
 - jRespond
 - jPanelMenu
 - hoverIntent
 - Waypoints
 - Packery http://packery.metafizzy.co
 - Tipr drop (tooltip)
 - Woocommerce Variations forms
 - Images loaded script
 - Parallax script
 */

;
(function ($) {

	/* -- vertical align text */
	(function ($) {
		$.fn.vAlign = function () {
			return this.each(function () {
				var d = $(this).outerHeight();
				$(this).css('margin-bottom', -d / 2);
			});
		};
	})($);


	/* SCROLL TO TOP */

	/**
	 * Copyright (c) 2007-2012 Ariel Flesler - aflesler(at)gmail(dot)com | http://flesler.blogspot.com
	 * Dual licensed under MIT and GPL.
	 * @author Ariel Flesler
	 * @version 1.4.3.1
	 */
	;
	(function ($) {
		var h = $.scrollTo = function (a, b, c) {
			$(window).scrollTo(a, b, c)
		};
		h.defaults = {axis: 'xy', duration: parseFloat($.fn.$) >= 1.3 ? 0 : 1, limit: true};
		h.window = function (a) {
			return $(window)._scrollable()
		};
		$.fn._scrollable = function () {
			return this.map(function () {
				var a = this, isWin = !a.nodeName || $.inArray(a.nodeName.toLowerCase(), ['iframe', '#document', 'html', 'body']) != -1;
				if (!isWin)return a;
				var b = (a.contentWindow || a).document || a.ownerDocument || a;
				return/webkit/i.test(navigator.userAgent) || b.compatMode == 'BackCompat' ? b.body : b.documentElement
			})
		};
		$.fn.scrollTo = function (e, f, g) {
			if (typeof f == 'object') {
				g = f;
				f = 0
			}
			if (typeof g == 'function')g = {onAfter: g};
			if (e == 'max')e = 9e9;
			g = $.extend({}, h.defaults, g);
			f = f || g.duration;
			g.queue = g.queue && g.axis.length > 1;
			if (g.queue)f /= 2;
			g.offset = both(g.offset);
			g.over = both(g.over);
			return this._scrollable().each(function () {
				if (e == null)return;
				var d = this, $elem = $(d), targ = e, toff, attr = {}, win = $elem.is('html,body');
				switch (typeof targ) {
					case'number':
					case'string':
						if (/^([+-]=)?\d+(\.\d+)?(px|%)?$/.test(targ)) {
							targ = both(targ);
							break
						}
						targ = $(targ, this);
						if (!targ.length)return;
					case'object':
						if (targ.is || targ.style)toff = (targ = $(targ)).offset()
				}
				$.each(g.axis.split(''), function (i, a) {
					var b = a == 'x' ? 'Left' : 'Top', pos = b.toLowerCase(), key = 'scroll' + b, old = d[key], max = h.max(d, a);
					if (toff) {
						attr[key] = toff[pos] + (win ? 0 : old - $elem.offset()[pos]);
						if (g.margin) {
							attr[key] -= parseInt(targ.css('margin' + b)) || 0;
							attr[key] -= parseInt(targ.css('border' + b + 'Width')) || 0
						}
						attr[key] += g.offset[pos] || 0;
						if (g.over[pos])attr[key] += targ[a == 'x' ? 'width' : 'height']() * g.over[pos]
					} else {
						var c = targ[pos];
						attr[key] = c.slice && c.slice(-1) == '%' ? parseFloat(c) / 100 * max : c
					}
					if (g.limit && /^\d+$/.test(attr[key]))attr[key] = attr[key] <= 0 ? 0 : Math.min(attr[key], max);
					if (!i && g.queue) {
						if (old != attr[key])animate(g.onAfterFirst);
						delete attr[key]
					}
				});
				animate(g.onAfter);
				function animate(a) {
					$elem.animate(attr, f, g.easing, a && function () {
						a.call(this, e, g)
					})
				}
			}).end()
		};
		h.max = function (a, b) {
			var c = b == 'x' ? 'Width' : 'Height', scroll = 'scroll' + c;
			if (!$(a).is('html,body'))return a[scroll] - $(a)[c.toLowerCase()]();
			var d = 'client' + c, html = a.ownerDocument.documentElement, body = a.ownerDocument.body;
			return Math.max(html[scroll], body[scroll]) - Math.min(html[d], body[d])
		};
		function both(a) {
			return typeof a == 'object' ? a : {top: a, left: a}
		}
	})($);
}(jQuery));


/*! jRespond.js v 0.10 | Author: Jeremy Fields [jeremy.fields@viget.com], 2013 | License: MIT */
(function (b, a, c) {
	b.jRespond = function (h) {
		var i = [];
		var n = [];
		var g = h;
		var t = "";
		var m = "";
		var d;
		var e = 0;
		var o = 100;
		var f = 500;
		var r = f;
		var k = function () {
			var v = 0;
			if (typeof(window.innerWidth) != "number") {
				if (!(document.documentElement.clientWidth === 0)) {
					v = document.documentElement.clientWidth
				} else {
					v = document.body.clientWidth
				}
			} else {
				v = window.innerWidth
			}
			return v
		};
		var j = function (w) {
			if (w.length === c) {
				u(w)
			} else {
				for (var v = 0; v < w.length; v++) {
					u(w[v])
				}
			}
		};
		var u = function (x) {
			var w = x.breakpoint;
			var v = x.enter || c;
			i.push(x);
			n.push(false);
			if (q(w)) {
				if (v !== c) {
					v.call(null, {entering: t, exiting: m})
				}
				n[(i.length - 1)] = true
			}
		};
		var s = function () {
			var A = [];
			var v = [];
			for (var C = 0; C < i.length; C++) {
				var D = i[C]["breakpoint"];
				var x = i[C]["enter"] || c;
				var w = i[C]["exit"] || c;
				if (D === "*") {
					if (x !== c) {
						A.push(x)
					}
					if (w !== c) {
						v.push(w)
					}
				} else {
					if (q(D)) {
						if (x !== c && !n[C]) {
							A.push(x)
						}
						n[C] = true
					} else {
						if (w !== c && n[C]) {
							v.push(w)
						}
						n[C] = false
					}
				}
			}
			var y = {entering: t, exiting: m};
			for (var B = 0; B < v.length; B++) {
				v[B].call(null, y)
			}
			for (var z = 0; z < A.length; z++) {
				A[z].call(null, y)
			}
		};
		var p = function (w) {
			var x = false;
			for (var v = 0; v < g.length; v++) {
				if (w >= g[v]["enter"] && w <= g[v]["exit"]) {
					x = true;
					break
				}
			}
			if (x && t !== g[v]["label"]) {
				m = t;
				t = g[v]["label"];
				s()
			} else {
				if (!x && t !== "") {
					t = "";
					s()
				}
			}
		};
		var q = function (v) {
			if (typeof v === "object") {
				if (v.join().indexOf(t) >= 0) {
					return true
				}
			} else {
				if (v === "*") {
					return true
				} else {
					if (typeof v === "string") {
						if (t === v) {
							return true
						}
					}
				}
			}
		};
		var l = function () {
			var v = k();
			if (v !== e) {
				r = o;
				p(v)
			} else {
				r = f
			}
			e = v;
			setTimeout(l, r)
		};
		l();
		return{addFunc  : function (v) {
			j(v)
		}, getBreakpoint: function () {
			return t
		}}
	}
}(this, this.document));


/**
 *
 * jPanelMenu 1.3.0 (http://jpanelmenu.com)
 * By Anthony Colangelo (http://acolangelo.com)
 *
 * */
(function (e) {
	e.jPanelMenu = function (t) {
		if (typeof t == "undefined" || t == null)t = {};
		var n = {options                : e.extend({menu: "#menu", trigger: ".menu-trigger", excludedPanelContent: "style, script", direction: "left", openPosition: "250px", animated: !0, closeOnContentClick: !0, keyboardShortcuts: [
			{code: 27, open: !1, close: !0},
			{code: 37, open: !1, close: !0},
			{code: 39, open: !0, close: !0},
			{code: 77, open: !0, close: !0}
		], duration                                     : 150, openDuration: t.duration || 150, closeDuration: t.duration || 150, easing: "ease-in-out", openEasing: t.easing || "ease-in-out", closeEasing: t.easing || "ease-in-out", before: function () {
		}, beforeOpen                                   : function () {
		}, beforeClose                                  : function () {
		}, after                                        : function () {
		}, afterOpen                                    : function () {
		}, afterClose                                   : function () {
		}, beforeOn                                     : function () {
		}, afterOn                                      : function () {
		}, beforeOff                                    : function () {
		}, afterOff                                     : function () {
		}}, t), settings                : {transitionsSupported: "WebkitTransition"in document.body.style || "MozTransition"in document.body.style || "msTransition"in document.body.style || "OTransition"in document.body.style || "Transition"in document.body.style, shiftFixedChildren: !1, panelPosition: "relative", positionUnits: "px"}, menu: "#jPanelMenu-menu", panel: ".jPanelMenu-panel", fixedChildren: [], timeouts: {}, clearTimeouts: function () {
			clearTimeout(n.timeouts.open);
			clearTimeout(n.timeouts.afterOpen);
			clearTimeout(n.timeouts.afterClose)
		}, setPositionUnits             : function () {
			var e = !1, t = ["%", "px", "em"];
			for (unitID in t) {
				var r = t[unitID];
				if (n.options.openPosition.toString().substr(-r.length) == r) {
					e = !0;
					n.settings.positionUnits = r
				}
			}
			e || (n.options.openPosition = parseInt(n.options.openPosition) + n.settings.positionUnits)
		}, checkFixedChildren           : function () {
			n.disableTransitions();
			var t = {position: e(n.panel).css("position")};
			t[n.options.direction] = e(n.panel).css(n.options.direction) == "auto" ? 0 : e(n.panel).css(n.options.direction);
			e(n.panel).find("> *").each(function () {
				e(this).css("position") == "fixed" && e(this).css(n.options.direction) == "auto" && n.fixedChildren.push(this)
			});
			if (n.fixedChildren.length > 0) {
				var r = {position: "relative"};
				r[n.options.direction] = "1px";
				n.setPanelStyle(r);
				parseInt(e(n.fixedChildren[0]).offset().left) == 0 && (n.settings.shiftFixedChildren = !0)
			}
			n.setPanelStyle(t)
		}, setjPanelMenuStyles          : function () {
			var t = "#fff", r = e("html").css("background-color"), i = e("body").css("background-color");
			i != "transparent" && i != "rgba(0, 0, 0, 0)" ? t = i : r != "transparent" && r != "rgba(0, 0, 0, 0)" ? t = r : t = "#fff";
			e("#jPanelMenu-style-master").length == 0 && e("body").append('<style id="jPanelMenu-style-master">body{width:100%}.jPanelMenu,body{overflow-x:hidden}#jPanelMenu-menu{display:block;position:fixed;top:0;' + n.options.direction + ":0;height:100%;z-index:-1;overflow-x:hidden;overflow-y:scroll;-webkit-overflow-scrolling:touch}.jPanelMenu-panel{position:static;" + n.options.direction + ":0;top:0;z-index:2;width:100%;min-height:100%;background:" + t + "}</style>")
		}, setMenuState                 : function (t) {
			var n = t ? "open" : "closed";
			e("body").attr("data-menu-position", n)
		}, getMenuState                 : function () {
			return e("body").attr("data-menu-position")
		}, menuIsOpen                   : function () {
			return n.getMenuState() == "open" ? !0 : !1
		}, setMenuStyle                 : function (t) {
			e(n.menu).css(t)
		}, setPanelStyle                : function (t) {
			e(n.panel).css(t)
		}, showMenu                     : function () {
			n.setMenuStyle({display: "block"});
			n.setMenuStyle({"z-index": "1"})
		}, hideMenu                     : function () {
			n.setMenuStyle({"z-index": "-1"});
			n.setMenuStyle({display: "none"})
		}, enableTransitions            : function (t, r) {
			var i = t / 1e3, s = n.getCSSEasingFunction(r);
			n.disableTransitions();
			e("body").append('<style id="jPanelMenu-style-transitions">.jPanelMenu-panel{-webkit-transition: all ' + i + "s " + s + "; -moz-transition: all " + i + "s " + s + "; -o-transition: all " + i + "s " + s + "; transition: all " + i + "s " + s + ";}</style>")
		}, disableTransitions           : function () {
			e("#jPanelMenu-style-transitions").remove()
		}, enableFixedTransitions       : function (t, r, i, s) {
			var o = i / 1e3, u = n.getCSSEasingFunction(s);
			n.disableFixedTransitions(r);
			e("body").append('<style id="jPanelMenu-style-fixed-' + r + '">' + t + "{-webkit-transition: all " + o + "s " + u + "; -moz-transition: all " + o + "s " + u + "; -o-transition: all " + o + "s " + u + "; transition: all " + o + "s " + u + ";}</style>")
		}, disableFixedTransitions      : function (t) {
			e("#jPanelMenu-style-fixed-" + t).remove()
		}, getCSSEasingFunction         : function (e) {
			switch (e) {
				case"linear":
					return e;
				case"ease":
					return e;
				case"ease-in":
					return e;
				case"ease-out":
					return e;
				case"ease-in-out":
					return e;
				default:
					return"ease-in-out"
			}
		}, getJSEasingFunction          : function (e) {
			switch (e) {
				case"linear":
					return e;
				default:
					return"swing"
			}
		}, openMenu                     : function (t) {
			if (typeof t == "undefined" || t == null)t = n.options.animated;
			n.clearTimeouts();
			n.options.before();
			n.options.beforeOpen();
			n.setMenuState(!0);
			n.setPanelStyle({position: "relative"});
			n.showMenu();
			var r = {none: t ? !1 : !0, transitions: t && n.settings.transitionsSupported ? !0 : !1};
			if (r.transitions || r.none) {
				r.none && n.disableTransitions();
				r.transitions && n.enableTransitions(n.options.openDuration, n.options.openEasing);
				var i = {};
				i[n.options.direction] = n.options.openPosition;
				n.setPanelStyle(i);
				n.settings.shiftFixedChildren && e(n.fixedChildren).each(function () {
					var t = e(this).prop("tagName").toLowerCase() + " " + e(this).attr("class"), i = t.replace(" ", "."), t = t.replace(" ", "-");
					r.none && n.disableFixedTransitions(t);
					r.transitions && n.enableFixedTransitions(i, t, n.options.openDuration, n.options.openEasing);
					var s = {};
					s[n.options.direction] = n.options.openPosition;
					e(this).css(s)
				});
				n.timeouts.afterOpen = setTimeout(function () {
					n.disableTransitions();
					n.settings.shiftFixedChildren && e(n.fixedChildren).each(function () {
						var t = e(this).prop("tagName").toLowerCase() + " " + e(this).attr("class"), t = t.replace(" ", "-");
						n.disableFixedTransitions(t)
					});
					n.options.after();
					n.options.afterOpen();
					n.initiateContentClickListeners()
				}, n.options.openDuration)
			} else {
				var s = n.getJSEasingFunction(n.options.openEasing), o = {};
				o[n.options.direction] = n.options.openPosition;
				e(n.panel).stop().animate(o, n.options.openDuration, s, function () {
					n.options.after();
					n.options.afterOpen();
					n.initiateContentClickListeners()
				});
				n.settings.shiftFixedChildren && e(n.fixedChildren).each(function () {
					var t = {};
					t[n.options.direction] = n.options.openPosition;
					e(this).stop().animate(t, n.options.openDuration, s)
				})
			}
		}, closeMenu                    : function (t) {
			if (typeof t == "undefined" || t == null)t = n.options.animated;
			n.clearTimeouts();
			n.options.before();
			n.options.beforeClose();
			n.setMenuState(!1);
			var r = {none: t ? !1 : !0, transitions: t && n.settings.transitionsSupported ? !0 : !1};
			if (r.transitions || r.none) {
				r.none && n.disableTransitions();
				r.transitions && n.enableTransitions(n.options.closeDuration, n.options.closeEasing);
				var i = {};
				i[n.options.direction] = 0 + n.settings.positionUnits;
				n.setPanelStyle(i);
				n.settings.shiftFixedChildren && e(n.fixedChildren).each(function () {
					var t = e(this).prop("tagName").toLowerCase() + " " + e(this).attr("class"), i = t.replace(" ", "."), t = t.replace(" ", "-");
					r.none && n.disableFixedTransitions(t);
					r.transitions && n.enableFixedTransitions(i, t, n.options.closeDuration, n.options.closeEasing);
					var s = {};
					s[n.options.direction] = 0 + n.settings.positionUnits;
					e(this).css(s)
				});
				n.timeouts.afterClose = setTimeout(function () {
					n.setPanelStyle({position: n.settings.panelPosition});
					n.disableTransitions();
					n.settings.shiftFixedChildren && e(n.fixedChildren).each(function () {
						var t = e(this).prop("tagName").toLowerCase() + " " + e(this).attr("class"), t = t.replace(" ", "-");
						n.disableFixedTransitions(t)
					});
					n.hideMenu();
					n.options.after();
					n.options.afterClose();
					n.destroyContentClickListeners()
				}, n.options.closeDuration)
			} else {
				var s = n.getJSEasingFunction(n.options.closeEasing), o = {};
				o[n.options.direction] = 0 + n.settings.positionUnits;
				e(n.panel).stop().animate(o, n.options.closeDuration, s, function () {
					n.setPanelStyle({position: n.settings.panelPosition});
					n.hideMenu();
					n.options.after();
					n.options.afterClose();
					n.destroyContentClickListeners()
				});
				n.settings.shiftFixedChildren && e(n.fixedChildren).each(function () {
					var t = {};
					t[n.options.direction] = 0 + n.settings.positionUnits;
					e(this).stop().animate(t, n.options.closeDuration, s)
				})
			}
		}, triggerMenu                  : function (e) {
			n.menuIsOpen() ? n.closeMenu(e) : n.openMenu(e)
		}, initiateClickListeners       : function () {
			e(document).on("click", n.options.trigger, function () {
				n.triggerMenu(n.options.animated);
				return!1
			})
		}, destroyClickListeners        : function () {
			e(document).off("click", n.options.trigger, null)
		}, initiateContentClickListeners: function () {
			if (!n.options.closeOnContentClick)return!1;
			e(document).on("click", n.panel, function (e) {
				n.menuIsOpen() && n.closeMenu(n.options.animated)
			});
			e(document).on("touchend", n.panel, function (e) {
				n.menuIsOpen() && n.closeMenu(n.options.animated)
			})
		}, destroyContentClickListeners : function () {
			if (!n.options.closeOnContentClick)return!1;
			e(document).off("click", n.panel, null);
			e(document).off("touchend", n.panel, null)
		}, initiateKeyboardListeners    : function () {
			var t = ["input", "textarea"];
			e(document).on("keydown", function (r) {
				var i = e(r.target), s = !1;
				e.each(t, function () {
					i.is(this.toString()) && (s = !0)
				});
				if (s)return!0;
				for (mapping in n.options.keyboardShortcuts)if (r.which == n.options.keyboardShortcuts[mapping].code) {
					var o = n.options.keyboardShortcuts[mapping];
					o.open && o.close ? n.triggerMenu(n.options.animated) : o.open && !o.close && !n.menuIsOpen() ? n.openMenu(n.options.animated) : !o.open && o.close && n.menuIsOpen() && n.closeMenu(n.options.animated);
					return!1
				}
			})
		}, destroyKeyboardListeners     : function () {
			e(document).off("keydown", null)
		}, setupMarkup                  : function () {
			e("html").addClass("jPanelMenu");
			e("body > *").not(n.menu + ", " + n.options.excludedPanelContent).wrapAll('<div class="' + n.panel.replace(".", "") + '"/>');
			e(n.options.menu).clone().attr("id", n.menu.replace("#", "")).insertAfter("body > " + n.panel)
		}, resetMarkup                  : function () {
			e("html").removeClass("jPanelMenu");
			e("body > " + n.panel + " > *").unwrap();
			e(n.menu).remove()
		}, init                         : function () {
			n.options.beforeOn();
			n.initiateClickListeners();
			Object.prototype.toString.call(n.options.keyboardShortcuts) === "[object Array]" && n.initiateKeyboardListeners();
			n.setjPanelMenuStyles();
			n.setMenuState(!1);
			n.setupMarkup();
			n.setMenuStyle({width: n.options.openPosition});
			n.checkFixedChildren();
			n.setPositionUnits();
			n.closeMenu(!1);
			n.options.afterOn()
		}, destroy                      : function () {
			n.options.beforeOff();
			n.closeMenu();
			n.destroyClickListeners();
			Object.prototype.toString.call(n.options.keyboardShortcuts) === "[object Array]" && n.destroyKeyboardListeners();
			n.resetMarkup();
			var t = {};
			t[n.options.direction] = "auto";
			e(n.fixedChildren).each(function () {
				e(this).css(t)
			});
			n.fixedChildren = [];
			n.options.afterOff()
		}};
		return{on: n.init, off: n.destroy, trigger: n.triggerMenu, open: n.openMenu, close: n.closeMenu, isOpen: n.menuIsOpen, menu: n.menu, getMenu: function () {
			return e(n.menu)
		}, panel : n.panel, getPanel: function () {
			return e(n.panel)
		}}
	}
})(jQuery);

/**
 * hoverIntent r7 // 2013.03.11 // jQuery 1.9.1+
 **/
(function ($) {
	$.fn.hoverIntent = function (handlerIn, handlerOut, selector) {

		// default configuration values
		var cfg = {
			interval   : 100,
			sensitivity: 20,
			timeout    : 200
		};

		if (typeof handlerIn === "object") {
			cfg = $.extend(cfg, handlerIn);
		} else if ($.isFunction(handlerOut)) {
			cfg = $.extend(cfg, { over: handlerIn, out: handlerOut, selector: selector });
		} else {
			cfg = $.extend(cfg, { over: handlerIn, out: handlerIn, selector: handlerOut });
		}

		// instantiate variables
		// cX, cY = current X and Y position of mouse, updated by mousemove event
		// pX, pY = previous X and Y position of mouse, set by mouseover and polling interval
		var cX, cY, pX, pY;

		// A private function for getting mouse position
		var track = function (ev) {
			cX = ev.pageX;
			cY = ev.pageY;
		};

		// A private function for comparing current and previous mouse position
		var compare = function (ev, ob) {
			ob.hoverIntent_t = clearTimeout(ob.hoverIntent_t);
			// compare mouse positions to see if they've crossed the threshold
			if (( Math.abs(pX - cX) + Math.abs(pY - cY) ) < cfg.sensitivity) {
				$(ob).off("mousemove.hoverIntent", track);
				// set hoverIntent state to true (so mouseOut can be called)
				ob.hoverIntent_s = 1;
				return cfg.over.apply(ob, [ev]);
			} else {
				// set previous coordinates for next time
				pX = cX;
				pY = cY;
				// use self-calling timeout, guarantees intervals are spaced out properly (avoids JavaScript timer bugs)
				ob.hoverIntent_t = setTimeout(function () {
					compare(ev, ob);
				}, cfg.interval);
			}
		};

		// A private function for delaying the mouseOut function
		var delay = function (ev, ob) {
			ob.hoverIntent_t = clearTimeout(ob.hoverIntent_t);
			ob.hoverIntent_s = 0;
			return cfg.out.apply(ob, [ev]);
		};

		// A private function for handling mouse 'hovering'
		var handleHover = function (e) {
			// copy objects to be passed into t (required for event object to be passed in IE)
			var ev = jQuery.extend({}, e);
			var ob = this;

			// cancel hoverIntent timer if it exists
			if (ob.hoverIntent_t) {
				ob.hoverIntent_t = clearTimeout(ob.hoverIntent_t);
			}

			// if e.type == "mouseenter"
			if (e.type == "mouseenter") {
				// set "previous" X and Y position based on initial entry point
				pX = ev.pageX;
				pY = ev.pageY;
				// update "current" X and Y position based on mousemove
				$(ob).on("mousemove.hoverIntent", track);
				// start polling interval (self-calling timeout) to compare mouse coordinates over time
				if (ob.hoverIntent_s != 1) {
					ob.hoverIntent_t = setTimeout(function () {
						compare(ev, ob);
					}, cfg.interval);
				}

				// else e.type == "mouseleave"
			} else {
				// unbind expensive mousemove event
				$(ob).off("mousemove.hoverIntent", track);
				// if hoverIntent state is true, then call the mouseOut function after the specified delay
				if (ob.hoverIntent_s == 1) {
					ob.hoverIntent_t = setTimeout(function () {
						delay(ev, ob);
					}, cfg.timeout);
				}
			}
		};

		// listen for mouseenter and mouseleave
		return this.on({'mouseenter.hoverIntent': handleHover, 'mouseleave.hoverIntent': handleHover}, cfg.selector);
	};
})(jQuery);


/*
 jQuery Waypoints - v2.0.3
 Copyright (c) 2011-2013 Caleb Troughton
 Dual licensed under the MIT license and GPL license.
 https://github.com/imakewebthings/jquery-waypoints/blob/master/licenses.txt
 */
(function () {
	var t = [].indexOf || function (t) {
		for (var e = 0, n = this.length; e < n; e++) {
			if (e in this && this[e] === t)return e
		}
		return-1
	}, e = [].slice;
	(function (t, e) {
		if (typeof define === "function" && define.amd) {
			return define("waypoints", ["jquery"], function (n) {
				return e(n, t)
			})
		} else {
			return e(t.jQuery, t)
		}
	})(this, function (n, r) {
		var i, o, l, s, f, u, a, c, h, d, p, y, v, w, g, m;
		i = n(r);
		c = t.call(r, "ontouchstart") >= 0;
		s = {horizontal: {}, vertical: {}};
		f = 1;
		a = {};
		u = "waypoints-context-id";
		p = "resize.waypoints";
		y = "scroll.waypoints";
		v = 1;
		w = "waypoints-waypoint-ids";
		g = "waypoint";
		m = "waypoints";
		o = function () {
			function t(t) {
				var e = this;
				this.$element = t;
				this.element = t[0];
				this.didResize = false;
				this.didScroll = false;
				this.id = "context" + f++;
				this.oldScroll = {x: t.scrollLeft(), y: t.scrollTop()};
				this.waypoints = {horizontal: {}, vertical: {}};
				t.data(u, this.id);
				a[this.id] = this;
				t.bind(y, function () {
					var t;
					if (!(e.didScroll || c)) {
						e.didScroll = true;
						t = function () {
							e.doScroll();
							return e.didScroll = false
						};
						return r.setTimeout(t, n[m].settings.scrollThrottle)
					}
				});
				t.bind(p, function () {
					var t;
					if (!e.didResize) {
						e.didResize = true;
						t = function () {
							n[m]("refresh");
							return e.didResize = false
						};
						return r.setTimeout(t, n[m].settings.resizeThrottle)
					}
				})
			}

			t.prototype.doScroll = function () {
				var t, e = this;
				t = {horizontal: {newScroll: this.$element.scrollLeft(), oldScroll: this.oldScroll.x, forward: "right", backward: "left"}, vertical: {newScroll: this.$element.scrollTop(), oldScroll: this.oldScroll.y, forward: "down", backward: "up"}};
				if (c && (!t.vertical.oldScroll || !t.vertical.newScroll)) {
					n[m]("refresh")
				}
				n.each(t, function (t, r) {
					var i, o, l;
					l = [];
					o = r.newScroll > r.oldScroll;
					i = o ? r.forward : r.backward;
					n.each(e.waypoints[t], function (t, e) {
						var n, i;
						if (r.oldScroll < (n = e.offset) && n <= r.newScroll) {
							return l.push(e)
						} else if (r.newScroll < (i = e.offset) && i <= r.oldScroll) {
							return l.push(e)
						}
					});
					l.sort(function (t, e) {
						return t.offset - e.offset
					});
					if (!o) {
						l.reverse()
					}
					return n.each(l, function (t, e) {
						if (e.options.continuous || t === l.length - 1) {
							return e.trigger([i])
						}
					})
				});
				return this.oldScroll = {x: t.horizontal.newScroll, y: t.vertical.newScroll}
			};
			t.prototype.refresh = function () {
				var t, e, r, i = this;
				r = n.isWindow(this.element);
				e = this.$element.offset();
				this.doScroll();
				t = {horizontal: {contextOffset: r ? 0 : e.left, contextScroll: r ? 0 : this.oldScroll.x, contextDimension: this.$element.width(), oldScroll: this.oldScroll.x, forward: "right", backward: "left", offsetProp: "left"}, vertical: {contextOffset: r ? 0 : e.top, contextScroll: r ? 0 : this.oldScroll.y, contextDimension: r ? n[m]("viewportHeight") : this.$element.height(), oldScroll: this.oldScroll.y, forward: "down", backward: "up", offsetProp: "top"}};
				return n.each(t, function (t, e) {
					return n.each(i.waypoints[t], function (t, r) {
						var i, o, l, s, f;
						i = r.options.offset;
						l = r.offset;
						o = n.isWindow(r.element) ? 0 : r.$element.offset()[e.offsetProp];
						if (n.isFunction(i)) {
							i = i.apply(r.element)
						} else if (typeof i === "string") {
							i = parseFloat(i);
							if (r.options.offset.indexOf("%") > -1) {
								i = Math.ceil(e.contextDimension * i / 100)
							}
						}
						r.offset = o - e.contextOffset + e.contextScroll - i;
						if (r.options.onlyOnScroll && l != null || !r.enabled) {
							return
						}
						if (l !== null && l < (s = e.oldScroll) && s <= r.offset) {
							return r.trigger([e.backward])
						} else if (l !== null && l > (f = e.oldScroll) && f >= r.offset) {
							return r.trigger([e.forward])
						} else if (l === null && e.oldScroll >= r.offset) {
							return r.trigger([e.forward])
						}
					})
				})
			};
			t.prototype.checkEmpty = function () {
				if (n.isEmptyObject(this.waypoints.horizontal) && n.isEmptyObject(this.waypoints.vertical)) {
					this.$element.unbind([p, y].join(" "));
					return delete a[this.id]
				}
			};
			return t
		}();
		l = function () {
			function t(t, e, r) {
				var i, o;
				r = n.extend({}, n.fn[g].defaults, r);
				if (r.offset === "bottom-in-view") {
					r.offset = function () {
						var t;
						t = n[m]("viewportHeight");
						if (!n.isWindow(e.element)) {
							t = e.$element.height()
						}
						return t - n(this).outerHeight()
					}
				}
				this.$element = t;
				this.element = t[0];
				this.axis = r.horizontal ? "horizontal" : "vertical";
				this.callback = r.handler;
				this.context = e;
				this.enabled = r.enabled;
				this.id = "waypoints" + v++;
				this.offset = null;
				this.options = r;
				e.waypoints[this.axis][this.id] = this;
				s[this.axis][this.id] = this;
				i = (o = t.data(w)) != null ? o : [];
				i.push(this.id);
				t.data(w, i)
			}

			t.prototype.trigger = function (t) {
				if (!this.enabled) {
					return
				}
				if (this.callback != null) {
					this.callback.apply(this.element, t)
				}
				if (this.options.triggerOnce) {
					return this.destroy()
				}
			};
			t.prototype.disable = function () {
				return this.enabled = false
			};
			t.prototype.enable = function () {
				this.context.refresh();
				return this.enabled = true
			};
			t.prototype.destroy = function () {
				delete s[this.axis][this.id];
				delete this.context.waypoints[this.axis][this.id];
				return this.context.checkEmpty()
			};
			t.getWaypointsByElement = function (t) {
				var e, r;
				r = n(t).data(w);
				if (!r) {
					return[]
				}
				e = n.extend({}, s.horizontal, s.vertical);
				return n.map(r, function (t) {
					return e[t]
				})
			};
			return t
		}();
		d = {init   : function (t, e) {
			var r;
			if (e == null) {
				e = {}
			}
			if ((r = e.handler) == null) {
				e.handler = t
			}
			this.each(function () {
				var t, r, i, s;
				t = n(this);
				i = (s = e.context) != null ? s : n.fn[g].defaults.context;
				if (!n.isWindow(i)) {
					i = t.closest(i)
				}
				i = n(i);
				r = a[i.data(u)];
				if (!r) {
					r = new o(i)
				}
				return new l(t, r, e)
			});
			n[m]("refresh");
			return this
		}, disable  : function () {
			return d._invoke(this, "disable")
		}, enable   : function () {
			return d._invoke(this, "enable")
		}, destroy  : function () {
			return d._invoke(this, "destroy")
		}, prev     : function (t, e) {
			return d._traverse.call(this, t, e, function (t, e, n) {
				if (e > 0) {
					return t.push(n[e - 1])
				}
			})
		}, next     : function (t, e) {
			return d._traverse.call(this, t, e, function (t, e, n) {
				if (e < n.length - 1) {
					return t.push(n[e + 1])
				}
			})
		}, _traverse: function (t, e, i) {
			var o, l;
			if (t == null) {
				t = "vertical"
			}
			if (e == null) {
				e = r
			}
			l = h.aggregate(e);
			o = [];
			this.each(function () {
				var e;
				e = n.inArray(this, l[t]);
				return i(o, e, l[t])
			});
			return this.pushStack(o)
		}, _invoke  : function (t, e) {
			t.each(function () {
				var t;
				t = l.getWaypointsByElement(this);
				return n.each(t, function (t, n) {
					n[e]();
					return true
				})
			});
			return this
		}};
		n.fn[g] = function () {
			var t, r;
			r = arguments[0], t = 2 <= arguments.length ? e.call(arguments, 1) : [];
			if (d[r]) {
				return d[r].apply(this, t)
			} else if (n.isFunction(r)) {
				return d.init.apply(this, arguments)
			} else if (n.isPlainObject(r)) {
				return d.init.apply(this, [null, r])
			} else if (!r) {
				return n.error("jQuery Waypoints needs a callback function or handler option.")
			} else {
				return n.error("The " + r + " method does not exist in jQuery Waypoints.")
			}
		};
		n.fn[g].defaults = {context: r, continuous: true, enabled: true, horizontal: false, offset: 0, triggerOnce: false};
		h = {refresh     : function () {
			return n.each(a, function (t, e) {
				return e.refresh()
			})
		}, viewportHeight: function () {
			var t;
			return(t = r.innerHeight) != null ? t : i.height()
		}, aggregate     : function (t) {
			var e, r, i;
			e = s;
			if (t) {
				e = (i = a[n(t).data(u)]) != null ? i.waypoints : void 0
			}
			if (!e) {
				return[]
			}
			r = {horizontal: [], vertical: []};
			n.each(r, function (t, i) {
				n.each(e[t], function (t, e) {
					return i.push(e)
				});
				i.sort(function (t, e) {
					return t.offset - e.offset
				});
				r[t] = n.map(i, function (t) {
					return t.element
				});
				return r[t] = n.unique(r[t])
			});
			return r
		}, above         : function (t) {
			if (t == null) {
				t = r
			}
			return h._filter(t, "vertical", function (t, e) {
				return e.offset <= t.oldScroll.y
			})
		}, below         : function (t) {
			if (t == null) {
				t = r
			}
			return h._filter(t, "vertical", function (t, e) {
				return e.offset > t.oldScroll.y
			})
		}, left          : function (t) {
			if (t == null) {
				t = r
			}
			return h._filter(t, "horizontal", function (t, e) {
				return e.offset <= t.oldScroll.x
			})
		}, right         : function (t) {
			if (t == null) {
				t = r
			}
			return h._filter(t, "horizontal", function (t, e) {
				return e.offset > t.oldScroll.x
			})
		}, enable        : function () {
			return h._invoke("enable")
		}, disable       : function () {
			return h._invoke("disable")
		}, destroy       : function () {
			return h._invoke("destroy")
		}, extendFn      : function (t, e) {
			return d[t] = e
		}, _invoke       : function (t) {
			var e;
			e = n.extend({}, s.vertical, s.horizontal);
			return n.each(e, function (e, n) {
				n[t]();
				return true
			})
		}, _filter       : function (t, e, r) {
			var i, o;
			i = a[n(t).data(u)];
			if (!i) {
				return[]
			}
			o = [];
			n.each(i.waypoints[e], function (t, e) {
				if (r(i, e)) {
					return o.push(e)
				}
			});
			o.sort(function (t, e) {
				return t.offset - e.offset
			});
			return n.map(o, function (t) {
				return t.element
			})
		}};
		n[m] = function () {
			var t, n;
			n = arguments[0], t = 2 <= arguments.length ? e.call(arguments, 1) : [];
			if (h[n]) {
				return h[n].apply(null, t)
			} else {
				return h.aggregate.call(null, n)
			}
		};
		n[m].settings = {resizeThrottle: 100, scrollThrottle: 30};
		return i.load(function () {
			return n[m]("refresh")
		})
	})
}).call(this);

/*
 Sticky Elements Shortcut for jQuery Waypoints - v2.0.3
 Copyright (c) 2011-2013 Caleb Troughton
 Dual licensed under the MIT license and GPL license.
 https://github.com/imakewebthings/jquery-waypoints/blob/master/licenses.txt
 */
(function () {
	(function (t, n) {
		if (typeof define === "function" && define.amd) {
			return define(["jquery", "waypoints"], n)
		} else {
			return n(t.jQuery)
		}
	})(this, function (t) {
		var n, s;
		n = {wrapper: '<div class="sticky-wrapper" />', stuckClass: "stuck"};
		s = function (t, n) {
			t.wrap(n.wrapper);
			return t.parent()
		};
		t.waypoints("extendFn", "sticky", function (e) {
			var i, r, a;
			r = t.extend({}, t.fn.waypoint.defaults, n, e);
			i = s(this, r);
			a = r.handler;
			r.handler = function (n) {
				var s, e;
				s = t(this).children(":first");
				e = n === "down" || n === "right";
				s.toggleClass(r.stuckClass, e);
				i.height(e ? s.outerHeight() : "");
				if (a != null) {
					return a.call(this, n)
				}
			};
			i.waypoint(r);
			return this.data("stuckClass", r.stuckClass)
		});
		return t.waypoints("extendFn", "unsticky", function () {
			this.parent().waypoint("destroy");
			this.unwrap();
			return this.removeClass(this.data("stuckClass"))
		})
	})
}).call(this);


/*!
 * Packery PACKAGED v1.0.2
 * bin-packing layout library
 * http://packery.metafizzy.co
 *
 * Commercial use requires one-time purchase of a commercial license
 * http://packery.metafizzy.co/license.html
 *
 * Non-commercial use is licensed under the MIT License
 *
 * Copyright 2013 Metafizzy
 */

(function (t) {
	"use strict";
	function e(t) {
		return RegExp("(^|\\s+)" + t + "(\\s+|$)")
	}

	function i(t, e) {
		var i = n(t, e) ? r : o;
		i(t, e)
	}

	var n, o, r;
	"classList"in document.documentElement ? (n = function (t, e) {
		return t.classList.contains(e)
	}, o = function (t, e) {
		t.classList.add(e)
	}, r = function (t, e) {
		t.classList.remove(e)
	}) : (n = function (t, i) {
		return e(i).test(t.className)
	}, o = function (t, e) {
		n(t, e) || (t.className = t.className + " " + e)
	}, r = function (t, i) {
		t.className = t.className.replace(e(i), " ")
	}), t.classie = {hasClass: n, addClass: o, removeClass: r, toggleClass: i, has: n, add: o, remove: r, toggle: i}
})(window), function (t) {
	"use strict";
	function e() {
	}

	function i(t, e) {
		if (o)return e.indexOf(t);
		for (var i = e.length; i--;)if (e[i] === t)return i;
		return-1
	}

	var n = e.prototype, o = Array.prototype.indexOf ? !0 : !1;
	n._getEvents = function () {
		return this._events || (this._events = {})
	}, n.getListeners = function (t) {
		var e = this._getEvents();
		return e[t] || (e[t] = [])
	}, n.addListener = function (t, e) {
		var n = this.getListeners(t);
		return-1 === i(e, n) && n.push(e), this
	}, n.on = n.addListener, n.removeListener = function (t, e) {
		var n = this.getListeners(t), o = i(e, n);
		return-1 !== o && (n.splice(o, 1), 0 === n.length && this.removeEvent(t)), this
	}, n.off = n.removeListener, n.addListeners = function (t, e) {
		return this.manipulateListeners(!1, t, e)
	}, n.removeListeners = function (t, e) {
		return this.manipulateListeners(!0, t, e)
	}, n.manipulateListeners = function (t, e, i) {
		var n, o, r = t ? this.removeListener : this.addListener, s = t ? this.removeListeners : this.addListeners;
		if ("object" == typeof e)for (n in e)e.hasOwnProperty(n) && (o = e[n]) && ("function" == typeof o ? r.call(this, n, o) : s.call(this, n, o)); else for (n = i.length; n--;)r.call(this, e, i[n]);
		return this
	}, n.removeEvent = function (t) {
		return t ? delete this._getEvents()[t] : delete this._events, this
	}, n.emitEvent = function (t, e) {
		for (var i, n = this.getListeners(t), o = n.length; o--;)i = e ? n[o].apply(null, e) : n[o](), i === !0 && this.removeListener(t, n[o]);
		return this
	}, n.trigger = n.emitEvent, n.emit = function (t) {
		var e = Array.prototype.slice.call(arguments, 1);
		return this.emitEvent(t, e)
	}, "function" == typeof define && define.amd ? define(function () {
		return e
	}) : t.EventEmitter = e
}(this), function (t) {
	"use strict";
	var e = document.documentElement, i = function () {
	};
	e.addEventListener ? i = function (t, e, i) {
		t.addEventListener(e, i, !1)
	} : e.attachEvent && (i = function (e, i, n) {
		e[i + n] = n.handleEvent ? function () {
			var e = t.event;
			e.target = e.target || e.srcElement, n.handleEvent.call(n, e)
		} : function () {
			var i = t.event;
			i.target = i.target || i.srcElement, n.call(e, i)
		}, e.attachEvent("on" + i, e[i + n])
	});
	var n = function () {
	};
	e.removeEventListener ? n = function (t, e, i) {
		t.removeEventListener(e, i, !1)
	} : e.detachEvent && (n = function (t, e, i) {
		t.detachEvent("on" + e, t[e + i]), delete t[e + i]
	});
	var o = {bind: i, unbind: n};
	"function" == typeof define && define.amd ? define(o) : t.eventie = o
}(this), function (t) {
	"use strict";
	function e(t) {
		e.isReady ? t() : e.on("ready", t)
	}

	function i(t) {
		var i = "readystatechange" === t.type && "complete" !== r.readyState;
		e.isReady || i || (e.isReady = !0, e.emit("ready", t))
	}

	var n = t.EventEmitter, o = t.eventie, r = t.document;
	e.isReady = !1;
	for (var s in n.prototype)e[s] = n.prototype[s];
	o.bind(r, "DOMContentLoaded", i), o.bind(r, "readystatechange", i), o.bind(t, "load", i), t.docReady = e
}(this), function (t) {
	"use strict";
	function e(t) {
		if (t) {
			if ("string" == typeof n[t])return t;
			t = t.charAt(0).toUpperCase() + t.slice(1);
			for (var e, o = 0, r = i.length; r > o; o++)if (e = i[o] + t, "string" == typeof n[e])return e
		}
	}

	var i = "Webkit Moz ms Ms O".split(" "), n = document.documentElement.style;
	"function" == typeof define && define.amd ? define(function () {
		return e
	}) : t.getStyleProperty = e
}(window), function (t) {
	"use strict";
	function e(t) {
		var e = parseFloat(t), i = -1 === t.indexOf("%") && !isNaN(e);
		return i && e
	}

	function i() {
		for (var t = {width: 0, height: 0, innerWidth: 0, innerHeight: 0, outerWidth: 0, outerHeight: 0}, e = 0, i = s.length; i > e; e++) {
			var n = s[e];
			t[n] = 0
		}
		return t
	}

	function n(t) {
		function n(t) {
			if ("object" == typeof t && t.nodeType) {
				var n = r(t);
				if ("none" === n.display)return i();
				var h = {};
				h.width = t.offsetWidth, h.height = t.offsetHeight;
				for (var p = h.isBorderBox = !(!a || !n[a] || "border-box" !== n[a]), c = 0, u = s.length; u > c; c++) {
					var l = s[c], d = n[l], f = parseFloat(d);
					h[l] = isNaN(f) ? 0 : f
				}
				var m = h.paddingLeft + h.paddingRight, y = h.paddingTop + h.paddingBottom, g = h.marginLeft + h.marginRight, v = h.marginTop + h.marginBottom, x = h.borderLeftWidth + h.borderRightWidth, E = h.borderTopWidth + h.borderBottomWidth, w = p && o, S = e(n.width);
				S !== !1 && (h.width = S + (w ? 0 : m + x));
				var T = e(n.height);
				return T !== !1 && (h.height = T + (w ? 0 : y + E)), h.innerWidth = h.width - (m + x), h.innerHeight = h.height - (y + E), h.outerWidth = h.width + g, h.outerHeight = h.height + v, h
			}
		}

		var o, a = t("boxSizing");
		return function () {
			if (a) {
				var t = document.createElement("div");
				t.style.width = "200px", t.style.padding = "1px 2px 3px 4px", t.style.borderStyle = "solid", t.style.borderWidth = "1px 2px 3px 4px", t.style[a] = "border-box";
				var i = document.body || document.documentElement;
				i.appendChild(t);
				var n = r(t);
				o = 200 === e(n.width), i.removeChild(t)
			}
		}(), n
	}

	var o = document.defaultView, r = o && o.getComputedStyle ? function (t) {
		return o.getComputedStyle(t, null)
	} : function (t) {
		return t.currentStyle
	}, s = ["paddingLeft", "paddingRight", "paddingTop", "paddingBottom", "marginLeft", "marginRight", "marginTop", "marginBottom", "borderLeftWidth", "borderRightWidth", "borderTopWidth", "borderBottomWidth"];
	"function" == typeof define && define.amd ? define(["get-style-property"], n) : t.getSize = n(t.getStyleProperty)
}(window), function (t, e) {
	"use strict";
	function i() {
	}

	function n(t) {
		t.prototype.option || (t.prototype.option = function (t) {
			e.isPlainObject(t) && (this.options = e.extend(!0, this.options, t))
		})
	}

	function o(t, i) {
		e.fn[t] = function (n) {
			if ("string" == typeof n) {
				for (var o = r.call(arguments, 1), a = 0, h = this.length; h > a; a++) {
					var p = this[a], c = e.data(p, t);
					if (c)if (e.isFunction(c[n]) && "_" !== n.charAt(0)) {
						var u = c[n].apply(c, o);
						if (void 0 !== u)return u
					} else s("no such method '" + n + "' for " + t + " instance"); else s("cannot call methods on " + t + " prior to initialization; " + "attempted to call '" + n + "'")
				}
				return this
			}
			return this.each(function () {
				var o = e.data(this, t);
				o ? (o.option(n), o._init()) : (o = new i(this, n), e.data(this, t, o))
			})
		}
	}

	if (e) {
		var r = Array.prototype.slice, s = "undefined" == typeof console ? i : function (t) {
			console.error(t)
		};
		e.bridget = function (t, e) {
			n(e), o(t, e)
		}
	}
}(window, window.jQuery), function (t, e) {
	"use strict";
	function i(t, e) {
		return t[a](e)
	}

	function n(t) {
		var e = document.createDocumentFragment();
		e.appendChild(t)
	}

	function o(t, e) {
		t.parentNode || n(t);
		for (var i = t.parentNode.querySelectorAll(e), o = 0, r = i.length; r > o; o++)if (i[o] === t)return!0;
		return!1
	}

	function r(t, e) {
		return t.parentNode || n(t), i(t, e)
	}

	var s, a = function () {
		for (var t = ["matchesSelector", "webkitMatchesSelector", "mozMatchesSelector", "msMatchesSelector", "oMatchesSelector"], i = 0, n = t.length; n > i; i++) {
			var o = t[i];
			if (e[o])return o
		}
	}();
	if (a) {
		var h = document.createElement("div"), p = i(h, "div");
		s = p ? i : r
	} else s = o;
	"function" == typeof define && define.amd ? define(function () {
		return s
	}) : window.matchesSelector = s
}(this, Element.prototype), function (t) {
	"use strict";
	function e(t) {
		for (var i in e.defaults)this[i] = e.defaults[i];
		for (i in t)this[i] = t[i]
	}

	var i = t.Packery = function () {
	};
	i.Rect = e, e.defaults = {x: 0, y: 0, width: 0, height: 0}, e.prototype.contains = function (t) {
		var e = t.width || 0, i = t.height || 0;
		return this.x <= t.x && this.y <= t.y && this.x + this.width >= t.x + e && this.y + this.height >= t.y + i
	}, e.prototype.overlaps = function (t) {
		var e = this.x + this.width, i = this.y + this.height, n = t.x + t.width, o = t.y + t.height;
		return n > this.x && e > t.x && o > this.y && i > t.y
	}, e.prototype.getMaximalFreeRects = function (t) {
		if (!this.overlaps(t))return!1;
		var i, n = [], o = this.x + this.width, r = this.y + this.height, s = t.x + t.width, a = t.y + t.height;
		return this.y < t.y && (i = new e({x: this.x, y: this.y, width: this.width, height: t.y - this.y}), n.push(i)), o > s && (i = new e({x: s, y: this.y, width: o - s, height: this.height}), n.push(i)), r > a && (i = new e({x: this.x, y: a, width: this.width, height: r - a}), n.push(i)), this.x < t.x && (i = new e({x: this.x, y: this.y, width: t.x - this.x, height: this.height}), n.push(i)), n
	}, e.prototype.canFit = function (t) {
		return this.width >= t.width && this.height >= t.height
	}
}(window), function (t) {
	"use strict";
	function e(t, e) {
		this.width = t || 0, this.height = e || 0, this.reset()
	}

	var i = t.Packery, n = i.Rect;
	e.prototype.reset = function () {
		this.spaces = [], this.newSpaces = [];
		var t = new n({x: 0, y: 0, width: this.width, height: this.height});
		this.spaces.push(t)
	}, e.prototype.pack = function (t) {
		for (var e = 0, i = this.spaces.length; i > e; e++) {
			var n = this.spaces[e];
			if (n.canFit(t)) {
				this.placeInSpace(t, n);
				break
			}
		}
	}, e.prototype.placeInSpace = function (t, e) {
		t.x = e.x, t.y = e.y, this.placed(t)
	}, e.prototype.placed = function (t) {
		for (var i = [], n = 0, o = this.spaces.length; o > n; n++) {
			var r = this.spaces[n], s = r.getMaximalFreeRects(t);
			s ? i.push.apply(i, s) : i.push(r)
		}
		this.spaces = i, e.mergeRects(this.spaces), this.spaces.sort(e.spaceSorterTopLeft)
	}, e.mergeRects = function (t) {
		for (var e = 0, i = t.length; i > e; e++) {
			var n = t[e];
			if (n) {
				var o = t.slice(0);
				o.splice(e, 1);
				for (var r = 0, s = 0, a = o.length; a > s; s++) {
					var h = o[s], p = e > s ? 0 : 1;
					n.contains(h) && (t.splice(s + p - r, 1), r++)
				}
			}
		}
		return t
	}, e.spaceSorterTopLeft = function (t, e) {
		return t.y - e.y || t.x - e.x
	}, e.spaceSorterLeftTop = function (t, e) {
		return t.x - e.x || t.y - e.y
	}, i.Packer = e
}(window), function (t) {
	"use strict";
	function e(t, e) {
		for (var i in e)t[i] = e[i];
		return t
	}

	function i(t, e) {
		this.element = t, this.packery = e, this.position = {x: 0, y: 0}, this.rect = new o, this.placeRect = new o, this.element.style.position = "absolute"
	}

	var n = t.Packery, o = n.Rect, r = t.getSize, s = t.getStyleProperty, a = t.EventEmitter, h = document.defaultView, p = h && h.getComputedStyle ? function (t) {
		return h.getComputedStyle(t, null)
	} : function (t) {
		return t.currentStyle
	}, c = s("transition"), u = s("transform"), l = c && u, d = !!s("perspective"), f = {WebkitTransition: "webkitTransitionEnd", MozTransition: "transitionend", OTransition: "otransitionend", transition: "transitionend"}[c], m = {WebkitTransform: "-webkit-transform", MozTransform: "-moz-transform", OTransform: "-o-transform", transform: "transform"}[u];
	e(i.prototype, a.prototype), i.prototype.handleEvent = function (t) {
		var e = "on" + t.type;
		this[e] && this[e](t)
	}, i.prototype.getSize = function () {
		this.size = r(this.element)
	}, i.prototype.css = function (t) {
		var e = this.element.style;
		for (var i in t)e[i] = t[i]
	}, i.prototype.getPosition = function () {
		var t = p(this.element), e = parseInt(t.left, 10), i = parseInt(t.top, 10);
		e = isNaN(e) ? 0 : e, i = isNaN(i) ? 0 : i;
		var n = this.packery.elementSize;
		e -= n.paddingLeft, i -= n.paddingTop, this.position.x = e, this.position.y = i
	};
	var y = d ? function (t, e) {
		return"translate3d( " + t + "px, " + e + "px, 0)"
	} : function (t, e) {
		return"translate( " + t + "px, " + e + "px)"
	};
	i.prototype._transitionTo = function (t, e) {
		this.getPosition();
		var i = this.position.x, n = this.position.y, o = parseInt(t, 10), r = parseInt(e, 10), s = o === this.position.x && r === this.position.y;
		if (this.setPosition(t, e), s && !this.isTransitioning)return this.layoutPosition(), void 0;
		var a = t - i, h = e - n, p = {};
		p[m] = y(a, h), this.transition(p, this.layoutPosition)
	}, i.prototype.goTo = function (t, e) {
		this.setPosition(t, e), this.layoutPosition()
	}, i.prototype.moveTo = l ? i.prototype._transitionTo : i.prototype.goTo, i.prototype.setPosition = function (t, e) {
		this.position.x = parseInt(t, 10), this.position.y = parseInt(e, 10)
	}, i.prototype.layoutPosition = function () {
		var t = this.packery.elementSize;
		this.css({left: this.position.x + t.paddingLeft + "px", top: this.position.y + t.paddingTop + "px"}), this.emitEvent("layout", [this])
	}, i.prototype._nonTransition = function (t, e) {
		this.css(t), e && e.call(this)
	}, i.prototype._transition = function (t, e) {
		this.transitionStyle = t;
		var i = [];
		for (var n in t)i.push(n);
		var o = {};
		o[c + "Property"] = i.join(","), o[c + "Duration"] = this.packery.options.transitionDuration, this.element.addEventListener(f, this, !1), e && this.on("transitionEnd", function (t) {
			return e.call(t), !0
		}), this.css(o), this.css(t), this.isTransitioning = !0
	}, i.prototype.transition = i.prototype[c ? "_transition" : "_nonTransition"], i.prototype.onwebkitTransitionEnd = function (t) {
		this.ontransitionend(t)
	}, i.prototype.onotransitionend = function (t) {
		this.ontransitionend(t)
	}, i.prototype.ontransitionend = function (t) {
		if (t.target === this.element) {
			this.onTransitionEnd && (this.onTransitionEnd(), delete this.onTransitionEnd), this.removeTransitionStyles();
			var e = {};
			for (var i in this.transitionStyle)e[i] = "";
			this.css(e), this.element.removeEventListener(f, this, !1), delete this.transitionStyle, this.isTransitioning = !1, this.emitEvent("transitionEnd", [this])
		}
	}, i.prototype.removeTransitionStyles = function () {
		var t = {};
		t[c + "Property"] = "", t[c + "Duration"] = "", this.css(t)
	}, i.prototype.remove = function () {
		var t = {opacity: 0};
		t[m] = "scale(0.001)", this.transition(t, this.removeElem)
	}, i.prototype.removeElem = function () {
		this.element.parentNode.removeChild(this.element), this.emitEvent("remove", [this])
	}, i.prototype.reveal = c ? function () {
		var t = {opacity: 0};
		t[m] = "scale(0.001)", this.css(t);
		var e = this.element.offsetHeight, i = {opacity: 1};
		i[m] = "scale(1)", this.transition(i), e = null
	} : function () {
	}, i.prototype.destroy = function () {
		this.css({position: "", left: "", top: ""})
	}, i.prototype.dragStart = function () {
		this.getPosition(), this.removeTransitionStyles(), this.isTransitioning && u && (this.element.style[u] = "none"), this.getSize(), this.isPlacing = !0, this.needsPositioning = !1, this.positionPlaceRect(this.position.x, this.position.y), this.isTransitioning = !1, this.didDrag = !1
	}, i.prototype.dragMove = function (t, e) {
		this.didDrag = !0;
		var i = this.packery.elementSize;
		t -= i.paddingLeft, e -= i.paddingTop, this.positionPlaceRect(t, e)
	}, i.prototype.dragStop = function () {
		this.getPosition();
		var t = this.position.x !== this.placeRect.x, e = this.position.y !== this.placeRect.y;
		this.needsPositioning = t || e, this.didDrag = !1
	}, i.prototype.positionPlaceRect = function (t, e, i) {
		this.placeRect.x = this.getPlaceRectCoord(t, !0), this.placeRect.y = this.getPlaceRectCoord(e, !1, i)
	}, i.prototype.getPlaceRectCoord = function (t, e, i) {
		var n = e ? "Width" : "Height", o = this.size["outer" + n], r = this.packery[e ? "columnWidth" : "rowHeight"], s = this.packery.elementSize["inner" + n];
		e || (s = Math.max(s, this.packery.maxY), this.packery.rowHeight || (s -= this.packery.gutter));
		var a;
		if (r) {
			r += this.packery.gutter, s += e ? this.packery.gutter : 0, t = Math.round(t / r);
			var h = Math[e ? "floor" : "ceil"](s / r);
			h -= Math.ceil(o / r), a = h
		} else a = s - o;
		return t = i ? t : Math.min(t, a), t *= r || 1, Math.max(0, t)
	}, i.prototype.copyPlaceRectPosition = function () {
		this.rect.x = this.placeRect.x, this.rect.y = this.placeRect.y
	}, n.Item = i
}(window), function (t) {
	"use strict";
	function e(t, e) {
		for (var i in e)t[i] = e[i];
		return t
	}

	function i(t) {
		var e = [];
		if ("number" == typeof t.length)for (var i = 0, n = t.length; n > i; i++)e.push(t[i]); else e.push(t);
		return e
	}

	function n(t, i) {
		if (!t || !g(t))return m && m.error("bad Packery element: " + t), void 0;
		this.element = t, this.options = e({}, this.options), e(this.options, i);
		var n = ++x;
		this.element.packeryGUID = n, E[n] = this, this._create(), this.options.isInitLayout && this.layout()
	}

	var o = t.Packery, r = o.Rect, s = o.Packer, a = o.Item, h = t.classie, p = t.docReady, c = t.EventEmitter, u = t.eventie, l = t.getSize, d = t.matchesSelector, f = t.document, m = t.console, y = t.jQuery, g = "object" == typeof HTMLElement ? function (t) {
		return t instanceof HTMLElement
	} : function (t) {
		return t && "object" == typeof t && 1 === t.nodeType && "string" == typeof t.nodeName
	}, v = Array.prototype.indexOf ? function (t, e) {
		return t.indexOf(e)
	} : function (t, e) {
		for (var i = 0, n = t.length; n > i; i++)if (t[i] === e)return i;
		return-1
	}, x = 0, E = {};
	e(n.prototype, c.prototype), n.prototype.options = {containerStyle: {position: "relative"}, isInitLayout: !0, isResizeBound: !0, transitionDuration: "0.4s"}, n.prototype._create = function () {
		this.packer = new s, this.reloadItems(), this.stampedElements = [], this.stamp(this.options.stamped);
		var t = this.options.containerStyle;
		e(this.element.style, t), this.options.isResizeBound && this.bindResize();
		var i = this;
		this.handleDraggabilly = {dragStart: function (t) {
			i.itemDragStart(t.element)
		}, dragMove                        : function (t) {
			i.itemDragMove(t.element, t.position.x, t.position.y)
		}, dragEnd                         : function (t) {
			i.itemDragEnd(t.element)
		}}, this.handleUIDraggable = {start: function (t) {
			i.itemDragStart(t.currentTarget)
		}, drag                            : function (t, e) {
			i.itemDragMove(t.currentTarget, e.position.left, e.position.top)
		}, stop                            : function (t) {
			i.itemDragEnd(t.currentTarget)
		}}
	}, n.prototype.reloadItems = function () {
		this.items = this._getItems(this.element.children)
	}, n.prototype._getItems = function (t) {
		for (var e = this._filterFindItemElements(t), i = [], n = 0, o = e.length; o > n; n++) {
			var r = e[n], s = new a(r, this);
			i.push(s)
		}
		return i
	}, n.prototype._filterFindItemElements = function (t) {
		t = i(t);
		var e = this.options.itemSelector;
		if (!e)return t;
		for (var n = [], o = 0, r = t.length; r > o; o++) {
			var s = t[o];
			d(s, e) && n.push(s);
			for (var a = s.querySelectorAll(e), h = 0, p = a.length; p > h; h++)n.push(a[h])
		}
		return n
	}, n.prototype.getItemElements = function () {
		for (var t = [], e = 0, i = this.items.length; i > e; e++)t.push(this.items[e].element);
		return t
	}, n.prototype.layout = function () {
		this._prelayout();
		var t = void 0 !== this.options.isLayoutInstant ? this.options.isLayoutInstant : !this._isLayoutInited;
		this.layoutItems(this.items, t), this._isLayoutInited = !0
	}, n.prototype._init = n.prototype.layout, n.prototype._prelayout = function () {
		this.elementSize = l(this.element), this._getMeasurements(), this.packer.width = this.elementSize.innerWidth + this.gutter, this.packer.height = Number.POSITIVE_INFINITY, this.packer.reset(), this.maxY = 0, this.placeStampedElements()
	}, n.prototype._getMeasurements = function () {
		this._getMeasurement("columnWidth", "width"), this._getMeasurement("rowHeight", "height"), this._getMeasurement("gutter", "width")
	}, n.prototype._getMeasurement = function (t, e) {
		var i, n = this.options[t];
		n ? ("string" == typeof n ? i = this.element.querySelector(n) : g(n) && (i = n), this[t] = i ? l(i)[e] : n) : this[t] = 0
	}, n.prototype.layoutItems = function (t, e) {
		var i = this._getLayoutItems(t);
		this._itemsOn(i, "layout", function () {
			this.emitEvent("layoutComplete", [this, i])
		});
		for (var n = 0, o = i.length; o > n; n++) {
			var r = i[n];
			this._packItem(r), this._layoutItem(r, e)
		}
		var s = this.elementSize, a = this.maxY - this.gutter;
		s.isBorderBox && (a += s.paddingBottom + s.paddingTop + s.borderTopWidth + s.borderBottomWidth), this.element.style.height = a + "px"
	}, n.prototype._getLayoutItems = function (t) {
		for (var e = [], i = 0, n = t.length; n > i; i++) {
			var o = t[i];
			o.isIgnored || e.push(o)
		}
		return e
	}, n.prototype._packItem = function (t) {
		this._setRectSize(t.element, t.rect), this.packer.pack(t.rect), this._setMaxY(t.rect)
	}, n.prototype._setMaxY = function (t) {
		this.maxY = Math.max(t.y + t.height, this.maxY)
	}, n.prototype._setRectSize = function (t, e) {
		var i = l(t), n = i.outerWidth, o = i.outerHeight, r = this.columnWidth + this.gutter, s = this.rowHeight + this.gutter;
		n = this.columnWidth ? Math.ceil(n / r) * r : n + this.gutter, o = this.rowHeight ? Math.ceil(o / s) * s : o + this.gutter, e.width = Math.min(n, this.packer.width), e.height = o
	}, n.prototype._layoutItem = function (t, e) {
		var i = t.rect;
		e ? t.goTo(i.x, i.y) : t.moveTo(i.x, i.y)
	}, n.prototype._itemsOn = function (t, e, i) {
		function n() {
			return o++, o === r && i.call(s), !0
		}

		for (var o = 0, r = t.length, s = this, a = 0, h = t.length; h > a; a++) {
			var p = t[a];
			p.on(e, n)
		}
	}, n.prototype.stamp = function (t) {
		if (t) {
			"string" == typeof t && (t = this.element.querySelectorAll(t)), t = i(t), this.stampedElements.push.apply(this.stampedElements, t);
			for (var e = 0, n = t.length; n > e; e++) {
				var o = t[e];
				this.ignore(o)
			}
		}
	}, n.prototype.unstamp = function (t) {
		if (t) {
			t = i(t);
			for (var e = 0, n = t.length; n > e; e++) {
				var o = t[e], r = v(this.stampedElements, o);
				-1 !== r && this.stampedElements.splice(r, 1), this.unignore(o)
			}
		}
	}, n.prototype.placeStampedElements = function () {
		if (this.stampedElements && this.stampedElements.length) {
			this._getBounds();
			for (var t = 0, e = this.stampedElements.length; e > t; t++) {
				var i = this.stampedElements[t];
				this.placeStamp(i)
			}
		}
	}, n.prototype._getBounds = function () {
		var t = this.element.getBoundingClientRect();
		this._boundingLeft = t.left + this.elementSize.paddingLeft, this._boundingTop = t.top + this.elementSize.paddingTop
	}, n.prototype.placeStamp = function (t) {
		var e, i = this.getItem(t);
		e = i && i.isPlacing ? i.placeRect : this._getElementOffsetRect(t), this._setRectSize(t, e), this.packer.placed(e), this._setMaxY(e)
	}, n.prototype._getElementOffsetRect = function (t) {
		var e = t.getBoundingClientRect(), i = new r({x: e.left - this._boundingLeft, y: e.top - this._boundingTop});
		return i.x -= this.elementSize.borderLeftWidth, i.y -= this.elementSize.borderTopWidth, i
	}, n.prototype.handleEvent = function (t) {
		var e = "on" + t.type;
		this[e] && this[e](t)
	}, n.prototype.bindResize = function () {
		this.isResizeBound || (u.bind(t, "resize", this), this.isResizeBound = !0)
	}, n.prototype.unbindResize = function () {
		u.unbind(t, "resize", this), this.isResizeBound = !1
	}, n.prototype.onresize = function () {
		function t() {
			e.resize()
		}

		this.resizeTimeout && clearTimeout(this.resizeTimeout);
		var e = this;
		this.resizeTimeout = setTimeout(t, 100)
	}, n.prototype.resize = function () {
		var t = l(this.element);
		t.innerWidth !== this.elementSize.innerWidth && (this.layout(), delete this.resizeTimeout)
	}, n.prototype.addItems = function (t) {
		var e = this._getItems(t);
		if (e.length)return this.items.push.apply(this.items, e), e
	}, n.prototype.appended = function (t) {
		var e = this.addItems(t);
		e.length && (this.layoutItems(e, !0), this.reveal(e))
	}, n.prototype.prepended = function (t) {
		var e = this._getItems(t);
		if (e.length) {
			var i = this.items.slice(0);
			this.items = e.concat(i), this._prelayout(), this.layoutItems(e, !0), this.reveal(e), this.layoutItems(i)
		}
	}, n.prototype.reveal = function (t) {
		if (t && t.length)for (var e = 0, i = t.length; i > e; e++) {
			var n = t[e];
			n.reveal()
		}
	}, n.prototype.getItem = function (t) {
		for (var e = 0, i = this.items.length; i > e; e++) {
			var n = this.items[e];
			if (n.element === t)return n
		}
	}, n.prototype.getItems = function (t) {
		if (t && t.length) {
			for (var e = [], i = 0, n = t.length; n > i; i++) {
				var o = t[i], r = this.getItem(o);
				r && e.push(r)
			}
			return e
		}
	}, n.prototype.remove = function (t) {
		t = i(t);
		var e = this.getItems(t);
		this._itemsOn(e, "remove", function () {
			this.emitEvent("removeComplete", [this, e])
		});
		for (var n = 0, o = e.length; o > n; n++) {
			var r = e[n];
			r.remove();
			var s = v(this.items, r);
			this.items.splice(s, 1)
		}
	}, n.prototype.ignore = function (t) {
		var e = this.getItem(t);
		e && (e.isIgnored = !0)
	}, n.prototype.unignore = function (t) {
		var e = this.getItem(t);
		e && delete e.isIgnored
	}, n.prototype.sortItemsByPosition = function () {
		this.items.sort(function (t, e) {
			return t.position.y - e.position.y || t.position.x - e.position.x
		})
	}, n.prototype.fit = function (t, e, i) {
		function n() {
			s++, 2 === s && r.emitEvent("fitComplete", [r, o])
		}

		var o = this.getItem(t);
		if (o) {
			this._getMeasurements(), this.stamp(o.element), o.getSize(), o.isPlacing = !0, e = void 0 === e ? o.rect.x : e, i = void 0 === i ? o.rect.y : i, o.positionPlaceRect(e, i, !0);
			var r = this, s = 0;
			o.on("layout", function () {
				return n(), !0
			}), this.on("layoutComplete", function () {
				return n(), !0
			}), o.moveTo(o.placeRect.x, o.placeRect.y), this.layout(), this.unstamp(o.element), this.sortItemsByPosition(), o.isPlacing = !1, o.copyPlaceRectPosition()
		}
	}, n.prototype.itemDragStart = function (t) {
		this.stamp(t);
		var e = this.getItem(t);
		e && e.dragStart()
	}, n.prototype.itemDragMove = function (t, e, i) {
		function n() {
			r.layout(), delete r.dragTimeout
		}

		var o = this.getItem(t);
		o && o.dragMove(e, i);
		var r = this;
		this.clearDragTimeout(), this.dragTimeout = setTimeout(n, 40)
	}, n.prototype.clearDragTimeout = function () {
		this.dragTimeout && clearTimeout(this.dragTimeout)
	}, n.prototype.itemDragEnd = function (t) {
		function e() {
			return s++, s !== r ? !0 : (n && (h.remove(n.element, "is-positioning-post-drag"), n.isPlacing = !1, n.copyPlaceRectPosition()), a.unstamp(t), a.sortItemsByPosition(), n && o && a.emitEvent("dragItemPositioned", [a, n]), !0)
		}

		var i, n = this.getItem(t);
		if (n && (i = n.didDrag, n.dragStop()), !n || !i && !n.needsPositioning)return this.unstamp(t), void 0;
		h.add(n.element, "is-positioning-post-drag");
		var o = n.needsPositioning, r = o ? 2 : 1, s = 0, a = this;
		o ? (n.on("layout", e), n.moveTo(n.placeRect.x, n.placeRect.y)) : n && n.copyPlaceRectPosition(), this.clearDragTimeout(), this.on("layoutComplete", e), this.layout()
	}, n.prototype.bindDraggabillyEvents = function (t) {
		t.on("dragStart", this.handleDraggabilly.dragStart), t.on("dragMove", this.handleDraggabilly.dragMove), t.on("dragEnd", this.handleDraggabilly.dragEnd)
	}, n.prototype.bindUIDraggableEvents = function (t) {
		t.on("dragstart", this.handleUIDraggable.start).on("drag", this.handleUIDraggable.drag).on("dragstop", this.handleUIDraggable.stop)
	}, n.prototype.destroy = function () {
		this.element.style.position = "", this.element.style.height = "", delete this.element.packeryGUID;
		for (var t = 0, e = this.items.length; e > t; t++) {
			var i = this.items[t];
			i.destroy()
		}
		this.unbindResize()
	}, n.data = function (t) {
		var e = t.packeryGUID;
		return e && E[e]
	}, p(function () {
		for (var t = f.querySelectorAll(".js-packery"), e = 0, i = t.length; i > e; e++) {
			var o, r = t[e], s = r.getAttribute("data-packery-options");
			try {
				o = s && JSON.parse(s)
			} catch (a) {
				m && m.error("Error parsing data-packery-options on " + r.nodeName.toLowerCase() + (r.id ? "#" + r.id : "") + ": " + a);
				continue
			}
			var h = new n(r, o);
			y && y.data(r, "packery", h)
		}
	}), y && y.bridget && y.bridget("packery", n), n.Rect = r, n.Packer = s, n.Item = a, t.Packery = n
}(window);

/*
 Tipr drop 1.0 /* modfied by UX themes
 Copyright (c) 2013 Tipue
 Tipr is released under the MIT License
 http://www.tipue.com/tipr
 */
(function ($) {
	$.fn.tipr = function (options) {
		var set = $.extend({"speed": 300, "mode": "bottom"}, options);
		return this.each(function () {
			var tipr_cont = ".tipr_container_" + set.mode;
			$(this).hover(function () {
				var position = $(this).offset();
				var out = '<div class="tipr_container_' + set.mode + '" style="position:absolute;top:' + position.top + 'px;left:' + position.left + 'px"><div class="tipr_point_' + set.mode + '"><div class="tipr_content">' + $(this).attr("data-tip") + "</div></div></div>";
				$('body').append(out);
				var w_t = $(tipr_cont).outerWidth();
				var w_e = $(this).outerWidth();
				var m_l = w_e / 2 - w_t / 2;
				$(tipr_cont).css("margin-left", m_l + "px");
				$(this).removeAttr("title");
				$(tipr_cont).fadeIn(set.speed)
			}, function () {
				$(tipr_cont).remove()
			})
		})
	}
})(jQuery);


/* Woocommerce Variations form */
(function (e, t, n, r) {
	e.fn.wc_variation_form = function () {
		e.fn.wc_variation_form.find_matching_variations = function (t, n) {
			var r = [];
			for (var i = 0; i < t.length; i++) {
				var s = t[i], o = s.variation_id;
				e.fn.wc_variation_form.variations_match(s.attributes, n) && r.push(s)
			}
			return r
		};
		e.fn.wc_variation_form.variations_match = function (e, t) {
			var n = !0;
			for (attr_name in e) {
				var i = e[attr_name], s = t[attr_name];
				i !== r && s !== r && i.length != 0 && s.length != 0 && i != s && (n = !1)
			}
			return n
		};
		this.unbind("check_variations update_variation_values found_variation");
		this.find(".reset_variations").unbind("click");
		this.find(".variations select").unbind("change focusin");
		return this.on("click", ".reset_variations",function (t) {
			e(this).closest("form.variations_form").find(".variations select").val("").change();
			var n = e(this).closest(".product").find(".sku"), r = e(this).closest(".product").find(".product_weight"), i = e(this).closest(".product").find(".product_dimensions");
			n.attr("data-o_sku") && n.text(n.attr("data-o_sku"));
			r.attr("data-o_weight") && r.text(r.attr("data-o_weight"));
			i.attr("data-o_dimensions") && i.text(i.attr("data-o_dimensions"));
			return!1
		}).on("change", ".variations select",function (t) {
				$variation_form = e(this).closest("form.variations_form");
				$variation_form.find("input[name=variation_id]").val("").change();
				$variation_form.trigger("woocommerce_variation_select_change").trigger("check_variations", ["", !1]);
				e(this).blur();
				e().uniform && e.isFunction(e.uniform.update) && e.uniform.update()
			}).on("focusin", ".variations select",function (t) {
				$variation_form = e(this).closest("form.variations_form");
				$variation_form.trigger("woocommerce_variation_select_focusin").trigger("check_variations", [e(this).attr("name"), !0])
			}).on("check_variations",function (n, r, i) {
				var s = !0, o = !1, u = !1, a = {}, f = e(this), l = f.find(".reset_variations");
				f.find(".variations select").each(function () {
					e(this).val().length == 0 ? s = !1 : o = !0;
					if (r && e(this).attr("name") == r) {
						s = !1;
						a[e(this).attr("name")] = ""
					} else {
						value = e(this).val();
						a[e(this).attr("name")] = value
					}
				});
				var c = parseInt(f.data("product_id")), h = f.data("product_variations");
				h || (h = t.product_variations[c]);
				h || (h = t.product_variations);
				h || (h = t["product_variations_" + c]);
				var p = e.fn.wc_variation_form.find_matching_variations(h, a);
				if (s) {
					var d = p.pop();
					if (d) {
						f.find("input[name=variation_id]").val(d.variation_id).change();
						f.trigger("found_variation", [d])
					} else {
						f.find(".variations select").val("");
						i || f.trigger("reset_image");
						alert(woocommerce_params.i18n_no_matching_variations_text)
					}
				} else {
					f.trigger("update_variation_values", [p]);
					i || f.trigger("reset_image");
					r || f.find(".single_variation_wrap").slideUp("200")
				}
				o ? l.css("visibility") == "hidden" && l.css("visibility", "visible").hide().fadeIn() : l.css("visibility", "hidden")
			}).on("reset_image",function (t) {
				var n = e(this).closest(".product"), r = n.find("div.images img:eq(0)"), i = n.find("div.images a.zoom:eq(0)"), s = r.attr("data-o_src"), o = r.attr("data-o_title"), u = i.attr("data-o_href");
				s && r.attr("src", s);
				u && i.attr("href", u);
				if (o) {
					r.attr("alt", o).attr("title", o);
					i.attr("title", o)
				}
			}).on("update_variation_values",function (t, n) {
				$variation_form = e(this).closest("form.variations_form");
				$variation_form.find(".variations select").each(function (t, r) {
					current_attr_select = e(r);
					current_attr_select.data("attribute_options") || current_attr_select.data("attribute_options", current_attr_select.find("option:gt(0)").get());
					current_attr_select.find("option:gt(0)").remove();
					current_attr_select.append(current_attr_select.data("attribute_options"));
					current_attr_select.find("option:gt(0)").removeClass("active");
					var i = current_attr_select.attr("name");
					for (num in n)if (typeof n[num] != "undefined") {
						var s = n[num].attributes;
						for (attr_name in s) {
							var o = s[attr_name];
							if (attr_name == i)if (o) {
								o = e("<div/>").html(o).text();
								o = o.replace(/'/g, "\\'");
								o = o.replace(/"/g, '\\"');
								current_attr_select.find('option[value="' + o + '"]').addClass("active")
							} else current_attr_select.find("option:gt(0)").addClass("active")
						}
					}
					current_attr_select.find("option:gt(0):not(.active)").remove()
				});
				$variation_form.trigger("woocommerce_update_variation_values")
			}).on("found_variation", function (t, n) {
				var r = e(this), i = e(this).closest(".product"), s = i.find("div.images img:eq(0)"), o = i.find("div.images a.zoom:eq(0)"), u = s.attr("data-o_src"), a = s.attr("data-o_title"), f = o.attr("data-o_href"), l = n.image_src, c = n.image_link, h = n.image_title;
				r.find(".variations_button").show();
				r.find(".single_variation").html(n.price_html + n.availability_html);
				if (!u) {
					u = s.attr("src") ? s.attr("src") : "";
					s.attr("data-o_src", u)
				}
				if (!f) {
					f = o.attr("href") ? o.attr("href") : "";
					o.attr("data-o_href", f)
				}
				if (!a) {
					a = s.attr("title") ? s.attr("title") : "";
					s.attr("data-o_title", a)
				}
				if (l && l.length > 1) {
					s.attr("src", l).attr("alt", h).attr("title", h);
					o.attr("href", c).attr("title", h)
				} else {
					s.attr("src", u).attr("alt", a).attr("title", a);
					o.attr("href", f).attr("title", a)
				}
				var p = r.find(".single_variation_wrap"), d = i.find(".product_meta").find(".sku"), v = i.find(".product_weight"), m = i.find(".product_dimensions");
				d.attr("data-o_sku") || d.attr("data-o_sku", d.text());
				v.attr("data-o_weight") || v.attr("data-o_weight", v.text());
				m.attr("data-o_dimensions") || m.attr("data-o_dimensions", m.text());
				n.sku ? d.text(n.sku) : d.text(d.attr("data-o_sku"));
				n.weight ? v.text(n.weight) : v.text(v.attr("data-o_weight"));
				n.dimensions ? m.text(n.dimensions) : m.text(m.attr("data-o_dimensions"));
				p.find(".quantity").show();
				!n.is_in_stock && !n.backorders_allowed && r.find(".variations_button").hide();
				n.min_qty ? p.find("input[name=quantity]").attr("min", n.min_qty).val(n.min_qty) : p.find("input[name=quantity]").removeAttr("min");
				n.max_qty ? p.find("input[name=quantity]").attr("max", n.max_qty) : p.find("input[name=quantity]").removeAttr("max");
				if (n.is_sold_individually == "yes") {
					p.find("input[name=quantity]").val("1");
					p.find(".quantity").hide()
				}
				p.slideDown("200").trigger("show_variation", [n])
			})
	};
	e("form.variations_form").wc_variation_form();
	e("form.variations_form .variations select").change()
})(jQuery, window, document);


/*!
 * imagesLoaded PACKAGED v3.0.4
 * JavaScript is all like "You images are done yet or what?"
 */
(function () {
	"use strict";
	function e() {
	}

	function t(e, t) {
		for (var n = e.length; n--;)if (e[n].listener === t)return n;
		return-1
	}

	var n = e.prototype;
	n.getListeners = function (e) {
		var t, n, i = this._getEvents();
		if ("object" == typeof e) {
			t = {};
			for (n in i)i.hasOwnProperty(n) && e.test(n) && (t[n] = i[n])
		} else t = i[e] || (i[e] = []);
		return t
	}, n.flattenListeners = function (e) {
		var t, n = [];
		for (t = 0; e.length > t; t += 1)n.push(e[t].listener);
		return n
	}, n.getListenersAsObject = function (e) {
		var t, n = this.getListeners(e);
		return n instanceof Array && (t = {}, t[e] = n), t || n
	}, n.addListener = function (e, n) {
		var i, r = this.getListenersAsObject(e), o = "object" == typeof n;
		for (i in r)r.hasOwnProperty(i) && -1 === t(r[i], n) && r[i].push(o ? n : {listener: n, once: !1});
		return this
	}, n.on = n.addListener, n.addOnceListener = function (e, t) {
		return this.addListener(e, {listener: t, once: !0})
	}, n.once = n.addOnceListener, n.defineEvent = function (e) {
		return this.getListeners(e), this
	}, n.defineEvents = function (e) {
		for (var t = 0; e.length > t; t += 1)this.defineEvent(e[t]);
		return this
	}, n.removeListener = function (e, n) {
		var i, r, o = this.getListenersAsObject(e);
		for (r in o)o.hasOwnProperty(r) && (i = t(o[r], n), -1 !== i && o[r].splice(i, 1));
		return this
	}, n.off = n.removeListener, n.addListeners = function (e, t) {
		return this.manipulateListeners(!1, e, t)
	}, n.removeListeners = function (e, t) {
		return this.manipulateListeners(!0, e, t)
	}, n.manipulateListeners = function (e, t, n) {
		var i, r, o = e ? this.removeListener : this.addListener, s = e ? this.removeListeners : this.addListeners;
		if ("object" != typeof t || t instanceof RegExp)for (i = n.length; i--;)o.call(this, t, n[i]); else for (i in t)t.hasOwnProperty(i) && (r = t[i]) && ("function" == typeof r ? o.call(this, i, r) : s.call(this, i, r));
		return this
	}, n.removeEvent = function (e) {
		var t, n = typeof e, i = this._getEvents();
		if ("string" === n)delete i[e]; else if ("object" === n)for (t in i)i.hasOwnProperty(t) && e.test(t) && delete i[t]; else delete this._events;
		return this
	}, n.emitEvent = function (e, t) {
		var n, i, r, o, s = this.getListenersAsObject(e);
		for (r in s)if (s.hasOwnProperty(r))for (i = s[r].length; i--;)n = s[r][i], o = n.listener.apply(this, t || []), (o === this._getOnceReturnValue() || n.once === !0) && this.removeListener(e, s[r][i].listener);
		return this
	}, n.trigger = n.emitEvent, n.emit = function (e) {
		var t = Array.prototype.slice.call(arguments, 1);
		return this.emitEvent(e, t)
	}, n.setOnceReturnValue = function (e) {
		return this._onceReturnValue = e, this
	}, n._getOnceReturnValue = function () {
		return this.hasOwnProperty("_onceReturnValue") ? this._onceReturnValue : !0
	}, n._getEvents = function () {
		return this._events || (this._events = {})
	}, "function" == typeof define && define.amd ? define(function () {
		return e
	}) : "undefined" != typeof module && module.exports ? module.exports = e : this.EventEmitter = e
}).call(this), function (e) {
	"use strict";
	var t = document.documentElement, n = function () {
	};
	t.addEventListener ? n = function (e, t, n) {
		e.addEventListener(t, n, !1)
	} : t.attachEvent && (n = function (t, n, i) {
		t[n + i] = i.handleEvent ? function () {
			var t = e.event;
			t.target = t.target || t.srcElement, i.handleEvent.call(i, t)
		} : function () {
			var n = e.event;
			n.target = n.target || n.srcElement, i.call(t, n)
		}, t.attachEvent("on" + n, t[n + i])
	});
	var i = function () {
	};
	t.removeEventListener ? i = function (e, t, n) {
		e.removeEventListener(t, n, !1)
	} : t.detachEvent && (i = function (e, t, n) {
		e.detachEvent("on" + t, e[t + n]);
		try {
			delete e[t + n]
		} catch (i) {
			e[t + n] = void 0
		}
	});
	var r = {bind: n, unbind: i};
	"function" == typeof define && define.amd ? define(r) : e.eventie = r
}(this), function (e) {
	"use strict";
	function t(e, t) {
		for (var n in t)e[n] = t[n];
		return e
	}

	function n(e) {
		return"[object Array]" === c.call(e)
	}

	function i(e) {
		var t = [];
		if (n(e))t = e; else if ("number" == typeof e.length)for (var i = 0, r = e.length; r > i; i++)t.push(e[i]); else t.push(e);
		return t
	}

	function r(e, n) {
		function r(e, n, s) {
			if (!(this instanceof r))return new r(e, n);
			"string" == typeof e && (e = document.querySelectorAll(e)), this.elements = i(e), this.options = t({}, this.options), "function" == typeof n ? s = n : t(this.options, n), s && this.on("always", s), this.getImages(), o && (this.jqDeferred = new o.Deferred);
			var a = this;
			setTimeout(function () {
				a.check()
			})
		}

		function c(e) {
			this.img = e
		}

		r.prototype = new e, r.prototype.options = {}, r.prototype.getImages = function () {
			this.images = [];
			for (var e = 0, t = this.elements.length; t > e; e++) {
				var n = this.elements[e];
				"IMG" === n.nodeName && this.addImage(n);
				for (var i = n.querySelectorAll("img"), r = 0, o = i.length; o > r; r++) {
					var s = i[r];
					this.addImage(s)
				}
			}
		}, r.prototype.addImage = function (e) {
			var t = new c(e);
			this.images.push(t)
		}, r.prototype.check = function () {
			function e(e, r) {
				return t.options.debug && a && s.log("confirm", e, r), t.progress(e), n++, n === i && t.complete(), !0
			}

			var t = this, n = 0, i = this.images.length;
			if (this.hasAnyBroken = !1, !i)return this.complete(), void 0;
			for (var r = 0; i > r; r++) {
				var o = this.images[r];
				o.on("confirm", e), o.check()
			}
		}, r.prototype.progress = function (e) {
			this.hasAnyBroken = this.hasAnyBroken || !e.isLoaded;
			var t = this;
			setTimeout(function () {
				t.emit("progress", t, e), t.jqDeferred && t.jqDeferred.notify(t, e)
			})
		}, r.prototype.complete = function () {
			var e = this.hasAnyBroken ? "fail" : "done";
			this.isComplete = !0;
			var t = this;
			setTimeout(function () {
				if (t.emit(e, t), t.emit("always", t), t.jqDeferred) {
					var n = t.hasAnyBroken ? "reject" : "resolve";
					t.jqDeferred[n](t)
				}
			})
		}, o && (o.fn.imagesLoaded = function (e, t) {
			var n = new r(this, e, t);
			return n.jqDeferred.promise(o(this))
		});
		var f = {};
		return c.prototype = new e, c.prototype.check = function () {
			var e = f[this.img.src];
			if (e)return this.useCached(e), void 0;
			if (f[this.img.src] = this, this.img.complete && void 0 !== this.img.naturalWidth)return this.confirm(0 !== this.img.naturalWidth, "naturalWidth"), void 0;
			var t = this.proxyImage = new Image;
			n.bind(t, "load", this), n.bind(t, "error", this), t.src = this.img.src
		}, c.prototype.useCached = function (e) {
			if (e.isConfirmed)this.confirm(e.isLoaded, "cached was confirmed"); else {
				var t = this;
				e.on("confirm", function (e) {
					return t.confirm(e.isLoaded, "cache emitted confirmed"), !0
				})
			}
		}, c.prototype.confirm = function (e, t) {
			this.isConfirmed = !0, this.isLoaded = e, this.emit("confirm", this, t)
		}, c.prototype.handleEvent = function (e) {
			var t = "on" + e.type;
			this[t] && this[t](e)
		}, c.prototype.onload = function () {
			this.confirm(!0, "onload"), this.unbindProxyEvents()
		}, c.prototype.onerror = function () {
			this.confirm(!1, "onerror"), this.unbindProxyEvents()
		}, c.prototype.unbindProxyEvents = function () {
			n.unbind(this.proxyImage, "load", this), n.unbind(this.proxyImage, "error", this)
		}, r
	}

	var o = e.jQuery, s = e.console, a = s !== void 0, c = Object.prototype.toString;
	"function" == typeof define && define.amd ? define(["eventEmitter/EventEmitter", "eventie/eventie"], r) : e.imagesLoaded = r(e.EventEmitter, e.eventie)
}(window);


/* PARALAXX */
(function ($, window, document, undefined) {
	// Create the defaults once
	var pluginName = 'scrolly',
		defaults = {
			bgParallax: false
		},
		didScroll = false;

	function Plugin(element, options) {
		this.element = element;
		this.$element = $(this.element);

		this.options = $.extend({}, defaults, options);

		this._defaults = defaults;
		this._name = pluginName;

		this.init();
	}

	Plugin.prototype.init = function () {
		var self = this;
		this.startPosition = this.$element.position().top;
		this.offsetTop = this.$element.offset().top;
		this.height = this.$element.outerHeight(true);
		this.velocity = this.$element.attr('data-velocity');
		this.bgStart = parseInt(this.$element.attr('data-fit'), 10);

		$(document).scroll(function () {
			self.didScroll = true;
		});

		setInterval(function () {
			if (self.didScroll) {
				self.didScroll = false;
				self.scrolly();
			}
		}, 10);
	};

	Plugin.prototype.scrolly = function () {
		var dT = $(window).scrollTop(),
			wH = $(window).height(),
			position = this.startPosition;

		if (this.offsetTop >= (dT + wH)) {
			this.$element.addClass('scrolly-invisible');
		} else {
			if (this.$element.hasClass('scrolly-invisible')) {
				position = this.startPosition - (dT + ( wH - this.offsetTop ) ) * this.velocity;
			} else {
				position = this.startPosition - dT * this.velocity;
			}
		}
		// Fix background position
		if (this.bgStart) {
			position = position + this.bgStart;
		}
		this.$element.css({backgroundPosition: '50% ' + position + 'px'});
	};

	$.fn[pluginName] = function (options) {
		return this.each(function () {
			if (!$.data(this, 'plugin_' + pluginName)) {
				$.data(this, 'plugin_' + pluginName, new Plugin(this, options));
			}
		});
	};
})(jQuery, window, document);