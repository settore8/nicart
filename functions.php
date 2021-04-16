<?php

define('NICART_SPEDIZIONE_GRATUITA', 30); 
define('NICART_CONTRASSEGNO', 5); 

$manutenzione = get_field('manutenzione', 'option');
$minify = get_field('minify', 'option');

if ($minify === true) :
  //include ( get_stylesheet_directory() . '/functions/_minify.php' );
endif;

if ($manutenzione === true) :
  include ( get_stylesheet_directory() . '/functions/_maintenance.php' );
endif;

include ( get_stylesheet_directory() . '/functions/_woocommerce.php' );
include ( get_stylesheet_directory() . '/functions/_posttypes.php' );
include ( get_stylesheet_directory() . '/functions/_taxonomy.php' );
include ( get_stylesheet_directory() . '/functions/_images.php' );
include ( get_stylesheet_directory() . '/functions/_wpHacks.php' );
include ( get_stylesheet_directory() . '/functions/_menus.php' );
include ( get_stylesheet_directory() . '/functions/_custom.php' );
include ( get_stylesheet_directory() . '/functions/_login.php' );
include ( get_stylesheet_directory() . '/functions/_recensioni.php' );


// serve per mostrare le gallerie dentro le descrizioni delle categorie
add_filter( 'term_description', 'do_shortcode' );
add_filter('use_block_editor_for_post', '__return_false');

add_theme_support( 'post-thumbnails' );
add_filter( 'auto_update_theme', '__return_false' );
add_filter( 'auto_update_plugin', '__return_false' );
add_filter( 'wpcf7_load_js', '__return_false' );
add_filter( 'wpcf7_load_css', '__return_false' );

add_action('after_setup_theme', 'remove_admin_bar');
function remove_admin_bar() {
	  show_admin_bar(false);
}

add_filter('body_class','my_class_names');
function my_class_names($classes) {
    if (! ( is_user_logged_in() ) ) {
        $classes[] = 'logged-out';
    }
    return $classes;
}

/* infiniti riventitori */
function hwl_home_pagesize( $query ) {
  if ( is_admin() || ! $query->is_main_query() )
      return;

  if ( is_post_type_archive( 'retailer' ) ) {
      // Display 50 posts for a custom post type called 'movie'
      $query->set( 'posts_per_page', -1 );
      return;
  }
}
add_action( 'pre_get_posts', 'hwl_home_pagesize', 1 );



function so23698827_filter_post_type_link( $link, $post ) {
  if ( $post->post_type == 'prodotto' ) {
    if ( $cats = get_the_terms( $post->ID, 'cat' ) ) {
      $link = str_replace( '%cat%', current( $cats )->slug, $link );
    }
  }
  return $link;
}
add_filter( 'post_type_link', 'so23698827_filter_post_type_link', 10, 2 );



if( function_exists('acf_add_options_page') ) {
	
	acf_add_options_page(array(
		'page_title' 	=> 'Impostazioni Tema',
		'menu_title'	=> 'Impostazioni Tema',
		'menu_slug' 	=> 'theme-settings',
		'capability'	=> 'activate_plugins',
		'redirect'		=> false
	));
	
}

// Function to change email address
function wpb_sender_email( $original_email_address ) {
  return 'noreply@nicart.it';
}
// Function to change sender name
function wpb_sender_name( $original_email_from ) {
  return 'Nicart Srl';
}
// Hooking up our functions to WordPress filters 
add_filter( 'wp_mail_from', 'wpb_sender_email' );
add_filter( 'wp_mail_from_name', 'wpb_sender_name' );


// Setting the Google Maps API key for ACF
function bmhe_acf_init() {
  acf_update_setting('google_api_key', GOOGLEAPIKEY);
  }
add_action( 'init', 'bmhe_acf_init' );


function imagesPath() {
  $template = get_stylesheet_directory_uri();
  $folder = 'images';
  echo $template .'/'. $folder;
}


function custom_order( $query ) {
  if ( $query->is_archive() && $query->is_main_query() ) {
      $query->set( 'orderby', 'menu_order' );
      $query->set( 'order', 'ASC' );
  }
}
add_action( 'pre_get_posts', 'custom_order' );

