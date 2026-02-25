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
if ( ! empty( $faq_cats ) && ! is_wp_error( $faq_cats ) ) {
  foreach ( $faq_cats as $cat ) {

    echo '<h2 class="faqs-section-title">' . esc_html( $cat->name ) . '</h2>';

    $args = array(
      'post_type'      => 'faq',
      'posts_per_page' => -1,
	  'orderby' => 'menu_order',
	  'order' => 'ASC',
      'tax_query'      => array(
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
          <div class="faq-inner">

            <h3 class="faq-title">
              <?php the_title(); ?>
            </h3>

            <div class="entry-content">
              <?php echo wp_kses_post( $risposta ); ?>
            </div>

          </div>
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
