<?php get_header(); ?>

<?php
if ( have_posts() ) {
	while ( have_posts() ) {
		the_post();
		?>
		<?php if ( function_exists('yoast_breadcrumb') ) {
			yoast_breadcrumb('<div id="breadcrumbs" class="row"><p class="container">','</p></div>');
		} ?>

		<main class="container">
				<article class="row">
					<header class="col-xs-12 col-sm-5">
						<?php
						$video = get_field('video_youtube');
						$description = get_field('description');
						$poster = get_field('poster');
						?>
						<h1><?php the_title(); ?></h1>
						<p><?php if ($description) { echo $description; } ?></p>
					</header>
					<div class="col-xs-12 col-sm-7">
					<?php if( $video ): ?>
							<?php
							echo '<div class="embed-container">';
							echo get_field('video_youtube');
							echo '</div>';
					?>
					<?php endif; ?>
					</div>
				</article>
		</main>

		<?php
				$current_video_id = get_the_ID();

				$args = [
					'post_type'      => 'product',
					'posts_per_page' => -1,
					'post_status'    => 'publish',
					'meta_query'     => [
						[
							'key'     => 'video',
							'value'   => '"' . $current_video_id . '"',
							'compare' => 'LIKE'
						]
					]
				];
				
				$related_products = new WP_Query($args);

				?>

				<?php if ($related_products->have_posts()) : ?>
					<div class="container prodotti-video">
					<section class="row customsection group">
							<h3 class="text-center">Prodotti nel video</h3>  
							<ul class="products columns-4">          
							<?php while ( $related_products->have_posts() ) {
									$related_products->the_post(); 
									wc_get_template_part( 'content', 'product' ); ?>
							<?php } ?>
							</ul>
					</section>
					</div>
					<?php wp_reset_postdata(); ?>
		<?php endif; ?>

		<?php }
}
?>

<?php get_footer(); ?>
