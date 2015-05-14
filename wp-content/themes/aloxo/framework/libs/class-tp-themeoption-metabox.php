<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


/**
 * Description of class-tp-import-update
 *
 * @author Tuannv
 */
class Thim_ThemeOption_And_Metabox {
    function __construct() {
        add_action('tf_create_options', array($this, 'create_theme_option'));
    }
    function create_theme_option()
    {
        $titan = TitanFramework::getInstance('thim');
        
        $panel = $titan->createAdminPanel(array(
            'name' => 'Import Demo Data',
        ));

        //data demo tab
        $data_demo_tab = $panel->createTab(array(
            'name' => 'Demo Data',
        ));

        $data_demo_tab->createOption(array(
            'type' => 'Import',
            'import' => 'Import Demo Data'
        ));

        // update theme tab
//        $update_theme = $panel->createTab(array(
//            'name' => 'Theme Update',
//        ));
//        
//        $update_theme->createOption(array(
//            'name' => 'Update your Theme from the WordPress Dashboard',           
//            'type' => 'heading',
//        ));
//        
//        $update_theme->createOption(array(
//            'paragraph' => false,
//            'type' => 'note',
//            'desc' => 'If you want to get update notifications for your themes and if you want to be able to update your theme from your WordPress backend you need to enter your Themeforest account name as well as your Themeforest Secret API Key below:
//'
//        ));
//        
//        $update_theme->createOption(array(
//            'name' => 'Your Themeforest User Name',
//            'id' => 'themeforest_username',
//            'type' => 'Text',
//            'desc' => 'Enter the Name of the User you used to purchase this theme '
//        ));
//
//        $update_theme->createOption(array(
//            'name' => 'Your Themeforest API Key',
//            'id' => 'themeforest_api_key',
//            'type' => 'Text',
//            'desc' => 'Enter the API Key of your Account here. 
//Where can you get an API key? To generate an API key, select Settings from the account dropdown, then navigate to the API Keys tab. Multiple API keys can be generated so it is recommended to use one per application. '
//        ));
        
        // Post Format
        include ('meta-box/post-format.php');
        // Display Setting
        include ('meta-box/setting.php');
        
    }
}
new Thim_ThemeOption_And_Metabox();

