<?php

add_action( 'init', 'codex_video_init' );

function codex_video_init() {
	$labels = array(
		'name'               => _x( 'Video', 'post type general name', 'your-plugin-textdomain' ),
		'singular_name'      => _x( 'video', 'post type singular name', 'your-plugin-textdomain' ),
		'menu_name'          => _x( 'Video', 'admin menu', 'your-plugin-textdomain' ),
		'name_admin_bar'     => _x( 'video', 'add new on admin bar', 'your-plugin-textdomain' ),
		'add_new'            => _x( 'Aggiungi video', 'privati', 'your-plugin-textdomain' ),
		'add_new_item'       => __( 'Aggiungi nuovo video', 'your-plugin-textdomain' ),
		'new_item'           => __( 'Nuovo video', 'your-plugin-textdomain' ),
		'edit_item'          => __( 'Modifico video', 'your-plugin-textdomain' ),
		'view_item'          => __( 'Vedi i video', 'your-plugin-textdomain' ),
		'search_items'       => __( 'Cerca video', 'your-plugin-textdomain' ),
		'parent_item_colon'  => __( 'Parent video:', 'your-plugin-textdomain' ),
		'not_found'          => __( 'Nessuna video trovato.', 'your-plugin-textdomain' ),
		'not_found_in_trash' => __( 'Nessuna video trovato nel cestino.', 'your-plugin-textdomain' )
	);

	$args = array(
		'labels'             => $labels,
    'description'        => __( 'Description.', 'your-plugin-textdomain' ),
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite' => array(
	    'slug' => 'video',
	    'with_front' => true
	  	),
    'has_archive'        => 'video',
		'capability_type'    => 'post',
		'hierarchical'       => false,
		'supports'           => array( 'title')
	);

	register_post_type( 'video', $args );
}



add_action( 'init', 'codex_retailer_init' );

function codex_retailer_init() {
	$labels = array(
		'name'               => _x( 'Rivenditore', 'post type general name', 'your-plugin-textdomain' ),
		'singular_name'      => _x( 'Rivenditore', 'post type singular name', 'your-plugin-textdomain' ),
		'menu_name'          => _x( 'Rivenditori', 'admin menu', 'your-plugin-textdomain' ),
		'name_admin_bar'     => _x( 'Rivenditore', 'add new on admin bar', 'your-plugin-textdomain' ),
		'add_new'            => _x( 'Aggiungi Rivenditore', 'privati', 'your-plugin-textdomain' ),
		'add_new_item'       => __( 'Aggiungi nuovo Rivenditore', 'your-plugin-textdomain' ),
		'new_item'           => __( 'Nuovo Rivenditore', 'your-plugin-textdomain' ),
		'edit_item'          => __( 'Modifico Rivenditore', 'your-plugin-textdomain' ),
		'view_item'          => __( 'Vedi i rivenditori', 'your-plugin-textdomain' ),
		'search_items'       => __( 'Cerca Rivenditore', 'your-plugin-textdomain' ),
		'parent_item_colon'  => __( 'Parent Rivenditore:', 'your-plugin-textdomain' ),
		'not_found'          => __( 'Nessuna rivenditore trovato.', 'your-plugin-textdomain' ),
		'not_found_in_trash' => __( 'Nessuna rivenditore trovato nel cestino.', 'your-plugin-textdomain' )
	);

	$args = array(
		'labels'             => $labels,
    'description'        => __( 'Description.', 'your-plugin-textdomain' ),
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite' => array(
	    'slug' => 'rivenditori',
	    'with_front' => true
	  	),
    	'has_archive'        => 'rivenditori',
		'capability_type'    => 'post',
		'hierarchical'       => false,
		'supports'           => array( 'title')
	);

	register_post_type( 'retailer', $args );
}


add_action( 'template_redirect', function() {
    if ( is_singular('retailer') ) {
        global $post;
        $redirectLink = get_post_type_archive_link( 'retailer' );
        wp_redirect( $redirectLink, 302 );
        exit;
    }
});


add_action( 'init', 'codex_faq_init' );

function codex_faq_init() {
	$labels = array(
		'name'               => _x( 'Faqs', 'post type general name', 'your-plugin-textdomain' ),
		'singular_name'      => _x( 'Faq', 'post type singular name', 'your-plugin-textdomain' ),
		'menu_name'          => _x( 'Faqs', 'admin menu', 'your-plugin-textdomain' ),
		'name_admin_bar'     => _x( 'faq', 'add new on admin bar', 'your-plugin-textdomain' ),
		'add_new'            => _x( 'Aggiungi faq', 'privati', 'your-plugin-textdomain' ),
		'add_new_item'       => __( 'Aggiungi nuovo faq', 'your-plugin-textdomain' ),
		'new_item'           => __( 'Nuovo faq', 'your-plugin-textdomain' ),
		'edit_item'          => __( 'Modifico faq', 'your-plugin-textdomain' ),
		'view_item'          => __( 'Vedi i faq', 'your-plugin-textdomain' ),
		'search_items'       => __( 'Cerca faq', 'your-plugin-textdomain' ),
		'parent_item_colon'  => __( 'Parent faq:', 'your-plugin-textdomain' ),
		'not_found'          => __( 'Nessuna faq trovato.', 'your-plugin-textdomain' ),
		'not_found_in_trash' => __( 'Nessuna faq trovato nel cestino.', 'your-plugin-textdomain' )
	);

	$args = array(
		'labels'             => $labels,
    	'description'        => __( 'Description.', 'your-plugin-textdomain' ),
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite' => array(
	    'slug' => 'faq',
	    	'with_front' => true
	  	),
		'has_archive'        => 'domande-frequenti',
		'capability_type'    => 'post',
		'hierarchical'       => false,
		'supports'           => array( 'title', 'page-attributes' ),
		);
	register_post_type( 'faq', $args );
}




?>
