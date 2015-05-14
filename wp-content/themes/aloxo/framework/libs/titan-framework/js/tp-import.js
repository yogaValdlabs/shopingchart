/**
 * File: tp import
 * Description: Action import data demo, demo files to make site as demo site
 * Author: Andy Ha (tu@wpbriz.com)
 * Copyright 2007-2014 wpbriz.com. All rights reserved.
 */

/**
 * Function import
 * Call ajax to process
 * @constructor
 */
jQuery(document).ready(function () {
	jQuery('.tp-import-action').on('click', function (event) {

		jQuery('.tp_process_bar').show();
		import_type('woo_setting', 0);

		jQuery(".tpimport_core .meter > span").animate({width: '20px'});


	})
})


function import_type(type, method) {
	jQuery(document).ready(function () {
		jQuery(".tp_process_bar").slideDown('fast');
		jQuery.ajax({
			type   : 'POST',
			data   : 'action=tp_make_site&method=' + method + '&type=' + type,
			url    : ajaxurl,
			success: function (html) {

				if (html == 'done') {
					jQuery(".tpimport_slider .meter > span").animate({width: '345px'}, 'slow');
					location.reload();
				} else if ((html == 'setting') || (html == 'menus') || (html == 'slider') || (html == 'widgets') || (html == 'core')) {
					switch (html) {
						case 'menus':
							jQuery(".tpimport_setting .meter > span").animate({width: '345px'}, 'slow');
							break;
						case 'widgets':
							jQuery(".tpimport_core .meter > span").animate({width: '345px'}, 'slow');
							break;
						case 'slider':
							jQuery(".tpimport_menus .meter > span").animate({width: '345px'}, 'slow');
							if (parseInt(jQuery('.tpimport_slider .meter > span').width()) < 320) {
								jQuery(".tpimport_slider .meter > span").animate({width: parseInt(jQuery('.tpimport_slider .meter > span').width()) + 1 + 'px'}, 'slow');
							}
							break;
						case 'setting':
							jQuery(".tpimport_widgets .meter > span").animate({width: '345px'}, 'slow');
							break;
						case 'core':
							//console.log();
							if (parseInt(jQuery('.tpimport_core .meter > span').width()) < 320) {
								jQuery(".tpimport_core .meter > span").animate({width: parseInt(jQuery('.tpimport_core .meter > span').width()) + 5 + 'px'}, 'slow');
							}
							break;
						default :
							jQuery(".tpimport_core .meter > span").animate({width: '345px'}, 'slow');
					}
					import_type(html, method);
				}
                else if(html=='revolution_error')
                {
                    alert('Import finish without revolution sliders.You can import manual, please view http://thimpress.com/knowledge-base/import-revolution-sliders/.');

                }
				else {
					alert('Import error. Please go to http://thimpress.com/forums to get the best support.');
				}
			},
			error  : function (html) {

			}
		})
		;
	})
	;
}
/**
 * Function remove demo data
 * @constructor
 */
function tp_remove() {

}
