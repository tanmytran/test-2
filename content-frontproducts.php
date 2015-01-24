<?php
/**
 * The template for displaying featured products on Front Page 
 *
 * @package Smartshop
 * @since Smartshop 1.0
 */
?>

<?php
if (class_exists('Easy_Digital_Downloads')) {

    // check if user has enabled featured products for front page
    if (get_theme_mod('smartshop_edd_front_featured_products')) {  ?>

        <div class="store-info">
            <?php if (get_theme_mod('smartshop_edd_store_archives_title')) : ?>
                <h2 class="store-title"><?php echo esc_html(get_theme_mod('smartshop_edd_store_archives_title')); ?></h2>
                <?php endif; ?>
                <?php if (get_theme_mod('smartshop_edd_store_archives_description')) : ?>
                <div class="store-description">
                <?php echo wpautop(get_theme_mod('smartshop_edd_store_archives_description')); ?>
                </div>
        <?php endif; ?>
        </div>

        <div class="row" id="home-featured">
            <div class="col grid_12_of_12" id="featured-products">

                <?php
                if (class_exists('Easy_Digital_Downloads')) {
                    $per_page = absint(get_theme_mod('smartshop_store_front_featured_count'));
                    $product_args = array(
                        'post_type' => 'download',
                        'posts_per_page' => $per_page
                    );
                    $products = new WP_Query($product_args);
                    ?>
            <?php if ($products->have_posts()) : $i = 1; ?>
                <?php while ($products->have_posts()) : $products->the_post(); ?>
                            <div class="col grid_4_of_12 product<?php if ($i % 3 == 0) { echo ' last'; } ?>">

                                <h3 class="title">
                                    <a href="<?php the_permalink(); ?>">
                                        <?php the_title(); ?>
                                    </a>
                                </h3>

                                <div class="product-image">
                                    <a href="<?php the_permalink(); ?>">
                                         <?php the_post_thumbnail('product-image'); ?>
                                    </a>
                                            <?php if (function_exists('edd_price')) { ?>

                                        <div class="product-info">
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
                                        <div class="product-description">
                                            <?php the_excerpt(); ?>
                                        </div> <!-- end .product-description -->
                                        <?php if (function_exists('edd_price')) { ?>
                                            <div class="product-buttons">
                                                <?php if (get_theme_mod('smartshop_product_view_details')) : ?>
                                                      <a class="view-details" href="<?php the_permalink(); ?>">
                                                          <?php echo esc_html(get_theme_mod('smartshop_product_view_details')); ?>
                                                      </a>
                                                <?php endif; ?>
                                            </div><!--end .product-buttons-->
                                        <?php } ?>
                                    </div>
                                </div>

                            </div><!--end .product-->
                            <?php $i+=1; ?>
                        <?php endwhile; ?>
                    <?php else : ?>

                             <h2 class="title"><?php _e('Not Found','smartshop'); ?></h2>
                    <p><?php _e('Sorry, but you are looking for something that is not here.','smartshop'); ?></p>
                    <?php get_search_form(); ?>
            <?php endif; ?>
        <?php } ?>
            </div> <!--end #featured-products -->

        </div> <!-- end #home-featured -->
    <?php
    } // end EDD enabled check
} // end EDD Plugin activation check 
?>