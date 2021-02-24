<?php

function custommenu($parent_id, $post_type, $category) {
	$args = array(
		'post_type' => $post_type,
		'post_status' => array('publish', 'draft'),
		'orderby' => 'menu_order',
		'post_parent' => $parent_id,
		'order' => 'ASC',
		'posts_per_page' => -1,
		'category__in' => $category
	);

	query_posts($args); if (have_posts()) : ?>

	<?php while ( have_posts() ) : the_post(); ?>
					<li>
					<a href="<?php the_permalink(); ?>" title="<?php echo  _e('Scopri', 'mylang'); ?> <?php the_title(); ?>"><?php the_title(); ?></a>
					</li>
				<?php endwhile;
				?>
	<?php endif; wp_reset_query();

}

function shortcode_boxright( $atts, $content = null ) {
	return '<div class="shortcode_box-right">' . $content . '</div>';
}
add_shortcode( 'boxright', 'shortcode_boxright' );

function shortcode_highlight( $atts, $content = null ) {
	return '<span class="shortcode_highlight">' . $content . '</span>';
}
add_shortcode( 'highlight', 'shortcode_highlight' );

function shortcode_boxleft( $atts, $content = null ) {
	return '<div class="shortcode_box-left">' . $content . '</div>';
}
add_shortcode( 'boxleft', 'shortcode_boxleft' );

function shortcode_box( $atts, $content = null ) {
	return '<div class="shortcode_box">' . $content . '</div>';
}
add_shortcode( 'box', 'shortcode_box' );

function shortcode_boxhighlight( $atts, $content = null ) {
	return '<div class="shortcode_box-highlight">' . $content . '</div>';
}
add_shortcode( 'boxhighlight', 'shortcode_boxhighlight' );


add_filter( 'body_class', 'custom_class' );
function custom_class( $classes ) {
    if ( is_page() ) {
				$body_class = get_field('body_class');
				if (!empty($body_class)) {
					$classes[] = $body_class;
				}
    }
    return $classes;
}
