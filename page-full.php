<?php /* Template Name: Full Template */ ?>

<?php get_header(); ?>

<?php
if ( have_posts() ) {
	while ( have_posts() ) {
		the_post(); ?>
		
		<?php if ( function_exists('yoast_breadcrumb') ) {
			yoast_breadcrumb('<div id="breadcrumbs" class="row"><p class="container">','</p></div>');
		} ?>

		<main class="container">
			<article class="row entry-content" itemscope itemtype="http://schema.org/Service">

					<h1><?php the_title(); ?></h1>
					<?php the_content(); ?>
				<footer>
					
				<?php
				$postID = get_the_ID();
				$args = array(
					'post_type' => 'page',
					'orderby' => 'menu_order',
					'post_parent' => $postID,
					'order' => 'ASC',
					'posts_per_page' => -1
				);

				query_posts($args); if (have_posts()) : ?>
				<div class="row">
					<div class="col-xs-12">

						<section class="childPage" itemprop="itemListElement" >
							<div class="row">

							<?php while ( have_posts() ) : the_post(); ?>
								<?php get_template_part('assets/pagePreview'); ?>
							<?php endwhile;
							?>
							</div>
						</section>

					</div>
				</div>

				<?php endif;
				
				wp_reset_query(); ?>

				</footer>
			</article>
			
	<?php }
}
?>
</main>


<?php get_footer(); ?>
