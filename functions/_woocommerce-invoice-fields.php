<?php 

/**
 * CHECKOUT FATTURAZIONE
 */

// aggiunge i campi al checkout
add_action( 'woocommerce_after_checkout_billing_form', 'add_custom_checkout_field' );
function add_custom_checkout_field() {

	
	echo '<div id="show_if_invoice_fields">';

   woocommerce_form_field( 'show_invoice_fields', array(
      'type'          => 'checkbox',
      'class'         => array('form-row-wide'),
      'label'         => __('Ho bisogno della fattura'),
      ),
	  WC()->checkout->get_value( 'show_invoice_fields' )
	);

	

	woocommerce_form_field( 'ragione_sociale', array(
		'type'          => 'text',
		'class'         => array('form-row'),
		'label'         => __('Ragione Sociale'),
		'required'      => true,
		'hidden'        => true,
	),
	WC()->checkout->get_value( 'ragione_sociale' ));

	woocommerce_form_field( 'partita_iva', array(
		'type'          => 'text',
		'class'         => array('form-row'),
		'label'         => __('Partita Iva'),
		'required'      => true,
		'hidden'        => true,
	),
	WC()->checkout->get_value( 'partita_iva' ));


	woocommerce_form_field( 'codice_fiscale', array(
		'type'          => 'text',
		'class'         => array('form-row'),
		'label'         => __('Codice Fiscale'),
		'required'      => true,
		'hidden'        => true,
	),
	WC()->checkout->get_value( 'codice_fiscale' ));

	woocommerce_form_field( 'codice_univoco', array(
		'type'          => 'text',
		'class'         => array('form-row'),
		'label'         => __('Codice univoco SDI'),
		'required'      => true,
		'hidden'        => true,
	),
	WC()->checkout->get_value( 'codice_univoco' ));

	echo '</div>';
}

// verifica i campi obbligatori
add_action( 'woocommerce_checkout_process', 'validate_invoice_fields' );
function validate_invoice_fields() {
   if( isset( $_POST['show_invoice_fields'] ) && $_POST['show_invoice_fields'] == 1 ) {
      if( empty( $_POST['ragione_sociale'] ) ) {
         wc_add_notice( '<strong>'.__( 'Ragione Sociale' ).'</strong> è un campo obbligatorio', 'error' );
      }
      if( empty( $_POST['partita_iva'] ) ) {
		wc_add_notice( '<strong>'.__( 'Partita Iva' ).'</strong> è un campo obbligatorio', 'error' );
      }
      if( empty( $_POST['codice_fiscale'] ) ) {
		wc_add_notice( '<strong>'.__( 'Codice fiscale' ).'</strong> è un campo obbligatorio', 'error' );
      }
      if( empty( $_POST['codice_univoco'] ) ) {
		wc_add_notice( '<strong>'.__( 'Codice Univoco' ).'</strong> è un campo obbligatorio', 'error' );
      }
   }
}

// aggiunge ii dati all'ordine
add_action( 'woocommerce_checkout_create_order', 'save_custom_checkout_field_value' );
function save_custom_checkout_field_value( $order ) {
   if( isset( $_POST['show_invoice_fields'] ) ) {
      $order->update_meta_data( '_show_invoice_fields', $_POST['show_invoice_fields'] );
      $order->update_meta_data( '_ragione_sociale', $_POST['ragione_sociale'] );
      $order->update_meta_data( '_partita_iva', $_POST['partita_iva'] );
      $order->update_meta_data( '_codice_fiscale', $_POST['codice_fiscale'] );
      $order->update_meta_data( '_codice_univoco', $_POST['codice_univoco'] );
   }
}

// aggiunge i dati all'email
add_action( 'woocommerce_email_after_order_table', 'add_invoice_fields_to_email', 10, 4 );
function add_invoice_fields_to_email( $order, $sent_to_admin, $plain_text, $email ) {
   $show_invoice_fields = get_post_meta( $order->get_id(), '_show_invoice_fields', true );
   if( $show_invoice_fields == 1 ) {
      $ragione_sociale = get_post_meta( $order->get_id(), '_ragione_sociale', true );
      $partita_iva = get_post_meta( $order->get_id(), '_partita_iva', true );
      $codice_fiscale = get_post_meta( $order->get_id(), '_codice_fiscale', true );
      $codice_univoco = get_post_meta( $order->get_id(), '_codice_univoco', true );
      echo '<h2>' . __( 'Dati Fatturazione' ) . '</h2>';
      echo '<p><strong>' . __( 'Ragione Sociale' ) . ':</strong> ' . $ragione_sociale . '</p>';
      echo '<p><strong>' . __( 'Partita IVA' ) . ':</strong> ' . $partita_iva . '</p>';
      echo '<p><strong>' . __( 'Codice Fiscale' ) . ':</strong> ' . $codice_fiscale . '</p>';
      echo '<p><strong>' . __( 'Codice Univoco' ) . ':</strong> ' . $codice_univoco . '</p>';
   }
}

