<?php 


/*
** Disabilita i tabs nella pagina del prodotto
*/
add_filter( 'woocommerce_product_tabs', 'woo_remove_product_tabs', 98 );

function woo_remove_product_tabs( $tabs ) {

    unset( $tabs['description'] );      	// Remove the description tab
    unset( $tabs['reviews'] ); 			// Remove the reviews tab
    unset( $tabs['additional_information'] );  	// Remove the additional information tab

    return $tabs;
}
   

/* RECENSIONI */

/** 
 * 
 * Serve per abilitare l'abilitazione ai commenti dall'admin
 */

add_action( 'woocommerce_product_bulk_edit_end', 'wcerbe_woocommerce_product_bulk_edit_end' );
function wcerbe_woocommerce_product_bulk_edit_end() {
    $output = '<label><span class="title">' . esc_html__( "Enable reviews", "woocommerce" ) . '?</span>';
    $output .= '<span class="input-text-wrap"><select class="reviews_allowed" name="_reviews_allowed">';
    $options = array(
        ''    => __( '— No change —', 'woocommerce' ),
        'yes' => __( 'Yes', 'woocommerce' ),
        'no'  => __( 'No', 'woocommerce' ),
    );
    foreach ( $options as $key => $value ) {
        $output .= '<option value="' . esc_attr( $key ) . '">' . esc_html( $value ) . '</option>';
    }
    $output .= '</select></span></label>';
    echo $output;
}


add_action( 'woocommerce_product_bulk_edit_save', 'wcerbe_woocommerce_product_bulk_edit_save', 10, 1 );
function wcerbe_woocommerce_product_bulk_edit_save( $product ) {
    // Enable reviews
    if ( ! empty( $_REQUEST['_reviews_allowed'] ) ) {
        if ( 'yes' === $_REQUEST['_reviews_allowed'] ) {
            $product->set_reviews_allowed( 'yes' );
        } else {
            $product->set_reviews_allowed( '' );
        }
    }
    $product->save();
}


/**
 * 
 * 
 */

 function wpd_wc_add_product_reviews() {
  global $product;
  
	if ( ! comments_open() )
    return;
  
  if($product->review_count == 0) {
    $class = 'noreview';
  } else {
    $class = '';
  }
  ?>
	<div class="product-reviews <?php echo $class; ?>">
    <?php call_user_func( 'comments_template', 999 ); ?>
	</div>
  <?php
  }

  add_action('woocommerce_after_single_product', 'wpd_wc_add_product_reviews', 30);


/**
 * Comments fields
 */

function sv_add_wc_review_notes( $review_form ) {
  $review_form['comment_notes_before'] = '';
  $review_form['comment_notes_after'] = '<p class="review-legal-info"><span>Confermo di aver letto e compreso la <a href="https://www.iubenda.com/privacy-policy/87233560" class="iubenda-nostyle no-brand iubenda-embed " title="Privacy Policy">Privacy Policy</a> <script type="text/javascript">(function (w,d) {var loader = function () {var s = d.createElement("script"), tag = d.getElementsByTagName("script")[0]; s.src="https://cdn.iubenda.com/iubenda.js"; tag.parentNode.insertBefore(s,tag);}; if(w.addEventListener){w.addEventListener("load", loader, false);}else if(w.attachEvent){w.attachEvent("onload", loader);}else{w.onload = loader;}})(window, document);</script> ed autorizzo al trattamento dei miei dati</span></p>';
  return $review_form;
}
add_filter( 'woocommerce_product_review_comment_form_args', 'sv_add_wc_review_notes' );



add_filter('get_comment_author', 'my_comment_author', 10, 1);
  function my_comment_author( $author = '' ) {
  // Get the comment ID from WP_Query
  $comment = get_comment( $comment_ID );
  if (!empty($comment->comment_author) ) {
  if($comment->user_id > 0){
  $user=get_userdata($comment->user_id);
  //$author=$user->first_name.' '.substr($user->last_name,0,1).'.'; // this is the actual line you want to change
  $provincia = !user_can( $comment->user_id, 'manage_options' ) ? ', ' . get_user_meta( $comment->user_id, 'shipping_state', true ) : '';
  $author = $user->first_name. ' ' . $provincia; // this is the actual line you want to change
  } else {
    // $author = __('Anonymous');
  }
  } else {
    // $author = $comment->comment_author;
  }
return $author;
}


