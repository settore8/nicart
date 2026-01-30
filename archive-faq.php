<?php get_header(); ?>

<div id="archiveHeader" class="row">
	<div id="archiveHeaderTxt">
		<?php if ( function_exists('yoast_breadcrumb') ) {
			yoast_breadcrumb('<p id="breadcrumbs" class="row">','</p>');
		} ?>
		<h1>Domande Frequenti Nicart</h1>
		<p>Domande frequenti su accessori e ricambi per decespugliatori</p>
	</div>
</div>

<main class="container">
	<div class="row">

		<section class="col-12">
		<?php if ( have_posts() ) : ?>

			<div class="faqs list-group list-group-flush">

			<?php while ( have_posts() ) : the_post();

				// Tassonomia FAQ
				$faq_cats = get_the_terms( get_the_ID(), 'faq_cat' );
				$cat_names = [];

				if ( ! empty( $faq_cats ) && ! is_wp_error( $faq_cats ) ) {
					foreach ( $faq_cats as $cat ) {
						$cat_names[] = esc_html( $cat->name );
					}
				}
			?>

				<a href="<?php the_permalink(); ?>" class="list-group-item list-group-item-action faq-item">
					
					<h2 class="h5 mb-1">
						<?php the_title(); ?>
					</h2>

					<?php if ( ! empty( $cat_names ) ) : ?>
						<small class="text-muted">
							<?php echo implode( ' · ', $cat_names ); ?>
						</small>
					<?php endif; ?>

				</a>

			<?php endwhile; ?>

			</div>

		<?php else : ?>
			<p>Nessuna FAQ trovata.</p>
		<?php endif; ?>
		</section>

	</div>
</main>

<?php get_footer(); ?>
