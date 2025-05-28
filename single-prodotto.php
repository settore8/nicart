<?php get_header(); ?>

<?php
if ( have_posts() ) {
	while ( have_posts() ) {
		the_post(); ?>

		<?php if ( function_exists('yoast_breadcrumb') ) {
			yoast_breadcrumb('<div id="breadcrumbs" class="row"><p class="container">','</p></div>');
		} ?>

<main class="container">

<div class="row">
<div class="col-xs-12">
<article class="row">
<?php 
$italy = get_field('made_italy');
if ($italy) { ?>
      <span class="made_italy">
        <img src="<?php echo get_template_directory_uri().'/images/made_italy.png'; ?>" alt="Made in Italy">
      </span>
  <?php } ?>

	<div class="col-xs-12 col-sm-5">
	<?php
	if (has_post_thumbnail()) {
	$post = get_the_ID();
	$thumb_id = get_post_thumbnail_id($post);
	$alt = get_post_meta($thumb_id, '_wp_attachment_image_alt', true);
	$caption = get_post($thumb_id)->post_excerpt;
	$description = get_post($thumb_id)->post_content;
	$altrefoto = get_field('immagini_prodotto'); ?>
	<div class="productSlider">
		<figure>
			<img src="<?php the_post_thumbnail_url(); ?>" class="img-responsive" alt="<?php if ($alt) { echo $alt; } else { the_title(); } ?>"/>
			<?php if($caption) { ?>
			 <figcaption>
			 <?php // echo $caption; ?>
			 <?php // echo $description; ?>
			 </figcaption>
			 <?php } ?>
		</figure>

	<?php if (!empty($altrefoto)) {
			foreach ($altrefoto as $foto) { ?>
				<figure>
					<img src="<?php echo $foto['url'] ?>" class="img-responsive" alt="<?php echo $foto['title']; ?>"/>
					<?php if(!empty($foto['caption'])) { ?>
					 <figcaption>
					 <?php // echo $foto['caption']; ?>
					 <?php // echo $foto['description']; ?>
					 </figcaption>
					 <?php } ?>
				</figure>
			<?php } ?>
	<?php } ?>
</div>
	<?php }  else { ?>
		<img src="<?php echo get_template_directory_uri().'/images/placeholder.png'; ?>" class="img-responsive" alt="<?php the_title(); ?>"/>
	<?php }?>
	<div class="fb-like" data-href="<?php the_permalink(); ?>" data-size="large" data-layout="button_count" data-action="like" data-show-faces="false" data-share="true"></div>
	</div>

	<div class="entry-content col-xs-12 col-sm-6 col-sm-offset-1">
	<header>
		<?php
		$cod = get_field('codice_articolo');
		$video = get_field('video');
		$scheda = get_field('scheda_pdf');
		?>
		<?php
		if($cod) {
			echo '<span class="cod">cod. <strong>'.$cod.'</strong></span> ';
		}
		?>
		<h1><?php the_title(); ?></h1>

	</header>
	<?php the_content(); ?>

	<?php if(!empty($scheda)) : ?>
	<a href="<?php echo $scheda['url']; ?>" class="btn btn-danger pull-right" target="_blank"><i class="icon-file-pdf"></i><?php echo $scheda['title']; ?></a>

	<?php endif; ?>
	<div id="contactButton" class="btn btn-primary"><i class="icon-information"></i>Vuoi saperne di più?</div>
	<footer>
		<hr/>
		<?php if( $video ): ?>
				<?php foreach( $video as $post ) {
						setup_postdata( $post); 
						echo '<h2>'.get_the_title().'</h2>';
						echo '<div class="embed-container">';
						echo get_field('video_youtube');
						echo '</div>';
					} 
				wp_reset_postdata();
				?>
		<?php endif; ?>
	</footer>
	</div>
</article>
	<?php }
}
?>

</div>

</main>

<?php get_footer(); ?>
