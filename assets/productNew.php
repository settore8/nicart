
<?php
    $args = array(
      'post_type' => 'prodotto',
      'posts_per_page' => 4,
      'orderby' => 'rand',
      'meta_key'		=> 'evidenza',
      'meta_value'	=> true
    );
    $the_query = new WP_Query( $args );

    if ( $the_query->have_posts($args) ) { ?>
      
      <div class="container">
        <div class="row customsection group">
          <h3>I prodotti Nicart in evidenza</h3>
          
      <?php while ( $the_query->have_posts() ) {
        $the_query->the_post(); ?>

      <?php get_template_part('assets/productPreview'); ?>

  <?php } ?>
    </div>
  </div>
<?php } wp_reset_query(); ?>
