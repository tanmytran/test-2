<?php
/**
 * Template Name: Full Width 
 * 
 * A cusotm full width page template without sidebar
 * 
 * @package : SmartShop
 * @version : 1.0
 * @since : 1.0
 * 
 */
get_header(); ?>
<div id="page-header-container" class="container">
    <div class="headsection row">
        <h2 class="title"><?php the_title(); ?></h2>
    </div>
</div>
<div id="main-content-container" class="container">    
<div id="main-content" class="row">	
    <div class="full-width-content">	
        <div class="content clearfix">
            <?php if (have_posts()) : ?>

                <?php while (have_posts()) : the_post(); ?>

                    <div <?php post_class(); ?>"  id="post-<?php the_ID(); ?>">

                        <?php the_content(); ?>

                    <?php endwhile; ?>

                <?php else : ?>

                    <div class="entry">
                        <h2 class="title"><?php _e('Not Found','smartshop'); ?></h2>
                    <p><?php _e('Sorry, but you are looking for something that is not here.','smartshop'); ?></p>
                    <?php get_search_form(); ?>
                    </div><!--end .entry-->

                <?php endif; ?>

            </div><!--end .content-->

            <div class="page-pagination">
                <?php wp_link_pages('before=<p>&after=</p>&next_or_number=number&pagelink=page %'); ?>
            </div><!-- end .pagination-->
        </div><!--end .entry-->
    </div><!--end .col grid_8_of_12-->
</div><!--end .row#main-content-->
</div><!-- end #main-content-container -->

<?php get_footer(); ?>
