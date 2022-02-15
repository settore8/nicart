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

			if( $video ): ?>
			<div class="col-xs-12 col-sm-6">
			<?php
			echo '<div class="embed-container">';
				echo get_field('video_youtube');
			echo '</div>'; ?>

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