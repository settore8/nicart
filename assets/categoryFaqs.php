
<?php

    $args = array(
      'post_type' => 'faq',
      'posts_per_page' => -1,

    );
    $the_query = new WP_Query( $args );

    if ( $the_query->have_posts($args) ) { ?>
      
        <div class="row customsection group">
          <h3>Domande frequenti</h3>  
            <ul class="faqs">          
            <?php while ( $the_query->have_posts() ) {
                $the_query->the_post(); 
                $risposta = get_field('risposta');
                ?>
                    <li class="faq">
                        <div class="product-inner">
                            <h4><?php the_title(); ?></h4>
                            <div class="entry-content">
                                <?php echo $risposta; ?>
                            </div>
                        </div>
                    </li>
            <?php } ?>
            </ul>
        </div>
<?php } wp_reset_query(); ?>
