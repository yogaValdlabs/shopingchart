jQuery( function ( $ )
{
	checkboxToggle();
	togglePostFormatMetaBoxes();
 	togglePortfolioSettings();
	togglePortfolioTestimonial();
	toggleMenuOnePage();

	selectToggle();
	selectDivToggle();
	displaySetting();
	/**
	 * Show, hide a type of select
	 *
	 * @return void
	 * @since 1.0
	 */
	function selectDivToggle () {
		var st = jQuery('[class*="selectToggle"]');
		st.each(function () {
			var $this = jQuery(this);
			var classes = $this.attr('class').split('_');
			if (classes[1]) {
				var pref = classes[1];
			}else {
				return;
			}
			var $pBox = $( 'div[class*="selectToggle_'+pref+'-"]' );
			$( ".selectToggle_"+pref+" select" ).on('change', function() {
				$pBox.hide();
				$( ".selectToggle_"+pref+'-' + $( this ).val() ).show();
			}).trigger( 'change' );
		});
	}

	function displaySetting () {
		$('#display-setting tbody > tr').each(function(i) {
        	if (i >= 4 && i <=5) {
        		$(this).show();
        	}
        });
		$("#display-setting #thim_mtb_hide_title_and_subtitle").change(function() {
		    if(this.checked) {
		        //Do stuff
		        $('#display-setting tbody > tr').each(function(i) {
		        	if (i >= 4 && i <=5) {
		        		$(this).hide();
		        	}
		        });
		    }else {
		    	$('#display-setting tbody > tr').each(function(i) {
		        	if (i >= 4 && i <=5) {
		        		$(this).show();
		        	}
		        });
		    }
		}).trigger( 'change' );
		
		
		$('#display-setting tbody > tr').each(function(i) {
        	if (i >= 2 && i <=11) {
        		$(this).hide();
        	}
        });
		$("#display-setting #thim_mtb_using_custom_heading").change(function() {
		    if(this.checked) {
		        //Do stuff
		        $('#display-setting tbody > tr').each(function(i) {
		        	if (i >= 2 && i <=11) {
		        		$(this).show();
		        	}
		        });
		    }else {
		    	$('#display-setting tbody > tr').each(function(i) {
		        	if (i >= 2 && i <=11) {
		        		$(this).hide();
		        	}
		        });
		    }
		}).trigger( 'change' );
		$('#display-setting tbody > tr').each(function(i) {
        	if (i >= 14 && i <=16) {
        		$(this).hide();
        	}
        });
		$("#display-setting #thim_mtb_custom_layout").change(function() {
		    if(this.checked) {
		        //Do stuff
		        $('#display-setting tbody > tr').each(function(i) {
		        	if (i >= 14 && i <=16) {
		        		$(this).show();
		        	}
		        });
		    }else {
		    	 $('#display-setting tbody > tr').each(function(i) {
		        	if (i >= 14 && i <=16) {
		        		$(this).hide();
		        	}
		        });
		    }
		}).trigger( 'change' );

		
	}
	


	/**
	 * Show, hide a type of select
	 *
	 * @return void
	 * @since 1.0
	 */
	function selectToggle() {
		var $pBox = $( 'div[class*="select-toggle_"]' ).hide();
		$( ".select-toggle select" ).on('change', function() {
			$pBox.hide();
			$( '.' + $( this ).val() ).show();
		}).trigger( 'change' );
	}

	/**
	 * Show, hide a <div> based on a checkbox
	 *
	 * @return void
	 * @since 1.0
	 */
	function checkboxToggle()
	{
		$( 'body' ).on( 'change', '.checkbox-toggle input', function()
		{
			var $this = $( this ),
				$toggle = $this.closest( '.checkbox-toggle' ),
				action;
			if ( !$toggle.hasClass( 'reverse' ) )
				action = $this.is( ':checked' ) ? 'slideDown' : 'slideUp';
			else
				action = $this.is( ':checked' ) ? 'slideUp' : 'slideDown';

			$toggle.next()[action]();
		} );
		$( '.checkbox-toggle input' ).trigger( 'change' );
	}

	/**
	 * Show, hide post format meta boxes
	 *
	 * @return void
	 * @since 1.0
	 */
	function togglePostFormatMetaBoxes()
	{
		var $input = $( 'input[name=post_format]' ),
			$metaBoxes = $( '[id^="aloxo-meta-boxes-post-format-"]' ).hide();

		// Don't show post format meta boxes for portfolio
		if ( $( '#post_type' ).val() == 'portfolio' )
			return;

		$input.change( function ()
		{
			$metaBoxes.hide();
			$( '#aloxo-meta-boxes-post-format-' + $( this ).val() ).show();
		} );
		$input.filter( ':checked' ).trigger( 'change' );
	}

	/**
	 * Show contact meta box for contact page-templates only
	 *
	 * @return void
	 * @since 1.0
	 */

	function togglePortfolioSettings()
	{
		$( '#page_template' ).change(function ()
		{
			$( '#aloxo-meta-boxes-template-page-portfolio' )[$( this ).val() == 'page-templates/portfolio.php' ? 'show' : 'hide']();
		} ).trigger( 'change' );
	}

	function toggleMenuOnePage()
	{
	$( '#page_template' ).change(function ()
		{
			$( '#select_menu_onepage' )[$( this ).val() == 'page-templates/onepage.php' ? 'show' : 'hide']();
			$( '#select_menu_onepage-hide' )[$( this ).val() == 'page-templates/onepage.php' ?  'show' : 'hide']();
		} ).trigger( 'change' );
	}

	/**
	 * Display type for portfolio
	 *
	 * @return void
	 * @since 1.0
	 */
	function togglePortfolioTestimonial()
	{
		var $display = $( 'input[name=display]' ),
			$testimonial = $( '#portfolio-testimonial' );
		$display.change( function ()
		{
			$testimonial[$( this ).val() == 'simple' ? 'show' : 'hide']();
		} );
		$display.filter( ':checked' ).trigger( 'change' );
	}
} );
