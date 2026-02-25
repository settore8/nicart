<?php get_header(); ?>

<div id="archiveHeader" class="row">
	<div id="archiveHeaderTxt">
		<?php if ( function_exists('yoast_breadcrumb') ) {
			yoast_breadcrumb('<p id="breadcrumbs" class="row">','</p>');
		} ?>
		<h1>Domande Frequenti Nicart</h1>
		<p>Domande frequenti su accessori e ricambi per decespugliatori</p>

		<?php 
		// filtro per cat_faqegory
		$faq_cats = get_terms( array(
			'taxonomy' => 'faq_cat',
			'hide_empty' => true,
		) );	
		?>
	</div>
</div>

<main class="container">

		<section class="faqs-archive">
		<?php 
			
			// ciclo per ogni categoria FAQ
			if ( ! empty( $faq_cats ) && ! is_wp_error( $faq_cats ) ) {
				foreach ( $faq_cats as $cat ) {
					echo '<h2 class="faqs-section-title">' . esc_html( $cat->name ) . '</h2>';

					// Query per le FAQ nella categoria corrente
					$args = array(
						'post_type' => 'faq',
						'posts_per_page' => -1,
						'tax_query' => array(
							array(
								'taxonomy' => 'faq_cat',
								'field'    => 'term_id',
								'terms'    => $cat->term_id,
							),
						),
					);	

					$the_query = new WP_Query( $args );
					if ( $the_query->have_posts() ) {
						echo '<ul class="faqs">';

						while ( $the_query->have_posts() ) {
							$the_query->the_post(); 
							$risposta = get_field('risposta');
							?>
								<li class="faq">
									
									<h2 class="h5 mb-1">
										<?php the_title(); ?>
									</h2>
									
									<?php 
										echo $risposta;
									?>

									<a href="<?php echo get_the_permalink(); ?>" class="read-more">Apri</a>

								</li>
							<?php
						}

						echo '</ul>';
					} else {
						echo '<p>Nessuna FAQ trovata in questa categoria.</p>';
					}
					wp_reset_postdata();
				}
			}
			?>


		</section>

</main>

<?php get_footer(); ?>