add_action( 'woocommerce_admin_order_data_after_billing_address', 'add_additional_fields_to_admin_order_detail', 10, 1 );
function add_additional_fields_to_admin_order_detail( $order ) {
   $show_additional_fields = get_post_meta( $order->get_id(), '_show_additional_fields', true );
   if( $show_additional_fields == 1 ) {
      $ragione_sociale = get_post_meta( $order->get_id(), '_ragione_sociale', true );
      $partita_iva = get_post_meta( $order->get_id(), '_partita_iva', true );
      $codice_fiscale = get_post_meta( $order->get_id(), '_codice_fiscale', true );
      $codice_univoco = get_post_meta( $order->get_id(), '_codice_univoco', true );
   }
}

add_action( 'woocommerce_admin_order_data_after_billing_address', 'add_additional_fields_to_admin_order', 10, 1 );
function add_additional_fields_to_admin_order( $order ) {

   echo '<div class="show_if_additional_fields">';

   woocommerce_wp_text_input( array(
      'id' => '_ragione_sociale',
      'label' => __('Ragione Sociale'),
      'value' => get_post_meta( $order->get_id(), '_ragione_sociale', true ),
      'desc_tip' => true,
    
   ));
   
   woocommerce_wp_text_input( array(
		'id' => '_partita_iva',
		'label' => __('Partita Iva'),
		'value' => get_post_meta( $order->get_id(), '_partita_iva', true ),
		'desc_tip' => true,
 	));

	woocommerce_wp_text_input( array(
		'id' => '_codice_fiscale',
		'label' => __('Codice Fiscale'),
		'value' => get_post_meta( $order->get_id(), '_codice_fiscale', true ),
		'desc_tip' => true,
 	));

	 woocommerce_wp_text_input( array(
		'id' => '_codice_univoco',
		'label' => __('Codice univoco'),
		'value' => get_post_meta( $order->get_id(), '_codice_univoco', true ),
		'desc_tip' => true,
 	));

   echo '</div>';
}

add_action( 'save_post_shop_order', 'save_additional_fields_to_order', 10, 1 );
function save_additional_fields_to_order( $order_id ) {
   if( isset( $_POST['_ragione_sociale'] ) ) {
      update_post_meta( $order_id, '_ragione_sociale', sanitize_text_field( $_POST['_ragione_sociale'] ) );
   }
   if( isset( $_POST['_partita_iva'] ) ) {
      update_post_meta( $order_id, '_partita_iva', sanitize_text_field( $_POST['_partita_iva'] ) );
   }
   if( isset( $_POST['_codice_fiscale'] ) ) {
	update_post_meta( $order_id, '_codice_fiscale', sanitize_text_field( $_POST['_codice_fiscale'] ) );
	}
	if( isset( $_POST['_codice_univoco'] ) ) {
		update_post_meta( $order_id, '_codice_univoco', sanitize_text_field( $_POST['_codice_univoco'] ) );
	}
}

/**
 * ADD javascript to checkout page
*/
 
add_action( 'wp_footer', 'checkout_add_jscript_checkout', 9999 );
function checkout_add_jscript_checkout() {
   if ( is_checkout()  ) {
      echo "<script>
            function check_need_invoice() {
                if($('#show_invoice_fields').is(':checked')){
                    $('.form-row#ragione_sociale_field').show();
                    $('.form-row#partita_iva_field').show();
                    $('.form-row#codice_fiscale_field').show();
                    $('.form-row#codice_univoco_field').show();
                }else{
                    $('.form-row#ragione_sociale_field').hide();
                    $('.form-row#partita_iva_field').hide();
                    $('.form-row#codice_fiscale_field').hide();
                    $('.form-row#codice_univoco_field').hide();
                }
            }
            $(document).ready(function($){
                check_need_invoice();
                $('#show_invoice_fields').change(function(){
                    check_need_invoice();
                });
            });
    </script>";
   }
}