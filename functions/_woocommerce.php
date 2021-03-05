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
add_action('woocommerce_after_single_product', 'video_prodotto', 28);

function video_prodotto() {
	global $product;
	$video = get_field('video', $product->get_id());

	if( $video ): 
		foreach( $video as $post ) {
				setup_postdata( $post);
				echo '<div class="video_prodotto">';
				$vid = get_field('video_youtube', $post->ID);
				//echo '<h2>'.get_the_title().'</h2>';
				echo '<div class="embed-container">';
				echo $vid;
				echo '</div>';
				echo '</div>';
				wp_reset_postdata();
			} 
	endif;
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
add_action( 'woocommerce_after_shop_loop_item', 'prodotto_new', 9 );
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
add_action( 'woocommerce_after_shop_loop_item', 'made_in_italy', 9 );
add_action( 'woocommerce_product_thumbnails', 'made_in_italy', 1 );
function made_in_italy() {
	global $product;
	$madeitaly = get_field('made_italy', $product->get_id());
	if(!empty($madeitaly)) :
		echo '<span class="made"><img src="'.get_template_directory_uri().'/images/made_italy.png'.'" alt="Made in Italy"></span>';
	endif;
};

/**
 * Aggiungo made in USA nella pagina del prodotto
*/
add_action( 'woocommerce_product_thumbnails', 'made_in_usa', 1 );
function made_in_usa() {
	global $product;
	$madeUsa = get_field('made_usa', $product->get_id());
	if(!empty($madeUsa)) :
		echo '<span class="made"><img src="'.get_template_directory_uri().'/images/made_usa.svg'.'" alt="Made in Usa"></span>';
	endif;
};

/**
 * Aggiungo made in Japan nella pagina del prodotto
*/
add_action( 'woocommerce_product_thumbnails', 'made_in_japan', 1 );
function made_in_japan() {
	global $product;
	$madeUsa = get_field('made_japan', $product->get_id());
	if(!empty($madeUsa)) :
		echo '<span class="made"><img src="'.get_template_directory_uri().'/images/made_japan.svg'.'" alt="Made in Japan"></span>';
	endif;
};

/**
 * Aggiungo made in Germany nella pagina del prodotto
*/
add_action( 'woocommerce_product_thumbnails', 'made_in_germany', 1 );
function made_in_germany() {
	global $product;
	$madeUsa = get_field('made_germany', $product->get_id());
	if(!empty($madeUsa)) :
		echo '<span class="made"><img src="'.get_template_directory_uri().'/images/made_germany.svg'.'" alt="Made in Germany"></span>';
	endif;
};


/**
 * Modifico placeholder 
 */

add_filter( 'woocommerce_placeholder_img_src', 'filter_woocommerce_placeholder_img_src', 10, 1);
function filter_woocommerce_placeholder_img_src( $image_url )
 {
	$image_url = get_template_directory_uri().'/images/placeholder.png'; 
    return $image_url;
 }


/**
 * Aggiungo made in italy nella pagina del prodotto
*/


/**
 * Template pagina Account
*/


/**
 * Disabilito voci di menù nella pagina My Account
*/

function custom_my_account_menu_items( $items ) {
    unset($items['downloads']);
    return $items;
}
add_filter( 'woocommerce_account_menu_items', 'custom_my_account_menu_items' );


/*
** variazioni
*/

add_filter( 'woocommerce_dropdown_variation_attribute_options_html', 'wc_product_variation_attributes', 10, 2);
function wc_product_variation_attributes($html, $args) {
return $html;
}


function e12_remove_product_image_link( $html, $post_id ) {
    return preg_replace( "!<(a|/a).*?>!", '', $html );
}
add_filter( 'woocommerce_single_product_image_thumbnail_html', 'e12_remove_product_image_link', 10, 2 );