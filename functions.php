<?php

$edds_options = get_option('SS_THEME_settings');

/* Include plugin activation file to install plugins */
include get_template_directory() . '/includes/plugin-activation/plugin-details.php';

/**
 * Add support for a custom header image.
 */
require( get_template_directory() . '/includes/custom-header.php' );

// customizer addition
require get_template_directory() . '/includes/customizer.php';

if (!function_exists('smartshop_theme_setup')) {

    /**
     * Make theme available for translation
     * Translations can be filed in the /languages/ directory
     * If you're building a theme based on Tatva, use a find and replace
     * to change 'tatva' to the name of your theme in all the template files
     */
    load_theme_textdomain('smartshop', trailingslashit(get_template_directory_uri()) . 'languages');

    function smartshop_theme_setup() {
        // Set content width 
        if (!isset($content_width))
            $content_width = 716;

        // This theme styles the visual editor with editor-style.css to match the theme style.
        add_editor_style();

        add_theme_support('automatic-feed-links');

        /*
         * This theme supports all available post formats by default.
         * See http://codex.wordpress.org/Post_Formats
         */
        add_theme_support('post-formats', array(
            'aside', 'audio', 'chat', 'gallery', 'image', 'link', 'quote', 'status', 'video'
        ));


        // Enable support for Custom Backgrounds
        add_theme_support('custom-background', array(
            // Background color default
            'default-color' => 'fff',
            // Background image default
            'default-image' => '',
            'header-text' => 'true',
            'Flex-height' => 'true',
            'Flex-width' => 'true'
        )); 
        
        add_theme_support( 'woocommerce' );

        //adds post thumbnail support - new in Wordpress 2.9
        add_theme_support('post-thumbnails');

        set_post_thumbnail_size(716, 400, true); // default post thumbnail size
        add_image_size('product-image', 368, 200, true); // product thumbnail
        add_image_size('product-image-large', 716, 400, true); // main product image
        add_image_size('home-slider', 1140, 450, true); //home slider image size
        add_image_size('post-thumb', 220, 180, true); // custom thumbnail for post              
        
        // set up custom nav menus
        register_nav_menus( array( 'main_nav' => __('Main Navigation','smartshop') ));
        
    }

}
add_action('after_setup_theme', 'smartshop_theme_setup');

// Load Scripts for responsive navigation, media queries, comments and stheme stylesheet.
function smartshop_load_scripts() {

        
        // Enqueue the default WordPress stylesheet
	wp_enqueue_style( 'style', get_stylesheet_uri(), array(), '1.5', 'all' );
        
        wp_enqueue_script('smartshop-media-queries', get_template_directory_uri() . '/assets/js/css3-mediaqueries.js');

        // Adds JavaScript for handling the navigation menu hide-and-show behavior.
        wp_enqueue_script('smartshop-navigation', get_template_directory_uri() . '/assets/js/navigation.js', array(), '1.0', true);

        
        if (is_singular()) {
            wp_enqueue_script('comment-reply');
        }
    
        wp_enqueue_style( 'smartshop-woocommerce', trailingslashit( get_template_directory_uri() ) . 'assets/css/smartshop-woocommerce.css' , array(), '1.0', 'all' );
}

add_action('wp_enqueue_scripts', 'smartshop_load_scripts');


// Load Google Fonts
add_action('wp_enqueue_scripts', 'smartshop_load_fonts');

function smartshop_load_fonts() {
    
    // Load Open Sans from Google Fonts
    wp_enqueue_style('google-fonts', '//fonts.googleapis.com/css?family=Open+Sans:300,400,700', array(),'1.0','all');
    
    // Register and enqueue our icon font
    // We're using the awesome Font Awesome icon font. http://fortawesome.github.io/Font-Awesome
    wp_enqueue_style('font-awesome', trailingslashit(get_template_directory_uri()) . 'assets/css/font-awesome.min.css', array(), '4.0.3', 'all');
}

