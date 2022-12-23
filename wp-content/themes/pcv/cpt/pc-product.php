<?php

function pcv_pc_product_cpt() {

	// On rentre les différentes dénominations de notre custom post type qui seront affichées dans l'administration
	$labels = array(
		// Le nom au pluriel
		'name'                => _x( 'Product', 'Post Type General Name'),
		// Le nom au singulier
		'singular_name'       => _x( 'Product', 'Post Type Singular Name'),
		// Le libellé affiché dans le menu
		'menu_name'           => __( 'Products'),
		// Les différents libellés de l'administration
		'all_items'           => __( 'All products'),
		'view_item'           => __( 'View products'),
		'add_new_item'        => __( 'Add product'),
		'add_new'             => __( 'Add'),
		'edit_item'           => __( 'Modifier produit'),
		'update_item'         => __( 'Modifier produit'),
		'search_items'        => __( 'Rechercher un produit'),
		'not_found'           => __( 'Non trouvé'),
		'not_found_in_trash'  => __( 'Non trouvé dans la corbeille'),
	);

	// On peut définir ici d'autres options pour notre custom post type

	$args = array(
		'label'               => __( 'Produits'),
		'description'         => __( 'Tous les produits'),
		'labels'              => $labels,
		// On définit les options disponibles dans l'éditeur de notre custom post type ( un titre, un auteur...)
		'supports'            => array( 'title', 'editor', 'thumbnail' ),
		/*
		* Différentes options supplémentaires
		*/
		'show_in_rest' => false,
		'hierarchical'        => false,
		'public'              => true,
		'has_archive'         => false,
		'rewrite'			  => array( 'slug' => 'produit'),

	);

	register_post_type( 'pc-product', $args );

}

add_action( 'init', 'pcv_pc_product_cpt', 0 );