add_filter( 'comment_text', 'ci_comment_rating_display_rating');
function ci_comment_rating_display_rating( $comment_text ){

	if ( $rating = get_comment_meta( get_comment_ID(), 'rating', true ) ) {
		$stars = '<div class="stars">';
		for ( $i = 1; $i <= $rating; $i++ ) {
			$stars .= '<span></span>';
		}
		$stars .= '</div>';
		$comment_text = $comment_text . $stars;
		return $comment_text;
	} else {
		return $comment_text;
	}
}

add_action( 'comment_form_logged_in_after', 'ci_comment_rating_rating_field' );

function ci_comment_rating_rating_field () {
?>
<div class="comment-form-rating-custom">
<label for="rating">La tua valutazione<span class="required">*</span></label>
<p class="stars">
<span>
<?php for( $i = 5; $i >= 1; $i-- ) { ?>
  <a class="star-<?php echo $i; ?>" href="#"><?php echo $i; ?></a>
<?php } ?>
</span>
</p>
</div>
<?php
}


add_action( 'woocommerce_single_product_summary', 'custom_rating_single_product_summary', 4 );
function custom_rating_single_product_summary() {
    global $product;

    if ( $product->get_rating_count() > 0 ) {
        remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10 );
        add_action( 'woocommerce_single_product_summary', 'replace_product_rating', 9 );
    }

}


add_action( 'woocommerce_before_shop_loop_item', 'rating_anteprima_prodotto', 1);
function rating_anteprima_prodotto() { 
	global $product; 
  if ( $product->get_rating_count() > 0 ) {
    remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );
    add_action( 'woocommerce_after_shop_loop_item_title', 'replace_product_rating_loop', 5 );
  }
   
}


// Content function
function replace_product_rating_loop() {
  global $product;

  $rating_count = $product->get_rating_count();
  $review_count = $product->get_review_count();
  $average      = $product->get_average_rating();
 
  $percent = 100 / 5 * $average;
  if($review_count > 0) {

  if($review_count == 1) {
    $rec = 'recensione';
  } else {
    $rec = 'recensioni';
  }
  echo '<div class="reviews-average"><div class="star-ratings-css"><div class="star-ratings-css-top" style="width: '.$percent.'%"><span>★</span><span>★</span><span>★</span><span>★</span><span>★</span></div>
<div class="star-ratings-css-bottom"><span>★</span><span>★</span><span>★</span><span>★</span><span>★</span></div></div><span class="reviews-counter"><span class="n">'.$review_count.'</span> '.$rec.'</span></div>';
  }
}




// Content function
function replace_product_rating() {
  global $product;

  $rating_count = $product->get_rating_count();
  $review_count = $product->get_review_count();
  $average      = $product->get_average_rating();
 
  $percent = 100 / 5 * $average;
  if($review_count > 0) {

  if($review_count == 1) {
    $rec = 'recensione';
  } else {
    $rec = 'recensioni';
  }
  echo '<div class="reviews-average"><a href="#reviews"><div class="star-ratings-css"><div class="star-ratings-css-top" style="width: '.$percent.'%"><span>★</span><span>★</span><span>★</span><span>★</span><span>★</span></div>
<div class="star-ratings-css-bottom"><span>★</span><span>★</span><span>★</span><span>★</span><span>★</span></div></div><span class="reviews-counter"><span class="n">'.$review_count.'</span> '.$rec.'</span></a></div>';
  }
}


add_action( 'woocommerce_review_order_before_submit', 'bbloomer_add_checkout_privacy_policy', 9 );
    
function bbloomer_add_checkout_privacy_policy() {
   
woocommerce_form_field( 'privacy_policy', array(
   'type'          => 'checkbox',
   'class'         => array('form-row privacy'),
   'label_class'   => array('woocommerce-form__label woocommerce-form__label-for-checkbox checkbox'),
   'input_class'   => array('woocommerce-form__input woocommerce-form__input-checkbox input-checkbox'),
   'required'      => true,
   'label'         => 'Ho letto e accetto l\'<a href="#">informativa sulla Privacy</a>',
)); 
   
}
   