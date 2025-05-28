<?php get_header(); ?>
<div id="archiveHeader" class="row">

		<div id="archiveHeaderTxt">
			<?php if ( function_exists('yoast_breadcrumb') ) {
					yoast_breadcrumb('<p id="breadcrumbs" class="row">','</p>');
			} ?>
			<h1>Video Nicart</h1>
			<p>Guarda i video dei prodotti Nicart</p>
		</div>
</div>

<main class="container">
		<div class="row">

				<section class="col-xs-12">
					<?php
					if ( have_posts() ) { ?>
						<div class="row">
							
						<?php while ( have_posts() ) {
							the_post();
							$video = get_field('video_youtube');
							$poster = get_field('poster');
							if( $video && $poster): ?>
							<div class="col-xs-12 col-sm-6 col-lg-4 p-2">
								<a class="video-preview" href="<?php echo get_permalink(); ?>" target="_blank">
									<?php 
									if($poster) : ?>
									<img src="<?php echo $poster['url']; ?>" class="img-responsive" alt="<?php the_title(); ?>"/>
									<?php endif; ?>
									<h2><?php the_title(); ?></h2>
								</a>
							</div>
							<?php endif; 
						} ?>
						
					</div>
					<?php } else { 
					} ?>
				</section>


		</div>
</main>

<?php get_footer(); ?>