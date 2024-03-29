<?php 


function mytheme_add_woocommerce_support() {
    add_theme_support( 'woocommerce' );
}
add_action( 'after_setup_theme', 'mytheme_add_woocommerce_support' );

remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);

/**
 * Rimuovo i prodotti cross sells
 */
remove_action( 'woocommerce_cart_collaterals', 'woocommerce_cross_sell_display' );


/**
 * Disabilita pulsante add to cart
 */
//remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart');


add_filter( 'woocommerce_loop_add_to_cart_link', 'replace_default_button' );
function replace_default_button(){
    return '<a href="'.get_the_permalink().'" class="button product_type_variable add_to_cart_button" title="Acquista"><span>Vedi</span> <svg><use xlink:href="#arrowcart" width="37" height="24"/></svg></a>';
}

/**
 * Sposto i prodotti correlati
*/
remove_action('woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20);
//add_action('woocommerce_after_single_product', 'woocommerce_output_related_products', 30);


/* cambio titolo prodotti correlati */
add_filter('woocommerce_product_related_products_heading',function(){
	return 'Ti potrebbe interessare';
});

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
	$video_title = get_field('titolo_video', $product->get_id());
	$video_text = get_field('testo_video', $product->get_id());


	if( $video ): 
		echo '<div id="video">';
		foreach( $video as $post ) {
				if( $video_title || $video_title): 
					echo '<div class="video_intro">';
					if( $video_title ): 
						echo '<h3>'.$video_title.'</h3>';
					endif;
					if( $video_text ): 
						echo $video_text;
					endif;
					echo '</div>';
				
				endif;

				setup_postdata( $post);
				echo '<div class="video_prodotto">';
				//$vid = get_field('video_youtube', $post->ID);
				$youtube_video_url = get_field('video_youtube',  $post->ID, false, false);
				$codice = str_replace('https://youtu.be/', '', $youtube_video_url);

				echo '<div class="embed-container">';
				echo '<iframe width="560" height="315" src="https://www.youtube.com/embed/'.$codice.'?rel=0" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';
				//echo $vid;
				echo '</div>';
				echo '</div>';
				wp_reset_postdata();
			} 
		echo '</div>';
	endif;
}



/**
* Aggiungo immagine 
*/
add_action( 'woocommerce_single_product_summary', 'product_banner_after_single_product_title', 6 );
function product_banner_after_single_product_title() { 
    global $product; 
	$banner_product = get_field('banner_product', $product->get_id());
	$banner_product_float = get_field('banner_product_float', $product->get_id()) ? 'float' : 'block';

	if( $banner_product ): 
		echo '<div id="product-banner" class="'.$banner_product_float.'">';
			echo '<img src="'.$banner_product['url'].'"  />';
		echo '</div>';
	endif;
   
}


/**
 * Aggiungo il pulsante video dopo il titolo
*/
add_action( 'woocommerce_single_product_summary', 'custom_action_after_single_product_title', 6 );
function custom_action_after_single_product_title() { 
    global $product; 
	$video = get_field('video', $product->get_id());
	if( $video ): 
		echo '<a href="#video" class="btn btn-video">Guarda il video!</a>';
	endif;
   
}


/**
 * Aggiungo il pulsante video nell'anteprima del prodotto
*/
add_action( 'woocommerce_after_shop_loop_item', 'pulsante_video_anteprima_prodotto', 6 );
function pulsante_video_anteprima_prodotto() { 
	global $product; 
	$video = get_field('video', $product->get_id());
	if( $video ): 
		echo '<a href="'.get_permalink($product->get_id()).'" class="guarda_video_label">Guarda il video!</a>';
	endif;
   
}



/**
 * Aggiungo messaggio spedizione gratuita su prodotti sopra o uguale a una certa cifra
*/
add_action( 'woocommerce_after_shop_loop_item', 'label_spedizione_gratuita', 9 );
function label_spedizione_gratuita() { 
    global $product; 
	$limit = NICART_SPEDIZIONE_GRATUITA;
	if( $product->get_price() >= NICART_SPEDIZIONE_GRATUITA ): 
		echo '<span class="free_shipping_label">Spedizione gratuita!</span>';
	endif;
   
}

add_action( 'woocommerce_single_product_summary', 'messaggio_spedizione_gratuita', 10 );
function messaggio_spedizione_gratuita() { 
    global $product; 
	$limit = NICART_SPEDIZIONE_GRATUITA;
	if( $product->get_price() >= NICART_SPEDIZIONE_GRATUITA ): 
		echo '<span class="free_shipping_text">Questo prodotto beneficia della spedizione gratuita!</span>';
	endif;
}

