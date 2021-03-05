
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
        <div class="customsection">
          <h3>I prodotti Nicart in evidenza</h3>
            <ul class="products columns-4">
            <?php while ( $the_query->have_posts() ) {
              $the_query->the_post(); 
                wc_get_template_part( 'content', 'product' );
            ?>
           <?php } ?>
            </ul>
          
    </div>
  </div>
<?php } wp_reset_query(); ?>
