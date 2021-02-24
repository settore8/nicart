<?php 
$codice = get_field('codice_articolo');
$new = get_field('novita');
$italy = get_field('made_italy');
$video = get_field('video');
?>

<article class="preview-prodotto preview-prodotto-full col-xs-12">

 <div class="row">
  <?php if (has_post_thumbnail()) { ?>
    <picture class="col-xs-12 col-sm-5 col-md-4">
      <source srcset="<?php the_post_thumbnail_url('squareSmall'); ?>">
      <img src="<?php the_post_thumbnail_url('squareSmall'); ?>" alt="<?php the_title(); ?>" class="img-responsive">
    </picture>
  <?php } else { ?>
    <picture class="col-xs-12 col-sm-5 col-md-4">
    <img src="<?php echo get_template_directory_uri().'/images/placeholder.png'; ?>" class="img-responsive" alt="placeholder"/>
    </picture>
  <?php } ?>

  <?php if ($italy) { ?>
      <span class="made_italy">
        <img src="<?php echo get_template_directory_uri().'/images/made_italy.png'; ?>" alt="Made in Italy">
      </span>
  <?php } ?>

  <div class="preview-prodotto-txt col-xs-12 col-sm-7 col-md-8">
    <?php if ($codice) { ?>
        <small class="codice"><?php echo $codice; ?></small>
    <?php } ?>

    <h2><?php the_title(); ?></h2>
    <h4><?php echo get_field('sottotitolo'); ?></h4>
    <?php  the_content(); ?>

    <?php if ($new) { ?>
      <span class="new_product">Novità</span>
    <?php } ?>

  <?php if ($video) { ?>
    <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" class="btn btn-danger link_video pull-right"><i class="icon-video"></i> Guarda video</a>
  <?php } ?>

  <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" class="btn btn-primary link_open pull-right">Dettagli <i class="icon-right-open"></i></a>

  </div>

  </div>

</article>