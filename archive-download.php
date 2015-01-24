<?php get_header(); ?>

<div id="main-content-container" class="container">
<div id="main-content" class="row store-template">	
    <div class="col grid_12_of_12 last">		
        <div class="content clearfix">
            <?php if (have_posts()) : $i = 1; ?>

                <?php while (have_posts()) : the_post(); ?>

                    <div id="post-<?php the_ID(); ?>" class="col grid_3_of_12 product<?php if ($i % 4 == 0) { echo ' last'; } ?>">
                        <a href="<?php the_permalink(); ?>">
                            <h2 class="title"><?php the_title(); ?></h2>
                        </a>
                        <div class="product-image">
                            <a href="<?php the_permalink(); ?>">
                            <?php the_post_thumbnail('product-image'); ?>
                            </a>
                                <?php if (function_exists('edd_price')) { ?>
                                <div class="product-price">
                                    <?php
                                    if (edd_has_variable_prices(get_the_ID())) {
                                        // if the download has variable prices, show the first one as a starting price
                                         printf( __('Starting at: %s','smartshop'), edd_price(get_the_ID()));
                                    } else {
                                        edd_price(get_the_ID());
                                    }
                                    ?>
                                </div><!--end .product-price-->
                            <?php } ?>
                        </div>
                            <?php if (function_exists('edd_price')) { ?>
                            <div class="product-buttons">
            <?php if (!edd_has_variable_prices(get_the_ID())) { ?>
                                <?php echo edd_get_purchase_link(get_the_ID(), __('Add to Cart','smartshop'), 'button'); ?>
                            <?php } ?>
                                <a href="<?php the_permalink(); ?>"><?php _e('View Details','smartshop'); ?></a>
                            </div><!--end .product-buttons-->
                    <?php } ?>
                    </div><!--end .product-->
        <?php $i+=1; ?>

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

    </div><!--end .col grid_12_of_12-->		

</div><!--end .row#main-content-->
</div><!-- end #main-content-container -->

<?php get_footer(); ?>
