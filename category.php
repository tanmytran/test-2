<?php get_header(); ?>
<div id="page-header-container" class="container">
     <div class="headsection row">
        <h2 class="title archive-title"><?php printf(esc_html__('Category Archives: %s', 'smartshop'), '<span class="cat-archive">' . single_cat_title('', false) . '</span>'); ?></h2>

        <?php if (category_description()) { // Show an optional category description ?>
            <div class="archive-meta"><?php echo category_description(); ?></div>
        <?php } ?>
    </div>
</div>
<div id="main-content-container" class="container">     
    <div id="main-content" class="row">	
   
    <div class="col grid_8_of_12">		
        <div class="content clearfix">
            <?php if (have_posts()) : ?>

                <?php while (have_posts()) : the_post(); ?>

                    <div <?php post_class('clearfix'); ?>  id="post-<?php the_ID(); ?>">

                        <a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
                            <?php the_post_thumbnail('post-thumb'); ?>
                        </a>

                        <h2 class="title">
                            <a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
                                <?php the_title(); ?>
                            </a>
                        </h2>

                        <span class="post-meta"><small><?php the_time(__('F j, Y','smartshop')); ?> <!-- by <?php the_author() ?> --></small></span>
                        <?php the_excerpt(); ?>

                    </div><!--end .entry-->


                <?php endwhile; ?>

                <div class="pagination">
                    <?php
                    global $wp_query;

                    $big = 999999999; // need an unlikely integer

                    echo paginate_links(array(
                        'base' => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
                        'format' => '?paged=%#%',
                        'current' => max(1, get_query_var('paged')),
                        'total' => $wp_query->max_num_pages
                    ));
                    ?>
                </div>

            <?php else : ?>

                <div class="entry">
                    <h2 class="title"><?php _e('Not Found','smartshop'); ?></h2>
                    <p><?php _e('Sorry, but you are looking for something that is not here.','smartshop'); ?></p>
                    <?php get_search_form(); ?>
                </div><!--end .entry-->

            <?php endif; ?>

        </div><!--end .content-->
    </div><!--end .col grid_8_of_12-->

    <div class="col grid_4_of_12 last right-sidebar">
        <?php get_sidebar(); ?>
    </div><!--end .col grid_4_of_12-->		

</div><!--end .row#main-content-->
</div><!-- end #main-content-container -->
<?php get_footer(); ?>
