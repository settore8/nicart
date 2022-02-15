<div class="container">
  <div class="row customsection">
    <?php
       $terms = get_terms( array(
        'taxonomy' => 'product_cat',
        'hide_empty' =>  true,
        'parent' => 0
        ));
    ?>

        <?php 
            if ( ! empty( $terms ) && ! is_wp_error( $terms ) ){
                $categorie = [];
                $newterms = array(); 

                foreach ( $terms as $term) { 
                    $order = get_field('custom_order', $term);
                    $newterms[$order] = $term;
                    ?>
                <?php }

                ksort( $newterms, SORT_NUMERIC );

                foreach ( $newterms as $term) {  ?>   
                    <article class="preview-prodotto col-xs-6 col-sm-3">
                        <a href="<?php echo esc_url( get_term_link( $term ) ); ?>" title="<?php echo $term->name; ?>">
                        <?php if (get_field('anteprima_categoria', $term)) { 
                            $anteprima_categoria = get_field('anteprima_categoria', $term); 
                            ?>
                        <picture>
                            <source srcset="<?php echo $anteprima_categoria['sizes']['medium_large']; ?>">
                            <img src="<?php echo $anteprima_categoria['sizes']['medium_large']; ?>" alt="<?php echo $anteprima_categoria['alt']; ?>" class="img-responsive">
                        </picture>
                        <?php } else { ?>
                            <img src="<?php echo get_template_directory_uri().'/images/placeholder.png'; ?>" class="img-responsive" alt="placeholder"/>
                        <?php }?>
                        <div class="preview-prodotto-txt">
                            <h4><?php echo $term->name; ?></h4>
                        </div>
                        </a>
                    </article>
                <?php 
                }
            }
            ?>
  </div>
</div>
