<?php get_header(); ?>

<div id="page-header-container" class="container">
    <div class="headsection row">
        <h2 class="title"><?php the_title(); ?></h2>
    </div>
</div>
<div id="main-content-container" class="container">    
    <div id="main-content" class="row">	
        <div class="col grid_8_of_12">	
            <div class="content clearfix">

                <?php while (have_posts()) : the_post(); ?>

                    <div <?php post_class(); ?>"  id="post-<?php the_ID(); ?>">

                        <?php the_content(); ?>

                    <?php endwhile; ?>

                </div><!--end .entry-->

                <div class="page-pagination">
                    <?php wp_link_pages('before=<p>&after=</p>&next_or_number=number&pagelink=page %'); ?>
                </div><!-- end .pagination-->
            </div><!--end .content-->

            <div class="comments">
                <?php
                // If comments are open or we have at least one comment, load up the comment template
                if (comments_open() || '0' != get_comments_number()) {
                    comments_template('', true);
                }
                ?>
        </div>
        
    </div><!--end .col grid_8_of_12-->
    <div class="col grid_4_of_12 last right-sidebar">
        <?php get_sidebar(); ?>
    </div><!--end .col grid_4_of_12-->
</div><!--end .row#main-content-->
</div><!-- end #main-content-container -->
<?php get_footer(); ?>
