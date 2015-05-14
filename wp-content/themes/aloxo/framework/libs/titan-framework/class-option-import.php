<?php
if ( !defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

class TitanFrameworkOptionImport extends TitanFrameworkOption {

	public $defaultSecondarySettings = array(
		'import' => '',
		'desc'   => 'Warning: You must import the sample data file before customizing your theme.
            If you customize your theme, and later import a sample data file, all current contents entered in your site will be overwritten to the default settings of the file you are uploading! Please proceed with the utmost care, after exporting all current data!
            Note: If you get errors, please be sure that your server configured Memory Limit >=64MB and Execution Time >=60.'
	);

	public function display() {
		wp_enqueue_script( 'tp-import', TP_FRAMEWORK_LIBS_URI . '/titan-framework/js/tp-import.js', array(), false, true );
		if ( !empty( $this->owner->postID ) ) {
			return;
		}
		if ( empty( $this->settings['import'] ) ) {
			$this->settings['import'] = __( 'Import', TF_I18NDOMAIN );
		}
		?>
        </tbody>
        </table>
      
        <p class='submit'>
            <span class="button button-primary tp-import-action">
                <?php echo $this->settings['import'] ?>
            </span>
            <br><?php echo $this->settings['desc'] ?>
        </p>
          <div class="tp_process_bar" style="display:none;">
				<div class="tpimport_core">
					<div class="meter">
						<span style="width: 0px"></span>
					</div>
					<span class="text_note">Installing demo data...</span>
				</div>
				<div class="tpimport_widgets">
					<div class="meter">
						<span style="width: 0px"></span>
					</div>
					<span class="text_note">Add widgets...</span>
				</div>
				<div class="tpimport_setting">
					<div class="meter">
						<span style="width: 0px"></span>
					</div>
					<span class="text_note">Reset theme options...</span>
				</div>
				<div class="tpimport_menus">
					<div class="meter">
						<span style="width: 0px"></span>
					</div>
					<span class="text_note">Setup menus...</span>
				</div>
                <?php  if (class_exists('RevSlider')) {?>
                <div class="tpimport_slider">
					<div class="meter">
						<span style="width: 0px"></span>
					</div>
					<span class="text_note">Setup slider...(if import slider don`t finish you can import manual, please view http://thimpress.com/knowledge-base/import-revolution-sliders/)</span>
				</div>
                <?php }?>              
			</div>

        <table class='form-table'>
            <tbody>
                <?php
	}

}
        