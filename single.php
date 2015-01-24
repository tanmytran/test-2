<?php get_header(); ?>
<div id="page-header-container" class="container">
    <div class="headsection row">
        <h2 class="title"><?php the_title(); ?></h2>
        <small class="date"><?php the_time(__('F j, Y','smartshop')); ?></small>
    </div>
</div>
<div id="main-content-container" class="container">     
    <div id="main-content" class="row">	

        <div class="col grid_8_of_12">		
            <div class="content">
                <?php if (have_posts()) : ?>

                    <?php while (have_posts()) : the_post(); ?>

                        <div <?php post_class(); ?>"  id="post-<?php the_ID(); ?>">

                            <?php
                            if ('' != get_the_post_thumbnail()) {
                                the_post_thumbnail();
                            }
                            ?> 
                            <?php the_content(__('Read the rest of this entry &raquo;','smartshop')); ?>

                            <p class="postinfo">
                                <?php the_tags( __('Tags:', 'smartshop') . ' ', __(', ', 'smartshop'), '<br />' ); ?>
                                <?php printf( __( 'Posted in %s', 'smartshop' ), the_category( __( ', ', 'smartshop' ) ) ); ?> 
                                <?php printf(_n( 'One comment', '%s comments', get_comments_number(), 'smartshop'), number_format_i18n( get_comments_number() )); ?>
                            </p>

                        </div>

                    <?php endwhile; ?>

                <?php else : ?>

                    <div class="entry">
                        <h2 class="title"><?php _e('Not Found','smartshop'); ?></h2>
                    <p><?php _e('Sorry, but you are looking for something that is not here.','smartshop'); ?></p>
                    <?php get_search_form(); ?>
                    </div><!--end .entry-->

                <?php endif; ?>

            </div><!--end .content-->


            <div class="comments">
                <?php
                // If comments are open or we have at least one comment, load up the comment template
                if (comments_open() || '0' != get_comments_number()) {
                    comments_template('', true);
                }
                ?>
            </div>
            
            <div class="nav-single">
                <span class="nav-previous"><?php previous_post_link( '%link', '<span class="meta-nav">' . _x( '&larr;', 'Previous post link', 'smartshop' ) . '</span> %title' ); ?></span>
                <span class="nav-next"><?php next_post_link( '%link', '%title <span class="meta-nav">' . _x( '&rarr;', 'Next post link', 'smartshop' ) . '</span>' ); ?></span>
            </div><!-- .nav-single -->

        </div><!--end .col grid_8_of_12-->

        <div class="col grid_4_of_12 last right-sidebar">
            <?php get_sidebar(); ?>
        </div><!--end .col grid_4_of_12-->		

    </div><!--end .row#main-content-->
</div><!-- end #main-content-container -->

<?php get_footer(); ?>
