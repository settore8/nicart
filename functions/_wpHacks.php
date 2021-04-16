<?php


remove_action( 'wp_head', 'rest_output_link_wp_head', 10 );
remove_action( 'wp_head', 'wp_oembed_add_discovery_links', 10 );
remove_action( 'template_redirect', 'rest_output_link_header', 11, 0 );
remove_action ('wp_head', 'rsd_link');
remove_action( 'wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'wp_generator');


function my_deregister_scripts(){
  wp_deregister_script( 'wp-embed' );
}
add_action( 'wp_footer', 'my_deregister_scripts' );


/* ELIMINA BOZZE AUTOMATICHE E REVISIONI */

    if (is_admin()){
    if ( get_option('db_enable_auto_clean')=='y' && (get_option('db_last_auto_cnl') < time()- 86400) )  {
        global  $wpdb;
        $del= $wpdb->query("DELETE FROM $wpdb->posts WHERE post_status = 'auto-draft'");
        $del= $wpdb->query("DELETE FROM $wpdb->posts WHERE post_type = 'revision'");
        $del= $wpdb->query("DELETE FROM $wpdb->options WHERE option_name LIKE '_transient_timeout_rss%'");
        $del= $wpdb->query("DELETE FROM $wpdb->options WHERE option_name LIKE '_transient_rss_%'");
        $del= $wpdb->query("DELETE FROM $wpdb->options WHERE option_name LIKE '_transient_timeout_feed_%'");
        $del= $wpdb->query("DELETE FROM $wpdb->options WHERE option_name LIKE '_transient_feed_%'");
        update_option('db_last_auto_cnl',time());
    }
}


/* ELIMINA JQUERY DEFAULT */
/*
add_filter( 'wp_default_scripts', 'dequeue_jquery_migrate' );

function dequeue_jquery_migrate( &$scripts){
  if(!is_admin()){
    $scripts->remove( 'jquery');
  }
}
*/

function wpdocs_dequeue_script() {
        wp_dequeue_script( 'jquery' ); 
} 
add_action( 'wp_print_scripts', 'wpdocs_dequeue_script', 100 );



function remove_admin_bar_links() {
    global $wp_admin_bar;
    $wp_admin_bar->remove_menu('wp-logo');          // Remove the WordPress logo
    $wp_admin_bar->remove_menu('about');            // Remove the about WordPress link
    $wp_admin_bar->remove_menu('wporg');            // Remove the WordPress.org link
    $wp_admin_bar->remove_menu('documentation');    // Remove the WordPress documentation link
    $wp_admin_bar->remove_menu('support-forums');   // Remove the support forums link
    $wp_admin_bar->remove_menu('feedback');         // Remove the feedback link
    //$wp_admin_bar->remove_menu('site-name');        // Remove the site name menu
    $wp_admin_bar->remove_menu('view-site');        // Remove the view site link
    $wp_admin_bar->remove_menu('updates');          // Remove the updates link
    $wp_admin_bar->remove_menu('comments');         // Remove the comments link
    $wp_admin_bar->remove_menu('new-content');      // Remove the content link
    $wp_admin_bar->remove_menu('w3tc');             // If you use w3 total cache remove the performance link
    //$wp_admin_bar->remove_menu('my-account');       // Remove the user details tab
}
add_action( 'wp_before_admin_bar_render', 'remove_admin_bar_links' );


function disable_wp_emojicons() {

  // all actions related to emojis
  remove_action( 'admin_print_styles', 'print_emoji_styles' );
  remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
  remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
  remove_action( 'wp_print_styles', 'print_emoji_styles' );
  remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
  remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
  remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );

  // filter to remove TinyMCE emojis
  add_filter( 'tiny_mce_plugins', 'disable_emojicons_tinymce' );
}
	add_action( 'init', 'disable_wp_emojicons' );


function disable_emojicons_tinymce( $plugins ) {
  if ( is_array( $plugins ) ) {
    return array_diff( $plugins, array( 'wpemoji' ) );
  } else {
    return array();
  }
}


/*------------------------------------------------------------------------------------
    remove quick edit for custom post type videos just to check if less mem consumption
------------------------------------------------------------------------------------*/
add_filter( 'post_row_actions', 'remove_row_actions', 10, 2 );
function remove_row_actions( $actions, $post )
{
  global $current_screen;
    //if( $current_screen->post_type != 'cliente', 'intervento' ) return $actions;
    //unset( $actions['edit'] );
    //unset( $actions['view'] );
    //unset( $actions['trash'] );
    unset( $actions['inline hide-if-no-js'] );
    //$actions['inline hide-if-no-js'] .= __( 'Quick&nbsp;Edit' );

    return $actions;
}






?>