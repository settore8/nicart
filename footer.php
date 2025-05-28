<?php 
if(is_product_category()) {
	// get_template_part('assets/categoryFaqs'); 
}
?>

<section id="newsSection" class="row largepadding">
	<div class="container">
		<?php get_template_part('assets/productBestSellers'); ?>
	</div>
</section>

<section id="contactSection" class="row largepadding">
	<div class="container">
		<?php get_template_part('assets/contactForm'); ?>
	</div>
</section>

<section id="iconSection" class="row largepadding">
	<div class="container">
		<?php get_template_part('assets/ecommerceinfo'); ?>
	</div>
</section>


<footer id="footer" class="row">
	<div class="container">
	<div class="row">

		<div class="col-xs-12 col-sm-6 col-md-5">
				<div class="footer-title">Dove siamo e contatti</div>

				<div class="col-xs-8 col-xs-offset-2 col-sm-7 col-sm-offset-0">
					<a href="<?php echo get_permalink(4); ?>"><img src="<?php bloginfo('template_directory'); ?>/images/negozio-nicart-loro-ciuffenna.jpg" alt="Negozio Nicart Loro Ciuffenna (Arezzo)" class="img-responsive foto-negozio"> </a>
				</div>

				<div class="col-xs-12 col-sm-5">
					<address>
					Piazza Pertini, 11<br/>
					52024 Loro Ciuffenna (AR)<br/>
					Tel/Fax 055 9172783<br/>
					P. Iva 02300830516
				</address>
				</div>
				
		 </div>


		<div class="col-xs-12 col-sm-6 col-md-2">
			<div class="footer-title">Nicart Srl</div>
				<ul title="Nicart">
				<?php
					$args = array(
								'container' => '',
								'items_wrap' => '%3$s',
								'theme_location' => 'azienda',
							);
					wp_nav_menu($args);
				?>
				</ul>
				
				
		</div>


		<div class="col-xs-12 col-sm-6 col-md-3">
			<div class="footer-title">Prodotti</div>
			<ul title="Prodotti Nicart">
			<?php
	 				 $args = array(
			 					 'container' => '',
			 					 'items_wrap' => '%3$s',
			 					 'theme_location' => 'prodotti',
			 				 );
			 		 wp_nav_menu($args);
			 		?>
			</ul>
		</div>

		<div class="col-xs-12 col-sm-6 col-md-2">
				<div class="footer-title">Shop on line</div>
				<ul title="Nicart">
				<?php
					$args = array(
								'container' => '',
								'items_wrap' => '%3$s',
								'theme_location' => 'shop',
							);
					wp_nav_menu($args);
				?>
					</ul>
		 </div>



	</div>

	</div>

	<div class="credits text-center">

	<a href="https://www.iubenda.com/privacy-policy/87233560" class="iubenda-nostyle no-brand iubenda-embed " title="Privacy Policy">Privacy Policy</a> - 
	<a href="https://www.iubenda.com/privacy-policy/87233560/cookie-policy" class="iubenda-nostyle no-brand iubenda-embed " title="Cookie Policy">Cookie Policy</a> - <a href="#" class="iubenda-cs-preferences-link">Preferenze Cookie</a> <script type="text/javascript">(function (w,d) {var loader = function () {var s = d.createElement("script"), tag = d.getElementsByTagName("script")[0]; s.src="https://cdn.iubenda.com/iubenda.js"; tag.parentNode.insertBefore(s,tag);}; if(w.addEventListener){w.addEventListener("load", loader, false);}else if(w.attachEvent){w.attachEvent("onload", loader);}else{w.onload = loader;}})(window, document);</script> - Credits <a href="http://www.settore8.it" target="_blank">Settore8</a>
	</div>

</footer>

</div><!--end row -->

<script src="https://code.jquery.com/jquery-2.2.1.min.js" integrity="sha256-gvQgAFzTH6trSrAWoH1iPo9Xc96QxSZ3feW6kem+O00=" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<?php wp_footer(); ?>
<script src="<?php bloginfo('template_directory'); ?>/js/slick.min.js"></script>
<script src="<?php bloginfo('template_directory'); ?>/js/swipebox.min.js"></script>
<script src="<?php bloginfo('template_directory'); ?>/js/wow.min.js"></script>
<script src="<?php bloginfo('template_directory'); ?>/js/custom.js?v=1.2.7"></script>

<script>
new WOW().init();
</script>

<?php
  if ( is_post_type_archive('retailer') ) { 
	  get_template_part('assets/mappa_rivenditori'); 
 } else {
	global $post;
	if($post) :
	$location = get_field('mappa', $post->ID); 
		if($location) { 
		get_template_part('assets/footer_mappa'); 
		}
	endif;
 }?>

 <?php get_template_part('images/icone'); ?>


 <div id="modalspedizione">
  <div class="modal-container">
  		<button id="chiudimodal"> 
          <span aria-hidden="true">&times;</span>
        </button>
		<img src="<?php bloginfo('template_directory'); ?>/images/spedizioni-nicart.svg" alt="Spedizioni Nicart">
  </div>
</div>


<!--IUB_COOKIE_POLICY_START-->
<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-JTHJENDY5G"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-JTHJENDY5G');
</script>
<!--IUB_COOKIE_POLICY_END-->

</body>
</html>