


<?php

     $currenProduct = get_the_ID();

    // verifico se ci sono faq per questa categoria tramite acf field object post multiplo
     $args = array(
      'post_type' => 'faq',
      'posts_per_page' => -1,
      'meta_query' => array(
            array(
                'key' => 'prodotti', // nome del campo ACF
                'value' => '"' . $currenProduct . '"', // valore da cercare
                'compare' => 'LIKE'
            )
      )
    );

    
    $the_query = new WP_Query( $args );

    if ( $the_query->have_posts() ) { ?>
      
        <div class="faqs-section">
            <h2 class="faqs-section-title">Domande frequenti su <?php echo get_the_title($currenProduct); ?></h2>  
            <ul class="faqs">          
            <?php while ( $the_query->have_posts() ) {
                $the_query->the_post(); 
                $risposta = get_field('risposta');

                ?>
                    <li class="faq">
                        <div class="faq-inner">
                            <h3><?php the_title(); ?></h3>
                            <div class="entry-content">
                               <?php echo wp_kses_post( $risposta ); ?>
                            </div>
                        </div>
                    </li>
            <?php } ?>
            </ul>
        </div>
<?php } wp_reset_query(); ?>

