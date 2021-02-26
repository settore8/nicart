<?php 


function mytheme_add_woocommerce_support() {
    add_theme_support( 'woocommerce' );
}
add_action( 'after_setup_theme', 'mytheme_add_woocommerce_support' );

remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);

/**
 * Sposto i prodotti correlati
*/
remove_action('woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20);
add_action('woocommerce_after_single_product', 'woocommerce_output_related_products', 30);

/**
 * Sposto i meta nella pagina singola del prodotto
*/
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );
add_action('woocommerce_single_product_summary', 'woocommerce_template_single_meta', 1);

/**
 * Rimuove l'ordinamentodei prodotti
*/
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );

/**
 * Rimuove lo stile di default
*/
add_filter( 'woocommerce_enqueue_styles', '__return_false' );

/**
 * Disabilita gallery zoom
*/
function remove_image_zoom_support() {
    remove_theme_support( 'wc-product-gallery-zoom' );
    remove_theme_support( 'wc-product-gallery-lightbox' );
}
add_action( 'wp', 'remove_image_zoom_support', 100 );

/**
 * Change the placeholder image
*/
add_filter('woocommerce_placeholder_img_src', 'custom_woocommerce_placeholder_img_src');

function custom_woocommerce_placeholder_img_src( $src ) {
	$src = get_stylesheet_directory_uri() . '/images/placeholder.svg';
	 
	return $src;
}

/**
 * Aggiungo il video nella pagina del prodotto
*/
function video_prodotto() {
	global $product;
	$video = get_field('video', $product->get_id());
}

/**
 * Aggiungo la scheda pdf nella pagina del prodotto
*/
add_action('woocommerce_after_single_product', 'scheda_prodotto', 29);
function scheda_prodotto() {
	global $product;
	$scheda = get_field('scheda_pdf', $product->get_id());
	if(!empty($scheda)) :
		echo '<a href="'.$scheda['url'].'" class="btn btn-danger pull-right" target="_blank"><i class="icon-file-pdf"></i>'.$scheda['title'].'</a>';
	endif;
}

/**
 * Aggiungo la scheda pdf nella pagina del prodotto
*/

add_action('woocommerce_before_single_product_summary', 'prodotto_new', 1);
function prodotto_new() {
	global $product;
	$novita = get_field('novita',$product->get_id());
	if(!empty($novita)) :
		echo '<span class="new_product">Novità</span>';
	endif;
}


/**
 * Aggiungo made in italy nella pagina del prodotto
*/
add_action( 'woocommerce_product_thumbnails', 'made_in_italy', 1 );
function made_in_italy() {
	global $product;
	$madeitaly = get_field('made_italy', $product->get_id());
	if(!empty($madeitaly)) :
		echo '<span class="made_italy"><img src="'.get_template_directory_uri().'/images/made_italy.png'.'" alt="Made in Italy"></span>';
	endif;
};

/**
 * Aggiungo made in italy nella pagina del prodotto
*/

