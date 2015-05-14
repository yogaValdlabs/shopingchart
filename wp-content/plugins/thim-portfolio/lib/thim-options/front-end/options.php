<?php
	global $my_data, $meta_options;
	if(($_SERVER['REQUEST_METHOD'] == 'POST')):

		$array_data = array();
		if (isset($_POST['submit'])) {
			// update
			foreach ( $meta_options as $value ) {
				//only show header if 'name' value exists
				if ( $value['id'] ) {
					$array_data[$value['id']] = $_POST[$value['id']]; 
				}
			}
			update_option(THIM_PORTFOLIO_OPTION,$array_data);
		} else {
			// reset
			foreach ( $meta_options as $value ) {
				//only show header if 'name' value exists
				if ( $value['id'] ) {
					$array_data[$value['id']] = $value['std']; 
				}
			}
			update_option(THIM_PORTFOLIO_OPTION,$array_data);
		}
		$my_data = new THIM_Option( $meta_options );
	endif;
?>

<div class="wrap" id="of_container">
	<form id="of_form" method="post" action="<?php echo esc_attr( $_SERVER['REQUEST_URI'] ) ?>" enctype="multipart/form-data">
		<div id="header">

			<div class="logo">
				<h2>PORTFOLIO SETTTING</h2>
				<h3>Welcome to Portfolio by ThimPress!</h3>
				<p class="about-description">We’ve assembled some links to get you started:</p>
			</div>
		</div>

		<div id="main">
			<div id="content">
				<?php echo $my_data->output; /* Settings */ ?>
			</div>

			<div class="clear"></div>

		</div>

		<div class="save_bar">
			<button type="submit" name="submit" class="button-primary"><?php _e( 'Save All Changes', 'thimpress' ); ?></button>
			<button type="submit" name="reset" class="button submit-button reset-button"><?php _e( 'Options Reset', 'thimpress' ); ?></button>
		</div>
	</form>
</div>