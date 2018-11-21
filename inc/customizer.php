<?php
/**
 * _s Theme Customizer
 *
 * @package acme
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function acme_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->default   = '#1FA67A';
}
add_action( 'customize_register', 'acme_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function acme_customize_preview_js() {
	wp_enqueue_script( 'acme_customizer', get_template_directory_uri() . '/inc/js/customizer.js', array( 'customize-preview' ), '20150423', true );
}
add_action( 'customize_preview_init', 'acme_customize_preview_js' );

/**
 * Options for acme Theme Customizer.
 */
function acme_customizer( $wp_customize ) {

    /* Main option Settings Panel */
    $wp_customize->add_panel('acme_main_options', array(
        'capability' => 'edit_theme_options',
        'theme_supports' => '',
        'title' => __('acme Options', 'acme'),
        'description' => __('Panel to update acme theme options', 'acme'), // Include html tags such as <p>.
        'priority' => 10 // Mixed with top-level-section hierarchy.
    ));

        /* acme Main Options */
        $wp_customize->add_section('acme_slider_options', array(
            'title' => __('Slider options', 'acme'),
            'priority' => 31,
            'panel' => 'acme_main_options'
        ));
            $wp_customize->add_setting( 'acme[acme_slider_checkbox]', array(
                    'default' => 0,
                    'type' => 'option',
                    'sanitize_callback' => 'acme_sanitize_checkbox',
            ) );
            $wp_customize->add_control( 'acme[acme_slider_checkbox]', array(
                    'label'	=> esc_html__( 'Check if you want to enable slider', 'acme' ),
                    'section'	=> 'acme_slider_options',
                    'priority'	=> 5,
                    'type'      => 'checkbox',
            ) );

            // Pull all the categories into an array
            global $options_categories;
            $wp_customize->add_setting('acme[acme_slide_categories]', array(
                'default' => '',
                'type' => 'option',
                'capability' => 'edit_theme_options',
                'sanitize_callback' => 'acme_sanitize_slidecat'
            ));
            $wp_customize->add_control('acme[acme_slide_categories]', array(
                'label' => __('Slider Category', 'acme'),
                'section' => 'acme_slider_options',
                'type'    => 'select',
                'description' => __('Select a category for the featured post slider', 'acme'),
                'choices'    => $options_categories
            ));

            $wp_customize->add_setting('acme[acme_slide_number]', array(
                'default' => 3,
                'type' => 'option',
                'sanitize_callback' => 'acme_sanitize_number'
            ));
            $wp_customize->add_control('acme[acme_slide_number]', array(
                'label' => __('Number of slide items', 'acme'),
                'section' => 'acme_slider_options',
                'description' => __('Enter the number of slide items', 'acme'),
                'type' => 'text'
            ));

        $wp_customize->add_section('acme_layout_options', array(
            'title' => __('Layout options', 'acme'),
            'priority' => 31,
            'panel' => 'acme_main_options'
        ));
            // Layout options
            global $site_layout;
            $wp_customize->add_setting('acme[site_layout]', array(
                 'default' => 'side-pull-left',
                 'type' => 'option',
                 'sanitize_callback' => 'acme_sanitize_layout'
            ));
            $wp_customize->add_control('acme[site_layout]', array(
                 'label' => __('Website Layout Options', 'acme'),
                 'section' => 'acme_layout_options',
                 'type'    => 'select',
                 'description' => __('Choose between different layout options to be used as default', 'acme'),
                 'choices'    => $site_layout
            ));

            $wp_customize->add_setting('acme[element_color]', array(
                'default' => '',
                'type'  => 'option',
                'sanitize_callback' => 'acme_sanitize_hexcolor'
            ));
            $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'acme[element_color]', array(
                'label' => __('Element Color', 'acme'),
                'description'   => __('Default used if no color is selected','acme'),
                'section' => 'acme_layout_options',
                'settings' => 'acme[element_color]',
            )));

            $wp_customize->add_setting('acme[element_color_hover]', array(
                'default' => '',
                'type'  => 'option',
                'sanitize_callback' => 'acme_sanitize_hexcolor'
            ));
            $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'acme[element_color_hover]', array(
                'label' => __('Element color on hover', 'acme'),
                'description'   => __('Default used if no color is selected','acme'),
                'section' => 'acme_layout_options',
                'settings' => 'acme[element_color_hover]',
            )));

         /* acme Action Options */
        $wp_customize->add_section('acme_action_options', array(
            'title' => __('Action Button', 'acme'),
            'priority' => 31,
            'panel' => 'acme_main_options'
        ));
            $wp_customize->add_setting('acme[w2f_cfa_text]', array(
                'default' => '',
                'type' => 'option',
                'sanitize_callback' => 'acme_sanitize_strip_slashes'
            ));
            $wp_customize->add_control('acme[w2f_cfa_text]', array(
                'label' => __('Call For Action Text', 'acme'),
                'description' => sprintf(__('Enter the text for call for action section', 'acme')),
                'section' => 'acme_action_options',
                'type' => 'textarea'
            ));

            $wp_customize->add_setting('acme[w2f_cfa_button]', array(
                'default' => '',
                'type' => 'option',
                'sanitize_callback' => 'acme_sanitize_nohtml'
            ));
            $wp_customize->add_control('acme[w2f_cfa_button]', array(
                'label' => __('Call For Action Button Title', 'acme'),
                'section' => 'acme_action_options',
                'description' => __('Enter the title for Call For Action button', 'acme'),
                'type' => 'text'
            ));

            $wp_customize->add_setting('acme[w2f_cfa_link]', array(
                'default' => '',
                'type' => 'option',
                'sanitize_callback' => 'esc_url_raw'
            ));
            $wp_customize->add_control('acme[w2f_cfa_link]', array(
                'label' => __('CFA button link', 'acme'),
                'section' => 'acme_action_options',
                'description' => __('Enter the link for Call For Action button', 'acme'),
                'type' => 'text'
            ));

            $wp_customize->add_setting('acme[cfa_color]', array(
                'default' => '',
                'type'  => 'option',
                'sanitize_callback' => 'acme_sanitize_hexcolor'
            ));
            $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'acme[cfa_color]', array(
                'label' => __('Call For Action Text Color', 'acme'),
                'description'   => __('Default used if no color is selected','acme'),
                'section' => 'acme_action_options',
            )));
            $wp_customize->add_setting('acme[cfa_bg_color]', array(
                'default' => '',
                'type'  => 'option',
                'sanitize_callback' => 'acme_sanitize_hexcolor'
            ));
            $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'acme[cfa_bg_color]', array(
                'label' => __('Call For Action Background Color', 'acme'),
                'description'   => __('Default used if no color is selected','acme'),
                'section' => 'acme_action_options',
            )));
            $wp_customize->add_setting('acme[cfa_btn_color]', array(
                'default' => '',
                'type'  => 'option',
                'sanitize_callback' => 'acme_sanitize_hexcolor'
            ));
            $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'acme[cfa_btn_color]', array(
                'label' => __('Call For Action Button Border Color', 'acme'),
                'description'   => __('Default used if no color is selected','acme'),
                'section' => 'acme_action_options',
            )));
            $wp_customize->add_setting('acme[cfa_btn_txt_color]', array(
                'default' => '',
                'type'  => 'option',
                'sanitize_callback' => 'acme_sanitize_hexcolor'
            ));
            $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'acme[cfa_btn_txt_color]', array(
                'label' => __('Call For Action Button Text Color', 'acme'),
                'description'   => __('Default used if no color is selected','acme'),
                'section' => 'acme_action_options',
            )));

        /* acme Typography Options */
        $wp_customize->add_section('acme_typography_options', array(
            'title' => __('Typography', 'acme'),
            'priority' => 31,
            'panel' => 'acme_main_options'
        ));
            global $typography_defaults;

            // Typography Options
            global $typography_options;
            $wp_customize->add_setting('acme[main_body_typography][size]', array(
                'default' => $typography_defaults['size'],
                'type' => 'option',
                'sanitize_callback' => 'acme_sanitize_typo_size'
            ));
            $wp_customize->add_control('acme[main_body_typography][size]', array(
                'label' => __('Main Body Text', 'acme'),
                'description' => __('Used in p tags', 'acme'),
                'section' => 'acme_typography_options',
                'type'    => 'select',
                'choices'    => $typography_options['sizes']
            ));
            $wp_customize->add_setting('acme[main_body_typography][face]', array(
                'default' => $typography_defaults['face'],
                'type' => 'option',
                'sanitize_callback' => 'acme_sanitize_typo_face'
            ));
            $wp_customize->add_control('acme[main_body_typography][face]', array(
                'section' => 'acme_typography_options',
                'type'    => 'select',
                'choices'    => $typography_options['faces']
            ));
            $wp_customize->add_setting('acme[main_body_typography][style]', array(
                'default' => $typography_defaults['style'],
                'type' => 'option',
                'sanitize_callback' => 'acme_sanitize_typo_style'
            ));
            $wp_customize->add_control('acme[main_body_typography][style]', array(
                'section' => 'acme_typography_options',
                'type'    => 'select',
                'choices'    => $typography_options['styles']
            ));
            $wp_customize->add_setting('acme[main_body_typography][color]', array(
                'default' => $typography_defaults['color'],
                'type'  => 'option',
                'sanitize_callback' => 'acme_sanitize_hexcolor'
            ));
            $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'acme[main_body_typography][color]', array(
                'section' => 'acme_typography_options',
            )));

            $wp_customize->add_setting('acme[heading_color]', array(
                'default' => '',
                'type'  => 'option',
                'sanitize_callback' => 'acme_sanitize_hexcolor'
            ));
            $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'acme[heading_color]', array(
                'label' => __('Heading Color', 'acme'),
                'description'   => __('Color for all headings (h1-h6)','acme'),
                'section' => 'acme_typography_options',
            )));
            $wp_customize->add_setting('acme[link_color]', array(
                'default' => '',
                'type'  => 'option',
                'sanitize_callback' => 'acme_sanitize_hexcolor'
            ));
            $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'acme[link_color]', array(
                'label' => __('Link Color', 'acme'),
                'description'   => __('Default used if no color is selected','acme'),
                'section' => 'acme_typography_options',
            )));
            $wp_customize->add_setting('acme[link_hover_color]', array(
                'default' => '',
                'type'  => 'option',
                'sanitize_callback' => 'acme_sanitize_hexcolor'
            ));
            $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'acme[link_hover_color]', array(
                'label' => __('Link:hover Color', 'acme'),
                'description'   => __('Default used if no color is selected','acme'),
                'section' => 'acme_typography_options',
            )));

        /* acme Header Options */
        $wp_customize->add_section('acme_header_options', array(
            'title' => __('Header', 'acme'),
            'priority' => 31,
            'panel' => 'acme_main_options'
        ));
            $wp_customize->add_setting('acme[top_nav_bg_color]', array(
                'default' => '',
                'type'  => 'option',
                'sanitize_callback' => 'acme_sanitize_hexcolor'
            ));
            $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'acme[top_nav_bg_color]', array(
                'label' => __('Top nav background color', 'acme'),
                'description'   => __('Default used if no color is selected','acme'),
                'section' => 'acme_header_options',
            )));
            $wp_customize->add_setting('acme[top_nav_link_color]', array(
                'default' => '',
                'type'  => 'option',
                'sanitize_callback' => 'acme_sanitize_hexcolor'
            ));
            $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'acme[top_nav_link_color]', array(
                'label' => __('Top nav item color', 'acme'),
                'description'   => __('Link color','acme'),
                'section' => 'acme_header_options',
            )));

            $wp_customize->add_setting('acme[top_nav_dropdown_bg]', array(
                'default' => '',
                'type'  => 'option',
                'sanitize_callback' => 'acme_sanitize_hexcolor'
            ));
            $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'acme[top_nav_dropdown_bg]', array(
                'label' => __('Top nav dropdown background color', 'acme'),
                'description'   => __('Background of dropdown item hover color','acme'),
                'section' => 'acme_header_options',
            )));

            $wp_customize->add_setting('acme[top_nav_dropdown_item]', array(
                'default' => '',
                'type'  => 'option',
                'sanitize_callback' => 'acme_sanitize_hexcolor'
            ));
            $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'acme[top_nav_dropdown_item]', array(
                'label' => __('Top nav dropdown item color', 'acme'),
                'description'   => __('Dropdown item color','acme'),
                'section' => 'acme_header_options',
            )));

        /* acme Footer Options */
        $wp_customize->add_section('acme_footer_options', array(
            'title' => __('Footer', 'acme'),
            'priority' => 31,
            'panel' => 'acme_main_options'
        ));
            $wp_customize->add_setting('acme[footer_widget_bg_color]', array(
                'default' => '',
                'type'  => 'option',
                'sanitize_callback' => 'acme_sanitize_hexcolor'
            ));
            $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'acme[footer_widget_bg_color]', array(
                'label' => __('Footer widget area background color', 'acme'),
                'section' => 'acme_footer_options',
            )));

            $wp_customize->add_setting('acme[footer_bg_color]', array(
                'default' => '',
                'type'  => 'option',
                'sanitize_callback' => 'acme_sanitize_hexcolor'
            ));
            $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'acme[footer_bg_color]', array(
                'label' => __('Footer background color', 'acme'),
                'section' => 'acme_footer_options',
            )));

            $wp_customize->add_setting('acme[footer_text_color]', array(
                'default' => '',
                'type'  => 'option',
                'sanitize_callback' => 'acme_sanitize_hexcolor'
            ));
            $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'acme[footer_text_color]', array(
                'label' => __('Footer text color', 'acme'),
                'section' => 'acme_footer_options',
            )));

            $wp_customize->add_setting('acme[footer_link_color]', array(
                'default' => '',
                'type'  => 'option',
                'sanitize_callback' => 'acme_sanitize_hexcolor'
            ));
            $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'acme[footer_link_color]', array(
                'label' => __('Footer link color', 'acme'),
                'section' => 'acme_footer_options',
            )));

            $wp_customize->add_setting('acme[custom_footer_text]', array(
                'default' => '',
                'type' => 'option',
                'sanitize_callback' => 'acme_sanitize_strip_slashes'
            ));
            $wp_customize->add_control('acme[custom_footer_text]', array(
                'label' => __('Footer information', 'acme'),
                'description' => sprintf(__('Copyright text in footer', 'acme')),
                'section' => 'acme_footer_options',
                'type' => 'textarea'
            ));

        /* acme Social Options */
        $wp_customize->add_section('acme_social_options', array(
            'title' => __('Social', 'acme'),
            'priority' => 31,
            'panel' => 'acme_main_options'
        ));
            $wp_customize->add_setting('acme[social_color]', array(
                'default' => '',
                'type'  => 'option',
                'sanitize_callback' => 'acme_sanitize_hexcolor'
            ));
            $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'acme[social_color]', array(
                'label' => __('Social icon color', 'acme'),
                'description' => sprintf(__('Default used if no color is selected', 'acme')),
                'section' => 'acme_social_options',
            )));

            $wp_customize->add_setting('acme[social_hover_color]', array(
                'default' => '',
                'type'  => 'option',
                'sanitize_callback' => 'acme_sanitize_hexcolor'
            ));
            $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'acme[social_hover_color]', array(
                'label' => __('Social Icon:hover Color', 'acme'),
                'description' => sprintf(__('Default used if no color is selected', 'acme')),
                'section' => 'acme_social_options',
            )));

            $wp_customize->add_setting('acme[footer_social]', array(
                'default' => 0,
                'type' => 'option',
                'sanitize_callback' => 'acme_sanitize_checkbox'
            ));
            $wp_customize->add_control('acme[footer_social]', array(
                'label' => __('Footer Social Icons', 'acme'),
                'description' => sprintf(__('Check to show social icons in footer', 'acme')),
                'section' => 'acme_social_options',
                'type' => 'checkbox',
            ));

        /* acme Other Options */
        $wp_customize->add_section('acme_other_options', array(
            'title' => __('Other', 'acme'),
            'priority' => 31,
            'panel' => 'acme_main_options'
        ));
            $wp_customize->add_setting('acme[custom_css]', array(
                'default' => '',
                'type' => 'option',
                'sanitize_callback' => 'acme_sanitize_strip_slashes'
            ));
            $wp_customize->add_control('acme[custom_css]', array(
                'label' => __('Custom CSS', 'acme'),
                'description' => sprintf(__('Additional CSS', 'acme')),
                'section' => 'acme_other_options',
                'type' => 'textarea'
            ));

        $wp_customize->add_section('acme_important_links', array(
            'priority' => 5,
            'title' => __('Support and Documentation', 'acme')
        ));
            $wp_customize->add_setting('acme[imp_links]', array(
              'sanitize_callback' => 'esc_url_raw'
            ));
            $wp_customize->add_control(
            new acme_Important_Links(
            $wp_customize,
                'acme[imp_links]', array(
                'section' => 'acme_important_links',
                'type' => 'acme-important-links'
            )));

}
add_action( 'customize_register', 'acme_customizer' );



