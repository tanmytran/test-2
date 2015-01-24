<?php
/**
 * The Woocommerce template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a Shop page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Smartshop
 * @since Smartshop 1.0
 */
get_header();
?>

<div id="main-content-container">

    <div id="primary" class="content row" role="main">
          <div class="col grid_12_of_12">
            <div class="main-content">

		<?php woocommerce_content(); ?>

            </div> <!-- /.main-content -->

        </div> <!-- /.col.grid_12_of_12 -->
        
    </div> <!-- /#primary.site-content.row -->

</div> <!-- /#maincontentcontainer -->

<?php get_footer(); ?>
