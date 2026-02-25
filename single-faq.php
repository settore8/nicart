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
					<header class="col-xs-12 col-sm-5 col-offset-1">
						<?php
						$risposta = get_field('risposta');
						$prodotti = get_field('prodotti');
						$categorie = get_field('categorie');
						// recupera la tassonomia faq_cat
						$faq_cat = get_the_terms( get_the_ID(), 'faq_cat' );
						?>
						<h1><?php the_title(); ?></h1>
						<?php if ($risposta) { echo $risposta; } ?>
					</header>
				
				</article>
		</main>

		<?php
				$current_faq_id = get_the_ID();

				$args = [
					'post_type'      => 'product',
					'posts_per_page' => -1,
					'post_status'    => 'publish',
					'meta_query'     => [
						[
							'key'     => 'faq',
							'value'   => '"' . $current_faq_id . '"',
							'compare' => 'LIKE'
						]
					]
				];
				
				$related_products = new WP_Query($args);

				?>

				<?php if ($related_products->have_posts()) : ?>
					<div class="container prodotti-video">
					<section class="row customsection group">
							<h3 class="text-center">Prodotti</h3>  
							<ul class="products columns-4">          
								<?php while ($related_products->have_posts()) : $related_products->the_post(); ?>
											<li <?php wc_product_class('', $product); ?>>
												<a href="<?php the_permalink(); ?>">
													<?php
													if (has_post_thumbnail()) {
														the_post_thumbnail('medium');
													} else {
														echo '<img src="' . wc_placeholder_img_src() . '" alt="Placeholder" />';
													}
													?>
													<h2 class="woocommerce-loop-product__title"><?php the_title(); ?></h2>
													<span class="price"><?php echo $product->get_price_html(); ?></span>
												</a>
											</li>
								<?php endwhile; ?>
							</ul>
					</section>
					</div>
					<?php wp_reset_postdata(); ?>
		<?php endif; ?>

		<?php }
}
?>

<?php get_footer(); ?>
