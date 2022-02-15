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

	<div class="entry-content col-xs-12 col-sm-6 col-sm-offset-1">
	<header>
		<?php
		$video = get_field('video_youtube');
		?>
		<h1><?php the_title(); ?></h1>
	</header>

	<?php if( $video ): ?>
			<?php
			echo '<div class="embed-container">';
			echo get_field('video_youtube');
			echo '</div>';
	?>
	<?php endif; ?>
	</div>
</article>
	<?php }
}
?>

</div>

</main>

<?php get_footer(); ?>
