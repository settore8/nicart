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

// aggiunge i dati all'ordine
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
   $billing_codice_fiscale = get_post_meta( $order->get_id(), '_billing_codice_fiscale', true );

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

   if($billing_codice_fiscale) {
    echo '<p><strong>' . __( 'Codice Fiscale' ) . ':</strong> ' . $billing_codice_fiscale . '</p>';
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

   echo '<div class="show_if_additional_fields" style="display:block;">';
   
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

    echo '<div style="clear:both"></div>';
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
    if (isset($_POST['_billing_codice_fiscale'])) {
        $cf = sanitize_text_field($_POST['_billing_codice_fiscale']);
        if (validate_codice_fiscale($cf)) {
            update_post_meta($order_id, '_billing_codice_fiscale', $cf);
        } else {
            // Aggiungi un messaggio di errore
            add_filter('woocommerce_checkout_posted_data', function($data) use ($cf) {
                $data['_billing_codice_fiscale'] = $cf;
                return $data;
            });

            add_action('woocommerce_checkout_process', function() {
                wc_add_notice('Il codice fiscale inserito non è valido.', 'error');
            });
        }
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

                    if ($('input[name=\"payment_method\"]:checked').val() === 'bacs') {
                        $('.form-row#billing_codice_fiscale_field input').val('');
                        $('.form-row#billing_codice_fiscale_field').hide();
                    }
                    
                }else{
                    $('.form-row#ragione_sociale_field').hide();
                    $('.form-row#partita_iva_field').hide();
                    $('.form-row#codice_fiscale_field').hide();
                    $('.form-row#codice_univoco_field').hide();

                    if($('input[name=\"payment_method\"]:checked').val() === 'bacs') {
                        $('.form-row#billing_codice_fiscale_field').show();
                    }

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

/**
 * CAMPO CONDIZIONALE SE BONIFICO
 */


 add_filter('woocommerce_billing_fields', 'custom_billing_field');
 function custom_billing_field($fields) {
     $fields['billing_codice_fiscale'] = array(
         'type'        => 'text',
         'label'       => __('Codice Fiscale', 'woocommerce'),
         'required'    => false, // Non obbligatorio di default
         'class'       => array('form-row-wide'),
         'clear'       => true,
         'priority'    => 45, // Posiziona dopo billing_company (default 40)
     );
     return $fields;
 }
 

 add_action('woocommerce_checkout_process', 'custom_payment_method_checkout_process');
 function custom_payment_method_checkout_process() {
     // Verifica se il metodo di pagamento selezionato è "bonifico bancario anticipato"
     if (isset($_POST['payment_method']) && $_POST['payment_method'] === 'bacs') {
         // Verifica se il campo personalizzato è vuoto
         if (empty($_POST['billing_codice_fiscale']) && empty($_POST['codice_fiscale'])) {
             wc_add_notice(__('Il campo "Codice Fiscale" è obbligatorio per il bonifico bancario anticipato.', 'woocommerce'), 'error');
         } else {
             // Verifica la validità del codice fiscale

             if(!empty($_POST['billing_codice_fiscale'])) {
                if (!validate_codice_fiscale($_POST['billing_codice_fiscale'])) {
                    wc_add_notice(__('Il campo "Codice Fiscale" non è valido.', 'woocommerce'), 'error');
                }
             }

             if(!empty($_POST['codice_fiscale'])) {
                if (!validate_codice_fiscale($_POST['codice_fiscale'])) {
                    wc_add_notice(__('Il campo "Codice Fiscale" non è valido.', 'woocommerce'), 'error');
                }
             }
            
         }
     }
 }
 
 function validate_codice_fiscale($cf) {
    if (strlen($cf) != 16) {
        return false;
    }

    $cf = strtoupper($cf);

    if (!preg_match("/^[A-Z0-9]+$/", $cf)) {
        return false;
    }

    $odd_values = [
        '0' => 1, '1' => 0, '2' => 5, '3' => 7, '4' => 9, '5' => 13, '6' => 15, '7' => 17, '8' => 19, '9' => 21,
        'A' => 1, 'B' => 0, 'C' => 5, 'D' => 7, 'E' => 9, 'F' => 13, 'G' => 15, 'H' => 17, 'I' => 19, 'J' => 21,
        'K' => 2, 'L' => 4, 'M' => 18, 'N' => 20, 'O' => 11, 'P' => 3, 'Q' => 6, 'R' => 8, 'S' => 12, 'T' => 14,
        'U' => 16, 'V' => 10, 'W' => 22, 'X' => 25, 'Y' => 24, 'Z' => 23
    ];

    $even_values = [
        '0' => 0, '1' => 1, '2' => 2, '3' => 3, '4' => 4, '5' => 5, '6' => 6, '7' => 7, '8' => 8, '9' => 9,
        'A' => 0, 'B' => 1, 'C' => 2, 'D' => 3, 'E' => 4, 'F' => 5, 'G' => 6, 'H' => 7, 'I' => 8, 'J' => 9,
        'K' => 10, 'L' => 11, 'M' => 12, 'N' => 13, 'O' => 14, 'P' => 15, 'Q' => 16, 'R' => 17, 'S' => 18,
        'T' => 19, 'U' => 20, 'V' => 21, 'W' => 22, 'X' => 23, 'Y' => 24, 'Z' => 25
    ];

    $sum = 0;

    for ($i = 0; $i < 15; $i++) {
        if ($i % 2 == 0) {
            $sum += $odd_values[$cf[$i]];
        } else {
            $sum += $even_values[$cf[$i]];
        }
    }

    $check_characters = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
    $check_code = $check_characters[$sum % 26];

    return $check_code == $cf[15];
}


 add_action('woocommerce_checkout_update_order_meta', 'save_custom_billing_field');
function save_custom_billing_field($order_id) {
    if (!empty($_POST['billing_codice_fiscale'])) {
        update_post_meta($order_id, '_billing_codice_fiscale', sanitize_text_field($_POST['billing_codice_fiscale']));
    }
}

add_action('woocommerce_admin_order_data_after_billing_address', 'display_custom_billing_field_in_admin_order', 10, 1);
function display_custom_billing_field_in_admin_order($order) {
    $custom_field = get_post_meta($order->get_id(), '_billing_codice_fiscale', true);
    if ($custom_field) {
        echo '<div style="display:block; padding: 0px; margin-top: 20px !important; clear: both; float: none">';
            echo '<h4>Pagamento con Bonifico</h4>';
            woocommerce_wp_text_input( array(
                'id' => '_billing_codice_fiscale',
                'label' => __('Codice fiscale'),
                'value' => get_post_meta( $order->get_id(), '_billing_codice_fiscale', true ),
                'desc_tip' => true,
             ));
             echo '<div style="clear: both"></div>';
        echo '</div>';
    }
}


add_action('wp_footer', 'custom_checkout_field_display');
function custom_checkout_field_display() {
    if (is_checkout()) {
        ?>
        <script type="text/javascript">
            jQuery(document).ready(function($) {
                function toggleCustomField() {
                    if ($('input[name="payment_method"]:checked').val() === 'bacs') {
                        $('#billing_codice_fiscale_field').show();
                        $('#billing_codice_fiscale').attr('required', 'required');
                        $('label[for="billing_codice_fiscale"] .optional').remove();
                        if ($('label[for="billing_codice_fiscale"] abbr').length === 0) {
                            $('label[for="billing_codice_fiscale"]').append(' <abbr class="required" title="obbligatorio">*</abbr>');
                        }
                    } else {
                        $('#billing_codice_fiscale_field').hide();
                        $('#billing_codice_fiscale').removeAttr('required');
                        $('label[for="billing_codice_fiscale"] abbr.required').remove();
                        if ($('label[for="billing_codice_fiscale"] .optional').length === 0) {
                            $('label[for="billing_codice_fiscale"]').append(' <span class="optional">(opzionale)</span>');
                        }
                    }
                }

                // Nascondi il campo inizialmente
                $('#billing_codice_fiscale_field').hide();

                // Mostra/nascondi il campo in base alla selezione del metodo di pagamento
                $('form.checkout').on('change', 'input[name="payment_method"]', function() {
                    toggleCustomField();
                });

                // Inizializza lo stato del campo in base al metodo di pagamento selezionato al caricamento della pagina
                toggleCustomField();
            });
        </script>
        <?php
    }
}
