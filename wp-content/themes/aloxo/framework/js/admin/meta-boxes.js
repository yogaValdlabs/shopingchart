/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

	/**
	 * Show, hide post format meta boxes
	 *
	 * @return void
	 * @since 1.0
	 */
	function togglePostFormatMetaBoxes()
	{
		var $input = jQuery( 'input[name=post_format]' ),
                $metaBoxes =jQuery( '[id^="thim-meta-boxes-post-format-"]' ).hide();

		// Don't show post format meta boxes for portfolio
		if ( jQuery( '#post_type' ).val() == 'portfolio' )
			return;

		$input.change( function ()
		{
			$metaBoxes.hide();
			jQuery( '#thim-meta-boxes-post-format-' + jQuery( this ).val() ).show();
		} );
		$input.filter( ':checked' ).trigger( 'change' );
	}
    togglePostFormatMetaBoxes();
    displaySetting ();
    function displaySetting () {
		jQuery('#display-setting tbody > tr').each(function(i) {
        	if (i >= 4 && i <=5) {
        		jQuery(this).show();
        	}
        });
		jQuery("#display-setting #thim_mtb_hide_title_and_subtitle").change(function() {
		    if(this.checked) {
		        //Do stuff
		        jQuery('#display-setting tbody > tr').each(function(i) {
		        	if (i >= 4 && i <=5) {
		        		jQuery(this).hide();
		        	}
		        });
		    }else {
		    	jQuery('#display-setting tbody > tr').each(function(i) {
		        	if (i >= 4 && i <=5) {
		        		jQuery(this).show();
		        	}
		        });
		    }
		}).trigger( 'change' );
		
		
		jQuery('#display-setting tbody > tr').each(function(i) {
        	if (i >= 2 && i <=11) {
        		jQuery(this).hide();
        	}
        });
		jQuery("#display-setting #thim_mtb_using_custom_heading").change(function() {
		    if(this.checked) {
		        //Do stuff
		        jQuery('#display-setting tbody > tr').each(function(i) {
		        	if (i >= 2 && i <=11) {
		        		jQuery(this).show();
		        	}
		        });
		    }else {
		    	jQuery('#display-setting tbody > tr').each(function(i) {
		        	if (i >= 2 && i <=11) {
		        		jQuery(this).hide();
		        	}
		        });
		    }
		}).trigger( 'change' );
		jQuery('#display-setting tbody > tr').each(function(i) {
        	if (i >= 14 && i <=16) {
        		jQuery(this).hide();
        	}
        });
		jQuery("#display-setting #thim_mtb_custom_layout").change(function() {
		    if(this.checked) {
		        //Do stuff
		        jQuery('#display-setting tbody > tr').each(function(i) {
		        	if (i >= 14 && i <=16) {
		        		jQuery(this).show();
		        	}
		        });
		    }else {
		    	 jQuery('#display-setting tbody > tr').each(function(i) {
		        	if (i >= 14 && i <=16) {
		        		jQuery(this).hide();
		        	}
		        });
		    }
		}).trigger( 'change' );
	}