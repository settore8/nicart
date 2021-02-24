
<?php
    $args = array(
      'post_type' => 'product',
      'posts_per_page' => 8,
      'orderby' => 'rand',
      'tax_query' => array(
          array(
              'taxonomy' => 'product_visibility',
              'field'    => 'name',
              'terms'    => 'featured',
          ),
        ),
    );
    $the_query = new WP_Query( $args );

    if ( $the_query->have_posts($args) ) { ?>
      
      <div class="container">
        <div class="row customsection group">
          <h3>I prodotti Nicart in evidenza</h3>
            <div class="col-xs-6 col-sm-4 col-md-3">
            <?php while ( $the_query->have_posts() ) {
              $the_query->the_post(); 
                wc_get_template_part( 'content', 'product' );
            ?>
            </div>
      <?php //get_template_part('assets/productPreview'); ?>

  <?php } ?>
    </div>
  </div>
<?php } wp_reset_query(); ?>
