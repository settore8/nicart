<?php if( isset($_GET['token']) && isset($_GET['token']) == 'V80CKJUJyefhWcjkU8qlpxpDzU0SOLZBpeWRVZvFv01g0G6PdPuP9k4nR8AA7zrVTvhpqv7fGYxPWbOy0xqz6KgQ1T0uyeipFEo3ljwVGfIwakMRVbpq3ixFbbmYQ0gBnRhzgjLxw' ) {
header('Location: /NICART_generale_2023_v1.pdf');
exit;
} ?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head id="head">
	<title><?php wp_title();?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<meta name="google-site-verification" content="IdUVse-Tm5fOqyzsCEe1ROpAvHN6PT0N7q7z9GaTUjk" />
	<meta name="google-site-verification" content="zEhtJGuZ3dPvEKIvf_S0K7XfZWrdByeHA0nEqTQn3OM" />
	<link href="<?php bloginfo('stylesheet_url'); ?>?v=1.2.7" rel = "stylesheet">
	<link href="<?php bloginfo('template_directory'); ?>/hover.css" rel = "stylesheet">
	<link rel="apple-touch-icon" sizes="180x180" href="<?php bloginfo('template_directory'); ?>/images/favicons/apple-touch-icon.png">
	<link rel="icon" type="image/png" sizes="32x32" href="<?php bloginfo('template_directory'); ?>/images/favicons/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="16x16" href="<?php bloginfo('template_directory'); ?>/images/favicons/favicon-16x16.png">
	<link rel="manifest" href="<?php bloginfo('template_directory'); ?>/images/favicons/manifest.json">
	<link rel="mask-icon" href="<?php bloginfo('template_directory'); ?>/images/images/favicons/safari-pinned-tab.svg" color="#ffffff">
	<meta name="theme-color" content="#ffffff">
	<?php wp_head(); ?>

	<?php if(is_home() ) : ?>
		<script type="application/ld+json">
		{
			"@context": "http://schema.org",
			"@type": "GardenStore",
			"name": "Nicart Srl",
			"address": {
				"@type": "PostalAddress",
				"streetAddress": "Piazza Pertini, 11",
				"addressLocality": "Loro Ciuffenna",
				"addressRegion": "AR",
				"postalCode": "52024"
			},
			"image": "<?php bloginfo('template_directory'); ?>/images/logo-nicart.png",
			"email": "info@nicart.it",
			"telePhone": "<?php echo NICART_TEL; ?>",
			"faxNumber": "0559172783",
			"url": "www.nicart.it",
			"openingHours": "Mo,Tu,We,Th,Fr 0-0",
			"geo": {
				"@type": "GeoCoordinates",
				"latitude": "43.58297144571846",
				"longitude": "11.62230134010315"
			}

		}
		</script>
		<?php endif; ?>
</head>

<body <?php body_class(); ?>>
<script>
  window.fbAsyncInit = function() {
    FB.init({
      appId      : '103361310281343',
      xfbml      : true,
      version    : 'v2.9'
    });
    FB.AppEvents.logPageView();
  };
  (function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "//connect.facebook.net/it_IT/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));
</script>

<div id="site" class="container-fluid">
	<header id="header" class="row">

		<div id="topmenu">
			<div class="contenitore">
			<a class="topmessage" href="<?php echo get_permalink(wc_terms_and_conditions_page_id()); ?>"><span class="blink">Spedizione gratuita per gli ordini con minimo 3 articoli* <br/>o con carrello sopra i <?php echo NICART_SPEDIZIONE_GRATUITA; ?>€</span></a>
			<a class="topcontact" href="tel:+39<?php echo NICART_TEL; ?>"><svg><use xlink:href="#tel" width="24" height="24"/></svg> <?php echo NICART_TEL; ?> <span class="assistenza">Assistenza gratuita</span></a>
			<?php if ( is_user_logged_in() ) { ?>
				<a href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>" title="" class="user">Area Utente</a>
			<?php } 
			else { ?>
				<a href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>" title=""  class="user">Login / Registrati</a>
			<?php } ?>
			<a class="cart" href="<?php echo wc_get_cart_url(); ?>" title="">
			<svg><use xlink:href="#cart" width="24" height="24"/></svg><span class="cart--counter"><?php echo WC()->cart->get_cart_contents_count(); ?></span><?php echo WC()->cart->get_cart_total(); ?></a>
			</div>
		</div>

		

		<nav id="navigazione" class="navbar navbar-default">
			<div class="container">

				<div class="navbar-header">

				

				<!--
				<button type="button" id="searchtoggle" aria-expanded="false">
					<svg><use xlink:href="#cerca" width="26" height="26"/></svg>
					<span>Ricerca</span>
				 </button>
				-->

				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#menu" aria-expanded="false">
		        <span class="icon-bar"></span>
		        <span class="icon-bar"></span>
		        <span class="icon-bar"></span>
		     	</button>

		     	<a class="navbar-brand"  href="<?php echo home_url(); ?>" title="Ritorna alla homepage di Nicart, accessori e ricambi per giardinaggio"><img src="<?php bloginfo("template_url"); ?>/images/logo-nicart.svg" alt="Logo Nicart" class="img-responsive"></a>

		     	</div>


			    <div class="collapse navbar-collapse" id="menu">
			      <ul class="nav navbar-nav navbar-right">
				  	<li class="menu-item">
						<?php echo get_product_search_form(); ?>
					</li>
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

				

				
		    </div>
		</nav>
		
	</header>