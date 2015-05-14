<?php
if ( ! class_exists( 'THIM_Option' ) ) {
    /**
     * Thim Theme
     *
     * Manage Option in the THIM Framework
     *
     * @class THIM_Option
     * @package thimpress
     * @since 1.0
     * @author kien16
     */
    class THIM_Option {
        /**
         * @var array option information
         */
        public $option;

        public $data;

        public $output;

        // Safe to start up
        public function __construct ( $args ) {
            $this->option = $this->register_settings( $args );
            // Assign meta box values to local variables and add it's missed values
            $this->output = $this->display_setting( $this->option );
        }

        /**
        * Register settings
        *
        * @since 1.0
        */
        public function register_settings($args) {
            
            foreach ( $args as $id => $setting ) {
                $option[] = $this->create_setting( $setting );
            }
            return $option;
            
        }
        /**
         * Create settings field
         *
         * @since 1.0
         */
        public function create_setting( $args = array() ) {
            
            // Set default values for meta box
            $option = wp_parse_args( $args, array(
                'id'      => 'default_field',
                'name'   => __( 'Default Field' ),
                'desc'    => __( '' ),
                'std'     => '',
                'type'    => 'text',
                'options' => array(),
                'class'   => ''
            ) );
            return $option;
        }
        /**
         * HTML output for text field
         *
         * @since 1.0
         */
        public function display_setting( $args = array() ) {
            if ( ! get_option( THIM_PORTFOLIO_OPTION ) ) {
                $this->initialize_settings();
            }
            $options_data = get_option(THIM_PORTFOLIO_OPTION);

            $this->data = $options_data;

            $output = "";
            foreach ( $args as $value ) {
                switch ( $value['type'] ) {
                    
                    case 'heading':
                        $output .= '<div class="heading">';
                        $output .= '<h3>' . $value['name'] . '</h3>';
                        $output .= '<div class="description">'.$value['desc'].'</div>';
                        $output .= '</div>';
                        
                        break;
                    case 'checkbox':
                        if (isset($options_data[$value['id']])) {
                            $cb = $options_data[$value['id']];
                        }else if (isset($value['std'])){
                            $cb = $value['std'];
                        }else {
                            $cb = 0;
                        }
                        $output .= '<label class="title" for="'.$value['id'].'">'.$value['name'].'</label>';
                        $output .= '<input type="checkbox" class="checkbox of-input" name="' . $value['id'] . '" id="' . $value['id'] . '" value="1" ' . checked($cb, 1, false) . ' />';
                        $output .= '<div class="description">'.$value['desc'].'</div>';
                        
                        break;
                    case 'select':
                        if (isset($options_data[$value['id']])) {
                            $sl = $options_data[$value['id']];
                        }else if (isset($value['std'])){
                            $sl = $value['std'];
                        }else {
                            $sl = "";
                        }

                        $output .= '<div class="select_wrapper">';
                        $output .= '<label class="title" for="'.$value['id'].'">'.$value['name'].'</label>';
                        $output .= '<select class="select of-input" name="' . $value['id'] . '" id="' . $value['id'] . '">';

                        foreach ($value['options'] as $select_ID => $option) {
                            $theValue = $option;
                            if (!is_numeric($select_ID)) {
                                $theValue = $select_ID;
                            }
                            $output .= '<option id="' . $select_ID . '" value="' . $theValue . '" ' . selected($sl, $theValue, false) . ' />' . $option . '</option>';
                        }
                        $output .= '</select>';
                        $output .= '<div class="description">'.$value['desc'].'</div>';
                        $output .= '</div>';
                       
                        break;
                    
                    case 'radio':
                        if (isset($options_data[$value['id']])) {
                            $ra = $options_data[$value['id']];
                        }else if (isset($value['std'])){
                            $ra = $value['std'];
                        }else {
                            $ra = "";
                        }

                        $i = 0;
                        $output .= '<label class="title" for="'.$value['id'].'">'.$value['name'].'</label>';
                        foreach ( $value['options'] as $v => $label ) {
                            $output .= '<input class="radio" type="radio" name="'.$value['id'].'" id="' . $value['id'] . $i . '" value="' . esc_attr( $v ) . '" ' . checked( $ra, $v, false ) . '> <label for="' . $value['id'] . $i . '">' . $label . '</label>';
                            $i++;
                        }
                        $output .= '<div class="description">'.$value['desc'].'</div>';
                        
                        break;
                    case 'radioimage':

                        if (isset($options_data[$value['id']])) {
                            $ri_value = $options_data[$value['id']];
                        }else {
                            $ri_value = $value['std'];
                        }

                        $output .= '<div class="radio-image">';
                        $output .= '<label class="title" for="'.$value['id'].'">'.$value['name'].'</label>';
                        $i = 0;
                        foreach ($value['options'] as $key => $option) {
                            $i ++;

                            $checked = '';
                            $selected = '';
                            if (NULL != checked($ri_value, $key, false)) {
                                $checked = checked($ri_value, $key, false);
                                $selected = 'of-radio-img-selected';
                            }
                            $image_thumb_index = strrpos($option, '.', - 1);
                            $image_thumb = $option;//substr_replace($option, '_thumb', $image_thumb_index, 0);
                            $output .= '<div class="image-box">';
                            $output .= '<span>';
                            $output .= '<input type="radio" id="of-radio-img-' . $value['id'] . $i . '" class="checkbox of-radio-img-radio" value="' . $key . '" name="' . $value['id'] . '" ' . $checked . ' />';
                            $output .= '<img src="' . $image_thumb . '" alt="" class="of-radio-img-img-header ' . $selected . '" onClick="document.getElementById(\'of-radio-img-' . $value['id'] . $i . '\').checked = true;" rel-data="' . ( ( $i - 1 ) % 6 ) . '"/>';
                            $output .= '</span>';
                            $output .= '</div>';
                        }
                        $output .= '<div class="description">'.$value['desc'].'</div>';
                        $output .= '</div>';
                        
                        break;
                    case 'textarea':
                        if (isset($options_data[$value['id']])) {
                            $ta = $options_data[$value['id']];
                        }else if (isset($value['std'])){
                            $ta = $value['std'];
                        }else {
                            $ta = "";
                        }

                        $ta_value = stripslashes($ta);
                        $output .= '<label class="title" for="'.$value['id'].'">'.$value['name'].'</label>';
                        $output .= '<textarea class="of-input" name="' . $value['id'] . '" id="' . $value['id'] . '" cols="' . $cols . '" rows="8">' . $ta_value . '</textarea>';
                        $output .= '<div class="description">'.$value['desc'].'</div>';
                        
                        break;
                    case 'number':
                        $output .= '<div>';
                        $output .= '<label class="title" for="'.$value['id'].'">'.$value['name'].'</label>';
                        $output .= '<input type="number" id="' . $value['id'] . '" name="' . $value['id'] . '" value="' . ($options_data[$value['id']] ? $options_data[$value['id']] : $value['std']) . '" />';
                        $output .= '<div class="description">'.$value['desc'].'</div>';
                        $output .= '</div>';

                        break;
                    case 'text':
                        $output .= '<div>';
                        $output .= '<label class="title" for="'.$value['id'].'">'.$value['name'].'</label>';
                        $output .= '<input type="text" id="' . $value['id'] . '" name="' . $value['id'] . '" value="' . ($options_data[$value['id']] ? $options_data[$value['id']] : $value['std']) . '" />';
                        $output .= '<div class="description">'.$value['desc'].'</div>';
                        $output .= '</div>';

                        break;
                    default:
                        $output .= '<div>';
                        $output .= '<label class="title" for="'.$value['id'].'">'.$value['name'].'</label>';
                        $output .= '<input type="text" id="' . $value['id'] . '" name="' . $value['id'] . '" value="' . ($options_data[$value['id']] ? $options_data[$value['id']] : $value['std']) . '" />';
                        $output .= '<div class="description">'.$value['desc'].'</div>';
                        $output .= '</div>';

                        break;
                }
            }
            return  $output;
        }

        /**
         * Initialize settings to their default values
         * 
         * @since 1.0
         */
        public function initialize_settings() {
            $default_settings = array();
            foreach ( $this->option as $id => $setting ) {

                if ( $setting['type'] != 'heading' )
                    $default_settings[$setting['id']] = $setting['std'];
            }
            
            update_option( THIM_PORTFOLIO_OPTION, $default_settings );
            
        }
    }     
}