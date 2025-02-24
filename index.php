<?php get_header(); ?>

<h1 id="tagline" class="row">Accessori e ricambi per giardinaggio</h1>

<section id="contentSection" class="row largepadding">
	<?php get_template_part('assets/categorieProdotti'); ?>
	<?php get_template_part('assets/shopPreview'); ?>
</section>

<section id="aziendaSection" class="row largepadding">
	<div class="container">
		<div class="row">
			<div class="col-sm-6">
			<span class="wow animated fadeInUp">Nicart</span>
			<h2>Accessori e ricambi per il giardinaggio</h2>
			<p class="wow animated fadeInDown">Nicart, un’azienda giovane e dinamica nata dalla passione e dall’approfondita conoscenza degli accessori per decespugliatori sempre più selezionati e professionali, in linea con la nostra idea di azienda che sta sempre più allargando la gamma di articoli a catalogo, ma con un occhio sempre più attento alla qualità degli stessi.</p>
				<a href="<?php echo get_permalink(2); ?>" class="btn btn-primary hvr-grow wow animated fadeInLeft"><i class="icon-information"></i> Chi siamo</a>
				<a href="<?php echo get_permalink(25); ?>" class="btn btn-default hvr-grow wow animated fadeInRight" title="<?php echo get_field('titolo_catalogo', 'options'); ?>"><i class="icon-file-pdf"></i> <?php echo get_field('titolo_catalogo', 'options'); ?></a>
				<a href="https://www.youtube.com/channel/UCgu1RU2allBYhX5mfeuXCfQ?view_as=subscriber" target="_blank" class="btn btn-default hvr-grow wow animated fadeInRight"><i class="icon-youtube-play"></i> Canale YouTube</a>
			</div>
			<div class="col-sm-5 col-sm-offset-1 text-center">
			<a href="<?php echo get_permalink(2); ?>" title="Catalogo Nicart" >
				<?php echo get_the_post_thumbnail(2, 'full', array('class' => 'img-responsive')); ?>
			</a>
			</div>
		</div>
	</div>
</section>


<?php get_footer(); ?>