/**
 * Sanitize checkbox for WordPress customizer
 */
function acme_sanitize_checkbox( $input ) {
    if ( $input == 1 ) {
        return 1;
    } else {
        return '';
    }
}
/**
 * Adds sanitization callback function: colors
 * @package acme
 */
function acme_sanitize_hexcolor($color) {
    if ($unhashed = sanitize_hex_color_no_hash($color))
        return '#' . $unhashed;
    return $color;
}

/**
 * Adds sanitization callback function: Nohtml
 * @package acme
 */
function acme_sanitize_nohtml($input) {
    return wp_filter_nohtml_kses($input);
}

/**
 * Adds sanitization callback function: Number
 * @package acme
 */
function acme_sanitize_number($input) {
    if ( isset( $input ) && is_numeric( $input ) ) {
        return $input;
    }
}

/**
 * Adds sanitization callback function: Strip Slashes
 * @package acme
 */
function acme_sanitize_strip_slashes($input) {
    return wp_kses_stripslashes($input);
}

/**
 * Adds sanitization callback function: Slider Category
 * @package acme
 */
function acme_sanitize_slidecat( $input ) {
    global $options_categories;
    if ( array_key_exists( $input, $options_categories ) ) {
        return $input;
    } else {
        return '';
    }
}

/**
 * Adds sanitization callback function: Sidebar Layout
 * @package acme
 */
