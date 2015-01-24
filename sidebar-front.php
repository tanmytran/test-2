<?php
/**
 *  Front page sidebars for 
 * 
 *  Home Featured
 *  Home CTA
 *  Home #1, Home #2 and Home #3
 */
// Check if home featured sidebar is active. Yes, then output the relevant HTML else exit. 

?>

    <div id="home-featured-area" class="container" >

        <div class="row" id="featured-widgets">

            <div class="col grid_12_of_12 last">

                <?php
                if (is_active_sidebar('home-featured')) {
                    dynamic_sidebar('home-featured');
                } 
                else { ?>
                    <div class="widget widget_text">			
                        <div class="textwidget">
                            <img src="<?php echo get_template_directory_uri().'/assets/images/featured.jpg'; ?>" />
                        </div>
                    </div>
                <?php } ?>

            </div>

        </div> <!--end .row --> 

    </div> <!--end .container -->



    <div id="home-widgets-area" class="container">
        <div class="row" id="home-widgets">

            
            <div class="col grid_4_of_12 home-widget-one">
                <?php if (is_active_sidebar('home_one')) { 
                    dynamic_sidebar('home_one'); 
                } 
                else { ?>
                <div class="home-widget widget_text">			
                        <div class="textwidget">
                            <p><i class="fa fa-gears"></i></p>
                            <center><?php _e('Home #1 Widget','smartshop'); ?></center>
                        </div>
                    </div>
                <?php } ?>
            </div>
       
            <div class="col grid_4_of_12 home-widget-two">
                <?php
                if (is_active_sidebar('home_two')) {
                    dynamic_sidebar('home_two');
                } else { ?>
                    <div class="home-widget widget_text">			
                        <div class="textwidget">
                            <p><i class="fa fa-comments"></i></p>
                            <center><?php _e('Home #2 Widget','smartshop'); ?></center>
                        </div>
                    </div>
            <?php } ?>
            </div>
            <div class="col grid_4_of_12 home-widget-three">
                <?php
                if (is_active_sidebar('home_three')) {
                    dynamic_sidebar('home_three');
                } else { ?>
                    <div class="home-widget widget_text">			
                        <div class="textwidget">
                            <p><i class="fa fa-laptop"></i></p>
                            <center><?php _e('Home #3 Widget','smartshop'); ?></center>
                        </div>
                    </div>
            <?php } ?>
            </div>

    </div>
</div>

 
    <div id="home-cta-area" class="container" >

        <div class="row" id="home-cta">

            <div class="col grid_12_of_12">
                   
            <?php 
            // Check if home CTA sidebar is active 
                if (is_active_sidebar('home_cta')) { 
                    dynamic_sidebar('home_cta');
                } else { ?>
                    <div class="home-cta-widget widget_text">
                        <h3 class="widget_title"><?php _e('Home CTA Widget','smartshop'); ?></h3>			
                        <div class="textwidget">
                            <p><?php _e('This is Home CTA widget area to add some Call to Action text and button','smartshop'); ?></p>
                            <p><a href="#" class="smartshop-cta"><?php _e('Get started','smartshop'); ?></a></p>
                        </div>
                    </div>
                <?php } ?>
            </div>

        </div> <!--end .row --> 

    </div> <!--end .container -->
   