// Register Sidebars
if (function_exists('register_sidebar')) {

    register_sidebars(1, array(
        'name' => __('Sidebar Right', 'smartshop'),
        'id' => 'sidebar_right',
        'before_title' => '<h3 class="widget_title">',
        'after_title' => '</h3>',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>'
    ));

    register_sidebar(array(
        'name' => __('Shop Sidebar', 'smartshop'),
        'id' => 'sidebar_shop',
        'description' => esc_html__('Appears in the sidebar on shop/product pages.', 'smartshop'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="widget_title">',
        'after_title' => '</h3>'
    ));


    register_sidebar(array(
        'name' => __('Header Widget', 'smartshop'),
        'id' => 'header_widget',
        'before_title' => '<h3 class="widget_title">',
        'description' => esc_html__('Appears in the top right section of header', 'smartshop'),
        'after_title' => '</h3>',
        'before_widget' => '<div id="%1$s" class="header-widget %2$s">',
        'after_widget' => '</div>'
    ));
    register_sidebar(array(
        'name' => __('Home Featured', 'smartshop'),
        'id' => 'home-featured',
        'description' => esc_html__('Appears on the front page below navigation. Apt for adding featured slider', 'smartshop'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="widget_title">',
        'after_title' => '</h3>'
    ));
    register_sidebar(array(
        'name' => __('Home CTA', 'smartshop'),
        'id' => 'home_cta',
        'description' => esc_html__('Appears on the front page above featured posts and products listing', 'smartshop'),
        'before_title' => '<h3 class="widget_title">',
        'after_title' => '</h3>',
        'before_widget' => '<div id="%1$s" class="home-cta-widget %2$s">',
        'after_widget' => '</div>'
    ));

    register_sidebar(array(
        'name' => __('Home Sidebar', 'smartshop'),
        'id' => 'home_sidebar',
        'description' => esc_html__('Appears on the right of featured posts on front page', 'smartshop'),
        'before_title' => '<h3 class="widget_title">',
        'after_title' => '</h3>',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>'
    ));

    register_sidebar(array(
        'name' => __('Home #1', 'smartshop'),
        'id' => 'home_one',
        'description' => esc_html__('Appears below the front page featured widget area.', 'smartshop'),
        'before_title' => '<h3 class="widget_title">',
        'after_title' => '</h3>',
        'before_widget' => '<div id="%1$s" class="home-widget %2$s">',
        'after_widget' => '</div>'
    ));

    register_sidebar(array(
        'name' => __('Home #2', 'smartshop'),
        'id' => 'home_two',
        'description' => esc_html__('Appears below the front page featured widget area.', 'smartshop'),
        'before_title' => '<h3 class="widget_title">',
        'after_title' => '</h3>',
        'before_widget' => '<div id="%1$s" class="home-widget %2$s">',
        'after_widget' => '</div>'
    ));
    register_sidebar(array(
        'name' => __('Home #3', 'smartshop'),
        'id' => 'home_three',
        'description' => esc_html__('Appears below the front page featured widget area.', 'smartshop'),
        'before_title' => '<h3 class="widget_title">',
        'after_title' => '</h3>',
        'before_widget' => '<div id="%1$s" class="home-widget %2$s">',
        'after_widget' => '</div>'
    ));

    register_sidebars(1, array(
        'name' => __('Footer #1', 'smartshop'),
        'id' => 'footer_one',
        'before_title' => '<h3 class="widget_title">',
        'after_title' => '</h3>',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>'
    ));
    register_sidebars(1, array(
        'name' => __('Footer #2', 'smartshop'),
        'id' => 'footer_two',
        'before_title' => '<h3 class="widget_title">',
        'after_title' => '</h3>',
        'before_widget' => '<div id="%1$s"class="widget %2$s">',
        'after_widget' => '</div>'
    ));
    register_sidebars(1, array(
        'name' => __('Footer #3', 'smartshop'),
        'id' => 'footer_three',
        'before_title' => '<h3 class="widget_title">',
        'after_title' => '</h3>',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>'
    ));
}


/*
 * 
 * Set excerpt length for products on front page
 * and post excerpts on rest of the pages.
 * 
 */
function smartshop_excerpt_length($length) {
    global $post;
    if ($post->post_type == 'post') {
        return 50;
    }
    else if (($post->post_type == 'download') && (is_front_page())) {
        return 15;
    }
    else {
        return 50;
    }
}
add_filter('excerpt_length', 'smartshop_excerpt_length');

// Customize read more link
function smartshop_excerpt_more($more) {
    if (is_front_page()) {
        return '...';
    } else {
        return ' <a class="read-more" href="' . get_permalink(get_the_ID()) . '">' . __('Read More', 'smartshop') . '</a>';
    }
}

add_filter('excerpt_more', 'smartshop_excerpt_more');


// Add layout classes 
add_filter('body_class', 'smartshop_layout_body_classes');
function smartshop_layout_body_classes($classes) {

    if (get_theme_mod('smartshop_theme_layout')) {
        $classes[] = esc_html(get_theme_mod('smartshop_theme_layout'));
    }
    return $classes;
}


/*
 * Check if the front page is set 
 * to display latest blog posts
 * or a static front page
 * 
 * If it's set to display blog posts
 * then ignore the front-page.php 
 * template and head over to index.php
 * 
 * @Credits Chip Bennett 
 * 
 * @since Tatva 1.2
 */


function smartshop_filter_front_page_template( $template ) {
     return is_home() ? '' : $template ;
}
add_filter( 'frontpage_template', 'smartshop_filter_front_page_template' );


// Remove default WooCommerce styles
add_filter( 'woocommerce_enqueue_styles', '__return_false' );

// Display 24 products per page. Goes in functions.php
add_filter( 'loop_shop_per_page', create_function( '$cols', 'return 9;' ), 20 );


// Change number or products per row to 3
add_filter('loop_shop_columns', 'loop_columns');
if (!function_exists('loop_columns')) {
	function loop_columns() {
		return 3; // 3 products per row
	}
}


/**
 * Hook in on activation
 */
global $pagenow;
if ( is_admin() && isset( $_GET['activated'] ) && $pagenow == 'themes.php' ) add_action( 'init', 'smartshop_woocommerce_image_dimensions', 1 );
 
/**
 * Define image sizes
 */
function smartshop_woocommerce_image_dimensions() {
  	$catalog = array(
		'width' 	=> '349',	// px
		'height'	=> '349',	// px
		'crop'		=> 1 		// true
	);
 
	$single = array(
		'width' 	=> '362',	// px
		'height'	=> '362',	// px
		'crop'		=> 1 		// true
	);
 
	$thumbnail = array(
		'width' 	=> '150',	// px
		'height'	=> '150',	// px
		'crop'		=> 0 		// false
	);
 
	// Image sizes
	update_option( 'shop_catalog_image_size', $catalog ); 		// Product category thumbs
	update_option( 'shop_single_image_size', $single ); 		// Single product image
	update_option( 'shop_thumbnail_image_size', $thumbnail ); 	// Image gallery thumbs
}

remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15 );


function smartshop_admin_notice(){
    global $pagenow;
    if ( $pagenow == 'themes.php' ) { ?>
          <div class="updated">
              <p>This is a lite version of SmartShop theme. You can upgrade to <a href="http://ideaboxthemes.com/themes/smartshop-wordpress-theme/">Pro version</a> for more features, support and upgrades.</p>
         </div>
   <?php  }
}
add_action('admin_notices', 'smartshop_admin_notice');