function acme_sanitize_layout( $input ) {
    global $site_layout;
    if ( array_key_exists( $input, $site_layout ) ) {
        return $input;
    } else {
        return '';
    }
}

/**
 * Adds sanitization callback function: Typography Size
 * @package acme
 */
function acme_sanitize_typo_size( $input ) {
    global $typography_options,$typography_defaults;
    if ( array_key_exists( $input, $typography_options['sizes'] ) ) {
        return $input;
    } else {
        return $typography_defaults['size'];
    }
}
/**
 * Adds sanitization callback function: Typography Face
 * @package acme
 */
function acme_sanitize_typo_face( $input ) {
    global $typography_options,$typography_defaults;
    if ( array_key_exists( $input, $typography_options['faces'] ) ) {
        return $input;
    } else {
        return $typography_defaults['face'];
    }
}
/**
 * Adds sanitization callback function: Typography Style
 * @package acme
 */
function acme_sanitize_typo_style( $input ) {
    global $typography_options,$typography_defaults;
    if ( array_key_exists( $input, $typography_options['styles'] ) ) {
        return $input;
    } else {
        return $typography_defaults['style'];
    }
}

/**
 * Add CSS for custom controls
 */
function acme_customizer_custom_control_css() {
	?>
    <style>
        #customize-control-acme-main_body_typography-size select, #customize-control-acme-main_body_typography-face select,#customize-control-acme-main_body_typography-style select { width: 60%; }
    </style><?php
}
add_action( 'customize_controls_print_styles', 'acme_customizer_custom_control_css' );

