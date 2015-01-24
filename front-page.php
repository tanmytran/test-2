<?php
/**
 * 
 * This template is used for setting up widgetized front page
 * along with featured posts and featured products. 
 * 
 * @package: SmartShop
 * @version: 1.0
 * @since  : 1.0
 */

get_header();

// call front page sidebars
get_sidebar('front');
?>

<div id="main-content-container" class="container">    
    <div id="main-content" class="row">
        <div class="content clearfix">

            <?php
            
            /* Display featured products using EDD on front page
             * This section works only when the setting 
             * has been checked in Theme Customizer
             * 
             * Theme customizer setting for EDD appears only when 
             * Easy Digital Downloads plugin is installed and active. 
             * 
            */
            get_template_part('content', 'frontproducts');
            
            
            /* Display featured products using WooCommerce on front page
             * This section works when the setting 
             * has been checked in Theme Customizer
             * 
             * Theme customizer setting for WooCommerce appears only when 
             * WooCommerce plugin is installed and active. 
             * 
            */
            
            get_template_part('content', 'wooproducts');

            
            /* Display featured posts on front page
             * This section works when "Front Page Featured Posts" setting 
             * has been checked in Theme Customizer
             * 
            */
            
            get_template_part('content', 'frontposts');
            ?>

        </div><!--end .content-->

    </div><!--end #main-content.row-->
</div><!-- end #main-content-container -->

<?php get_footer(); ?>
