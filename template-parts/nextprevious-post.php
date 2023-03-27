<?php
/**
 * Display next/previous post. This would work in a singular page such as single.php.
 *
 * The code below was copied from TwentyTwenty theme.
 * 
 * @package bootstrap-basic4
 * @since 1.2.6
 */


$next_post = get_next_post();
$prev_post = get_previous_post();

$author_id_next = $next_post->post_author;
$author_id_prev = $prev_post->post_author;

if ($next_post || $prev_post) {

	$pagination_classes = '';

	if ( ! $next_post ) {
            $pagination_classes = ' only-one only-prev';
	} elseif ( ! $prev_post ) {
            $pagination_classes = ' only-one only-next';
	}

    ?> 
    <nav class="pagination-single section-inner<?php echo esc_attr( $pagination_classes ); ?>" aria-label="<?php esc_attr_e('Post', 'bootstrap-basic4'); ?>" role="navigation">
        <ul class="justify-content-between">
            <?php if ($prev_post) { ?> 
            <li class="post-item">
              <span><?php _e('السابق', 'teslatradeltd'); ?></span>
              <a class="previous-post post-link" href="<?php echo esc_url(get_permalink($prev_post->ID)); ?>">
                <p><?php echo wp_kses_post(get_the_title($prev_post->ID)); ?></p>
              </a>
            </li>
            <?php
            }// endif; $prev_post

            if ($next_post) {
            ?> 
            <li class="post-item">
              <span><?php _e('التالي', 'teslatradeltd'); ?></span>
              <a class="next-post post-link" href="<?php echo esc_url(get_permalink($next_post->ID)); ?>">              
                <p><?php echo wp_kses_post(get_the_title($next_post->ID)); ?></p>
              </a>
            </li>
            <?php }// endif; $next_post ?> 
        </ul>
    </nav><!-- .pagination-single -->
    <?php
}
