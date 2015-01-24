<?php get_header(); ?>
<div id="page-header-container" class="container">
    <div class="headsection row">
        <h2 class="title"><?php the_title(); ?></h2>
        <small class="date"><?php the_time(__('F j, Y','smartshop')); ?></small>
    </div>
</div>
<div id="main-content-container" class="container">
<div id="main-content" class="row">

    <div class="row">

        <?php if (have_posts()) : ?>

            <?php while (have_posts()) : the_post(); ?>
                <?php if (is_active_sidebar('sidebar_shop')) { ?>
                    <div class="col grid_8_of_12">
                    <?php } else { ?>
                        <div class="col grid_12_of_12 last">
                        <?php } ?> 
                        <div class="content">							

                            <div id="post-<?php the_ID(); ?>" <?php post_class('entry product-content'); ?>>

                                <?php the_post_thumbnail('product-image-large'); ?>

                            </div><!--end .product-content.entry-->
                            <div class="content-des">
                                <?php the_content(__('Read the rest of this entry &raquo;','smartshop')); ?>
                            </div>


                        </div><!--end .content-->

                    </div><!--end .col grid_12_of_12-->



                <?php endwhile; ?>

            <?php else : ?>

                <div class="entry product-content not-found">

                    <h2 class="title"><?php _e('Not Found','smartshop'); ?></h2>
                    <p><?php _e('Sorry, but you are looking for something that is not here.','smartshop'); ?></p>
                    <?php get_search_form(); ?>

                </div><!--end .product-content.entry-->


            <?php endif; ?>
            <?php if (is_active_sidebar('sidebar_shop')) { ?>
                <div class="col grid_4_of_12 last right-sidebar">
                    <div class="sidebar">
                        <?php dynamic_sidebar('sidebar_shop'); ?>
                    </div>
                </div><!--end .col grid_4_of_12-->
            <?php } ?>
        </div><!--end .row-->

    </div><!--end #main-content.container-->
</div><!-- end #main-content-container -->
    <?php get_footer(); ?>