if ( ! class_exists( 'WP_Customize_Control' ) )
    return NULL;
/**
 * Class to create a acme important links
 */
class acme_Important_Links extends WP_Customize_Control {

   public $type = "acme-important-links";

   public function render_content() {?>
         <!-- Twitter -->
        <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>

        <!-- Facebook -->
        <div id="fb-root"></div>
        <script>
            (function(d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s); js.id = id;
            js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=328285627269392";
            fjs.parentNode.insertBefore(js, fjs);
            }(document, 'script', 'facebook-jssdk'));
        </script>

        <div class="inside">
            <div id="social-share">
              <div class="fb-like" data-href="<?php echo esc_url( 'https://www.facebook.com/colorlib' ); ?>" data-send="false" data-layout="button_count" data-width="90" data-show-faces="true"></div>
              <div class="tw-follow" ><a href="https://twitter.com/colorlib" class="twitter-follow-button" data-show-count="false">Follow @colorlib</a></div>
            </div>
            <p><b><a href="<?php echo esc_url( 'http://colorlib.com/wp/support/acme' ); ?>"><?php esc_html_e('acme Documentation','acme'); ?></a></b></p>
            <p><?php _e('The best way to contact us with <b>support questions</b> and <b>bug reports</b> is via','acme') ?> <a href="<?php echo esc_url( 'http://colorlib.com/wp/forums' ); ?>"><?php esc_html_e('Colorlib support forum','acme') ?></a>.</p>
            <p><?php esc_html_e('If you like this theme, I\'d appreciate any of the following:','acme') ?></p>
            <ul>
              <li><a class="button" href="<?php echo esc_url( 'http://wordpress.org/support/view/theme-reviews/acme?filter=5' ); ?>" title="<?php esc_attr_e('Rate this Theme', 'acme'); ?>" target="_blank"><?php printf(esc_html__('Rate this Theme','acme')); ?></a></li>
              <li><a class="button" href="<?php echo esc_url( 'http://www.facebook.com/colorlib' ); ?>" title="Like Colorlib on Facebook" target="_blank"><?php printf(esc_html__('Like on Facebook','acme')); ?></a></li>
              <li><a class="button" href="<?php echo esc_url( 'http://twitter.com/colorlib/' ); ?>" title="Follow Colrolib on Twitter" target="_blank"><?php printf(esc_html__('Follow on Twitter','acme')); ?></a></li>
            </ul>
        </div><?php
   }

}

