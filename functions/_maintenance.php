<?php 
// Activate WordPress Maintenance Mode
function wp_maintenance_mode(){
   if( !current_user_can('administrator') ) {
        if ( file_exists( WP_CONTENT_DIR . '/maintenance.php' ) ) {
            require_once( WP_CONTENT_DIR . '/maintenance.php' );
            die();
        }
    }
}
add_action('get_header', 'wp_maintenance_mode');