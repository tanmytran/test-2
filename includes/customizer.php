<?php
/**
 * SmartShop Theme Customizer
 *
 * @package SmartShop
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function smartshop_customize_register($wp_customize) {
    $wp_customize->get_setting('blogname')->transport = 'postMessage';
    $wp_customize->get_setting('blogdescription')->transport = 'postMessage';

    // reorganize background settings in customizer
    $wp_customize->get_control( 'background_color'  )->section   = 'background_image';
    $wp_customize->get_section( 'background_image'  )->title     = __('Background Settings','smartshop');
    $wp_customize->get_section( 'background_image' )->description = __('Please note that background color and image settings work only for Boxed Layout','smartshop'); 
    
    // reorganize header settings in cusotmizer
    $wp_customize->get_control( 'header_textcolor'  )->section   = 'header_image';
    $wp_customize->get_control( 'display_header_text' )->section = 'header_image'; 
    $wp_customize->get_section( 'header_image'  )->title     = __('Header Settings','smartshop');
    
    $wp_customize->get_section( 'header_image'  )->priority     = 30;
    $wp_customize->get_section( 'background_image' )->priority  = 30; 
}

add_action('customize_register', 'smartshop_customize_register', 12);


function smartshop_customizer($wp_customize) {

    class smartshop_customize_textarea_control extends WP_Customize_Control {

        public $type = 'textarea';

        public function render_content() {
            ?>

            <label>
                <span class="customize-control-title"><?php echo esc_html($this->label); ?></span>
                <textarea rows="5" style="width:98%;" <?php $this->link(); ?>><?php echo esc_textarea($this->value()); ?></textarea>
            </label>

            <?php
        }

    }

    // Add new section for theme layout and color schemes
    $wp_customize->add_section('smartshop_theme_layout_settings', array(
        'title' => __('Theme Layout & Colors', 'smartshop'),
        'priority' => 30,
    ));

    // Add setting for theme layout
    $wp_customize->add_setting('smartshop_theme_layout', 
            array( 
                'default' => __('boxed','smartshop'), 
                'sanitize_callback' => 'smartshop_sanitize_layout_option',
                )
            );

    $wp_customize->add_control('smartshop_theme_layout', array(
        'label' => 'Layout Options',
        'section' => 'smartshop_theme_layout_settings',
        'type' => 'radio',
        'choices' => array(
            'full-width' => __('Full Width', 'smartshop'),
            'boxed' => __('Boxed', 'smartshop'),
        ),
    ));
    
    // Add setting for primary color
    $wp_customize->add_setting('smartshop_theme_primary_color', array(
        'default' => '#F84545', 
        'sanitize_callback' => 'smartshop_sanitize_hex_color',
        'sanitize_js_callback' => 'smartshop_sanitize_escaping',
    ));
    
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'smartshop_theme_primary_color',
        array(
            'label' => 'Primary Color',
            'section' => 'smartshop_theme_layout_settings',
            'settings' => 'smartshop_theme_primary_color',
        )
    ));

    // Add setting for secondary color
    $wp_customize->add_setting('smartshop_theme_secondary_color', array(
        'default' => '#FFF', 
        'sanitize_callback' => 'smartshop_sanitize_hex_color',
        'sanitize_js_callback' => 'smartshop_sanitize_escaping',
    ));
    
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'smartshop_theme_secondary_color',
        array(
            'label' => 'Secondary Color',
            'section' => 'smartshop_theme_layout_settings',
            'settings' => 'smartshop_theme_secondary_color',
        )
    ));

    if (class_exists('Easy_Digital_Downloads')) {
        $wp_customize->add_section('smartshop_edd_options', array(
            'title' => __('Easy Digital Downloads', 'smartshop'),
            'description' => __('All other EDD options are under Dashboard => Downloads.', 'smartshop'),
            'priority' => 70,
        ));

        // enable featured products on front page?
        $wp_customize->add_setting('smartshop_edd_front_featured_products',array (
            'default' => 0, 
            'sanitize_callback' => 'smartshop_sanitize_checkbox',
        ));
        $wp_customize->add_control('smartshop_edd_front_featured_products', array(
            'label' => __('Show featured products on Front Page', 'smartshop'),
            'section' => 'smartshop_edd_options',
            'priority' => 10,
            'type' => 'checkbox',
        ));

        // store front/archive item count
        $wp_customize->add_setting('smartshop_store_front_featured_count', array (
            'default' => 3,
            'sanitize_callback' => 'smartshop_sanitize_integer',
        ));
        $wp_customize->add_control('smartshop_store_front_featured_count', array(
            'label' => __('Number of Featured Products', 'smartshop'),
            'section' => 'smartshop_edd_options',
            'settings' => 'smartshop_store_front_featured_count',
            'priority' => 20,
        ));

        // store front/downloads archive headline
        $wp_customize->add_setting('smartshop_edd_store_archives_title', array(
            'default' => __('Latest Products','smartshop'),
            'sanitize_callback' => 'sanitize_text_field'
        ));
        $wp_customize->add_control('smartshop_edd_store_archives_title', array(
            'label' => __('Featured Products Title', 'smartshop'),
            'section' => 'smartshop_edd_options',
            'settings' => 'smartshop_edd_store_archives_title',
            'priority' => 30,
        ));
        // store front/downloads archive description
        $wp_customize->add_setting('smartshop_edd_store_archives_description', array(
            'default' => null,
            'sanitize_callback' => 'sanitize_text_field',
        ));
        $wp_customize->add_control(new smartshop_customize_textarea_control($wp_customize, 'smartshop_edd_store_archives_description', array(
            'label' => __('Featured Products Description', 'smartshop'),
            'section' => 'smartshop_edd_options',
            'settings' => 'smartshop_edd_store_archives_description',
            'priority' => 40, 
        )));
        // read more link
        $wp_customize->add_setting('smartshop_product_view_details', array(
            'default' => __('View Details', 'smartshop'),
            'sanitize_callback' => 'sanitize_text_field',
        ));
        $wp_customize->add_control('smartshop_product_view_details', array(
            'label' => __('Product Details Text', 'smartshop'),
            'section' => 'smartshop_edd_options',
            'settings' => 'smartshop_product_view_details',
            'priority' => 50,
        ));
        // store front/archive item count
        $wp_customize->add_setting('smartshop_store_front_count', array(
            'default' => 9,
            'sanitize_callback' => 'smartshop_sanitize_integer',
        ));
        $wp_customize->add_control('smartshop_store_front_count', array(
            'label' => __('Store Item Count', 'smartshop'),
            'section' => 'smartshop_edd_options',
            'settings' => 'smartshop_store_front_count',
            'priority' => 60,
        ));
    }
    
    if(class_exists('woocommerce')) {
    
    /* ========================================================= */
        // Add new section for Woocommerce featured products on Front Page
        /* ========================================================= */
        $wp_customize->add_section('smartshop_woo_front_page_options', array(
            'title' => __('Product On Front Page', 'smartshop'),
            'description' => __('Settings for displaying featured products on Front Page', 'smartshop'),
            'priority' => 60,
        ));
        // enable featured products on front page?
        $wp_customize->add_setting('smartshop_woo_front_featured_products', array('default' => 0,
             'sanitize_callback' => 'smartshop_sanitize_checkbox',
            ));
        
        $wp_customize->add_control('smartshop_woo_front_featured_products', array(
            'label' => __('Show featured products on Front Page', 'smartshop'),
            'section' => 'smartshop_woo_front_page_options',
            'priority' => 10,
            'type' => 'checkbox',
        ));
        // Front featured products section headline
        $wp_customize->add_setting('smartshop_woo_front_featured_title', array('default' => __('Latest Products', 'smartshop'),
             'sanitize_callback' => 'sanitize_text_field',
            ));
        $wp_customize->add_control('smartshop_woo_front_featured_title', array(
            'label' => __('Main Title', 'smartshop'),
            'section' => 'smartshop_woo_front_page_options',
            'settings' => 'smartshop_woo_front_featured_title',
            'priority' => 10,
        ));
        
        // store front/products archive description
        $wp_customize->add_setting('smartshop_woo_store_archives_description', array(
            'default' => null,
            'sanitize_callback' => 'sanitize_text_field',
        ));
        $wp_customize->add_control(new smartshop_customize_textarea_control($wp_customize, 'smartshop_woo_store_archives_description', array(
            'label' => __('Featured Products Description', 'smartshop'),
            'section' => 'smartshop_woo_front_page_options',
            'settings' => 'smartshop_woo_store_archives_description',
            'priority' => 40, 
        )));
        
        // read more link
        $wp_customize->add_setting('smartshop_woo_view_details', array(
            'default' => __('View Details', 'smartshop'),
            'sanitize_callback' => 'sanitize_text_field',
        ));
        $wp_customize->add_control('smartshop_woo_view_details', array(
            'label' => __('Product Details Text', 'smartshop'),
            'section' => 'smartshop_woo_front_page_options',
            'settings' => 'smartshop_woo_view_details',
            'priority' => 50,
        ));

        // store front item count
        $wp_customize->add_setting('smartshop_woo_store_front_count', array('default' => 3,
            'sanitize_callback' => 'smartshop_sanitize_integer',
            ));
        $wp_customize->add_control('smartshop_woo_store_front_count', array(
            'label' => __('Number of products to display', 'smartshop'),
            'section' => 'smartshop_woo_front_page_options',
            'settings' => 'smartshop_woo_store_front_count',
            'priority' => 20,
        ));
    }
    // Add new section for displaying Featured Posts on Front Page
    $wp_customize->add_section('smartshop_front_page_post_options', array(
        'title' => __('Front Page Featured Posts', 'smartshop'),
        'description' => __('Settings for displaying featured posts on Front Page', 'smartshop'),
        'priority' => 60,
    ));
    // enable featured posts on front page?
    $wp_customize->add_setting('smartshop_front_featured_posts_check', array(
        'default' => 1, 
        'sanitize_callback' => 'smartshop_sanitize_checkbox',
    ));
    $wp_customize->add_control('smartshop_front_featured_posts_check', array(
        'label' => __('Show featured posts on Front Page', 'smartshop'),
        'section' => 'smartshop_front_page_post_options',
        'priority' => 10,
        'type' => 'checkbox',
    ));

    // Front featured posts section headline
    $wp_customize->add_setting('smartshop_front_featured_posts_title', array(
        'default' => __('Latest Posts', 'smartshop'),
        'sanitize_callback' => 'sanitize_text_field',
    ));
    
    $wp_customize->add_control('smartshop_front_featured_posts_title', array(
        'label' => __('Featured Section Title', 'smartshop'),
        'section' => 'smartshop_front_page_post_options',
        'settings' => 'smartshop_front_featured_posts_title',
        'priority' => 10,
    ));

    // select number of posts for featured posts on front page
    $wp_customize->add_setting('smartshop_front_featured_posts_count', array(
        'default' => 3,
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('smartshop_front_featured_posts_count', array(
        'label' => __('Number of posts to display', 'smartshop'),
        'section' => 'smartshop_front_page_post_options',
        'settings' => 'smartshop_front_featured_posts_count',
        'priority' => 20,
    ));


    // featured post read more link
    $wp_customize->add_setting('smartshop_front_featured_link_text', array(
        'default' => __('Read more', 'smartshop'),
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('smartshop_front_featured_link_text', array(
        'label' => __('Posts Read More Link Text', 'smartshop'),
        'section' => 'smartshop_front_page_post_options',
        'settings' => 'smartshop_front_featured_link_text',
        'priority' => 30,
    ));

    // Add footer text section
    $wp_customize->add_section('smartshop_footer', array(
        'title' => 'Footer Text', // The title of section
        'priority' => 75,
    ));

    $wp_customize->add_setting('smartshop_footer_footer_text', array(
        'default' => '',
        'sanitize_callback' => 'sanitize_text_field',
        'sanitize_js_callback' => 'smartshop_sanitize_escaping',
    ));
    
    $wp_customize->add_control(new smartshop_customize_textarea_control($wp_customize, 'smartshop_footer_footer_text', array(
        'section' => 'smartshop_footer', // id of section to which the setting belongs
        'settings' => 'smartshop_footer_footer_text',
    )));
    
    // Add custom CSS section 
    $wp_customize->add_section(
        'smartshop_custom_css_section', array(
        'title' => __('Custom CSS', 'smartshop'),
        'priority' => 80,
    ));

    $wp_customize->add_setting(
        'smartshop_custom_css', array(
        'default' => '',
        'sanitize_callback' => 'smartshop_sanitize_custom_css',
        'sanitize_js_callback' => 'smartshop_sanitize_escaping',
    ));

    $wp_customize->add_control(
        new smartshop_customize_textarea_control(
        $wp_customize, 'smartshop_custom_css', array(
        'label' => __('Add your custom css here and design live! (for advanced users)', 'smartshop'),
        'section' => 'smartshop_custom_css_section',
        'settings' => 'smartshop_custom_css'
    )));
}

add_action('customize_register', 'smartshop_customizer', 11);

/* 
 * Sanitize Hex Color for 
 * Primary and Secondary Color options
 * 
 * @since SmartShop 1.4
 */
function smartshop_sanitize_hex_color( $color ) {
    if ( $unhashed = sanitize_hex_color_no_hash( $color ) ) {
        return '#' . $unhashed;
    }
    return $color;
}

/* 
 * Sanitize Custom CSS 
 * 
 * @since SmartShop 1.4
 */

function smartshop_sanitize_custom_css( $input) {
    $input = wp_kses_stripslashes( $input);
    return $input;
}	

/* 
 * Sanitize numeric values 
 * 
 * @since SmartShop 1.4
 */
function smartshop_sanitize_integer( $input ) {
    if( is_numeric( $input ) ) {
    return intval( $input );
    }
}

/*
 * Escaping for input values
 * 
 * @since SmartShop 1.4
 */
function smartshop_sanitize_escaping( $input) {
    $input = esc_attr( $input);
    return $input;
}


/*
 * Sanitize Checkbox input values
 * 
 * @since Flex 1.0
 */
function smartshop_sanitize_checkbox( $input ) {
    if ( $input ) {
            $output = '1';
    } else {
            $output = false;
    }
    return $output;
}

/*
 * Sanitize layout options 
 * 
 * @since SmartShop 1.4
 */
function smartshop_sanitize_layout_option($layout_option){
    if ( ! in_array( $layout_option, array( 'full-width','boxed' ) ) ) {
		$layout_option = 'boxed';
	}

	return $layout_option;
}

/**
 * Change theme colors based on theme options from customizer.
 *
 * @since SmartShop 1.0
 */
function smartshop_color_style() {
	$primary_color = get_theme_mod('smartshop_theme_primary_color');
        $secondary_color = get_theme_mod('smartshop_theme_secondary_color'); 

	// If no custom options for text are set, let's bail
	if ( $primary_color == '#F84545' || $primary_color == '#f84545' ) {
            return;
        }
	// If we get this far, we have custom styles.
	?>
	<style type="text/css" id="smartshop-colorscheme-css">

                .header-widget .smartshop-call,
                #footer,
                #featured-products .product-info,
                #page-header-container,
                .pagination a:hover, 
                 .pagination span.current,
                .page-pagination a:hover,
                .edd-submit.button.blue:hover,
                .main-navigation li ul li a,
                .nav-menu > li > a:hover,
                #home-cta-area,
                .gform_footer input[type=submit]:hover,
                .home-sidebar .sidebar .gform_footer input[type="submit"],
                .sidebar .wpcf7 .wpcf7-form input[type="submit"],
                .sidebar .gform_footer input[type="submit"],
                #commentsubmit,
                .hentry #edd_login_form input[type="submit"],
                #commentsubmit, .form-submit input[type="submit"],
                .onsale,
                .woocommerce-page a.button:hover,
                .woocommerce button.button.alt,
                ins,
                li a:hover.page-numbers,
                .woocommerce input.button.alt:hover,
                .woocommerce #review_form #respond .form-submit input:hover,
                .woocommerce-cart .button:hover{
                    background: <?php echo $primary_color; ?> !important;
                    color: <?php echo $secondary_color; ?> !important; 
                }

                .gform_footer input[type=submit]:hover,
                #commentsubmit,
                .hentry #edd_login_form input[type="submit"] {
                    color:<?php echo $secondary_color; ?> !important;
                }
                
                .woocommerce .woocommerce-message{
                    border-top:3px solid <?php echo $primary_color; ?> !important;
                }

                 #home-widgets .fa, 
                .hentry .read-more,
                .product .title:hover,
                .sidebar li.widget ul a:hover,
                .gform_wrapper .gfield_required,
                .hentry a:hover,
                .star-rating span:before,
                .woocommerce-message:before,
                .woocommerce-info:before,
                #header .cart-contents:after,
                .fa-shopping-cart:before,
                .product h2:hover,
                .required{
                    color:<?php echo $primary_color; ?> !important;
                }

                ::selection {
                    background:<?php echo $primary_color; ?> !important;
                    color:<?php echo $secondary_color; ?> !important;
                }

	</style>
        <style type="text/css" id="smartshop-custom-css">
            <?php echo trim( get_theme_mod( 'smartshop_custom_css' ) ); ?>
        </style>
	<?php
}
add_action('wp_head','smartshop_color_style');


/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function smartshop_customize_preview_js() {
    wp_enqueue_script('smartshop_customizer', get_template_directory_uri() . '/assets/js/customizer.js', array('jquery', 'customize-preview'), rand() , true);
}

add_action('customize_preview_init', 'smartshop_customize_preview_js');