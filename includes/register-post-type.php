<?php

function ustlib_setup_init() {
	$labels = array(
        'name'                  => 'Books',
        'singular_name'         => 'Book',
        'menu_name'             => 'Books',
        'name_admin_bar'        => 'Book',
        'add_new'               => 'Add New',
        'add_new_item'          => 'Add New Book',
        'new_item'              => 'New Book',
        'edit_item'             => 'Edit Book',
        'view_item'             => 'View Book',
        'all_items'             => 'All Books',
        'search_items'          => 'Search Books',
        'parent_item_colon'     => 'Parent Books:',
 
    );
 
    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'exclude_from_search' => false,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'librarie' ),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => null,
        'menu_icon'			 => 'dashicons-book-alt',
        'supports'           => array( 'title', 'thumbnail', 'excerpt' ),
    );
    

	$cat_args = array( 
		'labels' => array(
						'name' => 'Categorii cărți',
						'add_new_item' => 'Adaugă categorie',
						'new_item_name' => "Categorie nouă"
					),
		'show_ui' => true,
		'public' => true,
		'show_in_nav_menus' => true,
		'show_tagcloud' => true,
		'hierarchical' => true,
		'query_var' => true,
	   	'rewrite' => array( 'slug' => 'categorie-carti' )
	);

	// ETICHETE
	$tag_args = array( 
		'labels' => array(
						'name' => 'Etichete cărți',
						'add_new_item' => 'Adaugă eticheta',
						'new_item_name' => "Eticheta nouă"
					),
		'show_ui' => true,
		'public' => true,
		'show_in_nav_menus' => true,
		'show_tagcloud' => true,
		'hierarchical' => false,
		'query_var' => true,
	   	'rewrite' => array( 'slug' => 'etichete-carti' )
	);

	//AUTHOR
	$author_args = array( 
		'labels' => array(
						'name' => 'Autor',
						'add_new_item' => 'Adaugă autor',
						'new_item_name' => "Autor nou"
					),
		'show_ui' => true,
		'public' => true,
		'show_in_nav_menus' => true,
		'show_tagcloud' => true,
		'hierarchical' => false,
		'query_var' => true,
	   	'rewrite' => array( 'slug' => 'autor-carti' )
	);

	//EDITURA
	$publishing_house_args = array( 
		'labels' => array(
						'name' => 'Editura',
						'add_new_item' => 'Adaugă editura',
						'new_item_name' => "Editura noua"
					),
		'show_ui' => true,
		'public' => true,
		'show_in_nav_menus' => true,
		'show_tagcloud' => true,
		'hierarchical' => false,
		'query_var' => true,
	   	'rewrite' => array( 'slug' => 'editura' )
	);

	//AN
	$year_args = array( 
		'labels' => array(
						'name' => 'Anul',
						'add_new_item' => 'Adaugă an',
						'new_item_name' => "An nou"
					),
		'show_ui' => true,
		'public' => true,
		'show_in_nav_menus' => true,
		'show_tagcloud' => true,
		'hierarchical' => false,
		'query_var' => true,
	   	'rewrite' => array( 'slug' => 'an' )
	);

	//Lang
	$lang_args = array( 
		'labels' => array(
						'name' => 'Limba',
						'add_new_item' => 'Adaugă limba',
						'new_item_name' => "limba noua"
					),
		'show_ui' => true,
		'public' => true,
		'show_in_nav_menus' => true,
		'show_tagcloud' => true,
		'hierarchical' => false,
		'query_var' => true,
	   	'rewrite' => array( 'slug' => 'limba' )
	);

	//Reg Post Type
	register_post_type( 'b3c_library', $args );

	//Reg taxonomii
	register_taxonomy('author_book','b3c_library', $author_args );
	register_taxonomy('pubhouse_book','b3c_library', $publishing_house_args );
	register_taxonomy('year_book','b3c_library', $year_args );
	register_taxonomy('tag_book','b3c_library', $tag_args );
	register_taxonomy('lang_book','b3c_library', $lang_args );
	register_taxonomy('book_category','b3c_library', $cat_args );

}
 
add_action( 'init', 'ustlib_setup_init' );