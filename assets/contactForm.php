<div class="col-xs-12 col-sm-8">
	<?php if(is_singular('prodotto')) { ?>
	<h3>Richiedi informazioni su <?php echo get_the_title(); ?></h3>
<?php } else { ?>
	<h3>Ti servono ulteriori informazioni? Scrivici!</h3>
<?php }?>
<?php echo do_shortcode('[contact-form-7 id="15" title="Contatto"]'); ?>
</div>
<div class="col-xs-12 col-sm-4">
	<a href="<?php echo get_permalink(25); ?>" title="Catalogo Nicart" >
		<?php echo get_the_post_thumbnail( 25, 'full', array('class' => 'img-responsive')); ?>
	</a>
</div>