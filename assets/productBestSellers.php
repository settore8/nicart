
<?php
    $args = array(
      'post_type' => 'product',
      'meta_key' => 'total_sales',
      'orderby' => 'meta_value_num',
      'posts_per_page' => 4,
    );
    $the_query = new WP_Query( $args );

    if ( $the_query->have_posts($args) ) { ?>
      
        <div class="row customsection group">
          <h3>I prodotti Nicart più venduti</h3>  
            <ul class="products columns-4">          
            <?php while ( $the_query->have_posts() ) {
                $the_query->the_post(); ?>
                <!--<div class="col-xs-6 col-sm-4 col-md-3">-->
                    <?php  wc_get_template_part( 'content', 'product' ); ?>
               <!-- </div>-->
            <?php } ?>
            </ul>
        </div>
<?php } wp_reset_query(); ?>
