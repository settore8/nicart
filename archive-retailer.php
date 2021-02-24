<?php get_header(); ?>
<div id="archiveHeader" class="row">
      <div id="mappaRivenditori"></div>
</div>

<main class="container">
<div class="row">
<section class="col-xs-12">
	
<div id="reg-top">
    <?php
    $listaregioni = [];
    if (have_posts()) :  while (have_posts()) : the_post();
    $regione = get_field('regione'); 
    array_push($listaregioni, array('value' => $regione['value'], 'label' => $regione['label']));
    endwhile;  endif;
  
    $result = array_map("unserialize", array_unique(array_map("serialize", $listaregioni)));
    usort($result, function($a, $b) {
      return $a['label'] <=> $b['label'];
    });

    echo '<div id="lista_regioni_container">';
    echo '<h1>Rivenditori Nicart</h1> <span>Seleziona una regione</span> <select name="lista_regioni" id="lista_regioni">';
    echo '<option value="top">Seleziona una regione</option>';
    foreach ($result as $r) {
        echo '<option value="'.$r['value'].'">'.$r['label'].'</option>';
    }
    echo '</select></div>';

    foreach ($result as $r) {
      $args = array(
        'post_type' => 'retailer',
        'posts_per_page'	=> -1,
        'meta_key'		=> 'regione',
        'meta_value'	=> $r
      );
    $the_query = new WP_Query( $args );

      if( $the_query->have_posts() ):
        echo '<h2 id="reg-'.$r['value'].'" class="titolo_regione">'.$r['label'].'</h2>';
        echo '<section class="section_rivenditori">';
        while( $the_query->have_posts() ) : $the_query->the_post();
          $website = get_field('website');
          $tel = get_field('telefono');
          $indirizzo = get_field('indirizzo');
          $cap = get_field('cap');
          $location = get_field('mappa');
          if ($location) {
          echo '<article class="rivenditore">';
            echo '<h4>'.get_the_title().'</h4>';
            echo '<span class="citta">'.get_field('citta').'</span> '; 
            if ($indirizzo) {
              echo ' <span>'.$indirizzo.'</span> ';
            }
            echo '<span class="actions">';

            if ($website) {
              echo '<a href="'.$website.'" class="www">sito web</a>';
            }
            if ($tel) {
              echo ' <span class="tel">Tel. <strong>'.$tel.'</strong></span>';
            }

            echo '</span>';
          echo '</article>';
          }
        endwhile;
        echo '</section>';
      endif;
      wp_reset_query();
    }
    ?>
</div>

</section>

</div>
</main>

<?php get_footer(); ?>