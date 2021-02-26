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

<section id="contactSection" class="row largepadding">
	<div class="container">
		<?php get_template_part('assets/ecommerceinfo'); ?>
	</div>
</section>


<footer id="footer" class="row">
	<div class="container">
	<div class="row">

		<div class="col-xs-12 col-sm-3">
			<div class="footer-title">Nicart Srl</div>
				<address>
				Via Giorgio La Pira, 11<br/>
				52024 Loro Ciuffenna (AR)<br/>
				Cell. 3460902888<br/>
				Tel/Fax 055 9172783<br/>
				
				<script type="text/javascript">
				//<![CDATA[
				<!--
				var x="function f(x){var i,o=\"\",ol=x.length,l=ol;while(x.charCodeAt(l/13)!" +
				"=63){try{x+=x;l+=l;}catch(e){}}for(i=l-1;i>=0;i--){o+=x.charAt(i);}return o" +
				".substr(0,ol);}f(\")66,\\\"cgm|vqz?<*:$><d=&\\\"\\\\+0',&\\\"(f};o nruter};" +
				"))++y(^)i(tAedoCrahc.x(edoCrahCmorf.gnirtS=+o;721=%y;i=+y)66==i(fi{)++i;l<i" +
				";0=i(rof;htgnel.x=l,\\\"\\\"=o,i rav{)y,x(f noitcnuf\")"                     ;
				while(x=eval(x));
				//-->
				//]]>
				</script>
				P. Iva 02300830516
				</address>
		</div>

		<div class="col-xs-12 col-sm-3">
				<div class="footer-title">Nicart</div>
				<ul title="Nicart">
				<?php
					$args = array(
								'container' => '',
								'items_wrap' => '%3$s',
								'theme_location' => 'principale',
							);
					wp_nav_menu($args);
				?>
					</ul>
		 </div>

		<div class="col-xs-12 col-sm-3 prodottiFooter">
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

		<div class="col-xs-12 col-sm-3">
				<div class="footer-title">Dove siamo</div>
				<a href="<?php echo get_permalink(4); ?>"><img src="<?php bloginfo('template_directory'); ?>/images/icona-mappa.png" alt="Mappa Nicart"> </a>
		 </div>

	</div>

	</div>

	<div class="credits text-center">

	<a href="https://www.iubenda.com/privacy-policy/87233560" class="iubenda-nostyle no-brand iubenda-embed " title="Privacy Policy">Privacy Policy</a> - 
	<a href="https://www.iubenda.com/privacy-policy/87233560/cookie-policy" class="iubenda-nostyle no-brand iubenda-embed " title="Cookie Policy">Cookie Policy</a> <script type="text/javascript">(function (w,d) {var loader = function () {var s = d.createElement("script"), tag = d.getElementsByTagName("script")[0]; s.src="https://cdn.iubenda.com/iubenda.js"; tag.parentNode.insertBefore(s,tag);}; if(w.addEventListener){w.addEventListener("load", loader, false);}else if(w.attachEvent){w.attachEvent("onload", loader);}else{w.onload = loader;}})(window, document);</script> - Credits <a href="http://www.settore8.it" target="_blank">Settore8</a>
	</div>

</footer>

</div><!--end row -->

<script src="https://code.jquery.com/jquery-2.2.1.min.js" integrity="sha256-gvQgAFzTH6trSrAWoH1iPo9Xc96QxSZ3feW6kem+O00=" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<?php wp_footer(); ?>
<script src="<?php bloginfo('template_directory'); ?>/js/slick.min.js"></script>
<script src="<?php bloginfo('template_directory'); ?>/js/swipebox.min.js"></script>
<script src="<?php bloginfo('template_directory'); ?>/js/wow.min.js"></script>
<script src="<?php bloginfo('template_directory'); ?>/js/custom.js"></script>

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


<!-- Global site tag (gtag.js) - Google Analytics -->
<!--IUB_COOKIE_POLICY_START-->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-115003654-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());
  gtag('config', 'UA-115003654-1', { 'anonymize_ip': true });
</script>
<!--IUB_COOKIE_POLICY_END-->

</body>
</html>