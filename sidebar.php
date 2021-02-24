
<?php if ( is_active_sidebar( 'sidebar' ) ) : ?>
  <ul id="sidebar" >
    <?php dynamic_sidebar( 'sidebar' ); ?>
  </ul>
<?php endif; ?>

  <?php if (is_single('prodotto') ){ ?>

  <?php
  $categories = get_the_category();
  if ($categories) { ?>
  <div class="block">
  <h2>Potrebbe interessarti</h2>

  <?php $first_cat = $categories[0]->cat_ID;
  $args=array(
  'post_type' => array( 'prodotto'),
  'category__in' => array($first_cat),
  'post__not_in' => array($post->ID),
  'ignore_sticky_posts'=>1
  );
  $my_query = new WP_Query($args);
  if( $my_query->have_posts() ) {


  while ($my_query->have_posts()) : $my_query->the_post(); ?>

    <div class="media">
          <a class="media-left" href="<?php the_permalink(); ?>">
          <?php echo get_the_post_thumbnail($post->ID, 'square-s', array('class' => 'media-object')); ?>
          </a>
          <div class="media-body">
            <h4 class="media-heading"><a href="<?php the_permalink(); ?>" title="Apri <?php the_title(); ?>">
      <?php the_title(); ?></a></h4>

          </div>
    </div>

  <?php
  endwhile;
  }
  wp_reset_query(); ?>

  </div>

  <?php
  } ?>

<?php } ?>