add_action( 'woocommerce_single_product_summary', 'schema_taglie', 20 );
function schema_taglie() { 
    global $product; 
	$taglie = get_field('schema_taglie', $product->get_id());

	if($taglie && $taglie['url']) {
		echo '<a href="'.$taglie['url'].'" target="_blank" class="guida_alle_taglie">Guida alle Taglie</a>';
	}
}


/**
 * Aggiungo la scheda pdf nella pagina del prodotto
*/
add_action('woocommerce_after_single_product', 'scheda_prodotto', 29);
function scheda_prodotto() {
	global $product;
	$scheda = get_field('scheda_pdf', $product->get_id());
	if(!empty($scheda)) :
		echo '<div class="scheda_tecnica">';
		echo '<a href="'.$scheda['url'].'" class="btn btn-danger" target="_blank"><i class="icon-file-pdf"></i>'.$scheda['title'].'</a>';
		echo '</div>';
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
add_action( 'woocommerce_product_thumbnails', 'made_in_italy', 2 );
function made_in_italy() {
	global $product;
	$madeitaly = get_field('made_italy', $product->get_id());
	if(!empty($madeitaly)) :
		echo '<span class="made"><img src="'.get_template_directory_uri().'/images/made_italy.svg'.'" alt="Made in Italy"></span>';
	endif;
};

/**
 * Aggiungo made in USA nella pagina del prodotto
*/
add_action( 'woocommerce_after_shop_loop_item', 'made_in_usa', 9 );
add_action( 'woocommerce_product_thumbnails', 'made_in_usa', 2 );
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
add_action( 'woocommerce_after_shop_loop_item', 'made_in_japan', 9 );
add_action( 'woocommerce_product_thumbnails', 'made_in_japan', 2 );
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
add_action( 'woocommerce_after_shop_loop_item', 'made_in_germany', 9 );
add_action( 'woocommerce_product_thumbnails', 'made_in_germany', 2 );
function made_in_germany() {
	global $product;
	$madeUsa = get_field('made_in_germany', $product->get_id());
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

/*
** cambio label variazioni
*/

add_filter( 'woocommerce_dropdown_variation_attribute_options_args', 'bt_dropdown_choice' );

function bt_dropdown_choice( $args ){
	// product_cat 26 è l'ID della categoria fili e decespugliatori
	if( is_product() && has_term(26, 'product_cat') ) {
			$args['show_option_none'] = "Scegli sezione e diametro"; // Change your text here
	}  
	return $args;    
}

/*
** Rimuove link nella galleruia
function e12_remove_product_image_link( $html, $post_id ) {
    return preg_replace( "!<(a|/a).*?>!", '', $html );
}
add_filter( 'woocommerce_single_product_image_thumbnail_html', 'e12_remove_product_image_link', 10, 2 );

*/

/*
** Registrazione
*/

add_action( 'woocommerce_register_form', 'bbloomer_add_registration_privacy_policy', 11 );
   
function bbloomer_add_registration_privacy_policy() {
 
woocommerce_form_field( 'privacy_policy_reg', array(
   'type'          => 'checkbox',
   'class'         => array('form-row privacy'),
   'label_class'   => array('woocommerce-form__label woocommerce-form__label-for-checkbox checkbox'),
   'input_class'   => array('woocommerce-form__input woocommerce-form__input-checkbox input-checkbox'),
   'required'      => true,
   'label'         => 'Ho letto la <a href="/privacy-policy">Privacy Policy</a>',
));
  
}
  
// Show error if user does not tick
   
add_filter( 'woocommerce_registration_errors', 'bbloomer_validate_privacy_registration', 10, 3 );
  
function bbloomer_validate_privacy_registration( $errors, $username, $email ) {
if ( ! is_checkout() ) {
    if ( ! (int) isset( $_POST['privacy_policy_reg'] ) ) {
        $errors->add( 'privacy_policy_reg_error', __( 'Accetta la Privacy policy!', 'woocommerce' ) );
    }
}
return $errors;
}

/* Moodifica dicitura prodotti esauriti */
function so_42345940_esaurito_message( $text, $product ){
	if ( !$product->is_in_stock()) {
        $text = 'Prodotto al momento non disponibile';
    }
    return $text;
}
add_filter( 'woocommerce_get_availability_text', 'so_42345940_esaurito_message', 10, 2 );


/* Moodifica dicitura prodotti disponibili */
function so_42345940_disponibile_message( $text, $product ){

	$limit = wc_get_low_stock_amount($product);

	if($product->managing_stock() && $product->is_in_stock() && $product->get_stock_quantity() === 1) {
		$text = 'Solo '. $product->get_stock_quantity() .' pezzo disponibile';
	} elseif($product->managing_stock() && $product->is_in_stock() && $product->get_stock_quantity() <= $limit) {
		$text = 'Ultimi '. $product->get_stock_quantity() .' pezzi disponibili';
	} elseif ( $product->is_in_stock()) {
		$text = 'Prodotto disponibile';
	}
    return $text;
}
add_filter( 'woocommerce_get_availability_text', 'so_42345940_disponibile_message', 10, 2 );

/* Moodifica dicitura disponibile in N giorni */
function so_42345940_backorder_message( $text, $product ){

	if ( $product->is_in_stock() && $product->is_on_backorder(1)) {
        $text = 'Disponibile con consegna in 5-10 giorni';
    }
    return $text;
}
add_filter( 'woocommerce_get_availability_text', 'so_42345940_backorder_message', 10, 2 );


add_filter( 'woocommerce_get_stock_html', 'filter_get_stock_html', 10, 2 );
function filter_get_stock_html( $html, $product ) {
    // Low stock quantity amount
    $low_stock_qty = wc_get_low_stock_amount($product);

    $availability = $product->get_availability();


    if ( ! empty( $availability['availability'] ) && $product->get_stock_quantity() ) {
        $class = esc_attr( $availability['class'] );
        $avail_text = wp_kses_post( $availability['availability'] );
        $stock_qty = $product->get_stock_quantity();

        if( $stock_qty <= $low_stock_qty ){
            $class .= ' few-in-stock';
        }
        ob_start();
        ?>
        <p class="stock <?php echo $class; ?>"><?php echo $avail_text; ?></p>
        <?php

        $html = ob_get_clean();
    }
    return $html;
}



add_filter('woocommerce_checkout_fields', 'unrequire_address_2_checkout_fields' );
function unrequire_address_2_checkout_fields( $fields ) {
	unset($fields['billing']['billing_address_2']);
	return $fields;
}

// Add a custom fee (fixed or based cart subtotal percentage) by payment
add_action( 'woocommerce_cart_calculate_fees', 'custom_handling_fee' );
function custom_handling_fee ( $cart ) {
    if ( is_admin() && ! defined( 'DOING_AJAX' ) )
        return;

    $chosen_payment_id = WC()->session->get('chosen_payment_method');
	
    if ( empty( $chosen_payment_id ) )
        return;

	$chosen_methods = WC()->session->get( 'chosen_shipping_methods' );
	$chosen_shipping = $chosen_methods[0];

	if ( 0 !== strpos( $chosen_shipping, 'local_pickup:3' ) ) {

		$subtotal = $cart->subtotal;

		$contrassegno = NICART_CONTRASSEGNO;
		// SETTINGS: Here set in the array the (payment Id) / (fee cost) pairs
		$targeted_payment_ids = array(
			'cod' => $contrassegno, // Fixed fee
			//'paypal' => 5 * $subtotal / 100, // Percentage fee
		);

		// Loop through defined payment Ids array
		foreach ( $targeted_payment_ids as $payment_id => $fee_cost ) {
			if ( $chosen_payment_id === $payment_id ) {
				$cart->add_fee( __('Pagamento alla consegna ', 'woocommerce'), $fee_cost, true );
			}
		}
		
	} else {

		return;
	}
    
}


// jQuery - Update checkout on payment method change
add_action( 'wp_footer', 'custom_checkout_jquery_script' );
function custom_checkout_jquery_script() {
    if ( is_checkout() && ! is_wc_endpoint_url() ) :
    ?>
    <script type="text/javascript">
    jQuery( function($){
        $('form.checkout').on('change', 'input[name="payment_method"]', function(){
            $(document.body).trigger('update_checkout');
        });
    });
    </script>
    <?php
    endif;
}


/*
** Nascondi altre spedizioni se disponbile la spedizione gratuita
*/


/**
 * Hide shipping rates when free shipping is available, but keep "Local pickup" 
 * Updated to support WooCommerce 2.6 Shipping Zones
 */

function hide_shipping_when_free_is_available( $rates, $package ) {
	$new_rates = array();
	foreach ( $rates as $rate_id => $rate ) {
		// Only modify rates if free_shipping is present.
		if ( 'free_shipping' === $rate->method_id ) {
			$new_rates[ $rate_id ] = $rate;
			break;
		}
	}

	if ( ! empty( $new_rates ) ) {
		//Save local pickup if it's present.
		foreach ( $rates as $rate_id => $rate ) {
			if ('local_pickup' === $rate->method_id ) {
				$new_rates[ $rate_id ] = $rate;
				break;
			}
		}
		return $new_rates;
	}

	return $rates;
}

add_filter( 'woocommerce_package_rates', 'hide_shipping_when_free_is_available', 10, 2 );



function shipping_estimate_html()
{
    return null;
}
add_filter('woocommerce_shipping_estimate_html', 'shipping_estimate_html');



/**
* Sort product search results by menu order
*/

add_action('pre_get_posts','sortby_menuorder_query');
function sortby_menuorder_query($query) {
	if ( isset($_REQUEST['s']) ) {
	$query->set('orderby', 'menu_order');
	$query->set('order', 'ASC');
	}
}

add_filter( 'woocommerce_shipping_free_shipping_is_available', 'free_shipping_for_x_cart_items', 10, 3 );
function free_shipping_for_x_cart_items() {
	
	$cartitems = WC()->cart->get_cart();
	$validitems = 0;
	$exclude_shipping_class = array("ferramenta");
	$total = WC()->cart->subtotal;
	$is_available = false;
	
	if($cartitems) {
		foreach($cartitems as $product) {
			$quantity = $product['quantity'];
			$product = wc_get_product( $product['product_id'] );
			$shipping_class = $product->get_shipping_class();
			if(!$shipping_class || !in_array($product->get_shipping_class(), $exclude_shipping_class)) {
				$validitems = $validitems + $quantity;
			} 
		}
	}


	if($validitems >= 3) {
		$is_available = true;
	} else {
		if(NICART_SPEDIZIONE_GRATUITA < $total) {
			$is_available = true;
		}
	}

    return $is_available;
}


add_action( 'woocommerce_review_order_before_shipping', 'create_notice_free_shipping', 10, 0 );
add_action( 'woocommerce_cart_totals_before_shipping', 'create_notice_free_shipping', 10, 0 );

function create_notice_free_shipping() {
	$cartitems = WC()->cart->get_cart();
	$validitems = 0;
	$exclude_shipping_class = array("ferramenta");
	$total = WC()->cart->total;

	if($cartitems) {
		foreach($cartitems as $product) {
			$quantity = $product['quantity'];
			$product = wc_get_product( $product['product_id'] );
			$shipping_class = $product->get_shipping_class();
			if(!$shipping_class || !in_array($product->get_shipping_class(), $exclude_shipping_class)) {
				$validitems = $validitems + $quantity;
			}
		}
		
	}

    if ($validitems == 1 && NICART_SPEDIZIONE_GRATUITA > $total) {
		$diff =  str_replace('.', ',',NICART_SPEDIZIONE_GRATUITA - $total);
      	$notice = __("Aggiungi <strong>2 articoli</strong> al carrello <br/>oppure articoli di importo superiore a <strong>". $diff . ' euro</strong>');
    } elseif ($validitems == 2 && NICART_SPEDIZIONE_GRATUITA > $total) {
		$diff =   str_replace('.', ',', NICART_SPEDIZIONE_GRATUITA - $total);
        $notice = __("Aggiungi <strong>1 articolo</strong> al carrello <br/>oppure 1 articolo di importo superiore a <strong>". $diff . ' euro</strong>');
    } elseif ($validitems < 3 || NICART_SPEDIZIONE_GRATUITA > $total) {
        //$notice = __("Hai diritto alla spedizione gratuita");
    } elseif ($validitems >= 3 || NICART_SPEDIZIONE_GRATUITA < $total) {
      	//$notice = __("Hai diritto alla spedizione gratuita");
    } 
	if(isset($notice)) {
		echo '<tr><td colspan="2"><div class="cart_spedizione_gratuita"><h5>'.__('Vuoi beneficiare della spedizione gratuita?', 'wp-theme').'</h5>'.$notice.'</div></td><td></td></tr>';
	}
	
}

// AGGIUNGE LA CLASSE DI SPEDIZIONE
add_filter( 'woocommerce_cart_item_name', 'custom_text_cart_item_name', 10, 3 );
function custom_text_cart_item_name( $item_name, $cart_item, $cart_item_key ) {
    $shipping_class = 'ferramenta';

    if( is_cart() && $cart_item['data']->get_shipping_class() === $shipping_class ) {
        $item_name .= '<br /><div class="item-shipping-class">' . __("Questo prodotto non concorre al conteggio per la spedizione gratuita", "woocommerce") . '</div>';
    }
    return $item_name;
}

// Display a custom text under cart item name in checkout
add_filter( 'woocommerce_checkout_cart_item_quantity', 'custom_checkout_text_cart_item_name', 10, 3 );
function custom_checkout_text_cart_item_name( $item_qty, $cart_item, $cart_item_key ) {
    // Here below define your shipping class slug
    $shipping_class = 'ferramenta';

    if( $cart_item['data']->get_shipping_class() === $shipping_class ) {
        $item_qty .= '<br /><div class="item-shipping-class">' . __("Questo prodotto non concorre al conteggio per la spedizione gratuita", "woocommerce") . '</div>';
    }
    return $item_qty;
}


include ( get_stylesheet_directory() . '/functions/_woocommerce-invoice-fields.php' );