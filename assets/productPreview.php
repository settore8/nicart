<article class="preview-prodotto col-xs-6 col-sm-3 wow animated fadeInUp">
  <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
  <?php if (has_post_thumbnail()) { ?>
  <picture>
    <source srcset="<?php the_post_thumbnail_url('squareSmall'); ?>">
    <img src="<?php the_post_thumbnail_url('squareSmall'); ?>" alt="<?php the_title(); ?>" class="img-responsive">
  </picture>
  <?php } else { ?>
    <img src="<?php echo get_template_directory_uri().'/images/placeholder.png'; ?>" class="img-responsive" alt="placeholder"/>
  <?php }?>
  <div class="preview-prodotto-txt">
    <h4><?php the_title(); ?></h4>
    <p><?php echo get_field('sottotitolo'); ?></p>
  </div>

  <?php if (get_field('prezzo')) { ?>
    <div class="preview-prodotto-hover">
      <strong><?php echo get_field('prezzo'); ?></strong>€
    </div>
<?php } ?>
  </a>
</article>
