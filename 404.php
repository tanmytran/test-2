<?php get_header(); ?>
<div id="page-header-container" class="container">
     <div class="headsection row">
        <h2 class="title"><?php _e('Oops!', 'smartshop'); ?></h2>
    </div>
</div>
<div id="main-content-container" class="container">
<div id="main-content" class="row">	
    
    <div class="col grid_8_of_12">		
        <div class="content clearfix">

            <div class="entry clearfix">
                <div <?php post_class(); ?>"  id="post-<?php the_ID(); ?>">
                    <h2 class="title"><?php _e('Not Found','smartshop'); ?></h2>
                    <p><?php _e('Sorry, but you are looking for something that is not here.','smartshop'); ?></p>
                    <?php get_search_form(); ?>
                </div><!--end .entry-->
            </div><!--end .entry-->

        </div><!--end .content-->
    </div><!--end .col grid_8_of_12-->

    <div class="col grid_4_of_12 last right-sidebar">
        <?php get_sidebar(); ?>
    </div><!--end .col grid_4_of_12-->		

</div><!--end .row#main-content-->
</div><!-- end #main-content-container -->

<?php get_footer(); ?>