/*
 * Custom Scripts
 */
add_action( 'customize_controls_print_footer_scripts', 'customizer_custom_scripts' );

function customizer_custom_scripts() { ?>
<script type="text/javascript">
    jQuery(document).ready(function() {
        /* This one shows/hides the an option when a checkbox is clicked. */
        jQuery('#customize-control-acme-acme_slide_categories, #customize-control-acme-acme_slide_number').hide();
        jQuery('#customize-control-acme-acme_slider_checkbox input').click(function() {
            jQuery('#customize-control-acme-acme_slide_categories, #customize-control-acme-acme_slide_number').fadeToggle(400);
        });

        if (jQuery('#customize-control-acme-acme_slider_checkbox input:checked').val() !== undefined) {
            jQuery('#customize-control-acme-acme_slide_categories, #customize-control-acme-acme_slide_number').show();
        }
    });
</script>
<style>
    li#accordion-section-acme_important_links h3.accordion-section-title, li#accordion-section-acme_important_links h3.accordion-section-title:focus { background-color: #00cc00 !important; color: #fff !important; }
    li#accordion-section-acme_important_links h3.accordion-section-title:hover { background-color: #00b200 !important; color: #fff !important; }
    li#accordion-section-acme_important_links h3.accordion-section-title:after { color: #fff !important; }
</style>
<?php
}
