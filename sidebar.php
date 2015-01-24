<div class="sidebar">
    
        <?php
        if (class_exists('Easy_Digital_Downloads')) {
            if (is_page('checkout')) {
            echo '<div class="widget edd-cart-widget">';
            echo '<h3 class="widget_title">'._e('Shopping Cart','smartshop').'</h3>';
            echo edd_shopping_cart();
            echo '</div>';
        }
        }


        if (class_exists('Easy_Digital_Downloads')) {
        if (!is_active_sidebar('sidebar_right') && !is_page('checkout')) {
            echo '<div class="widget edd-cart-widget">';
            echo '<h3 class="widget_title">'._e('Shopping Cart','smartshop').'</h3>';
            echo edd_shopping_cart();
            echo '</div>';
        }
        }
        ?>
    
     <?php if (is_active_sidebar('sidebar_right')) {
            dynamic_sidebar('sidebar_right');
        } ?>
</div>