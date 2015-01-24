<div class="container" id="footer">

    <?php if (is_active_sidebar('footer_one') || is_active_sidebar('footer_two') || is_active_sidebar('footer_three') || is_active_sidebar('footer_four')) { ?>
        <div class="row" id="footer-widgets">

            <?php if (is_active_sidebar('footer_one')) { ?>
                <div class="col grid_4_of_12 footer-widget">
                    <?php dynamic_sidebar('footer_one'); ?>
                </div><!--end .col grid_4_of_12-->
            <?php } ?>

            <?php if (is_active_sidebar('footer_two')) { ?>
                <div class="col grid_4_of_12 footer-widget">
                    <?php dynamic_sidebar('footer_two'); ?>
                </div><!--end .col grid_4_of_12-->
            <?php } ?>

            <?php if (is_active_sidebar('footer_three')) { ?>
                <div class="col grid_4_of_12 footer-widget">
                    <?php dynamic_sidebar('footer_three'); ?>
                </div><!--end .col grid_4_of_12-->
            <?php } ?>

        </div><!--end .row#footer-widgets-->
    <?php } ?>

    <div class="row copyright">
        <div class="col grid_12_of_12">
             <div class="smallprint left">
                <p>
                   <a href="<?php $smartshop = wp_get_theme(); echo $smartshop->get( 'ThemeURI' ); ?>">
                            <?php _e('Smartshop WordPress theme by IdeaBox','smartshop'); ?>
                    </a>
                </p>
            </div>
            <?php if (get_theme_mod('smartshop_footer_footer_text') != '') { ?>
                <div class="smallprint right"><?php echo wpautop(get_theme_mod('smartshop_footer_footer_text')); ?></div>
           <?php } ?>
        </div>

    </div> <!-- end .copyright --> 

</div><!--end .container#footer-->
</div> <!-- end #wrapper --> 
<div><?php wp_footer(); ?></div>

</body>
</html>
