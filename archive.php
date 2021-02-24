<?php get_header(); ?>
<div id="archiveHeader" class="row">

<?php 
	if(is_tax() ) { 
	$queried_object = get_queried_object();
	$taxonomy = $queried_object->taxonomy;
	$term_id = $queried_object->term_id;
	$thumbnail = get_field('testata_categoria', $queried_object);

	$title = $queried_object->name;
	$description = $queried_object->description;

	} elseif( is_post_type_archive() ) {
		$title = get_query_var( 'post_type' );
		$description = null;
		$thumbnail = null;
	} else {
		$title = null;
		$description = null;
		$thumbnail = null;
	}
	?>
	<?php if(!empty($thumbnail)) { ?>
		<picture>
			<source srcset="<?php echo $thumbnail['sizes']['md'] ?>" media="(max-width: 768px)">
			<source srcset="<?php echo $thumbnail['sizes']['lg'] ?>">
			<img src="<?php echo $thumbnail['sizes']['lg'] ?>" alt="<?php echo $title; ?>" class="img-responsive">
		</picture>

<?php } ?>
		<div id="archiveHeaderTxt">
			<?php if ( function_exists('yoast_breadcrumb') ) {
					yoast_breadcrumb('<p id="breadcrumbs" class="row">','</p>');
			} ?>
			<h1><?php echo $title; ?></h1>
			<?php if ( have_posts() ) { 
				if(!empty($description)) :
				// mostra la descrizione sotto al titolo solo se non sono presenti articoli.
				echo '<p>'.$description.'</p>';
				endif;
			}?>
		</div>
</div>

<main class="container">
<div class="row">

<section class="col-xs-12">
	<?php
	if ( have_posts() ) { ?>
		<?php while ( have_posts() ) {
			the_post();
			get_template_part('assets/productCompletePreview');
		}
	} else { 
		// mostra la descrizione nel caso in cui la categoria fosse senza prodotti.
		$term = get_queried_object();
		$immagini = get_field('Immagini_categoria', $term);
		$gallery = get_field('galleria', $term);
		$video = get_field('video_collegato', $term);
		?>
		<div class="row">
				<?php 
				if (!empty($immagini)) { ?>
							<div class="col-xs-12 col-sm-5">
								<div class="productSlider">
				<?php foreach ($immagini as $foto) : ?>
						<figure>
							<img src="<?php echo $foto['url'] ?>" class="img-responsive" alt="<?php echo $foto['title']; ?>"/>
						</figure>
				<?php endforeach; ?>
					</div>
					</div>
					<div class="col-xs-12 col-sm-6 col-sm-offset-1 descrizione-categoria">
							<?php echo $description; ?>
							<?php
							
							if( $video ): ?>
								<?php foreach( $video as $post ) {
										setup_postdata( $post); 
										echo '<hr/>';
										echo '<h2>'.get_the_title().'</h2>';
										echo '<div class="embed-container">';
										the_field('video_youtube');
										echo '</div>';
									} 
								wp_reset_postdata();
								?>
							<?php endif; ?>

							<?php 
								if (!empty($gallery)) { ?>
								<div class="row">
									<?php foreach ($gallery as $foto) : ?>
									<figure class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
										<img src="<?php echo $foto['url'] ?>" class="img-responsive" alt="<?php echo $foto['title']; ?>"/>
									</figure>
									<?php endforeach; ?>
								</div>
							<?php } ?>
					</div>
				<?php } else { ?>
					
					<div class="col-xs-12 descrizione-categoria">
						<?php echo $description; ?>	
						<?php 
							if (!empty($gallery)) { ?>
							<div class="row galleria-categoria">
								<?php foreach ($gallery as $foto) : ?>
								<div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
									<img src="<?php echo $foto['url'] ?>" class="img-responsive" alt="<?php echo $foto['title']; ?>"/>
									<h2><?php echo $foto['title']; ?></h2>
								</div>
								<?php endforeach; ?>
							</div>
						<?php } ?>
					</div>
				<?php } ?>
		</div>
	<?php } ?>
</section>


<?php 
get_template_part('assets/bannerCatalogoCompleto');
?>

</div>
</main>

<?php get_footer(); ?>