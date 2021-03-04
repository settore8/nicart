<?php get_header(); ?>

<?php
if ( have_posts() ) {
	while ( have_posts() ) {
		the_post(); ?>
		
		<?php if ( function_exists('yoast_breadcrumb') ) {
			yoast_breadcrumb('<div id="breadcrumbs" class="row"><p class="container">','</p></div>');
		} ?>

		<main class="container">
			<article class="row entry-content" itemscope itemtype="http://schema.org/Service">
					
					<?php $location = get_field('mappa'); 
					if($location) { ?>
						<!--IUB_COOKIE_POLICY_START-->
						<div class="acf-map col-sm-5">
								<div class="marker" data-lat="<?php echo $location['lat']; ?>" data-lng="<?php echo $location['lng']; ?>">
									<div class="row" style="margin-left: 0px; margin-right: 0px;">
										<div class="col-xs-5">
										<?php echo get_the_post_thumbnail(get_the_ID(), 'medium', array('class' => 'img-responsive')); ?>
										</div>
										<div class="col-xs-7">
										<h4>Nicart</h4>
										<p class="address">Via G. La Pira, 11<br/>
										52024 Loro Ciuffenna (AR)<br/>
										Cell. 3460902888 – Tel/Fax 055 9172783<br/>
										info@nicart.it 
										</p>
										</div>
									</div>
								</div>
						</div>
						<!--IUB_COOKIE_POLICY_END-->
					<?php } ?>	

					<?php if(has_post_thumbnail()) : ?>
					<figure class="col-sm-5">
						<?php echo get_the_post_thumbnail(get_the_ID(), 'full', array('class' => 'img-responsive')); ?>
					</figure>
					<?php endif; ?>
					
					<header class="col-sm-7">

					<h1><?php the_title(); ?></h1>
					<?php the_content(); 
					$galleries = get_field('galleria');
					if( $galleries ): ?>
						<?php foreach( $galleries as $gallery): ?>

						<?php
						$immagini = get_field('immagini', $gallery->ID);

							if($immagini) { ?>
								<div class="panel galleryBox">
								<div class="row">
									<?php foreach( $immagini as $image ): ?>
									<figure itemscope itemtype="http://schema.org/ImageObject" class="col-xs-6 col-sm-4 col-lg-3">
									<a href="<?php echo $image['url']; ?>" class="swipebox" title="<?php echo $image['title']; ?>">
									<img src="<?php echo $image['sizes']['squareSmall']; ?>" alt="<?php if ($image['alt'] != '') { echo $image['alt']; } else { echo get_the_title(); } ?>" class="img-responsive" itemprop="contentUrl"/>
									<figcaption><?php echo $image['caption']; ?></figcaption>
									</a>
									</figure>
									<?php endforeach; ?>
								</div>
								</div>
							<?php } ?>

						<?php endforeach; ?>
					<?php endif; ?>
					
					</header>
				<footer>
				<?php
				$postID = get_the_ID();
				$args = array(
					'post_type' => 'page',
					'orderby' => 'menu_order',
					'post_parent' => $postID,
					'order' => 'ASC',
					'posts_per_page' => -1
				);

				query_posts($args); if (have_posts()) : ?>
				<div class="row">
					<div class="col-xs-12">

						<section class="childPage" itemprop="itemListElement" >
							<div class="row">

							<?php while ( have_posts() ) : the_post(); ?>
								<?php get_template_part('assets/pagePreview'); ?>
							<?php endwhile;
							?>
							</div>
						</section>

					</div>
				</div>

				<?php endif;
				
				wp_reset_query(); ?>

				</footer>
			</article>
			
	<?php }
}
?>
</main>


<?php get_footer(); ?>
