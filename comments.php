<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 */
// Do not delete these lines
if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
    die(__('Please do not load this page directly. Thanks!','smartshop'));

if (post_password_required()) {
    ?>
    <p class="nocomments"><?php _e('This post is password protected. Enter the password to view comments.','smartshop'); ?></p>
    <?php
    return;
}
?>

<!-- You can start editing here. -->

<?php if (have_comments()) : ?>
    <h3 id="comments">
        <?php printf( _n( 'One comment on &ldquo;%2$s&rdquo;', '%1$s commnets on &ldquo;%2$s&rdquo;', get_comments_number(), 'smartshop' ), number_format_i18n( get_comments_number() ), '<span>' . get_the_title() . '</span>' );?>
    </h3>
    <ol class="commentlist">
        <?php wp_list_comments('type=comment'); ?>
    </ol>
    <div class="clear"></div>
    <div class="comment-navigation">
        <div class="older"><?php previous_comments_link() ?></div>
        <div class="newer"><?php next_comments_link() ?></div>
    </div>
<?php else : // this is displayed if there are no comments so far ?>

    <?php if (comments_open()) : ?>
        <!-- If comments are open, but there are no comments. -->

    <?php else : // comments are closed ?>
        <!-- If comments are closed. -->
        <p class="nocomments"><?php _e('Comments are closed.','smartshop'); ?></p>

    <?php endif; ?>
<?php endif; ?>


<?php if (comments_open()) : ?>

    <div id="respond">

        <div class="cancel-comment-reply">
            <small><?php cancel_comment_reply_link(); ?></small>
        </div>

        <?php if (get_option('comment_registration') && !is_user_logged_in()) : ?>
            <p><?php printf( __ ('You must be <a href="%s">logged in</a> to post a comment.','smartshop'), wp_login_url(get_permalink()) ); ?></p>
        <?php else :
            comment_form(); ?>

            <div class="comment-rss"><?php post_comments_feed_link(__('Subscribe to Comments via RSS','smartshop')); ?></div>

        <?php endif; // If registration required and not logged in ?>
    </div>

<?php endif; // if you delete this the sky will fall on your head ?>