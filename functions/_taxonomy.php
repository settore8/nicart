<?php
add_action( 'init', 'create_categoria_taxonomies', 0 );

function create_categoria_taxonomies() {

	$labels = array(
		'name'              => _x( 'Categoria', 'taxonomy general name' ),
		'singular_name'     => _x( 'Categoria', 'taxonomy singular name' ),
		'search_items'      => __( 'Cerca categoria' ),
		'all_items'         => __( 'Tutte le categorie' ),
		'parent_item'       => __( 'Parent categorie' ),
		'parent_item_colon' => __( 'Parent categorie:' ),
		'edit_item'         => __( 'Modifica categoria' ),
		'update_item'       => __( 'Aggiorna Categoria' ),
		'add_new_item'      => __( 'Aggiungi Nuova Categoria' ),
		'new_item_name'     => __( 'Nuovo nome categoria' ),
		'menu_name'         => __( 'Categoria' ),
	);

	$args = array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array('slug' => 'prodottiii', 'with_front' => true),
		'public' => true,
		'publicly_queryable' => true,
		'exclude_from_search' => true,
		'query_var' => 'categoria'
	);

	register_taxonomy( 'cat', array( 'prodotto' ), $args );

}
